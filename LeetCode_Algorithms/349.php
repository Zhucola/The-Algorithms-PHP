<?php
class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Integer[]
     */
    function intersection($nums1, $nums2) {
        
        $hashTable1 = new HashSet();
        $rs = [];
        
        for ($i = 0; $i < count($nums1); $i++) {
            $hashTable1->add($nums1[$i]);
        }
        
        
        for ($i = 0; $i < count($nums2); $i++) {
            if ($hashTable1->contains($nums2[$i])) {
                $rs[$nums2[$i]] = $nums2[$i];
            }
        }
        
        return $rs;
        
    }
}

class HashSet
{
    public $data = [];
    private const BUCKET = 5;

    /**
     * Initialize your data structure here.
     */
    function __construct() {

    }

    /**
     * @param Integer $key
     * @return NULL
     */
    function add($key) {
        $this->data[$this->hash($key)][$key] = $key;
    }

    /**
     * @param Integer $key
     * @return NULL
     */
    function remove($key) {
        if ($this->contains($key)) {
            unset($this->data[$this->hash($key)][$key]);
        }
    }

    /**
     * Returns true if this set contains the specified element
     * @param Integer $key
     * @return Boolean
     */
    function contains($key) {
        if (isset($this->data[$this->hash($key)][$key])) {
            return true;
        }

        return false;
    }

    public function hash($key)
    {
        return $key % self::BUCKET;
    }
}
$obj = new Solution();
$res = $obj -> intersection([1,2,3,4,5,6,6],[4,6,7,4,8,9]);
var_dump($res);