<?php 
  $page_title = "Home";
  $page_description = "ITLC - The Premier IT Leadership Community in Bangladesh";
  $page_keywords = "leadership, cio, cto, it managers, tech community, bangladesh";

  // Include configuration & global header
  include 'includes/config.php';
  include 'includes/header.php';
  
  // Fetch dynamic membership counts from user table
  $counts = [];
  $res = $conn->query("SELECT membership_type_id, COUNT(*) as count FROM `user` WHERE membership_type_id IS NOT NULL GROUP BY membership_type_id");
  if ($res) {
      while($row = $res->fetch_assoc()) {
          $counts[$row['membership_type_id']] = $row['count'];
      }
  }
  // IDs based on DB seeding: 1: Lifetime, 2: Professional, 3: General, 4: Student
  $lifetime = $counts[1] ?? 0;
  $professional = $counts[2] ?? 0;
  $general = $counts[3] ?? 0;
  $student = $counts[4] ?? 0;
  $total_members = $lifetime + $professional + $general + $student;
?>

<style>
/* Modern 2026 Hero Slider System */
.itlc-hero-section {
    padding: 40px 0 60px;
    background: radial-gradient(100% 80% at 50% 0%, rgba(6, 72, 122, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
    position: relative;
    overflow: hidden;
}

.itlc-hero-slide {
    outline: none;
    padding: 10px 0 25px;
}

.hero-custom-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}

.hero-text-col {
    width: 44%;
}

.hero-img-col {
    width: 52%;
}

.hero-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(255, 188, 59, 0.16);
    color: #b45309;
    border: 1px solid rgba(255, 188, 59, 0.35);
    margin-bottom: 18px;
}

.hero-title {
    color: #06487a;
    font-size: 38px;
    font-weight: 800;
    line-height: 1.18;
    letter-spacing: -0.6px;
    margin-bottom: 16px;
}

.hero-desc {
    color: #475569;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 24px;
}

.hero-img-wrapper {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 45px -12px rgba(6, 72, 122, 0.18);
    border: 4px solid #ffffff;
    background: #06487a;
}

.hero-slider-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.hero-img-wrapper:hover .hero-slider-img {
    transform: scale(1.03);
}

.hero-slider {
    position: relative;
    overflow: hidden;
    width: 100%;
}

/* Hide legacy slick arrows & dots */
.hero-slider .slick-dots,
.hero-slider .prevArrow,
.hero-slider .nextArrow,
.hero-slider .slick-arrow {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
}

/* Custom Yellow Active-Slide Indicator */
.hero-custom-indicator-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 22px;
    padding-bottom: 4px;
}

.hero-indicator-track {
    width: 140px;
    height: 5px;
    background: rgba(6, 72, 122, 0.12);
    border-radius: 9999px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.08);
}

.hero-indicator-bar {
    width: 25%;
    height: 100%;
    background: linear-gradient(90deg, #ffbc3b, #f59e0b);
    border-radius: 9999px;
    box-shadow: 0 0 10px rgba(245, 158, 11, 0.6);
    transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    transform: translateX(0%);
}

@media (max-width: 991px) {
    .hero-text-col,
    .hero-img-col {
        width: 100%;
    }
    .hero-text-col {
        margin-bottom: 30px;
        text-align: center;
    }
    .hero-title {
        font-size: 28px;
    }
    .hero-slider-img {
        height: 300px;
    }
    .hero-badge-pill {
        margin-left: auto;
        margin-right: auto;
    }
}

/* Modern Metric Cards */
.metric-box-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 18px;
    padding: 24px 14px;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.metric-box-card:hover {
    background: rgba(255, 255, 255, 0.14);
    border-color: #ffbc3b;
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
}

.metric-icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 12px;
}

/* Event & News Card Upgrades */
.itlc-media-card {
    background: #ffffff;
    border: 1px solid rgba(6, 72, 122, 0.08);
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 16px rgba(6, 72, 122, 0.04);
}

.itlc-media-card:hover {
    transform: translateY(-5px);
    border-color: rgba(6, 72, 122, 0.2);
    box-shadow: 0 18px 35px -10px rgba(6, 72, 122, 0.14);
}

.itlc-media-img {
    height: 200px;
    object-fit: cover;
    width: 100%;
    transition: transform 0.5s ease;
}

.itlc-media-card:hover .itlc-media-img {
    transform: scale(1.05);
}

