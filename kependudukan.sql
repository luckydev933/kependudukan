-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2022 pada 08.18
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kependudukan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kelahiran`
--

CREATE TABLE `data_kelahiran` (
  `kd_kelahiran` varchar(18) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `berat_lahir` double NOT NULL,
  `nik_ibu` varchar(16) NOT NULL,
  `nik_ayah` varchar(16) NOT NULL,
  `lampiran_surat_lahir` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_keluarga`
--

CREATE TABLE `data_keluarga` (
  `kd_keluarga` varchar(18) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `lampiran_kk` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pernikahan`
--

CREATE TABLE `data_pernikahan` (
  `nik` varchar(16) NOT NULL,
  `tanggal_pernikahan` date NOT NULL,
  `jumlah_anak` int(11) NOT NULL,
  `status_keluarga` varchar(1) NOT NULL,
  `no_akta_nikah` varchar(33) NOT NULL,
  `lampiran_buku_nikah` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pernikahan`
--

INSERT INTO `data_pernikahan` (`nik`, `tanggal_pernikahan`, `jumlah_anak`, `status_keluarga`, `no_akta_nikah`, `lampiran_buku_nikah`, `created_time`) VALUES
('630103240695', '2022-02-13', 0, 'S', '0215/012/VIII/2022', 'halsuami.jpg', '2022-02-18 15:11:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(33) NOT NULL,
  `password` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kependudukan`
--

CREATE TABLE `master_kependudukan` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `kd_pekerjaan` varchar(3) NOT NULL,
  `kd_status_nikah` varchar(3) NOT NULL,
  `jenis_kelamin` varchar(2) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `kd_pendidikan` varchar(4) NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `alamat_domisili` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_kependudukan`
--

INSERT INTO `master_kependudukan` (`id`, `nik`, `nama`, `alamat_ktp`, `kd_pekerjaan`, `kd_status_nikah`, `jenis_kelamin`, `agama`, `kd_pendidikan`, `rt`, `rw`, `alamat_domisili`, `tanggal_lahir`, `created_time`) VALUES
(1, '630103240695', 'Mulyadi', 'Jl. Perintis Kemerdekaan No 41, RT 001, RW 005 , Kelurahan Pasar Lama, Kecamatan Banjarmasin Tengah, Banjarmasin, kalimantan Selatan', 'P3', 'NK0', 'L', 'Islam', 'PD3', '005', '001', 'Desa tajau Pecah', '1995-06-24', '2022-02-18 01:32:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pekerjaan`
--

CREATE TABLE `master_pekerjaan` (
  `kd_pekerjaan` varchar(3) NOT NULL,
  `nama_pekerjaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_pekerjaan`
--

INSERT INTO `master_pekerjaan` (`kd_pekerjaan`, `nama_pekerjaan`, `alamat`) VALUES
('P1', 'Pegawai Negeri Sipil (PNS)', ''),
('P2', 'Karyawan Swasta / BUMN / BUMD', ''),
('P3', 'Wiraswasta', ''),
('P4', 'Outsourcing', ''),
('P5', 'Petani', ''),
('P6', 'Nelayan', ''),
('P7', 'Buruh Lepas', ''),
('P8', 'Lainnya', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pendidikan`
--

CREATE TABLE `master_pendidikan` (
  `kd_pendidikan` varchar(4) NOT NULL,
  `nama_pendidikan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_pendidikan`
--

INSERT INTO `master_pendidikan` (`kd_pendidikan`, `nama_pendidikan`) VALUES
('PD0', 'Tidak Tamat SD'),
('PD1', 'Sekolah Dasar (SD / Sederajat)'),
('PD10', 'Doktor S3'),
('PD2', 'SLTP (Mts / SMP / Sederajat)'),
('PD3', 'SLTA (SMK / SMA / Sederajat)'),
('PD4', 'Diploma I'),
('PD5', 'Diploma II'),
('PD6', 'Diploma III'),
('PD7', 'Diploma IV'),
('PD8', 'Sarjana S1'),
('PD9', 'Pra Sarjana S2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_status_nikah`
--

CREATE TABLE `master_status_nikah` (
  `kd_status_nikah` varchar(3) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_status_nikah`
--

INSERT INTO `master_status_nikah` (`kd_status_nikah`, `keterangan`) VALUES
('NK0', 'Kawin'),
('NK1', 'Belum Kawin'),
('NK2', 'Cerai Talak'),
('NK3', 'Cerai Mati');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kelahiran`
--
ALTER TABLE `data_kelahiran`
  ADD KEY `nik_ibu` (`nik_ibu`),
  ADD KEY `nik_ayah` (`nik_ayah`);

--
-- Indeks untuk tabel `data_keluarga`
--
ALTER TABLE `data_keluarga`
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `data_pernikahan`
--
ALTER TABLE `data_pernikahan`
  ADD KEY `pernikahan_nik` (`nik`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `master_kependudukan`
--
ALTER TABLE `master_kependudukan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `kd_pekerjaan` (`kd_pekerjaan`),
  ADD KEY `kd_status_nikah` (`kd_status_nikah`),
  ADD KEY `kd_pendidikan` (`kd_pendidikan`);

--
-- Indeks untuk tabel `master_pekerjaan`
--
ALTER TABLE `master_pekerjaan`
  ADD PRIMARY KEY (`kd_pekerjaan`);

--
-- Indeks untuk tabel `master_pendidikan`
--
ALTER TABLE `master_pendidikan`
  ADD PRIMARY KEY (`kd_pendidikan`);

--
-- Indeks untuk tabel `master_status_nikah`
--
ALTER TABLE `master_status_nikah`
  ADD PRIMARY KEY (`kd_status_nikah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_kependudukan`
--
ALTER TABLE `master_kependudukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_kelahiran`
--
ALTER TABLE `data_kelahiran`
  ADD CONSTRAINT `kelahiran_nik_ayah` FOREIGN KEY (`nik_ayah`) REFERENCES `master_kependudukan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelahiran_nik_ibu` FOREIGN KEY (`nik_ibu`) REFERENCES `master_kependudukan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_keluarga`
--
ALTER TABLE `data_keluarga`
  ADD CONSTRAINT `keluarga_nik` FOREIGN KEY (`nik`) REFERENCES `master_kependudukan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_pernikahan`
--
ALTER TABLE `data_pernikahan`
  ADD CONSTRAINT `pernikahan_nik` FOREIGN KEY (`nik`) REFERENCES `master_kependudukan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `master_kependudukan`
--
ALTER TABLE `master_kependudukan`
  ADD CONSTRAINT `pekerjaan` FOREIGN KEY (`kd_pekerjaan`) REFERENCES `master_pekerjaan` (`kd_pekerjaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendidikan` FOREIGN KEY (`kd_pendidikan`) REFERENCES `master_pendidikan` (`kd_pendidikan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_nikah` FOREIGN KEY (`kd_status_nikah`) REFERENCES `master_status_nikah` (`kd_status_nikah`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
