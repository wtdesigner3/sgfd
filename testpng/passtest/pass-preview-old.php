<?php
// pass-preview.php
// Generates a landscape bifold image:
//   LEFT  half = new portrait pass background (pass2.jpg) with visitor data + QR
//   RIGHT half = info/back page image (pass_back.jpg)

// ── phpqrcode ────────────────────────────────────────────────────────────────
$qrLibPaths = [
  __DIR__ . '/phpqrcode/qrlib.php',
  __DIR__ . '/../phpqrcode/qrlib.php',
  __DIR__ . '/../../phpqrcode/qrlib.php',
  'C:\\Users\\Admin2\\Downloads\\phpqrcode\\qrlib.php',
  'C:\\Users\\Admin2\\Downloads\\phpqrcode-2010100721_1.1.4\\phpqrcode\\qrlib.php',
];
$qrAvailable = false;
foreach ($qrLibPaths as $p) {
  if (file_exists($p)) { require_once $p; $qrAvailable = true; break; }
}

// ── Inputs ───────────────────────────────────────────────────────────────────
$name        = isset($_REQUEST['name'])        ? trim($_REQUEST['name'])        : 'Visitor Name';
$designation = isset($_REQUEST['designation']) ? trim($_REQUEST['designation']) : 'Designation';
$company     = isset($_REQUEST['company'])     ? trim($_REQUEST['company'])     : 'Company';
$email       = isset($_REQUEST['email'])       ? trim($_REQUEST['email'])       : '';

// ── Asset paths ───────────────────────────────────────────────────────────────
// pass2.jpg     = LEFT side: new portrait pass background (1132×1546)
// pass_back.jpg = RIGHT side: info/text page
$bgLeft  = __DIR__ . '/pass2.jpg';
$bgRight = __DIR__ . '/pass_back.jpg';
$font     = __DIR__ . '/fonts/Poppins-Regular.ttf';
$fontBold = __DIR__ . '/fonts/Poppins-Bold.ttf';

// ── Output dirs ───────────────────────────────────────────────────────────────
$qrcDir = __DIR__ . '/qrcodes';
$outDir = __DIR__ . '/output';
if (!is_dir($qrcDir)) mkdir($qrcDir, 0777, true);
if (!is_dir($outDir)) mkdir($outDir, 0777, true);

// ── ALWAYS generate a fresh pass + QR (never reuse cached files) ─────────────
$ts          = time();
$passFileFs  = $outDir  . '/pass_' . $ts . '.png';
$passFileUrl = 'output/pass_' . $ts . '.png';
$qrFileFs    = $qrcDir  . '/qr_'  . $ts . '.png';
$qrFileUrl   = 'qrcodes/qr_' . $ts . '.png';

// ── Layout constants for LEFT panel (portrait pass, 1132×1546) ────────────────
//  White zone: rows 629–1400
$leftW   = 1132;
$leftH   = 1546;
$centerX = 566;

$nameY        = 729;
$designationY = 804;
$companyY     = 859;
$qrSizePx     = 220;
$qrDestX      = $centerX - intdiv($qrSizePx, 2);
$qrDestY      = 929;
$visitorY     = $qrDestY + $qrSizePx + 48;

$nameFontSz  = 48;
$desgFontSz  = 32;
$compFontSz  = 28;
$visitFontSz = 30;

// Text colour: dark navy
$tR = 26; $tG = 35; $tB = 90;

// ── Helper: shrink text to fit $maxW ─────────────────────────────────────────
function fitText($text, $size, $fontPath, $maxW, $minSize = 14) {
  while ($size >= $minSize) {
    $bb = imagettfbbox($size, 0, $fontPath, $text);
    if (abs($bb[2] - $bb[0]) <= $maxW) return [$size, $bb];
    $size -= 2;
  }
  return [$size, imagettfbbox($size, 0, $fontPath, $text)];
}

