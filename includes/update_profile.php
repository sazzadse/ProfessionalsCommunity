<?php
// includes/update_profile.php

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action  = $_POST['action'] ?? 'update_profile';
    $is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_POST['is_ajax']) && $_POST['is_ajax'] == '1');

    // ==========================================
    // ACTION: CHANGE PASSWORD (single AJAX request)
    // Validates AND updates in one round-trip, always
    // returns JSON so the UI can show a message no
    // matter what happens.
    // ==========================================
    if ($action === 'change_password') {
        header('Content-Type: application/json');

        $current_password = $_POST['current_password'] ?? '';
        $new_password      = $_POST['new_password'] ?? '';
        $confirm_password  = $_POST['confirm_password'] ?? '';

        // Validation: all fields required
        if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all password fields.']);
            exit;
        }

        // Validation: new + confirm must match
        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'New password and Repeat New Password do not match.']);
            exit;
        }

        // Validation: minimum length
        if (strlen($new_password) < 6) {
            echo json_encode(['success' => false, 'message' => 'New password must be at least 6 characters long.']);
            exit;
        }

        // Fetch current hashed password
        $pwd_stmt = $conn->prepare("SELECT password FROM `user` WHERE id = ?");
        $pwd_stmt->bind_param("i", $user_id);
        $pwd_stmt->execute();
        $pwd_result = $pwd_stmt->get_result();

        if (!$pwd_result || $pwd_result->num_rows !== 1) {
            $pwd_stmt->close();
            echo json_encode(['success' => false, 'message' => 'User account not found.']);
            exit;
        }

        $user = $pwd_result->fetch_assoc();
        $pwd_stmt->close();

        // Validation: current password must be correct
        if (!password_verify($current_password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
            exit;
        }

        // Optional: block re-using the same password
        if (password_verify($new_password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'New password must be different from your current password.']);
            exit;
        }

        // Update password
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE `user` SET password = ?, updated_at = NOW() WHERE id = ?");
        $update_stmt->bind_param("si", $new_hashed_password, $user_id);

        if ($update_stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Password updated successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update password. Please try again.']);
        }

        $update_stmt->close();
        exit;
    }

    // ==========================================
    // ACTION 1: UPDATE PROFILE DETAILS
    // ==========================================
    if ($action === 'update_profile') {

        $full_name         = trim($_POST['full_name'] ?? '');
        $email             = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $mobile            = trim($_POST['mobile'] ?? '');
        $country_id        = !empty($_POST['country_id']) ? (int)$_POST['country_id'] : null;
        $present_address   = trim($_POST['present_address'] ?? '');
        $website_url       = filter_var(trim($_POST['website_url'] ?? ''), FILTER_SANITIZE_URL);
        $biography         = trim($_POST['biography'] ?? '');
        $date_of_birth     = !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : null;
        $profession_id     = !empty($_POST['profession_id']) ? (int)$_POST['profession_id'] : null;
        $position          = trim($_POST['position'] ?? '');
        $company           = trim($_POST['company'] ?? '');
        $company_address   = trim($_POST['company_address'] ?? '');
        $highest_education = trim($_POST['highest_education'] ?? '');
        $certification     = trim($_POST['certification'] ?? '');
        $linkedin_url      = filter_var(trim($_POST['linkedin_url'] ?? ''), FILTER_SANITIZE_URL);
        $blood_group       = trim($_POST['blood_group'] ?? '');
        $facebook_url      = trim($_POST['facebook_url'] ?? '');
        $twitter_url       = trim($_POST['twitter_url'] ?? '');
        $youtube_url       = trim($_POST['youtube_url'] ?? '');
        $cv_link           = filter_var(trim($_POST['cv_link'] ?? ''), FILTER_SANITIZE_URL);

        // Required field validation
        if (empty($full_name) || empty($email) || empty($mobile) || empty($position) || !$profession_id) {
            $msg = "Please fill in all mandatory profile fields.";
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $msg]);
                exit;
            }
            $_SESSION['error'] = $msg;
            header("Location: ../edit-profile.php?tab=profile");
            exit;
        }

        // Email uniqueness validation
        $check_email = $conn->prepare("SELECT id FROM `user` WHERE email = ? AND id != ?");
        $check_email->bind_param("si", $email, $user_id);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
            $msg = "Another account with this email address already exists.";
            $check_email->close();
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $msg]);
                exit;
            }
            $_SESSION['error'] = $msg;
            header("Location: ../edit-profile.php?tab=profile");
            exit;
        }
        $check_email->close();

        // Update user record query
        $sql = "UPDATE `user` SET 
                    full_name = ?,
                    email = ?,
                    mobile = ?,
                    country_id = ?,
                    present_address = ?,
                    website_url = ?,
                    biography = ?,
                    date_of_birth = ?,
                    profession_id = ?,
                    position = ?,
                    company = ?,
                    company_address = ?,
                    highest_education = ?,
                    certification = ?,
                    linkedin_url = ?,
                    blood_group = ?,
                    facebook_url = ?,
                    twitter_url = ?,
                    youtube_url = ?,
                    cv_link = ?,
                    updated_at = NOW()
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssissssisssssssssssi",
            $full_name,
            $email,
            $mobile,
            $country_id,
            $present_address,
            $website_url,
            $biography,
            $date_of_birth,
            $profession_id,
            $position,
            $company,
            $company_address,
            $highest_education,
            $certification,
            $linkedin_url,
            $blood_group,
            $facebook_url,
            $twitter_url,
            $youtube_url,
            $cv_link,
            $user_id
        );

        if ($stmt->execute()) {
            $_SESSION['full_name'] = $full_name;
            $_SESSION['email']     = $email;
            $msg = "Profile details updated successfully!";
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => $msg]);
                exit;
            }
            $_SESSION['success']   = $msg;
        } else {
            $msg = "Failed to update profile details. Please try again.";
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $msg]);
                exit;
            }
            $_SESSION['error']     = $msg;
        }

        $stmt->close();
        header("Location: ../member-profile.php");
        exit;
    }

    // ==========================================
    // ACTION 2: UPDATE OTHERS INFO
    // ==========================================
    elseif ($action === 'update_others') {

        $event_payment_account_id  = !empty($_POST['event_payment_account_id']) ? (int)$_POST['event_payment_account_id'] : null;
        $event_trans_num           = trim($_POST['event_trans_num'] ?? '');
        $t_shirt_size              = trim($_POST['t_shirt_size'] ?? '');
        $transport_support         = trim($_POST['transport_support'] ?? '');
        $user_location_address     = trim($_POST['user_location_address'] ?? '');
        $member_payment_account_id = !empty($_POST['member_payment_account_id']) ? (int)$_POST['member_payment_account_id'] : null;
        $member_trans_num          = trim($_POST['member_trans_num'] ?? '');
        $is_profile_public         = isset($_POST['is_profile_public']) ? (int)$_POST['is_profile_public'] : 0;
        $has_blog_permission       = isset($_POST['has_blog_permission']) ? (int)$_POST['has_blog_permission'] : 0;

        $sql = "UPDATE `user` SET 
                    event_payment_account_id = ?,
                    event_trans_num = ?,
                    t_shirt_size = ?,
                    transport_support = ?,
                    user_location_address = ?,
                    member_payment_account_id = ?,
                    member_trans_num = ?,
                    is_profile_public = ?,
                    has_blog_permission = ?,
                    updated_at = NOW()
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "issssisiii",
            $event_payment_account_id,
            $event_trans_num,
            $t_shirt_size,
            $transport_support,
            $user_location_address,
            $member_payment_account_id,
            $member_trans_num,
            $is_profile_public,
            $has_blog_permission,
            $user_id
        );

        if ($stmt->execute()) {
            $msg = "Other info updated successfully!";
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => $msg]);
                exit;
            }
            $_SESSION['success'] = $msg;
        } else {
            $msg = "Failed to update additional information.";
            if ($is_ajax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $msg]);
                exit;
            }
            $_SESSION['error']   = $msg;
        }

        $stmt->close();
        header("Location: ../member-profile.php");
        exit;
    }
}

// Fallback redirect
header("Location: ../member-profile.php");
exit;
?>