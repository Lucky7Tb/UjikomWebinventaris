-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2019 at 04:17 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(50) NOT NULL,
  `id_detail_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailbarangview`
-- (See below for the actual view)
--
CREATE TABLE `detailbarangview` (
`id_detail_barang` varchar(50)
,`nama_barang` varchar(50)
,`kondisi_barang` enum('Baik','Tidak Baik')
,`jumlah_barang` int(255)
,`nama_ruang` varchar(50)
,`nama_jenis` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id_detail_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kondisi_barang` enum('Baik','Tidak Baik') NOT NULL,
  `jumlah_barang` int(255) NOT NULL,
  `id_ruang` varchar(50) NOT NULL,
  `id_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` varchar(50) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
('5d3d87528757f', 'Elektronik'),
('OR-1', 'Alat Olahraga'),
('PBSH-1', 'Alat Pembersih');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(10) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'administrator'),
(2, 'operator'),
(3, 'peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(7);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `jumlah_barang` int(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_peminjaman` varchar(50) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` varchar(50) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `keterangan`) VALUES
('5d3d849d2fa8a', 'Ruang TU', 'Pintu Ruang Tu susah di buka'),
('5d3d84a5e9b9f', 'sdvcsdvsdvds', 'sdcscsdcdscsdccsdcdscsd'),
('5d3d84afc091b', 'Ruang Matematika', 'Pintunya gampang dibuka'),
('5d3d8558366ff', 'vfdsvreververv', 'verververveervreghtehtgrgt'),
('R-GO', 'Gudang Olahraga', 'Ruangan di sebelah lapang 1'),
('R-Simdig', 'Ruang Simulasi Digital', 'Ruangan di lantai 2 dekat masjid');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telpon` varchar(14) NOT NULL,
  `level` int(10) NOT NULL DEFAULT '3',
  `status` enum('10','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `no_telpon`, `level`, `status`) VALUES
('user-1500886324', 'dqededefwfwe', 'sdfefwf', '$2y$10$B5toX84f0DygVuS2cLL.JuLmM7OELzxz9XGcXseCFY4b6c1r3xx4e', 'wfefew@gmai.com', '7657546456', 3, '0'),
('user-1958482241', 'Lucky', 'Lucky101', '$2y$10$RLad9fEr7y7CWLkDzObrZOnz9E81.Hafvot.LObztGEFHb8rRkXxO', 'luckytribhakti@gmail.com', '08993970968', 1, '10'),
('user-369659638', 'cascdewfgw', 'fewfewfwe', '$2y$10$/DhFWtkJp7yEx.vgl6VQeukRk5HaT9qg9/6m//mYrtB9pRw1.ni0m', 'fsdfesfwef@gmail.com', '757767567', 3, '0'),
('user-773530661', 'guest', 'guest', '$2y$10$CNW4zQcLAQMXzknoqbkbkuxRwCQljI6PESGni9RBQO477LMB09cjy', 'guest@gmail.com', '08993970969', 2, '10'),
('user-957197026', 'operator', 'operator', '$2y$10$/c3esfqyeJ5UoHZwqzstkOr.iBuPCRhBY6p2oF5eGb6uUlw.cllR.', 'operator@example.com', '08987467812', 3, '10');

-- --------------------------------------------------------

--
-- Structure for view `detailbarangview`
--
DROP TABLE IF EXISTS `detailbarangview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailbarangview`  AS  select `detail_barang`.`id_detail_barang` AS `id_detail_barang`,`detail_barang`.`nama_barang` AS `nama_barang`,`detail_barang`.`kondisi_barang` AS `kondisi_barang`,`detail_barang`.`jumlah_barang` AS `jumlah_barang`,`ruang`.`nama_ruang` AS `nama_ruang`,`jenis`.`nama_jenis` AS `nama_jenis` from ((`detail_barang` join `ruang` on((`detail_barang`.`id_ruang` = `ruang`.`id_ruang`))) join `jenis` on((`detail_barang`.`id_jenis` = `jenis`.`id_jenis`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_detail_barang` (`id_detail_barang`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id_detail_barang`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nama_user` (`nama_user`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_detail_barang`) REFERENCES `detail_barang` (`id_detail_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`id_ruang`) REFERENCES `ruang` (`id_ruang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_barang_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
