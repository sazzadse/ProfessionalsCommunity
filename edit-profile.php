<?php 
// edit-profile.php
if (ob_get_level() === 0) {
    ob_start();
}

$page_title = "Edit Members Profile";

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
?>

<style>
.profile-tabs .nav-link {
    border: 1px solid #dee2e6;
    border-bottom: none;
    color: #6c757d;
    font-size: 14px;
    padding: 10px 20px;
    margin-right: 4px;
    background-color: #f8f9fa;
    border-radius: 0;
    text-transform: none;
}
.profile-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
    font-weight: 600;
}
.form-control-profile {
    background-color: #f4f5f7 !important;
    border: 1px solid #dcdfe6;
    border-radius: 0;
    height: 42px;
    font-size: 14px;
    color: #333;
}
textarea.form-control-profile {
    height: auto;
}
.btn-update-orange {
    background-color: #ee6435;
    color: #ffffff;
    border: none;
    border-radius: 2px;
    padding: 8px 30px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}
.btn-update-orange:hover {
    background-color: #d95328;
    color: #ffffff;
}
.password-error-msg {
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
    display: none;
}
.password-success-msg {
    color: #28a745;
    font-size: 13px;
    margin-top: 5px;
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
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
    animation: toastSlideIn 0.35s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
    transition: all 0.3s ease;
    line-height: 1.4;
}
.custom-toast.toast-success {
    background: linear-gradient(135deg, #28a745, #218838);
    border-left: 5px solid #1e7e34;
}
.custom-toast.toast-danger {
    background: linear-gradient(135deg, #dc3545, #c82333);
    border-left: 5px solid #bd2130;
}
.custom-toast.toast-warning {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
    border-left: 5px solid #d39e00;
}
.custom-toast.toast-info {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border-left: 5px solid #117a8b;
}
.custom-toast .toast-icon {
    font-size: 20px;
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

<!-- Use exact height from inspection -->
<div style="height: 150px;"></div>

<!-- Breadcrumb & Page Heading -->
<section class="bg-white pt-4 pb-2">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3 class="font-weight-bold text-dark m-0">Update Your Member Account...</h3>
          <a href="member-profile.php" class="btn btn-primary-outline btn-sm text-uppercase font-weight-bold px-3 py-1"><i class="ti-arrow-left mr-1"></i> Back to Profile</a>
        </div>
        <hr class="mt-0 mb-4" style="border-top: 1px solid #e5e5e5;">
      </div>
    </div>
  </div>
</section>

<!-- Profile Edit Body Section -->
<section class="section pt-0 bg-white pb-5">
  <div class="container">
    <div class="row">

      <!-- Left Column: Main Form & Tabs -->
      <div class="col-lg-8 col-md-8">

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
        <ul class="nav nav-tabs profile-tabs mb-4 border-bottom" id="profileTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab === 'profile') ? 'active' : ''; ?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="<?php echo ($active_tab === 'profile') ? 'true' : 'false'; ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab === 'others') ? 'active' : ''; ?>" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="<?php echo ($active_tab === 'others') ? 'true' : 'false'; ?>">Others Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($active_tab === 'password') ? 'active' : ''; ?>" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="<?php echo ($active_tab === 'password') ? 'true' : 'false'; ?>">Change Password</a>
          </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="profileTabContent">

          <!-- TAB 1: PROFILE INFO -->
          <div class="tab-pane fade <?php echo ($active_tab === 'profile') ? 'show active' : ''; ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="includes/update_profile.php" method="POST" id="profileForm">
              <input type="hidden" name="action" value="update_profile">

              <h5 class="font-weight-bold mb-4 text-dark" style="font-size: 17px;">
                Update Account Details | Username: <?php echo htmlspecialchars($user_data['email'] ?? ''); ?>
              </h5>

              <div class="row">
                <!-- Sub-column Left -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Name</label>
                    <input type="text" name="full_name" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Email</label>
                    <input type="email" name="email" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['mobile'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Country</label>
                    <select name="country_id" class="form-control form-control-profile">
                      <option value="">Select Country</option>
                      <?php foreach ($countries as $c): ?>
                        <option value="<?php echo $c['id']; ?>" <?php echo ($user_data['country_id'] == $c['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($c['country_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Present Address</label>
                    <input type="text" name="present_address" class="form-control form-control-profile" placeholder="Enter Your Present Address" value="<?php echo htmlspecialchars($user_data['present_address'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Website</label>
                    <input type="text" name="website_url" class="form-control form-control-profile" placeholder="Enter personal website url" value="<?php echo htmlspecialchars($user_data['website_url'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Short Biography</label>
                    <textarea name="biography" class="form-control form-control-profile" rows="5"><?php echo htmlspecialchars($user_data['biography'] ?? ''); ?></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['date_of_birth'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Profession</label>
                    <select name="profession_id" class="form-control form-control-profile" required>
                      <option value="" disabled>Select Profession</option>
                      <?php foreach ($professions as $p): ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo ($user_data['profession_id'] == $p['id']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($p['profession_name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mt-5">
                    <button type="submit" class="btn btn-primary-outline">Save Changes</button>
                  </div>
                </div>

                <!-- Sub-column Right -->
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Position</label>
                    <input type="text" name="position" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['position'] ?? ''); ?>" required>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Current Company</label>
                    <input type="text" name="company" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['company'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Company Address</label>
                    <input type="text" name="company_address" class="form-control form-control-profile" placeholder="Enter Your Office Address" value="<?php echo htmlspecialchars($user_data['company_address'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Education</label>
                    <input type="text" name="highest_education" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['highest_education'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Professional certification</label>
                    <input type="text" name="certification" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['certification'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">LinkedIn</label>
                    <input type="url" name="linkedin_url" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['linkedin_url'] ?? ''); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Blood Group</label>
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

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Facebook</label>
                    <input type="text" name="facebook_url" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['facebook_url'] ?? '#'); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Twitter</label>
                    <input type="text" name="twitter_url" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['twitter_url'] ?? '#'); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">YouTube</label>
                    <input type="text" name="youtube_url" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['youtube_url'] ?? '#'); ?>">
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">CV Link</label>
                    <input type="text" name="cv_link" class="form-control form-control-profile" placeholder="Enter Your CV URL" value="<?php echo htmlspecialchars($user_data['cv_link'] ?? ''); ?>">
                  </div>
                </div>
              </div>

              <!-- <div class="text-right mt-4 mb-3">
                <button type="submit" class="btn btn-primary-outline">Save Changes</button>
              </div> -->
            </form>
          </div>

          <!-- TAB 2: OTHERS INFO -->
          <div class="tab-pane fade <?php echo ($active_tab === 'others') ? 'show active' : ''; ?>" id="others" role="tabpanel" aria-labelledby="others-tab">
            <form action="includes/update_profile.php" method="POST" id="othersForm">
              <input type="hidden" name="action" value="update_others">

              <h5 class="font-weight-bold mb-3 text-dark" style="font-size: 16px;">Event Related Info</h5>
              <div class="row mb-4">
                <div class="col-md-6 mb-3">
                  <label class="font-weight-bold small text-dark mb-1">Payment To(Bank/Mobile Account)</label>
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
                  <label class="font-weight-bold small text-dark mb-1">Trans Num(Event)</label>
                  <input type="text" name="event_trans_num" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['event_trans_num'] ?? ''); ?>">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="font-weight-bold small text-dark mb-1">T-shirt size</label>
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
                  <label class="font-weight-bold small text-dark mb-1">Transport Support</label>
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

                <div class="col-md-6 mb-3">
                  <label class="font-weight-bold small text-dark mb-1">Your Address/Location</label>
                  <input type="text" name="user_location_address" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['user_location_address'] ?? ''); ?>">
                </div>
              </div>

              <h5 class="font-weight-bold mb-3 text-dark" style="font-size: 16px;">Membership Related Info</h5>
              <div class="row mb-4">
                <div class="col-md-6 mb-3">
                  <label class="font-weight-bold small text-dark mb-1">Payment To(Bank/Mobile Account)</label>
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
                  <label class="font-weight-bold small text-dark mb-1">Trans Num(Membership)</label>
                  <input type="text" name="member_trans_num" class="form-control form-control-profile" value="<?php echo htmlspecialchars($user_data['member_trans_num'] ?? ''); ?>">
                </div>
              </div>

              <div class="form-group mb-4">
                <label class="font-weight-bold small text-dark d-block mb-2">Do you want your Profile public?</label>
                <div class="custom-control custom-radio mb-1">
                  <input type="radio" id="publicYes" name="is_profile_public" value="1" class="custom-control-input" <?php echo ($user_data['is_profile_public'] == 1) ? 'checked' : ''; ?>>
                  <label class="custom-control-label small text-dark" for="publicYes">Yes, Make my profile public</label>
                </div>
                <div class="custom-control custom-radio mb-3">
                  <input type="radio" id="publicNo" name="is_profile_public" value="0" class="custom-control-input" <?php echo ($user_data['is_profile_public'] == 0) ? 'checked' : ''; ?>>
                  <label class="custom-control-label small text-dark" for="publicNo">No, Do not make my profile public</label>
                </div>
                <button type="submit" class="btn btn-primary-outline">Submit</button>
              </div>

              <div class="form-group mb-4 pt-2">
                <label class="font-weight-bold small text-dark d-block mb-2">Story Permission</label>
                <div class="custom-control custom-radio mb-1">
                  <input type="radio" id="blogYes" name="has_blog_permission" value="1" class="custom-control-input" <?php echo ($user_data['has_blog_permission'] == 1) ? 'checked' : ''; ?>>
                  <label class="custom-control-label small text-dark" for="blogYes">I want to have permission to write Blog</label>
                </div>
                <div class="custom-control custom-radio mb-2">
                  <input type="radio" id="blogNo" name="has_blog_permission" value="0" class="custom-control-input" <?php echo ($user_data['has_blog_permission'] == 0) ? 'checked' : ''; ?>>
                  <label class="custom-control-label small text-dark" for="blogNo">I do not want to have permission to write Blog</label>
                </div>
                <p class="small text-muted mb-3">
                  <?php echo ($user_data['has_blog_permission'] == 1) ? 'You have permission to write Blog.' : 'You do not have permission to write Blog yet.'; ?>
                </p>
                <button type="submit" class="btn btn-primary-outline">Submit</button>
              </div>

            </form>
          </div>

          <!-- TAB 3: CHANGE PASSWORD -->
          <div class="tab-pane fade <?php echo ($active_tab === 'password') ? 'show active' : ''; ?>" id="password" role="tabpanel" aria-labelledby="password-tab">
            <form action="includes/update_profile.php" method="POST" id="passwordForm">
              <input type="hidden" name="action" value="change_password">

              <h5 class="font-weight-bold mb-4 text-dark" style="font-size: 16px;">Update Password</h5>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control form-control-profile" required>
                    <div class="password-error-msg" id="err_current_password"></div>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control form-control-profile" required>
                    <div class="password-error-msg" id="err_new_password"></div>
                  </div>

                  <div class="form-group mb-3">
                    <label class="font-weight-bold small text-dark mb-1">Repeat New Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-profile" required>
                    <div id="passwordMatchError" class="password-error-msg">✗ Passwords do not match!</div>
                    <div id="passwordMatchSuccess" class="password-success-msg">✓ Passwords match!</div>
                    <div class="password-error-msg" id="err_confirm_password"></div>
                  </div>

                  <div id="validationMessage"></div>

                  <div class="mt-4">
                    <button type="submit" class="btn btn-primary-outline">Update</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
$(document).ready(function() {

    // Helper: Toast Notifications
    function showToast(message, type) {
        type = type || 'success';
        var $container = $('#toastContainer');
        if ($container.length === 0) {
            $('body').append('<div id="toastContainer"></div>');
            $container = $('#toastContainer');
        }

        var iconMap = {
            'success': 'ti-check',
            'danger': 'ti-alert',
            'warning': 'ti-info-alt',
            'info': 'ti-info-alt'
        };

        var iconClass = iconMap[type] || 'ti-info-alt';
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

    // ---- Field-level error helpers -------------------------------------
    function setFieldError(fieldId, message) {
        $('#err_' + fieldId).text(message || '').toggle(!!message);
    }
    function clearAllFieldErrors() {
        ['current_password', 'new_password', 'confirm_password'].forEach(function(id) {
            setFieldError(id, '');
        });
    }

    // ---- Pure client-side validation (format only) ----------------------
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

    // Live feedback as the user types
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

    // ---- AJAX Submit: Profile Info ------------------------------------
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalBtnText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('Saving...');

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
                $submitBtn.prop('disabled', false).text(originalBtnText);
            }
        });
    });

    // ---- AJAX Submit: Others Info -------------------------------------
    $('#othersForm').on('submit', function(e) {
        e.preventDefault();
        var $form = $(this);
        var $submitBtns = $form.find('button[type="submit"]');
        $submitBtns.prop('disabled', true);

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
                $submitBtns.prop('disabled', false);
            }
        });
    });

    // ---- AJAX Submit: Password Form -----------------------------------
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
        var originalBtnText = $submitBtn.text();
        $submitBtn.prop('disabled', true).text('Updating...');

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
                $submitBtn.prop('disabled', false).text(originalBtnText);
            }
        });
    });

    function showValidationMessage(message, type) {
        var alertClass = (type === 'danger') ? 'alert-danger' : 'alert-success';
        var html = '<div class="alert ' + alertClass + ' alert-dismissible fade show mt-3" role="alert">';
        html += '<strong>' + (type === 'danger' ? 'Error!' : 'Success!') + '</strong> ' + message;
        html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        html += '<span aria-hidden="true">&times;</span></button></div>';

        $('#validationMessage').html(html);
    }
});
</script>