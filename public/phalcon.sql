-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 21 2019 г., 11:47
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
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(100) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `host` text CHARACTER SET latin1 NOT NULL,
  `footer` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `companies`
--

INSERT INTO `companies` (`id`, `tag`, `name`, `host`, `footer`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'https://docs.phalconphp.com/3.4/en/db-models.html', 1, '2019-05-20 20:43:05', '2019-05-19 19:07:34'),
(2, 'relation', 'relation', 'https://docs.phalconphp.com/3.4/en/db-models-relationships', 1, '2019-05-20 20:43:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_logins`
--

CREATE TABLE `failed_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `ipAddress` char(15) NOT NULL,
  `attempted` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `failed_logins`
--

INSERT INTO `failed_logins` (`id`, `users_id`, `ipAddress`, `attempted`) VALUES
(1, 1, '127.0.0.1', 1558343565);

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 NOT NULL,
  `companies_id` int(10) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `price` text CHARACTER SET latin1,
  `type_register` int(1) NOT NULL DEFAULT '0',
  `type_sms` int(1) NOT NULL DEFAULT '0',
  `type_buy` int(1) NOT NULL DEFAULT '0',
  `type_internet` int(1) NOT NULL DEFAULT '0',
  `type_submission` int(1) NOT NULL DEFAULT '0',
  `suggested_solution` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `enter_date` date DEFAULT '0000-00-00',
  `enter_time` time DEFAULT NULL,
  `deadline_date` date DEFAULT '0000-00-00',
  `deadline_time` time DEFAULT '23:59:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id`, `url`, `companies_id`, `title`, `price`, `type_register`, `type_sms`, `type_buy`, `type_internet`, `type_submission`, `suggested_solution`, `enter_date`, `enter_time`, `deadline_date`, `deadline_time`, `created_at`, `updated_at`) VALUES
(1, 'https://forum.phalconphp.com/discussion/14919/datetime-form-field-shows-only-date-no-time', 2, 'first game', '', 1, 0, 1, 0, 0, '', '0000-00-00', NULL, '0000-00-00', NULL, '2019-05-19 20:18:20', '2019-05-19 21:33:57'),
(2, '2nd', 1, 'another', '', 1, 1, 1, 0, 0, '123', '0000-00-00', '23:59:00', '0000-00-00', '19:59:00', '2019-05-19 20:27:19', '2019-05-20 04:52:53'),
(4, 'sfgg', 1, 'tttt', '', 0, 1, 1, 0, 0, '', '0000-00-00', '23:59:00', '0000-00-00', '23:59:00', '2019-05-20 04:53:51', '2019-05-20 04:55:36');

-- --------------------------------------------------------

--
-- Структура таблицы `games_tags`
--

CREATE TABLE `games_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) NOT NULL,
  `tags_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `games_tags`
--

INSERT INTO `games_tags` (`id`, `games_id`, `tags_id`, `created_at`) VALUES
(51, 2, 23, '2019-05-20 04:52:53'),
(57, 4, 21, '2019-05-20 04:55:36'),
(58, 4, 22, '2019-05-20 04:55:36'),
(59, 4, 23, '2019-05-20 04:55:36'),
(60, 4, 24, '2019-05-20 04:55:36');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `profiles_id` int(10) UNSIGNED NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `profiles_id`, `resource`, `action`) VALUES
(23, 1, 'tags', 'index'),
(24, 1, 'tags', 'create'),
(25, 1, 'tags', 'edit'),
(26, 1, 'tags', 'delete'),
(27, 1, 'games', 'index'),
(28, 1, 'games', 'create'),
(29, 1, 'games', 'edit'),
(30, 1, 'games', 'delete'),
(31, 1, 'companies', 'index'),
(32, 1, 'companies', 'create'),
(33, 1, 'companies', 'edit'),
(34, 1, 'companies', 'delete'),
(35, 1, 'users', 'index'),
(36, 1, 'users', 'create'),
(37, 1, 'users', 'edit'),
(38, 1, 'users', 'delete'),
(39, 1, 'profiles', 'index'),
(40, 1, 'profiles', 'create'),
(41, 1, 'profiles', 'edit'),
(42, 1, 'profiles', 'delete'),
(43, 2, 'games', 'index'),
(44, 2, 'games', 'search');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `name`) VALUES
(1, 'Administrators'),
(2, 'Users');

-- --------------------------------------------------------

--
-- Структура таблицы `remember_tokens`
--

CREATE TABLE `remember_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` varchar(120) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `success_logins`
--

CREATE TABLE `success_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `success_logins`
--

INSERT INTO `success_logins` (`id`, `users_id`, `ipAddress`, `userAgent`) VALUES
(3, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36'),
(4, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36'),
(5, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36'),
(6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36'),
(7, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36'),
(8, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.157 Safari/537.36');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `footer` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `tag`, `title`, `description`, `footer`, `created_at`, `updated_at`) VALUES
(21, 'linz', 'Linz', '', 1, '2019-05-19 19:57:08', '0000-00-00 00:00:00'),
(22, 'game', 'Gewinnspiel', '', 1, '2019-05-19 19:57:08', '0000-00-00 00:00:00'),
(23, 'map', 'Karten', '', 0, '2019-05-19 19:57:08', '0000-00-00 00:00:00'),
(24, 'concert', 'Konzert', '', 1, '2019-05-19 19:57:08', '2019-05-18 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `profiles_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profiles_id`) VALUES
(1, 'Serhii Kotsar', 'smotzart@yandex.ru', '$2y$08$aWkzdmFNRnJtaUR0bi9BdenZWxzz.y6v42FatX6Fi4Lhf//sO8SJa', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `games_tags`
--
ALTER TABLE `games_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_id` (`tags_id`),
  ADD KEY `games_id` (`games_id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_id` (`profiles_id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `remember_tokens`
--
ALTER TABLE `remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`);

--
-- Индексы таблицы `success_logins`
--
ALTER TABLE `success_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `games_tags`
--
ALTER TABLE `games_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `success_logins`
--
ALTER TABLE `success_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
