<?php
/*
	二叉树:(一个空链接或者是一个有左右两个节点的链接，每个链接都指向一棵独立的子二叉树)
		1.节点包含的链接可以为null或者指向其他节点
		2.在二叉树中每个节点只能有一个父节点，根节点没有父节点
		3.每个节点都只有左右两个链接，分别指向自己的左子节点和右子节点
		4.可以将每个链接看做是指向了另一个二叉树，而这个二叉树的根节点就是被指向的节点
		5.每个节点都有一个值，一个键，一个左链接，一个右链接和一个节点计数器
		6.对于查找来说，如果递归中树是null则没有找到，否则较大的选择右面，小的选择左面
        7.所有操作最坏情况下所需的事件都和树的高度成正比
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

	//静态获取节点个数
	public static function getSize($node){
    	if($node == null){
    		return 0;
    	}
    	$left = self::getSize($node->left);
    	$right = self::getSize($node->right);
    	return 1+$left+$right;
    }

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

	//添加节点
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

	//获取key对应的值
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

	//二叉树转数组，中序遍历(先打印它的左子树，然后再打印它本身，最后打印它的右子树)
    private $print_tmp = [];
    public function printMiddle($node = null){
        $this->print_tmp = [];
        if($node == null){
            return $this->doPrintMiddle($this->root);
        }else{
            return $this->doPrintMiddle($node);
        }
    }
    private function doPrintMiddle($node){
        if($node == null){
            return;
        }
        $this->doPrintMiddle($node->left);
        $this->print_tmp[$node->key] = $node->val;
        $this->doPrintMiddle($node->right);
        return $this->print_tmp;
    }
    //二叉树转数组，前序遍历(先打印这个节点，然后再打印它的左子树，最后打印它的右子树)
    public function printHead($node = null){
        $this->print_tmp = [];
        if($node == null){
            return $this->doPrintHead($this->root);
        }else{
            return $this->doPrintHead($node);
        }
    }
    private function doPrintHead($node){
        if($node == null){
            return;
        }
        $this->print_tmp[$node->key] = $node->val;
        $this->doPrintHead($node->left);
        $this->doPrintHead($node->right);
        return $this->print_tmp;
    }
    //二叉树转数组，后序遍历(先打印它的左子树，然后再打印它的右子树，最后打印这个节点本身)
    public function printBehind($node = null){
        $this->print_tmp = [];
        if($node == null){
            return $this->doPrintBehind($this->root);
        }else{
            return $this->doPrintBehind($node);
        }
    }
    private function doPrintBehind($node){
        if($node == null){
            return;
        }
        $this->doPrintBehind($node->left);
        $this->doPrintBehind($node->right);
        $this->print_tmp[$node->key] = $node->val;
        return $this->print_tmp;
    }

    //二叉树翻转
    public function invertTree(){
    	$this->root = $this->doInvertTree($this->root);
    }
    private function doInvertTree($node){
    	if($node == null){
    		return null;
    	}
    	$node->left = $this->doInvertTree($node->left);
    	$node->right = $this->doInvertTree($node->right);
    	$tmp = $node->left;
    	$node->left = $node->right;
    	$node->right = $tmp;
    	return $node;
    }
    //合并两个二叉树
    public static function mergeBST($t1,$t2){
    	$root = null;
    	$res = self::doMergeBST($t1,$t2,$root);
    	print_r($root);
    }
    private static function doMergeBST($t1,$t2,&$root){
        if($t1!=null && $t2!=null){
        	$root = new Node($t1->key+$t2->key,$t1->val+$t2->val,1);
        	$root->left = self::doMergeBST($t1->left,$t2->left,$root);
        	$root->right = self::doMergeBST($t1->right,$t2->right,$root);
        	$root->N = self::getSize($root);
        	return;
        }else{
        	return $t1?$t1:$t2;
        }
    }

    //查找排名为第$key个的键的值
    public function select($k){
    	return $this->doSelect($this->root,$k);
    }
    private function doSelect($node,$k){
    	if($node == null){
    		return null;
    	}
    	$t = 0;
    	if($node->left != null){
    		$t = $this->size($node->left); //size方法有bug
    	}
    	if($t>$k){
    		return $this->doSelect($node->left,$k);
    	}elseif($t<$k){
    		return $this->doSelect($node->right,$k-$t-1);
    	}else{
    		return $node;
    	}
    }
    public function rank($key){
    	return $this->doRank($this->root,$key);
    }
    private function doRank($node,$key){
    	if($node == null){
    		return 0;
    	}
    	if($key < $node->key){
    		return $this->doRank($node->left,$key);
    	}elseif($key > $node->key){
    		$t = 0;
    		if($node->left != null){
    			$t = $this->size($node->left);
    		}
    		return 1+$t + $this->doRank($node->right,$key);
    	}else{
    		$t = 0;
    		if($node->left != null){
    			$t = $this->size($node->left);
    		}
    		return $t;
    	}
    }
    //删除最小的键
    public function deleteMin(){
    	$this->root = $this->doDeleteMin($this->root);
    }
    private function doDeleteMin($node){
    	if($node->left == null){
    		return $node->right;
    	}
    	$node->left = $this->doDeleteMin($node->left);
    	$node->N = $this->doSize($node->left) + $this->doSize($node->right) + 1;
    	return $node;
    }
    //删除二叉树的key对应的节点
    public function delete($key){
        $this->root = $this->doDelete($this->root,$key);
    }
    private function doDelete($node,$key){
        if($node == null){
            return null;
        }
        if($node->key>$key){
            $node->left = $this->doDelete($node->left,$key);
        }elseif($node->key<$key){
            $node->right = $this->doDelete($node->right,$key);
        }else{
            if($node->right == null){
                return $node->left;
            }
            if($node->left == null){
                return $node->right;
            }
            $t = $node;
            $node = $this->doMin($t->right);
            $node->right = $this->doDeleteMin($t->right);
            $node->left = $t->left;
        }
        $node->N = $this->doSize($node->left) + $this->doSize($node->right) + 1;
        return $node;
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
$obj->put(3,3);
$obj->put(2,2);
$obj->put(8,8);
$obj->put(10,10);
$obj->put(0,0);
$obj->deleteMin();
var_dump($obj->select(0));
var_dump($obj->rank(101));