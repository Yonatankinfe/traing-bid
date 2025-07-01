<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Place Bid - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h3 class="mb-3">Place Your Bid</h3>

            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    Client Request Details
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= esc($request['title']) ?></h5>
                    <p class="card-text mb-1"><strong>Client:</strong> <?= esc($request['client_age_gender']) ?></p>
                    <p class="card-text mb-1"><strong>Location:</strong> <?= esc($request['location_area']) ?></p>
                    <p class="card-text mb-1"><strong>Goals:</strong>
                        <?php foreach ($request['goals'] as $goal): ?>
                            <span class="badge bg-light text-dark border me-1"><?= esc($goal) ?></span>
                        <?php endforeach; ?>
                    </p>
                    <p class="card-text mb-1"><strong>Preferred Times:</strong>
                        <?php foreach ($request['preferred_time_slots'] as $slot): ?>
                            <span class="badge bg-secondary me-1"><?= esc($slot) ?></span>
                        <?php endforeach; ?>
                    </p>
                    <?php if (!empty($request['notes'])): ?>
                        <p class="card-text mt-2"><strong>Client Notes:</strong> <em><?= nl2br(esc($request['notes'])) ?></em></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    Your Bid Submission
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('provider/submit_bid') ?>" method="post" id="placeBidForm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="request_id" value="<?= esc($request['id']) ?>">

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="price_quote_amount" class="form-label">Your Price Quote (in ₹) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price_quote_amount" name="price_quote_amount" required placeholder="e.g., 5000">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price_quote_type" class="form-label">Price Basis <span class="text-danger">*</span></label>
                                <select class="form-select" id="price_quote_type" name="price_quote_type" required>
                                    <?php foreach ($price_types as $type): ?>
                                        <option value="<?= esc($type) ?>"><?= esc(ucfirst($type)) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <small class="form-text text-muted d-block mb-3">Client will see this as "₹[Amount] [Basis]", e.g., "₹5000 per month".</small>


                        <div class="mb-3">
                            <label for="availability_timing" class="form-label">Your Availability for this Client <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="availability_timing" name="availability_timing" rows="3" required placeholder="e.g., Mon, Wed, Fri - 7 AM to 8 AM. Or, Flexible based on discussion."></textarea>
                            <small class="form-text text-muted">Clearly state when you are available to train this specific client.</small>
                        </div>

                        <div class="mb-3">
                            <label for="short_message" class="form-label">Short Message to Client (Optional)</label>
                            <textarea class="form-control" id="short_message" name="short_message" rows="4" placeholder="Introduce yourself briefly and explain why you're a good fit. (Max 500 characters)"></textarea>
                            <small class="form-text text-muted">This message will be shown to the client along with your bid.</small>
                        </div>

                        <p class="text-danger small mt-3">Note: Clients will not see other trainers' bids. Your bid is private between you and the client.</p>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Your Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Basic client-side validation or interactions can be added here if needed
document.getElementById('placeBidForm').addEventListener('submit', function(event) {
    const priceAmount = document.getElementById('price_quote_amount').value;
    const availability = document.getElementById('availability_timing').value;

    if (!priceAmount || parseFloat(priceAmount) <= 0) {
        alert('Please enter a valid price quote amount.');
        event.preventDefault();
        document.getElementById('price_quote_amount').focus();
        return;
    }
    if (!availability.trim()) {
        alert('Please specify your availability for this client.');
        event.preventDefault();
        document.getElementById('availability_timing').focus();
        return;
    }
    // You might add character limits for the message, etc.
});
</script>
<?= $this->endSection() ?>
