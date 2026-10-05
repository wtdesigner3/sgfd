<?php
require('checksession.php'); 
include '../inc/function.php'; 

if(isset($_POST['submit']))
{ 
    $alt = mysqli_real_escape_string($conn, trim($_POST['alt'] ?? ''));
    $heading = mysqli_real_escape_string($conn, trim($_POST['heading'] ?? ''));
    $url = mysqli_real_escape_string($conn, trim($_POST['url'] ?? ''));
    $numbers = intval($_POST['sort_number'] ?? 0);
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0';

    //=============|PDF File Upload|============//
    $final_pdf_url = $url;
    if(isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['name']))
    {
        $pdf_name = $_FILES['pdf_file']['name'];
        $pdf_ext = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));
        if($pdf_ext === 'pdf')
        {
            $clean_pdf_name = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $pdf_name);
            if(move_uploaded_file($_FILES["pdf_file"]["tmp_name"], "../uploads/brochure/" . $clean_pdf_name))
            {
                $final_pdf_url = $clean_pdf_name;
            }
        }
        else
        {
            $_SESSION['warning'] = "Invalid PDF file format. Only .pdf files are allowed.";
        }
    }

    //=============|Cover Image Upload|============//
    $bimage = "";
    if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
    {
        $bimages = $_FILES['image']['name'];
        $img_ext = strtolower(pathinfo($bimages, PATHINFO_EXTENSION));
        $allowed_img = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        if(in_array($img_ext, $allowed_img))
        {
            $clean_img_name = time() . "_" . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $bimages);
            if(move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/brochure/" . $clean_img_name))
            {
                $bimage = $clean_img_name;
            }
        }
        else
        {
            $_SESSION['warning'] = "Invalid image file format. Allowed: jpg, jpeg, png, gif, webp, svg.";
        }
    }

    // Auto-generate cover page from PDF first page if no cover image was explicitly uploaded
    if(empty($bimage) && !empty($_POST['pdf_cover_data']))
    {
        $cover_data = $_POST['pdf_cover_data'];
        if(preg_match('/^data:image\/(jpeg|jpg|png);base64,(.+)$/i', $cover_data, $match))
        {
            $img_ext = strtolower($match[1]) === 'png' ? 'png' : 'jpg';
            $decoded = base64_decode($match[2]);
            if($decoded !== false && strlen($decoded) > 100)
            {
                $clean_cover_name = time() . "_cover." . $img_ext;
                if(file_put_contents("../uploads/brochure/" . $clean_cover_name, $decoded))
                {
                    $bimage = $clean_cover_name;
                }
            }
        }
    }

    $query = mysqli_query($conn, "INSERT INTO `tbl_brochure`(`image`, `alt`, `sort`, `status`, `pdf_url`, `heading`) VALUES ('$bimage','$alt','$numbers','$status','$final_pdf_url','$heading')");
    if($query == true)
    {
        $_SESSION['success'] = "Brochure inserted successfully";
        header("refresh:2;url=manage-brochure.php");
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
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
	<!-- begin #page-container -->
	<?php require("includes/header.php"); ?>
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
	<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Brochure</a></li>
				<li class="breadcrumb-item active">Add Brochure</li>
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
							<h4 class="panel-title">Add Brochure</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="heading"><strong>Brochure Heading / Title <span class="text-danger">*</span></strong></label>
                  <input type="text" name="heading" class="form-control" id="heading" placeholder="Enter brochure heading (e.g. 5th Edition Food & Bakery Expo Brochure)" required>
                </div>

                <div class="form-group">
                  <label for="pdf_file"><strong>Upload Brochure PDF Document <span class="text-danger">*</span></strong></label>
                  <input type="file" name="pdf_file" class="form-control" id="pdf_file" accept=".pdf,application/pdf">
                  <p class="help-block text-muted mb-1"><i class="fa fa-info-circle"></i> Upload the PDF file (.pdf format only). <strong>The 1st page will be used automatically as the cover page</strong> if you don't upload a separate image.</p>
                  
                  <div id="pdf_cover_status" class="mt-1"></div>
                  <div id="pdf_cover_preview_wrapper" style="display:none;" class="mt-2 p-2 border rounded bg-light">
                    <label class="d-block mb-1 text-success"><strong><i class="fa fa-magic"></i> Auto-Generated Cover (Page 1 of PDF):</strong></label>
                    <img id="pdf_cover_preview" src="" class="img-thumbnail" style="max-height: 140px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <p class="small text-muted mb-0 mt-1">This cover will be saved automatically. You can still upload a custom image below if you prefer.</p>
                  </div>
                  <input type="hidden" name="pdf_cover_data" id="pdf_cover_data">
                </div>

                <div class="form-group">
                  <label for="image"><strong>Custom Cover / Preview Image (Optional)</strong></label>
                  <input type="file" name="image" class="form-control" id="image" accept="image/*">
                  <p class="help-block text-muted"><i class="fa fa-info-circle"></i> Optional. If left empty, the first page of the PDF above will be used as the cover page.</p>
                </div>

                <div class="form-group">
                  <label for="alt">Image Alt Text (Optional)</label>
                  <input type="text" name="alt" class="form-control" id="alt" placeholder="Enter alt text for image">
                </div>
                
                <div class="form-group">
                  <label for="url">Or External PDF URL (Optional)</label>
                  <input type="text" name="url" class="form-control" id="url" placeholder="https://example.com/brochure.pdf (optional, if not uploading a PDF file above)">
                </div>
                
                <div class="form-group">
                  <label for="sort_number">Sort Number</label>
                  <input type="number" name="sort_number" class="form-control" id="sort_number" placeholder="Enter Sort Number (e.g. 1)" value="1">
                </div>

                <div class="form-group">
                  <label class="d-block">Status</label>
                  <div class="radio radio-css radio-inline">
                    <input type="radio" value="1" id="optionsRadios3" name="status" checked>
                    <label for="optionsRadios3">Active</label>
                  </div>
                  <div class="radio radio-css radio-inline">
                    <input type="radio" value="0" id="optionsRadios4" name="status">
                    <label for="optionsRadios4">Inactive</label>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Click Here To Submit</button>
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

				statusBox.innerHTML = '<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Rendering 1st page of PDF as cover page...</span>';

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
							statusBox.innerHTML = '<span class="text-success"><i class="fa fa-check-circle"></i> Page 1 of PDF generated as cover page!</span>';
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