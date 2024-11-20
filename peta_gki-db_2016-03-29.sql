-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2016 at 08:34 AM
-- Server version: 5.5.45
-- PHP Version: 5.5.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peta_gki`
--

-- --------------------------------------------------------

--
-- Table structure for table `gereja`
--

CREATE TABLE `gereja` (
  `id_gereja` int(11) NOT NULL,
  `id_klasis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jumlah_kk` int(11) NOT NULL,
  `jumlah_jemaat` int(11) NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gereja`
--

INSERT INTO `gereja` (`id_gereja`, `id_klasis`, `nama`, `ketua`, `no_telp`, `email`, `alamat`, `jumlah_kk`, `jumlah_jemaat`, `lat`, `lng`, `foto`) VALUES
(1, 1, 'GKI Pengharapan Jayapura Klasis Jayapura', '-', '', '', '', 85, 210, '-2.5561608522011166', '140.71426391601562', ''),
(2, 1, 'GKI Bukit Saitun Skailen', '-', '', '', '', 64, 144, '-2.5722136871027623', '140.68954467773438', ''),
(3, 1, 'GKI Sion Dok VIII Klasis Jayapura', '-', '', '', '', 73, 177, '-2.577709890097023', '140.66654205322266', ''),
(4, 1, 'GKI Maranatha Ardipura I-III Jayapura', '-', '', '', '', 47, 155, '-2.607196853250595', '140.67169189453125', ''),
(5, 2, 'GKI Rehobot Sentani', '-', '', '', '', 89, 233, '-2.545352613222672', '140.47496795654297', ''),
(6, 2, 'GKI Solagratia Kamaiga', '-', '', '', '', 78, 174, '-2.514483682780946', '140.40252685546875', ''),
(7, 2, 'GKI Soar Abeale', '-', '', '', '', 93, 242, '-2.5749320882672784', '140.51502875983715', ''),
(8, 2, 'GKI Waloben Sereh', '-', '', '', '', 55, 123, '-2.5845608039345658', '140.45883178710938', ''),
(9, 46, 'GKI Imanuel Boswesen Sorong', '-', '', '', '', 46, 168, '-0.8605519020100282', '131.253662109375', ''),
(10, 46, 'GKI Lachai Roi Sorong', '-', '', '', '', 88, 211, '-0.8935070247647734', '131.32232666015625', ''),
(11, 30, 'GKI Sion Maripi', '-', '', '', '', 92, 181, '-0.813178417023411', '134.066162109375', ''),
(12, 30, 'GKI Maranatha', '-', '', '', '', 68, 147, '-0.8571190601621688', '134.04556274414062', '');

-- --------------------------------------------------------

--
-- Table structure for table `klasis`
--

