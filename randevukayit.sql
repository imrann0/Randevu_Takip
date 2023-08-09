-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 02:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `randevukayit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aeposta` varchar(255) NOT NULL,
  `asifre` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aeposta`, `asifre`) VALUES
('admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `doktor`
--

CREATE TABLE `doktor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(11) DEFAULT NULL,
  `zaman` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doktor`
--

INSERT INTO `doktor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`, `zaman`) VALUES
(4, 'emredrms@gmail.com', 'Emre Durmus', '123', '17984849848', '5515546252', 1, 30),
(3, 'cagatay07@gmail.com', 'Cagatay Kurt', '123', '545454444', '595955595', 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `doktorlogs`
--

CREATE TABLE `doktorlogs` (
  `doktorlog_id` int(11) NOT NULL,
  `docid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doktorlogs`
--

INSERT INTO `doktorlogs` (`doktorlog_id`, `docid`, `date`, `message`) VALUES
(1, 3, '2023-04-04 10:28:54', 'Randevu İptal Edildi  Eden Doktor ID: 3 ::1'),
(2, 3, '2023-04-04 10:38:33', 'Sens İptal Edildi İptal Eden ID: 3  Seans ID: 50::1'),
(3, 3, '2023-04-04 10:40:43', 'Yeni Seans Oluşturuldu Seansı Oluşturan Doktor 3 Senas Başlığı: LogDeneme::1'),
(4, 3, '2023-04-04 10:46:11', 'Randevu Tamamlandı Tamamlanan Randevu 85 Randevu Tamamlayan Doktor 3::1');

-- --------------------------------------------------------

--
-- Table structure for table `hasta`
--

CREATE TABLE `hasta` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  `cinsiyet` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasta`
--

