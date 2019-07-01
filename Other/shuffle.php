<?php
function myShuffle(Array $arr){
	$count = count($arr);
	for($i=0;$i<$count;$count--){
		$key = mt_rand(0,$count-1);
		$flag = $arr[$key];
		$tmp = $arr[$count-1];
		$arr[$count-1] = $flag;
		$arr[$key] = $tmp;
	}
	return $arr;
}
$tmp = [1,2,3,4,5];
$obj = myShuffle($tmp);
var_dump($obj);