<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["cid"] ?? 0);



$catData=mysqli_query($conn,"select * from tbl_subsubcategory where subcategory_id='$b'");
if(mysqli_num_rows($catData)>0)
{
	echo "<script>alert('Please First Delete All Subsubcategory Of This SubCategory'); </script>";
	header("Refresh:1;url=../manage-subcategory.php");
}
else
{
	$data=mysqli_query($conn,"DELETE FROM `tbl_subcategory` WHERE `id`='$b'");
	if($data==true)
	{
		echo "<script>alert('Sub-Category Deleted successfully'); </script>";
		header("Refresh:1;url=../manage-subcategory.php");
	}
}

?>