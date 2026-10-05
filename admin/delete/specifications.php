<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);
$idd = intval($_REQUEST["idd"] ?? 0);
$banner=mysqli_query($conn,"select * from tbl_specifications where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/products/".$bannerData["ach_image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_specifications` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Specifications on Deleted successfully";
	header("location:../manage-specifications.php?idd=$idd");
}
?>