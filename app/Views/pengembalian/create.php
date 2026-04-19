<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Pengembalian</h3>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <label>Pilih Peminjaman</label><br>
    <select name="id_peminjaman" required>
        <option value="">-- Pilih --</option>
        <?php foreach ($peminjaman as $p): ?>
            <option value="<?= $p['id_peminjaman'] ?>">
                ID <?= $p['id_peminjaman'] ?> | <?= $p['tanggal_pinjam'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('pengembalian') ?>">Kembali</a>

</form>
<?= $this->endSection() ?>