<?php
// includes/db.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "itlc_community";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// Set charset globally for all included files
$conn->set_charset("utf8mb4");