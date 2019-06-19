<?php
//二分查找
//递归调用存在着压栈/出栈的开销，其效率是比较低下的
//二分查找
//递归调用存在着压栈/出栈的开销，其效率是比较低下的
function search1(Array $arr,$index){
	$right = count($arr);
	$left = 0;
	while($left<=$right){
		$center = (int)(floor($left+$right)/2); //会有$center溢出风险
		if(!isset($arr[$center])){
			return null;
		}
		if($arr[$center]>$index){
			$right = $center - 1;
		}elseif($arr[$center]<$index){
			$left = $center + 1;
		}else{
			return $center;
		}
	}
}
function search2(Array $arr,$index){
	$right = count($arr);
	$left = 0;
	while($left<=$right){
		$center = (int)($left+floor($right-$left)/2); //不会有溢出风险
		if($arr[$center]>$index){
			$right = $center - 1;
		}elseif($arr[$center]<$index){
			$left = $center + 1;
		}else{
			return $center;
		}
	}
}
//给定一个升序数组，数组可以有重复元素，找到最左的元素下标
function search_find1(Array $arr,$index){
	$right = count($arr);
	$left = 0;
	while($left<=$right){
		$center = (int)(floor($right+$left)/2);
		if(!isset($arr[$center])){
			return null;
		}
		if($arr[$center] >= $index){ //降序的话就是<=
			$right = $center - 1;
		}else{
			$left = $center + 1;
		}
	}
	if($left < count($arr) && $arr[$left] == $index){
		return $left;
	}
	return null;
}
//给定一个升序数组，数组可以有重复元素，找到最右的元素下标(有bug，在[1,1]下找1会null)
function search_find2(Array $arr,$index){
	$right = count($arr);
	$left = 0;
	while($left<=$right){
		$center = (int)(floor($right+$left)/2);
		if(!isset($arr[$center])){
			return null;
		}
		if($arr[$center] <= $index){
			$left = $center + 1;
		}else{
			$right = $center - 1;
		}
	}
	if($right < count($arr) && $arr[$right] == $index){
		return $right;
	}
	return null;
}
//https://www.cnblogs.com/luoxn28/p/5767571.html
$tmp = [];
for($i=0;$i<100000;$i++){
	$tmp[] = $i;
}
$index = mt_rand(0,100000);
$start = microtime(true);
$res = search1($tmp,$index);
echo microtime(true) - $start;
