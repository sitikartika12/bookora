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

.btn-custom {
    border-radius: 20px;
    padding: 5px 12px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold mb-0">Data Pengiriman</h4>
        <small class="text-muted">Manajemen pengiriman buku</small>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Biaya</th>
                        <th>Petugas</th>

                        <?php if (session()->get('role') != 'admin') : ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($pengiriman as $p): ?>

                    <tr>

                        <td>
                            <span class="badge bg-secondary">
                                #<?= $p['id_pengiriman'] ?>
                            </span>
                        </td>

                        <td>
                            <small><?= $p['alamat'] ?></small>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php
                                $color = 'secondary';
                                if ($p['status']=='menunggu') $color='warning';
                                elseif ($p['status']=='diproses') $color='primary';
                                elseif ($p['status']=='dikirim') $color='info';
                                elseif ($p['status']=='selesai') $color='success';
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

                        <!-- PETUGAS -->
                        <td>
                            <?= $p['petugas_id'] ?? '-' ?>
                        </td>

                        <!-- AKSI -->
                        <?php if (session()->get('role') != 'admin') : ?>
                        <td>
                            <div class="d-flex flex-wrap gap-1">

                                <?php if (session()->get('role') == 'petugas'): ?>

                                    <?php if ($p['status'] == 'menunggu'): ?>
                                        <a href="<?= base_url('pengiriman/ambil/'.$p['id_pengiriman']) ?>"
                                           class="btn btn-sm btn-warning">
                                            Ambil
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'diproses'): ?>
                                        <a href="<?= base_url('pengiriman/kirim/'.$p['id_pengiriman']) ?>"
                                           class="btn btn-sm btn-primary">
                                            Kirim
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'dikirim'): ?>
                                        <a href="<?= base_url('pengiriman/sampai/'.$p['id_pengiriman']) ?>"
                                           class="btn btn-sm btn-success">
                                            Selesai
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>
                        </td>
                        <?php endif; ?>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>