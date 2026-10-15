<?php 
  $page_title = "Home";
  $page_description = "ITLC - Your bright future is our mission";
  $page_keywords = "education, community, learning, it";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';
  
  // Fetch membership counts
  $counts = [];
  $res = $conn->query("SELECT membership_type_id, COUNT(*) as count FROM user WHERE membership_type_id IS NOT NULL GROUP BY membership_type_id");
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
?>

<style>
/* Slick dots alignment to bottom center */
.hero-slider .slick-dots {
    text-align: center !important;
    bottom: -35px !important;
    left: 0;
    right: 0;
}
.hero-slider .slick-dots li button {
    background: #cddbe8;
    border-radius: 50%;
    opacity: 1;
}
.hero-slider .slick-dots li.slick-active button {
    background: #06487a;
}

/* Slider item height setup */
.hero-slider-item {
    height: auto !important;
    padding-bottom: 25px;
    background: none !important;
}

/* Custom width logic (60% image, 35% text, 5% gap) */
.slider-custom-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
}
.slider-text-col {
    width: 35%;
}
.slider-img-col {
    width: 60%;
}

/* Typography & Text Styling for professional corporate look */
.slider-title {
    color: #06487a;
    font-size: 30px;
    font-weight: 700;
    line-height: 1.25;
    letter-spacing: -0.5px;
}
.slider-desc {
    color: #06487a;
    font-size: 15px;
    line-height: 1.6;
    font-weight: 400;
    opacity: 0.95;
}

/* Fixed height 380px for images */
.hero-slider-img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 16px;
    box-shadow: 0 12px 32px rgba(6, 72, 122, 0.12);
}

/* Responsive adjustment for mobile/tablet */
@media (max-width: 991px) {
    .slider-text-col,
    .slider-img-col {
        width: 100%;
    }
    .slider-text-col {
        margin-bottom: 25px;
    }
    .slider-title {
        font-size: 28px;
    }
}

/* Partner Logo Grayscale & Hover Transition */
.partner-logo {
    height: 70px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: filter 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
}
.partner-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: translateY(-3px);
}
</style>

<!-- hero slider -->
<section class="hero-section" style="padding-top: 160px; background-color: #fff; padding-bottom: 75px;">
  <div class="hero-slider">
    
    <!-- Slider 1 (Text 35% Left, Gap 5%, Image 60% Right) -->
    <div class="hero-slider-item">
        <div class="container">
            <div class="slider-custom-row">
                <div class="slider-text-col">
                    <h1 class="slider-title mb-3">IT Leadership Community (ITLC)</h1>
                    <p class="slider-desc mb-0">The IT Leadership Community (ITLC) is an exclusive, non-profit, and non-political organization uniting visionary technology leaders, including CIOs, CTOs, Heads of IT, and Senior Project Managers. We are dedicated to accelerating professional excellence, establishing robust operational frameworks, and empowering technology executives to lead digital transformation across industries.</p>
                </div>
                <div class="slider-img-col">
                    <img src="images/banner/banner-1.jpg" alt="Banner 1" class="hero-slider-img">
                </div>
            </div>
        </div>
    </div>

    <!-- Slider 2 (Image 60% Left, Gap 5%, Text 35% Right) -->
    <div class="hero-slider-item">
        <div class="container">
            <div class="slider-custom-row flex-lg-row-reverse">
                <div class="slider-text-col">
                    <h1 class="slider-title mb-3">Collaborative Platform for IT Leaders</h1>
                    <p class="slider-desc mb-0">ITLC serves as a catalyst for professional development by cultivating an inclusive ecosystem where tech executives collaborate, share strategic insights, and solve complex industry challenges. Through knowledge sharing, mentorship, and peer networking, we empower leaders to navigate the rapidly evolving technology landscape.</p>
                </div>
                <div class="slider-img-col">
                    <img src="images/banner/banner-2.jpg" alt="Banner 2" class="hero-slider-img">
                </div>
            </div>
        </div>
    </div>

    <!-- Slider 3 (Text 35% Left, Gap 5%, Image 60% Right) -->
    <div class="hero-slider-item">
        <div class="container">
            <div class="slider-custom-row">
                <div class="slider-text-col">
                    <h1 class="slider-title mb-3">Envisioning a Tech-Driven Bangladesh</h1>
                    <p class="slider-desc mb-0">ITLC is steadfastly committed to positioning Bangladesh as a global technology hub. By setting benchmark standards for the IT profession, promoting sustainable digital governance, and stimulating national economic growth, we pave the way for breakthrough innovation, digital resilience, and a prosperous future for the ecosystem.</p>
                </div>
                <div class="slider-img-col">
                    <img src="images/banner/banner-3.jpg" alt="Banner 3" class="hero-slider-img">
                </div>
            </div>
        </div>
    </div>

    <!-- Slider 4 (Image 60% Left, Gap 5%, Text 35% Right) -->
    <div class="hero-slider-item">
        <div class="container">
            <div class="slider-custom-row flex-lg-row-reverse">
                <div class="slider-text-col">
                    <h1 class="slider-title mb-3">Empowering Future Tech Visionaries</h1>
                    <p class="slider-desc mb-0">Bridging the technology leadership deficit, ITLC actively nurtures the next generation of digital pioneers. By hosting specialized masterclasses, executive leadership workshops, and strategic forums, we equip emerging technology professionals with the critical capabilities required to champion transformative change in a complex global market.</p>
                </div>
                <div class="slider-img-col">
                    <img src="images/banner/banner-4.jpg" alt="Banner 4" class="hero-slider-img">
                </div>
            </div>
        </div>
    </div>

  </div>
