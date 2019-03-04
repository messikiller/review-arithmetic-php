<?php

class Node
{
    public $data;
    public $next = null;
    public function __construct($data)
    {
        $this->data = $data;
    }
}

class LinkList
{
    public $head;

    public function __construct()
    {
        $this->head = new Node(null);
    }

    public function count()
    {
        $cur = $this->head;
        $count = 0;
        while (! is_null($cur->next)) {
            $count++;
            $cur = $cur->next;
        }
        return $count;
    }

    public function add($data)
    {
        $cur = $this->head;
        while (! is_null($cur->next)) {
            $cur = $cur->next;
        }
        $newNode = new Node($data);
        $cur->next = $newNode;
    }

    public function insert($data, $no)
    {
        $count = $this->count();
        if ($no > $count) {
            return false;
        }
        $cur = $this->head;
        $i = 0;
        while (! is_null($cur->next) && $i < $no) {
            $cur = $cur->next;
            $i++;
        }

        $newNode = new Node($data);
        $newNode->next = $cur->next;
        $cur->next = $newNode;
    }

    public function delete($no)
    {
        $count = $this->count();
        if ($no > $count) {
            return false;
        }
        $cur = $this->head;

        $i = 0;
        while (! is_null($cur->next) && $i < $no) {
            $cur = $cur->next;
            $i++;
        }

        $cur->next = $cur->next->next;
    }

    public function show()
    {
        echo "\n";
        $cur = $this->head;
        while (! is_null($cur->next)) {
            $cur = $cur->next;
            echo $cur->data . ' -> ';
        }
        echo 'NULL' . "\n";
        echo "\n";
    }
}

$linkList = new LinkList();
$linkList->add('aaa');
$linkList->add('bbb');
$linkList->add('ccc');
$linkList->add('ddd');
$linkList->insert('eeeeeeee', 2);
$linkList->delete(6);
$linkList->show();
