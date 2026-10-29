<?php 
  $page_title = "Our Members - IT Leadership Community";
  $current_page = "member";

  // Include configuration and header
  include 'includes/config.php';
  include 'includes/header.php';

  // Get search filters
  $search_query = trim($_GET['search'] ?? '');

  // Pagination configuration (9 members per page = 3 full rows)
  $limit = 9;
  $page  = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
  $offset = ($page - 1) * $limit;

  // Build SQL conditions - FIXED: More lenient conditions for manual entries
  $where_clauses = ["(u.is_profile_public = 1 OR u.is_profile_public IS NULL OR u.is_profile_public = 0)"]; // Include all members
  $params = [];
  $types  = "";

  if (!empty($search_query)) {
      $where_clauses[] = "(u.full_name LIKE ? OR u.company LIKE ? OR u.position LIKE ? OR u.biography LIKE ? OR u.membership_id LIKE ? OR u.highest_education LIKE ? OR u.certification LIKE ?)";
      $term = "%" . $search_query . "%";
      $params[] = $term;
      $params[] = $term;
      $params[] = $term;
      $params[] = $term;
      $params[] = $term;
      $params[] = $term;
      $params[] = $term;
      $types .= "sssssss";
  }

  $where_sql = implode(" AND ", $where_clauses);

  // Count total matching records for pagination
  $count_sql = "SELECT COUNT(*) as total FROM `user` u WHERE $where_sql";
  $stmt_count = $conn->prepare($count_sql);
  if (!empty($types)) {
      $stmt_count->bind_param($types, ...$params);
  }
  $stmt_count->execute();
  $result = $stmt_count->get_result();
  $total_members = $result->fetch_assoc()['total'] ?? 0;
  $stmt_count->close();

  $total_pages = ceil($total_members / $limit);

  // Fetch paginated member records
  $sql = "SELECT u.*, p.profession_name, c.country_name, mt.membership_name 
          FROM `user` u 
          LEFT JOIN `profession` p ON u.profession_id = p.id 
          LEFT JOIN `country` c ON u.country_id = c.id 
          LEFT JOIN `membership_type` mt ON u.membership_type_id = mt.id 
          WHERE $where_sql 
          ORDER BY u.id ASC 
          LIMIT ? OFFSET ?";

  $params[] = $limit;
  $params[] = $offset;
  $types   .= "ii";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param($types, ...$params);
  $stmt->execute();
  $members_res = $stmt->get_result();
  $members = [];
  while ($r = $members_res->fetch_assoc()) {
      $members[] = $r;
  }
  $stmt->close();

  // Debug: Uncomment to see what's being fetched
  // echo "<!-- Total members: " . $total_members . " | Fetched: " . count($members) . " -->";

  // Build query parameters for pagination links
  $query_params = [];
  if (!empty($search_query)) {
      $query_params[] = 'search=' . urlencode($search_query);
  }
  
  $query_string = !empty($query_params) ? '&' . implode('&', $query_params) : '';

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

    /* Search bar height & typography */
    .member-search-input { 
        height: 40px; 
        font-size: 14px;
    }

    /* Pagination color override to site primary dark blue */
    .pagination .page-link { 
        color: #06487a; 
    }
    .pagination .page-item.active .page-link { 
        background-color: #06487a; 
        border-color: #06487a; 
        color: #fff; 
    }
    .pagination .page-item .page-link:hover { 
        background-color: #06487a; 
        color: #fff; 
        border-color: #06487a; 
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
        <h1 class="main-title">Our Members</h1>
        <div class="title-accent"></div>
        <p class="mb-4">
          Connecting senior IT leaders, executives, and technology professionals across Bangladesh.
          Empowering leadership development, industry standards, and strategic digital transformation.
        </p>
      </div>
    </div>

    <!-- Search Section -->
    <div class="row mb-4 justify-content-center">
      <div class="col-lg-8 col-md-10 col-12">
        <form action="member.php" method="GET">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-white border-right-0"><i class="ti-search text-color"></i></span>
            </div>
            <input type="text" name="search" class="form-control member-search-input border-left-0 pl-2" placeholder="Search by Name, Company, Position, ID or Certification..." value="<?php echo htmlspecialchars($search_query); ?>">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary member-search-input px-4">
                <i class="ti-search mr-1"></i> Search
              </button>
              <?php if (!empty($search_query)): ?>
                <a href="member.php" class="btn btn-secondary member-search-input px-3" title="Reset Search">
                  <i class="ti-reload"></i>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Active Filter Badge / Result Counter -->
    <div class="row mb-4 align-items-center">
      <div class="col-md-6">
        <h6 class="font-weight-normal text-secondary m-0">
          Showing <span class="font-weight-bold text-dark"><?php echo count($members); ?></span> of <span class="font-weight-bold text-dark"><?php echo $total_members; ?></span> Members
          <?php if (!empty($search_query)): ?>
            matching "<span style="color:#06487a; font-weight:600;"><?php echo htmlspecialchars($search_query); ?></span>"
          <?php endif; ?>
        </h6>
      </div>
    </div>

    <?php if (empty($members)): ?>
      <div class="text-center py-5">
        <i class="ti-user text-muted" style="font-size: 60px;"></i>
        <h5 class="mt-3 text-muted">No members found matching your search.</h5>
        <p class="text-color">Try searching with a different name, company, or profession.</p>
        <a href="member.php" class="btn btn-primary-outline mt-2">View All Members</a>
        <!-- Debug info - remove in production -->
        <?php if (isset($_GET['debug'])): ?>
          <div class="mt-4 text-left">
            <h6>Debug Info:</h6>
            <p>Total Members: <?php echo $total_members; ?></p>
            <p>SQL: <?php echo htmlspecialchars($sql); ?></p>
            <p>Where clause: <?php echo htmlspecialchars($where_sql); ?></p>
          </div>
        <?php endif; ?>
      </div>
    <?php else: ?>
      <!-- Members Grid: 3 Profiles per Row (col-lg-4) -->
      <div class="row">
        <?php foreach ($members as $m): ?>
          <?php 
            // FIXED: Better profile image handling
            $img_src = 'images/users/default-avatar.jpg'; // default fallback
            
            if (!empty($m['image'])) {
                // Check in users folder
                if (file_exists(__DIR__ . '/images/users/' . $m['image'])) {
                    $img_src = 'images/users/' . $m['image'];
                }  
                // Check if it's a full path or URL
                elseif (filter_var($m['image'], FILTER_VALIDATE_URL)) {
                    $img_src = $m['image'];
                }
            }
            
            // If no image found, use default
            if (!file_exists(__DIR__ . '/' . $img_src) && !filter_var($img_src, FILTER_VALIDATE_URL)) {
                $img_src = 'images/members/default-avatar.jpg';
            }

            // Truncate biography snippet
            $bio_text = !empty($m['biography']) && $m['biography'] !== '0' ? $m['biography'] : 'A dedicated professional believing in lifelong learning and collaborative growth.';
            if (strlen($bio_text) > 110) {
                $bio_text = substr($bio_text, 0, 107) . '...';
            } else {
                $bio_text = $bio_text . '...';
            }
            
            $profile_url = 'member-profile.php?id=' . $m['id'];
          ?>

          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card border-0 rounded-0 hover-shadow h-100 p-3">
              <div class="d-flex align-items-start">

                <!-- Top Left: Circular Image (75x75) -->
                <div class="mr-3 flex-shrink-0">
                  <a href="<?php echo $profile_url; ?>">
                    <img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($m['full_name']); ?>'s profile" class="rounded-circle" style="width:75px;height:75px;object-fit:cover;border:2px solid #06487a;">
                  </a>
                </div>

                <!-- Right Side: Details -->
                <div class="flex-grow-1" style="min-width:0;overflow-wrap:break-word;">

                  <!-- Name -->
                  <a href="<?php echo $profile_url; ?>">
                    <h5 class="mb-1" style="font-size:15px;line-height:1.3;color:#06487a;">
                      <?php echo htmlspecialchars($m['full_name']); ?>
                    </h5>
                  </a>

                  <!-- Member ID -->
                  <p class="mb-1" style="font-size:12px;font-weight:600;">
                    <?php echo htmlspecialchars(!empty($m['membership_id']) ? $m['membership_id'] : 'ITLC-Member'); ?>, <?php echo htmlspecialchars(!empty($m['membership_name']) ? $m['membership_name'] : 'Member'); ?>
                  </p>

                  <!-- Position & Company -->
                  <?php if (!empty($m['position']) || !empty($m['company'])): ?>
                    <p class="text-color mb-1" style="font-size:12px;">
                      <?php echo htmlspecialchars($m['position'] ?? ''); ?>
                      <?php if (!empty($m['position']) && !empty($m['company'])): ?>
                         - 
                      <?php endif; ?>
                      <?php echo htmlspecialchars($m['company'] ?? ''); ?>
                    </p>
                  <?php endif; ?>

                  <!-- Education -->
                  <?php if (!empty($m['highest_education'])): ?>
                  <p class="text-color mb-1" style="font-size:12px;">
                    <i class="ti-mortarboard mr-1"></i>
                    <?php echo htmlspecialchars($m['highest_education']); ?>
                  </p>
                  <?php endif; ?>

                  <!-- Certification -->
                  <?php if (!empty($m['certification'])): ?>
                  <p class="text-color mb-2" style="font-size:12px;">
                    <i class="ti-medall mr-1"></i>
                    <?php echo htmlspecialchars($m['certification']); ?>
                  </p>
                  <?php endif; ?>

                  <!-- Bio Snippet -->
                  <p class="text-color mb-3" style="font-size:12px;line-height:1.5;">
                    <?php echo htmlspecialchars($bio_text); ?>
                  </p>

                  <!-- Full Bio Button -->
                  <a href="<?php echo $profile_url; ?>" class="btn btn-primary btn-sm py-1 px-3" style="font-size: 11px;">Full Bio</a>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Pagination -->
      <?php if ($total_pages > 1): ?>
        <div class="row mt-4">
          <div class="col-12">
            <nav aria-label="Members pagination">
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="member.php?page=<?php echo ($page - 1); ?><?php echo $query_string; ?>">Previous</a>
                  </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="member.php?page=<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="member.php?page=<?php echo ($page + 1); ?><?php echo $query_string; ?>">Next</a>
                  </li>
                <?php endif; ?>
              </ul>
            </nav>
          </div>
        </div>
      <?php endif; ?>

    <?php endif; ?>

  </div>
</section>
<!-- /Members Section -->

<?php 
include 'includes/footer.php'; 
?>