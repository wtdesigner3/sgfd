<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_exibitor_profile where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/exibit-profile/".$bannerData["image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_exibitor_profile` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Exibit Profile Deleted successfully";
	header("location:../manage-exibit-profile.php");
}
?>