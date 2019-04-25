<?php
error_reporting(E_ALL);// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
?>

<?php
$projects = [
    "Входящие","Учеба","Работа","Домашние дела","Авто"
];
?>

<?php
require_once('helpers.php');
// массив пунктами меню проектов
$tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'dateOfComplition' => '01.12.2018',
        'category' => 'Работа',
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


// двумерный массив задач с параметрами

$contetnPage = include_template('index.php', ['task' => $tasks]);

// окончательный HTML код

$namePage = include_template('layout.php', ['content' => $contetnPage]);

print($namePage);
