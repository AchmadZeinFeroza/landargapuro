-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 11:45 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `argopuro`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_in_out`
--

CREATE TABLE `cash_in_out` (
  `id` int(11) NOT NULL,
  `kode_rekening` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` decimal(10,0) NOT NULL,
  `keluar` decimal(10,0) NOT NULL,
  `id_hutang_dibayar` int(11) DEFAULT NULL,
  `id_piutang_dibayar` int(11) DEFAULT NULL,
  `id_penjualan` varchar(50) DEFAULT NULL,
  `keterangan` varchar(300) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_in_out`
--

INSERT INTO `cash_in_out` (`id`, `kode_rekening`, `tanggal`, `masuk`, `keluar`, `id_hutang_dibayar`, `id_piutang_dibayar`, `id_penjualan`, `keterangan`, `id_admin`) VALUES
(4, '10003', '2019-06-27', '5000000', '0', NULL, NULL, NULL, 'keterangan', 1),
(6, '20003', '2019-06-30', '0', '850000', NULL, NULL, NULL, 'oke', 1),
(7, '10003', '2019-06-02', '4000000', '0', NULL, NULL, NULL, 'tes', 1),
(8, '10003', '2019-06-03', '700000', '0', NULL, NULL, NULL, 'deee', 1),
(11, '10003', '2019-06-20', '6000000', '0', NULL, NULL, NULL, '-', 1),
(12, '10003', '2019-06-06', '700000', '0', NULL, NULL, NULL, 'keterangan', 1),
(38, '10001', '2019-06-30', '16000', '0', NULL, NULL, '300619000001', '', 1),
(39, '10001', '2019-06-30', '16000', '0', NULL, NULL, '300619000002', '', 1),
(40, '10001', '2019-06-30', '18000', '0', NULL, NULL, '300619000003', '', 1),
(41, '10001', '2019-06-30', '21000', '0', NULL, NULL, '300619000004', '', 1),
(42, '10001', '2019-06-30', '116000', '0', NULL, NULL, '300619000005', '', 1),
(43, '10001', '2019-07-05', '21000', '0', NULL, NULL, '050719000006', '', 1),
(44, '10001', '2019-07-05', '220000', '0', NULL, NULL, '050719000007', '', 1),
(45, '10001', '2019-10-23', '93000', '0', NULL, NULL, '231019000008', '', 1),
(46, '10001', '2019-10-23', '93000', '0', NULL, NULL, '231019000009', '', 1),
(47, '10001', '2019-10-23', '93000', '0', NULL, NULL, '231019000010', '', 1),
(48, '10001', '2019-10-23', '114000', '0', NULL, NULL, '231019000011', '', 1),
(49, '10001', '2019-10-23', '114000', '0', NULL, NULL, '231019000012', '', 1),
(50, '10001', '2019-10-23', '114000', '0', NULL, NULL, '231019000013', '', 1),
(51, '10001', '2019-10-24', '81000', '0', NULL, NULL, '241019000014', '', 1),
(52, '10001', '2019-10-24', '510000', '0', NULL, NULL, '241019000015', '', 1),
(53, '10001', '2019-10-24', '20000', '0', NULL, NULL, '241019000016', '', 1),
(54, '10001', '2019-10-24', '170000', '0', NULL, NULL, '241019000017', '', 1),
(55, '10001', '2019-10-24', '12000', '0', NULL, NULL, '241019000018', '', 1),
(56, '10001', '2019-10-24', '11000', '0', NULL, NULL, '241019000019', '', 1),
(57, '10001', '2019-10-24', '150000', '0', NULL, NULL, '241019000020', '', 1),
(58, '10001', '2019-11-06', '70000', '0', NULL, NULL, '061119000021', '', 1),
(59, '10001', '2019-11-06', '148000', '0', NULL, NULL, '061119000022', '', 1),
(60, '10001', '2019-11-12', '23000', '0', NULL, NULL, '121119000023', '', 1),
(61, '10001', '2019-11-12', '231000', '0', NULL, NULL, '121119000024', '', 1),
(62, '10001', '2019-11-16', '660000', '0', NULL, NULL, '161119000025', '', 1),
(63, '10001', '2019-11-19', '23000', '0', NULL, NULL, '191119000026', '', 1),
(64, '10001', '2019-11-20', '99000', '0', NULL, NULL, '201119000027', '', 1),
(65, '10001', '2019-11-20', '466000', '0', NULL, NULL, '201119000028', '', 1),
(66, '10001', '2019-12-04', '649500', '0', NULL, NULL, '041219000029', '', 1),
(67, '10001', '2019-12-04', '474000', '0', NULL, NULL, '041219000030', '', 1),
(68, '10001', '2019-12-27', '105000', '0', NULL, NULL, '271219000031', '', 1),
(69, '10001', '2020-04-30', '559000', '0', NULL, NULL, '300420000032', '', 1),
(70, '10001', '2020-04-30', '84000', '0', NULL, NULL, '300420000033', '', 1),
(71, '10001', '2020-04-30', '460000', '0', NULL, NULL, '300420000034', '', 1),
(72, '10001', '2020-04-30', '524000', '0', NULL, NULL, '300420000035', '', 1),
(73, '10001', '2020-04-30', '64000', '0', NULL, NULL, '300420000036', '', 1),
(74, '10001', '2020-04-30', '460000', '0', NULL, NULL, '300420000037', '', 1),
(75, '10001', '2020-04-30', '64000', '0', NULL, NULL, '300420000038', '', 1),
(76, '10001', '2020-05-03', '529000', '0', NULL, NULL, '030520000039', '', 1),
(77, '10001', '2020-05-03', '530000', '0', NULL, NULL, '030520000040', '', 1),
(78, '10001', '2020-05-03', '68000', '0', NULL, NULL, '030520000041', '', 1),
(88, '10001', '2020-05-04', '530500', '0', NULL, NULL, '040520000042', '', 1),
(89, '10001', '2020-05-05', '1009000', '0', NULL, NULL, '050520000043', '', 1),
(93, '10001', '2020-05-05', '3027000', '0', NULL, NULL, '050520000044', '', 1),
(94, '10001', '2020-05-05', '1009000', '0', NULL, NULL, '050520000045', '', 1),
(95, '10001', '2020-05-05', '41500', '0', NULL, NULL, '050520000046', '', 1),
(96, '10001', '2020-05-13', '35000', '0', NULL, NULL, '130520000047', '', 1),
(97, '10001', '2020-05-14', '524000', '0', NULL, NULL, '140520000048', '', 1),
(98, '10001', '2020-05-14', '460000', '0', NULL, NULL, '140520000049', '', 1),
(99, '10001', '2020-05-14', '0', '0', NULL, NULL, '140520000050', '', 1),
(102, '10001', '2020-05-14', '579000', '0', NULL, NULL, '140520000051', '', 1),
(103, '10001', '2020-05-14', '460000', '0', NULL, NULL, '140520000052', '', 1),
(106, '10001', '2020-05-14', '460000', '0', NULL, NULL, '140520000053', '', 1),
(107, '10001', '2020-05-14', '35000', '0', NULL, NULL, '140520000054', '', 1),
(108, '10001', '2020-05-14', '35000', '0', NULL, NULL, '140520000055', '', 1),
(109, '10001', '2020-05-14', '27000', '0', NULL, NULL, '140520000056', '', 1),
(110, '10001', '2020-05-14', '8000', '0', NULL, NULL, '140520000057', '', 1),
(111, '10001', '2020-05-14', '7000', '0', NULL, NULL, '140520000058', '', 1),
(112, '10001', '2020-05-14', '7000', '0', NULL, NULL, '140520000059', '', 1),
(113, '10001', '2020-05-14', '20000', '0', NULL, NULL, '140520000060', '', 1),
(116, '10001', '2020-05-15', '413500', '0', NULL, NULL, '150520000061', '', 1),
(117, '10001', '2020-05-15', '40000', '0', NULL, NULL, '150520000062', '', 1),
(118, '10001', '2020-05-15', '5000', '0', NULL, NULL, '150520000063', '', 1),
(119, '10001', '2020-05-15', '6000', '0', NULL, NULL, '150520000064', '', 1),
(120, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000065', '', 1),
(121, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000066', '', 1),
(122, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000067', '', 1),
(123, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000068', '', 1),
(124, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000069', '', 1),
(125, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000070', '', 1),
(126, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000071', '', 1),
(127, '10001', '2020-05-15', '140000', '0', NULL, NULL, '150520000072', '', 1),
(128, '10001', '2020-05-15', '760000', '0', NULL, NULL, '150520000073', '', 1),
(129, '10001', '2020-05-29', '40000', '0', NULL, NULL, '290520000074', '', 1),
(130, '10001', '2020-05-29', '40000', '0', NULL, NULL, '290520000075', '', 1),
(131, '10001', '2020-05-29', '40000', '0', NULL, NULL, '290520000076', '', 1),
(132, '10001', '2020-05-29', '40000', '0', NULL, NULL, '290520000077', '', 1),
(133, '10001', '2020-06-04', '140000', '0', NULL, NULL, '040620000078', '', 1),
(134, '10001', '2020-06-04', '40000', '0', NULL, NULL, '040620000079', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hutang_dibayar_history`
--

CREATE TABLE `hutang_dibayar_history` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `id_hutang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hutang_history`
--

CREATE TABLE `hutang_history` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `nominal_dibayar` decimal(10,0) NOT NULL,
  `nomor_faktur` varchar(100) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `tanggal_lunas` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `sudah_lunas` enum('0','1') NOT NULL DEFAULT '0',
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hutang_history`
--

INSERT INTO `hutang_history` (`id`, `judul`, `tanggal`, `nominal`, `nominal_dibayar`, `nomor_faktur`, `id_supplier`, `tanggal_lunas`, `tanggal_jatuh_tempo`, `sudah_lunas`, `waktu_update`, `keterangan`) VALUES
(14, 'pembelian ke supplier', '2019-06-12', '12040000', '0', 'F1306190001', 3, '0000-00-00', '2019-06-12', '0', '2019-06-13 15:27:40', '-'),
(15, 'pembelian ke supplier', '2019-06-13', '126000000', '0', 'F1306190002', 1, '0000-00-00', '2019-07-23', '0', '2019-06-13 15:27:56', '-'),
(16, 'pembelian ke supplier', '2019-06-14', '870000000', '0', 'F1306190003', 4, '0000-00-00', '2019-07-29', '0', '2019-06-13 15:28:18', '-'),
(17, 'pembelian ke supplier', '2019-06-12', '1232000000', '0', 'F1306190004', 1, '0000-00-00', '2019-06-12', '0', '2019-06-13 15:28:47', '-'),
(18, 'pembelian ke supplier', '2019-06-13', '535000000', '0', 'F1306190005', 1, '0000-00-00', '2019-06-13', '0', '2019-06-13 15:29:27', '-'),
(19, 'pembelian ke supplier', '2019-06-14', '598500000', '0', 'F1306190006', 1, '0000-00-00', '2019-06-14', '0', '2019-06-13 15:29:46', '-'),
(20, 'pembelian ke supplier', '2019-06-13', '169000000', '0', 'F1306190007', 4, '0000-00-00', '2019-08-02', '0', '2019-06-13 15:30:23', '-'),
(21, 'pembelian ke supplier', '2019-06-12', '1970000000', '0', 'F1306190008', 1, '0000-00-00', '2019-06-12', '0', '2019-06-13 15:30:50', '-'),
(22, 'pembelian ke supplier', '2019-06-13', '909000', '0', 'F2306190009', 1, '0000-00-00', '2019-06-13', '0', '2019-06-23 16:36:23', '-'),
(24, 'pembelian ke supplier', '2017-05-11', '0', '0', 'F1111190011', 1, '0000-00-00', '2017-06-01', '0', '2019-11-11 11:26:30', '-'),
(25, 'pembelian ke supplier', '2020-04-01', '80000', '0', 'F0203200011', 4, '0000-00-00', '2020-04-01', '0', '2020-03-02 04:05:29', '-'),
(26, 'pembelian ke supplier', '2020-03-14', '2750000', '0', 'F1403200012', 3, '0000-00-00', '2020-04-13', '0', '2020-03-14 07:59:59', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_stok`
--

