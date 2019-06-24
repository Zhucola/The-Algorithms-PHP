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
		if($current == null){//在链表为空的时候
			$this->head = $node;
		}else{
			while($current->next != null){
				$current = $current->next;
			}
			$current->next = $node;
		}
		if($checkLoop && $this->hasLoop()){
			$current->next = null;
		}else{
			while($node != null){
				$this->count++;
				$node = $node->next;
			}
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
	//如链表为1->2->3，执行insertNth(11,1);链表为11->1->2->3
	public function insertNth($data,$position){
		if($position == 1){
			$this->insertHead($data);
		}elseif($position < 1 || $position > $this->count+1){
			return false;
		}else{
			$tmp = new Node($data);
			$node = $this->head;
			for($i=0;$i<$position-2;$i++){
				$node = $node->next;
			}
			$tmp->next = $node->next;
			$node->next = $tmp;
			$this->count++;
		}
		return true;
	}
	//删除链表中的指定位置
	//如果是1->2->3，deleteNth(1)为2->3
	public function deleteNth($position){
		if($position < 1 || $position > $this->count){
			return false;
		}elseif($position == 1){
			$this->deleteHead();
		}else{
			$current = $this->head;
			for($i=0;$i<$position-2;$i++){
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
		if(($start = $this->findLoopStart()) != false){
			$length = 0;
			$tmp = $start;
			while ($start != null) {
				$start = $start->next;
				$length++;
				if($start === $tmp){
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
			if($slow === $fast){
				return true;
			}
		}
		return false;
	}
	//删除排序链表中的重复元素
	public function deleteDuplicates(){
		$tmp = $this->head;
		while($tmp->next!= null){
			if($tmp->data == $tmp->next->data){
				$tmp->next = $tmp->next->next;
				$this->count--;
			}else{
				$tmp = $tmp->next;
			}
		}
	}
	//在两个链表无环的情况环判断是否相交
	//如果连个链表相交，那么两个链表就会呈Y型，只要判断最后一个节点是不是相等就行
	//1->2->3
	//       \   
	//         9->10->11
	//   4->8/
	public static function isJoinNoLoop1(Node $node1,Node $node2){
		while($node1->next != null){
			$node1 = $node1->next;
		}
		while($node2->next != null){
			$node2 = $node2->next;
		}
		if($node1 === $node2){
			return true;
		}
		return false;
	}
	//将第二个链表的头指向第一个链表的尾，然后判断是否有环
	public static function isJoinNoLoop2(Node $node1,Node $node2){
		$tmp = $node1;
		while($tmp->next != null){
			$tmp = $tmp->next;
		}
		//将第二个链表的头指向第一个链表的尾
		$tmp->next = $node2;
		$fast = $slow = $tmp;
		if($fast == null){
			return false;
		}
		while($fast->next != null && $fast->next->next != null){
			$slow = $slow->next;
			$fast = $fast->next->next;
			if($slow === $fast){
				return true;
			}
		}
		return false;
	}
	//两个链表都有环，如果环入口相同则相交点在入口点前(只需计算着两个链表到入口点部分长度之差，然后用长的部分减去差，再同时与短的部分同步前进，如果节点相同，则为相交点)，如果不同则相交点是任意两个入口点
	public static function bothLoop(Node $node1,Node $node2){
		$start1 = self::findLoopStartStatic($node1);
		$start2 = self::findLoopStartStatic($node2);
		if($start1===$start2){
			
		}else{
			return [$start1,$start2];
		}
	}
	private static function findLoopStartStatic(Node $node){
		$hasLoop = false;
		$slow = $fast = $node;
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
	//找到两个有交点的链表的交点
	public static function getFirstJoinNode(Node $node1,Node $node2){
		$tmp1 = $node1;
		$tmp2 = $node2;
		$length1 = $length2 = 0;
		while($tmp1->next != null){
			$length1++;
			$tmp1 = $tmp1->next;
		}
		while($tmp2->next != null){
			$length2++;
			$tmp2 = $tmp2->next;
		}
		if($length1>$length2){
			$tmp = $node1;
			for($i=0;$i<$length1-$length2;$i++){
				$tmp = $tmp->next;
			}
			while($tmp->next!=null && $node2->next!=null){
				$tmp = $tmp->next;
				$node2=$node2->next;
				if($tmp===$node2){
					return $tmp;
				}
			}
		}else{
			$tmp = $node2;
			for($i=0;$i<$length2-$length1;$i++){
				$tmp = $tmp->next;
			}
			$tmp = $tmp->next;
			$node1=$node1->next;
			if($tmp===$node1){
				return $tmp;
			}
		}
	}

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
		if($position<1){
			return 0;
		}
		$slow  = $fast = $this->head;
		for($i=0;$i<$position-1;$i++){
			if($fast->next != null){
				$fast = $fast->next;
			}else{
				return null;
			}
		}
		while($fast->next != null){
			$fast = $fast->next;
			$slow = $slow->next;
		}
		return $slow;
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
	//删除一个给定的节点，该节点在链表中，时间复杂度O(1)
	public static function deleteNode(Node $head,Node $node){
		if($node->next != null){//删除的不是尾节点
			$node->data = $node->next->data;
			$node->next = $node->next->next;
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
$common = new SinglyLinkedList();
$s1->insertHead(8);
$s1->insertHead(6);
$s1->insertHead(4);
$s1->insertHead(1);
$common->insertHead(1);
$common->insertHead(9);
$common->insertHead(10);
$s1->addNodeToTail($common->head);
$s2->insertHead(3);
$s2->insertHead(2);
$s2->insertHead(1);
$s2->addNodeToTail($common->head);
$res = SinglyLinkedList::isJoinNoLoop2($s1->head,$s2->head);
var_dump($res);