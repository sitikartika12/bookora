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

.cover-preview {
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    object-fit: cover;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Edit Buku</h4>
        <small class="text-muted">Perbarui data buku</small>
    </div>

    <!-- FORM -->
    <div class="form-card">

        <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- KIRI -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control"
                               value="<?= $buku['judul'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control"
                               value="<?= $buku['isbn'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>"
                                    <?= ($buku['id_kategori'] == $k['id_kategori']) ? 'selected' : '' ?>>
                                    <?= $k['nama_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="kategori_baru" class="form-control mt-2"
                               placeholder="Tambah kategori baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="id_penulis" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penulis as $p): ?>
                                <option value="<?= $p['id_penulis'] ?>"
                                    <?= ($buku['id_penulis'] == $p['id_penulis']) ? 'selected' : '' ?>>
                                    <?= $p['nama_penulis'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penulis_baru" class="form-control mt-2"
                               placeholder="Tambah penulis baru">
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <select name="id_penerbit" class="form-select">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($penerbit as $p): ?>
                                <option value="<?= $p['id_penerbit'] ?>"
                                    <?= ($buku['id_penerbit'] == $p['id_penerbit']) ? 'selected' : '' ?>>
                                    <?= $p['nama_penerbit'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="penerbit_baru" class="form-control mt-2"
                               placeholder="Tambah penerbit baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rak</label>
                        <select name="id_rak" class="form-select">
                            <option value="">-- Pilih Rak --</option>
                            <?php foreach ($rak as $r): ?>
                                <option value="<?= $r['id_rak'] ?>"
                                    <?= ($buku['id_rak'] ?? '') == $r['id_rak'] ? 'selected' : '' ?>>
                                    <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun_terbit" class="form-control"
                                   value="<?= $buku['tahun_terbit'] ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control"
                                   value="<?= $buku['jumlah'] ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tersedia</label>
                            <input type="number" name="tersedia" class="form-control"
                                   value="<?= $buku['tersedia'] ?>">
                        </div>
                    </div>

                </div>

            </div>

            <!-- DESKRIPSI -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= $buku['deskripsi'] ?></textarea>
            </div>

            <!-- COVER -->
            <input type="hidden" name="old_cover" value="<?= $buku['cover'] ?>">

            <div class="mb-3">
                <label class="form-label">Cover</label><br>

                <?php if ($buku['cover']): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" 
                         width="90" class="cover-preview mb-2"><br>
                <?php endif; ?>

                <input type="file" name="cover" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti cover</small>
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark btn-custom">
                    <i class="bi bi-save"></i> Update
                </button>

                <a href="<?= base_url('buku') ?>" class="btn btn-light btn-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>