.date-badge-pill {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    padding: 6px 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    line-height: 1.2;
}

.date-badge-pill .day {
    font-size: 16px;
    font-weight: 800;
    color: #06487a;
    display: block;
}

.date-badge-pill .month {
    font-size: 10px;
    font-weight: 700;
    color: #b45309;
    text-transform: uppercase;
}

/* Member Horizontal Card */
.member-h-card {
    background: #ffffff;
    border: 1px solid rgba(6, 72, 122, 0.08);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(6, 72, 122, 0.04);
}

.member-h-card:hover {
    transform: translateY(-4px);
    border-color: rgba(6, 72, 122, 0.2);
    box-shadow: 0 16px 30px -8px rgba(6, 72, 122, 0.12);
}

/* Partner Logo Grayscale & Hover Transition */
.partner-logo-item {
    height: 65px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.65;
    transition: all 0.3s ease;
}

.partner-logo-item:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.05);
}
</style>

<!-- 1. MODERN HERO SLIDER -->
<section class="itlc-hero-section">
  <div class="container">
    <div class="hero-slider">
      
      <!-- Slide 1 -->
      <div class="itlc-hero-slide">
        <div class="hero-custom-row">
          <div class="hero-text-col">
            <div class="hero-badge-pill">
              <i class="fa-solid fa-shield-halved"></i>
              <span>National Executive Network</span>
            </div>
            <h1 class="hero-title">IT Leadership Community (ITLC)</h1>
            <p class="hero-desc">
              The IT Leadership Community is an exclusive, non-profit organization uniting visionary CIOs, CTOs, Heads of IT, and technology directors across Bangladesh. We are dedicated to accelerating leadership excellence, establishing benchmark operational standards, and driving national digital transformation.
            </p>
            <div class="d-flex flex-wrap gap-2">
              <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary rounded-pill px-4 py-2 mr-2 font-weight-bold">
                <span>Join As A Member</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
              <a href="about.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                Learn About ITLC
              </a>
            </div>
          </div>
          <div class="hero-img-col">
            <div class="hero-img-wrapper">
              <img src="images/banner/banner-1.jpg" alt="ITLC Conference" class="hero-slider-img">
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="itlc-hero-slide">
        <div class="hero-custom-row flex-lg-row-reverse">
          <div class="hero-text-col">
            <div class="hero-badge-pill">
              <i class="fa-solid fa-handshake-angle"></i>
              <span>Executive Peer Collaboration</span>
            </div>
            <h1 class="hero-title">Collaborative Platform for IT Leaders</h1>
            <p class="hero-desc">
              ITLC serves as a catalyst for professional development by cultivating an inclusive ecosystem where tech executives collaborate, share strategic insights, and solve complex industry challenges. Through mentorship and peer networking, we empower leaders to navigate rapidly shifting technologies.
            </p>
            <div class="d-flex flex-wrap gap-2">
              <a href="member.php" class="btn btn-primary rounded-pill px-4 py-2 mr-2 font-weight-bold">
                <span>Explore Directory</span>
                <i class="fa-solid fa-users ml-1 small"></i>
              </a>
              <a href="member-benefits.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                Member Benefits
              </a>
            </div>
          </div>
          <div class="hero-img-col">
            <div class="hero-img-wrapper">
              <img src="images/banner/banner-2.jpg" alt="Executive Meeting" class="hero-slider-img">
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="itlc-hero-slide">
        <div class="hero-custom-row">
          <div class="hero-text-col">
            <div class="hero-badge-pill">
              <i class="fa-solid fa-chart-line"></i>
              <span>National Tech Vision</span>
            </div>
            <h1 class="hero-title">Envisioning a Tech-Driven Bangladesh</h1>
            <p class="hero-desc">
              ITLC is steadfastly committed to positioning Bangladesh as a recognized global technology hub. By setting benchmark standards for corporate IT governance, cyber resilience, and economic advancement, we pave the way for breakthrough innovation and national prosperity.
            </p>
            <div class="d-flex flex-wrap gap-2">
              <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary rounded-pill px-4 py-2 mr-2 font-weight-bold">
                <span>Apply For Membership</span>
                <i class="fa-solid fa-id-card ml-1 small"></i>
              </a>
              <a href="professional-guidelines.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                Professional Guidelines
              </a>
            </div>
          </div>
          <div class="hero-img-col">
            <div class="hero-img-wrapper">
              <img src="images/banner/banner-3.jpg" alt="Technology Leaders" class="hero-slider-img">
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 4 -->
      <div class="itlc-hero-slide">
        <div class="hero-custom-row flex-lg-row-reverse">
          <div class="hero-text-col">
            <div class="hero-badge-pill">
              <i class="fa-solid fa-graduation-cap"></i>
              <span>Mentorship & Enrichment</span>
            </div>
            <h1 class="hero-title">Empowering Future Tech Visionaries</h1>
            <p class="hero-desc">
              Bridging the technology leadership deficit, ITLC actively nurtures the next generation of digital pioneers. By hosting specialized masterclasses, executive leadership workshops, and strategic forums, we equip emerging technology professionals to champion transformative change.
            </p>
            <div class="d-flex flex-wrap gap-2">
              <a href="events.php" class="btn btn-primary rounded-pill px-4 py-2 mr-2 font-weight-bold">
                <span>Upcoming Summits</span>
                <i class="fa-solid fa-calendar ml-1 small"></i>
              </a>
              <a href="ec-member.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                Executive Committee
              </a>
            </div>
          </div>
          <div class="hero-img-col">
            <div class="hero-img-wrapper">
              <img src="images/banner/banner-4.jpg" alt="Masterclasses" class="hero-slider-img">
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Modern Yellow Active-Slide Indicator (Clean single bar, zero arrows, zero numbers, zero dots) -->
    <div class="hero-custom-indicator-wrap" aria-label="Slider Active Indicator">
      <div class="hero-indicator-track" title="Slide Navigation (Click to switch)">
        <div class="hero-indicator-bar" id="heroActiveIndicator"></div>
      </div>
    </div>
  </div>
