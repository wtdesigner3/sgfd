<?php
/**
 * Automated Server-Side Deployment Unpacker
 * Safely extracts deploy.zip in place on the cPanel server.
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');
@set_time_limit(300);
@ini_set('memory_limit', '512M');

$token = $_GET['token'] ?? '';
$tokenFile = __DIR__ . '/.deploy_token';

if (!file_exists($tokenFile)) {
    http_response_code(403);
    exit('Access Denied: Missing deployment token file.');
}

$expectedToken = trim(file_get_contents($tokenFile));
if (!$token || !hash_equals($expectedToken, $token)) {
    http_response_code(403);
    exit('Access Denied: Invalid deployment token.');
}

$zipFile = __DIR__ . '/deploy.zip';
if (!file_exists($zipFile)) {
    http_response_code(404);
    exit('Error: deploy.zip not found on server.');
}

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    exit('Error: ZipArchive extension is not enabled in PHP.');
}

$zip = new ZipArchive();
$res = $zip->open($zipFile);
if ($res !== true) {
    http_response_code(500);
    exit('Error opening zip file. Code: ' . $res);
}

$extractOk = $zip->extractTo(__DIR__);
$zip->close();

if (!$extractOk) {
    http_response_code(500);
    exit('Error: Failed to extract zip contents.');
}

// Clean up deployment artifacts
@unlink($zipFile);
@unlink($tokenFile);
@unlink(__FILE__);

echo 'SUCCESS: Deployment extracted successfully!';
