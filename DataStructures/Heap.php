<?php
class Heap{
    public $arr;
    public $count;
    public function __construct($arr){
        $this->arr = $arr;
        $this->count = count($arr);
    }
    public function run(){
        $i = (int)(floor($this->count)/2);
        while($i--){
            $this->createHeap($i);
        }   
    }
    //初始化堆
    private function createHeap($i){
        if($i>=$this->count){
            return;
        }
        $left = 2*$i + 1;
        $right = $left + 1;
        $max = $i;
        if($left < $this->count && $this->arr[$left] > $this->arr[$max]){
            $max = $left;
        }
        if($right < $this->count && $this->arr[$right] > $this->arr[$max]){
            $max = $right;
        }
        if($i!=$max && $max<$this->count){
            $this->swap($i,$max);
            $this->createHeap($max);
        }
    }

    public function insert($val){
        $this->arr[$this->count] = $val;
        $this->count++;
        //将被插入元素放到末尾，然后上浮
        $this->swim($this->count-1);
    }

    private function swap($i,$j){
        $tmp = $this->arr[$i];
        $this->arr[$i] = $this->arr[$j];
        $this->arr[$j] = $tmp;
    }

    //大根堆上浮
    private function swim($i){
        if($i<1){
            return;
        }
        //根节点位置
        $k = (int)(ceil($i/2))-1;
        if($this->arr[$i] > $this->arr[$k]){
            $this->swap($i,$k);
            $this->swim($k);
        }
    }
    public function toArray(){
        while($this->count){
            $this->swap(0,--$this->count);
            $this->createHeap(0);
        }
    }
}
$heap = new Heap([10,6,5,1,12,9]);
$heap->run();
$heap->insert(22);
$heap->insert(8);
$heap->insert(100);
var_dump($heap->arr);