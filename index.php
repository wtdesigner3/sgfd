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
$videoTestimonial = mysqli_query($conn,"SELECT * FROM `tbl_video_testimonia` WHERE `status` = '1' ORDER BY `sort`");
if(mysqli_num_rows($videoTestimonial) > 0){
?>
             <section class="about-style-two sec-pad n-about pt-5">
            <div class="auto-container ">
                <div class="s-style d-flex justify-content-center mb-5">
                    <h1 class="">What Our Exhibitors Say
                    </h1>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12" >
                        <div class="vt-carousel-wrap">
    <div class="vt-track" id="vtTrack" role="list">
<?php
    while($rowVideoTestimonial = mysqli_fetch_assoc($videoTestimonial)){

?>
      <!-- CARD 1 -->
      <div class="vt-card" data-index="0" data-videoid="<?= $rowVideoTestimonial['v_code']; ?>" role="listitem">
        <div class="vt-thumb">
          <img src="https://img.youtube.com/vi/<?= $rowVideoTestimonial['v_code']; ?>/hqdefault.jpg" alt="Testimonial 1" loading="lazy">
        </div>
        <div class="vt-play" aria-hidden="true"></div>
        <div class="vt-meta">
        <?php
        if(!empty($rowVideoTestimonial['tag'])){
        ?>
          <span class="vt-badge"><?= $rowVideoTestimonial['tag']; ?></span>
        <?php } ?>  
          <p class="vt-name"><?= $rowVideoTestimonial['title']; ?></p>
          <p class="vt-role"><?= $rowVideoTestimonial['subtitle']; ?></p>
        </div>
        <div class="vt-iframe-wrap"></div>
      </div>
<?php } ?>
    </div>
  </div>

  <div class="vt-nav">
    <button class="vt-btn" id="vtPrev" aria-label="Previous">&#8592;</button>
    <div class="vt-dots" id="vtDots"></div>
    <button class="vt-btn" id="vtNext" aria-label="Next">&#8594;</button>
  </div>
                        
                    </div>
                </div>
              
            </div>
        </section>
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
(function () {
  var track  = document.getElementById('vtTrack');
  var dotsEl = document.getElementById('vtDots');
  var cards  = track.querySelectorAll('.vt-card');
  var currentIndex = 0;


  cards.forEach(function (card, i) {
    var dot = document.createElement('button');
    dot.className = 'vt-dot' + (i === 0 ? ' is-active' : '');
    dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
    dot.addEventListener('click', function () { scrollToCard(i); });
    dotsEl.appendChild(dot);

   
    card.addEventListener('click', function () {
      var vid = card.getAttribute('data-videoid');
      if (vid) playVideo(card, vid);
    });
  });

  function playVideo(card, id) {
    track.querySelectorAll('.vt-iframe-wrap.is-playing').forEach(function (el) {
      el.innerHTML = '';
      el.classList.remove('is-playing');
    });
    track.querySelectorAll('.vt-card.is-active').forEach(function (el) {
      el.classList.remove('is-active');
    });
    var wrap   = card.querySelector('.vt-iframe-wrap');
    var iframe = document.createElement('iframe');
    iframe.src   = 'https://www.youtube.com/embed/' + id + '?autoplay=1&rel=0&modestbranding=1&playsinline=1';
    iframe.title = 'Video testimonial';
    iframe.allow = 'autoplay; encrypted-media';
    iframe.setAttribute('allowfullscreen', '');
    wrap.appendChild(iframe);
    wrap.classList.add('is-playing');
    card.classList.add('is-active');
  }

  function scrollToCard(index) {
    if (!cards[index]) return;
    cards[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    updateDots(index);
    currentIndex = index;
  }

  function updateDots(active) {
    dotsEl.querySelectorAll('.vt-dot').forEach(function (d, i) {
      d.classList.toggle('is-active', i === active);
    });
  }

  document.getElementById('vtNext').addEventListener('click', function () {
    currentIndex = Math.min(currentIndex + 1, cards.length - 1);
    scrollToCard(currentIndex);
  });
  document.getElementById('vtPrev').addEventListener('click', function () {
    currentIndex = Math.max(currentIndex - 1, 0);
    scrollToCard(currentIndex);
  });

  
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        var idx = parseInt(entry.target.getAttribute('data-index'));
        currentIndex = idx;
        updateDots(idx);
      }
    });
  }, { root: track, threshold: 0.6 });
  cards.forEach(function (c) { observer.observe(c); });

  
  var isDragging = false, startX, scrollLeft;
  track.addEventListener('mousedown', function (e) {
    isDragging = true; track.classList.add('is-grabbing');
    startX = e.pageX - track.offsetLeft; scrollLeft = track.scrollLeft;
  });
  document.addEventListener('mousemove', function (e) {
    if (!isDragging) return; e.preventDefault();
    track.scrollLeft = scrollLeft - (e.pageX - track.offsetLeft - startX) * 1.2;
  });
  document.addEventListener('mouseup', function () {
    isDragging = false; track.classList.remove('is-grabbing');
  });
})();
</script>
</body>

</html>
