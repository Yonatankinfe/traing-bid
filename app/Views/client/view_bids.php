<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
View Bids for Your Request - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Bids for Your Request: "<?= esc($request['title']) ?>"</h3>

            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    Request Summary
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Posted On:</strong> <?= esc(date('d M Y', strtotime($request['posted_on']))) ?></p>
                    <p class="card-text"><strong>Location Details:</strong> <?= esc($request['location_summary']) ?></p>
                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-primary"><?= esc($request['status']) ?></span></p>
                    <!-- Add more request details here if needed -->
                </div>
            </div>

            <h4 class="mb-3">Received Bids (<?= count($bids) ?>)</h4>

            <?php if (empty($bids)): ?>
                <div class="alert alert-info" role="alert">
                    No bids received for this request yet. Please check back later.
                </div>
            <?php else: ?>
                <?php foreach ($bids as $bid): ?>
                    <div class="card mb-3 bid-card shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-2 text-center p-3 border-end">
                                <img src="<?= esc($bid['provider_photo_url']) ?>" class="img-fluid rounded-circle mb-2" alt="<?= esc($bid['provider_name']) ?>" style="width: 80px; height: 80px; object-fit: cover;">
                                <h6><?= esc($bid['provider_name']) ?></h6>
                                <span class="text-muted small"><?= esc($bid['distance_km']) ?> km away</span>
                                <div>
                                <?php foreach ($bid['badges'] as $badge): ?>
                                    <span class="badge
                                        <?php
                                            if (strtolower($badge) === 'verified') echo 'bg-success';
                                            elseif (strtolower($badge) === 'top rated') echo 'bg-warning text-dark';
                                            elseif (strtolower($badge) === 'safe for kids (example)') echo 'bg-info text-dark';
                                            else echo 'bg-secondary';
                                        ?>
                                    me-1"><?= esc($badge) ?></span>
                                <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="card-title">Bid Details</h5>
                                    <p class="card-text mb-1"><strong>Skills:</strong>
                                        <?php foreach ($bid['provider_tags'] as $tag): ?>
                                            <span class="badge bg-light text-dark border me-1"><?= esc($tag) ?></span>
                                        <?php endforeach; ?>
                                    </p>
                                    <p class="card-text mb-1"><strong>Price Quote:</strong> <span class="fw-bold text-primary"><?= esc($bid['price_quote']) ?></span></p>
                                    <p class="card-text mb-1"><strong>Availability:</strong> <?= esc($bid['availability']) ?></p>
                                    <p class="card-text mt-2"><strong>Message from Provider:</strong></p>
                                    <p class="card-text bg-light p-2 rounded small"><em><?= nl2br(esc($bid['message'])) ?></em></p>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex align-items-center justify-content-center p-3 border-start flex-column">
                                <a href="<?= base_url('chat/initiate/' . $bid['provider_id'] . '/' . $request['id']) // Placeholder for chat initiation ?>" class="btn btn-primary mb-2 w-100">
                                    <i class="bi bi-chat-dots-fill"></i> Initiate Chat
                                </a>
                                <!-- <button type="button" class="btn btn-outline-secondary w-100">View Profile (Placeholder)</button> -->
                                <small class="text-muted mt-2">Bid received: <?= esc(date('d M Y, H:i', strtotime($bid['bid_received_on']))) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .bid-card .img-fluid {
        border: 2px solid #eee;
    }
    .bid-card:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.10)!important;
        /* transition: box-shadow .1s ease-in-out; */
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Add any page-specific JavaScript here if needed -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?= $this->endSection() ?>
