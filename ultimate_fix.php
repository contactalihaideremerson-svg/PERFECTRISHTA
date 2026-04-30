<?php
/**
 * ULTIMATE DATABASE FIX SCRIPT
 * This script will fix ANY missing columns in the profiles table.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle CLI environment
if (!isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

require_once 'config/config.php';

echo "<h1>Ultimate Database Repair</h1>";

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "<p style='color: green;'>Connected to " . DB_NAME . " successfully.</p>";

    // Get current columns
    $stmt = $pdo->query("DESCRIBE profiles");
    $existing_columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<h3>Current Columns in 'profiles':</h3><ul>";
    foreach ($existing_columns as $col)
        echo "<li>$col</li>";
    echo "</ul>";

    // List of columns to check/add
    $columns_to_ensure = [
        'father_name' => "VARCHAR(255)",
        'cnic' => "VARCHAR(50)",
        'weight' => "VARCHAR(50)",
        'complexion' => "VARCHAR(100)",
        'blood_group' => "VARCHAR(20)",
        'degree' => "VARCHAR(255)",
        'job_title' => "VARCHAR(255)",
        'country' => "VARCHAR(255)",
        'father_status' => "VARCHAR(50)",
        'mother_status' => "VARCHAR(50)",
        'father_occup' => "VARCHAR(255)",
        'mother_occup' => "VARCHAR(255)",
        'brothers_count' => "INT DEFAULT 0",
        'married_brothers' => "INT DEFAULT 0",
        'sisters_count' => "INT DEFAULT 0",
        'married_sisters' => "INT DEFAULT 0",
        'has_children' => "VARCHAR(50)",
        'children_count' => "INT DEFAULT 0",
        'living_with' => "VARCHAR(255)",
        'pref_age' => "VARCHAR(255)",
        'pref_height' => "VARCHAR(255)",
        'pref_education' => "VARCHAR(255)",
        'pref_caste' => "VARCHAR(255)",
        'pref_city' => "VARCHAR(255)",
        'pref_income' => "VARCHAR(255)",
        'pref_others' => "TEXT",
        'form_no' => "VARCHAR(255)",
        'receipt_no' => "VARCHAR(255)",
        'fee' => "DECIMAL(10, 2) DEFAULT 0.00",
        'admin_signature' => "VARCHAR(255)",
        'admin_notes' => "TEXT",
        'house_status' => "VARCHAR(50) DEFAULT 'None'",
        'house_size' => "VARCHAR(100) DEFAULT ''"
    ];

    echo "<h3>Applying Updates:</h3>";
    foreach ($columns_to_ensure as $col => $definition) {
        if (!in_array($col, $existing_columns)) {
            try {
                $pdo->exec("ALTER TABLE profiles ADD COLUMN $col $definition");
                echo "<p style='color: green;'>✅ Added: <strong>$col</strong></p>";
            } catch (Exception $e) {
                echo "<p style='color: red;'>❌ Failed to add <strong>$col</strong>: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color: blue;'>ℹ️ Exists: $col</p>";
        }
    }

    echo "<h2>PROCESS COMPLETE!</h2>";
    echo "<p>Please delete this file (ultimate_fix.php) and try your profile again.</p>";

} catch (Exception $e) {
    echo "<h1>CRITICAL ERROR</h1>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
}
