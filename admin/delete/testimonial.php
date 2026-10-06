<?php
require_once(__DIR__ . '/../checksession.php');
require_once(__DIR__ . '/../../inc/function.php');

$b = intval($_REQUEST["bid"] ?? 0);

$banner = mysqli_query($conn, "SELECT * FROM `tbl_testimonial` WHERE `tt_id`='$b'");
$bannerData = mysqli_fetch_assoc($banner);
if (!empty($bannerData["tt_image"])) {
    @unlink(__DIR__ . "/../../uploads/testimonial/" . $bannerData["tt_image"]); 
}

$data = mysqli_query($conn, "DELETE FROM `tbl_testimonial` WHERE `tt_id`='$b'");
if ($data == true) {
	$_SESSION['warning'] = "Testimonial deleted successfully";
	header("location:../manage-testimonial.php");
	exit();
}
?>