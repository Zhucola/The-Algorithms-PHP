<?php
include("./Base.php");
/*
 * 选择排序
 * 对于部分段有序的部分，还是要进行比较，数组交换次数比冒泡排序要少，每次循环只要交换一次就可以
 *
 */
class SelectSort extends Base{
	public function sort(){
		for($i=0;$i<$this->count-1;$i++){
			$min = $i;
			for($j=$i+1;$j<$this->count;$j++){
				if($this->less($this->arr[$min],$this->arr[$j])){
					$min = $j;
				}
			}
			if($min != $i){
				$this->swap($i,$min);
			}
		}
	}
}

function SelectSortFunc(Array $arr){
	$count = count($arr);
	for($i=0;$i<$count-1;$i++){
		$min = $i;
		for($j=$i+1;$j<$count;$j++){
			if($arr[$min]>$arr[$j]){
				$min = $j;
			}
		}
		if($min != $i){
			$tmp = $arr[$min];
			$arr[$i] = $arr[$min];
			$arr[$min] = $tmp;
		}
	}
}

$sort = new SelectSort(10000);
$sort->sort();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
