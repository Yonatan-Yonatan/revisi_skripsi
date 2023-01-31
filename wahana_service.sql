-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 09:55 AM
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
(22, 'Ak001', '2023-01-31', 1, 620000, 'Terjual'),
(23, 'OM001', '2023-01-31', 1, 500000, 'Terjual'),
(24, 'KR002', '2023-01-31', 2, 460000, 'Terjual'),
(25, 'Ba002', '2023-01-31', 4, 2200000, 'Terjual'),
(26, 'Ba001', '2023-01-31', 4, 1600000, 'Terjual'),
(27, 'B001', '2023-01-31', 2, 760000, 'Terjual'),
(28, 'B002', '2023-01-31', 2, 190000, 'Terjual');

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
(35, 'Ak001', 8, '2023-01-31', 100),
(36, 'Ak002', 8, '2023-01-31', 100),
(37, 'Ak004', 8, '2023-01-31', 100),
(38, 'Ak003', 8, '2023-01-31', 100),
(39, 'B001', 9, '2023-01-31', 100),
(40, 'B002', 9, '2023-01-31', 100),
(41, 'Ba001', 10, '2023-01-31', 100),
(42, 'Ba002', 10, '2023-01-31', 100),
(43, 'OM001', 11, '2023-01-31', 100),
(44, 'OM002', 11, '2023-01-31', 100),
(45, 'OM003', 11, '2023-01-31', 100),
(46, 'KR001', 12, '2023-01-31', 100),
(47, 'KR002', 12, '2023-01-31', 100),
(48, 'FU002', 13, '2023-01-31', 100);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis_barang`, `qty`, `harga`) VALUES
('Ak001', 'GS Astra', 'Aki', 99, 620000),
('Ak002', 'Boch SM Mega Power', 'Aki', 100, 700000),
('Ak003', 'Amarin Hi Life', 'Aki', 100, 600000),
('Ak004', 'Yuasa', 'Aki', 100, 570000),
('B001', 'Duration Ultra Iridium', 'Busi', 98, 380000),
('B002', 'ACDelco 41-993 Professional ', 'Busi', 98, 95000),
('Ba001', 'Accelera', 'Ban', 96, 400000),
('Ba002', 'Bridgestone', 'Ban', 96, 550000),
('FU001', 'K&N', 'Filter Udara', 0, 1300000),
('FU002', 'Ferrox', 'Filter Udara', 100, 1300000),
('KR001', 'Akebono Brake', 'Kampas Rem', 100, 250000),
('KR002', 'Birkens', 'Kampas Rem', 98, 230000),
('OM001', 'Top Zenzation', 'Oli Mesin', 99, 500000),
('OM002', 'Castrol Magnetic', 'Oli Mesin', 100, 360000),
('OM003', 'Lucas Semi-Synthetic', 'Oli Mesin', 100, 700000);

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
(8, 'PT Kapuas Borneo Mandiri', 'Jl. Husein Hamzah No. 168 Pontianak', '0561778084'),
(9, 'PT NGK Busi Indonesia', 'Jl. Raya Jakarta-Bogor No.KM.26, RT.10/RW.4', '0218710974'),
(10, 'PT Pakita Jaya', 'Jl. Raya Wajok No.Km.9, RW.3, Kab. Mempawah, Kalimantan Barat', '0561881066'),
(11, 'PT Jayadipa Perkasa', 'Central Bisnis Blok SS 8, JL. Harapan Indah Raya, No. 20, Bekasi City, West Java', '085293938815'),
(12, 'PT. Dirgaputra Ekapratama', 'Jl.Pulobuaran Raya Blok III Kav.2-3-6 Pulogadung Jakarta Timur', '02129826633'),
(13, 'FERROX Air Filter Indonesia', 'NUR AZ Islamic Town House, Jl. Raya Klp. Dua Wetan, RT.4/RW.8, Ciracas, Jakarta', '081299429490');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `rack_no` varchar(50) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `status` varchar(5) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `note` varchar(255) NOT NULL,
  `entry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `rack_no`, `id_produk`, `nama_produk`, `qty`, `satuan`, `status`, `pic`, `note`, `entry`) VALUES
(0, '2023-01-18', '001', 'P001', 'Astrol', '1', 'Pcs', 'OUT', 'Customer', 'terjual', 'admin');

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
(13, 'wahanaa', '38d719adee9173c4135d3b212d9788b56f8e0358', 'Wahana Service', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

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
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
