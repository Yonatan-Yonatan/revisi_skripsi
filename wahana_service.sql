-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 07:45 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `id_produk` varchar(10) CHARACTER SET latin1 NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `deskripsi` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_produk`, `tanggal`, `jumlah_barang`, `total_harga`, `deskripsi`) VALUES
(41, '0002', '2023-02-22', 1, 75000, 'Terjual'),
(42, '0004', '2023-02-22', 1, 450000, 'Terjual');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_produk` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_produk`, `id_supplier`, `tanggal`, `stok`) VALUES
(65, '0001', 14, '2023-02-22', 30),
(66, '0002', 14, '2023-02-22', 63),
(67, '0003', 14, '2023-02-22', 63),
(68, '0009', 14, '2023-02-22', 24),
(69, '0008', 15, '2023-02-22', 1),
(70, '0007', 15, '2023-02-22', 1),
(71, '0006', 15, '2023-02-22', 1),
(72, '0005', 15, '2023-02-22', 1),
(73, '0004', 15, '2023-02-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(10) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_supplier`, `nama_produk`, `jenis_barang`, `qty`, `harga`) VALUES
('0001', 14, 'Wiper Blade DCS-G016', 'Wiper Blade', 29, 50000),
('0002', 14, 'STP.SYN Gear Oil 80W-90.946ML', 'Pelumas', 62, 75000),
('0003', 14, 'STP.SYN Gear Oil SAE140GL-5', 'Pelumas', 63, 75000),
('0004', 15, 'Cable A/S Park Barke', 'Kabel ', 0, 450000),
('0005', 15, 'ARM S/A SUSP LWR LH', 'Shockbreaker & Kaki Mobil', 1, 1400000),
('0006', 15, 'ARM S/A SUSP LWR RH', 'Shockbreaker & Kaki Mobil', 1, 1400000),
('0007', 15, 'Absorber Assy FR LH', 'Shockbreaker & Kaki Mobil', 1, 950000),
('0008', 15, 'Absorber Assy FR RH', 'Shockbreaker & Kaki Mobil', 1, 950000),
('0009', 14, 'Rotary Lith EP-3 WB COPBM Red', 'Pelumas', 24, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id_retur` int(11) NOT NULL,
  `id_produk` varchar(10) CHARACTER SET latin1 NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `deskripsi` varchar(150) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `retur_barang`
--

INSERT INTO `retur_barang` (`id_retur`, `id_produk`, `id_supplier`, `tanggal`, `quantity`, `deskripsi`) VALUES
(18, '0001', 14, '2023-02-22', 1, 'Patah');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(200) CHARACTER SET latin1 NOT NULL,
  `alamat` varchar(500) CHARACTER SET latin1 NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(14, 'CV Putera Jaya Sentosa', 'Jl. Tanjung Pura Darat Sekip No 77, Kota Pontianak, Kalimantan Barat, 78243', '0561734103'),
(15, 'PT Tasti Anugerah Mandiri', 'Jl. Gaya Motor Selatan No. 5, Sungai Bambu, Tanjuk Priok, Jakarta Utara', '0216521866');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) CHARACTER SET latin1 NOT NULL,
  `password` text CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(200) CHARACTER SET latin1 NOT NULL,
  `level` enum('user','admin') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin'),
(2, 'yonatan', 'b30f5421ee44c0904eef5d0626c92b32aa569a65', 'Yonatan', 'user'),
(13, 'wahana', '38d719adee9173c4135d3b212d9788b56f8e0358', 'Wahana Service', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_ibfk_2` (`id_supplier`),
  ADD KEY `barang_masuk_ibfk_3` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

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
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD CONSTRAINT `retur_barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_barang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
