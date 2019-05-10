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
			}
		}
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
$s->insertHead(1);
$s->insertHead(2);
$s->delete(2);
$s->insertTail(5);
$s->insertTail(88);
$s->insertOrder(200);
$s->insertOrder(6);
echo $s;