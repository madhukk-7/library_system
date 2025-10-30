<?php
// Database configuration - edit these before running
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'library_system');
define('DB_USER', 'root');
define('DB_PASS', '');

// Start session
if(session_status() === PHP_SESSION_NONE) session_start();

try {
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>