</section>

<!-- 2. HIGH-IMPACT COMMUNITY COUNTER BOARD -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #021424 0%, #03233e 50%, #06487a 100%);">
    <div class="container text-center">
        
        <!-- Section Header -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    COMMUNITY NETWORK
                </span>
                <h3 class="font-weight-bold mb-2 text-white" style="font-size: 28px; letter-spacing: -0.5px;">Our Community Ecosystem</h3>
                <p class="mb-0 text-white-50 small">Uniting visionary leaders, corporate IT directors, and tech students nationwide.</p>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            
            <!-- Total Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="metric-box-card">
                    <div class="metric-icon-circle" style="background: rgba(77, 179, 255, 0.15); color: #4db3ff;">
                        <i class="fa-solid fa-users-viewfinder"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1 count text-white" style="font-size: 32px; line-height: 1;" data-count="<?php echo $total_members; ?>"><?php echo $total_members; ?></h2>
                    <p class="mb-0 text-white-50 text-uppercase font-weight-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">Total Members</p>
                </div>
            </div>

            <!-- Lifetime Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="metric-box-card">
                    <div class="metric-icon-circle" style="background: rgba(255, 188, 59, 0.18); color: #ffbc3b;">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1 count text-white" style="font-size: 32px; line-height: 1;" data-count="<?php echo $lifetime; ?>"><?php echo $lifetime; ?></h2>
                    <p class="mb-0 text-white-50 text-uppercase font-weight-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">Lifetime</p>
                </div>
            </div>

            <!-- Professional Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="metric-box-card">
                    <div class="metric-icon-circle" style="background: rgba(16, 185, 129, 0.18); color: #10b981;">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1 count text-white" style="font-size: 32px; line-height: 1;" data-count="<?php echo $professional; ?>"><?php echo $professional; ?></h2>
                    <p class="mb-0 text-white-50 text-uppercase font-weight-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">Professionals</p>
                </div>
            </div>

            <!-- General Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="metric-box-card">
                    <div class="metric-icon-circle" style="background: rgba(129, 140, 248, 0.18); color: #818cf8;">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1 count text-white" style="font-size: 32px; line-height: 1;" data-count="<?php echo $general; ?>"><?php echo $general; ?></h2>
                    <p class="mb-0 text-white-50 text-uppercase font-weight-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">General</p>
                </div>
            </div>

            <!-- Student Members -->
            <div class="col-6 col-md">
                <div class="metric-box-card">
                    <div class="metric-icon-circle" style="background: rgba(244, 114, 182, 0.18); color: #f472b6;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h2 class="font-weight-bold mb-1 count text-white" style="font-size: 32px; line-height: 1;" data-count="<?php echo $student; ?>"><?php echo $student; ?></h2>
                    <p class="mb-0 text-white-50 text-uppercase font-weight-bold" style="font-size: 11.5px; letter-spacing: 0.5px;">Students</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. MISSION & VISION SECTION -->
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container py-4">
        
        <!-- Section Header -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 11px;">
                    DRIVING PURPOSE
                </span>
                <h3 class="font-weight-bold mb-2" style="color: #06487a; font-size: 28px;">Guiding Strategy & Foundation</h3>
                <p class="text-muted small mb-0">Upholding ethical leadership, technical advancement, and digital governance across industries.</p>
            </div>
        </div>

        <div class="row">
            <!-- Mission Card -->
            <div class="col-md-6 mb-4 mb-md-0 d-flex">
                <div class="itlc-card p-4 p-lg-5 w-100 d-flex flex-column" style="border-top: 4px solid #06487a;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px; background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 20px;">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h4 class="font-weight-bold mb-0" style="color: #06487a; font-size: 22px;">Our Mission</h4>
                    </div>
                    <p class="text-muted" style="line-height: 1.8; font-size: 14.5px;">
                        To empower technology professionals through collaborative knowledge exchange, executive leadership development, and continuous skill enrichment. We cultivate an inclusive ecosystem that fosters innovation, upholds ethical standards, and accelerates career growth.
                    </p>
                    <ul class="list-unstyled mb-4 small text-secondary">
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success mr-2"></i>Executive roundtables and technical masterclasses</li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-success mr-2"></i>Mentorship bridging emerging leaders to C-suite roles</li>
                        <li><i class="fa-solid fa-circle-check text-success mr-2"></i>Continuous professional enrichment programs</li>
                    </ul>
                    <div class="mt-auto pt-2">
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold">
                            Join the Community
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Vision Card -->
            <div class="col-md-6 d-flex">
                <div class="itlc-card p-4 p-lg-5 w-100 d-flex flex-column" style="border-top: 4px solid #ffbc3b;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255, 188, 59, 0.18); color: #b45309; font-size: 20px;">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h4 class="font-weight-bold mb-0" style="color: #06487a; font-size: 22px;">Our Vision</h4>
                    </div>
                    <p class="text-muted" style="line-height: 1.8; font-size: 14.5px;">
                        To become the premier platform for IT leaders and tech visionaries in Bangladesh, shaping the future of technology through strategic collaboration, breakthrough innovation, and national digital advancement.
                    </p>
                    <ul class="list-unstyled mb-4 small text-secondary">
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-warning mr-2"></i>Setting benchmark standards for the IT profession</li>
                        <li class="mb-2"><i class="fa-solid fa-circle-check text-warning mr-2"></i>Positioning Bangladesh as a recognized tech hub</li>
                        <li><i class="fa-solid fa-circle-check text-warning mr-2"></i>Fostering national digital resilience and economic growth</li>
                    </ul>
                    <div class="mt-auto pt-2">
                        <a href="about.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                            Explore About ITLC
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Strategic Objective Banner -->
    <div class="container-fluid py-4 text-white mt-4" style="background: linear-gradient(135deg, #03233e 0%, #06487a 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 mb-3 mb-md-0 pr-md-5">
                    <h4 class="text-white font-weight-bold mb-1" style="font-size: 20px; letter-spacing: -0.3px;">
                        Delivering world-class professional development, executive mentorship, and strategic networking.
                    </h4>
                    <p class="text-white-50 small mb-0">Uniting CIOs, CTOs, and Heads of IT across banking, telecoms, garments, and enterprise sectors.</p>
                </div>
                <div class="col-md-5 text-md-right">
                    <a href="member.php" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold">
                        <span>Browse Member Directory</span>
                        <i class="fa-solid fa-arrow-right ml-1 small"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. LATEST EVENTS SECTION -->
