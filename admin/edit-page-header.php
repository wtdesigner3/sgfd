<?php
require('checksession.php');
require('../inc/function.php');
require('../inc/page-header-db.php');

ensure_page_headers_table($conn);

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$query = mysqli_query($conn, "SELECT * FROM `tbl_page_headers` WHERE `id` = '$id'");
$rec = mysqli_fetch_array($query);

if (!$rec) {
    $_SESSION['error'] = "Page header record not found.";
    header("Location: manage-page-headers.php");
    exit();
}

if (isset($_POST['update'])) {
    $page_name         = mysqli_real_escape_string($conn, trim($_POST['page_name']));
    $page_slug         = mysqli_real_escape_string($conn, trim($_POST['page_slug']));
    $breadcrumb        = mysqli_real_escape_string($conn, trim($_POST['breadcrumb']));
    $eyebrow           = mysqli_real_escape_string($conn, trim($_POST['eyebrow']));
    $title             = mysqli_real_escape_string($conn, trim($_POST['title']));
    $lead_text         = mysqli_real_escape_string($conn, trim($_POST['lead_text']));
    $show_primary_btn  = isset($_POST['show_primary_btn']) && $_POST['show_primary_btn'] == '1' ? 1 : 0;
    $primary_btn_text  = mysqli_real_escape_string($conn, trim($_POST['primary_btn_text']));
    $primary_btn_modal = mysqli_real_escape_string($conn, trim($_POST['primary_btn_modal']));
    $primary_btn_icon  = mysqli_real_escape_string($conn, trim($_POST['primary_btn_icon']));
    $show_secondary_btn = isset($_POST['show_secondary_btn']) && $_POST['show_secondary_btn'] == '1' ? 1 : 0;
    $secondary_btn_text  = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_text']));
    $secondary_btn_modal = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_modal']));
    $secondary_btn_icon  = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_icon']));
    $sort_order        = (int)$_POST['sort_order'];
    $status            = isset($_POST['status']) && $_POST['status'] == '1' ? 1 : 0;
    $divider_style     = mysqli_real_escape_string($conn, trim($_POST['divider_style'] ?: 'simple'));
    $old_img           = mysqli_real_escape_string($conn, $_POST['old_bg_image']);

    $bg_image_name = $old_img;

    // Handle Image Upload if provided
    if (!empty($_FILES['bg_image']['name'])) {
        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'JPG', 'JPEG', 'PNG', 'WEBP'];
        $fileExt = pathinfo($_FILES['bg_image']['name'], PATHINFO_EXTENSION);
        
        if (in_array($fileExt, $allowedExts)) {
            $cleanFileName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $_FILES['bg_image']['name']);
            $newFileName = time() . '_' . $cleanFileName;
            $uploadTarget = "../uploads/headers/" . $newFileName;

            if (!is_dir("../uploads/headers/")) {
                @mkdir("../uploads/headers/", 0777, true);
            }

            if (move_uploaded_file($_FILES['bg_image']['tmp_name'], $uploadTarget)) {
                $bg_image_name = $newFileName;
                // Clean up previous image if it was in uploads/headers/
                if (!empty($old_img) && file_exists("../uploads/headers/" . $old_img)) {
                    @unlink("../uploads/headers/" . $old_img);
                }
            } else {
                $_SESSION['error'] = "Could not upload image file. Please check folder permissions.";
            }
        } else {
            $_SESSION['error'] = "Invalid image file type. Please upload JPG, PNG, or WEBP.";
        }
    }

    $updateSql = "UPDATE `tbl_page_headers` SET
        `page_name` = '$page_name',
        `page_slug` = '$page_slug',
        `breadcrumb` = '$breadcrumb',
        `eyebrow` = '$eyebrow',
        `title` = '$title',
        `lead_text` = '$lead_text',
        `show_primary_btn` = '$show_primary_btn',
        `primary_btn_text` = '$primary_btn_text',
        `primary_btn_modal` = '$primary_btn_modal',
        `primary_btn_icon` = '$primary_btn_icon',
        `show_secondary_btn` = '$show_secondary_btn',
        `secondary_btn_text` = '$secondary_btn_text',
        `secondary_btn_modal` = '$secondary_btn_modal',
        `secondary_btn_icon` = '$secondary_btn_icon',
        `bg_image` = '$bg_image_name',
        `divider_style` = '$divider_style',
        `sort_order` = '$sort_order',
        `status` = '$status'
        WHERE `id` = '$id'";

    $result = mysqli_query($conn, $updateSql);

    if ($result) {
        $_SESSION['success'] = "Page Header for '" . htmlspecialchars($page_name) . "' updated successfully!";
        header("Location: manage-page-headers.php");
        exit();
    } else {
        $_SESSION['error'] = "Database error: " . mysqli_error($conn);
    }
}

