<?php
require('inc/function.php');

// Fetch breadcrumb or use brand fallback
$breadCrumb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_breadcrumb` WHERE brd_name LIKE '%Testimonial%' LIMIT 1"));
if (!$breadCrumb) {
    $breadCrumb = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_breadcrumb` WHERE brd_id = '6' LIMIT 1"));
}

$pageTitle = "Testimonials & Reviews | " . SITE_NAME;
$pageDesc = "Read authentic reviews, exhibitor experiences, and trade buyer feedback from the SG Foodees Food & Bakery Expo.";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $pageDesc ?>">
    <meta name="keywords" content="SG Foodees reviews, Food & Bakery Expo testimonials, exhibitor feedback, bakery expo India, trade visitor experience">
    <?php include('inc/head.php'); ?>
    <!-- Testimonial Specific Stylesheet -->
    <link href="<?= SITE_URL ?>assets/css/testimonial.css?v=<?= time() ?>" rel="stylesheet">
</head>

<body>
    <div class="boxed_wrapper">

        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="S" class="letters-loading">S</span>
                            <span data-text-preloader="G" class="letters-loading">G</span>
                            <span data-text-preloader="F" class="letters-loading">F</span>
                            <span data-text-preloader="O" class="letters-loading">O</span>
                            <span data-text-preloader="O" class="letters-loading">O</span>
                            <span data-text-preloader="D" class="letters-loading">D</span>
                            <span data-text-preloader="E" class="letters-loading">E</span>
                            <span data-text-preloader="E" class="letters-loading">E</span>
                            <span data-text-preloader="S" class="letters-loading">S</span>
                        </div>
                    </div>  
                </div>
            </div>
        </div> 
        <!-- Preloader end -->

        <!-- Main Header -->
        <?php include('inc/header.php'); ?>
        <!-- Main Header end -->

        <!-- Page Title Banner -->
        <section class="page-title centred">
            <div class="bg-layer"
                style="background-image: url(<?= SITE_URL ?>uploads/breadcrumb/<?= !empty($breadCrumb['brd_image']) ? $breadCrumb['brd_image'] : '1772022290_tetk.jpg' ?>); background-size: cover; background-position: bottom;">
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <div class="fg-logo">
                        <h2 class="mb-3">Testimonials</h2>
                        <img loading="lazy" src="<?= SITE_URL ?>uploads/breadcrumb/<?= !empty($breadCrumb['brd_logo']) ? $breadCrumb['brd_logo'] : '1772079888_logo11.png' ?>" class="img-fluid" alt="SG Foodees Logo">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Page Title -->

        <!-- Main Testimonial Section -->
        <section class="testimonial-page-sec position-relative">
            <div class="auto-container">

                <!-- 1. Trust Stats Metric Bar -->
                <div class="trust-stats-wrapper">
                    <div class="row g-3">
                        <div class="col-lg-3 col-sm-6">
                            <div class="trust-stat-card">
                                <div class="trust-stat-icon">
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div>
                                    <div class="trust-stat-number">4.9 <span>/ 5.0</span></div>
                                    <div class="trust-stat-label">500+ Verified Trade Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="trust-stat-card">
                                <div class="trust-stat-icon">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div>
                                    <div class="trust-stat-number">450<span>+</span></div>
                                    <div class="trust-stat-label">Leading Food Brands Exhibited</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="trust-stat-card">
                                <div class="trust-stat-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div>
                                    <div class="trust-stat-number">25K<span>+</span></div>
                                    <div class="trust-stat-label">Trade Visitors & Buyers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="trust-stat-card">
                                <div class="trust-stat-icon">
                                    <i class="fa-solid fa-handshake"></i>
                                </div>
                                <div>
                                    <div class="trust-stat-number">96<span>%</span></div>
                                    <div class="trust-stat-label">Exhibitor Return Rate</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Section Heading -->
                <div class="tm-section-heading">
                    <span class="tm-subbadge"><i class="fa-solid fa-certificate"></i> Trusted By Industry Leaders</span>
                    <h2 class="tm-title">Voices of <span>Success & Growth</span></h2>
                    <p class="tm-desc">
                        Discover what machinery manufacturers, commercial bakers, FMCG brands, and international buyers have to say about their real business impact at SG Foodees Expo.
                    </p>
                </div>

                <!-- 3. Category Filter Navigation -->
                <div class="tm-filter-nav" id="testimonialFilterNav">
                    <button class="tm-filter-btn active" data-filter="all">
                        <i class="fa-solid fa-layer-group"></i> All Stories
                    </button>
                    <button class="tm-filter-btn" data-filter="exhibitor">
                        <i class="fa-solid fa-store"></i> Exhibitors & Brands
                    </button>
                    <button class="tm-filter-btn" data-filter="buyer">
                        <i class="fa-solid fa-briefcase"></i> Trade Buyers & Distributors
                    </button>
                    <button class="tm-filter-btn" data-filter="chef">
                        <i class="fa-solid fa-utensils"></i> Master Bakers & Chefs
                    </button>
                    <button class="tm-filter-btn" data-filter="video">
                        <i class="fa-solid fa-video"></i> Video Reviews
                    </button>
                </div>

                <!-- 4. Featured Spotlight Testimonial -->
                <div class="tm-spotlight-card" data-category="exhibitor">
                    <i class="fa-solid fa-quote-right tm-spotlight-quote-icon"></i>
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 text-center">
                            <div class="tm-spotlight-img-wrap">
                                <img src="<?= SITE_URL ?>assets/images/team/team-1.jpg" alt="Rajesh Malhotra" class="tm-spotlight-img">
                                <span class="tm-spotlight-badge" title="Verified Exhibitor">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <h4 class="tm-spotlight-author">Rajesh Malhotra</h4>
                            <p class="tm-spotlight-role">Managing Director</p>
                            <p class="tm-spotlight-company">Bakers Equipment World, Delhi</p>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="tm-spotlight-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span class="ms-2 fw-semibold text-dark">5.0 / 5.0 (Exhibitor Spotlight)</span>
                            </div>
                            <blockquote class="tm-spotlight-text">
                                "Exhibiting our automated rotary rack ovens and planetary mixers at SG Foodees Expo was the turning point for our national sales. In just three days, we connected with over 180 verified bakery owners and secured firm dealership contracts across 5 major states. The footfall quality was strictly B2B with genuine decision-makers."
                            </blockquote>
                            <div class="tm-spotlight-metrics">
                                <div class="tm-spotlight-metric-item">
                                    <strong>180+</strong>
                                    <span>Verified Inquiries</span>
                                </div>
                                <div class="tm-spotlight-metric-item">
                                    <strong>5 New States</strong>
                                    <span>Distribution Expanded</span>
                                </div>
                                <div class="tm-spotlight-metric-item">
                                    <strong>3rd Year</strong>
                                    <span>Consecutive Exhibitor</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Testimonial Cards Grid -->
                <div class="tm-grid" id="testimonialGrid">

                    <!-- Card 1: Exhibitor -->
                    <div class="tm-card" data-category="exhibitor">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag exhibitor">Exhibitor</span>
                            </div>
                            <p class="tm-card-quote">
                                SG Foodees gave our artisan flour brand unprecedented visibility. We conducted live dough-making workshops at our stall which drew continuous crowds of commercial bakers and cafe chains. We closed advance bulk orders on the second day itself.
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-1.jpg" alt="Pooja Sharma" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Pooja Sharma <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>Co-Founder, <span class="tm-author-company">GrainCraft Organics</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Ahmedabad, Gujarat</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Trade Buyer -->
                    <div class="tm-card" data-category="buyer">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag buyer">Trade Buyer</span>
                            </div>
                            <p class="tm-card-quote">
                                As head of procurement for 40+ restaurant outlets, finding reliable packaging and raw ingredient suppliers under one roof used to take months. At SG Foodees, I finalized two machinery suppliers and negotiated direct factory pricing in a single afternoon.
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-2.jpg" alt="Vikramaditya Patel" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Vikramaditya Patel <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>VP Procurement, <span class="tm-author-company">TastyBite Hospitality Group</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Mumbai, Maharashtra</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Master Baker / Chef -->
                    <div class="tm-card" data-category="chef">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag chef">Master Baker</span>
                            </div>
                            <p class="tm-card-quote">
                                The live masterclasses and bakery demonstrations were world-class! Getting hands-on trial runs with the latest European convection ovens and sourdough fermentation chambers was invaluable for upgrading our production academy.
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/team/team-2.jpg" alt="Chef Antonio D'Souza" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Chef Antonio D'Souza <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>Head Pastry Chef, <span class="tm-author-company">Artisan Bakehouse & Academy</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Goa & Bengaluru</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Exhibitor -->
                    <div class="tm-card" data-category="exhibitor">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag exhibitor">Exhibitor</span>
                            </div>
                            <p class="tm-card-quote">
                                We introduced our eco-friendly bakery boxes and tamper-evident food trays. The response was phenomenal. Buyers from Tier-1 and Tier-2 cities specifically visited our stall looking for sustainable alternatives. We already booked our 2026 booth!
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-4.jpg" alt="Sunil Verma" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Sunil Verma <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>Director, <span class="tm-author-company">GreenPack Solutions</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Surat, Gujarat</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Trade Buyer -->
                    <div class="tm-card" data-category="buyer">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag buyer">Trade Buyer</span>
                            </div>
                            <p class="tm-card-quote">
                                The B2B Buyer-Seller lounge organized by Dr. Girish Gupta and team was impeccably managed. Pre-scheduled 1-on-1 meetings saved us immense time and allowed deep commercial negotiations. An essential expo on our yearly calendar.
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-5.jpg" alt="Meenakshi Iyer" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Meenakshi Iyer <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>Sourcing Head, <span class="tm-author-company">Southern Spice & Confectioneries</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Chennai, Tamil Nadu</small></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Master Baker / Chef -->
                    <div class="tm-card" data-category="chef">
                        <div>
                            <div class="tm-card-top">
                                <div class="tm-card-stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                                <span class="tm-cat-tag chef">Food Consultant</span>
                            </div>
                            <p class="tm-card-quote">
                                What sets SG Foodees apart is the synergy between raw material suppliers, food technologists, and machinery innovators. You leave the expo with actionable ideas and the exact partners to scale your food enterprise.
                            </p>
                        </div>
                        <div class="tm-card-author">
                            <img src="<?= SITE_URL ?>assets/images/team/team-3.jpg" alt="Dr. Alok Srivastava" class="tm-author-img">
                            <div class="tm-author-meta">
                                <h5>Dr. Alok Srivastava <i class="fa-solid fa-circle-check tm-verified-check" title="Verified Attendee"></i></h5>
                                <p>Chief Consultant, <span class="tm-author-company">FoodTech Innovations</span></p>
                                <p><small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>Indore, Madhya Pradesh</small></p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 6. Video Testimonials Section -->
                <div class="tm-video-sec" data-category="video">
                    <div class="row align-items-end mb-4">
                        <div class="col-lg-8">
                            <span class="tm-subbadge"><i class="fa-solid fa-circle-play"></i> Watch Real Experiences</span>
                            <h3 class="mb-2" style="font-family: 'Noto Serif', serif; font-size: 28px; font-weight: 700;">
                                Video Stories from the <span>Exhibition Floor</span>
                            </h3>
                            <p class="text-muted mb-0">Hear directly from exhibitors, stall visitors, and commercial bakers at the venue.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                            <a href="<?= SITE_URL ?>contact" class="tm-btn-primary">
                                <i class="fa-solid fa-calendar-check"></i> Book Stall for Next Edition
                            </a>
                        </div>
                    </div>

                    <div class="tm-video-grid">

                        <!-- Video Card 1 -->
                        <div class="tm-video-card" onclick="openVideoModal('https://www.youtube.com/embed/dQw4w9WgXcQ', 'Leading Bakery Equipment Manufacturer Feedback')">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-3.jpg" alt="Video thumbnail" class="tm-video-thumb">
                            <div class="tm-video-overlay">
                                <span class="tm-video-duration"><i class="fa-solid fa-clock me-1"></i> 2:45 min</span>
                                <div class="tm-play-btn"><i class="fa-solid fa-play"></i></div>
                                <div class="tm-video-info">
                                    <h6>Kavita Agarwal</h6>
                                    <p>Director, Premium Flours & Mixes</p>
                                </div>
                            </div>
                        </div>

                        <!-- Video Card 2 -->
                        <div class="tm-video-card" onclick="openVideoModal('https://www.youtube.com/embed/dQw4w9WgXcQ', 'SME Food Processor Scaling Story')">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-6.jpg" alt="Video thumbnail" class="tm-video-thumb">
                            <div class="tm-video-overlay">
                                <span class="tm-video-duration"><i class="fa-solid fa-clock me-1"></i> 3:10 min</span>
                                <div class="tm-play-btn"><i class="fa-solid fa-play"></i></div>
                                <div class="tm-video-info">
                                    <h6>Manish Kulkarni</h6>
                                    <p>Founder, Kulkarni Sweets & Savouries</p>
                                </div>
                            </div>
                        </div>

                        <!-- Video Card 3 -->
                        <div class="tm-video-card" onclick="openVideoModal('https://www.youtube.com/embed/dQw4w9WgXcQ', 'International Trade Buyer Experience')">
                            <img src="<?= SITE_URL ?>assets/images/resource/testimonial-7.jpg" alt="Video thumbnail" class="tm-video-thumb">
                            <div class="tm-video-overlay">
                                <span class="tm-video-duration"><i class="fa-solid fa-clock me-1"></i> 1:55 min</span>
                                <div class="tm-play-btn"><i class="fa-solid fa-play"></i></div>
                                <div class="tm-video-info">
                                    <h6>Tariq Al-Mansoor</h6>
                                    <p>Import Director, Gulf Food Distribution</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 7. Call To Action Banner -->
                <div class="tm-cta-card">
                    <div class="row align-items-center">
                        <div class="col-lg-8 tm-cta-content">
                            <h3>Have You Exhibited or Visited SG Foodees?</h3>
                            <p>
                                Your feedback shapes the future of India's premier Food & Bakery networking platform. Share your feedback, business wins, or story with our community.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0 d-flex gap-3 justify-content-lg-end tm-cta-btns flex-wrap">
                            <button type="button" class="tm-btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fa-solid fa-pen-to-square"></i> Submit Review
                            </button>
                            <a href="<?= SITE_URL ?>exhibit" class="tm-btn-secondary">
                                <i class="fa-solid fa-store"></i> Exhibit With Us
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Submit Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 16px; overflow: hidden; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                    <div class="modal-header tm-modal-header">
                        <div>
                            <h5 class="modal-title text-white fw-bold" id="reviewModalLabel">Share Your Experience</h5>
                            <small class="text-white-50">Tell us how SG Foodees helped your business grow</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="reviewSubmissionForm" onsubmit="handleReviewSubmit(event)">
                            <div class="mb-3 text-center">
                                <label class="form-label d-block fw-semibold mb-1">Your Overall Rating</label>
                                <div class="tm-star-picker justify-content-center" id="starPicker">
                                    <i class="fa-solid fa-star selected" data-value="1"></i>
                                    <i class="fa-solid fa-star selected" data-value="2"></i>
                                    <i class="fa-solid fa-star selected" data-value="3"></i>
                                    <i class="fa-solid fa-star selected" data-value="4"></i>
                                    <i class="fa-solid fa-star selected" data-value="5"></i>
                                </div>
                                <input type="hidden" name="rating" id="reviewRatingInput" value="5">
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Your Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="e.g. Ramesh Kumar" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Email Address *</label>
                                    <input type="email" class="form-control" name="email" placeholder="name@company.com" required>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Company / Brand *</label>
                                    <input type="text" class="form-control" name="company" placeholder="e.g. Royal Bakers" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Designation *</label>
                                    <input type="text" class="form-control" name="designation" placeholder="e.g. Owner / MD" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Participant Role *</label>
                                <select class="form-select" name="role" required>
                                    <option value="Exhibitor">Exhibitor (Stall Owner)</option>
                                    <option value="Trade Buyer">Trade Buyer / Distributor</option>
                                    <option value="Master Baker">Chef / Master Baker</option>
                                    <option value="Visitor">General Trade Visitor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Your Feedback / Review *</label>
                                <textarea class="form-control" name="feedback" rows="4" placeholder="Share your experience regarding footfall, networking, organization, and leads..." required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="tm-btn-primary justify-content-center py-3">
                                    <i class="fa-solid fa-paper-plane"></i> Submit Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Player Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark text-white" style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                    <div class="modal-header border-0 pb-0">
                        <h6 class="modal-title" id="videoModalTitle">Video Testimonial</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="closeVideoModal()"></button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoIframe" src="" title="Video Player" allowfullscreen allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('inc/footer.php'); ?>
        <!-- Footer end -->

    </div>

    <!-- Interactive Scripts for Filtering, Video Modal, and Form Handling -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Dynamic Filter Tabs
        const filterButtons = document.querySelectorAll('#testimonialFilterNav .tm-filter-btn');
        const testimonialCards = document.querySelectorAll('#testimonialGrid .tm-card');
        const spotlightCard = document.querySelector('.tm-spotlight-card');
        const videoSection = document.querySelector('.tm-video-sec');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                // Filter grid cards
                testimonialCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'flex';
                        card.style.animation = 'fadeIn 0.4s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide spotlight
                if (spotlightCard) {
                    if (filter === 'all' || filter === 'exhibitor') {
                        spotlightCard.style.display = 'block';
                    } else {
                        spotlightCard.style.display = 'none';
                    }
                }

                // Show/hide video section
                if (videoSection) {
                    if (filter === 'all' || filter === 'video') {
                        videoSection.style.display = 'block';
                    } else {
                        videoSection.style.display = 'none';
                    }
                }
            });
        });

        // 2. Interactive Star Rating Picker in Modal
        const starIcons = document.querySelectorAll('#starPicker i');
        const ratingInput = document.getElementById('reviewRatingInput');

        starIcons.forEach(star => {
            star.addEventListener('click', function () {
                const val = parseInt(this.getAttribute('data-value'), 10);
                ratingInput.value = val;
                starIcons.forEach(s => {
                    const sVal = parseInt(s.getAttribute('data-value'), 10);
                    if (sVal <= val) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
            });
        });
    });

    // 3. Video Modal Trigger
    function openVideoModal(url, title) {
        const modal = new bootstrap.Modal(document.getElementById('videoModal'));
        document.getElementById('videoIframe').src = url + "?autoplay=1";
        document.getElementById('videoModalTitle').innerText = title || "Video Testimonial";
        modal.show();
    }

    function closeVideoModal() {
        document.getElementById('videoIframe').src = "";
    }

    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        closeVideoModal();
    });

    // 4. Client-side Form Confirmation
    function handleReviewSubmit(e) {
        e.preventDefault();
        const form = document.getElementById('reviewSubmissionForm');
        form.innerHTML = `
            <div class="text-center py-4">
                <div style="font-size: 50px; color: #2b8a3e; margin-bottom: 15px;">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <h4 class="fw-bold mb-2">Thank You for Your Feedback!</h4>
                <p class="text-muted">Your review has been successfully received and will appear on the website after editorial verification.</p>
                <button type="button" class="tm-btn-primary mt-3" data-bs-dismiss="modal">Close</button>
            </div>
        `;
    }
    </script>
</body>
</html>
