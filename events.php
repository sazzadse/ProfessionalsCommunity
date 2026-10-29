<?php 
  $page_title = "Upcoming Events - IT Leadership Community";
  $current_page = "events";

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
        <h1 class="main-title">Events</h1>
        <div class="title-accent"></div>
        <p class="mb-5">
          Explore upcoming conferences, summits, and leadership workshops organized by the IT Leadership Community (ITLC) to empower technology leaders across Bangladesh.
        </p>
      </div>
    </div>

    <div class="row">
      <!-- event 6 -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-top" src="images/events/event-6.jpg" alt="event thumb">
            <div class="card-date"><span>12</span><br>September<br>2026</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-6.php"><h4 class="card-title">Executive Committee Meeting of ITLC</h4></a>
          </div>
        </div>
      </div>
      
      <!-- event 5 -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="images/events/event-5.jpg" alt="event thumb">
            <div class="card-date"><span>15</span><br>June<br>2026</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-5.php">
              <h4 class="card-title">Executive Committee Meeting of ITLC</h4>
            </a>
          </div>
        </div>
      </div>
      <!-- event -->
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="images/events/event-4.jpg" alt="event thumb">
            <div class="card-date"><span>20</span><br>April<br>2026</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-4.php">
              <h4 class="card-title">Executive Committee Meeting of ITLC</h4>
            </a>
          </div>
        </div>
      </div>
      <!-- event -->
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="images/events/event-3.jpg" alt="event thumb">
            <div class="card-date"><span>05</span><br>January<br>2026</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-3.php">
              <h4 class="card-title">Executive Committee Meeting of ITLC</h4>
            </a>
          </div>
        </div>
      </div>
      <!-- event -->
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="images/events/event-2.jpg" alt="event thumb">
            <div class="card-date"><span>19</span><br>October<br>2025</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-2.php">
              <h4 class="card-title">Executive Committee Meeting of ITLC</h4>
            </a>
          </div>
        </div>
      </div>
      <!-- event -->
      <div class="col-lg-4 col-sm-6 mb-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <div class="card-img position-relative">
            <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
            <div class="card-date"><span>10</span><br>October<br>2025</div>
          </div>
          <div class="card-body">
            <!-- location -->
            <p><i class="ti-location-pin text-primary mr-2"></i>Pan Pacific Sonargaon, Dhaka</p>
            <a href="event-details-1.php">
              <h4 class="card-title">Executive Committee Meeting of ITLC</h4>
            </a>
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