<?php

class LruNode
{
    public $key;
    public $data;
    public $next;
    public $previous;

    public function __construct($key, $data)
    {
        $this->key = $key;
        $this->data = $data;
    }
}

class LruCache
{
    private $head;
    private $tail;
    private $capacity;
    private $hashmap;

    public function __construct($capacity)
    {
        $this->capacity = $capacity;
        $this->hashmap = [];
        $this->head = new LruNode(null, null);
        $this->tail = new LruNode(null, null);
        $this->head->next = $this->tail;
        $this->tail->previous = $this->head;
    }

    public function get($key)
    {
        if (! isset($this->hashmap[$key])) {
            return null;
        }
        $node = $this->hashmap[$key];
        if (count($this->hashmap) == 1) {
            return $node->data;
        }
        // refresh access
        $this->detach($node);
        $this->attach($node);
        return $node->data;
    }

    public function put($key, $data)
    {
        if ($this->capacity <= 0) {
            return false;
        }
        if (isset($this->hashmap[$key])) {
            $node = $this->hashmap[$key];
            $node->data = $data;
            $this->detach($node);
            $this->attach($node);
        } else {
            $node = new LruNode($key, $data);
            $this->hashmap[$key] = $node;
            $this->attach($node);
        }
        if (count($this->hashmap) == $this->capacity) {
            $this->gc();
        }
    }

    public function dump()
    {
        echo PHP_EOL;
        echo 'Capacity:' . $this->capacity . PHP_EOL;
        echo PHP_EOL;
        echo 'Hashmap:' . PHP_EOL;
        echo PHP_EOL;
        foreach ($this->hashmap as $key => $node) {
            echo "[{$node->key}] => {$node->data}" . PHP_EOL;
        }

        echo PHP_EOL;
        echo 'Linklist' . PHP_EOL;
        echo PHP_EOL;

        $str = 'HEAD->';
        $cur = $this->head->next;
        while ($cur != $this->tail) {
            $str .= "[{$cur->key}]{$cur->data}->";
            $cur = $cur->next;
        }
        $str .= 'TAIL';
        echo $str . PHP_EOL;
        echo PHP_EOL;
    }

    private function gc()
    {
        $node = $this->tail->previous;
        $this->detach($node);
        unset($this->hashmap[$node->key]);
    }

    /**
    * insert node after head
    */
    private function attach(LruNode $node)
    {
        $node->previous = $this->head;
        $node->next = $this->head->next;
        $node->next->previous = $node;
        $this->head->next = $node;
    }

    /**
    * remove specific node
    */
    private function detach(LruNode $node)
    {
        $node->previous->next = $node->next;
        $node->next->previous = $node->previous;
        $node->previous = null;
        $node->next = null;
    }
}

$lru = new LruCache(5);

foreach (range(1, 4) as $index) {
    $lru->put("key{$index}", "data{$index}");
}

// $lru->get('key2');
$lru->put('key4', 'aaaa');
$lru->put('key2', 'sssws');
$lru->put('key5', 'dddddddd');
$lru->put('key67', 'kkkk');

$lru->dump();
