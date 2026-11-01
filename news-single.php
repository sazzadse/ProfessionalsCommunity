<?php 
  // Set variables specific to this page
  include 'includes/config.php';

  $news_items = [
      1 => [
          'title' => 'Elegant Light Box Paper Cut Dioramas',
          'date' => '28 August 2025',
          'author' => 'Somrat Sorkar',
          'image' => 'images/news/news-1.jpg',
          'detail_image' => 'images/news/news-details-1.jpg',
      ],
      2 => [
          'title' => 'The Expenses You Are Thinking',
          'date' => '13 August 2025',
          'author' => 'Jonathon Drew',
          'image' => 'images/news/news-2.jpg',
          'detail_image' => 'images/news/news-details-2.jpg',
      ],
      3 => [
          'title' => 'Strategic Technology Trends Driving Enterprise Growth',
          'date' => '24 August 2025',
          'author' => 'Alex Pitt',
          'image' => 'images/news/news-3.jpg',
          'detail_image' => 'images/news/news-details-3.jpg',
      ],
      4 => [
          'title' => 'Enrolling New Members into the ITLC Network',
          'date' => '28 August 2025',
          'author' => 'Somrat Sorkar',
          'image' => 'images/news/news-4.jpg',
          'detail_image' => 'images/news/news-details-4.jpg',
      ],
      5 => [
          'title' => 'Completion of Projects Before the Deadline',
          'date' => '13 August 2025',
          'author' => 'Jonathon Drew',
          'image' => 'images/news/news-5.jpg',
          'detail_image' => 'images/news/news-details-5.jpg',
      ],
      6 => [
          'title' => 'The Changing Scenario in Tech & Digital Ecosystem',
          'date' => '24 August 2025',
          'author' => 'Alex Pitt',
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

    .itlc-about .news-breadcrumb-link {
        color: #ffbc3b;
        text-decoration: none !important;
        cursor: pointer;
    }

    .itlc-about .news-breadcrumb-link:hover,
    .itlc-about .news-breadcrumb-link:focus,
    .itlc-about .news-breadcrumb-link:active {
        color: #ffbc3b !important;
        text-decoration: none !important;
    }

    .itlc-about .news-breadcrumb-separator {
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

    .itlc-about .news-content p {
        font-size: 15px;
        line-height: 1.9;
        margin-bottom: 20px;
    }

    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 20px;
        }

        .itlc-about .news-breadcrumb-separator {
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
          <a href="news.php" class="news-breadcrumb-link">News</a>
          <span class="news-breadcrumb-separator">&gt;</span>
          <span style="color: #06487a; font-size: 20px;"><?php echo htmlspecialchars($current_news['title']); ?></span>
        </h1>
        <div class="title-accent"></div>
      </div>
    </div>

    <!-- News Single Content -->
    <div class="row">
      <!-- news image -->
      <div class="col-12 mb-4">
        <img src="<?php echo htmlspecialchars($current_news['detail_image']); ?>" alt="news banner" class="img-fluid w-100 rounded">
      </div>

      <!-- meta info without ss icons -->
      <div class="col-12 mb-3">
        <ul class="list-inline mb-0">
          <li class="list-inline-item mr-4" style="color: #06487a; font-size: 14px;">
            <i class="ti-user text-primary mr-2"></i><span class="font-weight-bold">By:</span> <?php echo htmlspecialchars($current_news['author']); ?>
          </li>
          <li class="list-inline-item mr-4" style="color: #06487a; font-size: 14px;">
            <i class="ti-calendar text-primary mr-2"></i><?php echo htmlspecialchars($current_news['date']); ?>
          </li>
        </ul>
      </div>

      <!-- border -->
      <div class="col-12 mb-4">
        <div class="border-bottom border-primary"></div>
      </div>

      <!-- news article body -->
      <div class="col-12 news-content">
        <h2 class="mb-4" style="font-size: 24px; color: #06487a; font-weight: 700;"><?php echo htmlspecialchars($current_news['title']); ?></h2>
        <p>
          The IT Leadership Community (ITLC) is continuously advancing leadership standards, collaborative growth, and strategic tech ecosystems across Bangladesh. This initiative highlights our ongoing commitment to driving innovation, establishing industry best practices, and facilitating knowledge sharing among CIOs, CTOs, IT Directors, and senior tech executives.
        </p>
        <p>
          Technology leaders play a vital role in navigating the rapid advancements in digital transformation, cloud architecture, artificial intelligence, and cybersecurity. Through our focused workgroups, industry sessions, and executive collaborations, ITLC empowers professionals to spearhead high-impact transformations within their organizations.
        </p>
        <p class="mb-0">
          We welcome active participation from members across sectors to contribute to our research, mentorship programs, and policy discussions. Together, we continue to shape the trajectory of information technology and digital leadership nationwide.
        </p>
      </div>

    </div>
  </div>
</section>
<!-- /itlc-about -->

<?php 
include 'includes/footer.php'; 
?>
