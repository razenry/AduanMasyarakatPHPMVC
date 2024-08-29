-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2024 pada 09.54
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wimcycle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`) VALUES
(1, 'Sepeda Gunung (Mountain Bike)', 'Dirancang untuk menempuh medan yang kasar dan berbatu, sepeda gunung biasanya memiliki ban yang lebar dengan tapak yang kasar, suspensi depan dan/atau belakang untuk mengurangi guncangan, serta frame yang kuat dan tahan lama. Cocok untuk trail dan jalur off-road.', '1'),
(2, 'Sepeda Jalan (Road Bike)', 'Dikenal dengan desain aerodinamis dan ringan, sepeda jalan memiliki ban yang sempit dan tekanan tinggi untuk mengurangi gesekan. Dapat digunakan untuk bersepeda di jalan raya dan perjalanan jarak jauh dengan kecepatan tinggi. Biasanya tidak dilengkapi dengan suspensi.', '1'),
(3, 'Sepeda Hybrid', 'Menggabungkan fitur sepeda jalan dan sepeda gunung, sepeda hybrid menawarkan kenyamanan dan fleksibilitas. Memiliki ban yang lebih lebar daripada sepeda jalan, tetapi tidak sebesar sepeda gunung, dan sering kali dilengkapi dengan beberapa tingkat suspensi. Cocok untuk bersepeda di berbagai jenis permukaan jalan.', '1'),
(4, 'Sepeda Lipat (Folding Bike)', 'Sepeda yang dirancang agar dapat dilipat dan disimpan dalam ukuran kecil. Ideal untuk komuter yang membutuhkan transportasi praktis dan penyimpanan yang mudah, terutama bagi mereka yang menggunakan transportasi umum atau memiliki ruang terbatas.', '1'),
(5, 'Sepeda BMX', 'Dirancang khusus untuk trik dan balapan di lintasan yang pendek dan bergelombang, sepeda BMX memiliki frame kecil dan kuat, serta ban yang tebal. Sepeda ini sering digunakan untuk aksi freestyle dan balapan BMX.', '1'),
(6, 'Sepeda Balap (Racing Bike)', 'Sepeda ini adalah versi khusus dari sepeda jalan yang didesain untuk kecepatan dan efisiensi maksimum dalam balapan. Memiliki frame yang sangat ringan, komponen aerodinamis, dan ban sempit. Cocok untuk perlombaan dan bersepeda jarak jauh dengan fokus pada performa.', '1'),
(7, 'Sepeda Kota (City Bike)', 'Dirancang untuk kenyamanan dan kemudahan berkendara di lingkungan perkotaan, sepeda kota sering dilengkapi dengan aksesori seperti rak depan dan belakang, lampu, dan bel. Memiliki desain yang lebih santai dengan posisi berkendara yang tegak.', '1'),
(8, 'Sepeda Elektrik (E-Bike)', 'Sepeda ini dilengkapi dengan motor listrik yang membantu pengendara dalam bersepeda. Motor ini dapat memberikan dorongan pada pedal atau bahkan bisa digerakkan secara penuh. Cocok untuk perjalanan jauh, mendaki bukit, atau membantu dalam bersepeda di kota.', '1'),
(9, 'Sepeda Touring', 'Didesain untuk perjalanan jauh dengan beban berat, sepeda touring memiliki frame yang kuat, fitur tambahan seperti rak bagasi, dan ruang untuk ban yang lebih lebar. Dirancang untuk kenyamanan dan stabilitas saat mengangkut perlengkapan perjalanan.', '1'),
(10, 'Sepeda Cruiser', 'Memiliki desain yang klasik dengan posisi berkendara yang santai dan nyaman. Sepeda cruiser sering dilengkapi dengan ban besar, kursi empuk, dan desain retro. Ideal untuk bersepeda santai di sepanjang pantai atau jalan-jalan kota.', '1'),
(16, 'sepeda', 'asdasd', '1'),
(17, 'defaultx', 'xcXXXvbcb cbc', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slides`
--

INSERT INTO `slides` (`id`, `name`, `file`, `description`, `status`) VALUES
(1, 'Banner 2', '', 'asdasdasd', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`) VALUES
(1, 'Kafkariela Prima Rasendriya', 'kafkariela150@gmail.com', 'admin', '$2y$10$Nn9mXbBHGnwnFo0Nxu0sx.XiVj69zK6cMdvR4AzimahDE14U2chqW', 'Admin'),
(2, 'Sultan M. Al-Fatih', 'sultannnigger@gmail.com', 'nigga kecap', '$2y$10$Nn9mXbBHGnwnFo0Nxu0sx.XiVj69zK6cMdvR4AzimahDE14U2chqW', 'Support');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
