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

  // Build SQL conditions
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

  // Build query parameters for pagination links
  $query_params = [];
  if (!empty($search_query)) {
      $query_params[] = 'search=' . urlencode($search_query);
  }
  
  $query_string = !empty($query_params) ? '&' . implode('&', $query_params) : '';
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    LEADERSHIP DIRECTORY
                </span>
                <h1 class="hero-title">Our Members Directory</h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    Connecting senior CIOs, CTOs, and IT directors across Bangladesh to foster executive collaboration and digital excellence.
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <a href="member.php">Membership</a>
                    <span class="sep">/</span>
                    <span class="current">Directory</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Member Directory Section -->
<section class="itlc-content-section">
  <div class="container">

    <!-- Modern Search Bar -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 col-md-10">
        <div class="itlc-card p-2 shadow-sm" style="border-radius: 9999px;">
          <form action="member.php" method="GET" class="d-flex align-items-center">
            <div class="pl-3 text-muted" style="font-size: 16px;">
              <i class="fa-solid fa-magnifying-glass text-warning"></i>
            </div>
            <input type="text" name="search" class="form-control border-0 bg-transparent px-3 py-2" placeholder="Search by Name, Company, Position, or ID..." value="<?php echo htmlspecialchars($search_query); ?>" style="font-size: 14.5px; box-shadow: none;">
            
            <?php if (!empty($search_query)): ?>
              <a href="member.php" class="btn btn-link text-muted px-2" title="Reset Search">
                <i class="fa-solid fa-xmark"></i>
              </a>
            <?php endif; ?>
            
            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold ml-2">
              <span>Search</span>
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Active Filter Badge & Result Counter -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
      <div>
        <h6 class="font-weight-normal text-muted m-0" style="font-size: 14px;">
          Showing <strong class="text-dark"><?php echo count($members); ?></strong> of <strong class="text-dark"><?php echo $total_members; ?></strong> Verified Leaders
          <?php if (!empty($search_query)): ?>
            matching "<span class="font-weight-bold" style="color: #06487a;"><?php echo htmlspecialchars($search_query); ?></span>"
          <?php endif; ?>
        </h6>
      </div>
      <div>
        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-gold-sm">
          <i class="fa-solid fa-plus mr-1"></i>Join Network
        </a>
      </div>
    </div>

    <?php if (empty($members)): ?>
      <div class="text-center py-5">
        <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; font-size: 28px;">
          <i class="fa-solid fa-user-slash"></i>
        </div>
        <h5 class="font-weight-bold mb-1" style="color: #06487a;">No Members Found</h5>
        <p class="text-muted small">No profile matches your search keywords. Try searching by company, position, or name.</p>
        <a href="member.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold small mt-2">View All Members</a>
      </div>
    <?php else: ?>
      
      <!-- Modern Members Grid (3 Profiles per Row) -->
      <div class="row">
        <?php foreach ($members as $m): ?>
          <?php 
            $img_src = 'images/users/default-avatar.jpg';
            if (!empty($m['image'])) {
                if (file_exists(__DIR__ . '/images/users/' . $m['image'])) {
                    $img_src = 'images/users/' . $m['image'];
                } elseif (filter_var($m['image'], FILTER_VALIDATE_URL)) {
                    $img_src = $m['image'];
                }
            }
            if (!file_exists(__DIR__ . '/' . $img_src) && !filter_var($img_src, FILTER_VALIDATE_URL)) {
                $img_src = 'images/users/default-avatar.jpg';
            }

            // Truncate biography snippet
            $bio_text = !empty($m['biography']) && $m['biography'] !== '0' ? $m['biography'] : 'A dedicated professional believing in lifelong learning and collaborative growth.';
            if (strlen($bio_text) > 100) {
                $bio_text = substr($bio_text, 0, 97) . '...';
            }
            
            $profile_url = 'member-profile.php?id=' . $m['id'];
          ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="itlc-card h-100 p-4 d-flex flex-column">
              
              <!-- Tier & ID Header -->
              <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <span class="badge badge-pill px-2.5 py-1 font-weight-bold" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 10.5px;">
                  <?php echo htmlspecialchars(!empty($m['membership_name']) ? $m['membership_name'] : 'Member'); ?>
                </span>
                <span class="text-muted small" style="font-size: 11px;">
                  <?php echo htmlspecialchars(!empty($m['membership_id']) ? $m['membership_id'] : 'ITLC-M' . $m['id']); ?>
                </span>
              </div>

              <!-- Main Member Info -->
              <div class="d-flex align-items-start mb-3">
                <div class="mr-3 flex-shrink-0" style="width: 74px; height: 74px; border-radius: 16px; overflow: hidden; background: #f1f5f9; border: 2px solid #e2e8f0;">
                  <a href="<?php echo $profile_url; ?>" class="d-block w-100 h-100">
                    <img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($m['full_name']); ?>" class="w-100 h-100" style="object-fit: cover; object-position: top center;">
                  </a>
                </div>

                <div class="flex-grow-1 min-w-0">
                  <h5 class="font-weight-bold mb-1 text-truncate" style="font-size: 15.5px; color: #06487a;">
                    <a href="<?php echo $profile_url; ?>" class="text-dark"><?php echo htmlspecialchars($m['full_name']); ?></a>
                  </h5>
                  
                  <?php if (!empty($m['position']) || !empty($m['company'])): ?>
                    <p class="text-muted mb-1 text-truncate" style="font-size: 12.5px; line-height: 1.4;">
                      <?php echo htmlspecialchars($m['position'] ?? ''); ?>
                      <?php if (!empty($m['position']) && !empty($m['company'])): ?>
                        <br><strong class="text-dark"><?php echo htmlspecialchars($m['company'] ?? ''); ?></strong>
                      <?php else: ?>
                        <?php echo htmlspecialchars($m['company'] ?? ''); ?>
                      <?php endif; ?>
                    </p>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Education / Certification Meta -->
              <?php if (!empty($m['highest_education']) || !empty($m['certification'])): ?>
                <div class="small text-secondary mb-2" style="font-size: 12px; line-height: 1.5;">
                  <?php if (!empty($m['highest_education'])): ?>
                    <div class="text-truncate mb-1"><i class="fa-solid fa-graduation-cap text-muted mr-1.5"></i><?php echo htmlspecialchars($m['highest_education']); ?></div>
                  <?php endif; ?>
                  <?php if (!empty($m['certification'])): ?>
                    <div class="text-truncate"><i class="fa-solid fa-certificate text-warning mr-1.5"></i><?php echo htmlspecialchars($m['certification']); ?></div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <!-- Bio Snippet -->
              <p class="text-muted small mb-3 flex-grow-1" style="font-size: 12.5px; line-height: 1.6;">
                <?php echo htmlspecialchars($bio_text); ?>
              </p>

              <!-- Profile Button -->
              <div class="pt-2 border-top">
                <a href="<?php echo $profile_url; ?>" class="btn btn-gold-sm btn-block text-center font-weight-bold">
                  View Full Profile
                </a>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Modern Pagination -->
      <?php if ($total_pages > 1): ?>
        <div class="row mt-4">
          <div class="col-12">
            <nav aria-label="Members pagination">
              <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                  <li class="page-item mr-1">
                    <a class="page-link rounded-pill px-3" href="member.php?page=<?php echo ($page - 1); ?><?php echo $query_string; ?>">
                      <i class="fa-solid fa-chevron-left mr-1 small"></i>Previous
                    </a>
                  </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?> mx-1">
                    <a class="page-link rounded-circle text-center" style="width: 38px; height: 38px; line-height: 22px;" href="member.php?page=<?php echo $i; ?><?php echo $query_string; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                  <li class="page-item ml-1">
                    <a class="page-link rounded-pill px-3" href="member.php?page=<?php echo ($page + 1); ?><?php echo $query_string; ?>">
                      Next<i class="fa-solid fa-chevron-right ml-1 small"></i>
                    </a>
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

<?php 
include 'includes/footer.php'; 
?>
