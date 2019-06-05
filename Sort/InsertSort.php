<?php
include("./Base.php");
/*
 * 插入排序
 * 对于部分段有序的部分，不需要进行比较,每次循环数组左面是有序的
 * 时间复杂度
 *  最坏O(n^2)  最好O(n)
 */
class InsertSort extends Base{
    public function sort(){
        for($i=1;$i<$this->count;$i++){
            $j = $i - 1;
            $tmp = $this->arr[$i];
            while($j>=0&&$this->less($this->arr[$j],$tmp)){
                $this->arr[$j+1] = $this->arr[$j];
                $j--;
            }
            $this->arr[$j+1] = $tmp;
        }
    }
}
function InsertSortFunc(array $arr){
    $len = count($arr);
    for($i=1;$i<$len;$i++){
        $temp = $arr[$i];
        $j = $i - 1;
        while($j>=0&&$arr[$j]>$temp){
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        $arr[$j+1] = $temp;
    }
    return $arr;
}
$sort = new InsertSort(1000);
$arr = $sort->arr;
$sort->sort();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);