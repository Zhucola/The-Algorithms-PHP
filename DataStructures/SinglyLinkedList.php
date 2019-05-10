<?php
class SinglyLinkedList{
	public $head;
	public $count = 0;
	public function insertHead($data): void{
		$node = new Node($data);
		$node->next = $this->head;
		$this->head = $node;
		$this->count++;
	}
	public function deleteHead(): boolean{
		if($this->isEmpty()){
			return false;
		}	
		$this->head = $this->head->next;
		$this->count--;
		return true;
	}
	public function isEmpty(): boolean{
		return $this->count == 0;
	}
	public function __toString(): string{
		$res = "";
		$node = $this->head;
		while($node != null){
			$res .= $node->data . "->";
			$node = $node->next;
		}
		$res = rtrim($res,"->");
		return $res;
	}
	public function insertNth($data,$position): boolean{
		if($position < 0 || $position > $this->count){
			return false;
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
		return true;
	}
	public function reverse(){
		$head = $this->head;
		$tmp = null;
		$res = null;
		while($head != null){
			$tmp = $head->next;
			$head->next = $res; 
			$res = $head;
			$head = $tmp;
		}
		$this->head = $res;
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
$s->insertHead(77);
$s->insertHead(2);
$s->insertHead(3);
$s->insertHead(88);
echo $s;
$s->reverse();
echo "</br>";
echo $s;
