<?php
require_once(__DIR__ . '/../checksession.php');
$qs = intval($_REQUEST["id"] ?? 0);
require('../../inc/function.php');
$data=mysqli_query($conn,"select * from `tbl_visa_steps` where `vs_id`='$qs'");
$rec=mysqli_fetch_array($data);
if($rec['vs_status']==0)
{
	mysqli_query($conn,"UPDATE `tbl_visa_steps` SET `vs_status`='1' where `vs_id`='$qs'");
}
else
{
	mysqli_query($conn,"UPDATE `tbl_visa_steps` SET `vs_status`='0' where `vs_id`='$qs'");
}
//header("location:../view_product.php")
?>