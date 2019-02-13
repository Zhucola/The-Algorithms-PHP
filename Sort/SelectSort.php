<?php
function SelectSort(Array $arr){
	for($i=0,$k=$i,$len=count($arr);$i<$len;$i++){
		for($j=$i+1;$j<$len;$j++){
			if($arr[$j] < $arr[$k]){
				$k = $j;
			}
		}
		if($k!=$i){
			$temp = $arr[$i];
			$arr[$i] = $arr[$k];
			$arr[$k] = $temp;
		}
	}
	return $arr;
}