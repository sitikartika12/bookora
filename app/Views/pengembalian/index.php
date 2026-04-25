<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Pengembalian</h3>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('pengembalian/create') ?>">+ Tambah Pengembalian</a>
<?php endif; ?>

<br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>No</th>
        <th>ID Peminjaman</th>
        <th>Tanggal Dikembalikan</th>
        <th>Denda</th>
    </tr>

    <?php if (!empty($pengembalian)) : ?>
        <?php $no = 1; foreach ($pengembalian as $p): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $p['id_peminjaman'] ?></td>

                <!-- TANGGAL AMAN -->
                <td>
                    <?= !empty($p['tanggal_dikembalikan']) 
                        ? $p['tanggal_dikembalikan'] 
                        : '-' ?>
                </td>

                <!-- DENDA AMAN -->
                <td>
                    Rp <?= number_format((float) $p['denda'], 0, ',', '.') ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align:center;">
                Tidak ada data pengembalian
            </td>
        </tr>
    <?php endif; ?>

</table>

<?= $this->endSection() ?>