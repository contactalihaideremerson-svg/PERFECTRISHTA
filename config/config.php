<?php
// Database and App Configuration
if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
    // Localhost Settings
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'u638387449_perfect_data');
    define('URLROOT', 'http://localhost/perfect match');

    // Display Errors for Debugging
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    // Production (Hostinger) Settings
    define('DB_HOST', 'localhost');
    define('DB_USER', 'u638387449_perfect_user1');
    define('DB_PASS', 'Perfect_password1');
    define('DB_NAME', 'u638387449_perfect_data');
    define('URLROOT', 'https://perfectrishta.online');

    // TEMPORARY: Show Errors in Production for Debugging
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// Global App Constants
define('APPROOT', dirname(dirname(__FILE__)) . '/app');
define('SITENAME', 'Perfect Rishta');
define('CURRENCY', 'Rs.');

// Timezone
date_default_timezone_set('Asia/Karachi');
