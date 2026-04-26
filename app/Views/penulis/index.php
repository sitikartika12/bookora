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
            <h4 class="fw-bold mb-0">Data Penulis</h4>
            <small class="text-muted">Manajemen data penulis</small>
        </div>

        <a href="<?= base_url('penulis/create') ?>" class="btn btn-dark btn-custom">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <div class="table-card">

        <!-- SEARCH -->
        <form method="get" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Cari penulis..."
                       value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-custom">
                    <i class="bi bi-search"></i>
                </button>
                <a href="<?= base_url('penulis') ?>" class="btn btn-outline-secondary btn-custom">
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
                        <th>Nama Penulis</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($penulis)) : ?>
                        <?php $no=1; foreach($penulis as $p): ?>

                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <span class="fw-semibold">
                                    <?= $p['nama_penulis'] ?>
                                </span>
                            </td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="<?= base_url('penulis/edit/'.$p['id_penulis']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('penulis/delete/'.$p['id_penulis']) ?>"
                                       onclick="return confirm('Hapus penulis ini?')"
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
                                    Data penulis "<?= $_GET['keyword'] ?>" tidak ditemukan
                                <?php else : ?>
                                    Belum ada data penulis
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