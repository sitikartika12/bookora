<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.table-card {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.badge-status {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 10px;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-3">
        <h4 class="fw-bold">Status Pengiriman Saya</h4>
        <small class="text-muted">Informasi pengiriman buku</small>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Biaya</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($pengiriman)): ?>
                        <?php foreach ($pengiriman as $p): ?>

                        <tr>

                            <td>
                                <small><?= $p['alamat'] ?></small>
                            </td>

                            <!-- STATUS -->
                            <td>
                                <?php
                                    $color = 'secondary';
                                    if ($p['status'] == 'menunggu') $color='warning';
                                    elseif ($p['status'] == 'diproses') $color='primary';
                                    elseif ($p['status'] == 'dikirim') $color='info';
                                    elseif ($p['status'] == 'selesai') $color='success';
                                ?>
                                <span class="badge bg-<?= $color ?> badge-status">
                                    <?= $p['status'] ?>
                                </span>
                            </td>

                            <!-- BIAYA -->
                            <td>
                                <span class="badge bg-dark">
                                    Rp <?= number_format($p['biaya'],0,',','.') ?>
                                </span>
                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Tidak ada data pengiriman
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>