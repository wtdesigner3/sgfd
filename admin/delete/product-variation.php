<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["id"] ?? 0);
$pid = intval($_REQUEST["pid"] ?? 0);


		$data=mysqli_query($conn,"DELETE FROM `tbl_variation` WHERE `id`='$b'");
		if($data==true)
		{
			 echo "<script>alert('Product Deleted successfully'); </script>";
			header("Refresh:1;url=../manage-variation.php?id=".$pid);
		}


?>