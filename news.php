<?php 
  $page_title = "News - IT Leadership Community";
  $current_page = "news";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';
?>

<style>
    .itlc-about {
        padding: 170px 0 60px;
        color: #06487a;
    }

    .itlc-about h1 {
        color: #ffbc3b;
    }

    .itlc-about h2,
    .itlc-about p,
    .itlc-about li,
    .itlc-about strong {
        color: #06487a;
    }

    /* Main Title */
    .itlc-about .main-title {
        font-size: 25px;
        font-weight: 700;
        line-height: 1.4;
        margin: 0 0 12px;
    }

    /* Title Underline */
    .itlc-about .title-accent {
        width: 45px;
        height: 3px;
        background: #06487a;
        border-radius: 2px;
        margin-bottom: 25px;
    }

    /* Card styling matching events */
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(6, 72, 122, 0.12) !important;
    }

    .card-title {
        color: #06487a;
        font-size: 20px;
        font-family: "Trebuchet MS", sans-serif;
        font-weight: 700;
        line-height: 1.3;
        transition: color 0.2s ease;
    }

    .card-title:hover {
        color: #ffbc3b;
    }

    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 25px;
        }
    }
</style>

<section class="itlc-about">
  <div class="container">

    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <h1 class="main-title">News</h1>
        <div class="title-accent"></div>
        <p class="mb-5">
          Explore the latest announcements, updates, leadership insights, and press releases from the IT Leadership Community (ITLC).
        </p>
      </div>
    </div>

    <!-- News Grid (Descending Order: 6 to 1) -->
    <div class="row">
      <!-- news 6 -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-6.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Alex Pitt</span>
              <span><i class="ti-calendar text-primary mr-1"></i>24 August 2025</span>
            </p>
            <a href="news-single.php?id=6"><h4 class="card-title">The Changing Scenario in Tech & Digital Ecosystem</h4></a>
          </div>
        </div>
      </div>

      <!-- news 5 -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-5.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Jonathon Drew</span>
              <span><i class="ti-calendar text-primary mr-1"></i>13 August 2025</span>
            </p>
            <a href="news-single.php?id=5"><h4 class="card-title">Completion of Projects Before the Deadline</h4></a>
          </div>
        </div>
      </div>

      <!-- news 4 -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-4.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Somrat Sorkar</span>
              <span><i class="ti-calendar text-primary mr-1"></i>28 August 2025</span>
            </p>
            <a href="news-single.php?id=4"><h4 class="card-title">Enrolling New Members into the ITLC Network</h4></a>
          </div>
        </div>
      </div>

      <!-- news 3 -->
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-3.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Alex Pitt</span>
              <span><i class="ti-calendar text-primary mr-1"></i>24 August 2025</span>
            </p>
            <a href="news-single.php?id=3"><h4 class="card-title">Strategic Technology Trends Driving Enterprise Growth</h4></a>
          </div>
        </div>
      </div>

      <!-- news 2 -->
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-2.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Jonathon Drew</span>
              <span><i class="ti-calendar text-primary mr-1"></i>13 August 2025</span>
            </p>
            <a href="news-single.php?id=2"><h4 class="card-title">The Expenses You Are Thinking</h4></a>
          </div>
        </div>
      </div>

      <!-- news 1 -->
      <div class="col-lg-4 col-sm-6 mb-0">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/news/news-1.jpg" alt="news thumb">
          </div>
          <div class="card-body">
            <p class="mb-2" style="font-size: 13px; color: #555;">
              <span class="mr-3"><i class="ti-user text-primary mr-1"></i>By Somrat Sorkar</span>
              <span><i class="ti-calendar text-primary mr-1"></i>28 August 2025</span>
            </p>
            <a href="news-single.php?id=1"><h4 class="card-title">Elegant Light Box Paper Cut Dioramas</h4></a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- /itlc-about -->

<?php 
include 'includes/footer.php'; 
?>
