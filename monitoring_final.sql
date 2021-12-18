-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 10:47 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `monitoring.final`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrasi`
--

CREATE TABLE IF NOT EXISTS `administrasi` (
`id_administrasi` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `no_segment` int(11) DEFAULT NULL,
  `abd` int(11) DEFAULT NULL,
  `boq` int(11) DEFAULT NULL,
  `dokumen_atp` int(11) DEFAULT NULL,
  `dokumen_otdr` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrasi`
--

INSERT INTO `administrasi` (`id_administrasi`, `id_proyek`, `no_segment`, `abd`, `boq`, `dokumen_atp`, `dokumen_otdr`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 9, 2, 2, 2, 2, 2),
(3, 10, 1, 1, 1, 1, 1),
(4, 12, 1, 1, 1, 1, 1),
(5, 12, 2, 1, 1, 1, 1),
(6, 12, 3, 1, 1, 1, 1),
(7, 12, 4, 1, 1, 1, 1),
(8, 13, 1, 1, 1, 1, 1),
(9, 13, 2, 1, 1, 1, 1),
(10, 13, 3, 1, 1, 1, 1),
(11, 13, 4, 1, 1, 1, 1),
(12, 14, 1, 1, 1, 1, 1),
(13, 14, 2, 1, 1, 1, 1),
(14, 16, 1, 1, 1, 1, 1),
(15, 16, 2, 1, 1, 1, 1),
(16, 17, 1, 1, 1, 1, 1),
(17, 19, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `administrasi_update`
--

CREATE TABLE IF NOT EXISTS `administrasi_update` (
`id_administrasi_update` int(11) NOT NULL,
  `id_administrasi` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `abd_p` int(11) DEFAULT NULL,
  `abd_r` varchar(100) DEFAULT NULL,
  `abd_d` text,
  `boq_p` int(11) DEFAULT NULL,
  `boq_r` varchar(100) DEFAULT NULL,
  `boq_d` text,
  `dokumen_atp_p` int(11) DEFAULT NULL,
  `dokumen_atp_r` varchar(100) DEFAULT NULL,
  `dokumen_atp_d` text,
  `dokumen_otdr_p` int(11) DEFAULT NULL,
  `dokumen_otdr_r` varchar(100) DEFAULT NULL,
  `dokumen_otdr_d` text,
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrasi_update`
--

INSERT INTO `administrasi_update` (`id_administrasi_update`, `id_administrasi`, `id_proyek`, `id_user`, `abd_p`, `abd_r`, `abd_d`, `boq_p`, `boq_r`, `boq_d`, `dokumen_atp_p`, `dokumen_atp_r`, `dokumen_atp_d`, `dokumen_otdr_p`, `dokumen_otdr_r`, `dokumen_otdr_d`, `tgl_update`) VALUES
(16, 1, 1, 2, 1, '', 'dokumen/administrasi_8211000_20150401_abd_16.txt', 1, NULL, 'dokumen/administrasi_8211000_20150401_boq_16.txt', 1, NULL, 'dokumen/administrasi_8211000_20150401_atp_16.txt', 1, NULL, 'dokumen/administrasi_8211000_20150401_otdr_16.txt', '2015-04-01 20:07:49'),
(17, 12, 14, 2, 1, '', 'dokumen/administrasi_8211000_20150401_abd_17.txt', 1, '', '', 1, '', '', 1, '', '', '2015-04-01 21:09:10'),
(19, 14, 16, 2, 1, '', '', 1, '', '', 1, '', '', 1, '', '', '2015-04-01 21:21:58'),
(20, 14, 16, 2, 1, '', '', 1, '', '', 0, '', '', 1, '', '', '2015-04-01 21:22:06'),
(21, 16, 17, 2, 1, '', '', 1, '', '', 1, '', '', 1, '', '', '2015-04-01 21:22:22'),
(22, 8, 13, 2, 1, '', '', 1, '', '', 1, '', '', 1, '', '', '2015-04-01 21:22:42'),
(24, 9, 13, 2, 1, '', '', 1, '', '', 1, '', '', 1, '', '', '2015-04-01 21:23:01'),
(27, 10, 13, 2, 1, '', '', 1, '', '', 1, '', '', 0, '', '', '2015-04-01 21:23:34'),
(28, 11, 13, 2, 1, '', '', 1, '', '', 1, '', '', 0, '', '', '2015-04-01 21:23:47'),
(29, 17, 19, 2, 1, '', 'dokumen/administrasi_8211000_20150419_abd_29.pdf', 1, '', '', 1, '', '', 1, '', '', '2015-04-19 16:07:26'),
(30, 4, 12, 2, 1, '', 'dokumen/administrasi_8211000_20150424_abd_30.zip', 1, '', '', 1, '', '', 1, '', '', '2015-04-24 21:00:17'),
(31, 6, 12, 2, 1, '', '', 1, '', 'dokumen/administrasi_8211000_20150424_boq_31. Link 100399-100431', 0, '', '', 0, '', '', '2015-04-24 21:01:29'),
(32, 7, 12, 2, 1, '', 'dokumen/administrasi_8211000_20150425_abd_32. Link 100399-100431', 1, '', '', 1, '', '', 0, '', '', '2015-04-25 10:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE IF NOT EXISTS `akses` (
  `hak_akses` varchar(20) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`hak_akses`, `keterangan`) VALUES
('1', 'admin'),
('2', 'user'),
('3', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `civil_bobot`
--

CREATE TABLE IF NOT EXISTS `civil_bobot` (
`id_civil_bobot` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `trenching` int(11) DEFAULT NULL,
  `jembatan` int(11) DEFAULT NULL,
  `joinbox` int(11) DEFAULT NULL,
  `pulling` int(11) DEFAULT NULL,
  `splicing` int(11) DEFAULT NULL,
  `atp` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_bobot`
--

INSERT INTO `civil_bobot` (`id_civil_bobot`, `id_proyek`, `trenching`, `jembatan`, `joinbox`, `pulling`, `splicing`, `atp`) VALUES
(1, 1, 50, 20, 5, 15, 5, 5),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, 1, 0, 0, 0, 0, 0),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, 50, 20, 5, 15, 5, 5),
(13, 13, 50, 20, 5, 15, 5, 5),
(14, 14, 50, 20, 5, 15, 5, 5),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 16, 50, 20, 20, 15, 5, 5),
(17, 17, 50, 20, 5, 15, 5, 5),
(18, 18, 50, 20, 5, 15, 5, 5),
(19, 19, 50, 20, 5, 15, 5, 5),
(20, 18, 50, 20, 5, 15, 5, 5),
(21, 19, 50, 20, 5, 15, 5, 5),
(36, 21, 50, 20, 5, 15, 5, 5),
(37, 20, 50, 20, 5, 15, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `civil_segment`
--

CREATE TABLE IF NOT EXISTS `civil_segment` (
`id_civil_segment` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `no_segment` int(11) NOT NULL,
  `nama_segment` varchar(255) DEFAULT NULL,
  `sow_m` int(11) DEFAULT NULL,
  `trenching` int(11) DEFAULT NULL,
  `jembatan` int(11) DEFAULT NULL,
  `joinbox` int(11) DEFAULT NULL,
  `pulling` int(11) DEFAULT NULL,
  `splicing` int(11) DEFAULT NULL,
  `atp` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_segment`
--

INSERT INTO `civil_segment` (`id_civil_segment`, `id_proyek`, `no_segment`, `nama_segment`, `sow_m`, `trenching`, `jembatan`, `joinbox`, `pulling`, `splicing`, `atp`) VALUES
(1, 10, 1, '1', 1, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 'LINK 10050 - 10060', 2000, 1900, 100, 9, 2200, 9, 1),
(3, 1, 2, 'LINK 10060 - 10070', 1000, 950, 50, 4, 1200, 4, 1),
(4, 1, 3, 'LINK 10070 - 10050', 1500, 1300, 200, 6, 1700, 6, 1),
(5, 12, 1, 'Site 100 to Site 200', 1000, 900, 100, 3, 1100, 3, 1),
(6, 12, 2, 'Site 200 to Site 300', 4000, 3900, 100, 7, 4200, 7, 1),
(7, 12, 3, 'Site 300 to Site 400', 12000, 11800, 200, 6, 12600, 6, 1),
(8, 12, 4, 'Site 500 - Site 600', 2700, 2500, 200, 3, 2800, 3, 1),
(9, 13, 1, 'HH 01 to HH 09', 2000, 2000, 0, 0, 2020, 2, 1),
(10, 13, 2, 'HH 09 to HH 12', 1500, 1500, 0, 0, 1550, 2, 1),
(11, 13, 3, 'HH 01 to HH 10', 300, 300, 0, 0, 330, 2, 1),
(12, 13, 4, 'HH 12 to HH 13', 400, 400, 0, 0, 404, 2, 1),
(13, 14, 1, 'HH 01 ACD to  HH 02 BAS', 6000, 5000, 1000, 4, 6500, 4, 1),
(14, 14, 2, 'HH 02 BAS to HH 03 GST', 20000, 19900, 100, 8, 20200, 8, 1),
(15, 16, 1, 'Link 20102 to 30876', 20000, 19900, 100, 8, 22000, 8, 1),
(16, 17, 1, 'Link 001 - 002', 4000, 4000, 0, 2, 4400, 2, 1),
(17, 19, 1, 'link a to link b', 1000, 900, 100, 4, 1200, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `civil_segment_update`
--

CREATE TABLE IF NOT EXISTS `civil_segment_update` (
`id_civil_segment_update` int(11) NOT NULL,
  `id_civil_segment` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `trenching_p` int(11) DEFAULT NULL,
  `trenching_r` varchar(255) DEFAULT NULL,
  `jembatan_p` int(11) DEFAULT NULL,
  `jembatan_r` varchar(255) DEFAULT NULL,
  `joinbox_p` int(11) DEFAULT NULL,
  `joinbox_r` varchar(255) DEFAULT NULL,
  `pulling_p` int(11) DEFAULT NULL,
  `pulling_r` varchar(255) DEFAULT NULL,
  `splicing_p` int(11) DEFAULT NULL,
  `splicing_r` varchar(255) DEFAULT NULL,
  `atp_p` int(11) DEFAULT NULL,
  `atp_r` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_segment_update`
--

INSERT INTO `civil_segment_update` (`id_civil_segment_update`, `id_civil_segment`, `id_proyek`, `trenching_p`, `trenching_r`, `jembatan_p`, `jembatan_r`, `joinbox_p`, `joinbox_r`, `pulling_p`, `pulling_r`, `splicing_p`, `splicing_r`, `atp_p`, `atp_r`, `id_user`, `tgl_update`) VALUES
(10, 2, 1, 1900, NULL, 100, '', 9, '', 2200, '', 9, '', 1, '', 2, '2015-03-31 16:08:53'),
(11, 3, 1, 900, '', 40, '', 3, '', 1100, '', 3, '', 0, '', 2, '2015-03-31 16:09:18'),
(12, 4, 1, 1280, '', 200, '', 5, '', 180, '', 5, '', 1, '', 2, '2015-03-31 16:09:44'),
(13, 3, 1, 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 3, '2015-04-01 19:50:39'),
(14, 3, 1, 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 3, '2015-04-01 19:51:08'),
(15, 3, 1, 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 3, '2015-04-01 19:51:10'),
(16, 3, 1, 3, '', 0, '', 0, '', 0, '', 0, '', 0, '', 3, '2015-04-01 19:51:14'),
(17, 13, 14, 3000, '', 500, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:04:47'),
(18, 13, 14, 300, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:05:06'),
(19, 13, 14, 900, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:05:12'),
(20, 13, 14, 0, '', 100, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:05:20'),
(21, 13, 14, 0, '', 400, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:05:36'),
(22, 13, 14, 800, '', 0, '', 4, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:05:58'),
(23, 13, 14, 0, '', 0, '', 0, '', 0, '', 4, '', 0, '', 2, '2015-04-01 21:06:04'),
(24, 13, 14, 0, '', 0, '', 0, '', 0, '', 0, '', 1, 'ATP Succes', 2, '2015-04-01 21:06:21'),
(25, 14, 14, 100, 'warga tidak mengijinkan', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:06:43'),
(26, 14, 14, 9000, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:06:52'),
(27, 14, 14, 2000, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:06:59'),
(28, 14, 14, 800, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:07:06'),
(29, 14, 14, 8000, '', 0, '', 0, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:07:22'),
(30, 14, 14, 0, '', 30, '', 4, '', 3000, '', 0, '', 0, '', 2, '2015-04-01 21:07:35'),
(31, 14, 14, 0, '', 0, '', 0, '', 0, '', 9, '', 0, '', 2, '2015-04-01 21:07:51'),
(32, 15, 16, 18000, NULL, 100, '', 8, '', 0, '', 0, '', 0, '', 2, '2015-04-01 21:12:53'),
(33, 16, 17, 3000, '', 0, '', 2, '', 3000, '', 0, '', 0, '', 2, '2015-04-01 21:13:22'),
(34, 9, 13, 1000, '', 0, '', 0, '', 1000, '', 2, '', 1, '', 2, '2015-04-01 21:14:00'),
(35, 10, 13, 1400, 'commcase', 0, '', 0, '', 1400, '', 2, '', 1, '', 2, '2015-04-01 21:14:43'),
(36, 11, 13, 200, '', 0, '', 0, '', 200, '', 2, '', 0, '', 2, '2015-04-01 21:15:18'),
(37, 12, 13, 300, '', 0, '', 0, '', 404, '', 0, '', 0, '', 2, '2015-04-01 21:15:40'),
(38, 5, 12, 900, '', 100, '', 3, '', 1100, '', 3, '', 1, '', 2, '2015-04-01 21:17:04'),
(39, 6, 12, 3900, '', 100, '', 7, '', 4200, '', 7, '', 1, '', 2, '2015-04-01 21:17:40'),
(40, 7, 12, 11800, '', 200, '', 6, '', 12600, '', 6, '', 1, '', 2, '2015-04-01 21:18:17'),
(41, 8, 12, 2500, 'comcase dgn warga', 200, '', 3, '', 2800, '', 3, '', 1, '', 2, '2015-04-01 21:18:43'),
(43, 17, 19, 300, '', 50, '', 3, '', 100, '', 3, '', 0, '', 2, '2015-04-19 16:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE IF NOT EXISTS `otoritas` (
`id_otoritas` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `civil` varchar(1) DEFAULT NULL,
  `permit` varchar(1) DEFAULT NULL,
  `administrasi` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otoritas`
--

INSERT INTO `otoritas` (`id_otoritas`, `id_proyek`, `id_user`, `civil`, `permit`, `administrasi`) VALUES
(2, 2, 3, '0', '1', '0'),
(3, 9, 3, '0', '0', '0'),
(4, 10, 3, '1', '0', '0'),
(5, 9, 3, '1', '1', '0'),
(20, 20, 3, '1', '1', '0'),
(21, 21, 3, '1', '1', '1'),
(22, 20, 6, '1', '1', '1'),
(25, 17, 2, '1', '1', '1'),
(26, 13, 2, '1', '1', '1'),
(27, 12, 2, '1', '1', '1'),
(28, 19, 2, '1', '1', '1'),
(29, 14, 6, '0', '0', '1'),
(41, 16, 2, '1', '1', '1'),
(42, 16, 6, '0', '1', '1'),
(43, 17, 6, '1', '1', '1'),
(44, 1, 9, '1', '1', '1'),
(45, 1, 6, '0', '0', '1'),
(46, 1, 2, '1', '1', '1'),
(47, 13, 9, '1', '1', '1'),
(48, 13, 6, '0', '0', '1'),
(49, 12, 9, '0', '1', '0'),
(50, 12, 6, '0', '0', '1'),
(51, 19, 9, '1', '1', '1'),
(52, 19, 6, '0', '0', '1'),
(53, 14, 2, '1', '1', '1'),
(54, 14, 9, '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE IF NOT EXISTS `permit` (
`id_permit` int(11) NOT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  `izin` varchar(255) DEFAULT NULL,
  `wilayah` varchar(255) DEFAULT NULL,
  `sow` int(11) DEFAULT NULL,
  `url_dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`id_permit`, `id_proyek`, `izin`, `wilayah`, `sow`, `url_dokumen`) VALUES
(1, 1, 'KOTA', 'BOGOR', 1, NULL),
(3, 8, '1', '1', 1, NULL),
(5, 9, '1', '1', 2, NULL),
(6, 10, '1', '1', 1, NULL),
(7, 1, 'NASIONAL', 'PPK BAWEN', 1, NULL),
(8, 12, 'Kota', 'Bandung', 1, NULL),
(9, 12, 'Kota', 'Cianjur', 1, NULL),
(10, 12, 'Kabupaten', 'Bandung', 1, NULL),
(11, 12, 'Nasional', 'PPK Bandung', 1, NULL),
(12, 13, 'KOTA', 'DKI Jakarta', 1, NULL),
(13, 14, 'KOTA', 'BOGOR', 1, NULL),
(14, 14, 'KABUTAREN', 'BOGOR', 1, NULL),
(15, 16, 'KOTA', 'BANDUNG', 1, NULL),
(16, 16, 'KOTA', 'BOGOR', 1, NULL),
(17, 17, 'KOTA', 'PEKANBARU', 1, NULL),
(18, 19, 'kota', 'bogor', 1, NULL),
(19, 20, 'KOTA', 'DKI JAKARTA', 2, NULL),
(20, 20, 'KOTA', 'BANDUNG', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permit_update`
--

CREATE TABLE IF NOT EXISTS `permit_update` (
`id_permit_update` int(11) NOT NULL,
  `id_permit` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `dokumen` text,
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permit_update`
--

INSERT INTO `permit_update` (`id_permit_update`, `id_permit`, `id_proyek`, `id_user`, `progress`, `remark`, `dokumen`, `tgl_update`) VALUES
(11, 1, 1, 2, 1, '', 'dokumen/permit_8211000_20150401_11.txt', '2015-04-01 19:54:44'),
(14, 7, 1, 2, 1, NULL, 'dokumen/permit_8211000_20150401_14.txt', '2015-04-01 19:55:44'),
(15, 1, 1, 2, 1, '', '', '2015-04-01 19:57:22'),
(16, 7, 1, 2, 0, '', '', '2015-04-01 19:57:22'),
(17, 13, 14, 2, 1, NULL, 'dokumen/permit_8211000_20150401_17.txt', '2015-04-01 21:10:53'),
(18, 14, 14, 2, 1, '', '', '2015-04-01 21:10:53'),
(19, 15, 16, 2, 1, '', '', '2015-04-01 21:18:57'),
(20, 16, 16, 2, 1, '', '', '2015-04-01 21:18:57'),
(21, 17, 17, 2, 1, NULL, 'dokumen/permit_8211000_20150401_21.txt', '2015-04-01 21:19:19'),
(22, 12, 13, 2, 1, '', '', '2015-04-01 21:19:37'),
(24, 9, 12, 2, 1, '', '', '2015-04-01 21:19:46'),
(25, 10, 12, 2, 1, '', '', '2015-04-01 21:19:46'),
(26, 11, 12, 2, 1, '', '', '2015-04-01 21:19:47'),
(28, 8, 12, 2, 1, '', 'dokumen/permit_8211000_20150401_28.txt', '2015-04-01 22:41:56'),
(30, 18, 19, 2, 1, '', 'dokumen/permit_8211000_20150419_30.zip', '2015-04-19 16:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE IF NOT EXISTS `proyek` (
`id_proyek` int(11) NOT NULL,
  `operator` varchar(255) DEFAULT NULL,
  `nama_proyek` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tingkat_kesulitan` varchar(20) DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `operator`, `nama_proyek`, `tgl_mulai`, `status`, `tingkat_kesulitan`, `tgl_akhir`) VALUES
(1, 'INDOSAT', 'Lingkar Bandung', '2015-05-20', 'ON PROGRESS', 'MUDAH', '2015-09-09'),
(12, 'XL', 'Fiberisasi II Bandung', '2015-08-20', 'ON PROGRESS', 'SEDANG', '2015-09-19'),
(13, 'INDOSAT', 'MRT Relokasi', '2015-05-20', 'ON PROGRESS', 'SULIT', '2015-09-12'),
(14, 'BIZNET', 'Bogor to Bandung', '2015-05-21', 'ON PROGRESS', 'SEDANG', '2015-09-16'),
(16, 'HUAWEI', 'Mega 2.1 - Bogor Inner', '2015-06-18', 'ARSIP', 'SEDANG', '2015-10-21'),
(17, 'HUAWEI', 'Mega 2.2 - Salatiga', '2015-06-20', 'ON PROGRESS', 'SULIT', '2015-10-05'),
(19, 'XL', 'Sudirman - Thamrin', '2015-07-01', 'ON PROGRESS', 'MUDAH', '2015-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(8) DEFAULT NULL,
  `hp` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `nm_belakang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nik`, `nama`, `hak_akses`, `password`, `hp`, `email`, `jabatan`, `nm_belakang`) VALUES
(1, '100073', 'admin', '1', '100073', '088800001', 'admin@ccc.com', 'Administrasi', '1'),
(2, '100074', 'Ridwan', '2', '100074', '088800003', 'ridwan@ccc.com', 'Project Manager', 'Sucipto'),
(3, '100075', 'Wimpy', '3', '100075', '088800004', 'wimpy@ccc.com', 'Manager', 'Putra'),
(4, '100078', 'Freddy', '3', '100078', '088800012', 'freddy@ccc.com', 'Manager', 'Putra'),
(5, '100076', 'Jeffry', '3', '100076', '088800013', 'jeffry@ccc.com', 'Manager', 'Putra'),
(6, '100077', 'Kakay', '2', '100077', '088800014', 'kakay@ccc.com', 'Administrasi', 'Lestari'),
(9, '100079', 'Teguh', '2', '100079', '087700003', 'teguh@ccc.com', 'Project Manager', 'Superman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrasi`
--
ALTER TABLE `administrasi`
 ADD PRIMARY KEY (`id_administrasi`);

--
-- Indexes for table `administrasi_update`
--
ALTER TABLE `administrasi_update`
 ADD PRIMARY KEY (`id_administrasi_update`);

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
 ADD PRIMARY KEY (`hak_akses`);

--
-- Indexes for table `civil_bobot`
--
ALTER TABLE `civil_bobot`
 ADD PRIMARY KEY (`id_civil_bobot`);

--
-- Indexes for table `civil_segment`
--
ALTER TABLE `civil_segment`
 ADD PRIMARY KEY (`id_civil_segment`);

--
-- Indexes for table `civil_segment_update`
--
ALTER TABLE `civil_segment_update`
 ADD PRIMARY KEY (`id_civil_segment_update`);

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
 ADD PRIMARY KEY (`id_otoritas`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
 ADD PRIMARY KEY (`id_permit`);

--
-- Indexes for table `permit_update`
--
ALTER TABLE `permit_update`
 ADD PRIMARY KEY (`id_permit_update`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
 ADD PRIMARY KEY (`id_proyek`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrasi`
--
ALTER TABLE `administrasi`
MODIFY `id_administrasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `administrasi_update`
--
ALTER TABLE `administrasi_update`
MODIFY `id_administrasi_update` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `civil_bobot`
--
ALTER TABLE `civil_bobot`
MODIFY `id_civil_bobot` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `civil_segment`
--
ALTER TABLE `civil_segment`
MODIFY `id_civil_segment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `civil_segment_update`
--
ALTER TABLE `civil_segment_update`
MODIFY `id_civil_segment_update` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `otoritas`
--
ALTER TABLE `otoritas`
MODIFY `id_otoritas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `permit`
--
ALTER TABLE `permit`
MODIFY `id_permit` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `permit_update`
--
ALTER TABLE `permit_update`
MODIFY `id_permit_update` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
