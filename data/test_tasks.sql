-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `aliases` varchar(255) NOT NULL,
  `creativity_years` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `prize` varchar(255) NOT NULL,
  `debut` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `author` (`id`, `name`, `aliases`, `creativity_years`, `occupation`, `prize`, `debut`) VALUES
(1,	'Братья Стругацкие',	'С. Бережков, С. Витин, С. Победин, С. Ярославцев, С. Витицкий',	'1958—1990',	'Писатель фантаст, сценарист',	'премия «Аэлита»',	0),
(2,	'Аркадий Натанович Стругацкий',	'С. Бережков, С. Ярославцев',	'1946—1991',	'писатель-фантаст, сценарист, переводчик',	'',	0),
(3,	'Борис Натанович Стругацкий',	'С. Витицкий',	'1958—2012',	'писатель-фантаст, сценарист, переводчик',	'',	0),
(4,	'Виктор Олегович Пелевин',	'',	'1989 — настоящее время',	'писатель',	'Третья премия «Большая книга» (2010)',	0),
(5,	'Эрнест Миллер Хемингуэй',	'',	'1917—1961',	'прозаик, журналист',	'	 Пулитцеровская (1953), Нобелевская премия Нобелевская (1954)',	0);

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `publishing` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `book` (`id`, `author`, `title`, `genre`, `publishing`, `price`) VALUES
(4,	1,	'Извне',	'научная фантастика',	'1960',	150),
(5,	1,	'Полдень, XXII век',	'научная фантастика',	'1961',	250),
(6,	1,	'Попытка к бегству',	'научная фантастика',	'1962',	250),
(7,	1,	'Далёкая Радуга',	'научная фантастика',	'1964',	180),
(8,	5,	'И восходит солнце (Фиеста)',	'роман',	'1926',	120),
(9,	5,	'Снега Килиманджаро',	'рассказ, проза',	'1936',	100),
(10,	5,	'По ком звонит колокол',	'роман',	'1940',	250),
(11,	4,	'Оружие возмездия',	'рассказ, проза',	'1990',	120),
(12,	4,	'Затворник и Шестипалый',	'повесть',	'1990',	140),
(13,	4,	'Священная книга оборотня',	'роман',	'2004',	260),
(14,	4,	'Generation «П»',	'роман',	'1999 ',	300);

-- 2017-06-09 09:56:40