</section>
<!-- /hero slider -->


<!-- Membership Counter Board -->
<section style="background: linear-gradient(135deg, #06487a 0%, #083456 100%); padding: 45px 0;">
    <div class="container text-center">
        
        <!-- Section Header Title -->
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-8">
                <h3 class="font-weight-bold mb-2 text-center" style="color: #ffffff; font-size: 30px; letter-spacing: -0.5px; margin-bottom: 15px!important;">Our Community</h3>
                <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 15px;">Uniting visionary leaders, IT professionals, and students across the nation.</p>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            
            <!-- Total Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="text-center" style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 12px; padding: 22px 10px;">
                    <i class="ti-user mb-2 d-block text-center" style="color: #4db3ff; font-size: 30px;"></i>
                    <h2 class="font-weight-bold mb-1 count text-center" style="color: #ffffff; font-size: 34px; line-height: 1;" data-count="<?php echo $lifetime + $professional + $general + $student; ?>">0</h2>
                    <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Total Members</p>
                </div>
            </div>

            <!-- Lifetime Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="text-center" style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 12px; padding: 22px 10px;">
                    <i class="ti-id-badge mb-2 d-block text-center" style="color: #4db3ff; font-size: 30px;"></i>
                    <h2 class="font-weight-bold mb-1 count text-center" style="color: #ffffff; font-size: 34px; line-height: 1;" data-count="<?php echo $lifetime; ?>">0</h2>
                    <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Lifetime Members</p>
                </div>
            </div>

            <!-- Professional Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="text-center" style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 12px; padding: 22px 10px;">
                    <i class="ti-briefcase mb-2 d-block text-center" style="color: #4db3ff; font-size: 30px;"></i>
                    <h2 class="font-weight-bold mb-1 count text-center" style="color: #ffffff; font-size: 34px; line-height: 1;" data-count="<?php echo $professional; ?>">0</h2>
                    <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Professional Members</p>
                </div>
            </div>

            <!-- General Members -->
            <div class="col-6 col-md mb-3 mb-md-0">
                <div class="text-center" style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 12px; padding: 22px 10px;">
                    <i class="ti-crown mb-2 d-block text-center" style="color: #4db3ff; font-size: 30px;"></i>
                    <h2 class="font-weight-bold mb-1 count text-center" style="color: #ffffff; font-size: 34px; line-height: 1;" data-count="<?php echo $general; ?>">0</h2>
                    <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">General Members</p>
                </div>
            </div>

            <!-- Student Members -->
            <div class="col-6 col-md text-center">
                <div class="text-center" style="background: rgba(255, 255, 255, 0.07); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 12px; padding: 22px 10px;">
                    <i class="ti-book mb-2 d-block text-center" style="color: #4db3ff; font-size: 30px;"></i>
                    <h2 class="font-weight-bold mb-1 count text-center" style="color: #ffffff; font-size: 34px; line-height: 1;" data-count="<?php echo $student; ?>">0</h2>
                    <p class="mb-0 text-center" style="color: rgba(255, 255, 255, 0.85); font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Student Members</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /Membership Counter Board -->


