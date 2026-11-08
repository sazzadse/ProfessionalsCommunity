<?php 
  // Set variables specific to this page
  include 'includes/config.php';

  $news_items = [
      1 => [
          'title' => 'Elegant Light Box Paper Cut Dioramas',
          'date' => '28 August 2025',
          'author' => 'Somrat Sorkar',
          'category' => 'Creative Tech',
          'image' => 'images/news/news-1.jpg',
          'detail_image' => 'images/news/news-details-1.jpg',
      ],
      2 => [
          'title' => 'The Expenses You Are Thinking',
          'date' => '13 August 2025',
          'author' => 'Jonathon Drew',
          'category' => 'Budget & ROI',
          'image' => 'images/news/news-2.jpg',
          'detail_image' => 'images/news/news-details-2.jpg',
      ],
      3 => [
          'title' => 'Strategic Technology Trends Driving Enterprise Growth',
          'date' => '24 August 2025',
          'author' => 'Alex Pitt',
          'category' => 'Enterprise Strategy',
          'image' => 'images/news/news-3.jpg',
          'detail_image' => 'images/news/news-details-3.jpg',
      ],
      4 => [
          'title' => 'Enrolling New Members into the ITLC Network',
          'date' => '28 August 2025',
          'category' => 'Community Growth',
          'image' => 'images/news/news-4.jpg',
          'detail_image' => 'images/news/news-details-4.jpg',
      ],
      5 => [
          'title' => 'Completion of Projects Before the Deadline',
          'date' => '13 August 2025',
          'author' => 'Jonathon Drew',
          'category' => 'Delivery & Agility',
          'image' => 'images/news/news-5.jpg',
          'detail_image' => 'images/news/news-details-5.jpg',
      ],
      6 => [
          'title' => 'The Changing Scenario in Tech & Digital Ecosystem',
          'date' => '24 August 2025',
          'author' => 'Alex Pitt',
          'category' => 'Ecosystem Evolution',
          'image' => 'images/news/news-6.jpg',
          'detail_image' => 'images/news/news-details-6.jpg',
      ],
  ];

  $id = isset($_GET['id']) && isset($news_items[$_GET['id']]) ? (int)$_GET['id'] : 6;
  $current_news = $news_items[$id];

  $page_title = $current_news['title'] . " - IT Leadership Community";
  $current_page = "news";

  include 'includes/header.php';
?>

<style>
/* Modern 2026 Single Article Styling */
.itlc-article-banner {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(6, 72, 122, 0.12);
    border: 1px solid rgba(6, 72, 122, 0.08);
    background: #03233e;
    margin-bottom: 28px;
}

.itlc-article-banner img {
    width: 100%;
    max-height: 480px;
    object-fit: cover;
    display: block;
}

.itlc-article-meta-bar {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    padding: 16px 22px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    margin-bottom: 30px;
}

.itlc-author-info {
    display: flex;
    align-items: center;
}

.itlc-author-avatar-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(6, 72, 122, 0.1);
    color: #06487a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 12px;
}

.itlc-author-name {
    font-size: 14.5px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.2;
}

.itlc-author-meta {
    font-size: 12px;
    color: #64748b;
}

/* Article Typography */
.itlc-article-content {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 10px 30px rgba(6, 72, 122, 0.05);
    padding: 38px 32px;
    margin-bottom: 30px;
}

.itlc-article-lead {
    font-size: 17px;
    font-weight: 500;
    line-height: 1.8;
    color: #1e293b;
    margin-bottom: 24px;
}

.itlc-article-content p {
    font-size: 15px;
    line-height: 1.85;
    color: #475569;
    margin-bottom: 22px;
}

.itlc-article-quote {
    background: #f8fafc;
    border-left: 4px solid #f59e0b;
    border-radius: 0 10px 10px 0;
    padding: 20px 24px;
    margin: 28px 0;
    font-style: italic;
    color: #06487a;
    font-size: 16px;
    line-height: 1.7;
    position: relative;
}

.itlc-article-quote i {
    color: rgba(245, 158, 11, 0.4);
    font-size: 26px;
    margin-bottom: 8px;
    display: block;
}

.itlc-takeaways-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 22px;
    margin: 30px 0 20px;
}

.itlc-takeaways-title {
    font-size: 15px;
    font-weight: 700;
    color: #06487a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
}

.itlc-takeaways-title i {
    color: #f59e0b;
    margin-right: 8px;
}

.itlc-takeaways-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.itlc-takeaways-list li {
    font-size: 13.5px;
    color: #334155;
    line-height: 1.6;
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
}

.itlc-takeaways-list li i {
    color: #10b981;
    margin-right: 10px;
    margin-top: 3px;
    flex-shrink: 0;
}

