<?php

function shellSort($arr)
{
    $count = count($arr);
    for ($increment = intval($count / 2); $increment > 0; $increment = intval($increment / 2))
    {
        for ($i = $increment; $i < $count; $i++)
        {
            $temp = $arr[$i];
            for ($j = $i; $j >= $increment; $j -= $increment)
            {
                if ($temp < $arr[$j - $increment]) {
                    $arr[$j] = $arr[$j - $increment];
                } else {
                    break;
                }
            }
            $arr[$j] = $temp;
        }
    }
    return $arr;
}

$arr = range(1, 20);
shuffle($arr);

echo 'INPUT: ' . implode($arr, ', ') . "\n";
echo 'OUPUT: ' . implode(shellSort($arr), ', ') . "\n";
