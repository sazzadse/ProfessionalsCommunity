<?php 
// Start session globally so alerts work on any page
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Enable output buffering
if (ob_get_level() === 0) {
    ob_start();
}

// Get the base URL dynamically pointing to project root
$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$root_dir   = preg_replace('#/includes$#', '', $script_dir);
$base_url   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . rtrim($root_dir, '/');
$current_page = $current_page ?? basename($_SERVER['PHP_SELF'], '.php');
$default_title = $default_title ?? "ITLC";
$title_separator = $title_separator ?? " | ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#06487a">

  <!-- Dynamic Title -->
  <title><?php 
      if(isset($page_title) && !empty($page_title)) {
          echo htmlspecialchars($page_title) . $title_separator . htmlspecialchars($default_title);
      } else {
          echo htmlspecialchars($default_title) . " - IT Leadership Community";
      }
  ?></title>

  <!-- Modern 2026 Typography: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
  
  <!-- FontAwesome 6 for modern symbols & icons (v6.5.2 supports X logo) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
  <!-- ** Core Plugins ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/slick/slick.css">
  <!-- themify-icon -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/venobox/venobox.css">

  <!-- Main Unified 2026 Stylesheet -->
  <link href="<?php echo $base_url; ?>/css/style.css?v=202601" rel="stylesheet">
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo $base_url; ?>/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo $base_url; ?>/images/favicon.ico" type="image/x-icon">
</head>

<body>

