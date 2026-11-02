<?php 
  // Set page title and metadata
  $page_title = "Contact Us";

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
    /* Consistent ITLC Page Layout System */
    .itlc-contact-section {
        padding: 170px 0 60px;
        color: #06487a;
        font-family: "Trebuchet MS", sans-serif;
    }

    .itlc-contact-section .main-title {
        font-size: 25px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 12px;
        color: #ffbc3b;
    }

    .itlc-contact-section .title-accent {
        width: 45px;
        height: 3px;
        background: #06487a;
        border-radius: 2px;
        margin-bottom: 25px;
    }

    .itlc-contact-section .intro-description {
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        margin-bottom: 35px;
    }

    .itlc-contact-section .breadcrumb-link {
        color: #ffbc3b;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .itlc-contact-section .breadcrumb-link:hover {
        color: #ff9800;
        text-decoration: underline;
    }

    .itlc-contact-section .breadcrumb-sep {
        color: #06487a;
        margin: 0 8px;
        font-size: 20px;
    }

    /* Contact Form Box */
    .contact-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 35px 30px;
        box-shadow: 0 8px 25px rgba(6, 72, 122, 0.06);
    }

    .contact-form-card .form-control {
        height: 48px;
        border: 1px solid #d2dce5;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 14.5px;
        color: #334155;
        transition: all 0.25s ease;
    }

    .contact-form-card textarea.form-control {
        height: auto;
        resize: vertical;
    }

    .contact-form-card .form-control:focus {
        border-color: #06487a;
        box-shadow: 0 0 0 3px rgba(6, 72, 122, 0.12);
    }

    .contact-form-card label {
        font-weight: 600;
        color: #06487a;
        font-size: 13.5px;
        margin-bottom: 6px;
    }

    /* Info Sidebar Card */
    .contact-info-card {
        background: linear-gradient(145deg, #06487a 0%, #032b4d 100%);
        border-radius: 8px;
        color: #ffffff;
        padding: 35px 30px;
        box-shadow: 0 8px 25px rgba(6, 72, 122, 0.15);
    }

    .contact-info-card h4 {
        color: #ffffff;
        font-size: 21px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .contact-info-card .card-subtitle {
        color: #ffbc3b;
        font-size: 13.5px;
        font-weight: 600;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 22px;
    }

    .contact-item:last-child {
        margin-bottom: 0;
    }

    .contact-item .icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 188, 59, 0.15);
        color: #ffbc3b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
        margin-right: 16px;
        transition: all 0.3s ease;
    }

    .contact-item:hover .icon-wrapper {
        background: #ffbc3b;
        color: #06487a;
        transform: scale(1.08);
    }

    .contact-item .item-details {
        font-size: 14.5px;
        line-height: 1.5;
    }

    .contact-item .item-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        display: block;
        margin-bottom: 2px;
    }

    .contact-item a {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .contact-item a:hover {
        color: #ffbc3b;
    }

    /* Social Icons */
    .contact-social-icons {
        list-style: none;
        padding: 0;
        margin: 25px 0 0;
        display: flex;
        gap: 10px;
    }

    .contact-social-icons a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .contact-social-icons a:hover {
        background: #ffbc3b;
        color: #06487a;
        transform: translateY(-2px);
    }

    /* Member Banner Box */
    .member-help-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 22px;
        margin-top: 25px;
    }

    /* Map Section */
    .map-container-box {
        margin-top: 50px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(6, 72, 122, 0.06);
    }

    @media (max-width: 767px) {
        .itlc-contact-section {
            padding: 130px 0 40px;
        }

        .itlc-contact-section .main-title {
            font-size: 20px;
        }

        .contact-form-card,
        .contact-info-card {
            padding: 25px 20px;
        }
    }
</style>

