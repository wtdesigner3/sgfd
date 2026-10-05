<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$b = intval($_REQUEST['bid'] ?? 0);
$banner = mysqli_query($conn, "SELECT * FROM `tbl_magazine` WHERE `id`='$b'");
$bannerData = mysqli_fetch_assoc($banner);
if (!empty($bannerData['magazine'])) {
    @unlink('../../uploads/magazine/' . basename($bannerData['magazine']));
}
$data = mysqli_query($conn, "DELETE FROM `tbl_magazine` WHERE `id`='$b'");
if ($data) {
    $_SESSION['warning'] = 'Magazine Deleted successfully';
    header('location:../manage-magazine.php');
    exit();
}
?>
