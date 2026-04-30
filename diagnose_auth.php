<?php
require_once '../app/bootstrap.php';
$db = new Database();

echo "<h1>Authentication Diagnostic (Live)</h1>";

// 1. Check Table Definition
echo "<h2>1. Table Structure</h2>";
try {
    $db->query("DESCRIBE users");
    $columns = $db->resultSet();
    $found = false;
    foreach ($columns as $col) {
        if ($col->Field == 'status') {
            echo "<p><b>Field:</b> status | <b>Type:</b> {$col->Type} | <b>Default:</b> [" . ($col->Default ?? 'NULL') . "]</p>";
            $found = true;
        }
    }
    if (!$found)
        echo "<p style='color:red;'>ERROR: 'status' column not found in database!</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'>SQL ERROR: " . $e->getMessage() . "</p>";
}

// 2. Perform Test Registration
echo "<h2>2. Testing Model Registration</h2>";
$testEmail = 'test_' . time() . '@example.com';
$data = [
    'name' => 'Diagnostic User',
    'email' => $testEmail,
    'password' => password_hash('password123', PASSWORD_DEFAULT),
    'phone' => '123456789'
];

$userModel = new User();
try {
    if ($userModel->register($data)) {
        echo "<p style='color:green'>SUCCESS: Model reported successful registration.</p>";

        // Check what was actually inserted
        $db->query("SELECT id, name, email, status FROM users WHERE email = :email");
        $db->bind(':email', $testEmail);
        $insertedUser = $db->single();

        if ($insertedUser) {
            echo "<p><b>Inserted User Status:</b> <span style='font-size:1.5em; background:yellow;'>[{$insertedUser->status}]</span></p>";

            if ($insertedUser->status === 'active') {
                echo "<p style='color:red; font-weight:bold;'>CRITICAL: User was born as 'active'. The database default is still wrong.</p>";
            } else if ($insertedUser->status === 'pending') {
                echo "<p style='color:green; font-weight:bold;'>NORMAL: User was born as 'pending'. Registration logic is working.</p>";
            } else {
                echo "<p style='color:orange;'>UNKNOWN: User status is '{$insertedUser->status}'.</p>";
            }

            // 3. Test Login Logic (Simulated Controller)
            echo "<h2>3. Testing Controller Login Logic</h2>";
            $loggedInUser = $userModel->login($testEmail, 'password123');
            if ($loggedInUser) {
                echo "<p>Simulated Login Result: User Found.</p>";
                echo "<p>Checking <code>if (\$loggedInUser->status === 'active')</code> ...</p>";

                if ($loggedInUser->status === 'active') {
                    echo "<p style='color:red; font-weight:bold;'>RESULT: Login ALLOWED (Bypassed Approval).</p>";
                } else {
                    echo "<p style='color:green; font-weight:bold;'>RESULT: Login BLOCKED (Approval Required). This is correct.</p>";
                }
            }
        }
    } else {
        echo "<p style='color:red'>FAILURE: Model reported registration failed.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red;'>ERROR: " . $e->getMessage() . "</p>";
}

echo "<hr><p><b>Note:</b> If the results above don't match the new code, then your server files are not updated with the latest changes.</p>";
?>