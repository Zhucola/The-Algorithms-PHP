<?php
/*
	基于线性探测的符号表
	使用大小为M的数组保存N个键值对，其中M>N，需要依靠数组中的空位解决hash冲突
	开放地址最简单的方法叫做线性探测法:当碰撞发生时候，直接检查散列表中下一个位置(将索引值+1)
		1.命中，该位置的键和被查找的键相同
		2.未命中，键为空
		3.继续查找，该位置的键和被查找的键不同
	在继续查找的过程中，如果到底数组结尾时候这回数组的开头，知道找到该键或者遇到一个空元素
*/
class hashTableLinear{
	public $size;
	public $buckets;
	public $keys;
	public $vals;
	public $used = 0;

	public function __construct($size = 7){
		$this->keys = new SplFixedArray($size);
		$this->vals = new SplFixedArray($size);
		$this->size = $size;
	}

	public function hashing($key){
		return 1;
		$hash = crc32($key)%$this->size;
		if($hash<0){//注意不能为负，因为SplFixedArray不能插入负
			return $hash+$this->size;
		}
		return $hash;
	}

	public function insertHash($key,$val){
		$start = $hash = $this->hashing($key);
		$loop = false;//是否已经走了一圈了
		do{
			if($this->keys[$hash] == $key){
				$this->vals[$hash] = $val;
				return true;
			}
			if($loop){//已经走了一圈了，但是还没找到可用的空位置
				return false;
			}
			$hash=($hash+1)%$this->size;
			if($hash == $start){
				$loop = true;//已经走了一圈了
			}
		}while($this->keys[$hash]!=null);
		$this->keys[$hash] = $key;
		$this->vals[$hash] = $val;
		$this->used++;
	}

	public function findHash($key){
		$start = $hash = $this->hashing($key);
		$loop = false;//是否已经走了一圈了
		do{
			if($this->keys[$hash] == $key){
				return $this->vals[$hash];
			}
			if($loop){//已经走了一圈了，但是还没找到
				return false;
			}
			$hash=($hash+1)%$this->size;
			if($hash == $start){
				$loop = true;//已经走了一圈了
			}
		}while($this->keys[$hash]!=null);
		return false;
	}
}
$obj = new hashTableLinear();
$obj->insertHash("a",1);
$obj->insertHash("b",2);
$obj->insertHash("c",3);
$obj->insertHash("d",4);
$obj->insertHash("e",5);
$obj->insertHash("f",6);
$obj->insertHash("g",7);
$obj->insertHash("h",8);
var_dump($obj->findHash("ga"));
var_dump($obj->keys);