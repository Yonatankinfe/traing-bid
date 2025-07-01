<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Login - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Login with Mobile OTP</h3>
            </div>
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Mobile Number Input Form -->
                <form action="<?= base_url('auth/request_otp') ?>" method="post" id="requestOtpForm">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number (India - 10 digits)</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" required pattern="\d{10}">
                        </div>
                        <div class="form-text">We will send an OTP to this number for verification.</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" id="sendOtpButton">Send OTP</button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- OTP Verification Form -->
                <!-- This form would typically be hidden or on a separate step until OTP is sent -->
                <form action="<?= base_url('auth/verify_otp') ?>" method="post" id="verifyOtpForm" class="mt-3">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter 6-digit OTP" required pattern="\d{4,6}">
                        <!-- Assuming OTP is 4 to 6 digits -->
                    </div>
                     <div class="form-text mb-2">
                        <small>Enter the OTP sent to your mobile number. Didn't receive it? <a href="#" id="resendOtpLink">Resend OTP</a> (placeholder)</small>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success" id="verifyOtpButton">Verify OTP & Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</small>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Basic frontend interaction example (can be expanded)
    document.addEventListener('DOMContentLoaded', function () {
        const requestOtpForm = document.getElementById('requestOtpForm');
        const verifyOtpForm = document.getElementById('verifyOtpForm');
        const sendOtpButton = document.getElementById('sendOtpButton');
        // const verifyOtpDiv = document.getElementById('verifyOtpDiv'); // If OTP part was initially hidden

        // Example: Disable button after click to prevent multiple submissions
        if (requestOtpForm) {
            requestOtpForm.addEventListener('submit', function() {
                if (sendOtpButton) {
                    sendOtpButton.disabled = true;
                    sendOtpButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
                }
                // In a real AJAX scenario, you'd handle the response here
                // and then show the OTP form. For now, it's a direct post.
            });
        }

        // Placeholder for resend OTP
        const resendOtpLink = document.getElementById('resendOtpLink');
        if (resendOtpLink) {
            resendOtpLink.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Resend OTP functionality will be implemented here.');
                // Potentially re-enable the "Send OTP" for the original number or trigger a resend API call.
            });
        }
    });
</script>
<?= $this->endSection() ?>
