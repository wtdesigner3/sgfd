<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_previous_exhibit where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/previous-exibit/".$bannerData["image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_previous_exhibit` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Previous Exibit Deleted successfully";
	header("location:../manage-previous.php");
}
?>