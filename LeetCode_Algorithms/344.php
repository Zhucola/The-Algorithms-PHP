<?php
class Solution {
    function reverseString(&$s) {
        for($i=0,$len=count($s);$i<$len/2;$i++){
        	$temp = $s[$i];
        	$s[$i] = $s[$len - $i - 1];
        	$s[$len - $i - 1] = $temp;
        }
        return $s;
    }
}