INSERT INTO `hasta` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`, `cinsiyet`) VALUES
(4, 'yilmaz@gmail.com', 'Ali Yilmaz', '123', 'sultanorhan mah. 258 sok. Gebze/Kocaeli', '1795668988', '2003-08-15', '0596669668', 'E'),
(3, 'hasankrt@gmail.com', 'Hasan kurt', '123', 'gebze tatlikuyu', '1905', '2020-02-20', '0596669666', 'E'),
(5, 'merve@gmail.com', 'Merve Y?lmaz', '123', 'gebze ', '12345678901', '1996-06-12', '05514230456', 'K'),
(6, 'nisa@gmail.com', 'Nisa Kuru', '123', 'gebze', '1245678900', '2010-06-25', '05545525555', 'K');

-- --------------------------------------------------------

--
-- Table structure for table `hastalogs`
--

CREATE TABLE `hastalogs` (
  `hastalog_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hastalogs`
--

INSERT INTO `hastalogs` (`hastalog_id`, `pid`, `date`, `message`) VALUES
(8, 6, '2023-04-04 10:09:35', 'Randevu İptal Edildi Eden Hasta id 6::1'),
(9, 6, '2023-04-04 10:12:31', 'Randevu Aldı 6::1'),
(13, 4, '2023-04-04 10:49:10', 'Randevu İptal Edildi Eden Hasta id 4::1'),
(22, 0, '2023-04-13 09:28:11', 'Burası Log Dosyasından Geldi'),
(23, 0, '2023-04-13 09:28:24', 'Burası Log Dosyasından Geldi'),
(24, 0, '2023-04-13 09:29:41', 'Burası Log Dosyasından Geldi'),
(25, 0, '2023-04-13 09:29:46', 'Burası Log Dosyasından Geldi'),
(26, 0, '2023-04-13 09:30:18', 'Burası Log Dosyasından Geldi');

-- --------------------------------------------------------

--
-- Table structure for table `klinik`
--

CREATE TABLE `klinik` (
  `id` int(11) NOT NULL,
  `klinikler` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `klinik`
--

INSERT INTO `klinik` (`id`, `klinikler`) VALUES
(1, 'Aile Hekimligi'),
(2, 'Beyin ve Sinir Cerrahisi'),
(3, 'Cocuk Cerrahisi'),
(4, 'Cocuk Sagligi ve Hastaliklari'),
(5, 'Kardiyoloji'),
(6, 'Cildiye'),
(7, 'Enfeksiyon Hastaliklari'),
(8, 'Fiziksel Tip ve Rehabilitasyon'),
(9, 'Gastroenteroloji'),
(10, 'Genel Cerrahi'),
(11, 'Gögüs Hastaliklari'),
(12, 'Göz Hastaliklari'),
(13, 'Dermatoloji'),
(14, 'Dahiliye'),
(15, 'Kadin Hastaliklari ve Dogum'),
(16, 'Kalp ve Damar Cerrahisi'),
(17, 'Kulak Burun Bogaz Hastaliklari'),
(18, 'Kulak Burun Bo?az Hastal?klar?'),
(19, 'Nöroloji'),
(20, 'Ortopedi ve Travmatoloji'),
(21, 'Psikiyatri'),
(22, 'Üroloji'),
(39, 'Patoloji'),
(40, 'Pharmacology'),
(41, 'Physical medicine and rehabilitation'),
(42, 'Plastic surgery'),
(43, 'Podiatric Medicine'),
(44, 'Podiatric Surgery'),
(45, 'Psychiatry'),
(46, 'Public health and Preventive Medicine'),
(47, 'Radiology'),
(48, 'Radiotherapy'),
(49, 'Respiratory medicine'),
(50, 'Rheumatology'),
(51, 'Stomatology'),
(52, 'Thoracic surgery'),
(53, 'Tropical medicine'),
(54, 'Urology'),
(55, 'Vascular surgery'),
(56, 'Venereology');

-- --------------------------------------------------------

--
-- Table structure for table `kullanici_log`
--

CREATE TABLE `kullanici_log` (
  `log_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `giris_tarihi` datetime NOT NULL,
  `cikis_tarihi` datetime DEFAULT NULL,
  `ip_adresi` varchar(45) NOT NULL,
  `tarayici` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullanici_log`
--

INSERT INTO `kullanici_log` (`log_id`, `kullanici_id`, `giris_tarihi`, `cikis_tarihi`, `ip_adresi`, `tarayici`) VALUES
(18, 6, '2023-04-03 17:56:43', '2023-04-03 17:56:55', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(19, 6, '2023-04-03 15:28:06', '2023-04-03 15:28:12', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(31, 6, '2023-04-04 09:22:32', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(32, 6, '2023-04-04 09:54:40', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(33, 6, '2023-04-04 09:55:38', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(34, 6, '2023-04-04 09:56:38', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(35, 6, '2023-04-04 09:57:07', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(36, 6, '2023-04-04 09:57:55', '2023-04-04 10:14:10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(37, 4, '2023-04-04 10:49:01', '2023-04-04 10:49:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(38, 4, '2023-04-04 10:49:06', '2023-04-04 10:49:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'),
(39, 3, '2023-04-10 12:08:32', '2023-04-10 12:14:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(40, 3, '2023-04-10 13:59:57', '2023-04-10 14:11:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(41, 7, '2023-04-13 10:29:41', '2023-04-13 10:29:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36'),
(42, 7, '2023-04-13 10:30:18', '2023-04-13 10:30:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `randevu`
--

CREATE TABLE `randevu` (
  `appoid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `apponum` int(11) DEFAULT NULL,
  `scheduleid` int(11) DEFAULT NULL,
  `appodate` date DEFAULT NULL,
  `rndtime` time DEFAULT NULL,
  `bitis` date DEFAULT NULL,
  `docid` int(11) DEFAULT NULL,
  `klinikid` int(11) DEFAULT NULL,
  `rndurum` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `randevu`
--

