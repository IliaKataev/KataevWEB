<?php

require 'zad2.php';

echo "<hr><br>";

echo "<h3>Города, начинающиеся с буквы \"К\":</h3>";

foreach ($regions as $cities) {
    foreach ($cities as $city) {
        if (mb_substr($city, 0, 1, 'UTF-8') === 'К') {
            echo "$city<br>";
        }
    }
}



?>