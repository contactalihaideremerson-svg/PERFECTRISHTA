<?php
require_once 'config/config.php';
require_once 'app/core/Database.php';

$db = new Database();

// 1. Update existing packages to PKR
$db->query("DELETE FROM packages");
$db->execute();

$packages = [
    ['Basic', 2000, 30, json_encode(['Unlimited Messages', 'Basic Profile Search', 'Mobile App Access'])],
    ['Standard', 5000, 30, json_encode(['Everything in Basic', 'View Member Contacts', 'Direct Message Requests', 'Privacy Controls'])],
    ['Premium', 10000, 90, json_encode(['Everything in Standard', 'Featured Profile Tag', 'Boost Monthly Profile', 'Personal Support'])]
];

foreach ($packages as $p) {
    $db->query("INSERT INTO packages (name, price, duration_days, features) VALUES (:name, :price, :duration, :features)");
    $db->bind(':name', $p[0]);
    $db->bind(':price', $p[1]);
    $db->bind(':duration', $p[2]);
    $db->bind(':features', $p[3]);
    $db->execute();
}

// 2. Add 'pending' to users status ENUM and set default to pending
// This requires a raw SQL statement
try {
    $db->query("ALTER TABLE users MODIFY COLUMN status ENUM('pending', 'active', 'suspended') DEFAULT 'pending'");
    $db->execute();
    echo "<h1>Package and User Schema Updated!</h1>";
} catch (Exception $e) {
    echo "<h1>Schema Update Failed</h1>" . $e->getMessage();
}

echo "<p><a href='users/login'>Go to Login</a></p>";
