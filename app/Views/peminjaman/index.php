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
        <th>Metode</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Pembayaran</th>
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
            <td>
    <?php if ($p['status'] == 'diproses'): ?>
        <span style="color:blue;">diproses</span>
    <?php elseif ($p['status'] == 'diantar'): ?>
        <span style="color:orange;">diantar</span>
    <?php elseif ($p['status'] == 'dipinjam'): ?>
        <span style="color:green;">dipinjam</span>
    <?php else: ?>
        <?= $p['status'] ?>
    <?php endif; ?>
</td>

            <!-- PEMBAYARAN -->
            <td>

                <?php if ($p['metode'] == 'antar'): ?>
                    <b>Pengiriman:</b><br>
                    Status: <?= $p['status'] ?><br>
                <?php endif; ?>

                <?php if (!empty($p['status_denda']) && $p['status_denda'] != 'tidak_ada'): ?>
                    <br><b>Denda:</b><br>
                    Rp <?= number_format($p['denda'], 0, ',', '.') ?><br>
                    Status: <?= $p['status_denda'] ?><br>
                <?php endif; ?>

                <?php if ($p['metode'] == 'antar'): ?>
                    <?php if (!empty($p['bukti_pembayaran'])): ?>
                        <br>
                        <a href="<?= base_url('uploads/bukti/' . $p['bukti_pembayaran']) ?>" target="_blank">
                            Lihat Bukti
                        </a>
                    <?php else: ?>
                        <br>Tidak ada bukti
                    <?php endif; ?>
                <?php else: ?>
                    -
                <?php endif; ?>

            </td>

            <!-- AKSI -->
            <td>

    <!-- DETAIL -->
    <a href="<?= base_url('peminjaman/detail/' . $p['id_peminjaman']) ?>">Detail</a>

    <!-- ================= ANGGOTA ================= -->
    <?php if (session()->get('role') == 'anggota') : ?>

        <!-- AJUKAN PENGEMBALIAN -->
        <?php if (in_array($p['status'], ['dipinjam', 'diperpanjang'])): ?>
            <a href="<?= base_url('peminjaman/ajukanKembali/' . $p['id_peminjaman']) ?>">
                Ajukan Pengembalian
            </a>
        <?php endif; ?>

        <!-- PEMBAYARAN -->
        <?php if ($p['metode'] == 'antar' && $p['status'] == 'menunggu_pembayaran'): ?>

            <!-- BAYAR DENDA -->
            <?php if ($p['status_denda'] != 'tidak_ada' && $p['status_denda'] != 'lunas'): ?>
                <a href="<?= base_url('transaksi/pilihMetode/' . $p['id_peminjaman']) ?>">
                    💰 Bayar Denda
                </a>
            <?php endif; ?>

            <!-- BAYAR PENGIRIMAN -->
            <a href="<?= base_url('transaksi/pilihMetode/' . $p['id_peminjaman']) ?>">
                🚚 Bayar Pengiriman
            </a>

        <?php endif; ?>

        <!-- PERPANJANG -->
        <?php if ($p['status'] != 'dikembalikan') : ?>
            <a href="<?= base_url('peminjaman/perpanjang/' . $p['id_peminjaman']) ?>">
                Perpanjang
            </a>
        <?php endif; ?>

        <!-- STATUS SELESAI -->
        <?php if ($p['status'] == 'dikembalikan') : ?>
            <span>Sudah dikembalikan</span>
        <?php endif; ?>

        <!-- HAPUS -->
        <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
           onclick="return confirm('Hapus?')">
            Hapus
        </a>

    <?php endif; ?>

    <!-- ================= PETUGAS ================= -->
    <?php if (session()->get('role') == 'petugas'): ?>

        <!-- VERIFIKASI PEMBAYARAN -->
        <?php if ($p['status_pembayaran'] == 'menunggu_verifikasi'): ?>
            <a href="<?= base_url('transaksi/verifikasi/' . $p['id_transaksi']) ?>">
                ✅ Verifikasi Pembayaran
            </a>

            <a href="<?= base_url('transaksi/tolak/' . $p['id_transaksi']) ?>">
                ❌ Tolak
            </a>
        <?php endif; ?>

        <!-- PENGEMBALIAN -->
        <?php if ($p['status'] == 'menunggu_pengembalian'): ?>
            <span style="color:orange;">🔔 Menunggu Pengembalian</span>

            <a href="<?= base_url('peminjaman/kembali/' . $p['id_peminjaman']) ?>">
                Verifikasi
            </a>
        <?php endif; ?>

        <!-- PERPANJANGAN -->
        <?php if ($p['status'] == 'menunggu_perpanjangan'): ?>
            <span style="color:orange;">🔔 Menunggu Perpanjangan</span>

            <a href="<?= base_url('peminjaman/konfirmasiperpanjangan/'.$p['id_peminjaman']) ?>"
               onclick="return confirm('Konfirmasi perpanjangan?')">
                Verifikasi Perpanjangan
            </a>
        <?php endif; ?>

        <!-- AMBIL TUGAS -->
        <?php if ($p['status'] == 'diproses'): ?>
            <a href="<?= base_url('peminjaman/ambil/' . $p['id_peminjaman']) ?>">
                Ambil Tugas
            </a>
        <?php endif; ?>

        <!-- SELESAI -->
        <?php if ($p['status'] == 'diantar'): ?>
            <a href="<?= base_url('peminjaman/selesai/' . $p['id_peminjaman']) ?>">
                Selesai
            </a>
        <?php endif; ?>

    <?php endif; ?>

</td>

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