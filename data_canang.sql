-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Mei 2017 pada 07.40
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_canang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `canang`
--

CREATE TABLE `canang` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `keterangan` text,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `canang`
--

INSERT INTO `canang` (`id`, `nama_paket`, `image`, `harga`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paket Mecaru', 'f40a623d6245c16ca2234bcb4b1efb1a.jpg', 10000000, 'Banten ini digunakan untuk mecaru sanggah pada umumnya', 1, '2017-05-18 06:33:35', '2017-05-19 01:24:07'),
(2, 'Banten Otonan', '153ce85960cb88850b47a019829aea75.jpg', 500000, 'Banten yang digunakan untuk upacara manusa yadnya otonan. Upacara ini biasanya dilangsungkan setahun sekali untuk setiap orang yang beragama hindu.', 1, '2017-05-19 01:28:42', '2017-05-19 01:29:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `canang_detail`
--

CREATE TABLE `canang_detail` (
  `id` int(11) NOT NULL,
  `canang_id` int(11) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `canang_detail`
--

INSERT INTO `canang_detail` (`id`, `canang_id`, `label`, `qty`, `created_at`, `updated_at`) VALUES
(22, 1, 'Penyeneng', 1, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(23, 1, 'Sorohan', 1, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(24, 1, 'Sesayut Pengambeyan', 1, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(25, 1, 'Tiaipt Kelanan', 1, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(26, 1, 'Segehan Agung', 1, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(27, 1, 'Tumpeng Putih', 10, '2017-05-19 01:24:07', '2017-05-19 01:24:07'),
(32, 2, 'Ceper', 4, '2017-05-19 01:29:37', '2017-05-19 01:29:37'),
(33, 2, 'Daksina', 4, '2017-05-19 01:29:37', '2017-05-19 01:29:37'),
(34, 2, 'Ayam Betutu', 1, '2017-05-19 01:29:37', '2017-05-19 01:29:37'),
(35, 2, 'Jerimpen', 3, '2017-05-19 01:29:37', '2017-05-19 01:29:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` varchar(50) NOT NULL,
  `canang_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `telp` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `total` int(11) DEFAULT NULL,
  `img_bukti` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `canang_id`, `user_id`, `telp`, `address`, `total`, `img_bukti`, `status`, `created_at`, `updated_at`) VALUES
('TR17050001', 1, 3, '085737343456', 'Jalan Suli No.2', 10000000, NULL, 0, '2017-05-21 06:49:41', '2017-05-23 21:16:26'),
('TR17050002', 2, 3, '084737373', 'Jalan Suli Utara No.12', 500000, NULL, 0, '2017-05-21 06:59:29', '2017-05-23 21:09:33'),
('TR17050003', 1, 3, '084737373', 'Jalan Suli Utara No.12', 10000000, 'ffa30293f5757acbcbebbdbaffd360b9.jpg', 5, '2017-05-21 06:59:36', '2017-05-23 21:09:25'),
('TR17050004', 2, 3, '084737373', 'Jalan Suli Utara No.12 88888', 500000, '57d46b3bb30d226eb3af56470d684eb3.jpg', 3, '2017-05-21 06:59:46', '2017-05-23 21:02:01'),
('TR17050005', 1, 3, '085737343456', 'Jalan Suli No.2', 10000000, NULL, 0, '2017-05-21 07:01:15', '2017-05-23 21:13:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telp`, `address`, `password`, `remember_token`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@mail.com', '082247464196', 'Jalan Nangka Utara No.12', '$2y$10$nqLeVHNKrvYjABeCEBqObuYT1ed8IvFfdsQWeh/TqvzCtmYQPhP3G', 'zeAA41FZjDo81YUV7j8bSdkjQ2aoYvTLPq1HS64cr3NasoGNEDBIcsgOR2oe', 1, 1, '2017-05-18 00:30:23', '2017-05-18 00:30:23'),
(2, 'Hendra', 'hendra@gmail.com', '39384849848', 'Jalan Nangka Utarta', '$2y$10$DFNQv8uEyPnfdFjkqM7DcepdjA.V61UhggUQF3JeuxoapJkQ.3nIq', NULL, 1, 1, '2017-05-18 18:45:12', '2017-05-18 18:52:55'),
(3, 'Member Baru', 'member@mail.com', '084737373', 'Jalan Suli Utara No.12', '$2y$10$FGGQhde113/LLYCa1Z2FUuAyloOUWgJPOsGoKgnTp/ilb.ypdwwkq', NULL, 2, 1, '2017-05-18 19:04:14', '2017-05-18 19:06:12'),
(4, 'Hendra Test', 'hendra888@mail.com', '085737343456', 'Jalan Suli No.2', '$2y$10$rdsA9asWfkmdPxc2jWmVXuDyF0zzS.Ig1D5Fo2HwUzAapTC5..G0i', NULL, 2, 1, '2017-05-18 19:26:23', '2017-05-18 19:26:23'),
(5, 'Hendra', 'android@mail.com', '085724648', 'Jalan Nangka Barat', '$2y$10$wpMVpgbj4QW/wxiTODVpu.BHVbFWimRfOFRk1nYQn4cTBGzwALhNm', NULL, 2, 1, '2017-05-19 03:16:40', '2017-05-19 03:16:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canang`
--
ALTER TABLE `canang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canang_detail`
--
ALTER TABLE `canang_detail`
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
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
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
-- AUTO_INCREMENT for table `canang`
--
ALTER TABLE `canang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `canang_detail`
--
ALTER TABLE `canang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
