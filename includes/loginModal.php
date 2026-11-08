<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
        <div class="modal-content border-0 p-4 p-sm-5 position-relative overflow-hidden">
            
            <!-- Top Gold Decorative Accent -->
            <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #ffbc3b, #06487a);"></div>

            <div class="modal-header border-0 pb-0 pt-2 position-relative">
                <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="top: 0; right: 0; outline: none;">
                    <span aria-hidden="true" style="font-size: 24px; color: #94a3b8;">&times;</span>
                </button>
                <div class="w-100 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; border-radius: 50%; background: rgba(6, 72, 122, 0.08); color: #06487a; font-size: 20px;">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h4 class="modal-title font-weight-bold" id="loginModalTitle" style="color: #06487a; font-size: 22px;">Welcome to ITLC!</h4>
                </div>
            </div>
            
            <div class="modal-body text-center pt-2">
                
                <!-- Login Error Alert -->
                <?php if (isset($_SESSION['error']) && !isset($_GET['signup']) && (!isset($_GET['login']) || $_GET['login'] !== 'reset')): ?>
                    <div class="alert alert-<?php echo strpos($_SESSION['error'], 'Success') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show text-center mb-3" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                        <?php 
                            $msg = $_SESSION['error'];
                            if (strpos($msg, 'Success:') === 0) {
                                echo '<strong>Success!</strong> ' . htmlspecialchars(substr($msg, 8));
                            } else {
                                echo '<strong>Notice:</strong> ' . htmlspecialchars($msg);
                            }
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Login Section -->
                <div id="loginSection">
                    <p class="text-muted small mb-4">Please log in to access your member dashboard</p>
                    <form action="includes/login_process.php" method="POST">
                        <div class="form-group mb-3 text-left">
                            <label class="small font-weight-bold text-dark mb-1">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-pill px-3" placeholder="name@domain.com" required style="font-size: 14px;">
                        </div>
                        <div class="form-group mb-4 text-left">
                            <label class="small font-weight-bold text-dark mb-1">Password</label>
                            <input type="password" name="password" class="form-control rounded-pill px-3" placeholder="••••••••" required style="font-size: 14px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold" style="font-size: 14px; letter-spacing: 0.3px;">LOG IN</button>
                    </form>
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0);" class="text-secondary small font-weight-bold" id="switchToForgot">Forgot Password?</a>
                        <span class="small text-muted">Not a member? <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Apply now</a></span>
                    </div>
                </div>

                <!-- Forgot Password Section -->
                <div id="forgotSection" style="display: none; opacity: 0; transition: opacity 0.2s ease;">
                    <p class="text-muted small mb-4">Enter your registered email to receive a temporary password</p>

                    <!-- Reset Error Message -->
                    <?php if (isset($_SESSION['reset_error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show text-center mb-3" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                            <?php echo htmlspecialchars($_SESSION['reset_error']); unset($_SESSION['reset_error']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <!-- Reset Success Message -->
                    <?php if (isset($_SESSION['reset_success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show text-center mb-3" role="alert" style="border-radius: 12px; font-size: 13.5px;">
                            <?php echo $_SESSION['reset_success']; unset($_SESSION['reset_success']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <form action="includes/reset_password.php" method="POST">
                        <div class="form-group mb-4 text-left">
                            <label class="small font-weight-bold text-dark mb-1">Registered Email Address</label>
                            <input type="email" id="resetEmail" name="email" class="form-control rounded-pill px-3" placeholder="name@domain.com" required style="font-size: 14px;">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill py-2 font-weight-bold" style="font-size: 14px;">SEND TEMPORARY PASSWORD</button>
                    </form>
                    <div class="mt-4 text-center">
                        <a href="javascript:void(0);" class="text-secondary small font-weight-bold" id="switchToLogin"><i class="fa-solid fa-arrow-left mr-1"></i>Back to Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const loginSection = document.getElementById('loginSection');
    const forgotSection = document.getElementById('forgotSection');
    const modalTitle = document.getElementById('loginModalTitle');
    const switchToForgot = document.getElementById('switchToForgot');
    const switchToLogin = document.getElementById('switchToLogin');

    function switchView(hideView, showView, targetTitle) {
        hideView.style.opacity = 0;
        setTimeout(() => {
            hideView.style.display = 'none';
            if (modalTitle) modalTitle.textContent = targetTitle;
            showView.style.display = 'block';
            setTimeout(() => {
                showView.style.opacity = 1;
            }, 20);
        }, 200);
    }

    if (switchToForgot) {
        switchToForgot.addEventListener('click', function() {
            switchView(loginSection, forgotSection, 'Forgot Password');
        });
    }

    if (switchToLogin) {
        switchToLogin.addEventListener('click', function() {
            switchView(forgotSection, loginSection, 'Welcome Back!');
        });
    }

    if (window.jQuery) {
        $('#loginModal').on('hidden.bs.modal', function () {
            if (forgotSection) {
                forgotSection.style.display = 'none';
                forgotSection.style.opacity = 0;
            }
            if (loginSection) {
                loginSection.style.display = 'block';
                loginSection.style.opacity = 1;
            }
            if (modalTitle) modalTitle.textContent = 'Welcome Back!';
        });

        <?php if (isset($_GET['login'])): ?>
            $('#loginModal').modal('show');
            <?php if ($_GET['login'] === 'reset'): ?>
            setTimeout(function() {
                if (loginSection) {
                    loginSection.style.display = 'none';
                    loginSection.style.opacity = 0;
                }
                if (forgotSection) {
                    forgotSection.style.display = 'block';
                    forgotSection.style.opacity = 1;
                }
                if (modalTitle) modalTitle.textContent = 'Forgot Password';
            }, 100);
            <?php endif; ?>
        <?php endif; ?>
    }
});
</script>
