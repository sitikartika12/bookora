<div class="menu">

    <a href="<?= base_url('/') ?>" class="active">
        <i class="bi bi-grid"></i> Dashboard
    </a>

    <!-- ADMIN & PETUGAS -->
    <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

        <a href="<?= base_url('/users') ?>">
            <i class="bi bi-people"></i> Users
        </a>

        <a href="<?= base_url('/buku') ?>">
            <i class="bi bi-book"></i> Buku
        </a>

        <a href="<?= base_url('/kategori') ?>">
            <i class="bi bi-tags"></i> Kategori
        </a>

        <a href="<?= base_url('/penulis') ?>">
            <i class="bi bi-pencil"></i> Penulis
        </a>

        <a href="<?= base_url('/penerbit') ?>">
            <i class="bi bi-building"></i> Penerbit
        </a>

        <a href="<?= base_url('/pengiriman') ?>">
            <i class="bi bi-truck"></i> Pengiriman
        </a>

        <a href="<?= base_url('/transaksi') ?>">
            <i class="bi bi-cash-stack"></i> Transaksi
        </a>

    <?php endif; ?>

    <!-- NOTIF DENDA -->
    <?php if (session()->get('role') == 'petugas') : ?>

        <?php
        $db = \Config\Database::connect();
        $notifDendaCount = $db->table('transaksi')
            ->where('jenis', 'denda')
            ->where('status', 'menunggu_verifikasi')
            ->countAllResults();
        ?>

        <a href="<?= base_url('/transaksi/denda') ?>" class="d-flex justify-content-between align-items-center">
            <span><i class="bi bi-exclamation-triangle"></i> Denda</span>

            <?php if ($notifDendaCount > 0): ?>
                <span class="badge bg-danger rounded-pill"><?= $notifDendaCount ?></span>
            <?php endif; ?>
        </a>

    <?php endif; ?>

    <!-- ANGGOTA -->
    <?php if (session()->get('role') == 'anggota') : ?>
        <a href="<?= base_url('/buku') ?>">
            <i class="bi bi-book"></i> Buku
        </a>

        <a href="<?= base_url('/anggota/profil') ?>">
            <i class="bi bi-person"></i> Profil
        </a>
    <?php endif; ?>

    <!-- UMUM -->
    <a href="<?= base_url('/peminjaman') ?>">
        <i class="bi bi-journal"></i> Peminjaman
    </a>

    <a href="<?= base_url('/pengembalian') ?>">
        <i class="bi bi-arrow-repeat"></i> Pengembalian
    </a>

    <?php if (session()->get('role') != 'anggota') : ?>
        <a href="<?= base_url('/rak') ?>">
            <i class="bi bi-bookshelf"></i> Rak
        </a>
    <?php endif; ?>

    <a href="<?= base_url('users/edit/' . session('id')) ?>">
        <i class="bi bi-gear"></i> Setting
    </a>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/backup') ?>">
            <i class="bi bi-database"></i> Backup
        </a>
    <?php endif; ?>

    <a href="<?= base_url('/logout') ?>">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>

<hr>

<!-- PROFILE -->
<div class="text-center mt-3">

    <?php if (!empty(session('foto'))): ?>
        <img src="<?= base_url('uploads/users/' . session('foto')) ?>" 
             class="rounded-circle mb-2" width="70" height="70">
    <?php else: ?>
        <i class="bi bi-person-circle fs-1"></i>
    <?php endif; ?>

    <div class="fw-semibold"><?= session('nama') ?></div>
    <small class="text-muted"><?= session('role') ?></small>

</div>