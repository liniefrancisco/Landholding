-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2019 at 08:06 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `land_holding_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `amount_basis`
--

DROP TABLE IF EXISTS `amount_basis`;
CREATE TABLE IF NOT EXISTS `amount_basis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mv_latest_tax_dec` double(10,2) NOT NULL,
  `neighboring_inq` double(10,2) NOT NULL,
  `assesor` double(10,2) NOT NULL,
  `banks` double(10,2) NOT NULL,
  `final_value` double(10,2) NOT NULL,
  `reference_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_id_2` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amount_basis`
--

INSERT INTO `amount_basis` (`id`, `mv_latest_tax_dec`, `neighboring_inq`, `assesor`, `banks`, `final_value`, `reference_id`) VALUES
(1, 520400.00, 620540.00, 550200.00, 814050.00, 850000.00, 'ESO-0001'),
(2, 45040.00, 50000.00, 45040.00, 75800.00, 75800.00, 'ES-0001'),
(3, 150574.00, 367050.00, 781025.00, 548104.00, 951424.00, 'ES-0002'),
(4, 50050.00, 250000.00, 795000.00, 800000.00, 675000.00, 'ES-0003'),
(5, 50000.00, 60000.00, 70000.00, 80000.00, 100000.00, 'ES-0004');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_level`
--

DROP TABLE IF EXISTS `assessment_level`;
CREATE TABLE IF NOT EXISTS `assessment_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentage` float(10,2) NOT NULL,
  `is_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `is_no` (`is_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment_level`
--

INSERT INTO `assessment_level` (`id`, `percentage`, `is_no`) VALUES
(1, 15.00, 'NA-0001'),
(2, 15.00, 'NA-0008'),
(3, 10.00, 'ES-0001'),
(4, 10.00, 'ESO-0001');

-- --------------------------------------------------------

--
-- Table structure for table `bidding_details`
--

DROP TABLE IF EXISTS `bidding_details`;
CREATE TABLE IF NOT EXISTS `bidding_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_price` double(10,2) NOT NULL,
  `highest_bidder` varchar(90) NOT NULL,
  `reference_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidding_details`
--

INSERT INTO `bidding_details` (`id`, `bid_price`, `highest_bidder`, `reference_id`) VALUES
(1, 250000.00, 'Judy Torefiel', 'JSO-0001'),
(2, 450000.00, 'Felicity Acero', 'JS-0001'),
(3, 890000.00, 'Glenn Sarayan', 'JS-0002'),
(4, 530500.00, 'Felicita Agonoy', 'JS-0003'),
(5, 5000.00, 'Emilia AboAbo', 'JS-0004');

-- --------------------------------------------------------

--
-- Table structure for table `broker_info`
--

DROP TABLE IF EXISTS `broker_info`;
CREATE TABLE IF NOT EXISTS `broker_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `commission_due` double(10,2) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `broker_info`
--

INSERT INTO `broker_info` (`id`, `firstname`, `middlename`, `lastname`, `commission_due`, `owner_id`) VALUES
(1, 'Ilina', 'Pacatang', 'Persio', 0.00, 1),
(2, 'John Mark', 'Degamo', 'Cabillo', 0.00, 11),
(3, 'ghjhg', 'hgjhg', 'hgjgh', 0.00, 16),
(4, 'Ramon   ', 'Sevilla', 'Cuasito', 0.00, 20),
(5, 'Cynthia', 'Suwaybaguio', 'Clint', 0.00, 21),
(6, 'fghgf', 'fghgf', 'fghfg', 0.00, 22),
(7, 'fghgfh', 'fghgf', 'gfhgf', 0.00, 26),
(8, 'Fghgfh', 'Fghgfh', 'Gfhfg', 0.00, 36);

-- --------------------------------------------------------

--
-- Table structure for table `cash_advance`
--

DROP TABLE IF EXISTS `cash_advance`;
CREATE TABLE IF NOT EXISTS `cash_advance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_no` varchar(30) NOT NULL,
  `reference_no` varchar(30) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `remaining_balance` double(10,2) NOT NULL,
  `date_issue` date NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lpf_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `reference_no` (`reference_no`),
  UNIQUE KEY `ca_no` (`ca_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advance`
--

INSERT INTO `cash_advance` (`id`, `ca_no`, `reference_no`, `amount`, `remaining_balance`, `date_issue`, `transaction_date`, `lpf_no`) VALUES
(1, '22041-jjoi7', '054580', 150000.00, 2860000.00, '2019-04-17', '2019-04-23 07:30:56', '1704-01'),
(2, '23042-avkfb', '065460', 800000.00, 315000.00, '2019-04-23', '2019-04-23 07:36:10', '2304-03'),
(3, '23043-ljlfx', '054410', 500000.00, 4390000.00, '2019-04-24', '2019-04-24 07:31:14', '2304-04'),
(4, '24044-566kz', '0578474', 20000.00, 295000.00, '2019-04-28', '2019-04-29 07:03:48', '2304-03'),
(5, '25046-xe6p6', '057740', 50000.00, 4340000.00, '2019-05-15', '2019-05-16 08:42:27', '2304-04'),
(6, '24045-fznvm', '054085', 80000.00, 2780000.00, '2019-05-16', '2019-05-16 09:41:30', '1704-01'),
(7, '210510-6rfn4', '08440', 50000.00, 5158500.00, '2019-05-21', '2019-05-21 05:46:45', '2204-02'),
(8, '210511-2lwma', '45004', 10000.00, 5148500.00, '2019-05-01', '2019-05-21 05:51:43', '2204-02'),
(9, 'CA-210512', '054011', 150000.00, 4998500.00, '2019-05-01', '2019-05-23 09:52:44', '2204-02');

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

DROP TABLE IF EXISTS `contact_person`;
CREATE TABLE IF NOT EXISTS `contact_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `address` varchar(150) NOT NULL,
  `tel_no` varchar(30) NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `email_ad` varchar(30) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`id`, `name`, `address`, `tel_no`, `phone_no`, `email_ad`, `owner_id`) VALUES
