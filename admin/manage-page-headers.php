<?php
require('checksession.php');
require('../inc/function.php');
require('../inc/page-header-db.php');

// Ensure database table and initial seed exist
ensure_page_headers_table($conn);

$bb = isset($_POST['bb']) && is_array($_POST['bb']) ? array_map('intval', $_POST['bb']) : [];

// Bulk Deactivate
if (isset($_POST['Deactivate']) && !empty($bb)) {
    foreach ($bb as $act) {
        $act = (int)$act;
        mysqli_query($conn, "UPDATE tbl_page_headers SET status = '0' WHERE id = '$act'");
    }
    $_SESSION['success'] = "Selected page headers deactivated successfully.";
}

// Bulk Activate
if (isset($_POST['Activate']) && !empty($bb)) {
    foreach ($bb as $act) {
        $act = (int)$act;
        mysqli_query($conn, "UPDATE tbl_page_headers SET status = '1' WHERE id = '$act'");
    }
    $_SESSION['success'] = "Selected page headers activated successfully.";
}

// Bulk Delete
if (isset($_POST['Delete']) && !empty($bb)) {
    foreach ($bb as $act) {
        $act = (int)$act;
        mysqli_query($conn, "DELETE FROM tbl_page_headers WHERE id = '$act'");
    }
    $_SESSION['success'] = "Selected page headers deleted successfully.";
}

