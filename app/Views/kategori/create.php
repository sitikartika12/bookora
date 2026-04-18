<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <title>Tambah kategori</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<h3>Tambah Kategori</h3>

<form action="<?= base_url('kategori/store') ?>" method="post">
    <input type="text" name="nama_kategori" placeholder="Nama kategori">
    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>