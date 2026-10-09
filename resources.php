<?php
require('inc/function.php');

        $breadCrumb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_breadcrumb` where brd_id = '1'"));
        
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
     <title><?= $breadCrumb['brd_name']; ?> | <?= SITE_NAME ?></title>
    <meta name="description" content="<?= $breadCrumb['metakeyword']; ?>">
    <meta name="keywords" content="<?= $breadCrumb['metadesc']; ?>">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>

<body>

    <!-- modal-end -->
    <div class="boxed_wrapper">

        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->
          <!-- main header -->

        <?php include('inc/header.php'); ?>
        <!-- main-header end -->

        <!-- Page Title -->
        <?php include('inc/page-header.php'); ?>
        <!-- End Page Title -->



        <section class="about-style-two sec-pad  position-relative patt-bg" id="why">


            <div class="auto-container">

                <div class="inner-box">
                
                    <div class="row clearfix">
                        <div class="col-lg-12">
                           <div class="row" id="image-gallery">
                               
                           </div>
                            <!-- ---------------load more------------ -->
                            <div class="row justify-content-center">
                                <div class="col-md-4 text-center">
                                                                <button class="load-more" id="load-more12" >Load More</button>
                                </div>
                            </div>
                            <!-- ---------------load more------------ -->
                          
                        </div>
                    </div>
                </div>

            </div>
        </section>

<?php
                        $brochure = mysqli_query($conn, "SELECT pdf_url,image,heading FROM tbl_brochure where status = '1' ORDER BY sort");
                        if(mysqli_num_rows($brochure) > 0){

?>
        <section class="about-style-two sec-pad  position-relative patt-bg pt-0" id="brochure">
            <div class="auto-container">

                <div class="s-style mb-4 mb-lg-5">
                    <h1 class="text-dark">Brochure</h1>
                </div>

                    <div class="row gx-5">
                        <?php
                            while($bro_row = mysqli_fetch_assoc($brochure)){
                                $downloadUrl = '';
                                $pdfVal = trim($bro_row['pdf_url'] ?? '');
                                if(!empty($pdfVal)){
                                    if(preg_match('/^https?:\/\//i', $pdfVal)){
                                        $downloadUrl = $pdfVal;
                                    } elseif(file_exists(__DIR__ . '/uploads/brochure/' . ltrim($pdfVal, '/'))) {
                                        $downloadUrl = 'uploads/brochure/' . ltrim($pdfVal, '/');
                                    } elseif(file_exists(__DIR__ . '/' . ltrim($pdfVal, '/'))) {
                                        $downloadUrl = ltrim($pdfVal, '/');
                                    } else {
                                        $downloadUrl = 'uploads/brochure/' . ltrim($pdfVal, '/');
                                    }
                                } elseif(!empty($bro_row['image']) && file_exists(__DIR__ . '/uploads/brochure/' . $bro_row['image'])) {
                                    $downloadUrl = 'uploads/brochure/' . $bro_row['image'];
                                }

                                $hasImage = !empty($bro_row['image']) && file_exists(__DIR__ . '/uploads/brochure/' . $bro_row['image']);
                                $imagePath = $hasImage ? 'uploads/brochure/' . $bro_row['image'] : '';
                                $downloadName = !empty($downloadUrl) ? basename($downloadUrl) : 'brochure.pdf';
                        ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="bro-bg position-relative">
                                <?php if(!empty($downloadUrl)): ?>
                                    <a href="<?= htmlspecialchars($downloadUrl) ?>" download="<?= htmlspecialchars($downloadName) ?>" target="_blank" class="bro-download"><i class="fa-solid fa-download"></i> Download</a>
                                <?php else: ?>
                                    <span class="bro-download" style="opacity: 0.7; cursor: default;"><i class="fa-solid fa-file-pdf"></i> Available Soon</span>
                                <?php endif; ?>

                                <?php if(!empty($imagePath)): ?>
                                    <img loading="lazy" src="<?= htmlspecialchars($imagePath) ?>" class="img-fluid" alt="<?= htmlspecialchars($bro_row['heading']) ?>">
                                <?php elseif(!empty($downloadUrl)): ?>
                                    <!-- Automatic PDF Front Page Canvas Fallback -->
                                    <canvas class="pdf-cover-canvas img-fluid" data-pdf="<?= htmlspecialchars($downloadUrl) ?>" style="width: 100%; height: auto; display: block; background: #fff; min-height: 250px;"></canvas>
                                <?php else: ?>
                                    <img loading="lazy" src="uploads/no.png" class="img-fluid" alt="<?= htmlspecialchars($bro_row['heading']) ?>">
                                <?php endif; ?>

                                <div class="bro-text"><?= htmlspecialchars($bro_row['heading']) ?></div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                    </div>
            </div>
        </section>
<?php
} ?>


</div>

<?php require('inc/footer.php'); ?>
<?php require('inc/footer-data.php'); ?>

<!-- PDF.js for automatic front-page cover rendering -->
<script src="assets/js/pdf.min.js"></script>
<script>
    if (typeof pdfjsLib !== 'undefined') {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'assets/js/pdf.worker.min.js';
        document.querySelectorAll('.pdf-cover-canvas').forEach(function(canvas) {
            const pdfUrl = canvas.getAttribute('data-pdf');
            if (!pdfUrl) return;
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                return pdf.getPage(1);
            }).then(function(page) {
                const viewport = page.getViewport({scale: 1.2});
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({
                    canvasContext: context,
                    viewport: viewport
                });
            }).catch(function(err) {
                console.warn('PDF cover render error:', err);
            });
        });
    }

    var start = 0; 

    function loadImages() {
        $.ajax({
            url: 'load_images.php',  
            type: 'POST',
            data: { start: start },
            success: function(response) {
                if (response !== 'No more images to load.') {
                    console.log(response);
                    $('#image-gallery').append(response); 
                    start += 6; 
                } else {
                    $('#load-more12').hide();
                }
            }
        });
    }


    $(document).ready(function() {
        loadImages();

        $('#load-more12').click(function() {
            loadImages();
        });
    });
</script>
</body>

</html>