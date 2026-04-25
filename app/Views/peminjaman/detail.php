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

<h4>Pembayaran</h4>

<?php if (!empty($transaksi)): ?>
    <?php foreach ($transaksi as $t): ?>

        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <b><?= strtoupper($t['jenis']) ?></b><br>
            Rp <?= number_format($t['jumlah'], 0, ',', '.') ?><br>

            Status:
            <span style="color:<?= $t['status']=='lunas'?'green':'red' ?>">
                <?= $t['status'] ?>
            </span><br>

            Metode: <?= $t['metode_pembayaran'] ?? '-' ?><br>

            <?php if ($t['status'] != 'lunas'): ?>

                <?php if ($t['jenis'] == 'denda'): ?>
                    <a href="<?= base_url('transaksi/bayar/'.$peminjaman['id_peminjaman'].'/denda') ?>">
                        💰 Bayar Denda
                    </a>
                <?php endif; ?>

                <?php if ($t['jenis'] == 'pengiriman'): ?>
                    <a href="<?= base_url('transaksi/bayar/'.$peminjaman['id_peminjaman'].'/pengiriman') ?>">
                        🚚 Bayar Pengiriman
                    </a>
                <?php endif; ?>

            <?php endif; ?>

        </div>

    <?php endforeach; ?>
<?php else: ?>
    Tidak ada transaksi
<?php endif; ?>

<br>

<?php if ($penarikan): ?>
    Status Penarikan: <b><?= $penarikan['status'] ?></b><br>
<?php endif; ?>


<?php if ($penarikan && session()->get('role') == 'petugas'): ?>
    <a href="<?= base_url('penarikan/ambil/'.$penarikan['id_penarikan']) ?>">
        Ambil
    </a>
<?php endif; ?>

<h4>Daftar Buku</h4>

<table border="1">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Jumlah</th>
    </tr>

    <?php $no=1; foreach ($detail as $d): ?>
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