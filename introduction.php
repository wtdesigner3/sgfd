
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
                $dinner = mysqli_query($conn, "SELECT * FROM tbl_dinner where id = '1'");
                $dinner_cont = mysqli_fetch_assoc($dinner);
                if(!empty($dinner_cont)){
            ?>
        <section class="about-style-two sec-pad expo-feature-section" id="buyer">
            <div class="auto-container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="expo-feature-stage" data-aos="fade-up" data-aos-duration="700">
                            <!-- Top Editorial Header Strip -->
                            <div class="expo-stage-topbar">
                                <div class="expo-stage-brand">
                                    <img src="assets/img/food.png" alt="5th Global Food & Bakery Expo" class="expo-brand-symbol">
                                    <div class="expo-brand-meta">
                                        <span class="expo-brand-tag">5th Grand International Edition</span>
                                        <span class="expo-brand-sub">Premier B2B Conclave & Trade Fair</span>
                                    </div>
                                </div>
                                <div class="expo-stage-organizer">
                                    <span class="org-label">Organized By</span>
                                    <span class="org-name">SG Foodees Infotech LLP</span>
                                </div>
                            </div>

                            <!-- Main Showcase Body (2-Column Asymmetric Grid) -->
                            <div class="expo-stage-body">
                                <div class="row align-items-stretch g-4">
                                    <!-- Left Column: Title, Narrative, Venue & Action -->
                                    <div class="col-lg-7 d-flex flex-column justify-content-between">
                                        <div class="expo-primary-content">
                                            <div class="expo-heading-label">
                                                <span class="red-dash"></span>
                                                <span class="label-text">Official Event Announcement</span>
                                            </div>

                                            <h1 class="expo-main-title"><?= htmlspecialchars($dinner_cont['heading']) ?></h1>

                                            <p class="expo-lead-text">
                                                India's foremost business platform uniting global leaders, manufacturers, and buyers across Food Processing, Bakery Machinery, Ingredients, Packaging, and Allied Technologies.
                                            </p>

                                            <!-- Official Venue Panel -->
                                            <div class="expo-venue-panel">
                                                <div class="venue-icon-wrapper">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="venue-info-text">
                                                    <span class="venue-caption">Exhibition Venue</span>
                                                    <h3 class="venue-title"><?= htmlspecialchars($dinner_cont['subtitle']) ?></h3>
                                                    <span class="venue-sub">Delhi-NCR, India • World-Class Air-Conditioned Exhibition Halls</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons Group -->
                                        <div class="expo-actions-group">
                                            <a href="javascript:void(0)" class="theme-btn-one expo-primary-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                                <i class="fa-solid fa-id-badge mr-2"></i> Get Visitor Pass
                                            </a>
                                            <a href="exhibit.php" class="expo-secondary-btn">
                                                <span>Book Exhibition Stall</span>
                                                <i class="fa-solid fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Right Column: Official Calendar & Delegate Pass Component -->
                                    <div class="col-lg-5">
                                        <div class="expo-date-ticket">
                                            <!-- Ticket Ribbon -->
                                            <div class="ticket-header-ribbon">
                                                <i class="fa-solid fa-calendar-check mr-2"></i>
                                                <span>Official Exhibition Dates</span>
                                            </div>

                                            <!-- Ticket Body -->
                                            <div class="ticket-body-content">
                                                <div class="ticket-edition-stamp">JULY 2027</div>

                                                <div class="ticket-days-display">
                                                    <div class="day-slot">
                                                        <span class="slot-number">15</span>
                                                        <span class="slot-day">THU</span>
                                                    </div>
                                                    <div class="slot-divider">•</div>
                                                    <div class="day-slot slot-center">
                                                        <span class="slot-number">16</span>
                                                        <span class="slot-day">FRI</span>
                                                    </div>
                                                    <div class="slot-divider">•</div>
                                                    <div class="day-slot">
                                                        <span class="slot-number">17</span>
                                                        <span class="slot-day">SAT</span>
                                                    </div>
                                                </div>

                                                <div class="ticket-full-date-badge">
                                                    <i class="fa-regular fa-calendar-days mr-2 text-danger"></i> <?= htmlspecialchars($dinner_cont['title']) ?>
                                                </div>

                                                <div class="ticket-divider-stitch"></div>

                                                <!-- Expo Quick Facts -->
                                                <div class="ticket-info-rows">
                                                    <div class="t-row">
                                                        <span class="t-label"><i class="fa-regular fa-clock mr-2 text-danger"></i> Expo Timings:</span>
                                                        <span class="t-val">10:00 AM – 06:00 PM (Daily)</span>
                                                    </div>
                                                    <div class="t-row">
                                                        <span class="t-label"><i class="fa-solid fa-building mr-2 text-danger"></i> Complex:</span>
                                                        <span class="t-val">India Expo Centre & Mart</span>
                                                    </div>
                                                    <div class="t-row">
                                                        <span class="t-label"><i class="fa-solid fa-users mr-2 text-danger"></i> Target Audience:</span>
                                                        <span class="t-val">B2B Trade & Industrial Buyers</span>
                                                    </div>
                                                </div>

                                                <!-- Ticket Footer -->
                                                <div class="ticket-badge-footer">
                                                    <i class="fa-solid fa-shield-halved text-danger mr-2"></i> Official Trade Exhibition • SG Foodees
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Categories Strip -->
                            <div class="expo-stage-footer-strip">
                                <div class="strip-item"><i class="fa-solid fa-bread-slice mr-2"></i> Bakery & Confectionery Machinery</div>
                                <div class="strip-sep">/</div>
                                <div class="strip-item"><i class="fa-solid fa-wheat-awn mr-2"></i> Food Processing Technology</div>
                                <div class="strip-sep">/</div>
                                <div class="strip-item"><i class="fa-solid fa-box-open mr-2"></i> Packaging & Cold Chain</div>
                                <div class="strip-sep">/</div>
                                <div class="strip-item"><i class="fa-solid fa-handshake mr-2"></i> B2B Buyer-Seller Conclave</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buyer Seller Meet Section (Aligned with Site's s-style) -->
            <?php
                $meet = mysqli_query($conn, "SELECT * FROM tbl_overview where id = '2'");
                $meet_cont = mysqli_fetch_assoc($meet);
                if(!empty($meet_cont)){
            ?>
            <div class="auto-container mt-5 pt-4">
                <div class="s-style mb-4 text-center">
                    <h1><?= htmlspecialchars($meet_cont['heading']) ?></h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-11">
                        <div class="buyer-meet-clean-card text-center" data-aos="fade-up" data-aos-duration="700">
                            <p class="meet-clean-desc"><?= htmlspecialchars($meet_cont['description']) ?></p>
                            <div class="row g-3 justify-content-center mt-3">
                                <div class="col-md-4">
                                    <div class="b2b-highlight-tile">
                                        <div class="b2b-tile-icon"><i class="fa-solid fa-calendar-check"></i></div>
                                        <h5>Pre-Scheduled Meetings</h5>
                                        <p>One-on-one structured sessions with pre-qualified industrial buyers.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="b2b-highlight-tile">
                                        <div class="b2b-tile-icon"><i class="fa-solid fa-industry"></i></div>
                                        <h5>Direct Manufacturer Connect</h5>
                                        <p>Eliminate intermediaries to negotiate partnerships directly.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="b2b-highlight-tile">
                                        <div class="b2b-tile-icon"><i class="fa-solid fa-globe"></i></div>
                                        <h5>Pan-India & Global Buyers</h5>
                                        <p>Connect with high-value procurement heads and distributors.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </section>
                <?php } ?>
                
                
</div>                
                
<?php require('inc/footer.php');?>
<?php require('inc/footer-data.php');?>

</body>
</html>