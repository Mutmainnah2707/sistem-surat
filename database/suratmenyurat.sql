-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 05:12 PM
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
-- Database: `suratmenyurat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_surat_masuk` int(10) UNSIGNED NOT NULL,
  `tanggal_disposisi` date NOT NULL,
  `disposisi_ke` varchar(250) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_surat_masuk`, `tanggal_disposisi`, `disposisi_ke`, `keterangan`) VALUES
(1, '2024-08-22', 'Satker', 'Satker');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-08-21-034210', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1724211806, 1),
(2, '2024-08-21-052218', 'App\\Database\\Migrations\\CreateSuratMasukTable', 'default', 'App', 1724217807, 2),
(3, '2024-08-21-052308', 'App\\Database\\Migrations\\CreateSuratKeluarTable', 'default', 'App', 1724217807, 2),
(4, '2024-08-22-071130', 'App\\Database\\Migrations\\CreateDisposisiTable', 'default', 'App', 1724310714, 3);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat` int(10) UNSIGNED NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tujuan_surat` varchar(250) NOT NULL,
  `jenis_surat` varchar(255) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `id_surat_masuk` int(10) UNSIGNED DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat`, `asal_surat`, `no_surat`, `perihal`, `tanggal_terima`, `tujuan_surat`, `jenis_surat`, `file_surat`, `id_surat_masuk`, `is_draft`) VALUES
