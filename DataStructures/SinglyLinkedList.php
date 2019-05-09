<?php
class SinglyLinkedList{
	public $head;
	public $count = 0;
	public function insertHead($data){
		$node = new Node($data);
		$node->next = $this->head;
		$this->head = $node;
		$this->count++;
	}
	public function deleteHead(){
		if($this->isEmpty()){
			return false;
		}	
		$this->head = $this->head->next;
		$this->count--;
		return true;
	}
	public function isEmpty(){
		return $this->count == 0;
	}
	public function __toString(){
		$res = "";
		$node = $this->head;
		while($node != null){
			$res .= $node->data . "->";
			$node = $node->next;
		}
		$res = rtrim($res,"->");
		return $res;
	}
	public function insertNth($data,$position){
		if($position < 0 || $position > $this->count){
			throw new Exception("position less than zero or position more than the count of list");
		}elseif($position == 0){
			$this->insertHead($data);
		}else{
			$tmp = new Node($data);
			$node = $this->head;
			for($i=0;$i<$position-1;$i++){
				$node = $node->next;
			}
			$tmp->next = $node->next;
			$node->next = $tmp;
		}
		$this->count++;
	}
}
class Node{
	public $data;
	public $next;
	public function __construct($data){
		$this->data = $data;
	}
}
$s = new SinglyLinkedList();
$s->insertHead(1);
$s->insertHead(2);
$s->insertHead(3);
$s->insertHead(4);
$s->insertNth(55,2);
echo $s;