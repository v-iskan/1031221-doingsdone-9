-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 06 2019 г., 20:29
-- Версия сервера: 5.7.25
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dvp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id_project` int(11) NOT NULL COMMENT 'id проекта',
  `name_project` varchar(30) NOT NULL COMMENT 'Название проекта',
  `user_id` int(11) DEFAULT NULL COMMENT 'Сюда подтягивается поле id-user из таблицы Users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Какие проекты и сколько задач в проекте';

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL COMMENT 'id задачи',
  `status` tinyint(1) DEFAULT '0' COMMENT 'Статус задачи (выполнена/не выполнена',
  `name_task` varchar(60) NOT NULL COMMENT 'Название задачи',
  `file` text COMMENT 'Ссылка на файл',
  `date_of_complition` datetime DEFAULT NULL COMMENT 'Дата дедлайна',
  `user_id` int(11) NOT NULL COMMENT 'Сюда подтягивается поле id-user из таблицы Users',
  `project_id` int(11) NOT NULL COMMENT 'Сюда подтягивается поле id-project из таблицы Projects'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список Задач с датой дедлайна';

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL COMMENT 'id пользователя',
  `datRreg` datetime NOT NULL COMMENT 'Дата время регистрации пользователя',
  `e-mail` varchar(64) NOT NULL COMMENT 'E-mail пользователя',
  `user_name` varchar(120) NOT NULL COMMENT 'Имя пользователя',
  `password` varchar(20) NOT NULL COMMENT 'Пароль авторизации пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список пользователей';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `e-mail` (`e-mail`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id проекта';

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id задачи';

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id пользователя';

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id_project`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



