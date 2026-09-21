<?php
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

    if (empty($email)) {
        $_SESSION['reset_error'] = "Please enter your email address.";
        header("Location: ../index.php?login=reset");
        exit;
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, full_name FROM `user` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['reset_error'] = "No account found with that email address.";
        $stmt->close();
        header("Location: ../index.php?login=reset");
        exit;
    }

    $user = $result->fetch_assoc();
    $stmt->close();

    // Generate a secure temporary password
    $temp_password = 'ITLC@' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));

    // Hash and save temporary password
    $hashed = password_hash($temp_password, PASSWORD_DEFAULT);
    $update = $conn->prepare("UPDATE `user` SET password = ? WHERE email = ?");
    $update->bind_param("ss", $hashed, $email);

    if ($update->execute()) {
        $_SESSION['reset_success'] = "Hi <strong>" . htmlspecialchars($user['full_name']) . "</strong>! Your temporary password is: <strong>" . $temp_password . "</strong>. Please login and change it immediately.";
    } else {
        $_SESSION['reset_error'] = "Something went wrong. Please try again.";
    }

    $update->close();
    $conn->close();

    header("Location: ../index.php?login=reset");
    exit;
} else {
    header("Location: ../index.php");
    exit;
}
