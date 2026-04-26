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

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Penerbit</h4>
        <small class="text-muted">Input data penerbit baru</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('penerbit/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Penerbit</label>
                <input type="text" name="nama_penerbit"
                       class="form-control"
                       placeholder="Masukkan nama penerbit"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('penerbit') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>