(1, '', '', '', '', 'emily@yahoo.com', 1),
(2, 'Evica Zubac', 'Mansasa, Tagbilaran City', '', '09054505401', 'evica@ymail.com', 4),
(3, 'Reynolds Russell', 'Cabangkalan, Mandaue, Cebu', '', '09125402015', '', 5),
(4, 'Jessa Mae Calatrava', 'Hanopol, Loon, Bohol', '', '09245004524', 'jes@yahoo.com', 8),
(5, 'Antonio Dumanig', 'Pilar, Bohol', '', '09451450400', 'aton@ymail.com', 11),
(6, 'Zell Puras', 'Cantumocad, Loon, Bohol', '', '09545140404', 'zell@ymail.com', 12),
(7, 'Nelson Uy', 'Sta. Cruz, Calape, Bohol', '', '09245404100', 'nelson@ymail.com', 13),
(8, 'ghjhgjhg', 'ghjhgjfdgdfgdfg', '', '04574545452', 'john@example.com', 16),
(9, 'Emelyn Pacatang', 'Cogon, Bonbon, Calape', '', '09545401420', 'emely@yahoo.com', 17),
(10, 'dsfsdfdsf', 'sdfdsdsfdsfsd', '', '09154504210', '', 18),
(11, 'gfhfghgfh', 'fghgfhgfhfgh', '', '09515245040', '', 19),
(12, 'Michelle Lim', 'Purok 3, Taytay, Getafe', '', '09150205400', '', 21),
(13, 'sdfdsfds', 'dsfdsfdsf', '', '09121502441', '', 22),
(14, 'dsfdsf', 'sdfdsfdsf', '', '09124504000', 'john@example.com', 23),
(15, 'fghgfhgfh', 'fghfghfghfghg', '', '09215021454', 'john@example.com', 26),
(16, 'Capt John Price', 'Otawara, San', '', '09454805400', 'john@example.com', 29),
(17, 'Cherry Jane Miculob', 'Ulbujan, Calape, Bohol', '', '09548410400', '', 30),
(18, 'Sdfdsfsdfsdf', 'Sdfsdfsdf', '', '09514504040', '', 33),
(19, 'Fdgdddddddddddddddddddddddddddd', 'Dfgfdgfdgdfgdfgfdgdfg', '', '09545141000', '', 34),
(20, '', 'Fghgfhgfhgfh', '', '09545140450', '', 36),
(21, 'Dfgdfgfdgfdgfdg', 'Fdgdfgfdg', '', '09145451000', '', 35),
(22, 'Sdfdsf', 'Dsfdsfdfd', '', '09245104000', '', 37),
(23, 'Jhkjhkhjkhjk', 'Hjkhjkjhkjhk', '', '09245415450', '', 38),
(24, 'Fdgdfgfdgfdg', 'Dfgfdgdfgdfgdfg', '', '09545404000', '', 40);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE IF NOT EXISTS `customer_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`id`, `street`, `barangay`, `town`, `province`, `customer_id`) VALUES
(1, 'Purok 5', 'Bitaugan', 'Bilar', 'Bohol', '1'),
(2, 'Purok 8', 'Calumpay', 'Inabangga', 'Bohol', '2'),
(3, 'Purok 3', 'Pandan', 'Tubigon', 'Bohol', '3'),
(4, 'Purok 4', 'Libertad', 'Corella', 'Bohol', '4'),
(5, 'Purok 11', 'Cantumocad', 'Loon', 'Bohol', '5'),
(6, 'Purok 3', 'Bonkokan Ubos', 'Lila', 'Bohol', '6'),
(7, 'Junction', 'Pandan', 'Dauis', 'Bohol', '7'),
(8, 'Lamak', 'Bentig', 'Calape', 'Bohol', '8'),
(9, 'Purok 1 ', 'Cantumocad', 'Loon', 'Bohol', '9'),
(10, 'Purok 4', 'Bungkokan', 'Lila', 'Bohol', '10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_bal_info`
--

DROP TABLE IF EXISTS `customer_bal_info`;
CREATE TABLE IF NOT EXISTS `customer_bal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance_type` varchar(30) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `business_unit` varchar(60) NOT NULL,
  `reference_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_bal_info`
--

