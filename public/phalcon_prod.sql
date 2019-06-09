-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 09 2019 г., 22:18
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
-- База данных: `phalcon_prod`
--

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `host` mediumtext NOT NULL,
  `footer` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `companies_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` mediumtext,
  `price_info` int(1) NOT NULL DEFAULT '0',
  `type_register` int(1) NOT NULL DEFAULT '0',
  `type_sms` int(1) NOT NULL DEFAULT '0',
  `type_buy` int(1) NOT NULL DEFAULT '0',
  `type_internet` int(1) NOT NULL DEFAULT '0',
  `type_submission` int(1) NOT NULL DEFAULT '0',
  `suggested_solution` varchar(255) DEFAULT NULL,
  `enter_date` date DEFAULT NULL,
  `enter_time` time DEFAULT '06:00:00',
  `deadline_date` date DEFAULT NULL,
  `deadline_time` time DEFAULT '23:59:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `games_tags`
--

CREATE TABLE `games_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) NOT NULL,
  `tags_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `hidden_types`
--

CREATE TABLE `hidden_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `role`) VALUES
(4, 'Administrators', 'admin'),
(5, 'Users', 'user'),
(6, 'Superadmins', 'super');

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

-- --------------------------------------------------------

--
-- Структура таблицы `saved_games`
--

CREATE TABLE `saved_games` (
  `id` int(10) UNSIGNED NOT NULL,
  `games_id` int(10) NOT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 10, '23:59:00', '06:30:00', NULL, NULL, NULL, 'Title', 'Description', 'Title', 'Description', 'Title', 'Description', 'Title', 'Description');

-- --------------------------------------------------------

--
-- Структура таблицы `sorting`
--

CREATE TABLE `sorting` (
  `id` int(10) NOT NULL,
  `sorting_ids` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `success_logins`
--

CREATE TABLE `success_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `ipAddress` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext,
  `footer` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `sort_data` date DEFAULT NULL,
  `sort_type` int(1) NOT NULL DEFAULT '0',
  `notify` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Индексы таблицы `hidden_types`
--
ALTER TABLE `hidden_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `new_games`
--
ALTER TABLE `new_games`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sorting`
--
ALTER TABLE `sorting`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `games_tags`
--
ALTER TABLE `games_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT для таблицы `hidden_companies`
--
ALTER TABLE `hidden_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `hidden_games`
--
ALTER TABLE `hidden_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hidden_tags`
--
ALTER TABLE `hidden_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `hidden_types`
--
ALTER TABLE `hidden_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `new_games`
--
ALTER TABLE `new_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `remember_tokens`
--
ALTER TABLE `remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `saved_games`
--
ALTER TABLE `saved_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sorting`
--
ALTER TABLE `sorting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `success_logins`
--
ALTER TABLE `success_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `viewed_games`
--
ALTER TABLE `viewed_games`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
