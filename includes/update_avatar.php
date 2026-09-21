<?php
// includes/update_avatar.php

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security Check: Redirect unauthenticated users
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || empty($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $file = $_FILES['avatar'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "File upload failed with error code: " . $file['error'];
        header("Location: ../member-profile.php");
        exit;
    }

    // Validate size (max 5MB)
    $max_size = 5 * 1024 * 1024;
    if ($file['size'] > $max_size) {
        $_SESSION['error'] = "File size exceeds maximum limit of 5MB.";
        header("Location: ../member-profile.php");
        exit;
    }

    // Validate file extension
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $file_ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($file_ext, $allowed_exts)) {
        $_SESSION['error'] = "Invalid file format. Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
        header("Location: ../member-profile.php");
        exit;
    }

    // Validate image MIME type
    $check_image = @getimagesize($file['tmp_name']);
    if ($check_image === false) {
        $_SESSION['error'] = "Uploaded file is not a valid image.";
        header("Location: ../member-profile.php");
        exit;
    }

    // Target upload directory
    $target_dir = __DIR__ . '/../images/users/';
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Generate clean unique filename
    $new_filename = 'user_' . $user_id . '_' . time() . '.' . $file_ext;
    $target_path  = $target_dir . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        // Fetch existing avatar to remove old file if needed
        $old_stmt = $conn->prepare("SELECT image FROM `user` WHERE id = ?");
        $old_stmt->bind_param("i", $user_id);
        $old_stmt->execute();
        $old_res = $old_stmt->get_result();
        if ($old_res && $old_row = $old_res->fetch_assoc()) {
            if (!empty($old_row['image'])) {
                $old_file = $target_dir . $old_row['image'];
                if (file_exists($old_file)) {
                    @unlink($old_file);
                }
            }
        }
        $old_stmt->close();

        // Update DB record
        $stmt = $conn->prepare("UPDATE `user` SET image = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $new_filename, $user_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Profile picture updated successfully!";
        } else {
            $_SESSION['error']   = "Failed to update profile picture in database.";
        }
        $stmt->close();

    } else {
        $_SESSION['error'] = "Failed to save uploaded image file.";
    }
}

header("Location: ../member-profile.php");
exit;
?>