CREATE TABLE `klasis` (
  `id_klasis` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `pusat` varchar(50) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasis`
--

INSERT INTO `klasis` (`id_klasis`, `id_wilayah`, `nama`, `ketua`, `pusat`, `no_telp`, `email`, `alamat`, `lat`, `lng`, `foto`) VALUES
(1, 1, 'Klasis Jayapura', '-', '-', '', '', '', '-2.6098362707958387', '140.6737518310547', ''),
(2, 1, 'Klasis Sentani', '-', '-', '', '', '', '-2.5748985', '140.51497719999998', ''),
(3, 2, 'Klasis Sarmi Barat', '-', '-', '', '', '', '-2.5404877689992302', '139.24072265625', ''),
(5, 2, 'Klasis Sarmi Timur', '-', '-', '', '', '', '-2.4678144', '139.20308509999995', ''),
(6, 1, 'Klasis Sentani Barat Moi', '-', '-', '-', '-', '', '-2.5263797412725575', '140.3290557861328', ''),
(7, 1, 'Klasis Kemtukgresi', '-', '-', '', '', '', '-2.729070029832631', '140.31463623046875', ''),
(8, 2, 'Klasis Memberamo Apawer', '-', '-', '', '', '', '-2.533125499999999', '137.7637565', ''),
(9, 1, 'Klasis Nimboran', '-', '-', '', '', '', '-2.644705490023192', '140.1244354248047', ''),
(10, 1, 'Klasis Tanah Merah', '-', '-', '', '', '', '-2.452635020840953', '133.19583892822266', ''),
(11, 1, 'Klasis Tanah Merah Barat', '-', '-', '', '', '', '-2.45091997849473', '133.1920623779297', ''),
(12, 1, 'Klasis Keroom', '-', '-', '', '', '', '-3.370856476926319', '140.73486328125', ''),
(13, 1, 'Bakal Klasis Nawa Wirwai', '-', '-', '', '', '', '-2.9296042', '140.13180169999998', ''),
(14, 2, 'Bakal Klasis Bonggo', '-', '-', '', '', '', '-2.3255231', '139.4872858', ''),
(15, 3, 'Klasis Biak Barat', '-', '-', '', '', '', '-1.0656123898763876', '135.8740997314453', ''),
(16, 3, 'Klasis Biak Utara', '-', '-', '', '', '', '-1.0573740578261694', '136.07528686523438', ''),
(17, 4, 'Klasis Yapen Timur Jauh', '-', '-', '', '', '', '-1.8329217', '136.6512239', ''),
(18, 4, 'Klasis Yapen Timur', '-', '-', '', '', '', '-1.8329217', '136.6512239', ''),
(19, 3, 'Klasis Biak Timur', '-', '-', '', '', '', '-1.1376968366919602', '136.1817169189453', ''),
(20, 3, 'Klasis Numfor', '-', '-', '', '', '', '-0.9948993404003373', '134.8963165283203', ''),
(21, 4, 'Klasis Yapen Barat', '-', '-', '', '', '', '-1.7232438', '135.84696099999996', ''),
(22, 3, 'Klasis Supiori Utara', '-', '-', '', '', '', '-0.7243917114554929', '135.61386108398438', ''),
(23, 4, 'Bakal Klasis Yapen Utara', '-', '-', '', '', '', '-1.7536485', '136.40087199999994', ''),
(24, 3, 'Klasis Supiori Selatan', '-', '-', '', '', '', '-4.156140411309178', '135.3515625', ''),
(25, 3, 'Bakal Klasis Aimando Padaido', '-', '-', '', '', '', '-0.9997051308419692', '136.02447509765625', ''),
(26, 4, 'Klasis Waropen', '-', '-', '', '', '', '-2.8435717', '136.67053399999998', ''),
(27, 5, 'Klasis Paniai', '-', '-', '', '', '', '-3.7765593098768635', '136.39801025390625', ''),
(28, 4, 'Klasis Waropen Atas', '-', '-', '', '', '', '-2.4516885', '137.2142417', ''),
(29, 5, 'Bakal Klasis Nabire Timur', '-', '-', '', '', '', '-3.4311748572202108', '135.582275390625', ''),
(30, 6, 'Klasis Manokwari', '-', '-', '', '', '', '-0.871536975101822', '134.0606689453125', ''),
(31, 6, 'Klasis Ransiki', '-', '-', '', '', '', '-1.4698725', '134.11504130000003', ''),
(32, 6, 'Klasis Wondama', '-', '-', '', '', '', '-2.8551699', '134.32365570000002', ''),
(33, 6, 'Klasis Teluk Bintuni', '-', '-', '', '', '', '-1.9056848', '133.32946600000002', ''),
(34, 6, 'Klasis Kebar', '-', '-', '', '', '', '-1.0514482', '133.25215070000002', ''),
(35, 6, 'Klasis Amberbaken', '-', '-', '', '', '', '-0.633879', '133.05834100000004', ''),
(36, 6, 'Klasis Hatam Moile Meach', '-', '-', '', '', '', '-0.9047265755198737', '133.95286560058594', ''),
(37, 6, 'Bakal Klasis Rumberpon', '-', '-', '', '', '', '-1.843160299999999', '134.1815176', ''),
(38, 8, 'Klasis Mimika', '-', '-', '', '', '', '-4.7226882', '136.49220020000007', ''),
(39, 8, 'Klasis Fakfak', '-', '-', '', '', '', '-3.097706', '133.0194897', ''),
(40, 8, 'Klasis Kaimana', '-', '-', '', '', '', '-3.5830524', '134.0199152', ''),
(41, 8, 'Klasis Kokas', '-', '-', '', '', '', '-2.840682', '132.74669930000005', ''),
(42, 7, 'Klasis Inanwatan', '-', '-', '', '', '', '-2.0835097767922055', '132.2046661376953', ''),
(43, 10, 'Klasis Baliem', '-', '-', '', '', '', '-4.0991845', '138.92532059999996', ''),
(44, 7, 'Klasis Maybrat', '-', '-', '', '', '', '-1.2907843554331222', '132.2808837890625', ''),
(45, 7, 'Klasis Teminabuan', '-', '-', '', '', '', '-1.4239561742738065', '132.07489013671875', ''),
(46, 7, 'Klasis Sorong', '-', '-', '', '', '', '-0.8836777328346382', '131.3079071044922', ''),
(47, 7, 'Klasis Raja Ampat Tengah', '-', '-', '', '', '', '-1.0930733366239376', '130.91033935546875', ''),
(48, 7, 'Klasis Raja Ampat Utara', '-', '-', '', '', '', '-1.073850699893199', '130.9130859375', ''),
(49, 7, 'Klasis Raja Ampat Selatan', '-', '-', '', '', '', '-1.0711045990129324', '130.9130859375', ''),
(50, 7, 'Bakal Klaisis Maybrat Timur', '-', '-', '', '', '', '-1.3484472784360075', '132.308349609375', ''),
(51, 7, 'Bakal Klasis Raja Ampat Utara Jauh', '-', '-', '', '', '', '-1.0299127940481296', '130.93231201171875', ''),
(52, 7, 'Bakal KlasisTambrauw', '-', '-', '', '', '', '', '', ''),
(53, 10, 'Klasis Yalimo', '-', '-', '', '', '', '-3.785284699999999', '139.44660049999993', ''),
(54, 10, 'Bakal Klasis Yalimo Utara', '-', '-', '', '', '', '-3.785284699999999', '139.44660049999993', ''),
(55, 10, 'Klasis Merauke', '-', '-', '', '', '', '-8.442918589850272', '140.36956787109375', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  `aktif` enum('N','Y') NOT NULL,
  `login_terakhir` datetime NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL,
  `tgl_update_password` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `foto`, `level`, `aktif`, `login_terakhir`, `tgl_daftar`, `tgl_update`, `tgl_update_password`) VALUES
(1, 'Periantu Sabuna', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'hendra.jpg', 'admin', 'Y', '2016-03-22 08:20:30', '2016-02-15 07:14:51', '2016-02-15 14:23:03', '2016-02-15 14:23:03'),
(3, 'Varamitha Sikas', 'vara', '04ea67d1f1fe6911c74be505bdbcad3fb919f684', 'admin-3-foto-192952473.jpg', 'operator', 'Y', '0000-00-00 00:00:00', '2016-03-14 07:14:08', '2016-03-14 15:33:25', '2016-03-14 14:14:08'),
(4, 'Ensy Watunau', 'ensy', 'b2161a7506694b19bcaf7e2bbbc152abb022e3be', 'user-4-foto-648952907.jpg', 'operator', 'Y', '0000-00-00 00:00:00', '2016-03-14 08:33:48', '2016-03-14 15:33:48', '2016-03-14 15:33:48'),
(5, 'Jecky Paa', 'jecky', '580b083d8becb535be553273b1b58ed280cb952b', 'user-5-foto-473524305.jpg', 'operator', 'Y', '0000-00-00 00:00:00', '2016-03-14 08:38:04', '2016-03-14 15:38:04', '2016-03-14 15:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `pusat` varchar(50) NOT NULL,
  `no_telp` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `lat` varchar(30) NOT NULL,
  `lng` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama`, `ketua`, `pusat`, `no_telp`, `email`, `alamat`, `lat`, `lng`, `foto`) VALUES
