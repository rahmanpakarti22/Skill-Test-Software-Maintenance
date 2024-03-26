-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Mar 2024 pada 06.25
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
-- Database: `coffe_web_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` int(11) NOT NULL,
  `distributor_name` varchar(100) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `distributor_name`, `city`, `state`, `country`, `phone`, `email`) VALUES
(2, 'Coffwe Galore', 'Capabele san Jase', '-', 'Macau', '+31 104587148', 'seloonten@coffegalore.com'),
(8, 'dis_2', 'test_1', '2', 'India', '+31 104587148', 'test@gmail.com'),
(12, 'dis_2999', 'test_122444', '21', 'Taiwan', '+31 104587148', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor_user`
--

CREATE TABLE `distributor_user` (
  `id` int(11) NOT NULL,
  `id_distributor` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_dailybean`
--

CREATE TABLE `master_dailybean` (
  `id_dailybean` int(11) NOT NULL,
  `bean_of_the_day` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_dailybean`
--

INSERT INTO `master_dailybean` (`id_dailybean`, `bean_of_the_day`, `price`, `description`, `id_user`) VALUES
(1, 'Cubita', 11.00, 'Cubita Coffe is sun dried and hand sorted, It originates from an elavation of over 2000 neters in the Andes Mountains of Ecuador, which is located closser to the sin on he Equator. Superb aroma and rich flavor\n', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_katalog`
--

CREATE TABLE `master_katalog` (
  `id_katalog` int(11) NOT NULL,
  `bean_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_katalog`
--

INSERT INTO `master_katalog` (`id_katalog`, `bean_name`, `description`, `price`) VALUES
(9, 'Cubita', 'Cubita Coffe is sun dried and hand sorted, It originates from an elavation of over 2000 neters in the Andes Mountains of Ecuador, which is located closser to the sin on he Equator. Superb aroma and rich flavor', '$12.00'),
(10, 'Colombian', 'This smoot full flavered coffe from Colombian boasted a sweet delicate and a rich, balance flavor A clasic, coffie approriate  for any occasion', '$13.50'),
(14, 'kenyan', 'test', '$9.55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_user`
--

CREATE TABLE `master_user` (
  `id_user` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_user`
--

INSERT INTO `master_user` (`id_user`, `user_id`, `password`) VALUES
(1, 'user_1', '123456789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload`
--

CREATE TABLE `upload` (
  `id_upload` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `upload`
--

INSERT INTO `upload` (`id_upload`, `judul`, `file`, `author`, `id_user`) VALUES
(1, 'test_1', 'file/discord.png', 'discord', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_katalog`
--

CREATE TABLE `user_katalog` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_katalog` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indeks untuk tabel `distributor_user`
--
ALTER TABLE `distributor_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_distributor` (`id_distributor`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `master_dailybean`
--
ALTER TABLE `master_dailybean`
  ADD PRIMARY KEY (`id_dailybean`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `master_katalog`
--
ALTER TABLE `master_katalog`
  ADD PRIMARY KEY (`id_katalog`);

--
-- Indeks untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id_upload`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user_katalog`
--
ALTER TABLE `user_katalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_katalog` (`id_katalog`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `distributor_user`
--
ALTER TABLE `distributor_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_dailybean`
--
ALTER TABLE `master_dailybean`
  MODIFY `id_dailybean` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_katalog`
--
ALTER TABLE `master_katalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `upload`
--
ALTER TABLE `upload`
  MODIFY `id_upload` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_katalog`
--
ALTER TABLE `user_katalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `distributor_user`
--
ALTER TABLE `distributor_user`
  ADD CONSTRAINT `distributor_user_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`),
  ADD CONSTRAINT `distributor_user_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `master_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `master_dailybean`
--
ALTER TABLE `master_dailybean`
  ADD CONSTRAINT `master_dailybean_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `master_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `master_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `user_katalog`
--
ALTER TABLE `user_katalog`
  ADD CONSTRAINT `user_katalog_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `master_user` (`id_user`),
  ADD CONSTRAINT `user_katalog_ibfk_2` FOREIGN KEY (`id_katalog`) REFERENCES `master_katalog` (`id_katalog`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
