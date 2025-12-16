-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2025 pada 06.52
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paketmendaki`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `harga_per_orang` decimal(10,2) NOT NULL,
  `total` decimal(12,2) GENERATED ALWAYS AS (`jumlah_orang` * `harga_per_orang`) STORED,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `paket`, `jumlah_orang`, `harga_per_orang`, `bukti_pembayaran`, `tanggal_bayar`) VALUES
(1, 'bromo', 2, 350000.00, 'bukti_6863ee450922b9.20995034.png', '2025-07-01 22:18:45'),
(2, 'bromo', 3, 350000.00, 'bukti_6863efddc6b703.17149081.png', '2025-07-01 22:25:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tanggal_pendakian` date NOT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama_lengkap`, `email`, `nomor_telepon`, `paket`, `jumlah_orang`, `tanggal_pendakian`, `catatan`, `tanggal_daftar`) VALUES
(1, 'Putri Deviyanti ', 'deviyantiputri965@gmail.com', '081805581432', 'rinjani', 1, '2025-07-05', 'ingin bermalam di langit rinjani ', '2025-07-01 13:52:14'),
(2, 'Devii', 'milkyw965@gmail.com', '081805581432', 'bromo', 2, '2025-07-19', 'menginap selama 2 hari 3 malam ', '2025-07-01 14:00:04'),
(3, 'Kania', 'kania@gmail.com', '081805581432', 'bromo', 3, '2025-07-05', 'menginap 3 hari ', '2025-07-01 14:25:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
