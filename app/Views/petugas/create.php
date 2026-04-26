<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .form-card {
            background: #fff;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            max-width: 500px;
            margin: auto;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 6px 15px;
        }
    </style>
</head>

<body>

<div class="container d-flex align-items-center vh-100">

    <div class="w-100">

        <!-- HEADER -->
        <div class="text-center mb-3">
            <h4 class="fw-bold mb-0">Tambah Petugas</h4>
            <small class="text-muted">Tambahkan data petugas baru</small>
        </div>

        <!-- FORM -->
        <div class="form-card">

            <form action="<?= base_url('petugas/store') ?>" method="post">

                <!-- USER -->
                <div class="mb-3">
                    <label class="form-label">Pilih User</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        <?php foreach ($users as $u): ?>
                            <option value="<?= $u['id'] ?>">
                                <?= $u['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- JABATAN -->
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control"
                           placeholder="Masukkan jabatan" required>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('petugas') ?>" class="btn btn-outline-secondary btn-custom">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-dark btn-custom">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>