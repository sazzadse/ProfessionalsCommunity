<?php 
// member-profile.php
if (ob_get_level() === 0) {
    ob_start();
}

include 'includes/config.php';

// Security check: if no ID parameter and not logged in, redirect to login
$target_user_id = isset($_GET['id']) ? (int)$_GET['id'] : ($_SESSION['user_id'] ?? 0);

if ($target_user_id <= 0) {
    session_write_close();
    header("Location: index.php?login=1");
    exit;
}

// Fetch user details with profession and country names joined
$sql = "SELECT u.*, p.profession_name, c.country_name 
        FROM `user` u 
        LEFT JOIN `profession` p ON u.profession_id = p.id 
        LEFT JOIN `country` c ON u.country_id = c.id 
        WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $target_user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user_data) {
    header("Location: member.php");
    exit;
}

$is_logged_in = (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && !empty($_SESSION['user_id']));
$is_own_profile = ($is_logged_in && $_SESSION['user_id'] == $target_user_id);
$page_title = $user_data['full_name'] . " - Member Profile";
$current_page = "member";

// Determine profile picture path
$profile_img_src = 'images/users/default-avatar.jpg';

if (!empty($user_data['image'])) {
    if (file_exists(__DIR__ . '/images/users/' . $user_data['image'])) {
        $profile_img_src = 'images/users/' . $user_data['image'];
    } elseif (filter_var($user_data['image'], FILTER_VALIDATE_URL)) {
        $profile_img_src = $user_data['image'];
    }
}

