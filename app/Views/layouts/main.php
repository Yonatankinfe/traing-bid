<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title', 'MyTrainerBids - Personal Training') ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Custom CSS (optional) -->
    <?php /* <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> */ ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 56px; /* Adjust if navbar height changes */
        }
        .main-content {
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .navbar {
            min-height: 56px; /* Standard navbar height */
        }
        /* Homepage specific styles */
        .hero-section {
            background-color: #e9ecef;
            padding: 4rem 2rem;
            border-radius: 0.3rem;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1.2;
        }
        .hero-section .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }
        .action-buttons .btn {
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
            margin: 0.5rem;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('/') ?>">MyTrainerBids</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('login') // Placeholder for login route ?>">Login/Register</a>
                        </li>
                        <!-- More links can be added here -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content py-4">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <span>&copy; <?= date('Y') ?> MyTrainerBids.com. All rights reserved.</span>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Custom JS (optional) -->
    <?php /* <script src="<?= base_url('assets/js/script.js') ?>"></script> */ ?>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
