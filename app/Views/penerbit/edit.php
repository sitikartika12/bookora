<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Penerbit</h3>

<form action="<?= base_url('penerbit/update/'.$penerbit['id_penerbit']) ?>" method="post">
    <input type="text" name="nama_penerbit" value="<?= $penerbit['nama_penerbit'] ?>">
    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>