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
                
                <?php if (isset($_SESSION['error']) && isset($_GET['login'])): ?>
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

                <div id="forgotSection" style="display: none; padding: 10px 20px;">
                    <p class="text-muted text-center mb-4" style="font-size: 14px;">Enter your email address and we'll send you a reset code.</p>

                    <?php if (isset($_SESSION['reset_error']) && isset($_GET['login']) && $_GET['login'] === 'reset'): ?>
                        <div class="alert alert-danger alert-dismissible fade show text-left mb-3" role="alert" style="font-size: 13px;">
                            <?php echo htmlspecialchars($_SESSION['reset_error']); unset($_SESSION['reset_error']); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['reset_success']) && isset($_GET['login']) && $_GET['login'] === 'reset'): ?>
                        <div class="alert alert-success alert-dismissible fade show text-left mb-3" role="alert" style="font-size: 13px;">
                            <?php echo $_SESSION['reset_success']; unset($_SESSION['reset_success']); ?>
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <form action="includes/reset_password.php" method="POST" class="text-left">
                        <div class="form-group mb-4">
                            <label for="resetEmail" class="text-secondary" style="font-size: 14px;">Email Address</label>
                            <input type="email" id="resetEmail" name="email" class="form-control px-3" style="border-radius: 6px; border: 1px solid #ced4da;" required>
                        </div>
                        <button type="submit" class="btn btn-block" style="background-color: #1a497b; color: white; border-radius: 6px; padding: 10px 0; font-weight: 500;">Send Reset Code</button>
                    </form>
                    <div class="mt-4 text-center">
                        <a href="javascript:void(0);" style="color: #6c8ebf; font-size: 14px; text-decoration: none;" id="switchToLogin">Back to Login</a>
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

    // Smooth transition helper
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

    // Click to go to Forgot Password view
    if (switchToForgot) {
        switchToForgot.addEventListener('click', function() {
            switchView(loginSection, forgotSection, 'Forgot Password');
        });
    }

    // Click to go back to Login view
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function() {
            switchView(forgotSection, loginSection, 'Welcome Back!');
        });
    }

    // Reset back to Login state whenever modal is closed
    if (window.jQuery) {
        $('#loginModal').on('hidden.bs.modal', function () {
            forgotSection.style.display = 'none';
            forgotSection.style.opacity = 0;
            loginSection.style.display = 'block';
            loginSection.style.opacity = 1;
            modalTitle.textContent = 'Welcome Back!';
        });

        // Automatically show modal if redirected with login parameter
        <?php if (isset($_GET['login'])): ?>
            $('#loginModal').modal('show');
            <?php if ($_GET['login'] === 'reset'): ?>
            // Auto-switch to forgot password view on reset redirect
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