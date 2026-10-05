<?php
require_once(__DIR__ . '/../checksession.php');
$qs = intval($_REQUEST["id"] ?? 0);
include('../../inc/function.php');
$data=mysqli_query($conn,"select * from `tbl_links` where `id`='$qs'");
$rec=mysqli_fetch_array($data);
if($rec['status']==0)
{
	mysqli_query($conn,"UPDATE `tbl_links` SET `status`='1' where `id`='$qs'");
}
else
{
	mysqli_query($conn,"UPDATE `tbl_links` SET `status`='0' where `id`='$qs'");
}
//header("location:../view_product.php")
?>

