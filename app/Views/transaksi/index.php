<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.page-card {
    background: #fff;
    padding: 20px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

.btn-custom {
    border-radius: 18px;
    padding: 4px 10px;
}

.badge-id {
    font-size: 13px;
}
</style>

<div class="container">

    <div class="mb-3">
        <h4 class="fw-bold">Data Transaksi</h4>
        <small class="text-muted">Kelola pembayaran denda & pengiriman</small>
    </div>

    <!-- FLASH MESSAGE -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="page-card">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $t): ?>

                        <tr>

                            <!-- NO -->
                            <td><?= $no++ ?></td>

                            <!-- PEMINJAMAN -->
                            <td>
                                <span class="badge bg-dark badge-id">
                                    #<?= $t['id_peminjaman'] ?>
                                </span>
                            </td>

                            <!-- JENIS -->
                            <td>
                                <span class="badge bg-primary">
                                    <?= ucfirst($t['jenis']) ?>
                                </span>
                            </td>

                            <!-- JUMLAH -->
                            <td>
                                <span class="badge bg-danger">
                                    Rp <?= number_format($t['jumlah'],0,',','.') ?>
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php
                                    if ($t['status'] == 'lunas') $color = 'success';
                                    elseif ($t['status'] == 'menunggu_verifikasi') $color = 'warning';
                                    elseif ($t['status'] == 'ditolak') $color = 'danger';
                                    else $color = 'secondary';
                                ?>
                                <span class="badge bg-<?= $color ?>">
                                    <?= ucfirst(str_replace('_',' ', $t['status'])) ?>
                                </span>
                            </td>

                            <!-- METODE -->
                            <td><?= $t['metode_pembayaran'] ?? '-' ?></td>

                            <!-- BUKTI -->
                            <td>
                                <?php if (!empty($t['bukti_pembayaran'])): ?>
                                    <a href="<?= base_url('uploads/bukti/' . $t['bukti_pembayaran']) ?>"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary btn-custom">
                                        Lihat
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td>

                                <?php if ($t['status'] == 'menunggu_verifikasi'): ?>

                                    <a href="<?= base_url('transaksi/verifikasi/' . $t['id_transaksi']) ?>"
                                       class="btn btn-sm btn-success btn-custom">
                                        ✔ Verifikasi
                                    </a>

                                    <a href="<?= base_url('transaksi/tolak/' . $t['id_transaksi']) ?>"
                                       class="btn btn-sm btn-danger btn-custom">
                                        ❌ Tolak
                                    </a>

                                <?php elseif ($t['status'] == 'lunas'): ?>

                                    <span class="badge bg-success">Selesai</span>

                                <?php else: ?>
                                    -
                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>