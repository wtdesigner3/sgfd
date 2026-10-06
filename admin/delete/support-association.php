<?php
require_once(__DIR__ . '/../checksession.php');
require_once(__DIR__ . '/../../inc/function.php');

$b = intval($_REQUEST['bid'] ?? 0);
$res = mysqli_query($conn, "SELECT image FROM `tbl_support_association` WHERE `id`='$b'");
$row = mysqli_fetch_assoc($res);
if (!empty($row['image']) && file_exists(__DIR__ . '/../../uploads/support-association/' . $row['image'])) {
    @unlink(__DIR__ . '/../../uploads/support-association/' . $row['image']);
}

$data = mysqli_query($conn, "DELETE FROM `tbl_support_association` WHERE `id`='$b'");
if ($data) {
    $_SESSION['warning'] = 'Supporting Association deleted successfully';
    header('location:../manage-support-association.php');
    exit();
}
?>
