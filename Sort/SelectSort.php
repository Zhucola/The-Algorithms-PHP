<?php
include("./Base.php");
class SelectSort extends Base{
	public function sort(){
		for($i=0;$i<$this->count-1;$i++){
			$min = $i;
			for($j=$i+1;$j<$this->count;$j++){
				if($this->less($this->arr[$min],$this->arr[$j])){
					$min = $j;
				}
			}
			if($min != $i){
				$this->swap($i,$min);
			}
		}
	}
}

function SelectSortFunc(Array $arr){
	$count = count($arr);
	for($i=0;$i<$count-1;$i++){
		$min = $i;
		for($j=$i+1;$j<$count;$j++){
			if($arr[$min]>$arr[$j]){
				$min = $j;
			}
		}
		if($min != $i){
			$tmp = $arr[$min];
			$arr[$i] = $arr[$min];
			$arr[$min] = $tmp;
		}
	}
}

$sort = new SelectSort(10000);
$sort->sort();
$sort->elapsedTime();
var_dump($sort->check());
var_dump($sort->arr);
