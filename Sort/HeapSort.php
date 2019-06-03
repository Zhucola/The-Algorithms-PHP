<?php
/*
堆的定义：
    每个元素都要保证大于另两个特点位置的元素，当一个二叉树的每个节点都大于等于子节点时，为有序堆，从任意节点向上，都能得到一列非递减元素，从任意节点向下都能得到一列非递增元素
    每个节点的值都大于或等于其左右孩子节点的值，成为大顶堆（大根堆）；或者每个节点的值都小于或等于其左右节点的值，成为小顶堆（小根堆）
    根节点是有序堆的最大节点
    如果根节点位置是0，位置k的节点的父节点位置是ceil(k/2)-1，子节点为2k+1、2k+2
    如果根节点位置是1，位置k的节点的父节点位置是floor(k/2)，子节点为2k、2k+1
    一个大小为N的完全二叉树的高度是lgN，当N达到2的幂时，高度+1(二叉树不能这么算)
        8(位置1)
    5(位置2)      6(位置3)
3(位置4)   4(位置5)
*/
class HeapSort1{
    const ORDER_ASC = 0;
    const ORDER_DESC = 1;
    public $arr;
    public $count;
    private $order;
    private $find;
    public function __construct(Array $arr,$find,$order){
        if($find < 1){
            throw new Exception("$find is can't < 1");
        }
        //根位置是0，不是1
        $this->arr = $arr;
        $this->order = $order;
        $this->find = $find;
        $this->count = count($arr);
    }
    public function run(){
        $this->createHeap();
        if($this->find == 1){
            return (array)$this->arr[0];
        }
        $t = $this->find;
        while($this->count && $t--){
            $this->swap(0,--$this->count);
            $this->buildHeap(0,$this->count);
        }
        return array_slice($this->arr,$this->count,$this->find);
    }
    private function createHeap(){
        $i = (int)(floor($this->count)/2);
        while($i--){
            $this->buildHeap($i,$this->count);
        }
    }
    private function buildHeap($i,$count){
        if($i>=$count){
            return;
        }
        //根位置是0，不是1
        $left = 2*$i+1;
        $right = $left+1;
        $max = $i;
        if($left < $count && $this->less($left,$max)){
            $max = $left;
        }
        if($right < $count && $this->less($right,$max)){
            $max = $right;
        }
        if($max != $i && $max<$count){
            $this->swap($max,$i);
            $this->buildHeap($max,$count);
        }

    }
    private function less($i,$j){
        if($this->order == self::ORDER_ASC){
            return $this->arr[$i] > $this->arr[$j];
        }else{
            return $this->arr[$i] < $this->arr[$j];
        }
    }
    private function swap($i,$j){
        $tmp = $this->arr[$i];
        $this->arr[$i] = $this->arr[$j];
        $this->arr[$j] = $tmp;
    }
}
class HeapSort2{
    public $arr;
    private $count;
    public function __construct(Array $arr){
        $this->arr = $arr;
        $this->count = count($arr);
    }
    public function run(){
        $i = (int)(floor($this->count)/2);
        while($i--){
            $this->buildHeap($i,$this->count);
        }
        while($this->count){
            $this->swap(0,--$this->count);
            $this->buildHeap(0,$this->count);
        }
    }
    private function buildHeap($i,$count){
        if($i>=$count){
            return;
        }
        //根位置是0，不是1
        $left = 2*$i+1;
        $right = $left+1;
        $max = $i;
        if($left < $count && $this->less($left,$max)){
            $max = $left;
        }
        if($right < $count && $this->less($right,$max)){
            $max = $right;
        }
        if($max != $i && $max<$count){
            $this->swap($max,$i);
            $this->buildHeap($max,$count);
        }

    }
    private function less($i,$j){
        return $this->arr[$i] > $this->arr[$j];
    }
    private function swap($i,$j){
        $tmp = $this->arr[$i];
        $this->arr[$i] = $this->arr[$j];
        $this->arr[$j] = $tmp;
    }
}
//测试堆排序找最大或者最小的前几个
$tmp = [];
for($i=0;$i<100;$i++){
    $tmp[] = $i;
}
//查找最小的前10个
$obj = new HeapSort1($tmp,10,HeapSort1::ORDER_DESC);
$res = $obj->run();
var_dump($res);
//查找最大的前3个
$obj = new HeapSort1($tmp,3,HeapSort1::ORDER_ASC);
$res = $obj->run();
var_dump($res);


//测试堆排序
$tmp = [];
for($i=0;$i<1000;$i++){
    $tmp[] = mt_rand(-100000,100000);
}
$obj = new HeapSort2($tmp);
$obj->run();
var_dump($obj->arr);