INSERT INTO `customer_bal_info` (`id`, `balance_type`, `case_type`, `business_unit`, `reference_id`) VALUES
(1, 'Bad Account', '', 'Corp. Leasing', '1'),
(2, '', 'Collection of Sum Money', 'Corp. IAD', '2'),
(3, '', 'Small claim case', 'MFRI-Tangnan', '3'),
(4, 'Bounced Check', '', 'Corp. -Fad', '4'),
(5, '', 'Collection of Sum Money', 'Corp. - IT', '5'),
(6, 'Bounced Check', '', 'Corp. - Accounting', '6'),
(7, '', 'Small claim case', 'Corp-Accounting', '7'),
(8, 'Bounced Check', '', 'Corp. - IAD', '8'),
(9, '', 'Small claim case', 'Corporate - Accounting', '9'),
(10, 'Bad Account', '', 'Corporate - FAD', '10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

DROP TABLE IF EXISTS `customer_info`;
CREATE TABLE IF NOT EXISTS `customer_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `reference_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_id` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`id`, `firstname`, `middlename`, `lastname`, `reference_id`) VALUES
(1, 'Abella', 'Dinorog', 'Lamoste', 'ESO-0001'),
(2, 'Ernesto', 'Dumadag', 'Arcalla', 'JSO-0001'),
(3, 'Cerrania', 'Villa', 'Nueva', 'JS-0001'),
(4, 'Trifina', 'Palec', 'Agot', 'ES-0001'),
(5, 'Jocres', 'Socdiuag', 'Gaudicos', 'JS-0002'),
(6, 'Cristine', 'Gamay', 'Hamoay', 'ES-0002'),
(7, 'Cathy Claire', 'Danao', 'Jaluag', 'JS-0003'),
(8, 'Marvin', 'Cerebos', 'Burong', 'ES-0003'),
(9, 'Paulo', 'Venezuela', 'Bediones', 'JS-0004'),
(10, 'Cristine', 'Gamay', 'Hamoay', 'ES-0004');

-- --------------------------------------------------------

--
-- Table structure for table `es_uploads`
--

DROP TABLE IF EXISTS `es_uploads`;
CREATE TABLE IF NOT EXISTS `es_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doubtful_account` varchar(210) NOT NULL,
  `latest_soa` varchar(210) NOT NULL,
  `supporting_docs` varchar(210) NOT NULL,
  `reference_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_id` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `es_uploads`
--

INSERT INTO `es_uploads` (`id`, `doubtful_account`, `latest_soa`, `supporting_docs`, `reference_id`) VALUES
(1, '4_Pay-the-Transfer-Taxes-and-secure-the-Tax-Clearance-at-the-Local-Treasurer’s-Office.jpg', '15895018_1417749378235697_7352150381075355922_n.jpg', 'download.png', 'ESO-0001'),
(2, 'bfs-logo-centered-550px-116x60.jpg', 'donation-of-properties-subject-to-donors-tax-235x156.jpg', 'join-the-truly-rich-club-v5.gif', 'ES-0001'),
(3, 'real-property-tax-philippines.jpg', 'pagibig-foreclosed-properties-july-2018-v2-116x60.jpg', 'VAT-and-income-tax-on-homeowners-associations-181x156.jpg', 'ES-0002'),
(4, 'Condominium-sale-RS2317981-761534.jpg', 'guide-to-real-estate-property-tax-in-the-philippines-1.jpg', 'partner-broker-728x90-banner-hoppler.jpg', 'ES-0003'),
(5, 'conveyance-realty-services.gif', 'condo-dues-now-subject-to-vat-235x156.jpg', 'death-real-estate-and-estate-tax-3-298x156.jpg', 'ES-0004');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_no` varchar(15) NOT NULL,
  `form_type` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_no` (`form_no`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_no`, `form_type`, `user_id`) VALUES
