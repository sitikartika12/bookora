<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Bookora</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6a5af9, #8b7bff);
            font-family: "Segoe UI", sans-serif;
        }

        /* CARD LOGIN */
        .login-card {
            border: none;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        /* INPUT */
        .form-control {
            border-radius: 12px;
            padding: 10px;
            font-size: 14px;
        }

        /* BUTTON */
        .btn-login {
            border-radius: 20px;
            padding: 10px;
            background: linear-gradient(135deg, #6a5af9, #8b7bff);
            border: none;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        /* HEADER */
        .login-title {
            font-weight: bold;
        }

        /* LINK */
        .small-btn {
            border-radius: 20px;
        }

    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="login-card bg-white" style="width: 380px;">

        <!-- TITLE -->
        <div class="text-center mb-3">
            <h4 class="login-title">📚 Bookora</h4>
            <small class="text-muted">Silakan login ke akun kamu</small>
        </div>

        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('salahpw')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('salahpw') ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="<?= base_url('/proses-login') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button class="btn btn-login w-100 text-white">
                <i class="bi bi-box-arrow-in-right"></i> Sign In
            </button>

        </form>

        <!-- ACTION -->
        <div class="text-center mt-3 d-flex justify-content-center gap-2 flex-wrap">
            <a href="<?= base_url('users/create') ?>" class="btn btn-outline-success btn-sm small-btn">
                <i class="bi bi-person-plus"></i> Daftar
            </a>

            <a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm small-btn">
                <i class="bi bi-database"></i> Restore
            </a>
        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>