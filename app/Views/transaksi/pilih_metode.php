<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Pilih Metode Pembayaran</h3>

<p>Jenis: <?= $transaksi['jenis'] ?></p>
<p>Total: Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></p>

<hr>

<!-- COD -->
<a href="<?= base_url('transaksi/proses/' . $transaksi['id_transaksi'] . '/cod') ?>">
    💵 COD (Bayar di tempat)
</a>

<br><br>

<!-- QRIS -->
<a href="<?= base_url('transaksi/proses/' . $transaksi['id_transaksi'] . '/qris') ?>">
    📱 QRIS
</a>

<br><br>

<!-- Transfer -->
<a href="<?= base_url('transaksi/proses/' . $transaksi['id_transaksi'] . '/transfer') ?>">
    🏦 Transfer Bank
</a>

<?= $this->endSection() ?>