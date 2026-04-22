<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Pembayaran</h3>

<p>Total: Rp <?= number_format($transaksi['jumlah']) ?></p>

<form action="<?= base_url('transaksi/proses') ?>" method="post">

<input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">

<label>Pilih Metode Pembayaran</label><br>

<select name="metode">
    <option value="cod">COD (Bayar di tempat)</option>
    <option value="qris">QRIS</option>
    <option value="transfer">Transfer</option>
</select>

<br><br>

<button type="submit">Bayar</button>

</form>
<?= $this->endSection() ?>