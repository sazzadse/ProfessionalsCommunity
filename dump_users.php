<?php
include 'includes/db.php';

$result = $conn->query("SELECT id, full_name, membership_id FROM user");
echo "USERS:\n";
while ($row = $result->fetch_assoc()) {
    echo $row['id'] . " - " . $row['full_name'] . " - Membership: " . $row['membership_id'] . "\n";
}
