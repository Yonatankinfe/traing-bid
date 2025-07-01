<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'Provider Details') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Provider Information: <?= esc($provider['name']) ?></h5>
                <a href="<?= base_url('admin/providers') ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Provider ID</dt>
                    <dd class="col-sm-8"><?= esc($provider['id']) ?></dd>

                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8"><?= esc($provider['name']) ?></dd>

                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8"><?= esc(ucfirst($provider['gender'])) ?></dd>

                    <dt class="col-sm-4">Phone Number</dt>
                    <dd class="col-sm-8"><?= esc($provider['phone_number']) ?></dd>

                    <dt class="col-sm-4">Submitted On</dt>
                    <dd class="col-sm-8"><?= esc(date('d M Y, H:i', strtotime($provider['submitted_on']))) ?></dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge
                            <?php
                                if ($provider['status'] === 'Pending KYC Fee') echo 'bg-warning text-dark';
                                elseif ($provider['status'] === 'Pending Photo Review') echo 'bg-info text-dark';
                                elseif ($provider['status'] === 'Approved') echo 'bg-success';
                                elseif ($provider['status'] === 'Rejected') echo 'bg-danger';
                                else echo 'bg-secondary';
                            ?>
                        "><?= esc($provider['status']) ?></span>
                    </dd>

                    <dt class="col-sm-4">KYC Paid</dt>
                    <dd class="col-sm-8">
                        <?php if ($provider['kyc_paid']): ?>
                            <span class="badge bg-success">Yes</span> (ID: <?= esc($provider['kyc_payment_id']) ?>)
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">No</span>
                        <?php endif; ?>
                    </dd>

                    <dt class="col-sm-4">Skills / Services</dt>
                    <dd class="col-sm-8">
                        <?php foreach ($provider['skills'] as $skill): ?>
                            <span class="badge bg-light text-dark border me-1"><?= esc($skill) ?></span>
                        <?php endforeach; ?>
                    </dd>

                    <dt class="col-sm-4">Base Monthly Price</dt>
                    <dd class="col-sm-8"><?= esc($provider['base_monthly_price']) ?></dd>

                    <dt class="col-sm-4">Available Time Slots</dt>
                    <dd class="col-sm-8">
                        <?php foreach ($provider['available_time_slots'] as $slot): ?>
                            <span class="badge bg-secondary me-1"><?= esc($slot) ?></span>
                        <?php endforeach; ?>
                    </dd>

                    <dt class="col-sm-4">Service Area / Pincode</dt>
                    <dd class="col-sm-8"><?= esc($provider['area_pincode']) ?></dd>

                    <dt class="col-sm-4">Who Can Train</dt>
                    <dd class="col-sm-8">
                        <?php foreach ($provider['can_train'] as $audience): ?>
                            <span class="badge bg-info text-dark me-1"><?= esc($audience) ?></span>
                        <?php endforeach; ?>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>KYC Submitted Photos</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <h6>Front Face</h6>
                        <img src="<?= esc($provider['photos']['front_face']) ?>" alt="Front Face KYC" class="img-thumbnail kyc-image">
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6>Side Face</h6>
                        <img src="<?= esc($provider['photos']['side_face']) ?>" alt="Side Face KYC" class="img-thumbnail kyc-image">
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6>Holding ID</h6>
                        <img src="<?= esc($provider['photos']['id_holding']) ?>" alt="ID Holding KYC" class="img-thumbnail kyc-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                <?php if ($provider['status'] !== 'Approved' && $provider['status'] !== 'Rejected'): ?>
                    <p>Review the details and KYC photos. Then approve or reject this provider.</p>
                    <form action="<?= base_url('admin/providers/' . $provider['id'] . '/approve') ?>" method="post" class="d-inline">
                         <?= csrf_field() ?>
                        <button type="submit" class="btn btn-success action-btn mb-2 w-100" data-action="approve"><i class="bi bi-check-circle-fill"></i> Approve Provider</button>
                    </form>
                    <button type="button" class="btn btn-danger action-btn w-100" data-bs-toggle="modal" data-bs-target="#rejectModal" data-action="reject">
                        <i class="bi bi-x-circle-fill"></i> Reject Provider
                    </button>

                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="<?= base_url('admin/providers/' . $provider['id'] . '/reject') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel">Reject Provider: <?= esc($provider['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="rejection_reason" class="form-label">Reason for Rejection (Optional, but recommended)</label>
                                            <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php elseif ($provider['status'] === 'Approved'): ?>
                    <p class="text-success"><i class="bi bi-check-circle-fill"></i> This provider is already approved.</p>
                    <!-- Option to suspend or re-evaluate? -->
                <?php elseif ($provider['status'] === 'Rejected'): ?>
                    <p class="text-danger"><i class="bi bi-x-circle-fill"></i> This provider was rejected.</p>
                    <!-- Option to reconsider? -->
                <?php endif; ?>
            </div>
        </div>
        <div class="card shadow-sm">
             <div class="card-header">
                <h5>Admin Notes (Internal)</h5>
            </div>
            <div class="card-body">
                <textarea class="form-control" rows="4" placeholder="Add internal notes about this provider..."><?= esc($provider['admin_notes'] ?? '') ?></textarea>
                <button class="btn btn-outline-secondary btn-sm mt-2">Save Notes (Simulated)</button>
            </div>
        </div>
    </div>
</div>

<style>
    .kyc-image {
        max-width: 100%;
        height: auto;
        border: 1px solid #dee2e6;
        padding: 0.25rem;
        background-color: #fff;
        cursor: pointer; /* For potential modal zoom */
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('admin_scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        // Prevent double confirmation for modal trigger button
        if (button.dataset.bsToggle === 'modal') return;

        button.addEventListener('click', function(event) {
            const action = this.dataset.action;
            const providerName = "<?= esc($provider['name']) ?>"; // Get provider name from PHP
            if (!confirm(`Are you sure you want to ${action} provider "${providerName}"? This action is simulated.`)) {
                event.preventDefault();
            }
        });
    });

    // Optional: If you want to make images clickable to show larger in a modal
    // document.querySelectorAll('.kyc-image').forEach(img => {
    //     img.addEventListener('click', function() {
    //         // Implement modal display for larger image
    //         alert('Display larger image: ' + this.src);
    //     });
    // });
});
</script>
<?= $this->endSection() ?>
