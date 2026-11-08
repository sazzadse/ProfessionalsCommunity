<?php
$page_title = "Executive Committee";
$current_page = "about";

// Include configuration and header
include 'includes/config.php';
include 'includes/header.php';

// Pagination configuration: 11 members on Page 1, 12 members per page thereafter
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// Count total EC members
$count_query  = "SELECT COUNT(*) as total FROM `user` WHERE is_ec_member = 1";
$count_result = $conn->query($count_query);
$total_members = (int)($count_result->fetch_assoc()['total'] ?? 0);

// Calculate total pages
if ($total_members <= 11) {
    $total_pages = 1;
} else {
    $total_pages = 1 + (int)ceil(($total_members - 11) / 12);
}

// Clamp page to valid range
if ($page > $total_pages && $total_pages > 0) {
    $page = $total_pages;
}

// Calculate limit and offset based on current page
if ($page === 1) {
    $limit  = 11;
    $offset = 0;
} else {
    $limit  = 12;
    $offset = 11 + ($page - 2) * 12;
}

// Fetch EC members ordered by ec_order ASC, id ASC
$stmt = $conn->prepare("SELECT u.id, u.membership_id, u.full_name, u.image, u.position, u.company, u.ec_title, u.ec_order, mt.membership_name 
                        FROM `user` u 
                        LEFT JOIN `membership_type` mt ON u.membership_type_id = mt.id 
                        WHERE u.is_ec_member = 1 
                        ORDER BY u.ec_order ASC, u.id ASC 
                        LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$members_res = $stmt->get_result();

$members = [];
while ($row = $members_res->fetch_assoc()) {
    $members[] = $row;
}
$stmt->close();

// Split members for Page 1: first 2 (President & Sr. Vice President) in Row 1, next 9 in 3-column rows
$top_members       = ($page === 1) ? array_slice($members, 0, 2) : [];
$subsequent_members = ($page === 1) ? array_slice($members, 2) : $members;
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    LEADERSHIP TEAM
                </span>
                <h1 class="hero-title">Executive Committee</h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    The distinguished technology executives guiding strategic initiatives, industry standards, and community empowerment across Bangladesh.
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <a href="about.php">About Us</a>
                    <span class="sep">/</span>
                    <span class="current">Executive Committee</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main EC Members Directory -->
<section class="itlc-content-section">
    <div class="container">

        <?php if (empty($members)): ?>
            <div class="text-center py-5">
                <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; font-size: 28px;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h5 class="font-weight-bold mb-1" style="color: #06487a;">No Committee Members Listed</h5>
                <p class="text-muted small">Committee profiles are currently being synchronized.</p>
            </div>
        <?php else: ?>

            <?php
            // Modern reusable render helper for an EC member card
            function renderModernEcMemberCard($m, $is_top = false) {
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

                $profile_url = 'member-profile.php?id=' . $m['id'];
                $ec_title    = !empty($m['ec_title']) ? $m['ec_title'] : 'EC Member';
                ?>
                <div class="itlc-card h-100 p-3 p-sm-4 d-flex flex-column" style="<?php echo $is_top ? 'border-top: 4px solid #ffbc3b; background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);' : ''; ?>">
                    
                    <!-- Role Pill -->
                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <span class="badge badge-pill px-3 py-1 font-weight-bold" style="<?php echo $is_top ? 'background: rgba(255, 188, 59, 0.2); color: #b45309;' : 'background: rgba(6, 72, 122, 0.08); color: #06487a;'; ?> font-size: 11px;">
                            <i class="fa-solid fa-award mr-1"></i><?php echo htmlspecialchars($ec_title); ?>
                        </span>
                        <?php if (!empty($m['membership_id'])): ?>
                            <span class="text-muted small" style="font-size: 11px;">ID: <?php echo htmlspecialchars($m['membership_id']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex align-items-center mt-1">
                        <!-- Portrait Avatar -->
                        <div class="mr-3 flex-shrink-0" style="width: <?php echo $is_top ? '84px' : '72px'; ?>; height: <?php echo $is_top ? '84px' : '72px'; ?>; border-radius: 16px; overflow: hidden; background: #f1f5f9; border: 2px solid #e2e8f0;">
                            <a href="<?php echo $profile_url; ?>" class="d-block w-100 h-100">
                                <img src="<?php echo htmlspecialchars($img_src); ?>" 
                                     alt="<?php echo htmlspecialchars($m['full_name']); ?>" 
                                     class="w-100 h-100" 
                                     style="object-fit: cover; object-position: top center;">
                            </a>
                        </div>

                        <!-- Details -->
                        <div class="flex-grow-1 min-w-0">
                            <!-- Name -->
                            <h5 class="font-weight-bold mb-1 text-truncate" style="font-size: 16px; color: #06487a;">
                                <a href="<?php echo $profile_url; ?>" class="text-dark"><?php echo htmlspecialchars($m['full_name']); ?></a>
                            </h5>

                            <!-- Position & Company -->
                            <?php if (!empty($m['position']) || !empty($m['company'])): ?>
                                <p class="text-muted mb-2 text-truncate" style="font-size: 12.5px; line-height: 1.4;">
                                    <?php echo htmlspecialchars($m['position'] ?? ''); ?>
                                    <?php if (!empty($m['position']) && !empty($m['company'])): ?>
                                        <br><span class="text-dark font-weight-bold"><?php echo htmlspecialchars($m['company'] ?? ''); ?></span>
                                    <?php else: ?>
                                        <?php echo htmlspecialchars($m['company'] ?? ''); ?>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>

                            <!-- Full Bio Link -->
                            <div>
                                <a href="<?php echo $profile_url; ?>" class="btn btn-gold-sm py-1 px-3" style="font-size: 11.5px;">
                                    View Full Bio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php if ($page === 1 && !empty($top_members)): ?>
                <!-- Row 1: Executive Leaders (President & Senior Vice President) -->
                <div class="row justify-content-center mb-3">
                    <?php foreach ($top_members as $m): ?>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <?php renderModernEcMemberCard($m, true); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($subsequent_members)): ?>
                <!-- Subsequent Committee Members: 3 members per row -->
                <div class="row">
                    <?php foreach ($subsequent_members as $m): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <?php renderModernEcMemberCard($m, false); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Modern Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="row mt-4">
                    <div class="col-12">
                        <nav aria-label="EC Members pagination">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item mr-1">
                                        <a class="page-link rounded-pill px-3" href="ec-member.php?page=<?php echo ($page - 1); ?>">
                                            <i class="fa-solid fa-chevron-left mr-1 small"></i>Previous
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?> mx-1">
                                        <a class="page-link rounded-circle text-center" style="width: 38px; height: 38px; line-height: 22px;" href="ec-member.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item ml-1">
                                        <a class="page-link rounded-pill px-3" href="ec-member.php?page=<?php echo ($page + 1); ?>">
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
