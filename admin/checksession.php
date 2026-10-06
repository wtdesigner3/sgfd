<?php
// Function to ensure session is started with robust cookie params and writable save path
if (!function_exists('ensure_admin_session_started')) {
    function ensure_admin_session_started() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        // 1. Verify and resolve session save path
        $currentPath = @session_save_path();
        if (empty($currentPath) || !@is_dir($currentPath) || !@is_writable($currentPath)) {
            $tmp = sys_get_temp_dir();
            if (!empty($tmp) && @is_dir($tmp) && @is_writable($tmp)) {
                @session_save_path($tmp);
            } else {
                $localSessions = __DIR__ . '/sessions';
                if (!is_dir($localSessions)) {
                    @mkdir($localSessions, 0733, true);
                }
                if (is_dir($localSessions) && is_writable($localSessions)) {
                    @session_save_path($localSessions);
                }
            }
        }

        // 2. Detect HTTPS (direct, reverse proxy, Cloudflare, etc.)
        $isHttps = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
            || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
            || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on')
            || (!empty($_SERVER['REQUEST_SCHEME']) && strtolower($_SERVER['REQUEST_SCHEME']) === 'https');

        // 3. Set cookie params (lifetime 24 hours, path / across entire site)
        $cookieParams = [
            'lifetime' => 86400,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ];
        if ($isHttps) {
            $cookieParams['secure'] = true;
        }

        @session_set_cookie_params($cookieParams);
        @session_start();
    }
}

ensure_admin_session_started();

// Check if current script is login.php; if so, do not enforce active session check
$currentScript = basename($_SERVER['PHP_SELF'] ?? '');
if ($currentScript !== 'login.php') {
    if (!isset($_SESSION['admin_ses']) || $_SESSION['admin_ses'] !== true) {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $loginUrl = (strpos($uri, '/delete/') !== false || strpos($uri, '/status/') !== false) ? '../login.php' : 'login.php';
        header("Location: " . $loginUrl);
        exit();
    }
}
?>