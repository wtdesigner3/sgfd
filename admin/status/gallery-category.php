<?php
require_once(__DIR__ . '/../checksession.php');
$qs = intval($_REQUEST["id"] ?? 0);
require('../../inc/function.php');
$data=mysqli_query($conn,"select * from `tbl_gallery_category` where `glry_id`='$qs'");
$rec=mysqli_fetch_array($data);
if($rec['glry_status']==0)
{
	mysqli_query($conn,"UPDATE `tbl_gallery_category` SET `glry_status`='1' where `glry_id`='$qs'");
}
else
{
	mysqli_query($conn,"UPDATE `tbl_gallery_category` SET `glry_status`='0' where `glry_id`='$qs'");
}
//header("location:../view_product.php")
?>