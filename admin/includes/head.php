<?php
// Disable caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>

<?php
$sl ="SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon` , `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resut = $conn->query($sl);
$ro = $resut->fetch_assoc();
?>
<head>

	<title><?=$ro['pro_title']?> | Admin Panel</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="shortcut icon" type="image/x-icon" href="<?= SITE_URL ?>uploads/<?php echo $ro['pro_favicon']; ?>">-->
	 <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_URL ?>uploads/<?php echo $ro['pro_favicon']; ?>"> 
	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.css" rel="stylesheet" />
	<link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<script src="assets/ckeditor/ckeditor.js"></script>
    <script src="assets/ckeditor/samples/js/sample.js"></script>
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    <script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/toaster/toaster.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/toaster/toaster.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
</head>