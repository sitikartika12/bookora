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
            <td><?= $p['status'] ?></td>

            <!-- PEMBAYARAN -->
            <td>

                <?php if ($p['metode'] == 'antar'): ?>
                    <b>Pengiriman:</b><br>
                    Status: <?= $p['status'] ?><br>
                <?php endif; ?>

                <?php if ($p['status_denda'] != 'tidak_ada'): ?>
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

                <!-- ANGGOTA -->
                <?php if (session()->get('role') == 'anggota') : ?>

                    <?php if ($p['status'] == 'dipinjam'): ?>
                        <a href="<?= base_url('peminjaman/ajukanKembali/' . $p['id_peminjaman']) ?>">
                            Ajukan Pengembalian
                        </a>
                    <?php endif; ?>

                    <?php if ($p['metode'] == 'antar' && $p['status'] != 'dikembalikan'): ?>

                        <?php if ($p['status_denda'] != 'tidak_ada' && $p['status_denda'] != 'lunas'): ?>
                            <a href="<?= base_url('transaksi/bayar/' . $p['id_peminjaman'] . '/denda') ?>">
                                💰 Bayar Denda
                            </a>
                        <?php endif; ?>

                        <a href="<?= base_url('transaksi/bayar/' . $p['id_peminjaman'] . '/pengiriman') ?>">
                            🚚 Bayar Pengiriman
                        </a>

                    <?php endif; ?>

                    <?php if ($p['status'] != 'dikembalikan') : ?>
                        <a href="<?= base_url('peminjaman/perpanjang/' . $p['id_peminjaman']) ?>">
                            Perpanjang
                        </a>
                    <?php endif; ?>

                    <?php if ($p['metode'] == 'antar') : ?>
                        <a href="<?= base_url('penarikan/buatPenarikan/' . $p['id_peminjaman']) ?>">
                            Ajukan Penarikan
                        </a>
                    <?php else: ?>
                        <?php if ($p['status'] == 'dikembalikan') : ?>
                            Sudah dikembalikan
                        <?php endif; ?>
                    <?php endif; ?>

                    <a href="<?= base_url('peminjaman/delete/' . $p['id_peminjaman']) ?>"
                        onclick="return confirm('Hapus?')">
                        Hapus
                    </a>

                <?php endif; ?>

                <!-- PETUGAS -->
                <?php if (session()->get('role') == 'petugas'): ?>

                    <?php if ($p['status_pembayaran'] == 'menunggu_verifikasi'): ?>

                        <?php if ($p['metode'] == 'antar'): ?>
                            <a href="<?= base_url('transaksi/verifikasi/' . $p['id_transaksi']) ?>">
                                ✅ Verifikasi Pembayaran
                            </a>

                            <a href="<?= base_url('transaksi/tolak/' . $p['id_transaksi']) ?>">
                                ❌ Tolak
                            </a>
                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if ($p['status'] == 'menunggu_pengembalian'): ?>
                        <span style="color:orange;">🔔 Menunggu Pengembalian</span>

                        <a href="<?= base_url('peminjaman/konfirmasiKembali/' . $p['id_peminjaman']) ?>">
                            Konfirmasi
                        </a>
                    <?php endif; ?>

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