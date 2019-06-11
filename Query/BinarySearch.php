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
//给定一个升序排列的自然数数组，数组中包含重复数字，例如：[1,2,2,3,4,4,4,5,6,7,7]。问题：给定任意自然数，对数组进行二分查找，返回数组正确的位置，给出函数实现。注：连续相同的数字，返回第一个匹配位置还是最后一个匹配位置，由函数传入参数决定
//比较相等(相等用0表示，大于为1，小于为-1)，但是flag = 1，则返回纠正后的比较结果为1，需要移动二分查找的high到mid，继续二分(反之，若flag = 0，则返回纠正后的结果为-1，需要移动二分查找的low到mid，继续二分)
$tmp = [];
for($i=0;$i<100000;$i++){
	$tmp[] = $i;
}
$index = mt_rand(0,100000);
$start = microtime(true);
$res = search1($tmp,$index);
echo microtime(true) - $start;
