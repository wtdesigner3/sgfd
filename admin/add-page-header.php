<?php
require('checksession.php');
require('../inc/function.php');
require('../inc/page-header-db.php');

ensure_page_headers_table($conn);

if (isset($_POST['submit'])) {
    $page_name         = mysqli_real_escape_string($conn, trim($_POST['page_name']));
    $page_slug         = mysqli_real_escape_string($conn, trim($_POST['page_slug']));
    $breadcrumb        = mysqli_real_escape_string($conn, trim($_POST['breadcrumb']));
    $eyebrow           = mysqli_real_escape_string($conn, trim($_POST['eyebrow']));
    $title             = mysqli_real_escape_string($conn, trim($_POST['title']));
    $lead_text         = mysqli_real_escape_string($conn, trim($_POST['lead_text']));
    $show_primary_btn  = isset($_POST['show_primary_btn']) && $_POST['show_primary_btn'] == '1' ? 1 : 0;
    $primary_btn_text  = mysqli_real_escape_string($conn, trim($_POST['primary_btn_text'] ?: 'Book a Stall'));
    $primary_btn_modal = mysqli_real_escape_string($conn, trim($_POST['primary_btn_modal'] ?: '#contactModal'));
    $primary_btn_icon  = mysqli_real_escape_string($conn, trim($_POST['primary_btn_icon'] ?: 'fa-arrow-right'));
    $show_secondary_btn = isset($_POST['show_secondary_btn']) && $_POST['show_secondary_btn'] == '1' ? 1 : 0;
    $secondary_btn_text  = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_text'] ?: 'Get Visitor Pass'));
    $secondary_btn_modal = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_modal'] ?: '#myModal'));
    $secondary_btn_icon  = mysqli_real_escape_string($conn, trim($_POST['secondary_btn_icon'] ?: 'fa-download'));
    $sort_order        = (int)$_POST['sort_order'];
    $status            = isset($_POST['status']) && $_POST['status'] == '1' ? 1 : 0;

    $bg_image_name = '1739943873_introd-bg.jpg';

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
            } else {
                $_SESSION['error'] = "Could not upload image file. Please check folder permissions.";
            }
        } else {
            $_SESSION['error'] = "Invalid image file type. Please upload JPG, PNG, or WEBP.";
        }
    }

    // Check if slug already exists
    $checkQ = mysqli_query($conn, "SELECT id FROM tbl_page_headers WHERE page_slug = '$page_slug'");
    if (mysqli_num_rows($checkQ) > 0) {
        $_SESSION['error'] = "A page header with slug '{$page_slug}' already exists. Please edit that one or choose another slug.";
    } else {
        $insertSql = "INSERT INTO `tbl_page_headers` 
            (`page_name`, `page_slug`, `breadcrumb`, `eyebrow`, `title`, `lead_text`, `show_primary_btn`, `primary_btn_text`, `primary_btn_modal`, `primary_btn_icon`, `show_secondary_btn`, `secondary_btn_text`, `secondary_btn_modal`, `secondary_btn_icon`, `bg_image`, `sort_order`, `status`)
            VALUES
            ('$page_name', '$page_slug', '$breadcrumb', '$eyebrow', '$title', '$lead_text', '$show_primary_btn', '$primary_btn_text', '$primary_btn_modal', '$primary_btn_icon', '$show_secondary_btn', '$secondary_btn_text', '$secondary_btn_modal', '$secondary_btn_icon', '$bg_image_name', '$sort_order', '$status')";

        $result = mysqli_query($conn, $insertSql);

        if ($result) {
            $_SESSION['success'] = "New Page Header created successfully!";
            header("Location: manage-page-headers.php");
            exit();
        } else {
            $_SESSION['error'] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<body>
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<?php require("includes/header.php"); ?>
		<?php require("includes/left.php"); ?>
		
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="manage-page-headers.php">Manage Page Headers</a></li>
				<li class="breadcrumb-item active">Add Page Header</li>
			</ol>
			<!-- end breadcrumb -->

			<!-- begin page-header -->
			<h1 class="page-header">
				<a href="manage-page-headers.php" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> 
				Add New Page Header
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
							<h4 class="panel-title"><i class="fa fa-plus"></i> Create New Page Header</h4>
						</div>

						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<!-- Page Info Row -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-file-alt text-primary mr-1"></i> Page Identifier
									</div>
									<div class="card-body">
										<div class="row">
											<div class="form-group col-md-6">
												<label class="font-weight-bold">Page Display Name <span class="text-danger">*</span></label>
												<input type="text" name="page_name" class="form-control" placeholder="e.g. Schedule, Venue, Floor Plan" required>
												<small class="form-text text-muted">Admin title for this page header</small>
											</div>

											<div class="form-group col-md-3">
												<label class="font-weight-bold">Page Slug <span class="text-danger">*</span></label>
												<input type="text" name="page_slug" class="form-control" placeholder="e.g. schedule" required>
												<small class="form-text text-muted">Matches php filename without .php</small>
											</div>

											<div class="form-group col-md-3">
												<label class="font-weight-bold">Breadcrumb Label <span class="text-danger">*</span></label>
												<input type="text" name="breadcrumb" class="form-control" placeholder="e.g. Schedule" required>
												<small class="form-text text-muted">Active crumb label</small>
											</div>
										</div>
									</div>
								</div>

								<!-- Headline & Content Card -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-heading text-primary mr-1"></i> Header Headline &amp; Copy
									</div>
									<div class="card-body">
										<div class="form-group">
											<label class="font-weight-bold">Eyebrow / Sub-tag <span class="text-danger">*</span></label>
											<input type="text" name="eyebrow" class="form-control" placeholder="e.g. Official Expo Overview" required>
											<small class="form-text text-muted">Small pill badge above the headline</small>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Main Headline (Title) <span class="text-danger">*</span></label>
											<textarea name="title" class="form-control" rows="2" placeholder='e.g. Discover The Next Wave of <span class="sg-title-accent">Culinary Innovation</span>' required></textarea>
											<small class="form-text text-muted">
												<i class="fa fa-lightbulb text-warning"></i> <strong>Tip:</strong> Wrap text with <code>&lt;span class="sg-title-accent"&gt;...&lt;/span&gt;</code> for the orange-red gradient accent.
											</small>
										</div>

										<div class="form-group">
											<label class="font-weight-bold">Lead Paragraph / Description</label>
											<textarea name="lead_text" class="form-control" rows="3" placeholder="Detailed sub-headline or description for the page header..."></textarea>
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
											<div class="col-md-6 border-right">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<h5 class="text-danger font-weight-bold mb-0" style="font-size: 15px;"><i class="fa fa-circle"></i> Primary Button</h5>
												</div>

												<!-- Button Visibility On/Off -->
												<div class="mb-3 p-2 rounded" style="background: rgba(202,25,30,0.06); border: 1px solid rgba(202,25,30,0.18);">
													<label class="font-weight-bold d-block mb-1 text-dark" style="font-size: 12.5px;">Button Visibility:</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_primary_1" name="show_primary_btn" value="1" class="custom-control-input" checked>
														<label class="custom-control-label text-success font-weight-bold" for="show_primary_1" style="cursor: pointer;">
															<i class="fa fa-check-circle"></i> Active / Show (ON)
														</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_primary_0" name="show_primary_btn" value="0" class="custom-control-input">
														<label class="custom-control-label text-secondary font-weight-bold" for="show_primary_0" style="cursor: pointer;">
															<i class="fa fa-eye-slash"></i> Inactive / Hide (OFF)
														</label>
													</div>
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Button Text</label>
													<input type="text" name="primary_btn_text" class="form-control" value="Book a Stall">
												</div>
												<div class="form-group">
													<label class="font-weight-bold">Target Modal or URL</label>
													<input type="text" name="primary_btn_modal" class="form-control" value="#contactModal">
												</div>
												<div class="form-group">
													<label class="font-weight-bold">Icon Class</label>
													<input type="text" name="primary_btn_icon" class="form-control" value="fa-arrow-right">
												</div>
											</div>

											<div class="col-md-6">
												<div class="d-flex justify-content-between align-items-center mb-2">
													<h5 class="text-secondary font-weight-bold mb-0" style="font-size: 15px;"><i class="fa fa-circle"></i> Secondary Button</h5>
												</div>

												<!-- Button Visibility On/Off -->
												<div class="mb-3 p-2 rounded" style="background: rgba(100,100,100,0.06); border: 1px solid rgba(100,100,100,0.18);">
													<label class="font-weight-bold d-block mb-1 text-dark" style="font-size: 12.5px;">Button Visibility:</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_secondary_1" name="show_secondary_btn" value="1" class="custom-control-input" checked>
														<label class="custom-control-label text-success font-weight-bold" for="show_secondary_1" style="cursor: pointer;">
															<i class="fa fa-check-circle"></i> Active / Show (ON)
														</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="show_secondary_0" name="show_secondary_btn" value="0" class="custom-control-input">
														<label class="custom-control-label text-secondary font-weight-bold" for="show_secondary_0" style="cursor: pointer;">
															<i class="fa fa-eye-slash"></i> Inactive / Hide (OFF)
														</label>
													</div>
												</div>

												<div class="form-group">
													<label class="font-weight-bold">Button Text</label>
													<input type="text" name="secondary_btn_text" class="form-control" value="Get Visitor Pass">
												</div>
												<div class="form-group">
													<label class="font-weight-bold">Target Modal or URL</label>
													<input type="text" name="secondary_btn_modal" class="form-control" value="#myModal">
												</div>
												<div class="form-group">
													<label class="font-weight-bold">Icon Class</label>
													<input type="text" name="secondary_btn_icon" class="form-control" value="fa-download">
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Background Image Card -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-image text-primary mr-1"></i> Background Image
									</div>
									<div class="card-body">
										<div class="form-group">
											<label class="font-weight-bold">Upload Background Image</label>
											<input type="file" name="bg_image" class="form-control-file p-2" style="border: 1px dashed #ccc; border-radius: 4px; width: 100%;">
											<small class="form-text text-muted mt-2">Recommended: 1920 &times; 480 px or higher; JPG, PNG, WEBP.</small>
										</div>
									</div>
								</div>

								<!-- Visibility & Ordering -->
								<div class="card mb-4 border-light">
									<div class="card-header bg-light font-weight-bold text-dark">
										<i class="fa fa-cog text-primary mr-1"></i> Visibility &amp; Ordering
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<label class="font-weight-bold">Status</label><br>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="status1" name="status" value="1" class="custom-control-input" checked>
													<label class="custom-control-label" for="status1"><span class="badge badge-success">Active</span></label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="status0" name="status" value="0" class="custom-control-input">
													<label class="custom-control-label" for="status0"><span class="badge badge-danger">Inactive</span></label>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="font-weight-bold">Display Sort Order</label>
													<input type="number" name="sort_order" class="form-control" value="10">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group text-right">
									<a href="manage-page-headers.php" class="btn btn-secondary mr-2"><i class="fa fa-times"></i> Cancel</a>
									<button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"></i> Create Page Header</button>
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
		});
	</script>
</body>
</html>
