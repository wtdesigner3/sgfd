<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$data=mysqli_query($conn,"DELETE FROM `tbl_event_category` WHERE `id`='$b'");
if($data==true)
{
	$_SESSION['warning']="Event Category Deleted successfully";
	header("location:../manage-event-category.php");
}
?>