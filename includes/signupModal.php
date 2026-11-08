<?php
// Include Central Configuration & Database
require_once __DIR__ . '/config.php';

// Fetch dynamic professions from database
$profession_query = "SELECT id, profession_name FROM profession ORDER BY profession_name ASC";
$profession_result = $conn->query($profession_query);

// Fetch membership types
$membership_query = "SELECT id, membership_name FROM membership_type ORDER BY id ASC";
$membership_result = $conn->query($membership_query);
?>

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 p-4 p-md-5 position-relative overflow-hidden">
            
            <!-- Top Gold Decorative Accent -->
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #ffbc3b, #06487a);"></div>

            <div class="modal-header border-0 pb-0 pt-2 position-relative">
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="top: 0; right: 0; outline: none;">
                    <span aria-hidden="true" style="font-size: 24px; color: #94a3b8;">&times;</span>
                </button>
                <div class="w-100 text-center">
                    <span class="badge badge-pill px-3 py-1 mb-2" style="background: rgba(255, 188, 59, 0.15); color: #b45309; font-weight: 700; font-size: 11px;">
                        EXECUTIVE NETWORK
                    </span>
                    <h4 class="modal-title font-weight-bold" style="color: #06487a; font-size: 24px;">Apply for ITLC Membership</h4>
                    <p class="text-muted small mb-3">Join the premier platform of CIOs, CTOs, and IT Leaders across Bangladesh</p>
                </div>
            </div>

            <div class="modal-body pt-2">
                
                <!-- Alerts -->
                <?php 
                $signup_error = $_SESSION['signup_error'] ?? (isset($_GET['signup']) && $_GET['signup'] === 'error' ? ($_SESSION['error'] ?? null) : null);
                if ($signup_error): 
                ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center mb-4" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                        <strong>Notice:</strong> <?php echo htmlspecialchars($signup_error); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php 
                    unset($_SESSION['signup_error']); 
                    if (isset($_SESSION['error']) && isset($_GET['signup'])) {
                        unset($_SESSION['error']);
                    }
                    ?>
                <?php endif; ?>

                <?php 
                $signup_success = $_SESSION['signup_success'] ?? (isset($_GET['signup']) && $_GET['signup'] === 'success' ? ($_SESSION['success'] ?? null) : null);
                if ($signup_success): 
                ?>
                    <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                        <strong>Success!</strong> <?php echo htmlspecialchars($signup_success); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php 
                    unset($_SESSION['signup_success']); 
                    if (isset($_SESSION['success']) && isset($_GET['signup'])) {
                        unset($_SESSION['success']);
                    }
                    ?>
                <?php endif; ?>

                <form action="includes/signup_process.php" method="POST" id="itlcSignupForm">
                    
                    <div class="row">
                        <!-- Left Column: Personal & Company -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupName" name="full_name" placeholder="Md. Full Name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control rounded-pill px-3" id="signupEmail" name="email" placeholder="name@domain.com" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Create Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control rounded-pill px-3" id="signupPassword" name="password" placeholder="Minimum 6 characters" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Mobile / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupMobile" name="mobile" placeholder="+880 1XXXXXXXXX" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Company / Organization</label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupCompany" name="company" placeholder="e.g. Grameenphone, Beximco, Bank Asia">
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Company Address</label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupCompanyAddress" name="company_address" placeholder="Gulshan, Dhaka - 1212">
                            </div>
                        </div>

                        <!-- Right Column: Professional Qualifications -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Current Position / Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupPosition" name="position" placeholder="e.g. CIO, CTO, Head of IT, IT Manager" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Primary Profession / Domain <span class="text-danger">*</span></label>
                                <select class="form-control rounded-pill px-3" id="signupProfession" name="profession_id" style="height: 48px;" required>
                                    <option value="" disabled selected hidden>Select Professional Discipline</option>
                                    <?php
                                    if ($profession_result && $profession_result->num_rows > 0) {
                                        while($row = $profession_result->fetch_assoc()) {
                                            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['profession_name']) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Highest Education</label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupHighestEducation" name="highest_education" placeholder="e.g. B.Sc in CSE, M.Sc, MBA">
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">Certifications</label>
                                <input type="text" class="form-control rounded-pill px-3" id="signupCertification" name="certification" placeholder="e.g. CISSP, CISA, PMP, AWS, TOGAF">
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark mb-1">LinkedIn Profile Link</label>
                                <input type="url" class="form-control rounded-pill px-3" id="signupLinkedin" name="linkedin_url" placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>
                    </div>

                    <style>
                    .membership-tier-card {
                        border: 1.5px solid #e2e8f0;
                        border-radius: 12px;
                        padding: 18px 12px;
                        text-align: center;
                        cursor: pointer;
                        transition: all 0.25s ease;
                        background: #ffffff;
                        position: relative;
                    }
                    .membership-tier-card:hover {
                        border-color: #ffbc3b;
                        box-shadow: 0 8px 20px rgba(6, 72, 122, 0.08);
                        transform: translateY(-2px);
                    }
                    .membership-radio:checked + .membership-tier-card {
                        border: 2px solid #06487a;
                        background-color: #f8fafc;
                        box-shadow: 0 8px 24px rgba(6, 72, 122, 0.12);
                    }
                    .membership-radio:checked + .membership-tier-card::after {
                        content: "✓";
                        position: absolute;
                        top: 8px;
                        right: 8px;
                        width: 20px;
                        height: 20px;
                        border-radius: 50%;
                        background: #06487a;
                        color: #ffffff;
                        font-size: 11px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: bold;
                    }
                    </style>

                    <!-- Membership Category Selection -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="text-center mb-3">
                                <h6 class="font-weight-bold mb-1" style="color: #06487a; font-size: 16px;">Select Membership Tier <span class="text-danger">*</span></h6>
                                <p class="text-muted small mb-0">Choose the tier matching your career seniority</p>
                            </div>

                            <div class="row">
                                <!-- Lifetime Member -->
                                <div class="col-md-3 col-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem1" value="1" class="d-none membership-radio" required>
                                    <label for="mem1" class="membership-tier-card d-block mb-0 h-100">
                                        <h6 class="mb-1 font-weight-bold text-dark" style="font-size: 13.5px;">Lifetime</h6>
                                        <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.3;">15+ Years Experience</p>
                                        <div class="font-weight-bold" style="color: #06487a; font-size: 16px;">
                                            20,000 <span style="font-size: 11px;">BDT</span>
                                        </div>
                                        <span class="badge badge-light text-muted mt-1" style="font-size: 10px;">One-Time</span>
                                    </label>
                                </div>

                                <!-- Professional Member -->
                                <div class="col-md-3 col-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem2" value="2" class="d-none membership-radio" required>
                                    <label for="mem2" class="membership-tier-card d-block mb-0 h-100">
                                        <h6 class="mb-1 font-weight-bold text-dark" style="font-size: 13.5px;">Professional</h6>
                                        <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.3;">5+ Years Experience</p>
                                        <div class="font-weight-bold" style="color: #06487a; font-size: 16px;">
                                            5,000 <span style="font-size: 11px;">BDT</span>
                                        </div>
                                        <span class="badge badge-light text-muted mt-1" style="font-size: 10px;">Yearly</span>
                                    </label>
                                </div>

                                <!-- General Member -->
                                <div class="col-md-3 col-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem3" value="3" class="d-none membership-radio" required>
                                    <label for="mem3" class="membership-tier-card d-block mb-0 h-100">
                                        <h6 class="mb-1 font-weight-bold text-dark" style="font-size: 13.5px;">General</h6>
                                        <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.3;">2+ Years Experience</p>
                                        <div class="font-weight-bold" style="color: #06487a; font-size: 16px;">
                                            1,500 <span style="font-size: 11px;">BDT</span>
                                        </div>
                                        <span class="badge badge-light text-muted mt-1" style="font-size: 10px;">Yearly</span>
                                    </label>
                                </div>

                                <!-- Student Member -->
                                <div class="col-md-3 col-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem4" value="4" class="d-none membership-radio" required>
                                    <label for="mem4" class="membership-tier-card d-block mb-0 h-100">
                                        <h6 class="mb-1 font-weight-bold text-dark" style="font-size: 13.5px;">Student</h6>
                                        <p class="text-muted mb-2" style="font-size: 11px; line-height: 1.3;">Fresh Graduate / Intern</p>
                                        <div class="font-weight-bold" style="color: #06487a; font-size: 16px;">
                                            500 <span style="font-size: 11px;">BDT</span>
                                        </div>
                                        <span class="badge badge-light text-muted mt-1" style="font-size: 10px;">Yearly</span>
                                    </label>
                                </div>
                            </div>

                            <div id="membershipError" class="text-danger mt-1 text-center small font-weight-bold" style="display:none;">
                                Please select a Membership Tier to continue.
                            </div>
                        </div>
                    </div>

                    <!-- Terms agreement -->
                    <div class="form-group text-center my-3">
                        <div class="custom-control custom-checkbox d-inline-block">
                            <input type="checkbox" class="custom-control-input" id="termsCheck" required>
                            <label class="custom-control-label small text-muted" for="termsCheck">
                                I confirm I meet the criteria and agree to the 
                                <a href="#" class="font-weight-bold text-primary" data-toggle="modal" data-target="#termsModal">ITLC Terms & Conditions</a>
                            </label>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 font-weight-bold" style="font-size: 14px; min-width: 240px;">
                            SUBMIT APPLICATION
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <span class="small text-muted">
                            Already registered as an ITLC Member?
                            <a href="#" class="text-primary font-weight-bold ml-1" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login here</a>
                        </span>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 p-4" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0 position-relative">
                <h5 class="modal-title w-100 text-center font-weight-bold" style="color: #06487a;">ITLC Membership Terms & Guidelines</h5>
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="right: 1rem; top: 1rem; outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-left text-dark pr-2 mt-2" style="line-height: 1.6; font-size: 13.5px; max-height: 400px; overflow-y: auto;">
                <ul class="list-unstyled pl-0 mb-0">
                    <li class="mb-3 pl-3" style="border-left: 3px solid #06487a;">
                        <strong class="text-dark">Eligible Positions:</strong> CIO, CTO, Head of IT, IT Managers, and Project Managers (IT/Software/ERP) with 10+ years of overall experience, including a minimum of 3+ years of managerial experience as an IT Leader.
                    </li>
                    <li class="mb-3 pl-3" style="border-left: 3px solid #ffbc3b;">
                        <strong class="text-dark">Exclusions:</strong> Non-Technical Persons, Sales, Pre-Sales, and Technical Pre-Sales roles are not permitted to join ITLC.
                    </li>
                    <li class="mb-3 pl-3" style="border-left: 3px solid #06487a;">
                        <strong class="text-dark">Verification Process:</strong> ITLC organizers will conduct thorough verification of each applicant by a dedicated team, retaining the right to deny any membership request that does not meet the ITLC Membership Criteria.
                    </li>
                    <li class="mb-3 pl-3" style="border-left: 3px solid #ffbc3b;">
                        <strong class="text-dark">Communication Guidelines:</strong> Advertisement & sales-related posts, posts related to religion, politics, other communities, societies, forums, and any contradictory issues are strictly prohibited in ITLC communication channels. The administrator holds the right to delete such posts if they go against this guideline.
                    </li>
                    <li class="mb-3 pl-3" style="border-left: 3px solid #06487a;">
                        <strong class="text-dark">Enforcement of Policies:</strong> If any member is found engaged in sales or marketing activities within the ITLC, his or her membership will be revoked upon verified reports from ITLC members, ensuring the ITLC's integrity and focus on professional development.
                    </li>
                    <li class="mb-0 text-muted small">
                        <em>*** The ITLC Authority reserves the right to amend and update the Terms and Conditions as required for the betterment of the community.</em>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.jQuery) {
        $(document).on('hidden.bs.modal', '.modal', function () {
            if ($('.modal:visible').length) {
                $(document.body).addClass('modal-open');
            }
        });

        <?php if (isset($_GET['signup'])): ?>
        $('#signupModal').modal('show');
        <?php endif; ?>
    }
});

const membershipRadios = document.querySelectorAll(
    '#signupModal input[name="membership_type_id"]'
);
const membershipError = document.getElementById('membershipError');

membershipRadios.forEach(radio => {
    radio.addEventListener('invalid', function () {
        if (membershipError) membershipError.style.display = 'block';
    });

    radio.addEventListener('change', function () {
        if (membershipError) membershipError.style.display = 'none';
    });
});
</script>
