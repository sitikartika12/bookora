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
            <h4 class="fw-bold mb-0">Data Penerbit</h4>
            <small class="text-muted">Daftar penerbit buku</small>
        </div>

        <a href="<?= base_url('penerbit/create') ?>" class="btn btn-dark btn-custom">
            <i class="bi bi-plus"></i> Tambah
        </a>
    </div>

    <div class="table-card">

        <!-- SEARCH -->
        <form method="get" class="row g-2 mb-3">

            <div class="col-md-4">
                <input type="text"
                       name="keyword"
                       class="form-control"
                       placeholder="Cari penerbit..."
                       value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <div class="col-auto">
                <button class="btn btn-primary btn-custom">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <div class="col-auto">
                <a href="<?= base_url('penerbit') ?>" class="btn btn-light btn-custom">
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
                        <th>Nama Penerbit</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($penerbit)) : ?>
                        <?php $no=1; foreach($penerbit as $p): ?>

                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= $p['nama_penerbit'] ?></td>

                            <td>
                                <div class="d-flex gap-1">

                                    <a href="<?= base_url('penerbit/edit/'.$p['id_penerbit']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <a href="<?= base_url('penerbit/delete/'.$p['id_penerbit']) ?>"
                                       onclick="return confirm('Hapus data?')"
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
                                    Data "<b><?= $_GET['keyword'] ?></b>" tidak ditemukan
                                <?php else : ?>
                                    Belum ada data penerbit
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