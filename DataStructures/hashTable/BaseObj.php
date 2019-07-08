<?php
interface BaseObj{
	public function hashing($key);
	public function insertHash($key,$val);
	public function deleteHash($key);
	public function issetHash($key);
	public function findHash($key);
	public function displayHashtable();
	public function getLoadFactor();
}