<!-- Mission & Vision Section -->
<section class="section pb-0" style="padding-top: 50px;">
    <div class="container mb-5">
        
        <!-- Section Title -->
        <div class="row justify-content-center mb-3">
            <div class="col-lg-8 text-center">
                <h3 class="section-title font-weight-bold text-center" style="color: #06487a !important; font-size: 30px; letter-spacing: -0.5px; margin-bottom: 15px;">Our Driving Purpose</h3>
                <p class="text-center" style="color: #06487a; font-size: 15px; margin-bottom: 0;">Guiding tech excellence, leadership, and digital transformation across the industry.</p>
            </div>
        </div>

        <div class="row text-center position-relative" style="padding-top: 20px;">
            <!-- Vertical Divider Line (Green, Hidden on Mobile) -->
            <div class="d-none d-md-block position-absolute" style="border-left: 2px dashed #28a745; height: 85%; left: 50%; top: 5%; transform: translateX(-50%); opacity: 0.6;"></div>
            
            <!-- Mission -->
            <div class="col-md-6 px-4 px-md-5 mb-5 mb-md-0 d-flex flex-column">
                <div class="p-2 d-flex flex-column h-100 align-items-center">
                    <h4 class="font-weight-bold mb-3" style="color: #06487a; font-size: 24px;">Our Mission</h4>
                    <p class="mb-4" style="color: #06487a; font-size: 15px; line-height: 1.8; font-weight: 400;">
                        To empower technology professionals through collaborative knowledge exchange, executive leadership development, and continuous skill enrichment. We build an inclusive ecosystem that fosters innovation, upholds ethical standards, and accelerates career growth.
                    </p>
                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline px-4 py-2 mt-auto">Join the Community</a>
                </div>
            </div>
            
            <!-- Vision -->
            <div class="col-md-6 px-4 px-md-5 d-flex flex-column">
                <div class="p-2 d-flex flex-column h-100 align-items-center">
                    <h4 class="font-weight-bold mb-3" style="color: #06487a; font-size: 24px;">Our Vision</h4>
                    <p class="mb-4" style="color: #06487a; font-size: 15px; line-height: 1.8; font-weight: 400;">
                        To become the premier platform for IT leaders and tech visionaries in Bangladesh, shaping the future of technology through strategic collaboration, breakthrough innovation, and national digital advancement.
                    </p>
                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline px-4 py-2 mt-auto">Join the Community</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Our Strategic Objective Banner -->
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #06487a 0%, #083456 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0 position-relative pr-md-5">
                    <h3 class="text-white font-weight-bold mb-0" style="font-size: 24px; line-height: 1.5; letter-spacing: -0.3px;">
                        Delivering world-class professional development, executive mentorship, and strategic networking opportunities.
                    </h3>
                    <div class="d-none d-md-block position-absolute" style="border-right: 2px solid rgba(255,255,255,0.25); height: 80%; right: 0; top: 10%;"></div>
                </div>
                <div class="col-md-6 pl-md-5">
                    <h4 class="text-white font-weight-bold mb-2" style="font-size: 20px;">Core Objective</h4>
                    <p class="text-white mb-0" style="font-size: 15px; line-height: 1.7; opacity: 0.9;">
                        Advancing expertise across software architecture, cybersecurity, infrastructure, emerging tech domains, and empowering tech talent nationwide.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Mission & Vision -->

