<?php
if (session_status() === PHP_SESSION_NONE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isHttps,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}
if (!isset($_SESSION['admin_ses']) || $_SESSION['admin_ses'] !== true) {
    $loginUrl = file_exists('login.php') ? 'login.php' : '../login.php';
    header("Location: " . $loginUrl);
    exit();
}
?>