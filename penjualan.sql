-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 04:28 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('dev', '123'),
('yaw', '123');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `dimension` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`) VALUES
('GIVBIRU', 'Giv Biru', '11000.00', 'IDR', '0.00', '80 gram', 'PCS'),
('S013975531', 'Mama Lemon', '30000.00', 'IDR', '7.50', '1 Liter', 'PCX'),
('SKUSKILNP', 'So klin Pewangi', '15000.00', 'IDR', '10.00', '13 cm x 10 cm', 'PCS'),
('SKUSKILQD', 'So klin Liquid', '18000.00', 'IDR', '0.00', '13 cm x 10 cm', 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(6) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_header`
--

CREATE TABLE `transaction_header` (
  `document_code` varchar(3) NOT NULL,
  `document_number` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD KEY `product_code` (`product_code`),
  ADD KEY `document_number` (`document_number`);

--
-- Indexes for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD PRIMARY KEY (`document_number`),
  ADD KEY `user` (`user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`),
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`document_number`) REFERENCES `transaction_header` (`document_number`);

--
-- Constraints for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD CONSTRAINT `transaction_header_ibfk_1` FOREIGN KEY (`user`) REFERENCES `login` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
