-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 02:37 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datascience`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id_club` int(8) NOT NULL,
  `nama_club` text NOT NULL,
  `nama_stadion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id_club`, `nama_club`, `nama_stadion`) VALUES
(1, 'Arsenal', 'Emirates Stadium, London'),
(2, 'Aston Villa', 'Villa Park, Birmingham'),
(3, 'Brighton', 'Amex Stamiud, Falmer'),
(4, 'Burnley', 'Turf moor, Burnley'),
(5, 'Chelsea', 'Stamford Bridge, London'),
(6, 'Crystal Palace', 'Selhurst Park, London'),
(7, 'Everton', 'Goodison Park, Liverpool'),
(8, 'Fulham', 'Craven Cottage, London'),
(9, 'Leeds United', 'Elland Road, Leeds'),
(10, 'Leicester City', 'King Power Stadium, Leicester#'),
(11, 'Liverpool FC', 'Anfield, Liverpool'),
(12, 'Manchester City', 'Etihad Stadium, Manchester'),
(13, 'Manchester United', 'Old Trafford, Manchester'),
(14, 'Newcastle United', 'St. James Park, Newcastle'),
(15, 'Sheffield United', 'Bramall Lane, Sheffield'),
(16, 'Southampton', 'St. Mary\'s Stadium, Southampton'),
(17, 'Tottenham Hotspur', 'Tottenham Hotspur Stadium, London'),
(18, 'West Bromwich Albion', 'The Hawthorns, West Bromwich'),
(19, 'West Ham United', 'London Stadium, London'),
(20, 'Wolverhampton Wanderers', 'Molineux Stadium, Wolverhampton');

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `id_nationality` int(8) NOT NULL,
  `code` text NOT NULL,
  `nationality` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id_nationality`, `code`, `nationality`) VALUES
(1, 'ALG', 'Aljazair'),
(2, 'ARG', 'Argentina'),
(3, 'AUS', 'Australia'),
(4, 'AUT', 'Austria'),
(5, 'BEL', 'Belgia'),
(6, 'BFA', 'Burkina Faso'),
(7, 'BIH', 'Bosnia dan Herzegovina'),
(8, 'BRA', 'Brasil'),
(9, 'CAN', 'Kanada'),
(10, 'CIV', 'Pantai Gading'),
(11, 'CMR', 'Kamerun'),
(12, 'COD', 'Republik Demokratik Kongo'),
(13, 'COL', 'Kolombia'),
(14, 'CRO', 'Kroasia'),
(15, 'CZE', 'Ceko'),
(16, 'DEN', 'Denmark'),
(17, 'EGY', 'Mesir'),
(18, 'ENG', 'Inggris'),
(19, 'ESP', 'Spanyol'),
(20, 'FRA', 'Perancis'),
(21, 'GAB', 'Gabon'),
(22, 'GER', 'Jerman'),
(23, 'GHA', 'Ghana'),
(24, 'GRE', 'Yunani'),
(25, 'GUI', 'Guinea'),
(26, 'IRL', 'Republik Irlandia'),
(27, 'IRN', 'Iran'),
(28, 'ISL', 'Islandia'),
(29, 'ITA', 'Italia'),
(30, 'JAM', 'Jamaika'),
(31, 'JPN', 'Jepang'),
(32, 'KOR', 'Korea '),
(33, 'MAR', 'Maroko'),
(34, 'MEX', 'Meksiko'),
(35, 'MKD', 'Makedonia'),
(36, 'MLI', 'Mali'),
(37, 'MTN', 'Mauritania'),
(38, 'NED', 'Belanda'),
(39, 'NGA', 'Nigeria'),
(40, 'NIR', 'Irlandia Utara'),
(41, 'NOR', 'Norwegia'),
(42, 'NZL', 'Selandia Baru'),
(43, 'PAR', 'Paraguay'),
(44, 'POL', 'Polandia'),
(45, 'POR', 'Portugal'),
(46, 'RSA', 'Afrika Selatan'),
(47, 'SCO', 'Skotlandia'),
(48, 'SEN', 'Senegal'),
(49, 'SKN', 'Saint Kitts dan Nevis'),
(50, 'SRB', 'Serbia'),
(51, 'SUI', 'Swiss'),
(52, 'SVK', 'Slovakia'),
(53, 'SWE', 'Swedia'),
(54, 'TUR', 'Turkey'),
(55, 'UKR', 'Ukraina'),
(56, 'URU', 'Uruguay'),
(57, 'USA', 'Amerika Serikat'),
(58, 'WAL', 'Wales'),
(59, 'ZIM', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id_position` int(8) NOT NULL,
  `position` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id_position`, `position`) VALUES
(1, 'GK'),
(2, 'DF'),
(3, 'MF'),
(4, 'FW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id_nationality`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id_nationality` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