<section class="py-5" style="background-color: #ffffff;">
  <div class="container py-3">
    
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-4">
      <div>
        <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 11px;">
            MEDIA CENTER
        </span>
        <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 26px;">Latest Events & Summits</h3>
        <p class="text-muted small mb-0">Join our upcoming conferences, roundtables, and technical sessions.</p>
      </div>
      <div class="mt-3 mt-sm-0">
        <a href="events.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold small">
          <span>See All Events</span>
          <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>
    </div>

    <div class="row justify-content-center">
      
      <!-- Event 1 (Event 6) -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/events/event-6.jpg" alt="Executive Committee Meeting">
            <div class="date-badge-pill">
              <span class="day">12</span>
              <span class="month">Sep 2026</span>
            </div>
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <p class="small text-muted mb-2">
              <i class="fa-solid fa-location-dot text-warning mr-1"></i>Pan Pacific Sonargaon, Dhaka
            </p>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="event-single.php?id=6" class="text-dark">Executive Committee Strategic Meeting of ITLC</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="event-single.php?id=6" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>View Details</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Event 2 (Event 5) -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/events/event-5.jpg" alt="Executive Committee Meeting">
            <div class="date-badge-pill">
              <span class="day">15</span>
              <span class="month">Jun 2026</span>
            </div>
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <p class="small text-muted mb-2">
              <i class="fa-solid fa-location-dot text-warning mr-1"></i>Pan Pacific Sonargaon, Dhaka
            </p>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="event-single.php?id=5" class="text-dark">Executive Committee Leadership Review of ITLC</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="event-single.php?id=5" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>View Details</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Event 3 (Event 4) -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/events/event-4.jpg" alt="Executive Committee Meeting">
            <div class="date-badge-pill">
              <span class="day">20</span>
              <span class="month">Apr 2026</span>
            </div>
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <p class="small text-muted mb-2">
              <i class="fa-solid fa-location-dot text-warning mr-1"></i>Pan Pacific Sonargaon, Dhaka
            </p>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="event-single.php?id=4" class="text-dark">Executive Committee Foundation Assembly of ITLC</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="event-single.php?id=4" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>View Details</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 5. LATEST NEWS SECTION -->
