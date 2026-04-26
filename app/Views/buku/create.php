<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.form-card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.form-control, .form-select {
    border-radius: 12px;
    padding: 10px;
    font-size: 14px;
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
        <h4 class="fw-bold">Tambah Buku</h4>
        <small class="text-muted">Masukkan data buku baru</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- KIRI -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>">
                                    <?= $k['nama_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="kategori_baru" class="form-control mt-2" placeholder="Tambah kategori baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>">
                                    <?= $p['nama_penulis'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penulis_baru" class="form-control mt-2" placeholder="Tambah penulis baru">
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>">
                                    <?= $p['nama_penerbit'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penerbit_baru" class="form-control mt-2" placeholder="Tambah penerbit baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">-- Pilih Rak --</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>">
                                    <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun_terbit" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>

                </div>

            </div>

            <!-- FULL WIDTH -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <a href="<?= base_url('buku') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>