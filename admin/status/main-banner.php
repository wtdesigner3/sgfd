<?php
require_once(__DIR__ . '/../checksession.php');
require('../../inc/function.php');
$qs = intval($_REQUEST['id'] ?? 0);
$data = mysqli_query($conn, "SELECT * FROM `tbl_main_banner` WHERE `id`='$qs'");
$rec = mysqli_fetch_array($data);
if ($rec) {
    if ($rec['status'] == 0) {
        mysqli_query($conn, "UPDATE `tbl_main_banner` SET `status`='1' WHERE `id`='$qs'");
    } else {
        mysqli_query($conn, "UPDATE `tbl_main_banner` SET `status`='0' WHERE `id`='$qs'");
    }
}
?>
