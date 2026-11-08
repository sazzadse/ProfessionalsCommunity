<?php 
  // Include configuration
  include 'includes/config.php';

  $events_data = [
      6 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '12 September 2026',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-6.jpg',
          'tag' => 'Strategic Leadership',
      ],
      5 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '15 June 2026',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-5.jpg',
          'tag' => 'Governance & Policy',
      ],
      4 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '20 April 2026',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-4.jpg',
          'tag' => 'Ecosystem Roundtable',
      ],
      3 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '05 January 2026',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-3.jpg',
          'tag' => 'Annual Roadmap',
      ],
      2 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '19 October 2025',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-2.jpg',
          'tag' => 'Executive Assembly',
      ],
      1 => [
          'title' => 'Executive Committee Meeting of ITLC',
          'date' => '10 October 2025',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'time' => '07:00 PM',
          'entry_fee' => 'From: 1000 BDT',
          'image' => 'images/events/event-details-1.jpg',
          'tag' => 'Foundational Session',
      ],
  ];

  $id = isset($_GET['id']) && isset($events_data[$_GET['id']]) ? (int)$_GET['id'] : 6;
  $current_event = $events_data[$id];

  $page_title = $current_event['title'] . " - IT Leadership Community";
  $current_page = "events";

  include 'includes/header.php';
?>

<style>
/* Modern 2026 Event Details Styling */
.itlc-event-detail-banner {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(6, 72, 122, 0.12);
    border: 1px solid rgba(6, 72, 122, 0.08);
    background: #03233e;
    margin-bottom: 30px;
}

.itlc-event-detail-banner img {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    display: block;
}

/* Event Info Quick Tiles */
.itlc-event-info-tile {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 6px 20px rgba(6, 72, 122, 0.04);
    padding: 18px 16px;
    display: flex;
    align-items: center;
    height: 100%;
    transition: all 0.25s ease;
}

.itlc-event-info-tile:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(6, 72, 122, 0.1);
    border-color: rgba(245, 158, 11, 0.4);
}

.itlc-event-info-tile .tile-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: rgba(6, 72, 122, 0.08);
    color: #06487a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 14px;
    flex-shrink: 0;
}

.itlc-event-info-tile:hover .tile-icon {
    background: #f59e0b;
    color: #03233e;
}

.itlc-event-info-tile .tile-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #94a3b8;
    margin-bottom: 2px;
}

.itlc-event-info-tile .tile-value {
    font-size: 13.5px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.25;
}

/* Strategic Focus Cards */
.itlc-focus-item {
    background: #ffffff;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    padding: 16px 18px;
    margin-bottom: 14px;
    display: flex;
    align-items: flex-start;
    transition: all 0.25s ease;
}

.itlc-focus-item:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
    transform: translateX(4px);
}

.itlc-focus-item .focus-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(245, 158, 11, 0.15);
    color: #b45309;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    margin-right: 14px;
    flex-shrink: 0;
    margin-top: 2px;
}

.itlc-focus-item .focus-title {
    font-size: 14.5px;
    font-weight: 700;
    color: #06487a;
    margin-bottom: 3px;
}

.itlc-focus-item .focus-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.55;
    margin-bottom: 0;
}

/* Sidebar Widgets */
.itlc-event-sidebar-widget {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 8px 24px rgba(6, 72, 122, 0.04);
    padding: 26px 22px;
    margin-bottom: 24px;
}

.itlc-event-sidebar-widget h5 {
    font-size: 16px;
    font-weight: 700;
    color: #06487a;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid rgba(6, 72, 122, 0.08);
    display: flex;
    align-items: center;
}

.itlc-event-sidebar-widget h5 i {
    color: #f59e0b;
    margin-right: 8px;
}

.itlc-other-event-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.itlc-other-event-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.itlc-other-event-item:hover {
    transform: translateX(4px);
}

.itlc-other-event-item .mini-thumb {
    width: 60px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
    margin-right: 12px;
    flex-shrink: 0;
}

.itlc-other-event-item .item-title {
    font-size: 13px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.3;
    margin-bottom: 2px;
    transition: color 0.2s ease;
}

.itlc-other-event-item:hover .item-title {
    color: #f59e0b;
}

