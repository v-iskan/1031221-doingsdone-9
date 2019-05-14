<?php

function taskCounting($tasks, $projects)
{
    $count = 0;
    foreach ($tasks as $key => $val)
    {
        if ($val["category"] === $projects)
        {
            $count++;
        }
    }
    return $count;
};

function esc($var)
{
    $text = htmlspecialchars($var);

    return $text;
};

function dateDiff($date) // функция возвращает разницу между дадами в абсолютных днях
{
    $dateDeadline = new DateTime($date); //дата крайнего срока выполнения задачи из массива
    $dateNow = new DateTime('now'); // датавремя сейчас
    $interval = $dateNow->diff($dateDeadline); // интервал между датами в абсолютных (a)часа
    return $interval->format('%R%a');
};