INSERT INTO `randevu` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`, `rndtime`, `bitis`, `docid`, `klinikid`, `rndurum`) VALUES
(82, 4, 2, 49, '2023-04-06', '09:15:00', '2023-04-07', 4, 14, 0),
(83, 4, 1, 50, '2023-04-03', '13:35:00', '2023-04-04', 3, 5, 2),
(80, 3, 3, 49, '2023-04-07', '09:15:00', '2023-04-08', 4, 1, 3),
(84, 4, 3, 49, '2023-04-04', '09:15:00', '2023-04-05', 4, 1, 0),
(85, 4, 2, 50, '2023-04-04', '09:15:00', '2023-04-05', 3, 5, 4),
(86, 6, 4, 49, '2023-04-06', '09:15:00', '2023-04-07', 4, 1, 0),
(87, 6, 5, 49, '2023-04-04', '09:15:00', '2023-04-05', 4, 1, 0),
(88, 6, 6, 49, '2023-04-06', '09:15:00', '2023-04-07', 4, 1, 0),
(89, 6, 7, 49, '2023-04-06', '09:15:00', '2023-04-07', 4, 1, 3),
(90, 6, 8, 49, '2023-04-06', '09:15:00', '2023-04-07', 4, 1, 0),
(91, 6, 9, 49, '2023-04-05', '09:15:00', '2023-04-06', 4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `takvim`
--

CREATE TABLE `takvim` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `klinik_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` datetime DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(11) DEFAULT NULL,
  `bitis` datetime DEFAULT NULL,
  `Durum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `takvim`
--

INSERT INTO `takvim` (`scheduleid`, `docid`, `klinik_id`, `title`, `scheduledate`, `scheduletime`, `nop`, `bitis`, `Durum`) VALUES
(49, '4', 1, 'hasta', '2023-04-03 08:30:00', '00:00:00', 5, '2023-04-07 18:00:00', 0),
(50, '3', 5, 'assa', '2023-03-28 15:51:00', '00:00:00', 3, '2023-04-05 15:51:00', 0),
(57, '3', 5, 'deddde', '2023-04-05 14:12:00', '00:00:00', 10, '2023-04-12 14:12:00', 0),
(51, '3', 5, 'imran', '2023-04-04 20:39:00', '00:00:00', 4, '2023-04-07 20:39:00', 0),
(52, '3', 5, 'Klinik Deneme', '2023-04-04 22:30:00', '00:00:00', 4, '2023-04-12 22:30:00', 0),
(54, '3', 5, 'cardo2', '2023-04-03 23:19:00', '00:00:00', 1, '2023-04-13 23:19:00', 1),
(55, '4', 14, 'deneme', '2023-04-06 13:55:00', '00:00:00', 2, '2023-04-09 13:55:00', 0),
(56, '3', 5, 'denenemc', '2023-04-05 13:56:00', '00:00:00', 10, '2023-04-07 13:56:00', 0),
(58, '4', 14, 'OnayDeneme', '2023-04-04 14:18:00', '00:00:00', 10, '2023-04-14 14:18:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `webkullanici`
--

CREATE TABLE `webkullanici` (
  `email` varchar(255) NOT NULL,
  `kullanicitipi` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webkullanici`
--

INSERT INTO `webkullanici` (`email`, `kullanicitipi`) VALUES
('admin@gmail.com', 'a'),
('yilmaz@gmail.com', 'p'),
('emhashenudara@gmail.com', 'p'),
('emredrms@gmail.com', 'd'),
('cagatay07@gmail.com', 'd'),
('hasankrt@gmail.com', 'p'),
('merve@gmail.com', 'p'),
('nisa@gmail.com', 'p'),
('keremyldrm0@gmail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aeposta`);

--
-- Indexes for table `doktor`
--
ALTER TABLE `doktor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `doktorlogs`
--
ALTER TABLE `doktorlogs`
  ADD PRIMARY KEY (`doktorlog_id`);

--
-- Indexes for table `hasta`
--
ALTER TABLE `hasta`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `hastalogs`
--
ALTER TABLE `hastalogs`
  ADD PRIMARY KEY (`hastalog_id`);

--
-- Indexes for table `klinik`
--
ALTER TABLE `klinik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kullanici_log`
--
ALTER TABLE `kullanici_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `randevu`
--
ALTER TABLE `randevu`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `takvim`
--
ALTER TABLE `takvim`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `webkullanici`
--
ALTER TABLE `webkullanici`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doktor`
--
ALTER TABLE `doktor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doktorlogs`
--
ALTER TABLE `doktorlogs`
  MODIFY `doktorlog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasta`
--
ALTER TABLE `hasta`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hastalogs`
--
ALTER TABLE `hastalogs`
  MODIFY `hastalog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kullanici_log`
--
ALTER TABLE `kullanici_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `randevu`
--
ALTER TABLE `randevu`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `takvim`
--
ALTER TABLE `takvim`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