.itlc-other-event-item .item-date {
    font-size: 11px;
    color: #94a3b8;
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-calendar-check mr-1"></i> Executive Event Details</div>
        <h1 class="itlc-hero-title"><?php echo htmlspecialchars($current_event['title']); ?></h1>
        <p class="itlc-hero-desc">Organized by the IT Leadership Community (ITLC) &bull; <?php echo htmlspecialchars($current_event['date']); ?></p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="events.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-arrow-left mr-2"></i> All Events
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Event Single Content Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">
    <div class="row">

      <!-- Main Column: Event Details -->
      <div class="col-lg-8 mb-5 mb-lg-0">

        <!-- Banner Image -->
        <div class="itlc-event-detail-banner">
          <img src="<?php echo htmlspecialchars($current_event['image']); ?>" alt="<?php echo htmlspecialchars($current_event['title']); ?>" class="img-fluid">
        </div>

        <!-- 4 Highlights Tiles -->
        <div class="row mb-4">
          <div class="col-sm-6 col-md-3 mb-3">
            <div class="itlc-event-info-tile">
              <div class="tile-icon"><i class="fa-solid fa-location-dot"></i></div>
              <div>
                <div class="tile-label">Location</div>
                <div class="tile-value"><?php echo htmlspecialchars($current_event['location']); ?></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-3">
            <div class="itlc-event-info-tile">
              <div class="tile-icon"><i class="fa-solid fa-calendar-day"></i></div>
              <div>
                <div class="tile-label">Date</div>
                <div class="tile-value"><?php echo htmlspecialchars($current_event['date']); ?></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-3">
            <div class="itlc-event-info-tile">
              <div class="tile-icon"><i class="fa-solid fa-clock"></i></div>
              <div>
                <div class="tile-label">Time</div>
                <div class="tile-value"><?php echo htmlspecialchars($current_event['time']); ?></div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-3">
            <div class="itlc-event-info-tile">
              <div class="tile-icon"><i class="fa-solid fa-ticket"></i></div>
              <div>
                <div class="tile-label">Entry Fee</div>
                <div class="tile-value"><?php echo htmlspecialchars($current_event['entry_fee']); ?></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Event Overview & Strategic Focus -->
        <div class="itlc-card p-4 p-md-5 mb-4" style="background: #ffffff; border-radius: 14px; border: 1px solid rgba(6, 72, 122, 0.08); box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);">
          <h3 class="font-weight-bold mb-3" style="color: #06487a; font-size: 22px;">
            Event Overview & Strategic Outcomes
          </h3>
          <p class="text-muted" style="font-size: 15px; line-height: 1.85;">
            The executive committee meeting resulted in the strategic formation and review of dedicated sub-committees committed to advancing technology governance, professional leadership, and institutional collaboration across Bangladesh's IT landscape.
          </p>

          <hr style="border-top: 1px solid #e2e8f0; margin: 24px 0;">

          <h5 class="font-weight-bold mb-3" style="color: #06487a; font-size: 17px;">
            Key Focus Areas & Strategic Pillars
          </h5>

          <!-- Focus Area 1 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-landmark"></i></div>
            <div>
              <div class="focus-title">Governance Framework (#Governance_Framework)</div>
              <div class="focus-desc">Establishing robust governance guidelines to steward technology-driven initiatives, standards enforcement, and national ICT policies.</div>
            </div>
          </div>

          <!-- Focus Area 2 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
              <div class="focus-title">Technical Training and Development (#Technical_Training_and_Development)</div>
              <div class="focus-desc">Upskilling current and upcoming technology leaders in emerging AI architectures, cloud resilience, cybersecurity, and enterprise engineering.</div>
            </div>
          </div>

          <!-- Focus Area 3 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-briefcase"></i></div>
            <div>
              <div class="focus-title">Tech Job Placement (#Tech_Job_Placement)</div>
              <div class="focus-desc">Connecting senior professionals, specialized engineers, and digital innovators with leading enterprise opportunities and career pathways.</div>
            </div>
          </div>

          <!-- Focus Area 4 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-microphone-lines"></i></div>
            <div>
              <div class="focus-title">Technology Event Management (#Technology_Event_Management)</div>
              <div class="focus-desc">Curating world-class conferences, roundtables, and innovation showcases to facilitate premier knowledge exchange and executive networking.</div>
            </div>
          </div>

          <!-- Focus Area 5 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-handshake-angle"></i></div>
            <div>
              <div class="focus-title">Public Relations and Collaborations (#Public_Relations_and_Collaborations)</div>
              <div class="focus-desc">Strengthening strategic alliances with academia, technology industry leaders, enterprise partners, and governmental stakeholders.</div>
            </div>
          </div>

          <!-- Focus Area 6 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-earth-americas"></i></div>
            <div>
              <div class="focus-title">Foreign Affairs (#Foreign_Affairs)</div>
              <div class="focus-desc">Bridging Bangladesh's technology leadership with global innovation ecosystems, diaspora leaders, and international technology councils.</div>
            </div>
          </div>

          <!-- Focus Area 7 -->
          <div class="itlc-focus-item">
            <div class="focus-icon"><i class="fa-solid fa-scale-balanced"></i></div>
            <div>
              <div class="focus-title">Fund Management (#Fund_Management)</div>
              <div class="focus-desc">Maintaining complete fiscal transparency, audited procedures, and purposeful utilization of community funds for high-impact initiatives.</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Right Column: Sidebar -->
      <div class="col-lg-4">

        <!-- Quick Action / Reservation Box -->
        <div class="itlc-event-sidebar-widget" style="background: linear-gradient(135deg, #06487a 0%, #03233e 100%); color: #ffffff;">
          <span class="badge badge-warning text-dark font-weight-bold text-uppercase px-2 py-1 mb-2" style="font-size: 11px;">
            Executive Session
          </span>
          <h4 class="font-weight-bold text-white mb-2" style="font-size: 20px;">Participate in this Event</h4>
          <p class="text-white-50 small mb-4">
            Seats are limited for executive committee assemblies. Please reach out to the communication desk to confirm attendance or submit agenda notes.
          </p>
          <a href="contact.php" class="btn btn-gold-sm btn-block font-weight-bold text-center py-2 mb-2">
            <i class="fa-solid fa-envelope mr-1"></i> Inquire with Desk
          </a>
          <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-outline-light btn-block font-weight-bold text-center py-2 text-white" style="font-size: 13px;">
            <i class="fa-solid fa-id-badge mr-1"></i> Apply for ITLC Membership
          </a>
        </div>

        <!-- Event Host Widget -->
        <div class="itlc-event-sidebar-widget">
          <h5><i class="fa-solid fa-users-gear"></i> Event Organizer</h5>
          <div class="d-flex align-items-center mb-3">
            <img src="images/logo/logo.png" alt="ITLC Logo" style="height: 48px; width: auto;" class="mr-3">
            <div>
              <h6 class="font-weight-bold mb-0" style="color: #06487a; font-size: 14px;">IT Leadership Community</h6>
              <span class="text-muted small">Executive Secretariat</span>
            </div>
          </div>
          <p class="text-muted small mb-3">
            Dhaka, Bangladesh &bull; Advancing the voice of CIOs, CTOs, and IT directors across the nation.
          </p>
          <div class="small font-weight-bold" style="color: #06487a;">
            <i class="fa-solid fa-phone text-warning mr-2"></i> +8801710817997
          </div>
        </div>

        <!-- Other Events -->
        <div class="itlc-event-sidebar-widget">
          <h5><i class="fa-solid fa-calendar-days"></i> Other Assemblies</h5>
          <div>
            <?php foreach ($events_data as $other_id => $other_ev): ?>
              <?php if ($other_id !== $id): ?>
                <a href="event-single.php?id=<?php echo $other_id; ?>" class="itlc-other-event-item">
                  <img src="<?php echo htmlspecialchars($other_ev['image']); ?>" alt="Thumb" class="mini-thumb">
                  <div>
                    <div class="item-title"><?php echo htmlspecialchars($other_ev['title']); ?></div>
                    <div class="item-date"><i class="fa-solid fa-clock text-warning mr-1"></i> <?php echo htmlspecialchars($other_ev['date']); ?></div>
                  </div>
                </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<?php 
include 'includes/footer.php'; 
?>
