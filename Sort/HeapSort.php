<?php
/*
堆的定义：
    每个元素都要保证大于另两个特点位置的元素，当一个二叉树的每个节点都大于等于子节点时，为有序堆，从任意节点向上，都能得到一列非递减元素，从任意节点向下都能得到一列非递增元素
    每个节点的值都大于或等于其左右孩子节点的值，成为大顶堆（大根堆）；或者每个节点的值都小于或等于其左右节点的值，成为小顶堆（小根堆）
    根节点是有序堆的最大节点
    如果根节点位置是0，位置k的节点的父节点位置是ceil(k/2)-1，子节点为2k+1、2k+2
    一个大小为N的完全二叉树的高度是lgN，当N达到2的幂时，高度+1
        8(位置1)
    5(位置2)      6(位置3)
3(位置4)   4(位置5)
*/
class Heap{
    public $arr;
    public $count;
    public function __construct(Array $arr){
        $this->arr = $arr;
        $this->count = count($arr);
    }
    public function run(){
        $this->createHeap();
        while($this->count){
            $this->swap(0,--$this->count);
            $this->buildHeap(0,$this->count);
        }
        return $this->arr;
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
$tmp = [6,1,3,2,7,8,9,10];
$obj = new Heap($tmp);
$res = $obj->run();
var_dump($res);