-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 22 2020 г., 07:54
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `taxi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` varchar(64) NOT NULL,
  `updated_at` varchar(64) NOT NULL,
  `deleted_at` varchar(64) NOT NULL,
  `owner_login` varchar(128) NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'FREE',
  `place_from` varchar(512) NOT NULL,
  `place_to` varchar(512) NOT NULL,
  `description` varchar(512) NOT NULL,
  `driver` varchar(128) NOT NULL,
  `cost` varchar(128) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` varchar(11) NOT NULL DEFAULT '0',
  `updated_at` varchar(11) NOT NULL DEFAULT '0',
  `deleted_at` varchar(11) NOT NULL DEFAULT '0',
  `group_id` varchar(64) NOT NULL DEFAULT 'CLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`, `updated_at`, `deleted_at`, `group_id`) VALUES
(1, 'admin', '123', '1581148699', '0', '0', 'ADMIN'),
(16, 'client', '123', '1581259043', '0', '0', 'CLIENT'),
(17, 'driver', '123', '1582309111', '0', '0', 'DRIVER');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
