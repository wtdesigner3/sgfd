<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_elevate_business where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/elevate/".$bannerData["image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_elevate_business` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Elevate Deleted successfully";
	header("location:../manage-elevate.php");
}
?>