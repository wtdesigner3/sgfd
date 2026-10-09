<?php
// Smart Page Header Component for SG Foodees
// Inspired by WMNC modern editorial exhibition hero style

$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

// Defaults & Page Content Mapping
$headers_data = [
    'introduction' => [
        'breadcrumb' => 'Introduction',
        'eyebrow' => '5th Global Food & Bakery Expo 2027',
        'title' => 'The Epicentre of Food & Bakery Innovation in India',
        'lead' => 'Connecting 50,000+ industry buyers, 500+ global brands, food technologists and bakery leaders under one prestigious roof — 15–17 July 2027, India Expo Centre & Mart, Greater Noida.',
        'primary_btn' => ['text' => 'Book Exhibition Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bnr_id' => '8'
    ],
    'exhibit' => [
        'breadcrumb' => 'Exhibit',
        'eyebrow' => 'For Exhibitors',
        'title' => 'Put your brand in front of the whole industry',
        'lead' => 'Three days, 50,000+ trade visitors and 500+ exhibitors across the food, bakery, confectionery and allied value chain — 15–17 July 2027.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bnr_id' => '9'
    ],
    'visit' => [
        'breadcrumb' => 'Visitor Profile',
        'eyebrow' => 'For Trade Visitors',
        'title' => 'Discover the future of food, bakery & confectionery',
        'lead' => 'Explore cutting-edge processing machinery, innovative ingredients, packaging solutions and live masterclasses — 15–17 July 2027, India Expo Centre & Mart.',
        'primary_btn' => ['text' => 'Get Free Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'bnr_id' => '10'
    ],
    'contact' => [
        'breadcrumb' => 'Contact Us',
        'eyebrow' => 'Reach Our Team',
        'title' => 'Let’s connect & build lasting business partnerships',
        'lead' => 'Have questions about stall bookings, visitor registration, sponsorship or media partnerships? Our dedicated team is here to assist you.',
        'primary_btn' => ['text' => 'Send Enquiry', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bnr_id' => '12'
    ],
    'blogs' => [
        'breadcrumb' => 'Blogs',
        'eyebrow' => 'Industry Insights',
        'title' => 'Trends, innovations & exhibition updates',
        'lead' => 'Stay ahead with the latest food and bakery industry trends, market intelligence, technological innovations, and event news.',
        'primary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'bnr_id' => '6'
    ],
    'resources' => [
        'breadcrumb' => 'Resources',
        'eyebrow' => 'Exhibition Essentials',
        'title' => 'Resources, guidelines & event documentation',
        'lead' => 'Everything you need for successful participation — exhibitor guidelines, stall layouts, visitor manuals, and media kits.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bnr_id' => '11'
    ],
    'blog-detail' => [
        'breadcrumb' => 'Blog Detail',
        'eyebrow' => 'Article & Insights',
        'title' => !empty($blogDetail['b_title']) ? $blogDetail['b_title'] : (!empty($blogDetail['title']) ? $blogDetail['title'] : 'Industry Insights & Updates'),
        'lead' => 'Read expert analysis, industry trends, and latest innovations shaping the food and bakery sector.',
        'primary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'bnr_id' => '6'
    ],
    'spices-exhibition-services-in-india' => [
        'breadcrumb' => 'Spices Exhibition Services',
        'eyebrow' => 'Exhibition Services',
        'title' => 'Premier Spices Exhibition & Stall Services in India',
        'lead' => 'Comprehensive stall design, fabrication, logistics, and digital branding solutions for spices and food expos across India.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bnr_id' => '8'
    ]
];

// Determine data for this page or allow overrides
$page_data = $headers_data[$currentPage] ?? [
    'breadcrumb' => ucfirst(str_replace('-', ' ', $currentPage)),
    'eyebrow' => '5th Global Food & Bakery Expo 2027',
    'title' => ucfirst(str_replace('-', ' ', $currentPage)),
    'lead' => '15 - 16 - 17 July 2027 • India Expo Centre & Mart, Greater Noida, UP.',
    'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
    'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
    'bnr_id' => '8'
];

// Allow page-specific variables to override
if (isset($header_title) && !empty($header_title)) $page_data['title'] = $header_title;
if (isset($header_eyebrow) && !empty($header_eyebrow)) $page_data['eyebrow'] = $header_eyebrow;
if (isset($header_breadcrumb) && !empty($header_breadcrumb)) $page_data['breadcrumb'] = $header_breadcrumb;
if (isset($breadCrumb['brd_name']) && !empty($breadCrumb['brd_name'])) {
    $page_data['title'] = $breadCrumb['brd_name'];
    $page_data['breadcrumb'] = $breadCrumb['brd_name'];
}

// Resolve Background Image
$bg_image_url = SITE_URL . 'assets/img/introd-bg.jpg';
if (isset($header_bg_image) && !empty($header_bg_image)) {
    $bg_image_url = $header_bg_image;
} elseif (isset($banner_cont['bnr_image']) && !empty($banner_cont['bnr_image'])) {
    $bg_image_url = SITE_URL . 'uploads/banner/' . $banner_cont['bnr_image'];
} elseif (isset($breadCrumb['brd_image']) && !empty($breadCrumb['brd_image'])) {
    $bg_image_url = SITE_URL . 'uploads/breadcrumb/' . $breadCrumb['brd_image'];
} elseif (isset($blogDetail['broad_image']) && !empty($blogDetail['broad_image'])) {
    $bg_image_url = SITE_URL . 'uploads/blogs/' . $blogDetail['broad_image'];
} else {
    // Fetch from tbl_banner by bnr_id
    $bnr_id = $page_data['bnr_id'] ?? '8';
    $bnr_q = mysqli_query($conn, "SELECT bnr_image FROM tbl_banner WHERE bnr_id = '$bnr_id' LIMIT 1");
    if ($bnr_q && mysqli_num_rows($bnr_q) > 0) {
        $bnr_row = mysqli_fetch_assoc($bnr_q);
        if (!empty($bnr_row['bnr_image'])) {
            $bg_image_url = SITE_URL . 'uploads/banner/' . $bnr_row['bnr_image'];
        }
    }
}

// Resolve Logo
$logo_img_url = SITE_URL . 'assets/img/fg-logo.png';
if (isset($header_logo_image) && !empty($header_logo_image)) {
    $logo_img_url = $header_logo_image;
} elseif (isset($banner_cont['bnr_logo']) && !empty($banner_cont['bnr_logo'])) {
    $logo_img_url = SITE_URL . 'uploads/banner/' . $banner_cont['bnr_logo'];
} elseif (isset($breadCrumb['brd_logo']) && !empty($breadCrumb['brd_logo'])) {
    $logo_img_url = SITE_URL . 'uploads/breadcrumb/' . $breadCrumb['brd_logo'];
}
?>

<!-- Page Header (Editorial Hero) -->
<section class="wmnc-page-header">
    <div class="wmnc-header-bg" style="background-image: url('<?= $bg_image_url ?>');"></div>
    <div class="wmnc-header-overlay"></div>
    <div class="auto-container position-relative" style="z-index: 5;">
        <div class="wmnc-header-content">
            <!-- Breadcrumb -->
            <nav aria-label="Breadcrumb" class="wmnc-breadcrumb">
                <ol>
                    <li><a href="<?= SITE_URL ?>">Home</a></li>
                    <li class="separator">/</li>
                    <li class="active"><?= htmlspecialchars($page_data['breadcrumb']) ?></li>
                </ol>
            </nav>

            <!-- Eyebrow Tag with Gradient Line -->
            <div class="wmnc-eyebrow">
                <span class="wmnc-eyebrow-bar"></span>
                <span class="wmnc-eyebrow-text"><?= htmlspecialchars($page_data['eyebrow']) ?></span>
            </div>

            <!-- Main Headline -->
            <h1 class="wmnc-headline"><?= $page_data['title'] ?></h1>

            <!-- Lead Paragraph -->
            <p class="wmnc-lead"><?= htmlspecialchars($page_data['lead']) ?></p>

            <!-- Actions Row & Organizer Endorsement -->
            <div class="wmnc-actions-row">
                <div class="wmnc-btn-group">
                    <a href="#" data-bs-toggle="modal" data-bs-target="<?= $page_data['primary_btn']['modal'] ?>" class="wmnc-btn-primary">
                        <span><?= $page_data['primary_btn']['text'] ?></span>
                        <i class="fa-solid <?= $page_data['primary_btn']['icon'] ?>"></i>
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="<?= $page_data['secondary_btn']['modal'] ?>" class="wmnc-btn-secondary">
                        <span><?= $page_data['secondary_btn']['text'] ?></span>
                        <i class="fa-solid <?= $page_data['secondary_btn']['icon'] ?>"></i>
                    </a>
                </div>

                <div class="wmnc-organizer-pill">
                    <span class="wmnc-organizer-label">Organised by</span>
                    <img src="<?= $logo_img_url ?>" alt="Foodees Group" class="wmnc-organizer-img">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Page Header -->
