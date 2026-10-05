<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$catData=mysqli_query($conn,"select * from tbl_subsubcategory where category_id='$b'");
if(mysqli_num_rows($catData)>0)
{
    echo "<script>alert('Please Delete All subsubcategory To Delete This Category'); </script>";
	header("Refresh:1;url=../manage-package-cat.php");
}
else
{
	$subcat=mysqli_query($conn,"select * from tbl_subcategory where category_id='$b'");
	if(mysqli_num_rows($subcat)>0)
	{
		 echo "<script>alert('Please Delete Subcategory To  Delete This Category'); </script>";
		header("Refresh:1;url=../manage-package-cat.php");
	}
	else
	{
		$data=mysqli_query($conn,"DELETE FROM `tbl_category` WHERE `id`='$b'");
		if($data==true)
		{
			 echo "<script>alert('Category Deleted successfully'); </script>";
			header("Refresh:1;url=../manage-package-cat.php");
		}
	}
}

?>