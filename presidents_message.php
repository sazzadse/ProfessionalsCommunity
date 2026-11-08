<?php
$page_title = "President's Message";
$current_page = "about";

include 'includes/config.php';
include 'includes/header.php';
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    EXECUTIVE LEADERSHIP
                </span>
                <h1 class="hero-title">President's Message</h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    A welcoming address from Md. Fokrul Islam, President of the IT Leadership Community (ITLC).
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <a href="about.php">About Us</a>
                    <span class="sep">/</span>
                    <span class="current">President's Message</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Letter & Executive Card -->
<section class="itlc-content-section">
    <div class="container">
        <div class="row">
            
            <!-- Left Column: Executive Card -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="itlc-card p-4 text-center sticky-top" style="top: 130px; z-index: 10;">
                    <div class="mx-auto mb-3" style="width: 180px; height: 180px; border-radius: 20px; overflow: hidden; border: 4px solid #ffffff; box-shadow: 0 10px 25px rgba(6, 72, 122, 0.15);">
                        <img src="images/members/Md_Fokrul_Islam_President.jpg" alt="Md. Fokrul Islam, President of ITLC" class="w-100 h-100" style="object-fit: cover; object-position: top center;">
                    </div>
                    
                    <span class="badge badge-pill px-3 py-1 font-weight-bold mb-2" style="background: rgba(255, 188, 59, 0.18); color: #b45309; font-size: 11px;">
                        PRESIDENT, ITLC
                    </span>
                    <h4 class="font-weight-bold mb-1" style="color: #06487a; font-size: 20px;">Md. Fokrul Islam</h4>
                    <p class="text-muted small mb-3">PMP®, CISA®</p>
                    
                    <div class="p-3 bg-light rounded-xl mb-3 text-left" style="border-radius: 12px; font-size: 13px; color: #475569;">
                        <i class="fa-solid fa-quote-left text-warning mr-1"></i>
                        <em>"Together, we are shaping the future of technology leadership and national digital resilience in Bangladesh."</em>
                    </div>

                    <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold small">
                        Join the ITLC Community
                    </a>
                </div>
            </div>

            <!-- Right Column: Official Presidential Letter -->
            <div class="col-lg-8">
                <div class="itlc-card p-4 p-md-5">
                    
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="mr-3 text-warning" style="font-size: 32px;">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <h3 class="font-weight-bold mb-1" style="color: #06487a; font-size: 22px;">Dear Fellow Members and Colleagues,</h3>
                            <p class="text-muted small mb-0"><em>Assalamualaikum and Sincere Greetings to all IT leaders and technology professionals,</em></p>
                        </div>
                    </div>

                    <div class="letter-body text-secondary" style="font-size: 15.5px; line-height: 1.85;">
                        <p>
                            It is an honor to serve as the President of the <strong>IT Leadership Community (ITLC)</strong>, a platform dedicated to uniting and empowering IT professionals across Bangladesh and beyond. Our community has grown to connect hundreds of visionary CIOs, CTOs, Heads of IT, and technology directors from renowned local conglomerates and international organizations.
                        </p>

                        <div class="p-4 my-4 rounded-xl" style="background: #f8fafc; border-left: 4px solid #06487a; border-radius: 12px;">
                            <h6 class="font-weight-bold mb-2" style="color: #06487a;">Our Shared Commitment:</h6>
                            <p class="mb-0 text-muted" style="font-size: 14.5px;">
                                At ITLC, our mission is to foster leadership, collaboration, and innovation within the technology ecosystem. We believe firmly in the multiplier effect of shared knowledge and peer mentorship, creating opportunities for our members to excel through executive networking and skill enrichment.
                            </p>
                        </div>

                        <p>
                            By upholding benchmark standards of excellence, we aim to elevate the IT profession and contribute directly to the sustainable growth of Bangladesh's technology landscape. As we navigate an era of unprecedented digital acceleration, the strategic role of IT leaders has never been more critical.
                        </p>

                        <p>
                            ITLC is committed to supporting our members by providing them with the tools, executive frameworks, and collaborative community needed to succeed in an increasingly automated and interconnected world. Whether through workshops, webinars, leadership summits, or specialized action teams, we are here to guide and support one another in achieving transformative outcomes.
                        </p>

                        <p>
                            I warmly invite all IT professionals who share our vision to join us in this journey. Together, we can drive positive change, not only for our profession, but for our society and national economy as a whole.
                        </p>

                        <p class="mb-5">
                            Thank you for your continued trust, dedication, and passion for excellence. I look forward to working alongside all of you to build a tech-powered, innovative future for Bangladesh.
                        </p>
                    </div>

                    <!-- Formal Signature Block -->
                    <div class="pt-4 border-top d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-3 mb-sm-0">
                            <span class="text-muted small d-block">Official Presidential Address</span>
                            <span class="text-primary font-weight-bold small"><i class="fa-solid fa-stamp mr-1"></i>Verified ITLC Seal</span>
                        </div>
                        <div class="text-sm-right">
                            <p class="mb-1 text-muted small">With warm personal regards,</p>
                            <h5 class="font-weight-bold mb-0" style="color: #06487a; font-size: 18px;">Md. Fokrul Islam</h5>
                            <span class="text-muted small">PMP®, CISA®</span><br>
                            <strong class="small" style="color: #06487a;">President, IT Leadership Community (ITLC)</strong>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>
