<?php
/*
 |-------------------------------------
 | 返回数组顺序相反的数组
 |-------------------------------------
*/
function reverseArr(array $arr){
	$len = count($arr);
	for($x=0,$y=$len-1;$x<$len/2;$x++,$y--){
		$temp = $arr[$y];
		$arr[$y] = $arr[$x];
		$arr[$x] = $temp;
	}
	return $arr;
}
$arr = [1,2,3,4,5];
$res = reverseArr($arr);
var_dump($res);