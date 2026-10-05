<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `tbl_abt_group_company` WHERE `id`='$b'"));
@unlink('../../uploads/companygroup/'.$data['image']);
$delete = mysqli_query($conn, "DELETE FROM `tbl_abt_group_company` WHERE `id`='$b'");
if($delete==true)
{
	$_SESSION['warning']="Group Company Deleted successfully";
	header("location:../manage-group-companies.php");
}
?>