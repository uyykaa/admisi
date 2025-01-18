-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 10:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(10) NOT NULL,
  `u_card` varchar(12) NOT NULL,
  `u_f_name` text NOT NULL,
  `u_l_name` text NOT NULL,
  `u_father` text NOT NULL,
  `u_birthday` text NOT NULL,
  `u_gender` varchar(15) NOT NULL,
  `u_email` text NOT NULL,
  `u_phone` varchar(12) NOT NULL,
  `u_state` varchar(50) NOT NULL,
  `u_dist` text NOT NULL,
  `u_village` text NOT NULL,
  `u_pincode` text NOT NULL,
  `file` longblob NOT NULL,
  `u_mother` varchar(30) NOT NULL,
  `staff_id` varchar(12) NOT NULL,
  `image` varchar(150) NOT NULL,
  `uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `u_card`, `u_f_name`, `u_l_name`, `u_father`, `u_birthday`, `u_gender`, `u_email`, `u_phone`, `u_state`, `u_dist`, `u_village`, `u_pincode`, `file`, `u_mother`, `staff_id`, `image`, `uploaded`) VALUES
(138, '223450013', 'Indah', 'Mei', 'Parman', '2002-05-18', 'Perempuan', 'indahmei12@gmail.com', '087876532245', 'Bantul', 'Imogiri', 'Giriloyo', '55782', '', 'Sri', 'A002', 'Mei.jpg', '2023-07-09 21:30:08'),
(139, '223450014', 'Rika Nur', 'Afifah', 'Sumarwan', '2001-05-01', 'Perempuan', 'rikaafiffah01@gmail.com', '081254378901', 'Bantul', 'Sewon', 'Umbulharjo', '55185', '', 'Martilah', 'A001', 'Rika.jpg', '2023-07-09 21:32:53'),
(140, '223450015', 'Ahmad', 'Fauzan', 'Giyanto', '2003-07-07', 'Laki - Laki', 'ahmadfauzan@gmail.com', '081756823412', 'Bantul', 'Dlingo', 'Semuten', '55789', '', 'Marmi', 'A002', 'Fauzan.jpg', '2023-07-09 21:34:48'),
(141, '223450016', 'Nur', 'Aini', 'Yatiman', '2002-05-12', 'Perempuan', 'nurainie12@gmail.com', '081234567891', 'Gunungkidul', 'Saptosari', 'Playen', '78872', '', 'WARJILAH', 'A001', 'Aini.jpg', '2023-07-09 21:38:26'),
(142, '223450017', 'Kholifatul', 'Feby', 'Purwanto', '2000-02-18', 'Perempuan', 'kholifatul123@gmail.com', '089345678213', 'Magelang', 'Muntilan', 'Sriwedari', '56412', '', 'Aslihatun', 'A002', 'Feby.jpg', '2023-07-09 21:44:51'),
(144, '223450019', 'Angga', 'Yunanda', 'Nasir', '1999-12-12', 'Laki - Laki', 'yunandaangga@gmail.com', '089337764512', 'Jakarta', 'Kelapa gading', 'Mawar', '14240', '', 'Yuliati', 'A001', 'Angga.jpg', '2023-07-09 21:53:04'),
(146, '213210029', 'Reza Widya', 'Astuti', 'Sulistyo', '2002-05-29', 'Perempuan', 'reza.widya@students.utdi.ac.id', '089603077352', 'Pati', 'Pleret', 'Turi', '55791', '', 'Kenik Astuti', 'A001', 'widya.jpg', '2023-07-11 09:13:43'),
(147, '291820021', 'Ardi', 'Febriano', 'Andre', '2001-03-28', 'Laki - Laki', 'ardifebriano22@gmail.com', '087126789234', 'Cirebon', 'Depok', 'kaliangkrik', '45155', '', 'Novi', 'A002', 'ardi.jpg', '2023-07-11 10:34:08'),
(148, '1234890', 'hani', 'Mei', 'tyo', '1999-12-12', 'Laki - Laki', 'indahmei12@gmail.com', '089603077352', 'Jakarta', 'Dlingo', 'Giriloyo', '56172', '', 'Sri', 'A001', 'ttd.jpg', '2023-07-11 15:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(13, 'admin', '$2y$10$mF0t6hkaV2Gs/a64wCaZduROJBFLGZKhDCy8KnjKxV.C.qPDfsIA6', '2023-07-11 09:18:52'),
(14, 'rezawidyaa', '$2y$10$IxFc5uzvZ7DmIGMd39AuKeQKhP95rp3uX.9ssah/PfMH7FLQSK9eG', '2023-07-11 09:19:30'),
(15, '213210029', '$2y$10$6MAT.GHfRLv70spGPrUgAOY1K1ha4/F2UtW3XQwsDGzCWee2m/8de', '2023-07-11 10:07:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
