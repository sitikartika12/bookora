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

.cover-img {
    border-radius: 10px;
    object-fit: cover;
}

.badge-soft {
    background: #eef2ff;
    color: #6a5af9;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Data Buku</h4>
            <small class="text-muted">Daftar semua buku</small>
        </div>

        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
            <a href="<?= base_url('buku/create') ?>" class="btn btn-dark btn-custom">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <!-- SEARCH -->
    <div class="table-card mb-3">
        <form method="get" class="row g-2">

            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Cari judul..."
                       value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary btn-custom">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('buku') ?>" class="btn btn-light btn-custom">
                    Reset
                </a>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('buku/print?' . http_build_query($_GET)) ?>"
                   target="_blank"
                   class="btn btn-success btn-custom">
                    <i class="bi bi-printer"></i> Print
                </a>
            </div>

        </form>
    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>ISBN</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Rak</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($buku)): ?>
                        <?php $no = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                        <?php foreach ($buku as $b): ?>
                            <tr>

                                <td><?= $no++ ?></td>

                                <td>
                                    <?php if ($b['cover']): ?>
                                        <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                                             width="50" class="cover-img">
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="fw-semibold"><?= $b['judul'] ?></div>
                                    <small class="text-muted"><?= $b['tahun_terbit'] ?></small>
                                </td>

                                <td><?= $b['isbn'] ?: '-' ?></td>

                                <td>
                                    <span class="badge-soft">
                                        <?= $b['nama_kategori'] ?? '-' ?>
                                    </span>
                                </td>

                                <td><?= $b['nama_penulis'] ?? '-' ?></td>

                                <td><?= $b['nama_rak'] ?? '-' ?></td>

                                <td>
                                    <span class="badge bg-success">
                                        <?= $b['tersedia'] ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex gap-1 flex-wrap">

                                        <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                                           class="btn btn-sm btn-light">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>
                                            <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>"
                                               class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="<?= base_url('buku/wa/' . $b['id_buku']) ?>"
                                           target="_blank"
                                           class="btn btn-sm btn-success">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>

                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                                               onclick="return confirm('Hapus buku ini?')"
                                               class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>

                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                Belum ada data buku
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3">
            <?= $pager->links() ?>
        </div>

    </div>

</div>

<?= $this->endSection() ?>