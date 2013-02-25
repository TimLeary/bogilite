
-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2013. febr. 24. 15:20
-- Szerver verzió: 5.5.24-log
-- PHP verzió: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `bogilite`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(45) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `area`
--

INSERT INTO `area` (`area_id`, `area_name`) VALUES
(1, 'article');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `simplefied_url` varchar(255) NOT NULL,
  `article_short` text,
  `article_text` text,
  `article_title` varchar(255) DEFAULT NULL,
  `article_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `simplefied_url_UNIQUE` (`simplefied_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- A tábla adatainak kiíratása `article`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `keywords_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(45) NOT NULL,
  PRIMARY KEY (`keywords_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `keywords_to_article`
--

CREATE TABLE IF NOT EXISTS `keywords_to_article` (
  `keywords_to_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `keywords_id` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`keywords_to_article_id`),
  KEY `fk_keywords_to_article_1_idx` (`article_id`),
  KEY `keywords_to_kta_idx` (`keywords_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `media_to_object`
--

CREATE TABLE IF NOT EXISTS `media_to_object` (
  `media_to_object_id` int(11) NOT NULL AUTO_INCREMENT,
  `medium_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `priority` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`media_to_object_id`),
  KEY `medium_to_mto_idx` (`medium_id`),
  KEY `fk_media_to_object_1_idx` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- A tábla adatainak kiíratása `media_to_object`
--


-- --------------------------------------------------------

--
-- Tábla szerkezet: `medium`
--

CREATE TABLE IF NOT EXISTS `medium` (
  `medium_id` int(11) NOT NULL AUTO_INCREMENT,
  `mime_type` varchar(45) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subtitle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`medium_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- A tábla adatainak kiíratása `medium`
--

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `keywords_to_article`
--
ALTER TABLE `keywords_to_article`
  ADD CONSTRAINT `article_to_kta` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `keywords_to_kta` FOREIGN KEY (`keywords_id`) REFERENCES `keywords` (`keywords_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `media_to_object`
--
ALTER TABLE `media_to_object`
  ADD CONSTRAINT `fk_media_to_object_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `medium_to_mto` FOREIGN KEY (`medium_id`) REFERENCES `medium` (`medium_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `createtime` datetime NOT NULL,
  `lastvisit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` enum('new','active') NOT NULL DEFAULT 'new',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `password`, `email`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '0000-00-00 00:00:00', '2012-11-27 20:45:00', 1, 'active');