<!-- about us -->
<!-- <section class="section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 order-2 order-md-1">
        <h3 class="section-title">About ITLC</h3>
        <p>The IT Leadership Community (ITLC) is a non-profit, non-political organization comprised of senior IT leaders, including CIOs, CTOs, Head of IT, IT Managers, and IT Project Managers. It was established to create a collaborative platform for IT professionals to grow together and support each other in leadership development.</p>
        <p>ITLC envisions a tech-driven Bangladesh by advancing and setting standards for the IT profession and leadership, driving economic growth, and fostering innovation for a prosperous future.</p>
        <a href="about.php" class="btn btn-primary-outline">Learn more</a>
      </div>
      <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
        <img class="img-fluid w-100 rounded shadow" src="images/about/about-us.jpg" alt="about image">
      </div>
    </div>
  </div>
</section> -->
<!-- /about us -->

<!-- events -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h3 class="mb-0 text-nowrap mr-3">Events</h3>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="events.php" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see all</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-top" src="images/events/fecm_home.jpg" alt="event thumb">
        <div class="card-date"><span>19</span><br>Septemter<br>2025</div>
      </div>
      <div class="card-body">
        <!-- location -->
        <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
        <a href="event-single.php"><h4 class="card-title">First Executive Committee Meeting of ITLC</h4></a>
      </div>
    </div>
  </div>
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-top" src="images/events/event-2.jpg" alt="event thumb">
        <div class="card-date"><span>21</span><br>December</div>
      </div>
      <div class="card-body">
        <!-- location -->
        <p><i class="ti-location-pin text-primary mr-2"></i>Cambridge, USA</p>
        <a href="event-single.php"><h4 class="card-title">Research seminar in clinical science.</h4></a>
      </div>
    </div>
  </div>
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-top" src="images/events/event-3.jpg" alt="event thumb">
        <div class="card-date"><span>23</span><br>December</div>
      </div>
      <div class="card-body">
        <!-- location -->
        <p><i class="ti-location-pin text-primary mr-2"></i>Dhanmondi Lake, Dhaka</p>
        <a href="event-single.php"><h4 class="card-title">Firefly training in trauma-informed yoga</h4></a>
      </div>
    </div>
  </div>
</div>
    <!-- mobile see all button -->
    <div class="row">
      <div class="col-12 text-center">
        <a href="events.php" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">see all</a>
      </div>
    </div>
  </div>
</section>
<!-- /events -->

<!-- blog -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h3 class="mb-0 text-nowrap mr-3">Latest News</h3>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="blog.php" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see all</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <!-- blog post -->
      <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card rounded border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
          <img class="card-img-top rounded-top" src="images/blog/post-1.jpg" alt="Post thumb">
          <div class="card-body">
            <!-- post meta -->
            <ul class="list-inline mb-3">
              <!-- post date -->
              <li class="list-inline-item mr-3 ml-0">August 28, 2019</li>
              <!-- author -->
              <li class="list-inline-item mr-3 ml-0">By Jonathon</li>
            </ul>
            <a href="blog-single.php">
              <h4 class="card-title">The Expenses You Are Thinking.</h4>
            </a>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
            <a href="blog-single.php" class="btn btn-primary btn-sm">read more</a>
          </div>
        </div>
      </article>
      <!-- blog post -->
      <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card rounded border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
          <img class="card-img-top rounded-top" src="images/blog/post-2.jpg" alt="Post thumb">
          <div class="card-body">
            <!-- post meta -->
            <ul class="list-inline mb-3">
              <!-- post date -->
              <li class="list-inline-item mr-3 ml-0">August 13, 2019</li>
              <!-- author -->
              <li class="list-inline-item mr-3 ml-0">By Jonathon Drew</li>
            </ul>
            <a href="blog-single.php">
              <h4 class="card-title">Tips to Succeed in an Online Course</h4>
            </a>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
            <a href="blog-single.php" class="btn btn-primary btn-sm">read more</a>
          </div>
        </div>
      </article>
      <!-- blog post -->
      <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card rounded border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
          <img class="card-img-top rounded-top" src="images/blog/post-3.jpg" alt="Post thumb">
          <div class="card-body">
            <!-- post meta -->
            <ul class="list-inline mb-3">
              <!-- post date -->
              <li class="list-inline-item mr-3 ml-0">August 24, 2018</li>
              <!-- author -->
              <li class="list-inline-item mr-3 ml-0">By Alex Pitt</li>
            </ul>
            <a href="blog-single.php">
              <h4 class="card-title">Orientation Program for the new students</h4>
            </a>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
            <a href="blog-single.php" class="btn btn-primary btn-sm">read more</a>
          </div>
        </div>
      </article>
    </div>
    <!-- mobile see all button -->
    <div class="row">
      <div class="col-12 text-center">
        <a href="blog.php" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">see all</a>
      </div>
    </div>
  </div>
