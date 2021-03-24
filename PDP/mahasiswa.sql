-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2017 pada 06.41
-- Versi Server: 5.5.34
-- Versi PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE IF NOT EXISTS `biodata` (
  `nim` char(9) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`nim`, `nama`, `alamat`) VALUES
('161401075', 'Randy Fikri', 'Medan'),
('161401087', 'Theo Ignathius', 'Binjai'),
('161401090', 'William', 'abdul'),
('161401093', 'Winto Junior Khosasih', 'jl.kambes'),
('161401096', 'Hensen Tia', 'Jl.Pembangunan'),
('161401135', 'Ricky Yohannes', 'jakarta'),
('161401138', 'Joshua JR sidabutar', 'medan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `general`
--

CREATE TABLE IF NOT EXISTS `general` (
  `foto` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `general`
--

INSERT INTO `general` (`foto`, `username`, `pesan`, `tanggal`) VALUES
('ikon/user.jpg', 'winto', 'saya', '2017-07-05 04:34:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `grup` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `sesi` varchar(255) NOT NULL,
  PRIMARY KEY (`grup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('winto', 'winto123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `username` varchar(255) NOT NULL,
  `pesan` longtext NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`username`, `pesan`, `tanggal`) VALUES
('winto', 'first launching', '2017-06-22 14:39:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `foto` varchar(255) NOT NULL DEFAULT 'ikon/user.jpg',
  `nim` int(11) NOT NULL,
  `nama` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `jeniskelamin` varchar(254) NOT NULL,
  `username` varchar(254) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`nama`,`email`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `signup`
--

INSERT INTO `signup` (`foto`, `nim`, `nama`, `email`, `jeniskelamin`, `username`, `password`) VALUES
('ikon/user.jpg', 161401093, 'Winto Junior Khosasih', 'piao.wjk@gmail.com', 'laki-laki', 'winto', 'winto12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
