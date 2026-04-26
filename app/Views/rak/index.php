<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.table-card {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.btn-custom {
    border-radius: 20px;
    padding: 5px 12px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Data Rak</h4>
            <small class="text-muted">Manajemen lokasi rak buku</small>
        </div>

        <a href="<?= base_url('rak/create') ?>" class="btn btn-dark btn-custom">
            <i class="bi bi-plus"></i> Tambah Rak
        </a>
    </div>

    <div class="table-card">

        <!-- SEARCH -->
        <form method="get" class="row g-2 mb-3">

            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Cari rak atau lokasi..."
                       value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary btn-custom" type="submit">
                    <i class="bi bi-search"></i>
                </button>

                <a href="<?= base_url('rak') ?>" class="btn btn-outline-secondary btn-custom">
                    Reset
                </a>
            </div>

        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Rak</th>
                        <th>Lokasi</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($rak)) : ?>
                        <?php $no=1; foreach($rak as $r): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <span class="fw-semibold">
                                    <?= $r['nama_rak'] ?>
                                </span>
                            </td>

                            <td>
                                <small class="text-muted">
                                    <?= $r['lokasi'] ?>
                                </small>
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="<?= base_url('rak/edit/'.$r['id_rak']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('rak/delete/'.$r['id_rak']) ?>"
                                       onclick="return confirm('Hapus rak ini?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                <?php if (!empty($_GET['keyword'])) : ?>
                                    Data rak tidak ditemukan
                                <?php else : ?>
                                    Belum ada data rak
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>