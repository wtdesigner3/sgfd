<?php
require('checksession.php');
require('../inc/function.php');
if (isset($_POST['submit'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$v_code = mysqli_real_escape_string($conn, $_POST['v_code']);
	$tag = mysqli_real_escape_string($conn, $_POST['tag']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	//=============|image|============//
// 	$bimages = $_FILES['bimage']['name'];
// 	$bimage = time() . "_" . $bimages;
// 	if ($bimages != '') {
// 		move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/banner/" . $bimage);
// 	} else {
// 		$bimage = '';
// 	}
	
// 	$bnrlogo = $_FILES['bnrlogo']['name'];
// 	$bnr_logo = time() . "_" . $bnrlogo;
// 	if ($bnrlogo != '') {
// 		move_uploaded_file($_FILES["bnrlogo"]["tmp_name"], "../uploads/banner/" . $bnr_logo);
// 	} else {
// 		$bnr_logo = '';
// 	}
	
	$query = mysqli_query($conn, "INSERT INTO `tbl_video_testimonia`(`title`,`subtitle`, `v_code`, `tag`, `sort`, `status`) VALUES ('$title','$subtitle','$v_code','$tag','$sort','$status')");
	if ($query == true) {
		$_SESSION['success'] = "inserted successfully";
		header("refresh:3;url=manage-video-testimonials.php");
	} else {
		// Message for unsuccessfull insertion
		$_SESSION['error'] = "Something went wrong. Please try again";
		header("refresh:3;url=manage-video-testimonials.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>

<body>
	<!-- begin #page-container -->
	<?php require("includes/header.php"); ?>
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="breadcrumb-item"><a href="javascript:;">Video Testimonial Management</a></li>
			<li class="breadcrumb-item active">Add Video Testimonial</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Video Testimonial</h1>
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
						<h4 class="panel-title">Add Video Testimonial</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="banner">Video Code</label>
									<input type="text" name="v_code" class="form-control" placeholder="Enter Video Code">
								</div>

								<div class="form-group">
									<label for="banner">Title</label>
									<input type="text" name="title" class="form-control" placeholder="Enter title">
								</div>

								<div class="form-group">
									<label for="banner">SubTitle</label>
									<input type="text" name="subtitle" class="form-control" placeholder="Enter subtitle">
								</div>

								<div class="form-group">
									<label for="banner">Tag</label>
									<input type="text" name="tag" class="form-control" placeholder="Enter tag">
								</div>

								<div class="form-group">
									<label for="exampleInputPassword1">Video Testimonial position</label>
									<input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
								</div>
			
				
								<div class="form-group">
									<input type="radio" value="1" id="optionsRadios3" name="status" checked>
									<label for="optionsRadios3">Active</label>
									<input type="radio" value="0" id="optionsRadios4" name="status">
									<label for="optionsRadios4">Inactive</label>
								</div>

							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary">Click Here To Submit</button>
								<!--<button type="reset" name="reset" class="btn btn-danger">Reset</button>-->
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
		});
	</script>

</body>

</html>