<?php
include("./Base.php");
/*
 * 选择排序
 * 对于部分段有序的部分，还是要进行比较，数组交换次数比冒泡排序要少，每次循环只要交换一次就可以
 * 时间复杂度:
 *   O(n^2)
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

function SelectSortFunc1(Array $arr){
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
			$arr[$min] = $arr[$i];
			$arr[$i] = $tmp;
		}
	}
	return $arr;
}
function SelectSortFunc2(Array $arr){
	$count = count($arr);
	for($left=0,$right=$count-1;$left<$right;$left++,$right--){
		$min = $left;
		$max = $right;
		for($i=$left;$i<=$right;$i++){
			if($arr[$i] < $arr[$min]){
				$min = $i;
			}elseif($arr[$i] > $arr[$max]){
				$max = $i;
			}
		}
		if($min != $left){	
			$tmp = $arr[$min];
			$arr[$min] = $arr[$left];
			$arr[$left] = $tmp;
		}	
		if($max == $left){//因为$arr[$left]值已经改变了
			$max = $min;
		}
		if($max != $right){
			$tmp = $arr[$max];
			$arr[$max] = $arr[$right];
			$arr[$right] = $tmp;
		}
	}
	return $arr;
}
$sort = new SelectSort(10000);
$sort->sort();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
