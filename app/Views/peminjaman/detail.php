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

    <tr>
    <td>Status Pembayaran</td>
    <td>
        <?php if ($transaksi): ?>
            <?php if ($transaksi['status'] == 'lunas'): ?>
                <span style="color:green; font-weight:bold;">LUNAS</span>
            <?php elseif ($transaksi['status'] == 'belum_bayar'): ?>
                <span style="color:red; font-weight:bold;">BELUM BAYAR</span>
            <?php else: ?>
                <?= $transaksi['status'] ?>
            <?php endif; ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>

<tr>
    <td>Total Pembayaran</td>
    <td>
        Rp <?= number_format($transaksi['jumlah'] ?? 0, 0, ',', '.') ?>
    </td>
</tr>

<tr>
    <td>Metode Pembayaran</td>
    <td>
        <?= $transaksi['metode'] ?? '-' ?>
    </td>
</tr>
</table>

<br>



<?php if ($penarikan): ?>
    <p>Status Penarikan: <b><?= $penarikan['status'] ?></b></p>
<?php endif; ?>


<?php if ($penarikan && session()->get('role') == 'petugas'): ?>
    <a href="<?= base_url('penarikan/ambil/' . $penarikan['id_penarikan']) ?>">
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

    <?php $no = 1;
    foreach ($detail as $d): ?>
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