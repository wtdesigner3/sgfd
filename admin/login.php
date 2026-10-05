<?php
ob_start();          // MUST be absolute first line
session_start();     // MUST be second line, no @ suppressor

require('../inc/function.php');

// If already logged in, go to index
if(isset($_SESSION['admin_ses']) && $_SESSION['admin_ses'] === true) {
    header("location:index.php");
    exit();
}

if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['username'] ?? '')); 
    $pass  = $_POST['password'] ?? ''; 

    $data = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `username`='$email'");
    if($data && mysqli_num_rows($data) > 0) {
        $adminUser = mysqli_fetch_assoc($data);
        $storedHash = $adminUser['password'];
        $loginSuccess = false;

        // Check legacy MD5 hash (32 hex characters)
        if (strlen($storedHash) === 32 && ctype_xdigit($storedHash)) {
            if (md5($pass) === $storedHash) {
                $loginSuccess = true;
                // Auto-upgrade hash to modern bcrypt
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                $userId = intval($adminUser['id']);
                mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
            }
        } else {
            // Modern password_verify (bcrypt/argon2)
            if (password_verify($pass, $storedHash)) {
                $loginSuccess = true;
                if (password_needs_rehash($storedHash, PASSWORD_DEFAULT)) {
                    $newHash = password_hash($pass, PASSWORD_DEFAULT);
                    $userId = intval($adminUser['id']);
                    mysqli_query($conn, "UPDATE `tbl_admin` SET `password`='$newHash' WHERE `id`=$userId");
                }
            }
        }

        if ($loginSuccess) {
            session_regenerate_id(true);
            $_SESSION['admin_ses']   = true;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_id']    = $adminUser['id'];
            $_SESSION['success']     = "You Are Successfully Logged In";
            header('location:index.php');
            exit();
        } else {
            $_SESSION['error'] = "Invalid Username or Password.";    
        }
    } else {
        $_SESSION['error'] = "Invalid Username or Password.";    
    }
}

$sqqll   = "SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon`, `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resulltt = $conn->query($sqqll);
$rowww    = $resulltt->fetch_assoc();
?> 
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title> Signin | <?=$rowww['pro_title']?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.min.css" rel="stylesheet" />
	<link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<script src="assets/plugins/pace/pace.min.js"></script>
    <link rel="shortcut icon" href="<?= SITE_URL ?>uploads/<?=$rowww['pro_favicon']?>">
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
				    
                    <img src="../uploads/<?php echo $rowww['pro_favicon'];?>" width="20%"/>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			 <!-- begin login-content -->
			  <div class="login-content" style="background-color: white;">
                   
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="margin-bottom-0">
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
		});
	</script>
    <script type="text/javascript">
		$(window).load(function() {
		function getQueryVariable(variable) {
			var query = window.location.search.substring(1);
			var vars = query.split('&');
			for (var i = 0; i < vars.length; i++) {
				var pair = vars[i].split('=');
				if (decodeURIComponent(pair[0]) == variable) {
					return decodeURIComponent(pair[1]);
				}
			}
			return "notfound";
			console.log('Query variable %s not found', variable);
		}
		});
		<?php if(isset($_SESSION['success'])){ ?>
		  $.toast({
				text: '<?php echo $_SESSION['success']; ?>',
				heading: 'Success',
				showHideTransition: 'slide',
				icon: 'success'
			});
		<?php } unset($_SESSION['success']); ?>	
		<?php if(isset($_SESSION['error'])) { ?>	
			  $.toast({
					text: '<?php echo $_SESSION['error']; ?>',
					heading: 'Ooh Snapp..',
					showHideTransition: 'slide',
					icon: 'error'
				});
		<?php } unset($_SESSION['error']); ?>	
   </script>
   
</body>
</html>
