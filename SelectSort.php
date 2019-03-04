<?php

function selectSort(array $arr)
{
    $count = count($arr);
    for ($i = 0; $i < $count; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $count; $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            swap($arr[$i], $arr[$min]);
        }
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
echo 'OUPUT: ' . implode(selectSort($arr), ', ') . "\n";
