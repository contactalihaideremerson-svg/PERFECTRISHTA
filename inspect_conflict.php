<?php
require_once 'app/bootstrap.php';
$db = new Database();

$ids = [15, 20];
foreach ($ids as $id) {
    $db->query("SELECT id, name, email, created_at, role, status FROM users WHERE id = :id");
    $db->bind(':id', $id);
    $user = $db->single();

    echo "------------------------------------------------\n";
    if ($user) {
        echo "User ID: " . $user->id . "\n";
        echo "Name:    " . $user->name . "\n";
        echo "Email:   " . $user->email . "\n";
        echo "Role:    " . $user->role . "\n";
        echo "Status:  " . $user->status . "\n";
        echo "Created: " . $user->created_at . "\n";
    } else {
        echo "User ID $id NOT FOUND.\n";
    }
}
echo "------------------------------------------------\n";
