<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post" autocomplete="off">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox"<?php if ($show_complete_tasks == 1): ?> checked<?php endif; ?>>
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $val): ?>
        <?php if ($show_complete_tasks == 1 || ($show_complete_tasks == 0 && $val['done'] == false)): ?>
            <tr class="tasks__item task<? if ($val['done'] == true): ?> task--completed<? endif; ?><? if (dateDiff($val['dateOfComplition']) <= 1 && $val['dateOfComplition'] !== null && $val['done'] == false): ?> task--important<? endif; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                        <span class="checkbox__text"><?=$val['task']; ?><?=esc($var);?></span>
                    </label>
                </td>

                <td class="task__file">
                    <a class="download-link" href="#">Home.psd</a>
                </td>

                <td class="task__date"><?=$val['dateOfComplition']; ?><?=esc($var);?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
</table>
