<?php
/*
 |-----------------------------------
 | 快速排序
 | 最好O(n log n) 最坏 O(n^2)
 | 最差情况是递归已经排序好的数组，可以每次选取随机键来排序
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
function QuickSort1(array $arr){
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
	$left = QuickSort1($left);
	$right = QuickSort1($right);
	return array_merge($left,[$arr[0]],$right);
}
function QuickSort2(array $arr){
	if(count($arr)<=1){
		return $arr;
	}
	$index = mt_rand(0,count($arr) - 1);
	$flag = $arr[$index];
	$left = $right = [];
	for($i=0;$i<count($arr);$i++){ 
		if($i==$index){
			continue;
		}
		if($flag < $arr[$i]){
			$right[] = $arr[$i];
		}else{
			$left[] = $arr[$i];
		}
	}
	$left = QuickSort2($left);
	$right = QuickSort2($right);
	return array_merge($left,[$arr[0]],$right);
}
function quickSort3($arr){
    $count = count($arr);
    if($count <= 1){
        return $arr;
    }elseif($count <= 7){
    	//小的数组插入排序比快排性能更好
        for($i=1;$i<$count;$i++){
            $j=$i-1;
            $tmp = $arr[$i];
            while($j>=0 && ($arr[$j]>$tmp)){
                $arr[$j+1] = $arr[$j];
                $j--;
            }
            $arr[$j+1] = $tmp;
        }
        return $arr;
    }
    $flag = $arr[0];
    $left = $right = [];
    for($i=1;$i<$count;$i++){
        if($arr[$i]<$flag){
            $left[] = $arr[$i];
        }else{
            $right[] = $arr[$i];
        }
    }
    $left = quickSort3($left);
    $right = quickSort3($right);
    return array_merge($left,(array)$flag,$right);
}
$temp = [];
for($i=0;$i<1000;$i++){
	$temp[] = mt_rand(0,1000);
}
$count = count($temp) + 1;
ini_set("xdebug.max_nesting_level",$count);
var_dump(QuickSort1($temp));
ini_set("xdebug.max_nesting_level",256);