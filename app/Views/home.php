<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Home - MyTrainerBids
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="hero-section my-5">
    <h1 class="display-4">MyTrainerBids.com</h1>
    <p class="lead mt-3">Personal training. At your comfort zone.</p>
    <hr class="my-4">
    <p>Find the right personal trainer or offer your training services to clients near you.</p>
    <div class="action-buttons mt-4">
        <a class="btn btn-primary btn-lg" href="<?= base_url('client/onboarding') // Placeholder for client flow ?>" role="button">
            <i class="bi bi-search"></i> I Need Training
        </a>
        <a class="btn btn-success btn-lg" href="<?= base_url('provider/onboarding') // Placeholder for provider flow ?>" role="button">
            <i class="bi bi-briefcase"></i> I Give Training
        </a>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <h2><i class="bi bi-geo-alt-fill text-primary"></i> Location Based</h2>
        <p>Connect with trainers and clients in your preferred locality. Our radius filter ensures you find services or providers conveniently close to you.</p>
    </div>
    <div class="col-md-4">
        <h2><i class="bi bi-shield-check text-success"></i> Safe & Verified</h2>
        <p>Your safety is our priority. Providers undergo photo-based verification. We ensure privacy with hidden contact details and secure in-app chat.</p>
    </div>
    <div class="col-md-4">
        <h2><i class="bi bi-wallet2 text-info"></i> Zero Commission</h2>
        <p>Our platform is 100% free for Phase 1. Clients post needs, providers bid, and you connect directly without any commission fees.</p>
    </div>
</div>

<!-- Example: How it works section -->
<div class="row mt-5 py-4 bg-light rounded">
    <h2 class="text-center mb-4">How It Works</h2>
    <div class="col-md-4 text-center">
        <div class="p-3">
            <div style="font-size: 3rem; color: #0d6efd;">1</div>
            <h4>Client Posts Need</h4>
            <p>Describe your training requirements, location, and preferences.</p>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="p-3">
            <div style="font-size: 3rem; color: #198754;">2</div>
            <h4>Providers Bid</h4>
            <p>Verified trainers in your area submit their best offers and availability.</p>
        </div>
    </div>
    <div class="col-md-4 text-center">
        <div class="p-3">
            <div style="font-size: 3rem; color: #0dcaf0;">3</div>
            <h4>Connect & Train</h4>
            <p>Review bids, chat securely, and start your fitness journey.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Add any page-specific JavaScript here if needed -->
<!-- Bootstrap Icons (optional, if you want to use them like in the example buttons) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?= $this->endSection() ?>
