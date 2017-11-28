-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2017 at 10:13 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(11) NOT NULL COMMENT 'diagnosis id',
  `patient_id` int(11) NOT NULL COMMENT 'patient id',
  `time` int(11) NOT NULL COMMENT 'diagnosis time',
  `diagnosis` text COMMENT 'diagnosis',
  `clinical_representation` text COMMENT 'clinical representation',
  `stage` int(4) DEFAULT NULL COMMENT 'disease stage',
  `cytological_diagnosis` text COMMENT 'cytological diagnosis',
  `pathologic_diagnosis` text COMMENT 'pathologic diagnosis',
  `immunology_diagnosis` text COMMENT 'immunology diagnosis',
  `cytogenetical_diagnosis` text COMMENT 'cytogenetical diagnosis',
  `molecular_biology_diagnosis` text COMMENT 'molecular biology diganosis',
  `genetic_diagnosis` text COMMENT 'gene diagnosis',
  `other_diagnosis` text COMMENT 'other diagnosis',
  `comment` text COMMENT 'comment',
  `create_time` int(11) NOT NULL COMMENT 'diagnosis create time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `patient_id`, `time`, `diagnosis`, `clinical_representation`, `stage`, `cytological_diagnosis`, `pathologic_diagnosis`, `immunology_diagnosis`, `cytogenetical_diagnosis`, `molecular_biology_diagnosis`, `genetic_diagnosis`, `other_diagnosis`, `comment`, `create_time`) VALUES
(9, 8, 1508989860, 'def', 'abc', 1, '', '', '', '', '', '', 'abc', 'sg', 1508989920),
(12, 9, 1510036440, 'xxx', 'xxx', 1, '', '', '', '', '', '', '', '', 1510036448),
(13, 13, 1510036440, 'xx', 'xxx', 1, '', '', '', '', '', '', '', '', 1510036463),
(14, 8, 1510283280, 'sss', 'sss', 1, '', '', '', '', '', '', '', '', 1510283289),
(15, 14, 1510901400, 'yy', 'xx', 1, '', '', '', '', '', '', '', '', 1510901453),
(16, 15, 1510902240, 'xxxx', 'xx', 1, '', '', '', '', '', '', '', '', 1510902251);

-- --------------------------------------------------------

--
-- Table structure for table `experiment`
--

