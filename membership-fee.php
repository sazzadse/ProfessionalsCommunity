<?php
$page_title = "Membership Fee Structure";
$current_page = "membership";

include 'includes/config.php';
include 'includes/header.php';
?>

<!-- Modern Page Hero Banner -->
<section class="itlc-page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge badge-pill px-3 py-1 mb-2 font-weight-bold text-uppercase" style="background: rgba(255, 188, 59, 0.2); color: #ffbc3b; font-size: 11px;">
                    TRANSPARENT PRICING
                </span>
                <h1 class="hero-title">Membership Fee Structure</h1>
                <div class="hero-accent-bar"></div>
                <p class="hero-subtitle">
                    Structured membership categories tailored to your career seniority, leadership scope, and professional aspirations.
                </p>
                <div class="itlc-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="sep">/</span>
                    <a href="membership-criteria.php">Membership</a>
                    <span class="sep">/</span>
                    <span class="current">Fees</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Cards Section -->
<section class="itlc-content-section">
    <div class="container">
        
        <div class="text-center max-w-2xl mx-auto mb-5">
            <h3 class="font-weight-bold mb-2" style="color: #06487a; font-size: 26px;">Choose Your Membership Tier</h3>
            <p class="text-muted small mb-0">Transparent annual and one-time fees dedicated to powering community programs and summits.</p>
        </div>

        <!-- 4 Pricing Cards -->
        <div class="row justify-content-center mb-5">

            <!-- Lifetime Member (Highlighted Tier) -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="itlc-card h-100 p-4 text-center d-flex flex-column position-relative" style="border: 2px solid #ffbc3b; box-shadow: 0 16px 35px -8px rgba(255, 188, 59, 0.25);">
                    <div class="position-absolute" style="top: -12px; left: 50%; transform: translateX(-50%);">
                        <span class="badge badge-pill px-3 py-1 font-weight-bold text-uppercase" style="background: linear-gradient(135deg, #ffbc3b, #f59e0b); color: #021424; font-size: 10px; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);">
                            MOST PRESTIGIOUS
                        </span>
                    </div>

                    <div class="pt-2 mb-3">
                        <h4 class="font-weight-bold mb-1" style="color: #06487a; font-size: 20px;">Lifetime</h4>
                        <span class="text-muted small font-weight-bold">15+ Years Job Experience</span>
                    </div>

                    <div class="my-3 py-3 border-top border-bottom">
                        <h2 class="font-weight-bold mb-0" style="color: #06487a; font-size: 32px;">20,000 <span style="font-size: 14px; font-weight: 600;">BDT</span></h2>
                        <span class="text-muted small font-weight-bold text-uppercase">One-Time Contribution</span>
                    </div>

                    <ul class="list-unstyled text-left small text-muted mb-4 space-y-2 flex-grow-1" style="line-height: 1.8;">
                        <li><i class="fa-solid fa-circle-check text-warning mr-2"></i>Lifetime verified directory badge</li>
                        <li><i class="fa-solid fa-circle-check text-warning mr-2"></i>VIP priority at annual summits</li>
                        <li><i class="fa-solid fa-circle-check text-warning mr-2"></i>Permanent executive voting right</li>
                        <li><i class="fa-solid fa-circle-check text-warning mr-2"></i>Special advisory privileges</li>
                    </ul>

                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold">
                            Apply Lifetime
                        </a>
                    </div>
                </div>
            </div>

            <!-- Professional Member -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="itlc-card h-100 p-4 text-center d-flex flex-column" style="border-top: 4px solid #06487a;">
                    <div class="mb-3">
                        <h4 class="font-weight-bold mb-1" style="color: #06487a; font-size: 20px;">Professional</h4>
                        <span class="text-muted small font-weight-bold">5+ Years Job Experience</span>
                    </div>

                    <div class="my-3 py-3 border-top border-bottom">
                        <h2 class="font-weight-bold mb-0" style="color: #06487a; font-size: 32px;">5,000 <span style="font-size: 14px; font-weight: 600;">BDT</span></h2>
                        <span class="text-muted small font-weight-bold text-uppercase">Annual Renewal</span>
                    </div>

                    <ul class="list-unstyled text-left small text-muted mb-4 space-y-2 flex-grow-1" style="line-height: 1.8;">
                        <li><i class="fa-solid fa-circle-check text-success mr-2"></i>Full directory listing</li>
                        <li><i class="fa-solid fa-circle-check text-success mr-2"></i>Access to masterclasses & webinars</li>
                        <li><i class="fa-solid fa-circle-check text-success mr-2"></i>Peer executive networking</li>
                        <li><i class="fa-solid fa-circle-check text-success mr-2"></i>Eligibility for action committees</li>
                    </ul>

                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline btn-block rounded-pill py-2 font-weight-bold">
                            Apply Professional
                        </a>
                    </div>
                </div>
            </div>

            <!-- General Member -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="itlc-card h-100 p-4 text-center d-flex flex-column" style="border-top: 4px solid #0d5c99;">
                    <div class="mb-3">
                        <h4 class="font-weight-bold mb-1" style="color: #06487a; font-size: 20px;">General</h4>
                        <span class="text-muted small font-weight-bold">2+ Years Job Experience</span>
                    </div>

                    <div class="my-3 py-3 border-top border-bottom">
                        <h2 class="font-weight-bold mb-0" style="color: #06487a; font-size: 32px;">1,500 <span style="font-size: 14px; font-weight: 600;">BDT</span></h2>
                        <span class="text-muted small font-weight-bold text-uppercase">Annual Renewal</span>
                    </div>

                    <ul class="list-unstyled text-left small text-muted mb-4 space-y-2 flex-grow-1" style="line-height: 1.8;">
                        <li><i class="fa-solid fa-circle-check text-info mr-2"></i>Community directory profile</li>
                        <li><i class="fa-solid fa-circle-check text-info mr-2"></i>Knowledge sharing webinars</li>
                        <li><i class="fa-solid fa-circle-check text-info mr-2"></i>Mentorship access</li>
                        <li><i class="fa-solid fa-circle-check text-info mr-2"></i>Digital badge & certificate</li>
                    </ul>

                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline btn-block rounded-pill py-2 font-weight-bold">
                            Apply General
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Member -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="itlc-card h-100 p-4 text-center d-flex flex-column" style="border-top: 4px solid #64748b;">
                    <div class="mb-3">
                        <h4 class="font-weight-bold mb-1" style="color: #06487a; font-size: 20px;">Student</h4>
                        <span class="text-muted small font-weight-bold">Fresher / Undergrad</span>
                    </div>

                    <div class="my-3 py-3 border-top border-bottom">
                        <h2 class="font-weight-bold mb-0" style="color: #06487a; font-size: 32px;">500 <span style="font-size: 14px; font-weight: 600;">BDT</span></h2>
                        <span class="text-muted small font-weight-bold text-uppercase">Annual Renewal</span>
                    </div>

                    <ul class="list-unstyled text-left small text-muted mb-4 space-y-2 flex-grow-1" style="line-height: 1.8;">
                        <li><i class="fa-solid fa-circle-check text-secondary mr-2"></i>Student portal access</li>
                        <li><i class="fa-solid fa-circle-check text-secondary mr-2"></i>Career orientation sessions</li>
                        <li><i class="fa-solid fa-circle-check text-secondary mr-2"></i>Direct IT executive Q&A</li>
                        <li><i class="fa-solid fa-circle-check text-secondary mr-2"></i>Internship referral alerts</li>
                    </ul>

                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary-outline btn-block rounded-pill py-2 font-weight-bold">
                            Apply Student
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Payment Instructions & Accounts Info -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="itlc-card p-4 p-md-5 bg-surface">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 text-warning" style="font-size: 26px;">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                        <h4 class="font-weight-bold mb-0" style="color: #06487a; font-size: 20px;">Official Payment Channels & Instructions</h4>
                    </div>
                    
                    <p class="text-muted small mb-4" style="line-height: 1.8;">
                        You can pay your membership contribution via official ITLC bKash merchant/personal numbers or through direct bank deposit. Please retain your <strong>Transaction Number (TrxID)</strong> to submit during registration or update in your profile settings:
                    </p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                                <span class="badge badge-pill badge-danger font-weight-bold mb-1" style="background: #e2136e;">bKash Channel 1</span>
                                <h6 class="font-weight-bold text-dark mb-1">Treasurer Account</h6>
                                <p class="text-muted mb-0 font-weight-bold" style="font-size: 15px;">+880 1714 579986</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                                <span class="badge badge-pill badge-danger font-weight-bold mb-1" style="background: #e2136e;">bKash Channel 2</span>
                                <h6 class="font-weight-bold text-dark mb-1">Joint-Treasurer Account</h6>
                                <p class="text-muted mb-0 font-weight-bold" style="font-size: 15px;">+880 1670 105363</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                                <span class="badge badge-pill badge-danger font-weight-bold mb-1" style="background: #e2136e;">bKash Channel 3</span>
                                <h6 class="font-weight-bold text-dark mb-1">Alternative Support</h6>
                                <p class="text-muted mb-0 font-weight-bold" style="font-size: 15px;">+880 1710 817997</p>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-white rounded-lg border h-100" style="border-radius: 12px;">
                                <span class="badge badge-pill badge-primary font-weight-bold mb-1" style="background: #004b93;">Bank Transfer</span>
                                <h6 class="font-weight-bold text-dark mb-1">Dutch-Bangla Bank Limited (DBBL)</h6>
                                <p class="text-muted mb-0 small">Account details provided during registration verification</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-muted small">
                        <em>*** The ITLC Authority reserves the right to review and adjust fee structures periodically as approved by the Executive Committee.</em>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>
