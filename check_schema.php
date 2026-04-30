<?php
require_once 'app/bootstrap.php';
$db = new Database();

function checkTable($db, $table)
{
    echo "<h2>Schema for $table</h2>";
    $db->query("DESCRIBE $table");
    $columns = $db->resultSet();
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    foreach ($columns as $col) {
        echo "<tr>";
        echo "<td>{$col->Field}</td>";
        echo "<td>{$col->Type}</td>";
        echo "<td>{$col->Null}</td>";
        echo "<td>{$col->Key}</td>";
        echo "<td>{$col->Default}</td>";
        echo "<td>{$col->Extra}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

checkTable($db, 'users');
checkTable($db, 'profiles');
checkTable($db, 'subscriptions');
?>