(1, 'Wilayah I', 'Pdt. Josias Paru, S.Th.', 'Jayapura', '', '', '', '-2.5916025', '140.66899950000004', 'wilayah-1-foto-299207899.jpg'),
(2, 'Wilayah II', 'Pdt. Nikolas J. Matruti, S.Th.', 'Sarmi Barat', '', '', '', '-1.8526967', '138.75075519999996', 'wilayah-2-foto-766655815.JPG'),
(3, 'Wilayah III', 'Pdt. Markus Kafiar, S.Th.', 'Biak Selatan', '', '', '', '-1.1831466', '136.08971240000005', 'wilayah-3-foto-928141276.jpg'),
(4, 'Wilayah IV', 'Pdt. Syahnur Abbas, S.Th., M.Pd.', 'Yapen Selatan', '', '', '', '-1.8275595', '136.2378645', 'wilayah-4-foto-405056423.jpg'),
(5, 'Wilayah V', 'Pdt. Yunus Mbaubedari, S.Th.', 'Nabire', '', '', '', '-3.372592962177778', '135.50537109375', 'wilayah-5-foto-969835069.jpg'),
(6, 'Wilayah VI', 'Pdt. Ishak Wiliam Rumbiak, S.Th.', 'Manokwari', '', '', '', '-0.8614531', '134.06204209999999', 'wilayah-6-foto-964898003.jpg'),
(7, 'Wilayah VII', 'Pdt. Simon Everth Lois, S.Th.', 'Sorong', '', '', '', '-0.8819985999999999', '131.29548339999997', 'wilayah-7-foto-167995876.jpg'),
(8, 'Wilayah VIII', 'Pdt. Ishak Maran, S.Th.', 'Timika', '', '', '', '-4.550316200000001', '136.88956210000003', 'wilayah-8-foto-652696397.jpg'),
(9, 'Wilayah IX', 'Pnt. Densemina Marei Numberi', 'Merauke', '', '', '', '-8.48910169901185', '140.40115356445312', 'wilayah-9-foto-276041666.jpg'),
(10, 'Wilayah X', 'Pnt. Dr. Drs. Gasper Liau, M.Si.', 'Wamena', '', '', '', '', '', 'wilayah-10-foto-943874782.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gereja`
--
ALTER TABLE `gereja`
  ADD PRIMARY KEY (`id_gereja`);

--
-- Indexes for table `klasis`
--
ALTER TABLE `klasis`
  ADD PRIMARY KEY (`id_klasis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gereja`
--
ALTER TABLE `gereja`
  MODIFY `id_gereja` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `klasis`
--
ALTER TABLE `klasis`
  MODIFY `id_klasis` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
