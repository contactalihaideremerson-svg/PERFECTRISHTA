<?php
require_once '../config/config.php';
require_once '../app/core/Database.php';

$db = new Database();

echo "<h1>Updating Subscriptions Schema...</h1>";

$queries = [
    "ALTER TABLE subscriptions MODIFY COLUMN status ENUM('active', 'expired', 'cancelled', 'pending', 'rejected') DEFAULT 'pending'",
    "ALTER TABLE subscriptions ADD COLUMN IF NOT EXISTS payment_method VARCHAR(100) AFTER status",
    "ALTER TABLE subscriptions ADD COLUMN IF NOT EXISTS payment_proof VARCHAR(255) AFTER payment_method",
    "ALTER TABLE subscriptions ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
    "ALTER TABLE subscriptions ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
];

foreach ($queries as $sql) {
    try {
        $db->query($sql);
        $db->execute();
        echo "<p style='color:green'>SUCCESS: " . htmlspecialchars($sql) . "</p>";
    } catch (Exception $e) {
        echo "<p style='color:red'>FAILED: " . $e->getMessage() . "</p>";
    }
}

echo "<h3>Update Complete!</h3>";
