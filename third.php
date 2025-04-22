<?php
function add($a, $b)
{
    return "Сложение $a и $b - " . ($a + $b);
}

function subtract($a, $b)
{
    return "Вычитание $a и $b - " . ($a - $b);
}

function multiply($a, $b)
{
    return "Умножение $a и $b - " . ($a * $b);
}

function divide($a, $b)
{
    if ($b == 0) {
        return "Деление на ноль невозможно";
    }
    return "Деление $a и $b - " . ($a / $b);
}
echo "Задание 3<br>";
echo add(12, 2) . "<br>";
echo multiply(12, 2) . "<br>";
echo divide(12, 2) . "<br>";
echo subtract(12, 2) . "<br><br><br><br>";

?>