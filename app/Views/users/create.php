<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .card-custom {
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .btn-custom {
            border-radius: 20px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card card-custom p-4" style="width: 450px;">

        <div class="text-center mb-3">
            <h4 class="fw-bold">Form Tambah User</h4>
            <small class="text-muted">Silakan isi data dengan benar</small>
        </div>

        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

            <!-- NAMA -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- USERNAME -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <!-- ROLE -->
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="anggota">Anggota</option>
                </select>
            </div>

            <!-- FOTO -->
            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak upload foto</small>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-dark w-100 btn-custom">
                <i class="bi bi-person-plus"></i> Simpan
            </button>

            <div class="text-center mt-3">
                <a href="<?= base_url('login') ?>" class="text-decoration-none">
                    Sudah punya akun? Login
                </a>
            </div>

        </form>

    </div>

</div>

</body>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</html>