(1, 'OA-0001', 'IS', 4),
(2, 'ESO-0001', 'LAPF-ES', 4),
(3, 'JSO-0001', 'LAPF-JS', 4),
(4, 'NA-0001', 'IS', 1),
(5, 'NA-0002', 'IS', 1),
(6, 'JS-0001', 'LAPF-JS', 8),
(7, 'ES-0001', 'LAPF-ES', 8),
(8, '1704-01', 'LPF', 1),
(9, 'NA-0003', 'IS', 1),
(10, 'JS-0002', 'LAPF-JS', 8),
(11, 'ES-0002', 'LAPF-ES', 8),
(12, 'NA-0004', 'IS', 1),
(13, 'NA-0005', 'IS', 1),
(14, '22041-jjoi7', 'LCAF', 1),
(15, '2204-02', 'LPF', 1),
(16, 'NA-0006', 'IS', 1),
(17, 'JS-0003', 'LAPF-JS', 8),
(18, 'ES-0003', 'LAPF-ES', 8),
(19, '2304-03', 'LPF', 1),
(20, '23042-avkfb', 'LCAF', 1),
(21, '2304-04', 'LPF', 1),
(22, '23043-ljlfx', 'LCAF', 1),
(23, '24044-566kz', 'LCAF', 1),
(24, '24045-fznvm', 'LCAF', 1),
(25, '25046-xe6p6', 'LCAF', 1),
(28, 'NA-0007', 'IS', 1),
(31, 'NA-0008', 'IS', 1),
(32, '2704-05', 'LPF', 1),
(33, '29047-vcfmh', 'LCAF', 1),
(34, 'OA-0002', 'IS', 4),
(35, 'NA-0009', 'IS', 1),
(38, '2105-06', 'LPF', 1),
(39, '210510-6rfn4', 'LCAF', 1),
(40, '210511-2lwma', 'LCAF', 1),
(41, 'NA-0010', 'IS', 1),
(42, 'CA-210512', 'LCAF', 1),
(44, 'NA-0011', 'IS', 1),
(45, 'NA-0012', 'IS', 1),
(46, 'JS-0004', 'LAPF-JS', 8),
(47, 'ES-0004', 'LAPF-ES', 8),
(48, 'CA-310513', 'LCAF', 1),
(49, 'CA-310514', 'LCAF', 1),
(50, '0806-07', 'LPF', 1),
(51, 'OA-0003', 'IS', 4),
(52, 'CA-200615', 'LCAF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `land_info`
--

DROP TABLE IF EXISTS `land_info`;
CREATE TABLE IF NOT EXISTS `land_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_no` varchar(10) NOT NULL,
  `land_title_no` varchar(50) NOT NULL,
  `tax_dec_no` varchar(50) NOT NULL,
  `lot` varchar(30) NOT NULL,
  `cad` varchar(30) NOT NULL,
  `lot_type` varchar(15) NOT NULL,
  `lot_sold` varchar(15) NOT NULL,
  `purchase_type` varchar(15) NOT NULL,
  `lot_size` double(10,2) NOT NULL,
  `price_per_sqm` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_acquired` varchar(20) NOT NULL,
  `date_approved` date NOT NULL,
  `tag` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `is_no` (`is_no`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `land_info`
--

INSERT INTO `land_info` (`id`, `is_no`, `land_title_no`, `tax_dec_no`, `lot`, `cad`, `lot_type`, `lot_sold`, `purchase_type`, `lot_size`, `price_per_sqm`, `total_price`, `status`, `date_acquired`, `date_approved`, `tag`) VALUES
(1, 'OA-0001', 'TF5240', 'PI4501', '15704', '054-402', 'Agricultural', 'Portion', 'package', 4752.00, 0.00, 890000.00, 'Approved', '1989-01-12', '1989-01-13', 'Old'),
(2, 'ESO-0001', '', '', '05710', '0540', 'Agricultural', 'Portion', '', 1506.00, 0.00, 0.00, 'Approved', '2012-06-28', '0000-00-00', 'Old LAPF-ES'),
(3, 'JSO-0001', '', '', '05414', '84110', 'Residential', 'Portion', '', 450.00, 0.00, 0.00, 'Approved', '2015-08-18', '0000-00-00', 'Old LAPF-JS'),
(4, 'NA-0001', '0424', '', '405500', '871052', 'Commercial', 'Whole', 'per/sq.m.', 860.00, 3500.00, 3010000.00, 'Approved', '04/17/2019', '2019-04-17', 'New'),
(5, 'NA-0002', '51100', '', '0504140', '05040', 'Commercial', 'Whole', 'package', 4150.00, 0.00, 12860000.00, 'Approved', '04/17/2019', '2019-05-21', 'New'),
(6, 'JS-0001', '', '', '057450', '89104', 'Agricultural', 'Portion', '', 1504.00, 0.00, 0.00, 'Approved', '04/17/2019', '2019-04-23', 'New LAPF-JS'),
(7, 'ES-0001', '', '', '15104', '14520', 'Commercial', 'Portion', '', 3504.00, 0.00, 0.00, 'Approved', '04/17/2019', '2019-04-23', 'New LAPF-ES'),
(8, 'NA-0003', '0065740', '', '21005', '407454', 'Agricultural', 'Whole', 'per/sq.m.', 947.00, 5500.00, 5208500.00, 'Approved', '04/17/2019', '2019-04-17', 'New'),
(9, 'JS-0002', '', '', '045104', '054089', 'Commercial', 'Portion', '', 1250.00, 0.00, 0.00, 'Pending', '04/17/2019', '0000-00-00', 'New LAPF-JS'),
(10, 'ES-0002', '', '', '95450', '32650', 'Residential', 'Portion', '', 634.00, 0.00, 0.00, 'Disapproved', '04/17/2019', '2019-04-23', 'New LAPF-ES'),
(11, 'NA-0004', '084560', '', '05450', '815045', 'Residential', 'Whole', 'per/sq.m.', 1454.00, 851.00, 1237354.00, 'Disapproved', '04/22/2019', '0000-00-00', 'New'),
(12, 'NA-0005', '684140', '', '04814', '099545', 'Agricultural', 'Whole', 'per/sq.m.', 446.00, 2500.00, 1115000.00, 'Approved', '04/22/2019', '2019-04-22', 'New'),
(13, 'NA-0006', '62650', '', '964140', '25405', 'Residential', 'Whole', 'package', 2500.00, 0.00, 4890000.00, 'Approved', '04/23/2019', '2019-04-23', 'New'),
(14, 'JS-0003', '', '', '028540', '9640', 'Commercial', 'Portion', '', 750.00, 0.00, 0.00, 'Disapproved', '04/23/2019', '2019-04-23', 'New LAPF-JS'),
(15, 'ES-0003', '', '', '9526', '02450', 'Commercial', 'Portion', '', 1250.00, 0.00, 0.00, 'Pending', '04/23/2019', '0000-00-00', 'New LAPF-ES'),
(17, 'NA-0007', '05451', '', '058401', '78910', 'Commercial', 'Whole', 'package', 2130.00, 0.00, 8451000.00, 'Approved', '04/26/2019', '2019-04-26', 'New'),
(19, 'NA-0008', '', '024510', 'ukjh', 'jkjkjkj', 'Agricultural', 'Whole', 'per/sq.m.', 451.00, 500.00, 225500.00, 'Approved', '04/27/2019', '2019-04-27', 'New'),
(20, 'OA-0002', 'K97H', 'P86B', '0571', '0401', 'Commercial', 'Portion', 'package', 4000.00, 0.00, 54000000.00, 'Approved', '2016-07-21', '2016-07-22', 'Old'),
(21, 'NA-0009', '0450', '', '05411', '0541', 'Commercial', 'Whole', 'per/sq.m.', 750.00, 1500.00, 1125000.00, 'Pending', '05/16/2019', '0000-00-00', 'New'),
(23, 'NA-0010', 'dfgdfgdfg', '', 'dsfdsf', 'dsfdsf', 'Commercial', 'Whole', 'per/sq.m.', 2522.00, 500.00, 1261000.00, 'Disapproved', '05/21/2019', '0000-00-00', 'New'),
(29, 'NA-0011', '04580', '', '054JHF', 'HJHG050', 'Residential', 'Portion', 'per/sq.m.', 678.01, 895.00, 606818.95, 'Pending', '05/28/2019', '0000-00-00', 'New'),
(30, 'NA-0012', '', '205044', 'PIJ-450', 'SDF-8965', 'Commercial', 'Portion', 'package', 500.00, 0.00, 60000.00, 'Approved', '05/28/2019', '2019-06-07', 'New'),
(31, 'JS-0004', '', '', '40JGU', '67HJU', 'Agricultural', 'Portion', '', 5000.00, 0.00, 0.00, 'Pending', '05/28/2019', '0000-00-00', 'New LAPF-JS'),
(32, 'ES-0004', '', '', '0540JH', '451IOH', 'Agricultural', 'Portion', '', 1500.00, 0.00, 0.00, 'Pending', '05/28/2019', '0000-00-00', 'New LAPF-ES'),
(36, 'OA-0003', 'fghgf', 'fgfggfh', 'fghgfh', 'fghgfh', 'Agricultural', 'Portion', 'package', 5000.00, 0.00, 500.00, 'Approved', '2018-05-21', '2018-05-22', 'Old');

-- --------------------------------------------------------

--
-- Table structure for table `lot_location`
--

DROP TABLE IF EXISTS `lot_location`;
CREATE TABLE IF NOT EXISTS `lot_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(50) NOT NULL,
  `baranggay` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `zip_code` int(5) NOT NULL,
  `province` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `is_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `is_no` (`is_no`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lot_location`
--

INSERT INTO `lot_location` (`id`, `street`, `baranggay`, `municipality`, `zip_code`, `province`, `country`, `is_no`) VALUES
(1, 'Purok 1', 'Bahi', 'Loon', 6327, 'Bohol', 'Philippines', 'OA-0001'),
(2, 'Purok 1', 'Hingotanan East', 'Inabanga', 6333, 'Bohol', 'Philippines', 'ESO-0001'),
(3, 'Purok 9', 'Bicahan', 'Guindulman', 6326, 'Bohol', 'Philippines', 'JSO-0001'),
(4, 'Purok 1', 'Dao', 'Tagbilaran City', 6300, 'Bohol', 'Philippines', 'NA-0001'),
(5, 'Purok 3', 'Bool', 'Tagbilaran City', 6300, 'Bohol', 'Philippines', 'NA-0002'),
(6, 'Purok 6', 'Bantolinao', 'Danao', 6335, 'Bohol', 'Philippines', 'JS-0001'),
(7, 'Bagong Silang', 'Bitaugan', 'Mabini', 6305, 'Bohol', 'Philippines', 'ES-0001'),
(8, 'Purok 3', 'Bool', 'Tagbilaran City', 6300, 'Bohol', 'Philippines', 'NA-0003'),
(9, 'Purok 3', 'Napo', 'Loon', 6327, 'Bohol', 'Philippines', 'JS-0002'),
(10, 'Badiang', 'Bonbonon', 'Calape', 6328, 'Bohol', 'Philippines', 'ES-0002'),
(11, 'Purok 5', 'Union', 'Pilar', 6347, 'Bohol', 'Philippines', 'NA-0004'),
(12, 'Purok 6', 'Villa Aurora', 'Sevilla', 6315, 'Bohol', 'Philippines', 'NA-0005'),
(13, 'Purok 9', 'Landican', 'Loboc', 6324, 'Bohol', 'Philippines', 'NA-0006'),
(14, 'Junction', 'Pandan', 'Dauis', 6311, 'Bohol', 'Philippines', 'JS-0003'),
(15, 'Purok 5', 'Banlasan', 'Calape', 6510, 'Bohol', 'Philippines', 'ES-0003'),
(17, 'Purok 6', 'San Agustin', 'Carmen', 6341, 'Bohol', 'Philippines', 'NA-0007'),
(19, 'jkjjh', 'hjkjh', 'hjkhjkhj', 6120, 'jhkjh', 'hjkjhk', 'NA-0008'),
(20, 'Purok 1', 'Abucayan Norte', 'Calape', 6328, 'Bohol', 'Phillipines', 'OA-0002'),
(21, 'Purok 3', 'Liboron', 'Calape', 6328, 'Bohol', 'Philippines', 'NA-0009'),
(23, 'sdfds', 'dsfdsf', 'dsfdsf', 6510, 'dsfdsf', 'sdfdsf', 'NA-0010'),
(29, 'Purok 5', 'Catagbacan', 'Loon', 6327, 'Bohol', 'Philippines', 'NA-0011'),
(30, 'Purok 1', 'Baogo', 'Inabanga', 6350, 'Bohol', 'Philippines', 'NA-0012'),
(31, 'Purok 5', 'Banlasan', 'Calape', 6328, 'Bohol', 'Philippines', 'JS-0004'),
(32, 'Purok  1', 'Bonbon', 'Calape', 6328, 'Bohol', 'Philippines', 'ES-0004'),
(36, 'Fghgfh', 'Gfhgfh', 'Gfhgf', 6304, 'Fghfgh', 'Gfh', 'OA-0003');

-- --------------------------------------------------------

--
-- Table structure for table `lot_purchase_requests`
--

DROP TABLE IF EXISTS `lot_purchase_requests`;
CREATE TABLE IF NOT EXISTS `lot_purchase_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lpf_no` varchar(15) NOT NULL,
  `date_requested` date NOT NULL,
  `date_reviewed` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `is_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `is_no` (`is_no`),
  UNIQUE KEY `lpf_no` (`lpf_no`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lot_purchase_requests`
--

INSERT INTO `lot_purchase_requests` (`id`, `lpf_no`, `date_requested`, `date_reviewed`, `status`, `is_no`) VALUES
(1, '1704-01', '2019-04-17', '2019-04-22', 'Approved', 'NA-0001'),
(2, '2204-02', '2019-04-27', '2019-05-21', 'Approved', 'NA-0003'),
(3, '2304-03', '2019-04-23', '2019-04-23', 'Approved', 'NA-0005'),
(4, '2304-04', '2019-04-23', '2019-04-23', 'Approved', 'NA-0006'),
(7, '2704-05', '2019-06-20', '2019-04-27', 'Pending', 'NA-0008'),
(8, '2105-06', '2019-05-21', '0000-00-00', 'Pending', 'NA-0007'),
(9, '0806-07', '2019-06-08', '2019-06-20', 'Approved', 'NA-0002');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_type` varchar(15) NOT NULL,
  `reference_id` varchar(20) NOT NULL,
  `action` varchar(70) NOT NULL,
  `recipient` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `form_type`, `reference_id`, `action`, `recipient`, `status`, `date`) VALUES
(7, 'LAPF-JS', 'JS-0001', 'approved', '8', 'unread', '2019-04-23 11:33:56'),
(8, 'LAPF-JS', 'JS-0003', 'disapproved', '8', 'unread', '2019-04-23 11:36:00'),
(9, 'LAPF-ES', 'ES-0001', 'approved', '8', 'read', '2019-05-16 08:30:09'),
(10, 'LAPF-ES', 'ES-0002', 'disapproved', '8', 'unread', '2019-04-23 11:37:12'),
(11, 'LCAF', '25046-xe6p6', 'approved', '1', 'read', '2019-05-16 08:43:15'),
(12, 'LCAF', '24045-fznvm', 'approved', '1', 'read', '2019-05-16 08:42:49'),
(14, 'LPF', '2204-02', 'approved', '1', 'read', '2019-06-19 00:17:59'),
(15, 'LCAF', '210510-6rfn4', 'approved', '1', 'unread', '2019-05-20 21:16:03'),
(16, 'LCAF', '210511-2lwma', 'approved', '1', 'unread', '2019-05-20 21:51:08'),
(17, 'IS', 'NA-0010', 'disapproved', '1', 'read', '2019-05-28 07:23:50'),
(18, 'IS', 'NA-0002', 'approved', '1', 'read', '2019-06-03 05:59:20'),
(19, 'LCAF', 'CA-210512', 'approved', '1', 'read', '2019-06-19 00:18:10'),
(21, 'LCAF', 'CA-310513', 'disapproved', '1', 'unread', '2019-05-30 22:40:02'),
(22, 'IS', 'NA-0012', 'approved', '1', 'unread', '2019-06-07 00:58:27'),
(23, 'LPF', '0806-07', 'approved', '1', 'read', '2019-06-20 03:24:41'),
(24, 'LCAF', 'CA-200615', 'approved', '1', 'unread', '2019-06-19 19:41:19');

-- --------------------------------------------------------

--
-- Table structure for table `owner_address`
--

DROP TABLE IF EXISTS `owner_address`;
CREATE TABLE IF NOT EXISTS `owner_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(50) NOT NULL,
  `baranggay` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `owner_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `owner_id` (`owner_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner_address`
--

INSERT INTO `owner_address` (`id`, `street`, `baranggay`, `town`, `province`, `owner_id`) VALUES
(1, 'Cogon', 'Bonbon', 'Calape', 'Bohol', '1'),
(2, 'Purok 2', 'Boctol', 'Corella', 'Bohol', '4'),
(3, 'Purok 3', 'Cogon', 'Tagbilaran City', 'Bohol', '5'),
(4, 'Purok 2', 'Pondol', 'Loon', 'Bohol', '8'),
(5, 'Purok 1', 'Bicahan', 'Catigbi-an', 'Bohol', '11'),
(6, 'Purok 4', 'Baucan Norte', 'Batuan', 'Bohol', '12'),
(7, 'Purok 3', 'Bitaugan', 'Sevilla', 'Bohol', '13'),
(8, 'ghjghj', 'hgjhgj', 'hjhgj', 'ghjghj', '16'),
(9, 'Purok 2', 'Hinawanan', 'Anda', 'Bohol', '17'),
(10, 'sdfds', 'dsfdsf', 'sdfdsf', 'sdfdsfdf', '18'),
(11, 'gfhgfh', 'fghgfh', 'fghfgh', 'fghfg', '19'),
(12, 'dfgdf', 'fgffg', 'dfgdf', 'dfgdf', '2'),
(13, 'Purok 1', 'Lawis', 'Calape', 'Bohol', '20'),
(14, 'Pandan', 'Alumar', 'Getafe', 'Bohol', '21'),
(15, 'sdfsd', 'sdfdsf', 'sdfds', 'sdfsdf', '22'),
(17, 'dsfdsf', 'sdfsd', 'dsfdsf', 'sdfsdfdf', '23'),
(18, 'gfhgf', 'ghgfh', 'fgh', 'fghhg', '26'),
(19, 'Purok 5', 'Catagbacan', 'Loon', 'Bohol', '29'),
(20, 'Purok 7', 'Liboron', 'Calape', ' Bohol', '30'),
(21, 'Sdf', 'Fsdfsd', 'Sdfds', 'Sdfsdf', '33'),
(23, 'Fdgfd', 'Gdfgfd', 'Dfgdfg', 'Dfgfd', '34'),
(24, 'Fghgfh', 'Fghgf', 'Fghfg', 'Fgh', '36'),
(25, 'Dfgdfg', 'Fdgfdg', 'Dfgfdg', 'Dfgdfg', '35'),
(26, 'Sdfdsf', 'Sdfdsf', 'Dsfsdf', 'Dsfdsf', '37'),
(27, 'Hjkhk', 'Hjkjhk', 'Hjkjhk', 'Jkjhkj', '38'),
(28, 'Fdgfd', 'Gdfg', 'Dfgfdg', 'Dfgfdg', '40');

-- --------------------------------------------------------

--
-- Table structure for table `owner_info`
--

DROP TABLE IF EXISTS `owner_info`;
CREATE TABLE IF NOT EXISTS `owner_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `vital_status` varchar(10) NOT NULL,
  `is_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `is_no` (`is_no`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner_info`
--

INSERT INTO `owner_info` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `vital_status`, `is_no`) VALUES
(1, 'Toring', 'Cabalang', 'Pacatang', 'Female', 'Alive', 'OA-0001'),
(2, 'John Mark', 'Degamo', 'Cabillo', 'Male', 'Alive', 'ESO-0001'),
(3, 'Mariano', 'Omania', 'Natuel', '', 'Alive', 'JSO-0001'),
(4, 'Teresita', 'Dumanig', 'Gadon', 'Female', 'Deceased', 'NA-0001'),
(5, 'Clarissa', 'Polinar', 'Caresosa', 'Female', 'Alive', 'NA-0002'),
(6, 'Apolo', 'Falar', 'Polinar', '', 'Deceased', 'JS-0001'),
(7, 'Amelia', 'Crusat', 'Mula', '', 'Alive', 'ES-0001'),
(8, 'Mark Josh', 'Balansag', 'Mejares', 'Male', 'Alive', 'NA-0003'),
(9, 'Pilang', 'Mandaguit', 'Lastimoza', '', 'Alive', 'JS-0002'),
(10, 'Lonsyano', 'Pacatang', 'Itang', '', 'Alive', 'ES-0002'),
(11, 'Atom', 'Tacatani', 'Aurellio', 'Male', 'Alive', 'NA-0004'),
(12, 'Ian', 'Sumaylo', 'Mendoza', 'Male', 'Alive', 'NA-0005'),
(13, 'Johnrey', 'Ahas ', 'Nietes', 'Male', 'Deceased', 'NA-0006'),
(14, 'Liza', 'Danao', 'Jaluag', '', 'Alive', 'JS-0003'),
(15, 'Mark', 'Isidro', 'Lantaca', '', 'Alive', 'ES-0003'),
(17, 'Lando', 'Kobayakawa', 'Sena', 'Male', 'Alive', 'NA-0007'),
(19, 'gfhgfh', 'gfhgfh', 'ghgfh', 'Male', 'Alive', 'NA-0008'),
(20, 'Duetoronemeo', 'Cabalang', 'Cuasito', 'Male', 'Deceased', 'OA-0002'),
(21, 'Erika', 'Sampinit', 'Cua', 'Female', 'Alive', 'NA-0009'),
(23, 'sdfds', 'fsdfsdf', 'dfdsf', 'Male', 'Alive', 'NA-0010'),
(29, 'Jocres', 'Sociduag', 'Gaudicos', 'Male', 'Alive', 'NA-0011'),
(30, 'Mary Grace', 'Salunman', 'Perez', 'Female', 'Alive', 'NA-0012'),
(31, 'Melecia', 'Asuncion', 'Bonifacio', '', 'Alive', 'JS-0004'),
(32, 'Marthina', 'Linda', 'Schauenberg', '', 'Alive', 'ES-0004'),
(36, 'Gfhgfh', 'Gfhfgh', 'Fghgfh', 'Male', 'Alive', 'OA-0003');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

