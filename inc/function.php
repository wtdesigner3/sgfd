<?php
// session_start();
$serverHost = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');

if (file_exists(__DIR__ . '/config.local.php')) {
    require_once __DIR__ . '/config.local.php';
} elseif ($serverHost === "localhost" || strpos($serverHost, '127.0.0.1') !== false) {
    $hostname = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "sabi_db";
    @define('SITE_NAME', 'sgfoodees');
    @define('SITE_EMAIL', 'foodees.drgupta@gmail.com');
    @define('SITE_URL', 'http://localhost/sgfoodees/');
} elseif (strpos($serverHost, 'seotycoons.in') !== false) {
    $hostname = getenv('DB_HOST') ?: "localhost";
    $dbusername = getenv('DB_USER') ?: "seotycoo_sgfduser";
    $dbpassword = getenv('DB_PASS') ?: "Nk8suGDVsmJU";
    $dbname = getenv('DB_NAME') ?: "seotycoo_sgfd";
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    @define('SITE_NAME', 'sgfoodees Dev');
    @define('SITE_EMAIL', 'foodees.drgupta@gmail.com');
    @define('SITE_URL', $protocol . 'seotycoons.in/sgdev/');
} else {
    $hostname = getenv('DB_HOST') ?: "localhost";
    $dbusername = getenv('DB_USER') ?: "sgfoo1e6_food_user";
    $dbpassword = getenv('DB_PASS') ?: "~@gy7ejsTcjg";
    $dbname = getenv('DB_NAME') ?: "sgfoo1e6_food_db";
    @define('SITE_NAME', 'Bakery Expro 2026');
    @define('SITE_EMAIL', 'foodees.drgupta@gmail.com');
    @define('SITE_URL', 'https://sgfoodees.in/');
}

// Auto-deployment self-extractor: unpacks deploy.zip when uploaded by CI/CD
$deployZipFile = dirname(__DIR__) . '/deploy.zip';
if (file_exists($deployZipFile) && class_exists('ZipArchive')) {
    $zipArchive = new ZipArchive();
    if ($zipArchive->open($deployZipFile) === true) {
        @set_time_limit(300);
        @ini_set('memory_limit', '512M');
        $zipArchive->extractTo(dirname(__DIR__));
        $zipArchive->close();
        @unlink($deployZipFile);
        @unlink(dirname(__DIR__) . '/.deploy_token');
        @unlink(dirname(__DIR__) . '/deploy_unpacker.php');
    }
}

$conn = mysqli_connect($hostname, $dbusername, $dbpassword,$dbname);

if (!$conn) {
    error_log("Database connection error: " . mysqli_connect_error());
    if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] === "localhost") {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        die("A temporary database connection error occurred. Please try again later.");
    }
}

$contact = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_contact` WHERE `con_id` = '1'"));
$profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_profile` WHERE `pro_id` = '1'"));

?>