-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 08:52 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ktp`
--

CREATE TABLE `tbl_ktp` (
  `nik` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `golongan_darah` varchar(3) NOT NULL,
  `alamat_lengkap` varchar(200) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status_kawin` varchar(25) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `kewarganegaraan` varchar(25) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ktp`
--

INSERT INTO `tbl_ktp` (`nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `alamat_lengkap`, `agama`, `status_kawin`, `pekerjaan`, `kewarganegaraan`, `foto`) VALUES
('1801070310930005', 'SATRIA BAJA HITAM', 'GEREM', '1993-10-03', 'Laki-laki', '-', 'GEREM DUSUN KALIMATI RT 003 RW 005 DESA BANDAR DALAM KECAMATAN SIDOMULYO KABUPATEN LAMPUNG SELATAN PROVINSI LAMPUNG', 'islam', 'BELUM KAWIN', 'TIDAK BEKERJA', 'WNI', '92944_satria.jpg'),
('327106430874006', 'LINDA YUNUS', 'BOGOR', '1974-08-03', 'Perempuan', '-', 'JALAN ARIF RAHMAN HAKIM IV RT 002 RW 002 KELURAHAN KAUMAN KECAMATAN KLOJEN KOTA MALANG JAWA TIMUR', 'islam', 'KAWIN', 'KARYAWAN SWASTA', 'WNI', '57354_linda.jpg'),
('3273201609810003', 'NAZRIL IRHAM', 'BRANDAN', '1981-09-16', 'Laki-laki', 'O', 'JALAN TANJUNGSARI RAYA NO.58 RT 004 RW 006 KELURAHAN ANTAPANI WETAN KECAMATAN ANTAPANI KOTA BANDUNG', 'islam', 'CERAI', 'SENIMAN', 'WNI', '48715_irham.jpg'),
('3308114611890002', 'AMRIH SATITI GRAHITA NUR UTAMI', 'MAGELANG', '1989-11-06', 'Perempuan', 'B', 'DUSUN SIDOMUKTI  RT 001 RW 001 KELURAHAN SIDOAGUNG KECAMATAN TEMPURAN KABUPATEN MAGELANG PROVINSI JAWA TENGAH ', 'islam', 'BELUM KAWIN', 'MAHASISWA', 'WNI', '79074_satiti.jpg'),
('3311092006680005', 'AHMAD MUSTAQIM', 'SURAKARTA', '1980-06-20', 'Laki-laki', 'O', 'DK. NURICIK RT 002/ RW 005 DESA GRAJEGAN KECAMATAN TAWANGSARI KABUPATEN SUKOHARJO JAWA TENGAH', 'islam', 'KAWIN', 'KARYAWAN SWASTA', 'WNI', '4724_amus.jpg'),
('3402100901810001', 'BEJO', 'BANTUL', '1981-01-09', 'Laki-laki', 'A', 'MENGGER RT 006 RW 010 DESA KARANGASEM KECAMATAN PALIYAN KABUPATEN GUNUNG KIDUL PROVINSI DIY  ', 'islam', 'KAWIN', 'BURUH', 'WNI', '81106_BEJO.jpg'),
('3506042602660001', 'SULISTYONO', 'KEDIRI', '1966-02-26', 'Laki-laki', '-', 'JALAN RAYA DUSUN PURWOKERTO RT 002  RW 003 KELURAHAN PURWOKERTO KECAMATAN NGADILUWIH KABUPATEN KEDIRI JAWA TIMUR', 'islam', 'KAWIN', 'GURU', 'WNI', '83853_sulistyono.jpg'),
('3674066206890004', 'RESTI HARIZONA ZALDI', 'PADANG', '1989-06-22', 'Perempuan', '-', 'JALAN BULAK WANGI RAYA NO. 2C RT 009 RW 003 DESA KEDAUNG KECAMATAN PAMULANG KOTA TANGERANG SELATAN PROVINSI BANTEN', 'islam', 'BELUM KAWIN', 'KARYAWAN SWASTA', 'WNI', '55642_resti.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(25) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `nama_user`, `username`, `password`, `status`) VALUES
('user00', 'root', 'admin', 'admin', 'administrator'),
('user01', 'Didi Purnomo', 'siipur', 'cahbrebes', 'admininstrator'),
('user03', 'awam setionegoro', 'warga', 'lupa', 'warga'),
('user04', 'syahnan ahya ronindi', 'jakwirtkj', 'rahasia', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ktp`
--
ALTER TABLE `tbl_ktp`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
