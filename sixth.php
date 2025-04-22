<?php
function power($val, $pow)
{
    if ($pow == 0) {
        return 1;
    }

    if ($pow < 0) {
        return 1 / power($val, -$pow);
    }

    return $val * power($val, $pow - 1);
}


echo power(2, 3) . "<br>";
echo power(5, 0) . "<br>";
echo power(2, -2) . "<br>";
?>