<?= $this->extend('layouts/admin_main') ?>

<?= $this->section('title') ?>
<?= esc($title ?? 'View Chat Conversation') ?>
<?= $this->endSection() ?>

<?= $this->section('admin_content') ?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Chat between <?= esc($client['name'] ?? 'Client') ?> and <?= esc($provider['name'] ?? 'Provider') ?> (Chat ID: <?= esc($chat_id) ?>)</span>
        <a href="<?= base_url('admin/chats') ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Chats List</a>
    </div>
    <div class="card-body chat-messages-area p-3" style="height: 500px; overflow-y: auto;">
        <?php if (empty($messages)): ?>
            <p class="text-center text-muted">This chat has no messages or messages could not be loaded.</p>
        <?php else: ?>
            <?php foreach ($messages as $msg): // Assuming $messages structure is similar to user chat ?>
                <div class="message mb-2 <?= ($msg['sender_role'] ?? 'unknown') === 'client' ? 'received text-start' : 'sent text-end' ?>"> <!-- Adjust based on who is 'user1' vs 'user2' or sender role -->
                    <div class="message-bubble d-inline-block p-2 rounded shadow-sm
                        <?= ($msg['sender_role'] ?? 'unknown') === 'client' ? 'bg-light text-dark border' : 'bg-primary text-white' // Example: Client messages on left, Provider on right from admin perspective
                        ?>" style="max-width: 75%;">

                        <small class="fw-bold d-block">
                            <?= esc($msg['sender_name'] ?? 'Unknown Sender') ?>
                            (<?= esc(ucfirst($msg['sender_role'] ?? 'Unknown')) ?>)
                        </small>
                        <p class="mb-0"><?= nl2br(esc($msg['message'])) ?></p>
                        <small class="message-timestamp d-block text-end mt-1 <?= ($msg['sender_role'] ?? 'unknown') === 'client' ? 'text-muted' : 'text-white-50' ?>">
                            <?= date('h:i A, M d', $msg['timestamp'] ?? time()) ?>
                            <?php if (!empty($msg['seen_by_recipient'])): ?>
                                <!-- <i class="bi bi-check2-all ms-1 text-info" title="Seen"></i> -->
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="card-footer text-muted">
        <small>This is a read-only view for audit purposes. Admins cannot send messages here.</small>
        <!-- Add any admin actions related to this chat, e.g., flag message, take action on user -->
    </div>
</div>

<style>
    .chat-messages-area .message.sent .message-bubble {
        margin-left: auto; /* Aligns to the right */
    }
    .chat-messages-area .message.received .message-bubble {
        margin-right: auto; /* Aligns to the left */
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('admin_scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessagesArea = document.querySelector('.chat-messages-area');
    if (chatMessagesArea) {
        chatMessagesArea.scrollTop = chatMessagesArea.scrollHeight;
    }
});
</script>
<?= $this->endSection() ?>
