<?php 

require('inc/function.php');
$pass = $_GET['pass'] ?? null;
?>

<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= $profile['pro_title'] ?> <?= SITE_NAME ?></title>
    <meta name="description" content="<?= $profile['pro_detail'] ?>">
    <meta name="keywords" content="<?= $profile['pro_keyword'] ?>">
    <?php include('inc/head.php'); ?>
    <link href="<?= SITE_URL ?>assets/css/home-testimonial.css?v=<?= time() ?>" rel="stylesheet">
    
     <link rel="canonical" href="https://sgfoodees.in/home" />
      <meta name="author" content="SGFOODEES INFOTECH LLP">
      <meta name="language" content="english">
      <meta name="google-site-verification" content="d2aoyQMpTfuOoFU7FB5XUUfWVHlrSTtD-dVGvFakv2o" />
      <meta name="robots" content="index,follow">

<!-- page wrapper -->
</head>
<body>

    <!-- Button trigger modal -->
    <div class="boxed_wrapper">

        <!-- preloader -->
    <div class="loader-wrap">
            <div class="preloader">
             
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="S" class="letters-loading">
                                S
                            </span>
                            <span data-text-preloader="G" class="letters-loading">
                                G
                            </span>
                            <span data-text-preloader="F" class="letters-loading">
                                F
                            </span>
                            <span data-text-preloader="O" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="O" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="D" class="letters-loading">
                                D
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                            <span data-text-preloader="S" class="letters-loading">
                                S
                            </span>
                        </div>
                    </div>  
                </div>
            </div>
        </div> 
        <!-- preloader end -->

    <?php include('inc/header.php'); ?>
    
