<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* FORM CARD */
.form-card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* INPUT */
.form-control, .form-select {
    border-radius: 12px;
    padding: 10px;
    font-size: 14px;
}

/* BUTTON */
.btn-custom {
    border-radius: 20px;
    padding: 8px 18px;
}

/* LABEL */
.form-label {
    font-weight: 500;
    margin-bottom: 5px;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Tambah Anggota</h4>
        <small class="text-muted">Tambahkan data anggota baru</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('anggota/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">User</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Pilih User --</option>
                    <?php foreach ($users as $u): ?>
                        <option value="<?= $u['id'] ?>"><?= $u['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('anggota') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>