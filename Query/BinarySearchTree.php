<?php
/*
	二叉树:(一个空链接或者是一个有左右两个节点的链接，每个链接都指向一棵独立的子二叉树)
		1.节点包含的链接可以为null或者指向其他节点
		2.在二叉树中每个节点只能有一个父节点，根节点没有父节点
		3.每个节点都只有左右两个链接，分别指向自己的左子节点和右子节点
		4.可以将每个链接看做是指向了另一个二叉树，而这个二叉树的根节点就是被指向的节点
		5.每个节点都有一个值，一个键，一个左链接，一个右链接和一个节点计数器
		6.对于查找来说，如果递归中树是null则没有找到，否则较大的选择右面，小的选择左面
									S
									|
					---------------------------------
					E   							X
					|                               |
			------------------                ---------------
	  		A 				 R                空节点         R
	  		|                |
	  	---------       --------------
	  	空节点	C	    H           空节点

		将二叉树的所有键映射到一条直线上，得到的是一条有序的键列
	  	    A   C   E   H   R       S              X         R

	  	A是E的左子节点，A和R的父节点是E，A和C是比E小的键，R和H是比E大的键
	  	以x节点为根的子树的节点总数
	  		size(x) = size(x.left) + size(x.right) + 1  size方法会将空链接的值当成0
*/
class BST{
	public $root;
	public function size($node = null){
		if($node == null){
			return $this->doSize($this->root);
		}else{
			return $this->doSize($node);
		}
	}

	private function doSize($node){
		if($node == null){
			return 0;
		}else{
			return $node->N;
		}
	}

	public function put($key,$val){
		$this->root = $this->doPut($this->root,$key,$val);
	}

	private function doPut($node,$key,$val){
		if($node == null){
			return new Node($key,$val,1);
		}
		if($key < $node->key){
			$node->left = $this->doPut($node->left,$key,$val);
		}elseif($key > $node->key){
			$node->right = $this->doPut($node->right,$key,$val);
		}else{
			$node->val = $val;
		}
		//沿着添加路径向上更新节点计数器的值
		$node->N = $this->doSize($node->left) + $this->doSize($node->right) + 1;
		return $node;
	}

	public function get($key){
		return $this->doGet($this->root,$key);
	}

	private function doGet($node,$key){
		if($node == null){
			return null;
		}
		if($key < $node->key){
			return $this->doGet($node->left,$key);
		}elseif($key > $node->key){
			return $this->doGet($node->right,$key);
		}else{
			return $node->val;
		}
	}
	//求树的深度
	public function getMaxDepth($node = null ){
		if($node == null){
			return $this->doGetMaxDepth($this->root);
		}else{
			return $this->doGetMaxDepth($node);
		}
	}
	private function doGetMaxDepth($node){
		if($node == null){
			return 0;
		}else{
			$left = $this->doGetMaxDepth($node->left);
			$right = $this->doGetMaxDepth($node->right);
			return 1+max($left,$right);
		}
	}
	//找最小的键
	public function min(){
		return $this->doMin($this->root)->val;
	}
	private function doMin($node){
		if($node->left == null){
			return $node;
		}
		return $this->doMin($node->left);
	}

	//二叉树转数组
	private $print_tmp = [];
	public function print($node){
		if($node == null){
			return;
		}
		$this->print($node->left);
		$this->print_tmp[$node->key] = $node->val;
		$this->print($node->right);
		return $this->print_tmp;
	}
}
class Node{
	public $key; //键
	public $val; //值
	public $left; //左链接
	public $right; //右链接
	public $N = 0; //以该节点为根的子树的节点总数
	public function __construct($key,$val,$N){
		$this->key = $key;
		$this->val = $val;
		$this->N = $N;
	}
}
$obj = new BST();
$obj->put(1,1);
$obj->put(2,2);
$obj->put(3,123);
$obj->put(4,4);
var_dump($obj->get(3));
var_dump($obj->size());