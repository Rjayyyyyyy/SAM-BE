-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 08:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corememories`
--

-- --------------------------------------------------------

--
-- Table structure for table `islandcontents`
--

CREATE TABLE `islandcontents` (
  `islandContentID` int(4) NOT NULL,
  `islandOfPersonalityID` int(4) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandcontents`
--

INSERT INTO `islandcontents` (`islandContentID`, `islandOfPersonalityID`, `image`, `content`, `color`) VALUES
(1, 1, 'image/family.png', 'Spending quality time during family vacations.', NULL),
(2, 1, 'image/family.png', 'Celebrating special occasions with loved ones.', NULL),
(3, 1, 'image/family.png', 'Sunday lunch gatherings at grandma’s house.', NULL),
(4, 2, 'image/friends.png', 'Laughing together during late-night talks.', NULL),
(5, 2, NULL, 'Exploring new places with my best friends.', NULL),
(6, 2, NULL, 'Making unforgettable memories at school.', NULL),
(7, 3, NULL, 'Reaching the summit after a challenging hike.', NULL),
(8, 3, NULL, 'Sleeping under the stars during a camping trip.', NULL),
(9, 3, NULL, 'Driving along scenic routes on a road trip', NULL),
(10, 4, NULL, 'Winning my first basketball game', NULL),
(11, 4, NULL, 'Training hard for a marathon', NULL),
(12, 4, NULL, 'Playing basketball with the team every weekend', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `islandsofpersonality`
--

CREATE TABLE `islandsofpersonality` (
  `islandOfPersonalityID` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `shortDescription` varchar(300) DEFAULT NULL,
  `longDescription` varchar(900) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandsofpersonality`
--

INSERT INTO `islandsofpersonality` (`islandOfPersonalityID`, `name`, `shortDescription`, `longDescription`, `color`, `image`, `status`) VALUES
(1, 'Family', 'A beautiful family moment captured in time.', 'Family Island is a serene and picturesque destination that captures the essence of family moments.', '#f0f8ff', 'family.png', 'active'),
(2, 'Friends', 'Enjoying good times with great friends.', 'Friends Island is a vibrant and lively destination where you can enjoy good times with great friends.', '#ffe4e1', 'friends.png', 'active'),
(3, 'Adventure', 'Exploring new places and creating memories.', 'Adventure Island is the ultimate destination for those who love exploring new places and creating unforgettable memories.', '#ffebcd', 'adventure.png', 'active'),
(4, 'Sports', 'Engaging in thrilling sports activities.', 'Sports Island is a dynamic and energetic destination where you can engage in thrilling sports activities.', '#add8e6', 'sports.png', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `islandcontents`
--
ALTER TABLE `islandcontents`
  ADD PRIMARY KEY (`islandContentID`);

--
-- Indexes for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  ADD PRIMARY KEY (`islandOfPersonalityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `islandcontents`
--
ALTER TABLE `islandcontents`
  MODIFY `islandContentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  MODIFY `islandOfPersonalityID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
