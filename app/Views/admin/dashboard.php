<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'Admin Dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<div class="row g-4">
    <div class="col-md-6 col-xl-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Pending Approvals</h5>
                        <p class="card-text fs-4 fw-bold"><?= esc($pending_providers_count ?? 0) ?></p>
                    </div>
                    <i class="bi bi-person-check-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
                <a href="<?= base_url('admin/providers?status=pending') ?>" class="text-white stretched-link text-decoration-none">View Details <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Total Users</h5>
                        <p class="card-text fs-4 fw-bold"><?= esc($total_users_count ?? 0) ?></p>
                    </div>
                    <i class="bi bi-people-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
                <a href="<?= base_url('admin/users') ?>" class="text-white stretched-link text-decoration-none">Manage Users <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Active Chats</h5>
                        <p class="card-text fs-4 fw-bold"><?= esc($active_chats_count ?? 0) ?></p>
                    </div>
                    <i class="bi bi-chat-dots-fill" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
                <a href="<?= base_url('admin/chats') ?>" class="text-white stretched-link text-decoration-none">Audit Chats <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </div>

    <!-- Add more cards or charts for other stats -->
</div>

<div class="mt-5">
    <h4>Recent Activity (Placeholder)</h4>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024-08-02 10:15</td>
                    <td>Provider: Jane Smith</td>
                    <td>KYC Submitted</td>
                    <td><a href="<?= base_url('admin/providers/2/details') ?>">Review Photos</a></td>
                </tr>
                <tr>
                    <td>2024-08-02 09:30</td>
                    <td>Client: Sunil Varma</td>
                    <td>New Request Posted</td>
                    <td>"Yoga for Back Pain"</td>
                </tr>
                <tr>
                    <td>2024-08-01 18:00</td>
                    <td>Admin: SuperAdmin</td>
                    <td>User Blocked</td>
                    <td>User ID: u003 (Spam activity)</td>
                </tr>
                <!-- More rows -->
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('admin_scripts') ?>
<!-- You can add chart libraries here if needed, e.g., Chart.js -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script>
    // Placeholder for potential dashboard specific JS
    // console.log("Admin dashboard loaded.");
</script>
<?= $this->endSection() ?>
