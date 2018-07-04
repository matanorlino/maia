-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2018 at 05:02 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kit_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lesson_files_tbl`
--

CREATE TABLE `lesson_files_tbl` (
  `rowId` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `ppt_id` int(11) NOT NULL,
  `pdf_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_tbl`
--

CREATE TABLE `lesson_tbl` (
  `rowID` int(11) NOT NULL,
  `lesson_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `lesson_desc` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `lesson_code` varchar(20) COLLATE latin1_general_cs NOT NULL,
  `lesson_img_path` text COLLATE latin1_general_cs NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `isRemoved` int(11) NOT NULL DEFAULT '0',
  `isDeleted` int(11) NOT NULL DEFAULT '0',
  `delPermanent` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `module_lesson_tbl`
--

CREATE TABLE `module_lesson_tbl` (
  `rowID` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `isLinked` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `module_tbl`
--

CREATE TABLE `module_tbl` (
  `rowID` int(11) NOT NULL,
  `mod_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `mod_desc` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `mod_day` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `mod_img_path` text COLLATE latin1_general_cs NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `delPermanent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_tbl`
--

CREATE TABLE `pdf_tbl` (
  `rowId` int(11) NOT NULL,
  `file_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `file_path` text COLLATE latin1_general_cs NOT NULL,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `ppt_tbl`
--

CREATE TABLE `ppt_tbl` (
  `rowId` int(11) NOT NULL,
  `file_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `file_path` text COLLATE latin1_general_cs NOT NULL,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_tbl`
--

CREATE TABLE `quiz_tbl` (
  `rowID` int(11) NOT NULL,
  `quiz_name` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `quiz_code` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `quiz_answer` text COLLATE latin1_general_cs NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `isDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `to_do_tbl`
--

CREATE TABLE `to_do_tbl` (
  `rowID` int(11) NOT NULL,
  `todo_desc` text COLLATE latin1_general_cs NOT NULL,
  `isChecked` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `rowID` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `middlename` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `lastname` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `username` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `password` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`rowID`, `firstname`, `middlename`, `lastname`, `username`, `password`) VALUES
(1, 'DEMO', 'D', 'DEMO', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229');

-- --------------------------------------------------------

--
-- Table structure for table `video_tbl`
--

CREATE TABLE `video_tbl` (
  `rowId` int(11) NOT NULL,
  `file_name` text COLLATE latin1_general_cs NOT NULL,
  `file_path` text COLLATE latin1_general_cs NOT NULL,
  `created_by` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lesson_files_tbl`
--
ALTER TABLE `lesson_files_tbl`
  ADD PRIMARY KEY (`rowId`);

--
-- Indexes for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `module_lesson_tbl`
--
ALTER TABLE `module_lesson_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `module_tbl`
--
ALTER TABLE `module_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `pdf_tbl`
--
ALTER TABLE `pdf_tbl`
  ADD PRIMARY KEY (`rowId`);

--
-- Indexes for table `ppt_tbl`
--
ALTER TABLE `ppt_tbl`
  ADD PRIMARY KEY (`rowId`);

--
-- Indexes for table `quiz_tbl`
--
ALTER TABLE `quiz_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `to_do_tbl`
--
ALTER TABLE `to_do_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`rowID`);

--
-- Indexes for table `video_tbl`
--
ALTER TABLE `video_tbl`
  ADD PRIMARY KEY (`rowId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lesson_files_tbl`
--
ALTER TABLE `lesson_files_tbl`
  MODIFY `rowId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lesson_tbl`
--
ALTER TABLE `lesson_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module_lesson_tbl`
--
ALTER TABLE `module_lesson_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module_tbl`
--
ALTER TABLE `module_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pdf_tbl`
--
ALTER TABLE `pdf_tbl`
  MODIFY `rowId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ppt_tbl`
--
ALTER TABLE `ppt_tbl`
  MODIFY `rowId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_tbl`
--
ALTER TABLE `quiz_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `to_do_tbl`
--
ALTER TABLE `to_do_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `rowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `video_tbl`
--
ALTER TABLE `video_tbl`
  MODIFY `rowId` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