/* Share Bar */
.itlc-share-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 22px;
    border-top: 1px solid #e2e8f0;
}

.itlc-share-buttons {
    display: flex;
    gap: 8px;
}

.itlc-share-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #ffffff;
    text-decoration: none !important;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

.itlc-share-btn:hover {
    transform: translateY(-2px);
    opacity: 0.9;
    color: #ffffff;
}

.btn-share-linkedin { background: #0077b5; }
.btn-share-twitter  { background: #1da1f2; }
.btn-share-facebook { background: #1877f2; }
.btn-share-whatsapp { background: #25d366; }

/* Sidebar Widgets */
.itlc-news-sidebar-widget {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(6, 72, 122, 0.08);
    box-shadow: 0 8px 24px rgba(6, 72, 122, 0.04);
    padding: 26px 22px;
    margin-bottom: 24px;
}

.itlc-news-sidebar-widget h5 {
    font-size: 16px;
    font-weight: 700;
    color: #06487a;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid rgba(6, 72, 122, 0.08);
    display: flex;
    align-items: center;
}

.itlc-news-sidebar-widget h5 i {
    color: #f59e0b;
    margin-right: 8px;
}

.itlc-recent-news-item {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.itlc-recent-news-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.itlc-recent-news-item:hover {
    transform: translateX(4px);
}

.itlc-recent-news-item .mini-thumb {
    width: 60px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
    margin-right: 12px;
    flex-shrink: 0;
}

.itlc-recent-news-item .item-title {
    font-size: 13px;
    font-weight: 700;
    color: #06487a;
    line-height: 1.3;
    margin-bottom: 2px;
    transition: color 0.2s ease;
}

.itlc-recent-news-item:hover .item-title {
    color: #f59e0b;
}

.itlc-recent-news-item .item-date {
    font-size: 11px;
    color: #94a3b8;
}
</style>

<!-- Modern Page Hero -->
<section class="itlc-page-hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="itlc-hero-badge"><i class="fa-solid fa-newspaper mr-1"></i> ITLC Press & Insights</div>
        <h1 class="itlc-hero-title"><?php echo htmlspecialchars($current_news['title']); ?></h1>
        <p class="itlc-hero-desc">By <?php echo htmlspecialchars($current_news['author']); ?> &bull; Published on <?php echo htmlspecialchars($current_news['date']); ?></p>
      </div>
      <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
        <a href="news.php" class="btn btn-gold-sm px-4 py-2 font-weight-bold">
          <i class="fa-solid fa-arrow-left mr-2"></i> All News
        </a>
      </div>
    </div>
  </div>
</section>

<!-- News Article Content Section -->
<section class="itlc-content-section" style="background: #f8fafc; padding: 50px 0 80px;">
  <div class="container">
    <div class="row">

      <!-- Main Column: Article Body -->
      <div class="col-lg-8 mb-5 mb-lg-0">

        <!-- Featured Banner -->
        <div class="itlc-article-banner">
          <img src="<?php echo htmlspecialchars($current_news['detail_image']); ?>" alt="<?php echo htmlspecialchars($current_news['title']); ?>" class="img-fluid">
        </div>

        <!-- Meta Bar -->
        <div class="itlc-article-meta-bar">
          <div class="itlc-author-info">
            <div class="itlc-author-avatar-icon"><i class="fa-solid fa-user-tie"></i></div>
            <div>
              <div class="itlc-author-name"><?php echo htmlspecialchars($current_news['author']); ?></div>
              <div class="itlc-author-meta">Contributing Author &bull; ITLC Insight Desk</div>
            </div>
          </div>
          <div class="d-flex align-items-center gap-3">
            <span class="badge badge-light font-weight-bold py-2 px-3 text-muted" style="border: 1px solid #e2e8f0;">
              <i class="fa-solid fa-calendar-day text-warning mr-1"></i> <?php echo htmlspecialchars($current_news['date']); ?>
            </span>
            <span class="badge badge-light font-weight-bold py-2 px-3 text-muted" style="border: 1px solid #e2e8f0;">
              <i class="fa-solid fa-clock text-warning mr-1"></i> 4 Min Read
            </span>
          </div>
        </div>

        <!-- Article Content -->
        <div class="itlc-article-content">
          <h2 class="font-weight-bold mb-4" style="font-size: 24px; color: #06487a; line-height: 1.35;">
            <?php echo htmlspecialchars($current_news['title']); ?>
          </h2>

          <p class="itlc-article-lead">
            The IT Leadership Community (ITLC) is continuously advancing leadership standards, collaborative growth, and strategic tech ecosystems across Bangladesh. This publication highlights our ongoing commitment to driving innovation, establishing industry best practices, and facilitating knowledge sharing among CIOs, CTOs, IT Directors, and senior tech executives.
          </p>

          <p>
            Technology leaders play a vital role in navigating the rapid advancements in digital transformation, cloud architecture, artificial intelligence, and cybersecurity. Through our focused workgroups, industry sessions, and executive collaborations, ITLC empowers professionals to spearhead high-impact transformations within their organizations.
          </p>

          <!-- Pull Quote -->
          <div class="itlc-article-quote">
            <i class="fa-solid fa-quote-left"></i>
            "Modern leadership is defined not merely by technical proficiency, but by the strategic capability to build resilient organizational frameworks, empower talent, and translate technological breakthroughs into measurable human progress."
          </div>

          <p>
            As technology leaders across various corporate, financial, and industrial sectors navigate increasing complexities, community-driven collaboration serves as an invaluable asset. Peer review of enterprise architecture, shared vulnerability insights, and unified advocacy for national ICT standards ensure that our technology ecosystem remains resilient against emerging global disruptions.
          </p>

          <p>
            We welcome active participation from members across sectors to contribute to our research, mentorship programs, and policy discussions. Together, we continue to shape the trajectory of information technology and digital leadership nationwide.
          </p>

          <!-- Key Takeaways Box -->
          <div class="itlc-takeaways-box">
            <div class="itlc-takeaways-title">
              <i class="fa-solid fa-list-check"></i> Key Strategic Takeaways
            </div>
            <ul class="itlc-takeaways-list">
              <li>
                <i class="fa-solid fa-circle-check"></i>
                <span><strong>Proactive Governance:</strong> Aligning IT strategies with enterprise risk management and national compliance mandates.</span>
              </li>
              <li>
                <i class="fa-solid fa-circle-check"></i>
                <span><strong>Talent Acceleration:</strong> Investing in continuous training, leadership mentorship, and technical upskilling for rising professionals.</span>
              </li>
              <li>
                <i class="fa-solid fa-circle-check"></i>
                <span><strong>Collaborative Ecosystem:</strong> Breaking down corporate silos to foster joint innovation and industry-wide knowledge exchange.</span>
              </li>
            </ul>
          </div>

          <!-- Share Bar -->
          <div class="itlc-share-bar">
            <span class="font-weight-bold text-muted small text-uppercase">
              <i class="fa-solid fa-share-nodes mr-1"></i> Share This Story
            </span>
            <div class="itlc-share-buttons">
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="itlc-share-btn btn-share-linkedin" title="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($current_news['title']); ?>&url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="itlc-share-btn btn-share-twitter" title="Share on X / Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="itlc-share-btn btn-share-facebook" title="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($current_news['title'] . ' ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="itlc-share-btn btn-share-whatsapp" title="Share on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>

        </div>

      </div>

      <!-- Right Column: Sidebar -->
      <div class="col-lg-4">

        <!-- About ITLC Press Box -->
        <div class="itlc-news-sidebar-widget" style="background: linear-gradient(135deg, #06487a 0%, #03233e 100%); color: #ffffff;">
          <span class="badge badge-warning text-dark font-weight-bold text-uppercase px-2 py-1 mb-2" style="font-size: 11px;">
            ITLC Editorial Desk
          </span>
          <h4 class="font-weight-bold text-white mb-2" style="font-size: 20px;">The Voice of Tech Leadership</h4>
          <p class="text-white-50 small mb-4">
            ITLC publishes research-backed insights, executive interviews, and technical policy reviews for CIOs and enterprise architects nationwide.
          </p>
          <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-gold-sm btn-block font-weight-bold text-center py-2 mb-2">
            <i class="fa-solid fa-id-badge mr-1"></i> Join the Community
          </a>
          <a href="contact.php" class="btn btn-outline-light btn-block font-weight-bold text-center py-2 text-white" style="font-size: 13px;">
            <i class="fa-solid fa-pen mr-1"></i> Submit Guest Editorial
          </a>
        </div>

        <!-- Recent News Stories Widget -->
        <div class="itlc-news-sidebar-widget">
          <h5><i class="fa-solid fa-newspaper"></i> More Insights & News</h5>
          <div>
            <?php foreach ($news_items as $other_id => $other_item): ?>
              <?php if ($other_id !== $id): ?>
                <a href="news-single.php?id=<?php echo $other_id; ?>" class="itlc-recent-news-item">
                  <img src="<?php echo htmlspecialchars($other_item['image']); ?>" alt="Thumb" class="mini-thumb">
                  <div>
                    <div class="item-title"><?php echo htmlspecialchars($other_item['title']); ?></div>
                    <div class="item-date"><i class="fa-solid fa-calendar-day text-warning mr-1"></i> <?php echo htmlspecialchars($other_item['date']); ?></div>
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
