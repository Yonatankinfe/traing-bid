<?= $this->extend('layouts/main') // Or a different layout for chat if needed ?>

<?= $this->section('title') ?>
Chat with <?= esc($chat_partner['name']) ?> - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4 mb-5 chat-container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header chat-header d-flex justify-content-between align-items-center">
                    <div>
                        <img src="<?= esc($chat_partner['profile_photo_url']) ?>" alt="<?= esc($chat_partner['name']) ?>" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <span class="fw-bold">Chat with <?= esc($chat_partner['name']) ?> (<?= esc(ucfirst($chat_partner['role'])) ?>)</span>
                    </div>
                    <a href="<?= base_url('client/request/' . $request_id . '/bids') // Link back to bids or relevant page ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body chat-messages-area p-3" id="chatMessagesArea" style="height: 400px; overflow-y: auto;">
                    <?php if (empty($messages)): ?>
                        <p class="text-center text-muted">No messages yet. Start the conversation!</p>
                    <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                            <div class="message mb-2 <?= $msg['is_current_user'] ? 'sent text-end' : 'received text-start' ?>">
                                <div class="message-bubble d-inline-block p-2 rounded shadow-sm <?= $msg['is_current_user'] ? 'bg-primary text-white' : 'bg-light text-dark border' ?>" style="max-width: 75%;">
                                    <?php if (!$msg['is_current_user']): ?>
                                        <small class="fw-bold d-block"><?= esc($msg['sender_name']) ?></small>
                                    <?php endif; ?>
                                    <p class="mb-0"><?= nl2br(esc($msg['message'])) ?></p>
                                    <small class="message-timestamp d-block text-end mt-1 <?= $msg['is_current_user'] ? 'text-white-50' : 'text-muted' ?>">
                                        <?= date('h:i A, M d', $msg['timestamp']) ?>
                                        <?php if ($msg['is_current_user'] && $current_user_role === 'client' && $msg['seen_by_recipient']): ?>
                                            <i class="bi bi-check2-all ms-1 text-info" title="Seen by <?= esc($chat_partner['name']) ?>"></i>
                                        <?php elseif ($msg['is_current_user'] && $current_user_role === 'client' && !$msg['seen_by_recipient']): ?>
                                            <i class="bi bi-check2 ms-1" title="Delivered"></i> <!-- Placeholder for delivered -->
                                        <?php endif; ?>
                                        <?php
                                        // Trainer (provider) does not see "seen" receipts from client
                                        // Client can see "seen" receipts from trainer (handled above)
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="card-footer chat-input-area p-3">
                    <form id="sendMessageForm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="recipient_id" value="<?= esc($chat_partner['id']) ?>">
                        <input type="hidden" name="request_id" value="<?= esc($request_id) ?>">
                        <input type="hidden" name="recipient_id_for_redirect" value="<?= esc($chat_partner['id']) ?>"> <!-- For non-AJAX fallback -->
                        <input type="hidden" name="request_id_for_redirect" value="<?= esc($request_id) ?>"> <!-- For non-AJAX fallback -->

                        <div class="input-group">
                            <textarea class="form-control" id="messageText" name="message" rows="2" placeholder="Type your message..." required></textarea>
                            <button class="btn btn-primary" type="submit" id="sendMessageButton">
                                <i class="bi bi-send-fill"></i> Send
                            </button>
                        </div>
                         <small class="form-text text-muted">Phone numbers are hidden for privacy. Admin can audit chats for safety.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessagesArea = document.getElementById('chatMessagesArea');
    // Scroll to the bottom of the chat messages
    chatMessagesArea.scrollTop = chatMessagesArea.scrollHeight;

    const sendMessageForm = document.getElementById('sendMessageForm');
    const messageText = document.getElementById('messageText');
    const sendMessageButton = document.getElementById('sendMessageButton');

    sendMessageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = messageText.value.trim();
        if (message === '') {
            return;
        }

        sendMessageButton.disabled = true;
        sendMessageButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

        const formData = new FormData(sendMessageForm);

        // AJAX request to send message
        fetch('<?= base_url('chat/send_message') ?>', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Important for CodeIgniter to recognize AJAX
                'X-CSRF-TOKEN': document.querySelector('input[name="<?= csrf_token() ?>"]').value // CSRF token
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Add message to UI (optimistic update)
                const newMessageDiv = document.createElement('div');
                newMessageDiv.classList.add('message', 'mb-2', 'sent', 'text-end');

                const messageBubble = `
                    <div class="message-bubble d-inline-block p-2 rounded shadow-sm bg-primary text-white" style="max-width: 75%;">
                        <p class="mb-0">${escapeHtml(message)}</p>
                        <small class="message-timestamp d-block text-end mt-1 text-white-50">
                            ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}, ${new Date().toLocaleDateString([], { month: 'short', day: 'numeric' })}
                            <i class="bi bi-check2 ms-1" title="Delivered"></i>
                        </small>
                    </div>`;
                newMessageDiv.innerHTML = messageBubble;
                chatMessagesArea.appendChild(newMessageDiv);
                chatMessagesArea.scrollTop = chatMessagesArea.scrollHeight; // Scroll to new message
                messageText.value = ''; // Clear input
            } else {
                alert('Error sending message: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending the message.');
        })
        .finally(() => {
            sendMessageButton.disabled = false;
            sendMessageButton.innerHTML = '<i class="bi bi-send-fill"></i> Send';
            messageText.focus();
        });
    });

    function escapeHtml(unsafe) {
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }
});
</script>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .chat-messages-area .message.sent .message-bubble {
        margin-left: auto; /* Aligns to the right */
    }
    .chat-messages-area .message.received .message-bubble {
        margin-right: auto; /* Aligns to the left */
    }
</style>
<?= $this->endSection() ?>
