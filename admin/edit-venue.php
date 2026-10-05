<?php
require('checksession.php');
include '../inc/function.php';

$b = $_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_venue` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$map_url = mysqli_real_escape_string($conn, $_POST['map_url']);
	$heading1 = mysqli_real_escape_string($conn, $_POST['heading1']);
	$heading2 = mysqli_real_escape_string($conn, $_POST['heading2']);
	$heading3 = mysqli_real_escape_string($conn, $_POST['heading3']);
	$content1 = mysqli_real_escape_string($conn, $_POST['content1']);
	$content2 = mysqli_real_escape_string($conn, $_POST['content2']);
	$content3 = mysqli_real_escape_string($conn, $_POST['content3']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

	$query = mysqli_query($conn, "UPDATE `tbl_venue` SET `map_url`='$map_url',`heading1`='$heading1',`heading2`='$heading2',`heading3`='$heading3',`content1`='$content1',`content2`='$content2',`content3`='$content3',`status`='$status' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Venue Updated Successfully";
		header("refresh:3;url=manage-venue.php");
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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Venue</a></li>
				<li class="breadcrumb-item active">Edit Venue</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Venue</h1>
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
							<h4 class="panel-title"> Edit Venue</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">

	                               <div class="form-group">
										<label for="banner" class="d-none">Map Url</label>
										<input type="text" name="map_url" class="form-control" id="" placeholder="Enter Map Url" value="<?= $brec['map_url']; ?>">
									</div>

									<div class="form-group">
										<label for="banner">Heading 1</label>
										<input type="text" name="heading1" class="form-control" id=""  placeholder="Enter Heading 1" value="<?= $brec['heading1']; ?>">
									</div>
									
									<div class="form-group">
                                      <label for="bannerlink">Content 1</label>
                                      <textarea  name="content1"  placeholder="Enter content1" class="form-control" id="editor1"><?= $brec['content1']; ?></textarea>
                                    </div> 
                                    
                                    <div class="form-group">
										<label for="banner">Heading 2</label>
										<input type="text" name="heading2" class="form-control" id=""  placeholder="Enter Heading 2" value="<?= $brec['heading2']; ?>">
									</div>
									
									<div class="form-group">
                                      <label for="bannerlink">Content 2</label>
                                      <textarea  name="content2"  placeholder="Enter content2" class="form-control" id="editor2"><?= $brec['content2']; ?></textarea>
                                    </div> 
                                    
                                    <div class="form-group">
										<label for="banner">Heading 3</label>
										<input type="text" name="heading3" class="form-control" id=""  placeholder="Enter Heading 3" value="<?= $brec['heading3']; ?>">
									</div>
									
									<div class="form-group">
                                      <label for="bannerlink">Content 3</label>
                                      <textarea  name="content3"  placeholder="Enter content3" class="form-control" id="editor3"><?= $brec['content3']; ?></textarea>
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
		initSample();
	CKEDITOR.replace('editor1', {
		filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
	});
	CKEDITOR.replace('editor2', {
		filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
	});
	CKEDITOR.replace('editor3', {
		filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
	});
	});
</script>

	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>

</body>

</html>