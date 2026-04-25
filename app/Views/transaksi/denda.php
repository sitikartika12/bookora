<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Denda</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Peminjaman</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($denda)): ?>
        <?php foreach ($denda as $d): ?>
            <tr>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['id_peminjaman'] ?></td>
                <td>Rp <?= number_format($d['jumlah'], 0, ',', '.') ?></td>
                <td><?= $d['status'] ?></td>
                <td>
                    <a href="<?= base_url('transaksi/verifikasi/'.$d['id_transaksi']) ?>">
                        ✔ Verifikasi
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Tidak ada data denda</td>
        </tr>
    <?php endif; ?>

</table>

<?= $this->endSection() ?>