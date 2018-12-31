<?php
function InsertSort(array $arr){
    $len = count($arr);
    for($i=1;$i<$len;$i++){
        $temp = $arr[$i];
        $j = $i - 1;
        while($j>=0&&$arr[$j]>$temp){
            $arr[$j+1] = $arr[$j];
            $j--;
        }
        if($i != $j+1) 
            $arr[$j+1] = $temp;
    }
    return $arr;
}
$temp = [];
for($i=0;$i<1000;$i++){
    $temp[] = mt_rand(0,10000);
}
$count = count($temp) + 1;
ini_set("xdebug.max_nesting_level",$count);
var_dump(InsertSort($temp));
ini_set("xdebug.max_nesting_level",256);