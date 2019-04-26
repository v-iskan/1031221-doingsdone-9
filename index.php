<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
?>

<?php
$projects = [
    "Входящие",
    "Учеба",
    "Работа",
    "Домашние дела",
    "Авто"
];
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
        'dateOfComplition' => '22.12.2018',
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
