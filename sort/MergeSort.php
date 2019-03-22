<?php

function mergeSort(&$arr, $left = null, $right = null)
{
    $left = $left ?? 0;
    $right = $right ?? (count($arr) - 1);

    if ($left < $right) {
        $center = floor(($left + $right) / 2);
        mergeSort($arr, $left, $center);
        mergeSort($arr, $center + 1, $right);
        mergeSortedArray($arr, $left, $center, $right);
    }
}

function mergeSortedArray(&$arr, $left, $center, $right)
{
    $l_pointer = $left;
    $r_pointer = $center + 1;

    while ($l_pointer <= $center && $r_pointer <= $right) {
        if ($arr[$l_pointer] < $arr[$r_pointer]) {
            $temp[] = $arr[$l_pointer];
            $l_pointer++;
        } else {
            $temp[] = $arr[$r_pointer];
            $r_pointer++;
        }
    }

    while ($l_pointer <= $center) {
        $temp[] = $arr[$l_pointer];
        $l_pointer++;
    }

    while ($r_pointer <= $right) {
        $temp[] = $arr[$r_pointer];
        $r_pointer++;
    }

    $len = count($temp);
    for ($i = 0; $i < $len; $i++) {
        $arr[$left + $i] = $temp[$i];
    }
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
mergeSort($arr);
echo 'OUPUT: ' . implode($arr, ', ') . "\n";
