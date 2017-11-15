-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2017 at 10:12 AM
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'diagnosis id', AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `experiment`
--
ALTER TABLE `experiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'experiment id', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'patient id', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'sample id', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
