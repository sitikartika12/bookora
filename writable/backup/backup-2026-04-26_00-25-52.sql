-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bookora
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_anggota`),
  UNIQUE KEY `nisn` (`nisn`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota`
--

LOCK TABLES `anggota` WRITE;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` VALUES (8,18,'1234567','syghbn','081022246534','2026-04-21 17:00:00'),(9,19,NULL,NULL,NULL,'2026-04-21 17:00:00'),(10,20,'74815402','sumedang','081022246534','2026-04-21 17:00:00'),(11,21,'0123456789','sumedang\r\ntanjung sari','0853456782981','2026-04-21 17:00:00'),(12,22,'2345678','bendungan','08543276543','2026-04-24 17:00:00');
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_rak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_penulis` (`id_penulis`),
  KEY `id_penerbit` (`id_penerbit`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (37,'9786234580099','cita cita dan persahabatan',3,3,3,2023,2,0,'Afif dan Jihan memiliki cita-cita tinggi untuk \"go internasional\" di bidang yang mereka minati. Mereka sangat bersemangat, bahkan sampai mengikuti kursus kelas online yang pesertanya rata-rata orang dewasa demi memperdalam kemampuan mereka','1776529804_827b1893ba60b69a80f2.jpg','2026-04-18 04:44:45',NULL),(41,'9786231031433','Bandung After Rain',1,7,2,2025,2,0,'Cerita berfokus pada Hemachandra (Hema), seorang mahasiswa yang tinggal di Bandung bersama ibundanya. Ia baru saja mengakhiri hubungan selama hampir tujuh tahun dengan kekasihnya, Rania (Ra), tepat satu bulan sebelum hari jadi mereka yang ke-7. Perpisahan ini terjadi akibat kesalahan fatal dan sikap acuh yang dilakukan Hema secara sengaja, yang membuat Rania enggan memberikan kesempatan kedua','1776529817_a612d955132bb4604458.jpg','2026-04-18 04:53:00',NULL),(46,'9786342360507','Ekonomi',2,15,14,2020,3,0,'Buku ini sangat cocok bagi pemula atau mahasiswa. Isinya fokus pada prinsip dasar ekonomi Islam, perbandingannya dengan sistem ekonomi konvensional, serta bagaimana nilai-nilai tauhid dan keadilan diterapkan dalam aktivitas pasar sehari-hari.','1776531645_9bf465c83f5473c09fc3.png','2026-04-18 17:00:45',NULL),(47,'9786230972201','Rintik Terakhir',1,1,15,2024,3,0,' Cerita berfokus pada Karang Samudra Daneswara yang terbangun dari koma selama tiga tahun setelah insiden penembakan oleh ibu kandungnya. Namun, saat terbangun, identitasnya dikuasai oleh kepribadian baru bernama Arutala Sembagi Daneswara, seorang remaja tunarungu yang dominan.','1776666328_977cdcf6e4a6c8cc9342.jpg','2026-04-20 06:25:28',NULL),(48,'9786028054928','psikologi ',2,16,16,2020,5,1,'Psikologi Belajar Orang Dewasa adalah cabang ilmu yang mempelajari bagaimana orang dewasa belajar, memahami informasi baru, dan mengembangkan keterampilan sepanjang hidupnya','1776666651_f3334195168db777c969.jpg','2026-04-20 06:30:51',NULL),(49,'9786238649372','Manajemen Pendidikan',2,17,17,2015,6,5,'Di era globalisasi dan revolusi industri 4.0, dunia pendidikan menghadapi berbagai tantangan yang kompleks dan dinamis. “Manajemen Pendidikan: Strategi Modern untuk Kepemimpinan Efektif” merupakan buku referensi yang esensial, dirancang untuk membekali para pendidik, pemimpin pendidikan, dan para stakeholder terkait dengan wawasan serta alat-alat praktis untuk mengatasi tantangan tersebut.','1776788629_65fe89a3b40a2fcf9249.jpeg','2026-04-21 16:23:49',NULL),(50,' 9789797807214','Sabtu Bersama Bapa',1,18,18,2014,4,1,'“Hai, Satya! Hai, Cakra!” Sang Bapak melambaikan tangan.\r\n“Ini Bapak.\r\nIya, benar kok, ini Bapak.\r\nBapak cuma pindah ke tempat lain. Gak sakit. Alhamdulillah, berkat doa Satya dan Cakra.\r\n\r\n…\r\n\r\nMungkin Bapak tidak dapat duduk dan bermain di samping kalian.\r\nTapi, Bapak tetap ingin kalian tumbuh dengan Bapak di samping kalian.\r\nIngin tetap dapat bercerita kepada kalian.\r\nIngin tetap dapat mengajarkan kalian.\r\nBapak sudah siapkan.\r\n\r\nKetika punya pertanyaan, kalian tidak pernah perlu bingung ke mana harus mencari jawaban.\r\nI don’t let death take these, away from us.\r\nI don’t give death, a chance.\r\n\r\nBapak ada di sini. Di samping kalian.\r\nBapak sayang kalian.”','1776844989_c35ff27e4be97501a7d6.jpeg','2026-04-22 08:03:09',NULL),(51,' 602-6992-60-X','Biologi',2,19,19,2014,5,1,'Buku ini berisi ringkasan materi lengkap dengan peta konsep, cara cepat menghafal, serta contoh soal dan pembahasan.\r\n\r\nDengan keungggulan tersebut, buku ini dapat dijadikan sebagai buku penunjang pelajaran bagi siswa SMA untuk menghadapi ulangan harian, ujian tengah dan akhir semester, ujian sekolah, ujian nasional, bahkan SBMPTN dan USM PTN tertentu.','1776845258_9333a1575397603cb476.jpg','2026-04-22 08:07:38',NULL),(52,'978-979-22-7355-7','Komik Sains',3,20,20,2016,3,3,'Buku ini khusus untuk kamu yang selalu ingin tahu. Kamu akan menemukan jawaban dari pertanyaan yang membuat penasaran. Dijamin kamu akan mudah memahami dan menyukai sains. Dikemas dengan komik yang lucu dan menarik serta penjelasan sederhana. Siapa pun bisa jadi ahli sains.','1776871332_388037b4e3b65c5a0c44.jpg','2026-04-22 08:12:55',NULL);
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buku_rak`
--

DROP TABLE IF EXISTS `buku_rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_rak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buku_rak_ibfk_1` (`id_buku`),
  KEY `buku_rak_ibfk_2` (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_rak`
--

LOCK TABLES `buku_rak` WRITE;
/*!40000 ALTER TABLE `buku_rak` DISABLE KEYS */;
INSERT INTO `buku_rak` VALUES (13,37,1),(14,41,2),(15,46,3),(16,47,2),(17,48,3),(18,49,3),(19,50,2),(20,51,3),(21,52,1);
/*!40000 ALTER TABLE `buku_rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengembalian` int(11) DEFAULT NULL,
  `jumlah_denda` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar',
  PRIMARY KEY (`id_denda`),
  KEY `denda_ibfk_1` (`id_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `detail_peminjaman_ibfk_1` (`id_peminjaman`),
  KEY `detail_peminjaman_ibfk_2` (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
INSERT INTO `detail_peminjaman` VALUES (256,285,48,1),(257,286,48,1),(258,287,48,1),(259,288,48,1);
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'novel'),(2,'pelajaran'),(3,'komik');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_aktivitas`
--

DROP TABLE IF EXISTS `log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_aktivitas` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log`),
  KEY `log_aktivitas_ibfk_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_aktivitas`
--

LOCK TABLES `log_aktivitas` WRITE;
/*!40000 ALTER TABLE `log_aktivitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('diproses','dikirim','dipinjam','dikembalikan','selesai','menunggu','sampai','menunggu_pengembalian','menunggu_perpanjangan','denda_sudah_dibayar','diperpanjang','menunggu_pembayaran','diantar','antar') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `metode` enum('ambil','antar') DEFAULT NULL,
  `perpanjangan` int(11) DEFAULT 0,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (285,20,NULL,'2026-04-26','2026-05-03','menunggu_pembayaran',NULL,'ambil',0),(286,20,NULL,'2026-04-26','2026-04-26','dikembalikan',NULL,'ambil',0),(287,20,13,'2026-04-26','2026-05-03','selesai','sumedang','antar',0),(288,20,NULL,'2026-04-26','2026-04-26','dikembalikan',NULL,'ambil',0);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penarikan`
--

DROP TABLE IF EXISTS `penarikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','diambil','selesai') DEFAULT 'menunggu',
  `tanggal_ambil` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_penarikan`),
  KEY `penarikan_ibfk_1` (`id_peminjaman`),
  KEY `penarikan_ibfk_2` (`petugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penarikan`
--

LOCK TABLES `penarikan` WRITE;
/*!40000 ALTER TABLE `penarikan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penarikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbit`
--

LOCK TABLES `penerbit` WRITE;
/*!40000 ALTER TABLE `penerbit` DISABLE KEYS */;
INSERT INTO `penerbit` VALUES (2,'Black Swan Books','PT Sinar Angsa Media'),(3,' Gema Insani','Depok'),(4,'Kemendikbudristek','Kompleks Kemendikbudristek, Jl. Gunung Sahari Raya No. 4, Jakarta Pusat.'),(8,'gradien mediatama',NULL),(14,' UMSU PRESS',NULL),(15,' Skuad Media Cakrawala',NULL),(16,'Cipta Prima Nusantara',NULL),(17,'PT Media Penerbit Indonesia',NULL),(18,'GagasMedia',NULL),(19,'CMedia',NULL),(20,'Plants vs. Zombies',NULL);
/*!40000 ALTER TABLE `penerbit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaturan`
--

DROP TABLE IF EXISTS `pengaturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `denda_per_hari` decimal(10,2) DEFAULT NULL,
  `maksimal_pinjam` int(11) DEFAULT NULL,
  `lama_pinjam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturan`
--

LOCK TABLES `pengaturan` WRITE;
/*!40000 ALTER TABLE `pengaturan` DISABLE KEYS */;
INSERT INTO `pengaturan` VALUES (1,'Sistem Perpustakaan',1000.00,3,7);
/*!40000 ALTER TABLE `pengaturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id_pengembalian`),
  KEY `pengembalian_ibfk_1` (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (79,286,'2026-04-26',0.00),(80,288,'2026-04-26',0.00);
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengiriman`
--

DROP TABLE IF EXISTS `pengiriman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','diproses','dikirim','selesai','dipinjam') DEFAULT 'menunggu',
  `tanggal_kirim` date DEFAULT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`),
  KEY `pengiriman_ibfk_1` (`id_peminjaman`),
  KEY `pengiriman_ibfk_2` (`petugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengiriman`
--

LOCK TABLES `pengiriman` WRITE;
/*!40000 ALTER TABLE `pengiriman` DISABLE KEYS */;
INSERT INTO `pengiriman` VALUES (142,287,'sumedang',10000.00,'diproses',NULL,13);
/*!40000 ALTER TABLE `pengiriman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penulis`
--

DROP TABLE IF EXISTS `penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) NOT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penulis`
--

LOCK TABLES `penulis` WRITE;
/*!40000 ALTER TABLE `penulis` DISABLE KEYS */;
INSERT INTO `penulis` VALUES (1,'Sri Puji Hartini'),(3,'Aan Wulandari'),(7,'wulan nur amalia'),(8,'khoirul trian'),(9,'aisyah nurjati'),(15,'Syahrul Amsari'),(16,'Ahmad Rifa\'i'),(17,'Dr. Saripuddin, M.Pd.I.'),(18,'Adhitya Mulya'),(19,'Kusnadi, Msi .dk'),(20,'Xiao Jiang Nan');
/*!40000 ALTER TABLE `penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rak`
--

DROP TABLE IF EXISTS `rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rak`
--

LOCK TABLES `rak` WRITE;
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` VALUES (1,'rak 1 A','lantai 1'),(2,'rak 2 A','lantai 1'),(3,'rak 3 C','lantai 1');
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservasi`
--

DROP TABLE IF EXISTS `reservasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tanggal_reservasi` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','dibatalkan') DEFAULT 'menunggu',
  PRIMARY KEY (`id_reservasi`),
  KEY `reservasi_ibfk_1` (`id_anggota`),
  KEY `reservasi_ibfk_2` (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservasi`
--

LOCK TABLES `reservasi` WRITE;
/*!40000 ALTER TABLE `reservasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int(11) DEFAULT NULL,
  `jenis` enum('denda','pengiriman','penarikan') DEFAULT NULL,
  `jumlah` decimal(10,2) DEFAULT NULL,
  `status` enum('belum_bayar','lunas','menunggu_verifikasi') DEFAULT 'belum_bayar',
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode_pembayaran` enum('cod','qris','transfer','cash') DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `transaksi_ibfk_1` (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES (129,287,'pengiriman',10000.00,'lunas','2026-04-26 00:21:19','cod',NULL);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ulasan`
--

DROP TABLE IF EXISTS `ulasan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_ulasan`),
  KEY `ulasan_ibfk_1` (`id_buku`),
  KEY `ulasan_ibfk_2` (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ulasan`
--

LOCK TABLES `ulasan` WRITE;
/*!40000 ALTER TABLE `ulasan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ulasan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'siti kartika','siti.kartika822@smk.belajar.id','kartika','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','admin','1775889287_bb4359edba9c8703c4ac.jpg','aktif','2026-04-11 04:29:52'),(13,'siti humairoh','may@gmail.com','umay','$2y$10$Ds2sohu4fltuxJQB0BW9keNQm1gNFfspDtxhQ8Mtlc09MZug4Z61y','petugas','1776743567_c2e811be809178fafe49.png','aktif','2026-04-21 03:52:47'),(18,'ayu riska','ayu@gmail.com','ayu','$2y$10$UXANX/uPRPNpeXtNypY.T.kFgD7ZNsL9l/87i08cU6HKR8k9KbGrW','anggota','1776838551_e6b2fa7b83d4b6cb1cf4.jpg','aktif','2026-04-22 06:15:51'),(19,'shalis shatul','shalis@gmail.com','ute','$2y$10$t0kAaqw2z6zjCTdPbi1xXOxrVPrc2qtfXRBt1Dpbkts.V1fFvjebO','anggota','1776839108_40cd5f8e61d5986a8b1a.jpg','aktif','2026-04-22 06:25:08'),(20,'imey siti','imey@gmail.com','imey','$2y$10$G.la.fmavkCh6nQdAN2S9ecM5GfcwOhjfyK6dAdvAW.s2uZ1L5Mra','anggota','1776839224_d0b46ad7ba4a7fe8b035.jpg','aktif','2026-04-22 06:27:05'),(21,'insaniar','ican@gmail.com','ican','$2y$10$ENGivdZqd1wRqhJKLmI2ouAvnxI.P6cAr/PvG3Gie3L1DgHK6i36y','anggota','1776839356_7f03936ea3eb0aa93efc.png','aktif','2026-04-22 06:27:53'),(22,'rika apriliani','rika@gmail.com','rika','$2y$10$9.B1cpgdn4acFe4UDD6xpOb1SbqLUWnek6qOUGWrnXkWKdIuAsYl2','anggota','1777131275_2e670573c6c101c9873d.jpg','aktif','2026-04-25 15:34:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-26  7:25:53
