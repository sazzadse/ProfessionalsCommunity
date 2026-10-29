<?php
$page_title = "Membership Criteria";
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

    /* Paragraph */
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

    /* Criteria List */
    .itlc-about .criteria-list {
        list-style: none;
        padding: 0;
        margin: 20px 0 0;
    }

    .itlc-about .criteria-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 20px;
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        text-align: justify;
    }

    /* Custom Blue Bullet */
    .itlc-about .criteria-list li::before {
        content: "";
        position: absolute;
        left: 4px;
        top: 11px;
        width: 8px;
        height: 8px;
        background: #06487a;
        border-radius: 50%;
    }

    /* Note Item */
    .itlc-about .criteria-list li.note-item {
        padding-left: 0;
        margin-top: 30px;
        font-size: 14px;
        font-weight: 600;
    }

    .itlc-about .criteria-list li.note-item::before {
        display: none;
    }

    /* Mobile Responsive */
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

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <h1 class="main-title">Membership Criteria</h1>
                <div class="title-accent"></div>
            </div>
        </div>

        <!-- Criteria Content -->
        <div class="row">
            <div class="col-12">
                <ul class="criteria-list">
                    <li>
                        <strong>Eligible Positions:</strong> CIO, CTO, Head of IT, IT Managers, and Project Managers (IT/Software/ERP) with 10+ years of overall experience, including a minimum of 3+ years of managerial experience as an IT Leader.
                    </li>
                    <li>
                        <strong>Exclusions:</strong> Non-Technical Persons, Sales, Pre-Sales, and Technical Pre-Sales roles are not permitted to join ITLC.
                    </li>
                    <li>
                        <strong>Verification Process:</strong> ITLC organizers will conduct thorough verification of each applicant by a dedicated team, retaining the right to deny any membership request that does not meet the ITLC Membership Criteria.
                    </li>
                    <li>
                        <strong>Communication Guidelines:</strong> Advertisement &amp; Sales related posts, Posts related to Religion, Politics, Other Community, Society, Forum, and any Contradictory Issue are strictly prohibited in ITLC communication channels. Admin holds the right to delete such posts if it goes against this guideline.
                    </li>
                    <li>
                        <strong>Enforcement of Policies:</strong> If any member is found engaged in sales or marketing activities within ITLC, His/Her membership will be revoked upon verified reports from ITLC members, ensuring ITLC's integrity and focus on professional development.
                    </li>
                    <li class="note-item">
                        <strong>*** ITLC Authority can change and update the Terms and Conditions if needed for the betterment of ITLC.</strong>
                    </li>
                </ul>

                <div class="mt-4 pt-2">
                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary px-4 py-2">
                        Become a Member
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>
