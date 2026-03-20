<?php
// config.php - Centralized Configuration

// detect environment
$is_local = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || $_SERVER['HTTP_HOST'] === 'localhost';

if ($is_local) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'padosi_db_staging');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('IS_DEV', true);
} else {
    // --- PRODUCTION SETTINGS (InfinityFree) ---
    // IMPORTANT: Replace these with your actual InfinityFree MySQL details from the control panel
    define('DB_HOST', 'sqlxxx.infinityfree.com'); // e.g. sql101.infinityfree.com
    define('DB_NAME', 'if0_xxxxxx_padosi_db');   // e.g. if0_38400000_padosi_db
    define('DB_USER', 'if0_xxxxxx');              // e.g. if0_38400000
    define('DB_PASS', 'your_password');           // Your InfinityFree hosting/vPanel password
    define('IS_DEV', false);
}

// --- SESSION & AUTH ---
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Lax'
    ]);
}

/**
 * Checks if the user is logged in as an admin.
 * Redirects to login page if not authenticated.
 */
function check_auth() {
    if (!isset($_SESSION['admin_auth']) || $_SESSION['admin_auth'] !== true) {
        header("Location: login.php");
        exit();
    }
}

/**
 * Helper for XSS protection
 */
function h($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}
?>
