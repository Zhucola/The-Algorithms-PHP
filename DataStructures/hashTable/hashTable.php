<?php
//简单的hashTable，不解决冲突
include("./BaseObj.php");
class HashTable implements BaseObj,ArrayAccess{
	public $size;
	public $buckets; //槽
    public $used = 0; //已经使用的节点
    private $load_factor;//负载因子
	public function __construct($size = 33){
		$this->size = $size;
		//SplFixedArray是一个不会根据key做hash的数组
		$this->buckets = new SplFixedArray($this->size);
	}

	//生成hash码
	public function hashing($key){
		$hash = crc32($key)%$this->size;
		if($hash<0){//注意不能为负，因为SplFixedArray不能插入负
			return $hash+$this->size;
		}
		return $hash;
	}

	//添加
	public function insertHash($key, $value){
        $index = $this->hashing($key);
        if(!isset($this->buckets[$index])){
            $this->used++;
        }
        $this->buckets[$index] = $value;
        return true;
    }

    public function findHash($key){
        $index = $this->hashing($key);
        if(isset($this->buckets[$index])){
            return $this->buckets[$index];
        }
        return NULL;
    }

    public function deleteHash($key){
    	$index = $this->hashing($key);
        if(isset($this->buckets[$index])){
            $this->used--;
            unset($this->buckets[$index]);
            return true;
        }
        return false;
    }

    public function displayHashtable(){
		return (array)$this->buckets;
	}

    public function issetHash($key){
    	$index = $this->hashing($key);
        if(isset($this->buckets[$index])){
            return true;
        }
        return false;
    }

    //获取负载因子
    public function getLoadFactor(){
        return number_format($this->used/$this->size,2);
    }

    public function offsetExists($key){
    	return $this->issetHash($key);
    }

    public function offsetGet($key){
    	return $this->findHash($key);
    }

    public function offsetSet($key,$val){
    	$this->insertHash($key,$val);
    }

    public function offsetUnset($key){
    	return $this->deleteHash($key);
    }
}
$obj = new HashTable();
$obj["a"] = "a";
$obj["b"] = "b";
$obj[1] = 1;
$obj[1.9] = 1.9;
unset($obj["a"]);
var_dump($obj["a"]);
$res = $obj->displayHashtable();
var_dump($res);
var_dump($obj->getLoadFactor());