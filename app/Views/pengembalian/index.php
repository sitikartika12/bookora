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

.badge-denda {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 10px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Data Pengembalian</h4>
            <small class="text-muted">Riwayat pengembalian buku</small>
        </div>

        <?php if (session()->get('role') == 'anggota') : ?>
            <a href="<?= base_url('pengembalian/create') ?>" class="btn btn-dark btn-custom">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>ID Peminjaman</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($pengembalian)) : ?>
                        <?php $no = 1; foreach ($pengembalian as $p): ?>

                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <span class="badge bg-secondary">
                                    #<?= $p['id_peminjaman'] ?>
                                </span>
                            </td>

                            <td>
                                <?= !empty($p['tanggal_dikembalikan']) 
                                    ? $p['tanggal_dikembalikan'] 
                                    : '<span class="text-muted">-</span>' ?>
                            </td>

                            <td>
                                <?php if ((float)$p['denda'] > 0): ?>
                                    <span class="badge bg-danger badge-denda">
                                        Rp <?= number_format($p['denda'],0,',','.') ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success badge-denda">
                                        Tidak ada
                                    </span>
                                <?php endif; ?>
                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Tidak ada data pengembalian
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>