-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 07:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(30) NOT NULL,
  `isi` text NOT NULL,
  `tgl` date NOT NULL DEFAULT current_timestamp(),
  `id_pelanggan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `isi`, `tgl`, `id_pelanggan`) VALUES
(1, 'Pelayanan laundry-nya cepat dan hasil cucian bersih serta wangi. Sangat puas dan pasti akan kembali lagi!', '2025-06-16', 1),
(8, 'Staff ramah, proses laundry cepat, dan hasilnya rapi. Harga juga terjangkau. Recommended!', '2025-06-16', 5),
(16, 'Sudah beberapa kali pakai jasa laundry ini, dan selalu memuaskan. Baju wangi dan tidak rusak. Terima kasih!', '2025-06-18', 4),
(17, 'Laundry cepat selesai sesuai estimasi, tidak ada pakaian yang hilang atau tertukar. Mantap!', '2025-06-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Karina', 'karina@gmail.com', '123'),
(2, 'Ali', 'ali@gmail.com', '000');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `no_telpon` int(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `no_telpon`, `password`) VALUES
(1, 'Alea', 'alea@gmail.com', 2147483647, '123'),
(4, 'Paijo', 'paijo@gmail.com', 2147483647, '111'),
(5, 'Rani', 'rani@gmail.com', 2147483647, '222');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` int(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Irene', 'irene@gmail.com', '123'),
(2, 'Amri', 'amri@gmail.com', '111');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(20) NOT NULL,
  `tgl` date NOT NULL,
  `deskripsi` text NOT NULL,
  `nominal` int(30) NOT NULL,
  `id_pemilik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tgl`, `deskripsi`, `nominal`, `id_pemilik`) VALUES
(1, '2025-06-07', 'Perbaikan setrika', 40000, 1),
(4, '2025-06-16', 'Beli parfum', 35000, 1),
(6, '2025-06-14', 'Beli pelembut', 20000, 1),
(8, '2025-06-18', 'Perbaikan mesin cuci', 70000, 1),
(9, '2025-06-19', 'Beli Setrika', 120000, 1),
(11, '2025-06-19', 'Bayar listrik', 200000, 1),
(14, '2025-06-25', 'Bayar air', 50000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `layanan` varchar(30) NOT NULL,
  `berat` varchar(30) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `no_telp` int(30) NOT NULL,
  `tgl` date NOT NULL,
  `parfum` varchar(50) NOT NULL,
  `pembayaran` enum('Unpaid','Paid','','') NOT NULL DEFAULT 'Unpaid',
  `status` enum('Process','Finished','','') NOT NULL DEFAULT 'Process',
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `layanan`, `berat`, `total_harga`, `no_telp`, `tgl`, `parfum`, `pembayaran`, `status`, `id_pelanggan`, `id_karyawan`) VALUES
(2, 'Siti', 'Express Wash', '5 ', 50000, 2147483647, '2025-06-13', 'Lavender Fresh', 'Unpaid', 'Finished', 1, 1),
(3, 'Rani', 'Washing & Iron', '3', 18000, 814488272, '2025-06-02', 'Sweet Vanilla', 'Paid', 'Finished', 5, 2),
(5, 'Alea', 'Washing & Folding', '2', 8000, 2147483647, '2025-06-03', 'Lavender Fresh', 'Unpaid', 'Finished', 1, 1),
(7, 'Paijo', 'Washing & Folding', '6', 30000, 2147483647, '2025-06-28', 'Sweet Vanilla', 'Paid', 'Finished', 4, 1),
(12, 'Rani', 'Washing & Folding', '2', 10000, 2147483647, '2025-06-16', 'Sweet Vanilla', 'Paid', 'Finished', 5, 1),
(15, 'Rani', 'Washing', '1', 4000, 2147483647, '2025-06-16', 'Sweet Vanilla', 'Unpaid', 'Finished', 5, 2),
(16, 'Rani', 'Washing & Folding', '1', 5000, 2147483647, '2025-06-16', 'Lavender Fresh', 'Unpaid', 'Finished', 5, 1),
(19, 'Paijo', 'Washing', '2', 8000, 2147483647, '2025-06-17', 'Sweet Vanilla', 'Unpaid', 'Finished', 4, 1),
(20, 'Paijo', 'Express Wash', '2', 20000, 814488272, '2025-06-17', 'Floral Garden', 'Unpaid', 'Finished', 4, 2),
(21, 'Alea', 'Washing & Iron', '4', 24000, 2147483647, '2025-06-25', 'Sweet Vanilla', 'Unpaid', 'Finished', 1, 1),
(22, 'Alea', 'Iron', '3', 15000, 2147483647, '2025-06-25', 'Lavender Fresh', 'Paid', 'Finished', 1, 2),
(23, 'Yati', 'Express Wash', '3', 30000, 814488272, '2025-06-27', 'Sweet Vanilla', 'Unpaid', 'Process', 4, NULL),
(24, 'Paijo', 'Washing & Iron', '2', 12000, 814488272, '2025-06-25', 'Floral Garden', 'Unpaid', 'Process', 4, NULL),
(25, 'Alea', 'Washing & Iron', '1', 6000, 2147483647, '2025-06-25', 'Sweet Vanilla', 'Unpaid', 'Process', 1, NULL),
(26, 'Alea', 'Iron', '2', 10000, 2147483647, '2025-06-25', 'Sweet Vanilla', 'Unpaid', 'Process', 1, NULL),
(27, 'Alea', 'Washing', '3', 12000, 814488272, '2025-06-25', 'Sweet Vanilla', 'Unpaid', 'Finished', 1, 1),
(28, 'Sela', 'Express Wash', '3', 10000, 814488272, '2025-06-25', 'Sweet Vanilla', 'Unpaid', 'Process', 1, NULL),
(29, 'Alea', 'Washing', '2', 8000, 814488272, '2025-06-25', 'Floral Garden', 'Unpaid', 'Process', 1, NULL),
(30, 'Alea', 'Washing', '3', 12000, 814488272, '2025-06-25', 'Floral Garden', 'Unpaid', 'Process', 1, NULL),
(32, 'Alea', 'Washing', '2', 8000, 814488272, '2025-06-26', 'Floral Garden', 'Paid', 'Process', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `fk_feedback_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengeluaran_pemilik` (`id_pemilik`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesanan_pelanggan` (`id_pelanggan`),
  ADD KEY `fk_pesanan_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_pengeluaran_pemilik` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_karyawan` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pesanan_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
