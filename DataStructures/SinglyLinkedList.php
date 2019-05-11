<?php
class SinglyLinkedList{
	public $head;
	public $count = 0;
	//向链表头添加元素
	public function insertHead($data): void{
		$node = new Node($data);
		$node->next = $this->head;
		$this->head = $node;
		$this->count++;
	}
	//向链表尾部添加新节点
	public function addNodeToTail(Node $node,$checkLoop = false){
		$current = $this->head;
		while($current->next != null){
			$current = $current->next;
		}
		$current->next = $node;
		if($checkLoop && $this->hasLoop()){
			$current->next = null;
		}else{
			// while($node != null){
			// 	$this->count++;
			// 	$node = $node->next;
			// }
		}
	}
	//删除链表头元素
	public function deleteHead(): bool{
		if($this->isEmpty()){
			return false;
		}	
		$this->head = $this->head->next;
		$this->count--;
		return true;
	}
	//判断链表是否为空
	public function isEmpty(): bool{
		return $this->count == 0;
	}
	//遍历链表
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
	//向链表中的指定位置插入元素
	public function insertNth($data,$position): bool{
		if($position < 0 || $position > $this->count){
			return false;
		}elseif($position == 0){
			$this->insertHead($data);
			return true;
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
	//删除链表中的指定位置
	public function deleteNth($position){
		if($position < 0 || $position > $this->count){
			return false;
		}elseif($position == 0){
			$this->deleteHead();
		}else{
			$current = $this->head;
			for($i=0;$i<$position-1;$i++){
				$current = $current->next;
			}
			$current->next = $current->next->next;
			$this->count--;
		}
	}
	//不知道节点总个数,找到单链表中间节点
	public function findMiddle(){
		$slow = $this->head;
		$fast = $this->head;
		if($fast == null){
			return false;
		}
		while($fast->next != null && $fast->next->next != null){
			$slow = $slow->next;
			$fast = $fast->next->next;
		}
		if($fast->next != null){
			return [
				$slow->data,
				$slow->next->data
			];
		}
		return (array)($slow->data);
	}
	//找到环的入口
	public function findLoopStart(){
		$hasLoop = false;
		$slow = $this->head;
		$fast = $this->head;
		if($fast == null){
			return false;
		}
		while($fast->next != null && $fast->next->next != null){
			$slow = $slow->next;
			$fast = $fast->next->next;
			if($slow == $fast){
				$hasLoop = true;
				break;
			}
		}
		if($hasLoop){
			$start = $this->head;
			while($start != $slow){
				$start = $start->next;
				$slow = $slow->next;
			}
			return $start;
		}else{
			return false;
		}
	}

	public function hasLoop(){
		$slow = $this->head;
		$fast = $this->head;
		if($fast == null){
			return false;
		}
		while($fast->next != null && $fast->next->next != null){
			$slow = $slow->next;
			$fast = $fast->next->next;
			if($slow == $fast){
				return true;
			}
		}
		return false;
	}
	//删除链表中的重复元素


	//链表翻转
	public function reverse(): void{
		$current = $this->head;
		$tmp = null;
		$res = null;
		while($current != null){
			$tmp = $current->next;
			$current->next = $res;
			$res = $current;
			$current = $tmp;
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
$s1 = new SinglyLinkedList();
$s2 = new SinglyLinkedList();
$s1->insertHead(3);
$s1->insertHead(2);
$s1->insertHead(1);
$s2->insertHead(10);
$s2->insertHead(9);
$s2->insertHead(8);
$s1->addNodeToTail($s2->head);
$s1->addNodeToTail($s2->head);   //会出现环  
var_dump($s1->count);
print_r($s1->findLoopStart());
//echo $s1;
