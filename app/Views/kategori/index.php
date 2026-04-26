<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.table-card {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.form-control {
    border-radius: 12px;
}

.btn-custom {
    border-radius: 20px;
    padding: 6px 15px;
}

.table thead {
    background: #f1f3f9;
}

.table td, .table th {
    vertical-align: middle;
}
</style>

<div class="container">

    <!-- TITLE + BUTTON -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Data Kategori</h4>
            <small class="text-muted">Daftar kategori buku</small>
        </div>

        <a href="<?= base_url('kategori/create') ?>" class="btn btn-dark btn-custom">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <!-- SEARCH -->
    <div class="table-card mb-3">
        <form method="get" class="row g-2">

            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Cari kategori..."
                       value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary btn-custom">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('kategori') ?>" class="btn btn-light btn-custom">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($kategori)) : ?>

                        <?php $no=1; foreach($kategori as $k): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <span class="fw-semibold"><?= $k['nama_kategori'] ?></span>
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="<?= base_url('kategori/edit/'.$k['id_kategori']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('kategori/delete/'.$k['id_kategori']) ?>"
                                       onclick="return confirm('Hapus kategori ini?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>
                        <?php endforeach; ?>

                    <?php else : ?>

                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                <?php if (!empty($_GET['keyword'])) : ?>
                                    Data kategori "<b><?= $_GET['keyword'] ?></b>" tidak ditemukan
                                <?php else : ?>
                                    Belum ada data kategori
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