<?php
// database.php - PDO Connection Wrapper
require_once 'config.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // Log error internally
    error_log("Database Connection Failed: " . $e->getMessage());
    
    // In development, show the real error. In production, show a clean message.
    if (defined('IS_DEV') && IS_DEV) {
        die("<h3>Database Connection Error (Dev Mode)</h3>" . 
            "<p>Check your credentials in config.php</p>" .
            "<strong>Error:</strong> " . $e->getMessage());
    } else {
        die("A technical error occurred while connecting to the database. Please check your production credentials in config.php.");
    }
}
?>
