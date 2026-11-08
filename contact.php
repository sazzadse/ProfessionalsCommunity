<?php 
  // Set page title and metadata
  $page_title = "Contact Us - IT Leadership Community";
  $current_page = "contact";

  // Include configuration and database
  include 'includes/config.php';

  $success_msg = '';
  $error_msg = '';

  // Process Contact Form Submission
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_contact_message'])) {
      $name    = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
      $email   = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
      $phone   = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
      $subject = isset($_POST['subject']) ? trim(strip_tags($_POST['subject'])) : '';
      $message = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

      // Validation
      if (empty($name) || empty($email) || empty($subject) || empty($message)) {
          $error_msg = "Please fill in all mandatory fields (Name, Email, Subject, and Message).";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error_msg = "Please enter a valid email address.";
      } else {
          // Target recipient email
          $to_email = "fokrulislamrasel@gmail.com";
          $mail_subject = "New Inquiry: " . $subject . " - ITLC Contact Form";

          // Construct plain text email body
          $body  = "You have received a new contact inquiry from the IT Leadership Community (ITLC) website:\r\n\r\n";
          $body .= "--------------------------------------------------\r\n";
          $body .= "Name    : " . $name . "\r\n";
          $body .= "Email   : " . $email . "\r\n";
          $body .= "Phone   : " . (!empty($phone) ? $phone : "Not Provided") . "\r\n";
          $body .= "Subject : " . $subject . "\r\n";
          $body .= "Date    : " . date("d F Y, h:i A") . "\r\n";
          $body .= "IP      : " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "\r\n";
          $body .= "--------------------------------------------------\r\n\r\n";
          $body .= "Message:\r\n" . $message . "\r\n\r\n";
          $body .= "--------------------------------------------------\r\n";

          // Determine host domain for sender address
          $host_domain = !empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] !== 'localhost' 
              ? preg_replace('/^www\./i', '', $_SERVER['SERVER_NAME']) 
              : 'itlc.org';
          $from_email  = "noreply@" . $host_domain;

          // MIME-compliant headers for reliable live hosting delivery
          $encoded_subject     = "=?UTF-8?B?" . base64_encode($mail_subject) . "?=";
          $encoded_from_name   = "=?UTF-8?B?" . base64_encode("ITLC Contact Form") . "?=";
          $encoded_sender_name = "=?UTF-8?B?" . base64_encode($name) . "?=";

          $headers  = "From: " . $encoded_from_name . " <" . $from_email . ">\r\n";
          $headers .= "Reply-To: " . $encoded_sender_name . " <" . $email . ">\r\n";
          $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
          $headers .= "Content-Transfer-Encoding: 8bit\r\n";

          // Send email using PHP mail() with envelope sender parameter (-f)
          $sent = @mail($to_email, $encoded_subject, $body, $headers, "-f" . $from_email);
          if (!$sent) {
              // Retry without -f flag if host server restricts 5th parameter
              $sent = @mail($to_email, $encoded_subject, $body, $headers);
          }

          // Localhost detection (allows testing form flow without a local mail server)
          $is_localhost = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']) || ($_SERVER['SERVER_NAME'] ?? '') === 'localhost';

          if ($sent || $is_localhost) {
              $success_msg = "Thank you, <strong>" . htmlspecialchars($name) . "</strong>! Your message has been sent successfully to <strong>ITLC</strong>. Our team will get back to you shortly.";
              // Clear fields after successful send
              $name = $email = $phone = $subject = $message = '';
          } else {
              $error_msg = "We were unable to deliver your email at this time. Please try again or email us directly at <a href='mailto:fokrulislamrasel@gmail.com' class='text-primary font-weight-bold'>fokrulislamrasel@gmail.com</a>.";
          }
      }
  }

  include 'includes/header.php';
?>

<style>
/* Modern 2026 Contact Page Styling */
.itlc-contact-metric-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 8px 24px rgba(6, 72, 122, 0.04);
    padding: 24px 20px;
    display: flex;
    align-items: center;
    height: 100%;
    transition: all 0.3s ease;
}

.itlc-contact-metric-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 35px rgba(6, 72, 122, 0.12);
    border-color: rgba(245, 158, 11, 0.4);
}

.itlc-contact-metric-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    background: rgba(6, 72, 122, 0.08);
    color: #06487a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-right: 16px;
    flex-shrink: 0;
    transition: all 0.25s ease;
}

.itlc-contact-metric-card:hover .itlc-contact-metric-icon {
    background: #f59e0b;
    color: #03233e;
}

.itlc-contact-metric-label {
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 3px;
}

.itlc-contact-metric-value {
    font-size: 15px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.3;
}

.itlc-contact-metric-value a {
    color: #06487a;
    text-decoration: none;
    transition: color 0.2s ease;
}

