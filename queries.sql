-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 06 2019 г., 20:35
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

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id_project`, `name_project`, `user_id`) VALUES
(3, 'Входящие', 5),
(5, 'Учеба', 5),
(7, 'Работа', 5),
(9, 'Домашние дела', 5),
(11, 'Авто', 5);

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id_task`, `status`, `name_task`, `file`, `date_of_complition`, `user_id`, `project_id`) VALUES
(1, 0, 'Собеседование в IT компании', NULL, '2018-12-01 00:00:00', 5, 7),
(2, 0, 'Выполнить тестовое задание', NULL, '2018-12-25 00:00:00', 5, 7),
(3, 1, 'Сделать задание первого раздела', NULL, '2018-12-21 00:00:00', 5, 5),
(4, 0, 'Встреча с другом', NULL, '2018-12-22 00:00:00', 5, 3),
(5, 0, 'Купить корм для кота', NULL, NULL, 5, 9),
(6, 0, 'Заказать пиццу', NULL, NULL, 5, 9);

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `datRreg`, `e-mail`, `user_name`, `password`) VALUES
(5, '2018-11-30 00:00:00', 'perov83@gmail.com', 'Искандер Владимирович', '159753Фя'),
(6, '2018-11-30 00:00:00', 'sverlov@gmail.com', 'Искандер Владимирович', '159753Фя');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Существующий список проектов
--

SELECT name_project FROM projects;

--
-- Добавление пользователей
--

INSERT INTO users (datRreg, `e-mail`, 'user_name', 'password') VALUES
('2019-02-02 00:00:00', 'vasya@pupkin.net', 'Василий Пупкин', '1234567!'),
('2019-02-03 00:00:00', 'ivan@ivan.ru', 'Иван Ивыанов', '1234567!');

--
-- Существующий список задач
--

SELECT name_task FROM tasks;

--
-- Получить список из всех задач для одного проекта
--

SELECT name_task FROM tasks
WHERE project_id = 9;

--
-- Обновить название задачи по её идентификатору
--

UPDATE tasks SET name_task = 'Заказать фрукты'
WHERE id_task = 6;

--
-- Пометить задачу как выполненную
--

UPDATE tasks SET status = 1
WHERE id_task = 2;

--
--
--

SELECT DISTINCT COUNT(t.id_task) as task_count, p.name_project, t.name_task
FROM projects p
       LEFT JOIN tasks t
                 ON t.project_id = p.id_project
WHERE p.user_id = 5
GROUP BY p.name_project, t.name_task;
