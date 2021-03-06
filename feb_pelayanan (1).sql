-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 10:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feb_pelayanan`
--

-- --------------------------------------------------------

--
-- Table structure for table `feb_aktifkuliah`
--

CREATE TABLE `feb_aktifkuliah` (
  `id_aktifkuliah` bigint(255) NOT NULL,
  `npm_aktifkuliah` bigint(255) NOT NULL,
  `nama_aktifkuliah` varchar(255) NOT NULL,
  `no_aktifkuliah` varchar(255) NOT NULL,
  `keterangan_aktifkuliah` varchar(255) NOT NULL,
  `confirm_aktifkuliah` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feb_aktifkuliah`
--

INSERT INTO `feb_aktifkuliah` (`id_aktifkuliah`, `npm_aktifkuliah`, `nama_aktifkuliah`, `no_aktifkuliah`, `keterangan_aktifkuliah`, `confirm_aktifkuliah`, `created_at`, `updated_at`) VALUES
(1, 29452231993, 'Widhiawan Agung Kusumo', '1/K/I/FEB/UPS/VI/2022', '', 0, '2022-06-22 05:34:35', '2022-06-22 05:34:35'),
(2, 29452231993, 'Widhiawan Agung Kusumo', '2/K/I/FEB/UPS/VI/2022', '', 0, '2022-06-22 05:35:47', '2022-06-22 05:35:47'),
(3, 29452231993, 'Widhiawan Agung Kusumo', '3/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 06:28:21', '2022-06-22 06:28:21'),
(4, 29452231993, 'Widhiawan Agung Kusumo', '4/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 06:59:11', '2022-06-22 06:59:11'),
(5, 29452231993, 'Widhiawan Agung Kusumo', '5/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 07:53:09', '2022-06-22 07:53:09'),
(6, 29452231993, 'Widhiawan Agung K', '6/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:06:45', '2022-06-22 08:06:45'),
(7, 29452231993, 'Widhiawan Agung K', '7/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:07:40', '2022-06-22 08:07:40'),
(8, 29452231993, 'Widhiawan Agung K', '8/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:08:17', '2022-06-22 08:08:17'),
(9, 29452231993, 'Widhiawan Agung K', '9/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:11:47', '2022-06-22 08:11:47'),
(10, 29452231993, 'Widhiawan Agung K', '10/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:13:07', '2022-06-22 08:13:07'),
(11, 29452231993, 'Widhiawan Agung K', '11/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:13:47', '2022-06-22 08:13:47'),
(12, 29452231993, 'Widhiawan Agung K', '12/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 08:14:18', '2022-06-22 08:14:18'),
(13, 29452231993, 'Widhiawan Agung K', '13/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 09:36:29', '2022-06-22 09:36:29'),
(14, 29452231993, 'Widhiawan Agung K', '14/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-22 09:40:03', '2022-06-22 09:40:03'),
(15, 29452231993, 'Widhiawan Agung K', '15/K/E/FEB/UPS/VI/2022', 'Surat Ijin Penelitian', 0, '2022-06-22 09:40:30', '2022-06-22 09:40:30'),
(16, 1234567890, 'Fakultas Ekonomi dan Bisnis', '16/K/E/FEB/UPS/VI/2022', 'Surat Ijin Penelitian', 1, '2022-06-22 10:26:35', '2022-07-04 03:26:43'),
(17, 29452231993, 'Widhiawan Agung K', '17/K/E/FEB/UPS/VI/2022', 'Surat Ijin Penelitian', 0, '2022-06-30 02:32:22', '2022-06-30 02:32:22'),
(18, 29452231993, 'Widhiawan Agung K', '18/K/I/FEB/UPS/VI/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-06-30 02:37:49', '2022-06-30 02:37:49'),
(19, 1234567890, 'Fakultas Ekonomi dan Bisnis', '1/K/I/FEB/UPS/VII/2022', 'Surat Keterangan Aktif Kuliah', 1, '2022-07-01 11:05:11', '2022-07-04 03:28:42'),
(20, 1234567890, 'Fakultas Ekonomi dan Bisnis', '2/K/I/FEB/UPS/VII/2022', 'Surat Keterangan Aktif Kuliah', 0, '2022-07-01 11:06:01', '2022-07-04 03:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `feb_jurusan`
--

CREATE TABLE `feb_jurusan` (
  `id_jurusan` int(255) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `kaprodi_jurusan` varchar(255) NOT NULL,
  `akreditasi_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feb_jurusan`
--

INSERT INTO `feb_jurusan` (`id_jurusan`, `nama_jurusan`, `kaprodi_jurusan`, `akreditasi_jurusan`) VALUES
(1, 'Manajemen', 'Yuni Utami', 'Baik Sekali'),
(2, 'Akuntansi', 'Abdulloh Mubarok', 'Baik Sekali'),
(3, 'Bisnis Digital', 'Deddy Prihadi', 'Minimal'),
(4, 'Manajemen Perpajakan', 'Mei Rani Amalia', 'Baik');

-- --------------------------------------------------------

--
-- Table structure for table `feb_user`
--

CREATE TABLE `feb_user` (
  `id_user` int(255) NOT NULL,
  `npm_user` bigint(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `jurusan_user` int(255) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `tempat_user` varchar(255) NOT NULL,
  `lahir_user` date NOT NULL,
  `ortu_user` varchar(255) NOT NULL,
  `kerja_user` varchar(255) NOT NULL,
  `semester_user` int(255) NOT NULL,
  `pangkat_user` varchar(255) NOT NULL,
  `skripsi_user` varchar(255) NOT NULL,
  `institusi_user` varchar(255) NOT NULL,
  `alis_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `role` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feb_user`
--

INSERT INTO `feb_user` (`id_user`, `npm_user`, `email_user`, `nama_user`, `jurusan_user`, `alamat_user`, `tempat_user`, `lahir_user`, `ortu_user`, `kerja_user`, `semester_user`, `pangkat_user`, `skripsi_user`, `institusi_user`, `alis_user`, `pass_user`, `role`, `created_at`, `updated_at`) VALUES
(1, 29452231993, 'zhebom@gmail.com', 'Widhiawan Agung K', 3, 'Jl. Nanas No. 7 RT.5 RW.2 Kelurahan Procot Kecamatan Slawi', 'Tegal', '1993-03-22', 'Ali Sasmito', 'PNS', 3, 'Penata Muda / IV A', 'pengaruh antara perbandingan dan penambahan (Studi kasus:Fakultas Ekonomi dan Bisnis Universitas Pancasakti Tegal)', 'Fakultas Ekonomi dan Bisnis Universitas Pancasakti Tegal', 'Jl. Halmahera 1, RT.5 RW.2 Kecamatan tegal timur', '$2y$10$5TKy0pBCmWlC8/SoLc5YR.YRV/zyUtXOlIKNy.ntM2QwH45N.ct0y', 1, '2022-06-22 00:29:19', '2022-06-29 21:32:19'),
(2, 1234567890, 'zhebom@gmail.com', 'Fakultas Ekonomi dan Bisnis', 3, 'Jl. Nanas No. 7 RT.5 RW.2 Kelurahan Procot Kecamatan Slawi', 'Tegal', '1998-05-04', 'Ali Sasmito', 'PNS', 3, 'Penata Muda / IV A', '', '', '', '$2y$10$FyP6EeRN/2WyWZghV2bueOL.mXZRFJIrYt6JFW5jPhW86Uw7W8T3a', 3, '2022-06-22 05:26:08', '2022-07-01 20:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `menu_user`
--

CREATE TABLE `menu_user` (
  `id_menu` int(11) NOT NULL,
  `role_menu` int(11) NOT NULL,
  `href_menu` varchar(255) NOT NULL,
  `class_menu` varchar(255) NOT NULL,
  `title_menu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_user`
--

INSERT INTO `menu_user` (`id_menu`, `role_menu`, `href_menu`, `class_menu`, `title_menu`) VALUES
(1, 1, 'mahasiswa', 'fas fa-fw fa-solid fa-user', 'Data Mahasiswa'),
(2, 1, '/surat', 'fas fa-fw fa-solid fa-envelope-open-text', 'Pelayanan Surat'),
(3, 3, '/surat', 'fas fa-fw fa-solid fa-envelope-open-text', 'Pelayanan Surat'),
(4, 3, 'profil', 'fas fa-fw fa-solid fa-user', 'Biodata Diri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feb_aktifkuliah`
--
ALTER TABLE `feb_aktifkuliah`
  ADD PRIMARY KEY (`id_aktifkuliah`);

--
-- Indexes for table `feb_jurusan`
--
ALTER TABLE `feb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `feb_user`
--
ALTER TABLE `feb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `menu_user`
--
ALTER TABLE `menu_user`
  ADD PRIMARY KEY (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feb_aktifkuliah`
--
ALTER TABLE `feb_aktifkuliah`
  MODIFY `id_aktifkuliah` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feb_jurusan`
--
ALTER TABLE `feb_jurusan`
  MODIFY `id_jurusan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feb_user`
--
ALTER TABLE `feb_user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_user`
--
ALTER TABLE `menu_user`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
