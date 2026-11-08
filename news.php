<?php 
  $page_title = "News & Press - IT Leadership Community";
  $current_page = "news";

  // Include configuration
  include 'includes/config.php';
  include 'includes/header.php';

  $news_list = [
      [
          'id'       => 6,
          'title'    => 'The Changing Scenario in Tech & Digital Ecosystem',
          'author'   => 'Alex Pitt',
          'date'     => '24 August 2025',
          'category' => 'Ecosystem Evolution',
          'image'    => 'images/news/news-6.jpg',
          'excerpt'  => 'An in-depth analysis of Bangladesh\'s shifting digital landscape, cloud native adoptions, and how CIOs are responding to rapid AI transformation.'
      ],
      [
          'id'       => 5,
          'title'    => 'Completion of Projects Before the Deadline',
          'author'   => 'Jonathon Drew',
          'date'     => '13 August 2025',
          'category' => 'Delivery & Agility',
          'image'    => 'images/news/news-5.jpg',
          'excerpt'  => 'Best practices for agile execution, resource alignment, and eliminating technical bottlenecks in high-stakes enterprise IT delivery.'
      ],
      [
          'id'       => 4,
          'title'    => 'Enrolling New Members into the ITLC Network',
          'author'   => 'Somrat Sorkar',
          'date'     => '28 August 2025',
          'category' => 'Community Growth',
          'image'    => 'images/news/news-4.jpg',
          'excerpt'  => 'ITLC welcomes senior executives, technology architects, and IT managers into our rapidly expanding professional network nationwide.'
      ],
      [
          'id'       => 3,
          'title'    => 'Strategic Technology Trends Driving Enterprise Growth',
          'author'   => 'Alex Pitt',
          'date'     => '24 August 2025',
          'category' => 'Enterprise Strategy',
          'image'    => 'images/news/news-3.jpg',
          'excerpt'  => 'Key strategic priorities shaping modern CIO agendas: data governance, automated cybersecurity, and scalable infrastructure investments.'
      ],
      [
          'id'       => 2,
          'title'    => 'The Expenses You Are Thinking',
          'author'   => 'Jonathon Drew',
          'date'     => '13 August 2025',
          'category' => 'Budget & ROI',
          'image'    => 'images/news/news-2.jpg',
          'excerpt'  => 'Optimizing corporate IT expenditures while maximizing operational ROI through smart cloud procurement and licensing rationalization.'
      ],
      [
          'id'       => 1,
          'title'    => 'Elegant Light Box Paper Cut Dioramas',
          'author'   => 'Somrat Sorkar',
          'date'     => '28 August 2025',
          'category' => 'Creative Tech',
          'image'    => 'images/news/news-1.jpg',
          'excerpt'  => 'Exploring the intersection of modern digital fabrication, lighting aesthetics, and precision creative technology in contemporary design.'
      ],
  ];
?>

<style>
/* Modern 2026 News Card System */
.itlc-news-card {
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

.itlc-news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(6, 72, 122, 0.14);
    border-color: rgba(6, 72, 122, 0.18);
}

.itlc-news-thumb-wrap {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: #03233e;
}

.itlc-news-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.itlc-news-card:hover .itlc-news-thumb-wrap img {
    transform: scale(1.08);
}

.itlc-news-category-badge {
    position: absolute;
    top: 14px;
    left: 14px;
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

.itlc-news-body {
    padding: 24px 22px 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.itlc-news-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 12.5px;
    color: #64748b;
    margin-bottom: 12px;
}

.itlc-news-meta span {
    display: inline-flex;
    align-items: center;
}

.itlc-news-meta i {
    color: #f59e0b;
    margin-right: 6px;
}

.itlc-news-title {
    font-size: 18px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.4;
    margin-bottom: 12px;
    transition: color 0.2s ease;
}

.itlc-news-card:hover .itlc-news-title,
.itlc-news-title:hover {
    color: #f59e0b;
}

.itlc-news-excerpt {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

.itlc-news-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}

.itlc-news-link {
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

.itlc-news-link i {
    margin-left: 6px;
    transition: transform 0.2s ease;
}

.itlc-news-card:hover .itlc-news-link {
    color: #f59e0b;
}

.itlc-news-card:hover .itlc-news-link i {
    transform: translateX(4px);
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-newspaper mr-1"></i> Press & Insights</div>
        <h1 class="itlc-hero-title">Latest News & <span>Industry Insights</span></h1>
        <p class="itlc-hero-desc">Explore official announcements, technology leadership perspectives, ecosystem updates, and press releases from the IT Leadership Community (ITLC).</p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="contact.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-pen-nib mr-2"></i> Submit an Article
        </a>
      </div>
    </div>
  </div>
</section>

<!-- News Archive Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">

    <!-- News Grid (Descending Order: 6 to 1) -->
    <div class="row">
      <?php foreach ($news_list as $news): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="itlc-news-card">
            
            <!-- Thumbnail & Category Badge -->
            <div class="itlc-news-thumb-wrap">
              <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" loading="lazy">
              <span class="itlc-news-category-badge"><?php echo htmlspecialchars($news['category']); ?></span>
            </div>

            <!-- Content -->
            <div class="itlc-news-body">
              <div class="itlc-news-meta">
                <span><i class="fa-solid fa-user-pen"></i> By <?php echo htmlspecialchars($news['author']); ?></span>
                <span><i class="fa-solid fa-calendar-day"></i> <?php echo htmlspecialchars($news['date']); ?></span>
              </div>

              <a href="news-single.php?id=<?php echo $news['id']; ?>" class="text-decoration-none">
                <h4 class="itlc-news-title"><?php echo htmlspecialchars($news['title']); ?></h4>
              </a>

              <p class="itlc-news-excerpt"><?php echo htmlspecialchars($news['excerpt']); ?></p>

              <div class="itlc-news-footer">
                <span class="badge badge-light text-muted font-weight-normal py-1 px-2" style="font-size: 11.5px;">
                  <i class="fa-solid fa-book-open text-warning mr-1"></i> 3 min read
                </span>
                <a href="news-single.php?id=<?php echo $news['id']; ?>" class="itlc-news-link">
                  Read Full Story <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Editorial Callout Card -->
    <div class="mt-5 p-4 p-md-5 rounded-lg text-white d-flex flex-column flex-md-row align-items-center justify-content-between" 
         style="background: linear-gradient(135deg, #06487a 0%, #03233e 100%); border-radius: 14px; box-shadow: 0 10px 30px rgba(6, 72, 122, 0.15);">
      <div class="mb-3 mb-md-0 text-center text-md-left">
        <h3 class="font-weight-bold text-white mb-2" style="font-size: 22px;">Have a Story or Tech Whitepaper to Share?</h3>
        <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 600px;">
          ITLC members with approved blogging permissions can publish case studies, architectural blueprints, and leadership thought pieces.
        </p>
      </div>
      <div>
        <a href="edit-profile.php?tab=others" class="btn btn-gold-sm px-4 py-2 font-weight-bold text-nowrap">
          <i class="fa-solid fa-key mr-2"></i> Request Blog Access
        </a>
      </div>
    </div>

  </div>
</section>

<?php 
include 'includes/footer.php'; 
?>
