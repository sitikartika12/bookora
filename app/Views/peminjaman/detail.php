<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
.card-box {
    background: #fff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.label {
    font-size: 13px;
    color: #888;
}

.value {
    font-weight: 500;
}

.badge-status {
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.selected-item {
    border-radius: 10px;
    padding: 10px;
    background: #f8f9fa;
    margin-bottom: 10px;
}
</style>

<div class="container">

    <!-- TITLE -->
    <div class="mb-4">
        <h4 class="fw-bold">Detail Peminjaman</h4>
        <small class="text-muted">Informasi lengkap peminjaman</small>
    </div>

    <!-- DATA PEMINJAMAN -->
    <div class="card-box">
        <div class="row">

            <div class="col-md-6 mb-3">
                <div class="label">Nama Anggota</div>
                <div class="value"><?= $peminjaman['nama_anggota'] ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="label">Status</div>
                <span class="badge-status 
                    <?= $peminjaman['status']=='selesai' ? 'bg-success' : 'bg-warning' ?>">
                    <?= $peminjaman['status'] ?>
                </span>
            </div>

            <div class="col-md-6 mb-3">
                <div class="label">Tanggal Pinjam</div>
                <div class="value"><?= $peminjaman['tanggal_pinjam'] ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="label">Tanggal Kembali</div>
                <div class="value"><?= $peminjaman['tanggal_kembali'] ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="label">Alamat</div>
                <div class="value"><?= $peminjaman['alamat'] ?? '-' ?></div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="label">No HP</div>
                <div class="value"><?= $peminjaman['no_hp'] ?? '-' ?></div>
            </div>

        </div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="card-box">
        <h6 class="fw-bold mb-3">Pembayaran</h6>

        <?php if (!empty($transaksi)): ?>
            <?php foreach ($transaksi as $t): ?>

                <div class="selected-item">

                    <b><?= strtoupper($t['jenis']) ?></b><br>
                    Rp <?= number_format($t['jumlah'], 0, ',', '.') ?><br>

                    Status:
                    <span class="badge 
                        <?= $t['status']=='lunas' ? 'bg-success' : 'bg-danger' ?>">
                        <?= $t['status'] ?>
                    </span><br>

                    Metode: <?= $t['metode_pembayaran'] ?? '-' ?><br><br>

                    <?php if ($t['status'] != 'lunas'): ?>

                        <?php if ($t['jenis'] == 'denda'): ?>
                           <a href="<?= base_url('transaksi/denda/bayar/'.$t['id_transaksi']) ?>"
   class="btn btn-sm btn-danger">
    💰 Bayar Denda
</a>
                        <?php endif; ?>

                        <?php if ($t['jenis'] == 'pengiriman'): ?>
                            <a href="<?= base_url('transaksi/pilih-metode/'.$peminjaman['id_peminjaman']) ?>"
   class="btn btn-sm btn-warning">
    🚚 Bayar Pengiriman
</a>
                        <?php endif; ?>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-muted">Tidak ada transaksi</div>
        <?php endif; ?>
    </div>

    <!-- PENARIKAN -->
    <?php if ($penarikan): ?>
    <div class="card-box">
        <h6 class="fw-bold">Penarikan</h6>

        Status:
        <span class="badge bg-info"><?= $penarikan['status'] ?></span>

        <?php if (session()->get('role') == 'petugas'): ?>
            <br><br>
            <a href="<?= base_url('penarikan/ambil/'.$penarikan['id_penarikan']) ?>"
               class="btn btn-dark btn-sm">
                Ambil
            </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- DAFTAR BUKU -->
    <div class="card-box">
        <h6 class="fw-bold mb-3">Daftar Buku</h6>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no=1; foreach ($detail as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['judul'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- BUTTON -->
    <a href="<?= base_url('peminjaman') ?>" class="btn btn-light">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

<?= $this->endSection() ?>