<?php
require('checksession.php');
include '../inc/function.php';

$b = intval($_REQUEST['bid'] ?? 0);
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_brochure` WHERE `id`='$b'");
$brec = mysqli_fetch_array($bdata);

if (!$brec) {
    $_SESSION['error'] = "Brochure record not found.";
    header("location:manage-brochure.php");
    exit();
}

if (isset($_POST['update'])) {
    $alt = mysqli_real_escape_string($conn, trim($_POST['alt'] ?? ''));
    $heading = mysqli_real_escape_string($conn, trim($_POST['heading'] ?? ''));
    $url = mysqli_real_escape_string($conn, trim($_POST['url'] ?? ''));
    $sort = intval($_POST['sort_number'] ?? 0);
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0';
    $oldimg = mysqli_real_escape_string($conn, $_POST['oldimg'] ?? '');
    $oldpdf = mysqli_real_escape_string($conn, $_POST['oldpdf'] ?? '');

    //=============|Image Update|============//
    $ach_images = $oldimg;
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $img_name = $_FILES['image']['name'];
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_img = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        if (in_array($img_ext, $allowed_img)) {
            $clean_img_name = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $img_name);
            if (!empty($oldimg) && file_exists("../uploads/brochure/" . $oldimg)) {
                @unlink("../uploads/brochure/" . $oldimg);
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/brochure/" . $clean_img_name)) {
                $ach_images = $clean_img_name;
            }
        } else {
            $_SESSION['warning'] = "Invalid image file format. Allowed: jpg, jpeg, png, gif, webp, svg.";
        }
    }

    //=============|PDF File Update|============//
    $final_pdf_url = !empty($url) ? $url : $oldpdf;
    $new_pdf_uploaded = false;
    if (isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name'])) {
        $pdf_name = $_FILES['pdf_file']['name'];
        $pdf_ext = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));
        if ($pdf_ext === 'pdf') {
            $clean_pdf_name = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $pdf_name);
            if (!empty($oldpdf) && !preg_match('/^https?:\/\//i', $oldpdf) && file_exists("../uploads/brochure/" . $oldpdf)) {
                @unlink("../uploads/brochure/" . $oldpdf);
            }
            if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], "../uploads/brochure/" . $clean_pdf_name)) {
                $final_pdf_url = $clean_pdf_name;
                $new_pdf_uploaded = true;
            }
        } else {
            $_SESSION['warning'] = "Invalid PDF file format. Only .pdf files are allowed.";
        }
    }

    // Auto-update cover from PDF Page 1 if a new PDF was selected and no new custom image was provided
    if ($new_pdf_uploaded && empty($_FILES['image']['name']) && !empty($_POST['pdf_cover_data'])) {
        $cover_data = $_POST['pdf_cover_data'];
        if (preg_match('/^data:image\/(jpeg|jpg|png);base64,(.+)$/i', $cover_data, $match)) {
            $img_ext = strtolower($match[1]) === 'png' ? 'png' : 'jpg';
            $decoded = base64_decode($match[2]);
            if ($decoded !== false && strlen($decoded) > 100) {
                $clean_cover_name = time() . "_cover." . $img_ext;
                if (!empty($oldimg) && file_exists("../uploads/brochure/" . $oldimg)) {
                    @unlink("../uploads/brochure/" . $oldimg);
                }
                if (file_put_contents("../uploads/brochure/" . $clean_cover_name, $decoded)) {
                    $ach_images = $clean_cover_name;
                }
            }
        }
    }

    $query = mysqli_query($conn, "UPDATE `tbl_brochure` SET `alt`='$alt',`image`='$ach_images',`sort`='$sort',`status`='$status',`pdf_url`='$final_pdf_url',`heading`='$heading' WHERE `id`='$b'");
    if ($query == true) {
        $_SESSION['success'] = "Brochure Updated Successfully";
        header("refresh:2;url=manage-brochure.php");
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
		<!-- begin #header -->
		<?php require("includes/header.php"); ?>
		<!-- begin #sidebar -->
		<?php require("includes/left.php"); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Brochure</a></li>
				<li class="breadcrumb-item active">Edit Brochure</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Brochure</h1>
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
							<h4 class="panel-title">Edit Brochure</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">
								    
								    <div class="form-group">
										<label for="heading"><strong>Brochure Heading / Title <span class="text-danger">*</span></strong></label>
										<input type="text" name="heading" class="form-control" id="heading" placeholder="Enter heading" value="<?= htmlspecialchars($brec['heading']); ?>" required>
									</div>

									<div class="form-group">
										<label for="pdf_file"><strong>Upload Brochure PDF Document</strong></label>
										<?php if(!empty($brec['pdf_url'])): ?>
											<?php 
												$pdfViewUrl = preg_match('/^https?:\/\//i', $brec['pdf_url']) ? $brec['pdf_url'] : '../uploads/brochure/' . $brec['pdf_url'];
											?>
											<div class="mb-2 p-2 bg-light rounded border">
												<i class="fa fa-file-pdf text-danger fa-lg mr-1"></i>
												<strong>Current PDF:</strong> <?= htmlspecialchars(basename($brec['pdf_url'])) ?>
												<a href="<?= htmlspecialchars($pdfViewUrl) ?>" target="_blank" class="btn btn-xs btn-primary ml-2"><i class="fa fa-eye"></i> View/Download Current PDF</a>
											</div>
										<?php else: ?>
											<div class="mb-2 text-warning"><i class="fa fa-exclamation-triangle"></i> No PDF file currently attached. Please upload one below.</div>
										<?php endif; ?>
										<input type="file" name="pdf_file" class="form-control" id="pdf_file" accept=".pdf,application/pdf">
										<input type="hidden" name="oldpdf" value="<?= htmlspecialchars($brec['pdf_url']); ?>">
										<p class="help-block text-muted mb-1"><i class="fa fa-info-circle"></i> Upload a new PDF file to replace the current document (.pdf format only). <strong>The 1st page will be used as the cover page</strong> if no custom image is selected.</p>
										
										<div id="pdf_cover_status" class="mt-1"></div>
										<div id="pdf_cover_preview_wrapper" style="display:none;" class="mt-2 p-2 border rounded bg-light">
											<label class="d-block mb-1 text-success"><strong><i class="fa fa-magic"></i> Auto-Generated Cover (from new PDF Page 1):</strong></label>
											<img id="pdf_cover_preview" src="" class="img-thumbnail" style="max-height: 140px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
										</div>
										<input type="hidden" name="pdf_cover_data" id="pdf_cover_data">
									</div>
								    
									<div class="form-group">
										<label for="image"><strong>Cover / Preview Image</strong></label>
										<?php if (!empty($brec['image'])): ?>
											<div class="mb-2">
												<label class="small text-muted d-block">Current Cover Image:</label>
												<img src="../uploads/brochure/<?= htmlspecialchars($brec['image']); ?>" class="img-thumbnail" style="max-height: 120px;">
											</div>
										<?php endif; ?>
										<input type="file" name="image" class="form-control" id="image" accept="image/*">
										<input type="hidden" name="oldimg" value="<?= htmlspecialchars($brec['image']); ?>">
										<p class="help-block text-muted">Optional custom cover image (PNG, JPG, WebP). Leave blank to keep existing cover or use the PDF's first page.</p>
									</div>
										
	                                <div class="form-group">
										<label for="alt">Image Alt Text (Optional)</label>
										<input type="text" name="alt" class="form-control" id="alt" placeholder="Enter alt text" value="<?= htmlspecialchars($brec['alt']); ?>">
									</div>
									
	                                <div class="form-group">
										<label for="url">Or External PDF URL (Optional)</label>
										<input type="text" name="url" class="form-control" id="url" placeholder="https://example.com/brochure.pdf" value="<?= htmlspecialchars($brec['pdf_url']); ?>">
										<p class="help-block text-muted"><i class="fa fa-info-circle"></i> If uploading a file above, this field will be updated automatically.</p>
									</div>
                    					
									<div class="form-group">
										<label for="sort_number">Sort Number</label>
										<input type="number" name="sort_number" class="form-control" id="sort_number" placeholder="Ex: 1" value="<?= htmlspecialchars($brec['sort']); ?>">
									</div>

									<div class="form-group">
										<label class="d-block">Status</label>
										<div class="radio radio-css radio-inline">
											<input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') { echo 'checked'; } ?>>
											<label for="optionsRadios3">Active</label>
										</div>
										<div class="radio radio-css radio-inline">
											<input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') { echo 'checked'; } ?>>
											<label for="optionsRadios4">Inactive</label>
										</div>
									</div>

								</div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> Click Here To Update</button>
									<a href="manage-brochure.php" class="btn btn-default">Cancel</a>
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

	<!-- PDF.js for automatic front-page cover extraction -->
	<script src="../assets/js/pdf.min.js"></script>
	<script>
		if (typeof pdfjsLib !== 'undefined') {
			pdfjsLib.GlobalWorkerOptions.workerSrc = '../assets/js/pdf.worker.min.js';
		}

		$(document).ready(function() {
			App.init();

			const pdfInput = document.getElementById('pdf_file');
			const coverDataInput = document.getElementById('pdf_cover_data');
			const previewWrapper = document.getElementById('pdf_cover_preview_wrapper');
			const previewImg = document.getElementById('pdf_cover_preview');
			const statusBox = document.getElementById('pdf_cover_status');

			if (pdfInput) {
				pdfInput.addEventListener('change', function(e) {
					const file = e.target.files[0];
					if (!file || file.type !== 'application/pdf') return;

					statusBox.innerHTML = '<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Rendering 1st page of new PDF as cover page...</span>';

					const reader = new FileReader();
					reader.onload = function(ev) {
						const typedarray = new Uint8Array(ev.target.result);
						pdfjsLib.getDocument({data: typedarray}).promise.then(function(pdf) {
							return pdf.getPage(1);
						}).then(function(page) {
							const viewport = page.getViewport({scale: 1.5});
							const canvas = document.createElement('canvas');
							const context = canvas.getContext('2d');
							canvas.height = viewport.height;
							canvas.width = viewport.width;

							return page.render({
								canvasContext: context,
								viewport: viewport
							}).promise.then(function() {
								const dataUrl = canvas.toDataURL('image/jpeg', 0.88);
								coverDataInput.value = dataUrl;
								previewImg.src = dataUrl;
								previewWrapper.style.display = 'block';
								statusBox.innerHTML = '<span class="text-success"><i class="fa fa-check-circle"></i> Page 1 of PDF generated as new cover page!</span>';
							});
						}).catch(function(err) {
							console.warn('PDF cover render error:', err);
							statusBox.innerHTML = '';
						});
					};
					reader.readAsArrayBuffer(file);
				});
			}
		});
	</script>

</body>
</html>