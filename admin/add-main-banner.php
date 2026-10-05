<?php
require('checksession.php');
require('../inc/function.php');
if (isset($_POST['submit'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$link1 = mysqli_real_escape_string($conn, $_POST['link1']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	//=============|image|============//
	$bimages = $_FILES['bimage']['name'];
	$bimage = time() . "_" . $bimages;
	if ($bimages != '') {
		move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/banner/" . $bimage);
	} else {
		$bimage = '';
	}

	//=============|Video|============//
	$video = $_FILES['video']['name'];
	$video = time() . "_" . $video;
	if ($video != '') {
		move_uploaded_file($_FILES["video"]["tmp_name"], "../uploads/banner/" . $video);
	} else {
		$video = '';
	}
	
	$query = mysqli_query($conn, "INSERT INTO `tbl_main_banner`(`heading`,`subheading`,`content`, `url1`, `main_image`, `video`, `sort`, `status`) VALUES ('$title','$subtitle','$content','$link1','$bimage','$video','$position','$status')");
	if ($query == true) {
		$_SESSION['success'] = "inserted successfully";
		header("refresh:3;url=manage-main-banner.php");
	} else {
		// Message for unsuccessfull insertion
		$_SESSION['error'] = "Something went wrong. Please try again";
		header("refresh:3;url=manage-main-banner.php");
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
			<li class="breadcrumb-item"><a href="javascript:;">Hero Management</a></li>
			<li class="breadcrumb-item active">Add Hero</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Hero</h1>
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
						<h4 class="panel-title">Add Hero</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">
							 <div class="row"> 
								<div class="form-group col-6">
									<label for="banner">Banner Title</label>
									<input type="text" name="title" class="form-control" id="banner" placeholder="Enter Banner Title">
								</div>

								<div class="form-group col-6">
									<label for="banner">Banner Subtitle</label>
									<input type="text" name="subtitle" class="form-control" id="banner" placeholder="Enter Banner Subtitle">
								</div>
							</div>	
								
							<div class="form-group">
								<label for="banner">Banner Description</label>
								<textarea type="text" name="content" class="form-control" id="editor1" rows="5" placeholder="Enter Banner Description"></textarea>
							</div>

                            <div class="row"> 
								<div class="form-group col-6">
									<label for="bannerlink">Youtube Video Url</label>
									<input type="url" name="link1" placeholder="https://www.youtube.com/watch?v=..." class="form-control" id="bannerlink">
								</div>

								<div class="form-group col-6">
									<label for="exampleInputPassword1">Position</label>
									<input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
								</div>
							</div>

				            <div class="row">
								<div class="form-group col-6">
									<label for="exampleInputFile">Background Image</label>
									<input type="file" name="bimage" class="form-control" id="exampleInputFile">
									<p class="help-block">Image dimension must be 900 X 600 px & must be jpg format</p>
								</div>
				   
								<div class="form-group col-6">
									<label for="exampleInputFile">Video File (Optional if using YouTube)</label>
									<input type="file" name="video" class="form-control" id="exampleInputFile" accept="video/*">
									<p class="help-block">Must be a video file (mp4, avi, mov etc.)</p>
								</div>
                            </div>
				
								<div class="form-group">
									<label style="display:block;">Status</label>
									<input type="radio" value="1" id="optionsRadios3" name="status" checked>
									<label for="optionsRadios3">Active</label>
									<input type="radio" value="0" id="optionsRadios4" name="status" style="margin-left:15px;">
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
            initSample();
          CKEDITOR.replace('editor1', {
              filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
          });
      });
</script>
</body>

</html>