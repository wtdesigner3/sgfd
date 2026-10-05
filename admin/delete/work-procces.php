<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_visa_steps where vs_id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/visasteps/".$bannerData["vs_image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_visa_steps` WHERE `vs_id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Work Procces Deleted successfully";
	header("location:../manage-work-procces.php");
}
?>