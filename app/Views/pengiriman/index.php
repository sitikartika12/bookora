<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Pengiriman</h3>

<table border="1">
<tr>
    <th>ID</th>
    <th>Alamat</th>
    <th>Status</th>
    <th>Biaya</th>
    <th>Petugas</th>

    <?php if (session()->get('role') != 'admin') : ?>
        <th>Aksi</th>
    <?php endif; ?>
</tr>

<?php foreach ($pengiriman as $p): ?>

<tr>
    <td><?= $p['id_pengiriman'] ?></td>
    <td><?= $p['alamat'] ?></td>
    <td><?= $p['status'] ?></td>
    <td><?= $p['biaya'] ?></td>
    <td><?= $p['petugas_id'] ?? '-' ?></td>

    <!-- ========================
         AKSI
    ======================== -->
    <?php if (session()->get('role') != 'admin') : ?>
    <td>

        <?php if (session()->get('role') == 'petugas'): ?>

            <?php if ($p['status'] == 'menunggu'): ?>
                <a href="<?= base_url('pengiriman/ambil/'.$p['id_pengiriman']) ?>">
                    Ambil
                </a>
            <?php endif; ?>

            <?php if ($p['status'] == 'diproses'): ?>
                <a href="<?= base_url('pengiriman/kirim/'.$p['id_pengiriman']) ?>">
                    Kirim
                </a>
            <?php endif; ?>

            <?php if ($p['status'] == 'dikirim'): ?>
                <a href="<?= base_url('pengiriman/sampai/'.$p['id_pengiriman']) ?>">
                    Selesai
                </a>
            <?php endif; ?>

        <?php endif; ?>

    </td>
    <?php endif; ?>

</tr>

<?php endforeach; ?>

</table>

<?= $this->endSection() ?>