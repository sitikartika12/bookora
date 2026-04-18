<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah petugas</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>

<div>
<h3>Tambah Petugas</h3>

<form action="<?= base_url('petugas/store') ?>" method="post">

    <label>User</label><br>
    <select name="user_id">
        <option value="">-- Pilih User --</option>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>">
                <?= $u['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Jabatan</label><br>
    <input type="text" name="jabatan">

    <br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('petugas') ?>">Kembali</a>

</form>