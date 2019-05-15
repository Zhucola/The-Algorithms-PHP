<?php
//数组中有出现了大于一般数组长度的值，求这个值
function search1(Array $arr){
	//有bug,如给定的数组是[1,2,1,2,1,2,1,2,2]
	$count = 0;
	$num = null;
	$res = null;
	for($i=1;$i<count($arr);$i++){
		if($num==null){
			$num = $arr[$i];
			$count++;
		}else{
			if($num != $arr[$i]){
				if($count == 0){
					$num = $arr[$i];
					$count = 1;
				}else{
					$count--;
				}
			}else{
				$count++;
			}
		}
	}
	return $num;
}
function search2(Array $arr){
	$count = count($arr);
	for($i=1;$i<$count;$i++){
		$tmp = $arr[$i];
		$j = $i-1;
		while($j>=0&&($arr[$j]>$tmp)){
			$arr[$j+1] = $arr[$j];
			$j--;
		}
		if($j != $i-1){
			$arr[$j+1] = $tmp;
		}
	}
	return $arr[($count/2)];
}
$arr = [];
$count = 1000;
$index = mt_rand(0,$count/2);
$data = mt_rand(-10000,10000);
for($i=0;$i<$count;$i++){
	if($i == $index){
		for($j=0;$j<501;$j++){
			$arr[] = $data;
		}
		$i = $j+$i-1;
	}else{
		$arr[] = mt_rand(-10000,10000);
	}
}
var_dump(search1($arr));
var_dump(search2($arr));