include 'includes/header.php';
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    VERIFIED MEMBER DOSSIER
                </span>
                <h1 class="hero-title"><?php echo htmlspecialchars($user_data['full_name'] ?? 'Member Profile'); ?></h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    <?php echo htmlspecialchars($user_data['position'] ?? 'IT Leader'); ?>
                    <?php if (!empty($user_data['company'])): ?>
                        at <strong class="text-white"><?php echo htmlspecialchars($user_data['company']); ?></strong>
                    <?php endif; ?>
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <a href="member.php">Member Directory</a>
                    <span class="sep">/</span>
                    <span class="current">Profile</span>
                </div>
            </div>
            
            <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                <?php if ($is_own_profile): ?>
                    <a href="edit-profile.php" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold">
                        <i class="fa-solid fa-pen-to-square mr-1.5"></i>Edit My Profile
                    </a>
                <?php else: ?>
                    <a href="member.php" class="btn btn-outline-light rounded-pill px-4 py-2 font-weight-bold small">
                        <i class="fa-solid fa-arrow-left mr-1.5"></i>Back to Directory
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Profile Details Section -->
<section class="itlc-content-section">
  <div class="container">

    <!-- Session Alerts -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center mb-4" role="alert" style="border-radius: 12px;">
            <strong>Notice:</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert" style="border-radius: 12px;">
            <strong>Success!</strong> <?php echo htmlspecialchars($_SESSION['success']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div class="row">
      
      <!-- Left Column: Portrait & Quick Actions -->
      <div class="col-lg-4 col-md-5 mb-4">
        <div class="itlc-card p-3 p-sm-4 text-center">
          
          <!-- Avatar Container -->
          <div class="mx-auto mb-3" style="width: 200px; height: 230px; border-radius: 20px; overflow: hidden; background: #f8fafc; border: 3px solid #e2e8f0; box-shadow: 0 10px 25px rgba(6, 72, 122, 0.1);">
            <img src="<?php echo htmlspecialchars($profile_img_src); ?>" alt="<?php echo htmlspecialchars($user_data['full_name']); ?>" class="w-100 h-100" style="object-fit: cover; object-position: top center;">
          </div>

          <?php if ($is_own_profile): ?>
            <!-- CHANGE IMAGE Button -->
            <button type="button" class="btn btn-primary-outline btn-block rounded-pill font-weight-bold text-uppercase py-2 mb-3" data-toggle="modal" data-target="#changeImageModal" style="font-size: 12px;">
              <i class="fa-solid fa-camera mr-1.5"></i>Change Photo
            </button>
          <?php endif; ?>

          <span class="badge badge-pill px-3 py-1 font-weight-bold mb-2" style="background: rgba(16, 185, 129, 0.15); color: #047857; font-size: 11px;">
            <i class="fa-solid fa-circle-check mr-1"></i>Verified Member
          </span>

          <h5 class="font-weight-bold mb-1" style="color: #06487a; font-size: 18px;">
            <?php echo htmlspecialchars($user_data['full_name'] ?? 'Member'); ?>
          </h5>

          <?php if (!empty($user_data['membership_id'])): ?>
            <p class="text-muted small mb-3">
              Member ID: <strong class="text-dark"><?php echo htmlspecialchars($user_data['membership_id']); ?></strong>
            </p>
          <?php endif; ?>

          <!-- Social Links -->
          <?php if (!empty($user_data['twitter_url']) || !empty($user_data['facebook_url']) || !empty($user_data['linkedin_url']) || !empty($user_data['youtube_url'])): ?>
            <div class="pt-3 border-top d-flex justify-content-center align-items-center gap-2">
              <?php if(!empty($user_data['facebook_url'])): ?>
                <a href="<?php echo htmlspecialchars($user_data['facebook_url']); ?>" target="_blank" class="mr-2" style="font-size: 18px; color: #1877F2;"><i class="fa-brands fa-facebook"></i></a>
              <?php endif; ?>
              <?php if(!empty($user_data['twitter_url'])): ?>
                <a href="<?php echo htmlspecialchars($user_data['twitter_url']); ?>" target="_blank" class="mr-2" style="font-size: 18px; color: #1DA1F2;"><i class="fa-brands fa-x-twitter"></i></a>
              <?php endif; ?>
              <?php if(!empty($user_data['linkedin_url'])): ?>
                <a href="<?php echo htmlspecialchars($user_data['linkedin_url']); ?>" target="_blank" class="mr-2" style="font-size: 18px; color: #0A66C2;"><i class="fa-brands fa-linkedin"></i></a>
              <?php endif; ?>
              <?php if(!empty($user_data['youtube_url'])): ?>
                <a href="<?php echo htmlspecialchars($user_data['youtube_url']); ?>" target="_blank" style="font-size: 18px; color: #FF0033;"><i class="fa-brands fa-youtube"></i></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- Right Column: Member Dossier & Metadata Grid -->
      <div class="col-lg-8 col-md-7 mb-4">
        
        <div class="itlc-card p-4 p-md-5 mb-4">
          <div class="d-flex justify-content-between align-items-start mb-3 pb-3 border-bottom">
            <div>
              <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 22px;">
                <?php echo htmlspecialchars($user_data['full_name']); ?>
              </h3>
              <p class="text-muted font-weight-bold mb-0" style="font-size: 15px;">
                <?php echo htmlspecialchars($user_data['position'] ?? ''); ?>
                <?php if (!empty($user_data['company'])): ?>
                  at <span class="text-dark"><?php echo htmlspecialchars($user_data['company']); ?></span>
                <?php endif; ?>
              </p>
            </div>
            <?php if ($is_own_profile): ?>
              <a href="edit-profile.php" class="btn btn-gold-sm py-1 px-3">
                <i class="fa-solid fa-pencil mr-1"></i>Edit
              </a>
            <?php endif; ?>
          </div>

          <!-- Professional Biography -->
          <div class="p-3 rounded-xl bg-surface mb-4" style="border-radius: 14px; border: 1px solid #e2e8f0;">
            <span class="text-uppercase font-weight-bold text-muted small d-block mb-1" style="font-size: 11px;">Executive Biography</span>
            <p class="text-secondary mb-0" style="font-size: 14.5px; line-height: 1.8;">
              <?php 
                $bio = isset($user_data['biography']) ? trim($user_data['biography']) : '';
                if (!empty($bio) && $bio !== '0') {
                    echo nl2br(htmlspecialchars($bio));
                } else {
                    echo 'An experienced tech leader committed to driving innovation, empowering engineering teams, and advancing digital leadership standards across Bangladesh.';
                }
              ?>
            </p>
          </div>

          <!-- Metadata Grid -->
          <h5 class="font-weight-bold mb-3" style="color: #06487a; font-size: 17px;">Professional Background</h5>
          <div class="row">
            
            <div class="col-sm-6 mb-3">
              <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                <span class="text-muted small d-block mb-1"><i class="fa-solid fa-briefcase text-warning mr-1"></i>Primary Discipline</span>
                <strong class="text-dark" style="font-size: 14px;"><?php echo htmlspecialchars(!empty($user_data['profession_name']) ? $user_data['profession_name'] : 'Information Technology'); ?></strong>
              </div>
            </div>

            <div class="col-sm-6 mb-3">
              <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                <span class="text-muted small d-block mb-1"><i class="fa-solid fa-graduation-cap text-primary mr-1"></i>Education</span>
                <strong class="text-dark" style="font-size: 14px;"><?php echo htmlspecialchars(!empty($user_data['highest_education']) ? $user_data['highest_education'] : 'Degree Information Available'); ?></strong>
              </div>
            </div>

            <?php if (!empty($user_data['certification'])): ?>
            <div class="col-sm-6 mb-3">
              <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                <span class="text-muted small d-block mb-1"><i class="fa-solid fa-certificate text-warning mr-1"></i>Certifications</span>
                <strong class="text-dark" style="font-size: 14px;"><?php echo htmlspecialchars($user_data['certification']); ?></strong>
              </div>
            </div>
            <?php endif; ?>

            <div class="col-sm-6 mb-3">
              <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                <span class="text-muted small d-block mb-1"><i class="fa-solid fa-calendar text-info mr-1"></i>Community Member Since</span>
                <strong class="text-dark" style="font-size: 14px;"><?php echo !empty($user_data['created_at']) ? date('d F Y', strtotime($user_data['created_at'])) : 'Verified Founding Member'; ?></strong>
              </div>
            </div>

            <div class="col-sm-6 mb-3">
              <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                <span class="text-muted small d-block mb-1"><i class="fa-solid fa-location-dot text-danger mr-1"></i>Location / Address</span>
                <strong class="text-dark" style="font-size: 14px;"><?php echo htmlspecialchars(!empty($user_data['present_address']) ? $user_data['present_address'] : (!empty($user_data['country_name']) ? $user_data['country_name'] : 'Dhaka, Bangladesh')); ?></strong>
              </div>
            </div>

            <?php if ($is_logged_in): ?>
              <div class="col-sm-6 mb-3">
                <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                  <span class="text-muted small d-block mb-1"><i class="fa-solid fa-envelope text-primary mr-1"></i>Direct Email</span>
                  <a href="mailto:<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" class="font-weight-bold text-primary" style="font-size: 14px; word-break: break-all;">
                    <?php echo htmlspecialchars($user_data['email'] ?? 'Confidential'); ?>
                  </a>
                </div>
              </div>

              <?php if (!empty($user_data['mobile'])): ?>
              <div class="col-sm-6 mb-3">
                <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                  <span class="text-muted small d-block mb-1"><i class="fa-solid fa-phone text-success mr-1"></i>Phone / WhatsApp</span>
                  <a href="tel:<?php echo htmlspecialchars($user_data['mobile']); ?>" class="font-weight-bold text-dark" style="font-size: 14px;">
                    <?php echo htmlspecialchars($user_data['mobile']); ?>
                  </a>
                </div>
              </div>
              <?php endif; ?>

              <?php if (!empty($user_data['blood_group'])): ?>
              <div class="col-sm-6 mb-3">
                <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                  <span class="text-muted small d-block mb-1"><i class="fa-solid fa-droplet text-danger mr-1"></i>Blood Group</span>
                  <strong class="text-danger" style="font-size: 14px;"><?php echo htmlspecialchars($user_data['blood_group']); ?></strong>
                </div>
              </div>
              <?php endif; ?>

              <?php if (!empty($user_data['website_url'])): ?>
              <div class="col-sm-6 mb-3">
                <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                  <span class="text-muted small d-block mb-1"><i class="fa-solid fa-globe text-info mr-1"></i>Personal / Corporate Site</span>
                  <a href="<?php echo htmlspecialchars($user_data['website_url']); ?>" target="_blank" class="text-dark font-weight-bold text-truncate d-block" style="font-size: 14px;">
                    <?php echo htmlspecialchars($user_data['website_url']); ?>
                  </a>
                </div>
              </div>
              <?php endif; ?>
            <?php else: ?>
              <div class="col-12 mt-2">
                <div class="p-3 bg-light rounded text-center small text-muted" style="border-radius: 12px;">
                  <i class="fa-solid fa-lock mr-1 text-warning"></i>
                  <span>Direct contact channels are visible only to verified logged-in ITLC members. <a href="#" data-toggle="modal" data-target="#loginModal" class="font-weight-bold text-primary">Log in here</a>.</span>
                </div>
              </div>
            <?php endif; ?>

          </div>

        </div>

      </div>
    </div>
  </div>
</section>

<!-- Change Image Modal -->
<div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
    <div class="modal-content border-0 p-4" style="border-radius: 20px;">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title font-weight-bold" style="color: #06487a;">Change Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-3">
        <form action="includes/update_avatar.php" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-3">
            <label class="small text-muted mb-2">Select a photo (.jpg, .png, .webp, max 5MB):</label>
            <input type="file" name="avatar" class="form-control-file border p-2 rounded" accept="image/*" required style="border-radius: 10px;">
          </div>
          <div class="text-right mt-4">
            <button type="button" class="btn btn-light rounded-pill px-3 py-1.5 small font-weight-bold mr-2" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4 py-1.5 small font-weight-bold">Upload Photo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
include 'includes/footer.php'; 
?>
