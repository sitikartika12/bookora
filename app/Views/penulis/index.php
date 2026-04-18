<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penulis</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari penulis..."
        value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= base_url('penulis') ?>">Reset</a>
</form>

<br>

<a href="<?= base_url('penulis/create') ?>">+ Tambah</a>


<table border="1">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($penulis)) : ?>

    <?php $no=1; foreach($penulis as $p): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $p['nama_penulis'] ?></td>
        <td>
            <a href="<?= base_url('penulis/edit/'.$p['id_penulis']) ?>">Edit</a>
            <a href="<?= base_url('penulis/delete/'.$p['id_penulis']) ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>

<?php else : ?>

    <tr>
        <td colspan="3">
            <?php if (!empty($_GET['keyword'])) : ?>
                Data penulis "<?= $_GET['keyword'] ?>" tidak ditemukan
            <?php else : ?>
                Belum ada data penulis
            <?php endif; ?>
        </td>
    </tr>

<?php endif; ?>
</table>
<?= $this->endSection() ?>