<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Pembayaran <?= ucfirst($transaksi['jenis']) ?></h3>

<p>Total: Rp <?= number_format($transaksi['jumlah']) ?></p>

<form action="<?= base_url('transaksi/proses') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">

    <label>Pilih Metode Pembayaran</label><br>

    <?php if ($transaksi['jenis'] == 'denda'): ?>

        <select name="metode" required>
            <option value="">-- Pilih --</option>
            <option value="transfer">Transfer</option>
            <option value="cash">Cash (langsung ke petugas)</option>
        </select>

    <?php else: ?>

        <select name="metode" required>
            <option value="">-- Pilih --</option>
            <option value="cod">COD (Bayar di tempat)</option>
            <option value="qris">QRIS</option>
            <option value="transfer">Transfer</option>
        </select>

    <?php endif; ?>

    <br><br>

    <label>Upload Bukti Pembayaran</label><br>
    <input type="file" name="bukti" accept="image/*,.pdf">

    <br><br>

    <?php if (!empty($transaksi['bukti_pembayaran'])) : ?>
        <p>Bukti:</p>
        <img src="<?= base_url('uploads/bukti/' . $transaksi['bukti_pembayaran']) ?>" width="200">
    <?php endif; ?>

    <br><br>

    <button type="submit">Bayar</button>

</form>

<?= $this->endSection() ?>

transaksi_denda .php

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