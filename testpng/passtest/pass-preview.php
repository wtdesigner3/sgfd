<?php
// pass-preview: generate QR + composite pass image and show browser preview

require_once(__DIR__ . '/pass_generator.php');

// Locate phpqrcode
$qrLibPaths = [
  __DIR__ . '/phpqrcode/qrlib.php',
  __DIR__ . '/../phpqrcode/qrlib.php',
  __DIR__ . '/../../phpqrcode/qrlib.php',
  'C:\\Users\\Admin2\\Downloads\\phpqrcode\\qrlib.php',
  'C:\\Users\\Admin2\\Downloads\\phpqrcode-2010100721_1.1.4\\phpqrcode\\qrlib.php',
];
$included = false;
foreach ($qrLibPaths as $p) {
  if (file_exists($p)) { require_once $p; $included = true; break; }
}
$qrAvailable = $included;

// Input (from form or query)
$name        = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : 'Visitor Name';
$designation = isset($_REQUEST['designation']) ? trim($_REQUEST['designation']) : '';
$company     = isset($_REQUEST['company']) ? trim($_REQUEST['company']) : '';
$email       = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
$phone       = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : '';

// Output directories
$qrcDirFs = __DIR__ . '/qrcodes';
$outDirFs = __DIR__ . '/output';
if (!is_dir($qrcDirFs)) mkdir($qrcDirFs, 0777, true);
if (!is_dir($outDirFs)) mkdir($outDirFs, 0777, true);

// If a pass/qr are provided via query (redirect from submit.php), check if file exists
$providedPass = isset($_GET['pass']) ? trim($_GET['pass']) : '';
$providedQr   = isset($_GET['qr']) ? trim($_GET['qr']) : '';

if ($providedPass) {
  $passFileUrl = $providedPass;
  $passFileFs  = __DIR__ . '/' . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $providedPass), DIRECTORY_SEPARATOR);
} else {
  $passFilename = 'pass_preview_' . time() . '.png';
  $passFileFs   = $outDirFs . '/' . $passFilename;
  $passFileUrl  = 'output/' . $passFilename;
}

if ($providedQr) {
  $qrFileUrl = $providedQr;
  $qrFileFs  = __DIR__ . '/' . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $providedQr), DIRECTORY_SEPARATOR);
} else {
  $qrFilename = 'qr_preview_' . time() . '.png';
  $qrFileFs   = $qrcDirFs . '/' . $qrFilename;
  $qrFileUrl  = 'qrcodes/' . $qrFilename;
}

// Generate if file does not exist
if (!file_exists($passFileFs) && function_exists('imagecreate')) {
  if ($qrAvailable) {
    $qrData = "Name: $name";
    if (!empty($designation)) $qrData .= "\nDesignation: $designation";
    if (!empty($company))     $qrData .= "\nCompany: $company";
    if (!empty($email))       $qrData .= "\nEmail: $email";
    if (!empty($phone))       $qrData .= "\nPhone: $phone";
    QRcode::png($qrData, $qrFileFs, QR_ECLEVEL_L, 5);
  }
  generateVisitorPassImage($name, $designation, $company, $qrFileFs, $passFileFs);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5th Global Food & Bakery Expo - Visitor Pass</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="pass-container">
  <div class="pass-wrapper">
    <div class="bg-overlay">
      <!-- Generated pass image -->
      <?php if (!empty($passFileUrl) && file_exists($passFileFs)): ?>
        <img src="<?php echo htmlspecialchars($passFileUrl, ENT_QUOTES, 'UTF-8'); ?>?v=<?php echo filemtime($passFileFs); ?>" class="pass-bg" alt="Visitor Pass Preview">
      <?php else: ?>
        <img src="pass_5th_bg.png" class="pass-bg" alt="Visitor Pass Preview">
      <?php endif; ?>
    </div>

    <?php if (!empty($passFileUrl) && file_exists($passFileFs)): ?>
      <div class="download-btn-wrap">
        <a class="btn-download-pass" href="download.php?file=<?php echo urlencode($passFileUrl); ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          Download Pass
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
