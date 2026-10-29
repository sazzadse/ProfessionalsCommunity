<?php 
  // Set variables specific to this page
  $page_title = "Executive Committee Meeting of ITLC - IT Leadership Community";
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
    .itlc-about h3,
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

    .itlc-about .event-breadcrumb-link {
        color: #ffbc3b;
        text-decoration: none !important;
        cursor: pointer;
    }

    .itlc-about .event-breadcrumb-link:hover,
    .itlc-about .event-breadcrumb-link:focus,
    .itlc-about .event-breadcrumb-link:active {
        color: #ffbc3b !important;
        text-decoration: none !important;
    }

    .itlc-about .event-breadcrumb-separator {
        color: #06487a;
        font-weight: 400;
        margin: 0 10px;
        font-size: 22px;
    }

    /* Title Underline */
    .itlc-about .title-accent {
        width: 45px;
        height: 3px;
        background: #06487a;
        border-radius: 2px;
        margin-bottom: 25px;
    }

    .itlc-about .outcome-text {
        font-size: 15px;
        line-height: 1.9;
    }

    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 20px;
        }

        .itlc-about .event-breadcrumb-separator {
            margin: 0 6px;
            font-size: 18px;
        }
    }
</style>

<section class="itlc-about">
  <div class="container">

    <!-- Page Header -->
    <div class="row">
      <div class="col-12">
        <h1 class="main-title">
          <a href="events.php" class="event-breadcrumb-link">Events</a>
          <span class="event-breadcrumb-separator">&gt;</span>
          <span style="color: #06487a; font-size: 20px;">Executive Committee Meeting of ITLC</span>
        </h1>
        <div class="title-accent"></div>
      </div>
    </div>

    <!-- event single content -->
    <div class="row">
      <!-- event image -->
      <div class="col-12 mb-4">
        <img src="images/events/event-details-1.jpg" alt="event thumb" class="img-fluid w-100">
      </div>
    </div>
    <!-- event info -->
    <div class="row align-items-center mb-5">
      <div class="col-lg-12">
        <ul class="list-inline">
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-location-pin text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">LOCATION</h6>
                <p class="mb-0">Pan Pacific Sonargaon, Dhaka</p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-calendar text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">DATE</h6>
                <p class="mb-0">10 October 2025</p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-time text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">TIME</h6>
                <p class="mb-0">07: 00 pm</p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-wallet text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">ENTRY FEE</h6>
                <p class="mb-0">From: 1000 BDT</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
    <!-- event details -->
    <div class="row">
      <div class="col-12">
        <h3 class="mb-3">Event Details</h3>
          <p class="outcome-text mb-0">
            The meeting resulted in the formation of several sub-committees dedicated to advancing innovation, leadership, and collaboration across the technology ecosystem. Key focus areas include strengthening the <strong>#Governance_Framework</strong> to guide technology-driven initiatives and strategic decisions, enhancing <strong>#Technical_Training_and_Development</strong> to build leadership in emerging technologies, and streamlining <strong>#Tech_Job_Placement</strong> to connect skilled professionals with leading organizations. <br>

            The initiative also focuses on elevating <strong>#Technology_Event_Management</strong> to promote networking, knowledge sharing, and innovation showcases. <br>

            In addition, expanding <strong>#Public_Relations_and_Collaborations</strong> with ITLC members, technology partners, industry IT leaders, and academia will help accelerate digital transformation and foster high-quality collaboration. <br>

            Our commitment to <strong>#Foreign_Affairs</strong> will strengthen global engagement by connecting with international technology ecosystems. <br>

            Furthermore, establishing a transparent <strong>#Fund_Management</strong> framework will ensure sustainable growth and effective utilization of member contributions for impactful community initiatives.
          </p>
      </div>
    </div>
  </div>
</section>
<!-- /itlc-about -->

<?php 
include 'includes/footer.php'; 
?>