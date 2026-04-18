<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Kategori</h3>

<form action="<?= base_url('kategori/update/'.$kategori['id_kategori']) ?>" method="post">
    <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>">
    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>