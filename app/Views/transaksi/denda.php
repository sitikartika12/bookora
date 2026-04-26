<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.page-card {
    background: #fff;
    padding: 20px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

.badge-id {
    font-size: 13px;
}

.btn-custom {
    border-radius: 18px;
    padding: 4px 10px;
}
</style>

<div class="container">

    <div class="mb-3">
        <h4 class="fw-bold">Data Denda</h4>
        <small class="text-muted">Daftar denda peminjaman yang perlu diverifikasi</small>
    </div>

    <div class="page-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Peminjaman</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($denda)): ?>
                        <?php foreach ($denda as $d): ?>

                            <tr>

                                <!-- ID -->
                                <td>
                                    <span class="badge bg-dark badge-id">
                                        #<?= $d['id_transaksi'] ?>
                                    </span>
                                </td>

                                <!-- PEMINJAMAN -->
                                <td>
                                    <?= $d['id_peminjaman'] ?>
                                </td>

                                <!-- JUMLAH -->
                                <td>
                                    <span class="badge bg-danger">
                                        Rp <?= number_format($d['jumlah'],0,',','.') ?>
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <?php
                                        $warna = ($d['status'] == 'lunas') ? 'success' : 'warning';
                                    ?>
                                    <span class="badge bg-<?= $warna ?>">
                                        <?= $d['status'] ?>
                                    </span>
                                </td>

                                <!-- AKSI -->
                                <td>

                                    <a href="<?= base_url('transaksi/verifikasi/'.$d['id_transaksi']) ?>"
                                       class="btn btn-sm btn-success btn-custom">
                                        ✔ Verifikasi
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Tidak ada data denda
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>