<?php
require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate email input
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {$_SESSION['reset_error'] = "Please enter a valid email address.";
        header("Location: ../index.php?login=reset");
        exit;
    }

    // Check if user exists in the database
    $stmt =$conn->prepare("SELECT id, full_name FROM `user` WHERE email = ?");
    $stmt->bind_param("s", $email);$stmt->execute();
    $result =$stmt->get_result();

    if ($result->num_rows === 0) {$_SESSION['reset_error'] = "No account found with that email address.";
        $stmt->close();$conn->close();
        header("Location: ../index.php?login=reset");
        exit;
    }

    $user = $result->fetch_assoc();$stmt->close();

    // Generate a default random 6-digit temporary password (e.g., ITLC@482910)
    $random_digits = random_int(100000, 999999);
    $temp_password = 'ITLC@' .$random_digits;

    // Hash the temporary password securely using PASSWORD_DEFAULT
    $hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

    // Directly update the user's password in the database
    $update =$conn->prepare("UPDATE `user` SET password = ? WHERE email = ?");
    $update->bind_param("ss", $hashed_password,$email);

    if ($update->execute()) {
        
        /* =========================================================
         * OPTION A: LOCAL TESTING MODE (Currently Active)
         * Displays the temporary password directly on screen.
         * Useful for localhost where mail servers are not configured.
         * ========================================================= */
        $_SESSION['reset_success'] = "LOCAL TEST MODE - Your temporary password is: <strong>" . $temp_password . "</strong>";


        /* =========================================================
         * OPTION B: LIVE SERVER MAIL MODE (Currently Commented Out)
         * Uncomment this block when deploying to a live hosting server 
         * and comment out/remove Option A above.
         * ========================================================= */
        /*
        $to =$email;
        $subject = "ITLC Community - Temporary Password";
        
        $message = "Hi " . $user['full_name'] . ",\n\n"
                 . "We received a request to reset your password for your ITLC Community account.\n"
                 . "Your temporary password is: " . $temp_password . "\n\n"
                 . "Please log in using this temporary password immediately and update it from your profile settings.\n\n"
                 . "If you did not request a password reset, please ignore this email.\n\n"
                 . "Best regards,\nITLC Community Team";
        
        $headers  = "From: nurulhoq85@gmail.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Send email via server mail() function
        if (mail($to, $subject,$message, $headers)) {$_SESSION['reset_success'] = "A temporary password has been sent to your email address. Please log in using it and change your password immediately.";
        } else {
            $_SESSION['reset_error'] = "Failed to send email. Please try again later.";
        }
        */

    } else {
        $_SESSION['reset_error'] = "Something went wrong. Please try again later.";
    }

    $update->close();$conn->close();

    header("Location: ../index.php?login=reset");
    exit;

} else {
    header("Location: ../index.php");
    exit;
}
?>