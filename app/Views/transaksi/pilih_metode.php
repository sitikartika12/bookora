<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.page-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

.method-btn {
    border-radius: 30px;
    padding: 10px 18px;
    margin-right: 8px;
    margin-bottom: 8px;
    border: 1px solid #ddd;
    background: #f8f9fa;
    transition: 0.2s;
}

.method-btn:hover {
    background: #e9ecef;
}

.method-btn.active {
    background: #212529;
    color: #fff;
    border-color: #212529;
}

.section-box {
    padding: 15px;
    border: 1px dashed #ddd;
    border-radius: 12px;
    margin-top: 10px;
}
</style>

<div class="container">

    <h4 class="fw-bold mb-3">Pilih Metode Pembayaran</h4>

    <div class="page-card">

        <!-- INFO -->
        <div class="mb-3">
            <p><b>Jenis Transaksi:</b> <?= esc($transaksi['jenis']) ?></p>
            <p><b>Total:</b>
                <span class="badge bg-danger">
                    Rp <?= number_format($transaksi['jumlah'],0,',','.') ?>
                </span>
            </p>
        </div>

        <hr>

        <!-- BUTTON METODE -->
        <div class="mb-3">
            <button type="button" class="method-btn" onclick="showMetode('cod', this)">💵 COD</button>
            <button type="button" class="method-btn" onclick="showMetode('qris', this)">📱 QRIS</button>
            <button type="button" class="method-btn" onclick="showMetode('transfer', this)">🏦 Transfer</button>
        </div>

        <form action="<?= base_url('transaksi/proses') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">
            <input type="hidden" name="metode" id="metode">

            <!-- QRIS -->
            <div id="qrisBox" class="section-box" style="display:none;">
                <h5>QRIS Payment</h5>
                <img src="<?= base_url('assets/qris.png') ?>" width="180">
                <p class="text-muted mt-2">Scan QR lalu upload bukti</p>
            </div>

            <!-- TRANSFER -->
            <div id="transferBox" class="section-box" style="display:none;">
                <h5>Transfer Bank</h5>
                <p><b>Bank:</b> BCA</p>
                <p><b>No Rekening:</b> 1234567890</p>
                <p><b>Atas Nama:</b> Perpustakaan Bookora</p>
                <p class="text-danger">
                    Gunakan berita: ID <?= $transaksi['id_transaksi'] ?>
                </p>
            </div>

            <!-- COD -->
            <div id="codBox" class="section-box" style="display:none;">
                <h5>Cash on Delivery</h5>
                <p>Bayar langsung saat pengambilan/pengiriman</p>
            </div>

            <!-- UPLOAD -->
            <div id="uploadBox" class="section-box" style="display:none;">
                <label class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti" class="form-control">
            </div>

            <hr>

            <button type="submit" class="btn btn-dark w-100">
                ✔ Konfirmasi Pembayaran
            </button>

        </form>

    </div>

</div>

<script>
function showMetode(metode, btn) {

    document.getElementById('metode').value = metode;

    // reset tombol active
    document.querySelectorAll('.method-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // hide semua
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