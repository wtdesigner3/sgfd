<?php
require('checksession.php');
include '../inc/function.php'; 

$b = intval($_REQUEST['cid'] ?? 0);
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_testimonial` where `tt_id`='$b'");
$brec = mysqli_fetch_array($bdata);

if(!$brec) {
	$_SESSION['error'] = "Testimonial not found";
	header("location:manage-testimonial.php");
	exit();
}

if(isset($_POST['update']))
{
	$name = mysqli_real_escape_string($conn, trim($_POST['name'] ?? '')); 
	$location = mysqli_real_escape_string($conn, trim($_POST['location'] ?? '')); 
	$description = mysqli_real_escape_string($conn, trim($_POST['description'] ?? '')); 
	$status = mysqli_real_escape_string($conn, $_POST['status'] ?? '1'); 
	$sort = mysqli_real_escape_string($conn, $_POST['sort'] ?? '1'); 
	$old = mysqli_real_escape_string($conn, $_POST['oldimg'] ?? '');  
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
		if(!empty($old) && file_exists($uploadDir . $old)) {
			@unlink($uploadDir . $old); 
		}
		move_uploaded_file($_FILES["bimage"]["tmp_name"], $uploadDir . $bimage);
	}
	else
	{
		$bimage = $brec['tt_image'];
	}
  
	$query = mysqli_query($conn, "UPDATE `tbl_testimonial` SET `tt_image`='$bimage', `tt_alt`='$alt', `tt_name`='$name', `tt_location`='$location', `tt_sort`='$sort', `tt_detail`='$description', `tt_status`='$status' WHERE `tt_id`='$b'");
	if($query == true)
	{
		$_SESSION['success'] = "Testimonial updated successfully";
		header("location:manage-testimonial.php");	
		exit();
	}
	else 
	{
		$_SESSION['error'] = "Something went wrong. Please try again";
	}
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
				<li class="breadcrumb-item active">Edit Testimonial</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Edit Testimonial</h1>
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
							<h4 class="panel-title">Edit Written Testimonial</h4>
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
												<input type="text" name="name" class="form-control" id="heading" value="<?= htmlspecialchars($brec['tt_name']); ?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="bannerlink"><strong>Title / Designation / Company <span class="text-danger">*</span></strong></label>
												<input type="text" name="location" value="<?= htmlspecialchars($brec['tt_location']); ?>" class="form-control" id="bannerlink" required>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label><strong>Testimonial Review Text <span class="text-danger">*</span></strong></label>
										<textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($brec['tt_detail']); ?></textarea>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="exampleInputFile"><strong>Author Photo (Optional)</strong></label>
												<input type="file" name="bimage" class="form-control" id="exampleInputFile" accept="image/*">
												<input type="hidden" name="oldimg" value="<?= htmlspecialchars($brec['tt_image']); ?>">
												<small class="form-text text-muted">Recommended square dimension: 100x100 or 200x200 px (JPG / PNG / WEBP).</small>
												<?php if(!empty($brec['tt_image']) && file_exists("../uploads/testimonial/".$brec['tt_image'])): ?>
													<div class="mt-2">
														<span class="text-muted d-block mb-1" style="font-size:12px;">Current Image:</span>
														<img src="../uploads/testimonial/<?= $brec['tt_image']; ?>" style="width:60px; height:60px; object-fit:cover; border-radius:50%; border:2px solid #ddd;">
													</div>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="altTag"><strong>Image Alt Tag (Optional)</strong></label>
												<input type="text" name="alt" id="altTag" value="<?= htmlspecialchars($brec['tt_alt']); ?>" class="form-control">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="sortOrder"><strong>Display Position (Order)</strong></label>
												<input type="number" name="sort" value="<?= htmlspecialchars($brec['tt_sort']); ?>" class="form-control" id="sortOrder">
												<small class="form-text text-muted">Lower numbers appear first on the website slider.</small>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label><strong>Status</strong></label>
												<div class="pt-2">
													<label class="radio-inline mr-3">
														<input type="radio" value="1" name="status" <?php if($brec['tt_status']=='1'){ echo 'checked';}?>> <span class="text-success font-weight-bold">Active</span>
													</label>
													<label class="radio-inline">
														<input type="radio" value="0" name="status" <?php if($brec['tt_status']=='0'){ echo 'checked';}?>> <span class="text-muted font-weight-bold">Inactive</span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.box-body -->

								<div class="box-footer pt-3 border-top">
									<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> Update Testimonial</button>
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
