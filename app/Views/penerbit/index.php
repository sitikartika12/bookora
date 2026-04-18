<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penerbit</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari penerbit..."
        value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= base_url('penerbit') ?>">Reset</a>
</form>

<br>

<a href="<?= base_url('penerbit/create') ?>">+ Tambah</a>

<table border="1">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($penerbit)) : ?>

    <?php $no=1; foreach($penerbit as $p): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $p['nama_penerbit'] ?></td>
        <td>
            <a href="<?= base_url('penerbit/edit/'.$p['id_penerbit']) ?>">Edit</a>
            <a href="<?= base_url('penerbit/delete/'.$p['id_penerbit']) ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>

<?php else : ?>

    <tr>
        <td colspan="3">
            <?php if (!empty($_GET['keyword'])) : ?>
                Data penerbit "<?= $_GET['keyword'] ?>" tidak ditemukan
            <?php else : ?>
                Belum ada data penerbit
            <?php endif; ?>
        </td>
    </tr>

<?php endif; ?>

</table>

<?= $this->endSection() ?>