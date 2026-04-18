<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <title>Tambah penulis</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<h3>Tambah Penulis</h3>

<form action="<?= base_url('penulis/store') ?>" method="post">
    <input type="text" name="nama_penulis" placeholder="Nama penulis">
    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>