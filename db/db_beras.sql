-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2023 at 08:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beras`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_beras`
--

CREATE TABLE `db_beras` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `karung` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_beras`
--

INSERT INTO `db_beras` (`id`, `jenis`, `kategori`, `karung`, `berat`, `status`, `harga`, `tgl_input`) VALUES
(2, 'IR', 'Non Wangi', 20, 25, 1, 10600, '2023-05-20 20:32:50'),
(3, 'Kongga', 'Non Wangi', 50, 25, 1, 10600, '2023-05-20 20:33:39'),
(4, 'Ciherang', 'Non Wangi', 20, 25, 1, 10600, '2023-05-20 20:45:21'),
(5, 'Mawar', 'Wangi', 40, 25, 1, 12000, '2023-05-20 23:48:59'),
(11, 'Gaga', 'Wangi', 50, 25, 1, 11000, '2023-05-21 12:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `db_beras_harga_kilogram`
--

CREATE TABLE `db_beras_harga_kilogram` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_beras_harga_kilogram`
--

INSERT INTO `db_beras_harga_kilogram` (`id`, `jenis`, `harga`, `tgl_input`) VALUES
(1, 'IR', 10600, '2023-05-21 05:51:51'),
(2, 'Kongga', 10600, '2023-05-21 05:52:17'),
(3, 'Ciherang', 10600, '2023-05-21 05:52:48'),
(4, 'Mawar', 12000, '2023-05-21 05:53:01'),
(5, 'Gaga', 11000, '2023-05-21 05:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `db_beras_jenis`
--

CREATE TABLE `db_beras_jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_beras_jenis`
--

INSERT INTO `db_beras_jenis` (`id`, `jenis`, `tgl_input`) VALUES
(1, 'Mawar', '2023-05-18 21:13:43'),
(2, 'IR', '2023-05-18 21:13:43'),
(3, 'Gaga', '2023-05-18 21:14:05'),
(4, 'Kongga', '2023-05-18 21:14:05'),
(6, 'Ciherang', '2023-05-25 16:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `db_huut`
--

CREATE TABLE `db_huut` (
  `id` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `karung` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_huut`
--

INSERT INTO `db_huut` (`id`, `berat`, `harga`, `karung`, `status`, `tgl_input`) VALUES
(1, 100, 25000, 5, 1, '2023-05-21 23:06:18'),
(3, 500, 50000, 10, 1, '2023-05-21 23:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `db_login`
--

CREATE TABLE `db_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_login`
--

INSERT INTO `db_login` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `db_log_history`
--

CREATE TABLE `db_log_history` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `karung` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `log` varchar(100) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_log_history`
--

INSERT INTO `db_log_history` (`id`, `kategori`, `jenis`, `karung`, `berat`, `log`, `tgl_input`) VALUES
(1, 'BERAS', 'Ciherang', 20, 25, '', '2023-05-21 11:16:51'),
(2, 'BERAS', 'Mawar', 15, 25, '', '2023-05-21 11:22:30'),
(3, 'BERAS', 'IR', 20, 25, '', '2023-05-21 11:22:37'),
(4, 'BERAS', 'Gaga', 0, 25, '', '2023-05-21 11:22:49'),
(5, 'BERAS', 'Kongga', 0, 25, '', '2023-05-21 11:22:53'),
(6, 'BERAS', 'Mawar', 100, 20, '', '2023-05-21 11:39:06'),
(7, 'BERAS', 'Mawar', 10, 25, 'INSERT', '2023-05-21 11:46:16'),
(8, 'BERAS', 'Mawar', 10, 25, 'UPDATE', '2023-05-21 11:46:33'),
(11, 'BERAS', 'Mawar', 10, 25, 'DELETE', '2023-05-21 11:51:53'),
(12, 'PADI', 'Mawar', 100, 100, 'INSERT', '2023-05-21 12:31:57'),
(13, 'BERAS', 'Gaga', 0, 25, 'DELETE', '2023-05-21 12:39:37'),
(14, 'BERAS', 'Gaga', 0, 25, 'INSERT', '2023-05-21 12:45:31'),
(15, 'PADI', 'Mawar', 100, 100, 'DELETE', '2023-05-21 12:46:15'),
(16, 'PADI', 'Ciherang', 0, 800, 'UPDATE', '2023-05-21 12:55:47'),
(17, 'PADI', 'Mawar', 0, 600, 'UPDATE', '2023-05-21 12:58:11'),
(18, 'PADI', 'IR', 0, 650, 'UPDATE', '2023-05-21 12:58:22'),
(19, 'PADI', 'Gaga', 0, 0, 'UPDATE', '2023-05-21 12:58:29'),
(20, 'PADI', 'Kongga', 0, 0, 'UPDATE', '2023-05-21 12:58:33'),
(21, 'HUUT', '-', 10, 100, 'INSERT', '2023-05-21 23:06:18'),
(22, 'HUUT', '-', 50, 50, 'INSERT', '2023-05-21 23:15:50'),
(23, 'HUUT', '-', 10, 100, 'UPDATE', '2023-05-21 23:18:50'),
(24, 'HUUT', '-', 51, 51, 'UPDATE', '2023-05-21 23:19:03'),
(25, 'HUUT', '-', 50, 51, 'DELETE', '2023-05-21 23:27:55'),
(26, 'HUUT', '-', 10, 500, 'INSERT', '2023-05-21 23:28:04'),
(27, 'HUUT', '-', 5, 100, 'UPDATE', '2023-05-21 23:28:11'),
(28, 'BERAS', 'Mawar', 10, 25, 'INSERT', '2023-05-25 21:31:37'),
(29, 'BERAS', 'Mawar', 10, 25, 'UPDATE', '2023-06-01 16:16:36'),
(30, 'BERAS', 'Gaga', 50, 25, 'INSERT', '2023-06-01 16:50:24'),
(31, 'BERAS', 'Mawar', 30, 25, 'INSERT', '2023-06-01 16:50:51'),
(32, 'PADI', 'IR', 0, 40, 'UPDATE', '2023-06-01 17:58:01'),
(33, 'PADI', 'Ciherang', 0, 50, 'UPDATE', '2023-06-01 17:58:07'),
(34, 'PADI', 'Mawar', 0, 60, 'UPDATE', '2023-06-01 17:58:12'),
(35, 'PADI', 'IR', 10, 40, 'INSERT', '2023-06-01 18:00:01'),
(36, 'PADI', 'IR', 10, 40, 'DELETE', '2023-06-01 18:02:45'),
(37, 'PADI', 'Kongga', 10, 40, 'UPDATE', '2023-06-01 18:04:58'),
(38, 'PADI', 'Gaga', 50, 50, 'UPDATE', '2023-06-01 18:05:10'),
(39, 'PADI', 'IR', 30, 60, 'UPDATE', '2023-06-01 18:05:19'),
(40, 'PADI', 'Ciherang', 20, 50, 'UPDATE', '2023-06-01 18:05:31'),
(41, 'PADI', 'Mawar', 50, 60, 'UPDATE', '2023-06-01 18:05:39'),
(42, 'BERAS', 'Kongga', 50, 25, 'UPDATE', '2023-06-01 18:05:48'),
(43, 'PADI', 'Mawar', 10, 60, 'UPDATE', '2023-06-01 18:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `db_padi`
--

CREATE TABLE `db_padi` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `karung` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_padi`
--

INSERT INTO `db_padi` (`id`, `jenis`, `karung`, `berat`, `status`, `tgl_input`) VALUES
(1, 'Mawar', 10, 60, 1, '2023-05-21 00:51:06'),
(2, 'Ciherang', 20, 50, 1, '2023-05-21 00:53:36'),
(3, 'IR', 30, 60, 1, '2023-05-21 00:53:50'),
(4, 'Gaga', 50, 50, 1, '2023-05-21 00:54:07'),
(5, 'Kongga', 10, 40, 1, '2023-05-21 00:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `db_padi_harga_kilogram`
--

CREATE TABLE `db_padi_harga_kilogram` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `db_transaksi`
--

CREATE TABLE `db_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pembeli` varchar(100) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_transaksi`
--

INSERT INTO `db_transaksi` (`id`, `id_transaksi`, `jenis`, `kategori`, `harga`, `jumlah_beli`, `total`, `pembeli`, `total_bayar`, `tgl_input`) VALUES
(1, 'TB-20230525183319', 'Mawar', 'Beras', 12000, 10, 120000, 'Jemi Yosua', 0, '2023-05-25 18:34:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_beras`
--
ALTER TABLE `db_beras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_beras_harga_kilogram`
--
ALTER TABLE `db_beras_harga_kilogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_beras_jenis`
--
ALTER TABLE `db_beras_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_huut`
--
ALTER TABLE `db_huut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_login`
--
ALTER TABLE `db_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_log_history`
--
ALTER TABLE `db_log_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_padi`
--
ALTER TABLE `db_padi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_padi_harga_kilogram`
--
ALTER TABLE `db_padi_harga_kilogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_transaksi`
--
ALTER TABLE `db_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_beras`
--
ALTER TABLE `db_beras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `db_beras_harga_kilogram`
--
ALTER TABLE `db_beras_harga_kilogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `db_beras_jenis`
--
ALTER TABLE `db_beras_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `db_huut`
--
ALTER TABLE `db_huut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_login`
--
ALTER TABLE `db_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_log_history`
--
ALTER TABLE `db_log_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `db_padi`
--
ALTER TABLE `db_padi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_padi_harga_kilogram`
--
ALTER TABLE `db_padi_harga_kilogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_transaksi`
--
ALTER TABLE `db_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
