<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('inc/function.php');

        $banner = mysqli_query($conn, "SELECT * FROM tbl_banner where bnr_id = '10'");
        $banner_cont = mysqli_fetch_assoc($banner);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Blogs | SG Foodees</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
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
        <?php include('inc/page-header.php'); ?>
        <!-- End Page Title -->
        
        
        
  <section class="about-style-two sec-pad  position-relative overflow-hidden  visit-bg" >
            <div class="auto-container">
                <div class="row align-items-center">
                    <?php
                    $blogPage = mysqli_query($conn,"SELECT b_url,b_image,b_alt,b_title,b_description FROM `tbl_blogs` WHERE `b_status` = '1' ORDER BY `b_id` DESC");
                    if(mysqli_num_rows($blogPage) > 0){
                        while($rowBlog = mysqli_fetch_assoc($blogPage)){
                    ?>
                    
                        <div class="col-lg-3 mb-4" >
                         <a href="<?= SITE_URL ?>blog/<?= $rowBlog['b_url'] ?>" class="c-container d-inline-block w-100">
                            <div class="c-image">
                              <img loading="lazy" src="<?= SITE_URL ?>uploads/blogs/<?= $rowBlog['b_image'] ?>" alt="<?= $rowBlog['b_alt'] ?>">
                            </div>
                            <div class="c-body cc-tag">
                              <h2><?= $rowBlog['b_title'] ?></h2>
                              <p class="c-subtitle"><?= substr($rowBlog['b_description'],0,80) ?> ...</p>
                            </div>
                          </a>
                        </div>
                    <?php } }else{ ?>
                        <div class="col-lg-3 mb-4" >
                            <div class="c-body cc-tag">
                              <h2>No Blogs</h2>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

</div>

<?php require('inc/footer.php'); ?>
 <?php require('inc/footer-data.php'); ?>

</body>

</html>