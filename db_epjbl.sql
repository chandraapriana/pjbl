-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 07:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_epjbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `eval_fase`
--

CREATE TABLE `eval_fase` (
  `id` int(11) NOT NULL,
  `fase` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `evaluasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_fase`
--

INSERT INTO `eval_fase` (`id`, `fase`, `id_kelompok`, `evaluasi`) VALUES
(4, 1, 72, 'bagus sekali kurang rapih pada penyusunannya'),
(5, 2, 72, 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `fase_project`
--

CREATE TABLE `fase_project` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `fase` int(11) NOT NULL,
  `instruksi` varchar(10000) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `startline` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fase_project`
--

INSERT INTO `fase_project` (`id`, `id_project`, `fase`, `instruksi`, `bahan`, `startline`, `deadline`) VALUES
(64, 63, 1, 'kerjakan yang ada', 'Black_and_Gold_Academic_Resume3.pdf', '2020-06-27 11:11:00', '2020-07-04 11:11:00'),
(65, 63, 2, 'kerjakan yang ada', '72064bab7-1807120659421.pdf', '2020-07-04 11:11:00', '2020-07-11 11:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_fase`
--

CREATE TABLE `jawaban_fase` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `fase` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban_fase`
--

INSERT INTO `jawaban_fase` (`id`, `id_project`, `id_kelompok`, `fase`, `nama_tugas`, `tanggal`) VALUES
(38, 63, 72, 1, 'soalfase1.pdf', '2020-06-28 10:28:02'),
(40, 63, 72, 2, 'jawaban2.pdf', '2020-06-28 10:32:13'),
(42, 63, 71, 1, 'jawaban11.pdf', '2020-06-28 12:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_pg`
--

CREATE TABLE `jawaban_pg` (
  `id` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `id_jawaban_pg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban_pg`
--

INSERT INTO `jawaban_pg` (`id`, `id_kelompok`, `id_pertanyaan`, `id_jawaban_pg`) VALUES
(63, 71, 67, 192),
(64, 72, 67, 189);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `anggota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `id_project`, `username`, `password`, `anggota`) VALUES
(71, 63, 'kelompok11', 'a2Vsb21wb2sxMQ==', 'surya, iqbal, adit'),
(72, 63, 'kelompok22', 'a2Vsb21wb2syMg==', 'chandra, kevin, david');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kelompok`
--

CREATE TABLE `nilai_kelompok` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `nilai_pertanyaan_dasar` int(11) NOT NULL,
  `nilai_fase_1` int(11) DEFAULT NULL,
  `nilai_fase_2` int(11) DEFAULT NULL,
  `nilai_fase_3` int(11) DEFAULT NULL,
  `nilai_fase_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_kelompok`
--

INSERT INTO `nilai_kelompok` (`id`, `id_project`, `id_kelompok`, `nilai_pertanyaan_dasar`, `nilai_fase_1`, `nilai_fase_2`, `nilai_fase_3`, `nilai_fase_4`) VALUES
(44, 63, 71, 0, NULL, NULL, NULL, NULL),
(45, 63, 72, 100, 90, 95, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_dasar`
--

CREATE TABLE `pertanyaan_dasar` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanyaan_dasar`
--

INSERT INTO `pertanyaan_dasar` (`id`, `id_project`, `pertanyaan`) VALUES
(67, 63, 'Hal pertama apa yang harus dilakukan ketika membuat web perpustakaan?');

-- --------------------------------------------------------

--
-- Table structure for table `pg_dasar`
--

CREATE TABLE `pg_dasar` (
  `id` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `pilihan` char(1) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `correct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pg_dasar`
--

INSERT INTO `pg_dasar` (`id`, `id_pertanyaan`, `pilihan`, `jawaban`, `correct`) VALUES
(189, 67, 'A', 'Merancang Layout (User Flow)', 1),
(190, 67, 'B', 'Membuat Database', 0),
(191, 67, 'C', 'Membuat codingan langsung', 0),
(192, 67, 'D', 'Brainstorming', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `id_user`, `nama_project`, `kelas`) VALUES
(63, 10, 'Web Tokopedia ', 'X RPL - 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `notelp` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `notelp`, `password`) VALUES
(8, 'Chandra Muhamad Apriana', 'aprianachandra@gmail.com', 'chandra123', '082214106020', '$2y$10$xsqgbrDD/HhP1y9z8fYzaOnfcm1zUorHrtfv1c4868T6UPwox.IKO'),
(10, 'Chandra Muhamad Apriana', 'chandra.developer@upi.edu', 'chandra_guru', '082214106020', '$2y$10$JyF6Oc8zMhamoWhBWLPgZ.k3duN.y9NkzF6HG.dxSBqhELDgo.j5y');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eval_fase`
--
ALTER TABLE `eval_fase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fase_project`
--
ALTER TABLE `fase_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban_fase`
--
ALTER TABLE `jawaban_fase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban_pg`
--
ALTER TABLE `jawaban_pg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_kelompok`
--
ALTER TABLE `nilai_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan_dasar`
--
ALTER TABLE `pertanyaan_dasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pg_dasar`
--
ALTER TABLE `pg_dasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eval_fase`
--
ALTER TABLE `eval_fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fase_project`
--
ALTER TABLE `fase_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `jawaban_fase`
--
ALTER TABLE `jawaban_fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `jawaban_pg`
--
ALTER TABLE `jawaban_pg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `nilai_kelompok`
--
ALTER TABLE `nilai_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pertanyaan_dasar`
--
ALTER TABLE `pertanyaan_dasar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `pg_dasar`
--
ALTER TABLE `pg_dasar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
