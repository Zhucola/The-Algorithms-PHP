<?php
include("./Base.php");
/*
 * 冒泡排序
 * 对于部分段有序的部分，还是要进行比较，并且数组交换次数较多
 *
 */
class BubbleSort extends Base{
	public function sort(){
		for($i=0;$i<$this->count-1;$i++){
			for($j=0;$j<$this->count-$i-1;$j++){
				if($this->less($this->arr[$j],$this->arr[$j+1])){
					$this->swap($j,$j+1);
				}
			}
		}
	}
}
function BubbleSortFunc(Array $arr){
	$count = count($arr);
	for($i=0;$i<$count-1;$i++){
		for($j=0;$j<$count-$i-1;$j++){
			if($arr[$j] > $arr[$j+1]){
				$tmp = $arr[$j];
				$arr[$j] = $arr[$j+1];
				$arr[$j+1] = $tmp;
			}
		}
	}
	return $arr;
}
$sort = new BubbleSort(10);
$arr = $sort->arr;
$sort->sort();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
$res = BubbleSortFunc($arr);
var_dump($res);
