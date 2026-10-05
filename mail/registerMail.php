<?php

/* ================= ERROR LOGGING ================= */
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

/* ================= SITE URL ================= */
define('SITE_URL', 'https://sgfoodees.in/');

/* ================= REQUIRED FILES ================= */
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'phpqrcode/qrlib.php';
require 'dompdf/autoload.inc.php';

/* ================= USE NAMESPACES ================= */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

$mail = new PHPMailer(true);

try {

    /* ================= SMTP SETTINGS ================= */
    $mail->isSMTP();
    $mail->Host       = 'localhost';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'work@sgfoodees.in';
    $mail->Password   = '[g.o5}G9V5*h';
    $mail->Port       = 587;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        /* ================= FORM DATA ================= */
        $name        = trim($_POST['name'] ?? '');
        $email       = trim($_POST['email'] ?? '');
        $company     = trim($_POST['company'] ?? '');
        $designation = trim($_POST['designation'] ?? '');
        $exibitor    = trim($_POST['exibitor'] ?? '');

        if (!$name || !$email || !$company || !$designation || !$exibitor) {
            exit('All fields are required');
        }

        /* ================= BADGE ID ================= */
        $badgeId = 'FBE25-' . strtoupper(substr(md5(uniqid('', true)), 0, 6));

        /* ================= QR CODE ================= */
        $qrDir = __DIR__ . '/uploads/qrcodes/';
        if (!is_dir($qrDir)) {
            mkdir($qrDir, 0755, true);
        }
        
        $qrFileName = $badgeId . '.png';
        $qrFilePath = $qrDir . $qrFileName;
        
        /* ================= QR DATA ================= */
        $qrData =
            "Name: {$name}\n" .
            "Designation: {$designation}\n" .
            "Company: {$company}\n" .
            "Badge ID: {$badgeId}";
        
        /* ================= GENERATE QR ================= */
        QRcode::png($qrData, $qrFilePath, QR_ECLEVEL_L, 5);

        /* ================= BASE64 IMAGES FOR OFFLINE / SECURE RENDERING ================= */
        $topImgPath = realpath(__DIR__ . '/../assets/img/f-top-new.jpg');
        $topImgSrc = ($topImgPath && file_exists($topImgPath)) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents($topImgPath)) : '';

        $pattImgPath = realpath(__DIR__ . '/../assets/img/patt2.png');
        $pattImgSrc = ($pattImgPath && file_exists($pattImgPath)) ? 'data:image/png;base64,' . base64_encode(file_get_contents($pattImgPath)) : '';

        $qrImgSrc = file_exists($qrFilePath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($qrFilePath)) : '';

        $safeName        = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $safeDesignation = htmlspecialchars($designation, ENT_QUOTES, 'UTF-8');
        $safeCompany     = htmlspecialchars($company, ENT_QUOTES, 'UTF-8');
        $safeExibitor    = htmlspecialchars($exibitor, ENT_QUOTES, 'UTF-8');
        $safeBadgeId     = htmlspecialchars($badgeId, ENT_QUOTES, 'UTF-8');

        /* ================= BADGE HTML ================= */
        $badgeHtml = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<div style="display:flex; justify-content:center;">

  <div id="pass" style="
      width:360px;
      height:540px;
      background:#ffffff;
      border-radius:16px;
      position:relative;
      border:1px solid #00000052;
      overflow:hidden;
      box-shadow:0 15px 40px rgba(0,0,0,0.25);
      display:flex;
      flex-direction:column;
  ">

    <div>
      <img src="'.$topImgSrc.'"
        style="width:100%;height:155px;object-fit:cover;display:block;">
    </div>

    <div style="
        flex:1;
        padding:40px 20px;
        text-align:center;
        display:flex;
        position: relative;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    ">
      <div style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; background-image: url('.$pattImgSrc.'); background-size: 300px; background-position: center center; background-repeat: repeat; opacity: 0.2;"></div>
      <h2 style="margin:12px 0 4px;font-size:22px;color:#c0392b;">
        '.$safeName.'
      </h2>

      <p style="margin:2px 0;font-size:14px;color:#555;">
        '.$safeDesignation.'
      </p>

      <p style="margin:2px 0;font-size:14px;color:#555;">
        '.$safeCompany.'
      </p>

      <div style="margin-top:10px;text-align:center;">
        <img src="'.$qrImgSrc.'"
          style="height:110px;width:110px;margin:auto;display:block;">
        <small style="display:block;margin-top:6px;font-size:12px;color:#777;">
          ID: '.$safeBadgeId.'
        </small>
      </div>

      <span style="
          display:inline-block;
          margin:14px 0;
          padding:6px 18px;
          background:#f39c12;
          color:#fff;
          font-weight:600;
          border-radius:20px;
          letter-spacing:1px;
          font-size:13px;
      ">
        '.strtoupper($safeExibitor).'
      </span>

    </div>

  </div>

</div>
</body>
</html>';

        /* ================= PDF GENERATION ================= */
        $pdfDir = __DIR__ . '/uploads/badges/';
        if (!is_dir($pdfDir)) {
            mkdir($pdfDir, 0755, true);
        }

        $pdfFilePath = $pdfDir . $badgeId . '.pdf';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isRemoteEnabled', false);
        $options->set('dpi', 150);
        $options->set('defaultFont', 'Arial');
        $dompdf->setOptions($options);

        $dompdf->loadHtml($badgeHtml);
        $dompdf->setPaper([0, 0, 298, 434]); // 105mm x 153mm
        $dompdf->render();

        file_put_contents($pdfFilePath, $dompdf->output()); 

        /* ================= EMAIL ================= */
        $mail->setFrom('work@sgfoodees.in', 'SG Foodees');
        $mail->addAddress($email, $name);
        $mail->addCC('wtdeveloperpankaj@gmail.com'); 

        $mail->addAttachment($pdfFilePath, 'SG-Foodees-Pass.pdf');

        $mail->isHTML(true);
        $mail->Subject = 'Your SG Foodees Entry Pass';

        $mail->Body = '
            <p>Dear '.$name.',</p>
            <p>Your <strong>SG Foodees Expo Pass</strong> is attached.</p>
            <p><strong>Badge ID:</strong> '.$badgeId.'</p>
            <p>Please bring this PDF (print or mobile).</p>
            <br>
            <p>Regards,<br>SG Foodees Team</p>
        ';

        $mail->send();
       echo "<script>alert('Thank you for registering. Your pass will be sent to your email within 30–60 seconds.');window.location.href = '" . SITE_URL . "';</script>";
       exit;
    }

} catch (Exception $e) {
    error_log($e->getMessage());
    echo 'Mailer Error';
}
