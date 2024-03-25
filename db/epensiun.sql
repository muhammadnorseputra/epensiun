-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2024 at 02:21 AM
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
-- Table structure for table `api_access`
--

CREATE TABLE `api_access` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(40) NOT NULL DEFAULT '',
  `all_access` tinyint(1) NOT NULL DEFAULT 0,
  `controller` varchar(50) NOT NULL DEFAULT '',
  `date_created` datetime DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_access`
--

INSERT INTO `api_access` (`id`, `key`, `all_access`, `controller`, `date_created`, `date_modified`) VALUES
(1, 'Pensiun6811', 1, 'api/welcome', '2024-03-23 13:48:14', '2024-03-23 12:59:23'),
(2, 'Pensiun6811', 1, 'api/usul', '2024-03-23 13:48:14', '2024-03-23 12:59:23');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'Pensiun6811', 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `api_limits`
--

CREATE TABLE `api_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usul`
--

CREATE TABLE `usul` (
  `id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `is_status` enum('SKPD','BKPSDM','TTD_SK','SELESAI','SELESAI_ARSIP','SELESAI_TMS','SELESAI_BTL') NOT NULL DEFAULT 'SKPD',
  `nip` varchar(20) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `gelar_depan` varchar(10) DEFAULT NULL,
  `gelar_belakang` varchar(10) DEFAULT NULL,
  `id_unit_kerja` int(11) NOT NULL,
  `nama_golru` varchar(50) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `nama_pangkat` varchar(50) NOT NULL,
  `nama_unit_kerja` varchar(120) NOT NULL,
  `nama_penerima` varchar(50) DEFAULT NULL,
  `hub_keluarga` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `alamat_pensiun` text DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_meninggal` date DEFAULT NULL,
  `tmp_lahir` varchar(100) NOT NULL,
  `tgl_lahir_penerima` date DEFAULT NULL,
  `usia_pensiun` varchar(8) NOT NULL,
  `tmt_pensiun` date DEFAULT NULL,
  `url_photo` varchar(100) NOT NULL,
  `url_berkas` text DEFAULT NULL,
  `nomor_sk` varchar(100) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `url_sk` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `verify_at` timestamp NULL DEFAULT NULL,
  `verify_by` varchar(20) DEFAULT NULL,
  `approve_at` timestamp NULL DEFAULT NULL,
  `approve_by` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL,
  `created_by_unorid` int(11) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(20) DEFAULT NULL,
  `arsip_at` timestamp NULL DEFAULT NULL,
  `arsip_by` varchar(80) DEFAULT NULL,
  `diterima_oleh` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usul_jenis`
--

CREATE TABLE `usul_jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `kelompok` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usul_jenis`
--

INSERT INTO `usul_jenis` (`id`, `nama`, `keterangan`, `kelompok`) VALUES
(1, 'BUP', 'Batas Usia Pensiun', 'BUP'),
(2, 'JANDA/DUDA', 'Pensiun Janda atau Duda', 'NONBUP'),
(3, 'APS', 'Pensiun Atas Permintaan Sendiri', 'NONBUP'),
(4, 'UDZUR', 'Pensiun Karna Sakit', 'NONBUP'),
(5, 'MPP', 'Masa Persiapan Pensiun', 'NONBUP'),
(6, 'MENINGGAL DUNIA', 'Pensiun Meninggal Dunia', 'NONBUP'),
(7, 'TDD', 'Tewas Dalam Dinas', 'NONBUP'),
(8, 'CKD', 'Cacat Karena Dinas', 'NONBUP'),
(9, 'BUP NON KPP', 'BUP Tanpa Pangkat Pengabdian', 'NONBUP');

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
  `is_status` enum('SKPD','BKPSDM','TTD_SK','SELESAI','SELESAI_ARSIP','SELESAI_TMS','SELESAI_BTL') NOT NULL DEFAULT 'SKPD',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(20) NOT NULL,
  `created_by_unorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_access`
--
ALTER TABLE `api_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_limits`
--
ALTER TABLE `api_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usul`
--
ALTER TABLE `usul`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `api_access`
--
ALTER TABLE `api_access`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_limits`
--
ALTER TABLE `api_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usul`
--
ALTER TABLE `usul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usul_jenis`
--
ALTER TABLE `usul_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usul_pengantar`
--
ALTER TABLE `usul_pengantar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