</section>
<!-- /blog -->

<!-- our members -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h3 class="mb-0 text-nowrap mr-3">Our Members</h3>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="member.php" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see all</a>
          </div>
        </div>
      </div>
    </div>
    <!-- member list -->
    <div class="row justify-content-center">
      <?php 
        // Fetch first 6 members from user table serially
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
      <!-- member item -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card p-0 border-0 rounded hover-shadow h-100 d-flex flex-row bg-white overflow-hidden shadow-sm">
          <div class="card-img-wrapper flex-shrink-0" style="width: 125px; min-height: 145px; background-color: #f8f9fa;">
            <a href="<?php echo $profile_url; ?>" class="w-100 h-100 d-block">
              <img class="card-img-top rounded-0 w-100 h-100" src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($m['full_name']); ?>" style="object-fit: cover; object-position: top center;">
            </a>
          </div>
          <div class="card-body d-flex flex-column p-3 pb-2 flex-grow-1" style="min-width: 0;">
            <div>
              <a href="<?php echo $profile_url; ?>">
                <h4 class="card-title mb-1 text-dark" style="font-size: 16px; font-weight: 600; line-height: 1.3;"><?php echo htmlspecialchars($m['full_name']); ?></h4>
              </a>
              <p class="card-text text-color mb-2 small" style="line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
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
                    echo '<span class="text-muted">Member, ITLC</span>';
                  }
                ?>
              </p>
            </div>
            <div class="mt-auto pt-2">
              <a href="<?php echo $profile_url; ?>" class="btn btn-primary btn-sm py-1 px-3" style="font-size: 12px;">Show Profile</a>
            </div>
          </div>
        </div>
      </div>
      <?php 
          endwhile;
        endif; 
      ?>
    </div>
    <!-- /member list -->
    <!-- mobile see all button -->
    <div class="row">
      <div class="col-12 text-center">
        <a href="member.php" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">see all</a>
      </div>
    </div>
  </div>
</section>
<!-- /our members -->

<!-- Our Partners -->
<section class="section py-5">
    <div class="container">
        <!-- Section Title -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h3 class="section-title font-weight-bold" style="color: #06487a !important; font-size: 25px; margin-bottom: 8px !important;">Our Partners</h3>
                <p class="text-center mb-0" style="color: #06487a; font-size: 15px; margin-bottom: 15px !important;">Collaborating with industry leaders to drive technological advancement.</p>
            </div>
        </div>

        <!-- Partner Slider/Grid -->
        <div class="partner-slider text-center align-items-center">
            <div class="px-3">
                <img src="images/partners/partners1.png" class="img-fluid mx-auto partner-logo" alt="Partner 1">
            </div>
            <div class="px-3">
                <img src="images/partners/partners2.png" class="img-fluid mx-auto partner-logo" alt="Partner 2">
            </div>
            <div class="px-3">
                <img src="images/partners/partners3.png" class="img-fluid mx-auto partner-logo" alt="Partner 3">
            </div>
            <div class="px-3">
                <img src="images/partners/partners4.png" class="img-fluid mx-auto partner-logo" alt="Partner 4">
            </div>
            <div class="px-3">
                <img src="images/partners/partners5.png" class="img-fluid mx-auto partner-logo" alt="Partner 5">
            </div>
            <div class="px-3">
                <img src="images/partners/partners6.png" class="img-fluid mx-auto partner-logo" alt="Partner 6">
            </div>
        </div>
    </div>
</section>
<!-- /Our Partners -->

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