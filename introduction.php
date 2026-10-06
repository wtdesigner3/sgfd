
<?php
require('inc/function.php');


$contact = mysqli_query($conn, "SELECT * FROM tbl_contact where con_id = '1'");
$contact_con = mysqli_fetch_assoc($contact);

?>


<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Introduction | SG Foodees</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>

<body>



    <!-- <a href="#" class="fix-blob bg-light text-center p-2 rounded"> 
        <h6 class="text-dar" style="color: red;">Get your pass now</h6>
        <div class="animate__animated animate__pulse  animate__infinite">
         <img src="assets/img/food-2.gif" class="img-fluid" alt=""></div>
        </a> -->
    <!-- modal -->

    <!-- Button trigger modal -->


    <!-- modal-end -->
    <div class="boxed_wrapper">


        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->


        <!--Search Popup-->
        <!--<div id="search-popup" class="search-popup">-->
        <!--    <div class="popup-inner">-->
        <!--        <div class="upper-box clearfix">-->
        <!--            <figure class="logo-box pull-left"><a href="#"><img src="assets/img/logo.png" alt=""></a></figure>-->
        <!--            <div class="close-search pull-right"><span class="far fa-times"></span></div>-->
        <!--        </div>-->
        <!--        <div class="overlay-layer"></div>-->
        <!--        <div class="auto-container">-->
        <!--            <div class="search-form">-->
        <!--                <form method="post" action="#">-->
        <!--                    <div class="form-group">-->
        <!--                        <fieldset>-->
        <!--                            <input type="search" class="form-control" name="search-input" value=""-->
        <!--                                placeholder="Type your keyword and hit" required>-->
        <!--                            <button type="submit"><i class="far fa-search"></i></button>-->
        <!--                        </fieldset>-->
        <!--                    </div>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


         <!-- main header -->

        <?php include('inc/header.php'); ?>
        <!-- main-header end -->

       
        <!-- Page Title -->
        <?php
        
        $intro_banner = mysqli_query($conn, "SELECT * FROM tbl_banner where bnr_id = '8'");
        $banner_cont = mysqli_fetch_assoc($intro_banner);
         if(!empty($banner_cont)){
        ?>
        <section class="page-title centred">
            <div class="bg-layer"
                style="background-image: url(uploads/banner/<?= $banner_cont['bnr_image'] ?>); background-size: cover; background-position: bottom;">
            </div>
            <div class="auto-container">
                <div class="content-box">
                    
                   <div class="fg-logo"> <h2 class="mb-3">Introduction</h2> <img src="uploads/banner/<?= $banner_cont['bnr_logo'] ?>" class="img-fluid" alt=""></div>

                </div>
            </div>
        </section>
        <?php
         } ?>
        <!-- End Page Title -->

                <?php
                    $food_backery = mysqli_query($conn, "SELECT * FROM tbl_food_backery where id = '1'");
                    $food_backery_cont = mysqli_fetch_assoc($food_backery);
                    if(!empty($food_backery_cont)){
                ?>
        <section class="about-style-two sec-pad patt-bg" id="overview">

            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="intro-about p-5">
                            <img src="uploads/food-backery/<?= $food_backery_cont['image'] ?>" class="img-fluid c-page-box" alt="<?= $food_backery_cont['alt'] ?>">
                        </div>
                    </div>

                    <div class="col-md-6 content-custom">
                        <div class="content-box text-light p-0">
                            <h2 class="col-primary text-uppercase"><?= $food_backery_cont['name'] ?></h2>

                            <?= $food_backery_cont['description'] ?>
                            

                            <!-- <a href="#" class="theme-btn-one">Know more</a> -->
                        </div>
                    </div>
                </div>

            </div>
        </section>

            <?php
            }
            ?>


            <?php
                                    $key_element = mysqli_query($conn, "SELECT * FROM tbl_key_element where status = '1' ORDER BY sort");
                                    if(mysqli_num_rows($key_element) > 0){
            ?>
        <section class="about-style-two sec-pad key-bg position-relative " style="background-image:url('<?= SITE_URL ?>assets/images/testing.png')" id="elements">

            <div class="auto-container">

                <div class="s-style-w mb-3 mb-lg-5 d-flex justify-content-center">
                    <h1 class="text-light">Key Elements
                    </h1>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">

                        <div class="in-card2">
                            <?php

                            while($key_row = mysqli_fetch_assoc($key_element)){
                                
                            ?>
                            <div class=container-m>
                                <div class=card-m>
                                    <div class=image-m>
                                        <img src="uploads/key-element/<?= $key_row['image'] ?>" alt="<?= $key_row['alt'] ?>" class="">
                                        <h3 class="mt-3 "><?= $key_row['heading'] ?></h3>
                                    </div>
                                    <div class=content-m>
                                     
                                        <?= $key_row['description'] ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?php } ?>




            <?php

                    $dinner = mysqli_query($conn, "SELECT * FROM  tbl_dinner where id = '1'");
                    $dinner_cont = mysqli_fetch_assoc($dinner);
                    if(!empty($dinner_cont)){

            ?>
        <section class="about-style-two sec-pad buyer-bg" id="buyer">
            <div class="auto-container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="position-relative">
                            <div class="buyer-content">
                                <div class="buyer-contner-img">
                                    <img src="assets/img/l-border.png" class="img-fluid" alt="<?= $dinner_cont['alt'] ?>">
                                </div>
                                <h1><?= $dinner_cont['heading'] ?></h1>
                                <P><?= $dinner_cont['title'] ?></P>
                                <h2><?= $dinner_cont['subtitle'] ?></h2>
                            </div>
                            <img src="uploads/dinner/<?= $dinner_cont['image'] ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
                    $meet = mysqli_query($conn, "SELECT * FROM  tbl_overview where id = '2'");
                    $meet_cont = mysqli_fetch_assoc($meet);
            ?>
            <div class="auto-container mt-5">
                <div class="s-style mb-3 mb-lg-5">
                    <h1 class=""><?= $meet_cont['heading'] ?>
                    </h1>
                </div>
                <div class="text-inner p_relative d_block">
                    <div class="row clearfix justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-column">
                            <div class="text mr_30 text-center">
                                <p class=""><?= $meet_cont['description'] ?></p>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
                <?php } ?>
                
                
</div>                
                
<?php require('inc/footer.php');?>
<?php require('inc/footer-data.php');?>

</body>
</html>