(1, 'halo dek', '20', 'halo', '2024-08-21', 'Satker', 'Halo dek', '1724226457_7c6ba5c83af38bec72fe.docx', 2, 0),
(2, 'halo dek', 'VI/021/A/VIII', 'halo', '2024-08-21', 'Pimpinan Pondok', 'Halo dek', '1724226816_f2f4759074cff9c5bfb6.docx', 3, 0),
(3, 'halo dek', 'VI/022/A/VIII', 'satker', '2024-08-21', 'Satker', 'satker', '1724257817_9c889e87f5e1bf10da58.docx', 4, 0),
(4, 'tes satker', 'VI/023/A/VIII', 'satker', '2024-08-21', 'Satker', 'satker', '1724258197_c647769e36fbcf3d99ce.docx', 5, 0),
(5, 'pengurus', 'VI/024/A/VIII', 'pengurus', '2024-08-22', 'Pimpinan Pondok', 'pengurus', '1724260208_45e1a960d9989c945ad3.docx', 6, 0),
(6, 'tes satkerss', 'VI/025/A/VIII', 'satker', '2024-08-23', 'Satker', 'Pemberitahuan', '1724423023_09f9caec8dbe349937b5.docx', 7, 0),
(7, 'Admin', 'VI/026/A/VIII', 'Pemberitahuan', '2024-08-23', 'Pimpinan Pondok', 'Pemberitahuan', '1724427768_42124572e07ba53c0593.docx', 8, 0),
(8, 'disposisi', '', 'disposisi', '2024-08-25', 'Satker', 'disposisi', '1724589530_1f267bd5b8e07a4a4767.docx', NULL, 0),
(9, 'adminkk', 'VI/334/A/VIII', 'adminkk', '2024-08-25', 'Satker', 'adminkk', '1724593947_fd6751fb5166b920e2dd.docx', NULL, 0),
(10, 'notdraft', 'VI/334/A/VIII', 'notdraft', '2024-08-25', 'Satker', 'notdraft', '1724594031_72a7c6502caccbc91cfc.docx', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat` int(10) UNSIGNED NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `perihal` varchar(250) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tujuan_surat` varchar(250) NOT NULL,
  `jenis_surat` varchar(255) DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat`, `asal_surat`, `no_surat`, `perihal`, `tanggal_terima`, `tujuan_surat`, `jenis_surat`, `file_surat`, `created_at`, `updated_at`, `status`) VALUES
(1, 'halo dekllss', '20', 'halo', '2024-08-21', 'Satker', 'Halo dek', '1724225795_20b74470ea7c108119d6.jpeg', '2024-08-20 17:36:35', '2024-08-23 07:37:10', 1),
(2, 'halo dek', '20', 'halo', '2024-08-21', 'Pengurus', NULL, NULL, '2024-08-20 17:47:37', '2024-08-21 19:34:42', 0),
(3, 'halo dek', 'VI/021/A/VIII', 'halo', '2024-08-21', 'Pimpinan Pondok', NULL, NULL, '2024-08-20 17:53:36', '2024-08-25 05:05:58', 1),
(4, 'halo dek', 'VI/022/A/VIII', 'satker', '2024-08-21', 'Satker', NULL, NULL, '2024-08-21 02:30:17', '2024-08-23 00:58:42', 1),
(5, 'tes satker', 'VI/023/A/VIII', 'satker', '2024-08-21', 'Satker', 'satker', '1724258197_c647769e36fbcf3d99ce.docx', '2024-08-21 02:36:37', '2024-08-25 04:38:48', 1),
(6, 'pengurus', 'VI/024/A/VIII', 'pengurus', '2024-08-22', 'Satker', 'pengurus', '1724260208_45e1a960d9989c945ad3.docx', '2024-08-21 03:10:08', '2024-08-25 04:39:03', 1),
(7, 'tes satkerss', 'VI/025/A/VIII', 'satker', '2024-08-23', 'Satker', 'Pemberitahuan', '1724423023_09f9caec8dbe349937b5.docx', '2024-08-23 00:23:43', '2024-08-23 00:23:43', 0),
(8, 'Admin', 'VI/026/A/VIII', 'Pemberitahuan', '2024-08-23', 'Satker', 'Pemberitahuan', '1724427768_42124572e07ba53c0593.docx', '2024-08-23 01:42:48', '2024-08-23 01:42:48', 0),
(12, 'admin', '333', 'admin', '2024-08-25', 'admin', NULL, '1724589740_91a2368669cbab3baf60.docx', '2024-08-25 05:42:20', '2024-08-25 05:42:20', 0),
(13, 'notdraft', 'VI/334/A/VIII', 'notdraft', '2024-08-25', 'Satker', 'notdraft', '1724594031_72a7c6502caccbc91cfc.docx', '2024-08-25 06:53:51', '2024-08-25 06:53:51', 0),
(14, 'adminkk', 'VI/335/A/VIII', 'adminkk', '2024-08-25', 'Satker', 'adminkk', '1724593947_fd6751fb5166b920e2dd.docx', '2024-08-25 07:31:22', '2024-08-25 07:31:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('admin','user','satker','pengurus') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`, `email`, `level`) VALUES
(1, 'Johna', '$2y$10$FtLlZD2IArrTw2MqGLUTA.5j4oW.YXaoby4fDtKEgBAJgx1zym5xK', 'john.doe@example.com', 'admin'),
(2, 'Jane Smith', '$2y$10$MCh819iwvNDyCLZmmtotO.4cHxoxL5k5rjbcru36mAQruz9HaQe4.', 'jane.smith@example.com', 'user'),
(3, 'Admin', '$2y$10$iLWwDe4N8Q9gMtitxDExUuVyCQ7PSHX/f9LfN5/jwxG1GXVhQ2mzm', 'admin@example.com', 'admin'),
(5, 'satkerr', '$2y$10$YT6MAgPtrbMG9lSkksw39OYEP7dhQyBL8X9UVXeRleCxbDOG6UgoO', 'satker@example.com', 'satker'),
(6, 'pengurus', '$2y$10$MP2bbPrCDCRCVxlxlW588eeKmMfbBeDFX5D4XOMTaSN3Mi1ekIS6S', 'pengurus@example.com', 'pengurus'),
(7, 'satkerr', '$2y$10$bxIgoEKNKDThtGy0CpCZQO0V7PkKjufhlF/CmMZsSlvWNz28WJdiu', 'satker@examplee.com', 'satker'),
(8, 'penguruss', '$2y$10$vMhyXBB/1qUQrdMYrnRXPuG701yqamxul6l8tzrxrjA0nnjIz.1dy', 'penguruss@example.com', 'pengurus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD KEY `disposisi_id_surat_masuk_foreign` (`id_surat_masuk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `fk_id_surat_masuk` (`id_surat_masuk`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_id_surat_masuk_foreign` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `fk_id_surat_masuk` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
