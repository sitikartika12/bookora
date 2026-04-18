<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="UTF-8">
    <title>Tambah penerbit</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<h3>Tambah Penerbit</h3>

<form action="<?= base_url('penerbit/store') ?>" method="post">
    <input type="text" name="nama_penerbit" placeholder="Nama penerbit">
    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>