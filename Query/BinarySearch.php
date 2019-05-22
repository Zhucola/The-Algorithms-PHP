<?php
//二分查找
function search(Array $arr,$index){
	$right = count($arr);
	$left = 0;
	while($left<=$right){
		$center = (int)(floor($left+$right)/2);
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
$tmp = [];
for($i=0;$i<100000;$i++){
	$tmp[] = $i;
}
$index = mt_rand(0,100000);
$start = microtime(true);
$res = search($tmp,$index);
echo microtime(true) - $start;
