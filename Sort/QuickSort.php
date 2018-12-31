<?php
/*
 |-----------------------------------
 | 快速排序
 | 最好O(n log n) 最坏 O(n^2)
 |-----------------------------------
 | 以[1,4,3,2]为例子:
 | $flag           $left           $right
 |   1             []                [4,3,2]
 |   4             [3,2]             []
 |   3             [2]               []
 | 然后生成:
 | [2,3]
 | [2,3,4]
 | [1,2,3,4]
 |-----------------------------------
 | 以[10,6,4,2,3,1,7,11,22]为例子:
 | $flag           $left           $right
 |   10            [6,4,2,3,1]     [11,22]
 |   6             [4,2,3,1]         []
 |   4             [2,3,1]           []
 |   2              [1]              [3]
 |   11              []              [22]
 | 然后生成:
 | [11,22]
 | [1,2,3]
 | [1,2,3,4]
 | [1,2,3,4,6]
 | [1,2,3,4,6,11,22]
*/
function QuickSort(array $arr){
	if(count($arr)<=1){
		return $arr;
	}
	$flag = $arr[0];
	$left = $right = [];
	for($i=1;$i<count($arr);$i++){ //注意$i=1而不是0
		if($flag < $arr[$i]){
			$right[] = $arr[$i];
		}else{
			$left[] = $arr[$i];
		}
	}
	$left = QuickSort($left);
	$right = QuickSort($right);
	return array_merge($left,[$arr[0]],$right);
}
$temp = [];
for($i=0;$i<1000;$i++){
	$temp[] = mt_rand(0,1000);
}
$count = count($temp) + 1;
ini_set("xdebug.max_nesting_level",$count);
var_dump(QuickSort($temp));
ini_set("xdebug.max_nesting_level",256);