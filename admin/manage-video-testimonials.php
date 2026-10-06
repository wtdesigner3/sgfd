<?php
$bb = isset($_POST['bb']) && is_array($_POST['bb']) ? array_map('intval', $_POST['bb']) : [];
require('checksession.php');
require('../inc/function.php');

if (isset($_POST['Deactivate']) && !empty($bb)) {
	foreach ($bb as $act) {
		mysqli_query($conn, "update tbl_video_testimonia set status='0' where id='$act'");
	}
	$_SESSION['info'] = "Selected video testimonials deactivated successfully";
}

if (isset($_POST['Activate']) && !empty($bb)) {
	foreach ($bb as $act) {
		mysqli_query($conn, "update tbl_video_testimonia set status='1' where id='$act'");
	}
	$_SESSION['success'] = "Selected video testimonials activated successfully";
}

if (isset($_POST['Delete']) && !empty($bb)) {
	foreach ($bb as $act) {
		mysqli_query($conn, "delete from tbl_video_testimonia where id='$act'");
	}
	$_SESSION['warning'] = "Selected video testimonials deleted successfully";
}

$mqry = "select * from tbl_video_testimonia order by sort asc, id desc";
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>

<body>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php require('includes/header.php'); ?>
		<?php require('includes/left.php'); ?>

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Testimonials</a></li>
				<li class="breadcrumb-item active">Video Testimonials</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Manage Video Testimonials</h1>
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
							<h4 class="panel-title">Manage Video Testimonials</h4>
						</div>
						<!-- end panel-heading -->

						<form name="myform" method="post" action="">
							<!-- begin alert -->
							<div class="alert alert-secondary fade show mb-0">
								<div class="btn-group btn-group-justified">
									<a href="add-video-testimonials.php" class="btn btn-primary active"><i class="fa fa-plus"></i> Add New Video Testimonial</a>
									<input type="Submit" name="Activate" value="Activate" class="btn btn-info btn-flat">
									<input type="Submit" name="Deactivate" value="Deactivate" class="btn btn-warning btn-flat">
									<input type="Submit" name="Delete" class="btn btn-danger btn-flat" value="Delete" onClick="if(confirm('Are You Sure Want To Delete Selected Video Testimonial(s)?')){ return true;} else { return false; }">
								</div>
							</div>
							<!-- end alert -->

							<!-- begin panel-body -->
							<div class="panel-body">
								<div class="table-responsive">
									<table id="data-table-responsive" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th width="1%">S.No.</th>
												<th width="1%">Preview</th>
												<th class="text-nowrap">Title</th>
												<th class="text-nowrap">Subtitle</th>
												<th class="text-nowrap">Tag / Category</th>
												<th class="text-nowrap">Video Code</th>
												<th width="1%" class="text-center">Order</th>
												<th width="1%" class="text-center">Status</th>
												<th width="1%" class="text-center">Edit</th>
												<th width="1%" class="text-center">Delete</th>
												<th width="1%" class="text-center"><input type="checkbox" id="select_all" name="check"></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											$fetch = mysqli_query($conn, $mqry);
											while ($web = mysqli_fetch_array($fetch)) {
												$vcode = htmlspecialchars($web['v_code']);
												$thumbUrl = "https://img.youtube.com/vi/{$vcode}/mqdefault.jpg";
											?>
												<tr class="odd gradeX">
													<td width="1%" class="f-s-600 text-inverse text-center"><?= $count; ?></td>
													<td width="1%" class="text-center">
														<a href="https://www.youtube.com/watch?v=<?= $vcode; ?>" target="_blank" title="Watch on YouTube" style="position:relative; display:inline-block; border-radius:6px; overflow:hidden; border:1px solid #ccc; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
															<img src="<?= $thumbUrl; ?>" style="width:72px; height:42px; object-fit:cover; display:block;" onerror="this.src='../uploads/no.png';">
															<span style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.3); color:#fff; font-size:14px;">
																<i class="fa fa-play-circle text-danger" style="background:#fff; border-radius:50%;"></i>
															</span>
														</a>
													</td>
													<td style="font-weight:700;" class="text-inverse">
														<?= !empty($web['title']) ? htmlspecialchars($web['title']) : '<span class="text-muted font-italic">(Untitled)</span>'; ?>
													</td>
													<td class="text-muted">
														<small style="font-weight:600;"><?= htmlspecialchars($web['subtitle'] ?? ''); ?></small>
													</td>
													<td>
														<?php if(!empty($web['tag'])): ?>
															<span class="badge badge-info" style="font-size:11px; text-transform:uppercase; letter-spacing:0.5px;"><?= htmlspecialchars($web['tag']); ?></span>
														<?php else: ?>
															<span class="text-muted">-</span>
														<?php endif; ?>
													</td>
													<td>
														<code><?= $vcode; ?></code>
													</td>
													<td width="1%" class="text-center font-weight-bold">
														<span class="badge badge-default" style="font-size:11px;"><?= $web['sort']; ?></span>
													</td>
													<td class="text-center">
														<div class="switcher">
															<input type="checkbox" onClick="updateId('<?php echo $web['id']; ?>')" name="switcher_checkbox_1" id="switcher_checkbox_<?php echo $count; ?>" <?php if ($web['status'] == '1') { echo "checked"; } ?> value="1">
															<label for="switcher_checkbox_<?php echo $count; ?>"></label>
														</div>
													</td>
													<td class="text-center">
														<a href="edit-video-testimonials.php?bid=<?php echo $web['id']; ?>" class='label label-sm label-primary' title="Edit"><i class="fa fa-edit"></i> Edit</a>
													</td>
													<td class="text-center">
														<a href="delete/video-testimonials.php?bid=<?php echo $web['id']; ?>" onClick="if(confirm('Are You Sure Want To Delete This Video Testimonial?')){ return true;} else { return false; }" class='label label-sm label-danger' title="Delete"><i class="fa fa-trash"></i> Delete</a>
													</td>
													<td width="1%" class="text-center">
														<input type="checkbox" class="checkbox" value="<?php echo $web['id']; ?>" name="bb[]">
													</td>
												</tr>
											<?php $count++;
											} ?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- end panel-body -->
						</form>
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
	<?php require('includes/footer.php'); ?>

	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});

		function updateId(id) {
			$.ajax({
				url: "status/video-testimonials.php",
				type: "GET",
				data: { id: id },
				success: function(response) {
					// status updated
				},
				error: function(xhr, status, error) {
					console.error("Status update error: " + error);
				}
			});
		}
	</script>
</body>
</html>