<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
body {
    background: #f5f7fb;
    font-family: 'Segoe UI', sans-serif;
}

/* CARD UTAMA */
.custom-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* MINI CARD */
.mini-card {
    background: #f1f3f9;
    padding: 12px;
    border-radius: 15px;
    text-align: center;
    transition: 0.3s;
}

.mini-card:hover {
    transform: translateY(-3px);
}

/* HIGHLIGHT */
.mini-card.highlight {
    background: linear-gradient(135deg, #6a5af9, #8b7bff);
    color: white;
}

/* GRADIENT CARD */
.gradient-card {
    background: linear-gradient(135deg, #5f9cff, #7b61ff);
    border-radius: 20px;
}

/* FAKE CHART */
.fake-chart {
    height: 120px;
    background: linear-gradient(to top, #6a5af9, transparent);
    border-radius: 10px;
    margin-top: 10px;
}

/* BUTTON */
.btn-dark {
    border-radius: 20px;
    padding: 6px 15px;
}

.btn-light {
    border-radius: 20px;
    padding: 6px 15px;
}

/* TABLE */
.table tr {
    border-bottom: 1px solid #eee;
}

</style>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <small class="text-muted">Selamat datang di <b>Bookora App</b></small>
        </div>
        <div>
            <i class="bi bi-bell fs-5 me-3"></i>
            <i class="bi bi-person-circle fs-4"></i>
        </div>
    </div>

    <!-- CARD SALDO -->
    <div class="card custom-card mb-4">
        <div class="card-body">
            <h6 class="text-muted">Total Saldo</h6>
            <h3 class="fw-bold">Rp 73.558.000</h3>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="mini-card">
                        <small>Dipinjam</small>
                        <h6>Rp 10jt</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mini-card highlight">
                        <small>Dikembalikan</small>
                        <h6>Rp 23jt</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mini-card">
                        <small>Sisa</small>
                        <h6>Rp 39jt</h6>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-light btn-sm">Terima</button>
                <button class="btn btn-dark btn-sm">Kirim</button>
            </div>
        </div>
    </div>

    <!-- GRID -->
    <div class="row">
        <div class="col-md-8">
            <div class="card custom-card mb-4">
                <div class="card-body">
                    <h6 class="fw-semibold">Statistik Peminjaman</h6>
                    <p class="text-muted">Data bulanan</p>
                    <div class="fake-chart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card custom-card gradient-card text-white mb-4">
                <div class="card-body">
                    <h6>Kesehatan Sistem</h6>
                    <h2>85%</h2>
                    <small>Stabil</small>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card custom-card">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">Transaksi Terbaru</h6>
            <table class="table table-borderless">
                <tr>
                    <td>Pinjam Buku</td>
                    <td class="text-success">Selesai</td>
                    <td class="text-end">-</td>
                </tr>
                <tr>
                    <td>Denda</td>
                    <td class="text-warning">Pending</td>
                    <td class="text-end">Rp 50.000</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>