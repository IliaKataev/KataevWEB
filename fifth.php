<?php

echo "Вариант первый <br><br>";
include("fifth_1.php");

echo "<br><br><br><br><br>";

echo "Вариант второй <br><br>";
$file = file_get_contents("fifth_1.php");
echo $file;

echo "<br><br><br><br><br>";

echo "Вариант третий <br><br>";
function renderTemplate($page)
{
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}
$file2 = renderTemplate("fifth_1");
echo $file2;

echo "<br><br><br><br><br>";
?>