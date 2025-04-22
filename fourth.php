<?php

include("third.php");
function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case "add":
            return add($arg1, $arg2);
        case "subtract":
            return subtract($arg1, $arg2);
        case "multiply":
            return multiply($arg1, $arg2);
        case "divide":
            return divide($arg1, $arg2);
        default:
            return "Неизвестная операция";
    }
}
echo "Задание 4<br>";
echo mathOperation(10, 5, "multiply");
?>