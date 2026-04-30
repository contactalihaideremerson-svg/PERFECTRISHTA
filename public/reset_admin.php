<?php
// Since this is in the public folder, we need to go up one level
require_once '../config/config.php';
require_once '../app/core/Database.php';

$db = new Database();
$password = 'password123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$db->query("SELECT * FROM users WHERE email = 'admin@perfectrishta.com'");
$user = $db->single();

if (!$user) {
    echo "<h1>Error</h1>";
    echo "<p>Admin user 'admin@perfectrishta.com' not found in database.</p>";
    exit;
}

$db->query("UPDATE users SET password = :password WHERE email = 'admin@perfectrishta.com'");
$db->bind(':password', $hashed_password);

if ($db->execute()) {
    echo "<h1>Success!</h1>";
    echo "<p>Admin password has been reset to: <strong>password123</strong></p>";
    echo "<p>Return to <a href='../users/login'>Login Page</a></p>";
} else {
    echo "<h1>Error</h1>";
    echo "<p>Failed to update password.</p>";
}
