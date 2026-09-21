<?php 
// member-profile.php
if (ob_get_level() === 0) {
    ob_start();
}

// Set variables specific to this page
$page_title = "My Profile";
$page_description = "Member profile details and settings.";
$current_page = "profile";

include 'includes/config.php';

// Security check: if no ID parameter and not logged in, redirect to login
$target_user_id = isset($_GET['id']) ? (int)$_GET['id'] : ($_SESSION['user_id'] ?? 0);

if ($target_user_id <= 0) {
    session_write_close();
    header("Location: index.php?login=1");
    exit;
}

include 'includes/header.php';

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

$is_own_profile = (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && !empty($_SESSION['user_id']) && $_SESSION['user_id'] == $target_user_id);
$page_title = $user_data['full_name'] . " - Member Profile";

// Determine profile picture path
$profile_img_src = 'images/users/default-avatar.jpg'; // Default fallback image

if (!empty($user_data['image'])) {
    // Check in users folder
    if (file_exists(__DIR__ . '/images/users/' . $user_data['image'])) {
        $profile_img_src = 'images/users/' . $user_data['image'];
    }
    // Check if it's a full path or URL
    elseif (filter_var($user_data['image'], FILTER_VALIDATE_URL)) {
        $profile_img_src = $user_data['image'];
    }
}
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="member.php">Our Member</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Members Details</li>
        </ul>
        <p class="text-lighten">
          An experienced tech leader driven by innovation and strategic digital transformation. Committed to empowering teams, bridging business with technology, and shaping the future of IT leadership.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- member details -->
