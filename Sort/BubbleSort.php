<?php
include("./Base.php");
/*
 * 冒泡排序
 * 每次循环都推选出数组最大的值，数组的右侧是有序的
 * 对于部分段有序的部分，还是要进行比较，并且数组交换次数较多
 *
 */
class BubbleSort extends Base{
	public function sort1(){
		for($i=0;$i<$this->count-1;$i++){
			for($j=0;$j<$this->count-$i-1;$j++){
				if($this->less($this->arr[$j],$this->arr[$j+1])){
					$this->swap($j,$j+1);
				}
			}
		}
	}
	//对冒泡排序的优化
	public function sort2(){
		$count = $this->count;
		do{
			$swap = false;
			for($i=0;$i<$count - 1;$i++){
				if($this->less($this->arr[$i],$this->arr[$i+1])){
					$this->swap($i,$i+1);
					$swap = true;
				}
			}
			$count--;
		}while($swap);
	}
}
function BubbleSortFunc1(Array $arr){
	$count = count($arr);
	for($i=0;$i<$count-1;$i++){
		//冒泡在数组部分有序的情况下，还是要循环多次
		for($j=0;$j<$count-$i-1;$j++){
			//冒泡对数组的交换次数比较多
			if($arr[$j] > $arr[$j+1]){
				$tmp = $arr[$j];
				$arr[$j] = $arr[$j+1];
				$arr[$j+1] = $tmp;
			}
		}
	}
	return $arr;
}
//对冒泡排序的优化，如果一次循环发现数组已经有序则不需要再次循环，直接返回
function BubbleSortFunc2(Array $arr){
	$count = count($arr);
	do{
		$swap = false;
		for($i=0;$i<$count - 1;$i++){
			if($arr[$i] > $arr[$i+1]){
				$tmp = $arr[$i];
				$arr[$i] = $arr[$i+1];
				$arr[$i+1] = $tmp;
				$swap = true;
			}
		}
		$count--;
	}while($swap);
	return $arr;
}
//test1
$sort = new BubbleSort(10);
$arr = $sort->arr;
$sort->sort1();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
//test2
$sort = new BubbleSort(10);
$sort->sort2();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
//test3
$res = BubbleSortFunc1($arr);
var_dump($res);
//test4
$res = BubbleSortFunc2($arr);
var_dump($res);

