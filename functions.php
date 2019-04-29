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


