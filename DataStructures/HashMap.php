<?php
/*
	散列表解决碰撞:
	1.拉链法
	2.线性探测法
	整数散列:
		除留取余法，选择大小为素数M的数组，对于任意正整数K，计算K以M的余数
	浮点散列:
		将浮点表示为二进制然后再使用除留取余法
	字符串散列:
		
*/
class HashMap{
	public $hsize;
	public $buckets;
	public function __construct($hsize){
		$this->buckets = [];
		for($i=0;$i<$hsize;$i++){
			$this->buckets[$i] = new LinkedList();
		}
		$this->hsize = $hsize;
	}
	public function hashing($key){
		$hash = $key%$this->hsize;
		if($hash<0){
			$hash+=$hsize;
		}
		return $hash;
	}
	public function insertHash($key){
		$hash = $this->hashing($key);
		$this->buckets[$hash]->insert($key);
	}
	public function deleteHash($key){
		$hash = $this->hashing($key);
		$this->buckets[$hash]->delete($key);
	}
	public function displayHashtable(){
		for($i=0;$i<$this->hsize;$i++){
			$res = $this->buckets[$i]->display();
			var_dump($res);
		}
	}
}
class LinkedList{
	public $head;
	public $size = 0;
	public function insert($data){
		$tmp = $this->head;
		$node = new Node($data);
		$this->size++;
		if($this->head == null){
			$this->head = $node;
		}else{
			$node->next = $this->head;
			$this->head = $node;
		}
	}
	public function delete($data){
		if($this->size == 0){
			return;
		}else{
			$current = $this->head;
			if($current->data == $data){
				$this->head = $current->next;
				$this->size--;
				return;
			}else{
				while($current->next->next!=null){
					if($current->next->data == $data){
						$current->next = $current->next->next;
						return;
					}
				}
			}
		}
	}
	public function display(){
		$res = "";
		$tmp = $this->head;
		while($tmp!=null){
			$res.="{$tmp->data}->";
			$tmp=$tmp->next;
		}
		$res = rtrim($res,"->");
		return $res;
	}
}
class Node{
	public $data;
	public $next;
	public function __construct($data){
		$this->data = $data;
	}
}
$obj = new HashMap(7);
$obj->insertHash(14);
$obj->insertHash(28);
$obj->insertHash(32);
$obj->insertHash(39);
$obj->deleteHash(39);
$obj->displayHashtable();