<?php
// download.php - securely serve image files from output/ or qrcodes/
$allowedDirs = [
  realpath(__DIR__ . DIRECTORY_SEPARATOR . 'output'),
  realpath(__DIR__ . DIRECTORY_SEPARATOR . 'qrcodes'),
];
$file = isset($_GET['file']) ? $_GET['file'] : '';
if (! $file) {
  http_response_code(400); echo 'Missing file'; exit;
}
// normalize
$file = str_replace(['..','\\'], '', $file);
$fs = realpath(__DIR__ . DIRECTORY_SEPARATOR . ltrim($file, '/\\'));
if ($fs === false) { http_response_code(404); echo 'Not found'; exit; }
// ensure inside allowed dirs
$ok = false;
foreach ($allowedDirs as $d) { if ($d && strpos($fs, $d) === 0) { $ok = true; break; } }
if (! $ok) { http_response_code(403); echo 'Forbidden'; exit; }
if (! is_file($fs)) { http_response_code(404); echo 'Not found'; exit; }
$mime = mime_content_type($fs) ?: 'application/octet-stream';
header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . basename($fs) . '"');
header('Content-Length: ' . filesize($fs));
readfile($fs);
exit;
