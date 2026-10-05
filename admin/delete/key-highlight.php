<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner=mysqli_query($conn,"select * from tbl_key_highlights where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/key-hightlight/".$bannerData["image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_key_highlights` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="key Highlight Deleted successfully";
	header("location:../manage-key-highlight.php");
}
?>