<ul>

    <li>
        <a href="<?= base_url('/') ?>">Dashboard</a>
    </li>

    <!-- ADMIN & PETUGAS -->
    <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

        <li><a href="<?= base_url('/users') ?>">Users</a></li>
        <li><a href="<?= base_url('/buku') ?>">Buku</a></li>

        <li><a href="<?= base_url('/kategori') ?>">Kategori</a></li>
        <li><a href="<?= base_url('/penulis') ?>">Penulis</a></li>
        <li><a href="<?= base_url('/penerbit') ?>">Penerbit</a></li>

        <li><a href="<?= base_url('/pengiriman') ?>">Pengiriman</a></li>
         <li><a href="<?= base_url('/transaksi') ?>">transaksi</a></li>


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

        <li>
            <a href="<?= base_url('/transaksi/denda') ?>">
                🚨 Denda
                <?php if ($notifDendaCount > 0): ?>
                    <span style="color:red;">(<?= $notifDendaCount ?>)</span>
                <?php endif; ?>
            </a>
        </li>

    <?php endif; ?>

    <!-- ANGGOTA -->
    <?php if (session()->get('role') == 'anggota') : ?>
        <li><a href="<?= base_url('/buku') ?>">Buku</a></li>
        <li><a href="<?= base_url('/anggota/profil') ?>">Profil</a></li>
    <?php endif; ?>

    <!-- UMUM -->
    <li><a href="<?= base_url('/peminjaman') ?>">Peminjaman</a></li>
    <li><a href="<?= base_url('/pengembalian') ?>">Pengembalian</a></li>

    <?php if (session()->get('role') != 'anggota') : ?>
        <li><a href="<?= base_url('/rak') ?>">Rak</a></li>
    <?php endif; ?>

    <li>
        <a href="<?= base_url('users/edit/' . session('id')) ?>">Setting</a>
    </li>

    <?php if (session()->get('role') == 'admin') : ?>
        <li><a href="<?= base_url('/backup') ?>">Backup</a></li>
    <?php endif; ?>

    <li><a href="<?= base_url('/logout') ?>">Logout</a></li>

</ul>

<br>

Masuk sebagai:<br>
<b><?= session('nama') ?> (<?= session('role') ?>)</b>

<br><br>

<?php if (!empty(session('foto'))): ?>
    <img src="<?= base_url('uploads/users/' . session('foto')) ?>" height="80">
<?php endif; ?>