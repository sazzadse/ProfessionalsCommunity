<?php
// 1. Include global config & database connection ($conn)
require_once __DIR__ . '/config.php';

// Start session to pass success/error messages across redirects
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and process inputs
    $full_name         = trim($_POST['full_name'] ?? '');
    $email             = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $plain_password    = $_POST['password'] ?? '';
    $mobile            = trim($_POST['mobile'] ?? '');
    $company           = trim($_POST['company'] ?? '');
    $company_address   = trim($_POST['company_address'] ?? '');
    $position          = trim($_POST['position'] ?? '');
    $profession_id     = filter_var($_POST['profession_id'] ?? '', FILTER_VALIDATE_INT);
    $membership_type_id= filter_var($_POST['membership_type_id'] ?? '', FILTER_VALIDATE_INT);
    $highest_education = trim($_POST['highest_education'] ?? '');
    $certification     = trim($_POST['certification'] ?? '');
    $linkedin_url      = filter_var(trim($_POST['linkedin_url'] ?? ''), FILTER_SANITIZE_URL);

    // Basic required field validation
    if (empty($full_name) || empty($email) || empty($plain_password) || empty($mobile) || empty($position) || !$profession_id || !$membership_type_id) {
        $_SESSION['error'] = "Please fill in all mandatory fields.";
        header("Location: ../index.php?signup=error");
        exit;
    }

    // 3. Check if email already exists in the 'user' table
    $check_email = $conn->prepare("SELECT id FROM `user` WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        $_SESSION['error'] = "An account with this email address already exists.";
        $check_email->close();
        header("Location: ../index.php?signup=error");
        exit;
    }
    $check_email->close();

    // 4. CHECK IF MOBILE NUMBER ALREADY EXISTS
    $check_mobile = $conn->prepare("SELECT id FROM `user` WHERE mobile = ?");
    $check_mobile->bind_param("s", $mobile);
    $check_mobile->execute();
    $check_mobile->store_result();

    if ($check_mobile->num_rows > 0) {
        $_SESSION['error'] = "An account with this mobile number already exists.";
        $check_mobile->close();
        header("Location: ../index.php?signup=error");
        exit;
    }
    $check_mobile->close();

    // 5. Generate the formatted membership_id (e.g., ITLC-0001, ITLC-0002)
    $id_query  = "SELECT MAX(id) AS max_id FROM `user`";
    $id_result = $conn->query($id_query);
    $row       = $id_result->fetch_assoc();
    
    $next_id       = ($row['max_id'] ?? 0) + 1;
    $membership_id = "ITLC-" . str_pad($next_id, 4, "0", STR_PAD_LEFT);

    // 6. Securely hash the password
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // 7. Insert data into 'user' table including membership_id and membership_type_id
    $sql = "INSERT INTO `user` (
                membership_id, membership_type_id, full_name, email, password, mobile, 
                company, company_address, position, profession_id, 
                highest_education, certification, linkedin_url
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "sisssssssisss", 
        $membership_id,
        $membership_type_id,
        $full_name, 
        $email, 
        $hashed_password, 
        $mobile, 
        $company, 
        $company_address, 
        $position, 
        $profession_id, 
        $highest_education, 
        $certification, 
        $linkedin_url
    );

    // 8. Execute statement and return response
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registered successfully! Your Membership ID is " . $membership_id;
        header("Location: ../index.php?signup=success");
        exit;
    } else {
        $_SESSION['error'] = "Something went wrong while creating your account. Please try again.";
        header("Location: ../index.php?signup=error");
        exit;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../index.php");
    exit;
}
?>