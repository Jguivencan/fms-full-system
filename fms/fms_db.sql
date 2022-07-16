-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 08:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `description`, `user_id`, `folder_id`, `file_type`, `file_path`, `is_public`, `date_updated`) VALUES
(1, 'sample pdf file', 'Sample file uploaded', 1, 1, 'pdf', '1600320360_1600314660_sample.pdf', 1, '2020-09-17 16:22:26'),
(3, 'sample', 'Sample PDF Document', 3, 9, 'pdf', '1600330200_sample.pdf', 0, '2020-09-17 16:10:25'),
(5, 'Untitled design (1)', 'try lang na files\r\n', 1, 12, 'png', '1654321740_Untitled design (1).png', 0, '2022-06-04 14:00:24'),
(6, 'LIT', '', 1, 12, 'docx', '1654321800_LITERATURE.docx', 0, '2022-06-04 13:57:54'),
(7, '1-Team-Roles-and-Responsibilities', 'try', 1, 0, 'pdf', '1654484340_1-Team-Roles-and-Responsibilities.pdf', 1, '2022-06-06 10:59:05'),
(10, 'Jannelle Guivencan - Supervise Work-Based Training_no', '', 11, 0, 'pdf', '1654919640_Jannelle Guivencan - Supervise Work-Based Training_no.pdf', 0, '2022-06-11 11:54:55'),
(11, 'TNA_Dependable', '', 11, 20, 'xlsx', '1654920180_TNA_Dependable.xlsx', 0, '2022-06-11 12:03:10'),
(12, 'SWEETEUR-ADS1', '', 11, 0, 'mp4', '1654920180_SWEETEUR-ADS.mp4', 0, '2022-06-11 12:06:01'),
(14, 'Andantino (Piano and Violin)', '', 11, 20, 'mp3', '1654920960_Andantino (Piano and Violin).mp3', 0, '2022-06-11 12:16:30'),
(15, 'Johann Sebastian Bach-Air on G String', '', 11, 0, 'mp3', '1654928100_Johann Sebastian Bach-Air on G String.mp3', 0, '2022-06-11 14:15:39'),
(16, 'Telemann - Viola Concerto in G major TWV51G9 Largo (14)', '', 11, 21, 'mp3', '1654930200_Telemann - Viola Concerto in G major TWV51G9 Largo (14).mp3', 0, '2022-06-11 14:50:23'),
(17, 'letter', '', 11, 0, 'docx', '1655013480_letter.docx', 0, '2022-06-12 13:58:45'),
(18, 'TNA_Dependable', '', 11, 21, 'xlsx', '1655013540_TNA_Dependable.xlsx', 0, '2022-06-12 13:59:00'),
(19, '1-Team-Roles-and-Responsibilities ||1', 'updated\r\n', 13, 0, 'pdf', '1656243000_1-Team-Roles-and-Responsibilities.pdf', 0, '2022-07-03 11:38:59'),
(20, 'mockrocket-capture', '', 13, 23, 'png', '1656243060_mockrocket-capture.png', 0, '2022-06-26 19:31:20'),
(22, 'Jannelle Guivencan ', '', 14, 0, 'pdf', '1656745860_Jannelle Guivencan - Supervise Work-Based Training_no.pdf', 0, '2022-07-03 11:02:05'),
(24, 'Training-Plan_GUIVENCAN', '', 14, 0, 'pdf', '1656750240_Training-Plan_GUIVENCAN.pdf', 0, '2022-07-02 16:24:07'),
(25, 'Jannelle Guivencan - Supervise Work-Based Training_no', '', 14, 24, 'pdf', '1656751740_Jannelle Guivencan - Supervise Work-Based Training_no.pdf', 0, '2022-07-02 16:49:15'),
(26, 'work immersion presentation', '', 14, 0, 'pptx', '1656816780_work immersion presentation.pptx', 0, '2022-07-03 10:53:13'),
(28, 'TNA_Dependable', 'updated na po itong file ', 13, 0, 'xlsx', '1656819840_TNA_Dependable.xlsx', 0, '2022-07-03 11:44:56'),
(29, 'GUIVENCAN-Company', 'completed', 14, 0, 'docx', '1656820080_GUIVENCAN-Company.docx', 0, '2022-07-03 11:49:33'),
(30, 'GUIVENCAN-School-head', 'completed file\r\n', 14, 0, 'docx', '1656820200_GUIVENCAN-School-head.docx', 0, '2022-07-03 11:51:10'),
(31, '1', 'on progress', 14, 0, 'jpg', '1656820380_1.jpg', 0, '2022-07-03 11:53:20'),
(32, 'd3', 'completed', 14, 0, 'jpg', '1656820560_d3.jpg', 0, '2022-07-03 11:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `parent_id`) VALUES
(1, 1, 'Sample Folder', 0),
(3, 1, 'Sample Folder 3', 0),
(5, 1, 'Sample Folder 4', 0),
(6, 1, 'New Folder', 1),
(7, 1, 'Folder 1', 1),
(8, 1, 'test folder', 7),
(9, 3, 'My Folder 1', 0),
(12, 1, 'Documents', 0),
(13, 1, 'Pictures', 0),
(14, 1, 'Videos', 0),
(16, 4, 'Documents', 0),
(17, 4, 'Pictures', 0),
(18, 4, 'Videos', 0),
(20, 11, 'jah', 0),
(21, 11, 'school', 0),
(22, 11, 'TEST', 0),
(23, 13, 'school', 0),
(24, 14, 'DOCSS-1', 0),
(25, 14, 'jah', 24);

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `id` int(10) NOT NULL,
  `user_id` int(30) NOT NULL,
  `file_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `share`
--

INSERT INTO `share` (`id`, `user_id`, `file_id`) VALUES
(1, 1, 19),
(2, 2, 19),
(3, 13, 26),
(4, 14, 19),
(5, 14, 20),
(6, 14, 28),
(7, 13, 29),
(8, 13, 30),
(9, 13, 31),
(10, 13, 32);

-- --------------------------------------------------------

--
-- Table structure for table `trashbin`
--

CREATE TABLE `trashbin` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin123'),
(2, 'Try', 'user@gmail.com', 'user123'),
(5, 'Testing', 'testing@gmail.com', 'testing123'),
(6, 'Rayven', 'rayvenponce@gmail.com', 'password123'),
(7, 'Trisha', 'trishasimon@gmail.com', 'trisha123'),
(8, 'Marc', 'marc@gmail.com', 'marc123'),
(9, 'Rayven', 'rayvenponce@gmail.com', 'password123'),
(10, 'Marc Rayven', 'marcrayven@gmail.com', 'marcrayven123'),
(11, 'jah', 'jahnel@gmail.com', 'jah123'),
(12, 'jah', 'jahnel1@gmail.com', 'jah123'),
(13, 'Jannelle Guivencan', 'kidd@gmail.com', 'kidd123'),
(14, 'loevi', 'loevi@gmail.com', 'loevi123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `file_id` (`file_id`);

--
-- Indexes for table `trashbin`
--
ALTER TABLE `trashbin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trashbin`
--
ALTER TABLE `trashbin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `share_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `share_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
