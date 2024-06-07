<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME; ?></title>
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="<?= APP_URL; ?>/img/wings_logo.svg">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= APP_URL; ?>">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= APP_URL; ?>/transaction">Report Penjualan</a>
                </li>
            </ul>
            <a href="<?= APP_URL; ?>/auth/logout" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>