// Current preview path
$currentBgPath = resolve_header_bg_image_path_for_admin($rec['bg_image']);
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<style>
.header-preview-card {
    background: #111;
    border-radius: 8px;
    padding: 24px;
    color: #fff;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
.header-preview-card .preview-bg {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.28;
    filter: blur(1px);
}
.header-preview-card .preview-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(90deg, rgba(12,12,12,0.92) 0%, rgba(12,12,12,0.7) 100%);
}
.header-preview-card .preview-content {
    position: relative;
    z-index: 2;
}
.sg-title-accent {
    background: linear-gradient(90deg, #ff4d00, #ff9900);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
}
</style>
<body>
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<?php require("includes/header.php"); ?>
		<?php require("includes/left.php"); ?>
		
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="manage-page-headers.php">Manage Page Headers</a></li>
				<li class="breadcrumb-item active">Edit Page Header</li>
			</ol>
			<!-- end breadcrumb -->

			<!-- begin page-header -->
			<h1 class="page-header">
				<a href="manage-page-headers.php" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> 
				Edit Page Header: <?= htmlspecialchars($rec['page_name']); ?>
			</h1>
			<!-- end page-header -->

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title"><i class="fa fa-edit"></i> Edit Content & Background for <?= htmlspecialchars($rec['page_name']); ?></h4>
						</div>

						<div class="panel-body">
							<!-- Live Header Card Preview -->
							<div class="header-preview-card">
								<div class="preview-bg" id="previewBg" style="background-image: url('<?= htmlspecialchars($currentBgPath); ?>');"></div>
								<div class="preview-overlay"></div>
								<div class="preview-content">
									<div class="d-flex align-items-center mb-2" style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;">
										<span class="badge badge-warning mr-2" id="previewEyebrow"><?= htmlspecialchars($rec['eyebrow']); ?></span>
										<span class="text-white-50"><i class="fa fa-home"></i> Home / <span id="previewBreadcrumb"><?= htmlspecialchars($rec['breadcrumb']); ?></span></span>
									</div>
									<h3 id="previewTitle" class="text-white font-weight-bold mb-2" style="font-size: 22px;">
										<?= $rec['title']; ?>
									</h3>
									<p id="previewLead" class="text-white-50 mb-3" style="max-width: 750px; font-size: 13px; line-height: 1.5;">
										<?= htmlspecialchars($rec['lead_text']); ?>
									</p>
									<div class="d-flex align-items-center">
										<button type="button" class="btn btn-danger btn-sm mr-2 font-weight-bold" id="previewBtn1" style="<?= ((int)($rec['show_primary_btn'] ?? 1) === 1) ? '' : 'display: none !important;' ?>">
											<span id="previewBtn1Text"><?= htmlspecialchars($rec['primary_btn_text']); ?></span> 
											<i class="fa <?= htmlspecialchars($rec['primary_btn_icon']); ?> ml-1" id="previewBtn1Icon"></i>
										</button>
										<button type="button" class="btn btn-outline-light btn-sm font-weight-bold" id="previewBtn2" style="<?= ((int)($rec['show_secondary_btn'] ?? 1) === 1) ? '' : 'display: none !important;' ?>">
											<span id="previewBtn2Text"><?= htmlspecialchars($rec['secondary_btn_text']); ?></span> 
											<i class="fa <?= htmlspecialchars($rec['secondary_btn_icon']); ?> ml-1" id="previewBtn2Icon"></i>
										</button>
									</div>
								</div>
							</div>

							<form role="form" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="old_bg_image" value="<?= htmlspecialchars($rec['bg_image']); ?>">

								<!-- Page Info Row -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-file-alt text-primary mr-1"></i> Page Identifier
									</div>
									<div class="card-body">
										<div class="row">
											<div class="form-group col-md-6">
												<label class="font-weight-bold">Page Display Name <span class="text-danger">*</span></label>
												<input type="text" name="page_name" class="form-control" value="<?= htmlspecialchars($rec['page_name']); ?>" required>
												<small class="form-text text-muted">Admin title (e.g. Introduction, Exhibit, Contact Us)</small>
											</div>

											<div class="form-group col-md-3">
												<label class="font-weight-bold">Page Slug <span class="text-danger">*</span></label>
												<input type="text" name="page_slug" class="form-control" value="<?= htmlspecialchars($rec['page_slug']); ?>" required>
												<small class="form-text text-muted">Matches file name (e.g. <code>introduction</code> for <code>introduction.php</code>)</small>
											</div>

											<div class="form-group col-md-3">
												<label class="font-weight-bold">Breadcrumb Label <span class="text-danger">*</span></label>
												<input type="text" name="breadcrumb" id="inputBreadcrumb" class="form-control" value="<?= htmlspecialchars($rec['breadcrumb']); ?>" required>
												<small class="form-text text-muted">Active crumb in navigation (e.g. Introduction)</small>
											</div>
										</div>
									</div>
								</div>

								<!-- Headline & Content Card -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-heading text-primary mr-1"></i> Header Headlines & Copy
									</div>
									<div class="card-body">
										<div class="form-group">
											<label class="font-weight-bold">Eyebrow / Sub-tag <span class="text-danger">*</span></label>
											<input type="text" name="eyebrow" id="inputEyebrow" class="form-control" value="<?= htmlspecialchars($rec['eyebrow']); ?>" placeholder="e.g. Official Expo Overview">
											<small class="form-text text-muted">Small pill badge above the headline</small>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Main Headline (Title) <span class="text-danger">*</span></label>
											<textarea name="title" id="inputTitle" class="form-control" rows="2" required><?= htmlspecialchars($rec['title']); ?></textarea>
											<small class="form-text text-muted">
												<i class="fa fa-lightbulb text-warning"></i> <strong>Styling Tip:</strong> Wrap words in <code>&lt;span class="sg-title-accent"&gt;Your Words&lt;/span&gt;</code> to render the vibrant orange-red gradient highlight!
											</small>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Lead Paragraph / Description</label>
											<textarea name="lead_text" id="inputLead" class="form-control" rows="3"><?= htmlspecialchars($rec['lead_text']); ?></textarea>
											<small class="form-text text-muted">Sub-paragraph describing the expo page</small>
										</div>
									</div>
								</div>

								<!-- Action Buttons Card -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark d-flex justify-content-between align-items-center">
										<span><i class="fa fa-mouse-pointer text-primary mr-1"></i> Call-To-Action Buttons &amp; On/Off Toggles</span>
										<small class="text-muted">Turn buttons ON or OFF individually for this page</small>
									</div>
									<div class="card-body">
										<div class="row">
											<!-- Primary Button -->
											<div class="col-md-6 border-right">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<h5 class="text-danger font-weight-bold mb-0" style="font-size: 15px;"><i class="fa fa-circle"></i> Primary Button (Red Solid)</h5>
												</div>

												<!-- Primary Button ON/OFF Toggle -->
												<div class="mb-3 p-2 rounded" style="background: rgba(202,25,30,0.06); border: 1px solid rgba(202,25,30,0.18);">
													<label class="font-weight-bold d-block mb-1 text-dark" style="font-size: 12.5px;">Button Visibility:</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_primary_1" name="show_primary_btn" value="1" class="custom-control-input btn-toggle-primary" <?= ((int)($rec['show_primary_btn'] ?? 1) === 1) ? 'checked' : ''; ?>>
														<label class="custom-control-label text-success font-weight-bold" for="show_primary_1" style="cursor: pointer;">
															<i class="fa fa-check-circle"></i> Active / Show (ON)
														</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_primary_0" name="show_primary_btn" value="0" class="custom-control-input btn-toggle-primary" <?= ((int)($rec['show_primary_btn'] ?? 1) === 0) ? 'checked' : ''; ?>>
														<label class="custom-control-label text-secondary font-weight-bold" for="show_primary_0" style="cursor: pointer;">
															<i class="fa fa-eye-slash"></i> Inactive / Hide (OFF)
														</label>
													</div>
												</div>
												
												<div class="form-group">
													<label class="font-weight-bold">Button Text</label>
													<input type="text" name="primary_btn_text" id="inputBtn1Text" class="form-control" value="<?= htmlspecialchars($rec['primary_btn_text']); ?>">
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Target Modal or URL</label>
													<input type="text" name="primary_btn_modal" class="form-control" value="<?= htmlspecialchars($rec['primary_btn_modal']); ?>">
													<small class="form-text text-muted">Use <code>#contactModal</code> for Stall Enquiry popup or <code>#myModal</code> for Visitor Pass popup.</small>
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Icon Class</label>
													<input type="text" name="primary_btn_icon" id="inputBtn1Icon" class="form-control" value="<?= htmlspecialchars($rec['primary_btn_icon']); ?>">
													<small class="form-text text-muted">FontAwesome icon class (e.g. <code>fa-arrow-right</code>, <code>fa-calendar-check</code>)</small>
												</div>
											</div>

											<!-- Secondary Button -->
											<div class="col-md-6">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<h5 class="text-secondary font-weight-bold mb-0" style="font-size: 15px;"><i class="fa fa-circle"></i> Secondary Button (Glass Outline)</h5>
												</div>

												<!-- Secondary Button ON/OFF Toggle -->
												<div class="mb-3 p-2 rounded" style="background: rgba(100,100,100,0.06); border: 1px solid rgba(100,100,100,0.18);">
													<label class="font-weight-bold d-block mb-1 text-dark" style="font-size: 12.5px;">Button Visibility:</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_secondary_1" name="show_secondary_btn" value="1" class="custom-control-input btn-toggle-secondary" <?= ((int)($rec['show_secondary_btn'] ?? 1) === 1) ? 'checked' : ''; ?>>
														<label class="custom-control-label text-success font-weight-bold" for="show_secondary_1" style="cursor: pointer;">
															<i class="fa fa-check-circle"></i> Active / Show (ON)
														</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_secondary_0" name="show_secondary_btn" value="0" class="custom-control-input btn-toggle-secondary" <?= ((int)($rec['show_secondary_btn'] ?? 1) === 0) ? 'checked' : ''; ?>>
														<label class="custom-control-label text-secondary font-weight-bold" for="show_secondary_0" style="cursor: pointer;">
															<i class="fa fa-eye-slash"></i> Inactive / Hide (OFF)
														</label>
													</div>
												</div>
												
												<div class="form-group">
													<label class="font-weight-bold">Button Text</label>
													<input type="text" name="secondary_btn_text" id="inputBtn2Text" class="form-control" value="<?= htmlspecialchars($rec['secondary_btn_text']); ?>">
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Target Modal or URL</label>
													<input type="text" name="secondary_btn_modal" class="form-control" value="<?= htmlspecialchars($rec['secondary_btn_modal']); ?>">
													<small class="form-text text-muted">Use <code>#myModal</code> for Visitor Pass popup or <code>#contactModal</code> for Stall popup.</small>
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Icon Class</label>
													<input type="text" name="secondary_btn_icon" id="inputBtn2Icon" class="form-control" value="<?= htmlspecialchars($rec['secondary_btn_icon']); ?>">
													<small class="form-text text-muted">FontAwesome icon class (e.g. <code>fa-download</code>, <code>fa-arrow-down</code>)</small>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Background Image Card -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-image text-primary mr-1"></i> Background Header Image
									</div>
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col-md-7">
												<div class="form-group">
													<label class="font-weight-bold">Upload New Background Image</label>
													<input type="file" name="bg_image" id="inputBgImage" class="form-control-file p-2" style="border: 1px dashed #ccc; border-radius: 4px; width: 100%;">
													<small class="form-text text-muted mt-2">
														<i class="fa fa-info-circle text-info"></i> Recommended dimensions: <strong>1920 &times; 480 px</strong> or higher. Supported formats: JPG, JPEG, PNG, WEBP.
													</small>
												</div>
												<div class="form-group mt-3">
													<label class="font-weight-bold">Current Saved File:</label>
													<input type="text" class="form-control" value="<?= htmlspecialchars($rec['bg_image']); ?>" readonly>
												</div>
											</div>

											<div class="col-md-5 text-center">
												<label class="font-weight-bold d-block text-muted">Current Background Preview</label>
												<div style="max-height: 160px; overflow: hidden; border-radius: 6px; border: 1px solid #ddd; background: #111;">
													<img id="imagePreview" src="<?= htmlspecialchars($currentBgPath); ?>" alt="Header Background" style="width: 100%; height: 160px; object-fit: cover;">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Bottom Division / Section Transition Style -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark d-flex justify-content-between align-items-center">
										<span><i class="fa fa-sliders-h text-primary mr-1"></i> Bottom Division &amp; Section Transition Style</span>
										<small class="text-muted">Choose how the header divides from the content below</small>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6 mb-2">
												<div class="border rounded p-3 h-100" style="background: #fafafa;">
													<div class="custom-control custom-radio">
														<input type="radio" id="div_simple" name="divider_style" value="simple" class="custom-control-input" <?= (($rec['divider_style'] ?? 'simple') === 'simple' || ($rec['divider_style'] ?? '') === 'gradient' || ($rec['divider_style'] ?? '') === 'slant' || ($rec['divider_style'] ?? '') === 'curve') ? 'checked' : ''; ?>>
														<label class="custom-control-label font-weight-bold" for="div_simple">Simple Division Border (Default)</label>
													</div>
													<small class="text-muted d-block mt-2">Crisp, non-colorful 1px minimalist divider border. Clean, professional separation without harshness.</small>
												</div>
											</div>
											<div class="col-md-6 mb-2">
												<div class="border rounded p-3 h-100" style="background: #fafafa;">
													<div class="custom-control custom-radio">
														<input type="radio" id="div_seamless" name="divider_style" value="seamless" class="custom-control-input" <?= ($rec['divider_style'] ?? '') === 'seamless' ? 'checked' : ''; ?>>
														<label class="custom-control-label font-weight-bold" for="div_seamless">Seamless Dissolve</label>
													</div>
													<small class="text-muted d-block mt-2">Pure soft ivory feather fade into the content below with zero borders or lines. Modern, airy &amp; minimal.</small>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Display Settings Row -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-cog text-primary mr-1"></i> Visibility & Ordering
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<label class="font-weight-bold">Status</label><br>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="status1" name="status" value="1" class="custom-control-input" <?= ($rec['status'] == '1') ? 'checked' : ''; ?>>
													<label class="custom-control-label" for="status1"><span class="badge badge-success">Active</span></label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="status0" name="status" value="0" class="custom-control-input" <?= ($rec['status'] == '0') ? 'checked' : ''; ?>>
													<label class="custom-control-label" for="status0"><span class="badge badge-danger">Inactive</span></label>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="font-weight-bold">Display Sort Order</label>
													<input type="number" name="sort_order" class="form-control" value="<?= (int)$rec['sort_order']; ?>">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Action Buttons -->
								<div class="form-group text-right">
									<a href="manage-page-headers.php" class="btn btn-secondary mr-2"><i class="fa fa-times"></i> Cancel</a>
									<button type="submit" name="update" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save &amp; Update Header</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	</div>

	<?php require("includes/footer.php"); ?>
	<script>
		$(document).ready(function() {
			App.init();

			// Real-time live card preview synchronization
			$('#inputEyebrow').on('input', function() {
				$('#previewEyebrow').text($(this).val() || '—');
			});
			$('#inputBreadcrumb').on('input', function() {
				$('#previewBreadcrumb').text($(this).val() || 'Page');
			});
			$('#inputTitle').on('input', function() {
				$('#previewTitle').html($(this).val() || 'Page Title');
			});
			$('#inputLead').on('input', function() {
				$('#previewLead').text($(this).val() || '');
			});
			$('#inputBtn1Text').on('input', function() {
				$('#previewBtn1Text').text($(this).val() || 'Button 1');
			});
			$('#inputBtn2Text').on('input', function() {
				$('#previewBtn2Text').text($(this).val() || 'Button 2');
			});
			$('#inputBtn1Icon').on('input', function() {
				$('#previewBtn1Icon').attr('class', 'fa ' + $(this).val() + ' ml-1');
			});
			$('#inputBtn2Icon').on('input', function() {
				$('#previewBtn2Icon').attr('class', 'fa ' + $(this).val() + ' ml-1');
			});

			// Real-time Button Visibility On/Off Toggles
			$('input[name="show_primary_btn"]').on('change', function() {
				if ($(this).val() === '1') {
					$('#previewBtn1').css('display', 'inline-flex');
				} else {
					$('#previewBtn1').css('display', 'none');
				}
			});

			$('input[name="show_secondary_btn"]').on('change', function() {
				if ($(this).val() === '1') {
					$('#previewBtn2').css('display', 'inline-flex');
				} else {
					$('#previewBtn2').css('display', 'none');
				}
			});

			// Image file preview
			$('#inputBgImage').on('change', function(e) {
				var file = e.target.files[0];
				if (file) {
					var reader = new FileReader();
					reader.onload = function(evt) {
						$('#imagePreview').attr('src', evt.target.result);
						$('#previewBg').css('background-image', 'url(' + evt.target.result + ')');
					};
					reader.readAsDataURL(file);
				}
			});
		});
	</script>
</body>
</html>
