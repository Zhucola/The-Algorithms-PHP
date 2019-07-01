<?php
//一致性hash，带hash槽的
class FlexiHash{
	//虚拟节点数量
	private $_replicas = 64;
	//存hash与服务器的对应关系
	private $_positionToTarget;
	//存服务器的hash集合
	private $_targetToPositions;
	//是否已经排序
	private $_positionToTargetSorted;
	private $_targetCount;

	public function hashing($key){
		return crc32($key);
	}

	public function addTarget($server){
		for($i=0;$i<$this->_replicas;$i++){
			$hash = $this->hashing($server.$i);
			$this->_positionToTarget[$hash] = $server;
			$this->_targetToPositions[$server][] = $hash;
		}
		$this->_positionToTargetSorted = false;
		$this->_targetCount++;
		return true;
	}

	public function addTargets($server){
		foreach ($servers as $server){
			$this->addTarget($server);
		}

		return true;
	}

	public function lookup($key){
		if (empty($this->_positionToTarget)){
			return array();
		}
		if ($this->_targetCount == 1){
			//取第一个
			return key($this->_targetToPositions);
		}
		$resourceHash = $this->hashing($key);
		$this->_sortPositionTargets();
		foreach ($this->_positionToTarget as $hash => $server){
			// start collecting targets after passing resource position
			if ($hash > $resourceHash){
				return $server;
			}
		}
	}

	private function _sortPositionTargets(){
		if (!$this->_positionToTargetSorted){
			ksort($this->_positionToTarget, SORT_REGULAR);
			$this->_positionToTargetSorted = true;
		}
	}

	public function getAllTargets(){
		return array_keys($this->_targetToPositions);
	}

	public function removeTarget($server){
		if (!isset($this->_targetToPositions[$server])){
			return;
		}

		foreach ($this->_targetToPositions[$server] as $hash){
			unset($this->_positionToTarget[$hash]);
		}

		unset($this->_targetToPositions[$server]);

		$this->_targetCount--;

		return true;
	}

	public function getPosisionToTarger(){
		return $this->_positionToTarget;
	}

	public function getTargetToPositions(){
		return $this->_targetToPositions;
	}
}
$obj = new FlexiHash();
$obj->addTarget("127.0.0.1:6379");
$obj->addTarget("127.0.0.1:6378");
$obj->addTarget("127.0.0.1:6380");
$obj->addTarget("127.0.0.1:6381");
$res = $obj->lookup("aa111bc1");
print_r($obj->getPosisionToTarger());
print_r($obj->getTargetToPositions());
