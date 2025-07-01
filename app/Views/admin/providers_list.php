<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'Manage Provider Approvals') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Providers List</span>
        <div>
            <!-- Filter dropdown -->
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter: <?= ucfirst(esc($filter_status)) ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?= base_url('admin/providers?status=all') ?>">All</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/providers?status=pending_kyc_fee') ?>">Pending KYC Fee</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/providers?status=pending_photo_review') ?>">Pending Photo Review</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/providers?status=approved') ?>">Approved</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/providers?status=rejected') ?>">Rejected</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Submitted On</th>
                        <th>KYC Paid</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($providers)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No providers found for this filter.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($providers as $provider): ?>
                            <tr>
                                <td><?= esc($provider['id']) ?></td>
                                <td><?= esc($provider['name']) ?></td>
                                <td><?= esc(date('d M Y', strtotime($provider['submitted_on']))) ?></td>
                                <td>
                                    <?php if ($provider['kyc_paid']): ?>
                                        <span class="badge bg-success">Yes</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">No</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $statusClass = 'bg-secondary';
                                        if ($provider['status'] === 'Pending KYC Fee') $statusClass = 'bg-warning text-dark';
                                        elseif ($provider['status'] === 'Pending Photo Review') $statusClass = 'bg-info text-dark';
                                        elseif ($provider['status'] === 'Approved') $statusClass = 'bg-success';
                                        elseif ($provider['status'] === 'Rejected') $statusClass = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $statusClass ?>"><?= esc($provider['status']) ?></span>
                                    <?php if($provider['status'] === 'Rejected' && !empty($provider['rejection_reason'])): ?>
                                        <small class="d-block text-muted fst-italic">(<?= esc($provider['rejection_reason']) ?>)</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/providers/' . $provider['id'] . '/details') ?>" class="btn btn-sm btn-outline-primary" title="View Details">
                                        <i class="bi bi-eye-fill"></i> Details
                                    </a>
                                    <?php if ($provider['status'] === 'Pending Photo Review' || $provider['status'] === 'Pending KYC Fee'): // Simplified condition ?>
                                        <a href="<?= base_url('admin/providers/' . $provider['id'] . '/approve') ?>" class="btn btn-sm btn-outline-success ms-1 action-btn" title="Approve" data-action="approve">
                                            <i class="bi bi-check-circle-fill"></i> Approve
                                        </a>
                                        <a href="<?= base_url('admin/providers/' . $provider['id'] . '/reject') ?>" class="btn btn-sm btn-outline-danger ms-1 action-btn" title="Reject" data-action="reject">
                                            <i class="bi bi-x-circle-fill"></i> Reject
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination placeholder -->
        <?php if (!empty($providers)): // Simple check, real pagination would be more complex ?>
        <nav aria-label="Page navigation example" class="mt-3">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('admin_scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const action = this.dataset.action;
            const providerName = this.closest('tr').querySelector('td:nth-child(2)').textContent;
            if (!confirm(`Are you sure you want to ${action} provider "${providerName}"? This action is simulated.`)) {
                event.preventDefault();
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
