<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST['bid'] ?? 0);
$banner = mysqli_query($conn, "SELECT * FROM `tbl_video_testimonials` WHERE `id`='$b'");
$bannerData = mysqli_fetch_assoc($banner);
if (!empty($bannerData['bnr_image'])) {
    @unlink('../../uploads/banner/' . basename($bannerData['bnr_image']));
}
$data = mysqli_query($conn, "DELETE FROM `tbl_video_testimonials` WHERE `id`='$b'");
if ($data) {
    $_SESSION['warning'] = 'Video Testimonial Deleted successfully';
    header('location:../manage-video-testimonials.php');
    exit();
}
?>
