-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2024 at 06:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epensiun`
--

-- --------------------------------------------------------

--
-- Table structure for table `usul_jenis`
--

CREATE TABLE `usul_jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usul_jenis`
--

INSERT INTO `usul_jenis` (`id`, `nama`, `keterangan`) VALUES
(1, 'BUP', 'Batas Usia Pensiun'),
(2, 'JANDA/DUDA', 'Pensiun Janda atau Duda'),
(3, 'APS', 'Pensiun Atas Permintaan Sendiri'),
(4, 'UDZUR', 'Pensiun Meninggal Dunia Atau Kecelakaan');

-- --------------------------------------------------------

--
-- Table structure for table `usul_pengantar`
--

CREATE TABLE `usul_pengantar` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `fid_jenis_usul` int(11) NOT NULL,
  `nomor` varchar(70) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL,
  `created_by_unorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usul_jenis`
--
ALTER TABLE `usul_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usul_pengantar`
--
ALTER TABLE `usul_pengantar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usul_jenis`
--
ALTER TABLE `usul_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usul_pengantar`
--
ALTER TABLE `usul_pengantar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
