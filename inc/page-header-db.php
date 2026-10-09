<?php
// Page Header Database Helper & Auto-Migration
// Ensures tbl_page_headers exists and is properly seeded on local, dev, or live environments.

if (!function_exists('ensure_page_headers_table')) {
    function ensure_page_headers_table($conn) {
        static $checked = false;
        if ($checked || !$conn) {
            return;
        }

        $createTableSql = "CREATE TABLE IF NOT EXISTS `tbl_page_headers` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `page_slug` varchar(100) NOT NULL,
            `page_name` varchar(150) NOT NULL,
            `breadcrumb` varchar(150) DEFAULT NULL,
            `eyebrow` varchar(200) DEFAULT NULL,
            `title` text DEFAULT NULL,
            `lead_text` text DEFAULT NULL,
            `show_primary_btn` tinyint(1) NOT NULL DEFAULT 1,
            `primary_btn_text` varchar(100) DEFAULT 'Book a Stall',
            `primary_btn_modal` varchar(100) DEFAULT '#contactModal',
            `primary_btn_icon` varchar(50) DEFAULT 'fa-arrow-right',
            `show_secondary_btn` tinyint(1) NOT NULL DEFAULT 1,
            `secondary_btn_text` varchar(100) DEFAULT 'Get Visitor Pass',
            `secondary_btn_modal` varchar(100) DEFAULT '#myModal',
            `secondary_btn_icon` varchar(50) DEFAULT 'fa-download',
            `bg_image` varchar(255) DEFAULT NULL,
            `status` tinyint(1) NOT NULL DEFAULT 1,
            `sort_order` int(11) NOT NULL DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uk_page_slug` (`page_slug`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        mysqli_query($conn, $createTableSql);

        // Auto-migrate new button visibility columns if table existed prior
        $colCheck = mysqli_query($conn, "SHOW COLUMNS FROM `tbl_page_headers` LIKE 'show_primary_btn'");
        if ($colCheck && mysqli_num_rows($colCheck) === 0) {
            @mysqli_query($conn, "ALTER TABLE `tbl_page_headers` ADD COLUMN `show_primary_btn` TINYINT(1) NOT NULL DEFAULT 1 AFTER `lead_text`");
        }
        $colCheck2 = mysqli_query($conn, "SHOW COLUMNS FROM `tbl_page_headers` LIKE 'show_secondary_btn'");
        if ($colCheck2 && mysqli_num_rows($colCheck2) === 0) {
            @mysqli_query($conn, "ALTER TABLE `tbl_page_headers` ADD COLUMN `show_secondary_btn` TINYINT(1) NOT NULL DEFAULT 1 AFTER `primary_btn_icon`");
        }
        $colCheck3 = mysqli_query($conn, "SHOW COLUMNS FROM `tbl_page_headers` LIKE 'divider_style'");
        if ($colCheck3 && mysqli_num_rows($colCheck3) === 0) {
            @mysqli_query($conn, "ALTER TABLE `tbl_page_headers` ADD COLUMN `divider_style` VARCHAR(50) NOT NULL DEFAULT 'simple' AFTER `bg_image`");
        }

        // Check if records already exist
        $checkQ = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM `tbl_page_headers`");
        $rowCount = 0;
        if ($checkQ) {
            $row = mysqli_fetch_assoc($checkQ);
            $rowCount = (int)($row['cnt'] ?? 0);
        }

        if ($rowCount === 0) {
            $defaults = [
                [
                    'page_slug' => 'introduction',
                    'page_name' => 'Introduction',
                    'breadcrumb' => 'Introduction',
                    'eyebrow' => 'Official Expo Overview',
                    'title' => 'Elevating India’s <span class="sg-title-accent">Food & Bakery Ecosystem</span>',
                    'lead_text' => 'The 5th Global Food & Bakery Expo brings together food technologists, commercial bakers, snack manufacturers, and packaging pioneers under one prestigious roof.',
                    'primary_btn_text' => 'Book Exhibition Stall',
                    'primary_btn_modal' => '#contactModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Get Visitor Pass',
                    'secondary_btn_modal' => '#myModal',
                    'secondary_btn_icon' => 'fa-download',
                    'bg_image' => '1739943873_introd-bg.jpg',
                    'sort_order' => 1
                ],
                [
                    'page_slug' => 'exhibit',
                    'page_name' => 'Exhibit',
                    'breadcrumb' => 'Exhibit',
                    'eyebrow' => 'Exhibitor Opportunities',
                    'title' => 'Accelerate Your Growth at <span class="sg-title-accent">India’s Premier Food Expo</span>',
                    'lead_text' => 'Showcase your machinery, ingredients, and processing solutions directly to 50,000+ trade buyers, distributors, and modern retail decision-makers.',
                    'primary_btn_text' => 'Book a Stall',
                    'primary_btn_modal' => '#contactModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Get Visitor Pass',
                    'secondary_btn_modal' => '#myModal',
                    'secondary_btn_icon' => 'fa-download',
                    'bg_image' => '1739957443_introd-bg.jpg',
                    'sort_order' => 2
                ],
                [
                    'page_slug' => 'visit',
                    'page_name' => 'Visitor Profile',
                    'breadcrumb' => 'Visitor Profile',
                    'eyebrow' => 'Trade Visitor Guide',
                    'title' => 'Source Next-Gen Machinery & <span class="sg-title-accent">Innovative Ingredients</span>',
                    'lead_text' => 'Discover live baking demonstrations, cutting-edge packaging tech, and connect with 500+ leading manufacturers from across India and abroad.',
                    'primary_btn_text' => 'Get Free Visitor Pass',
                    'primary_btn_modal' => '#myModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Book a Stall',
                    'secondary_btn_modal' => '#contactModal',
                    'secondary_btn_icon' => 'fa-arrow-down',
                    'bg_image' => '1740035713_introd-bg.jpg',
                    'sort_order' => 3
                ],
                [
                    'page_slug' => 'contact',
                    'page_name' => 'Contact Us',
                    'breadcrumb' => 'Contact Us',
                    'eyebrow' => 'Direct Secretariat',
                    'title' => 'Partner With Us for <span class="sg-title-accent">Unmatched Industry Reach</span>',
                    'lead_text' => 'Connect with our exhibition management team for booth allocations, sponsorship inquiries, delegation visits, and media collaborations.',
                    'primary_btn_text' => 'Send Enquiry',
                    'primary_btn_modal' => '#contactModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Get Visitor Pass',
                    'secondary_btn_modal' => '#myModal',
                    'secondary_btn_icon' => 'fa-download',
                    'bg_image' => '1763193435_Beige and Orange Traditional Illustrative Dahi Handi Instagram Post (11).jpg',
                    'sort_order' => 4
                ],
                [
                    'page_slug' => 'blogs',
                    'page_name' => 'Blogs',
                    'breadcrumb' => 'Blogs',
                    'eyebrow' => 'Industry Knowledge',
                    'title' => 'Market Intelligence & <span class="sg-title-accent">Culinary Innovations</span>',
                    'lead_text' => 'Stay ahead of rapidly evolving consumer tastes, processing breakthroughs, and supply chain trends with our curated editorial analysis.',
                    'primary_btn_text' => 'Get Visitor Pass',
                    'primary_btn_modal' => '#myModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Book a Stall',
                    'secondary_btn_modal' => '#contactModal',
                    'secondary_btn_icon' => 'fa-arrow-down',
                    'bg_image' => '1772082757_bg.jpg',
                    'sort_order' => 5
                ],
                [
                    'page_slug' => 'resources',
                    'page_name' => 'Resources',
                    'breadcrumb' => 'Resources',
                    'eyebrow' => 'Exhibition Toolkit',
                    'title' => 'Exhibitor Essentials & <span class="sg-title-accent">Official Expo Manual</span>',
                    'lead_text' => 'Download comprehensive technical specifications, stall layout drawings, vendor guidelines, and visitor directories for seamless participation.',
                    'primary_btn_text' => 'Book a Stall',
                    'primary_btn_modal' => '#contactModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Get Visitor Pass',
                    'secondary_btn_modal' => '#myModal',
                    'secondary_btn_icon' => 'fa-download',
                    'bg_image' => '1763193553_WhatsApp Image 2025-11-01 at 12.09.04 PM.jpeg',
                    'sort_order' => 6
                ],
                [
                    'page_slug' => 'spices-exhibition-services-in-india',
                    'page_name' => 'Spices Exhibition Services',
                    'breadcrumb' => 'Spices Exhibition Services',
                    'eyebrow' => 'Turnkey Solutions',
                    'title' => 'Premier Spices Exhibition & <span class="sg-title-accent">Stall Fabrications</span>',
                    'lead_text' => 'Bespoke stall architecture, international-standard fabrication, and complete turnkey booth management for spices and seasoning brands.',
                    'primary_btn_text' => 'Book a Stall',
                    'primary_btn_modal' => '#contactModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Get Visitor Pass',
                    'secondary_btn_modal' => '#myModal',
                    'secondary_btn_icon' => 'fa-download',
                    'bg_image' => '1739943873_introd-bg.jpg',
                    'sort_order' => 7
                ],
                [
                    'page_slug' => 'blog-detail',
                    'page_name' => 'Blog Detail (Default)',
                    'breadcrumb' => 'Blog Detail',
                    'eyebrow' => 'Special Feature',
                    'title' => 'Industry Insights & Updates',
                    'lead_text' => 'In-depth editorial feature exploring key developments, market trends, and innovations across the food and confectionery spectrum.',
                    'primary_btn_text' => 'Get Visitor Pass',
                    'primary_btn_modal' => '#myModal',
                    'primary_btn_icon' => 'fa-arrow-right',
                    'secondary_btn_text' => 'Book a Stall',
                    'secondary_btn_modal' => '#contactModal',
                    'secondary_btn_icon' => 'fa-arrow-down',
                    'bg_image' => '1772082757_bg.jpg',
                    'sort_order' => 8
                ]
            ];

            foreach ($defaults as $item) {
                $slug = mysqli_real_escape_string($conn, $item['page_slug']);
                $name = mysqli_real_escape_string($conn, $item['page_name']);
                $bc = mysqli_real_escape_string($conn, $item['breadcrumb']);
                $eye = mysqli_real_escape_string($conn, $item['eyebrow']);
                $title = mysqli_real_escape_string($conn, $item['title']);
                $lead = mysqli_real_escape_string($conn, $item['lead_text']);
                $pbText = mysqli_real_escape_string($conn, $item['primary_btn_text']);
                $pbModal = mysqli_real_escape_string($conn, $item['primary_btn_modal']);
                $pbIcon = mysqli_real_escape_string($conn, $item['primary_btn_icon']);
                $sbText = mysqli_real_escape_string($conn, $item['secondary_btn_text']);
                $sbModal = mysqli_real_escape_string($conn, $item['secondary_btn_modal']);
                $sbIcon = mysqli_real_escape_string($conn, $item['secondary_btn_icon']);
                $bg = mysqli_real_escape_string($conn, $item['bg_image']);
                $sort = (int)$item['sort_order'];

                $insertSql = "INSERT INTO `tbl_page_headers` 
                    (`page_slug`, `page_name`, `breadcrumb`, `eyebrow`, `title`, `lead_text`, `primary_btn_text`, `primary_btn_modal`, `primary_btn_icon`, `secondary_btn_text`, `secondary_btn_modal`, `secondary_btn_icon`, `bg_image`, `sort_order`, `status`)
                    VALUES 
                    ('$slug', '$name', '$bc', '$eye', '$title', '$lead', '$pbText', '$pbModal', '$pbIcon', '$sbText', '$sbModal', '$sbIcon', '$bg', $sort, 1)
                    ON DUPLICATE KEY UPDATE `page_name`=VALUES(`page_name`);";
                mysqli_query($conn, $insertSql);
            }
        }

        $checked = true;
    }
}

if (!function_exists('get_page_header_record')) {
    function get_page_header_record($conn, $slug) {
        if (!$conn || empty($slug)) {
            return null;
        }
        ensure_page_headers_table($conn);
        $escapedSlug = mysqli_real_escape_string($conn, $slug);
        $res = mysqli_query($conn, "SELECT * FROM `tbl_page_headers` WHERE `page_slug` = '$escapedSlug' AND `status` = 1 LIMIT 1");
        if ($res && mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        }
        return null;
    }
}

if (!function_exists('resolve_header_bg_image_url')) {
    function resolve_header_bg_image_url($imageName, $siteUrl = '') {
        if (empty($imageName)) {
            return $siteUrl . 'assets/img/introd-bg.jpg';
        }
        if (strpos($imageName, 'http://') === 0 || strpos($imageName, 'https://') === 0) {
            return $imageName;
        }
        $root = dirname(__DIR__);
        if (file_exists($root . '/uploads/headers/' . $imageName)) {
            return $siteUrl . 'uploads/headers/' . $imageName;
        }
        if (file_exists($root . '/uploads/banner/' . $imageName)) {
            return $siteUrl . 'uploads/banner/' . $imageName;
        }
        if (file_exists($root . '/uploads/breadcrumb/' . $imageName)) {
            return $siteUrl . 'uploads/breadcrumb/' . $imageName;
        }
        if (file_exists($root . '/assets/img/' . $imageName)) {
            return $siteUrl . 'assets/img/' . $imageName;
        }
        return $siteUrl . 'assets/img/introd-bg.jpg';
    }
}

if (!function_exists('resolve_header_bg_image_path_for_admin')) {
    function resolve_header_bg_image_path_for_admin($imageName) {
        if (empty($imageName)) {
            return '../assets/img/introd-bg.jpg';
        }
        if (file_exists('../uploads/headers/' . $imageName)) {
            return '../uploads/headers/' . $imageName;
        }
        if (file_exists('../uploads/banner/' . $imageName)) {
            return '../uploads/banner/' . $imageName;
        }
        if (file_exists('../uploads/breadcrumb/' . $imageName)) {
            return '../uploads/breadcrumb/' . $imageName;
        }
        if (file_exists('../assets/img/' . $imageName)) {
            return '../assets/img/' . $imageName;
        }
        return '../assets/img/introd-bg.jpg';
    }
}

