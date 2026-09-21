<?php
include 'includes/db.php';

// 1. Create membership_type table
$sql1 = "CREATE TABLE IF NOT EXISTS `membership_type` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `membership_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if ($conn->query($sql1)) {
    echo "Table membership_type created successfully.\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// 2. Insert membership types
$types = [
    'Lifetime Member',
    'Professional Member',
    'General Member',
    'Student Member'
];

foreach ($types as $type) {
    $check = $conn->prepare("SELECT id FROM membership_type WHERE membership_name = ?");
    $check->bind_param("s", $type);
    $check->execute();
    $check->store_result();
    if ($check->num_rows == 0) {
        $insert = $conn->prepare("INSERT INTO membership_type (membership_name) VALUES (?)");
        $insert->bind_param("s", $type);
        $insert->execute();
    }
    $check->close();
}
echo "Membership types seeded.\n";

// 3. Add membership_type_id to user table if it doesn't exist
$check_col = $conn->query("SHOW COLUMNS FROM `user` LIKE 'membership_type_id'");
if ($check_col->num_rows == 0) {
    if ($conn->query("ALTER TABLE `user` ADD `membership_type_id` INT NULL AFTER `membership_id`")) {
        echo "Column membership_type_id added to user table.\n";
    } else {
        echo "Error adding column: " . $conn->error . "\n";
    }
}

// 4. Update existing 10 users (15-24)
// First 4 (15, 16, 17, 18) -> Lifetime (id=1)
// Next 3 (19, 20, 21) -> Professional (id=2)
// Last 3 (22, 23, 24) -> General (id=3)

$updates = [
    1 => [15, 16, 17, 18],
    2 => [19, 20, 21],
    3 => [22, 23, 24]
];

foreach ($updates as $type_id => $user_ids) {
    $ids = implode(",", $user_ids);
    $conn->query("UPDATE `user` SET membership_type_id = $type_id WHERE id IN ($ids)");
}
echo "Users updated successfully.\n";

$conn->close();
