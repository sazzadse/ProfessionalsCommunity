<?php
include 'includes/db.php';

$result = $conn->query("SHOW TABLES");
echo "TABLES:\n";
while ($row = $result->fetch_array()) {
    echo $row[0] . "\n";
    $desc = $conn->query("DESCRIBE " . $row[0]);
    while ($col = $desc->fetch_assoc()) {
        echo "  " . $col['Field'] . " - " . $col['Type'] . "\n";
    }
}
