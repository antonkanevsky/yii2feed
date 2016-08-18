-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 18 2016 г., 14:17
-- Версия сервера: 5.7.13-0ubuntu0.16.04.2
-- Версия PHP: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2basic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL COMMENT 'id записи',
  `name` varchar(50) NOT NULL COMMENT 'название события',
  `image` varchar(255) DEFAULT NULL COMMENT 'путь к файлу обложки',
  `location` varchar(255) DEFAULT NULL COMMENT 'Место события',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации',
  `startDate` datetime DEFAULT NULL COMMENT 'Дата начала',
  `endDate` datetime DEFAULT NULL COMMENT 'Дата окончания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='данные сущности Событие';

-- --------------------------------------------------------

--
-- Структура таблицы `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL COMMENT 'id записи',
  `name` varchar(255) NOT NULL COMMENT 'Название фильма',
  `image` varchar(255) DEFAULT NULL COMMENT 'путь к файлу обложки',
  `releaseDate` date DEFAULT NULL COMMENT 'Дата выхода',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='данные сущности Фильм';

-- --------------------------------------------------------

--
-- Структура таблицы `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL COMMENT 'id записи',
  `name` varchar(255) NOT NULL COMMENT 'название песни/музыки',
  `image` varchar(255) DEFAULT NULL COMMENT 'путь к файлу обложки',
  `artist` varchar(255) DEFAULT NULL COMMENT 'Исполнитель',
  `releaseDate` date DEFAULT NULL COMMENT 'Дата выхода',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='данные сущности Музыка';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id записи';
--
-- AUTO_INCREMENT для таблицы `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id записи';
--
-- AUTO_INCREMENT для таблицы `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id записи';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