DROP TABLE IF EXISTS `payment_requests`;
CREATE TABLE IF NOT EXISTS `payment_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL,
  `reference_no` varchar(20) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `other_purpose` varchar(200) NOT NULL,
  `status` varchar(15) NOT NULL,
  `date_requested` date NOT NULL,
  `date_reviewed` date NOT NULL,
  `lpf_no` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_requests`
--

INSERT INTO `payment_requests` (`id`, `type`, `reference_no`, `amount`, `purpose`, `other_purpose`, `status`, `date_requested`, `date_reviewed`, `lpf_no`) VALUES
(1, 'cash advance', '22041-jjoi7', 150000.00, 'Affidavit of Surrender of Landholdings, Capital Gains Tax, ', '', 'Payed', '2019-04-22', '2019-04-23', '1704-01'),
(2, 'cash advance', '23042-avkfb', 800000.00, 'Capital Gains Tax, Estate Tax, ', '', 'Payed', '2019-04-23', '2019-04-23', '2304-03'),
(3, 'cash advance', '23043-ljlfx', 500000.00, 'Personal, Documentary Stamp Tax, ', '', 'Payed', '2019-04-23', '2019-04-23', '2304-04'),
(4, 'cash advance', '24044-566kz', 20000.00, 'Affidavit of Surrender of Landholdings, Real Property Tax, ', '', 'Payed', '2019-04-29', '2019-04-29', '2304-03'),
(5, 'cash advance', '24045-fznvm', 80000.00, 'Affidavit of Surrender of Landholdings, Estate Tax, Notary Fee, ', '', 'Payed', '2019-04-24', '2019-05-16', '1704-01'),
(6, 'cash advance', '25046-xe6p6', 50000.00, 'Affidavit of Surrender of Landholdings, Capital Gains Tax, ', '', 'Payed', '2019-04-25', '2019-05-08', '2304-04'),
(7, 'cash advance', '29047-vcfmh', 5000.00, 'Estate Tax, ', '', 'Approved', '2019-04-29', '2019-04-29', '2304-03'),
(10, 'cash advance', '210510-6rfn4', 50000.00, 'Real Property Tax, Documentary Stamp Tax, ', '', 'Payed', '2019-05-21', '2019-05-21', '2204-02'),
(11, 'cash advance', '210511-2lwma', 10000.00, 'Capital Gains Tax, Estate Tax, ', '', 'Payed', '2019-05-21', '2019-05-21', '2204-02'),
(12, 'cash advance', 'CA-210512', 150000.00, 'Estate Tax, Notary Fee, ', '', 'Payed', '2019-05-21', '2019-05-23', '2204-02'),
(13, 'cash advance', 'CA-310513', 20000.00, 'Estate Tax, Notary Fee, ', '', 'Disapproved', '2019-05-31', '2019-05-31', '1704-01'),
(14, 'cash advance', 'CA-310514', 15000.00, 'Estate Tax, Notary Fee, ', '', 'Pending', '2019-05-31', '0000-00-00', '2304-04'),
(15, 'cash advance', 'CA-200615', 350000.00, '', 'Cash Advance', 'Approved', '2019-06-20', '2019-06-20', '0806-07');