CREATE TABLE `kartu_stok` (
  `id` int(11) NOT NULL,
  `nomor_rec_penerimaan` varchar(100) DEFAULT NULL,
  `id_utility` int(11) DEFAULT NULL,
  `id_stok_opname` int(11) DEFAULT NULL,
  `id_stok_keluar` int(11) DEFAULT NULL,
  `id_penjualan` varchar(50) DEFAULT NULL,
  `kode_item` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_transaksi` enum('pembelian ke supplier','retur penjualan','stok opname','stok utility','retur pembelian','penjualan','retur penjualan') NOT NULL DEFAULT 'retur pembelian',
  `jumlah_masuk` int(5) NOT NULL,
  `jumlah_keluar` int(5) NOT NULL,
  `stok_sisa` varchar(100) NOT NULL,
  `tgl_expired` date DEFAULT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_user`
--

CREATE TABLE `kategori_user` (
  `id` int(11) NOT NULL,
  `kategori_user` varchar(100) NOT NULL,
  `beranda` int(11) NOT NULL,
  `insentif` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_user`
--

INSERT INTO `kategori_user` (`id`, `kategori_user`, `beranda`, `insentif`) VALUES
(31, 'Manager', 1, '0'),
(32, 'Sales', 49, '0'),
(33, 'User', 16, '0');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_user_modul`
--

CREATE TABLE `kategori_user_modul` (
  `id` int(11) NOT NULL,
  `kategori_user` int(11) NOT NULL,
  `modul` int(11) NOT NULL,
  `akses` enum('read','add','edit','delete') NOT NULL DEFAULT 'read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_user_modul`
--

INSERT INTO `kategori_user_modul` (`id`, `kategori_user`, `modul`, `akses`) VALUES
(11956, 31, 1, 'read'),
(11957, 31, 2, 'read'),
(11958, 31, 3, 'read'),
(11959, 31, 4, 'read'),
(11960, 31, 5, 'read'),
(11961, 31, 6, 'read'),
(11962, 31, 7, 'read'),
(11963, 31, 8, 'read'),
(11964, 31, 9, 'read'),
(11965, 31, 10, 'read'),
(11966, 31, 11, 'read'),
(11967, 31, 12, 'read'),
(11968, 31, 13, 'read'),
(11969, 31, 14, 'read'),
(11970, 31, 15, 'read'),
(11971, 31, 16, 'read'),
(11972, 31, 17, 'read'),
(11973, 31, 18, 'read'),
(11974, 31, 19, 'read'),
(11975, 31, 20, 'read'),
(11976, 31, 21, 'read'),
(11977, 31, 22, 'read'),
(11978, 31, 23, 'read'),
(11979, 31, 24, 'read'),
(11980, 31, 25, 'read'),
(11981, 31, 26, 'read'),
(11982, 31, 27, 'read'),
(11983, 31, 28, 'read'),
(11984, 31, 29, 'read'),
(11985, 31, 30, 'read'),
(11986, 31, 31, 'read'),
(11987, 31, 32, 'read'),
(11988, 31, 33, 'read'),
(11989, 31, 34, 'read'),
(11990, 31, 35, 'read'),
(11991, 31, 36, 'read'),
(11992, 31, 37, 'read'),
(11993, 31, 38, 'read'),
(11994, 31, 39, 'read'),
(11995, 31, 40, 'read'),
(11996, 31, 41, 'read'),
(11997, 31, 42, 'read'),
(11998, 31, 43, 'read'),
(11999, 31, 3, 'add'),
(12000, 31, 4, 'add'),
(12001, 31, 5, 'add'),
(12002, 31, 6, 'add'),
(12003, 31, 7, 'add'),
(12004, 31, 8, 'add'),
(12005, 31, 9, 'add'),
(12006, 31, 10, 'add'),
(12007, 31, 12, 'add'),
(12008, 31, 13, 'add'),
(12009, 31, 14, 'add'),
(12010, 31, 15, 'add'),
(12011, 31, 17, 'add'),
(12012, 31, 18, 'add'),
(12013, 31, 19, 'add'),
(12014, 31, 23, 'add'),
(12015, 31, 24, 'add'),
(12016, 31, 27, 'add'),
(12017, 31, 28, 'add'),
(12018, 31, 29, 'add'),
(12019, 31, 38, 'add'),
(12020, 31, 39, 'add'),
(12021, 31, 42, 'add'),
(12022, 31, 3, 'edit'),
(12023, 31, 4, 'edit'),
(12024, 31, 5, 'edit'),
(12025, 31, 6, 'edit'),
(12026, 31, 7, 'edit'),
(12027, 31, 8, 'edit'),
(12028, 31, 9, 'edit'),
(12029, 31, 10, 'edit'),
(12030, 31, 12, 'edit'),
(12031, 31, 13, 'edit'),
(12032, 31, 15, 'edit'),
(12033, 31, 24, 'edit'),
(12034, 31, 27, 'edit'),
(12035, 31, 29, 'edit'),
(12036, 31, 38, 'edit'),
(12037, 31, 39, 'edit'),
(12038, 31, 41, 'edit'),
(12039, 31, 43, 'edit'),
(12040, 31, 3, 'delete'),
(12041, 31, 4, 'delete'),
(12042, 31, 5, 'delete'),
(12043, 31, 6, 'delete'),
(12044, 31, 7, 'delete'),
(12045, 31, 8, 'delete'),
(12046, 31, 9, 'delete'),
(12047, 31, 10, 'delete'),
(12048, 31, 12, 'delete'),
(12049, 31, 13, 'delete'),
(12050, 31, 14, 'delete'),
(12051, 31, 15, 'delete'),
(12052, 31, 17, 'delete'),
(12053, 31, 18, 'delete'),
(12054, 31, 19, 'delete'),
(12055, 31, 23, 'delete'),
(12056, 31, 24, 'delete'),
(12057, 31, 27, 'delete'),
(12058, 31, 28, 'delete'),
(12059, 31, 29, 'delete'),
(12060, 31, 38, 'delete'),
(12061, 31, 39, 'delete'),
(12062, 32, 14, 'read'),
(12063, 32, 25, 'read'),
(12064, 32, 14, 'add'),
(12065, 33, 16, 'read'),
(12066, 33, 2, 'read'),
(12067, 33, 9, 'read'),
(12068, 33, 43, 'read'),
(12069, 33, 43, 'edit'),
(12070, 31, 44, 'read'),
(12071, 31, 44, 'add'),
(12072, 31, 44, 'edit'),
(12073, 31, 44, 'delete'),
(12074, 31, 45, 'read'),
(12075, 31, 46, 'read'),
(12076, 31, 46, 'add'),
(12077, 31, 46, 'edit'),
(12078, 31, 46, 'delete'),
(12079, 31, 1, 'edit'),
(12080, 31, 47, 'read'),
(12081, 31, 47, 'add'),
(12082, 31, 47, 'edit'),
(12083, 31, 47, 'delete'),
(12090, 31, 21, 'add'),
(12091, 31, 48, 'read'),
(12092, 31, 48, 'add'),
(12093, 31, 48, 'edit');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `tanggal_jam` datetime NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `total_upah_peracik` decimal(10,0) NOT NULL,
  `total_harga_item` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `hold` enum('0','1') NOT NULL DEFAULT '0',
  `keterangan_hold` varchar(200) NOT NULL,
  `waktu_hold` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `token`, `tanggal_jam`, `id_admin`, `id_pembeli`, `total_upah_peracik`, `total_harga_item`, `total`, `hold`, `keterangan_hold`, `waktu_hold`, `status`) VALUES
(69, 'a5a857b77a4e28dc0df2c5192c6c90be', '2019-06-30 01:42:32', 1, NULL, '0', '44000', '44000', '0', '', '', 1),
(71, 'dccbbb8941d22dac340a245b4b7052fd', '2019-06-30 03:38:33', 1, NULL, '0', '84000', '84000', '1', 'ok', '1561883934', 1),
(72, 'dccbbb8941d22dac340a245b4b7052fd', '2019-07-01 01:33:14', 1, NULL, '0', '27000', '27000', '0', '', '', 1),
(74, '4ac14df063b1729185d4e0e2a6e4379e', '2019-07-01 01:08:36', 1, NULL, '5000', '182000', '187000', '0', '', '', 1),
(75, '982c1b7178f668d87e8cf3e21a072cb8', '2019-07-02 05:31:44', 1, NULL, '0', '10500', '10500', '0', '', '', 1),
(76, '904fd9e8537785f5c73d403ffef24ee6', '2019-07-03 02:03:35', 1, 14, '0', '21000', '21000', '0', 'ddd', '1562094224', 1),
(78, 'b1f95b98bf3941e3b3c07338a2cd6402', '2019-07-03 03:31:28', 1, NULL, '0', '0', '0', '0', '', '', 1),
(79, '8f24b84bb00133ed237217cb89ae9805', '2019-07-03 10:03:52', 1, NULL, '0', '0', '0', '0', '', '', 1),
(83, '4e4b5bc22437966870148131f801a2a3', '2019-10-23 11:08:31', 1, NULL, '0', '15000', '15000', '0', 'ok', '1571846927', 1),
(88, 'cbda80635d6da07fcf23f608f30415ec', '2019-10-24 08:32:52', 2, NULL, '0', '21000', '21000', '0', '', '', 1),
(89, '9f11b01f6074db2a7bb266cc1d6b1655', '2019-10-24 09:58:24', 1, 14, '0', '0', '0', '0', '', '', 1),
(97, '7d24614628f834e6e49257d641c52e87', '2019-11-13 07:02:58', 1, NULL, '0', '48000', '48000', '0', '', '', 1),
(100, 'cf89bff1076b9c05c0351e1df063a6da', '2019-11-19 10:19:13', 1, NULL, '0', '11000', '11000', '0', '', '', 1),
(102, '492336a6f659dd9b452acab699c342ad', '2019-11-20 05:13:07', 1, 17, '0', '0', '0', '0', '', '', 1),
(103, '8d07ef2013867393fcb30b5b592ecac1', '2020-02-08 07:15:32', 1, NULL, '0', '64000', '64000', '0', '', '', 1),
(104, 'dd3ec00217ada344c6d0ea36514b31fc', '2020-02-09 10:16:42', 1, NULL, '0', '544000', '544000', '0', '', '', 1),
(106, 'b76610a60568f84746cd67e25833baf1', '2020-02-10 02:28:51', 1, NULL, '0', '90000', '90000', '0', '', '', 1),
(107, '5341f9f2db926212509d8e52ade12d97', '2020-02-11 09:06:25', 1, NULL, '0', '1502000', '1502000', '0', '', '', 1),
(108, '8c4e9995db223749a90ee6888f132a85', '2020-02-11 09:28:10', 1, NULL, '0', '466500', '466500', '0', '', '', 1),
(109, '9069dbcca8c778e0c3a7a806d69e3dbe', '2020-02-11 05:06:01', 1, NULL, '0', '15000', '15000', '0', '', '', 1),
(110, '5881b331699742cca577a420a044d334', '2020-02-24 09:55:32', 1, NULL, '0', '460000', '460000', '0', '', '', 1),
(111, 'e0f61879810127757db1ddc58b201404', '2020-03-05 11:47:34', 1, NULL, '0', '636000', '636000', '0', '', '', 1),
(112, '9ccbe7eead66c02a7bbf9f60dbbcb723', '2020-03-05 06:09:38', 1, NULL, '0', '168000', '168000', '0', '', '', 1),
(113, 'b443989cbcd82c33bd32f43a95331d2e', '2020-03-08 04:28:23', 1, NULL, '0', '1612000', '1612000', '0', '', '', 1),
(114, 'eacae93cf712447112b042d2e3219fa2', '2020-03-09 10:13:56', 1, NULL, '0', '232000', '232000', '0', '', '', 1),
(115, 'd2387a3a823e8a58a9ace4d9920dc03f', '2020-03-14 02:27:40', 1, NULL, '0', '544000', '544000', '0', '', '', 1),
(116, 'b83b8ce82760e8460ae38ec038aebff4', '2020-03-14 03:04:53', 1, NULL, '0', '460000', '460000', '0', '', '', 1),
(117, '4dfe29195a14c7e337388d3fe23c011e', '2020-03-18 06:55:23', 1, NULL, '0', '64000', '64000', '0', '', '', 1),
(118, '71b1bb2bda4c815903bdb848d9b127be', '2020-04-01 10:36:27', 1, NULL, '0', '6000', '6000', '0', '', '', 1),
(126, '4523330518cafde46e676368641d090f', '2020-04-30 03:32:35', 1, NULL, '0', '4717500', '4717500', '0', '', '', 1),
(132, '34b417f00060362cd1dd2a7fff5d3b67', '2020-05-04 10:47:28', 1, NULL, '0', '504000', '504000', '0', '', '', 0),
(136, '36c92b0609aaaa33cadc834e4d6383cd', '2020-05-05 01:19:06', 1, NULL, '0', '64000', '64000', '0', '', '', 0),
(138, 'c54c67eb176fba6f09f9cdf79b329b10', '2020-05-10 01:02:46', 1, 17, '0', '460000', '460000', '0', '', '', 0),
(139, 'a977e567680bc49fe2cd4113fa4340fa', '2020-05-12 10:18:48', 1, NULL, '0', '76000', '76000', '1', 'asdas', '1589253610', 0),
(140, '1bff6aca0c1c4a03cd55c9c6249f4a91', '2020-05-29 08:07:14', 1, 25, '0', '240000', '240000', '0', '', '', 0),
(141, '5bb19a5af23aa4f8c5634106ed4012ea', '2020-05-31 07:41:44', 1, NULL, '0', '400000', '400000', '0', '', '', 0),
(142, 'a2276ca83c09ff62c3a785eb4c822119', '2020-06-01 10:14:25', 1, NULL, '0', '40000', '40000', '0', '', '', 0),
(143, 'feca1f189baf42ea7011452d5424efa0', '2020-06-03 10:27:52', 8, NULL, '0', '260000', '260000', '0', '', '', 0),
(146, 'fb00d227767027aa655042e9358aa230', '2020-06-04 05:28:17', 1, 2, '0', '140000', '140000', '0', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_detail`
--

CREATE TABLE `keranjang_detail` (
  `id` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `racikan` enum('0','1') NOT NULL DEFAULT '0',
  `upah_peracik` decimal(10,0) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `kuantiti` float NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komisi_detail`
--

CREATE TABLE `komisi_detail` (
  `idd` int(11) NOT NULL,
  `id_komisi` int(11) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `komisi` varchar(50) NOT NULL,
  `total` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_admin`
--

CREATE TABLE `master_admin` (
  `id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nama_admin` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `aktif` enum('0','1') NOT NULL DEFAULT '1',
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_admin`
--

INSERT INTO `master_admin` (`id`, `kategori`, `username`, `password`, `nama_admin`, `email`, `aktif`, `waktu_update`) VALUES
(1, 31, 'admin', '$2y$10$GqSP/ynXwcWbmyAwz0yKluIXG7Nv3S18l6D7btXxIhTeRolAi0nh6', 'admin', 'kantorposku@gmail.com', '1', '2020-05-04 12:04:44'),
(2, 32, 'user_kasir', '$2y$10$l1yNDeXjOcFP5jUAvp/be.C4aiC4J.5kwr26wiupnzbkduT4IKe3y', 'Andika', 'andika@gmail.com', '1', '2019-07-05 04:24:09'),
(3, 33, 'users', '$2y$10$l1yNDeXjOcFP5jUAvp/be.C4aiC4J.5kwr26wiupnzbkduT4IKe3y', 'Sang User', 'iniemail@mail.com', '1', '2020-01-07 11:58:10'),
(8, 32, 'paiji', '$2y$10$fKlRi23Ce.jT58viE34Ua.btJyCaPWAsIZx7kJtjiR/QRAK5SCHXi', 'paiji', 'aa@a.com', '1', '2020-06-03 15:19:43'),
(9, 32, 'suprapno', '$2y$10$twwTJzH3.Sw73Okt3hXRe.fDU520dBR9sGt7DuKB7Ngs8PH3JV0uK', 'Supratno', 'aa@a.com', '1', '2020-06-03 15:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `master_distributor`
--

CREATE TABLE `master_distributor` (
  `id` int(11) NOT NULL,
  `nama_distributor` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `id_regional` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_distributor`
--

INSERT INTO `master_distributor` (`id`, `nama_distributor`, `alamat`, `telepon`, `id_regional`, `id_sales`, `waktu_update`) VALUES
(8, 'distributor 1', 'alamat jember', '123', 1, 1, '2020-06-04 00:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `master_item`
--

CREATE TABLE `master_item` (
  `kode_item` varchar(100) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `nama_penjual` varchar(100) NOT NULL,
  `nama_surat_tanah` varchar(100) NOT NULL,
  `status_surat_tanah` int(11) NOT NULL,
  `no_gambar` int(11) NOT NULL,
  `jumlah_bidang` int(11) NOT NULL,
  `luas_surat` int(11) NOT NULL,
  `luas_ukur` int(11) NOT NULL,
  `no_pbb` varchar(100) NOT NULL,
  `luas_pbb` int(11) NOT NULL,
  `njop` varchar(100) NOT NULL,
  `satuan_harga_pengalihan` varchar(100) NOT NULL DEFAULT '0',
  `total_harga_pengalihan` varchar(100) NOT NULL DEFAULT '0',
  `nama_makelar` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL DEFAULT '0',
  `tanggal_pengalihan` date DEFAULT NULL,
  `akta_pengalihan` varchar(100) DEFAULT NULL,
  `nama_pengalihan` varchar(100) DEFAULT NULL,
  `pematangan` varchar(100) DEFAULT '0',
  `ganti_rugi` varchar(100) DEFAULT '0',
  `pbb` varchar(100) NOT NULL DEFAULT '0',
  `lain` varchar(100) NOT NULL DEFAULT '0',
  `harga_perm` varchar(100) NOT NULL DEFAULT '0',
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` varchar(100) NOT NULL,
  `id_perumahan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_item`
--

INSERT INTO `master_item` (`kode_item`, `nama_item`, `tanggal_pembelian`, `nama_penjual`, `nama_surat_tanah`, `status_surat_tanah`, `no_gambar`, `jumlah_bidang`, `luas_surat`, `luas_ukur`, `no_pbb`, `luas_pbb`, `njop`, `satuan_harga_pengalihan`, `total_harga_pengalihan`, `nama_makelar`, `nilai`, `tanggal_pengalihan`, `akta_pengalihan`, `nama_pengalihan`, `pematangan`, `ganti_rugi`, `pbb`, `lain`, `harga_perm`, `waktu_update`, `keterangan`, `id_perumahan`) VALUES
('tanah1', 'tanah 1', '2020-02-05', 'ach saubari', 'ach saubari', 1, 45, 1, 220, 220, '123/51.2/34/1998', 220, '34578', '0', '55000000', 'rahayu', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', '2020-06-08 07:58:58', 'keterangan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_komisi`
--

CREATE TABLE `master_komisi` (
  `id_komisi` int(11) NOT NULL,
  `id_penjualan` varchar(30) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `id_sales` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_komisi`
--

INSERT INTO `master_komisi` (`id_komisi`, `id_penjualan`, `tgl_transaksi`, `id_sales`, `total`, `waktu_update`) VALUES
(1, '300619000006', '2020-06-02', 1, '2000', '2020-05-05 06:14:43'),
(2, '300619000006', '2020-04-05', 1, '4000', '2020-05-05 09:11:05'),
(3, '300619000006', '2020-05-13', 1, '1000', '2020-05-13 07:16:48'),
(4, '300619000006', '2020-05-14', 1, '1', '2020-05-14 12:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `master_operasional`
--

CREATE TABLE `master_operasional` (
  `id` int(11) NOT NULL,
  `tgl_operasional` date NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` varchar(60) NOT NULL,
  `editor` varchar(50) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_operasional`
--

INSERT INTO `master_operasional` (`id`, `tgl_operasional`, `keterangan`, `jumlah`, `editor`, `waktu_update`) VALUES
(2, '2020-04-14', 'Api Es', '1000000', 'admin', '2020-03-24 04:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `master_pembeli`
--

CREATE TABLE `master_pembeli` (
  `id` int(11) NOT NULL,
  `nama_pembeli` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `stok_awal` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis_pembeli` int(11) NOT NULL,
  `luas_sawah` varchar(100) NOT NULL,
  `id_penjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pembeli`
--

INSERT INTO `master_pembeli` (`id`, `nama_pembeli`, `alamat`, `hp`, `stok_awal`, `total`, `waktu_update`, `jenis_pembeli`, `luas_sawah`, `id_penjual`) VALUES
(1, 'Diana', 'jakarta', '12', 1, 1, '2020-06-01 03:10:10', 1, '1', 1),
(2, 'Anisa', 'bekasi utara', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(9, 'Rian', '-', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(14, 'Andika', '-', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(15, 'Jonas', '-', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(16, 'Ratna', '-', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(17, 'ANI', 'JEMBER', '', 0, 0, '2020-06-01 03:03:09', 0, '', 1),
(18, 'Senyum Gelas', 'Jember Kota', '', 0, 0, '2020-06-01 03:03:09', 2, '', 1),
(20, 'Strakasia ', 'Nevada', '', 0, 0, '2020-06-01 03:03:09', 2, '', 1),
(22, 'Apotek baru', 'babarabu', '', 0, 0, '2020-06-01 03:03:09', 2, '', 1),
(23, 'APOTEK SEMESTA COKROAMINOTO', 'JALAN HOS COKROAMINOTO NO 8 JEMBER', '', 0, 0, '2020-06-01 03:03:09', 2, '', 1),
(24, 'abcd', 'jember', '123', 1, 1, '2020-06-01 03:03:09', 1, '', 1),
(25, 'siapa', 'jember', '123', 12, 1, '2020-06-01 03:05:01', 1, '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_penjual`
--

CREATE TABLE `master_penjual` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '0',
  `nama_penjual` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nik` varchar(50) NOT NULL,
  `target` int(11) NOT NULL DEFAULT '0',
  `regional` int(11) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_penjual`
--

INSERT INTO `master_penjual` (`id`, `id_admin`, `nama_penjual`, `alamat`, `nik`, `target`, `regional`, `kontak`, `waktu_update`) VALUES
(1, 9, 'Supratno', 'Jember', '35203123100', 1000, 1, '08123121', '2020-03-19 12:06:16'),
(2, 8, 'paiji', 'jember', '123', 0, 1, '123123', '2020-05-14 15:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `master_regional`
--

CREATE TABLE `master_regional` (
  `id` int(11) NOT NULL,
  `nama_regional` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_regional`
--

INSERT INTO `master_regional` (`id`, `nama_regional`, `lokasi`, `waktu_update`) VALUES
(1, 'jember', 'jember', '2020-06-01 02:53:13'),
(3, 'indonesia', 'indonesia', '2020-06-01 02:53:23'),
(4, 'bojonegoro', 'aaa', '2020-05-31 14:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `master_status_tanah`
--

CREATE TABLE `master_status_tanah` (
  `id_status_tanah` int(11) NOT NULL,
  `nama_status_tanah` varchar(100) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_supplier`
--

CREATE TABLE `master_supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `id_regional` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`id`, `nama_supplier`, `alamat`, `telepon`, `id_regional`, `id_sales`, `waktu_update`) VALUES
(1, 'siapa', 'jember', '1', 1, 1, '2020-06-01 04:55:53'),
(3, 'PT Maju Sejahtera Senantiasa', '', '', 1, 1, '2020-06-01 04:51:54'),
(4, 'PT Pelangi Jaya Bersinar', '', '', 1, 1, '2020-06-01 04:51:57'),
(5, 'PT. Besar', 'disini', '08881231', 1, 1, '2020-06-01 04:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `master_target`
--

CREATE TABLE `master_target` (
  `id` int(11) NOT NULL,
  `target_1` varchar(100) NOT NULL,
  `target_2` varchar(100) NOT NULL,
  `target_3` varchar(100) NOT NULL,
  `target_4` varchar(100) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_target`
--

INSERT INTO `master_target` (`id`, `target_1`, `target_2`, `target_3`, `target_4`, `waktu_update`) VALUES
(1, '100000', '10000', '330000', '102311', '2020-04-30 09:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `master_utility`
--

CREATE TABLE `master_utility` (
  `id_utility` int(11) NOT NULL,
  `nomor_ref` varchar(50) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `ket_utility` text NOT NULL,
  `stok_sebelum` int(11) NOT NULL,
  `aksi` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_utility`
--

INSERT INTO `master_utility` (`id_utility`, `nomor_ref`, `kode_item`, `ket_utility`, `stok_sebelum`, `aksi`, `jumlah`, `waktu`) VALUES
(21, 'SU2204200003', '8999909028229', '100000', 10009, '-', 9, '2020-04-22 02:19:29'),
(24, 'SU2204200002', 'AMOX01', 'asdxfghjkl', 120, '+', 25, '2020-04-22 06:00:58'),
(27, 'SU0505200004', '8999909028222', 'dsa', 1189, '-', 1, '2020-05-05 00:58:56'),
(44, 'SU1405200004', 'AMOX01', 'AA', 144, '+', 6, '2020-05-14 00:55:03'),
(45, 'SU1405200005', 'AMOX01', 'AA', 150, '-', 1, '2020-05-14 00:55:49'),
(46, 'SU1405200006', 'AMOX01', 'q', 149, '+', 1, '2020-05-14 01:32:35'),
(50, 'SU1405200007', 'AMOX01', 'a', 150, '-', 1, '2020-05-14 01:40:12'),
(51, 'SU1405200008', '8999909028214', 'aa', 1196, '+', 1, '2020-05-14 05:07:15'),
(52, 'SU1405200009', '123123112', 'a', 5, '+', 5, '2020-05-14 05:10:28'),
(53, 'SU1405200010', '8999909028214', 'aa', 1197, '+', 3, '2020-05-14 05:11:37'),
(56, 'SU1405200011', '00002', 'aaa', 0, '+', 10, '2020-05-14 05:56:10'),
(57, 'SU1405200012', '098765', 'tambah', 0, '+', 10, '2020-05-14 06:13:01'),
(58, 'SU1405200013', '098765', 'aaa', 10, '-', 5, '2020-05-14 06:14:33'),
(59, 'SU1405200014', '098765', 'aa', 5, '+', 2, '2020-05-14 06:15:39'),
(60, 'SU1405200015', '098765', 'a', 7, '+', 1, '2020-05-14 06:15:58'),
(61, 'SU1405200016', '098765', 'aa', 8, '-', 2, '2020-05-14 06:17:42'),
(62, 'SU1405200017', '00002', 'aaa', 10, '+', 4, '2020-05-14 06:18:40'),
(63, 'SU1405200018', '00002', 'a', 14, '+', 1, '2020-05-14 06:19:30'),
(64, 'SU1405200019', '00002', 'qa', 15, '-', 1, '2020-05-14 06:20:41'),
(65, 'SU1405200020', '00002', 'a', 14, '+', 1, '2020-05-14 06:24:01'),
(66, 'SU1405200021', '00002', 'a', 14, '+', 1, '2020-05-14 06:24:07'),
(69, 'SU1405200022', '00002', 'a', 16, '+', 1, '2020-05-14 06:48:17'),
(70, 'SU2905200023', '00002', 'tambah', 17, '+', 1, '2020-05-29 03:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `nama_function` varchar(100) NOT NULL,
  `aksi_edit` enum('0','1') NOT NULL DEFAULT '1',
  `aksi_hapus` enum('0','1') NOT NULL DEFAULT '1',
  `aksi_tambah` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `label`, `controller`, `nama_function`, `aksi_edit`, `aksi_hapus`, `aksi_tambah`) VALUES
(1, 'Dashboard', 'dashboard', 'index', '1', '0', '1'),
(2, 'Master Data Beranda', 'master', 'index', '0', '0', '0'),
(3, 'Master Data Dokter', 'master', 'dokter', '1', '1', '1'),
(4, 'Master Data pembeli', 'master', 'pembeli', '1', '1', '1'),
(5, 'Master Data Supplier', 'master', 'supplier', '1', '1', '1'),
(6, 'Master Data Kategori Item', 'master', 'perumahan', '1', '1', '1'),
(7, 'Master Data Satuan Item', 'master', 'satuan', '1', '1', '1'),
(8, 'Master Data Merk', 'master', 'merk', '1', '1', '1'),
(9, 'Master Data Obat dan Alkes', 'master', 'items', '1', '1', '1'),
(10, 'Master Racikan', 'master', 'racikan', '1', '1', '1'),
(11, 'Pembelian Beranda', 'pembelian', 'index', '0', '0', '0'),
(12, 'Purchase Order', 'pembelian', 'po', '1', '1', '1'),
(13, 'Pembelian ke Supplier', 'pembelian', 'langsung', '1', '1', '1'),
(14, 'Penerimaan Barang', 'pembelian', 'penerimaan', '0', '1', '1'),
(15, 'Retur Pembelian', 'pembelian', 'retur', '1', '1', '1'),
(16, 'Stok Beranda', 'stok', 'index', '0', '0', '0'),
(17, 'Stok Keluar Retur Pembelian', 'stok', 'keluar', '0', '1', '1'),
(18, 'Stok Adjustment', 'stok', 'adjustment', '0', '1', '1'),
(19, 'Stok Opname', 'stok', 'opname', '0', '1', '1'),
(20, 'Cetak Barcode', 'stok', 'barcode', '0', '0', '0'),
(21, 'Kartu Stok', 'stok', 'kartustok', '1', '1', '1'),
(22, 'Penjualan Beranda', 'penjualan', 'index', '0', '0', '0'),
(23, 'Diskon Produk', 'penjualan', 'diskon', '0', '1', '1'),
(24, 'Jenis Pembayaran', 'penjualan', 'jenispembayaran', '1', '1', '1'),
(25, 'Kasir / Point Of Sales', 'penjualan', 'kasir', '0', '0', '0'),
(26, 'Keuangan Beranda', 'keuangan', 'index', '0', '0', '0'),
(27, 'Kode Rekening', 'keuangan', 'koderekening', '1', '1', '1'),
(28, 'Hutang', 'keuangan', 'hutang', '0', '1', '1'),
(29, 'Cash in Cash Out', 'keuangan', 'cashinout', '1', '1', '1'),
(30, 'Laporan Beranda', 'laporan', 'index', '0', '0', '0'),
(31, 'Laporan Purchase Order', 'laporan', 'po', '0', '0', '0'),
(32, 'Laporan Pembelian', 'laporan', 'pembelian', '0', '0', '0'),
(33, 'Laporan Penerimaan Barang', 'laporan', 'penerimaan', '0', '0', '0'),
(34, 'Laporan Stok', 'laporan', 'stok', '0', '0', '0'),
(35, 'Laporan Penjualan', 'laporan', 'penjualan', '0', '0', '0'),
(36, 'Laporan Keuangan', 'laporan', 'keuangan', '0', '0', '0'),
(37, 'User Beranda', 'user', 'index', '0', '0', '0'),
(38, 'Kategori User', 'user', 'kategori', '1', '1', '1'),
(39, 'Data User', 'user', 'user', '1', '1', '1'),
(40, 'Tools Beranda', 'tools', 'index', '0', '0', '0'),
(41, 'Profil Apotek', 'tools', 'profil', '1', '0', '0'),
(42, 'Import Produk', 'tools', 'import_item', '0', '0', '1'),
(43, 'Edit Password', 'password', 'index', '1', '0', '0'),
(44, 'SPG', 'master', 'spg', '0', '0', '0'),
(45, 'Laporan SPG', 'laporan', 'spg', '0', '0', '0'),
(46, 'Master Biaya Operasional', 'master', 'operasional', '1', '1', '1'),
(47, 'Stok Utility', 'stok', 'utility', '1', '0', '1'),
(48, 'Target', 'penjualan', 'target', '1', '0', '1'),
(49, 'Dashboard sales', 'dashboard_sales', 'index', '1', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `isi` text,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `isi`, `waktu_update`) VALUES
(1, 'ashahahah', '2020-03-24 05:53:12');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_langsung`
--

CREATE TABLE `pembelian_langsung` (
  `nomor_faktur` varchar(100) NOT NULL,
  `kategori` enum('Pembelian Langsung','Purchase Order') NOT NULL DEFAULT 'Pembelian Langsung',
  `nomor_rec` varchar(100) DEFAULT NULL,
  `tgl_pembelian` date NOT NULL,
  `termin` int(5) NOT NULL,
  `pembayaran` enum('cash','hutang','lain-lain') NOT NULL DEFAULT 'cash',
  `supplier` int(11) NOT NULL,
  `total` decimal(20,0) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update_pembelian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_langsung`
--

INSERT INTO `pembelian_langsung` (`nomor_faktur`, `kategori`, `nomor_rec`, `tgl_pembelian`, `termin`, `pembayaran`, `supplier`, `total`, `keterangan`, `waktu_update_pembelian`) VALUES
('F0203200011', 'Purchase Order', 'PE0103200013', '2020-04-01', 0, 'cash', 4, '80000', 'uhu', '2020-03-02 04:05:29'),
('F1111190011', 'Purchase Order', 'PO2410190012', '2017-05-11', 21, 'hutang', 2, '0', 'bagus', '2019-11-11 11:26:30'),
('F1306190001', 'Purchase Order', 'PO1306190001', '2019-06-12', 0, 'cash', 3, '12040000', '-', '2019-06-13 15:27:40'),
('F1306190002', 'Purchase Order', 'PO1306190002', '2019-06-13', 40, 'hutang', 2, '126000000', '-', '2019-06-13 15:27:56'),
('F1306190003', 'Purchase Order', 'PO1306190003', '2019-06-14', 45, 'hutang', 4, '870000000', '-', '2019-06-13 15:28:18'),
('F1306190004', 'Purchase Order', 'PO1306190004', '2019-06-12', 0, 'cash', 2, '1232000000', '-', '2019-06-13 15:28:47'),
('F1306190005', 'Purchase Order', 'PO1306190005', '2019-06-13', 0, 'cash', 2, '535000000', '-', '2019-06-13 15:29:27'),
('F1306190006', 'Purchase Order', 'PO1306190006', '2019-06-14', 0, 'cash', 2, '598500000', '', '2019-06-13 15:29:46'),
('F1306190007', 'Purchase Order', 'PO1306190007', '2019-06-13', 50, 'hutang', 4, '169000000', '-', '2019-06-13 15:30:22'),
('F1306190008', 'Purchase Order', 'PO1306190008', '2019-06-12', 0, 'cash', 2, '1970000000', '-', '2019-06-13 15:30:50'),
('F1403200012', 'Purchase Order', 'PE1403200016', '2020-03-14', 30, 'hutang', 3, '2750000', 'klop', '2020-03-14 07:59:59'),
('F2306190009', 'Purchase Order', 'PO2206190011', '2019-06-13', 0, 'cash', 2, '909000', 'ss', '2019-06-23 16:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_langsung_detail`
--

CREATE TABLE `pembelian_langsung_detail` (
  `idd` int(11) NOT NULL,
  `nomor_faktur` varchar(100) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `sku` varchar(200) NOT NULL,
  `no_bet` varchar(20) DEFAULT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL,
  `kuantiti` int(5) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `diskon` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang`
--

CREATE TABLE `penerimaan_barang` (
  `nomor_rec` varchar(100) NOT NULL,
  `nomor_po` varchar(100) NOT NULL,
  `tanggal_penerimaan` date NOT NULL,
  `penerima` varchar(200) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerimaan_barang`
--

INSERT INTO `penerimaan_barang` (`nomor_rec`, `nomor_po`, `tanggal_penerimaan`, `penerima`, `keterangan`, `waktu_update`) VALUES
('PE0103200013', 'PO0103200016', '2020-03-31', 'Sumartiani', 'uhu', '2020-03-01 11:26:47'),
('PE0103200014', 'PO0103200016', '2020-03-28', 'Sumartiani', 'o1o1', '2020-03-01 11:31:00'),
('PE0103200015', 'PO0103200016', '2020-03-28', 'Sumartiani', 'ojo', '2020-03-01 11:33:27'),
('PE0412190010', 'PO2206190011', '2019-12-01', 'AYU', 'LENGKAP', '2019-12-04 00:10:43'),
('PE0505200017', 'PO123', '2020-05-01', 'aa', 'aa', '2020-05-05 05:31:54'),
('PE1205200018', 'PO12052020', '2020-05-02', 'kasir', 'kirim sebagian', '2020-05-12 03:36:11'),
('PE1306190001', 'PO1306190001', '2019-06-16', 'andika', 'barang sesuai', '2019-06-13 15:31:49'),
('PE1306190002', 'PO1306190002', '2019-06-15', 'andika', 'barang sesuai semua', '2019-06-13 15:32:28'),
('PE1306190003', 'PO1306190003', '2019-06-15', 'andika', 'semua sesuai', '2019-06-13 15:33:02'),
('PE1306190004', 'PO1306190004', '2019-06-15', 'andika', 'barang mantul', '2019-06-13 15:33:51'),
('PE1306190005', 'PO1306190005', '2019-06-15', 'andika', 'sesuai semua pemesanan', '2019-06-13 15:34:36'),
('PE1306190006', 'PO1306190006', '2019-06-15', 'andika', 'oke mantul semua', '2019-06-13 15:35:29'),
('PE1306190007', 'PO1306190007', '2019-06-15', 'andika', 'semua sesuai', '2019-06-13 15:36:00'),
('PE1306190008', 'PO1306190008', '2019-06-15', 'andika', 'oke mantul', '2019-06-13 15:36:49'),
('PE1403200016', 'PO1403200017', '2020-03-14', 'nurul ihsan', 'klop', '2020-03-14 07:57:18'),
('PE1411190009', 'PO2206190011', '2019-11-14', 'SAM', 'LENGKAP', '2019-11-14 11:00:26'),
('PE1702200011', 'PO2206190011', '2020-01-29', 'Saya', '001213', '2020-02-17 07:35:49'),
('PE2702200012', 'PO2602200015', '2020-02-28', 'Sumartiani', 'qwertyuio', '2020-02-27 04:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barang_detail`
--

CREATE TABLE `penerimaan_barang_detail` (
  `idd` int(11) NOT NULL,
  `nomor_rec` varchar(100) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `sku` varchar(200) NOT NULL,
  `no_bet` varchar(30) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `kuantiti` int(5) NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerimaan_barang_detail`
--

INSERT INTO `penerimaan_barang_detail` (`idd`, `nomor_rec`, `kode_item`, `sku`, `no_bet`, `nama_item`, `tgl_expired`, `kuantiti`, `satuan_kecil`) VALUES
(1, 'PE1306190001', '8999909028213', '8999909028213', 'AS12100', 'AFI SALEP 15 GRAM', '2025-04-22', 2000, 'Botol'),
(2, 'PE1306190001', '8999909028214', '8999909028214', '1', 'PAGODA SALEP EXTRA 10G', '2027-06-17', 1200, 'Box'),
(3, 'PE1306190002', '8999909028215', '8999909028215', '555OA1', 'BETASON KRIM 5 GRAM', '2025-04-22', 800, 'Tube'),
(4, 'PE1306190002', '8999909028216', '8999909028216', '1', 'ABIXA 10 MG TABLET', '2025-04-22', 2500, 'Botol'),
(5, 'PE1306190002', '8999909028217', '8999909028217', '1', 'ABBOTIC XL 500 MG TABLET', '2025-04-22', 1000, 'Botol'),
(6, 'PE1306190003', '8999909028218', '8999909028218', '1', 'A-B VASK 10 MG BOX 100 TABLET', '2025-04-22', 2000, 'Tablet'),
(7, 'PE1306190003', '8999909028219', '8999909028219', '1', '3TC-HBV 100 MG TABLET', '2025-04-22', 10000, 'Tablet'),
(8, 'PE1306190003', '8999909028220', '8999909028220', '1', 'COOLANT 350 ML BOTOL', '2025-04-22', 2000, 'Botol'),
(9, 'PE1306190003', '8999909028221', '8999909028221', '1', 'BONEETO 5-12 TAHUN RASA COKLAT 700 GRAM', '2025-04-22', 1000, 'Box'),
(10, 'PE1306190004', '8999909028222', '8999909028222', '1', 'APPETON WEIGHT GAIN DEWASA RASA VANILA 900 GRAM KALENG', '2030-04-22', 1200, 'Box'),
(11, 'PE1306190004', '8999909028223', '8999909028223', '1', 'ANLENE ACTIFIT RASA COKELAT 250 GRAM', '2023-06-30', 5000, 'Box'),
(12, 'PE1306190004', '8999909028224', '8999909028224', '1', 'AL SHIFA MADU ARAB 250 GRAM', '2025-04-22', 1000, 'Botol'),
(13, 'PE1306190004', '8999909028225', '8999909028225', '1', 'ADEM SARI CHING KU LARUTAN 320 ML KALENG', '2025-04-22', 1500, 'Botol'),
(14, 'PE1306190005', '8999909028226', '8999909028226', '1', 'ACANTHE SUNSCREEN SPF30 30 GRAM KRIM', '2025-04-22', 3000, 'Botol'),
(15, 'PE1306190005', '8999909028227', '8999909028227', '1', 'ANTIPLAQUE PASTA GIGI 75 GRAM TUBE', '2025-04-22', 2000, 'Tube'),
(16, 'PE1306190005', '8999909028228', '8999909028228', '1', 'ALYSSA ASHLEY WHITE MUSK BODY LOTION 750 ML BOTOL', '2025-04-22', 2000, 'Botol'),
(17, 'PE1306190006', '8999909028229', '8999909028229', '1', 'ACNES TREATMENT SERIES ACNES SEALING JELL 15 GRAM TUBE', '2025-04-22', 10000, 'Tube'),
(18, 'PE1306190006', '8999909028230', '8999909028230', '1', 'BIOVISION STRIP 10 KAPSUL', '2025-04-22', 3000, 'Tablet'),
(19, 'PE1306190006', '8999909028231', '8999909028231', '1', 'BIO GOLD GAMAT EMAS 350 GRAM', '2025-04-22', 2000, 'Botol'),
(20, 'PE1306190006', '8999909028232', '8999909028232', '1', 'BINTANG TOEDJOE MASUK ANGIN PLUS 4 TUBE', '2025-04-22', 2500, 'Botol'),
(21, 'PE1306190007', '8999909028233', '8999909028233', '1', 'BALPIRIK BALSEM GOSOK EXTRA KUAT HIJAU 20 GRAM', '2025-04-22', 5000, 'Botol'),
(22, 'PE1306190007', '8999909028234', '8999909028234', '1', 'Cussons Baby Telon Oil Plus 60 Ml', '2030-04-22', 4000, 'Botol'),
(23, 'PE1306190007', '8999909028235', '8999909028235', '1', 'AIR MANCUR PARCOK 75 ML', '2025-04-22', 3000, 'Botol'),
(24, 'PE1306190008', '8999909028236', '8999909028236', '1', 'ALBIBET ALBIRUNI BOX 50 KAPSUL', '2025-04-22', 10000, 'Botol'),
(25, 'PE1306190008', '8999909028237', '8999909028237', '1', 'AMBEVEN BOX 100 KAPSUL', '2025-04-22', 10000, 'Box'),
(26, 'PE1306190008', '8999909028238', '8999909028238', '1', 'APRICOT SYRUP 100 ML', '2025-04-22', 10000, 'Botol'),
(27, 'PE1306190008', '8999909028239', '8999909028239', '1', 'BALJITOT MINYAK GOSOK 50 ML', '2025-04-22', 10000, 'Botol'),
(28, 'PE1411190009', '8999909028215', '8999909028215', '0123AI', 'BETASON KRIM 5 GRAM', '2019-06-14', 1010, '1'),
(29, 'PE0412190010', '8999909028215', '8999909028215', '0123AI', 'BETASON KRIM 5 GRAM', '2019-06-14', 500, '1'),
(30, 'PE1702200011', '8999909028215', '8999909028215', '0123AI', 'BETASON KRIM 5 GRAM', '2019-06-14', 3, '1'),
(31, 'PE2702200012', 'AMOX01', 'AMOX01', 'BET-199231', 'AMOXYCILLIN 500MG TAB', '2020-02-28', 9, 'Kardus'),
(32, 'PE0103200013', '8999909028229', '8999909028229', 'BAT-10029', 'ACNES TREATMENT SERIES ACNES SEALING JELL 15 GRAM TUBE', '2020-03-29', 4, 'Bendel'),
(33, 'PE0103200014', '8999909028229', '8999909028229', 'BAT-10029', 'ACNES TREATMENT SERIES ACNES SEALING JELL 15 GRAM TUBE', '2020-03-29', 2, 'Bendel'),
(34, 'PE0103200015', '8999909028229', '8999909028229', 'BAT-10029', 'ACNES TREATMENT SERIES ACNES SEALING JELL 15 GRAM TUBE', '2020-03-29', 3, 'Bendel'),
(35, 'PE1403200016', 'AMOX01', 'AMOX01', 'abcde1234', 'AMOXYCILLIN 500MG TAB', '2025-01-12', 100, 'box'),
(36, 'PE0505200017', '123123112', '123123112', '1', 'barang1', '2020-05-05', 10, '1'),
(37, 'PE1205200018', '00001', '00001', '123', 'ALCO ORAL DROPS', '2020-05-12', 10, '1'),
(38, 'PE1205200018', '8999909028213', '8999909028213', '123', 'AFI SALEP 15 GRAM', '2020-05-12', 10, '1'),
(39, 'PE1205200018', '8999909028220', '8999909028220', '123', 'COOLANT 350 ML BOTOL', '2020-05-12', 20, '2');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` varchar(50) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `id_admin` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `total_upah_peracik` decimal(10,0) NOT NULL,
  `total_harga_item` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_jam` datetime NOT NULL,
  `retur` enum('0','1') NOT NULL DEFAULT '0',
  `tanggal_retur` datetime NOT NULL,
  `admin_retur` int(11) DEFAULT NULL,
  `jenis_penjualan` tinyint(4) NOT NULL,
  `status_penjualan` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_pembeli`, `id_admin`, `id_sales`, `total_upah_peracik`, `total_harga_item`, `total`, `tanggal`, `tanggal_jam`, `retur`, `tanggal_retur`, `admin_retur`, `jenis_penjualan`, `status_penjualan`) VALUES
('030520000039', 22, 1, 0, '0', '529000', '529000', '2020-05-03', '2020-05-03 17:50:29', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('030520000040', NULL, 1, 0, '0', '530000', '530000', '2020-05-03', '2020-05-03 17:51:12', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('030520000041', NULL, 1, 0, '0', '68000', '68000', '2020-05-03', '2020-05-03 17:52:20', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('040520000042', NULL, 1, 0, '0', '530500', '530500', '2020-05-04', '2020-05-04 20:31:01', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('040620000078', 24, 8, 0, '0', '140000', '140000', '2020-06-04', '2020-06-04 05:06:27', '0', '0000-00-00 00:00:00', NULL, 0, 0),
('040620000079', 24, 1, 0, '0', '40000', '40000', '2020-06-04', '2020-06-04 05:23:15', '0', '0000-00-00 00:00:00', NULL, 0, 0),
('041219000029', NULL, 1, 1, '0', '649500', '649500', '2019-12-04', '2019-12-04 06:04:42', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('041219000030', 18, 1, 1, '0', '474000', '474000', '2019-12-04', '2019-12-04 07:01:39', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('050520000043', NULL, 1, 0, '0', '1009000', '1009000', '2020-05-05', '2020-05-05 12:32:52', '0', '0000-00-00 00:00:00', NULL, 2, 0),
('050520000044', NULL, 1, 0, '0', '3027000', '3027000', '2020-05-05', '2020-05-05 13:13:06', '0', '0000-00-00 00:00:00', NULL, 2, 0),
('050520000045', NULL, 1, 0, '0', '1009000', '1009000', '2020-05-05', '2020-05-05 13:14:43', '0', '0000-00-00 00:00:00', NULL, 2, 0),
('050520000046', NULL, 1, 0, '0', '41500', '41500', '2020-05-05', '2020-05-05 16:11:05', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('050719000006', NULL, 1, 1, '0', '21000', '21000', '2019-07-05', '2019-07-05 11:15:08', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('050719000007', NULL, 1, 1, '0', '220000', '220000', '2019-07-05', '2019-07-05 11:19:49', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('061119000021', NULL, 1, 1, '0', '70000', '70000', '2019-11-06', '2019-11-06 18:29:11', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('061119000022', NULL, 1, 1, '0', '148000', '148000', '2019-11-06', '2019-11-06 18:32:23', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('121119000023', NULL, 1, 1, '0', '23000', '23000', '2019-11-12', '2019-11-12 07:09:04', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('121119000024', NULL, 1, 1, '0', '231000', '231000', '2019-11-12', '2019-11-12 07:10:24', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('130520000047', NULL, 1, 0, '0', '35000', '35000', '2020-05-13', '2020-05-13 14:16:48', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000048', NULL, 1, 0, '0', '524000', '524000', '2020-05-14', '2020-05-14 14:08:20', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000049', NULL, 1, 0, '0', '460000', '460000', '2020-05-14', '2020-05-14 14:48:34', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000050', NULL, 1, 0, '0', '0', '0', '2020-05-14', '2020-05-14 14:52:39', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000051', 9, 1, 0, '0', '579000', '579000', '2020-05-14', '2020-05-14 17:11:54', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000052', NULL, 1, 0, '0', '460000', '460000', '2020-05-14', '2020-05-14 17:14:28', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000053', NULL, 1, 0, '0', '460000', '460000', '2020-05-14', '2020-05-14 19:11:33', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000054', NULL, 1, 0, '0', '35000', '35000', '2020-05-14', '2020-05-14 19:19:11', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000055', NULL, 1, 0, '0', '35000', '35000', '2020-05-14', '2020-05-14 19:20:33', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000056', NULL, 1, 0, '0', '27000', '27000', '2020-05-14', '2020-05-14 19:26:29', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000057', NULL, 1, 0, '0', '8000', '8000', '2020-05-14', '2020-05-14 19:26:49', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000058', NULL, 1, 0, '0', '7000', '7000', '2020-05-14', '2020-05-14 19:27:47', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000059', NULL, 1, 0, '0', '7000', '7000', '2020-05-14', '2020-05-14 19:28:42', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('140520000060', NULL, 1, 0, '0', '20000', '20000', '2020-05-14', '2020-05-14 19:29:17', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000061', 25, 1, 0, '0', '413500', '413500', '2020-05-15', '2020-05-15 09:21:17', '0', '0000-00-00 00:00:00', NULL, 1, 1),
('150520000062', NULL, 1, 0, '0', '40000', '40000', '2020-05-15', '2020-05-15 09:22:45', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000063', NULL, 1, 0, '0', '5000', '5000', '2020-05-15', '2020-05-15 09:23:34', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000064', NULL, 1, 0, '0', '6000', '6000', '2020-05-15', '2020-05-15 09:25:04', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000065', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 10:29:08', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000066', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 10:36:22', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000067', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:22:50', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000068', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:26:33', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000069', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:27:03', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000070', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:28:08', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000071', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:36:01', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000072', NULL, 1, 0, '0', '140000', '140000', '2020-05-15', '2020-05-15 12:37:15', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('150520000073', NULL, 1, 0, '0', '760000', '760000', '2020-05-15', '2020-05-15 14:21:39', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('161119000025', NULL, 1, 1, '0', '660000', '660000', '2019-11-16', '2019-11-16 03:18:13', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('191119000026', NULL, 1, 1, '0', '23000', '23000', '2019-11-19', '2019-11-19 22:18:52', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('201119000027', NULL, 1, 1, '0', '99000', '99000', '2019-11-20', '2019-11-20 05:12:19', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('201119000028', NULL, 1, 1, '0', '466000', '466000', '2019-11-20', '2019-11-20 07:51:10', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000008', NULL, 1, 1, '0', '93000', '93000', '2019-10-23', '2019-10-23 22:53:10', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000009', NULL, 1, 1, '0', '93000', '93000', '2019-10-23', '2019-10-23 22:53:39', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000010', NULL, 1, 2, '0', '93000', '93000', '2019-10-23', '2019-10-23 22:53:55', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000011', NULL, 1, 2, '0', '114000', '114000', '2019-10-23', '2019-10-23 22:55:20', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000012', NULL, 1, 2, '0', '114000', '114000', '2019-10-23', '2019-10-23 22:56:07', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('231019000013', NULL, 1, 2, '0', '114000', '114000', '2019-10-23', '2019-10-23 23:06:48', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000014', NULL, 1, 2, '0', '81000', '81000', '2019-10-24', '2019-10-24 08:10:29', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000015', NULL, 1, 2, '0', '510000', '510000', '2019-10-24', '2019-10-24 08:12:57', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000016', NULL, 1, 2, '0', '20000', '20000', '2019-10-24', '2019-10-24 08:15:40', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000017', 9, 1, 2, '0', '170000', '170000', '2019-10-24', '2019-10-24 09:45:56', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000018', NULL, 1, 2, '0', '12000', '12000', '2019-10-24', '2019-10-24 10:36:26', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000019', NULL, 1, 2, '0', '11000', '11000', '2019-10-24', '2019-10-24 10:40:07', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('241019000020', NULL, 1, 2, '0', '150000', '150000', '2019-10-24', '2019-10-24 10:49:15', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('271219000031', NULL, 1, 1, '0', '105000', '105000', '2019-12-27', '2019-12-27 16:20:22', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('290520000074', NULL, 1, 0, '0', '40000', '40000', '2020-05-29', '2020-05-29 19:50:44', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('290520000075', NULL, 1, 0, '0', '40000', '40000', '2020-05-29', '2020-05-29 22:40:53', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('290520000076', NULL, 1, 0, '0', '40000', '40000', '2020-05-29', '2020-05-29 22:54:57', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('290520000077', NULL, 1, 0, '0', '40000', '40000', '2020-05-29', '2020-05-29 22:55:53', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000032', NULL, 1, 0, '0', '559000', '559000', '2020-04-30', '2020-04-30 15:19:13', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000033', NULL, 1, 0, '0', '84000', '84000', '2020-04-30', '2020-04-30 15:24:14', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000034', NULL, 1, 0, '0', '460000', '460000', '2020-04-30', '2020-04-30 15:24:28', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000035', NULL, 1, 0, '0', '524000', '524000', '2020-04-30', '2020-04-30 15:27:32', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000036', NULL, 1, 0, '0', '64000', '64000', '2020-04-30', '2020-04-30 15:29:23', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000037', NULL, 1, 0, '0', '460000', '460000', '2020-04-30', '2020-04-30 15:29:39', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300420000038', NULL, 1, 0, '0', '64000', '64000', '2020-04-30', '2020-04-30 15:30:43', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300619000001', NULL, 1, 1, '5000', '11000', '16000', '2019-06-30', '2019-06-30 00:15:46', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300619000002', 9, 1, 1, '5000', '11000', '16000', '2019-06-30', '2019-06-30 00:16:05', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300619000003', NULL, 1, 1, '0', '18000', '18000', '2019-06-30', '2019-06-30 01:42:20', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300619000004', NULL, 1, 1, '0', '21000', '21000', '2019-06-30', '2019-06-30 12:09:18', '0', '0000-00-00 00:00:00', NULL, 1, 0),
('300619000005', NULL, 1, 1, '0', '116000', '116000', '2019-06-30', '2019-06-30 15:40:56', '0', '0000-00-00 00:00:00', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(50) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `racikan` enum('0','1') NOT NULL DEFAULT '0',
  `upah_peracik` decimal(10,0) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `kuantiti` float NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `stok_sisa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_pembayaran`
--

CREATE TABLE `penjualan_pembayaran` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(50) NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `cara_bayar` enum('cash','kredit') NOT NULL DEFAULT 'cash',
  `catatan` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_pembayaran`
--

INSERT INTO `penjualan_pembayaran` (`id`, `id_penjualan`, `nominal`, `cara_bayar`, `catatan`) VALUES
(29, '300619000001', '20000', 'cash', ''),
(30, '300619000002', '16000', 'cash', ''),
(31, '300619000003', '18000', 'cash', ''),
(32, '300619000004', '25000', 'cash', ''),
(33, '300619000005', '50000', 'cash', ''),
(34, '300619000005', '66000', 'kredit', ''),
(35, '050719000006', '21000', 'cash', ''),
(36, '050719000007', '220000', 'cash', ''),
(37, '231019000008', '100000', 'cash', ''),
(38, '231019000009', '100000', 'cash', ''),
(39, '231019000010', '200000', 'cash', ''),
(40, '231019000011', '300000', 'cash', ''),
(41, '231019000012', '300000', 'cash', ''),
(42, '231019000013', '200000', 'cash', ''),
(43, '241019000014', '100000', 'cash', ''),
(44, '241019000015', '510000', 'cash', ''),
(45, '241019000016', '200000', 'cash', ''),
(46, '241019000017', '200000', 'cash', ''),
(47, '241019000018', '50000', 'cash', ''),
(48, '241019000019', '12000', 'cash', ''),
(49, '241019000020', '400000', 'cash', ''),
(50, '061119000021', '370000', 'cash', ''),
(51, '061119000022', '148000', 'cash', ''),
(52, '121119000023', '50000', 'cash', ''),
(53, '121119000024', '2500000', 'cash', ''),
(54, '161119000025', '700000', 'cash', ''),
(55, '191119000026', '50000', 'cash', ''),
(56, '201119000027', '110000', 'cash', ''),
(57, '201119000028', '500000', 'cash', ''),
(58, '041219000029', '700000', 'cash', ''),
(59, '041219000030', '500000', 'cash', ''),
(60, '271219000031', '200000', 'cash', ''),
(61, '300420000032', '0', 'cash', ''),
(62, '300420000033', '0', 'cash', ''),
(63, '300420000034', '0', 'cash', ''),
(64, '300420000035', '0', 'cash', ''),
(65, '300420000036', '0', 'cash', ''),
(66, '300420000037', '0', 'cash', ''),
(67, '300420000038', '0', 'cash', ''),
(68, '030520000039', '0', 'cash', ''),
(69, '030520000040', '0', 'cash', ''),
(70, '030520000041', '0', 'cash', ''),
(72, '140520000051', '0', 'kredit', ''),
(73, '140520000052', '0', 'kredit', ''),
(76, '140520000053', '100000', 'kredit', ''),
(77, '140520000054', '20000', 'kredit', ''),
(78, '140520000055', '20000', 'kredit', ''),
(79, '140520000056', '20000', 'kredit', ''),
(80, '140520000057', '5000', 'kredit', ''),
(81, '140520000058', '0', 'kredit', 'aa'),
(82, '140520000059', '0', 'kredit', ''),
(83, '140520000060', '0', 'kredit', ''),
(86, '150520000061', '500000', 'kredit', 'aa'),
(87, '150520000062', '50000', 'kredit', ''),
(88, '150520000063', '5000', 'kredit', ''),
(89, '150520000064', '6000', 'kredit', ''),
(90, '150520000065', '150000', 'kredit', ''),
(91, '150520000066', '150000', 'kredit', ''),
(92, '150520000067', '150000', 'kredit', ''),
(93, '150520000068', '150000', 'kredit', ''),
(94, '150520000069', '150000', 'kredit', ''),
(95, '150520000070', '200000', 'kredit', ''),
(96, '150520000071', '150000', 'kredit', ''),
(97, '150520000072', '150000', 'kredit', ''),
(98, '150520000073', '800000', 'kredit', ''),
(99, '290520000074', '50000', 'kredit', ''),
(100, '290520000075', '50000', 'kredit', ''),
(101, '290520000076', '50000', 'kredit', ''),
(102, '290520000077', '50000', 'kredit', ''),
(103, '040620000078', '150000', 'kredit', ''),
(104, '040620000079', '50000', 'kredit', '');

-- --------------------------------------------------------

--
-- Table structure for table `piutang_dibayar_history`
--

CREATE TABLE `piutang_dibayar_history` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `id_piutang` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `piutang_history`
--

CREATE TABLE `piutang_history` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(50) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `judul` varchar(200) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_jatuh_tempo` date NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `nominal_dibayar` decimal(10,0) NOT NULL,
  `sudah_lunas` enum('0','1') NOT NULL DEFAULT '0',
  `tanggal_lunas` date DEFAULT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keterangan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang_history`
--

INSERT INTO `piutang_history` (`id`, `id_penjualan`, `id_pembeli`, `judul`, `tanggal`, `tanggal_jatuh_tempo`, `nominal`, `nominal_dibayar`, `sudah_lunas`, `tanggal_lunas`, `waktu_update`, `keterangan`) VALUES
(1, '140520000051', 9, 'kredit pembelian', '2020-05-14 10:11:54', '0000-00-00', '579000', '0', '0', NULL, '2020-05-14 10:11:54', ''),
(2, '140520000052', NULL, 'kredit pembelian', '2020-05-14 10:14:28', '0000-00-00', '460000', '0', '0', NULL, '2020-05-14 10:14:28', ''),
(3, '140520000053', NULL, 'kredit pembelian', '2020-05-14 12:11:33', '0000-00-00', '460000', '100000', '0', NULL, '2020-05-14 12:11:33', ''),
(4, '140520000054', NULL, 'kredit pembelian', '2020-05-14 12:19:11', '0000-00-00', '35000', '20000', '0', NULL, '2020-05-14 12:19:11', ''),
(5, '140520000055', NULL, 'kredit pembelian', '2020-05-14 12:20:33', '0000-00-00', '35000', '20000', '0', NULL, '2020-05-14 12:20:33', ''),
(6, '140520000056', NULL, 'kredit pembelian', '2020-05-14 12:26:29', '0000-00-00', '27000', '20000', '0', NULL, '2020-05-14 12:26:29', ''),
(7, '140520000057', NULL, 'kredit pembelian', '2020-05-14 12:26:49', '0000-00-00', '8000', '5000', '0', NULL, '2020-05-14 12:26:49', ''),
(8, '140520000058', NULL, 'kredit pembelian', '2020-05-14 12:27:47', '0000-00-00', '7000', '0', '0', NULL, '2020-05-14 12:27:47', 'aa'),
(9, '140520000059', NULL, 'kredit pembelian', '2020-05-14 12:28:42', '0000-00-00', '7000', '0', '0', NULL, '2020-05-14 12:28:42', ''),
(10, '140520000060', NULL, 'kredit pembelian', '2020-05-14 12:29:17', '2020-05-31', '20000', '0', '0', NULL, '2020-05-14 12:29:17', ''),
(13, '150520000061', 25, 'kredit pembelian', '2020-05-15 02:21:17', '0000-00-00', '413500', '500000', '0', NULL, '2020-05-15 02:21:17', 'aa'),
(14, '150520000062', NULL, 'kredit pembelian', '2020-05-15 02:22:45', '0000-00-00', '40000', '50000', '0', NULL, '2020-05-15 02:22:45', ''),
(15, '150520000063', NULL, 'kredit pembelian', '2020-05-15 02:23:34', '0000-00-00', '5000', '5000', '0', NULL, '2020-05-15 02:23:34', ''),
(16, '150520000064', NULL, 'kredit pembelian', '2020-05-15 02:25:04', '0000-00-00', '6000', '6000', '0', NULL, '2020-05-15 02:25:04', ''),
(17, '150520000065', NULL, 'kredit pembelian', '2020-05-15 03:29:08', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 03:29:08', ''),
(18, '150520000066', NULL, 'kredit pembelian', '2020-05-15 03:36:22', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 03:36:22', ''),
(19, '150520000067', NULL, 'kredit pembelian', '2020-05-15 05:22:50', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 05:22:50', ''),
(20, '150520000068', NULL, 'kredit pembelian', '2020-05-15 05:26:33', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 05:26:33', ''),
(21, '150520000069', NULL, 'kredit pembelian', '2020-05-15 05:27:03', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 05:27:03', ''),
(22, '150520000070', NULL, 'kredit pembelian', '2020-05-15 05:28:08', '0000-00-00', '140000', '200000', '0', NULL, '2020-05-15 05:28:08', ''),
(23, '150520000071', NULL, 'kredit pembelian', '2020-05-15 05:36:01', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 05:36:01', ''),
(24, '150520000072', NULL, 'kredit pembelian', '2020-05-15 05:37:15', '0000-00-00', '140000', '150000', '0', NULL, '2020-05-15 05:37:15', ''),
(25, '150520000073', NULL, 'kredit pembelian', '2020-05-15 07:21:39', '0000-00-00', '760000', '800000', '0', NULL, '2020-05-15 07:21:39', ''),
(26, '290520000074', NULL, 'kredit pembelian', '2020-05-29 12:50:44', '0000-00-00', '40000', '50000', '0', NULL, '2020-05-29 12:50:44', ''),
(27, '290520000075', NULL, 'kredit pembelian', '2020-05-29 15:40:53', '0000-00-00', '40000', '50000', '0', NULL, '2020-05-29 15:40:53', ''),
(28, '290520000076', NULL, 'kredit pembelian', '2020-05-29 15:54:57', '0000-00-00', '40000', '50000', '0', NULL, '2020-05-29 15:54:57', ''),
(29, '290520000077', NULL, 'kredit pembelian', '2020-05-29 15:55:53', '0000-00-00', '40000', '50000', '0', NULL, '2020-05-29 15:55:53', ''),
(30, '040620000078', 24, 'kredit pembelian', '2020-06-03 22:06:27', '0000-00-00', '140000', '150000', '0', NULL, '2020-06-03 22:06:27', ''),
(31, '040620000079', 24, 'kredit pembelian', '2020-06-03 22:23:15', '0000-00-00', '40000', '50000', '0', NULL, '2020-06-03 22:23:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `profil_apotek`
--

CREATE TABLE `profil_apotek` (
  `id` varchar(2) NOT NULL,
  `nama_apotek` varchar(300) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `no_npwp` varchar(20) NOT NULL,
  `nama_npwp` varchar(20) NOT NULL,
  `alamat_npwp` text NOT NULL,
  `bank` varchar(10) NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `an` varchar(30) NOT NULL,
  `no_apoteker` varchar(20) NOT NULL,
  `tgl_masa` date NOT NULL,
  `apoteker` varchar(50) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `alamat_tinggal` text NOT NULL,
  `no_sipa` varchar(20) NOT NULL,
  `tgl_sipa` date NOT NULL,
  `nama_ttk` varchar(20) NOT NULL,
  `footer_struk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil_apotek`
--

INSERT INTO `profil_apotek` (`id`, `nama_apotek`, `alamat`, `logo`, `telepon`, `hp`, `no_npwp`, `nama_npwp`, `alamat_npwp`, `bank`, `rekening`, `an`, `no_apoteker`, `tgl_masa`, `apoteker`, `alamat_ktp`, `alamat_tinggal`, `no_sipa`, `tgl_sipa`, `nama_ttk`, `footer_struk`) VALUES
('1', 'PT Argopuro', 'Jalan Manggis No 11 Jemberargopuro', '1591596570.png', '0811212121', '089999', 'FP.01.04/IV/0045-e/2', 'PT Airlangga Sentral', 'Kelurahan Kawangrejo Mumbulsari Jember', 'Mandiri', '01231111', 'PT Airlangga Sentral Internasi', '0123199121112', '2025-11-27', 'riza putri agustina, S.Farm.Apt', 'disana', 'disini', '100321923', '2028-11-30', 'Katakuri', 'Terimakasih telah berbelanja');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `nomor_po` varchar(100) NOT NULL,
  `tgl_po` date NOT NULL,
  `id_admin` int(11) NOT NULL,
  `pembayaran` enum('cash','hutang','lain-lain') NOT NULL DEFAULT 'cash',
  `supplier` int(11) NOT NULL,
  `total` decimal(20,0) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update_po` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`nomor_po`, `tgl_po`, `id_admin`, `pembayaran`, `supplier`, `total`, `keterangan`, `waktu_update_po`) VALUES
('PO12052020', '2020-05-01', 1, 'cash', 3, '0', 'pesan bahan makan', '2020-05-30 01:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `idd` int(11) NOT NULL,
  `nomor_po` varchar(100) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `kuantiti` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekening_kode`
--

CREATE TABLE `rekening_kode` (
  `kode_rekening` varchar(30) NOT NULL,
  `kategori` enum('pemasukan','pengeluaran') NOT NULL DEFAULT 'pemasukan',
  `nama_rekening` varchar(200) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `editable` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening_kode`
--

INSERT INTO `rekening_kode` (`kode_rekening`, `kategori`, `nama_rekening`, `waktu_update`, `editable`) VALUES
('10001', 'pemasukan', 'Penjualan', '2019-05-28 14:03:51', '0'),
('10002', 'pemasukan', 'Piutang customer', '2019-05-31 10:12:45', '0'),
('10003', 'pemasukan', 'Setoran Dana Pemilik', '2019-06-05 13:31:42', '1'),
('10004', 'pemasukan', 'Penjualan Aset', '2019-06-25 03:24:04', '1'),
('20001', 'pengeluaran', 'Pembelian ke supplier', '2019-05-28 14:03:51', '0'),
('20002', 'pengeluaran', 'Pembayaran telepon', '2019-05-28 14:53:27', '1'),
('20003', 'pengeluaran', 'Pembayaran listrik', '2019-05-28 14:53:40', '1');

-- --------------------------------------------------------

--
-- Table structure for table `retur_detail`
--

CREATE TABLE `retur_detail` (
  `idd` int(11) NOT NULL,
  `nomor_retur` varchar(100) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `sku` varchar(200) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `kuantiti` int(5) NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_detail`
--

INSERT INTO `retur_detail` (`idd`, `nomor_retur`, `kode_item`, `sku`, `nama_item`, `tgl_expired`, `kuantiti`, `satuan_kecil`) VALUES
(5, 'RE2306190001', '8999909028236', '8999909028236', 'ALBIBET ALBIRUNI BOX 50 KAPSUL', '2025-04-22', 10, 'Botol'),
(6, 'RE2306190001', '8999909028237', '8999909028237', 'AMBEVEN BOX 100 KAPSUL', '2025-04-22', 20, 'Box'),
(7, 'RE2306190001', '8999909028238', '8999909028238', 'APRICOT SYRUP 100 ML', '2025-04-22', 11, 'Botol'),
(8, 'RE2306190001', '8999909028239', '8999909028239', 'BALJITOT MINYAK GOSOK 50 ML', '2025-04-22', 0, 'Botol');

-- --------------------------------------------------------

--
-- Table structure for table `retur_pembelian`
--

CREATE TABLE `retur_pembelian` (
  `nomor_retur` varchar(100) NOT NULL,
  `nomor_faktur` varchar(100) NOT NULL,
  `nomor_rec_penerimaan` varchar(100) NOT NULL,
  `tanggal_retur` date NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_pembelian`
--

INSERT INTO `retur_pembelian` (`nomor_retur`, `nomor_faktur`, `nomor_rec_penerimaan`, `tanggal_retur`, `keterangan`, `waktu_update`) VALUES
('RE2306190001', 'F1306190008', 'PE1306190008', '2019-06-26', 'koe', '2019-06-23 18:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `stok_adjustment`
--

CREATE TABLE `stok_adjustment` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_ref` varchar(100) NOT NULL,
  `stok_sebelum` int(11) NOT NULL,
  `kuantiti_berubah` int(5) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_ref` varchar(100) NOT NULL,
  `nomor_retur_pembelian` varchar(100) DEFAULT NULL,
  `kuantiti` int(5) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok_opname`
--

CREATE TABLE `stok_opname` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nomor_ref` varchar(100) NOT NULL,
  `stok_sebelum` int(11) NOT NULL,
  `kuantiti_berubah` int(5) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `nama_item` varchar(200) NOT NULL,
  `tgl_expired` date NOT NULL,
  `satuan_kecil` varchar(100) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `waktu_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verifikasi` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_admin`, `status`, `keterangan`, `waktu`) VALUES
(1, 1, 1, 'test', '2020-05-28 18:59:17'),
(2, 1, 2, 'gagal', '2020-05-29 19:05:53'),
(3, 8, 1, '', '2020-06-04 01:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_stok`
--

CREATE TABLE `tbl_detail_stok` (
  `id_detail_stok` int(11) NOT NULL,
  `kode_item` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `stok_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_in_out`
--
ALTER TABLE `cash_in_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_rekening` (`kode_rekening`),
  ADD KEY `id_hutang_dibayar` (`id_hutang_dibayar`),
  ADD KEY `id_piutang_dibayar` (`id_piutang_dibayar`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `hutang_dibayar_history`
--
ALTER TABLE `hutang_dibayar_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hutang` (`id_hutang`);

--
-- Indexes for table `hutang_history`
--
ALTER TABLE `hutang_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_faktur` (`nomor_faktur`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `kartu_stok`
--
ALTER TABLE `kartu_stok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_item` (`kode_item`),
  ADD KEY `nomor_rec` (`nomor_rec_penerimaan`),
  ADD KEY `id_stok_keluar` (`id_stok_keluar`),
  ADD KEY `id_stok_adjustment` (`id_utility`),
  ADD KEY `id_stok_opname` (`id_stok_opname`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `kategori_user`
--
ALTER TABLE `kategori_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_user` (`kategori_user`),
  ADD KEY `beranda` (`beranda`);

--
-- Indexes for table `kategori_user_modul`
--
ALTER TABLE `kategori_user_modul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_user` (`kategori_user`),
  ADD KEY `modul` (`modul`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keranjang` (`id_keranjang`),
  ADD KEY `kode_item` (`kode_item`);

--
-- Indexes for table `komisi_detail`
--
ALTER TABLE `komisi_detail`
  ADD PRIMARY KEY (`idd`);

--
-- Indexes for table `master_admin`
--
ALTER TABLE `master_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `master_distributor`
--
ALTER TABLE `master_distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_item`
--
ALTER TABLE `master_item`
  ADD PRIMARY KEY (`kode_item`);

--
-- Indexes for table `master_komisi`
--
ALTER TABLE `master_komisi`
  ADD PRIMARY KEY (`id_komisi`);

--
-- Indexes for table `master_operasional`
--
ALTER TABLE `master_operasional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pembeli`
--
ALTER TABLE `master_pembeli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_penjual`
--
ALTER TABLE `master_penjual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_regional`
--
ALTER TABLE `master_regional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_supplier`
--
ALTER TABLE `master_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_target`
--
ALTER TABLE `master_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_utility`
--
ALTER TABLE `master_utility`
  ADD PRIMARY KEY (`id_utility`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_langsung`
--
ALTER TABLE `pembelian_langsung`
  ADD PRIMARY KEY (`nomor_faktur`),
  ADD KEY `supplier` (`supplier`),
  ADD KEY `nomor_rec` (`nomor_rec`) USING BTREE;

--
-- Indexes for table `pembelian_langsung_detail`
--
ALTER TABLE `pembelian_langsung_detail`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `kode_item` (`kode_item`),
  ADD KEY `nomor_po` (`nomor_faktur`);

--
-- Indexes for table `penerimaan_barang`
--
ALTER TABLE `penerimaan_barang`
  ADD PRIMARY KEY (`nomor_rec`);

--
-- Indexes for table `penerimaan_barang_detail`
--
ALTER TABLE `penerimaan_barang_detail`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `nomor_rec` (`nomor_rec`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `admin_retur` (`admin_retur`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_item` (`kode_item`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `piutang_dibayar_history`
--
ALTER TABLE `piutang_dibayar_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_piutang` (`id_piutang`);

--
-- Indexes for table `piutang_history`
--
ALTER TABLE `piutang_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `profil_apotek`
--
ALTER TABLE `profil_apotek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`nomor_po`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `kode_item` (`kode_item`),
  ADD KEY `nomor_po` (`nomor_po`);

--
-- Indexes for table `rekening_kode`
--
ALTER TABLE `rekening_kode`
  ADD PRIMARY KEY (`kode_rekening`);

--
-- Indexes for table `retur_detail`
--
ALTER TABLE `retur_detail`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `nomor_rec` (`nomor_retur`);

--
-- Indexes for table `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  ADD PRIMARY KEY (`nomor_retur`),
  ADD KEY `nomor_faktur` (`nomor_faktur`),
  ADD KEY `nomor_rec_penerimaan` (`nomor_rec_penerimaan`);

--
-- Indexes for table `stok_adjustment`
--
ALTER TABLE `stok_adjustment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_ref` (`nomor_ref`),
  ADD KEY `kode_item` (`kode_item`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_ref` (`nomor_ref`),
  ADD KEY `kode_item` (`kode_item`),
  ADD KEY `stok_keluar_ibfk_2` (`nomor_retur_pembelian`);

--
-- Indexes for table `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_ref` (`nomor_ref`),
  ADD KEY `kode_item` (`kode_item`);

--
-- Indexes for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `tbl_detail_stok`
--
ALTER TABLE `tbl_detail_stok`
  ADD PRIMARY KEY (`id_detail_stok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_in_out`
--
ALTER TABLE `cash_in_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `hutang_dibayar_history`
--
ALTER TABLE `hutang_dibayar_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hutang_history`
--
ALTER TABLE `hutang_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `kartu_stok`
--
ALTER TABLE `kartu_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT for table `kategori_user`
--
ALTER TABLE `kategori_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `kategori_user_modul`
--
ALTER TABLE `kategori_user_modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12094;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `komisi_detail`
--
ALTER TABLE `komisi_detail`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_admin`
--
ALTER TABLE `master_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `master_distributor`
--
ALTER TABLE `master_distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `master_komisi`
--
ALTER TABLE `master_komisi`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_operasional`
--
ALTER TABLE `master_operasional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_pembeli`
--
ALTER TABLE `master_pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `master_penjual`
--
ALTER TABLE `master_penjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_regional`
--
ALTER TABLE `master_regional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_supplier`
--
ALTER TABLE `master_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_target`
--
ALTER TABLE `master_target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_utility`
--
ALTER TABLE `master_utility`
  MODIFY `id_utility` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pembelian_langsung_detail`
--
ALTER TABLE `pembelian_langsung_detail`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penerimaan_barang_detail`
--
ALTER TABLE `penerimaan_barang_detail`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `piutang_dibayar_history`
--
ALTER TABLE `piutang_dibayar_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `piutang_history`
--
ALTER TABLE `piutang_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `retur_detail`
--
ALTER TABLE `retur_detail`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stok_adjustment`
--
ALTER TABLE `stok_adjustment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stok_opname`
--
ALTER TABLE `stok_opname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_detail_stok`
--
ALTER TABLE `tbl_detail_stok`
  MODIFY `id_detail_stok` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash_in_out`
--
ALTER TABLE `cash_in_out`
  ADD CONSTRAINT `cash_in_out_ibfk_1` FOREIGN KEY (`kode_rekening`) REFERENCES `rekening_kode` (`kode_rekening`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cash_in_out_ibfk_2` FOREIGN KEY (`id_hutang_dibayar`) REFERENCES `hutang_dibayar_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cash_in_out_ibfk_3` FOREIGN KEY (`id_piutang_dibayar`) REFERENCES `piutang_dibayar_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cash_in_out_ibfk_4` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hutang_dibayar_history`
--
ALTER TABLE `hutang_dibayar_history`
  ADD CONSTRAINT `hutang_dibayar_history_ibfk_1` FOREIGN KEY (`id_hutang`) REFERENCES `hutang_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hutang_history`
--
ALTER TABLE `hutang_history`
  ADD CONSTRAINT `hutang_history_ibfk_1` FOREIGN KEY (`nomor_faktur`) REFERENCES `pembelian_langsung` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hutang_history_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `master_supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kartu_stok`
--
ALTER TABLE `kartu_stok`
  ADD CONSTRAINT `kartu_stok_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kartu_stok_ibfk_2` FOREIGN KEY (`nomor_rec_penerimaan`) REFERENCES `penerimaan_barang` (`nomor_rec`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kartu_stok_ibfk_3` FOREIGN KEY (`id_stok_keluar`) REFERENCES `stok_keluar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kartu_stok_ibfk_5` FOREIGN KEY (`id_stok_opname`) REFERENCES `stok_opname` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kartu_stok_ibfk_6` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori_user`
--
ALTER TABLE `kategori_user`
  ADD CONSTRAINT `kategori_user_ibfk_1` FOREIGN KEY (`beranda`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori_user_modul`
--
ALTER TABLE `kategori_user_modul`
  ADD CONSTRAINT `kategori_user_modul_ibfk_1` FOREIGN KEY (`kategori_user`) REFERENCES `kategori_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategori_user_modul_ibfk_2` FOREIGN KEY (`modul`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `master_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `master_pembeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang_detail`
--
ALTER TABLE `keranjang_detail`
  ADD CONSTRAINT `keranjang_detail_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_detail_ibfk_2` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_admin`
--
ALTER TABLE `master_admin`
  ADD CONSTRAINT `master_admin_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_langsung_detail`
--
ALTER TABLE `pembelian_langsung_detail`
  ADD CONSTRAINT `pembelian_langsung_detail_ibfk_1` FOREIGN KEY (`nomor_faktur`) REFERENCES `pembelian_langsung` (`nomor_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_langsung_detail_ibfk_2` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penerimaan_barang_detail`
--
ALTER TABLE `penerimaan_barang_detail`
  ADD CONSTRAINT `penerimaan_barang_detail_ibfk_1` FOREIGN KEY (`nomor_rec`) REFERENCES `penerimaan_barang` (`nomor_rec`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `master_pembeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `master_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`admin_retur`) REFERENCES `master_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_detail_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan_pembayaran`
--
ALTER TABLE `penjualan_pembayaran`
  ADD CONSTRAINT `penjualan_pembayaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `piutang_dibayar_history`
--
ALTER TABLE `piutang_dibayar_history`
  ADD CONSTRAINT `piutang_dibayar_history_ibfk_1` FOREIGN KEY (`id_piutang`) REFERENCES `piutang_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `piutang_history`
--
ALTER TABLE `piutang_history`
  ADD CONSTRAINT `piutang_history_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `master_pembeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `piutang_history_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `master_supplier` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD CONSTRAINT `purchase_order_detail_ibfk_1` FOREIGN KEY (`nomor_po`) REFERENCES `purchase_order` (`nomor_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_order_detail_ibfk_2` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur_detail`
--
ALTER TABLE `retur_detail`
  ADD CONSTRAINT `retur_detail_ibfk_1` FOREIGN KEY (`nomor_retur`) REFERENCES `retur_pembelian` (`nomor_retur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  ADD CONSTRAINT `retur_pembelian_ibfk_1` FOREIGN KEY (`nomor_faktur`) REFERENCES `pembelian_langsung` (`nomor_faktur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retur_pembelian_ibfk_2` FOREIGN KEY (`nomor_rec_penerimaan`) REFERENCES `penerimaan_barang` (`nomor_rec`) ON UPDATE CASCADE;

--
-- Constraints for table `stok_adjustment`
--
ALTER TABLE `stok_adjustment`
  ADD CONSTRAINT `stok_adjustment_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_keluar_ibfk_2` FOREIGN KEY (`nomor_retur_pembelian`) REFERENCES `retur_pembelian` (`nomor_retur`) ON UPDATE CASCADE;

--
-- Constraints for table `stok_opname`
--
ALTER TABLE `stok_opname`
  ADD CONSTRAINT `stok_opname_ibfk_1` FOREIGN KEY (`kode_item`) REFERENCES `master_item` (`kode_item`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
