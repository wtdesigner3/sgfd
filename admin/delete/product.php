<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);


		$data=mysqli_query($conn,"DELETE FROM `tbl_product` WHERE `p_id`='$b'");
		if($data==true)
		{
			 echo "<script>alert('Product Deleted successfully'); </script>";
			header("Refresh:1;url=../manage-product.php");
		}


?>