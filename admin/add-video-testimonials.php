<?php
require('checksession.php');
require('../inc/function.php');

if (!function_exists('getYoutubeCode')) {
	function getYoutubeCode($input) {
		$input = trim($input);
		if (empty($input)) return "";
		if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) return $input;
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input, $match)) {
			return $match[1];
		}
		return $input;
	}
}

if (isset($_POST['submit'])) {
	$title = mysqli_real_escape_string($conn, trim($_POST['title'] ?? ''));
	$subtitle = mysqli_real_escape_string($conn, trim($_POST['subtitle'] ?? ''));
	$rawCode = trim($_POST['v_code'] ?? '');
	$v_code = mysqli_real_escape_string($conn, getYoutubeCode($rawCode));
	$tag = mysqli_real_escape_string($conn, trim($_POST['tag'] ?? ''));
	$position = mysqli_real_escape_string($conn, $_POST['position'] ?? '1');
	$status = mysqli_real_escape_string($conn, $_POST['status'] ?? '1');

	$query = mysqli_query($conn, "INSERT INTO `tbl_video_testimonia`(`title`, `subtitle`, `v_code`, `tag`, `sort`, `status`) VALUES ('$title', '$subtitle', '$v_code', '$tag', '$position', '$status')");
	if ($query == true) {
		$_SESSION['success'] = "Video Testimonial inserted successfully";
		header("location:manage-video-testimonials.php");
		exit();
	} else {
		$_SESSION['error'] = "Something went wrong. Please try again";
	}
}

// Calculate next sort order
$maxSortRes = mysqli_query($conn, "SELECT MAX(sort) as msort FROM tbl_video_testimonia");
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
				<li class="breadcrumb-item"><a href="manage-video-testimonials.php">Testimonials</a></li>
				<li class="breadcrumb-item active">Add Video Testimonial</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Add Video Testimonial</h1>
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
							<h4 class="panel-title">Add Video Testimonial</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST">
								<div class="box-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="vcode"><strong>YouTube Video ID or Full URL <span class="text-danger">*</span></strong></label>
												<input type="text" name="v_code" id="vcode" class="form-control" placeholder="e.g. 2iUlxsIaEXA or https://www.youtube.com/watch?v=2iUlxsIaEXA" required>
												<small class="form-text text-muted">You can paste either the 11-character video ID or the complete YouTube URL; it will automatically extract the valid video code.</small>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="title"><strong>Video Title / Person Name <span class="text-danger">*</span></strong></label>
												<input type="text" name="title" id="title" class="form-control" placeholder="e.g. Rajesh Sharma" required>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="subtitle"><strong>Subtitle / Company / Designation</strong></label>
												<input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="e.g. Managing Director, Apex Pack">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="tag"><strong>Tag / Category Badge</strong></label>
												<input type="text" name="tag" id="tag" class="form-control" placeholder="e.g. Exhibitor Experience, Buyer Review, Visitor">
												<small class="form-text text-muted">Appears as a small colored badge on the video card.</small>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="position"><strong>Display Position (Order)</strong></label>
												<input type="number" name="position" id="position" class="form-control" value="<?= $nextSort; ?>">
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
									<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Video Testimonial</button>
									<a href="manage-video-testimonials.php" class="btn btn-default ml-2">Cancel</a>
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