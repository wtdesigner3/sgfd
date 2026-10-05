<?php
require_once(__DIR__ . '/../checksession.php');
$qs = intval($_REQUEST["id"] ?? 0);
require('../../inc/function.php');
$data=mysqli_query($conn,"select * from `tbl_product` where `p_id`='$qs'");
$rec=mysqli_fetch_array($data);
if($rec['p_status']==0)
{
	mysqli_query($conn,"UPDATE `tbl_product` SET `p_status`='1' where `p_id`='$qs'");
}
else
{
	mysqli_query($conn,"UPDATE `tbl_product` SET `p_status`='0' where `p_id`='$qs'");
}
//header("location:../view_product.php")
?>