<?php
// includes/login_process.php

if (ob_get_level() === 0) {
    ob_start();
}

// 1. Include central configuration (starts session and provides database connection $conn)
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Process login POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Validate empty inputs
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please fill in both email and password.";
        session_write_close();
        header("Location: ../index.php?login=error");
        exit;
    }

    // 3. Query user by email
    $stmt = $conn->prepare("SELECT id, membership_id, full_name, email, password FROM `user` WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // 4. Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Prevent session fixation
            session_regenerate_id(true);

            // Store user session variables
            $_SESSION['logged_in']     = true;
            $_SESSION['user_id']       = (int)$user['id'];
            $_SESSION['membership_id'] = $user['membership_id'];
            $_SESSION['full_name']     = $user['full_name'];
            $_SESSION['email']         = $user['email'];

            // Clear any previous errors
            unset($_SESSION['error']);
            $_SESSION['success'] = "Welcome back, " . $user['full_name'] . "!";

            $stmt->close();
            $conn->close();

            // Save session before redirect
            session_write_close();

            // Redirect to member profile page on successful authentication
            header("Location: ../member-profile.php");
            exit;
        }
    }

    // If account not found or password incorrect
    $_SESSION['error'] = "Invalid email address or password.";
    if (isset($stmt)) { $stmt->close(); }
    $conn->close();

    session_write_close();
    header("Location: ../index.php?login=error");
    exit;

} else {
    session_write_close();
    header("Location: ../index.php");
    exit;
}
