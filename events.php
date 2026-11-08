<?php 
  $page_title = "Upcoming Events - IT Leadership Community";
  $current_page = "events";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';

  $events_list = [
      [
          'id'       => 6,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '12',
          'month'    => 'September',
          'year'     => '2026',
          'date_str' => '12 September 2026',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Strategic Leadership',
          'image'    => 'images/events/event-6.jpg',
          'desc'     => 'Quarterly executive committee convening on technological governance, technical training frameworks, and ecosystem policy roadmap.'
      ],
      [
          'id'       => 5,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '15',
          'month'    => 'June',
          'year'     => '2026',
          'date_str' => '15 June 2026',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Governance & Policy',
          'image'    => 'images/events/event-5.jpg',
          'desc'     => 'Strategic deliberations on national tech job placement, academic-industry collaborations, and international partnership pipelines.'
      ],
      [
          'id'       => 4,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '20',
          'month'    => 'April',
          'year'     => '2026',
          'date_str' => '20 April 2026',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Ecosystem Roundtable',
          'image'    => 'images/events/event-4.jpg',
          'desc'     => 'High-impact discussions focusing on digital transformation benchmarks, fund management transparency, and enterprise innovation.'
      ],
      [
          'id'       => 3,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '05',
          'month'    => 'January',
          'year'     => '2026',
          'date_str' => '05 January 2026',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Annual Roadmap',
          'image'    => 'images/events/event-3.jpg',
          'desc'     => 'Annual strategic kickoff mapping ITLC member initiatives, professional certifications, and corporate technology showcases.'
      ],
      [
          'id'       => 2,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '19',
          'month'    => 'October',
          'year'     => '2025',
          'date_str' => '19 October 2025',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Executive Assembly',
          'image'    => 'images/events/event-2.jpg',
          'desc'     => 'Deliberating sub-committee progress on foreign affairs, tech innovation labs, and specialized community workshops.'
      ],
      [
          'id'       => 1,
          'title'    => 'Executive Committee Meeting of ITLC',
          'day'      => '10',
          'month'    => 'October',
          'year'     => '2025',
          'date_str' => '10 October 2025',
          'time'     => '07:00 PM',
          'location' => 'Pan Pacific Sonargaon, Dhaka',
          'tag'      => 'Foundational Session',
          'image'    => 'images/events/event-1.jpg',
          'desc'     => 'Foundational assembly chartering ITLC goals, leadership governance structures, and technology leader empowerment.'
      ],
  ];
?>

<style>
/* Modern 2026 Event Card System */
.itlc-event-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.itlc-event-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(6, 72, 122, 0.14);
    border-color: rgba(6, 72, 122, 0.18);
}

.itlc-event-thumb-wrap {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: #03233e;
}

.itlc-event-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.itlc-event-card:hover .itlc-event-thumb-wrap img {
    transform: scale(1.08);
}

.itlc-event-tag {
    position: absolute;
    top: 14px;
    right: 14px;
    background: rgba(3, 35, 62, 0.85);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    color: #ffbc3b;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 5px 12px;
    border-radius: 20px;
    border: 1px solid rgba(255, 188, 59, 0.3);
    z-index: 2;
}

.itlc-event-date-badge {
    position: absolute;
    bottom: 14px;
    left: 14px;
    background: #ffffff;
    border-radius: 10px;
    padding: 8px 14px;
    text-align: center;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    line-height: 1.1;
    z-index: 2;
    border-left: 3px solid #ffbc3b;
}

.itlc-event-date-badge .day {
    display: block;
    font-size: 20px;
    font-weight: 800;
    color: #06487a;
}

.itlc-event-date-badge .month-year {
    display: block;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    margin-top: 2px;
}

.itlc-event-content {
    padding: 24px 22px 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.itlc-event-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    font-size: 12.5px;
    color: #64748b;
    margin-bottom: 12px;
}

.itlc-event-meta span {
    display: inline-flex;
    align-items: center;
}

.itlc-event-meta i {
    color: #f59e0b;
    margin-right: 6px;
}

.itlc-event-title {
    font-size: 18px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.35;
    margin-bottom: 10px;
    transition: color 0.2s ease;
}

.itlc-event-card:hover .itlc-event-title,
.itlc-event-title:hover {
    color: #f59e0b;
}

.itlc-event-desc {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 18px;
    flex-grow: 1;
}

.itlc-event-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}

.itlc-event-action-btn {
    font-size: 13px;
    font-weight: 700;
    color: #06487a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.itlc-event-action-btn i {
    margin-left: 6px;
    transition: transform 0.2s ease;
}

.itlc-event-card:hover .itlc-event-action-btn {
    color: #f59e0b;
}

