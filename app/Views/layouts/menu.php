<ul>

    <li>
        <a href="<?= base_url('/') ?>">Dashboard</a>
    </li>

    <!-- ADMIN & PETUGAS -->

    <?php if (in_array(session()->get('role'), ['admin', 'petugas'])) : ?>

    <li><a href="<?= base_url('/users') ?>">Users</a></li>
    <li><a href="<?= base_url('/buku') ?>">Buku</a></li>

    <!-- TAMBAHAN -->
    <li><a href="<?= base_url('/kategori') ?>">Kategori</a></li>
    <li><a href="<?= base_url('/penulis') ?>">Penulis</a></li>
    <li><a href="<?= base_url('/penerbit') ?>">Penerbit</a></li>

<?php endif; ?>

    <!-- ANGGOTA -->
    <?php if (session()->get('role') == 'anggota') : ?>

        <li>
            <a href="<?= base_url('/buku') ?>">Buku</a>
        </li>

    <?php endif; ?>

     <li>
            <a href="<?= base_url('/peminjaman') ?>">peminjaman</a>
        </li>

        <li>
            <a href="<?= base_url('/rak') ?>">rak</a>
        </li>

    <li>
        <?php $idu = session('id'); ?>
        <a href="<?= base_url('users/edit/' . $idu) ?>">Setting</a>
    </li>

    <li>
        <a href="<?= base_url('/logout') ?>">Log Out</a>
    </li>

</ul>

<br>

Masuk sebagai:<br>
<b><?= session('nama'); ?> (<?= session('role'); ?>)</b>

<br><br>

<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80">