-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 20 2023 г., 19:36
-- Версия сервера: 8.0.33-0ubuntu0.22.04.2
-- Версия PHP: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `build_top_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `cat_id` int NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'Ремонт. Строительные и отделочные материалы', 'Обсуждение всех видов строительных материалов, их свойств, применение строительных и отделочных материалов, выбор материалов, советы по ремонту'),
(2, 'Инструмент и оборудование', 'Обсуждение строительных инструментов. оборудования и механизмов, обслуживание и эксплуатация инструментов. расходные материалы.'),
(4, 'Электрика. Новые возможности', 'Все, что связанно с электрикой');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id_user` int NOT NULL,
  `message_date` datetime NOT NULL,
  `message_content` text NOT NULL,
  `message_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id_user`, `message_date`, `message_content`, `message_from`) VALUES
(4, '2023-06-20 19:34:16', 'Слишком мало описания, какой размер имеет статуя.', '23');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `order_content` text NOT NULL,
  `order_date` datetime NOT NULL,
  `order_city` text NOT NULL,
  `order_tel` varchar(15) NOT NULL,
  `order_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `order_content`, `order_date`, `order_city`, `order_tel`, `order_by`) VALUES
(1, 'Укладка тротуарной плитки! Срочно!  Объём – 350кв.м. Цена- 650р за м.кв. за работу.', '2021-10-03 11:16:14', 'Саратов ', '+78094567653', 26),
(2, 'Обустройство полов. Демонтаж старого деревянного настила(доска 50 на 100), с последующим настиланием новых досок(доска 50 на 100), застилание OSB и устройством ламината. Объем 70 кв.м. Цена договорная.', '2021-10-06 08:57:45', 'Томск', '+78094677643', 27),
(8, 'Облицовка пола керамогранитомразмером 60х60см. Торговые помещения. Демонтаж старого покрытия(керамогранит 40х40). Работа в ночное время. Цена договорная.', '2023-06-20 14:22:19', 'Москва', '+78094677690', 4),
(9, 'Поклейка обой в двух помещениях: кухня и коридор. Объем 50кв.м. Обои флизилиновые. Стены: местами шпатлёваные плиты, есть старые кусочки обой.', '2023-06-20 15:06:06', 'Белгород', '+78094347665', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_moder`
--

