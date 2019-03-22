<?php

function array_contain($a, $b)
{
    $size_a = sizeof($a);
    $size_b = sizeof($b);

    $i = 0;
    $j = 0;

    while ($i < $size_a) {
        if ($a[$i] == $b[0]) {
            break;
        }
        $i++;
    }

    if ($a[$i] != $b[0]) {
        return false;
    }

    while ($i < $size_a && $j < $size_b) {
        if ($a[$i] != $b[$j]) {
            return false;
        }
        $i++;
        $j++;
    }

    if ($j > $size_b) {
        return false;
    }

    return true;
}

$a = [1, 2, 3, 4, 5, 6, 7];
$b = [5, 6, 7, 8];

var_dump(array_contain($a, $b));
