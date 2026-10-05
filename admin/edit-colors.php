<?php
require('checksession.php'); 
require('../inc/function.php');

$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_color` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{
	$position = mysqli_real_escape_string($conn,$_POST['position']);
	$color = mysqli_real_escape_string($conn,$_POST['color']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
  

   $query=mysqli_query($conn,"UPDATE `tbl_color` SET `sort`='$position',`name`='$name', `color`='$color', `status`='$status' WHERE `id`='$b'");
   if($query==true)
      {
	  $_SESSION['success']="Color Updated Successfully";	
	  header("refresh:3;url=manage-colors.php");
      }
      else 
      {
	   $_SESSION['error']="Something went wrong. Please try again";		
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<style>
 .color {
    display: block;
    text-align: center;
    width: 1.6rem;
    height: 1.6rem;
    border-radius: 50%;
    border: none;
    margin-right: 0;
    margin-top:5px;
 }
</style>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
	<!-- begin #page-container -->
	<?php require("includes/header.php"); ?>
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
	<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Colors Management</a></li>
				<li class="breadcrumb-item active">Edit Color</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Color </h1>
			<!-- begin row -->
			<div class="row">
				<!-- begin col-10 -->
				<div class="col-lg-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title"> Edit Color</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">

			  <div class="row">
				  <div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputPassword1">Color</label>
							<input type="color" name="color" class="form-control" id="exampleInputPassword1" value="<?= $brec['color']; ?>">
						</div>
				  </div>
                  <div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputPassword1"> Color Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Enter Color Name" value="<?= $brec['name']; ?>">
						</div>
					</div>
				  <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">position</label>
							<input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">

						</div>
				  </div>
				 
				
			  </div>


                <div class="form-group">
                <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['status']=='1'){ echo 'checked';}?>>
                <label for="optionsRadios3">Active</label>
                
                <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['status']=='0'){ echo 'checked';}?>>
                <label for="optionsRadios4">Inactive</label>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
              </div>
            </form>
						</div>
						<!-- end panel-body -->
					</div>
					<!-- end panel -->
				</div>
				<!-- end col-10 -->
			</div>
			<!-- end row -->
		</div>
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
<?php require("includes/footer.php"); ?>

    	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>

</body>
</html>
