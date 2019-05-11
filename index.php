<?php
error_reporting(E_ALL);// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
?>


<?php // Подтянули массив со списком проектов из БД
$link = mysqli_connect("localhost", "root", "159753Az", "dvp");

if ($link == false) {
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    $sql = 'SELECT `p`.`id_project`, `p`.`name_project`, COUNT(t.name_task) as `task_count`
FROM `projects` `p`
       LEFT JOIN `tasks` `t`
                 ON `t`.`project_id` = `p`.`id_project`
WHERE `p`.`user_id` = 5
GROUP BY `p`.`name_project`';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>


<?php // Подтянули массив со списком задача из БД
$link = mysqli_connect("localhost", "root", "159753Az", "dvp");

if ($link == false) {
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    $sql = 'SELECT `t`.`id_task`, `t`.`status`, `t`.`name_task`, `t`.`fail`, `t`.`date_of_complition`
FROM `tasks` `t`';
    $result = mysqli_query($link, $sql);
    if (result) {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>


<?php
require_once('helpers.php');
require_once('functions.php'); // подключение файла с функциями
// массив пунктами меню проектов
$tasks = [
    [
        'task' =>             'Собеседование в IT компании',
        'dateOfComplition' => '01.12.2018',
        'category' =>         'Работа',
        'done' => false,
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'dateOfComplition' => '25.12.2018',
        'category' => 'Работа',
        'done' => false,
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'dateOfComplition' => '21.12.2018',
        'category' => 'Учеба',
        'done' => true,
    ],
    [
        'task' => 'Встреча с другом',
        'dateOfComplition' => '22.12.2019',
        'category' => 'Входящие',
        'done' => false,
    ],
    [
        'task' => 'Купить корм для кота',
        'dateOfComplition' => null,
        'category' => 'Домашние дела',
        'done' => false,
    ],
    [
        'task' => 'Заказать пиццу',
        'dateOfComplition' => null,
        'category' => 'Домашние дела',
        'done' => false,
    ]
];


// подключение содержимое main - шаблон templates\index.php

$contetnPage = include_template('index.php',
    [
        'tasks'               => $tasks,
        'show_complete_tasks' => $show_complete_tasks,
    ]
);

// окончательный HTML код шаблона templates\layout.php

$namePage = include_template('layout.php',
    [
        'content'  => $contetnPage,
        'title'    => "Дела в порядке",
        'projects' => $projects,
        'tasks'    => $tasks,
    ]
);

print_r($namePage);
