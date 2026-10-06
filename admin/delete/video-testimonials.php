<?php
require_once(__DIR__ . '/../checksession.php');
require_once(__DIR__ . '/../../inc/function.php');

$b = intval($_REQUEST['bid'] ?? 0);
$data = mysqli_query($conn, "DELETE FROM `tbl_video_testimonia` WHERE `id`='$b'");
if ($data) {
    $_SESSION['warning'] = 'Video Testimonial deleted successfully';
    header('location:../manage-video-testimonials.php');
    exit();
}
?>
