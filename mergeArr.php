<?php
/*
 |--------------------------------
 | 合并两个有序数组
 |--------------------------------
*/
function mergeArr1(array $a,array $b){
	$temp = [];
	$x = 0;
	$y = 0;
	$count_a = count($a);
	$count_b = count($b);
	while($x<$count_a && $y <$count_b){
		if($a[$x] < $b[$y]){
			$temp[] = $a[$x++];
		}else{
			$temp[] = $b[$y++];
		}
	}
	while($x < $count_a){
		$temp[] = $a[$x++];
	}
	while($y < $count_b){
		$temp[] = $b[$y++];
	}
	return $temp;
}
$a = [1,3,5,9,10];
$b = [2,7,11,24,67,111,222];
$res = mergeArr1($a,$b);
var_dump($res);