<section class="py-5" style="background-color: #f8fafc;">
  <div class="container py-3">
    
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-4">
      <div>
        <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.16); color: #b45309; font-size: 11px;">
            INSIGHTS & PRESS
        </span>
        <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 26px;">Latest News & Articles</h3>
        <p class="text-muted small mb-0">Stay informed with community insights, announcements, and leadership perspectives.</p>
      </div>
      <div class="mt-3 mt-sm-0">
        <a href="news.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold small">
          <span>See All News</span>
          <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>
    </div>

    <div class="row justify-content-center">
      
      <!-- News 1 -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/news/news-6.jpg" alt="News Image">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex align-items-center small text-muted mb-2">
              <span class="mr-3"><i class="fa-regular fa-user mr-1 text-primary"></i>Alex Pitt</span>
              <span><i class="fa-regular fa-calendar mr-1 text-primary"></i>24 Aug 2025</span>
            </div>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="news-single.php?id=6" class="text-dark">The Changing Scenario in Tech & Digital Ecosystem</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="news-single.php?id=6" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>Read Full Story</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- News 2 -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/news/news-5.jpg" alt="News Image">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex align-items-center small text-muted mb-2">
              <span class="mr-3"><i class="fa-regular fa-user mr-1 text-primary"></i>Jonathon Drew</span>
              <span><i class="fa-regular fa-calendar mr-1 text-primary"></i>13 Aug 2025</span>
            </div>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="news-single.php?id=5" class="text-dark">Completion of Strategic Tech Projects Before the Deadline</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="news-single.php?id=5" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>Read Full Story</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- News 3 -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="itlc-media-card h-100 d-flex flex-column">
          <div class="position-relative overflow-hidden">
            <img class="itlc-media-img" src="images/news/news-4.jpg" alt="News Image">
          </div>
          <div class="p-4 d-flex flex-column flex-grow-1">
            <div class="d-flex align-items-center small text-muted mb-2">
              <span class="mr-3"><i class="fa-regular fa-user mr-1 text-primary"></i>Somrat Sorkar</span>
              <span><i class="fa-regular fa-calendar mr-1 text-primary"></i>28 Aug 2025</span>
            </div>
            <h5 class="font-weight-bold mb-3" style="font-size: 16px; line-height: 1.4;">
              <a href="news-single.php?id=4" class="text-dark">Enrolling New Members into the Active ITLC Network</a>
            </h5>
            <div class="mt-auto pt-2 border-top">
              <a href="news-single.php?id=4" class="font-weight-bold small text-primary d-inline-flex align-items-center">
                <span>Read Full Story</span>
                <i class="fa-solid fa-arrow-right ml-1 small"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 6. OUR MEMBERS SECTION -->
