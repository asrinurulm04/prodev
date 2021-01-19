-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2020 at 08:15 AM
-- Server version: 10.2.16-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodev`
--

-- --------------------------------------------------------

--
-- Table structure for table `fs_kategori_pangan`
--

CREATE TABLE IF NOT EXISTS `fs_kategori_pangan` (
  `id_pangan` int(10) unsigned NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `no_kategori` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fs_kategori_pangan`
--

INSERT INTO `fs_kategori_pangan` (`id_pangan`, `id_kategori`, `no_kategori`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 1, '01.1.1.1', 'Susu (Plain) ', NULL, NULL),
(2, 1, '01.1.1.2 ', 'Buttermilk (Plain) ', NULL, NULL),
(3, 1, '01.1.2 ', 'Coklat,  Eggnog,  Minuman Berbasis Susu  yang  Berperisa  dan  atau Difermentasi  (Contohnya  Susu Minuman Yogurt,  Minuman  ', NULL, NULL),
(4, 1, '01.2.1 ', 'Produk Susu  Fermentasi (Plain)  ', NULL, NULL),
(5, 1, '01.3.1   ', 'Susu Kental (Plain) ', NULL, NULL),
(6, 1, '01.3.2 ', 'Krimer Minuman (Bukan Susu) ', NULL, NULL),
(7, 1, '01.4.1 ', 'Krim Pasteurisasi (Plain) ', NULL, NULL),
(8, 1, '01.4.3 ', 'Krim yang Digumpalkan (Plain) ', NULL, NULL),
(9, 1, '01.4.4 ', 'Krim Analog ', NULL, NULL),
(10, 1, '1.5', 'Susu Bubuk dan Krim Bubuk dan Bubuk Analog (Plain) ', NULL, NULL),
(11, 1, '01.6.1', 'Keju Tanpa Pemeraman (Keju Mentah) ', NULL, NULL),
(12, 1, '01.6.2.1', 'Keju Peram Total, Termasuk Kulit Kejunya ', NULL, NULL),
(13, 1, '01.6.2.2 ', 'Kulit Keju ', NULL, NULL),
(14, 1, '01.6.3', 'Keju Whey ', NULL, NULL),
(15, 1, '01.6.4 ', 'Keju Olahan  ', NULL, NULL),
(16, 1, '01.6.5 ', ' Keju Analog ', NULL, NULL),
(17, 1, '01.6.6 ', 'Keju Protein Whey ', NULL, NULL),
(18, 1, '1.7', 'Makanan Pencuci Mulut Berbahan Dasar Susu ', NULL, NULL),
(19, 1, '01.8.1', 'Cairan Whey dan Produknya, Kecuali Keju Whey ', NULL, NULL),
(20, 1, '01.8.2', 'Bubuk Whey dan Produknya, Kecuali Keju Whey ', NULL, NULL),
(21, 2, '02.1.2 ', 'Lemak dan Minyak Nabati ', NULL, NULL),
(22, 2, '2.2', 'Emulsi Lemak Terutama Tipe Emulsi Air Dalam Minyak ', NULL, NULL),
(23, 2, '2.3', 'Emulsi Lemak Tipe Emulsi Minyak dalam Air, termasuk Produk Campuran Emulsi Lemak dengan atau Berperisa ', NULL, NULL),
(24, 2, '2.4', 'Makanan Pencuci Mulut Berbasis Lemak tidak Termasuk Makanan Pencuci Mulut Berbasis Susu Dari Kategori 01.7 ', NULL, NULL),
(25, 2, '3', 'Es Untuk Dimakan (Edible Ice), Termasuk Sherbet dan Sorbet ', NULL, NULL),
(26, 3, '04.1.2.1 ', 'Buah Beku ', NULL, NULL),
(27, 3, '04.1.2.2 ', 'Buah Kering ', NULL, NULL),
(28, 3, '04.1.2.3 ', 'Buah Dalam Cuka, Minyak dan Larutan Garam ', NULL, NULL),
(29, 3, '04.1.2.4', 'Buah Dalam Kemasan (Pasteurisasi) ', NULL, NULL),
(30, 3, '04.1.2.5 ', 'Jem, Jeli dan Marmalad ', NULL, NULL),
(31, 3, '04.1.2.6 ', 'Produk Oles Berbasis Buah Tidak Termasuk Produk Pada Kategori 04.1.2.5  ', NULL, NULL),
(32, 3, '04.1.2.7 ', 'Buah Bergula ', NULL, NULL),
(33, 3, '04.1.2.8 ', 'Bahan Baku Berbasis Buah, Meliputi Bubur Buah, Puree,Topping Buah dan Santan Kelapa ', NULL, NULL),
(34, 3, '04.1.2.9', 'Makanan Pencuci Mulut (Dessert) Berbasis Buah Termasuk Makanan Pencuci Mulut Berbasis Air Berflavor Buah ', NULL, NULL),
(35, 3, '04.1.2.10', 'Produk Buah Fermentasi ', NULL, NULL),
(36, 3, '04.1.2.11', 'Produk Buah Untuk Isi Pastri ', NULL, NULL),
(37, 3, '04.1.2.12', 'Buah Yang Dimasak ', NULL, NULL),
(38, 3, '04.2.2.1 ', 'Sayur, Kacang dan Biji-Bijian Beku ', NULL, NULL),
(39, 3, '04.2.2.2 ', 'Sayur, Rumput Laut, Kacang, dan Biji-Bijian Kering ', NULL, NULL),
(40, 3, '04.2.2.3', 'Sayur dan Rumput Laut Dalam Cuka, Minyak, Larutan Garam atau Kecap Kedelai ', NULL, NULL),
(41, 3, '04.2.2.5', 'Puree dan Produk Oles Sayur, Kacang dan BijiBijian (Misalnya Selai Kacang) ', NULL, NULL),
(42, 3, '04.2.2.6', 'Bahan Baku dan Bubur (Pulp) Sayur, Kacang Dan Biji-Bijian (Misalnya Makanan Pencuci Mulut dan Saus Sayur, Sayur Bergula)', NULL, NULL),
(43, 3, '04.2.2.7 ', 'Produk Fermentasi Sayuran (Termasuk Jamur, Akar dan Umbi, Kacang Dan Aloe Vera) dan Rumput Laut, Tidak Termasuk Kategori Pang', NULL, NULL),
(44, 3, '04.2.2.8 ', 'Sayur dan Rumput Laut Yang Dimasak ', NULL, NULL),
(45, 4, '05.1.1 ', 'Kakao Bubuk dan Kakao Massa/Keik Kakao ', NULL, NULL),
(46, 4, '05.1.2 ', 'Sirup Campuran Kakao/Cocoa Mixes (Syrups) ', NULL, NULL),
(47, 4, '05.1.3 ', 'Olesan Berbasis Kakao, Termasuk Isian (Filling) ', NULL, NULL),
(48, 4, '05.1.4', 'Produk Kakao dan Cokelat ', NULL, NULL),
(49, 4, '05.1.5 ', 'Cokelat Imitasi, Produk Pengganti Cokelat ', NULL, NULL),
(50, 4, '05.2.1 ', 'Kembang Gula Keras/Permen Keras ', NULL, NULL),
(51, 4, '05.2.2 ', 'Kembang Gula Lunak/Permen Lunak  ', NULL, NULL),
(52, 4, '05.2.3 ', 'Nougat dan Marzipan ', NULL, NULL),
(53, 4, '5.3', 'Kembang Gula Karet /Permen Karet ', NULL, NULL),
(54, 4, '5.4', 'Dekorasi (Misalnya Untuk Bakery), Topping (NonBuah) dan Saus Manis ', NULL, NULL),
(55, 5, '6.2', 'Tepung dan Pati ', NULL, NULL),
(56, 5, '6.3', 'Serealia Untuk Sarapan, Termasuk Rolled Oats ', NULL, NULL),
(57, 5, '06.4.1 ', 'Pasta dan Mi Mentah Serta Produk  Sejenisnya ', NULL, NULL),
(58, 5, '06.4.2 ', 'Pasta dan Mi Serta Produk Sejenis Pasta ', NULL, NULL),
(59, 5, '06.4.3 ', 'Pasta dan Mi Pra-Masak Serta Produk Sejenis ', NULL, NULL),
(60, 5, '6.5', 'Makanan Pencuci Mulut Berbasis Serealia dan Pati (Misalnya Puding Nasi, Puding Tapioka) ', NULL, NULL),
(61, 5, '6.6', 'Tepung Bumbu (Misalnya Untuk Melapisi Permukaan Ikan atau Daging Ayam) ', NULL, NULL),
(62, 5, '6.7', 'Kue Beras ', NULL, NULL),
(63, 5, '06.8.1 ', 'Minuman Kedelai ', NULL, NULL),
(64, 5, '06.8.2', 'Lapisan Tipis Cairan Kedelai ', NULL, NULL),
(65, 5, '06.8.3 ', 'Tahu Segar ', NULL, NULL),
(66, 5, '06.8.4 ', 'Tahu Semi Kering ', NULL, NULL),
(67, 5, '06.8.5 ', 'Tahu Kering ', NULL, NULL),
(68, 5, '06.8.6 ', 'Kedelai Fermentasi (Contohnya Nato) ', NULL, NULL),
(69, 5, '06.8.7 ', 'Tahu Fermentasi (Contohnya Keju Kedelai) ', NULL, NULL),
(70, 6, '07.1.1 ', 'Roti dan Roti Kadet (Roll) ', NULL, NULL),
(71, 6, '07.1.2', 'Krekers, Tidak Termasuk Krekers Manis ', NULL, NULL),
(72, 6, '07.1.3 ', 'Lainnya (misalnya Produk Bakeri Tawar Bagel, Pita,Muffin Inggris) ', NULL, NULL),
(73, 6, '07.1.4 ', 'Produk Serupa Roti Termasuk Roti Untuk Isi (Stuffing) dan Tepung Roti, Tepung Panir ', NULL, NULL),
(74, 6, '07.1.5 ', 'Roti dan Bun Kukus ', NULL, NULL),
(75, 6, '07.1.6 ', 'Premiks Untuk Roti Tawar Dan Produk Bakeri Tawar ', NULL, NULL),
(76, 6, '7.2', 'Produk Bakeri Istimewa (Manis, Asin, Gurih) ', NULL, NULL),
(77, 6, '07.2.3 ', 'Premiks Untuk Produk Bakeri Istimewa (Misalnya Keik,Panekuk) ', NULL, NULL),
(78, 7, '08.2.1.1 ', 'Daging Unggas dan Daging Hewan Buruan dalam Bentuk Utuh atau Potongan Yang Dicuring (Termasuk Penggaraman) Tanpa Produk Olaha', NULL, NULL),
(79, 7, '08.2.1.2 ', 'Produk Daging, Daging Unggas Dan Daging Hewan Buruan Dalam Bentuk Utuh Atau Potongan Yang Dikuring (Termasuk Penggaraman) dan', NULL, NULL),
(80, 7, '08.2.1.3 ', 'Produk Daging, Daging Unggas dan Daging Hewan Buruan,dalam Potongan yang Difermentasi Tanpa Perlakuan Panas ', NULL, NULL),
(81, 7, '08.2.2 ', 'Produk Daging, Daging Unggas Dan Daging Hewan Buruan Dalam Bentuk Utuh Atau Potongan yang Diolah Dengan Perlakuan Panas ', NULL, NULL),
(82, 7, '08.2.3 ', 'Produk Olahan Daging, Daging Unggas dan Daging Hewan Buruan dalam Bentuk Utuh Maupun Potongan yang Dibekukan (Diproses, Disim', NULL, NULL),
(83, 7, '08.3.1 ', 'Produk Olahan Daging, Daging Unggas, Dan Daging Hewan Buruan yang Dihaluskan, Tanpa Perlakuan Panas  ', NULL, NULL),
(84, 7, '08.3.2 ', 'Daging, Daging Unggas Dan Daging Hewan Buruan, yang Dihaluskan, dan Diolah dengan Perlakuan Panas ', NULL, NULL),
(85, 7, '08.3.3', 'Daging, Daging Unggas dan Daging Hewan Buruan Yang Dihaluskan, Diolah dan Dibekukan ', NULL, NULL),
(86, 7, '8.4', 'Selongsong Sosis ', NULL, NULL),
(87, 8, '09.2.1 ', 'Ikan, Filet Ikan dan Produk Perikanan Meliputi Moluska, Krustase dan Ekinodermata yang Dibekukan ', NULL, NULL),
(88, 8, '09.2.2', 'Ikan, Filet Ikan dan Hasil Perikanan Termasuk Moluska, Krustase dan Ekinodermata Berlapis Tepung yang Dibekukan ', NULL, NULL),
(89, 8, '09.2.3', 'Hancuran (Minced) dan Sari (Cream) Ikan Termasuk Moluska, Krustase dan Ekinodermata yang Dibekukan ', NULL, NULL),
(90, 8, '09.2.4.1 ', 'Ikan dan Produk Perikanan Kukus atau Rebus ', NULL, NULL),
(91, 8, '09.2.4.2 ', 'Moluska, Krustase dan Ekinodermata Rebus atau Kukus ', NULL, NULL),
(92, 8, '09.2.4.3 ', 'Ikan dan Produk Perikanan Termasuk Moluska, Krustase, Ekinodermata Goreng atau Panggang (Oven atau Bara) ', NULL, NULL),
(93, 8, '09.2.5', 'Ikan dan Produk Perikanan Termasuk Moluska, Krustase dan Ekinodermata yang Diasap, Dikeringkan, Difermentasi dengan atau Tanp', NULL, NULL),
(94, 8, '09.3.1', 'Ikan dan Produk Perikanan Termasuk Moluska, Krustase, dan Ekinodermata yang Direndam Dalam Bumbu (Marinasi) dan atau Di Dalam', NULL, NULL),
(95, 8, '09.3.2 ', 'Ikan dan Produk Perikanan Termasuk Moluska, Krustase dan Ekinodermata yang Diolah Menjadi Pikel dan atau Direndam Dalam Larut', NULL, NULL),
(96, 8, '09.3.3 ', 'Pengganti Salmon, Caviar dan Produk Telur Ikan Lainnya ', NULL, NULL),
(97, 8, '9.4', 'Ikan dan Produk Perikanan Awet, Meliputi Ikan dan Produk Perikanan yang Dikalengkan atau Difermentasi, Termasuk Moluska, Krus', NULL, NULL),
(98, 9, '10.2', 'Produk Telur ', NULL, NULL),
(99, 9, '10.3', 'Telur yang Diawetkan, Termasuk Produk Tradisional Telur yang Diawetkan, Termasuk Dengan Cara Dibasakan, Diasinkan, dan Dikale', NULL, NULL),
(100, 9, '10.4', 'Makanan Pencuci Mulut Berbahan Dasar Telur (Misalnya Custard) ', NULL, NULL),
(101, 10, '12.2.1', 'Herba dan Rempah ', NULL, NULL),
(102, 10, '12.2.2', 'Bumbu dan Kondimen ', NULL, NULL),
(103, 10, '12.4', 'Mustard ', NULL, NULL),
(104, 10, '12.5.2 ', 'Bubuk atau Campuran Untuk Sup dan Kaldu ', NULL, NULL),
(105, 10, '12.6.1 ', 'Saus Teremulsi (Misalnya Mayonais, Salad Dressing) ', NULL, NULL),
(106, 10, '12.6.2 ', 'Saus Non-Emulsi (Misalnya Saus Tomat, Saus Keju, Saus Krim, Gravi Cokelat) ', NULL, NULL),
(107, 10, '12.6.3 ', 'Bubuk Untuk Saus dan Gravies ', NULL, NULL),
(108, 10, '12.6.4 ', 'Saus Bening (Misalnya Kecap Ikan) ', NULL, NULL),
(109, 10, '12.7', 'Produk Oles Untuk Salad (Misalnya Salad Makaroni,Salad Kentang) dan Sandwich, Tidak Mencakup Produk Oles Berbasis Cokelat dan', NULL, NULL),
(110, 10, '12.9.1 ', 'Pasta Kedelai Fermentasi ', NULL, NULL),
(111, 10, '12.9.2.1 ', 'Saus Kedelai Fermentasi ', NULL, NULL),
(112, 10, '12.9.2.2 ', 'Saus Kedelai NonFermentasi ', NULL, NULL),
(113, 10, '12.9.2.3', 'Saus Kedelai Lainnya ', NULL, NULL),
(114, 10, '12.1', 'Protein Produk ', NULL, NULL),
(115, 11, '13.1.1 ', 'Formula bayi', NULL, NULL),
(116, 11, '13.1.2 ', 'Formula Lanjutan', NULL, NULL),
(117, 11, '13.1.3 ', 'Formula untuk\r\nKeperluan Medis\r\nKhusus Bagi Bayi', NULL, NULL),
(118, 11, '13.2', 'Makanan Bayi dan\r\nAnak Dalam Masa\r\nPertumbuhan', NULL, NULL),
(119, 11, '13.3', 'Makanan Diet\r\nKhusus Untuk\r\nKeperluan\r\nKesehatan,\r\nTermasuk\r\nUntuk Bayi dan\r\nAnak-Anak ', NULL, NULL),
(120, 11, '13.4', 'Pangan Diet\r\nuntuk Pelangsing\r\ndan Penurun\r\nBerat Badan', NULL, NULL),
(121, 11, '13.5', 'Makanan Diet\r\n(Contohnya\r\nSuplemen Pangan\r\nUntuk Diet) yang\r\nTidak Termasuk\r\nProduk dari\r\nKategori 13.1,\r\n13.2, 13.3, 13.4\r\ndan 13.6', NULL, NULL),
(122, 12, '14.1.1.1', 'Air Mineral\r\nAlami dan\r\nSumbernya', NULL, NULL),
(123, 12, '14.1.2', 'Sari Buah dan\r\nSari Sayuran', NULL, NULL),
(124, 12, '14.1.3.1 ', 'Nektar Buah ', NULL, NULL),
(125, 12, '14.1.3.2 ', 'Nektar Sayur', NULL, NULL),
(126, 12, '14.1.4.1', 'Minuman\r\nBerbasis Air\r\nBerperisa yang\r\nBerkarbonat\r\n', NULL, NULL),
(127, 12, '14.1.4.2', 'Minuman\r\nBerbasis Air\r\nBerperisa\r\nTidak\r\nBerkarbonat,\r\nTermasuk\r\nPunches dan\r\nAdes', NULL, NULL),
(128, 12, '14.1.4.3', 'Konsentrat\r\n(Cair atau\r\nPadat) Untuk\r\nMinuman\r\nBerbasis Air\r\nBerperisa ', NULL, NULL),
(129, 12, '14.1.5', 'Kopi, Kopi\r\nSubstitusi,\r\nTeh, Seduhan\r\nHerbal, dan\r\nMinuman Biji-Bijian dan\r\nSereal Panas,\r\nkecuali\r\nCokelat', NULL, NULL),
(130, 13, '15.1', 'Makanan Ringan –\r\nBerbahan Dasar\r\nKentang, Umbi, Serealia,\r\nTepung atau Pati (dari\r\nUmbi dan Kacang)', NULL, NULL),
(131, 13, '15.2', 'Olahan Kacang,\r\nTermasuk Kacang\r\nTerlapisi dan Campuran\r\nKacang (Contoh Dengan\r\nBuah Kering)', NULL, NULL),
(132, 13, '15.3', 'Makanan Ringan\r\nBerbasis Ikan\r\n', NULL, NULL),
(134, 3, '04.1.2.8 ', 'Kategori pangan santan', NULL, NULL),
(135, 9, '11.6', 'Pemanis, Termasuk Pemanis Buatan (Table Top Sweeteners, Termasuk yang Mengandung Pemanis dengan Intensitas Tinggi) ', NULL, NULL),
(136, 1, '1.5.1', 'Susu Bubuk dan Krim Bubuk (Plain)', NULL, NULL),
(137, 1, '1.5.2', 'Susu dan Krim Bubuk Analog', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fs_kategori_pangan`
--
ALTER TABLE `fs_kategori_pangan`
  ADD PRIMARY KEY (`id_pangan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fs_kategori_pangan`
--
ALTER TABLE `fs_kategori_pangan`
  MODIFY `id_pangan` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
