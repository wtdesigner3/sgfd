<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);
$idd = intval($_REQUEST["idd"] ?? 0);
$banner=mysqli_query($conn,"select * from tbl_faqs where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
// @unlink("../../uploads/products/".$bannerData["ach_image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_faqs` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Faqs on Deleted successfully";
	header("location:../manage-faqs.php?idd=$idd");
}
?>