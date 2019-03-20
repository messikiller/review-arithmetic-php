<?php

function mergeSort(&$arr, $left = null, $right = null)
{
    $left = $left ?? 0;
    $right = $right ?? (count($arr) - 1);

    if ($left < $right)
    {
        $middle = floor(($left + $right) / 2);
        mergeSort($arr, $left, $middle);
        mergeSort($arr, $middle + 1, $right);
        mergeSortedArray($arr, $left, $middle, $right);
    }
}

function mergeSortedArray(&$arr, $left, $middle, $right)
{
    $l_pointer = $left;
    $r_pointer = $middle + 1;

    $result = [];

    while (($l_pointer <= $middle) && ($r_pointer <= $right))
    {
        if ($arr[$l_pointer] < $arr[$r_pointer]) {
            $result[] = $arr[$l_pointer];
            $l_pointer++;
        } else {
            $result[] = $arr[$r_pointer];
            $r_pointer++;
        }
    }

    while ($l_pointer <= $middle) {
        $result[] = $arr[$l_pointer];
        $l_pointer++;
    }

    while ($r_pointer <= $right) {
        $result[] = $arr[$r_pointer];
        $r_pointer++;
    }

    $len = count($result);
    for ($i = 0; $i < $len; $i++) {
        $arr[$left + $i] = $result[$i];
    }
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
mergeSort($arr);
echo 'OUPUT: ' . implode($arr, ', ') . "\n";
