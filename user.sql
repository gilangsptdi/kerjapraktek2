-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2024 pada 06.48
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kode_user` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namauser` varchar(30) NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kode_user`, `username`, `password`, `namauser`, `foto`) VALUES
(2, 'enzodlaw', '$2y$10$y61BM/c94L3tr6tdkL.qLuzk0myMU1fLPUhy1JYmM.5eRfNPuxqPK', 'GILANG SEPTIADI', 0x463a78616d7070096d70706870464538392e746d70),
(3, 'ggwp', '$2y$10$CEa0MmLf5mibURKis.8x/edcRl2ZlMJRmAfPf9u9mZKWEWUmFINvy', 'Guntur bumi', 0x463a78616d7070096d70706870434234322e746d70),
(4, 'somat', '$2y$10$WfKKDJNgPczGCj2nVAE0QeSfa/qVoeZ91OaOr393coJThN39GQswm', 'somat asik', 0x463a78616d7070096d70706870393844372e746d70),
(5, 'enzodlaw', '$2y$10$iUX23rwPkKNlYWU1i4ynNev1hpNK2Uro8Nv0dwbeuGike46AfJqw2', 'Gilang ', 0x463a78616d7070096d70706870443231302e746d70),
(6, 'enzodlaw', '$2y$10$iOPGPlN5IWV6nUMlJPx9TOYFdw7z5mjxQC.BgLnGV1Tkkjs3d7fse', 'Gilang ', 0x463a78616d7070096d70706870353543412e746d70),
(7, 'dosen', '$2y$10$0Hrz1JpGuOMNSSnFN4m1EOCRU1ipxgNRcnpsCrj1yiVINjoyQj4Le', 'Guntur bumi', 0x463a78616d7070096d70706870323232422e746d70),
(8, 'dosen', '$2y$10$HQnCSvafS.AljeTcgDMPB.PewxXo2s7yfdaKMob.F3F9N2/1QVHK6', 'Guntur bumi', 0x463a78616d7070096d70706870363337422e746d70),
(9, 'dosen', '$2y$10$naoY1coHgA.F8dfV/gdfd.fPMfxTm1gYH2toCv05QbAVY4wmz.dPm', 'Guntur bumi', 0x463a78616d7070096d70706870374638462e746d70),
(10, 'dosen', '$2y$10$hMaSty7brTsgnq8pY2KKGubqwnvHi6iZRhi7vTN9soaZDlEu/Cg/a', 'Guntur bumi', 0x463a78616d7070096d707068703741452e746d70);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
