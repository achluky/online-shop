-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 12:44 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE IF NOT EXISTS `level_user` (
  `id` int(2) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id`, `level`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `level` int(2) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `level`, `last_login`) VALUES
('rosidin', '202cb962ac59075b964b07152d234b70', 1, '2017-04-25 14:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kode_barang` varchar(10) NOT NULL,
  `kode_kategori` varchar(5) NOT NULL,
  `nama_barang` varchar(80) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(40) NOT NULL,
  `input_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kode_barang`, `kode_kategori`, `nama_barang`, `harga`, `stok`, `keterangan`, `foto`, `input_date`) VALUES
('GAD3196834', 'GAD', '', 19000, 34, '', '', '2017-04-26 08:53:54'),
('GAD3196844', 'GAD', '', 28800, 432, '', '883d87efa0123d3048645c86e0b5c45c.jpg', '2017-04-26 08:54:04'),
('GAD3196854', 'GAD', '', 21300, 3, '', '0b2ec1e5bdd69840cfb0d4f379422c4a.jpg', '2017-04-26 08:54:14'),
('GAD3196960', 'GAD', '', 18500, 43, '', 'd9fe5dbf5f36a41121cd0b907c793a95.jpg', '2017-04-26 08:56:00'),
('GAD3196975', 'GAD', '', 18900, 67, '', '36152ab38e3bb5ec1b680c9cae9d9d7c.jpg', '2017-04-26 08:56:15'),
('GAD3196984', 'GAD', '', 25000, 2, '', '7a65fe0b268a2a505b30e36eb14dd925.jpg', '2017-04-26 08:56:24'),
('GAD3196993', 'GAD', '', 25600, 38, '', '75d935bdaf038d501c5b7ad6d728fc34.jpg', '2017-04-26 08:56:33'),
('GAD3259346', 'GAD', '', 30000, 3, '', '410ac0d19ca75ec1f4b28d13da78e72a.jpg', '2017-04-27 02:15:46'),
('GAD3349516', 'GAD', 'ABC', 2147483647, 1111111111, '1111111111111111', '7e55b1f61a0e24126889766ceb1e949b.jpg', '2017-04-28 03:18:36'),
('GAD3351052', 'GAD', 'asd', 0, 0, '', '', '2017-04-28 03:44:12'),
('GAD3351088', 'GAD', 'QQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQ', 0, 0, '', '', '2017-04-28 03:44:48'),
('GAD3351870', 'GAD', '~~~~~~~~~~~~~', 0, 0, '', '', '2017-04-28 03:57:50'),
('GAD3351966', 'GAD', '11111', 0, 0, '', '', '2017-04-28 03:59:26'),
('GAD3352030', 'GAD', 'UUUUUUUUUUUUUUUUUUUUUUUUUUUUUUU', 0, 0, '', '', '2017-04-28 04:00:30'),
('GAD3891426', 'GAD', 'DDDDDDDDDDDDDDDDDD', 2147483647, 2147483647, '22222222222222222', '1c2e486d5aeaef7a558db027d80c13d9.png', '2017-05-04 09:50:26'),
('KOM1', 'KOM', 'Dell Alienware', 15000000, 3, 'Core i7\r\nRAM 32GB\r\nNVIDIA GTX1080', '', '2017-04-26 03:28:47'),
('KOM3196887', 'KOM', '', 19000, 34, 'dfs', '367fa62d36e95c6e25d55f84bc46783e.jpg', '2017-04-26 08:54:47'),
('KOM3197007', 'KOM', '', 17000, 2, '', '91e4ed034c92b2f466b90865f2984067.jpg', '2017-04-26 08:56:47'),
('KOM3352190', 'KOM', '%%%%%%%%%%%%%%%%', 0, 0, '00000000000000000000000000000000000', 'd62bb6674bb5e6c1445e0f86a1d3b54e.jpg', '2017-04-28 04:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `kode_kategori` varchar(5) NOT NULL,
  `nama_kategori` varchar(80) NOT NULL,
  `input_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kode_kategori`, `nama_kategori`, `input_date`) VALUES
