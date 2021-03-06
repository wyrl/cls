<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List System</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap-4/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/responsive.css') ?>" />

    <!-- JS -->
    <script src="<?= base_url("assets/jquery-3.5.1.min.js"); ?>"></script>
    <script src="<?= base_url("assets/jquery.validate.min.js"); ?>"></script>
    <script src="<?= base_url("assets/bootstrap-4/js/bootstrap.min.js"); ?>"></script>

    
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= site_url() ?>">Contact List System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample04">
                    <!-- <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul> -->
                    <!-- <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Login<span class="sr-only">(current)</span></a>
                    </li>
                </ul> -->
                    <?php if (logged_in()) : ?>
                        <div class="ml-auto logout">
                            <a href="<?= site_url('user/logout') ?>">Logout</a>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="user"><a href="#">Login</a> or <a href="#">Register</a></div> -->
                </div>
            </div>
        </nav>
    </header>