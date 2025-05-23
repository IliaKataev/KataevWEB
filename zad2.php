<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Скопин', 'Касимов']
];

foreach ($regions as $regionName => $cityList) {
    echo "<strong>$regionName:</strong><br>";
    $formattedCities = implode(', ', $cityList);
    echo $formattedCities . '.<br>';
}

?>