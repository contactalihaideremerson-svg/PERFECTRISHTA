<?php
// Load configuration (handle CLI case)
if (!isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}
require_once 'config/config.php';

// Try to connect to the database
try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $dbh = new PDO($dsn, DB_USER, DB_PASS, $options);

    echo "<h1>Database Fix Script</h1>";
    echo "<p>Connected to database: " . DB_NAME . "</p>";

    // Check if house_status exists
    $result = $dbh->query("SHOW COLUMNS FROM profiles LIKE 'house_status'");
    if ($result->rowCount() == 0) {
        $dbh->exec("ALTER TABLE profiles ADD COLUMN house_status VARCHAR(50) AFTER admin_notes");
        echo "<p style='color: green;'>Added <strong>house_status</strong> column.</p>";
    } else {
        echo "<p style='color: blue;'>Column <strong>house_status</strong> already exists.</p>";
    }

    // Check if house_size exists
    $result = $dbh->query("SHOW COLUMNS FROM profiles LIKE 'house_size'");
    if ($result->rowCount() == 0) {
        $dbh->exec("ALTER TABLE profiles ADD COLUMN house_size VARCHAR(100) AFTER house_status");
        echo "<p style='color: green;'>Added <strong>house_size</strong> column.</p>";
    } else {
        echo "<p style='color: blue;'>Column <strong>house_size</strong> already exists.</p>";
    }

    echo "<h3>Migration completed successfully!</h3>";
    echo "<p>You can now delete this file and try updating your profile again.</p>";

} catch (PDOException $e) {
    echo "<h1>Database Error</h1>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<p>Check your <strong>config/config.php</strong> settings.</p>";
}