// ── GD composite generation ───────────────────────────────────────────────────
$genOk = false;
if ($qrAvailable && function_exists('imagecreatetruecolor')) {

  // 1. Generate QR PNG
  $qrData = "Name: $name\nCompany: $company\nEmail: $email";
  QRcode::png($qrData, $qrFileFs, QR_ECLEVEL_L, 8);

  // 2. Load LEFT background (portrait pass)
  if (file_exists($bgLeft)) {
    $leftImg = imagecreatefromjpeg($bgLeft);
  } else {
    $leftImg = imagecreatetruecolor($leftW, $leftH);
    imagefilledrectangle($leftImg, 0, 0, $leftW-1, $leftH-1, imagecolorallocate($leftImg,255,255,255));
  }
  $lW = imagesx($leftImg);
  $lH = imagesy($leftImg);

  // 3. Draw visitor text on left panel
  $col = imagecolorallocate($leftImg, $tR, $tG, $tB);
  $mW  = $lW - 120;

  if (file_exists($font)) {
    $bf = file_exists($fontBold) ? $fontBold : $font;

    // Name
    [$ns, $bb] = fitText($name, $nameFontSz, $bf, $mW);
    $nx = $centerX - intdiv(abs($bb[2]-$bb[0]), 2);
    imagettftext($leftImg, $ns, 0, $nx, $nameY, $col, $bf, $name);

    // Designation
    [$ds, $bb2] = fitText($designation, $desgFontSz, $font, $mW);
    $dx = $centerX - intdiv(abs($bb2[2]-$bb2[0]), 2);
    imagettftext($leftImg, $ds, 0, $dx, $designationY, $col, $font, $designation);

    // Company
    [$cs, $bb3] = fitText($company, $compFontSz, $font, $mW);
    $cx = $centerX - intdiv(abs($bb3[2]-$bb3[0]), 2);
    imagettftext($leftImg, $cs, 0, $cx, $companyY, $col, $font, $company);

  } else {
    // Built-in font fallback
    imagestring($leftImg, 5, 60, $nameY-15,        $name,        $col);
    imagestring($leftImg, 4, 60, $designationY-15, $designation, $col);
    imagestring($leftImg, 3, 60, $companyY-15,     $company,     $col);
  }

  // 4. Stamp QR onto left panel
  if (file_exists($qrFileFs)) {
    $qrImg = imagecreatefrompng($qrFileFs);
    imagecopyresampled($leftImg, $qrImg, $qrDestX, $qrDestY, 0, 0,
      $qrSizePx, $qrSizePx, imagesx($qrImg), imagesy($qrImg));
    imagedestroy($qrImg);
  }

  // 5. "Visitor" label under QR
  if (file_exists($font)) {
    $bf = file_exists($fontBold) ? $fontBold : $font;
    [$vs, $vb] = fitText('Visitor', $visitFontSz, $bf, $qrSizePx + 40);
    $vx = $centerX - intdiv(abs($vb[2]-$vb[0]), 2);
    imagettftext($leftImg, $vs, 0, $vx, $visitorY, $col, $bf, 'Visitor');
  } else {
    imagestring($leftImg, 4, $qrDestX, $visitorY, 'Visitor', $col);
  }

  // 6. Load RIGHT background (info page) scaled to same height as left
  if (file_exists($bgRight)) {
    $rightSrc = imagecreatefromjpeg($bgRight);
  } else {
    $rightSrc = imagecreatetruecolor($lW, $lH);
    imagefilledrectangle($rightSrc, 0, 0, $lW-1, $lH-1, imagecolorallocate($rightSrc,255,255,255));
  }
  $rSrcW = imagesx($rightSrc);
  $rSrcH = imagesy($rightSrc);

  $rScale      = $lH / $rSrcH;
  $rDestW      = (int)($rSrcW * $rScale);
  $rDestH      = $lH;
  $rightScaled = imagecreatetruecolor($rDestW, $rDestH);
  imagecopyresampled($rightScaled, $rightSrc, 0, 0, 0, 0,
    $rDestW, $rDestH, $rSrcW, $rSrcH);
  imagedestroy($rightSrc);

  // 7. Stitch left + right into one landscape canvas
  $canvasW = $lW + $rDestW;
  $canvasH = $lH;
  $canvas  = imagecreatetruecolor($canvasW, $canvasH);
  imagecopy($canvas, $leftImg,     0,   0, 0, 0, $lW,    $lH);
  imagecopy($canvas, $rightScaled, $lW, 0, 0, 0, $rDestW,$rDestH);
  imagedestroy($leftImg);
  imagedestroy($rightScaled);

  imagepng($canvas, $passFileFs);
  imagedestroy($canvas);
  $genOk = true;

} else {
  $passFileUrl = '';
  $qrFileUrl   = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Event Pass Preview</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body { margin: 0; background: #f0f0f0; font-family: sans-serif; }

    .pass-wrapper {
      max-width: 1000px;
      margin: 30px auto;
      padding: 0 16px;
    }

    /* Landscape bifold */
    .bifold {
      display: flex;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 6px 28px rgba(0,0,0,.35);
    }

    /* LEFT: portrait pass with dynamic overlay */
    .left-panel {
      position: relative;
      flex: 1 1 50%;
    }
    .left-panel img.bg {
      display: block;
      width: 100%;
      height: auto;
    }

    /* White zone overlay
       top    = 629/1546 = 40.7%
       bottom = (1546-1400)/1546 = 9.4% */
    .white-box {
       position: absolute;
    top: 40.7%;
    bottom: 9.4%;
    left: 4%;
    right: 4%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: end;
    padding-top: 3%;
    margin-bottom: 0;
    background: transparent;
    }
    .white-box h2 {
      font-size: clamp(12px, 2.8vw, 24px);
      font-weight: 700;
      color: #1A235A;
      margin: 0 0 4px;
      text-align: center;
    }
    .white-box .info {
      font-size: clamp(10px, 1.9vw, 16px);
      color: #1A235A;
      margin: 2px 0;
      text-align: center;
    }
    .white-box .qr-img {
      width: clamp(55px, 16%, 130px);
      height: auto;
      margin: 8px auto 4px;
      display: block;
    }
    .white-box .visitor-lbl {
      font-size: clamp(10px, 2.2vw, 18px);
      font-weight: 700;
      color: #1A235A;
      margin: 2px 0 0;
    }

    /* RIGHT: static info image */
    .right-panel {
      flex: 1 1 50%;
    }
    .right-panel img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Download button */
    .dl-wrap { text-align: center; margin: 22px 0 10px; }
    .dl-btn {
      display: inline-block;
      padding: 12px 36px;
      background: #E8313A;
      color: #fff;
      font-weight: 700;
      font-size: 16px;
      border-radius: 100px;
      text-decoration: none;
      box-shadow: 0 3px 10px rgba(0,0,0,.25);
    }
    .dl-btn:hover { background: #c0272e; }
  </style>
</head>
<body>

<div class="pass-wrapper">
  <div class="bifold">

    <!-- LEFT panel: pass background + dynamic overlay -->
    <div class="left-panel">
      <img src="pass2.jpg" class="bg" alt="Pass">

      <div class="white-box">
        <h2><?php echo htmlspecialchars($name); ?></h2>
        <p class="info"><?php echo htmlspecialchars($designation); ?></p>
        <p class="info"><?php echo htmlspecialchars($company); ?></p>
        <?php if (!empty($qrFileUrl) && file_exists($qrFileFs)): ?>
          <img src="<?php echo htmlspecialchars($qrFileUrl, ENT_QUOTES, 'UTF-8'); ?>?v=<?php echo filemtime($qrFileFs); ?>"
               class="qr-img" alt="QR Code">
          <p class="visitor-lbl">Visitor</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- RIGHT panel: static info/back page -->
    <div class="right-panel">
      <img src="pass_back.jpg" alt="Event Info">
    </div>

  </div><!-- .bifold -->

  <div class="dl-wrap">
    <?php if ($genOk && file_exists($passFileFs)): ?>
      <a class="dl-btn"
         href="download.php?file=<?php echo urlencode($passFileUrl); ?>">
        ⬇ Download Pass
      </a>
    <?php elseif (!$qrAvailable): ?>
      <p style="color:#b00">QR generation not available (phpqrcode missing).</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>