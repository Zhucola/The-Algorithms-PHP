<?php
class Base{
	CONST MAX_INT = 100000;
	public $count;
	public $arr = [];
	public $start_time;
	public function __construct($count){
		set_time_limit(60);
		$this->count = $count;
		$this->createArr();
		$this->start_time = microtime(true);
	}
	public function createArr(){
		for($i=0;$i<$this->count;$i++){
			$this->arr[] = mt_rand(-self::MAX_INT,self::MAX_INT);
		}
	}
	public function elapsedTime(){
		echo number_format(microtime(true) - $this->start_time,4);
	}

	public function swap($first,$second){
		$tmp = $this->arr[$first];
		$this->arr[$first] = $this->arr[$second];
		$this->arr[$second] = $tmp;
	}
	public function less($first,$second){
		if($first>$second){
			return true;
		}
		return false;
	}
	public function check(){
		for($i=0;$i<$this->count-1;$i++){
			if($this->arr[$i] > $this->arr[$i+1]){
				return false;
			}
		}
		return true;
	}
}