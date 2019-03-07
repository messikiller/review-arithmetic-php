<?php

function shuttleSort($arr)
{
    $count = count($arr);

    $left = 0;
    $right = $count - 1;

    while ($left < $right)
    {
        $lastRight = 0;
        $lastLeft = 0;

        for ($i = $left; $i < $right; $i++) {
            if ($arr[$i] > $arr[$i + 1]) {
                swap($arr[$i], $arr[$i + 1]);
                $lastRight = $i;
            }
        }

        $right = $lastRight;

        for ($j = $right; $j > $left; $j--) {
            if ($arr[$j] < $arr[$j - 1]) {
                swap($arr[$j], $arr[$j - 1]);
                $lastLeft = $j;
            }
        }

        $left = $lastLeft;
    }

    return $arr;
}

function swap(&$a, &$b)
{
    $a = $a + $b;
    $b = $a - $b;
    $a = $a - $b;
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
echo 'OUPUT: ' . implode(shuttleSort($arr), ', ') . "\n";
