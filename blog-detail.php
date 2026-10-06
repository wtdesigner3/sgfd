<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('inc/function.php');

$url = isset($_REQUEST['url']) ? preg_replace('/[^a-zA-Z0-9\-_]/', '', trim($_REQUEST['url'])) : '';
if(!empty($url)){
    $safeUrl = mysqli_real_escape_string($conn, $url);
    $blogChecking = mysqli_query($conn,"SELECT b_description,b_title,b_url,b_image,metadesc,metakeyword,b_id,broad_image FROM `tbl_blogs` WHERE `b_url` = '$safeUrl' AND `b_status` = '1'"); 
    if(mysqli_num_rows($blogChecking) > 0){ 
        $blogDetail = mysqli_fetch_assoc($blogChecking);    
    }else{
        header('Location: '.SITE_URL.'404');
        exit;
    }
}else{
    header('Location: '.SITE_URL.'404');
    exit;
}

        $banner = mysqli_query($conn, "SELECT bnr_image,bnr_logo FROM tbl_banner where bnr_id = '10'");
        $banner_cont = mysqli_fetch_assoc($banner);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
    <title><?= $blogDetail['b_title'] ?> | SG Foodees</title>
    <meta name="description" content="<?= $blogDetail['metadesc'] ?>">
    <meta name="keywords" content="<?= $blogDetail['metakeyword'] ?>">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>


<body>
    
    <div class="boxed_wrapper">

        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->
         <?php include('inc/header.php'); ?>
        <!-- Page Title -->
        <?php
        if(!empty($banner_cont['bnr_image'])){
        ?>
        <section class="page-title centred">
            <div class="bg-layer"
                style="background-image: url('<?= SITE_URL ?>uploads/blogs/<?= $blogDetail['broad_image'] ?>'); background-size: cover; background-position: bottom;"> 
            </div>
            <div class="auto-container">
                <div class="content-box">
                    
                   <div class="fg-logo"> <h2 class="mb-3">Blog detail</h2> <img loading="lazy" src="<?= SITE_URL ?>uploads/banner/<?= $banner_cont['bnr_logo'] ?>" class="img-fluid" alt=""></div>

                </div>
            </div>
        </section>
        <?php } ?>
        <!-- End Page Title -->
        
        
        
  <section class="about-style-two sec-pad  position-relative overflow-hidden  visit-bg" >
            <div class="auto-container">
               <div class="row justify-content-center main-content ">
                <div class="col-md-9">
                     <div class="col-md-12">
                    <img loading="lazy" style="width: 100%; object-fit: cover; object-position: center; height: 300px;" class="img-fluid" src="<?= SITE_URL ?>uploads/blogs/<?= $blogDetail['b_image'] ?>" alt="<?= $blogDetail['b_alt'] ?>">
                </div>
                <div class="col-md-12">
                    <div class="mt-5 blog-content"> 
                        <h1>
                            <?= $blogDetail['b_title'] ?>
                        </h1>
                          <?= $blogDetail['b_description'] ?>
                    </div>
                </div>
                </div>
                <div class="col-md-3 rel-card">
                    <h4 class="mb-3">Related Blogs</h4>
                    <hr>
                    <?php
                      $tblRelated = mysqli_query($conn,"SELECT * FROM `tbl_blogs` WHERE `b_id` != '{$blogDetail['b_id']}' AND `b_status` = '1' ORDER BY `b_sort`"); 
                    if(mysqli_num_rows($tblRelated) > 0){
                        while($rowRelated = mysqli_fetch_assoc($tblRelated)){
                    ?>
                    <a class="d-inline-block" href="<?= SITE_URL ?>blog/<?= $rowRelated['b_url'] ?>"> 
                    <div class="row">
                        <div class="col-md-4">
                            <div class="rel-img">
                                <img loading="lazy" src="<?= SITE_URL ?>uploads/blogs/<?= $rowRelated['b_image'] ?>" class="<?= $rowRelated['b_alt'] ?>" />
                            </div>
                        </div>
                        <div class="col-md-8">
                         <div class="rel-content"> 
                                <h4><?= $rowRelated['b_title'] ?></h4>
                            <div class="rel-des"><small><?= substr($rowRelated['b_description'],0,5); ?></small></div>
                         </div>
                        </div>
                    </div>
                    </a>
                    <?php } }else{
                    ?>
                    <div class="row">
                        There are No Related blogs.
                        </div>
                    <?php } ?>
                </div>
                
                
            </div>
            </div>
        </section>

</div>

<?php require('inc/footer.php'); ?>
 <?php require('inc/footer-data.php'); ?>

</body>

</html>