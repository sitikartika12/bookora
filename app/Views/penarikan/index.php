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
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.btn-custom {
    border-radius: 20px;
    padding: 5px 12px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="mb-3">
        <h4 class="fw-bold mb-0">Data Penarikan</h4>
        <small class="text-muted">Proses penarikan buku</small>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pinjam</th>
                        <th>Alamat</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Tanggal Ambil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no=1; foreach($penarikan as $p): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td>#<?= $p['id_peminjaman'] ?></td>

                        <td>
                            <small><?= $p['alamat'] ?></small>
                        </td>

                        <td>
                            Rp <?= number_format($p['biaya'],0,',','.') ?>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php
                                $color = 'secondary';
                                if ($p['status']=='menunggu') $color='warning';
                                elseif ($p['status']=='diproses') $color='primary';
                                elseif ($p['status']=='diambil') $color='info';
                                elseif ($p['status']=='selesai') $color='success';
                            ?>
                            <span class="badge bg-<?= $color ?>">
                                <?= $p['status'] ?>
                            </span>
                        </td>

                        <!-- TANGGAL -->
                        <td>
                            <?= (!empty($p['tanggal_ambil']) && $p['tanggal_ambil'] != '0000-00-00')
                                ? $p['tanggal_ambil']
                                : '-' ?>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="d-flex flex-wrap gap-1">

                                <!-- PETUGAS -->
                                <?php if (session()->get('role') == 'petugas'): ?>

                                    <?php if ($p['status'] == 'menunggu'): ?>
                                        <a href="<?= base_url('penarikan/proses/'.$p['id_penarikan']) ?>"
                                           class="btn btn-sm btn-warning">
                                            Proses
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'diproses'): ?>
                                        <a href="<?= base_url('penarikan/ambil/'.$p['id_penarikan']) ?>"
                                           class="btn btn-sm btn-primary">
                                            Ambil
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'diambil'): ?>
                                        <a href="<?= base_url('penarikan/selesai/'.$p['id_penarikan']) ?>"
                                           class="btn btn-sm btn-success">
                                            Selesai
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <!-- ANGGOTA -->
                                <?php if (session()->get('role') == 'anggota'): ?>

                                    <?php if ($p['metode'] == 'antar' && $p['status'] == 'dipinjam'): ?>
                                        <a href="<?= base_url('penarikan/buat/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-dark">
                                            Ajukan
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>
                        </td>

                    </tr>

                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

<?= $this->endSection() ?>