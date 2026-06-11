SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

--
-- Database: `donasilink`
--

-- --------------------------------------------------------

--
-- Tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabel `shelter`
--

CREATE TABLE `shelter` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_shelter` varchar(100) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shelter_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabel `donatur`
--

CREATE TABLE `donatur` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `donatur_username_unique` (`username`),
  UNIQUE KEY `donatur_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabel `kampanye`
--

CREATE TABLE `kampanye` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shelter_id` bigint(20) UNSIGNED NOT NULL,
  `nama_hewan` varchar(255) NOT NULL,
  `usia_hewan` varchar(255) NOT NULL,
  `sedang_sakit` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `kebutuhan_hewan` varchar(255) NOT NULL,
  `deskripsi_hewan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `target_donasi` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_terkumpul` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('aktif','selesai') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kampanye_shelter_id_foreign` (`shelter_id`),
  CONSTRAINT `kampanye_shelter_id_foreign` FOREIGN KEY (`shelter_id`) REFERENCES `shelter` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabel `donasi`
--

CREATE TABLE `donasi` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kampanye_id` bigint(20) UNSIGNED NOT NULL,
  `nama_donatur` varchar(255) NOT NULL,
  `email_donatur` varchar(255) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `metode_pembayaran` enum('bank_transfer','e_wallet','credit_card') NOT NULL,
  `status` enum('pending','berhasil','gagal') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donasi_kampanye_id_foreign` (`kampanye_id`),
  CONSTRAINT `donasi_kampanye_id_foreign` FOREIGN KEY (`kampanye_id`) REFERENCES `kampanye` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
