<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST['bid'] ?? 0);
$banner = mysqli_query($conn, "SELECT * FROM `tbl_main_banner` WHERE `id`='$b'");
$bannerData = mysqli_fetch_assoc($banner);
if (!empty($bannerData['main_image'])) {
    @unlink('../../uploads/breadcrumb/' . basename($bannerData['main_image']));
}
$data = mysqli_query($conn, "DELETE FROM `tbl_main_banner` WHERE `id`='$b'");
if ($data) {
    $_SESSION['warning'] = 'Banner Deleted successfully';
    header('location:../manage-main-banner.php');
    exit();
}
?>
