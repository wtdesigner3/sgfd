<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["cid"] ?? 0);
$data=mysqli_query($conn,"DELETE FROM `tbl_client` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Client Deleted successfully";
	header("location:../manage-clients.php");
}
?>