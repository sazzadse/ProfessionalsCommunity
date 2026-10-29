<?php
$page_title = "Membership Fee";
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

    /* Fee Cards matching Registration Modal style */
    .membership-card-box {
        border: 1px solid #ced4da;
        border-bottom: 2px solid #06487a;
        border-radius: 6px;
        padding: 28px 20px;
        text-align: center;
        background: #fff;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .membership-card-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(6, 72, 122, 0.12);
        border-color: #06487a;
    }

    .membership-card-box .tier-title {
        color: #06487a;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .membership-card-box .tier-exp {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 18px;
        min-height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .membership-card-box .tier-price {
        color: #28a745;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 4px;
        line-height: 1;
    }

    .membership-card-box .tier-price span {
        font-size: 16px;
        font-weight: 600;
    }

    .membership-card-box .tier-duration {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 22px;
    }

    /* Payment Guidelines Box */
    .payment-info-box {
        background: #f8fbfd;
        border: 1px solid #dbe7f0;
        border-radius: 6px;
        padding: 25px;
        margin-top: 30px;
    }

    .payment-info-box h5 {
        color: #06487a;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .payment-info-box p {
        color: #06487a;
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 10px;
    }

    .payment-info-box ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .payment-info-box ul li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 8px;
        color: #06487a;
        font-size: 14px;
    }

    .payment-info-box ul li::before {
        content: "";
        position: absolute;
        left: 2px;
        top: 8px;
        width: 8px;
        height: 8px;
        background: #06487a;
        border-radius: 50%;
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

        <!-- Page Header -->
        <div class="row">
            <div class="col-12">
                <h1 class="main-title">Membership Fee</h1>
                <div class="title-accent"></div>
                <p class="section-desc">
                    IT Leadership Community (ITLC) offers structured membership categories tailored to the experience, leadership level, and professional growth of technology professionals across Bangladesh.
                </p>
            </div>
        </div>

        <!-- 4 Membership Fee Categories -->
        <div class="row justify-content-center">

            <!-- Lifetime Member -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="membership-card-box">
                    <div>
                        <h4 class="tier-title">Lifetime Member</h4>
                        <p class="tier-exp">Minimum 15 Years Job Experience</p>
                        <div class="tier-price">
                            20,000 <span>BDT</span>
                        </div>
                        <p class="tier-duration text-center">One Time</p>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block btn-sm py-2">
                            Join Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Professional Member -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="membership-card-box">
                    <div>
                        <h4 class="tier-title">Professional Member</h4>
                        <p class="tier-exp">Minimum 5 Years Job Experience</p>
                        <div class="tier-price">
                            5,000 <span>BDT</span>
                        </div>
                        <p class="tier-duration text-center">Yearly</p>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block btn-sm py-2">
                            Join Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- General Member -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="membership-card-box">
                    <div>
                        <h4 class="tier-title">General Member</h4>
                        <p class="tier-exp">Minimum 2 Years Job Experience</p>
                        <div class="tier-price">
                            1,500 <span>BDT</span>
                        </div>
                        <p class="tier-duration text-center">Yearly</p>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block btn-sm py-2">
                            Join Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Student Member -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="membership-card-box">
                    <div>
                        <h4 class="tier-title">Student Member</h4>
                        <p class="tier-exp">Fresher / Student</p>
                        <div class="tier-price">
                            500 <span>BDT</span>
                        </div>
                        <p class="tier-duration text-center">Yearly</p>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#signupModal" class="btn btn-primary btn-block btn-sm py-2">
                            Join Now
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Payment Instructions & Accounts -->
        <div class="row">
            <div class="col-12">
                <div class="payment-info-box">
                    <h5><i class="ti-credit-card mr-2"></i>Payment Instructions &amp; Accounts</h5>
                    <p>
                        You can pay your membership fee through official ITLC bKash numbers or direct bank transfer. Please retain your <strong>Transaction ID (TrxID)</strong> to submit during registration or update via profile settings:
                    </p>
                    <ul>
                        <li><strong>bKash (Treasurer):</strong> +880 1714 579986</li>
                        <li><strong>bKash (Joint-Treasurer):</strong> +880 1670 105363</li>
                        <li><strong>bKash (Alternative):</strong> +880 1710 817997</li>
                        <li><strong>Bank Account:</strong> Dutch-Bangla Bank Limited (DBBL Account)</li>
                    </ul>
                    <p class="mt-3 mb-0 text-muted" style="font-size: 13px;">
                        <em>*** ITLC Authority reserves the right to amend and update the membership categories and fee structure as necessary for the development of the community.</em>
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>
