-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 01:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `price` float NOT NULL,
  `date` date DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `game_logo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `title`, `description`, `price`, `date`, `publisher`, `game_logo`) VALUES
(10001, 'The Legend of Zelda: Breath of the Wild', 'An open-world action-adventure game where players explore the vast kingdom of Hyrule and battle against the evil Calamity Ganon. Features a rich storyline and innovative gameplay mechanics.', 59.99, '2017-03-03', 'Nintendo', NULL),
(10002, 'The Witcher 3: Wild Hunt', 'A story-driven RPG set in a visually stunning fantasy universe full of meaningful choices and impactful consequences. Players take on the role of Geralt of Rivia, a monster hunter searching for his adopted daughter.', 39.99, '2015-05-19', 'CD Projekt', NULL),
(10003, 'Red Dead Redemption 2', 'An epic tale of life in America at the dawn of the modern age. The game features a vast and atmospheric world, providing the foundation for a brand new online multiplayer experience.', 59.99, '2018-10-26', 'Rockstar Games', NULL),
(10004, 'Minecraft', 'A sandbox game that allows players to build and explore their own worlds. Features multiple game modes including survival, creative, and adventure, with endless possibilities for creativity and exploration.', 26.95, '2011-11-18', 'Mojang Studios', NULL),
(10005, 'Cyberpunk 2077', 'An open-world, action-adventure story set in Night City, a megalopolis obsessed with power, glamour, and body modification. Players assume the role of V, a mercenary outlaw going after a one-of-a-kind implant that is the key to immortality.', 59.99, '2020-12-10', 'CD Projekt', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usergames`
--

CREATE TABLE `usergames` (
  `usergamesID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `gameID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usergames`
--

INSERT INTO `usergames` (`usergamesID`, `userID`, `gameID`) VALUES
(0, 4, 10001),
(1, 4, 10003);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`) VALUES
(1, 'gamermigs56', 'iloveroblocks123', 'roblox4layf@gmail.com'),
(2, 'bob_jones', 'bob_password', 'bob.jones@example.com'),
(3, 'emma_wilson', 'emma_password', 'emma.wilson@example.com'),
(4, '[boogeyman123', 'goofyahh123', 'sillyahh@gmail.com');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_insert_users` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO usergames (userID)
    VALUES (NEW.user_id);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `usergames`
--
ALTER TABLE `usergames`
  ADD PRIMARY KEY (`usergamesID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user-name` (`user_name`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usergames`
--
ALTER TABLE `usergames`
  ADD CONSTRAINT `usergames_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
