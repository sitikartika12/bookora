<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Penarikan</h3>

<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>ID Peminjaman</th>
    <th>Alamat</th>
    <th>Biaya</th>
    <th>Status</th>
    <th>Tanggal Ambil</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($penarikan as $p): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['id_peminjaman'] ?></td>
    <td><?= $p['alamat'] ?></td>
    <td>Rp <?= number_format($p['biaya']) ?></td>
    <td><?= strtoupper($p['status']) ?></td>

    <td>
        <?= (!empty($p['tanggal_ambil']) && $p['tanggal_ambil'] != '0000-00-00')
            ? $p['tanggal_ambil']
            : '-' ?>
    </td>

    <td>

        <!-- ================= PETUGAS ================= -->
        <?php if (session()->get('role') == 'petugas'): ?>

           <?php if ($p['status'] == 'menunggu'): ?>
                <a href="<?= base_url('penarikan/buat/'.$p['id_peminjaman']) ?>">
            <?php endif; ?>


            <?php if ($p['status'] == 'menunggu'): ?>
                <a href="<?= base_url('penarikan/proses/'.$p['id_penarikan']) ?>">Proses</a>
            <?php endif; ?>

            <?php if ($p['status'] == 'diproses'): ?>
                | <a href="<?= base_url('penarikan/ambil/'.$p['id_penarikan']) ?>">Ambil</a>
            <?php endif; ?>

            <?php if ($p['status'] == 'diambil'): ?>
                | <a href="<?= base_url('penarikan/selesai/'.$p['id_penarikan']) ?>">Selesai</a>
            <?php endif; ?>

        <?php endif; ?>

        <!-- ================= ANGGOTA ================= -->
        <?php if (session()->get('role') == 'anggota'): ?>

    <?php if ($p['metode'] == 'antar' && $p['status'] == 'dipinjam'): ?>
        | <a href="<?= base_url('penarikan/buat/'.$p['id_peminjaman']) ?>">
            Penarikan
        </a>
    <?php endif; ?>

<?php endif; ?>

    </td>

</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>