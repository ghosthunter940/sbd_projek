-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2024 pada 10.14
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
-- Database: `ukt_system`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banding_ukt`
--

CREATE TABLE `banding_ukt` (
  `banding_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `dokumen_pendukung` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Diterima','Ditolak') DEFAULT 'Pending',
  `tanggal_pengajuan` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `banding_ukt`
--

INSERT INTO `banding_ukt` (`banding_id`, `user_id`, `alasan`, `dokumen_pendukung`, `status`, `tanggal_pengajuan`) VALUES
(1, 6, 'saya tidak memiliki uang yang banyak dan cape', '231712050_Gonter Munte_Tugas6.pdf', 'Pending', '2024-12-03'),
(2, 6, 'saya tidak memiliki uang yang banyak dan cape', '231712050_Gonter Munte_Tugas6.pdf', 'Pending', '2024-12-03'),
(3, 6, 'saya tidak memiliki uang yang banyak dan cape', '231712050_Gonter Munte_Tugas6.pdf', 'Pending', '2024-12-03'),
(4, 7, 'jalan pergi ke semarang', 'Ginting.docx', 'Pending', '2024-12-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `ukt` double NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nim`, `fakultas`, `jurusan`, `ukt`, `email`, `password`) VALUES
(1, 'GONTER MUNTE', '231712050', 'vokasi', 'd3ti', 40000, 'gontermunte@gmail.com', '$2y$10$AblUtfrmHGtpozp8e3EafuCfFFaUN6j/tKDIarKdQ3c.StP.4RARy'),
(4, 'kusang', '12551166', 'gramen', 'pajero', 4900, 'redmigonter@gmail.com', '$2y$10$w4w3uHfKxwI2psGZx5Rfv.4ZAZ68sHT9/gyBbBxdxaktOs3/Kw/GG'),
(6, 'ghost', '12222', 'vokasi', 'd3ti', 40000, 'gonter@gmail.com', '$2y$10$rCr5xf/bM423iebnFMUz8ekdKb.KarbOMBdyYDj1KOX.6mHY604Nq'),
(7, 'james', '111111', 'vokas', 'ti', 5000, 'gonterxiaomi@gmail.com', '$2y$10$3wQNGD/M5K1K/yVOcHwDQ.P6b0f7f9knabe68/D6baHhaMBkhoE.e');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banding_ukt`
--
ALTER TABLE `banding_ukt`
  ADD PRIMARY KEY (`banding_id`),
  ADD KEY `fk_banding_user` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banding_ukt`
--
ALTER TABLE `banding_ukt`
  MODIFY `banding_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `banding_ukt`
--
ALTER TABLE `banding_ukt`
  ADD CONSTRAINT `banding_ukt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_banding_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
