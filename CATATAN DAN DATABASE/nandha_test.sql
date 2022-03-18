-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 06:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nandha_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 2),
(8, '2022_03_16_134010_create_t_po_table', 2),
(9, '2022_03_16_134022_create_t_po_detail_table', 2),
(10, '2022_03_16_152421_modify_id_po_table_t_po', 3),
(11, '2022_03_16_153442_modify_harga_satuan_po_table_t_po_detail', 4),
(12, '2022_03_17_042518_add_sub_total_to_t_po_detail_table', 5),
(13, '2022_03_17_043256_drop_harga_satuan_t_po_detail_table', 6),
(14, '2022_03_17_043359_add_harga_satuan_to_t_po_detail_table', 7),
(15, '2022_03_17_081544_modify_columns_t_po_detail', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_po`
--

CREATE TABLE `t_po` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_po` date DEFAULT NULL,
  `nama_supplier_atau_vendor` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cara_bayar` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_po`
--

INSERT INTO `t_po` (`id`, `kode_po`, `tanggal_po`, `nama_supplier_atau_vendor`, `cara_bayar`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'PO-11', '2022-03-16', 'gadgetstore', 'transfer', '1', '2022-03-16 15:19:55', '2022-03-17 12:10:21'),
(5, 'PO-15', '2022-03-16', 'lunarstore', 'cash', '1', NULL, '2022-03-17 11:17:58'),
(6, 'PO-16', '2022-03-17', 'electrokit', 'cash', '1', NULL, '2022-03-18 05:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `t_po_detail`
--

CREATE TABLE `t_po_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_barang` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_satuan` double(10,2) NOT NULL,
  `sub_total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_po_detail`
--

INSERT INTO `t_po_detail` (`id`, `id_item`, `id_po`, `nama_barang`, `merk_barang`, `satuan_barang`, `qty`, `harga_satuan`, `sub_total`, `created_at`, `updated_at`) VALUES
(10, 1244, '1', 'mouse', 'steelseries', 'pcs', 1, 400000.00, 400000.00, '2022-03-17 06:52:49', NULL),
(11, 2233, '1', 'ps4', 'sony', 'pcs', 2, 3000000.00, 6000000.00, '2022-03-17 06:53:33', '2022-03-17 08:03:59'),
(12, 4444, '1', 'tv led', 'samsung', 'unit', 1, 7000000.00, 7000000.00, '2022-03-17 06:56:37', '2022-03-17 13:03:53'),
(15, 2233, '5', 'macbook air', 'apple', 'pcs', 1, 15000000.00, 15000000.00, '2022-03-17 08:35:02', NULL),
(19, 1, '6', 'resistor', 'reskit', 'pcs', 100, 500.00, 50000.00, '2022-03-18 04:57:42', NULL),
(20, 123, '6', 'capacitor', 'cap', 'pcs', 200, 250.00, 50000.00, '2022-03-18 04:58:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nandha', 'admin@app.com', NULL, '$2y$10$SA985h4AWsVrupDFcDxm5eCMgg5h101gJgRvKFBcyLRImoofPiyq.', NULL, '2022-03-16 07:24:56', '2022-03-16 07:24:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `t_po`
--
ALTER TABLE `t_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_po_detail`
--
ALTER TABLE `t_po_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_po`
--
ALTER TABLE `t_po`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_po_detail`
--
ALTER TABLE `t_po_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
