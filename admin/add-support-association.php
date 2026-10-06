<?php
require('checksession.php');
include '../inc/function.php';

if (isset($_POST['submit'])) {
	$alt = mysqli_real_escape_string($conn, trim($_POST['alt'] ?? ''));
	$status = mysqli_real_escape_string($conn, $_POST['status'] ?? '1');

	$imageName = $_FILES['image']['name'] ?? '';
	if (!empty($imageName)) {
		$uploadDir = "../uploads/support-association/";
		if (!is_dir($uploadDir)) {
			@mkdir($uploadDir, 0777, true);
		}
		$cleanName = preg_replace("/[^a-zA-Z0-9._-]/", "", $imageName);
		$newImage = time() . "_" . $cleanName;
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $newImage)) {
			$query = mysqli_query($conn, "INSERT INTO `tbl_support_association` (`image`, `alt`, `status`) VALUES ('$newImage', '$alt', '$status')");
			if ($query) {
				$_SESSION['success'] = "Supporting Association added successfully";
				header("location:manage-support-association.php");
				exit();
			} else {
				$_SESSION['error'] = "Database error. Please try again";
			}
		} else {
			$_SESSION['error'] = "Failed to upload image. Please check folder permissions.";
		}
	} else {
		$_SESSION['error'] = "Please select an association logo image to upload.";
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
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php require("includes/header.php"); ?>
		<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="manage-support-association.php">Supporting Association</a></li>
				<li class="breadcrumb-item active">Add Supporting Association</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="manage-support-association.php" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Add Supporting Association</h1>
			<!-- end page-header -->
			
			<?php if (!empty($_SESSION['error'])): ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
				</div>
			<?php endif; ?>

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
							<h4 class="panel-title">Add Supporting Association Logo</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="assocImage"><strong>Association Logo Image <span class="text-danger">*</span></strong></label>
												<input type="file" name="image" id="assocImage" class="form-control" accept="image/*" required onchange="previewImage(this)">
												<small class="form-text text-muted">Recommended transparent PNG or JPG format (e.g. 250x150 px or 200x200 px).</small>
												<div id="imagePreviewContainer" class="mt-2" style="display:none;">
													<div class="p-2 border rounded" style="background:#f8f9fa; display:inline-block; max-width:220px;">
														<img id="imagePreview" src="#" alt="Preview" style="max-height:100px; max-width:100%; object-fit:contain;">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="altTag"><strong>Image Alt / Association Name <span class="text-danger">*</span></strong></label>
												<input type="text" name="alt" id="altTag" class="form-control" placeholder="e.g. Food Industries Welfare Association (FIWA)" required>
												<small class="form-text text-muted">Descriptive alt text for accessibility and SEO.</small>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
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
									<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Supporting Association</button>
									<a href="manage-support-association.php" class="btn btn-default ml-2">Cancel</a>
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

	function previewImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#imagePreview').attr('src', e.target.result);
				$('#imagePreviewContainer').show();
			}
			reader.readAsDataURL(input.files[0]);
		} else {
			$('#imagePreviewContainer').hide();
		}
	}
</script>
</body>
</html>