.itlc-event-card:hover .itlc-event-action-btn i {
    transform: translateX(4px);
}

/* Event Stats Counter Bar */
.itlc-event-stats-bar {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 8px 24px rgba(6, 72, 122, 0.04);
    padding: 20px 30px;
    margin-bottom: 40px;
}

.itlc-event-stat-item {
    display: flex;
    align-items: center;
}

.itlc-event-stat-item .icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(6, 72, 122, 0.08);
    color: #06487a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-right: 14px;
}

.itlc-event-stat-item .stat-num {
    font-size: 20px;
    font-weight: 800;
    color: #06487a;
    line-height: 1.1;
}

.itlc-event-stat-item .stat-label {
    font-size: 12px;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-calendar-days mr-1"></i> Community Gatherings</div>
        <h1 class="itlc-hero-title">Conferences & <span>Upcoming Events</span></h1>
        <p class="itlc-hero-desc">Explore flagship conferences, strategic roundtables, and leadership workshops organized by the IT Leadership Community (ITLC) to empower technology executives across Bangladesh.</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="about.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-circle-info mr-2"></i> About ITLC
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Events Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">

    <!-- Event Metrics Bar -->
    <div class="itlc-event-stats-bar">
      <div class="row">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="itlc-event-stat-item">
            <div class="icon-circle"><i class="fa-solid fa-chess-knight"></i></div>
            <div>
              <div class="stat-num">6+ Assemblies</div>
              <div class="stat-label">Executive Committee Meetings</div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="itlc-event-stat-item">
            <div class="icon-circle"><i class="fa-solid fa-users"></i></div>
            <div>
              <div class="stat-num">500+ Leaders</div>
              <div class="stat-label">Engaged Nationwide</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="itlc-event-stat-item">
            <div class="icon-circle"><i class="fa-solid fa-hotel"></i></div>
            <div>
              <div class="stat-num">Pan Pacific Sonargaon</div>
              <div class="stat-label">Premier Venue Partner</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Events Grid -->
    <div class="row">
      <?php foreach ($events_list as $ev): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="itlc-event-card">
            
            <!-- Thumbnail & Badges -->
            <div class="itlc-event-thumb-wrap">
              <img src="<?php echo htmlspecialchars($ev['image']); ?>" alt="<?php echo htmlspecialchars($ev['title']); ?>" loading="lazy">
              <span class="itlc-event-tag"><?php echo htmlspecialchars($ev['tag']); ?></span>
              <div class="itlc-event-date-badge">
                <span class="day"><?php echo htmlspecialchars($ev['day']); ?></span>
                <span class="month-year"><?php echo htmlspecialchars($ev['month'] . ' ' . $ev['year']); ?></span>
              </div>
            </div>

            <!-- Content -->
            <div class="itlc-event-content">
              <div class="itlc-event-meta">
                <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($ev['location']); ?></span>
                <span><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($ev['time']); ?></span>
              </div>

              <a href="event-single.php?id=<?php echo $ev['id']; ?>" class="text-decoration-none">
                <h4 class="itlc-event-title"><?php echo htmlspecialchars($ev['title']); ?></h4>
              </a>

              <p class="itlc-event-desc"><?php echo htmlspecialchars($ev['desc']); ?></p>

              <div class="itlc-event-footer">
                <span class="badge badge-light text-muted font-weight-normal py-1 px-2" style="font-size: 11.5px;">
                  <i class="fa-solid fa-ticket-simple text-warning mr-1"></i> From 1000 BDT
                </span>
                <a href="event-single.php?id=<?php echo $ev['id']; ?>" class="itlc-event-action-btn">
                  View Details <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Host or Propose an Event Banner -->
    <div class="mt-5 p-4 p-md-5 rounded-lg text-white d-flex flex-column flex-md-row align-items-center justify-content-between" 
         style="background: linear-gradient(135deg, #06487a 0%, #03233e 100%); border-radius: 14px; box-shadow: 0 10px 30px rgba(6, 72, 122, 0.15);">
      <div class="mb-3 mb-md-0 text-center text-md-left">
        <h3 class="font-weight-bold text-white mb-2" style="font-size: 22px;">Propose a Keynote or Host an ITLC Session</h3>
        <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 600px;">
          Have insights on emerging AI governance, enterprise cloud modernization, or cybersecurity protocols? Collaborate with our event committee.
        </p>
      </div>
      <div>
        <a href="contact.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold text-nowrap">
          <i class="fa-solid fa-paper-plane mr-2"></i> Contact Committee
        </a>
      </div>
    </div>

  </div>
</section>

<?php 
include 'includes/footer.php'; 
?>