<section class="py-5" style="background-color: #ffffff;">
  <div class="container py-3">
    
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-4">
      <div>
        <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 11px;">
            MEMBER SPOTLIGHT
        </span>
        <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 26px;">Distinguished Community Members</h3>
        <p class="text-muted small mb-0">Meet the IT executives, directors, and managers shaping our digital future.</p>
      </div>
      <div class="mt-3 mt-sm-0">
        <a href="member.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold small">
          <span>Explore All Members</span>
          <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>
    </div>

    <!-- Member List Query -->
    <div class="row">
      <?php 
        $members_query = "SELECT id, full_name, position, company, image FROM `user` ORDER BY id ASC LIMIT 6";
        $members_res = $conn->query($members_query);
        if ($members_res && $members_res->num_rows > 0):
          while ($m = $members_res->fetch_assoc()):
            $img_src = 'images/users/default-avatar.jpg';
            if (!empty($m['image'])) {
              if (file_exists(__DIR__ . '/images/users/' . $m['image'])) {
                $img_src = 'images/users/' . $m['image'];
              } elseif (filter_var($m['image'], FILTER_VALIDATE_URL)) {
                $img_src = $m['image'];
              }
            }
            if (!file_exists(__DIR__ . '/' . $img_src) && !filter_var($img_src, FILTER_VALIDATE_URL)) {
              $img_src = 'images/users/default-avatar.jpg';
            }
            $profile_url = 'member-profile.php?id=' . (int)$m['id'];
      ?>
      <!-- Member Item -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="member-h-card p-3 d-flex align-items-center h-100">
          <div class="flex-shrink-0 mr-3" style="width: 80px; height: 80px; border-radius: 14px; overflow: hidden; background: #f1f5f9; border: 2px solid #e2e8f0;">
            <a href="<?php echo $profile_url; ?>" class="d-block w-100 h-100">
              <img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($m['full_name']); ?>" class="w-100 h-100" style="object-fit: cover; object-position: top center;">
            </a>
          </div>
          <div class="flex-grow-1 min-w-0">
            <h5 class="font-weight-bold mb-1 text-truncate" style="font-size: 15px;">
              <a href="<?php echo $profile_url; ?>" class="text-dark"><?php echo htmlspecialchars($m['full_name']); ?></a>
            </h5>
            <p class="text-muted small mb-2 text-truncate" style="font-size: 12.5px; line-height: 1.3;">
              <?php 
                $job_info = [];
                if (!empty($m['position'])) {
                  $job_info[] = $m['position'];
                }
                if (!empty($m['company'])) {
                  $job_info[] = $m['company'];
                }
                if (!empty($job_info)) {
                  echo htmlspecialchars(implode(', ', $job_info));
                } else {
                  echo 'Member, ITLC';
                }
              ?>
            </p>
            <div>
              <a href="<?php echo $profile_url; ?>" class="btn btn-gold-sm py-1 px-3" style="font-size: 11px;">View Profile</a>
            </div>
          </div>
        </div>
      </div>
      <?php 
          endwhile;
        endif; 
      ?>
    </div>

  </div>
</section>

<!-- 7. OUR PARTNERS SECTION -->
<section class="py-5" style="background-color: #f8fafc; border-top: 1px solid rgba(6, 72, 122, 0.06);">
    <div class="container text-center">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 11px;">
                    STRATEGIC ALLIANCE
                </span>
                <h4 class="font-weight-bold" style="color: #06487a; font-size: 24px;">Our Community Partners</h4>
                <p class="text-muted small mb-0">Collaborating with leading enterprises to drive national technological advancement.</p>
            </div>
        </div>

        <!-- Partner Slider/Grid -->
        <div class="partner-slider align-items-center">
            <div class="px-3">
                <img src="images/partners/partners1.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 1">
            </div>
            <div class="px-3">
                <img src="images/partners/partners2.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 2">
            </div>
            <div class="px-3">
                <img src="images/partners/partners3.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 3">
            </div>
            <div class="px-3">
                <img src="images/partners/partners4.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 4">
            </div>
            <div class="px-3">
                <img src="images/partners/partners5.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 5">
            </div>
            <div class="px-3">
                <img src="images/partners/partners6.png" class="img-fluid mx-auto partner-logo-item" alt="Partner 6">
            </div>
        </div>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>

<!-- Automatically open modal if there is a signup error or success message -->
<?php if (isset($_GET['signup'])): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    if (window.jQuery) {
        $('#signupModal').modal('show');
    }
});
</script>
<?php endif; ?>
