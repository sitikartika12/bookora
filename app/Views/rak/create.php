<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.form-card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    max-width: 500px;
}

.btn-custom {
    border-radius: 20px;
    padding: 6px 15px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold mb-0">Tambah Rak</h4>
        <small class="text-muted">Tambahkan lokasi rak buku</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('rak/store') ?>" method="post">

            <!-- NAMA RAK -->
            <div class="mb-3">
                <label class="form-label">Nama Rak</label>
                <input type="text" name="nama_rak" class="form-control"
                       placeholder="Contoh: Rak A1" required>
            </div>

            <!-- LOKASI -->
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control"
                       placeholder="Contoh: Lantai 2 - Ruang Baca" required>
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('rak') ?>" class="btn btn-outline-secondary btn-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>