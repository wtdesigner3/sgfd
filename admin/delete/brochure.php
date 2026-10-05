<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST["bid"] ?? 0);

$banner = mysqli_query($conn, "SELECT * FROM `tbl_brochure` WHERE `id`='$b'");
$bannerData = mysqli_fetch_assoc($banner);

if ($bannerData) {
    if (!empty($bannerData["image"]) && file_exists("../../uploads/brochure/" . $bannerData["image"])) {
        @unlink("../../uploads/brochure/" . $bannerData["image"]);
    }
    if (!empty($bannerData["pdf_url"]) && !preg_match('/^https?:\/\//i', $bannerData["pdf_url"]) && file_exists("../../uploads/brochure/" . $bannerData["pdf_url"])) {
        @unlink("../../uploads/brochure/" . $bannerData["pdf_url"]);
    }
}

$data = mysqli_query($conn, "DELETE FROM `tbl_brochure` WHERE `id`='$b'");
if ($data == true) {
    $_SESSION['warning'] = "Brochure Deleted successfully";
    header("location:../manage-brochure.php");
    exit();
}
?>