<?php
require_once(__DIR__ . '/../checksession.php');
include('../../inc/function.php');
$qs = intval($_REQUEST["id"] ?? 0);
$data=mysqli_query($conn,"select * from `tbl_client` where `id`='$qs'");
$rec=mysqli_fetch_array($data);
if($rec['status']==0)
{
	mysqli_query($conn,"UPDATE `tbl_client` SET `status`='1' where `id`='$qs'");

}
else
{
	mysqli_query($conn,"UPDATE `tbl_client` SET `status`='0' where `id`='$qs'");
}

?>