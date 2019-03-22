<?php

function quickSort(array $arr)
{
    $count = count($arr);
    if ($count <= 1) {
        return $arr;
    }
    $pivot = $arr[0];
    $left = $right = [];

    for ($i = 1; $i < $count; $i++)
    {
        if ($arr[$i] < $pivot) {
            $left[] = $arr[$i];
        } else {
            $right[] = $arr[$i];
        }
    }

    return array_merge(quickSort($left), (array) $pivot, quickSort($right));
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
echo 'OUPUT: ' . implode(quickSort($arr), ', ') . "\n";
