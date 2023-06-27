-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2023 at 02:23 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-online`
--

-- --------------------------------------------------------

--
-- Table structure for table `beranda`
--

DROP TABLE IF EXISTS `beranda`;
CREATE TABLE IF NOT EXISTS `beranda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `about` text NOT NULL,
  `syarat_ketentuan` text NOT NULL,
  `beranda` text NOT NULL,
  `notelp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beranda`
--

INSERT INTO `beranda` (`id`, `about`, `syarat_ketentuan`, `beranda`, `notelp`) VALUES
(1, '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipisicing elit. Reprehenderit impedit autem, sunt accusantium ducimus error obcaecati iste. Sapiente, asperiores libero nostrum ratione dolore. Autem inventore facere nobis molestiae impedit, debitis, temporibus natus est ratione sunt atque soluta pariatur maxime quia quae. Non animi, sapiente quas temporibus, modi esse quae, ut incidunt autem dolores suscipit in accusantium totam sint quibusdam obcaecati dolorum itaque nulla alias officiis. Sed rerum, temporibus iste corrupti, maxime corporis atque omnis neque distinctio alias repellat! Repudiandae inventore nesciunt, voluptas consequatur id soluta dolorum. Nemo beatae culpa, perferendis voluptas delectus, placeat earum totam nobis consequuntur illum, sed, atque!</p>\r\n<p><em>tes aja ya</em></p>\r\n<p><strong>misal aja ini</strong></p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit autem, sunt accusantium ducimus error obcaecati iste. Sapiente, asperiores libero nostrum ratione dolore. Autem inventore facere nobis molestiae impedit, debitis, temporibus natus est ratione sunt atque soluta pariatur maxime quia quae. Non animi, sapiente quas temporibus, modi esse quae, ut incidunt autem dolores suscipit in accusantium totam sint quibusdam obcaecati dolorum itaque nulla alias officiis. Sed rerum, temporibus iste corrupti, maxime corporis atque omnis neque distinctio alias repellat! Repudiandae inventore nesciunt, voluptas consequatur id soluta dolorum. Nemo beatae culpa, perferendis voluptas delectus, placeat earum totam nobis consequuntur illum, sed, atque!</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit autem, sunt accusantium ducimus error obcaecati iste. Sapiente, asperiores libero nostrum ratione dolore. Autem inventore facere nobis molestiae impedit, debitis, temporibus natus est ratione sunt atque soluta pariatur maxime quia quae. Non animi, sapiente quas temporibus, modi esse quae, ut incidunt autem dolores suscipit in accusantium totam sint quibusdam obcaecati dolorum itaque nulla alias officiis. Sed rerum, temporibus iste corrupti, maxime corporis atque omnis neque distinctio alias repellat! Repudiandae inventore nesciunt, voluptas consequatur id soluta dolorum. Nemo beatae culpa, perferendis voluptas delectus, placeat earum totam nobis consequuntur illum, sed, atque!</p>', '6281216195260');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `produk_id` int DEFAULT NULL,
  `jumlah_produk` int DEFAULT NULL,
  `user_ip` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  KEY `fk_produk` (`produk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `produk_id`, `jumlah_produk`, `user_ip`, `created_at`, `updated_at`) VALUES
(15, NULL, 1, 1, '::1', '2023-03-01 08:35:11', '2023-03-01 15:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

DROP TABLE IF EXISTS `galeri`;
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_galeri` text NOT NULL,
  `is_aktif` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_promo`
--

DROP TABLE IF EXISTS `gambar_promo`;
CREATE TABLE IF NOT EXISTS `gambar_promo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) NOT NULL,
  `is_aktif` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gambar_promo`
--

INSERT INTO `gambar_promo` (`id`, `gambar`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'promo1.png', 1, '2021-11-28 00:01:01', '2021-11-28 00:01:01'),
(2, 'promo2.png', 1, '2021-11-28 00:01:01', '2021-11-30 18:01:50'),
(3, 'PROMO_flash3.png', 1, '2021-11-30 18:17:23', '2021-12-01 00:17:23'),
(4, 'PROMO_flash2.png', 1, '2021-11-30 18:17:23', '2021-12-01 00:17:23'),
(5, 'PROMO_flash promo.png', 1, '2021-11-30 18:17:23', '2021-12-01 00:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produk_id` int NOT NULL,
  `user_ip` text NOT NULL,
  `jumlah_produk` int NOT NULL,
  `status_pesanan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_gambar`
--

DROP TABLE IF EXISTS `master_gambar`;
CREATE TABLE IF NOT EXISTS `master_gambar` (
  `gambar_id` int NOT NULL AUTO_INCREMENT,
  `produk_id` int NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gambar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_produk`
--

DROP TABLE IF EXISTS `master_produk`;
CREATE TABLE IF NOT EXISTS `master_produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `harga_produk` decimal(16,0) NOT NULL,
  `gambar_produk` varchar(100) NOT NULL,
  `berat_produk` decimal(16,2) NOT NULL,
  `stok` int NOT NULL,
  `is_aktif` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_produk`
--

INSERT INTO `master_produk` (`id`, `nama_produk`, `keterangan`, `harga_produk`, `gambar_produk`, `berat_produk`, `stok`, `is_aktif`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Termometer', 'Alat pengecek suhu tubuh', '19500', 'termometer.png', '0.78', 57, 1, 1, '2021-11-28 00:54:23', '2021-11-28 00:54:23'),
(2, 'P3K', 'Kotak peralatan pertolongan pertama pada kecelakaan', '94000', 'p3k.jpg', '4.50', 11, 1, 1, '2021-11-28 00:54:23', '2021-11-28 00:54:23'),
(3, 'Tote Bag', 'Tote Bag kekinian untuk aktivitas kuliah', '69000', 'PRODUK_produk3.jpg', '1.50', 12, 1, 1, '2021-11-30 16:31:51', '2021-11-30 16:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

DROP TABLE IF EXISTS `master_user`;
CREATE TABLE IF NOT EXISTS `master_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `provinsi` int NOT NULL,
  `kota` int NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `role_id` int NOT NULL,
  `is_aktif` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id`, `nama`, `username`, `password`, `provinsi`, `kota`, `alamat_lengkap`, `telp`, `role_id`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin2021', 'b4ae64b88d9d168096155c68bf87cfa1', 11, 444, 'Manyar Sabrangan 9L No.45', '081216195260', 1, 1, '2021-11-27 00:11:39', '2021-11-27 00:11:39'),
(2, 'useraji', 'user2021', 'b4ae64b88d9d168096155c68bf87cfa1', 11, 444, 'Manyar Sabrangan 9L No.45', '081216195260', 2, 1, '2021-11-27 00:11:39', '2021-11-27 00:11:39');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_produk` FOREIGN KEY (`produk_id`) REFERENCES `master_produk` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
