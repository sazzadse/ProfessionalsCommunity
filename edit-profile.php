<?php 
// edit-profile.php
if (ob_get_level() === 0) {
    ob_start();
}

$page_title = "Edit Member Profile - IT Leadership Community";

include 'includes/config.php';

// Security check: redirect unauthenticated users
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || empty($_SESSION['user_id'])) {
    session_write_close();
    header("Location: index.php");
    exit;
}

include 'includes/header.php';

// Active tab selection
$active_tab = $_GET['tab'] ?? 'profile';

// Fetch current user details
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch professions
$professions = [];
$p_res = $conn->query("SELECT id, profession_name FROM profession ORDER BY profession_name ASC");
if ($p_res) {
    while ($r = $p_res->fetch_assoc()) { $professions[] = $r; }
}

// Fetch countries
$countries = [];
$c_res = $conn->query("SELECT id, country_name FROM country ORDER BY country_name ASC");
if ($c_res) {
    while ($r = $c_res->fetch_assoc()) { $countries[] = $r; }
}

// Fetch payment accounts
$payment_accounts = [];
$pa_res = $conn->query("SELECT id, account_details FROM payment_account ORDER BY id ASC");
if ($pa_res) {
    while ($r = $pa_res->fetch_assoc()) { $payment_accounts[] = $r; }
}

// Avatar resolution
$user_avatar = !empty($user_data['profile_image']) && file_exists(__DIR__ . '/' . $user_data['profile_image']) 
    ? $user_data['profile_image'] 
    : 'images/author.jpg';

// Membership tier lookup
$tier_title = 'Community Member';
if (!empty($user_data['membership_type_id'])) {
    $t_stmt = $conn->prepare("SELECT type_name FROM membership_type WHERE id = ?");
    if ($t_stmt) {
        $t_stmt->bind_param("i", $user_data['membership_type_id']);
        $t_stmt->execute();
        $t_res = $t_stmt->get_result()->fetch_assoc();
        if (!empty($t_res['type_name'])) {
            $tier_title = $t_res['type_name'];
        }
        $t_stmt->close();
    }
}
?>

<style>
/* Modern 2026 Profile Tab System */
.itlc-profile-tabs {
    border-bottom: 2px solid rgba(6, 72, 122, 0.08);
    gap: 8px;
    margin-bottom: 28px;
}

.itlc-profile-tabs .nav-link {
    border: none !important;
    color: #475569;
    font-size: 14.5px;
    font-weight: 600;
    padding: 12px 22px;
    border-radius: 8px 8px 0 0 !important;
    background: transparent;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    position: relative;
}

.itlc-profile-tabs .nav-link i {
    color: #94a3b8;
    transition: color 0.25s ease;
}

.itlc-profile-tabs .nav-link:hover {
    color: #06487a;
    background: rgba(6, 72, 122, 0.04);
}

.itlc-profile-tabs .nav-link.active {
    color: #06487a !important;
    background: #ffffff !important;
    font-weight: 700;
}

.itlc-profile-tabs .nav-link.active i {
    color: #f59e0b;
}

.itlc-profile-tabs .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #f59e0b, #06487a);
    border-radius: 3px 3px 0 0;
}

/* Modern Form Controls */
.form-control-profile {
    background-color: #f8fafc !important;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    height: 46px;
    font-size: 14px;
    color: #1e293b;
    padding: 10px 14px;
    transition: all 0.25s ease;
}

.form-control-profile:focus {
    background-color: #ffffff !important;
    border-color: #06487a;
    box-shadow: 0 0 0 3px rgba(6, 72, 122, 0.12);
}

textarea.form-control-profile {
    height: auto;
    resize: vertical;
}

.itlc-form-label {
    font-weight: 600;
    font-size: 13px;
    color: #1e293b;
    margin-bottom: 6px;
    display: block;
}

.itlc-form-section-title {
    font-size: 15px;
    font-weight: 700;
    color: #06487a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 24px 0 16px;
    padding-bottom: 8px;
    border-bottom: 1px dashed #e2e8f0;
    display: flex;
    align-items: center;
}

.itlc-form-section-title:first-of-type {
    margin-top: 0;
}

