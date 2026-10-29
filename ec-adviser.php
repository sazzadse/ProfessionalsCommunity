<?php
$page_title = "EC Member (Adviser)";
$current_page = "about";

// Include configuration and header
include 'includes/config.php';
include 'includes/header.php';

// Pagination configuration: 12 members per page (3 per row)
$limit = 12;
$page  = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Count total EC Advisers
$count_query   = "SELECT COUNT(*) as total FROM `user` WHERE is_ec_adviser = 1";
$count_result  = $conn->query($count_query);
$total_members = (int)($count_result->fetch_assoc()['total'] ?? 0);
$total_pages   = ceil($total_members / $limit);

// Fetch EC Advisers ordered by ec_order ASC, id ASC
$stmt = $conn->prepare("SELECT u.id, u.membership_id, u.full_name, u.image, u.position, u.company, u.ec_title, u.ec_order, mt.membership_name 
                        FROM `user` u 
                        LEFT JOIN `membership_type` mt ON u.membership_type_id = mt.id 
                        WHERE u.is_ec_adviser = 1 
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

    /* EC Member Card */
    .ec-card {
        background: #fff;
        border: 1px solid #eef2f5;
        border-bottom: 1px solid #06487a;
        transition: all 0.3s ease;
    }

    .ec-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(6, 72, 122, 0.12);
    }

    /* EC Title Badge */
    .ec-badge {
        display: inline-block;
        background: transparent;
        color: #06487a;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 0;
        border: 2px solid #06487a;
    }

    /* Pagination styling matching member.php */
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
                <h1 class="main-title">Executive Committee (Adviser)</h1>
                <div class="title-accent"></div>
                <p class="mb-4">
                    The Advisory Board of the IT Leadership Community (ITLC) consists of distinguished technology leaders guiding strategic initiatives, industry collaborations, and community empowerment across Bangladesh.
                </p>
            </div>
        </div>

        <?php if (empty($members)): ?>
            <div class="text-center py-5">
                <i class="ti-user text-muted" style="font-size: 60px;"></i>
                <h5 class="mt-3 text-muted">No EC Member (Adviser) found.</h5>
                <p class="text-color">Please check back soon as adviser profiles are updated.</p>
            </div>
        <?php else: ?>

            <?php
            // Reusable render helper for an EC member card
            function renderEcMemberCard($m) {
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
                $ec_title    = !empty($m['ec_title']) ? $m['ec_title'] : 'EC Member (Adviser)';
                ?>
                <div class="card ec-card rounded-0 h-100 p-3">
                    <!-- EC Title Badge -->
                    <div class="mb-2">
                        <span class="ec-badge">
                            <i class="ti-award mr-1"></i><?php echo htmlspecialchars($ec_title); ?>
                        </span>
                    </div>

                    <div class="d-flex align-items-start mt-1">
                        <!-- Circular Image -->
                        <div class="mr-3 flex-shrink-0">
                            <a href="<?php echo $profile_url; ?>">
                                <img src="<?php echo htmlspecialchars($img_src); ?>" 
                                     alt="<?php echo htmlspecialchars($m['full_name']); ?>" 
                                     class="rounded-circle" 
                                     style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #06487a;">
                            </a>
                        </div>

                        <!-- Details -->
                        <div class="flex-grow-1" style="min-width: 0; overflow-wrap: break-word;">
                            <!-- Name -->
                            <a href="<?php echo $profile_url; ?>">
                                <h5 class="mb-1" style="font-size: 15px; line-height: 1.3; color: #06487a; font-weight: 700;">
                                    <?php echo htmlspecialchars($m['full_name']); ?>
                                </h5>
                            </a>

                            <!-- Position & Company -->
                            <?php if (!empty($m['position']) || !empty($m['company'])): ?>
                                <p class="text-color mb-1" style="font-size: 12px; line-height: 1.4;">
                                    <?php echo htmlspecialchars($m['position'] ?? ''); ?>
                                    <?php if (!empty($m['position']) && !empty($m['company'])): ?>
                                        - 
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($m['company'] ?? ''); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Member ID -->
                            <?php if (!empty($m['membership_id'])): ?>
                                <p class="text-muted mb-2" style="font-size: 11px;">
                                    <i class="ti-id-badge mr-1"></i><?php echo htmlspecialchars($m['membership_id']); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Full Bio Link -->
                            <a href="<?php echo $profile_url; ?>" class="btn btn-primary btn-sm py-1 px-3" style="font-size: 11px;">
                                Full Bio
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- Advisers Grid: Uniform 3 members per row -->
            <div class="row">
                <?php foreach ($members as $m): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <?php renderEcMemberCard($m); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="row mt-4">
                    <div class="col-12">
                        <nav aria-label="EC Advisers pagination">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="ec-adviser.php?page=<?php echo ($page - 1); ?>">Previous</a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="ec-adviser.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="ec-adviser.php?page=<?php echo ($page + 1); ?>">Next</a>
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
