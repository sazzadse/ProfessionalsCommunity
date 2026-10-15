<?php
// 1. INCLUDE THE CENTRAL CONFIGURATION
// This automatically includes db.php (database connection) and all global variables
require_once __DIR__ . '/config.php';

// Fetch dynamic professions from the database using the connection ($conn) established in db.php
$profession_query = "SELECT id, profession_name FROM profession ORDER BY id ASC";
$profession_result = $conn->query($profession_query);

// Fetch membership types
$membership_query = "SELECT id, membership_name FROM membership_type ORDER BY id ASC";
$membership_result = $conn->query($membership_query);
?>

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-sm p-4">
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title w-100 text-center">Create Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted text-center mb-4">Join our IT Leadership Community!</p>
                
                <!-- ADD ALERTS HERE -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center mb-3" role="alert">
                        <strong>Notice:</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show text-center mb-3" role="alert">
                        <strong>Success!</strong> <?php echo htmlspecialchars($_SESSION['success']); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form action="includes/signup_process.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupName" name="full_name" placeholder="Full Name" required>
                            <input type="email" class="form-control mb-3 rounded-pill px-3" id="signupEmail" name="email" placeholder="Email Address" required>
                            <input type="password" class="form-control mb-3 rounded-pill px-3" id="signupPassword" name="password" placeholder="Create Password" required>
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupMobile" name="mobile" placeholder="Mobile Number" required>
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupCompany" name="company" placeholder="Company Name">
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupCompanyAddress" name="company_address" placeholder="Company Address">
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupPosition" name="position" placeholder="Current Position (e.g., CIO, CTO)" required>
                            
                            <select class="form-control mb-3 rounded-pill px-3" id="signupProfession" name="profession_id" style="height: 60px;" required>
                                <option value="" disabled selected hidden>Select Profession</option>
                                <?php
                                if ($profession_result && $profession_result->num_rows > 0) {
                                    while($row = $profession_result->fetch_assoc()) {
                                        echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['profession_name']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            

                            
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupHighestEducation" name="highest_education" placeholder="Highest Education">
                            <input type="text" class="form-control mb-3 rounded-pill px-3" id="signupCertification" name="certification" placeholder="Professional Certification">
                            <input type="url" class="form-control mb-3 rounded-pill px-3" id="signupLinkedin" name="linkedin_url" placeholder="LinkedIn Profile Link">
                        </div>
                    </div>

                    <style>
                    .membership-card {
                        border: 1px solid #ced4da;
                        border-radius: 6px;
                        padding: 20px 15px;
                        text-align: center;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        background: #fff;
                    }
                    .membership-card:hover {
                        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
                    }
                    .membership-radio:checked + .membership-card {
                        border: 1.5px solid #06487a;
                        background-color: #f8fbfd;
                    }
                    </style>

                    <div class="row">
                        <div class="col-12 mt-4">
                            <h5 class="mb-3 text-center" style="color: #06487a; font-weight: 500;">Membership & Payment</h5>
                            <p class="text-muted mb-4 text-center" style="font-size: 14px;">Select Membership Category <span class="text-danger">*</span></p>
                            
                            <div class="row justify-content-center">
                                <!-- Lifetime Member -->
                                <div class="col-md-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem1" value="1" class="d-none membership-radio" required>
                                    <label for="mem1" class="membership-card d-block mb-0 h-100 px-4 py-3">
                                        <div class="text-center">
                                            <h6 style="color: #06487a; font-weight: 600; font-size: 15px;" class="mb-1">Lifetime Member</h6>
                                        </div>
                                        <p class="text-muted small mb-2 text-center">Minimum 15 Years Job Experience</p>
                                        <div class="text-center">
                                            <h3 class="mb-0" style="color: #28a745; font-weight: 700;">20,000 <span style="font-size: 16px; font-weight: 600;">BDT</span></h3>
                                        </div>
                                        <p class="text-muted small mb-0 text-center">One Time</p>
                                    </label>
                                </div>

                                <!-- Professional Member -->
                                <div class="col-md-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem2" value="2" class="d-none membership-radio" required>
                                    <label for="mem2" class="membership-card d-block mb-0 h-100 px-4 py-3">
                                        <div class="text-center">
                                            <h6 style="color: #06487a; font-weight: 600; font-size: 15px;" class="mb-1">Professional Member</h6>
                                        </div>
                                        <p class="text-muted small mb-2 text-center">Minimum 5 Years Job Experience</p>
                                        <div class="text-center">
                                            <h3 class="mb-0" style="color: #28a745; font-weight: 700;">5,000 <span style="font-size: 16px; font-weight: 600;">BDT</span></h3>
                                        </div>
                                        <p class="text-muted small mb-0 text-center">Yearly</p>
                                    </label>
                                </div>

                                <!-- General Member -->
                                <div class="col-md-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem3" value="3" class="d-none membership-radio" required>
                                    <label for="mem3" class="membership-card d-block mb-0 h-100 px-4 py-3">
                                        <div class="text-center">
                                            <h6 style="color: #06487a; font-weight: 600; font-size: 15px;" class="mb-1">General Member</h6>
                                        </div>
                                        <p class="text-muted small mb-2 text-center">Minimum 2 Years Job Experience</p>
                                        <div class="text-center">
                                            <h3 class="mb-0" style="color: #28a745; font-weight: 700;">1,500 <span style="font-size: 16px; font-weight: 600;">BDT</span></h3>
                                        </div>
                                        <p class="text-muted small mb-0 text-center">Yearly</p>
                                    </label>
                                </div>

                                <!-- Student Member -->
                                <div class="col-md-6 mb-3">
                                    <input type="radio" name="membership_type_id" id="mem4" value="4" class="d-none membership-radio" required>
                                    <label for="mem4" class="membership-card d-block mb-0 h-100 px-4 py-3">
                                        <div class="text-center">
                                            <h6 style="color: #06487a; font-weight: 600; font-size: 15px;" class="mb-1">Student Member</h6>
                                        </div>
                                        <p class="text-muted small mb-2 text-center">Fresher</p>
                                        <div class="text-center">
                                            <h3 class="mb-0" style="color: #28a745; font-weight: 700;">500 <span style="font-size: 16px; font-weight: 600;">BDT</span></h3>
                                        </div>
                                        <p class="text-muted small mb-0 text-center">Yearly</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center my-4">
                        <div class="custom-control custom-checkbox d-inline-block">
                            <input type="checkbox" class="custom-control-input" id="termsCheck" required>
                            <label class="custom-control-label small text-muted" for="termsCheck">
                                I understand and agree to the 
                                <a href="#" class="font-weight-bold" data-toggle="modal" data-target="#termsModal">Terms & Conditions</a>
                            </label>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill mt-2 mx-auto" style="max-width: 300px;">SIGN UP</button>
                    </div>

                    <div class="text-center mt-4">
                        <label class="small text-muted">
                            Already have an account?
                            <a href="#" class="text-primary" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login here</a>
                        </label>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow p-4">
            <div class="modal-header border-0 pb-0 position-relative">
                <h4 class="modal-title w-100 text-center text-dark font-weight-normal pb-3" style="border-bottom: 1px solid #dee2e6;">IT Leadership Community (ITLC)</h4>
                <button type="button" class="close position-absolute text-dark" data-dismiss="modal" aria-label="Close" style="right: 1.5rem; top: 1rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-left text-dark pr-2" style="line-height: 1.6; font-size: 0.9rem; max-height: 380px; overflow-y: auto;">
                <ul class="list-unstyled pl-0 mb-0">
                    <li class="mb-3 position-relative pl-4">
                        <span class="position-absolute text-dark font-weight-bold" style="left: 5px; top: 0px;">*</span>
                        <strong class="text-dark">Eligible Positions:</strong> CIO, CTO, Head of IT, IT Managers, and Project Managers (IT/Software/ERP) with 10+ years of overall experience, including a minimum of 3+ years of managerial experience as an IT Leader.
                    </li>
                    <li class="mb-3 position-relative pl-4">
                        <span class="position-absolute text-dark font-weight-bold" style="left: 5px; top: 0px;">*</span>
                        <strong class="text-dark">Exclusions:</strong> Non-Technical Persons, Sales, Pre-Sales, and Technical Pre-Sales roles are not permitted to join ITLC.
                    </li>
                    <li class="mb-3 position-relative pl-4">
                        <span class="position-absolute text-dark font-weight-bold" style="left: 5px; top: 0px;">*</span>
                        <strong class="text-dark">Verification Process:</strong> ITLC organizers will conduct thorough verification of each applicant by a dedicated team, retaining the right to deny any membership request that does not meet the ITLC Membership Criteria.
                    </li>
                    <li class="mb-3 position-relative pl-4">
                        <span class="position-absolute text-dark font-weight-bold" style="left: 5px; top: 0px;">*</span>
                        <strong class="text-dark">Communication Guidelines:</strong> Advertisement & sales-related posts, posts related to religion, politics, other communities, societies, forums, and any contradictory issues are strictly prohibited in ITLC communication channels. The administrator holds the right to delete such posts if they go against this guideline.
                    </li>
                    <li class="mb-3 position-relative pl-4">
                        <span class="position-absolute text-dark font-weight-bold" style="left: 5px; top: 0px;">*</span>
                        <strong class="text-dark">Enforcement of Policies:</strong> If any member is found engaged in sales or marketing activities within the ITLC, his or her membership will be revoked upon verified reports from ITLC members, ensuring the ITLC's integrity and focus on professional development.
                    </li>
                    <li class="mb-0 position-relative pl-4">
                        <strong class="text-dark">*** ITLC Authority can change and update the Terms and Conditions if needed for the betterment of ITLC.</strong>
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
    }
});
</script>