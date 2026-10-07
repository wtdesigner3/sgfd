<?php
// Try to locate the phpqrcode library in common locations

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

require_once('../../inc/function.php');
require_once(__DIR__ . '/pass_generator.php');

$qrLibPaths = [
   __DIR__ . '/phpqrcode/qrlib.php',
   __DIR__ . '/../phpqrcode/qrlib.php',
   __DIR__ . '/../../phpqrcode/qrlib.php',
   'C:\\Users\\Admin2\\Downloads\\phpqrcode\\qrlib.php',
   'C:\\Users\\Admin2\\Downloads\\phpqrcode-2010100721_1.1.4\\phpqrcode\\qrlib.php',
];
$included = false;
foreach ($qrLibPaths as $p) {
   if (file_exists($p)) {
      require_once $p;
      $included = true;
      break;
   }
}
if (! $included) {
   http_response_code(500);
   echo "QR library not available.";
   exit;
}

/* =====================
   GET FORM DATA
===================== */
$name         = isset($_POST['name']) ? trim($_POST['name']) : '';
$designation  = isset($_POST['designation']) ? trim($_POST['designation']) : '';
$company      = isset($_POST['company']) ? trim($_POST['company']) : '';
$email        = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone        = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$attendeename = isset($_POST['attend_date']) ? trim($_POST['attend_date']) : (isset($_POST['attendeename']) ? trim($_POST['attendeename']) : '');

$s_name         = mysqli_real_escape_string($conn, $name);
$s_company      = mysqli_real_escape_string($conn, $company);
$s_email        = mysqli_real_escape_string($conn, $email);
$s_phone        = mysqli_real_escape_string($conn, $phone);
$s_designation  = mysqli_real_escape_string($conn, $designation);
$s_attendeename = mysqli_real_escape_string($conn, $attendeename);

$passEnqiry = mysqli_query($conn,"INSERT INTO `tbl_pass_inquiry` (name,company,email,phone,designation,attend_date) VALUES('$s_name','$s_company','$s_email','$s_phone','$s_designation','$s_attendeename')");

/* =====================
   FILE PATHS & DIRECTORIES
===================== */
$qrcDirFs = __DIR__ . '/qrcodes';
$outDirFs = __DIR__ . '/output';
if (!is_dir($qrcDirFs)) mkdir($qrcDirFs, 0777, true);
if (!is_dir($outDirFs)) mkdir($outDirFs, 0777, true);

$timestamp    = time();
$passFilename = 'pass_' . $timestamp . '.png';
$qrFilename   = 'qr_' . $timestamp . '.png';

$passFileFs   = $outDirFs . '/' . $passFilename;
$qrFileFs     = $qrcDirFs . '/' . $qrFilename;

$passFileUrl  = 'output/' . $passFilename;
$qrFileUrl    = 'qrcodes/' . $qrFilename;

/* =====================
   GENERATE QR CODE
===================== */
$qrData = "Name: $name";
if (!empty($designation)) $qrData .= "\nDesignation: $designation";
if (!empty($company))     $qrData .= "\nCompany: $company";
if (!empty($email))       $qrData .= "\nEmail: $email";
if (!empty($phone))       $qrData .= "\nPhone: $phone";

QRcode::png($qrData, $qrFileFs, QR_ECLEVEL_L, 5);

/* =====================
   RENDER PASS IMAGE
===================== */
generateVisitorPassImage($name, $designation, $company, $qrFileFs, $passFileFs);

/* =====================
   REDIRECT TO PREVIEW
===================== */
$qs = http_build_query([
   'name'        => $name,
   'designation' => $designation,
   'company'     => $company,
   'email'       => $email,
   'phone'       => $phone,
   'pass'        => $passFileUrl,
   'qr'          => $qrFileUrl,
]);
header('Location: pass-preview.php?' . $qs);
exit;
