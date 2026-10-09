<?php
// SG Foodees - Bespoke Creative Page Header Component
// Crafted uniquely for 5th Global Food & Bakery Expo 2027

$currentPage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

// Defaults & Page Content Mapping with Original SG Foodees Copy & Gradient Accents
$headers_data = [
    'introduction' => [
        'breadcrumb' => 'Introduction',
        'eyebrow' => 'Official Expo Overview',
        'title' => 'Elevating India’s <span class="sg-title-accent">Food & Bakery Ecosystem</span>',
        'lead' => 'The 5th Global Food & Bakery Expo brings together food technologists, commercial bakers, snack manufacturers, and packaging pioneers under one prestigious roof.',
        'primary_btn' => ['text' => 'Book Exhibition Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'chip_metric' => '50,000+ Trade Buyers',
        'chip_sub' => '500+ Exhibitors',
        'bnr_id' => '8'
    ],
    'exhibit' => [
        'breadcrumb' => 'Exhibit',
        'eyebrow' => 'Exhibitor Opportunities',
        'title' => 'Accelerate Your Growth at <span class="sg-title-accent">India’s Premier Food Expo</span>',
        'lead' => 'Showcase your machinery, ingredients, and processing solutions directly to 50,000+ trade buyers, distributors, and modern retail decision-makers.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'chip_metric' => 'Direct B2B Leads',
        'chip_sub' => 'High-Intent Buyers',
        'bnr_id' => '9'
    ],
    'visit' => [
        'breadcrumb' => 'Visitor Profile',
        'eyebrow' => 'Trade Visitor Guide',
        'title' => 'Source Next-Gen Machinery & <span class="sg-title-accent">Innovative Ingredients</span>',
        'lead' => 'Discover live baking demonstrations, cutting-edge packaging tech, and connect with 500+ leading manufacturers from across India and abroad.',
        'primary_btn' => ['text' => 'Get Free Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'chip_metric' => 'Free Entry Passes',
        'chip_sub' => 'Pre-Register Online',
        'bnr_id' => '10'
    ],
    'contact' => [
        'breadcrumb' => 'Contact Us',
        'eyebrow' => 'Direct Secretariat',
        'title' => 'Partner With Us for <span class="sg-title-accent">Unmatched Industry Reach</span>',
        'lead' => 'Connect with our exhibition management team for booth allocations, sponsorship inquiries, delegation visits, and media collaborations.',
        'primary_btn' => ['text' => 'Send Enquiry', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'chip_metric' => 'Direct Support',
        'chip_sub' => '+91-9811151444',
        'bnr_id' => '12'
    ],
    'blogs' => [
        'breadcrumb' => 'Blogs',
        'eyebrow' => 'Industry Knowledge',
        'title' => 'Market Intelligence & <span class="sg-title-accent">Culinary Innovations</span>',
        'lead' => 'Stay ahead of rapidly evolving consumer tastes, processing breakthroughs, and supply chain trends with our curated editorial analysis.',
        'primary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'chip_metric' => 'Weekly Insights',
        'chip_sub' => 'Expert Analysis',
        'bnr_id' => '6'
    ],
    'resources' => [
        'breadcrumb' => 'Resources',
        'eyebrow' => 'Exhibition Toolkit',
        'title' => 'Exhibitor Essentials & <span class="sg-title-accent">Official Expo Manual</span>',
        'lead' => 'Download comprehensive technical specifications, stall layout drawings, vendor guidelines, and visitor directories for seamless participation.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'chip_metric' => 'Instant Download',
        'chip_sub' => 'Official Guidelines',
        'bnr_id' => '11'
    ],
    'blog-detail' => [
        'breadcrumb' => 'Blog Detail',
        'eyebrow' => 'Special Feature',
        'title' => !empty($blogDetail['b_title']) ? $blogDetail['b_title'] : (!empty($blogDetail['title']) ? $blogDetail['title'] : 'Industry Insights & Updates'),
        'lead' => 'In-depth editorial feature exploring key developments, market trends, and innovations across the food and confectionery spectrum.',
        'primary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-down'],
        'chip_metric' => 'Verified Article',
        'chip_sub' => 'Editorial Team',
        'bnr_id' => '6'
    ],
    'spices-exhibition-services-in-india' => [
        'breadcrumb' => 'Spices Exhibition Services',
        'eyebrow' => 'Turnkey Solutions',
        'title' => 'Premier Spices Exhibition & <span class="sg-title-accent">Stall Fabrications</span>',
        'lead' => 'Bespoke stall architecture, international-standard fabrication, and complete turnkey booth management for spices and seasoning brands.',
        'primary_btn' => ['text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'chip_metric' => 'Turnkey Booths',
        'chip_sub' => 'Pan-India Execution',
        'bnr_id' => '8'
    ]
];

require_once __DIR__ . '/page-header-db.php';

// Try loading header configuration from tbl_page_headers database table
$db_header = get_page_header_record($conn, $currentPage);

if ($db_header) {
    $showPrimary = !isset($db_header['show_primary_btn']) || (int)$db_header['show_primary_btn'] === 1;
    $showSecondary = !isset($db_header['show_secondary_btn']) || (int)$db_header['show_secondary_btn'] === 1;

    $page_data = [
        'breadcrumb' => !empty($db_header['breadcrumb']) ? $db_header['breadcrumb'] : $db_header['page_name'],
        'eyebrow' => !empty($db_header['eyebrow']) ? $db_header['eyebrow'] : '5th Global Food & Bakery Expo 2027',
        'title' => !empty($db_header['title']) ? $db_header['title'] : ucfirst(str_replace('-', ' ', $currentPage)),
        'lead' => $db_header['lead_text'] ?? '',
        'primary_btn' => [
            'show' => $showPrimary,
            'text' => !empty($db_header['primary_btn_text']) ? $db_header['primary_btn_text'] : 'Book a Stall',
            'modal' => !empty($db_header['primary_btn_modal']) ? $db_header['primary_btn_modal'] : '#contactModal',
            'icon' => !empty($db_header['primary_btn_icon']) ? $db_header['primary_btn_icon'] : 'fa-arrow-right'
        ],
        'secondary_btn' => [
            'show' => $showSecondary,
            'text' => !empty($db_header['secondary_btn_text']) ? $db_header['secondary_btn_text'] : 'Get Visitor Pass',
            'modal' => !empty($db_header['secondary_btn_modal']) ? $db_header['secondary_btn_modal'] : '#myModal',
            'icon' => !empty($db_header['secondary_btn_icon']) ? $db_header['secondary_btn_icon'] : 'fa-download'
        ],
        'bg_image' => $db_header['bg_image'] ?? ''
    ];
} else {
    // Fallback to static defaults if DB record not found
    $page_data = $headers_data[$currentPage] ?? [
        'breadcrumb' => ucfirst(str_replace('-', ' ', $currentPage)),
        'eyebrow' => '5th Global Food & Bakery Expo 2027',
        'title' => ucfirst(str_replace('-', ' ', $currentPage)),
        'lead' => '15 - 16 - 17 July 2027 • India Expo Centre & Mart, Greater Noida, UP.',
        'primary_btn' => ['show' => true, 'text' => 'Book a Stall', 'modal' => '#contactModal', 'icon' => 'fa-arrow-right'],
        'secondary_btn' => ['show' => true, 'text' => 'Get Visitor Pass', 'modal' => '#myModal', 'icon' => 'fa-download'],
        'bg_image' => '1739943873_introd-bg.jpg'
    ];
    if (!isset($page_data['primary_btn']['show'])) $page_data['primary_btn']['show'] = true;
    if (!isset($page_data['secondary_btn']['show'])) $page_data['secondary_btn']['show'] = true;
}

// Blog detail dynamic title override
if ($currentPage === 'blog-detail' && !empty($blogDetail['b_title'])) {
    $page_data['title'] = $blogDetail['b_title'];
}

// Allow explicit page-specific variables to override
if (isset($header_title) && !empty($header_title)) $page_data['title'] = $header_title;
if (isset($header_eyebrow) && !empty($header_eyebrow)) $page_data['eyebrow'] = $header_eyebrow;
if (isset($header_lead) && !empty($header_lead)) $page_data['lead'] = $header_lead;
if (isset($header_breadcrumb) && !empty($header_breadcrumb)) $page_data['breadcrumb'] = $header_breadcrumb;

// Resolve Background Image URL
if (isset($header_bg_image) && !empty($header_bg_image)) {
    $bg_image_url = $header_bg_image;
} elseif (isset($blogDetail['broad_image']) && !empty($blogDetail['broad_image'])) {
    $bg_image_url = SITE_URL . 'uploads/blogs/' . $blogDetail['broad_image'];
} elseif (!empty($page_data['bg_image'])) {
    $bg_image_url = resolve_header_bg_image_url($page_data['bg_image'], SITE_URL);
} elseif (isset($banner_cont['bnr_image']) && !empty($banner_cont['bnr_image'])) {
    $bg_image_url = SITE_URL . 'uploads/banner/' . $banner_cont['bnr_image'];
} else {
    $bg_image_url = resolve_header_bg_image_url('', SITE_URL);
}
$dividerStyle = !empty($db_header['divider_style']) ? $db_header['divider_style'] : 'simple';
?>

<!-- Bespoke SG Foodees Page Header -->
<section class="sg-page-header">
    <div class="sg-header-bg" style="background-image: url('<?= $bg_image_url ?>');"></div>
    <div class="sg-header-overlay"></div>
    <div class="sg-header-bottom-fade"></div>

    <div class="auto-container position-relative" style="z-index: 5;">
        <div class="sg-header-content">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="Breadcrumb" class="sg-breadcrumb">
                <ol>
                    <li><a href="<?= SITE_URL ?>"><i class="fa-solid fa-house-chimney"></i> Home</a></li>
                    <li class="crumb-slash">/</li>
                    <li class="crumb-active"><?= htmlspecialchars($page_data['breadcrumb']) ?></li>
                </ol>
            </nav>

            <!-- Summit Edition Ribbon with Live Indicator -->
            <div class="sg-summit-ribbon">
                <span class="sg-live-dot"></span>
                <span class="sg-ribbon-edition">5th Edition • Global Expo</span>
                <span class="sg-ribbon-divider">•</span>
                <span class="sg-ribbon-tag"><?= htmlspecialchars($page_data['eyebrow']) ?></span>
            </div>

            <!-- Main Headline with Gradient Word Accent -->
            <h1 class="sg-headline"><?= $page_data['title'] ?></h1>

            <!-- Lead Paragraph -->
            <p class="sg-lead"><?= htmlspecialchars($page_data['lead']) ?></p>

            <?php
            $hasPrimary = !empty($page_data['primary_btn']['show']) && !empty($page_data['primary_btn']['text']);
            $hasSecondary = !empty($page_data['secondary_btn']['show']) && !empty($page_data['secondary_btn']['text']);
            if ($hasPrimary || $hasSecondary):
            ?>
            <!-- Action Buttons Row -->
            <div class="sg-actions-row">
                <div class="sg-btn-group">
                    <?php if ($hasPrimary): ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="<?= $page_data['primary_btn']['modal'] ?>" class="sg-btn-primary">
                        <span><?= $page_data['primary_btn']['text'] ?></span>
                        <i class="fa-solid <?= $page_data['primary_btn']['icon'] ?>"></i>
                    </a>
                    <?php endif; ?>
                    <?php if ($hasSecondary): ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="<?= $page_data['secondary_btn']['modal'] ?>" class="sg-btn-secondary">
                        <span><?= $page_data['secondary_btn']['text'] ?></span>
                        <i class="fa-solid <?= $page_data['secondary_btn']['icon'] ?>"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Simple Division Section Transition -->
    <?php if ($dividerStyle === 'seamless'): ?>
        <div class="sg-header-divider divider-seamless" aria-hidden="true"></div>
    <?php else: ?>
        <div class="sg-header-divider divider-simple" aria-hidden="true"></div>
    <?php endif; ?>
</section>
<!-- End Bespoke Page Header -->