-- --------------------------------------------------------

--
-- Table structure for table `real_property_tax`
--

DROP TABLE IF EXISTS `real_property_tax`;
CREATE TABLE IF NOT EXISTS `real_property_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rpt_file` varchar(210) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `aslvl` float(10,2) NOT NULL,
  `year_paid` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  `is_no` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `real_property_tax`
--

INSERT INTO `real_property_tax` (`id`, `rpt_file`, `amount`, `aslvl`, `year_paid`, `status`, `is_no`) VALUES
(1, 'Property-Tax-Payment-3.jpg', 4515.00, 15.00, '2019-05-01', 'Paid', 'NA-0001');

-- --------------------------------------------------------

--
-- Table structure for table `restrictions_to_land_title`
--

DROP TABLE IF EXISTS `restrictions_to_land_title`;
CREATE TABLE IF NOT EXISTS `restrictions_to_land_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liens` varchar(500) NOT NULL,
  `easement` varchar(500) NOT NULL,
  `encumbrances` varchar(500) NOT NULL,
  `is_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `is_no` (`is_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_documents`
--

DROP TABLE IF EXISTS `uploaded_documents`;
CREATE TABLE IF NOT EXISTS `uploaded_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_title` varchar(210) NOT NULL,
  `latest_tax_dec` varchar(210) NOT NULL,
  `land_sketch` varchar(210) NOT NULL,
  `brgy_resolution` varchar(210) NOT NULL,
  `instrument` varchar(210) NOT NULL,
  `tct` varchar(210) NOT NULL,
  `oct` varchar(210) NOT NULL,
  `doas` varchar(210) NOT NULL,
  `is_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `is_no` (`is_no`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploaded_documents`
--

INSERT INTO `uploaded_documents` (`id`, `land_title`, `latest_tax_dec`, `land_sketch`, `brgy_resolution`, `instrument`, `tct`, `oct`, `doas`, `is_no`) VALUES
(1, '', '', '', '', '', '', '', '', 'OA-0001'),
(2, '', '', '', '', '', 'TCT.jpg', '', '', 'ESO-0001'),
(3, '', '', '', '', '', '', 'tct2.jpg', '', 'JSO-0001'),
(4, 'Philippine_land_title.jpg', '', 'master plan land sketch.jpg', '', '', '', '', '', 'NA-0001'),
(5, 'Land-Title-Philippines.png', '', '3cebdb01952533129c018f6999ae9690.jpg', '', '', '', '', '', 'NA-0002'),
(6, 'Land-Title-Philippines.png', '', '', '', '', 'TCT3.jpg', '', '', 'JS-0001'),
(7, '', '', '', '', '', '', 'TCT.jpg', '', 'ES-0001'),
(8, 'Land-Title-Philippines.png', '', '120616_BritishLibrary_Unwin_HampsteadGdnSuburb_02S.jpg', 'images (1).jpg', '', '', '', '', 'NA-0003'),
(9, '', '', '', '', '', '', 'tct1.jpg', '', 'JS-0002'),
(10, '', '', '', '', '', 'Doc 011.jpg', '', '', 'ES-0002'),
(11, 'TCT3.jpg', '', 'b108ffa6beb69f1dd479a63e53f135f6.jpg', '', '', '', '', '', 'NA-0004'),
(12, 'TCT.jpg', '', 'WuImg.JPG', 'images (1).jpg', '', '', '', '', 'NA-0005'),
(13, 'Doc 011.jpg', '', 'contribution-of-eminent-town-planner-15-638.jpg', '', '', '', '', '', 'NA-0006'),
(14, '', '', '', '', '', 'Doc 011.jpg', '', '', 'JS-0003'),
(15, '', '', '', '', '', '', 'Philippine_land_title.jpg', '', 'ES-0003'),
(17, 'TCT.jpg', '', 'WuImg.JPG', 'town_tn.jpg', '', '', '', '', 'NA-0007'),
(19, '', 'master plan land sketch.jpg', 'sketch1.jpg', '', '', '', '', '', 'NA-0008'),
(20, 'sample-tct.jpg', 'realestate_25.jpg', '3cebdb01952533129c018f6999ae9690.jpg', 'town_tn.jpg', 'deed of absolute sale.jpg', 'TCT.jpg', '', '', 'OA-0002'),
(21, 'tct1.jpg', '', '120616_BritishLibrary_Unwin_HampsteadGdnSuburb_02S.jpg', 'images.jpg', '', '', '', '', 'NA-0009'),
(23, 'tct1.jpg', '', 'TCT3.jpg', '', '', '', '', '', 'NA-0010'),
(25, 'sample-tct.jpg', '', 'images.jpg', 'b108ffa6beb69f1dd479a63e53f135f6.jpg', '', '', '', '', 'NA-0011'),
(26, '', 'Declaration-of-Real-Property-Sample-front.jpg', 'contribution-of-eminent-town-planner-15-638.jpg', '', '', '', '', '', 'NA-0012'),
(27, '', '', '', '', '', '', 'TCT3.jpg', '', 'JS-0004'),
(28, '', '', '', '', '', 'TCT.jpg', '', '', 'ES-0004'),
(31, '', '', '', '', '', '', '', '', 'OA-0003');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) NOT NULL,
  `image` varchar(210) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `position` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `logged` varchar(10) NOT NULL,
  `time_active` varchar(50) NOT NULL,
  `last_login` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `image`, `firstname`, `lastname`, `position`, `username`, `password`, `logged`, `time_active`, `last_login`) VALUES
(1, 'Secretary', '68b9ce1dae8b63706732d0bc827c833d.jpeg', 'Saturnina', 'Bomediano', 'Atty\'s. Secretary', 'Saturnina', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Oct-29-2019 03:33:07', 'Oct-29-2019 03:31:34'),
(2, 'Administrator', '', 'null', 'user', 'anonymous', 'admin', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Jun-04-2019 09:16:30', 'Jun-04-2019 09:16:26'),
(3, 'GM', 'img_avatar3.png', 'Marlito', 'Uy', 'General Manager', 'GM', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Oct-29-2019 03:51:59', 'Oct-29-2019 03:33:59'),
(4, 'Legal', '', 'Cecile', 'Abrea', 'CEO', 'Legal', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Jun-20-2019 10:21:23', 'Jun-20-2019 10:20:26'),
(8, 'CCD', '', 'Jennelyn', 'Anunciado', 'Section Head', 'ccd', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Jun-20-2019 10:20:11', 'Jun-20-2019 10:19:58'),
(9, 'Accounting', '', 'Cristine', 'Hamoay', 'Section Head', 'accounting', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Jun-20-2019 07:16:03', 'Jun-20-2019 07:15:56'),
(11, 'CCD', '', 'Lea', 'Vistal', 'Sr. Supervisor', 'Lea', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Mar-06-2019 15:45:17', 'Mar-06-2019 15:45:08'),
(13, 'Legal', '', 'Noel', 'Pondias', 'Jr.Auditor', 'personnel', '939c8cb9652387cbf08aa41441db95238dbfcc6f0da181d9749f80c1908dfcfbcf6765d58f26bb27e53ac1d3cb564bf49ddee23b7f74519d28eb133450717635gqzS/lPsF+NKqNsiiI5MgVwSqCLtz3baNjERcb/mXjE=', 'false', 'Jan-21-2019 16:22:31', 'Jan-21-2019 15:53:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
