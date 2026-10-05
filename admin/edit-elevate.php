<?php
require('checksession.php');
include '../inc/function.php';

$b = $_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_elevate_business` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
    $heading = mysqli_real_escape_string($conn,$_POST['heading']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $alt = mysqli_real_escape_string($conn,$_POST['alt']);
    $sort = mysqli_real_escape_string($conn,$_POST['sort_number']);
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$old = mysqli_real_escape_string($conn,$_POST['oldimg']); 

  $ach_image=$_FILES['image']['name'];
  if($ach_image!='')
  {
      $ach_images=time()."_".$ach_image;
      @unlink("../uploads/elevate/".$old);
      move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/elevate/".$ach_images);
  }
  else{
      $ach_images=$old;	
  }

	$query = mysqli_query($conn, "UPDATE `tbl_elevate_business` SET `heading`='$heading',`image`='$ach_images',`sort`='$sort',`status`='$status',`alt`='$alt',`description`='$description' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Elevate Updated Successfully";
		header("refresh:3;url=manage-elevate.php");
	} else {
		$_SESSION['error'] = "Something went wrong. Please try again";
	}
}
?>




<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>

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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Elevate</a></li>
				<li class="breadcrumb-item active">Edit Elevate</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Elevate</h1>
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
							<h4 class="panel-title"> Edit Elevate</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">

	                               <div class="form-group">
										<label for="banner" class="d-none">Heading</label>
										<input type="text" name="heading" class="form-control" id="" placeholder="Enter heading" value="<?= $brec['heading']; ?>">
									</div>
									
									 <div class="form-group">
										<label for="banner" class="d-none">Description</label>
										<!--<input type="text" name="description" class="form-control" id="" placeholder="Enter Description" value="<?= $brec['description']; ?>">-->
										<textarea name="description" class="form-control" id="" placeholder="Enter Description" ><?= $brec['description']; ?></textarea>
									</div>

										<div class="form-group ">
											<label for="exampleInputFile">File input</label>
											<input type="file" name="image" class="form-control" >
											<input type="hidden" name="oldimg"  value="<?= $brec['image']; ?>">
										<p class="help-block">Image dimension must be 128 X 128 & must be png format</p>
											<img src="../uploads/elevate/<?= $brec['image']; ?>" style="width:10%; filter: invert(1);">
											</div>
										
                    					
									<div class="form-group">
										<label for="banner">Sort Numbers</label>
										<input type="number" name="sort_number" class="form-control" id=""  placeholder="Ex: 99" value="<?= $brec['sort']; ?>">
									</div>

									<div class="form-group">
										<input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') {
																			echo 'checked';
																										} ?>>
										<label for="optionsRadios3">Active</label>

										<input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') {
																			echo 'checked';
																										} ?>>
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