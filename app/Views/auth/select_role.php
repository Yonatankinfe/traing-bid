<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Select Your Role - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Welcome! Choose Your Role</h3>
                <p class="text-muted">This will help us tailor your experience on MyTrainerBids.</p>
            </div>
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('auth/process_role') ?>" method="post" id="roleSelectionForm">
                    <?= csrf_field() ?>
                    <p class="text-center mb-4">How would you like to use our platform?</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 role-card" data-role="client">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-person-check-fill" style="font-size: 3rem; color: #0d6efd;"></i>
                                    <h5 class="card-title mt-3">I am a Client</h5>
                                    <p class="card-text small">I'm looking for personal trainers or service providers.</p>
                                    <button type="submit" name="role" value="client" class="btn btn-outline-primary stretched-link mt-auto">Post a Need</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 role-card" data-role="provider">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-person-badge" style="font-size: 3rem; color: #198754;"></i>
                                    <h5 class="card-title mt-3">I am a Provider</h5>
                                    <p class="card-text small">I offer training services and want to bid on client needs.</p>
                                    <button type="submit" name="role" value="provider" class="btn btn-outline-success stretched-link mt-auto">Offer a Service</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden input to ensure 'role' is submitted even if JS fails or only one button is used without explicit value -->
                    <!-- <input type="hidden" name="role" id="selectedRole"> -->
                </form>
            </div>
            <div class="card-footer text-center">
                <small>You can typically change your role later if needed, but onboarding will be specific to your initial choice.</small>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<style>
    .role-card {
        cursor: pointer;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .role-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .role-card .btn {
        /* Ensuring button is part of the card click, but using form submission via button click */
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // const roleCards = document.querySelectorAll('.role-card');
    // const selectedRoleInput = document.getElementById('selectedRole');
    // const roleSelectionForm = document.getElementById('roleSelectionForm');

    // roleCards.forEach(card => {
    //     card.addEventListener('click', function () {
    //         const role = this.dataset.role;
    //         if (selectedRoleInput) {
    //             selectedRoleInput.value = role;
    //         }
    //         if (roleSelectionForm) {
    //             // Optionally submit the form directly with JS,
    //             // but using buttons with name/value is more robust without JS.
    //             // roleSelectionForm.submit();
    //             console.log('Selected role (via JS if buttons were not type=submit): ' + role);
    //         }
    //     });
    // });
});
</script>
<?= $this->endSection() ?>