<!-- Header Section with Glassmorphism -->
<header class="fixed-top itlc-header-wrapper">
  
  <!-- Modern Top Utility Bar -->
  <div class="itlc-topbar py-1">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Contact quick info -->
        <div class="topbar-left d-flex align-items-center">
          <a href="tel:+8801708168776" class="topbar-link mr-3 d-none d-sm-inline-flex align-items-center">
            <i class="fa-solid fa-phone-volume text-warning mr-1 small"></i>
            <span>+880 1708 168776</span>
          </a>
          <a href="mailto:contact@itlc.org" class="topbar-link mr-3 d-none d-md-inline-flex align-items-center">
            <i class="fa-regular fa-envelope text-warning mr-1 small"></i>
            <span>desk@itlc.org</span>
          </a>
          <span class="topbar-tagline d-none d-lg-inline-block text-white-50 small">
            Empowering Technology Leadership in Bangladesh
          </span>
        </div>

        <!-- Social Icons & Auth Shortcuts -->
        <div class="topbar-right d-flex align-items-center">
          <div class="topbar-social mr-3 d-none d-sm-flex align-items-center">
            <a href="#" class="topbar-icon" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="topbar-icon" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" class="topbar-icon" title="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class="topbar-icon" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>

          <div class="topbar-auth d-flex align-items-center">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
              <a href="<?php echo $base_url; ?>/member-profile.php" class="auth-pill-link mr-3">
                <i class="fa-solid fa-circle-user mr-1 text-warning"></i>
                <span>My Profile</span>
              </a>
              <a href="<?php echo $base_url; ?>/includes/logout.php" class="auth-pill-link">
                <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>
                <span>Logout</span>
              </a>
            <?php else: ?>
              <a href="#" data-toggle="modal" data-target="#loginModal" class="auth-pill-link mr-3">
                <i class="fa-solid fa-arrow-right-to-bracket mr-1 text-warning"></i>
                <span>Member Login</span>
              </a>
              <span class="text-white-50 mr-3 d-none d-sm-inline">|</span>
              <a href="<?php echo $base_url; ?>/member.php" class="auth-pill-link d-none d-sm-inline-flex align-items-center">
                <i class="fa-solid fa-users mr-1 text-warning"></i>
                <span>Directory</span>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Navigation Bar -->
  <div class="itlc-navbar-container">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light px-0 py-2">
        
        <!-- Brand Logo -->
        <a class="navbar-brand py-1" href="<?php echo $base_url; ?>/index.php">
          <img src="<?php echo $base_url; ?>/images/logo/logo.png" alt="ITLC Logo" class="itlc-brand-logo">
        </a>

        <!-- Modern Hamburger Button -->
        <button class="navbar-toggler modern-hamburger border-0 p-2" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="hamburger-bar"></span>
          <span class="hamburger-bar"></span>
          <span class="hamburger-bar"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto align-items-lg-center">
            
            <li class="nav-item <?php echo $current_page == 'index' ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo $base_url; ?>/index.php">Home</a>
            </li>

            <!-- About Us Dropdown -->
            <li class="nav-item dropdown <?php echo in_array($current_page, ['about', 'presidents_message', 'ec-member', 'ec-adviser']) ? 'active' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                About Us
              </a>
              <div class="dropdown-menu modern-dropdown shadow-lg border-0" aria-labelledby="aboutDropdown">
                <a class="dropdown-item" href="<?php echo $base_url; ?>/about.php">
                  <i class="fa-solid fa-circle-info text-primary mr-2"></i>About ITLC
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/presidents_message.php">
                  <i class="fa-solid fa-quote-left text-warning mr-2"></i>President's Message
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/ec-member.php">
                  <i class="fa-solid fa-users-gear text-primary mr-2"></i>Executive Committee (EC)
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/ec-adviser.php">
                  <i class="fa-solid fa-user-tie text-info mr-2"></i>EC Advisory Board
                </a>
              </div>
            </li>

            <!-- Membership Dropdown -->
            <li class="nav-item dropdown <?php echo in_array($current_page, ['membership-criteria', 'membership-fee', 'member-benefits', 'member', 'professional-guidelines']) ? 'active' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="membershipDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Membership
              </a>
              <div class="dropdown-menu modern-dropdown shadow-lg border-0" aria-labelledby="membershipDropdown">
                <a class="dropdown-item" href="<?php echo $base_url; ?>/membership-criteria.php">
                  <i class="fa-solid fa-list-check text-success mr-2"></i>Membership Criteria
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/membership-fee.php">
                  <i class="fa-solid fa-money-check-dollar text-primary mr-2"></i>Membership Fee
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/member-benefits.php">
                  <i class="fa-solid fa-gift text-warning mr-2"></i>Member Benefits
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/member.php">
                  <i class="fa-solid fa-address-book text-info mr-2"></i>Our Members Directory
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/professional-guidelines.php">
                  <i class="fa-solid fa-scale-balanced text-secondary mr-2"></i>Professional Guidelines
                </a>
              </div>
            </li>

            <!-- Media Center Dropdown -->
            <li class="nav-item dropdown <?php echo in_array($current_page, ['events', 'event-single', 'news', 'news-single', 'photo-gallery']) ? 'active' : ''; ?>">
              <a class="nav-link dropdown-toggle" href="#" id="mediaDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Media Center
              </a>
              <div class="dropdown-menu modern-dropdown shadow-lg border-0" aria-labelledby="mediaDropdown">
                <a class="dropdown-item" href="<?php echo $base_url; ?>/events.php">
                  <i class="fa-regular fa-calendar-days text-primary mr-2"></i>Events & Summits
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/news.php">
                  <i class="fa-regular fa-newspaper text-warning mr-2"></i>Articles & News
                </a>
                <a class="dropdown-item" href="<?php echo $base_url; ?>/photo-gallery.php">
                  <i class="fa-regular fa-images text-success mr-2"></i>Photo Gallery
                </a>
              </div>
            </li>

            <li class="nav-item <?php echo $current_page == 'contact' ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo $base_url; ?>/contact.php">Contact Us</a>
            </li>

            <!-- Navbar Quick Action Button -->
            <li class="nav-item nav-action-item ml-lg-3 my-2 my-lg-0">
              <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <a href="<?php echo $base_url; ?>/member-profile.php" class="btn btn-navbar-cta">
                  <i class="fa-solid fa-user-shield mr-2"></i>My Account
                </a>
              <?php else: ?>
                <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-navbar-cta">
                  <i class="fa-solid fa-id-badge mr-2"></i>
                  <span>Become a Member</span>
                </a>
              <?php endif; ?>
            </li>

          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>

<?php 
// Include Global Auth Modals
include 'loginModal.php'; 
include 'signupModal.php'; 
?>

<!-- Main Content Wrapper (Compensates for fixed glassmorphic header) -->
<main class="itlc-main-content">
