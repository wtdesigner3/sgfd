<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);
$idd = intval($_REQUEST["idd"] ?? 0);
$banner=mysqli_query($conn,"select * from tbl_focusingon where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/facilities/".$bannerData["ach_image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_focusingon` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Focusing on Deleted successfully";
	header("location:../manage-focusingon.php");
}
?>