-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 12:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('staff','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `password`, `name`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$PPgdGGChRZbskjWCW4kzZ.EezBTE3i5OE45C3wIaIE.uXfHE2oXwe', 'Ibuk Kantin', 'admin', 'e62rcaFLk1FI4oUOP6Aupuk5bkUIQh9FdOtzVXyf1Ij8Akdis30tg0Jy7S6x', '2022-11-27 08:06:30', '2022-11-27 08:08:30'),
(2, 'zyulianti', '$2y$10$TqAQf6wa4KmW2N7rhsqgeuT39HfbP5PGpdiwNxXcgVCVsPSYLSCdi', 'Jayeng Hidayanto', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(3, 'musamah', '$2y$10$eqG7eypoohEBnVT6sUKPPOOnoWj4CtYeYaQXcyTFzYQDmTIfOkDRG', 'Makara Nainggolan', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(4, 'hhastuti', '$2y$10$UBWe3bb06ZyRt3MnAn66E.jzX2FmUwOSZw8PySGXHBP1O2JYx.O7u', 'Zalindra Pertiwi S.IP', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(5, 'kasusra.haryanti', '$2y$10$XjIZjXQy3zaxwVIdGSWKZe9HaQvYMgzy4/GeaGn2wWq4QRK/GC22S', 'Hartana Dadi Suryono S.E.', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(6, 'widya50', '$2y$10$ZrXQCNqnXO5OcB3EIxKyG.hceaLWER8BwM6uHiPjXgOpZ3.htKYvu', 'Ifa Handayani', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(7, 'zbudiyanto', '$2y$10$zqLw7xjNaUpn3PxGOM7Hl.AlY9Ty9sa8lSH1FvdVIbi5UZMMbnTve', 'Yessi Halima Purnawati', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(8, 'ywibisono', '$2y$10$iG740BCRgcvbOq0UyUizQedkUQkguDla5Q8ogTfcSaCXvJK3oACl.', 'Dartono Anggriawan', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(9, 'nova85', '$2y$10$iMCKrbl/EwEI66DVi1OE4.6.S4IApHRkTDZUG08MZz723iJQruz/G', 'Cager Sinaga', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(11, 'gaduh18', '$2y$10$fufV9H5FjjkOZu5g3dbPn.n3qQ76tXLVAb2dmDJ/x1FvN7WJWr27u', 'Hesti Melani', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(12, 'puspasari.zelaya', '$2y$10$31ROKUneKF6Puj0fr/MkDeu7ygdMNqdWDngDBRNvZrfOMAou9ipW.', 'Maria Jasmin Riyanti S.Pt', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(13, 'msihombing', '$2y$10$S.VyRlpCPvBkmv9t2xosWOcFiTRNKxUXJcIiOKhGA73i/zr7NmDY2', 'Zizi Lalita Nuraini', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(14, 'usada.ifa', '$2y$10$npuiVb4GWdohuWz.fqLBmuhcUNRCKGWHNiX9eHNe2hQGnK9ArYJ.6', 'Yulia Susanti M.Kom.', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(15, 'simanjuntak.nurul', '$2y$10$QQ8g3TcbpavTnGkvQsyW7eSYJLAqL8koB86TaG/8JNEARPk5Sxe4G', 'Umi Lailasari', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(16, 'tarihoran.eka', '$2y$10$IWhYbNcttihc/Chp5A.6hOBAQYWaF4hQvu1YnO9bNQlgL2UgtT.y2', 'Gara Damanik', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(17, 'sitorus.iriana', '$2y$10$arrbxrOijwdEbk7I2C1Gp.dw28FjCBOUv49hLh9aQQW0JU0XMpsUi', 'Raden Ramadan', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(18, 'padma78', '$2y$10$WKrMoe69dAvfD/Nj9LhVNuSBgEEn4ojSzlfMdGfOmjX7PTNzNMPIy', 'Vicky Yuni Usada', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(19, 'tugiman76', '$2y$10$T6yE5SMWrX2EzSQEXefdfOCDwx4db6tb3ATBZbj7Xk6UHmoYa8TRS', 'Hafshah Purnawati', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(20, 'yastuti', '$2y$10$0xAFjok89i9QKjiNoHm.o.JBLvWOB0fkvNy24Xr7LBf.KGjCt2eOK', 'Harjasa Prasetya', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(21, 'panca98', '$2y$10$3q2IqrGWgR1serkXfpR.IOjPsg9CXjaolwTtcWkxi/EWUqXfIcivC', 'Janet Lailasari', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(22, 'jamalia89', '$2y$10$1mp9JIaN7r072o3J6Zt4LOLp7va3gia37sRoXtnd68VWLJIoMWIom', 'Ellis Almira Wulandari', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(23, 'wastuti', '$2y$10$8PcVEcpl.Y5DcjbQ4bwt3eGK17sPgSIV.zB.qLX6gLKoP6REL0yZ6', 'Samsul Maryadi', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(24, 'novitasari.puji', '$2y$10$DjGCHJcp.hbJG8Q28HDJQes.p//1XLjfX7xFtqWrJqExceDMITORy', 'Jumadi Jatmiko Waskita S.E.I', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(25, 'pratama.novi', '$2y$10$9ZMNOWrEfKRVivkxkT0WseD2OjnwPGM1SQPMDYlDKBMMZg7vHuJ8W', 'Silvia Wastuti', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(26, 'dramadan', '$2y$10$b6z/Tc5Qj.PAX06pbC2Ez.xo6fbP86jEinDcdvaj9JWfOFD90em2q', 'Soleh Simon Budiman', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(27, 'tugiman73', '$2y$10$MgUoiVLeh/j8Ut/hGiQKZOsrsvm7QcQIevJmYYjIkglHeZUB8NGke', 'Eka Nashiruddin', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(28, 'laila.irawan', '$2y$10$y0xI6wEo1UoEsaIWh6I78u0iB.Aw9FVHsCJLGzd3V4/G30ZMdeXAi', 'Dalima Susanti', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(29, 'kasim.nurdiyanti', '$2y$10$8bpIawTHOVmlHEdiUeet4eZB0tp0VyRABJ/kS9/iu8ml.GpngjIPq', 'Victoria Raisa Rahmawati', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(30, 'shastuti', '$2y$10$qOEki4AzWHdT.NrjFy4A5Osgn9z5NnGcr7AnCS2s4AmTjUTzXXte2', 'Panji Gantar Narpati', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(31, 'rahimah.daru', '$2y$10$q0A7UTbNnhqk6NKnDwvqv.dioxe7rpWWWLqZCDEICs37qZOu2uRq.', 'Mala Kartika Padmasari S.T.', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(32, 'habibi.liman', '$2y$10$2SAcxNWZdmxONZNYC6A9Yu5fnD5fSX1B3gB0r5H6buxEmRV6PXe7m', 'Gandi Danu Nainggolan', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(33, 'latupono.laras', '$2y$10$5Z6.aKlKmK.eb.Zf3Hn0N.ptOzvHsWScWzlmvFpwBUzvpUgXWmxZW', 'Vero Narpati', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(34, 'arta.hutapea', '$2y$10$Rd2v6crO3ysUe57LayNECeE856PoKgwpyP2DR5vX83WbB8tF8jMTG', 'Aisyah Suartini', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(35, 'vega12', '$2y$10$PjnuzZODmSK.dTtiaGW/9e8ngorLWIhwEa6r4AL2Wz7ZQelTXKTY2', 'Hari Mansur', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(36, 'laksita.jelita', '$2y$10$ypFgnZb1TO72yzqOL9VjIeUffmxzPkBFStukecWBN3.rdf8l7.KV.', 'Oman Kasim Prakasa', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(37, 'nilam87', '$2y$10$fAPlc0bAxDdPO85GMarL/O.Kw5Npy257vROZ/w2m2DgtNwduvWvwS', 'Indah Prastuti S.Ked', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(38, 'adikara12', '$2y$10$I/nox.pxWYnakHjMGf/hQ.c0epWla5dgzntXBp4oU7KVVp6iOStRS', 'Cawuk Habibi', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(39, 'sidiq.suartini', '$2y$10$kHqpyaHjIyP46.dXkAN.aODy7cMuE/uBWJ5M9zB4hK9/kbPzqtJ4G', 'Vivi Pratiwi S.T.', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(40, 'lmegantara', '$2y$10$xxid2RJw7saEoxkPYp1V4uU2Cms8cFU7uUUdSddT5pHeSGoGgrRdi', 'Raditya Simanjuntak', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(41, 'genta43', '$2y$10$00CqTouC4cbCmEnXJ.GPWONCSoiVflHA04KRPNrDYUqFqXCcYtEVK', 'Rizki Latupono', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(42, 'ofirgantoro', '$2y$10$r.HA53PFRgbwNoY9YMXsfeLiXmllERM4YIW4DB6sU/ytp2q4Q3626', 'Paris Wahyuni', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(43, 'samiah.melani', '$2y$10$j6JwYObImJsKzxYCpw8trebzPOX/ieEJFf5E0XNPrdyxCKI822HNq', 'Padma Hassanah', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(44, 'oliva.mahendra', '$2y$10$kk7.f8vZ4tDe0Wo/CQVd1.ILcjE3aS9vwSwFcVpk0gocDcl/vnPVi', 'Cindy Iriana Yulianti S.E.', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(45, 'zsiregar', '$2y$10$Xcawth9Rza.dHS6mGPcfQ.DyXS87aYvN.ztpYSdA7rSquCC2pPgTy', 'Vanesa Elisa Laksmiwati', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(46, 'sihotang.syahrini', '$2y$10$noamsOxMyzcolOk8WHmAOe55hZJcdOsMb7jkQyA5vmp73umRVNu4O', 'Ciaobella Namaga', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(47, 'oni.padmasari', '$2y$10$XLjDKgsY3ZmfOErvz7h4ne7jDKdmBucZOb4/Imi9gvV9DMaanYpUm', 'Fitriani Palastri', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(48, 'haryanti.ika', '$2y$10$LlxHWjy3lh8oR5haotBJYO3u3.7um59PlDktbgjDVxEKSLXy1vcyi', 'Gara Irawan S.Psi', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(49, 'yulia.farida', '$2y$10$bpb5pVRHmdLvwhzD5ABtuO5RRc9LsWhQrzwp1DuHzWfdgRqZFjoPC', 'Yuliana Maryati M.Ak', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(50, 'genta.yuniar', '$2y$10$pvEwS7x2Y/X8QMnjx6LTLe8ksKk53lSH5kvuqLrot6McDa2hqdibi', 'Ayu Kusmawati S.I.Kom', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(51, 'calista36', '$2y$10$kZNInFhXys42aVGYJ2j1LuGJFGqmInU.L2juvB0r6PFzeRJwKEnXK', 'Bella Hariyah', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(52, 'nasyiah.bahuwarna', '$2y$10$oVc/VGu580CH0WxF74j4IOz5OlWPH/a3sMJ7yMjUMFyMIcpJNPr96', 'Asirwada Cahyadi Sitompul M.M.', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(53, 'daruna65', '$2y$10$k.08SKCNVFpPp0EcCZYOFehws/WgxD6mbUQXZjmWRnSGXlB3nSXNG', 'Icha Purnawati M.Kom.', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(54, 'pradipta.edi', '$2y$10$7dguAo1rr8dk6YfXKdEbWebiDxY5573LPc7IC3gUfJDqCKePAUKTi', 'Karimah Rahayu Hastuti S.Pd', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(55, 'wahyudin.cagak', '$2y$10$S7wIRFhdlOnl/P.0YVbb7OlAmswhuoCtW7I/NwfZxtYEfSylf/QFu', 'Asmianto Waluyo Natsir S.E.I', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(56, 'raden89', '$2y$10$1LlpPgFlEUavgOV6bHZnG..VyTs7eJkImeuDFeAp3vhIb2IOma8.G', 'Kania Usyi Utami M.M.', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(57, 'azalea.andriani', '$2y$10$b9HU3j3wLDfW6aw3njAuA.B2QO3us9g18GVASwqlw8xDKDL9V49Ya', 'Eka Prakasa S.Farm', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(58, 'tampubolon.nardi', '$2y$10$NIm96Mme8ksshGyVkm5gReL4ono2ceRocUoZr3sLfE5JNKvatfuV6', 'Prayoga Megantara', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(59, 'estiawan50', '$2y$10$l5Zdhk8Sl2jAjF8CaCFHbOhLLdl33W8KWomd.ZqzcuQ3qc0hXC1Fq', 'Kunthara Harjasa Adriansyah', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(60, 'silvia03', '$2y$10$.UR1fqdMrbgQ9sTFeGh8tOMzqicPUnv43hz2IVdlAsOA0kxjEnIeS', 'Aurora Wahyuni S.Sos', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(61, 'yuliarti.mitra', '$2y$10$RQ4DnStxf5gvMXGIDp1Ay.DJWOAavYrr9JScGV6MgoAjTRs2Z.o0i', 'Mursinin Bagiya Waskita S.E.I', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(62, 'wardi.namaga', '$2y$10$TZ89rkP9UHNmPBKDcDqyAujrG6PtuE1RzJuZb8IYU3kaJjaJIZcBu', 'Bagus Jaeman Winarno M.Kom.', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(63, 'makuta.hartati', '$2y$10$1p6cByD3ZJjBJdTuNwPHXu6y8H2jGsaKNNa8NzDdY5Zo1exJ8YONi', 'Ratih Suryatmi M.M.', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(64, 'swulandari', '$2y$10$R4RFj3O3ZGTckLgCDu9Sze2X1SPwPc1RKF3MHXv0QMS2wwg7lMDBa', 'Jaiman Mahendra', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(65, 'najmudin.rahman', '$2y$10$80244XEgL6WYR/m42LNGbOKT1ChMWXTz1PT/YFtjZvcpEMbaWeHmy', 'Caraka Winarno', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(66, 'jagaraga53', '$2y$10$bnToh27awT8ZtfsveC4NM.4x2DH2bNBLjOvaxsmVhWAtc3.k2V7KK', 'Bahuraksa Najmudin S.Gz', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(67, 'prastuti.qori', '$2y$10$hx/rcLJAVJckFQC9wUZboeqqPN7hQHOdg64HB.rO8h.oYUd.KKKm.', 'Uli Utami', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(68, 'cengkir.suryatmi', '$2y$10$2EB1zl3UMd.uYeqht8BKdeoSWNnLtre61eT6itc4D9.Ce9JKjPoLq', 'Safina Mayasari M.Farm', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(69, 'ulya73', '$2y$10$XIqg1njjWZXGAnO3elfeBejtbuPZCIzIpnLBZE.7EtzTnkV71tjdS', 'Ida Rahimah M.Pd', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(70, 'hana.napitupulu', '$2y$10$FqspixLsor1aIfmR4jzDke9E1rjun5gSGlXAfMQJfaOUlFKPnkTza', 'Cawuk Wibisono', 'staff', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35'),
(71, 'maryadi.hastuti', '$2y$10$fS.obsRbeMIuF1X/PxxutOIJH0ttvj5/AYFrj2CMogo0QBCSguAxq', 'Najwa Wastuti', 'admin', NULL, '2022-11-27 08:06:35', '2022-11-27 08:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(8,2) NOT NULL DEFAULT 0.00,
  `capital_price` bigint(20) NOT NULL DEFAULT 0,
  `measurement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `stock`, `capital_price`, `measurement_id`, `created_at`, `updated_at`) VALUES
(1, 'Ayam', 30.00, 43000, 1, '2022-11-28 09:01:25', '2022-11-29 07:48:53'),
(2, 'Susu', 15.00, 18000, 3, '2022-11-28 09:01:25', '2022-11-29 03:41:24'),
(3, 'Minyak Goreng', 50.00, 16000, 3, '2022-11-29 03:42:21', '2022-11-29 07:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_menu`
--

CREATE TABLE `ingredient_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient_menu`
--

INSERT INTO `ingredient_menu` (`id`, `quantity`, `ingredient_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(9, 2.00, 1, 2, '2022-11-29 13:02:13', '2022-11-29 13:02:13'),
(11, 3.00, 2, 1, '2022-11-29 13:02:59', '2022-11-29 13:02:59'),
(12, 1.00, 3, 2, '2022-11-29 13:03:10', '2022-11-29 13:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `long_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `long_name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Kilogram', 'Kg', '2022-11-28 08:53:13', '2022-11-28 08:53:13'),
(2, 'Gram', 'G', '2022-11-28 08:53:13', '2022-11-28 08:53:13'),
(3, 'Liter', 'L', '2022-11-28 08:53:13', '2022-11-28 08:53:13'),
(4, 'Mililiter', 'Ml', '2022-11-28 08:53:13', '2022-11-28 08:53:13'),
(6, 'Pieces', 'Pcs', '2022-11-29 00:35:18', '2022-11-29 00:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `selling_price`, `created_at`, `updated_at`) VALUES
(1, 'Tes Menu Anjay', 15000, '2022-11-29 08:58:40', '2022-11-29 21:21:31'),
(2, 'Tes Menu 2', 50000, '2022-11-29 09:06:23', '2022-11-29 09:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `menu_transaction`
--

CREATE TABLE `menu_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_transaction`
--

INSERT INTO `menu_transaction` (`id`, `menu_id`, `transaction_id`, `amount`, `total_price`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 1, 0, '2022-11-30 02:00:08', '2022-11-30 02:00:08'),
(4, 2, 8, 1, 0, '2022-11-30 02:00:08', '2022-11-30 02:00:08'),
(5, 1, 9, 4, 0, '2022-11-30 02:08:20', '2022-11-30 02:08:20'),
(6, 2, 10, 2, 0, '2022-11-30 02:13:19', '2022-11-30 02:13:19'),
(7, 1, 10, 1, 0, '2022-11-30 02:13:19', '2022-11-30 02:13:19'),
(8, 1, 11, 10, 0, '2022-11-30 02:42:10', '2022-11-30 02:42:10'),
(9, 1, 12, 1, 0, '2022-11-30 02:48:39', '2022-11-30 02:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_11_09_060317_create_employees_table', 1),
(3, '2022_11_09_060338_create_measurements_table', 1),
(4, '2022_11_09_060753_create_ingredients_table', 1),
(5, '2022_11_09_062040_create_menus_table', 1),
(6, '2022_11_09_063356_create_ingredient_menus_table', 1),
(7, '2022_11_09_064535_create_transactions_table', 1),
(8, '2022_11_09_065014_create_menu_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_total` bigint(20) NOT NULL,
  `payment_total` bigint(20) NOT NULL,
  `change` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `employee_id`, `transaction_total`, `payment_total`, `change`, `created_at`, `updated_at`) VALUES
(8, 1, 65000, 100000, 35000, '2022-11-30 02:00:08', '2022-11-30 02:00:08'),
(9, 1, 60000, 100000, 40000, '2022-11-30 02:08:20', '2022-11-30 02:08:20'),
(10, 1, 115000, 120000, 5000, '2022-11-30 02:13:19', '2022-11-30 02:13:19'),
(11, 1, 150000, 200000, 50000, '2022-11-30 02:42:10', '2022-11-30 02:42:10'),
(12, 1, 15000, 20000, 5000, '2022-11-30 02:48:39', '2022-11-30 02:48:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_username_unique` (`username`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_measurement_id_foreign` (`measurement_id`);

--
-- Indexes for table `ingredient_menu`
--
ALTER TABLE `ingredient_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredient_menu_ingredient_id_foreign` (`ingredient_id`),
  ADD KEY `ingredient_menu_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_transaction`
--
ALTER TABLE `menu_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_transaction_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_transaction_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_employee_id_foreign` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredient_menu`
--
ALTER TABLE `ingredient_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu_transaction`
--
ALTER TABLE `menu_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_measurement_id_foreign` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`);

--
-- Constraints for table `ingredient_menu`
--
ALTER TABLE `ingredient_menu`
  ADD CONSTRAINT `ingredient_menu_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `ingredient_menu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_transaction`
--
ALTER TABLE `menu_transaction`
  ADD CONSTRAINT `menu_transaction_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menu_transaction_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
