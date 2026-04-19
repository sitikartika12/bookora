<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Pengembalian</h3>
<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('pengembalian/create') ?>">+ Tambah Pengembalian</a>
<?php endif; ?>
<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>ID Peminjaman</th>
    <th>Tanggal Dikembalikan</th>
    <th>Denda</th>
</tr>

<?php $no=1; foreach($pengembalian as $p): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['id_peminjaman'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td>Rp <?= number_format($p['denda']) ?></td>
</tr>
<?php endforeach; ?>

</table>
<?= $this->endSection() ?>