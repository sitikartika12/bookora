<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah anggota</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
</head>

<body>

<div>

<h3>Tambah Anggota</h3>

<form action="<?= base_url('anggota/store') ?>" method="post">

    <label>User</label><br>
    <select name="user_id">
        <option value="">-- Pilih User --</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>"><?= $u['nama'] ?></option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>NISN</label><br>
    <input type="text" name="nisn">

    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"></textarea>

    <br><br>

    <label>No HP</label><br>
    <input type="text" name="no_hp">

    <br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('anggota') ?>">Kembali</a>

</form>

</body>

<!-- Memanggil Bootstrap JS -->
<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</html>
<?= $this->endSection() ?>