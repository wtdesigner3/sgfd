<?php
// try locating phpqrcode library in common locations
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
   echo "phpqrcode library not found. Tried:" . PHP_EOL . implode(PHP_EOL, $qrLibPaths);
   exit;
}

/* ======================
   USER DATA (from form)
====================== */
$name        = "Rithvik Rautela";
$designation = "Marketing Manager";
$company     = "ABC Pvt Ltd";
$email       = "user@gmail.com";

/* ======================
   FILE PATHS
====================== */
$bgImage = 'pass-bg.png';
$font    = __DIR__ . '/fonts/Poppins-Regular.ttf';
$output  = 'output/pass_' . time() . '.png';
$qrFile  = 'qrcodes/qr_' . time() . '.png';

/* ======================
   GENERATE QR CODE
====================== */
$qrData = "Name: $name\nCompany: $company\nEmail: $email";
QRcode::png($qrData, $qrFile, QR_ECLEVEL_L, 5);

/* ======================
   LOAD BACKGROUND
====================== */
$image = imagecreatefrompng($bgImage);
$black = imagecolorallocate($image, 0, 0, 0);

/* ======================
   WRITE TEXT (WHITE BOX)
   (Adjust X/Y if needed)
====================== */
imagettftext($image, 28, 0, 210, 670, $black, $font, $name);
imagettftext($image, 22, 0, 210, 710, $black, $font, $designation);
imagettftext($image, 20, 0, 210, 740, $black, $font, $company);

/* ======================
   ADD QR CODE
====================== */
$qrImg = imagecreatefrompng($qrFile);

// Position QR inside white box
imagecopyresampled(
  $image,
  $qrImg,
  250, 780,     // DEST X, Y (adjust)
  0, 0,
  150, 150,     // QR size
  imagesx($qrImg),
  imagesy($qrImg)
);

/* ======================
   SAVE FINAL PASS
====================== */
imagepng($image, $output);

imagedestroy($image);
imagedestroy($qrImg);

echo "<h3>Pass Generated</h3>";
echo "<img src='$output' style='width:300px'>";
