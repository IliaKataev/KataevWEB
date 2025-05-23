<?php

$menu = [
    'Главная' => '/',
    'Пираты' => [
        'Пираты Соломенной Шляпы' => '/crew/strawhats',
        'Пираты Белоуса' => '/crew/whitebeard',
        'Пираты Биг Мам' => '/crew/bigmom'
    ],
    'Морской флот' => [
        'Адмиралы' => '/navy/admirals',
        'Вице-адмиралы' => '/navy/vice-admirals',
        'Солдаты' => '/navy/soldiers'
    ],
    'Плоды Дьявола' => [
        'Зоан' => '/fruits/zoan',
        'Логия' => '/fruits/logia',
        'Парамеция' => '/fruits/paramecia'
    ],
    'Контакты' => '/contacts'
];

function renderMenu($items)
{
    echo "<ul>";
    foreach ($items as $title => $link) {
        echo "<li>";
        if (is_array($link)) {
            echo "$title";
            renderMenu($link);
        } else {
            echo "<a href=\"$link\">$title</a>";
        }
        echo "</li>";
    }
    echo "</ul>";
}

renderMenu($menu);



?>