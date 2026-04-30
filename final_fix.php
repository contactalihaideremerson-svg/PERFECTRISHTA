<?php
/**
 * FINAL DATABASE FIX SCRIPT
 * Run this via browser: https://perfectrishta.online/final_fix.php
 */

// Production Credentials (from config.php)
$db_host = 'localhost';
$db_user = 'u638387449_perfect_user1';
$db_pass = 'Perfect_password1';
$db_name = 'u638387449_perfect_data';

header('Content-Type: text/html; charset=utf-8');

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    echo "<h1>Database Final Fix</h1>";
    echo "<p style='color: blue;'>Connected to: $db_name</p>";

    // 1. Add house_status
    $check = $pdo->query("SHOW COLUMNS FROM profiles LIKE 'house_status'");
    if ($check->rowCount() == 0) {
        $pdo->exec("ALTER TABLE profiles ADD COLUMN house_status VARCHAR(50) DEFAULT 'None' AFTER admin_notes");
        echo "<p style='color: green;'>✅ Added <strong>house_status</strong> column.</p>";
    } else {
        echo "<p style='color: orange;'>ℹ️ Column <strong>house_status</strong> already exists.</p>";
    }

    // 2. Add house_size
    $check = $pdo->query("SHOW COLUMNS FROM profiles LIKE 'house_size'");
    if ($check->rowCount() == 0) {
        $pdo->exec("ALTER TABLE profiles ADD COLUMN house_size VARCHAR(100) DEFAULT '' AFTER house_status");
        echo "<p style='color: green;'>✅ Added <strong>house_size</strong> column.</p>";
    } else {
        echo "<p style='color: orange;'>ℹ️ Column <strong>house_size</strong> already exists.</p>";
    }

    echo "<h2>SUCCESS! Database is now updated.</h2>";
    echo "<p>Please delete this file (final_fix.php) and try your profile again.</p>";

} catch (PDOException $e) {
    echo "<h1>ERROR</h1>";
    echo "<p style='color: red; font-weight: bold;'>" . $e->getMessage() . "</p>";
    echo "<p>Credentials used: User: $db_user, DB: $db_name</p>";
}
