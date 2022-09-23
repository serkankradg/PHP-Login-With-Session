-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Eyl 2022, 19:39:44
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `u0788414_serkan`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `ID` int(11) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 1,
  `yetki` int(11) NOT NULL DEFAULT 2,
  `ad` varchar(160) NOT NULL,
  `soyad` varchar(160) NOT NULL,
  `kullaniciAdi` varchar(160) NOT NULL,
  `sifre` varchar(160) NOT NULL,
  `eposta` varchar(160) NOT NULL,
  `telefon` varchar(60) NOT NULL,
  `adres` varchar(250) NOT NULL,
  `tc` bigint(11) NOT NULL,
  `foto` varchar(160) NOT NULL,
  `dil` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`ID`, `durum`, `yetki`, `ad`, `soyad`, `kullaniciAdi`, `sifre`, `eposta`, `telefon`, `adres`, `tc`, `foto`, `dil`) VALUES
(58, 1, 2, 'Samet', 'Yorgun', 'samet', '123', 'samet@sesasoft.com', '+90 537 033 24 66', 'blablabla', 11111111111, '1660648624.jpeg', 2),
(57, 1, 1, 'Serkan', 'Karadağ', 'serkan', '123', 'serkan@sesasoft.com', '+90 536 459 02 14', 'blabalba', 11111111111, '1660647767.jpeg', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `ID` int(11) NOT NULL,
  `mesaj` varchar(160) NOT NULL,
  `kullanici` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`ID`, `mesaj`, `kullanici`) VALUES
(17, 'sdsd', 57),
(15, 'Deneme Mesaj', 57),
(18, 'sdsd', 57),
(14, 'Deneme Cevap', 58),
(19, 'sdsd', 57),
(20, 'fsdfg', 57),
(21, 'serkan', 57),
(22, 'serkan2', 57),
(23, 'dfg', 57),
(24, 'fdfd', 57);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
