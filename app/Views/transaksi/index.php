<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Transaksi</h3>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>ID Peminjaman</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Metode</th>
        <th>Bukti</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php foreach ($transaksi as $t): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $t['id_peminjaman'] ?></td>
            <td><?= $t['jenis'] ?></td>
            <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
            <td>
                <?php if ($t['status'] == 'lunas'): ?>
                    <span style="color:green;">Lunas</span>
                <?php elseif ($t['status'] == 'menunggu_verifikasi'): ?>
                    <span style="color:orange;">Menunggu Verifikasi</span>
                <?php elseif ($t['status'] == 'ditolak'): ?>
                    <span style="color:red;">Ditolak</span>
                <?php else: ?>
                    <?= $t['status'] ?>
                <?php endif; ?>
            </td>

            <td><?= $t['metode_pembayaran'] ?? '-' ?></td>

            <td>
                <?php if ($t['bukti_pembayaran']): ?>
                    <a href="<?= base_url('uploads/bukti/' . $t['bukti_pembayaran']) ?>" target="_blank">
                        Lihat
                    </a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td>
                <?php if ($t['status'] == 'menunggu_verifikasi'): ?>

                    <a href="<?= base_url('transaksi/verifikasi/' . $t['id_transaksi']) ?>">
                        ✅ Verifikasi
                    </a>

                    <br>

                    <a href="<?= base_url('transaksi/tolak/' . $t['id_transaksi']) ?>">
                        ❌ Tolak
                    </a>

                <?php elseif ($t['status'] == 'lunas'): ?>
                    ✔ Selesai
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>