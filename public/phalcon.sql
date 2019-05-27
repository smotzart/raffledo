-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2019 г., 11:54
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
(2, 'relation', 'relation', 'https://docs.phalconphp.com/3.4/en/db-models-relationships', 1, '2019-05-20 20:43:09', '0000-00-00 00:00:00'),
(3, 'qwe', 'qwe', 'https://stackoverflow.com/questions/23665433/phalcon-php-get-controller-name-in-view', 1, '2019-05-21 15:59:26', '0000-00-00 00:00:00'),
(4, 'test2', 'test', 'sdfsdf', 0, '2019-05-21 16:04:12', '0000-00-00 00:00:00'),
(5, 'c1', 'c1df', 'https://tracker.fetz.cc', 1, '2019-05-21 23:59:37', '0000-00-00 00:00:00'),
(6, 'c2', 'c2', 'https://tracker.fetz.cc', 1, '2019-05-21 23:59:42', '0000-00-00 00:00:00'),
(7, 'c3', 'c3', 'https://tracker.fetz.cc', 1, '2019-05-21 23:59:47', '0000-00-00 00:00:00'),
(8, 'c4', 'c4', 'https://tracker.fetz.cc', 0, '2019-05-21 23:59:52', '0000-00-00 00:00:00'),
(9, 'c5', 'c5', 'https://tracker.fetz.cc', 1, '2019-05-21 23:59:58', '0000-00-00 00:00:00'),
(10, 'c6', 'c6', 'https://tracker.fetz.cc', 1, '2019-05-22 00:00:05', '0000-00-00 00:00:00'),
(11, 'c7', 'c7', 'https://tracker.fetz.cc', 1, '2019-05-22 00:00:12', '0000-00-00 00:00:00'),
(12, 'qwerty', 'qwerty', 'https://getbootstrap.com/docs/4.3/components/forms/', 1, '2019-05-24 09:42:45', '0000-00-00 00:00:00'),
(13, 'qwerty2', 'qwerty2', 'https://getbootstrap.com/docs/4.3/components/forms/', 1, '2019-05-24 09:46:05', '0000-00-00 00:00:00');

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
(1, 1, '127.0.0.1', 1558343565),
(2, 1, '127.0.0.1', 1558472050),
(3, 1, '127.0.0.1', 1558472063),
(4, 1, '127.0.0.1', 1558472125),
(5, 0, '127.0.0.1', 1558473761),
(6, 3, '127.0.0.1', 1558477228),
(7, 0, '127.0.0.1', 1558790325),
(8, 0, '127.0.0.1', 1558868682),
(9, 2, '127.0.0.1', 1558902531),
(10, 2, '127.0.0.1', 1558934066);

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
  `price_info` int(1) NOT NULL DEFAULT '0',
  `type_register` int(1) NOT NULL DEFAULT '0',
  `type_sms` int(1) NOT NULL DEFAULT '0',
  `type_buy` int(1) NOT NULL DEFAULT '0',
  `type_internet` int(1) NOT NULL DEFAULT '0',
  `type_submission` int(1) NOT NULL DEFAULT '0',
  `suggested_solution` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `enter_date` int(10) DEFAULT NULL,
  `enter_time` time DEFAULT '06:00:00',
  `deadline_date` int(10) DEFAULT NULL,
  `deadline_time` time DEFAULT '23:59:00',
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id`, `url`, `companies_id`, `title`, `price`, `price_info`, `type_register`, `type_sms`, `type_buy`, `type_internet`, `type_submission`, `suggested_solution`, `enter_date`, `enter_time`, `deadline_date`, `deadline_time`, `created_at`, `updated_at`) VALUES
(1, 'https://forum.phalconphp.com', 2, 'first game', '', 0, 1, 0, 1, 0, 0, '', 1558935577, '23:59:00', 1558935577, '23:59:00', 2147483647, 1558935577),
(2, '2nd', 1, 'first another 2', '', 0, 1, 1, 1, 0, 0, '123', 0, '23:59:00', 0, '19:59:00', 4294967295, 2147483647),
(4, 'http://raf.my/gewinnspiele', 1, 'first', '', 0, 0, 1, 1, 0, 0, '', 0, '23:59:00', 0, '23:59:00', 4294967295, 2147483647),
(29, 'http://raf.my/gewinnspiele', 11, 'wer', '', 0, 0, 0, 0, 0, 0, '', 1558908469, '06:00:00', 1558908469, '23:59:00', 1558908469, NULL),
(30, 'http://raf.my/gewinnspiele', 11, 'wer', '', 0, 0, 0, 0, 0, 0, '', 1558908670, '06:00:00', 1558908670, '23:59:00', 1558908670, NULL),
(31, 'http://raf.my/gewinnspiele', 3, 'qwe135687', '', 0, 0, 0, 0, 0, 0, '', 1558908706, '06:00:00', 1558908706, '23:59:00', 1558908706, NULL),
(32, 'http://raf.my/gewinnspiele', 1, 'tttttttt', '', 0, 0, 0, 0, 0, 0, '', 1558908721, '06:00:00', 1558908721, '23:59:00', 1558908721, NULL),
(33, 'http://raf.my/gewinnspiele', 9, 'q89', '', 0, 0, 0, 0, 0, 0, '', 1558908765, '06:00:00', 1558908765, '23:59:00', 1558908765, NULL),
(34, 'http://raf.my/gewinnspiele', 3, 'ui00', '', 0, 0, 0, 0, 0, 0, '', 1558908776, '06:00:00', 1558908776, '23:59:00', 1558908776, NULL);

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
(65, 4, 21, '2019-05-21 16:32:32'),
(66, 4, 22, '2019-05-21 16:32:32'),
(67, 4, 23, '2019-05-21 16:32:32'),
(68, 4, 24, '2019-05-21 16:32:32'),
(70, 2, 23, '2019-05-21 16:33:27'),
(112, 1, 22, '2019-05-27 04:39:37');

-- --------------------------------------------------------

--
-- Структура таблицы `hidden_companies`
--

CREATE TABLE `hidden_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `companies_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hidden_games`
--

