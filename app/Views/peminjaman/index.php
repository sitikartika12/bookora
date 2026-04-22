<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Peminjaman</h3>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('peminjaman/create') ?>">+ Tambah</a>
<?php endif; ?>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>metode</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>

    <?php foreach ($peminjaman as $p): ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['nama_anggota'] ?></td>
            <td><?= $p['nama_petugas'] ?? '-' ?></td>
            <td><?= $p['metode'] ?></td>
            <td><?= $p['tanggal_pinjam'] ?></td>
            <td><?= $p['tanggal_kembali'] ?></td>
            <td><?= $p['status'] ?></td>

            <td>

                <!-- SEMUA ROLE BISA DETAIL -->
                <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>">Detail</a>

                <!-- ANGGOTA -->
                <?php if (session()->get('role') == 'anggota') : ?>

                    <!-- PERPANJANG -->
                    <?php if ($p['status'] != 'dikembalikan') : ?>
                        <a href="<?= base_url('peminjaman/perpanjang/' . $p['id_peminjaman']) ?>">
                            Perpanjang
                        </a>
                    <?php endif; ?>

                    <!-- JIKA  ANTAR → KEMBALI MANUAL -->
                    <?php if ($p['metode'] == 'antar') : ?>
                        <a href="<?= base_url('penarikan/buatPenarikan/' . $p['id_peminjaman']) ?>">
                            Ajukan Penarikan
                        </a>
                    <?php else: ?>

                        <?php if ($p['status'] == 'dikembalikan') : ?>
                            Sudah dikembalikan
                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- HAPUS -->
                    <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                        onclick="return confirm('Hapus?')">
                        Hapus
                    </a>

                <?php endif; ?>

                <!-- PETUGAS -->
                <?php if (session()->get('role') == 'petugas'): ?>
                    <a href="<?= base_url('peminjaman/kembali/' . $p['id_peminjaman']) ?>">
                        Kembali
                    </a>
                    <?php if ($p['status'] == 'diproses'): ?>
                        <a href="<?= base_url('peminjaman/ambil/' . $p['id_peminjaman']) ?>">
                            Ambil Tugas
                        </a>
                    <?php endif; ?>

                    <?php if ($p['status'] == 'diantar'): ?>
                        <a href="<?= base_url('peminjaman/selesai/' . $p['id_peminjaman']) ?>">
                            Selesai
                        </a>
                    <?php endif; ?>

                <?php endif; ?>

                <!-- ADMIN -->
                <?php if (session()->get('role') == 'admin') : ?>

                    <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                        onclick="return confirm('Hapus data peminjaman?')">
                        Hapus
                    </a>

                <?php endif; ?>

            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?= $this->endSection() ?>