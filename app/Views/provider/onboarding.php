<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Provider Onboarding - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Provider Onboarding</h3>
                <p class="text-muted">Set up your trainer profile to start offering services.</p>
            </div>
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('provider/process_onboarding') ?>" method="post" id="providerOnboardingForm" enctype="multipart/form-data"> <!-- enctype for potential future file uploads if camera API direct save isn't feasible -->
                    <?= csrf_field() ?>

                    <h5 class="mt-3 mb-3 text-primary">Personal Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <?php foreach ($genders as $gender): ?>
                                    <option value="<?= strtolower($gender) ?>"><?= esc($gender) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number (from login)</label>
                        <input type="text" class="form-control" value="<?= session()->get('mobile_number_for_display_placeholder') ?: 'Your registered mobile number' ?>" readonly disabled>
                        <small class="form-text text-muted">This is your registered mobile number and will be kept hidden from clients. Used for verification and communication only.</small>
                    </div>


                    <h5 class="mt-4 mb-3 text-primary">Service Details</h5>
                    <div class="mb-3">
                        <label class="form-label">Skills / Services Offered (Select all that apply) <span class="text-danger">*</span></label>
                        <?php foreach ($skills_options as $skill): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="skills[]" value="<?= strtolower(str_replace(' ', '_', $skill)) ?>" id="skill_<?= strtolower(str_replace(' ', '_', $skill)) ?>">
                                <label class="form-check-label" for="skill_<?= strtolower(str_replace(' ', '_', $skill)) ?>">
                                    <?= esc($skill) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="skill_other_checkbox" onclick="toggleOtherInput('skill_other_checkbox', 'skills_other_text')">
                            <label class="form-check-label" for="skill_other_checkbox">Others:</label>
                        </div>
                        <input type="text" class="form-control mt-1" name="skills_other_text" id="skills_other_text" placeholder="Please specify other skills" style="display: none;">
                        <small class="form-text text-muted">At least one skill must be selected.</small>
                    </div>

                    <div class="mb-3">
                        <label for="base_monthly_price" class="form-label">Base Monthly Price (in ₹) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="base_monthly_price" name="base_monthly_price" required placeholder="e.g., 15000 or 12000-18000">
                        <small class="form-text text-muted">Enter a fixed price or a range.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Available Time Slots (Select all that apply) <span class="text-danger">*</span></label>
                        <?php foreach ($time_slots_general as $slot): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="available_time_slots[]" value="<?= strtolower($slot) ?>" id="ts_<?= strtolower($slot) ?>">
                                <label class="form-check-label" for="ts_<?= strtolower($slot) ?>"><?= esc($slot) ?></label>
                            </div>
                        <?php endforeach; ?>
                        <small class="form-text text-muted d-block">At least one time slot must be selected.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="area_locality" class="form-label">Service Area / Locality <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="area_locality" name="area_locality" required placeholder="e.g., Kondapur">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pincode" class="form-label">Service Pincode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pincode" name="pincode" required pattern="\d{6}" placeholder="e.g., 500084">
                        </div>
                    </div>
                     <small class="form-text text-muted d-block mb-3">GPS Lat/Long auto-capture (optional enhancement) - will be added later.</small>


                    <div class="mb-3">
                        <label class="form-label">Who Can You Train? (Select all that apply) <span class="text-danger">*</span></label>
                        <?php foreach ($train_audience_options as $audience): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="train_audience[]" value="<?= strtolower($audience) ?>" id="aud_<?= strtolower($audience) ?>">
                                <label class="form-check-label" for="aud_<?= strtolower($audience) ?>"><?= esc($audience) ?></label>
                            </div>
                        <?php endforeach; ?>
                         <small class="form-text text-muted">At least one audience type must be selected.</small>
                    </div>

                    <h5 class="mt-4 mb-3 text-primary">KYC Verification (Mandatory)</h5>
                    <p class="text-muted">For safety and trust, we require live photo verification. Please ensure good lighting. <strong class="text-danger">No uploads allowed.</strong></p>

                    <div class="row">
                        <div class="col-md-4 mb-3 text-center">
                            <label class="form-label">1. Front Face Photo</label>
                            <div class="kyc-photo-placeholder border p-3" id="front_face_placeholder">
                                <i class="bi bi-camera-fill" style="font-size: 2rem;"></i>
                                <p><small>Click to Capture</small></p>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2 kyc-capture-btn" data-type="front_face">Capture Front Face</button>
                            <input type="hidden" name="kyc_front_face_path" id="kyc_front_face_path">
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <label class="form-label">2. Side Face Photo</label>
                            <div class="kyc-photo-placeholder border p-3" id="side_face_placeholder">
                                <i class="bi bi-camera-fill" style="font-size: 2rem;"></i>
                                <p><small>Click to Capture</small></p>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2 kyc-capture-btn" data-type="side_face">Capture Side Face</button>
                            <input type="hidden" name="kyc_side_face_path" id="kyc_side_face_path">
                        </div>
                        <div class="col-md-4 mb-3 text-center">
                            <label class="form-label">3. Photo Holding ID</label>
                            <div class="kyc-photo-placeholder border p-3" id="id_photo_placeholder">
                                <i class="bi bi-person-bounding-box" style="font-size: 2rem;"></i>
                                <p><small>Click to Capture</small></p>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-2 kyc-capture-btn" data-type="id_photo">Capture ID Photo</button>
                            <input type="hidden" name="kyc_id_photo_path" id="kyc_id_photo_path">
                        </div>
                    </div>
                    <small class="form-text text-muted d-block mb-3">Accepted IDs: Aadhar Card, PAN Card, etc. Ensure the ID is clearly visible.</small>

                    <div class="kyc-payment-section mt-4 p-3 border rounded bg-light">
                        <h6>One-time KYC Verification Fee: ₹20</h6>
                        <p><small>This small fee helps us maintain a trustworthy platform and cover verification costs. It ensures only serious providers join.</small></p>
                        <button type="button" class="btn btn-success" id="payKycFeeButton">Pay ₹20 Verification Fee (via Razorpay)</button>
                        <input type="hidden" name="kyc_payment_id" id="kyc_payment_id">
                        <p id="kycPaymentStatus" class="mt-2 small"></p>
                    </div>


                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg" id="submitProviderForm">Submit for Approval</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Razorpay Checkout Script (to be loaded when payment button is clicked or page loads) -->
