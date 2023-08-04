-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 11:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wahana_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_bkeluar` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `no_nota`, `id_produk`, `jumlah_barang`, `total_harga`, `status_bkeluar`) VALUES
(1, 1, 9, 1, 55000, '0'),
(2, 2, 1, 1, 1000000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_tr_masuk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status_bmasuk` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_tr_masuk`, `id_produk`, `stok`, `status_bmasuk`) VALUES
(1, 1, 1, 1, '0'),
(2, 1, 2, 1, '0'),
(3, 1, 3, 1, '0'),
(4, 1, 4, 1, '0'),
(5, 1, 5, 1, '0'),
(6, 2, 7, 63, '0'),
(7, 2, 8, 63, '0'),
(8, 2, 9, 24, '0'),
(9, 3, 6, 30, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `plat` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `merk_kendaraan` varchar(100) NOT NULL,
  `jenis_kendaraan` enum('Mobil','Motor') NOT NULL,
  `transmisi` enum('Manual','Matic','Manual + Matic') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `min_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis_barang`, `qty`, `harga`, `min_qty`) VALUES
(1, 'Cable A/S Park Barke', 'Kabel ', 0, 1000000, 10),
(2, 'ARM S/A SUSP LWR LH', 'Shockbreaker & Kaki Mobil', 1, 1450000, 10),
(3, 'ARM S/A SUSP LWR RH', 'Shockbreaker & Kaki Mobil', 1, 1450000, 10),
(4, 'Absorber Assy FR LH', 'Shockbreaker & Kaki Mobil', 1, 950000, 10),
(5, 'Absorber Assy FR RH', 'Shockbreaker & Kaki Mobil', 1, 950000, 10),
(6, 'Wiper Blade DCS-G016', 'Wiper Blade', 30, 50000, 10),
(7, 'STP.SYN Gear Oil 80W-90.946ML', 'Oli Mesin', 63, 75000, 10),
(8, 'STP.SYN Gear Oil SAE140GL-5', 'Oli Mesin', 63, 75000, 10),
(9, 'Rotary Lith EP-3 WB COPBM Red', 'Oli Mesin', 23, 55000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `deskripsi` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('Diajukan','Diambil','Selesai') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retur_barang`
--

INSERT INTO `retur_barang` (`id_retur`, `id_produk`, `id_supplier`, `tanggal`, `quantity`, `deskripsi`, `status`, `id`) VALUES
(1, 6, 1, '2023-02-23', 1, 'Patah', 'Selesai', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(1, 'CV Putera Jaya Sentosa', 'Jl. Tanjung Pura Darat Sekip No 77, Kota Pontianak, Kalimantan Barat, 78243', '0561734103'),
(2, 'PT Tasti Anugerah Mandiri', 'Jl. Gaya Motor Selatan No. 5, Sungai Bambu, Tanjuk Priok, Jakarta Utara', '6285251842284');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_keluar`
--

CREATE TABLE `transaksi_keluar` (
  `no_nota` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `subtotal` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `ket` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_print` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_keluar`
--

INSERT INTO `transaksi_keluar` (`no_nota`, `tanggal`, `subtotal`, `id`, `ket`, `status_print`) VALUES
(1, '2023-02-23', 55000, 1, '-', '0'),
(2, '2023-02-24', 1000000, 1, '-', '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_masuk`
--

CREATE TABLE `transaksi_masuk` (
  `id_tr_masuk` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_masuk`
--

INSERT INTO `transaksi_masuk` (`id_tr_masuk`, `no_faktur`, `tanggal`, `id_supplier`, `id`) VALUES
(1, '4G30-FK22120295', '2022-12-26', 2, 1),
(2, '20201023002497DO', '2023-02-07', 1, 1),
(3, '20201023003067DO', '2023-02-14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `level` enum('owner','admin','kasir','INACTIVE') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_akun` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `level`, `status_akun`) VALUES
(1, 'owner', '579233b2c479241523cba5e3af55d0f50f2d6414', 'Owner', 'owner', '0'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 'admin', '0'),
(3, 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'Cashier', 'kasir', '0'),
(4, 'yonatan', 'b30f5421ee44c0904eef5d0626c92b32aa569a65', 'Yonatan', 'owner', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `barang_keluar_ibfk_1` (`id_produk`),
  ADD KEY `no_nota` (`no_nota`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_ibfk_1` (`id_produk`),
  ADD KEY `id_tr_masuk` (`id_tr_masuk`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`plat`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id` (`id`),
  ADD KEY `retur_barang_ibfk_2` (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD PRIMARY KEY (`no_nota`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD PRIMARY KEY (`id_tr_masuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  MODIFY `no_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  MODIFY `id_tr_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`no_nota`) REFERENCES `transaksi_keluar` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD CONSTRAINT `retur_barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_barang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_barang_ibfk_3` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_keluar`
--
ALTER TABLE `transaksi_keluar`
  ADD CONSTRAINT `transaksi_keluar_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_masuk`
--
ALTER TABLE `transaksi_masuk`
  ADD CONSTRAINT `transaksi_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_masuk_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
