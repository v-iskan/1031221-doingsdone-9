<?php

error_reporting(E_ALL);// показывать или нет выполненные задачи

$show_complete_tasks = rand(0, 1);
require_once('helpers.php');
require_once('functions.php'); // подключение файла с функциями

// Подтянули массив со списком проектов из БД

$link = mysqli_connect("localhost", "root", "159753Az", "dvp") or die(include_template('error.php', ['error' => mysqli_connect_error()]));

mysqli_set_charset($link, "utf8");
$sql = 'SELECT `p`.`id_project`, `p`.`name_project`, COUNT(t.name_task) as `task_count`
FROM `projects` `p`
       LEFT JOIN `tasks` `t`
                 ON `t`.`project_id` = `p`.`id_project`
WHERE `p`.`user_id` = 5
GROUP BY `p`.`id_project`, `p`.`name_project`';
$result = mysqli_query($link, $sql);
$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Подтянули массив со списком задача из БД

if (isset($_GET['id_project']) && !empty($_GET['id_project'])) { // Проверяем что параметр передан(существует) isset($_GET['id_project']) и что он не пустой !empty($_GET['id_project'])
    if (!in_array($_GET['id_project'], array_column($projects, 'id_project'))) /* Проверяем есть ли у нас значение параметра !in_array($_GET['id_project'] и в массиве $projects*/ {
        $_404 = "404 NOT FOUND";
        $content = include_template('_404.php', ['_404' => $_404]);
        print($content); // Вывод ошибки
        die();
    }
    $id_project = mysqli_real_escape_string($link, $_GET['id_project']); // Защита от SQL-инекции
    $sql = "SELECT `t`.`id_task`, `t`.`status`, `t`.`name_task`, `t`.`file`, `t`.`date_of_complition` 
FROM `tasks` `t`
WHERE `t`.`user_id` = 5 AND `t`.`project_id` = $id_project"; // Передается если условие выполняется (isset($_GET['id_project']) && !empty($_GET['id_project']))
} else {
    $sql = "SELECT `t`.`id_task`, `t`.`status`, `t`.`name_task`, `t`.`file`, `t`.`date_of_complition`
FROM `tasks` `t`
WHERE `t`.`user_id` = 5"; // Передается если условие НЕ выполняется (isset($_GET['id_project']) && !empty($_GET['id_project']))
}

$result = mysqli_query($link, $sql);
if ($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($link);
    $content = include_template('error.php', ['error' => $error]);
}



// подключение содержимое main - шаблон templates\index.php

$contetnPage = include_template('index.php',
    [
        'tasks' => $tasks,
        'show_complete_tasks' => $show_complete_tasks,
    ]
);

// окончательный HTML код шаблона templates\layout.php

$namePage = include_template('layout.php',
    [
        'content' => $contetnPage,
        'title' => "Дела в порядке",
        'projects' => $projects,
        'tasks' => $tasks,
    ]
);

print_r($namePage);
