<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container">

    <h4 class="fw-bold mb-3">Bayar Denda</h4>

    <div class="card p-4">

        <p><b>Total Denda:</b></p>
        <h3 class="text-danger">
            Rp <?= number_format($transaksi['jumlah'],0,',','.') ?>
        </h3>

        <hr>

        <form action="<?= base_url('transaksi/denda/proses') ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">

            <div class="mb-3">
                <label class="form-label">Pilih Metode</label>
                <select name="metode" class="form-select" required>
                    <option value="">-- pilih --</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

            <!-- BOX TRANSFER -->
            <div id="transferBox" class="alert alert-info mt-3" style="display:none;">
                <h6>Transfer Bank</h6>
                <p><b>Bank:</b> BCA</p>
                <p><b>No Rekening:</b> 1234567890</p>
                <p><b>Atas Nama:</b> Perpustakaan Bookora</p>

                <p class="text-danger mb-0">
                    Gunakan berita: ID <?= $transaksi['id_transaksi'] ?>
                </p>
            </div>

            <div class="mb-3 mt-3">
                <label>Upload Bukti (jika transfer)</label>
                <input type="file" name="bukti" class="form-control">
            </div>

            <button class="btn btn-dark w-100">
                ✔ Bayar Denda
            </button>

        </form>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let metodeSelect = document.querySelector('select[name="metode"]');
    let transferBox = document.getElementById('transferBox');

    metodeSelect.addEventListener('change', function () {
        if (this.value === 'transfer') {
            transferBox.style.display = 'block';
        } else {
            transferBox.style.display = 'none';
        }
    });
});
</script>

<?= $this->endSection() ?>