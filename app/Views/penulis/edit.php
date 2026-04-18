<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Penulis</h3>

<form action="<?= base_url('penulis/update/'.$penulis['id_penulis']) ?>" method="post">
    <input type="text" name="nama_penulis" value="<?= $penulis['nama_penulis'] ?>">
    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>