<section class="section bg-white pt-5 pb-5">
  <div class="container">

    <!-- Session Alerts -->
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

    <div class="row">
      
      <!-- Profile Picture Column -->
      <div class="col-lg-4 col-md-5 mb-4">
        <div class="border p-1 bg-white mb-2 shadow-sm">
          <img src="<?php echo htmlspecialchars($profile_img_src); ?>" alt="Member Profile Picture" class="img-fluid w-100" style="height: 330px; object-fit: cover;">
        </div>
        <?php if ($is_own_profile): ?>
          <!-- CHANGE IMAGE Button -->
          <button type="button" class="btn btn-primary-outline btn-block rounded-0 font-weight-bold text-uppercase" data-toggle="modal" data-target="#changeImageModal" style="font-size: 13px; padding: 7px 10px;">
            <i class="ti-image mr-1"></i> CHANGE IMAGE
          </button>
        <?php else: ?>
          <a href="member.php" class="btn btn-primary-outline btn-block rounded-0 font-weight-bold text-uppercase" style="font-size: 13px; padding: 7px 10px;">
            <i class="ti-arrow-left mr-1"></i> BACK TO MEMBERS
          </a>
        <?php endif; ?>
      </div>
      <!-- Member Details Column -->
      <div class="col-lg-8 col-md-7 mb-4">
        
        <!-- Name Header and EDIT PROFILE Button -->
        <div class="d-flex justify-content-between align-items-start mb-2">
          <div>
            <h3 class="font-weight-bold text-dark d-inline-block mb-0" style="font-size: 24px;">
              <?php echo htmlspecialchars($user_data['full_name'] ?? 'Member Name'); ?>
            </h3>
            <span class="badge badge-success rounded-circle ml-1 mb-2 p-1 align-middle" title="Verified Member" style="font-size: 13px; line-height: 1;">
              <i class="ti-check"></i>
            </span>
          </div>

          <?php if ($is_own_profile): ?>
            <!-- EDIT PROFILE Button -->
            <a href="edit-profile.php" class="btn btn-primary-outline btn-sm text-uppercase font-weight-bold px-3 py-1" style="font-size: 13px; padding: 7px 10px;">
              <i class="ti-pencil mr-1"></i> EDIT PROFILE
            </a>
          <?php else: ?>
            <a href="member.php" class="btn btn-primary-outline btn-sm text-uppercase font-weight-bold px-3 py-1" style="font-size: 13px; padding: 7px 10px;">
              <i class="ti-arrow-left mr-1"></i> BACK TO LIST
            </a>
          <?php endif; ?>
        </div>

        <!-- Position & Company -->
        <p class="font-weight-bold text-dark d-block mb-1">
          <?php echo htmlspecialchars($user_data['position'] ?? ''); ?>
          <?php if (!empty($user_data['company'])): ?>
            , <?php echo htmlspecialchars($user_data['company']); ?>
          <?php endif; ?>
        </p>

        <!-- Biography -->
        <p class="font-italic mb-4 text-color" style="font-size: 16px;">
          <?php 
            $bio = isset($user_data['biography']) ? trim($user_data['biography']) : '';
            if (!empty($bio) && $bio !== '0') {
                echo htmlspecialchars($bio);
            } else {
                echo 'A dedicated professional believing in lifelong learning and collaborative growth.';
            }
          ?>
        </p>

        <!-- Social Links -->
        <?php if (!empty($user_data['twitter_url']) || !empty($user_data['facebook_url']) || !empty($user_data['linkedin_url']) || !empty($user_data['youtube_url'])): ?>
          <div class="mb-4">
            <span class="font-weight-bold text-dark d-block mb-2">Social Links</span>
            <ul class="list-inline mb-0">
              <?php if(!empty($user_data['facebook_url'])): ?>
                <li class="list-inline-item mr-2"><a href="<?php echo htmlspecialchars($user_data['facebook_url']); ?>" style="font-size: 16px; color:#1877F2;"><i class="ti-facebook"></i></a></li>
              <?php endif; ?>
              <?php if(!empty($user_data['youtube_url'])): ?>
                <li class="list-inline-item mr-2"><a href="<?php echo htmlspecialchars($user_data['youtube_url']); ?>" style="font-size: 16px; color:#FF0033;"><i class="ti-youtube"></i></a></li>
              <?php endif; ?>
              <?php if(!empty($user_data['twitter_url'])): ?>
                <li class="list-inline-item mr-2"><a href="<?php echo htmlspecialchars($user_data['twitter_url']); ?>" style="font-size: 16px; color:#1DA1F2;"><i class="ti-twitter"></i></a></li>
              <?php endif; ?>
              <?php if(!empty($user_data['linkedin_url'])): ?>
                <li class="list-inline-item mr-2"><a href="<?php echo htmlspecialchars($user_data['linkedin_url']); ?>" style="font-size: 16px; color:#0A66C2;"><i class="ti-linkedin"></i></a></li>
              <?php endif; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Details List -->
        <div class="row">
          <div class="col-md-12">
            <h4 class="mb-3">Details:</h4>
            <ul class="list-unstyled">
              <li class="mb-3">
                <span class="text-color"><i class="ti-id-badge mr-2"></i>Member ID: <?php echo htmlspecialchars($user_data['membership_id'] ?? 'N/A'); ?></span>
              </li>
              <li class="mb-3">
                <span class="text-color"><i class="ti-briefcase mr-2"></i>Profession: <?php echo htmlspecialchars(!empty($user_data['profession_name']) ? $user_data['profession_name'] : 'N/A'); ?></span>
              </li>
              <li class="mb-3">
                <a class="text-color" href="mailto:<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>"><i class="ti-email mr-2"></i>Email: <?php echo htmlspecialchars($user_data['email'] ?? 'N/A'); ?></a>
              </li>
              <li class="mb-3">
                <a class="text-color" href="tel:<?php echo htmlspecialchars($user_data['mobile'] ?? ''); ?>"><i class="ti-mobile mr-2"></i>Phone: <?php echo htmlspecialchars(!empty($user_data['mobile']) ? $user_data['mobile'] : 'N/A'); ?></a>
              </li>
              <li class="mb-3">
                <a class="text-color" href="<?php echo htmlspecialchars($user_data['website_url'] ?? '#'); ?>" target="_blank"><i class="ti-world mr-2"></i>Web: <?php echo htmlspecialchars(!empty($user_data['website_url']) ? $user_data['website_url'] : 'N/A'); ?></a>
              </li>
              <li class="mb-3">
                <span class="text-color"><i class="ti-heart mr-2"></i>Blood Group: <?php echo htmlspecialchars(!empty($user_data['blood_group']) ? $user_data['blood_group'] : 'N/A'); ?></span>
              </li>
              <li class="mb-3">
                <span class="text-color"><i class="ti-calendar mr-2"></i>Joining Date: <?php echo !empty($user_data['created_at']) ? date('d F Y', strtotime($user_data['created_at'])) : 'N/A'; ?></span>
              </li>
              <li class="mb-3">
                <span class="text-color"><i class="ti-location-pin mr-2"></i>Location: <?php echo htmlspecialchars(!empty($user_data['present_address']) ? $user_data['present_address'] : (!empty($user_data['country_name']) ? $user_data['country_name'] : 'N/A')); ?></span>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- /member details -->

<!-- Change Image Modal -->
<div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-sm p-3">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title font-weight-bold text-dark" id="changeImageModalLabel">Change Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-3">
        <form action="includes/update_avatar.php" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-3">
            <label class="small text-muted mb-2">Select a photo from your device (.jpg, .png, .gif, .webp, max 5MB):</label>
            <input type="file" name="avatar" class="form-control-file border p-2 rounded" accept="image/*" required>
          </div>
          <div class="text-right mt-4">
            <button type="button" class="btn btn-primary-outline btn-sm rounded-0 mr-2" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-update-orange btn-sm">Upload Photo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
include 'includes/footer.php'; 
?>