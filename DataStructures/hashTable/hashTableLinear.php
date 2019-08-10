<?php
/*
	基于线性探测的符号表
	使用大小为M的数组保存N个键值对，其中M>N，需要依靠数组中的空位解决hash冲突
	开放地址最简单的方法叫做线性探测法:当碰撞发生时候，直接检查散列表中下一个位置(将索引值+1)
		1.命中，该位置的键和被查找的键相同
		2.未命中，键为空
		3.继续查找，该位置的键和被查找的键不同
	在继续查找的过程中，如果到底数组结尾时候这回数组的开头，直到找到该键或者遇到一个空元素
*/
class hashTableLinear{
	public $size;
	public $keys;
	public $vals;
	public $used = 0;

	public function __construct($size = 4){
		$this->keys = new SplFixedArray($size);
		$this->vals = new SplFixedArray($size);
		$this->size = $size;
	}

	public function hashing($key){
		$hash = crc32($key)%$this->size;
		if($hash<0){//注意不能为负，因为SplFixedArray不能插入负
			return $hash+$this->size;
		}
		return $hash;
	}

	public function insertHash($key,$val){
		if($this->getLoadFactor()>=1){
			$this->resize(2*$this->size);
		}
		$start = $hash = $this->hashing($key);
		do{
			if($this->keys[$hash] === $key){
				$this->vals[$hash] = $val;
				return true;
			}
			$hash=($hash+1)%$this->size;
		}while($this->keys[$hash]!=null);
		$this->keys[$hash] = $key;
		$this->vals[$hash] = $val;
		$this->used++;
	}
	public function findHash($key){
		$start = $hash = $this->hashing($key);
		$loop = false;//是否已经走了一圈了
		do{
			if($this->keys[$hash] === $key){ //防止 0==null为true
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

	//直接将该键所在位置设置为null是不行的，因为会是的在此位置之后的元素无法被查找到
	public function deleteHash($key){
		if($this->getLoadFactor()>0 && $this->getLoadFactor()<=0.5){
			$this->resize($this->size/2);
		}
		$start = $hash = $this->hashing($key);
		while($this->keys[$hash]!==$key){
			$hash = ($hash+1)%$this->size;
			if($hash == $start){
				return false;  //防止死循环
			}
		}
		$this->keys[$hash] = null;
		$this->vals[$hash] = null;
		$hash = ($hash+1)%$this->size;
		while($this->keys[$hash]!==null){
			$key = $this->keys[$hash];
			$val = $this->vals[$hash];
			$this->keys[$hash] = null;
			$this->vals[$hash] = null;
			$this->used--;
			$this->insertHash($key,$val);
			$hash = ($hash+1)%$this->size;
		}
		$this->used--;
	}

	//获取负载因子
    public function getLoadFactor(){
        return number_format($this->used/$this->size,2);
    }

    public function resize($size){
    	$new_hashTableLinear = new hashTableLinear($size);
    	for($i=0;$i<$this->size;$i++){
    		if($this->keys[$i] != null){
    			$new_hashTableLinear->insertHash($this->keys[$i],$this->vals[$i]);
    		}
    	}
    	$this->size = $size;
    	$this->used = $new_hashTableLinear->used;
    	$this->keys = $new_hashTableLinear->keys;
    	$this->vals = $new_hashTableLinear->vals;
    }
}
$obj = new hashTableLinear();
$obj->insertHash(8,1);
$obj->insertHash(4,2);
$obj->insertHash(0,0);
$obj->insertHash(3,3);
$obj->deleteHash(4);
$obj->deleteHash(3);
$obj->deleteHash(0);
$obj->insertHash(3,3);
$obj->insertHash(7,7);
var_dump($obj->used);
var_dump($obj->keys);