.itlc-contact-metric-value a:hover {
    color: #f59e0b;
}

/* Form Styles */
.itlc-contact-form-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    padding: 36px 32px;
}

.itlc-contact-form-card .form-control {
    background-color: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    height: 48px;
    font-size: 14.5px;
    color: #1e293b;
    padding: 10px 14px;
    transition: all 0.25s ease;
}

.itlc-contact-form-card textarea.form-control {
    height: auto;
    resize: vertical;
}

.itlc-contact-form-card .form-control:focus {
    background-color: #ffffff;
    border-color: #06487a;
    box-shadow: 0 0 0 3px rgba(6, 72, 122, 0.12);
}

.itlc-contact-label {
    font-size: 13px;
    font-weight: 700;
    color: #06487a;
    margin-bottom: 6px;
    display: block;
}

/* Info Sidebar Card */
.itlc-contact-info-card {
    background: linear-gradient(135deg, #06487a 0%, #03233e 100%);
    border-radius: 16px;
    color: #ffffff;
    padding: 36px 30px;
    box-shadow: 0 12px 35px rgba(6, 72, 122, 0.15);
    margin-bottom: 24px;
}

.itlc-contact-info-card h4 {
    color: #ffffff;
    font-size: 21px;
    font-weight: 700;
    margin-bottom: 4px;
}

.itlc-contact-info-subtitle {
    color: #f59e0b;
    font-size: 12.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 24px;
}

.itlc-contact-detail-row {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.itlc-contact-detail-row:last-child {
    margin-bottom: 0;
}

.itlc-contact-detail-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(245, 158, 11, 0.15);
    color: #f59e0b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    margin-right: 14px;
    flex-shrink: 0;
}

.itlc-contact-detail-title {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 2px;
}

.itlc-contact-detail-text {
    font-size: 14.5px;
    color: #ffffff;
    line-height: 1.4;
}

.itlc-contact-detail-text a {
    color: #ffffff;
    text-decoration: none;
    transition: color 0.2s ease;
}

.itlc-contact-detail-text a:hover {
    color: #f59e0b;
}

/* Social Buttons */
.itlc-contact-socials {
    display: flex;
    gap: 10px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
}

.itlc-contact-social-btn {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.itlc-contact-social-btn:hover {
    background: #f59e0b;
    color: #03233e;
    transform: translateY(-2px);
}

/* Membership CTA Box */
.itlc-contact-membership-box {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 8px 24px rgba(6, 72, 122, 0.04);
    padding: 26px 24px;
    text-align: center;
}

/* Map Container */
.itlc-map-card {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    background: #ffffff;
    margin-top: 50px;
}

.itlc-map-card-header {
    padding: 16px 22px;
    background: #ffffff;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    font-size: 15px;
    font-weight: 700;
    color: #06487a;
}

.itlc-map-card-header i {
    color: #f59e0b;
    margin-right: 10px;
    font-size: 18px;
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-headset mr-1"></i> Communication Desk</div>
        <h1 class="itlc-hero-title">Get in Touch With <span>ITLC</span></h1>
        <p class="itlc-hero-desc">Have questions regarding membership tiers, conference registrations, or corporate partnerships? Our executive team is here to assist.</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="member.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-users mr-2"></i> Member Directory
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Contact Content Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">

    <!-- 3 High-Impact Contact Metric Tiles -->
    <div class="row mb-5">
      <div class="col-md-4 mb-3 mb-md-0">
        <div class="itlc-contact-metric-card">
          <div class="itlc-contact-metric-icon"><i class="fa-solid fa-building-columns"></i></div>
          <div>
            <div class="itlc-contact-metric-label">Headquarters</div>
            <div class="itlc-contact-metric-value">Dhaka, Bangladesh</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <div class="itlc-contact-metric-card">
          <div class="itlc-contact-metric-icon"><i class="fa-solid fa-phone-volume"></i></div>
          <div>
            <div class="itlc-contact-metric-label">Direct Hotline</div>
            <div class="itlc-contact-metric-value"><a href="tel:+8801710817997">+8801710817997</a></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="itlc-contact-metric-card">
          <div class="itlc-contact-metric-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
          <div>
            <div class="itlc-contact-metric-label">Official Inquiries</div>
            <div class="itlc-contact-metric-value"><a href="mailto:fokrulislamrasel@gmail.com">fokrulislamrasel@gmail.com</a></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content: Form & Official Details -->
    <div class="row">

      <!-- Left Column: Modern Contact Form -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="itlc-contact-form-card">
          <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 22px;">
            Send Us an Inquiry
          </h3>
          <p class="text-muted small mb-4">
            Fill in the details below and your message will be forwarded directly to our communication desk.
          </p>

          <!-- Feedback Alerts -->
          <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
              <i class="fa-solid fa-circle-check mr-2"></i><?php echo $success_msg; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
              <i class="fa-solid fa-triangle-exclamation mr-2"></i><?php echo $error_msg; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <!-- Contact Form -->
          <form action="contact.php" method="POST">
            <div class="form-group mb-3">
              <label for="contact_name" class="itlc-contact-label">Your Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contact_name" name="name" 
                     placeholder="Enter your full name" 
                     value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6 mb-3">
                <label for="contact_email" class="itlc-contact-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="contact_email" name="email" 
                       placeholder="name@example.com" 
                       value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="contact_phone" class="itlc-contact-label">Phone / Mobile</label>
                <input type="text" class="form-control" id="contact_phone" name="phone" 
                       placeholder="+8801XXXXXXXXX" 
                       value="<?php echo htmlspecialchars($phone ?? ''); ?>">
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="contact_subject" class="itlc-contact-label">Subject <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contact_subject" name="subject" 
                     placeholder="e.g. ITLC Membership Inquiry / Event Collaboration" 
                     value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>
            </div>

            <div class="form-group mb-4">
              <label for="contact_message" class="itlc-contact-label">Your Message <span class="text-danger">*</span></label>
              <textarea class="form-control" id="contact_message" name="message" rows="5" 
                        placeholder="Write your inquiry or message here..." required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
            </div>

            <button type="submit" name="send_contact_message" class="btn btn-primary px-4 py-2 font-weight-bold" style="font-size: 14px; letter-spacing: 0.5px;">
              <i class="fa-solid fa-paper-plane mr-2"></i> Send Message
            </button>
          </form>

        </div>
      </div>

      <!-- Right Column: Official Contact Details -->
      <div class="col-lg-5">
        
        <!-- Info Card -->
        <div class="itlc-contact-info-card">
          <h4>IT Leadership Community</h4>
          <div class="itlc-contact-info-subtitle">The Voice of IT Leaders</div>

          <!-- Address -->
          <div class="itlc-contact-detail-row">
            <div class="itlc-contact-detail-icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
              <div class="itlc-contact-detail-title">Secretariat Address</div>
              <div class="itlc-contact-detail-text font-weight-bold">
                ITLC Secretariat, Dhaka, Bangladesh
              </div>
            </div>
          </div>

          <!-- Telephone -->
          <div class="itlc-contact-detail-row">
            <div class="itlc-contact-detail-icon">
              <i class="fa-solid fa-phone"></i>
            </div>
            <div>
              <div class="itlc-contact-detail-title">Telephone</div>
              <div class="itlc-contact-detail-text">
                <a href="tel:+8801710817997" class="font-weight-bold">
                  +8801710817997
                </a>
              </div>
            </div>
          </div>

          <!-- Email -->
          <div class="itlc-contact-detail-row">
            <div class="itlc-contact-detail-icon">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
              <div class="itlc-contact-detail-title">Official Email</div>
              <div class="itlc-contact-detail-text">
                <a href="mailto:fokrulislamrasel@gmail.com" class="font-weight-bold">
                  fokrulislamrasel@gmail.com
                </a>
              </div>
            </div>
          </div>

          <!-- Social Links -->
          <div class="itlc-contact-socials">
            <a href="#" target="_blank" title="LinkedIn" class="itlc-contact-social-btn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" target="_blank" title="X / Twitter" class="itlc-contact-social-btn"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" target="_blank" title="Facebook" class="itlc-contact-social-btn"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" target="_blank" title="YouTube" class="itlc-contact-social-btn"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <!-- Membership Portal Box -->
        <div class="itlc-contact-membership-box">
          <h5 class="font-weight-bold mb-2" style="color: #06487a;">Looking to Join ITLC?</h5>
          <p class="text-muted small mb-3">
            Join the elite network of CIOs, CTOs, and IT Leaders driving national digital transformation.
          </p>
          <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline btn-sm font-weight-bold text-uppercase py-2 px-3" style="font-size: 12.5px;">
            <i class="fa-solid fa-id-badge mr-1"></i> Apply for Membership
          </a>
        </div>

      </div>

    </div>

    <!-- Interactive Location Map: Dhaka, Bangladesh -->
    <div class="row">
      <div class="col-12">
        <div class="itlc-map-card">
          <div class="itlc-map-card-header">
            <i class="fa-solid fa-map-location-dot"></i>
            <span>Community Location &mdash; Dhaka, Bangladesh</span>
          </div>
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.38703692693!2d90.272926!3d23.7805733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1714000000000" 
            width="100%" 
            height="360" 
            style="border:0; display:block;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>

  </div>
</section>

<?php 
  include 'includes/footer.php'; 
?>
