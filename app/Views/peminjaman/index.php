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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Data Peminjaman</h4>
            <small class="text-muted">Daftar transaksi peminjaman</small>
        </div>

        <?php if (session()->get('role') == 'anggota') : ?>
            <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-dark btn-custom">
                <i class="bi bi-plus"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Petugas</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; foreach ($peminjaman as $p): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= $p['nama_anggota'] ?></td>

                        <td><?= $p['nama_petugas'] ?? '-' ?></td>

                        <td>
                            <span class="badge bg-info">
                                <?= $p['metode'] ?>
                            </span>
                        </td>

                        <td>
                            <small>
                                Pinjam: <?= $p['tanggal_pinjam'] ?><br>
                                Kembali: <?= $p['tanggal_kembali'] ?>
                            </small>
                        </td>

                        <!-- STATUS -->
                        <td>
                            <?php
                                $color = 'secondary';
                                if ($p['status']=='diproses') $color='primary';
                                elseif ($p['status']=='diantar') $color='warning';
                                elseif ($p['status']=='dipinjam') $color='success';
                                elseif ($p['status']=='dikembalikan') $color='dark';
                            ?>
                            <span class="badge bg-<?= $color ?>">
                                <?= $p['status'] ?>
                            </span>
                        </td>

                        <!-- PEMBAYARAN -->
                        <td>
                            <small>

                            <?php if ($p['metode'] == 'antar'): ?>
                                🚚 Pengiriman<br>
                            <?php endif; ?>

                            <?php if (!empty($p['status_denda']) && $p['status_denda'] != 'tidak_ada'): ?>
                                💰 Denda: Rp <?= number_format($p['denda'],0,',','.') ?><br>
                                Status: <?= $p['status_denda'] ?><br>
                            <?php endif; ?>

                            <?php if ($p['metode'] == 'antar' && !empty($p['bukti_pembayaran'])): ?>
                                <a href="<?= base_url('uploads/bukti/' . $p['bukti_pembayaran']) ?>" target="_blank">
                                    Lihat Bukti
                                </a>
                            <?php endif; ?>

                            </small>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="d-flex flex-wrap gap-1">

                                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>"
                                   class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- ANGGOTA -->
                                <?php if (session()->get('role') == 'anggota') : ?>

                                    <?php if ($p['metode']=='antar' && $p['status']=='menunggu_pembayaran'): ?>
                                        <a href="<?= base_url('transaksi/pilihMetode/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-success">
                                            Bayar
                                        </a>
                                    <?php endif; ?>


                                    <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>"
                                       onclick="return confirm('Hapus?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                <?php endif; ?>

                                <!-- PETUGAS -->
                                <?php if (session()->get('role') == 'petugas'): ?>

                                    <?php if ($p['status_pembayaran'] == 'menunggu_verifikasi'): ?>
                                            
                                        <a href="<?= base_url('transaksi/verifikasi/'.$p['id_transaksi']) ?>"
                                           class="btn btn-sm btn-success">✔</a>

                                        <a href="<?= base_url('transaksi/tolak/'.$p['id_transaksi']) ?>"
                                           class="btn btn-sm btn-danger">✖</a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'diproses'): ?>
                                        <a href="<?= base_url('peminjaman/ambil/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-primary">
                                            Ambil
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($p['status'] == 'diantar'): ?>
                                        <a href="<?= base_url('peminjaman/selesai/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-dark">
                                            Selesai
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