<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
/* STATUS LEMBUT */
.status-soft {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.status-success-soft {
    background: #e8f5e9;
    color: #1b5e20;
}

.status-warning-soft {
    background: #fff8e1;
    color: #8a6d1a;
}

.status-danger-soft {
    background: #fdecea;
    color: #7a1c14;
}
</style>

<div class="container mt-3">

    <div class="card shadow">

        <!-- HEADER -->
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="bi bi-cash-stack"></i> Data Denda</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>ID Peminjaman</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($denda)): ?>
                            <?php foreach ($denda as $d): ?>

                                <?php
                                    $status = $d['status'];

                                    if ($status == 'lunas') {
                                        $class = 'status-success-soft';
                                    } elseif ($status == 'pending' || $status == 'menunggu') {
                                        $class = 'status-warning-soft';
                                    } else {
                                        $class = 'status-danger-soft';
                                    }
                                ?>

                                <tr>
                                    <td><?= $d['id_transaksi'] ?></td>

                                    <td><?= $d['id_peminjaman'] ?></td>

                                    <td>
                                        Rp <?= number_format($d['jumlah'], 0, ',', '.') ?>
                                    </td>

                                    <td>
                                        <span class="status-soft <?= $class ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Tidak ada data denda
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>