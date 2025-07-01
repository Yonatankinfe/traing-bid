<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title', 'Admin Panel - MyTrainerBids') ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-size: .875rem;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link .bi {
            margin-right: 8px;
            color: #727272;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link:hover .bi,
        .sidebar .nav-link.active .bi {
            color: inherit;
        }
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }
        .main-content {
            margin-left: 220px; /* Same as sidebar width */
            padding-top: 56px; /* For fixed top navbar */
        }
        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem; /* Adjust if navbar height changes for mobile */
                padding-top: 0;
                z-index: 1030; /* Above content */
                width: 100%;
                height: auto; /* Or a fixed height if you prefer */
                position: static; /* Or relative for toggling */
            }
            .main-content {
                margin-left: 0;
                padding-top: 0; /* Reset if sidebar is static on mobile */
            }
            .sidebar-sticky {
                 height: auto;
                 overflow-y: visible;
            }
        }
    </style>
</head>
<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?= base_url('admin/dashboard') ?>">MyTrainerBids Admin</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search (not functional)" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="<?= base_url('logout_admin_placeholder') ?>">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'active' : '' ?>" aria-current="page" href="<?= base_url('admin/dashboard') ?>">
                                <i class="bi bi-house-door-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url(true)->getSegment(2) == 'providers') ? 'active' : '' ?>" href="<?= base_url('admin/providers') ?>">
                                <i class="bi bi-person-check-fill"></i> Provider Approvals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url(true)->getSegment(2) == 'users') ? 'active' : '' ?>" href="<?= base_url('admin/users') ?>">
                                <i class="bi bi-people-fill"></i> User Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (current_url(true)->getSegment(2) == 'chats') ? 'active' : '' ?>" href="<?= base_url('admin/chats') ?>">
                                <i class="bi bi-chat-dots-fill"></i> Chat Audit
                            </a>
                        </li>
                        <!-- Add more admin links here -->
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Settings (Placeholder)</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear-fill"></i> General Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= esc($title ?? 'Admin Page') ?></h1>
                    <!-- Optional breadcrumbs or action buttons can go here -->
                </div>

                <?= $this->renderSection('admin_content') ?>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <?= $this->renderSection('admin_scripts') ?>
</body>
</html>
