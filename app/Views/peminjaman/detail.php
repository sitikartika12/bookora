<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Detail Peminjaman</h3>

<!-- ========================
     DATA PEMINJAMAN
======================== -->
<table border="1" cellpadding="5">
<tr>
    <td>Nama Anggota</td>
    <td><?= $peminjaman['nama_anggota'] ?></td>
</tr>

<tr>
    <td>Tanggal Pinjam</td>
    <td><?= $peminjaman['tanggal_pinjam'] ?></td>
</tr>

<tr>
    <td>Tanggal Kembali</td>
    <td><?= $peminjaman['tanggal_kembali'] ?></td>
</tr>

<tr>
    <td>Alamat</td>
    <td><?= $peminjaman['alamat'] ?? '-' ?></td>
</tr>

<tr>
    <td>No HP</td>
    <td><?= $peminjaman['no_hp'] ?? '-' ?></td>
</tr>

<tr>
    <td>Status</td>
    <td><?= $peminjaman['status'] ?></td>
</tr>
</table>

<br>

<a href="<?= base_url('penarikan/buatPenarikan/' . $peminjaman['id_peminjaman']) ?>">
    Ajukan Penarikan
</a>

<?php if ($penarikan): ?>
    <p>Status Penarikan: <b><?= $penarikan['status'] ?></b></p>
<?php endif; ?>


<?php if ($penarikan && session()->get('role') == 'petugas'): ?>
    <a href="<?= base_url('penarikan/ambil/'.$penarikan['id_penarikan']) ?>">
        Ambil
    </a>
<?php endif; ?>
<!-- ========================
     DETAIL BUKU
======================== -->
<h4>Daftar Buku</h4>

<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>Judul Buku</th>
    <th>Jumlah</th>
</tr>

<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['judul'] ?></td>
    <td><?= $d['jumlah'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<br>

<a href="<?= base_url('peminjaman') ?>">Kembali</a>

<?= $this->endSection() ?>