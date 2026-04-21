<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!DOCTYPE html>
<html>
<head>
    <title>Lengkapi Profil Anggota</title>
</head>
<body>

<h3>Lengkapi Profil Anggota</h3>

<form action="<?= base_url('anggota/updateProfil') ?>" method="post">

    <label>NISN</label><br>
    <input type="text" name="nisn" value="<?= $anggota['nisn'] ?? '' ?>"><br><br>

    <label>Alamat</label><br>
    <textarea name="alamat"><?= $anggota['alamat'] ?? '' ?></textarea><br><br>

    <label>No HP</label><br>
    <input type="text" name="no_hp" value="<?= $anggota['no_hp'] ?? '' ?>"><br><br>

    <button type="submit">Simpan</button>

</form>
<?= $this->endSection() ?>

</body>
</html>
