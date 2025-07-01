<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Available Client Requests - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">Client Service Requests Near You</h3>

            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (empty($clientRequests)): ?>
                <div class="alert alert-info" role="alert">
                    No matching client requests found at this time. Please check back later or adjust your profile settings (skills, service area).
                </div>
            <?php else: ?>
                <div class="list-group shadow-sm">
                    <?php foreach ($clientRequests as $request): ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-primary"><?= esc($request['title']) ?></h5>
                                <small class="text-muted">Posted: <?= esc(date('d M Y', strtotime($request['posted_on']))) ?></small>
                            </div>
                            <p class="mb-1">
                                <strong>Location:</strong> <?= esc($request['location_area']) ?> (approx. <?= esc($request['distance_from_provider']) ?> km away) <br>
                                <strong>Client:</strong> <?= esc($request['client_age_gender']) ?> <br>
                                <strong>Goals:</strong>
                                <?php foreach ($request['goals'] as $goal): ?>
                                    <span class="badge bg-light text-dark border me-1"><?= esc($goal) ?></span>
                                <?php endforeach; ?>
                                <br>
                                <strong>Preferred Times:</strong>
                                <?php foreach ($request['preferred_time_slots'] as $slot): ?>
                                    <span class="badge bg-secondary me-1"><?= esc($slot) ?></span>
                                <?php endforeach; ?>
                            </p>
                            <?php if (!empty($request['notes'])): ?>
                                <p class="mb-1"><small class="text-muted"><strong>Notes:</strong> <?= esc($request['notes']) ?></small></p>
                            <?php endif; ?>
                            <div class="mt-2 text-end">
                                <a href="<?= base_url('provider/request/' . $request['id'] . '/bid') ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> View Details & Place Bid
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?= $this->endSection() ?>
