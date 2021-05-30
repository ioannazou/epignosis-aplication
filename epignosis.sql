-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 04:30 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epignosis`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id_user` int(11) NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `status` set('PENDING','ACCEPTED','DECLINED') DEFAULT 'PENDING',
  `submitted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id_user`, `from`, `to`, `reason`, `status`, `submitted`) VALUES
(3, '2021-05-30', '2021-06-15', 'testtesttest', 'PENDING', '2021-05-29 17:53:42'),
(3, '2020-01-22', '2020-01-30', 'tired', 'ACCEPTED', '2020-01-20 00:00:00'),
(3, '2020-05-22', '2020-08-30', 'tired 2', 'DECLINED', '2020-04-05 00:00:00'),
(3, '2021-05-30', '2021-05-31', 'asdasdasda', 'PENDING', '2021-05-29 20:25:01'),
(3, '2021-06-04', '2021-06-06', '22222222', 'PENDING', '2021-05-29 20:41:54'),
(3, '2021-07-01', '2021-07-25', 'Hello', 'PENDING', '2021-05-29 21:16:28'),
(3, '2021-05-30', '2021-05-31', 'sdasdasda', 'PENDING', '2021-05-29 21:19:19'),
(3, '2021-05-30', '2021-05-31', 'asdasdasd', 'PENDING', '2021-05-29 21:19:45'),
(3, '2021-05-30', '2021-05-31', 'asdasdasd', 'PENDING', '2021-05-29 21:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `title`) VALUES
(1, 'admin'),
(2, 'supervisor'),
(3, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fname`, `lname`, `id_role`, `username`, `password`, `email`) VALUES
(0, 'Name1', 'Surname1', 3, '', '123456', 'email@email.gr'),
(1, 'Admin', 'System', 1, 'admin', '654321', 'icsd17052@icsd.aegean.gr'),
(2, 'Maria', 'eponumo', 3, 'maria', '654321', 'ioannazournatzi19@gmail.gr'),
(3, 'ioanna', 'zournatzi', 3, 'ioanna', '654321', 'izournatzi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
