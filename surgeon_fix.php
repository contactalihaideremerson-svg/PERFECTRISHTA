<?php
/**
 * SURGEON DATABASE REPAIR SCRIPT
 * This script is 100% self-contained and uses production credentials directly.
 * Run this via browser: https://perfectrishta.online/surgeon_fix.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// PRODUCTION CREDENTIALS (Extracted from config.php)
$creds = [
    'host' => 'localhost',
    'user' => 'u638387449_perfect_user1',
    'pass' => 'Perfect_password1',
    'name' => 'u638387449_perfect_data'
];

echo "<h1>Surgeon Diagnostic & Repair</h1>";

try {
    $dsn = "mysql:host={$creds['host']};dbname={$creds['name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $creds['user'], $creds['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "<p style='color: green;'>✅ Connected to database: <strong>{$creds['name']}</strong></p>";

    // Check tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<p>Tables found: " . implode(', ', $tables) . "</p>";

    if (!in_array('profiles', $tables)) {
        die("<p style='color: red;'>❌ ERROR: 'profiles' table not found!</p>");
    }

    // Diagnostic: List columns
    $stmt = $pdo->query("DESCRIBE profiles");
    $existing_cols = [];
    while ($row = $stmt->fetch()) {
        $existing_cols[] = $row['Field'];
    }

    echo "<h3>Current Columns in 'profiles':</h3>";
    echo "<div style='background: #eee; padding: 10px; font-family: monospace;'>" . implode(', ', $existing_cols) . "</div>";

    // Repair: Add MISSING columns
    $needed = [
        'house_status' => "VARCHAR(50) DEFAULT 'None' AFTER admin_notes",
        'house_size' => "VARCHAR(100) DEFAULT '' AFTER house_status"
    ];

    echo "<h3>Applying Repairs:</h3>";
    foreach ($needed as $col => $def) {
        if (!in_array($col, $existing_cols)) {
            echo "<p>Adding $col... ";
            try {
                $pdo->exec("ALTER TABLE profiles ADD COLUMN $col $def");
                echo "<span style='color: green;'>SUCCESS!</span></p>";
            } catch (Exception $ex) {
                echo "<span style='color: red;'>FAILED: " . $ex->getMessage() . "</span></p>";
            }
        } else {
            echo "<p style='color: blue;'>ℹ️ $col already exists. Skipping.</p>";
        }
    }

    // Final Verification
    $stmt = $pdo->query("DESCRIBE profiles");
    $final_cols = [];
    while ($row = $stmt->fetch()) {
        $final_cols[] = $row['Field'];
    }

    if (in_array('house_status', $final_cols) && in_array('house_size', $final_cols)) {
        echo "<h2 style='color: green;'>DATABASE REPAIRED SUCCESSFULLY!</h2>";
        echo "<p>You can now delete this file and try your profile again.</p>";
    } else {
        echo "<h2 style='color: red;'>REPAIR VERIFICATION FAILED.</h2>";
    }

} catch (Exception $e) {
    echo "<h1>CRITICAL CONNECTION ERROR</h1>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<p>Attempted connection with user: {$creds['user']}</p>";
}
