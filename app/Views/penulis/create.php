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
        <h4 class="fw-bold mb-0">Tambah Penulis</h4>
        <small class="text-muted">Tambahkan data penulis baru</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('penulis/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Penulis</label>
                <input type="text" name="nama_penulis" class="form-control"
                       placeholder="Masukkan nama penulis" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('penulis') ?>" class="btn btn-outline-secondary btn-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>