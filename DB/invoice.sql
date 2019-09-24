-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 04:22 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('admin','staff','','') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `user_name`, `role`) VALUES
(1, 'Mr. Admin', 'admin@digital.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'access', 'admin'),
(2, 'Mr. Saraki', 'keziah@gmail.com', '574af96709192be4309a8b0e8f3adf29a6dfd53c', 'keziah', 'staff'),
(5, 'Olarenwaju Ruth', 'rutholarenwaju@yahoo.com', 'e1800d97fa0d7083690c58419cbcd8abd5b3c009', 'Ruth', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0bbin84op4987chm80fuvmkgkbt0holk', '::1', 1550237819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303233373831393b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('0qkoav2t8bqo8tt4d1qf0bjlkrhph44q', '::1', 1554373266, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535343337333234313b),
('2r3a26ip1pq0bsn3jvupga1ja6dmlop0', '::1', 1550589526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303538393532363b),
('6f33ksckstaqmpfludqsi79v3tmfovi0', '::1', 1550585721, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303538353732313b),
('6pn6lhud6v89dnbbguo793ku0u5tdjbh', '::1', 1569332507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536393333323438393b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('6tbco7s79r9q0teqkp3llqsdevgol0f6', '::1', 1550236815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303233363831353b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('8aa8jck9sqg7jdqgn0017rb5opap131a', '::1', 1550516070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303531363037303b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('aeqn1mbgvnvcd0na7drjeqk0p2cmcnp7', '::1', 1556020815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363032303831353b),
('alggprf314jqtutijf679qmfv059nvj1', '::1', 1555329414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535353332393431343b),
('d8euf9c7t9a9b8epski2e6og7c0bgncf', '::1', 1550589508, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303538393530383b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('ffca8uan253oteasnbj7a4p7l6nqc77r', '::1', 1556020851, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535363032303835313b),
('g3pfcfvr850k0ns3ogdi34oh4l6jgas1', '::1', 1552040186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535323034303130383b),
('gkarhodiiu1div7q1pt33vtu89rjgdss', '::1', 1554749960, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535343734393936303b),
('himf5jcm7pft10jsr3redq5amjkal4b6', '::1', 1550586726, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303538363732363b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('i31ngued43dc9isegk3ruolfcgpaeuii', '::1', 1550588480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303538383438303b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('k9mfj5dlrhr2p8tauua75t46f9dr1lli', '::1', 1555056198, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535353035363139383b),
('kjgc6jar6d6ub4qnr3sinqk4iqfq5499', '::1', 1569315822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536393331353832323b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('kpjhk89tt9t69pnog07gnl7q43332h8o', '::1', 1555527962, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535353532373936323b),
('ljonu3iv9e09jem6emr5ps9mvi6fqrsa', '::1', 1555211364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535353231313336343b),
('lqc00r7vl0jdeojl1hf9org0oj08pt34', '::1', 1552040049, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535323034303034393b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b737563636573735f6d73677c733a38383a223c64697620636c6173733d22616c65727420616c6572742d7375636365737320746578742d63656e746572223e437573746f6d657220446174612055706461746564205375636365737366756c6c792121213c2f6469763e223b5f5f63695f766172737c613a313a7b733a31313a22737563636573735f6d7367223b733a333a226e6577223b7d),
('n9dk4vk0ec2og6csodhi7m2j4dhnumll', '::1', 1550237961, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303233373831393b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('opc7174h8ru56bfpoblqbo229d46paj7', '::1', 1569332489, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536393333323438393b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('su2lttn02erbeahc7b7ickc21l41oimd', '::1', 1550515058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303531353035383b61646d696e5f6c6f67696e7c733a313a2231223b73746166665f6c6f67696e7c733a313a2231223b69647c733a313a2231223b6e616d657c733a363a22616363657373223b6c6f67696e5f747970657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b),
('vncn2k30sok6llgg40pj3o6cr87sdjun', '::1', 1550356374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303335363337343b);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Regular','New') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `address`, `phone`, `status`, `created_at`) VALUES
(7, 'Ruth Olarenwaju', 'Ayobo-Ipaja', '+2348080667647', 'New', '2019-03-08 10:14:08'),
(8, 'Abiola', 'Maryland, US-London', '+234725526514', 'Regular', '2019-02-13 03:22:16'),
(9, 'Mr. Jefferson', 'No. Alasia Rd. Okiki lane, Imo', '+23480652462', 'New', '2019-02-13 21:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_order`
--

CREATE TABLE `invoice_order` (
  `order_id` int(11) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `order_receiver_name` varchar(250) NOT NULL,
  `order_receiver_addr` text NOT NULL,
  `order_receiver_phone` text NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `order_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_order`
--

INSERT INTO `invoice_order` (`order_id`, `order_no`, `order_date`, `order_receiver_name`, `order_receiver_addr`, `order_receiver_phone`, `order_total`, `balance`, `paid`, `order_datetime`) VALUES
(7, 'm0dwtp', '2018-09-20', 'Dr. Saraki Buhari', 'Abuja, Aso Rock', '08023629339', '21050.00', '8246.00', '12804.00', '2018-11-27 12:41:31'),
(11, 'koOZ2u', '2018-09-24', 'Saraki Buhari', 'USA, Washinton', '08033493289', '21570.00', '8730.00', '12840.00', '2018-09-24 06:26:51'),
(12, 'hJlZ2X', '2019-03-07', 'Mr. Jefferson', 'No. Alasia Rd. Okiki lane, Imo', '+23480652462', '23670.00', '22370.00', '1300.00', '2019-03-08 10:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_order_item`
--

CREATE TABLE `invoice_order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(250) NOT NULL,
  `order_photo_type` varchar(250) NOT NULL,
  `order_photo_size` varchar(250) NOT NULL,
  `order_item_quantity` decimal(10,2) NOT NULL,
  `order_item_price` decimal(10,2) NOT NULL,
  `order_item_actual_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_order_item`
--

INSERT INTO `invoice_order_item` (`order_item_id`, `order_id`, `item_name`, `order_photo_type`, `order_photo_size`, `order_item_quantity`, `order_item_price`, `order_item_actual_amount`, `created_at`) VALUES
(39, 11, 'Touch light', 'Portrait', '303 x 410', '5.00', '2630.00', '13150.00', '2018-09-24 06:26:51'),
(40, 11, 'Camera Photo', 'Landscape', '125 x 95', '2.00', '4210.00', '8420.00', '2018-09-24 06:26:51'),
(46, 7, 'Plasma Tv', 'Portrait', '125 x 95', '5.00', '2630.00', '21050.00', '2018-11-27 12:41:50'),
(47, 12, 'TV5', 'Pastel Inkscape', '125 x 95', '5.00', '2630.00', '13150.00', '2019-03-08 10:08:13'),
(48, 12, 'Imobile', 'Pastel Inkscape', '125 x 95', '4.00', '2630.00', '10520.00', '2019-03-08 10:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_rate_item`
--

CREATE TABLE `pricing_rate_item` (
  `rate_id` int(11) NOT NULL,
  `photo_type` varchar(250) NOT NULL,
  `photo_size` varchar(250) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing_rate_item`
--

INSERT INTO `pricing_rate_item` (`rate_id`, `photo_type`, `photo_size`, `unit_price`) VALUES
(15, 'Pastel Inkscape', '125 x 95', '2630.00');

-- --------------------------------------------------------

--
-- Table structure for table `record_debt`
--

CREATE TABLE `record_debt` (
  `id` int(10) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `amount_paid` double(10,2) NOT NULL,
  `balance` double(10,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_received` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record_debt`
--

INSERT INTO `record_debt` (`id`, `customer_name`, `amount_paid`, `balance`, `date_created`, `date_received`) VALUES
(8, 'Dr. Saraki Buhari', 12804.00, 8246.00, '2019-02-19 15:13:26', '2018-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Invoicing Management System(IMS)'),
(2, 'system_title', 'Invoicing Management System(IMS)'),
(3, 'address', 'No. 1 Asika Ilobi Sreet, Orlu, Imo State.'),
(4, 'phone', '+2348037974772'),
(7, 'system_email', 'blessedstaninvestment@yahoo.com'),
(11, 'language', 'english'),
(17, 'company', 'BLESSED STAN DIGITAL PHOTO LAB LTD.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_order`
--
ALTER TABLE `invoice_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `pricing_rate_item`
--
ALTER TABLE `pricing_rate_item`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `record_debt`
--
ALTER TABLE `record_debt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_order`
--
ALTER TABLE `invoice_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice_order_item`
--
ALTER TABLE `invoice_order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pricing_rate_item`
--
ALTER TABLE `pricing_rate_item`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `record_debt`
--
ALTER TABLE `record_debt`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
