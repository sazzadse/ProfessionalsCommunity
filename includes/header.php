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
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">

  <!-- Dynamic Title -->
    <title><?php 
        if(isset($page_title) && !empty($page_title)) {
            // If page has custom title: "Page Title | Site Name"
            echo $page_title . $title_separator . $default_title;
        } else {
            // If no custom title: Just "Site Name"
            echo $default_title;
        }
    ?></title>


  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/plugins/venobox/venobox.css">

  <!-- Main Stylesheet -->
  <link href="<?php echo $base_url; ?>/css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="<?php echo $base_url; ?>/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php echo $base_url; ?>/images/favicon.ico" type="image/x-icon">

</head>


<!-- header -->
<header class="fixed-top header">
  <!-- top header -->
  <div class="top-header py-2 bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">
          <a class="text-color mr-3"><strong>Call:</strong> +880 1708 168776</a>
          <ul class="list-inline d-inline">
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-linkedin"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-youtube"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
              <li class="list-inline-item"><a class="text-color p-sm-2 py-2 px-0 d-inline-block font-weight-bold" href="<?php echo $base_url; ?>/member-profile.php"><i class="ti-user text-danger mr-1"></i> My Profile</a></li>|
              <li class="list-inline-item"><a class="text-color p-sm-2 py-2 px-0 d-inline-block" href="<?php echo $base_url; ?>/includes/logout.php">Logout</a></li>
            <?php else: ?>
              <li class="list-inline-item"><a class="text-color p-sm-2 py-2 px-0 d-inline-block" href="#" data-toggle="modal" data-target="#loginModal">Member Login</a></li>|
              <li class="list-inline-item"><a class="text-color p-sm-2 py-2 px-0 d-inline-block" href="#" data-toggle="modal" data-target="#signupModal">Become a Member</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- navbar -->
  <div class="navigation w-100">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php"><img src="<?php echo $base_url; ?>/images/logo.png" alt="logo" style="height: 80px; width: 300px;"></a>
        <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item <?php echo $current_page == 'index' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo $base_url; ?>/index.php">Home</a>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    About Us
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/about.php">About ITLC</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/presidents_message.php">President's Message</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/ec-member.php">EC Member</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/ec-adviser.php">EC Member (Adviser)</a>
                </div>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Membership
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/membership-criteria.php">Membership Criteria</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/membership-fee.php">Membership Fee</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/member-benefits.php">Member Benefits</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/member.php">Our Members</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/professional-guidelines.php">Professional Guidelines</a>
                </div>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Media Center
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/events.php">Events</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/blog.php">News</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/notice.php">Photo Gallery</a>
                </div>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Pages
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/member.php">Members Directory</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/member-profile.php">Member Profile</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/notice.php">Notice</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/notice-single.php">Notice Details</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/research.php">Research</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/scholarship.php">Scholarship</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/course-single.php">Course Details</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/event-single.php">Event Details</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/blog.php">Blog</a>
                    <a class="dropdown-item" href="<?php echo $base_url; ?>/blog-single.php">Blog Details</a>
                </div>
            </li>
            <li class="nav-item <?php echo $current_page == 'contact' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo $base_url; ?>/contact.php">Contact</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>

<?php 
include 'loginModal.php'; 
include 'signupModal.php'; 
?>

<main class="main-content">