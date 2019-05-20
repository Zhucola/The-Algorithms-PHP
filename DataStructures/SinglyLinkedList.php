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
		if($position < 0 || $position > $this->count-1){
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
	//求环的长度
	public function getCycleLength(){
		var_dump($this->findLoopStart());die;
		if(($start = $this->findLoopStart()) != false){
			$length = 0;
			$tmp = $start;
			while ($start != null) {
				$start = $start->next;
				$length++;
				if($start == $tmp){
					return $length;
				}
			}
		}
		return false;
	}
	//判断是否有环
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
	//删除排序链表中的重复元素
	public function deleteDuplicates(){
		$tmp = $this->head;
		while($tmp != null){
			if($tmp->next == null){
				break;
			}
			if($tmp->data == $tmp->next->data){
				$tmp->next = $tmp->next->next;
			}else{
				$tmp = $tmp->next;
			}
		}
	}
	//判断两个单链表相交的第一个交点，需要考虑环的可能

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
	//在不知道链表长度的情况下，查出倒数第N个节点
	public function findLastNode($position){
		if($this->isEmpty() || $position == 0){
			return null;
		}
		$first = $this->head;
		$second = $this->head;
		for($i=0;$i<$position;$i++){
			if($second == null){
				return null;
			}
			$second = $second->next;
		}
		while($second != null){
			$second = $second->next;
			$first = $first->next;
		}
		return $first;
	}
	//合并两个有序的单链表，合并之后还是有序
	public static function mergeLinkList(Node $node1,Node $node2){
		if($node1 == null && $node2 == null){
			return null;
		}
		if($node1 == null){
			return $node2;
		}
		if($node2 == null){
			return $node1;
		}
		$res = null;
		$current = null;
		if($node1->data < $node2->data){
			$res = $node1;
			$current = $node1;
			$node1 = $node1->next;
		}else{
			$res = $node2;
			$current = $node2;
			$node2 = $node2->next;
		}
		while($node1 != null && $node2 != null){
			if($node1->data < $node2->data){
				$current->next = $node1;
				$node1 = $node1->next;
			}else{
				$current->next = $node2;
				$node2 = $node2->next;
			}
			$current = $current->next;
		}
		while($node1 != null){
			$current->next = $node1;
			$node1 = $node1->next;
			$current = $current->next;
		}
		while($node2 != null){
			$current->next = $node2;
			$node2 = $node2->next;
			$current = $current->next;
		}
		$echo = "";
		while($res != null){
			$echo .= $res->data."->";
			$res = $res->next;
		}
		$echo = rtrim($echo,"->");
		echo $echo;
	}
	//删除一个给定的节点，该节点在链表中，时间复杂度O(1) http://eiptech.aspirecn.com/default.aspx
	public static function deleteNode(Node $head,Node $node){
		if($node->next != null){//删除的不是尾节点
			$tmp = $node->next;
			$node->data = $tmp->data;
			$node->next = $tmp->next;
		}elseif($node == $head){ //链表只有一个节点
			$head = null;
		}else{ //删除尾节点
			$current = $head;
			while($current->next != $node){
				$current = $current->next;
			}
			$current->next = null;
		}
		return $head;
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
$s1->insertHead(4);
$s1->insertHead(3);
$s1->insertHead(2);
$s1->insertHead(1);
$s1->insertHead(1);
$s1->deleteDuplicates();
echo $s1;die;
$s2->insertHead(3);
$s2->insertHead(2);
$s2->insertHead(1);
$s1->addNodeToTail($s2->head);
