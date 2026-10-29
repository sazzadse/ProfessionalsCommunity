
<?php
$page_title = "About ITLC";

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

    /* Section Headings */
    .itlc-about .section-heading {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        margin: 0 0 12px;
    }

    /* Paragraph - Same as Home Page */
    .itlc-about p {
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        margin: 0 0 14px;
    }

    .itlc-about strong {
        font-weight: 700;
    }

    /* Section Spacing */
    .itlc-about .content-section {
        margin-top: 12px;
    }

    /* Activities List */
    .itlc-about .activities-list {
        list-style: none;
        padding: 0;
        margin: 12px 0 0;
    }

    .itlc-about .activities-list li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 8px;
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
    }

    /* Custom Blue Bullet */
    .itlc-about .activities-list li::before {
        content: "";
        position: absolute;
        left: 2px;
        top: 10px;
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
            font-size: 20px;
        }

        .itlc-about .content-section {
            margin-top: 24px;
        }
    }
</style>

<section class="itlc-about">
    <div class="container">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <h1 class="main-title">About ITLC</h1>
                <div class="title-accent"></div>
            </div>
        </div>

        <!-- Introduction -->
        <div class="row">
            <div class="col-12">
                <p>
                    <strong>The IT Leadership Community (ITLC)</strong>
                    is a non-profit, non-political organization comprised
                    of senior IT leaders, including CIOs, CTOs, Heads of
                    IT, IT Managers, and IT Project Managers. It was
                    established to create a collaborative platform for
                    IT professionals to grow together and support each
                    other in leadership development.
                </p>
            </div>
        </div>

        <!-- Vision -->
        <div class="row content-section">
            <div class="col-12">
                <h2 class="section-heading">Our Vision</h2>
                <p>
                    ITLC envisions a tech-driven Bangladesh by advancing
                    and setting standards for the IT profession and
                    leadership, driving economic growth, and fostering
                    innovation for a prosperous future.
                </p>
            </div>
        </div>

        <!-- Mission -->
        <div class="row content-section">
            <div class="col-12">
                <h2 class="section-heading">Our Mission</h2>
                <p>
                    Our mission is to empower and elevate the IT
                    profession by upholding the highest standards of
                    excellence among members, enabling them to deliver
                    exceptional services to society.
                </p>
                <p>
                    ITLC focuses on formulating and implementing
                    technology standards, aligning with global best
                    practices, and harnessing Bangladesh's human
                    potential for sustainable progress.
                </p>
            </div>
        </div>

        <!-- Community -->
        <div class="row content-section">
            <div class="col-12">
                <h2 class="section-heading">Our Community</h2>
                <p>
                    ITLC welcomes all senior IT professionals in
                    Bangladesh. Membership in action teams and
                    participation in events are open to everyone,
                    regardless of previous involvement. We encourage
                    broad participation across the IT sector.
                </p>
                <p>
                    The ITLC Executive Committee (EC) strives to create
                    an open and collaborative environment across the
                    wider IT community and organizes events to support
                    members' leadership development.
                </p>
            </div>
        </div>

        <!-- Activities -->
        <div class="row content-section">
            <div class="col-12">
                <h2 class="section-heading">Our Activities</h2>
                <p>
                    ITLC promotes professional growth, leadership,
                    collaboration, and knowledge sharing through
                    the following initiatives:
                </p>

                <ul class="activities-list">
                    <li>Global network expansion among IT leaders.</li>
                    <li>Supporting IT industry standards and best practices.</li>
                    <li>Professional development programs.</li>
                    <li>Job opportunities through the ITLC network.</li>
                    <li>Mentorship programs.</li>
                    <li>Real-world experience-sharing sessions.</li>
                    <li>
                        Topic-based discussions, including webinars,
                        workshops, panel discussions, cutting-edge
                        research, IT conferences, and collaboration.
                    </li>
                    <li>Recognition and awards.</li>
                </ul>
            </div>
        </div>

        <!-- Decision Making -->
        <div class="row content-section">
            <div class="col-12">
                <h2 class="section-heading">Decision-Making Process</h2>
                <p>
                    Major decisions are finalized through consensus
                    among Executive Committee (EC) members during
                    meetings, taking members' opinions into consideration.
                </p>
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
