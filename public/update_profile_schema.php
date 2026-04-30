<?php
require_once '../config/config.php';
require_once '../app/core/Database.php';

$db = new Database();

$columns = [
    'height' => "VARCHAR(20) AFTER age",
    'skin_color' => "VARCHAR(50) AFTER height",
    'caste' => "VARCHAR(100) AFTER skin_color",
    'sect' => "VARCHAR(100) AFTER religion",
    'permanent_address' => "TEXT AFTER city",
    'temporary_address' => "TEXT AFTER permanent_address",
    'physique' => "VARCHAR(50) AFTER height",
    'disability' => "VARCHAR(255) AFTER physique",
    'is_overseas' => "BOOLEAN DEFAULT FALSE AFTER disability",
    'has_bike' => "BOOLEAN DEFAULT FALSE AFTER is_overseas",
    'has_car' => "BOOLEAN DEFAULT FALSE AFTER has_bike",
    'whatsapp' => "VARCHAR(20) AFTER has_car",
    'employment_type' => "ENUM('private', 'govt', 'business', 'freelancer', 'none') DEFAULT 'none' AFTER occupation",
    'company_name' => "VARCHAR(255) AFTER employment_type",
    'company_address' => "TEXT AFTER company_name",
    'monthly_income' => "DECIMAL(15, 2) AFTER company_address",
    'father_income' => "DECIMAL(15, 2) AFTER monthly_income",
    'mother_income' => "DECIMAL(15, 2) AFTER father_income"
];

echo "<h1>Updating Profile Schema (Compatible Mode)...</h1>";

// Get existing columns
$db->query("DESCRIBE profiles");
$results = $db->resultSet();
$existing_columns = [];
foreach ($results as $row) {
    $existing_columns[] = $row->Field;
}

foreach ($columns as $column => $definition) {
    if (!in_array($column, $existing_columns)) {
        try {
            $sql = "ALTER TABLE profiles ADD $column $definition";
            $db->query($sql);
            $db->execute();
            echo "<p style='color:green'>SUCCESS: Added column <b>$column</b></p>";
        } catch (Exception $e) {
            echo "<p style='color:red'>FAILED to add <b>$column</b>: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:blue'>SKIP: Column <b>$column</b> already exists.</p>";
    }
}

echo "<h3>Update Complete!</h3>";
echo "<p><a href='../admin/users'>Return to Dashboard</a></p>";
