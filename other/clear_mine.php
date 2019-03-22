<?php

class ClearMine
{
    private $width;
    private $height;
    private $mine_num;
    private $result;

    private $mine_flag = '*';
    private $mines = [];

    public function __construct($width, $height, $mine_num)
    {
        $this->width = $width;
        $this->height = $height;
        $this->mine_num = $mine_num;
    }

    public function run()
    {
        $this->initResult();
        $this->putMines();
        $this->scan();
        $this->printResult();
    }

    private function initResult()
    {
        $this->result = [];
        for ($i = 0; $i < $this->height; $i++) {
            for ($j = 0; $j < $this->width; $j++) {
                $this->result[$i][$j] = 0;
            }
        }
    }

    private function putMines()
    {
        $mines = [];
        $mine_num = $this->mine_num;
        $max = $this->height * $this->width - 1;
        while ($mine_num > 0) {
            $rand = mt_rand(0, $max);
            if (in_array($rand, $mines)) {
                continue;
            }
            $mines[] = $rand;
            $x = $rand % $this->width;
            $y = floor($rand / $this->width);
            $this->mines[] = [$x, $y];
            $this->result[$y][$x] = $this->mine_flag;
            $mine_num--;
        }
    }

    private function scan()
    {
        foreach ($this->mines as $mine) {
            list($x, $y) = $mine;
            $this->increasePoint($x - 1, $y - 1);
            $this->increasePoint($x, $y - 1);
            $this->increasePoint($x + 1, $y - 1);
            $this->increasePoint($x - 1, $y);
            $this->increasePoint($x + 1, $y);
            $this->increasePoint($x - 1, $y + 1);
            $this->increasePoint($x, $y + 1);
            $this->increasePoint($x + 1, $y + 1);
        }
    }

    private function increasePoint($x, $y)
    {
        if ($x < 0 || $y < 0 || $x >= $this->width || $y >= $this->height) {
            return false;
        }
        if ($this->mine_flag === $this->result[$y][$x]) {
            return false;
        }
        $this->result[$y][$x]++;
    }

    private function printResult()
    {
        echo "\n";
        foreach ($this->result as $line) {
            foreach ($line as $point) {
                if ($point === $this->mine_flag) {
                    echo ' ' . $this->red($point) . ' ';
                } else {
                    echo ' ' . $this->green($point) . ' ';
                }
            }
            echo "\n\n";
        }
    }

    private function green($str)
    {
        return "\033[32m{$str}\033[0m";
    }

    private function red($str)
    {
        return "\033[31m{$str}\033[0m";
    }
}

$clearMine = new ClearMine(5, 5, 5);
$clearMine->run();