<?php
$bannerValues = mysqli_query($conn,"SELECT * FROM `tbl_main_banner` WHERE status = '1' ORDER BY `sort`");
if(mysqli_num_rows($bannerValues) > 0){
    while($rowBanner = mysqli_fetch_assoc($bannerValues)){
        // Resolve background image
        $bannerBg = '';
        if (!empty($rowBanner['main_image'])) {
            if (file_exists('uploads/banner/' . $rowBanner['main_image'])) {
                $bannerBg = SITE_URL . 'uploads/banner/' . $rowBanner['main_image'];
            } elseif (file_exists('uploads/breadcrumb/' . $rowBanner['main_image'])) {
                $bannerBg = SITE_URL . 'uploads/breadcrumb/' . $rowBanner['main_image'];
            }
        }
        if (empty($bannerBg)) {
            $bannerBg = SITE_URL . 'assets/images/banner/banner-bg.jpg';
        }

        // Format video URL if available
        $videoSrc = $rowBanner['url1'] ?? '';
        if (!empty($videoSrc)) {
            if (strpos($videoSrc, 'watch?v=') !== false) {
                $parts = parse_url($videoSrc);
                parse_str($parts['query'] ?? '', $q);
                $ytId = $q['v'] ?? '';
                if ($ytId) {
                    $videoSrc = "https://www.youtube.com/embed/{$ytId}?autoplay=1&mute=1&loop=1&playlist={$ytId}&controls=1&rel=0";
                }
            } elseif (strpos($videoSrc, 'youtu.be/') !== false) {
                $ytId = basename(parse_url($videoSrc, PHP_URL_PATH));
                if ($ytId) {
                    $videoSrc = "https://www.youtube.com/embed/{$ytId}?autoplay=1&mute=1&loop=1&playlist={$ytId}&controls=1&rel=0";
                }
            }
        }
        $mp4Video = '';
        if (!empty($rowBanner['video']) && file_exists('uploads/banner/' . $rowBanner['video'])) {
            $mp4Video = SITE_URL . 'uploads/banner/' . $rowBanner['video'];
        }
?>
    <section class="hero-banner-section" style="background-image: url('<?= $bannerBg; ?>');">
        <div class="hero-backdrop-overlay"></div>
        <div class="hero-ambient-circle-1"></div>
        <div class="hero-ambient-circle-2"></div>
        
        <div class="container hero-container">
            <div class="row align-items-center g-4 g-lg-5">
                <!-- Left Column: Heading, Subheading, Event Meta, CTAs -->
                <div class="col-lg-7 col-md-12">
                    <div class="hero-content-wrap">
                        
                        <?php if(!empty($rowBanner['heading'])): ?>
                        <div class="hero-edition-pill">
                            <span class="edition-text"><i class="fa-solid fa-award me-1 text-warning"></i> <?= htmlspecialchars($rowBanner['heading']); ?></span>
                        </div>
                        <?php endif; ?>

                        <h1 class="hero-headline">
                            <?= $rowBanner['subheading']; ?>
                        </h1>

                        <!-- Description Block managed from Admin Panel -->
                        <?php if(!empty($rowBanner['content'])): ?>
                        <div class="hero-description">
                            <?= $rowBanner['content']; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Action Buttons -->
                        <div class="hero-btn-group">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#myModal" class="hero-btn-primary">
                                <i class="fa-solid fa-ticket-simple"></i>
                                <span>VISITOR PASS</span>
                                <i class="fa-solid fa-arrow-right btn-arrow"></i>
                            </a>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#contactModal" class="hero-btn-secondary">
                                <i class="fa-solid fa-store"></i>
                                <span>EXHIBITORS</span>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Right Column: Video -->
                <div class="col-lg-5 col-md-12">
                    <div class="hero-video-simple">
                        <div class="video-screen-ratio">
                            <?php if(!empty($videoSrc)): ?>
                                <iframe 
                                  src="<?= $videoSrc; ?>" 
                                  title="Global Food & Bakery Expo Preview" 
                                  frameborder="0" 
                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                  allowfullscreen>
                                </iframe>
                            <?php elseif(!empty($mp4Video)): ?>
                                <video autoplay loop muted playsinline poster="<?= $bannerBg; ?>" controls>
                                    <source src="<?= $mp4Video; ?>" type="video/mp4">
                                </video>
                            <?php else: ?>
                                <img src="<?= $bannerBg; ?>" alt="Hero Banner" style="width:100%; height:100%; object-fit:cover;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php } } ?>
    
    


        <!-- Carousel wrapper -->
<!--        <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong d-none">-->


            <!-- Inner -->
<!--           <div class="carousel-inner">-->
<!--    <div class="carousel-item active">-->
<!--        <div class="video-wrapper">-->
<!--            <video id="bannerVideo" -->
<!--                   autoplay -->
<!--                   loop -->
<!--                   muted -->
<!--                   playsinline -->
<!--                   style="width:100%; height:100%; object-fit:cover;">-->
<!--                <source src="<?= SITE_URL ?>uploads/banner/<?= $banner_cont['bnr_image'] ?>" type="video/mp4">-->
<!--            </video>-->

<!--            <button id="muteToggle" class="mute-btn">-->
<!--                <i class="fa-solid fa-volume-xmark"></i>-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

            <!-- Inner -->

            <!-- Controls -->
<!--            <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">-->
<!--                <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--                <span class="sr-only">Previous</span>-->
<!--            </a>-->
<!--            <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">-->
<!--                <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--                <span class="sr-only">Next</span>-->
<!--            </a>-->
<!--        </div>-->
        <!-- Carousel wrapper -->
        <!-- new-about -->

                <?php
                
                $overview = mysqli_query($conn, "SELECT heading,description,image FROM tbl_overview where id = '1'");
                $overview_cont = mysqli_fetch_assoc($overview);
                if(!empty($overview_cont)){
                ?>
        <section class="about-style-two sec-pad patt-bg " id="outro" data-aos="zoom-in"   data-aos-delay="400" data-aos-duration="800">

            <div class="shape">
                <div class="shape-1" style="background-image: url(assets/images/shape/shape-24.png);"></div>
                <div class="shape-2" style="background-image: url(assets/images/shape/shape-25.png);"></div>
            </div>
            <div class="auto-container">
                <div class="s-style mb-5">
                    <h1><?= $overview_cont['heading'] ?>
                    </h1>
                </div>
                <div class="text-inner p_relative d_block">
                    <div class="row clearfix justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 text-column">
                            <div class="text mr_30 text-center">


                                <p><?= $overview_cont['description'] ?></p>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </section>

    

        <!-- menu-style-four -->
        <section class="about-style-two sec-pad n-about pt-4 d-none">
            <div class="auto-container d-none">
                <!-- <div class="s-style d-flex justify-content-center mb-5">
                    <h1 class="">Get your pass now
                    </h1>
                </div> -->
                
                <div class="mt-5">
                    <div class="menu-block-two p-0">
                        <div class="inner-box">
                            <div class="shape">

                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal"><img loading="lazy"
                                    src="uploads/overview/<?= $overview_cont['image'] ?>" class="img-fluid w-100 " alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
                        <?php
                } ?>
        <!-- menu-style-four end -->

            <?php
                     $key_highlight = mysqli_query($conn, "SELECT image,alt,heading FROM tbl_key_highlights where status = '1' ORDER BY sort");
                       if(mysqli_num_rows($key_highlight)){
            ?>
        <section class="service-section sec-pad centred key-sec" id="high">
            <!-- <div class="patt2"></div> -->
            <div class="pattern-layer"></div>
            <div class="auto-container">
                <div class="s-style mb-5">
                    <h1>Key Highlights</h1>
                </div>

                <div class="key-box mt-5 pt-5" >
                    <?php
                           while($row1 = mysqli_fetch_assoc($key_highlight)){
                    ?>
                    <div class="key-card" data-aos="zoom-in"   data-aos-delay="200" data-aos-duration="600">
                        <div class="container-key">
                            <div class="k-blob"><img loading="lazy" src="uploads/key-highlight/<?= $row1['image'] ?>" class="img-fluid" alt="<?= $row1['alt'] ?>"></div>
                            <div class="overlay-key">
                                <div class="items-key"></div>
                                <div class="items-key head-key">
                                    <p><?= $row1['heading'] ?></p>
                                    <hr>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <?php 
                       } ?>

                </div>
            </div>
        </section>
            <?php
            }
            ?>


            <?php
             $director = mysqli_query($conn, "SELECT image,alt,name,sub_name,description FROM tbl_director where id = '1'");
             if(mysqli_num_rows($director)>0){
            ?>
        <!-- promotion-style-two -->
        <section class="promotion-style-two pt-0 patt-bg" id="d-profile">
            <div class="auto-container">
                <!-- <div class="sec-title centred mb_45">
                    <span class="sub-title">Lorem</span>
                    <h2>Lorem ipsum dolor sit.</h2>
                </div> -->
                <div class="py-5">
                    <?php
                    
                
                 $director_cont = mysqli_fetch_assoc($director);
                    
                    ?>

                    <div class="promotion-block-one py-5">
                        <div class="inner-box">
                            <!-- <div class="shape" style="background-image: url(assets/images/shape/shape-2.png);"></div> -->
                            <div class="row clearfix align-items-center">
                                <div class="col-lg-5 col-md-12 col-sm-12 image-column"  data-aos="zoom-in" data-aos-delay="400" data-aos-duration="600">
                                    <div class="image-box d-blob position-relative">
                                        <figure class="image p-4"><img loading="lazy" src="uploads/director/<?= $director_cont['image'] ?>" class="img-fluid"
                                                alt="<?= $director_cont['alt'] ?>">
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12 col-sm-12 content">
                                    <div class="content-box text-light p-0">
                                        <h2 class="col-primary text-uppercase"><?= $director_cont['name'] ?></h2>
                                        <h3
                                            class="tag-blob position-relative text-light py-2 px-3 mb-3 fw-semibold d-inline-block">
                                            <?= $director_cont['sub_name'] ?></h3>
                                        <!-- <h4>Lorem, ipsum dolor.</h4> -->
                                        
                                           <?= $director_cont['description'] ?>
                                        
                                        <!-- <a href="#" class="theme-btn-one">Know more</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- promotion-style-two end -->
            <?php } ?>      
            

                <?php
                $support_association = mysqli_query($conn, "SELECT image,alt FROM tbl_support_association where id = '1'");
                $support_association_cont = mysqli_fetch_assoc($support_association);
                if(!empty($support_association_cont)){
                ?>
        <section class="about-style-two sec-pad n-about pt-5">
            <div class="auto-container ">
                <div class="s-style d-flex justify-content-center mb-5">
                    <h1 class="">Supporting Association
                    </h1>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-4" data-aos="zoom-in"   data-aos-delay="400" data-aos-duration="800">
                        <img loading="lazy" src="uploads/support-association/<?= $support_association_cont['image'] ?>" class="img-fluid" alt="<?= $support_association_cont['alt'] ?>">
                    </div>
                </div>
              
            </div>
        </section>
                <?php
                } ?>


                        <?php
                        
                    $venue = mysqli_query($conn, "SELECT * FROM tbl_venue where id = '1'");
                    $venue_cont = mysqli_fetch_assoc($venue);
                        if(!empty($venue_cont)){
                        ?>
        <!-- order-style-two -->
        <section class="order-style-two sec-pad pb-5" id="venu">
            <div class="patt" style="background-image: url('<?= SITE_URL ?>assets/images/testing.png')"></div>

            <div class="auto-container">
                <div class="s-style mb-5">
                    <h1 class="text-light">Our Venue Details
                    </h1>
                </div>

                <div class="contact-section col-lg-12 py-0 position-static">
              
                    <div class="">

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 form-column" data-aos="zoom-in"
                                data-aos-delay="400" data-aos-duration="800">
                                <div class="map-responsives">
                                    <iframe
                                        src="<?= $venue_cont['map_url'] ?>"
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 info-column" >
                                <div class="info-inner">
                                    <!-- <div class="text">
                                        <h2>Contact Information</h2>
                                       
                                    </div> -->
                                    <ul class="info-list clearfix pt-5 cus-ul">
                                        <li data-aos="fade-up"
                                        data-aos-delay="200" data-aos-duration="600">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <h5><?= $venue_cont['heading1'] ?></h5>
                                            <?= $venue_cont['content1'] ?>
                                        </li>
                                        <li data-aos="fade-up"
                                        data-aos-delay="400" data-aos-duration="800">
                                            <i class="fa-solid fa-bus"></i>
                                            <h5><?= $venue_cont['heading2'] ?></h5>
                                            <?= $venue_cont['content2'] ?>
                                        </li>
                                        <li data-aos="fade-up"
                                        data-aos-delay="600" data-aos-duration="1200">
                                            <i class="fa-solid fa-plane-departure"></i>
                                            <h5><?= $venue_cont['heading3'] ?></h5>
                                            <?= $venue_cont['content3'] ?>
                                        </li>
                         
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- order-style-two end -->
        <?php }
        ?>
        
        
        <?php
        $pg_sponsor1 = mysqli_query($conn,"SELECT * FROM `tbl_pgsponsor`");
        if(mysqli_num_rows($pg_sponsor1) > 0){
            $pg_sponsor = mysqli_fetch_assoc($pg_sponsor1);
        ?>
        
          <section class="about-style-two sec-pad n-about pt-5 patt-bg">
            <div class="auto-container ">
                <div class="s-style d-flex justify-content-center mb-5">
                    <h1 class=""><?=$pg_sponsor['title']?></h1>
                </div>

                <div class="row justify-content-between pt-4">
                    <div class="col-md-5" data-aos="zoom-in"   data-aos-delay="400" data-aos-duration="800">
                        <div class="p-img  ">
                         
                            <img loading="lazy" src="<?=SITE_URL?>uploads/home/<?=$pg_sponsor['image']?>" class="img-fluid">
                            <hr>
                               <h3 style="font-weight:700" class="mb-0 pt-0 fs-4  text-center"><?=$pg_sponsor['image_title']?></h3>
                                <hr>
                        </div>
                    </div>
                    
                   <div class="col-md-5" data-aos="zoom-in"   data-aos-delay="400" data-aos-duration="800">
                        <div class="p-img  p-l">
                         
                            <img loading="lazy" src="<?=SITE_URL?>uploads/home/<?=$pg_sponsor['image1']?>" class="img-fluid">
                             <hr>
                               <h3 style="font-weight:700" class="mb-0 pt-0 fs-4  text-center"><?=$pg_sponsor['image1_title']?></h3>
                                <hr>
                        </div>
                    </div>
                </div>
              
            </div>
        </section>
        <?php } ?>
        
        
        
<?php
$writtenTestimonials = mysqli_query($conn, "SELECT * FROM `tbl_testimonial` WHERE `tt_status` = '1' ORDER BY `tt_sort` ASC, `tt_id` DESC");
$videoTestimonials = mysqli_query($conn, "SELECT * FROM `tbl_video_testimonia` WHERE `status` = '1' ORDER BY `sort` ASC");
$hasWritten = ($writtenTestimonials && mysqli_num_rows($writtenTestimonials) > 0);
$hasVideos = ($videoTestimonials && mysqli_num_rows($videoTestimonials) > 0);

if ($hasWritten || $hasVideos) {
?>
        <!-- Testimonials & Reviews Section -->
        <section class="about-style-two sec-pad n-about pt-5 patt-bg home-testimonial-sec" id="testimonials">
            <div class="auto-container">
                <!-- Section Header -->
                <div class="tm-home-header" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                    <span class="tm-home-subbadge"><i class="fa-solid fa-star text-warning"></i> TESTIMONIALS & REVIEWS</span>
                    <div class="s-style mb-2">
                        <h1>Voices of Success</h1>
                    </div>
                    <p class="tm-home-subtitle">
                        Hear authentic feedback and business growth stories from machinery exhibitors, master bakers, and trade buyers at SG Foodees Expo.
                    </p>

                    <?php if ($hasWritten && $hasVideos): ?>
                    <!-- Tab Switcher -->
                    <div class="tm-tab-toggle-wrap">
                        <button type="button" class="tm-tab-btn active" data-target="#writtenTestimonialPane">
                            <i class="fa-solid fa-comment-dots"></i> Verified Reviews
                        </button>
                        <button type="button" class="tm-tab-btn" data-target="#videoTestimonialPane">
                            <i class="fa-solid fa-circle-play"></i> Video Experiences
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($hasWritten): ?>
                <!-- Written Testimonial Slick Slider Pane -->
                <div class="tm-slider-pane" id="writtenTestimonialPane" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
                    <div class="tm-slider-container">
                        <div class="tm-slider-track" id="homeTestimonialSlider">
                            <?php while ($rowTm = mysqli_fetch_assoc($writtenTestimonials)): 
                                // Author initials for monogram fallback
                                $nameParts = explode(' ', trim($rowTm['tt_name']));
                                $initials = '';
                                foreach ($nameParts as $np) {
                                    if (!empty($np)) $initials .= strtoupper($np[0]);
                                    if (strlen($initials) >= 2) break;
                                }
                                if (empty($initials)) $initials = 'SG';
                            ?>
                            <div>
                                <div class="tm-home-card">
                                    <i class="fa-solid fa-quote-right tm-card-quote-bg"></i>
                                    
                                    <div class="tm-card-header">
                                        <div class="tm-stars-wrap">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <span class="tm-rating-val">5.0</span>
                                        </div>
                                        <span class="tm-verified-tag">
                                            <i class="fa-solid fa-circle-check"></i> Verified
                                        </span>
                                    </div>

                                    <p class="tm-card-text">
                                        "<?= htmlspecialchars($rowTm['tt_detail']); ?>"
                                    </p>

                                    <div class="tm-card-author-wrap">
                                        <?php if (!empty($rowTm['tt_image']) && file_exists('uploads/testimonial/' . $rowTm['tt_image'])): ?>
                                            <img src="<?= SITE_URL ?>uploads/testimonial/<?= $rowTm['tt_image']; ?>" alt="<?= htmlspecialchars($rowTm['tt_name']); ?>" class="tm-author-avatar" loading="lazy">
                                        <?php else: ?>
                                            <div class="tm-author-monogram"><?= $initials; ?></div>
                                        <?php endif; ?>

                                        <div class="tm-author-details">
                                            <h4 class="tm-author-name"><?= htmlspecialchars($rowTm['tt_name']); ?></h4>
                                            <p class="tm-author-role"><?= htmlspecialchars($rowTm['tt_location']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- Custom Navigation Arrows -->
                        <div class="tm-slider-controls">
                            <button type="button" class="tm-arrow-btn tm-prev-written" aria-label="Previous Review">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <button type="button" class="tm-arrow-btn tm-next-written" aria-label="Next Review">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($hasVideos): ?>
                <!-- Video Testimonial Slick Slider Pane -->
                <div class="tm-slider-pane" id="videoTestimonialPane" style="<?= $hasWritten ? 'display: none;' : ''; ?>" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
                    <div class="tm-slider-container">
                        <div class="tm-slider-track" id="homeVideoSlider">
                            <?php 
                            mysqli_data_seek($videoTestimonials, 0);
                            while ($rowVid = mysqli_fetch_assoc($videoTestimonials)): 
                                $vCode = htmlspecialchars($rowVid['v_code']);
                                $vTitle = !empty($rowVid['title']) ? htmlspecialchars($rowVid['title']) : 'Exhibitor Experience';
                                $vSub = !empty($rowVid['subtitle']) ? htmlspecialchars($rowVid['subtitle']) : 'SG Foodees Expo';
                                $vTag = !empty($rowVid['tag']) ? htmlspecialchars($rowVid['tag']) : 'Video Review';
                            ?>
                            <div>
                                <div class="tm-video-card">
                                    <div class="tm-video-thumb-wrap" onclick="openHomeVideoModal('<?= $vCode ?>', '<?= addslashes($vTitle) ?>')">
                                        <img src="https://img.youtube.com/vi/<?= $vCode ?>/hqdefault.jpg" alt="<?= $vTitle ?>" class="tm-video-thumb" loading="lazy">
                                        <div class="tm-video-play-btn">
                                            <i class="fa-solid fa-play"></i>
                                        </div>
                                        <span class="tm-video-badge"><?= $vTag ?></span>
                                    </div>
                                    <div class="tm-video-info">
                                        <h4 class="tm-video-title"><?= $vTitle ?></h4>
                                        <p class="tm-video-subtitle"><?= $vSub ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- Custom Arrows for Videos -->
                        <div class="tm-slider-controls">
                            <button type="button" class="tm-arrow-btn tm-prev-video" aria-label="Previous Video">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <button type="button" class="tm-arrow-btn tm-next-video" aria-label="Next Video">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </section>

        <!-- Video Playback Modal -->
        <div class="modal fade" id="homeVideoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark text-white" style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="modal-title" id="homeVideoModalTitle">Exhibitor Video Review</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closeHomeVideoModal()"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="ratio ratio-16x9">
                            <iframe id="homeVideoIframe" src="" title="Video Testimonial" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>        
        
</div>        
        

<?php include('inc/footer.php'); ?>

<?php include('inc/footer-data.php'); ?>

 
<script>
$(window).on('load', function () {
    let modalShown = false;

    const urlParams = new URLSearchParams(window.location.search);
    const pass = urlParams.get('pass');

    // If pass exists → show immediately
    if (pass) {
        $('#myModal').modal('show');
        modalShown = true;
    }

    // Scroll trigger (only if not already shown)
    $(window).scroll(function () {
        if (!modalShown && $(window).scrollTop() + $(window).height() >= $(document).height()) {
            $('#myModal').modal('show');
            modalShown = true;
        }
    });
});
</script>

<script>
$(window).on('load', function () {
    let modalShown = false;

    // Get pass from backend (PHP echo)
    const pass = "<?= isset($_GET['pass']) ? $_GET['pass'] : '' ?>";

    if (pass) {
        $('#myModal').modal('show');
        modalShown = true;
        console.log("Pass:", pass);
    }

    $(window).scroll(function () {
        if (!modalShown && $(window).scrollTop() + $(window).height() >= $(document).height()) {
            $('#myModal').modal('show');
            modalShown = true;
        }
    });
});
</script>
<script>
    let player;
    const muteButton = document.getElementById('muteToggle');

   
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtubePlayer', {
            events: {
                onReady: onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        player.mute();
    }


    muteButton.addEventListener('click', () => {
        if (player.isMuted()) {
            player.unMute();
            muteButton.innerHTML = '<i class="fa-solid fa-volume-high"></i>';

        } else {
            player.mute();
            muteButton.innerHTML = '<i class="fa-solid  fa-volume-xmark"></i>';
        }
    });

    
    const tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.body.appendChild(tag);
</script>
<script>
    const video = document.getElementById("bannerVideo");
const muteBtn = document.getElementById("muteToggle");

muteBtn.addEventListener("click", () => {
    video.muted = !video.muted;

    if (video.muted) {
        muteBtn.innerHTML = '<i class="fa-solid fa-volume-xmark"></i>';
    } else {
        muteBtn.innerHTML = '<i class="fa-solid fa-volume-high"></i>';
    }
});

</script>


<script>
$(document).ready(function () {
    // 1. Initialize Written Testimonials Slick Slider
    if ($('#homeTestimonialSlider').length) {
        $('#homeTestimonialSlider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 4500,
            pauseOnHover: true,
            dots: true,
            arrows: true,
            prevArrow: $('.tm-prev-written'),
            nextArrow: $('.tm-next-written'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true
                    }
                }
            ]
        });
    }

    // 2. Initialize Video Testimonials Slick Slider
    if ($('#homeVideoSlider').length) {
        $('#homeVideoSlider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            dots: true,
            arrows: true,
            prevArrow: $('.tm-prev-video'),
            nextArrow: $('.tm-next-video'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true
                    }
                }
            ]
        });
    }

    // 3. Tab switching between Written Reviews and Video Experiences
    $('.tm-tab-btn').on('click', function () {
        var targetId = $(this).data('target');
        $('.tm-tab-btn').removeClass('active');
        $(this).addClass('active');

        $('.tm-slider-pane').hide();
        $(targetId).fadeIn(250, function () {
            if (targetId === '#videoTestimonialPane') {
                if ($('#homeVideoSlider').hasClass('slick-initialized')) {
                    $('#homeVideoSlider').slick('setPosition');
                }
            } else {
                if ($('#homeTestimonialSlider').hasClass('slick-initialized')) {
                    $('#homeTestimonialSlider').slick('setPosition');
                }
            }
        });
    });
});

// 4. Video Modal handlers
function openHomeVideoModal(code, title) {
    var modalEl = document.getElementById('homeVideoModal');
    if (!modalEl) return;
    var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    var iframe = document.getElementById('homeVideoIframe');
    if (iframe) {
        iframe.src = 'https://www.youtube.com/embed/' + code + '?autoplay=1&rel=0';
    }
    var titleEl = document.getElementById('homeVideoModalTitle');
    if (titleEl) {
        titleEl.innerText = title || 'Exhibitor Video Review';
    }
    modal.show();
}

function closeHomeVideoModal() {
    var iframe = document.getElementById('homeVideoIframe');
    if (iframe) iframe.src = '';
}

var homeVidModal = document.getElementById('homeVideoModal');
if (homeVidModal) {
    homeVidModal.addEventListener('hidden.bs.modal', function () {
        closeHomeVideoModal();
    });
}
</script>
</body>

</html>
