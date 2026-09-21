<?php 
  // Set variables specific to this page
  $page_title = "Home - My Awesome Website";
  $page_description = "Welcome to our amazing website. We offer the best services.";
  $current_page = "home";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="events.php">Events</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">First Executive Committee Meeting of ITLC</li>
        </ul>
        <!-- <p class="text-lighten">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- event single -->
<section class="section-sm">
  <div class="container">
    <div class="row">
      <!-- <div class="col-12">
        <h2 class="section-title">English Spoken</h2>
      </div> -->
      <!-- event image -->
      <div class="col-12 mb-4">
        <img src="images/events/fecm_main.jpg" alt="event thumb" class="img-fluid w-100">
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
                <p class="mb-0">19 September 2025</p>
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
      <!-- <div class="col-lg-3 text-lg-right text-left">
        <a href="#" class="btn btn-primary">Apply now</a>
      </div> -->
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
    <!-- event details -->
    <div class="row">
      <div class="col-12 mb-50">
        <h3>Event Details</h3>
          <p class="outcome-text">
            The meeting resulted in the formation of several sub-committees dedicated to advancing innovation, leadership, and collaboration across the technology ecosystem. Key focus areas include strengthening the <strong>#Governance_Framework</strong> to guide technology-driven initiatives and strategic decisions, enhancing <strong>#Technical_Training_and_Development</strong> to build leadership in emerging technologies, and streamlining <strong>#Tech_Job_Placement</strong> to connect skilled professionals with leading organizations. <br>

            The initiative also focuses on elevating <strong>#Technology_Event_Management</strong> to promote networking, knowledge sharing, and innovation showcases. <br>

            In addition, expanding <strong>#Public_Relations_and_Collaborations</strong> with ITLC members, technology partners, industry IT leaders, and academia will help accelerate digital transformation and foster high-quality collaboration. <br>

            Our commitment to <strong>#Foreign_Affairs</strong> will strengthen global engagement by connecting with international technology ecosystems. <br>

            Furthermore, establishing a transparent <strong>#Fund_Management</strong> framework will ensure sustainable growth and effective utilization of member contributions for impactful community initiatives.
          </p>
      </div>
    </div>
    <!-- event speakers -->
    <div class="row">
      <div class="col-12">
        <h3 class="mb-4">Event Speakers</h3>
      </div>
      <!-- speakers -->
      <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
        <div class="media">
          <img class="mr-3 img-fluid" src="images/event-speakers/speaker-1.jpg" alt="speaker">
          <div class="media-body">
            <h4 class="mt-0">Jack Mastio</h4>
            Teacher
          </div>
        </div>
      </div>
      <!-- speakers -->
      <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
        <div class="media">
          <img class="mr-3 img-fluid" src="images/event-speakers/speaker-2.jpg" alt="speaker">
          <div class="media-body">
            <h4 class="mt-0">John Doe</h4>
            Teacher
          </div>
        </div>
      </div>
      <!-- speakers -->
      <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
        <div class="media">
          <img class="mr-3 img-fluid" src="images/event-speakers/speaker-3.jpg" alt="speaker">
          <div class="media-body">
            <h4 class="mt-0">Randy Luis</h4>
            Teacher
          </div>
        </div>
      </div>
      <!-- speakers -->
      <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
        <div class="media">
          <img class="mr-3 img-fluid" src="images/event-speakers/speaker-4.jpg" alt="speaker">
          <div class="media-body">
            <h4 class="mt-0">Alfred Jin</h4>
            Teacher
          </div>
        </div>
      </div>
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
  </div>
</section>
<!-- /event single -->

<!-- more event -->
<section class="section pt-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">More Events</h2>
      </div>
    </div>
    <div class="row justify-content-center">
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded-0 hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
        <div class="card-date"><span>18</span><br>December</div>
      </div>
      <div class="card-body">
        <!-- location -->
        <p><i class="ti-location-pin text-primary mr-2"></i>Harvard, Usa</p>
        <a href="event-single.php"><h4 class="card-title">Toward a public philosophy of justice</h4></a>
      </div>
    </div>
  </div>
  <!-- event -->
  <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card border-0 rounded-0 hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-0" src="images/events/event-2.jpg" alt="event thumb">
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
    <div class="card border-0 rounded-0 hover-shadow">
      <div class="card-img position-relative">
        <img class="card-img-top rounded-0" src="images/events/event-3.jpg" alt="event thumb">
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
  </div>
</section>
<!-- /more event -->

<?php 
include 'includes/footer.php'; 
?>