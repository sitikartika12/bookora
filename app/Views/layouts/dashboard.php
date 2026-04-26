<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

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
                        <h6>Rp 0</h6>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mini-card">
                        <small>Sisa</small>
                        <h6>Rp 0</h6>
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
            <div class="card custom-card mb-4 gradient-card text-white">
                <div class="card-body">
                    <h6>Kesehatan Sistem</h6>
                    <h2>0%</h2>
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
                    <td class="text-end">Rp 0</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>