<?php
ob_start();
require_once(__DIR__ . '/checksession.php');
require_once(__DIR__ . '/../inc/function.php');

// If already logged in, redirect to index
if(isset($_SESSION['admin_ses']) && $_SESSION['admin_ses'] === true) {
    header("Location: index.php");
    exit();
}

$errorMessage = '';
if(isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['username'] ?? '')); 
    $pass  = trim($_POST['password'] ?? ''); 

    if(empty($email) || empty($pass)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        $data = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `username`='$email'");
        if($data && mysqli_num_rows($data) > 0) {
            $adminUser = mysqli_fetch_assoc($data);
            $storedHash = trim($adminUser['password'] ?? '');
            $loginSuccess = false;

            // 1. Modern bcrypt / argon2 hash check
            if (password_verify($pass, $storedHash)) {
                $loginSuccess = true;
                if (password_needs_rehash($storedHash, PASSWORD_DEFAULT)) {
                    $newHash = password_hash($pass, PASSWORD_DEFAULT);
                    $userId = intval($adminUser['id']);
                    @mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
                }
            }
            // 2. Legacy MD5 check (32 hex chars)
            elseif (strlen($storedHash) === 32 && ctype_xdigit($storedHash) && md5($pass) === $storedHash) {
                $loginSuccess = true;
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $userId = intval($adminUser['id']);
                @mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
            }
            // 3. Legacy SHA1 check (40 hex chars)
            elseif (strlen($storedHash) === 40 && ctype_xdigit($storedHash) && sha1($pass) === $storedHash) {
                $loginSuccess = true;
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $userId = intval($adminUser['id']);
                @mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
            }
            // 4. Plaintext password check (fallback for unhashed passwords in legacy DBs)
            elseif ($pass === $storedHash) {
                $loginSuccess = true;
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $userId = intval($adminUser['id']);
                @mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
            }

            if ($loginSuccess) {
                @session_regenerate_id(true);
                $_SESSION['admin_ses']   = true;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_id']    = $adminUser['id'];
                $_SESSION['success']     = "You Are Successfully Logged In";
                header('Location: index.php');
                exit();
            } else {
                $errorMessage = "Invalid Password. Please check your password and try again.";
            }
        } else {
            $errorMessage = "Invalid Username. Account '$email' not found.";
        }
    }
}

$sqqll   = "SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon`, `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resulltt = $conn->query($sqqll);
$rowww    = $resulltt ? $resulltt->fetch_assoc() : [];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Signin | <?= htmlspecialchars($rowww['pro_title'] ?? 'SG FOODEES'); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.min.css" rel="stylesheet" />
	<link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<script src="assets/plugins/pace/pace.min.js"></script>
    <link rel="shortcut icon" href="<?= SITE_URL ?>uploads/<?= htmlspecialchars($rowww['pro_favicon'] ?? ''); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/toaster/toaster.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/toaster/toaster.css"> 
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login bg-black animated fadeInDown">
			<!-- begin brand -->
			<div class="login-header">
				<div class="brand">
                    <?php if(!empty($rowww['pro_favicon'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($rowww['pro_favicon']); ?>" width="20%"/>
                    <?php else: ?>
                        <b class="text-white">SG FOODEES</b>
                    <?php endif; ?>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<!-- begin login-content -->
			<div class="login-content" style="background-color: white;">
                <?php if (!empty($errorMessage)): ?>
                    <div class="alert alert-danger" style="margin-bottom: 15px; font-weight: 600; font-size: 13px; border-left: 4px solid #dc3545;">
                        <i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>

				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="margin-bottom-0">
					<div class="form-group m-b-20">
						<input type="text" class="form-control form-control-lg inverse-mode" name="username" placeholder="Username" required />
					</div>
                    
					<div class="form-group m-b-20">
						<input type="password" class="form-control form-control-lg inverse-mode" name="password" placeholder="Password" required />
					</div>
					
					<div class="login-buttons">
						<button type="submit" name="login" class="btn btn-block btn-lg" style="background:#7a0000; color:white">Sign me in</button>
					</div>
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end login -->
	</div>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();

			<?php if(!empty($_SESSION['success'])): ?>
				$.toast({
					text: '<?php echo addslashes($_SESSION['success']); ?>',
					heading: 'Success',
					showHideTransition: 'slide',
					icon: 'success'
				});
				<?php unset($_SESSION['success']); ?>
			<?php endif; ?>

			<?php if(!empty($errorMessage)): ?>
				$.toast({
					text: '<?php echo addslashes($errorMessage); ?>',
					heading: 'Sign In Notice',
					showHideTransition: 'slide',
					icon: 'error'
				});
			<?php endif; ?>
		});
	</script>
</body>
</html>
