-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 14 2017 г., 19:50
-- Версия сервера: 5.5.9
-- Версия PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `store777`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(2, 'HDD'),
(1, 'Mice');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `avatar` mediumblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `login`, `pass`, `roleid`, `discount`, `total`, `avatar`) VALUES
(1, 'user1', '111', 2, 0, 0, 0x433a5c57696e646f77735c54656d705c706870463830422e746d70);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `itemid` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemname` varchar(128) NOT NULL,
  `catid` int(11) DEFAULT NULL,
  `pricein` int(11) NOT NULL,
  `pricesale` int(11) NOT NULL,
  `info` varchar(256) NOT NULL,
  `rate` double DEFAULT NULL,
  `imagepath` varchar(256) NOT NULL,
  `action` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `itemname`, `catid`, `pricein`, `pricesale`, `info`, `rate`, `imagepath`, `action`) VALUES
(8, 'Mice 1', 1, 10, 15, 'Best Mice', 0, '', 0),
(9, 'HDD LG', 2, 120, 150, '500 Gb', 0, '', 0),
(10, 'Samsung', 2, 80, 94, '250 Gb', 0, 'images/Items/Penguins.jpg', 0),
(11, 'Mice 2', 1, 12, 15, 'SS', 0, 'images/Items/Jellyfish.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customername` varchar(32) DEFAULT NULL,
  `itemname` varchar(128) DEFAULT NULL,
  `pricein` int(11) DEFAULT NULL,
  `pricesale` int(11) DEFAULT NULL,
  `datesale` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
