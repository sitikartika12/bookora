<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.detail-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.label {
    font-size: 13px;
    color: #888;
}

.value {
    font-weight: 500;
}

.cover-img {
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    object-fit: cover;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Detail Buku</h4>
        <small class="text-muted">Informasi lengkap buku</small>
    </div>

    <div class="detail-card">

        <div class="row">

            <!-- COVER -->
            <div class="col-md-4 text-center mb-3">
                <?php if ($buku['cover']): ?>
                    <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" 
                         class="cover-img" width="180">
                <?php else: ?>
                    <div class="text-muted">Tidak ada cover</div>
                <?php endif; ?>
            </div>

            <!-- DETAIL -->
            <div class="col-md-8">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="label">Judul</div>
                        <div class="value"><?= $buku['judul'] ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="label">ISBN</div>
                        <div class="value"><?= $buku['isbn'] ?: '-' ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="label">Kategori</div>
                        <div class="value"><?= $buku['nama_kategori'] ?? '-' ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="label">Penulis</div>
                        <div class="value"><?= $buku['nama_penulis'] ?? '-' ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="label">Penerbit</div>
                        <div class="value"><?= $buku['nama_penerbit'] ?? '-' ?></div>
                    </div>

                    <div class="col-md-6">
                        <div class="label">Rak</div>
                        <div class="value"><?= $buku['nama_rak'] ?> - <?= $buku['lokasi'] ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="label">Tahun</div>
                        <div class="value"><?= $buku['tahun_terbit'] ?></div>
                    </div>

                    <div class="col-md-4">
                        <div class="label">Jumlah</div>
                        <div class="value"><?= $buku['jumlah'] ?></div>
                    </div>

                    <div class="col-md-4">
                        <div class="label">Tersedia</div>
                        <div class="value"><?= $buku['tersedia'] ?></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="label">Deskripsi</div>
                    <div class="value"><?= $buku['deskripsi'] ?: '-' ?></div>
                </div>

                <div class="mb-3">
                    <div class="label">Dibuat</div>
                    <div class="value"><?= $buku['created_at'] ?></div>
                </div>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="d-flex gap-2 mt-3">
            <a href="<?= base_url('buku') ?>" class="btn btn-light rounded-pill">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <a href="<?= base_url('buku/wa/' . $buku['id_buku']) ?>" target="_blank"
               class="btn btn-success rounded-pill">
                <i class="bi bi-whatsapp"></i> Kirim WA
            </a>
        </div>

    </div>

</div>

<?= $this->endSection() ?>