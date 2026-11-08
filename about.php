<?php
$page_title = "About ITLC";
$current_page = "about";

include 'includes/config.php';
include 'includes/header.php';

// Fetch dynamic membership count from database (identical to homepage counter)
$counts = [];
$res = $conn->query("SELECT membership_type_id, COUNT(*) as count FROM `user` WHERE membership_type_id IS NOT NULL GROUP BY membership_type_id");
if ($res) {
    while($row = $res->fetch_assoc()) {
        $counts[$row['membership_type_id']] = $row['count'];
    }
}
$lifetime = $counts[1] ?? 0;
$professional = $counts[2] ?? 0;
$general = $counts[3] ?? 0;
$student = $counts[4] ?? 0;
$total_members = $lifetime + $professional + $general + $student;

if ($total_members <= 0) {
    $total_res = $conn->query("SELECT COUNT(*) as count FROM `user`");
    if ($total_res) {
        $total_members = (int)$total_res->fetch_assoc()['count'];
    }
}
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    ORGANIZATION PROFILE
                </span>
                <h1 class="hero-title">About IT Leadership Community</h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    A non-profit, non-political organization comprised of visionary technology executives, CIOs, CTOs, and IT directors across Bangladesh.
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <span class="current">About ITLC</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<section class="itlc-content-section">
    <div class="container">
        
        <!-- Introduction Overview Card -->
        <div class="itlc-card p-4 p-lg-5 mb-5" style="border-left: 5px solid #06487a;">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h3 class="font-weight-bold mb-3" style="color: #06487a; font-size: 24px;">Who We Are</h3>
                    <p class="lead text-dark mb-3" style="font-size: 17px; font-weight: 500; line-height: 1.7;">
                        The <strong>IT Leadership Community (ITLC)</strong> is a non-profit, non-political organization uniting senior IT leaders, including CIOs, CTOs, Heads of IT, IT Managers, and Senior Project Managers across corporate, financial, telecommunications, and industrial sectors.
                    </p>
                    <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.8;">
                        Established to create a vibrant, collaborative platform for technology professionals to grow together, ITLC supports its members in executive leadership development, strategic problem solving, and technological innovation.
                    </p>
                </div>
            </div>
        </div>

        <!-- Vision & Mission Grid -->
        <div class="row mb-5">
            
            <!-- Vision -->
            <div class="col-md-6 mb-4 mb-md-0 d-flex">
                <div class="itlc-card p-4 p-lg-5 w-100 d-flex flex-column" style="border-top: 4px solid #ffbc3b;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 14px; background: rgba(255, 188, 59, 0.18); color: #b45309; font-size: 20px;">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <h4 class="font-weight-bold mb-0" style="color: #06487a; font-size: 22px;">Our Vision</h4>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.8;">
                        ITLC envisions a tech-driven Bangladesh by advancing and setting standards for the IT profession and leadership, driving economic growth, and fostering innovation for a prosperous and resilient future.
                    </p>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-md-6 d-flex">
                <div class="itlc-card p-4 p-lg-5 w-100 d-flex flex-column" style="border-top: 4px solid #06487a;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 14px; background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 20px;">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <h4 class="font-weight-bold mb-0" style="color: #06487a; font-size: 22px;">Our Mission</h4>
                    </div>
                    <p class="text-muted mb-2" style="font-size: 15px; line-height: 1.8;">
                        Our mission is to empower and elevate the IT profession by upholding the highest standards of excellence among members, enabling them to deliver exceptional technological value to society.
                    </p>
                    <p class="text-muted mb-0" style="font-size: 15px; line-height: 1.8;">
                        We formulate and implement technology frameworks, align with global best practices, and harness Bangladesh's human potential for sustainable progress.
                    </p>
                </div>
            </div>

        </div>

        <!-- Community & Inclusivity -->
        <div class="itlc-card p-4 p-lg-5 mb-5 bg-surface">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 11px;">
                        INCLUSIVE ECOSYSTEM
                    </span>
                    <h3 class="font-weight-bold mb-3" style="color: #06487a; font-size: 24px;">Our Community Ecosystem</h3>
                    <p class="text-muted mb-3" style="line-height: 1.8; font-size: 15px;">
                        ITLC welcomes all eligible senior IT professionals in Bangladesh. Membership in action teams and participation in events are open to technology leaders regardless of previous community involvement. We foster broad participation across every vertical of the technology industry.
                    </p>
                    <p class="text-muted mb-0" style="line-height: 1.8; font-size: 15px;">
                        The ITLC Executive Committee (EC) actively organizes conferences, networking sessions, and leadership summits to support members' lifelong career development.
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="p-4 bg-white rounded-xl shadow-sm border" style="border-radius: 18px;">
                        <i class="fa-solid fa-users-line mb-3 text-warning" style="font-size: 44px;"></i>
                        <h5 class="font-weight-bold mb-1" style="color: #06487a;"><?php echo number_format($total_members); ?> Members</h5>
                        <p class="text-muted small mb-3">CIOs, CTOs, and IT Managers</p>
                        <a href="member.php" class="btn btn-primary-outline btn-block rounded-pill py-2 font-weight-bold small">
                            View Directory
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities Section -->
        <div class="mb-5">
            <div class="text-center max-w-2xl mx-auto mb-4">
                <h3 class="font-weight-bold mb-2" style="color: #06487a; font-size: 26px;">Key Initiatives & Activities</h3>
                <p class="text-muted small mb-0">How ITLC actively promotes leadership development and national technology growth</p>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-primary mb-3" style="font-size: 24px;"><i class="fa-solid fa-globe"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Global Network Expansion</h5>
                        <p class="text-muted small mb-0">Building partnerships with international technology bodies and overseas IT chapters.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-warning mb-3" style="font-size: 24px;"><i class="fa-solid fa-certificate"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Industry Standards</h5>
                        <p class="text-muted small mb-0">Promoting benchmark IT frameworks, security standards, and ITIL/DevOps best practices.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-success mb-3" style="font-size: 24px;"><i class="fa-solid fa-chart-line"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Professional Development</h5>
                        <p class="text-muted small mb-0">Hosting specialized leadership masterclasses, C-suite coaching, and technical seminars.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-info mb-3" style="font-size: 24px;"><i class="fa-solid fa-briefcase"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Executive Career Network</h5>
                        <p class="text-muted small mb-0">Confidential referrals, advisory placements, and senior job opportunities within the network.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-secondary mb-3" style="font-size: 24px;"><i class="fa-solid fa-comments"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Knowledge Exchange Summits</h5>
                        <p class="text-muted small mb-0">Regular webinars, roundtables, Coffee Adda gatherings, and annual conferences.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="itlc-card p-4 h-100">
                        <div class="text-danger mb-3" style="font-size: 24px;"><i class="fa-solid fa-trophy"></i></div>
                        <h5 class="font-weight-bold mb-2" style="font-size: 16px; color: #06487a;">Recognition & Awards</h5>
                        <p class="text-muted small mb-0">Honoring outstanding IT leaders, digital innovators, and pioneering enterprises.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Governance / Decision Making -->
        <div class="itlc-card p-4 p-lg-5 mb-5 text-center bg-surface">
            <h4 class="font-weight-bold mb-2" style="color: #06487a; font-size: 22px;">Democratic & Transparent Governance</h4>
            <p class="text-muted mx-auto mb-4" style="max-width: 700px; font-size: 15px; line-height: 1.8;">
                Major decisions are finalized through consensus among Executive Committee (EC) members during regular assemblies, strictly prioritizing the interests and voices of our broader community members.
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="ec-member.php" class="btn btn-primary rounded-pill px-4 py-2 mr-2 font-weight-bold">
                    Meet Executive Committee
                </a>
                <a href="ec-adviser.php" class="btn btn-primary-outline rounded-pill px-4 py-2 font-weight-bold">
                    Advisory Board
                </a>
            </div>
        </div>

        <!-- Modern Call to Action Card -->
        <div class="p-4 p-md-5 rounded-xl text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #021424 0%, #03233e 50%, #06487a 100%); border-radius: 20px;">
            <div class="position-relative" style="z-index: 2;">
                <h3 class="font-weight-bold text-white mb-2" style="font-size: 26px;">Ready to Elevate Your Leadership Journey?</h3>
                <p class="text-white-50 mx-auto mb-4" style="max-width: 650px; font-size: 15px;">
                    Join hundreds of senior IT leaders shaping the future of technology and enterprise innovation in Bangladesh.
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-2">
                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary rounded-pill px-5 py-2 mr-2 font-weight-bold">
                        Become a Member
                    </a>
                    <a href="membership-criteria.php" class="btn btn-outline-light rounded-pill px-4 py-2 font-weight-bold">
                        View Criteria
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>
