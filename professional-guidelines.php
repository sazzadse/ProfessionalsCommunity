<?php
$page_title = "Professional Guidelines";
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
        margin-bottom: 25px;
    }

    /* Section Headings */
    .itlc-about .section-heading {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        margin: 30px 0 12px;
    }

    /* Bullet List matching about.php & membership-criteria.php */
    .itlc-about .guidelines-list {
        list-style: none;
        padding: 0;
        margin: 15px 0 0;
    }

    .itlc-about .guidelines-list li {
        position: relative;
        padding-left: 28px;
        margin-bottom: 16px;
        color: #06487a;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 400;
        text-align: justify;
    }

    /* Custom Blue Bullet */
    .itlc-about .guidelines-list li::before {
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
    .itlc-about .guidelines-list li.note-item {
        padding-left: 0;
        margin-top: 30px;
        font-size: 14px;
        font-weight: 600;
    }

    .itlc-about .guidelines-list li.note-item::before {
        display: none;
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
                <h1 class="main-title">Professional Guidelines</h1>
                <div class="title-accent"></div>
                <p class="section-desc">
                    The IT Leadership Community (ITLC) is built upon the pillars of mutual trust, professional ethics, peer collaboration, and executive leadership. All members are required to uphold these guidelines to maintain an inspiring, constructive, and dignified professional community.
                </p>
            </div>
        </div>

        <!-- 1. Code of Professional Conduct -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">1. Code of Professional Conduct</h2>
                <ul class="guidelines-list">
                    <li>
                        <strong>Integrity &amp; Ethical Leadership:</strong> Members must adhere to the highest ethical and professional standards in their organizational roles and community engagements, setting a positive precedent for Bangladesh's tech industry.
                    </li>
                    <li>
                        <strong>Mutual Respect &amp; Inclusivity:</strong> Foster an inclusive, polite, and encouraging environment where diverse perspectives and technical viewpoints are respected without prejudice.
                    </li>
                    <li>
                        <strong>Commitment to Excellence:</strong> Promote continuous learning, technological standard-setting, and innovation to support sustainable digital transformation across business and public sectors.
                    </li>
                </ul>
            </div>
        </div>

        <!-- 2. Community & Communication Standards -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">2. Community &amp; Communication Standards</h2>
                <ul class="guidelines-list">
                    <li>
                        <strong>Strict Prohibition of Sales &amp; Solicitation:</strong> Unsolicited advertisements, direct sales pitches, vendor promotions, and marketing campaigns are strictly prohibited in all ITLC forums, groups, and events.
                    </li>
                    <li>
                        <strong>Neutrality in Public Discourse:</strong> Discussions, posts, or debates involving religion, partisan politics, external society conflicts, or controversial non-professional topics are strictly forbidden in ITLC channels.
                    </li>
                    <li>
                        <strong>Confidentiality &amp; Data Protection:</strong> Strategic insights, sensitive enterprise architectures, and proprietary experiences shared during closed-door roundtables must remain strictly confidential.
                    </li>
                </ul>
            </div>
        </div>

        <!-- 3. Collaboration & Mentorship -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">3. Knowledge Sharing &amp; Mentorship</h2>
                <ul class="guidelines-list">
                    <li>
                        <strong>Active Participation:</strong> Members are encouraged to proactively participate in knowledge-sharing sessions, domain working groups, webinars, and panel discussions.
                    </li>
                    <li>
                        <strong>Empowering Emerging Leaders:</strong> Experienced executives are expected to share practical guidance, coach peers, and mentor emerging technology professionals to cultivate future IT leadership.
                    </li>
                </ul>
            </div>
        </div>

        <!-- 4. Policy Enforcement & Compliance -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-heading">4. Policy Enforcement &amp; Governance</h2>
                <ul class="guidelines-list">
                    <li>
                        <strong>Membership Revocation:</strong> Any member found engaging in commercial marketing, policy violations, or conduct prejudicial to ITLC will have their membership revoked upon verified review by the Executive Committee.
                    </li>
                    <li>
                        <strong>Administrative Discretion:</strong> ITLC Administrators reserve the full right to moderate content, remove non-compliant communications, and take corrective measures to protect the community's integrity.
                    </li>
                    <li class="note-item">
                        <strong>*** ITLC Authority reserves the right to amend and update these Professional Guidelines as needed for the continued excellence and governance of the community.</strong>
                    </li>
                </ul>

                <div class="mt-4 pt-2">
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
