<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_team where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);

$data=mysqli_query($conn,"DELETE FROM `tbl_team` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Team Deleted successfully";
	header("location:../manage-team.php");
}
?>