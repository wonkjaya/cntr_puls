-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 20. Juli 2014 jam 07:31
-- Versi Server: 5.5.37
-- Versi PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `counter_pulsa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `user_agent` varchar(14) NOT NULL DEFAULT '@',
  `nomorHp` varchar(14) NOT NULL,
  `name` varchar(10) NOT NULL DEFAULT 'REZ-',
  `code` varchar(5) NOT NULL,
  `saldo` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agents`
--

INSERT INTO `agents` (`user_agent`, `nomorHp`, `name`, `code`, `saldo`, `activated`) VALUES
('REZ-0010', '081299122149', 'Riancell', '07954', 400000, 1),
('REZ-0012', '089778776775', 'salwacell', '39471', 200000, 1),
('REZ-0013', '087665100001', 'nurhasanah', '95384', 234342, 1),
('REZ-0014', '034199822', 'makmurcell', '80032', 120000, 1),
('REZ-0015', '081224345678', 'selfiacell', '45455', 210000, 1),
('REZ-0016', '0897889887', 'rohmanCell', '89808', 80000, 1),
('REZ-0019', '0857887667', 'Riskocell', '49602', 230000, 1),
('REZ-0020', '08766776001', 'bobycell', '89777', 40788, 1),
('REZ-0021', '082988809213', 'gober Cel', '21902', 300000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `value` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `config`
--

INSERT INTO `config` (`ID`, `kode`, `nama`, `value`) VALUES
(1, 'SAL_SERV', 'saldo_server', '6498913');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `ID_deposit` varchar(17) NOT NULL DEFAULT 'DEP-',
  `tanggal_deposit` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_agent` varchar(14) NOT NULL,
  `nominal` int(9) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_deposit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`ID_deposit`, `tanggal_deposit`, `username`, `user_agent`, `nominal`, `status`) VALUES
('DEP-00000000001', '2014-07-13 08:51:54', 'root', 'REZ-0012', 100000, 2),
('DEP-00000000002', '2014-07-13 08:52:34', 'root', 'REZ-0010', 1000000, 2),
('DEP-00000000003', '2014-07-13 08:53:29', 'root', 'REZ-0013', 2000000, 2),
('DEP-00000000004', '2014-07-13 08:53:40', 'root', 'REZ-0020', 90000, 2),
('DEP-00000000006', '2014-07-13 09:04:15', 'root', 'REZ-0010', 70000, 2),
('DEP-00000000007', '2014-07-13 10:25:25', 'root', 'REZ-0016', 5000000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE IF NOT EXISTS `kasir` (
  `ID_kasir` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `kasir_name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_kasir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`ID_kasir`, `username`, `password`, `kasir_name`) VALUES
(4, 'rohim', 'TIgPM15iK2tIqO0N7GdPSAN3KRO+YFRAsMPnVS3Le3imshQs8f9CgZP0pP/rSfPt7wvzbifgNnspUBSntdqIkg==', ''),
(5, 'rohman', 'Vh7/ldT1+ACNt7+jYQ7g0exlbypX9YGt8GKuFYyUAyD+RqoeD0XtFBnO4UqcUFk4VnESNugYveUGut8+71SeEA==', ''),
(6, 'root', 'FCkrXxDaFDjoQYa5NvtjEgv4TFV1pM1AZgCt0A7yIxQqp9hCfJdiaWIwoXQuCC7qdIomdXch9neD3NrcJzGPNA==', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID_message` int(11) NOT NULL AUTO_INCREMENT,
  `send_to` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL DEFAULT 'GATOT',
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`ID_message`, `send_to`, `sender`, `message`, `status`) VALUES
(7, 'REZ-0010', 'GATOT', 'Success!!!. Transaksi Deposit dengan Nominal: 70000 Berhasil Dilakukan Pada tanggal 13-Jul-2014 10:04:15 dengan User REZ-0010', 0),
(8, 'REZ-0016', 'GATOT', 'Success!!!. Transaksi Deposit dengan Nominal: 5000000 Berhasil Dilakukan Pada tanggal 13-Jul-2014 11:25:25 dengan User REZ-0016', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provider`
--

CREATE TABLE IF NOT EXISTS `provider` (
  `kode_provider` varchar(10) NOT NULL,
  `nama_provider` varchar(30) NOT NULL,
  `nomor` varchar(14) NOT NULL DEFAULT '',
  `sisa_saldo` varchar(8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`kode_provider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provider`
--

INSERT INTO `provider` (`kode_provider`, `nama_provider`, `nomor`, `sisa_saldo`, `status`) VALUES
('axis', 'AXIS', '087887667655', '3000000', 1),
('flx', 'flexiasia', '087887667655', '1000009', 1),
('indst', 'indosat', '087887667655', '2000000', 1),
('sfren', 'smartfrend', '087887667655', '2000000', 1),
('three', 'threecom', '087887667655', '2000000', 1),
('tsel', 'telkomsel', '087887667655', '2000000', 0),
('xl', 'excelindo', '087887667655', '2000000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_topup`
--

CREATE TABLE IF NOT EXISTS `transaksi_topup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(10) NOT NULL,
  `tanggal` datetime NOT NULL,
  `user_agent` varchar(14) NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trash_items`
--

CREATE TABLE IF NOT EXISTS `trash_items` (
  `ID_trash` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(30) NOT NULL,
  `backup` text NOT NULL,
  PRIMARY KEY (`ID_trash`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `trash_items`
--

INSERT INTO `trash_items` (`ID_trash`, `table_name`, `backup`) VALUES
(16, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''@@08978899887'',''0005'',''0005'',''200000'')'),
(17, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''@@08978899887'',''0005'',''0005'',''200000'')'),
(18, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''@@08978899887'',''0005'',''0005'',''200000'')'),
(19, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''@08978899887'',''0005'',''0005'',''200000'')'),
(20, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''@08970431782'',''REZ-00003'',''00003'',''20000'')'),
(21, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0017'',''candracell'',''31798'',''688888'')'),
(22, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0004'',''Gobercell'',''00004'',''230000'')'),
(23, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0006'',''Rohmincell'',''35744'',''787777'')'),
(24, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0011'',''345345'',''09205'',''345354'')'),
(25, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0008'',''Sheilacell'',''56655'',''120000'')'),
(26, 'agents', 'INSERT INTO `agents` (`user_agent`,`name`,`code`,`saldo`) VALUES (''REZ-0009'',''winacell'',''87107'',''200000'')');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trxType`
--

CREATE TABLE IF NOT EXISTS `trxType` (
  `ID_jenis` varchar(10) NOT NULL,
  `kode_provider` varchar(10) NOT NULL,
  `nominal` varchar(7) NOT NULL DEFAULT '0',
  `harga_beli` varchar(7) NOT NULL DEFAULT '0',
  `harga_jual` varchar(7) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trxType`
--

INSERT INTO `trxType` (`ID_jenis`, `kode_provider`, `nominal`, `harga_beli`, `harga_jual`, `status`) VALUES
('im3-10', 'indst', '100000', '9900', '10300', 0),
('im3-5', 'indst', '5000', '4500', '5500', 1),
('indst-2', 'indst', '20000', '19000', '20500', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
