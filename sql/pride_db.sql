-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 05, 2020 at 02:00 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pride_db`
--
CREATE DATABASE IF NOT EXISTS `pride_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pride_db`;

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `id_dealer` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unmapped_name` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line_item`
--

CREATE TABLE `invoice_line_item` (
  `id_invoice_line_item` int(11) NOT NULL,
  `invoice_date` varchar(45) NOT NULL,
  `amount` float NOT NULL,
  `date_paid` date NOT NULL,
  `dealer_name` varchar(45) NOT NULL,
  `extended_line_cost` float NOT NULL,
  `rebateable_flag` bit(1) DEFAULT NULL,
  `vendor_id` varchar(100) NOT NULL,
  `invoice_line_type` varchar(45) NOT NULL,
  `invoice_number` varchar(150) NOT NULL,
  `management_fee_percent` float NOT NULL,
  `marketing_allowance_percent` float NOT NULL,
  `marketing_fee` float DEFAULT NULL,
  `note` varchar(45) NOT NULL,
  `po_number` varchar(45) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_cost` float DEFAULT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `product_sku` varchar(45) DEFAULT NULL,
  `rebate` float DEFAULT NULL,
  `rebate_month` varchar(45) NOT NULL,
  `rebate_percent` float NOT NULL,
  `rebate_year` int(11) NOT NULL,
  `vendor_name` varchar(45) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `id_submission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id_submission` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `result` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `submission_error_log`
--

CREATE TABLE `submission_error_log` (
  `id_submission_error_log` int(11) NOT NULL,
  `error_type` varchar(50) NOT NULL,
  `error_description` varchar(500) NOT NULL,
  `field` varchar(150) NOT NULL,
  `row_number` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `id_submission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `vendor_id` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `token` varchar(150) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `vendor_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `vendor_id`, `email`, `password`, `token`, `name`, `last_name`, `active`, `vendor_name`) VALUES
(1, '9E3CDCAD-22E3-2146-8FCC-A8C08AE2F33D', 'raydel.ojeda@codence.com', '$2y$10$Cd7jha9tyRZ24Vc6DSWqLeXhoskXiBJdam/O1KNjE0c.pz3VfhJrO', '', 'Raydel', 'Ojeda', 1, 'Vendor AAA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`id_dealer`) USING BTREE;

--
-- Indexes for table `invoice_line_item`
--
ALTER TABLE `invoice_line_item`
  ADD PRIMARY KEY (`id_invoice_line_item`) USING BTREE,
  ADD KEY `fk_invoice_line_item_submission1_idx` (`id_submission`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id_submission`) USING BTREE,
  ADD KEY `fk_log_user1_idx` (`id_user`);

--
-- Indexes for table `submission_error_log`
--
ALTER TABLE `submission_error_log`
  ADD PRIMARY KEY (`id_submission_error_log`) USING BTREE,
  ADD KEY `fk_submission_error_log_submission1_idx` (`id_submission`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE,
  ADD KEY `id_vendor` (`vendor_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id_dealer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_line_item`
--
ALTER TABLE `invoice_line_item`
  MODIFY `id_invoice_line_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id_submission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `submission_error_log`
--
ALTER TABLE `submission_error_log`
  MODIFY `id_submission_error_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_line_item`
--
ALTER TABLE `invoice_line_item`
  ADD CONSTRAINT `fk_invoice_line_item_submission1` FOREIGN KEY (`id_submission`) REFERENCES `submission` (`id_submission`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `fk_log_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `submission_error_log`
--
ALTER TABLE `submission_error_log`
  ADD CONSTRAINT `fk_submission_error_log_submission1` FOREIGN KEY (`id_submission`) REFERENCES `submission` (`id_submission`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
