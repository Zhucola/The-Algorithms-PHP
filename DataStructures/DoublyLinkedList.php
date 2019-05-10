<?php
class DoublyLinkedList{
	public $head;
	public $tail;
	public $count = 0;
	public function insertHead($data){
		$node = new Node($data);
		if($this->isEmpty()){
			$this->tail = $node;
		}else{
			$this->head->previous = $node;
		}
		$node->next = $this->head;
		$this->head = $node;
		$this->count++;
	}
	public function insertTail($data){
		$node = new Node($data);
		if($this->isEmpty()){
			$this->head = $node;
		}else{
			$this->tail->next = $node;
		}
		$node->previous = $this->tail;
		$this->tail = $node;
		$this->count++;
	}
	public function insertOrder($data){
		if(!$this->isEmpty()){
			$tmp = $this->head;
			while($tmp != null && ($data > $tmp->data)){
				$tmp = $tmp->next;
			}
			if($tmp == $this->head){
				$this->insertHead($data);
			}elseif($tmp == null){
				$this->insertTail($data);
			}else{
				$node = new Node($data);
				$previous_tmp = $tmp->previous;
				$previous_tmp->next = $node;
				$node->next = $tmp;
				$node->previous = $previous_tmp;
				$this->count++;
			}
		}else{
			$this->insertHead($data);
		}
	}
	public function deleteHead(){
		if(!$this->isEmpty()){
			$tmp = $this->head->next;
			if($tmp == null){
				$this->tail = null;
			}else{
				$tmp->previous = null;
			}
			$this->head = $tmp;
			$this->count--;
		}
	}
	public function deleteTail(){
		if(!$this->isEmpty()){
			$tmp = $this->tail->previous;
			if($tmp == null){
				$this->head = null;
			}else{
				$tmp->next = null;
			}
			$this->tail = $tmp;
			$this->count--;
		}
	}
	public function delete($data){
		if(!$this->isEmpty()){
			$tmp = $this->head;
			while($tmp->data != $data){
				$tmp = $tmp->next;
			}
			if($tmp->previous == null){
				$this->deleteHead();
			}elseif($tmp->next == null){
				$this->deleteTail();
			}else{
				$previous = $tmp->previous;
				$next = $tmp->next;
				$previous->next = $next;
				$next->previous = $previous;
				$this->count--;
			}
		}
	}
	public function __toString(){
		$head = $this->head;
		$tail = $this->tail;
		$head_arr = [];
		$tail_arr = [];
		for($i=0;$i<floor(($this->count/2));$i++){
			$head_arr[] = $head->data;
			array_unshift($tail_arr, $tail->data);
			$head = $head->next;
			$tail = $tail->previous;
		}
		if($this->count % 2 != 0){
			$head_arr[] = $head->data;
		}
		$res = array_merge($head_arr,$tail_arr);
		$res = implode($res, "->");
		return $res;
	}
	public function isEmpty(){
		return $this->head == null;
	}
}
class Node{
	public $next = null;
	public $previous = null;
	public $data;
	public function __construct($data){
		$this->data = $data;
	}
}
$s = new DoublyLinkedList();
$s->insertHead(0);
$s->insertHead(2);
$s->insertHead(1);
$s->insertTail(3);
$s->insertTail(4);
$s->insertTail(5);
$s->insertTail(6);
//$s->insertTail(4);
//$s->reverse();
echo $s;