('GAD', 'Gadget', '2017-04-26 06:06:18'),
('KOM', 'Komputer', '2017-04-26 03:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konfirmasi`
--

CREATE TABLE IF NOT EXISTS `tbl_konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `kode_pemesanan` varchar(50) NOT NULL,
  `judul` varchar(120) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_konfirmasi`
--

INSERT INTO `tbl_konfirmasi` (`id_konfirmasi`, `kode_pemesanan`, `judul`, `deskripsi`, `foto`) VALUES
(4, '1814938727348298', 'CEK 1', 'CEK 2', 'f45e1413b3fcea33041f95db3fc144f9.png'),
(5, '18149387268314777', 'CEK', 'CEK CEK', '328ff3aba7c794e8406566db27a6542a.png'),
(6, '1814938727348298', '', '', 'e21f33e994cb74b6bd1cda5f2234b921.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `email_pelanggan` varchar(80) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_provinsi` int(2) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kode_pos` varchar(8) NOT NULL,
  `detail_alamat` text NOT NULL,
  `foto` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `input_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`email_pelanggan`, `nama`, `tgl_lahir`, `no_telp`, `id_provinsi`, `kota`, `kecamatan`, `kode_pos`, `detail_alamat`, `foto`, `password`, `input_date`) VALUES
('cerdasgroup123@gmail.com', '081252711000', '0000-00-00', '081252711000', 11, 'Bandar Lampung', '35142', '35142', 'Jl. R.A. Basyid Perumahan Panorama Alam Blok A No.2  Labuhan Dalam Tanjung Senang.', 'c3ba0a4b19df81d9334d3937a4753347.jpg', 'c4ca4238a0b923820dcc509a6f75849b', '2017-04-30 10:42:01'),
('larashati@gmail.com', 'Laras Hati', '2016-02-02', '089659655665', 11, 'Bandar Lampung', 'Rajabasa', '35144', 'Jl komarudin', 'f76e9512f4aaebe272e2111e597ec157.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '2017-04-26 10:57:19'),
('muhammadrosidin@gmail.com', 'Muhammad Rosidin', '2017-04-01', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '', '202cb962ac59075b964b07152d234b70', '2017-04-26 03:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengiriman`
--

CREATE TABLE IF NOT EXISTS `tbl_pengiriman` (
  `kode_pemesanan` varchar(50) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_provinsi` int(2) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kode_pos` varchar(8) NOT NULL,
  `detail_alamat` text NOT NULL,
  `waktu_pemesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Menunggu','Terverifikasi','Terkirim','Batal','Kadaluarsa') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengiriman`
--

INSERT INTO `tbl_pengiriman` (`kode_pemesanan`, `nama`, `no_telp`, `id_provinsi`, `kota`, `kecamatan`, `kode_pos`, `detail_alamat`, `waktu_pemesanan`, `status`) VALUES
('1814937211897568', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-02 01:14:30', 'Menunggu'),
('1814938597804229', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-04 01:14:30', 'Menunggu'),
('18149387263616256', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-04 04:37:16', 'Menunggu'),
('18149387268314777', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-04 04:38:03', 'Menunggu'),
('18149387271215957', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-04 04:38:32', 'Menunggu'),
('1814938727348298', '18', '089999999999', 18, 'Bandar Lampung', 'Rajabasa', '35144', 'Rajabasa raya bandar lampung', '2017-05-04 04:38:54', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE IF NOT EXISTS `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_pemesanan` varchar(50) NOT NULL,
  `email_pelanggan` varchar(80) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jml_pesanan` int(5) NOT NULL,
  `total_bayar` varchar(10) NOT NULL,
  `status` enum('Menunggu','Terverifikasi','Terkirim','Batal','Kadaluarsa') NOT NULL DEFAULT 'Menunggu',
  `waktu_pemesanan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `kode_pemesanan`, `email_pelanggan`, `kode_barang`, `jml_pesanan`, `total_bayar`, `status`, `waktu_pemesanan`) VALUES
(6, '1814937211897568', 'muhammadrosidin@gmail.com', 'GAD3196975', 2, '37800', 'Menunggu', '2017-05-02 10:33:09'),
(7, '1814937211897568', 'muhammadrosidin@gmail.com', 'GAD3196984', 1, '25000', 'Menunggu', '2017-05-02 10:33:09'),
(8, '1814937211897568', 'muhammadrosidin@gmail.com', 'GAD3259346', 3, '90000', 'Menunggu', '2017-05-02 10:33:09'),
(9, '1814937211897568', 'muhammadrosidin@gmail.com', 'KOM3196887', 1, '19000', 'Menunggu', '2017-05-02 10:33:09'),
(10, '1814938597804229', 'muhammadrosidin@gmail.com', 'GAD3196975', 2, '37800', 'Menunggu', '2017-05-04 01:03:01'),
(11, '1814938597804229', 'muhammadrosidin@gmail.com', 'GAD3196984', 1, '25000', 'Menunggu', '2017-05-04 01:03:01'),
(12, '18149387263616256', 'muhammadrosidin@gmail.com', 'GAD3196975', 2, '37800', 'Menunggu', '2017-05-04 04:37:16'),
(13, '18149387263616256', 'muhammadrosidin@gmail.com', 'GAD3196984', 1, '25000', 'Menunggu', '2017-05-04 04:37:16'),
(14, '18149387268314777', 'muhammadrosidin@gmail.com', 'GAD3196960', 1, '18500', 'Menunggu', '2017-05-04 04:38:03'),
(15, '18149387268314777', 'muhammadrosidin@gmail.com', 'GAD3196975', 1, '18900', 'Menunggu', '2017-05-04 04:38:03'),
(16, '18149387268314777', 'muhammadrosidin@gmail.com', 'GAD3196993', 1, '25600', 'Menunggu', '2017-05-04 04:38:03'),
(17, '18149387268314777', 'muhammadrosidin@gmail.com', 'GAD3259346', 1, '30000', 'Menunggu', '2017-05-04 04:38:03'),
(18, '18149387268314777', 'muhammadrosidin@gmail.com', 'KOM1', 1, '15000000', 'Menunggu', '2017-05-04 04:38:03'),
(19, '18149387268314777', 'muhammadrosidin@gmail.com', 'KOM3196887', 1, '19000', 'Menunggu', '2017-05-04 04:38:03'),
(20, '18149387268314777', 'muhammadrosidin@gmail.com', 'KOM3197007', 1, '17000', 'Menunggu', '2017-05-04 04:38:03'),
(21, '18149387271215957', 'muhammadrosidin@gmail.com', 'GAD3196844', 1, '28800', 'Menunggu', '2017-05-04 04:38:32'),
(22, '1814938727348298', 'muhammadrosidin@gmail.com', 'GAD3196960', 1, '18500', 'Menunggu', '2017-05-04 04:38:54'),
(23, '1814938727348298', 'muhammadrosidin@gmail.com', 'GAD3196975', 2, '37800', 'Menunggu', '2017-05-04 04:38:54'),
(24, '1814938727348298', 'muhammadrosidin@gmail.com', 'GAD3196984', 3, '75000', 'Menunggu', '2017-05-04 04:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_provinsi`
--

CREATE TABLE IF NOT EXISTS `tbl_provinsi` (
  `id_provinsi` int(2) NOT NULL,
  `provinsi` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`id_provinsi`, `provinsi`) VALUES
(11, 'NANGGROE ACEH DARUSSALAM'),
(12, 'SUMATERA UTARA'),
(13, 'SUMATERA BARAT'),
(14, 'RIAU'),
(15, 'JAMBI'),
(16, 'SUMATERA SELATAN'),
(17, 'BENGKULU'),
(18, 'LAMPUNG'),
(19, 'BANGKA BELITUNG'),
(20, 'KEPULAUAN RIAU'),
(31, 'DKI JAKARTA'),
(32, 'JAWA BARAT'),
(33, 'JAWA TENGAH'),
(34, 'DI YOGYAKARTA'),
(35, 'JAWA TIMUR'),
(36, 'BANTEN'),
(51, 'BALI'),
(52, 'NUSA TENGGARA BARAT'),
(53, 'NUSA TENGGARA TIMUR'),
(61, 'KALIMANTAN BARAT'),
(62, 'KALIMANTAN TENGAH'),
(63, 'KALIMANTAN SELATAN'),
(64, 'KALIMANTAN TIMUR'),
(71, 'SULAWESI UTARA'),
(72, 'SULAWESI TENGAH'),
(73, 'SULAWESI SELATAN'),
(74, 'SULAWESI TENGGARA'),
(75, 'GORONTALO'),
(76, 'SULAWESI BARAT'),
(81, 'MALUKU'),
(82, 'MALUKU UTARA'),
(94, 'PAPUA'),
(95, 'IRIAN JAYA BARAT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`email_pelanggan`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `tbl_pengiriman`
--
ALTER TABLE `tbl_pengiriman`
  ADD PRIMARY KEY (`kode_pemesanan`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `email_pelanggan` (`email_pelanggan`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Indexes for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `id_provinsi` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD CONSTRAINT `tbl_barang_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `tbl_kategori` (`kode_kategori`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD CONSTRAINT `tbl_konfirmasi_ibfk_1` FOREIGN KEY (`kode_pemesanan`) REFERENCES `tbl_pengiriman` (`kode_pemesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD CONSTRAINT `tbl_pelanggan_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `tbl_provinsi` (`id_provinsi`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`email_pelanggan`) REFERENCES `tbl_pelanggan` (`email_pelanggan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_3` FOREIGN KEY (`kode_barang`) REFERENCES `tbl_barang` (`kode_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_4` FOREIGN KEY (`kode_pemesanan`) REFERENCES `tbl_pengiriman` (`kode_pemesanan`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