CREATE TABLE `experiment` (
  `id` int(11) NOT NULL COMMENT 'experiment id',
  `sample_id` int(11) NOT NULL COMMENT 'sample id',
  `experiment_type` varchar(255) NOT NULL COMMENT 'experiment type',
  `note` text COMMENT 'experiment note',
  `library` text COMMENT 'library information',
  `comment` text COMMENT ' comment',
  `create_time` int(11) NOT NULL COMMENT 'record create time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experiment`
--

INSERT INTO `experiment` (`id`, `sample_id`, `experiment_type`, `note`, `library`, `comment`, `create_time`) VALUES
(1, 2, 'DNA', 'notes', 'library', 'comments', 1510557199),
(2, 3, 'DNA', 'xyz', 'abc', 'comment', 1510643863),
(5, 4, 'DNA', 'xxsfsd', 'sfsdfs', 'sfdsf', 1510714859),
(6, 2, 'cDNA', 'fsdsd', 'fsdfds', 'comment', 1510714890),
(7, 7, 'cDNA', 'xxx', 'xxx', '', 1510902994);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL COMMENT 'patient id',
  `name` varchar(255) NOT NULL COMMENT 'patient name',
  `sex` tinyint(4) DEFAULT NULL COMMENT 'patient gender',
  `age` int(4) DEFAULT NULL COMMENT 'patient age',
  `diagnosis_count` int(11) NOT NULL DEFAULT '0' COMMENT 'diagnosis count',
  `sample_count` int(11) NOT NULL DEFAULT '0' COMMENT 'sample count',
  `hospital_id` varchar(255) DEFAULT NULL COMMENT 'hospital id',
  `department_id` varchar(255) DEFAULT NULL COMMENT 'department id',
  `diagnosis` text COMMENT 'diagnosis',
  `primary_site` text COMMENT 'primary site',
  `involved_site` text COMMENT 'involved site',
  `transplate` int(4) DEFAULT NULL COMMENT 'transplate type',
  `onset_time` int(11) DEFAULT NULL COMMENT 'onset time',
  `death_time` int(11) DEFAULT NULL COMMENT 'death time',
  `comment` text COMMENT 'patient comments',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT 'patient creat time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `sex`, `age`, `diagnosis_count`, `sample_count`, `hospital_id`, `department_id`, `diagnosis`, `primary_site`, `involved_site`, `transplate`, `onset_time`, `death_time`, `comment`, `create_time`) VALUES
(8, '张三', 1, 20, 2, 1, 'xxxx', 'xxxx', '白血病', '肝脏', '脾脏', 1, 1484795640, 1484795640, '张三备注信息', 1506330578),
(9, '李四', 1, 28, 1, 1, '', '', '', '', '', 2, 0, 0, '', 1506332698),
(13, '王五', 1, 20, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '王五备注', 1506481260),
(14, 'abc', 0, 12, 1, 0, '', '', '', '', '', 0, 0, 0, '', 1510887160),
(15, 'def', 0, 34, 1, 0, '', '', '', '', '', 0, 0, 0, '', 1510887169),
(16, 'xyz', 0, 13, 0, 1, '', '', '', '', '', 0, 0, 0, '', 1510887179),
(17, 'kksks', 0, 10, 0, 0, '', '', '', '', '', 0, 0, 0, '', 1510887188),
(18, 'xkxkksdjfsd', 0, 23, 0, 0, '', '', '', '', '', 0, 0, 0, '', 1510887200),
(19, 'who', 0, 30, 0, 1, '', '', '', '', '', 0, 0, 0, '', 1510887208),
(20, 'per', 0, 30, 0, 0, '', '', '', '', '', 0, 0, 0, '', 1510887217),
(21, 'ker', 0, 29, 0, 0, '', '', '', '', '', 0, 0, 0, '', 1510887226);

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id` int(11) NOT NULL COMMENT 'sample id',
  `patient_id` int(11) NOT NULL COMMENT 'patient id',
  `sample_time` int(11) NOT NULL COMMENT 'sample time',
  `tissue` varchar(255) NOT NULL COMMENT 'sample tissue',
  `type` varchar(255) NOT NULL COMMENT 'sample type',
  `amount` varchar(255) DEFAULT NULL COMMENT 'sample amount',
  `location` varchar(255) DEFAULT NULL COMMENT 'sample store location',
  `comment` text COMMENT 'record create time',
  `experiment_count` int(11) DEFAULT '0' COMMENT 'experiment count',
  `create_time` int(11) NOT NULL COMMENT 'record create time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id`, `patient_id`, `sample_time`, `tissue`, `type`, `amount`, `location`, `comment`, `experiment_count`, `create_time`) VALUES
(2, 8, 1510129320, '尿液', '血浆', '1.2ml', 'a.12', 'xyz', 2, 1510129381),
(3, 9, 1510281360, '尿液', '血浆', '123ml', 'c.12', 'abc', 1, 1510281409),
(4, 13, 1510281900, '便', '肿物', '4.5l', 'c.53', 'comment', 1, 1510281930),
(5, 13, 1510281900, '外周血', '血浆', '1.0ml', 'x.12', 'kxkxk', 0, 1510281955),
(6, 16, 1510902540, '尿液', '血浆', '', '', '', 0, 1510902555),
(7, 19, 1510902540, '外周血', '血浆', '', '', '', 1, 1510902571);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL COMMENT 'user id',
  `name` varchar(255) NOT NULL COMMENT 'user name',
  `password` varchar(255) NOT NULL COMMENT 'user password',
  `email` varchar(255) NOT NULL COMMENT 'user email',
  `role` tinyint(4) NOT NULL DEFAULT '10' COMMENT 'user role',
  `title` varchar(255) DEFAULT NULL COMMENT 'user title',
  `phone` varchar(255) DEFAULT NULL COMMENT 'user telphone',
  `office` varchar(255) DEFAULT NULL COMMENT 'user office',
  `create_time` int(11) NOT NULL COMMENT 'create time',
  `comment` text COMMENT 'comment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `role`, `title`, `phone`, `office`, `create_time`, `comment`) VALUES
(2, 'admin', '3fde6bb0541387e4ebdadf7c2ff31123', 'admin@123.com', 10, '', '', '', 1511850745, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiment`
--
ALTER TABLE `experiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'diagnosis id', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `experiment`
--
ALTER TABLE `experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'experiment id', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'patient id', AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'sample id', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'user id', AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
