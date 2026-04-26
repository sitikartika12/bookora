<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.form-card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.form-control {
    border-radius: 12px;
    padding: 10px;
}

.btn-custom {
    border-radius: 20px;
    padding: 8px 18px;
}

.form-label {
    font-weight: 500;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Kategori</h4>
        <small class="text-muted">Masukkan kategori baru</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('kategori/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori"
                       class="form-control"
                       placeholder="Masukkan nama kategori"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('kategori') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>