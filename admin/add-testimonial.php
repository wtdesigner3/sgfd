<?php
require('checksession.php');
include '../inc/function.php'; 

if(isset($_POST['submit']))
{  
	$name = mysqli_real_escape_string($conn, trim($_POST['name'] ?? ''));	
	$location = mysqli_real_escape_string($conn, trim($_POST['location'] ?? ''));	
	$description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? ''));	
	$status = mysqli_real_escape_string($conn, $_POST['status'] ?? '1');
	$sort = mysqli_real_escape_string($conn, $_POST['sort'] ?? '1');	
	$alt = mysqli_real_escape_string($conn, trim($_POST['alt'] ?? ''));	
	
	$bimages = $_FILES['bimage']['name'] ?? '';
	if(!empty($bimages))
	{
		$uploadDir = "../uploads/testimonial/";
		if(!is_dir($uploadDir)) {
			@mkdir($uploadDir, 0777, true);
		}
		$cleanName = preg_replace("/[^a-zA-Z0-9._-]/", "", $bimages);
		$bimage = time() . "_" . $cleanName;
		move_uploaded_file($_FILES["bimage"]["tmp_name"], $uploadDir . $bimage);
	}
	else
	{
		$bimage = "";	
	}

	$query = mysqli_query($conn, "INSERT INTO `tbl_testimonial` (`tt_name`, `tt_location`, `tt_detail`, `tt_sort`, `tt_status`, `tt_image`, `tt_alt`) VALUES ('$name', '$location', '$description', '$sort', '$status', '$bimage', '$alt')");
	if($query == true)
	{
		$_SESSION['success'] = "Testimonial inserted successfully";
		header("location:manage-testimonial.php");
		exit();
	}
	else 
	{
		$_SESSION['error'] = "Something went wrong. Please try again";
	} 
}

// Calculate next sort order suggestion
$maxSortRes = mysqli_query($conn, "SELECT MAX(tt_sort) as msort FROM tbl_testimonial");
$nextSort = 1;
if($maxSortRes && $mRow = mysqli_fetch_assoc($maxSortRes)) {
	$nextSort = intval($mRow['msort']) + 1;
}
?>   

<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<body>
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php require("includes/header.php"); ?>
		<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="manage-testimonial.php">Testimonials</a></li>
				<li class="breadcrumb-item active">Add Testimonial</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Add Testimonial</h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
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
							<h4 class="panel-title">Add Written Testimonial</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="heading"><strong>Author / Client Name <span class="text-danger">*</span></strong></label>
												<input type="text" name="name" class="form-control" id="heading" placeholder="e.g. Rajesh Malhotra" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="bannerlink"><strong>Title / Designation / Company <span class="text-danger">*</span></strong></label>
												<input type="text" name="location" placeholder="e.g. Bakers Equipment World, Delhi" class="form-control" id="bannerlink" required>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label><strong>Testimonial Review Text <span class="text-danger">*</span></strong></label>
										<textarea name="description" placeholder="Enter detailed client review / testimonial..." class="form-control" rows="5" required></textarea>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="exampleInputFile"><strong>Author Photo (Optional)</strong></label>
												<input type="file" name="bimage" class="form-control" id="exampleInputFile" accept="image/*">
												<small class="form-text text-muted">Recommended square dimension: 100x100 or 200x200 px (JPG / PNG / WEBP). If omitted, an elegant initials monogram will be generated automatically.</small>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="altTag"><strong>Image Alt Tag (Optional)</strong></label>
												<input type="text" name="alt" id="altTag" class="form-control" placeholder="e.g. Rajesh Malhotra Review">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="sortOrder"><strong>Display Position (Order)</strong></label>
												<input type="number" name="sort" placeholder="1-10" value="<?= $nextSort; ?>" class="form-control" id="sortOrder">
												<small class="form-text text-muted">Lower numbers appear first on the website slider.</small>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label><strong>Status</strong></label>
												<div class="pt-2">
													<label class="radio-inline mr-3">
														<input type="radio" value="1" name="status" checked> <span class="text-success font-weight-bold">Active</span>
													</label>
													<label class="radio-inline">
														<input type="radio" value="0" name="status"> <span class="text-muted font-weight-bold">Inactive</span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.box-body -->

								<div class="box-footer pt-3 border-top">
									<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Testimonial</button>
									<a href="manage-testimonial.php" class="btn btn-default ml-2">Cancel</a>
								</div>
							</form>
						</div>
						<!-- end panel-body -->
					</div>
					<!-- end panel -->
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
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
