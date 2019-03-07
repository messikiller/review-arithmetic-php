<?php

function binaryInsertSort($arr)
{
    $count = count($arr);

    for ($i = 1; $i < $count; $i++)
    {
        $left = 0;
        $right = $i - 1;

        $temp = $arr[$i];

        while ($left <= $right) {
            $middle = floor(($left + $right) / 2);
            if ($arr[$middle] > $temp) {
                $right = $middle - 1;
            } else {
                $left = $middle + 1;
            }
        }

        for ($j = $i -1; $j >= $left; $j++) {
            swap($arr[$j + 1], $arr[$j]);
        }

        $arr[$left] = $temp;
    }

    return $arr;
}

function swap(&$i, &$j)
{
    $temp = $i;
    $i = $j;
    $j = $temp;
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
echo 'OUPUT: ' . implode(binaryInsertSort($arr), ', ') . "\n";
