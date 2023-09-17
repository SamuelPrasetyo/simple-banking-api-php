-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2023 at 03:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rekening` varchar(13) NOT NULL,
  `nama_nasabah` varchar(50) NOT NULL,
  `saldo` decimal(15,0) NOT NULL,
  `nama_bank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `nama_nasabah`, `saldo`, `nama_bank`) VALUES
('1809094352934', 'Bobon', 150000, 'ABC'),
('1809094352935', 'Coki', 100000, 'XYZ'),
('1809094352936', 'nando', 1000000, 'ABC'),
('1809094352937', 'riski', 20980000, 'XYZ'),
('1809094352938', 'hendra', 890000, 'XYZ'),
('1809094352939', 'haryo', 750000, 'ABC'),
('1809094352940', 'danni', 69020000, 'XYZ');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `no_rekpengirim` int(13) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `no_rekpenerima` int(13) NOT NULL,
  `jumlah_transfer` int(13) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `nama_pengirim`, `no_rekpengirim`, `nama_penerima`, `no_rekpenerima`, `jumlah_transfer`, `time`) VALUES
(1, 'Bobon', 2147483647, 'Coki', 2147483647, 10000, '2023-09-17 16:20:45'),
(2, 'Bobon', 2147483647, 'Coki', 2147483647, 10000, '2023-09-17 16:25:45'),
(3, 'Bobon', 2147483647, 'Coki', 2147483647, 10000, '2023-09-17 16:28:09'),
(4, 'Bobon', 2147483647, 'Coki', 2147483647, 10000, '2023-09-17 16:30:45'),
(6, 'danni', 2147483647, 'riski', 2147483647, 1000000, '2023-09-17 18:09:48'),
(7, 'riski', 2147483647, 'danni', 2147483647, 20000, '2023-09-17 18:27:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
