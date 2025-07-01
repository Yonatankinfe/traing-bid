<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Client Onboarding - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Client Onboarding</h3>
                <p class="text-muted">Tell us about your training needs.</p>
            </div>
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('client/process_onboarding') ?>" method="post" id="clientOnboardingForm">
                    <?= csrf_field() ?>

                    <h5 class="mt-3 mb-3 text-primary">Basic Information</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                            <select class="form-select" id="age" name="age" required>
                                <option value="" selected disabled>Select Age</option>
                                <?php for ($i = 10; $i <= 90; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" selected disabled>Select Gender</option>
                                <?php foreach ($genders as $gender): ?>
                                    <option value="<?= strtolower($gender) ?>"><?= esc($gender) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="service_for" class="form-label">Who is this service for? <span class="text-danger">*</span></label>
                            <select class="form-select" id="service_for" name="service_for" required>
                                <option value="" selected disabled>Select an option</option>
                                <?php foreach ($service_for_options as $option): ?>
                                    <option value="<?= strtolower(str_replace(' ', '_', $option)) ?>"><?= esc($option) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3 text-primary">Health & Goals</h5>
                    <div class="mb-3">
                        <label class="form-label">Any Physical Conditions? (Select all that apply)</label>
                        <?php foreach ($physical_conditions_options as $condition): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="physical_conditions[]" value="<?= strtolower(str_replace(' ', '_', $condition)) ?>" id="cond_<?= strtolower(str_replace(' ', '_', $condition)) ?>">
                                <label class="form-check-label" for="cond_<?= strtolower(str_replace(' ', '_', $condition)) ?>">
                                    <?= esc($condition) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="physical_conditions_other_checkbox" id="cond_other_checkbox" onclick="toggleOtherInput('cond_other_checkbox', 'physical_conditions_other_text')">
                            <label class="form-check-label" for="cond_other_checkbox">Other:</label>
                        </div>
                        <input type="text" class="form-control mt-1" name="physical_conditions_other_text" id="physical_conditions_other_text" placeholder="Please specify other condition" style="display: none;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fitness Goals / Requirements (Select all that apply)</label>
                        <?php foreach ($goals_options as $goal): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="goals[]" value="<?= strtolower(str_replace([' ', '/'], '_', $goal)) ?>" id="goal_<?= strtolower(str_replace([' ', '/'], '_', $goal)) ?>">
                                <label class="form-check-label" for="goal_<?= strtolower(str_replace([' ', '/'], '_', $goal)) ?>">
                                    <?= esc($goal) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="goals_combination_checkbox" id="goal_combination_checkbox" onclick="toggleOtherInput('goal_combination_checkbox', 'goals_combination_text')">
                            <label class="form-check-label" for="goal_combination_checkbox">Combination Goal:</label>
                        </div>
                        <input type="text" class="form-control mt-1" name="goals_combination_text" id="goals_combination_text" placeholder="Describe combination goal" style="display: none;">

                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="goals_other_checkbox" id="goal_other_checkbox" onclick="toggleOtherInput('goal_other_checkbox', 'goals_other_text')">
                            <label class="form-check-label" for="goal_other_checkbox">Other Goal:</label>
                        </div>
                        <input type="text" class="form-control mt-1" name="goals_other_text" id="goals_other_text" placeholder="Specify other goal" style="display: none;">
                    </div>

                    <h5 class="mt-4 mb-3 text-primary">Preferences & Location</h5>
                    <div class="mb-3">
                        <label class="form-label">Preferred Time Slots (Select all that apply) <span class="text-danger">*</span></label>
                        <div class="row">
                        <?php foreach ($time_slots_detailed as $slot): ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="time_slots[]" value="<?= esc($slot) ?>" id="slot_<?= str_replace([' ', ':', '–'], '_', $slot) ?>">
                                    <label class="form-check-label" for="slot_<?= str_replace([' ', ':', '–'], '_', $slot) ?>">
                                        <?= esc($slot) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <small class="form-text text-muted">At least one time slot must be selected.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="pincode" name="pincode" required pattern="\d{6}" placeholder="e.g., 500001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="area_locality" class="form-label">Area / Locality <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="area_locality" name="area_locality" required placeholder="e.g., Gachibowli">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="distance_radius" class="form-label">Trainer Search Radius <span class="text-danger">*</span></label>
                            <select class="form-select" id="distance_radius" name="distance_radius" required>
                                <option value="" selected disabled>Select distance</option>
                                <?php foreach ($distance_options as $distance): ?>
                                    <option value="<?= esc($distance) ?>"><?= esc($distance) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preferred_trainer_gender" class="form-label">Preferred Trainer Gender</label>
                            <select class="form-select" id="preferred_trainer_gender" name="preferred_trainer_gender">
                                <?php foreach ($preferred_trainer_genders as $gender_pref): ?>
                                    <option value="<?= strtolower(str_replace(' ', '_', $gender_pref)) ?>"><?= esc($gender_pref) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="additional_notes" class="form-label">Additional Notes (Optional)</label>
                        <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3" placeholder="e.g., prefer trainers who’ve worked with seniors, need gentle routines"></textarea>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Save and Find Trainers</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function toggleOtherInput(checkboxId, textInputId) {
    const checkbox = document.getElementById(checkboxId);
    const textInput = document.getElementById(textInputId);
    if (checkbox && textInput) {
        textInput.style.display = checkbox.checked ? 'block' : 'none';
        if (!checkbox.checked) {
            textInput.value = ''; // Clear value when hidden
        } else {
            textInput.focus();
        }
    }
}

// Add validation for at least one checkbox in a group (e.g., time slots)
document.getElementById('clientOnboardingForm').addEventListener('submit', function(event) {
    const timeSlotCheckboxes = document.querySelectorAll('input[name="time_slots[]"]:checked');
    if (timeSlotCheckboxes.length === 0) {
        alert('Please select at least one Preferred Time Slot.');
        event.preventDefault(); // Stop form submission
        // Optionally, scroll to the time slot section or highlight it
        const timeSlotSection = document.querySelector('label.form-label:for(time_slots)');
        if(timeSlotSection) timeSlotSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return false;
    }
    // Add more client-side validations as needed
});
</script>
<?= $this->endSection() ?>
