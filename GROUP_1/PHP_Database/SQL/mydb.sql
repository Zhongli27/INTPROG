-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 01:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('', NULL),
('guest', 'abc123'),
('kali', 'kali'),
('manager', 'secret');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `coursera` varchar(255) DEFAULT NULL,
  `udemy` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `age`, `birthday`, `address`, `facebook`, `github`, `coursera`, `udemy`, `linkedin`, `description`, `image_path`) VALUES
(13, 'Carl Angelo Recodig', 21, '2003-04-13', 'Emerald Hills Victoria Muntinlupa City', 'https://www.facebook.com/', 'https://github.com/', 'https://www.coursera.org/courseraplus/special/global-thirty-2024?utm_source=gg&utm_medium=sem&utm_campaign=b2c_apac_coursera-plus_coursera_ftcof_subscription_arte_jan-24_dr_geo-set-2-multi_sem_rsa_gads_lg-all&utm_content=b2c&campaignid=20989858741&adgroup', 'https://www.udemy.com/?utm_source=adwords-brand&utm_medium=udemyads&utm_campaign=Brand-Udemy_la.EN_cc.ROW&campaigntype=Search&portfolio=BrandDirect&language=EN&product=Course&test=&audience=Keyword&topic=&priority=&utm_content=deal4584&utm_term=_._ag_8031', 'https://www.linkedin.com/login', 'lorem ipsum dolor sit amit', 'image/Carl.jpg'),
(17, 'Ian Jay Estubio', 28, '1996-02-11', 'Sucat Muntinlupa City', 'https://www.facebook.com/profile.php?id=100038661706600&mibextid=ZbWKwL', 'https://github.com/Zhongli27', 'https://www.coursera.org/courseraplus/special/global-thirty-2024?utm_source=gg&utm_medium=sem&utm_campaign=b2c_apac_coursera-plus_coursera_ftcof_subscription_arte_jan-24_dr_geo-set-2-multi_sem_rsa_gads_lg-all&utm_content=b2c&campaignid=20989858741&adgroup', 'https://www.udemy.com/user/ian-jay-estubio/', 'https://www.linkedin.com/login', 'lorem ipsum dolor sit amit', 'image/ian_jay.jpg'),
(18, 'Lemuel Doblada', 20, '2004-11-08', 'Blk 6 Lot 10 Jarger Home Owner Bayanan', 'https://www.facebook.com/', 'https://github.com/Zhongli27', 'https://www.coursera.org/courseraplus/special/global-thirty-2024?utm_source=gg&utm_medium=sem&utm_campaign=b2c_apac_coursera-plus_coursera_ftcof_subscription_arte_jan-24_dr_geo-set-2-multi_sem_rsa_gads_lg-all&utm_content=b2c&campaignid=20989858741&adgroup', 'https://www.udemy.com/?utm_source=adwords-brand&utm_medium=udemyads&utm_campaign=Brand-Udemy_la.EN_cc.ROW&campaigntype=Search&portfolio=BrandDirect&language=EN&product=Course&test=&audience=Keyword&topic=&priority=&utm_content=deal4584&utm_term=_._ag_8031', 'https://www.linkedin.com/login', 'lorem ipsum dolor sit amit', 'image/Lemuel.jpg'),
(19, 'Erick Sanchez', 20, '2004-05-13', 'Emerald Hills Victoria Muntinlupa Tunasan City', 'https://www.facebook.com/', 'https://github.com/Zhongli27', 'https://www.coursera.org/user/366a340cd41468108a0bd465f362c1a6', 'https://www.udemy.com/?utm_source=adwords-brand&utm_medium=udemyads&utm_campaign=Brand-Udemy_la.EN_cc.ROW&campaigntype=Search&portfolio=BrandDirect&language=EN&product=Course&test=&audience=Keyword&topic=&priority=&utm_content=deal4584&utm_term=_._ag_8031', 'https://www.linkedin.com/login', 'lorem ipsum dolor sit amit', 'image/erick.jpg'),
(20, 'Kenneth Jugadora', 20, '2004-05-13', 'Phase 2 Block 7 Pcs87 Southville 3 Poblacion', 'https://www.facebook.com/', 'https://github.com/', 'https://www.coursera.org/courseraplus/special/global-thirty-2024?utm_source=gg&utm_medium=sem&utm_campaign=b2c_apac_coursera-plus_coursera_ftcof_subscription_arte_jan-24_dr_geo-set-2-multi_sem_rsa_gads_lg-all&utm_content=b2c&campaignid=20989858741&adgroup', 'https://www.udemy.com/?utm_source=adwords-brand&utm_medium=udemyads&utm_campaign=Brand-Udemy_la.EN_cc.ROW&campaigntype=Search&portfolio=BrandDirect&language=EN&product=Course&test=&audience=Keyword&topic=&priority=&utm_content=deal4584&utm_term=_._ag_8031', 'https://www.linkedin.com/login', 'lorem ipsum dolor sit amit', 'image/kenneth.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