// Query all page headers
$mqry = "SELECT * FROM tbl_page_headers ORDER BY sort_order ASC, id ASC";
$fetch = mysqli_query($conn, $mqry);
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php require('includes/header.php'); ?>
		<!-- begin #sidebar -->
		<?php require('includes/left.php'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Pages Management</a></li>
				<li class="breadcrumb-item active">Page Headers</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">
				<a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> 
				Manage Page Headers
				<small style="font-size: 13px; font-weight: normal; margin-left: 8px; color: #666;">
					Customize titles, background images, subtitles, and CTA buttons for inner pages
				</small>
			</h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title"><i class="fa fa-header text-primary"></i> Page Headers Management</h4>
						</div>

						<form name="myform" method="post" action="">
							<div class="panel-body">
								<div class="alert alert-secondary fade show d-flex justify-content-between align-items-center mb-3">
									<div class="btn-group">
										<a href="add-page-header.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Page Header</a>
										<button type="submit" name="Activate" class="btn btn-info"><i class="fa fa-check"></i> Activate</button>
										<button type="submit" name="Deactivate" class="btn btn-warning"><i class="fa fa-ban"></i> Deactivate</button>
										<button type="submit" name="Delete" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete selected page header(s)?');"><i class="fa fa-trash"></i> Delete</button>
									</div>
									<span class="text-muted font-italic"><i class="fa fa-info-circle"></i> Real-time header updates appear immediately across visitor-facing pages.</span>
								</div>

								<div class="table-responsive">
									<table id="data-table-responsive" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th width="1%">#</th>
												<th width="8%" data-orderable="false">Background</th>
												<th width="14%">Page Name / Slug</th>
												<th width="12%">Eyebrow Tag</th>
												<th>Header Headline & Lead</th>
												<th width="12%">Buttons (Primary / Secondary)</th>
												<th width="5%" class="text-center">Status</th>
												<th width="7%" class="text-center" data-orderable="false">Actions</th>
												<th width="1%" data-orderable="false" class="text-center"><input type="checkbox" id="select_all" name="check"></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$count = 1;
											while ($row = mysqli_fetch_array($fetch)) {
												$bgPath = resolve_header_bg_image_path_for_admin($row['bg_image']);
												$pageUrl = '../' . $row['page_slug'] . '.php';
											?>
												<tr class="odd gradeX">
													<td class="f-s-600 text-inverse text-center"><?= $count; ?></td>
													<td class="text-center">
														<div style="width: 100px; height: 60px; overflow: hidden; border-radius: 4px; border: 1px solid #ddd; background: #222; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
															<img src="<?= htmlspecialchars($bgPath) ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="<?= htmlspecialchars($row['page_name']) ?>">
														</div>
													</td>
													<td>
														<strong style="color: #111; font-size: 14px;"><?= htmlspecialchars($row['page_name']); ?></strong><br>
														<span class="badge badge-light text-muted" style="border: 1px solid #ddd; font-family: monospace;">
															<?= htmlspecialchars($row['page_slug']); ?>
														</span>
														<div class="mt-1">
															<a href="<?= htmlspecialchars($pageUrl) ?>" target="_blank" class="text-primary" style="font-size: 11px;" title="View in new tab">
																<i class="fa fa-external-link-alt"></i> View live page
															</a>
														</div>
													</td>
													<td>
														<span class="badge badge-warning" style="font-size: 11px; padding: 5px 8px; font-weight: 600;">
															<?= htmlspecialchars($row['eyebrow'] ?: '—'); ?>
														</span>
														<div class="text-muted small mt-1">
															<i class="fa fa-folder-open"></i> <?= htmlspecialchars($row['breadcrumb'] ?: $row['page_name']); ?>
														</div>
														<div class="mt-1">
															<?php
															$divNames = [
																'simple'   => '<span class="badge badge-light border text-secondary" style="font-size:10px;"><i class="fa fa-minus"></i> Simple Border</span>',
																'seamless' => '<span class="badge badge-info" style="font-size:10px;"><i class="fa fa-water"></i> Seamless Dissolve</span>'
															];
															$divStyle = $row['divider_style'] ?? 'simple';
															echo $divNames[$divStyle] ?? $divNames['simple'];
															?>
														</div>
													</td>
													<td>
														<div style="font-weight: 600; color: #222; font-size: 13px; line-height: 1.4;">
															<?= $row['title']; ?>
														</div>
														<p class="text-muted small mb-0 mt-1" style="line-height: 1.3; max-width: 480px;">
															<?= htmlspecialchars(mb_strimwidth($row['lead_text'] ?? '', 0, 110, '...')); ?>
														</p>
													</td>
													<td>
														<?php
														$primOn = ((int)($row['show_primary_btn'] ?? 1) === 1);
														$secOn  = ((int)($row['show_secondary_btn'] ?? 1) === 1);
														?>
														<div class="mb-1">
															<?php if ($primOn): ?>
																<span class="badge badge-danger" style="font-size: 10px;" title="Primary Button is Active (ON)">
																	<i class="fa <?= htmlspecialchars($row['primary_btn_icon'] ?: 'fa-arrow-right') ?>"></i> 
																	<?= htmlspecialchars($row['primary_btn_text'] ?: 'Button 1'); ?>
																</span>
															<?php else: ?>
																<span class="badge badge-light border text-muted" style="font-size: 10px;" title="Primary Button is Inactive (OFF)">
																	<i class="fa fa-eye-slash text-danger"></i> Primary: OFF
																</span>
															<?php endif; ?>
														</div>
														<div>
															<?php if ($secOn): ?>
																<span class="badge badge-secondary" style="font-size: 10px;" title="Secondary Button is Active (ON)">
																	<i class="fa <?= htmlspecialchars($row['secondary_btn_icon'] ?: 'fa-download') ?>"></i> 
																	<?= htmlspecialchars($row['secondary_btn_text'] ?: 'Button 2'); ?>
																</span>
															<?php else: ?>
																<span class="badge badge-light border text-muted" style="font-size: 10px;" title="Secondary Button is Inactive (OFF)">
																	<i class="fa fa-eye-slash text-danger"></i> Secondary: OFF
																</span>
															<?php endif; ?>
														</div>
													</td>
													<td class="text-center">
														<?php if ($row['status'] == '1') { ?>
															<span class="badge badge-success" style="padding: 4px 8px; font-size: 11px;">Active</span>
														<?php } else { ?>
															<span class="badge badge-danger" style="padding: 4px 8px; font-size: 11px;">Inactive</span>
														<?php } ?>
													</td>
													<td class="text-center">
														<a href="edit-page-header.php?id=<?= $row['id']; ?>" class="btn btn-xs btn-primary" title="Edit Content & Images">
															<i class="fa fa-edit"></i> Edit
														</a>
													</td>
													<td class="text-center">
														<input type="checkbox" class="checkbox" value="<?= $row['id']; ?>" name="bb[]">
													</td>
												</tr>
											<?php 
												$count++; 
											} 
											?>
										</tbody>
									</table>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>
	<!-- end page container -->
	<?php require('includes/footer.php'); ?>
	<script>
		$(document).ready(function() {
			App.init();
			if (typeof TableManageResponsive !== 'undefined') {
				TableManageResponsive.init();
			}
		});
	</script>
</body>
</html>
