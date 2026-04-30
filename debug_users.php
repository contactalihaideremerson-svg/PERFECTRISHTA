<?php
require_once 'app/bootstrap.php';
$db = new Database();
// Check for the specific email
echo "Checking for email: haisamraza51214@gmail.com\n";
$db->query("SELECT id, email, name FROM users WHERE email = 'haisamraza51214@gmail.com'");
$res = $db->resultSet();
print_r($res);

// Also list all users to be sure
echo "\nAll Users with similar email:\n";
$db->query("SELECT id, email, name FROM users WHERE email LIKE '%haisam%'");
$res2 = $db->resultSet();
print_r($res2);
