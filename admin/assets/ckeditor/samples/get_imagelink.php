<?php
require_once(__DIR__ . '/../../../checksession.php');
require("../../../../inc/function.php");

if(isset($_FILES['upload']['name']))
{
    $file = $_FILES['upload']['tmp_name'];
    $file_name = $_FILES['upload']['name'];
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    $allowed_extension = array("jpg", "jpeg", "png", "gif", "webp");
    if(in_array($extension, $allowed_extension) && file_exists($file))
    {
        $new_image_name = time() . '_' . mt_rand(1000, 9999) . '.' . $extension;
        $upload_dir = '../../../../uploads/ckeditor/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        if (move_uploaded_file($file, $upload_dir . $new_image_name)) {
            $function_number = intval($_GET['CKEditorFuncNum'] ?? 0);
            $url = SITE_URL . 'uploads/ckeditor/' . $new_image_name;
            $message = '';
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(" . $function_number . ", '" . htmlspecialchars($url, ENT_QUOTES) . "', '" . htmlspecialchars($message, ENT_QUOTES) . "');</script>";
        }
    }
}
?>