-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2026 pada 19.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookora`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `judul` varchar(200) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 0,
  `tersedia` int(11) DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `isbn`, `judul`, `id_kategori`, `id_penulis`, `id_penerbit`, `tahun_terbit`, `jumlah`, `tersedia`, `deskripsi`, `cover`, `created_at`, `id_rak`) VALUES
(37, '9786234580099', 'cita cita dan persahabatan', 3, 3, 3, '2023', 2, 2, 'Afif dan Jihan memiliki cita-cita tinggi untuk \"go internasional\" di bidang yang mereka minati. Mereka sangat bersemangat, bahkan sampai mengikuti kursus kelas online yang pesertanya rata-rata orang dewasa demi memperdalam kemampuan mereka', '1776529804_827b1893ba60b69a80f2.jpg', '2026-04-18 04:44:45', NULL),
(41, '9786231031433', 'Bandung After Rain', 1, 7, 2, '2025', 2, 2, 'Cerita berfokus pada Hemachandra (Hema), seorang mahasiswa yang tinggal di Bandung bersama ibundanya. Ia baru saja mengakhiri hubungan selama hampir tujuh tahun dengan kekasihnya, Rania (Ra), tepat satu bulan sebelum hari jadi mereka yang ke-7. Perpisahan ini terjadi akibat kesalahan fatal dan sikap acuh yang dilakukan Hema secara sengaja, yang membuat Rania enggan memberikan kesempatan kedua', '1776529817_a612d955132bb4604458.jpg', '2026-04-18 04:53:00', NULL),
(46, '9786342360507', 'Ekonomi', 2, 15, 14, '2020', 3, 3, 'Buku ini sangat cocok bagi pemula atau mahasiswa. Isinya fokus pada prinsip dasar ekonomi Islam, perbandingannya dengan sistem ekonomi konvensional, serta bagaimana nilai-nilai tauhid dan keadilan diterapkan dalam aktivitas pasar sehari-hari.', '1776531645_9bf465c83f5473c09fc3.png', '2026-04-18 17:00:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_rak`
--

CREATE TABLE `buku_rak` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku_rak`
--

INSERT INTO `buku_rak` (`id`, `id_buku`, `id_rak`) VALUES
(1, 23, 1),
(2, 35, 1),
(3, 36, 1),
(4, 37, 1),
(5, 39, 2),
(6, 40, 3),
(7, 41, 2),
(8, 42, 3),
(9, 43, 3),
(10, 44, 3),
(11, 45, 4),
(12, 46, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah_denda` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'novel'),
(2, 'pelajaran'),
(3, 'komik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan','','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_petugas`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(3, 5, 2, '2026-04-18', '2026-04-17', 'dikembalikan'),
(6, 5, 5, '2026-04-18', '2026-04-25', 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','diambil','selesai') DEFAULT 'menunggu',
  `tanggal_ambil` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`) VALUES
(2, 'Black Swan Books', 'PT Sinar Angsa Media'),
(3, ' Gema Insani', 'Depok'),
(4, 'Kemendikbudristek', 'Kompleks Kemendikbudristek, Jl. Gunung Sahari Raya No. 4, Jakarta Pusat.'),
(8, 'gradien mediatama', NULL),
(14, ' UMSU PRESS', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `denda_per_hari` decimal(10,2) DEFAULT NULL,
  `maksimal_pinjam` int(11) DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_aplikasi`, `denda_per_hari`, `maksimal_pinjam`, `lama_pinjam`) VALUES
(1, 'Sistem Perpustakaan', 1000.00, 3, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','dikirim','sampai') DEFAULT 'menunggu',
  `tanggal_kirim` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'Sri Puji Hartini'),
(3, 'Aan Wulandari'),
(7, 'wulan nur amalia'),
(8, 'khoirul trian'),
(9, 'aisyah nurjati'),
(15, 'Syahrul Amsari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `lokasi`) VALUES
(1, 'rak A', 'lantai 1'),
(2, 'rak B', 'lantai 2'),
(3, 'rak c', 'apa saja'),
(4, 'rak D', 'lantai dasar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_reservasi` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','dibatalkan') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `jenis` enum('denda','pengiriman','penarikan') DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','lunas') DEFAULT 'belum_bayar',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `foto`, `status`, `created_at`) VALUES
(1, 'siti kartika', 'siti.kartika822@smk.belajar.id', 'kartika', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'admin', '1775889287_bb4359edba9c8703c4ac.jpg', 'aktif', '2026-04-11 04:29:52'),
(2, 'siti humairoh', 'siti.humairoh3724@smk.belajar.id', 'may', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'petugas', '1775923187_a212e84c34e7491a5aa5.png', 'aktif', '2026-04-11 04:31:03'),
(4, 'insaniar', 'ican@gmail.com', 'ican', '$2y$10$rIPq1jtvIoZNpB80utkZDeaFMSUkHVCwhlV7agluzwjQrMAh1t.SG', 'anggota', '1775887915_5ccfd9469f4d5a779e33.png', 'aktif', '2026-04-11 06:11:55'),
(5, 'iis sadiyah', 'iis.sadiyah7@smk.belajar.id', 'iis', '$2y$10$syvvAaihkO8jRpAqHL7swevmIqdfVVEz05Fxyjpb2kcZLfEjjv7bO', 'anggota', '1775923518_4e10f322fe79cef40939.jpg', 'aktif', '2026-04-11 16:05:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penulis` (`id_penulis`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indeks untuk tabel `buku_rak`
--
ALTER TABLE `buku_rak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_rak_ibfk_1` (`id_buku`),
  ADD KEY `buku_rak_ibfk_2` (`id_rak`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `denda_ibfk_1` (`id_pengembalian`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_peminjaman_ibfk_1` (`id_peminjaman`),
  ADD KEY `detail_peminjaman_ibfk_2` (`id_buku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `log_aktivitas_ibfk_1` (`user_id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`),
  ADD KEY `penarikan_ibfk_1` (`id_peminjaman`),
  ADD KEY `penarikan_ibfk_2` (`petugas_id`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `pengembalian_ibfk_1` (`id_peminjaman`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `pengiriman_ibfk_1` (`id_peminjaman`),
  ADD KEY `pengiriman_ibfk_2` (`petugas_id`);

--
-- Indeks untuk tabel `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `reservasi_ibfk_1` (`id_anggota`),
  ADD KEY `reservasi_ibfk_2` (`id_buku`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_ibfk_1` (`id_peminjaman`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `ulasan_ibfk_1` (`id_buku`),
  ADD KEY `ulasan_ibfk_2` (`id_anggota`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `buku_rak`
--
ALTER TABLE `buku_rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