.itlc-form-section-title i {
    color: #f59e0b;
    margin-right: 8px;
}

/* Member Side Summary Card */
.itlc-member-summary-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    padding: 28px 24px;
    text-align: center;
}

.itlc-member-summary-avatar {
    width: 105px;
    height: 105px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #ffffff;
    box-shadow: 0 8px 22px rgba(6, 72, 122, 0.18);
    margin: 0 auto 16px;
    display: block;
}

.itlc-member-summary-name {
    font-size: 18px;
    font-weight: 700;
    color: #06487a;
    margin-bottom: 4px;
}

.itlc-member-summary-role {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 12px;
}

.itlc-member-summary-badge {
    display: inline-block;
    padding: 4px 12px;
    font-size: 11.5px;
    font-weight: 700;
    border-radius: 20px;
    background: rgba(245, 158, 11, 0.14);
    color: #b45309;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 18px;
}

/* Quick Navigation Links */
.itlc-member-quicknav {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.itlc-member-quicknav li a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 600;
    color: #475569;
    text-decoration: none;
    transition: all 0.2s ease;
    margin-bottom: 4px;
}

.itlc-member-quicknav li a:hover,
.itlc-member-quicknav li a.active {
    background: rgba(6, 72, 122, 0.06);
    color: #06487a;
}

.itlc-member-quicknav li a i {
    color: #94a3b8;
    margin-right: 10px;
}

.itlc-member-quicknav li a.active i {
    color: #f59e0b;
}

/* Preference Cards */
.itlc-pref-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 18px;
    margin-bottom: 16px;
    transition: all 0.25s ease;
}

.itlc-pref-card:hover {
    border-color: #cbd5e1;
    background: #f1f5f9;
}

/* Password messages */
.password-error-msg {
    color: #ef4444;
    font-size: 12.5px;
    margin-top: 5px;
    font-weight: 500;
    display: none;
}
.password-success-msg {
    color: #10b981;
    font-size: 12.5px;
    margin-top: 5px;
    font-weight: 500;
    display: none;
}

