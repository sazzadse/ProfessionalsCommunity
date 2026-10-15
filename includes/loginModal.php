<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-sm p-4">
            
            <div class="modal-header border-0 pb-0">
                <h4 class="modal-title w-100 text-center" id="loginModalTitle">Welcome to ITLC!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body text-center">
                
                <!-- Login Error Alert -->
                <?php if (isset($_SESSION['error']) && (!isset($_GET['login']) || $_GET['login'] !== 'reset')): ?>
                    <div class="alert alert-<?php echo strpos($_SESSION['error'], 'Success') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show text-center mb-3" role="alert">
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
                    <p class="text-muted mb-4">Please login to your account</p>
                    <form action="includes/login_process.php" method="POST">
                        <input type="email" name="email" class="form-control mb-3 rounded-pill px-3" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-3 rounded-pill px-3" placeholder="Password" required>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">LOGIN</button>
                    </form>
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="javascript:void(0);" class="text-secondary small" id="switchToForgot">Forgot Password?</a>
                        <span class="small text-muted">Not a member? <a href="#" class="text-primary font-weight-bold" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Register now</a></span>
                    </div>
                </div>

                <!-- Forgot Password Section -->
                <div id="forgotSection" style="display: none; opacity: 0; transition: opacity 0.2s ease;">
                    <p class="text-muted mb-4">Enter your email to receive a temporary password</p>

                    <!-- Reset Error Message -->
                    <?php if (isset($_SESSION['reset_error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show text-center mb-3" role="alert">
                            <?php echo htmlspecialchars($_SESSION['reset_error']); unset($_SESSION['reset_error']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <!-- Reset Success Message -->
                    <?php if (isset($_SESSION['reset_success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show text-center mb-3" role="alert">
                            <?php echo $_SESSION['reset_success']; unset($_SESSION['reset_success']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <form action="includes/reset_password.php" method="POST">
                        <input type="email" id="resetEmail" name="email" class="form-control mb-3 rounded-pill px-3" placeholder="Email Address" required>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">SEND TEMPORARY PASSWORD</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="javascript:void(0);" class="text-secondary small" id="switchToLogin">Back to Login</a>
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
            modalTitle.textContent = targetTitle;
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
            forgotSection.style.display = 'none';
            forgotSection.style.opacity = 0;
            loginSection.style.display = 'block';
            loginSection.style.opacity = 1;
            modalTitle.textContent = 'Welcome Back!';
        });

        <?php if (isset($_GET['login'])): ?>
            $('#loginModal').modal('show');
            <?php if ($_GET['login'] === 'reset'): ?>
            setTimeout(function() {
                loginSection.style.display = 'none';
                loginSection.style.opacity = 0;
                forgotSection.style.display = 'block';
                forgotSection.style.opacity = 1;
                modalTitle.textContent = 'Forgot Password';
            }, 100);
            <?php endif; ?>
        <?php endif; ?>
    }
});
</script>