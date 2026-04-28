<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>

/* BACKGROUND */
body {
    background: #f4f6fb;
}

/* CARD UTAMA */
.card-dashboard {
    border-radius: 18px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

/* STAT BOX WARNA */
.stat-box {
    border-radius: 14px;
    padding: 18px;
    color: #fff;
    text-align: center;
    transition: 0.3s;
}

.stat-box:hover {
    transform: translateY(-3px);
}

/* WARNA */
.bg-purple {
    background: linear-gradient(135deg, #6a5af9, #8b7bff);
}

.bg-blue {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}

.bg-green {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
}

.bg-orange {
    background: linear-gradient(135deg, #fa709a, #fee140);
}

/* LIST */
.activity-item {
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}

/* TITLE */
.section-title {
    font-weight: 600;
    margin-bottom: 10px;
}

</style>

<div class="container">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold">Dashboard</h4>
        <small class="text-muted">Ringkasan perpustakaan</small>
    </div>

    <!-- =========================
         STATISTIK BERWARNA
    ========================== -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="stat-box bg-purple">
                <small>Total Buku</small>
                <h3><?= $total_buku ?? 0 ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box bg-blue">
                <small>Total User</small>
                <h3><?= $total_user ?? 0 ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box bg-green">
                <small>Dipinjam</small>
                <h3><?= $dipinjam ?? 0 ?></h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-box bg-orange">
                <small>Dikembalikan</small>
                <h3><?= $kembali ?? 0 ?></h3>
            </div>
        </div>

    </div>

    <!-- =========================
         GRID BAWAH
    ========================== -->
    <div class="row">

        <!-- AKTIVITAS -->
        <div class="col-md-6">
            <div class="card-dashboard">

                <div class="section-title">📌 Aktivitas Terbaru</div>

                <?php if (!empty($aktivitas)): ?>
                    <?php foreach ($aktivitas as $a): ?>
                        <div class="activity-item">
                            <?= $a['keterangan'] ?><br>
                            <small class="text-muted"><?= $a['tanggal'] ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <small class="text-muted">Belum ada aktivitas</small>
                <?php endif; ?>

            </div>
        </div>

        <!-- BUKU -->
        <div class="col-md-6">
            <div class="card-dashboard">

                <div class="section-title">📚 Buku Terbaru</div>

                <?php if (!empty($buku)): ?>
                    <?php foreach ($buku as $b): ?>
                        <div class="activity-item d-flex align-items-center gap-2">

                            <?php if ($b['cover']): ?>
                                <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>" width="45" style="border-radius:6px;">
                            <?php endif; ?>

                            <div>
                                <b><?= $b['judul'] ?></b><br>
                                <small class="text-muted"><?= $b['tahun_terbit'] ?></small>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <small class="text-muted">Belum ada buku</small>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <!-- =========================
         NOTIFIKASI
    ========================== -->
    <div class="card-dashboard mt-4">

        <div class="section-title">🔔 Notifikasi</div>

        <?php if (!empty($telat)): ?>
            <div class="alert alert-warning">
                ⚠️ Ada <?= count($telat) ?> buku belum dikembalikan
            </div>
        <?php endif; ?>

        <?php if (!empty($denda)): ?>
            <div class="alert alert-danger">
                💰 Ada denda belum dibayar
            </div>
        <?php endif; ?>

        <?php if (empty($telat) && empty($denda)): ?>
            <small class="text-muted">Tidak ada notifikasi</small>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>