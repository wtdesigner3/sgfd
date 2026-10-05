<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$key_element=mysqli_query($conn,"select * from tbl_key_element where id='$b'");
$bannerData=mysqli_fetch_assoc($key_element);
@unlink("../../uploads/key-element/".$bannerData["image"]); 

$data=mysqli_query($conn,"DELETE FROM `tbl_key_element` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Key Element Deleted successfully";
	header("location:../manage-key-element.php");
}
?>