<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

<style>
    .kyc-photo-placeholder {
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .kyc-photo-placeholder img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>

<script>
function toggleOtherInput(checkboxId, textInputId) {
    const checkbox = document.getElementById(checkboxId);
    const textInput = document.getElementById(textInputId);
    if (checkbox && textInput) {
        textInput.style.display = checkbox.checked ? 'block' : 'none';
        if (!checkbox.checked) {
            textInput.value = '';
        } else {
            textInput.focus();
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const kycCaptureButtons = document.querySelectorAll('.kyc-capture-btn');
    kycCaptureButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.dataset.type;
            alert('Camera capture for ' + type.replace('_', ' ') + ' would be initiated here. This requires native camera access or a library like Webcam.js.');
            // Placeholder: Simulate image capture and display
            const placeholderDiv = document.getElementById(type + '_placeholder');
            const hiddenInput = document.getElementById('kyc_' + type + '_path');
            if (placeholderDiv) {
                placeholderDiv.innerHTML = '<img src="https://via.placeholder.com/150x100.png?text=Captured+' + type.replace('_', '+') + '" alt="Captured Image">';
                if(hiddenInput) hiddenInput.value = 'simulated/path/to/' + type + '.jpg'; // Simulate storing a path
            }
        });
    });

    const payKycFeeButton = document.getElementById('payKycFeeButton');
    if (payKycFeeButton) {
        payKycFeeButton.addEventListener('click', function() {
            alert('Razorpay payment flow for ₹20 would be initiated here.');
            // This is where you'd call your backend to create a Razorpay order,
            // then use the Razorpay Checkout script.
            // For now, simulate successful payment:
            document.getElementById('kyc_payment_id').value = 'sim_payment_' + Date.now();
            document.getElementById('kycPaymentStatus').textContent = 'Payment successful (simulated). Payment ID: ' + document.getElementById('kyc_payment_id').value;
            payKycFeeButton.disabled = true;
            payKycFeeButton.textContent = 'Payment Completed';
        });
    }

    // Basic form validation for checkboxes
    document.getElementById('providerOnboardingForm').addEventListener('submit', function(event) {
        let isValid = true;
        const sectionsToValidate = [
            { name: 'skills[]', message: 'Please select at least one Skill/Service.' },
            { name: 'available_time_slots[]', message: 'Please select at least one Available Time Slot.' },
            { name: 'train_audience[]', message: 'Please select at least one Audience type you can train.' }
        ];

        sectionsToValidate.forEach(section => {
            const checkboxes = document.querySelectorAll('input[name="' + section.name + '"]:checked');
            if (checkboxes.length === 0) {
                alert(section.message);
                isValid = false;
                // Focus first element of the group if possible
                const firstCheckbox = document.querySelector('input[name="' + section.name + '"]');
                if(firstCheckbox) firstCheckbox.focus();
                event.preventDefault();
                return; // exit loop early if one validation fails
            }
        });

        if(!isValid) return;

        // Validate KYC photos (check if hidden fields have values - simulated)
        const kycPhotos = ['kyc_front_face_path', 'kyc_side_face_path', 'kyc_id_photo_path'];
        for (const photoId of kycPhotos) {
            if (!document.getElementById(photoId).value) {
                alert('Please capture all three KYC photos.');
                isValid = false;
                event.preventDefault();
                // Focus on the first empty KYC capture button or section
                const photoType = photoId.replace('kyc_', '').replace('_path', '');
                const captureButton = document.querySelector(`.kyc-capture-btn[data-type="${photoType}"]`);
                if(captureButton) captureButton.focus();
                return;
            }
        }

        if(!isValid) return;

        // Validate KYC payment (check if hidden field has value - simulated)
        if (!document.getElementById('kyc_payment_id').value) {
            alert('Please complete the KYC verification payment.');
            isValid = false;
            event.preventDefault();
            if(payKycFeeButton) payKycFeeButton.focus();
            return;
        }
    });
});
</script>
<?= $this->endSection() ?>
