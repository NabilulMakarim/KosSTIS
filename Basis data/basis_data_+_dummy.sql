-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2023 at 06:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `edit__kamars`
--

CREATE TABLE `edit__kamars` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `kamarMandi` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitasKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageKamar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsiKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasanKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `durSewa` tinyint(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `jumKam` tinyint(2) NOT NULL,
  `jumKos` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edit__kontrakans`
--

CREATE TABLE `edit__kontrakans` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `kontrakan_id` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noHp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumKam` tinyint(2) NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak` int(5) NOT NULL,
  `wifi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parkir` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `listrik` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `durSewa` tinyint(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edit__kontrakans`
--

INSERT INTO `edit__kontrakans` (`id`, `user_id`, `kontrakan_id`, `nama`, `area`, `noHp`, `image`, `harga`, `jumKam`, `fasilitas`, `jarak`, `wifi`, `parkir`, `ringkasan`, `deskripsi`, `listrik`, `created_at`, `updated_at`, `durSewa`, `status`, `longitude`, `latitude`) VALUES
(1, 14, 42, 'ketiga tes edit', NULL, '83159309886', NULL, 2300000, 5, 'kasur', 176, 'Belum Ada', 'Tidak Tersedia', '', '<div>mantappp</div>', 'Belum Termasuk', '2023-06-28 06:55:07', '2023-06-28 06:55:07', 1, 1, '106.86760834021923', '-6.232754721601606'),
(26, 1, 42, 'ketiga tes edit', NULL, '83159309886', NULL, 2300000, 5, 'kasur', 176, 'Belum Ada', 'Tidak Tersedia', '', '<div>mantappp</div>', 'Belum Termasuk', '2023-06-28 06:55:07', '2023-06-28 06:55:07', 1, 1, '106.86760834021923', '-6.232754721601606');

-- --------------------------------------------------------

--
-- Table structure for table `edit__kosts`
--

CREATE TABLE `edit__kosts` (
  `id` int(11) UNSIGNED NOT NULL,
  `kost_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noHp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak` int(5) NOT NULL,
  `wifi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parkir` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edit__kosts`
--

INSERT INTO `edit__kosts` (`id`, `kost_id`, `user_id`, `nama`, `area`, `gender`, `noHp`, `image`, `fasilitas`, `jarak`, `wifi`, `parkir`, `ringkasan`, `deskripsi`, `created_at`, `updated_at`, `longitude`, `latitude`) VALUES
(18, 66, 14, 'tes CC', 'Bonasel', 'Pria', '657', NULL, 'hvjhjv', 563, 'Ada', 'Tersedia', 'Tersedia', '<div>ghhk</div>', '2023-07-17 20:07:26', '2023-07-17 20:07:26', '106.87174355650264', '-6.2320721343696635'),
(19, 65, 14, 'tes bidcin edit', 'Bonsay', 'Pria', '565', NULL, 'gjk', 79, 'Ada', 'Tersedia', 'Tersedia', '<div>hj</div>', '2023-07-25 06:15:54', '2023-07-25 06:15:54', '106.86627218706376', '-6.230888270033653');

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `ukuran` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kamarMandi` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitasKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageKamar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsiKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasanKamar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `durSewa` tinyint(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kost_id` int(11) NOT NULL,
  `jumKam` tinyint(2) NOT NULL,
  `jumKos` tinyint(2) NOT NULL,
  `statusPengajuanKamar` tinyint(1) NOT NULL DEFAULT 1,
  `statusUpdateKamar` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id`, `created_at`, `updated_at`, `harga`, `ukuran`, `kamarMandi`, `fasilitasKamar`, `imageKamar`, `deskripsiKamar`, `ringkasanKamar`, `durSewa`, `user_id`, `kost_id`, `jumKam`, `jumKos`, `statusPengajuanKamar`, `statusUpdateKamar`) VALUES
(15, '2023-06-11 05:51:00', '2023-06-11 05:54:19', 800000, '3x3', 'Luar', 'kasur, meja', NULL, '<div>kamar mantap dan bersih</div>', 'kamar mantap dan ber...', 6, 3, 58, 6, 4, 1, 1),
(16, '2023-06-11 05:55:14', '2023-06-11 05:55:14', 900000, '4x3', 'Luar', 'kasur, tv', 'post-images/EfqtLraWVFLrLOvPNZo2BujSaQAyp16Ny7Jy2EhK.webp', '<div>enak bangettt</div>', 'enak bangettt', 3, 3, 58, 4, 2, 1, 1),
(17, '2023-06-11 05:58:44', '2023-07-11 02:19:24', 900000, '3x3', 'Dalam', 'kasur aja', 'post-images/yYMN4TpzrH03wYz94qpRSeluCuZh9ChMhzN3Ivt8.jpg', '<div>mantap dan bagus</div>', 'mantap dan bagus', 3, 17, 59, 4, 2, 1, 1),
(22, '2023-07-13 02:38:00', '2023-07-19 00:06:33', 750000, '3x3', 'Luar', 'kk', NULL, '<div>hjkadbka</div>', 'hjkadbka', 4, 17, 58, 6, 0, 1, 1),
(23, '2023-07-13 02:39:02', '2023-07-13 02:39:02', 898976, 'hh', 'Luar', 'hjhh', NULL, '<div>bhh</div>', 'bhh', 7, 17, 59, 7, 4, 1, 1),
(24, '2023-07-13 05:18:06', '2023-07-13 05:18:06', 900000, '7', 'Luar', 'sdfs', NULL, '<div>wfw</div>', 'wfw', 1, 17, 61, 3, 1, 1, 1),
(25, '2023-07-13 05:18:06', '2023-07-13 05:18:06', 900000, '7', 'Luar', 'sdfs', NULL, '<div>wfw</div>', 'wfw', 1, 17, 62, 3, 1, 1, 1),
(26, '2023-07-25 05:30:59', '2023-07-25 05:30:59', 800000, '3x3', 'Luar', 'kbsa', NULL, '<div>afdsd</div>', 'afdsd', 3, 14, 64, 5, 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasikontrakans`
--

CREATE TABLE `konfirmasikontrakans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kontrakan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasikontrakans`
--

INSERT INTO `konfirmasikontrakans` (`id`, `user_id`, `kontrakan_id`, `created_at`, `updated_at`) VALUES
(16, 14, 42, '2023-07-22 14:55:24', '2023-07-22 14:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasikosts`
--

CREATE TABLE `konfirmasikosts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasikosts`
--

INSERT INTO `konfirmasikosts` (`id`, `user_id`, `kamar_id`, `created_at`, `updated_at`) VALUES
(17, 14, 23, '2023-07-20 00:36:57', '2023-07-20 00:36:57'),
(18, 14, 17, '2023-07-20 00:38:44', '2023-07-20 00:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `kontrakans`
--

CREATE TABLE `kontrakans` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `jumKam` int(2) NOT NULL,
  `jarak` int(5) NOT NULL,
  `wifi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parkir` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `listrik` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `durSewa` tinyint(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `statusPengajuan` tinyint(1) NOT NULL DEFAULT 1,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusUpdate` tinyint(1) NOT NULL DEFAULT 1,
  `noHp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kontrakans`
--

INSERT INTO `kontrakans` (`id`, `user_id`, `nama`, `rt`, `rw`, `no`, `kelurahan`, `image`, `area`, `harga`, `jumKam`, `jarak`, `wifi`, `parkir`, `fasilitas`, `ringkasan`, `deskripsi`, `listrik`, `created_at`, `updated_at`, `durSewa`, `status`, `statusPengajuan`, `latitude`, `longitude`, `statusUpdate`, `noHp`) VALUES
(39, 3, 'pertama', '3', '3', '3', 'Bidara Cina', NULL, 'Bonsay', 1500000, 3, 127, 'Ada', 'Tidak Tersedia', 'lemari, bantal, kasur', 'mantappppp', '<div>mantappppp</div>', 'Sudah Termasuk', '2023-06-11 06:01:18', '2023-07-18 23:50:29', 4, 1, 1, '-6.2317948330530335', '106.86778546296635', 1, '83159309886'),
(40, 3, 'kedua', '5', '5', '5', 'Bidara Cina', NULL, 'Bonsay', 2000000, 3, 149, 'Ada', 'Tidak Tersedia', 'ac, kulkas', 'kontrakan gg gaming', '<div>kontrakan gg gaming</div>', 'Sudah Termasuk', '2023-06-11 06:02:23', '2023-07-19 00:12:03', 2, 0, 1, '-6.232285442975044', '106.86560899865013', 1, '83159309886'),
(42, 3, 'ketiga tes', '7', '7', '7', 'Cipinang Cempedak', 'post-images/ZAcQC9QpiMNWX0nANOyilsBZUkXFmvva9DY9Rddm.jpg', 'Bonasel', 2300000, 5, 176, 'Belum Ada', 'Tidak Tersedia', 'kasur', 'mantappp', '<div>mantappp</div>', 'Belum Termasuk', '2023-06-11 06:03:44', '2023-07-19 02:20:00', 1, 1, 1, '-6.232754721601606', '106.86760834021923', 0, '83159309886'),
(45, 17, 'Ilman Maulana', '2', '3', '2', 'Bidara Cina', NULL, 'Bobobo', 1800000, 4, 182, 'Ada', 'Tersedia', 'kulkas', 'Tersedia', '<div>SDFDFS</div>', 'Sudah Termasuk', '2023-07-13 05:15:34', '2023-07-18 23:52:01', 1, 1, 1, '-6.232253446689768', '106.86812821648432', 1, '083159309886'),
(46, 14, 'tes new kontrakan edit', '4', '6', '6', 'Balimester', NULL, 'Bonsay', 1800000, 3, 91, 'Belum Ada', 'Tidak Tersedia', 'qqq', 'Tidak Tersedia', '<div>jjg</div>', 'Belum Termasuk', '2023-07-15 07:08:57', '2023-07-18 23:45:13', 2, 1, 1, '-6.231640184178177', '106.8674842624491', 1, '6967885655');

-- --------------------------------------------------------

--
-- Table structure for table `kosts`
--

CREATE TABLE `kosts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noHp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jarak` int(5) NOT NULL,
  `wifi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parkir` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusPengajuan` tinyint(1) NOT NULL DEFAULT 1,
  `statusUpdate` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kosts`
--

INSERT INTO `kosts` (`id`, `user_id`, `nama`, `rt`, `rw`, `no`, `kelurahan`, `noHp`, `image`, `area`, `gender`, `jarak`, `wifi`, `parkir`, `fasilitas`, `ringkasan`, `deskripsi`, `created_at`, `updated_at`, `latitude`, `longitude`, `statusPengajuan`, `statusUpdate`) VALUES
(58, 3, 'coba pertama', '1', '1', '1', 'Cipinang Cempedak', '83159309886', 'post-images/m192EPWlBUYbDzl4AUgMjMI4WgwVPm7p2H5gNw1V.jpg', 'Bonasel', 'Pria', 122, 'Ada', 'Tidak Tersedia', 'kulkas', 'Tersedia', '<div>kost pertama</div>', '2023-06-11 05:47:55', '2023-06-11 05:47:55', '-6.232466755221436', '106.86715748231747', 1, 1),
(59, 3, 'kost kedua', '2', '2', '2', 'Bidara Cina', '83159309886', 'post-images/nKUsARqYftoYSiBbbmfmYahP3tcln4zKGKp0uQkj.jpg', 'Bonsay', 'Pria', 175, 'Belum Ada', 'Tersedia', 'sapu', 'Tidak Tersedia', '<div>kost kedua</div>', '2023-06-11 05:57:56', '2023-06-11 05:57:56', '-6.232738723473515', '106.86761907493117', 1, 1),
(61, 17, 'Ilman Maulana', '2', '3', '7', 'Balimester', '32324', NULL, 'Bobobo', 'Pria', 187, 'Ada', 'Tersedia', 'asda', 'Tersedia', '<div>asda</div>', '2023-07-13 05:17:39', '2023-07-13 05:17:39', '-6.2324347589472024', '106.86529573340285', 1, 1),
(62, 14, 'tes new edit', '6', '6', '6', 'Balimester', '6868978976778', NULL, 'Bonsay', 'Campuran', 70, 'Belum Ada', 'Tidak Tersedia', 'ntah', 'Tidak Tersedia', '<div>dca</div>', '2023-07-15 07:07:46', '2023-07-15 07:11:04', '-6.230920266402172', '106.86636872404132', 1, 1),
(63, 14, 'test alamat', '1', '1', '1', 'Balimester', '06967885655', NULL, 'Bonasel', 'Pria', 291, 'Ada', 'Tersedia', 'kulkas', 'Tersedia', '<div>test alamat</div>', '2023-07-17 06:57:48', '2023-07-17 06:57:48', '-6.232349435539746', '106.8691629319736', 0, 1),
(64, 14, 'tes', '2', '2', '2', 'Balimester', '77', NULL, 'Bonasut', 'Pria', 731, 'Ada', 'Tersedia', 'jbbj', 'Tersedia', '<div>kjkb</div>', '2023-07-17 17:59:25', '2023-07-17 17:59:25', '-6.226227444851155', '106.87066461829178', 0, 1),
(65, 14, 'tes bidcin', '31', '3', '3', 'Bidara Cina', '565', NULL, 'Bonsay', 'Pria', 79, 'Ada', 'Tersedia', 'gjk', 'Tersedia', '<div>hj</div>', '2023-07-17 18:00:46', '2023-07-25 06:15:54', '-6.230888270033653', '106.86627218706376', 0, 0),
(66, 14, 'tes CC', '12', '12', '12', 'Cipinang Cempedak', '657', NULL, 'Bonasut', 'Pria', 446, 'Ada', 'Tersedia', 'hvjhjv', 'Tersedia', '<div>ghhk</div>', '2023-07-17 18:01:50', '2023-07-17 20:07:26', '-6.231688178661465', '106.87070752361515', 0, 0);

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_05_085938_create_posts_table', 1),
(6, '2023_01_05_135739_create_categories_table', 1),
(7, '2023_01_24_041404_add_is_admin_to_users_table', 1),
(8, '2023_01_28_000041_create_kosts_table', 1),
(9, '2023_01_28_004929_create_kontrakans_table', 1),
(10, '2023_05_11_014731_create_update__kontrakans_table', 2),
(11, '2023_05_11_022516_create_edit__kontrakans_table', 3),
(12, '2023_05_21_131044_create_kamars_table', 4),
(13, '2023_05_23_031015_create_edit__kosts_table', 5),
(14, '2023_05_25_015111_create_edit__kamars_table', 6),
(15, '2023_06_05_020401_create_reviews_table', 7),
(16, '2023_06_05_065144_create_ratings_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) UNSIGNED NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kamar_id` int(11) DEFAULT NULL,
  `kontrakan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `rating`, `user_id`, `kamar_id`, `kontrakan_id`, `created_at`, `updated_at`) VALUES
(16, 5, 14, 17, NULL, '2023-06-28 07:55:54', '2023-06-28 07:55:54'),
(18, 5, 14, NULL, 46, '2023-07-18 23:45:48', '2023-07-18 23:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kamar_id` int(11) DEFAULT NULL,
  `kost_id` int(11) DEFAULT NULL,
  `kontrakan_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noHp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `tempat_id` int(11) DEFAULT NULL,
  `tempat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `noHp`, `email`, `nim`, `password`, `created_at`, `updated_at`, `is_admin`, `tempat_id`, `tempat`) VALUES
(1, 'Ilman Maulana', 'ilman014tffhg', '83159309886', 'ilmanmaulana1bbb42312@gmail.com', '221911194', '$2y$10$zPiVmizPO3sHrLH7MQbdOuzad4x2FfGfHrs7keWXCHs0yKH1jFXyy', '2023-06-07 20:43:23', '2023-06-07 20:43:23', 0, NULL, NULL),
(3, 'admin', 'admin', '83159309886', 'maba@gmail.com', '', '$2y$10$zPiVmizPO3sHrLH7MQbdOuzad4x2FfGfHrs7keWXCHs0yKH1jFXyy', '2023-01-30 05:51:05', '2023-06-11 16:46:23', 2, NULL, NULL),
(14, 'Ilman Maulana', 'ilman014', '83159309886', 'ilmanmaulana142312@gmail.com', '221911194', '$2y$10$zPiVmizPO3sHrLH7MQbdOuzad4x2FfGfHrs7keWXCHs0yKH1jFXyy', '2023-06-07 20:43:23', '2023-07-19 02:20:00', 0, 42, 'kontrakan'),
(17, 'pengelola', 'pengelola', '83159309886', 'pengelola@gmail.com', NULL, '$2y$10$zPiVmizPO3sHrLH7MQbdOuzad4x2FfGfHrs7keWXCHs0yKH1jFXyy', '2023-06-10 08:32:46', '2023-06-10 08:32:46', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `edit__kamars`
--
ALTER TABLE `edit__kamars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edit__kontrakans`
--
ALTER TABLE `edit__kontrakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edit__kosts`
--
ALTER TABLE `edit__kosts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasikontrakans`
--
ALTER TABLE `konfirmasikontrakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasikosts`
--
ALTER TABLE `konfirmasikosts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontrakans`
--
ALTER TABLE `kontrakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kosts`
--
ALTER TABLE `kosts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `edit__kamars`
--
ALTER TABLE `edit__kamars`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `edit__kontrakans`
--
ALTER TABLE `edit__kontrakans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `edit__kosts`
--
ALTER TABLE `edit__kosts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kamars`
--
ALTER TABLE `kamars`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `konfirmasikontrakans`
--
ALTER TABLE `konfirmasikontrakans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `konfirmasikosts`
--
ALTER TABLE `konfirmasikosts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kontrakans`
--
ALTER TABLE `kontrakans`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `kosts`
--
ALTER TABLE `kosts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
