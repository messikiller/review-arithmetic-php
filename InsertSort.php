<?php

function insertSort(array $arr)
{
    $count = count($arr);

    for ($i = 1; $i < $count; $i++)
    {
        for ($j = $i - 1; $j >= 0; $j--)
        {
            if ($arr[$j] > $arr[$j + 1]) {
                swap($arr[$j], $arr[$j + 1]);
            }
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
echo 'OUPUT: ' . implode(insertSort($arr), ', ') . "\n";
