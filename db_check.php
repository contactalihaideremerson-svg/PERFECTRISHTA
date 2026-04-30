<?php
if (!isset($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}
require_once 'config/config.php';

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $dbh = new PDO($dsn, DB_USER, DB_PASS);

    echo "COLUMNS IN 'profiles':" . PHP_EOL;
    $q = $dbh->query("DESCRIBE profiles");
    while ($f = $q->fetch(PDO::FETCH_ASSOC)) {
        echo $f['Field'] . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