CREATE TABLE `hidden_games` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hidden_tags`
--

CREATE TABLE `hidden_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tags_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hidden_tags`
--

INSERT INTO `hidden_tags` (`id`, `tags_id`, `users_id`) VALUES
(5, 22, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `new_games`
--

CREATE TABLE `new_games` (
  `id` int(10) UNSIGNED NOT NULL,
  `company` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text1` text,
  `text2` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `new_games`
--

INSERT INTO `new_games` (`id`, `company`, `url`, `text1`, `text2`) VALUES
(1, 'test', 'https://www.gewinnspielverzeichnis.at/gewinnspiel_melden.html', 'ttest', 'sdfsd');

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
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `remember_tokens`
--

INSERT INTO `remember_tokens` (`id`, `users_id`, `token`, `created_at`) VALUES
(4, 2, '11aa2a8b943b661b9e8dc6db7261cf6c', 1558934071);

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) NOT NULL,
  `games_id` int(10) NOT NULL,
  `report` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `users_id`, `games_id`, `report`) VALUES
(1, 2, 2, 'test report');

-- --------------------------------------------------------

--
-- Структура таблицы `saved_games`
--

CREATE TABLE `saved_games` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `saved_games`
--

INSERT INTO `saved_games` (`id`, `games_id`, `users_id`) VALUES
(2, 4, 2),
(3, 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `success_logins`
--

CREATE TABLE `success_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `ipAddress` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `success_logins`
--

INSERT INTO `success_logins` (`id`, `users_id`, `ipAddress`) VALUES
(34, 2, '127.0.0.1'),
(35, 2, '127.0.0.1'),
(36, 2, '127.0.0.1'),
(37, 2, '127.0.0.1'),
(38, 2, '127.0.0.1'),
(39, 2, '127.0.0.1'),
(40, 2, '127.0.0.1'),
(41, 2, '127.0.0.1'),
(42, 2, '127.0.0.1'),
(43, 2, '127.0.0.1'),
(44, 6, '127.0.0.1'),
(45, 2, '127.0.0.1'),
(46, 2, '127.0.0.1'),
(47, 2, '127.0.0.1'),
(48, 2, '127.0.0.1'),
(49, 2, '127.0.0.1'),
(50, 2, '127.0.0.1'),
(51, 2, '127.0.0.1'),
(52, 2, '127.0.0.1'),
(53, 2, '127.0.0.1'),
(54, 2, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `footer` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `tag`, `name`, `description`, `footer`, `created_at`, `updated_at`) VALUES
(21, 'linz', 'Linz', '', 1, '2019-05-19 19:57:08', '0000-00-00 00:00:00'),
(22, 'game', 'Gewinnspiel', '', 1, '2019-05-19 19:57:08', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `profiles_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profiles_id`) VALUES
(2, 'smotzart', '$2y$08$UlBPY1dSeFpnaTluRlg1YuZl0RbDZGgKCPaA5kf6FIMtpomlgfhhG', 1),
(3, 'smotzart2', '$2y$08$N2ZhOElLTG9hekNOV0wxYOYCp4KGbrTlpYz3aeJFqauDSWvX9Xi6K', 2),
(4, 'smotzart3', '$2y$08$VTlQOFhDSDZnL2Z1cGRTV.qqMB7IyQunWCNisGs0Bnlg5kGL7PUHy', 2),
(5, 'smotzart4', '$2y$08$SmpiMXVwUzMzWklSbnkwVu9KJMRAA3VEDJWcJxCMC1LhcgkIWWCYC', 2),
(6, '1234qwer', '$2y$08$NXhONld3WlFKTXRLMVhhWOr6oCFevOBo6vhRFDQ2mLCQQNIAE2u..', 2),
(7, 'admin', '$2y$08$UlBPY1dSeFpnaTluRlg1YuZl0RbDZGgKCPaA5kf6FIMtpomlgfhhG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `viewed_games`
--

CREATE TABLE `viewed_games` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `viewed_games`
--

INSERT INTO `viewed_games` (`id`, `games_id`, `users_id`) VALUES
(3, 1, 2),
(1, 4, 2),
(7, 29, 2);

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
-- Индексы таблицы `hidden_companies`
--
ALTER TABLE `hidden_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hidden_companies_users` (`companies_id`,`users_id`);

--
-- Индексы таблицы `hidden_games`
--
ALTER TABLE `hidden_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hiden_games_users` (`games_id`,`users_id`) USING BTREE;

--
-- Индексы таблицы `hidden_tags`
--
ALTER TABLE `hidden_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hidden_tags_users` (`tags_id`,`users_id`);

--
-- Индексы таблицы `new_games`
--
ALTER TABLE `new_games`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `saved_games`
--
ALTER TABLE `saved_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `saved_games_users` (`games_id`,`users_id`);

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
-- Индексы таблицы `viewed_games`
--
ALTER TABLE `viewed_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `viewed_game_user` (`games_id`,`users_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `games_tags`
--
ALTER TABLE `games_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT для таблицы `hidden_companies`
--
ALTER TABLE `hidden_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hidden_games`
--
ALTER TABLE `hidden_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hidden_tags`
--
ALTER TABLE `hidden_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `new_games`
--
ALTER TABLE `new_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `saved_games`
--
ALTER TABLE `saved_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `success_logins`
--
ALTER TABLE `success_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `viewed_games`
--
ALTER TABLE `viewed_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