CREATE TABLE `orders_moder` (
  `order_id` int NOT NULL,
  `order_content` text NOT NULL,
  `order_date` datetime NOT NULL,
  `order_city` text NOT NULL,
  `order_tel` varchar(15) NOT NULL,
  `order_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders_moder`
--

INSERT INTO `orders_moder` (`order_id`, `order_content`, `order_date`, `order_city`, `order_tel`, `order_by`) VALUES
(20, 'Ремонт бани. Востановление печки. Баня где-то 4х4 по полу. Обита вогонкой. Старую вогонку нужно поменять и переварить или переделать топку.', '2023-06-20 14:31:36', 'Воронеж', '+79066754567', 48);

-- --------------------------------------------------------

--
-- Структура таблицы `orders_moder_redact`
--

CREATE TABLE `orders_moder_redact` (
  `order_id` int NOT NULL,
  `order_content` text NOT NULL,
  `order_date` datetime NOT NULL,
  `order_city` text NOT NULL,
  `order_tel` varchar(15) NOT NULL,
  `order_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders_moder_redact`
--

INSERT INTO `orders_moder_redact` (`order_id`, `order_content`, `order_date`, `order_city`, `order_tel`, `order_by`) VALUES
(6, 'Поклейка обой в двух помещениях: кухня и коридор. Объем 50кв.м. Обои флизилиновые.', '2021-10-06 09:06:32', 'Белгород', '+78094347665', 4),
(7, 'Ремонт бани. Востановление печки.', '2023-06-20 14:27:55', 'Воронеж', '+79066754567', 48),
(8, 'Нужно отреставрировать статую из гипса', '2023-06-20 19:34:16', 'Белгород', '8906755443', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int NOT NULL,
  `post_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`) VALUES
(1, 'Проводка - дело серьёзное. Я бы вам порекомендовал обратиться к профессиональному электрику. А так расскажите какие требования к электрике, на сколько мощная она нужна, может вы там ракетные двигателя собирать хотите?', '2021-10-02 10:56:28', 2, 27),
(3, 'В старых шпалах содержится вредный для человека и природы каменноугольный креозот. Задумайтесь над этим, минимизируйте контакты членов семьи, растений и животных со шпалами! Покраска и покрытие лаком снизят потенциальный вред от пропитки креозотом.', '2021-10-02 15:54:42', 1, 26),
(5, 'По возможности откажитесь от использования шпал на участке', '2021-10-11 10:05:12', 1, 23),
(6, 'Некоторые их в строительстве домов используют..это очень вредно. Есть масса других материалов. Для чего вы их хотите использовать конкретно?', '2021-10-13 20:40:08', 1, 27),
(7, 'Спасибо всем за ответы!', '2021-11-08 21:18:36', 1, 4),
(8, 'Ну как там с твоей идеей со шпалами?', '2023-06-09 20:58:37', 1, 23),
(9, 'Может завести собаку на территории?', '2023-06-12 18:53:34', 3, 23),
(10, 'Привет, купили себе знакомые такое чудо техники..и ни разу не пользовалить почему-то (((', '2023-06-18 13:37:01', 5, 23),
(11, 'Какие ракетные двигателя?))\r\nВсе намного скромнее, пару ферм для майнинга, пару разеток и освещение.', '2023-06-18 13:44:46', 2, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `topic_id` int NOT NULL,
  `topic_subject` varchar(550) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int NOT NULL,
  `topic_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`) VALUES
(1, 'Чем грозит использование железнодорожных шпал на участке???', '2021-09-20 22:18:48', 1, 4),
(2, 'Обдумываю вопрос по пристройки мастерской в гараже, сейчас стоит вопрос с проводкой… Старая практически вся сгнила, иногда освещение боюсь включать… Как сделать нормально и качественно проводку? Какие будут рекомендации?', '2021-09-28 14:51:27', 1, 23),
(3, 'Как можно обезопасить свой дом своими руками? Реально ли это или лучше довериться платным средствам и услугам охраны?', '2021-09-28 15:19:43', 1, 27),
(4, 'Хочу купить шуруповерт, посоветуйте какой. \r\nЗдравствуйте, Я занимаюсь установкой спутниковых антенн, для этого мне совершенно необходимо использовать разного рода технику, но вот шуруповерт нужен, не пользовался никогда, только отвёрткой.', '2021-09-29 14:23:41', 2, 4),
(5, 'Доброго времени суток всем. Видел на али экспресс в продаже валик для покраски с автоматической подачей краски прямо в валик. Никто не покупал себя такое чудо техники? ', '2021-10-06 09:15:32', 2, 4),
(6, 'Кто нибудь ставил систему умный дом? Как правильно ее рассчитать?', '2023-06-20 15:03:45', 4, 48);

-- --------------------------------------------------------

--
-- Структура таблицы `topics_moder`
--

CREATE TABLE `topics_moder` (
  `topic_id` int NOT NULL,
  `topic_subject` varchar(550) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int NOT NULL,
  `topic_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `user_level` int NOT NULL,
  `cookie` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_level`, `cookie`) VALUES
(4, 'Ivan', '$2y$10$XCvbC2pdaSCQuzrZjZugg.2QtnTE.8q20YJcF7VAKni73z7aZYgHy', 'mail3@gmail.com', '2021-09-17 12:36:16', 0, ''),
(23, 'Vika', '$2y$10$Zf9HN5GBm9U3egEKyIvMCe01AKD.kAxft5Iyh0mMZsl9/BEoQMJ12', 'babikovav8@gmail.com', '2021-09-25 18:30:07', 1, '65c05cc91833b0e792f0414ce0280daa07a73231d66e003cdc776cb4c9d8c864'),
(26, 'sveta', '$2y$10$SFw4LbWKufy0iQMVujsIk.zRnZ/EkEwSdypaZKHh31UEqignAGrcC', 'mail22@gmail.com', '2021-09-26 15:29:31', 0, '6d0372e345ba4ad24ddc4dc50dc7f1023bc4509a95640a7612cf51d542393f1c'),
(27, 'Petr', '$2y$10$BTq2j89zhnugwNEJ/n5anu4HLcvFJ42AJ5P2D3J9E5.rUGz4jZi1O', 'mail5@gmail.com', '2021-10-01 23:18:17', 0, '16cf43ed8c563d3f800d2f1196c231def01e118c241b1de8bde3e57eb002d8b6'),
(48, 'Vera', '$2y$10$B.srRErVLfwrz1IIIbPHj.nKHqdoEGm47oh0YYE5kQX96rbeDNCD6', 'vera@gmail.com', '2023-06-18 15:21:52', 0, 'd4234a9bc80a89b38057da81e663465533d4482d38a931eeb2cc67dc75da6834');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name_unique` (`cat_name`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_user`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_ibfk_1` (`order_by`);

--
-- Индексы таблицы `orders_moder`
--
ALTER TABLE `orders_moder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_ibfk_2` (`order_by`);

--
-- Индексы таблицы `orders_moder_redact`
--
ALTER TABLE `orders_moder_redact`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_topic` (`post_topic`),
  ADD KEY `post_by` (`post_by`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_cat` (`topic_cat`),
  ADD KEY `topic_by` (`topic_by`);

--
-- Индексы таблицы `topics_moder`
--
ALTER TABLE `topics_moder`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_cat` (`topic_cat`),
  ADD KEY `topic_by` (`topic_by`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders_moder`
--
ALTER TABLE `orders_moder`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `orders_moder_redact`
--
ALTER TABLE `orders_moder_redact`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `topics_moder`
--
ALTER TABLE `topics_moder`
  MODIFY `topic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders_moder`
--
ALTER TABLE `orders_moder`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `topics_moder`
--
ALTER TABLE `topics_moder`
  ADD CONSTRAINT `topics_moder_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `topics_moder_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
