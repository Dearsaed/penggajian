-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Feb 2024 pada 15.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_karyawan` int(100) NOT NULL,
  `tanggal` date NOT NULL,
  `presensi` tinyint(1) NOT NULL,
  `lembur` int(100) NOT NULL,
  `pot` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_karyawan`, `tanggal`, `presensi`, `lembur`, `pot`) VALUES
(1, '2024-02-04', 1, 0, 0),
(2, '2024-02-04', 1, 0, 0),
(3, '2024-02-04', 1, 0, 0),
(4, '2024-02-04', 0, 0, 0),
(5, '2024-02-04', 1, 0, 0),
(1, '2024-02-03', 0, 0, 0),
(2, '2024-02-03', 0, 0, 0),
(3, '2024-02-03', 0, 0, 0),
(4, '2024-02-03', 0, 0, 0),
(5, '2024-02-03', 1, 0, 0),
(6, '2024-02-03', 1, 0, 0),
(1, '2024-02-01', 0, 0, 0),
(2, '2024-02-01', 1, 0, 0),
(3, '2024-02-01', 1, 0, 0),
(4, '2024-02-01', 0, 0, 0),
(5, '2024-02-01', 1, 0, 0),
(6, '2024-02-01', 0, 0, 0),
(1, '2024-02-02', 0, 0, 1),
(2, '2024-02-02', 1, 0, 0),
(3, '2024-02-02', 1, 0, 0),
(4, '2024-02-02', 0, 0, 0),
(5, '2024-02-02', 1, 0, 0),
(6, '2024-02-02', 0, 0, 0),
(6, '2024-02-04', 0, 0, 0),
(1, '2024-02-05', 1, 0, 0),
(2, '2024-02-05', 1, 0, 0),
(3, '2024-02-05', 1, 0, 0),
(4, '2024-02-05', 0, 0, 0),
(5, '2024-02-05', 1, 0, 0),
(6, '2024-02-05', 0, 0, 0),
(1, '2024-02-06', 1, 0, 0),
(2, '2024-02-06', 1, 0, 0),
(3, '2024-02-06', 1, 0, 0),
(4, '2024-02-06', 0, 0, 0),
(5, '2024-02-06', 1, 0, 0),
(6, '2024-02-06', 0, 0, 0),
(1, '2024-02-07', 1, 0, 0),
(2, '2024-02-07', 1, 0, 0),
(3, '2024-02-07', 1, 0, 0),
(4, '2024-02-07', 0, 0, 0),
(5, '2024-02-07', 1, 0, 0),
(6, '2024-02-07', 0, 0, 0),
(1, '2024-02-08', 1, 0, 0),
(2, '2024-02-08', 1, 0, 0),
(3, '2024-02-08', 1, 0, 0),
(4, '2024-02-08', 0, 0, 0),
(5, '2024-02-08', 1, 0, 0),
(6, '2024-02-08', 0, 0, 0),
(1, '2024-02-09', 1, 0, 0),
(2, '2024-02-09', 1, 0, 0),
(3, '2024-02-09', 1, 0, 0),
(4, '2024-02-09', 0, 0, 0),
(5, '2024-02-09', 1, 0, 0),
(6, '2024-02-09', 0, 0, 0),
(1, '2024-02-10', 1, 0, 0),
(2, '2024-02-10', 1, 0, 0),
(3, '2024-02-10', 1, 0, 0),
(4, '2024-02-10', 0, 0, 0),
(5, '2024-02-10', 1, 0, 0),
(6, '2024-02-10', 0, 0, 0),
(9, '2024-02-04', 0, 0, 0),
(9, '2024-02-05', 0, 0, 0),
(9, '2024-02-06', 0, 0, 0),
(9, '2024-02-07', 0, 0, 0),
(9, '2024-02-08', 0, 0, 0),
(9, '2024-02-09', 0, 0, 0),
(9, '2024-02-10', 0, 0, 0),
(12, '2024-02-04', 1, 0, 0),
(12, '2024-02-05', 1, 0, 0),
(12, '2024-02-06', 1, 0, 0),
(12, '2024-02-07', 1, 0, 0),
(12, '2024-02-08', 1, 0, 0),
(12, '2024-02-09', 1, 0, 0),
(12, '2024-02-10', 1, 0, 0),
(9, '2024-02-01', 0, 0, 0),
(12, '2024-02-01', 0, 0, 0),
(14, '2024-02-01', 0, 0, 0),
(15, '2024-02-01', 1, 0, 0),
(9, '2024-02-02', 0, 0, 0),
(12, '2024-02-02', 0, 0, 0),
(14, '2024-02-02', 0, 0, 0),
(15, '2024-02-02', 1, 0, 0),
(9, '2024-02-03', 0, 0, 0),
(12, '2024-02-03', 0, 0, 0),
(14, '2024-02-03', 0, 0, 0),
(15, '2024-02-03', 1, 0, 0),
(14, '2024-02-04', 0, 0, 0),
(15, '2024-02-04', 0, 0, 0),
(14, '2024-02-05', 0, 0, 0),
(15, '2024-02-05', 0, 0, 0),
(14, '2024-02-06', 0, 0, 0),
(15, '2024-02-06', 1, 0, 0),
(14, '2024-02-07', 0, 0, 0),
(15, '2024-02-07', 1, 0, 0),
(14, '2024-02-08', 0, 0, 0),
(15, '2024-02-08', 1, 0, 0),
(14, '2024-02-09', 0, 0, 0),
(15, '2024-02-09', 1, 0, 0),
(14, '2024-02-10', 0, 0, 0),
(15, '2024-02-10', 0, 20000, 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `gaji`) VALUES
(1, 'a', 50000),
(2, 'b', 50000),
(3, 'c', 80000),
(4, 'd', 80000),
(5, 'e', 95000),
(6, 'f', 50000),
(9, 'h', 50000),
(12, 'j', 40000),
(14, 'k', 70000),
(15, 'l', 55000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
