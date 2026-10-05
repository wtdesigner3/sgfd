<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["id"] ?? 0);
$banner=mysqli_query($conn,"select * from tbl_subcategory where id='$b'");
$bannerData=mysqli_fetch_assoc($banner);
@unlink("../../uploads/products/".$bannerData["image"]); 
$query=mysqli_query($conn,"UPDATE `tbl_subcategory` SET `image`='' WHERE `id`='$b'");
$_SESSION['warning']="Image on Deleted successfully";
header("location:../manage-subcategory.php");
?>