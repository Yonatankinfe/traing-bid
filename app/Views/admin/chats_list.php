<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'Audit Chats') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Chat Conversations</span>
        <div>
            <input type="text" class="form-control form-control-sm" placeholder="Search chats (Client, Provider, Request ID)...">
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted"><small>For safety and moderation, admins can review chat conversations. Phone numbers are never shown in chats.</small></p>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Chat ID</th>
                        <th>Client</th>
                        <th>Provider</th>
                        <th>Request ID</th>
                        <th>Last Message On</th>
                        <th>Messages</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($chats)): ?>
                        <tr>
                            <td colspan="7" class="text-center">No chats found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($chats as $chat): ?>
                            <tr>
                                <td><?= esc($chat['id']) ?></td>
                                <td><?= esc($chat['client_name']) ?></td>
                                <td><?= esc($chat['provider_name']) ?></td>
                                <td><a href="#request-<?= esc($chat['request_id']) ?>-details-placeholder">#<?= esc($chat['request_id']) ?></a></td>
                                <td><?= esc(date('d M Y, H:i', strtotime($chat['last_message_on']))) ?></td>
                                <td><span class="badge bg-secondary"><?= esc($chat['messages_count']) ?></span></td>
                                <td>
                                    <a href="<?= base_url('admin/chats/' . $chat['id'] . '/view') ?>" class="btn btn-sm btn-outline-primary" title="View Chat">
                                        <i class="bi bi-chat-left-text-fill"></i> View Chat
                                    </a>
                                    <!-- More actions like flagging, etc. could be added -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination placeholder -->
        <?php if (!empty($chats)): ?>
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
    // Placeholder for potential chat list specific JS
    // console.log("Admin chats list loaded.");
</script>
<?= $this->endSection() ?>
