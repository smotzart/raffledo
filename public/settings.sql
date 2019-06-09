-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 09 2019 г., 19:23
-- Версия сервера: 10.1.33-MariaDB
-- Версия PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phalcon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `entry_amount` int(10) NOT NULL DEFAULT '10',
  `deadline_time` time DEFAULT NULL,
  `enter_time` time DEFAULT NULL,
  `google_tag` text,
  `ads_regular` text,
  `ads_register` text,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `title_game` varchar(255) DEFAULT NULL,
  `description_game` text,
  `title_tag` varchar(255) DEFAULT NULL,
  `description_tag` text,
  `title_company` varchar(255) DEFAULT NULL,
  `description_company` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `entry_amount`, `deadline_time`, `enter_time`, `google_tag`, `ads_regular`, `ads_register`, `title`, `description`, `title_game`, `description_game`, `title_tag`, `description_tag`, `title_company`, `description_company`) VALUES
(1, 3, '23:59:00', '06:30:00', '<!-- Google tag -->', '<a href=\"#1\" class=\"d-none d-lg-block mx-auto mb-50px\">Die Seite befindet sich im Entwicklungsstatus!</a>', '<a href=\"#2\" class=\"d-block mx-auto mb-50px\"><img src=\"img/banner.png\" alt=\"MySEO\" class=\"img-fluid\"></a>', 'Page title', 'Page description', 'List page title', 'List page description', 'Tag %tag% page title', 'Tag %tag% page description', 'Company %company% page title', 'Company %company% page description');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
