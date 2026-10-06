<?php
require('checksession.php');
include '../inc/function.php';

$bb = $_POST['bb'] ?? [];

if (isset($_POST['Deactivate']) && !empty($bb)) {
	foreach ($bb as $act) {
		$act = intval($act);
		mysqli_query($conn, "UPDATE tbl_support_association SET status='0' WHERE id='$act'");
	}
	$_SESSION['success'] = "Selected association(s) deactivated successfully";
}

if (isset($_POST['Activate']) && !empty($bb)) {
	foreach ($bb as $act) {
		$act = intval($act);
		mysqli_query($conn, "UPDATE tbl_support_association SET status='1' WHERE id='$act'");
	}
	$_SESSION['success'] = "Selected association(s) activated successfully";
}

if (isset($_POST['Delete']) && !empty($bb)) {
	foreach ($bb as $act) {
		$act = intval($act);
		$res = mysqli_query($conn, "SELECT image FROM tbl_support_association WHERE id='$act'");
		if ($row = mysqli_fetch_assoc($res)) {
			if (!empty($row['image']) && file_exists("../uploads/support-association/" . $row['image'])) {
				@unlink("../uploads/support-association/" . $row['image']);
			}
		}
		mysqli_query($conn, "DELETE FROM tbl_support_association WHERE id='$act'");
	}
	$_SESSION['warning'] = "Selected association(s) deleted successfully";
}

$mqry = "SELECT * FROM tbl_support_association ORDER BY id ASC";
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php require('includes/header.php'); ?>
		<!-- begin #sidebar -->
		<?php require('includes/left.php'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Home Management</a></li>
				<li class="breadcrumb-item active">Manage Supporting Association</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="index.php" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Manage Supporting Association</h1>
			<!-- end page-header -->

			<?php if (!empty($_SESSION['success'])): ?>
				<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="fa fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($_SESSION['warning'])): ?>
				<div class="alert alert-warning alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($_SESSION['warning']); unset($_SESSION['warning']); ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($_SESSION['error'])): ?>
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<i class="fa fa-times-circle"></i> <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
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
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Supporting Association List</h4>
						</div>
						<!-- end panel-heading -->
						<form name="myform" method="post" action="">
							<!-- begin toolbar -->
							<div class="p-3 bg-light border-bottom d-flex align-items-center justify-content-between flex-wrap">
								<div class="btn-group my-1">
									<a href="add-support-association.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Association</a>
								</div>
								<div class="btn-group my-1">
									<input type="submit" name="Activate" value="Activate" class="btn btn-info btn-sm">
									<input type="submit" name="Deactivate" value="Deactivate" class="btn btn-warning btn-sm">
									<input type="submit" name="Delete" class="btn btn-danger btn-sm" value="Delete" onClick="if(confirm('Are you sure you want to delete selected records?')){ return true;} else { return false; }">
								</div>
							</div>
							<!-- end toolbar -->
							<!-- begin panel-body -->
							<div class="panel-body">
								<div class="table-responsive">
									<table id="data-table-responsive" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th width="1%" class="text-center">No</th>
												<th width="10%" class="text-center">Logo Image</th>
												<th class="text-nowrap">Association Name / Alt Text</th>
												<th width="8%" class="text-center">Status</th>
												<th width="6%" class="text-center">Edit</th>
												<th width="6%" class="text-center">Delete</th>
												<th width="1%" class="text-center">
													<input type="checkbox" id="select_all">
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											$fetch = mysqli_query($conn, $mqry);
											while ($web = mysqli_fetch_array($fetch)) {
												$imgFile = $web['image'];
												$imgPath = "../uploads/support-association/" . $imgFile;
												$hasRealImg = (!empty($imgFile) && file_exists($imgPath));
											?>
												<tr class="odd gradeX">
													<td class="f-s-600 text-inverse text-center"><?= $count; ?></td>
													<td class="with-img text-center">
														<div class="p-1 border rounded bg-white d-inline-block" style="box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
															<?php if ($hasRealImg): ?>
																<img src="<?= $imgPath; ?>" style="max-height: 50px; max-width: 120px; object-fit: contain;" alt="<?= htmlspecialchars($web['alt']); ?>" />
															<?php else: ?>
																<img src="../uploads/no.png" style="max-height: 50px; max-width: 120px; object-fit: contain;" alt="No image" />
															<?php endif; ?>
														</div>
													</td>
													<td style="font-weight:600; color:#333; vertical-align:middle;">
														<?= htmlspecialchars($web['alt']); ?>
													</td>
													<td class="text-center" style="vertical-align:middle;">
														<div class="switcher">
															<input type="checkbox" onClick="updateId('<?= $web['id']; ?>')" name="switcher_checkbox_<?= $count; ?>" id="switcher_checkbox_<?= $count; ?>" <?= ($web['status'] == '1') ? 'checked' : ''; ?> value="1">
															<label for="switcher_checkbox_<?= $count; ?>"></label>
														</div>
													</td>
													<td class="text-center" style="vertical-align:middle;">
														<a href="edit-support-association.php?bid=<?= $web['id']; ?>" class="label label-sm label-primary" title="Edit"><i class="fa fa-edit"></i> Edit</a>
													</td>
													<td class="text-center" style="vertical-align:middle;">
														<a href="delete/support-association.php?bid=<?= $web['id']; ?>" onClick="if(confirm('Are you sure you want to delete this association?')){ return true;} else { return false; }" class="label label-sm label-danger" title="Delete"><i class="fa fa-trash"></i> Delete</a>
													</td>
													<td class="text-center" style="vertical-align:middle;">
														<input type="checkbox" class="checkbox" value="<?= $web['id']; ?>" name="bb[]">
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
				<!-- end col-12 -->
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
				url: "status/support-association.php",
				type: "GET",
				data: { id: id },
				success: function(response) {
					// status updated silently
				},
				error: function(err) {
					console.error("Status update error: ", err);
				}
			});
		}

		// Select all checkbox handler
		$(document).ready(function() {
			$('#select_all').on('click', function() {
				if (this.checked) {
					$('.checkbox').each(function() {
						this.checked = true;
					});
				} else {
					$('.checkbox').each(function() {
						this.checked = false;
					});
				}
			});

			$('.checkbox').on('click', function() {
				if ($('.checkbox:checked').length == $('.checkbox').length) {
					$('#select_all').prop('checked', true);
				} else {
					$('#select_all').prop('checked', false);
				}
			});
		});
	</script>
</body>
</html>