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
        <h4 class="fw-bold">Tambah Pengembalian</h4>
        <small class="text-muted">Pilih data peminjaman untuk dikembalikan</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('pengembalian/store') ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Pilih Peminjaman</label>
                <select name="id_peminjaman" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($peminjaman as $p): ?>
                        <option value="<?= $p['id_peminjaman'] ?>">
                            ID <?= $p['id_peminjaman'] ?> | <?= $p['tanggal_pinjam'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('pengembalian') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>