/* Toast Notification Styles */
#toastContainer {
    position: fixed;
    top: 25px;
    right: 25px;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 380px;
    width: calc(100% - 50px);
    pointer-events: none;
}
.custom-toast {
    pointer-events: auto;
    display: flex;
    align-items: center;
    padding: 14px 18px;
    border-radius: 10px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    animation: toastSlideIn 0.35s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    transition: all 0.3s ease;
    line-height: 1.4;
}
.custom-toast.toast-success {
    background: linear-gradient(135deg, #10b981, #059669);
    border-left: 5px solid #047857;
}
.custom-toast.toast-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-left: 5px solid #b91c1c;
}
.custom-toast.toast-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    border-left: 5px solid #b45309;
}
.custom-toast.toast-info {
    background: linear-gradient(135deg, #0ea5e9, #0284c7);
    border-left: 5px solid #0369a1;
}
.custom-toast .toast-icon {
    font-size: 18px;
    margin-right: 12px;
    flex-shrink: 0;
}
.custom-toast .toast-msg {
    flex-grow: 1;
}
.custom-toast .toast-close {
    background: transparent;
    border: none;
    color: inherit;
    font-size: 18px;
    margin-left: 12px;
    cursor: pointer;
    opacity: 0.75;
    padding: 0 4px;
    line-height: 1;
}
.custom-toast .toast-close:hover {
    opacity: 1;
}
.custom-toast.toast-hiding {
    animation: toastFadeOut 0.3s ease forwards;
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateX(120%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
@keyframes toastFadeOut {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(120%);
    }
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-user-gear mr-1"></i> Account Settings</div>
        <h1 class="itlc-hero-title">Manage Your <span>Member Profile</span></h1>
        <p class="itlc-hero-desc">Keep your professional credentials, executive biography, contact details, and platform preferences current.</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="member-profile.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-arrow-left mr-2"></i> View Profile
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Profile Edit Body Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">
    <div class="row">

      <!-- Left Column: Member Mini Profile Sidebar -->
      <div class="col-lg-4 col-md-5 mb-4">
        <div class="itlc-member-summary-card">
          <img src="<?php echo htmlspecialchars($user_avatar); ?>" alt="Member Avatar" class="itlc-member-summary-avatar">
          <h4 class="itlc-member-summary-name"><?php echo htmlspecialchars($user_data['full_name'] ?? 'ITLC Member'); ?></h4>
          <div class="itlc-member-summary-role">
            <?php echo htmlspecialchars($user_data['position'] ?? 'Technology Leader'); ?>
            <?php if (!empty($user_data['company'])): ?>
              <br><span class="font-weight-bold" style="color: #06487a;"><?php echo htmlspecialchars($user_data['company']); ?></span>
            <?php endif; ?>
          </div>
          <span class="itlc-member-summary-badge"><i class="fa-solid fa-shield-halved mr-1"></i> <?php echo htmlspecialchars($tier_title); ?></span>

          <hr style="border-top: 1px solid #e2e8f0; margin: 12px 0 18px;">

          <ul class="itlc-member-quicknav">
            <li>
              <a href="#profile" class="nav-switch <?php echo ($active_tab === 'profile') ? 'active' : ''; ?>" data-target-tab="profile">
                <span><i class="fa-solid fa-id-card"></i> Profile Details</span>
                <i class="fa-solid fa-chevron-right small text-muted"></i>
              </a>
            </li>
            <li>
              <a href="#others" class="nav-switch <?php echo ($active_tab === 'others') ? 'active' : ''; ?>" data-target-tab="others">
                <span><i class="fa-solid fa-sliders"></i> Event & Community</span>
                <i class="fa-solid fa-chevron-right small text-muted"></i>
              </a>
            </li>
            <li>
              <a href="#password" class="nav-switch <?php echo ($active_tab === 'password') ? 'active' : ''; ?>" data-target-tab="password">
                <span><i class="fa-solid fa-lock"></i> Security & Password</span>
                <i class="fa-solid fa-chevron-right small text-muted"></i>
              </a>
            </li>
            <li>
              <a href="member-profile.php">
                <span><i class="fa-solid fa-eye"></i> Public View</span>
                <i class="fa-solid fa-arrow-up-right-from-square small text-muted"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right Column: Main Form & Tabs -->
      <div class="col-lg-8 col-md-7">
        <div class="itlc-card p-4 p-lg-5" style="background: #ffffff; border-radius: 14px; border: 1px solid rgba(6, 72, 122, 0.08); box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);">

          <!-- Display Session Alerts -->
          <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show text-center mb-4" role="alert">
                  <strong>Notice:</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

          <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert">
                  <strong>Success!</strong> <?php echo htmlspecialchars($_SESSION['success']); ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <?php unset($_SESSION['success']); ?>
          <?php endif; ?>

          <!-- Nav Tabs -->
          <ul class="nav nav-tabs itlc-profile-tabs" id="profileTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link <?php echo ($active_tab === 'profile') ? 'active' : ''; ?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="<?php echo ($active_tab === 'profile') ? 'true' : 'false'; ?>">
                <i class="fa-solid fa-user mr-2"></i> Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($active_tab === 'others') ? 'active' : ''; ?>" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="<?php echo ($active_tab === 'others') ? 'true' : 'false'; ?>">
                <i class="fa-solid fa-sliders mr-2"></i> Others Info
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo ($active_tab === 'password') ? 'active' : ''; ?>" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="<?php echo ($active_tab === 'password') ? 'true' : 'false'; ?>">
                <i class="fa-solid fa-shield-halved mr-2"></i> Change Password
              </a>
            </li>
          </ul>

          <!-- Tab Contents -->
          <div class="tab-content" id="profileTabContent">

            <!-- TAB 1: PROFILE INFO -->
            <div class="tab-pane fade <?php echo ($active_tab === 'profile') ? 'show active' : ''; ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form action="includes/update_profile.php" method="POST" id="profileForm">
                <input type="hidden" name="action" value="update_profile">

                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="itlc-form-section-title mb-0">
                    <i class="fa-solid fa-address-card"></i> Personal Details
                  </span>
                  <span class="badge badge-light text-muted font-weight-normal py-1 px-2" style="font-size: 11.5px;">
                    Username: <?php echo htmlspecialchars($user_data['email'] ?? ''); ?>
                  </span>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['mobile'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Country</label>
                    <select name="country_id" class="form-control form-control-profile">
                      <option value="">Select Country</option>
                      <?php foreach ($countries as $c): ?>
                        <option value="<?php echo $c['id']; ?>" <?php echo ($user_data['country_id'] == $c['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($c['country_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['date_of_birth'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Blood Group</label>
                    <select name="blood_group" class="form-control form-control-profile">
                      <option value="">Select Blood Group</option>
                      <?php 
                        $b_groups = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
                        foreach ($b_groups as $bg) {
                          $selected = ($user_data['blood_group'] == $bg) ? 'selected' : '';
                          echo "<option value=\"$bg\" $selected>$bg</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-12 mb-3">
                    <label class="itlc-form-label">Present Address</label>
                    <input type="text" name="present_address" class="form-control form-control-profile" placeholder="Enter Your Present Address" value="<?php echo htmlspecialchars($user_data['present_address'] ?? ''); ?>">
                  </div>

                  <div class="col-12 mb-3">
                    <label class="itlc-form-label">Executive Biography / Short Bio</label>
                    <textarea name="biography" class="form-control form-control-profile" rows="4" placeholder="Brief summary of your executive career and leadership journey..."><?php echo htmlspecialchars($user_data['biography'] ?? ''); ?></textarea>
                  </div>
                </div>

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-briefcase"></i> Professional Information
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Profession / Category <span class="text-danger">*</span></label>
                    <select name="profession_id" class="form-control form-control-profile" required>
                      <option value="" disabled>Select Profession</option>
                      <?php foreach ($professions as $p): ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo ($user_data['profession_id'] == $p['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($p['profession_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Current Designation / Position <span class="text-danger">*</span></label>
                    <input type="text" name="position" class="form-control form-control-profile" placeholder="e.g. Chief Information Officer" value="<?php echo htmlspecialchars($user_data['position'] ?? ''); ?>" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Current Company / Organization</label>
                    <input type="text" name="company" class="form-control form-control-profile" placeholder="e.g. Acme Technologies Ltd." value="<?php echo htmlspecialchars($user_data['company'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Company Office Address</label>
                    <input type="text" name="company_address" class="form-control form-control-profile" placeholder="Enter Your Office Address" value="<?php echo htmlspecialchars($user_data['company_address'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Highest Education</label>
                    <input type="text" name="highest_education" class="form-control form-control-profile" placeholder="e.g. M.Sc. in Computer Science" value="<?php echo htmlspecialchars($user_data['highest_education'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Professional Certification</label>
                    <input type="text" name="certification" class="form-control form-control-profile" placeholder="e.g. CISSP, PMP, CISA, TOGAF" value="<?php echo htmlspecialchars($user_data['certification'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Personal / Corporate Website</label>
                    <input type="text" name="website_url" class="form-control form-control-profile" placeholder="https://yourwebsite.com" value="<?php echo htmlspecialchars($user_data['website_url'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">CV / Resume Link</label>
                    <input type="text" name="cv_link" class="form-control form-control-profile" placeholder="https://drive.google.com/..." value="<?php echo htmlspecialchars($user_data['cv_link'] ?? ''); ?>">
                  </div>
                </div>

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-share-nodes"></i> Social & Professional Profiles
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label"><i class="fa-brands fa-linkedin text-primary mr-1"></i> LinkedIn Profile URL</label>
                    <input type="url" name="linkedin_url" class="form-control form-control-profile" placeholder="https://linkedin.com/in/username" value="<?php echo htmlspecialchars($user_data['linkedin_url'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label"><i class="fa-brands fa-facebook text-primary mr-1"></i> Facebook Profile URL</label>
                    <input type="text" name="facebook_url" class="form-control form-control-profile" placeholder="https://facebook.com/username" value="<?php echo htmlspecialchars($user_data['facebook_url'] ?? '#'); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label"><i class="fa-brands fa-x-twitter text-dark mr-1"></i> Twitter / X Profile URL</label>
                    <input type="text" name="twitter_url" class="form-control form-control-profile" placeholder="https://x.com/username" value="<?php echo htmlspecialchars($user_data['twitter_url'] ?? '#'); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label"><i class="fa-brands fa-youtube text-danger mr-1"></i> YouTube Channel URL</label>
                    <input type="text" name="youtube_url" class="form-control form-control-profile" placeholder="https://youtube.com/@channel" value="<?php echo htmlspecialchars($user_data['youtube_url'] ?? '#'); ?>">
                  </div>
                </div>

                <div class="mt-4 pt-2">
                  <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                    <i class="fa-solid fa-check mr-2"></i> Save Profile Details
                  </button>
                </div>
              </form>
            </div>

            <!-- TAB 2: OTHERS INFO -->
            <div class="tab-pane fade <?php echo ($active_tab === 'others') ? 'show active' : ''; ?>" id="others" role="tabpanel" aria-labelledby="others-tab">
              <form action="includes/update_profile.php" method="POST" id="othersForm">
                <input type="hidden" name="action" value="update_others">

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-calendar-check"></i> Event Related Information
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Payment To (Bank/Mobile Account)</label>
                    <select name="event_payment_account_id" class="form-control form-control-profile">
                      <option value="">Select Account</option>
                      <?php foreach ($payment_accounts as $pa): ?>
                        <option value="<?php echo $pa['id']; ?>" <?php echo ($user_data['event_payment_account_id'] == $pa['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($pa['account_details']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Transaction ID (Event)</label>
                    <input type="text" name="event_trans_num" class="form-control form-control-profile" placeholder="e.g. 9J8K7L6M" value="<?php echo htmlspecialchars($user_data['event_trans_num'] ?? ''); ?>">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">T-Shirt Size</label>
                    <select name="t_shirt_size" class="form-control form-control-profile">
                      <option value="">Select T-shirt Size</option>
                      <?php 
                        $sizes = [
                          'M | 38-40 in | 96-101 cm',
                          'L | 40-42 in | 101-106 cm',
                          'XL | 42-44 in | 106-111 cm',
                          'XXL | 44-46 in | 111-116 cm',
                          'S | 36-38 in | 91-96 cm'
                        ];
                        foreach ($sizes as $sz) {
                          $selected = ($user_data['t_shirt_size'] == $sz) ? 'selected' : '';
                          echo "<option value=\"$sz\" $selected>$sz</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Transport Support</label>
                    <select name="transport_support" class="form-control form-control-profile">
                      <option value="">Select Transport</option>
                      <?php 
                        $transports = ['ITLC Transport', 'Self Transport', 'None'];
                        foreach ($transports as $tr) {
                          $selected = ($user_data['transport_support'] == $tr) ? 'selected' : '';
                          echo "<option value=\"$tr\" $selected>$tr</option>";
                        }
                      ?>
                    </select>
                  </div>

                  <div class="col-12 mb-3">
                    <label class="itlc-form-label">Your Pickup Address / Location</label>
                    <input type="text" name="user_location_address" class="form-control form-control-profile" placeholder="Enter Your City or Detailed Pickup Address" value="<?php echo htmlspecialchars($user_data['user_location_address'] ?? ''); ?>">
                  </div>
                </div>

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-credit-card"></i> Membership Dues Information
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Payment To (Bank/Mobile Account)</label>
                    <select name="member_payment_account_id" class="form-control form-control-profile">
                      <option value="">Select Account</option>
                      <?php foreach ($payment_accounts as $pa): ?>
                        <option value="<?php echo $pa['id']; ?>" <?php echo ($user_data['member_payment_account_id'] == $pa['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($pa['account_details']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="itlc-form-label">Transaction ID (Membership)</label>
                    <input type="text" name="member_trans_num" class="form-control form-control-profile" placeholder="e.g. 7K6L5M4N" value="<?php echo htmlspecialchars($user_data['member_trans_num'] ?? ''); ?>">
                  </div>
                </div>

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-eye"></i> Privacy & Contribution Permissions
                </div>

                <div class="itlc-pref-card">
                  <label class="itlc-form-label d-block mb-2 font-weight-bold text-dark">
                    Public Directory Visibility
                  </label>
                  <p class="small text-muted mb-3">Allow your professional profile to appear in the ITLC public member directory.</p>
                  <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="publicYes" name="is_profile_public" value="1" class="custom-control-input" <?php echo ($user_data['is_profile_public'] == 1) ? 'checked' : ''; ?>>
                    <label class="custom-control-label font-weight-bold text-dark small" for="publicYes">
                      <i class="fa-solid fa-globe text-success mr-1"></i> Yes, make my profile visible to the public directory
                    </label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="publicNo" name="is_profile_public" value="0" class="custom-control-input" <?php echo ($user_data['is_profile_public'] == 0) ? 'checked' : ''; ?>>
                    <label class="custom-control-label font-weight-bold text-dark small" for="publicNo">
                      <i class="fa-solid fa-lock text-muted mr-1"></i> No, keep my profile private
                    </label>
                  </div>
                </div>

                <div class="itlc-pref-card">
                  <label class="itlc-form-label d-block mb-2 font-weight-bold text-dark">
                    Blog & Story Publishing Permission
                  </label>
                  <p class="small text-muted mb-3">
                    Current Status: 
                    <?php if ($user_data['has_blog_permission'] == 1): ?>
                      <span class="badge badge-success font-weight-bold px-2 py-1"><i class="fa-solid fa-circle-check mr-1"></i> Granted</span>
                    <?php else: ?>
                      <span class="badge badge-secondary font-weight-normal px-2 py-1"><i class="fa-solid fa-clock mr-1"></i> Not Granted Yet</span>
                    <?php endif; ?>
                  </p>
                  <div class="custom-control custom-radio mb-2">
                    <input type="radio" id="blogYes" name="has_blog_permission" value="1" class="custom-control-input" <?php echo ($user_data['has_blog_permission'] == 1) ? 'checked' : ''; ?>>
                    <label class="custom-control-label font-weight-bold text-dark small" for="blogYes">
                      I want to have permission to publish technical articles & blogs
                    </label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="blogNo" name="has_blog_permission" value="0" class="custom-control-input" <?php echo ($user_data['has_blog_permission'] == 0) ? 'checked' : ''; ?>>
                    <label class="custom-control-label font-weight-bold text-dark small" for="blogNo">
                      I do not need blogging permissions at this time
                    </label>
                  </div>
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                    <i class="fa-solid fa-check mr-2"></i> Save Additional Details
                  </button>
                </div>
              </form>
            </div>

            <!-- TAB 3: CHANGE PASSWORD -->
            <div class="tab-pane fade <?php echo ($active_tab === 'password') ? 'show active' : ''; ?>" id="password" role="tabpanel" aria-labelledby="password-tab">
              <form action="includes/update_profile.php" method="POST" id="passwordForm">
                <input type="hidden" name="action" value="change_password">

                <div class="itlc-form-section-title">
                  <i class="fa-solid fa-key"></i> Update Security Credentials
                </div>

                <div class="alert alert-light border small text-muted mb-4" style="border-radius: 8px;">
                  <i class="fa-solid fa-shield-cat text-primary mr-2"></i> Use at least 6 characters including a combination of uppercase letters, numbers, and special symbols for maximum security.
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group mb-3">
                      <label class="itlc-form-label">Current Password <span class="text-danger">*</span></label>
                      <input type="password" name="current_password" id="current_password" class="form-control form-control-profile" placeholder="Enter your current password" required>
                      <div class="password-error-msg" id="err_current_password"></div>
                    </div>

                    <div class="form-group mb-3">
                      <label class="itlc-form-label">New Password <span class="text-danger">*</span></label>
                      <input type="password" name="new_password" id="new_password" class="form-control form-control-profile" placeholder="Minimum 6 characters" required>
                      <div class="password-error-msg" id="err_new_password"></div>
                    </div>

                    <div class="form-group mb-3">
                      <label class="itlc-form-label">Repeat New Password <span class="text-danger">*</span></label>
                      <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-profile" placeholder="Re-enter your new password" required>
                      <div id="passwordMatchError" class="password-error-msg"><i class="fa-solid fa-circle-xmark mr-1"></i> Passwords do not match!</div>
                      <div id="passwordMatchSuccess" class="password-success-msg"><i class="fa-solid fa-circle-check mr-1"></i> Passwords match!</div>
                      <div class="password-error-msg" id="err_confirm_password"></div>
                    </div>

                    <div id="validationMessage"></div>

                    <div class="mt-4">
                      <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                        <i class="fa-solid fa-lock mr-2"></i> Update Password
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
$(document).ready(function() {

    // Tab switcher from side menu
    $('.nav-switch').on('click', function(e) {
        e.preventDefault();
        var targetTab = $(this).data('target-tab');
        $('#' + targetTab + '-tab').tab('show');
        $('.nav-switch').removeClass('active');
        $(this).addClass('active');
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var targetId = $(e.target).attr('href').replace('#', '');
        $('.nav-switch').removeClass('active');
        $('.nav-switch[data-target-tab="' + targetId + '"]').addClass('active');
    });

    // Helper: Toast Notifications
    function showToast(message, type) {
        type = type || 'success';
        var $container = $('#toastContainer');
        if ($container.length === 0) {
            $('body').append('<div id="toastContainer"></div>');
            $container = $('#toastContainer');
        }

        var iconMap = {
            'success': 'fa-solid fa-circle-check',
            'danger': 'fa-solid fa-circle-exclamation',
            'warning': 'fa-solid fa-triangle-exclamation',
            'info': 'fa-solid fa-circle-info'
        };

        var iconClass = iconMap[type] || 'fa-solid fa-circle-info';
        var toastId = 'toast_' + Date.now() + '_' + Math.floor(Math.random() * 1000);

        var safeMsg = $('<div>').text(message).html();

        var html = '<div id="' + toastId + '" class="custom-toast toast-' + type + '">' +
                   '<i class="' + iconClass + ' toast-icon"></i>' +
                   '<div class="toast-msg">' + safeMsg + '</div>' +
                   '<button type="button" class="toast-close">&times;</button>' +
                   '</div>';

        var $toast = $(html);
        $container.append($toast);

        $toast.find('.toast-close').on('click', function() {
            dismissToast($toast);
        });

        setTimeout(function() {
            dismissToast($toast);
        }, 4500);
    }

    function dismissToast($toast) {
        if ($toast.hasClass('toast-hiding')) return;
        $toast.addClass('toast-hiding');
        setTimeout(function() {
            $toast.remove();
        }, 300);
    }

    var $currentPwd = $('#current_password');
    var $newPwd     = $('#new_password');
    var $confirmPwd = $('#confirm_password');

    // Field-level error helpers
    function setFieldError(fieldId, message) {
        $('#err_' + fieldId).text(message || '').toggle(!!message);
    }
    function clearAllFieldErrors() {
        ['current_password', 'new_password', 'confirm_password'].forEach(function(id) {
            setFieldError(id, '');
        });
    }

    // Client-side password validation
    function validateClientSide() {
        var currentPassword = $currentPwd.val();
        var newPassword     = $newPwd.val();
        var confirmPassword = $confirmPwd.val();
        var errors = {};

        if (!currentPassword) {
            errors.current_password = 'Current password is required.';
        }

        if (!newPassword) {
            errors.new_password = 'New password is required.';
        } else if (newPassword.length < 6) {
            errors.new_password = 'New password must be at least 6 characters long.';
        }

        if (!confirmPassword) {
            errors.confirm_password = 'Please repeat the new password.';
        } else if (newPassword && newPassword !== confirmPassword) {
            errors.confirm_password = 'New password and Repeat New Password do not match.';
        }

        return errors;
    }

    function applyErrors(errors) {
        clearAllFieldErrors();
        var hasErrors = false;
        var firstErrorMsg = '';

        $.each(errors, function(field, message) {
            hasErrors = true;
            if (!firstErrorMsg) {
                firstErrorMsg = message;
            }
            if (field === 'general') {
                showValidationMessage(message, 'danger');
            } else {
                setFieldError(field, message);
            }
        });

        if (hasErrors && firstErrorMsg) {
            showToast(firstErrorMsg, 'danger');
        }
        return hasErrors;
    }

    // Live feedback
    $currentPwd.on('blur', function() {
        setFieldError('current_password', $(this).val() ? '' : 'Current password is required.');
    });

    $newPwd.on('keyup blur', function() {
        var val = $(this).val();
        if (!val) {
            setFieldError('new_password', '');
        } else if (val.length < 6) {
            setFieldError('new_password', 'New password must be at least 6 characters long.');
        } else {
            setFieldError('new_password', '');
        }
        $confirmPwd.trigger('keyup');
    });

    $confirmPwd.on('keyup', function() {
        var newPassword = $newPwd.val();
        var confirmPassword = $(this).val();

        if (confirmPassword.length > 0) {
            if (newPassword !== confirmPassword) {
                $('#passwordMatchError').show();
                $('#passwordMatchSuccess').hide();
            } else {
                $('#passwordMatchError').hide();
                $('#passwordMatchSuccess').show();
            }
        } else {
            $('#passwordMatchError').hide();
            $('#passwordMatchSuccess').hide();
        }
    });

    // AJAX Submit: Profile Info
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalBtnHtml = $submitBtn.html();
        $submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-2"></i> Saving...');

        var formData = $form.serialize() + '&is_ajax=1';

        $.ajax({
            url: 'includes/update_profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    showToast(response.message || 'Profile details updated successfully!', 'success');
                } else {
                    showToast((response && response.message) || 'Failed to update profile details.', 'danger');
                }
            },
            error: function() {
                showToast('Error updating profile details. Please try again.', 'danger');
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalBtnHtml);
            }
        });
    });

    // AJAX Submit: Others Info
    $('#othersForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtns = $form.find('button[type="submit"]');
        var originalBtnHtml = $submitBtns.html();
        $submitBtns.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-2"></i> Saving...');

        var formData = $form.serialize() + '&is_ajax=1';

        $.ajax({
            url: 'includes/update_profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    showToast(response.message || 'Other info updated successfully!', 'success');
                } else {
                    showToast((response && response.message) || 'Failed to update additional information.', 'danger');
                }
            },
            error: function() {
                showToast('Error updating information. Please try again.', 'danger');
            },
            complete: function() {
                $submitBtns.prop('disabled', false).html(originalBtnHtml);
            }
        });
    });

    // AJAX Submit: Password Form
    $('#passwordForm').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);
        $('#validationMessage').empty();

        var clientErrors = validateClientSide();
        if (applyErrors(clientErrors)) {
            return;
        }
        clearAllFieldErrors();

        var $submitBtn = $form.find('button[type="submit"]');
        var originalBtnHtml = $submitBtn.html();
        $submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-2"></i> Updating...');

        $.ajax({
            url: 'includes/update_profile.php',
            type: 'POST',
            data: {
                action: 'change_password',
                current_password: $currentPwd.val(),
                new_password: $newPwd.val(),
                confirm_password: $confirmPwd.val(),
                is_ajax: 1
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    var successMsg = response.message || 'Password updated successfully!';
                    showValidationMessage(successMsg, 'success');
                    showToast(successMsg, 'success');
                    $form[0].reset();
                    $('#passwordMatchError, #passwordMatchSuccess').hide();
                    clearAllFieldErrors();
                } else if (response && response.errors) {
                    applyErrors(response.errors);
                } else {
                    var errorMsg = (response && response.message) || 'Failed to update password.';
                    showValidationMessage(errorMsg, 'danger');
                    showToast(errorMsg, 'danger');
                }
            },
            error: function() {
                var errText = 'Error updating password. Please try again.';
                showValidationMessage(errText, 'danger');
                showToast(errText, 'danger');
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalBtnHtml);
            }
        });
    });

    function showValidationMessage(message, type) {
        var alertClass = (type === 'danger') ? 'alert-danger' : 'alert-success';
        var iconClass = (type === 'danger') ? 'fa-solid fa-triangle-exclamation mr-2' : 'fa-solid fa-circle-check mr-2';
        var html = '<div class="alert ' + alertClass + ' alert-dismissible fade show mt-3" role="alert">';
        html += '<i class="' + iconClass + '"></i><strong>' + (type === 'danger' ? 'Error!' : 'Success!') + '</strong> ' + message;
        html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        html += '<span aria-hidden="true">&times;</span></button></div>';

        $('#validationMessage').html(html);
    }
});
</script>
