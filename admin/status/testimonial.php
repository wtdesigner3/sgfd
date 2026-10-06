<?php
require_once(__DIR__ . '/../checksession.php');
require_once(__DIR__ . '/../../inc/function.php');

$qs = intval($_REQUEST['id'] ?? 0);
$data = mysqli_query($conn, "SELECT * FROM `tbl_testimonial` WHERE `tt_id`='$qs'");
$rec = mysqli_fetch_array($data);
if ($rec) {
    if ($rec['tt_status'] == 0) {
        mysqli_query($conn, "UPDATE `tbl_testimonial` SET `tt_status`='1' WHERE `tt_id`='$qs'");
        echo "Status activated";
    } else {
        mysqli_query($conn, "UPDATE `tbl_testimonial` SET `tt_status`='0' WHERE `tt_id`='$qs'");
        echo "Status deactivated";
    }
}
?>
