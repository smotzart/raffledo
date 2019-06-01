-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 02 2019 г., 01:55
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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `profiles_id` int(10) UNSIGNED NOT NULL,
  `sort_ids` varchar(255) DEFAULT NULL,
  `sort_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profiles_id`, `sort_ids`, `sort_data`) VALUES
(2, 'smotzart', '$2y$08$UlBPY1dSeFpnaTluRlg1YuZl0RbDZGgKCPaA5kf6FIMtpomlgfhhG', 1, '43,48,46,42,44,41,45', '2019-06-02'),
(3, 'smotzart2', '$2y$08$N2ZhOElLTG9hekNOV0wxYOYCp4KGbrTlpYz3aeJFqauDSWvX9Xi6K', 2, '43,45,42,46,48,41,44', '2019-06-02'),
(4, 'smotzart3', '$2y$08$VTlQOFhDSDZnL2Z1cGRTV.qqMB7IyQunWCNisGs0Bnlg5kGL7PUHy', 2, NULL, NULL),
(5, 'smotzart4', '$2y$08$SmpiMXVwUzMzWklSbnkwVu9KJMRAA3VEDJWcJxCMC1LhcgkIWWCYC', 2, NULL, NULL),
(6, '1234qwer', '$2y$08$NXhONld3WlFKTXRLMVhhWOr6oCFevOBo6vhRFDQ2mLCQQNIAE2u..', 2, NULL, NULL),
(7, 'admin', '$2y$08$UlBPY1dSeFpnaTluRlg1YuZl0RbDZGgKCPaA5kf6FIMtpomlgfhhG', 1, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
