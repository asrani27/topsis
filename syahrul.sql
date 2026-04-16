/*
 Navicat Premium Dump SQL

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80043 (8.0.43)
 Source Host           : localhost:3306
 Source Schema         : syahrul

 Target Server Type    : MySQL
 Target Server Version : 80043 (8.0.43)
 File Encoding         : 65001

 Date: 16/04/2026 19:06:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for kriterias
-- ----------------------------
DROP TABLE IF EXISTS `kriterias`;
CREATE TABLE `kriterias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` decimal(5,2) NOT NULL,
  `tipe` enum('benefit','cost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kriterias
-- ----------------------------
BEGIN;
INSERT INTO `kriterias` (`id`, `nama`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES (1, 'Kedisiplinan', 40.00, 'benefit', '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `kriterias` (`id`, `nama`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES (2, 'Kejujuran', 30.00, 'benefit', '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `kriterias` (`id`, `nama`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES (3, 'Tanggung Jawab', 20.00, 'benefit', '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `kriterias` (`id`, `nama`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES (4, 'Loyalitas', 10.00, 'cost', '2026-04-04 01:41:52', '2026-04-04 01:41:52');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2026_04_04_011305_create_pegawais_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2026_04_04_011902_create_kriterias_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2026_04_04_013033_create_penilaians_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pegawais
-- ----------------------------
DROP TABLE IF EXISTS `pegawais`;
CREATE TABLE `pegawais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pegawais_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pegawais
-- ----------------------------
BEGIN;
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (1, '198501012010011001', 'Ahmad Fauzi', 'Laki-laki', 'Kepala Bagian Keuangan', '081234567890', 'Jl. Merdeka No. 123, Jakarta Pusat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (2, '198805152011011002', 'Siti Rahayu', 'Perempuan', 'Kepala Bagian SDM', '082345678901', 'Jl. Sudirman No. 45, Jakarta Selatan', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (3, '199003202012011003', 'Budi Santoso', 'Laki-laki', 'Staff IT', '083456789012', 'Jl. Gatot Subroto No. 78, Jakarta Pusat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (4, '199207122013011004', 'Dewi Kartika', 'Perempuan', 'Staff Administrasi', '084567890123', 'Jl. Thamrin No. 56, Jakarta Pusat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (5, '198910082011011005', 'Eko Prasetyo', 'Laki-laki', 'Staff Keuangan', '085678901234', 'Jl. Hayam Wuruk No. 90, Jakarta Barat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (6, '199104112012011006', 'Fitriani', 'Perempuan', 'Staff SDM', '086789012345', 'Jl. Kebagusan No. 12, Jakarta Selatan', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (7, '198802252011011007', 'Gunawan', 'Laki-laki', 'Kepala Bagian Operasional', '087890123456', 'Jl. Cempaka Putih No. 34, Jakarta Pusat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (8, '199509182016011008', 'Hesti Lestari', 'Perempuan', 'Staff Operasional', '088901234567', 'Jl. Pemuda No. 67, Jakarta Timur', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (9, '199206302013011009', 'Indra Wijaya', 'Laki-laki', 'Staff IT', '089012345678', 'Jl. Diponegoro No. 23, Jakarta Pusat', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
INSERT INTO `pegawais` (`id`, `nip`, `nama`, `jenis_kelamin`, `jabatan`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES (10, '199308172014011010', 'Juniarti', 'Perempuan', 'Staff Administrasi', '081234567891', 'Jl. Rasuna Said No. 89, Jakarta Selatan', '2026-04-04 01:41:48', '2026-04-04 01:41:48');
COMMIT;

-- ----------------------------
-- Table structure for penilaians
-- ----------------------------
DROP TABLE IF EXISTS `penilaians`;
CREATE TABLE `penilaians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pegawai_id` bigint unsigned NOT NULL,
  `kriteria_id` bigint unsigned NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penilaians_pegawai_id_kriteria_id_unique` (`pegawai_id`,`kriteria_id`),
  KEY `penilaians_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `penilaians_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penilaians_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of penilaians
-- ----------------------------
BEGIN;
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (1, 1, 1, 95.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (2, 1, 2, 94.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (3, 1, 3, 93.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (4, 1, 4, 2.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (5, 2, 1, 94.25, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (6, 2, 2, 95.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (7, 2, 3, 94.75, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (8, 2, 4, 2.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (9, 3, 1, 88.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (10, 3, 2, 90.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (11, 3, 3, 87.75, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (12, 3, 4, 4.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (13, 4, 1, 91.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (14, 4, 2, 89.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (15, 4, 3, 90.25, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (16, 4, 4, 3.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (17, 5, 1, 85.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (18, 5, 2, 84.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (19, 5, 3, 83.75, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (20, 5, 4, 6.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (21, 6, 1, 90.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (22, 6, 2, 88.75, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (23, 6, 3, 89.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (24, 6, 4, 4.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (25, 7, 1, 93.75, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (26, 7, 2, 92.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (27, 7, 3, 94.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (28, 7, 4, 3.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (29, 8, 1, 84.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (30, 8, 2, 82.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (31, 8, 3, 83.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (32, 8, 4, 7.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (33, 9, 1, 89.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (34, 9, 2, 91.25, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (35, 9, 3, 88.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (36, 9, 4, 5.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (37, 10, 1, 86.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (38, 10, 2, 85.25, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (39, 10, 3, 86.00, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
INSERT INTO `penilaians` (`id`, `pegawai_id`, `kriteria_id`, `nilai`, `created_at`, `updated_at`) VALUES (40, 10, 4, 5.50, '2026-04-04 01:41:52', '2026-04-04 01:41:52');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Super Admin', 'superadmin', 'superadmin@example.com', NULL, '$2y$12$wC0OIfxiDIhxIfIKVEovFObhKDKqwlQr6DEzdEAPAluU.XBB2vFTa', NULL, '2026-04-04 01:41:48', '2026-04-04 01:41:48');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
