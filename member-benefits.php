<?php
$page_title = "Member Benefits";
$current_page = "membership";

include 'includes/config.php';
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

    /* Section Subtitle */
    .itlc-about .section-desc {
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    /* Benefit Cards */
    .benefit-card {
        background: #fff;
        border: 1px solid #eef2f5;
        border-bottom: 2px solid #06487a;
        border-radius: 6px;
        padding: 28px 24px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .benefit-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(6, 72, 122, 0.12);
        border-color: #06487a;
    }

    .benefit-card .icon-box {
        width: 52px;
        height: 52px;
        background: #f0f7fb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        color: #06487a;
        font-size: 22px;
        transition: all 0.3s ease;
    }

    .benefit-card:hover .icon-box {
        background: #06487a;
        color: #ffbc3b;
    }

    .benefit-card h4 {
        color: #06487a;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .benefit-card p {
        color: #555;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* Section Headings */
    .itlc-about .section-heading {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        margin: 35px 0 15px;
    }

    /* Bullet List matching about.php */
    .itlc-about .benefits-list {
        list-style: none;
        padding: 0;
        margin: 15px 0 0;
    }

    .itlc-about .benefits-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 12px;
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
    }

    .itlc-about .benefits-list li::before {
        content: "";
        position: absolute;
        left: 4px;
        top: 11px;
        width: 8px;
        height: 8px;
        background: #06487a;
        border-radius: 50%;
    }

    /* CTA Box */
    .cta-box {
        background: #f8fbfd;
        border: 1px solid #dbe7f0;
        border-radius: 6px;
        padding: 30px;
        margin-top: 40px;
        text-align: center;
    }

    .cta-box h4 {
        color: #06487a;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .cta-box p {
        color: #06487a;
        font-size: 15px;
        margin-bottom: 20px;
    }

    /* Green Criteria Button with theme animation */
    .btn-criteria {
        background: #28a745;
        color: #fff;
    }

    .btn-criteria::before {
        background: #fff;
    }

    .btn-criteria:hover {
        background: #218838;
        color: #28a745;
    }

    .btn-criteria:active {
        background: #28a745 !important;
        color: #28a745;
    }

    /* Mobile Responsive */
    @media (max-width: 767px) {
        .itlc-about {
            padding: 120px 0 40px;
        }

        .itlc-about .main-title {
            font-size: 25px;
        }

        .itlc-about .section-heading {
            font-size: 18px;
        }
    }
</style>

<section class="itlc-about">
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <h1 class="main-title">Member Benefits</h1>
                <div class="title-accent"></div>
                <p class="section-desc">
                    Joining the IT Leadership Community (ITLC) connects you with Bangladesh's premier executive technology network. Experience a dynamic platform dedicated to elevating leadership capabilities, strategic collaboration, and industry impact.
                </p>
            </div>
        </div>

        <!-- Benefit Cards Grid -->
        <div class="row">

            <!-- 1. Executive Networking -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-user"></i>
                    </div>
                    <h4>Executive Networking</h4>
                    <p>
                        Engage directly with CIOs, CTOs, Heads of IT, and Senior Technology Managers across industries to build high-trust professional relationships with key decision-makers.
                    </p>
                </div>
            </div>

            <!-- 2. Knowledge Sharing & Roundtables -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-light-bulb"></i>
                    </div>
                    <h4>Knowledge Sharing</h4>
                    <p>
                        Participate in closed-door sessions, panel roundtables, and workshops sharing real-world insights on enterprise architecture, cybersecurity, cloud, and digital transformation.
                    </p>
                </div>
            </div>

            <!-- 3. Career Advancement -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-briefcase"></i>
                    </div>
                    <h4>Career &amp; Executive Placement</h4>
                    <p>
                        Gain enhanced visibility within the corporate technology landscape and access exclusive executive opportunities, board appointments, and leadership referrals.
                    </p>
                </div>
            </div>

            <!-- 4. Mentorship & Peer Coaching -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-direction-alt"></i>
                    </div>
                    <h4>Mentorship &amp; Peer Coaching</h4>
                    <p>
                        Access structured mentorship and peer support designed to accelerate managerial competence and transition senior practitioners into strategic C-suite leaders.
                    </p>
                </div>
            </div>

            <!-- 5. Industry Standards & Policy -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-agenda"></i>
                    </div>
                    <h4>Industry Benchmarks &amp; Standards</h4>
                    <p>
                        Contribute directly to setting national technology guidelines, best practices, and collaborative policy discussions that advance Bangladesh's digital ecosystem.
                    </p>
                </div>
            </div>

            <!-- 6. Exclusive Summits & Recognition -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="benefit-card">
                    <div class="icon-box">
                        <i class="ti-medall"></i>
                    </div>
                    <h4>Recognition &amp; Annual Summits</h4>
                    <p>
                        Enjoy priority access to annual ITLC conferences, technology summits, leadership seminars, and member recognition awards honoring excellence in technology leadership.
                    </p>
                </div>
            </div>

        </div>

        <!-- Additional Membership Privileges -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">Key Membership Privileges</h2>
                <ul class="benefits-list">
                    <li><strong>Official ITLC Membership ID &amp; Directory Listing:</strong> Gain a verified digital identity on the official community portal showcasing your professional credentials.</li>
                    <li><strong>Action Teams &amp; Working Groups:</strong> Eligibility to join specialized ITLC domain committees focusing on Cloud, AI, Security, and Enterprise Applications.</li>
                    <li><strong>Collaborative Research &amp; White Papers:</strong> Access and contribute to exclusive industry reports, tech surveys, and strategic leadership white papers.</li>
                    <li><strong>Voting Rights &amp; Community Participation:</strong> Active voice in electing and shaping committee initiatives and community roadmap.</li>
                </ul>
            </div>
        </div>

        <!-- Call to Action Box -->
        <div class="row">
            <div class="col-12">
                <div class="cta-box">
                    <h4>Ready to Elevate Your Leadership Journey?</h4>
                    <p class="text-center">
                        Join hundreds of senior IT leaders shaping the future of technology in Bangladesh.
                    </p>
                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary px-4 py-2 mr-2">
                        Become a Member
                    </a>
                    <a href="membership-criteria.php" class="btn btn-criteria px-4 py-2">
                        View Membership Criteria
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>
