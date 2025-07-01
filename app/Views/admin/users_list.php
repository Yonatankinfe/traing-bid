<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'Manage Users') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Users (Clients & Providers)</span>
        <div>
            <input type="text" class="form-control form-control-sm" placeholder="Search users (Name, ID, Role)...">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Joined On</th>
                        <th>Verified (Provider)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="7" class="text-center">No users found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= esc($user['id']) ?></td>
                                <td><?= esc($user['name']) ?></td>
                                <td><span class="badge bg-info text-dark"><?= esc($user['role']) ?></span></td>
                                <td><?= esc(date('d M Y', strtotime($user['joined_on']))) ?></td>
                                <td>
                                    <?php if ($user['role'] === 'Provider'): ?>
                                        <?= isset($user['is_verified']) && $user['is_verified'] ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-warning text-dark">No</span>' ?>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (isset($user['is_blocked']) && $user['is_blocked']): ?>
                                        <span class="badge bg-danger">Blocked</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#view-user-<?= esc($user['id']) ?>-details"><i class="bi bi-person-lines-fill me-2"></i>View Details</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <?php if (isset($user['is_blocked']) && $user['is_blocked']): ?>
                                                <li><a class="dropdown-item action-btn" href="<?= base_url('admin/users/' . $user['id'] . '/unblock') ?>" data-action="unblock" data-user-name="<?= esc($user['name']) ?>"><i class="bi bi-unlock-fill me-2"></i>Unblock User</a></li>
                                            <?php else: ?>
                                                <li><a class="dropdown-item action-btn" href="<?= base_url('admin/users/' . $user['id'] . '/block') ?>" data-action="block" data-user-name="<?= esc($user['name']) ?>"><i class="bi bi-slash-circle-fill me-2"></i>Block User</a></li>
                                            <?php endif; ?>
                                            <li><a class="dropdown-item text-danger action-btn" href="<?= base_url('admin/users/' . $user['id'] . '/remove') ?>" data-action="remove" data-user-name="<?= esc($user['name']) ?>"><i class="bi bi-trash-fill me-2"></i>Remove User</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination placeholder -->
        <?php if (!empty($users)): ?>
        <nav aria-label="Page navigation example" class="mt-3">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
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
            const userName = this.dataset.userName;
            let message = `Are you sure you want to ${action} user "${userName}"?`;
            if (action === 'remove') {
                message += ' This action is irreversible and will delete user data (simulated).';
            } else {
                 message += ' This action is simulated.';
            }
            if (!confirm(message)) {
                event.preventDefault();
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