<section class="itlc-contact-section">
  <div class="container">

    <!-- Page Header & Breadcrumb -->
    <div class="row">
      <div class="col-12">
        <h1 class="main-title">
          Contact Us
        </h1>
        <div class="title-accent"></div>
      </div>
    </div>

    <!-- Main Content: Form & Contact Info -->
    <div class="row">

      <!-- Left Column: Workable Contact Form -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="contact-form-card">
          <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 22px;">
            Send Us a Message
          </h3>
          <p class="text-muted small mb-4">
            Fill in the details below and your message will be forwarded directly to our communication desk.
          </p>

          <!-- Feedback Alerts -->
          <?php if (!empty($success_msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="ti-check mr-2"></i><?php echo $success_msg; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="ti-alert mr-2"></i><?php echo $error_msg; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif; ?>

          <!-- Contact Form -->
          <form action="contact.php" method="POST">
            <div class="form-group mb-3">
              <label for="contact_name">Your Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contact_name" name="name" 
                     placeholder="Enter your full name" 
                     value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6 mb-3">
                <label for="contact_email">Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="contact_email" name="email" 
                       placeholder="name@example.com" 
                       value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
              </div>
              <div class="form-group col-md-6 mb-3">
                <label for="contact_phone">Phone / Mobile</label>
                <input type="text" class="form-control" id="contact_phone" name="phone" 
                       placeholder="+8801XXXXXXXXX" 
                       value="<?php echo htmlspecialchars($phone ?? ''); ?>">
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="contact_subject">Subject <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="contact_subject" name="subject" 
                     placeholder="e.g. ITLC Membership Inquiry / Event Collaboration" 
                     value="<?php echo htmlspecialchars($subject ?? ''); ?>" required>
            </div>

            <div class="form-group mb-4">
              <label for="contact_message">Your Message <span class="text-danger">*</span></label>
              <textarea class="form-control" id="contact_message" name="message" rows="5" 
                        placeholder="Write your inquiry or message here..." required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
            </div>

            <button type="submit" name="send_contact_message" class="btn btn-primary text-uppercase font-weight-bold px-4 py-2" style="font-size: 14px; letter-spacing: 0.5px;">
              <i class="ti-location-arrow mr-2"></i>Send Message
            </button>
          </form>

        </div>
      </div>

      <!-- Right Column: Official Contact Details -->
      <div class="col-lg-5">
        
        <!-- Info Card -->
        <div class="contact-info-card">
          <h4>IT Leadership Community</h4>
          <div class="card-subtitle">The Voice of IT Leaders</div>

          <!-- Address -->
          <div class="contact-item">
            <div class="icon-wrapper">
              <i class="ti-location-pin"></i>
            </div>
            <div class="item-details">
              <span class="item-label">Address</span>
              <strong class="text-white">ITLC, Dhaka, Bangladesh</strong>
            </div>
          </div>

          <!-- Telephone -->
          <div class="contact-item">
            <div class="icon-wrapper">
              <i class="ti-mobile"></i>
            </div>
            <div class="item-details">
              <span class="item-label">Telephone</span>
              <a href="tel:+8801710817997" class="font-weight-bold" style="font-size: 16px;">
                +8801710817997
              </a>
            </div>
          </div>

          <!-- Email -->
          <div class="contact-item">
            <div class="icon-wrapper">
              <i class="ti-email"></i>
            </div>
            <div class="item-details">
              <span class="item-label">Official Email</span>
              <a href="mailto:fokrulislamrasel@gmail.com" class="font-weight-bold">
                fokrulislamrasel@gmail.com
              </a>
            </div>
          </div>

          <!-- Social Links -->
          <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.12);">
            <span class="small text-white-50 font-weight-bold text-uppercase d-block mb-2">Connect With Us</span>
            <ul class="contact-social-icons">
              <li><a href="#" target="_blank" title="Facebook"><i class="ti-facebook"></i></a></li>
              <li><a href="#" target="_blank" title="Twitter"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#" target="_blank" title="LinkedIn"><i class="ti-linkedin"></i></a></li>
              <li><a href="#" target="_blank" title="YouTube"><i class="ti-youtube"></i></a></li>
            </ul>
          </div>
        </div>

        <!-- Membership Portal Box -->
        <div class="member-help-box text-center">
          <h6 class="font-weight-bold mb-1" style="color: #06487a;">Looking to Join ITLC?</h6>
          <p class="text-muted small mb-3">
            Join the community of CIOs, CTOs, and IT Leaders shaping the tech future.
          </p>
          <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline btn-sm font-weight-bold text-uppercase py-2 px-3" style="font-size: 12.5px;">
            <i class="ti-id-badge mr-1"></i>Apply for Membership
          </a>
        </div>

      </div>

    </div>

    <!-- Interactive Location Map: Dhaka, Bangladesh -->
    <div class="row">
      <div class="col-12">
        <div class="map-container-box">
          <div class="p-3 bg-white border-bottom d-flex align-items-center">
            <i class="ti-map-alt text-warning mr-2" style="font-size: 20px;"></i>
            <h5 class="mb-0 font-weight-bold" style="color: #06487a; font-size: 16px;">
              Community Location — Dhaka, Bangladesh
            </h5>
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