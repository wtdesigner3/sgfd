<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$data=mysqli_query($conn,"DELETE FROM `tbl_event` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Event Deleted successfully";
	header("location:../manage-event.php");
}
?>