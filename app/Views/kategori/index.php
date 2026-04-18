<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Kategori</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari kategori..."
        value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= base_url('kategori') ?>">Reset</a>
</form>

<br>

<a href="<?= base_url('kategori/create') ?>">+ Tambah</a>

<table border="1">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($kategori)) : ?>

    <?php $no=1; foreach($kategori as $k): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $k['nama_kategori'] ?></td>
        <td>
            <a href="<?= base_url('kategori/edit/'.$k['id_kategori']) ?>">Edit</a>
            <a href="<?= base_url('kategori/delete/'.$k['id_kategori']) ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>

<?php else : ?>

    <tr>
        <td colspan="3">
            <?php if (!empty($_GET['keyword'])) : ?>
                Data kategori "<?= $_GET['keyword'] ?>" tidak ditemukan
            <?php else : ?>
                Belum ada data kategori
            <?php endif; ?>
        </td>
    </tr>

<?php endif; ?>
</table>
<?= $this->endSection() ?>