<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Pilih Metode Pembayaran</h3>

<hr>

<p><b>Jenis Transaksi:</b> <?= esc($transaksi['jenis']) ?></p>
<p><b>Total:</b> Rp <?= number_format($transaksi['jumlah'], 0, ',', '.') ?></p>

<hr>

<!-- PILIH METODE -->
<button type="button" onclick="showMetode('cod')">💵 COD</button>
<button type="button" onclick="showMetode('qris')">📱 QRIS</button>
<button type="button" onclick="showMetode('transfer')">🏦 Transfer</button>

<hr>

<form action="<?= base_url('transaksi/proses') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">
    <input type="hidden" name="metode" id="metode">

    <!-- QRIS -->
    <div id="qrisBox" style="display:none;">
        <h4>Scan QRIS</h4>
        <img src="<?= base_url('assets/qris.png') ?>" width="200">
        <p>Upload bukti setelah bayar</p>
    </div>

    <!-- TRANSFER -->
    <div id="transferBox" style="display:none;">
        <h4>Transfer Bank</h4>
        <p><b>Bank:</b> BCA</p>
        <p><b>No Rekening:</b> 1234567890</p>
        <p><b>Atas Nama:</b> Perpustakaan Bookora</p>
        <p style="color:red;">Harap isi berita: ID Transaksi <?= $transaksi['id_transaksi'] ?></p>
    </div>

    <!-- COD -->
    <div id="codBox" style="display:none;">
        <h4>COD</h4>
        <p>Bayar langsung saat pengambilan/pengiriman</p>
    </div>

    <hr>

    <!-- UPLOAD BUKTI -->
    <div id="uploadBox" style="display:none;">
        <label>Upload Bukti Pembayaran</label><br>
        <input type="file" name="bukti">
    </div>

    <br>

    <button type="submit">✔ Konfirmasi Pembayaran</button>

</form>

<script>
function showMetode(metode) {

    document.getElementById('metode').value = metode;

    // reset semua
    document.getElementById('qrisBox').style.display = 'none';
    document.getElementById('transferBox').style.display = 'none';
    document.getElementById('codBox').style.display = 'none';
    document.getElementById('uploadBox').style.display = 'none';

    if (metode === 'qris') {
        document.getElementById('qrisBox').style.display = 'block';
        document.getElementById('uploadBox').style.display = 'block';
    }

    if (metode === 'transfer') {
        document.getElementById('transferBox').style.display = 'block';
        document.getElementById('uploadBox').style.display = 'block';
    }

    if (metode === 'cod') {
        document.getElementById('codBox').style.display = 'block';
    }
}
</script>

<?= $this->endSection() ?>