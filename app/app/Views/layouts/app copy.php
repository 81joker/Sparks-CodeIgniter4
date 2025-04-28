<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <!-- STYLES -->
</head>

<body>
    <?php echo view(name: 'layouts/sidebar'); ?>
    <!-- Content Menu -->
    <div class="content">
        <nav class="navbar navbar-light bg-white shadow mb-3">
            <div class="container-fluid">
                <button class="btn btn-link p-0 m-0" id="sidebarToggle">
                    <i class="bi bi-list text-black" style="font-size: 1.5rem;"></i>
                </button>
                <div>
                    <?php $session = session(); ?>
                    <?php if (!$session->get('logged_in')): ?>
                        <a class="btn btn-outline-primary me-2" href="<?= base_url('/login') ?>">Login</a>
                        <a class="btn btn-primary" href="<?= base_url('/register') ?>">Register</a>
                    <?php else: ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if (!empty($session->get('avatar'))):  ?>
                                    <img src="<?= base_url(esc($session->get('avatar'))) ?>" width="30" height="30" class="rounded-circle me-2">
                                <?php else : ?>
                                    <img src="https://github.com/mdo.png" width="30" height="30" class="rounded-circle me-2">
                                <?php endif; ?>
                                <?= esc($session->get('name')) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Sign out</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <?= view('partials/alerts') ?>
            <main>
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
    </div>
    </div>
    <!--/ Content Menu -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>