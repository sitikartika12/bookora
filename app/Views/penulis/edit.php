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
        <h4 class="fw-bold mb-0">Edit Penulis</h4>
        <small class="text-muted">Perbarui data penulis</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('penulis/update/'.$penulis['id_penulis']) ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Nama Penulis</label>
                <input type="text" 
                       name="nama_penulis" 
                       class="form-control"
                       value="<?= $penulis['nama_penulis'] ?>" 
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-custom">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="<?= base_url('penulis') ?>" class="btn btn-outline-secondary btn-custom">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>