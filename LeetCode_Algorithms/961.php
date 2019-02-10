<?php
class Solution {
    function repeatedNTimes($A) {
    	$i = 0;
        $len = count($A);
        $bak_arr = [];
        while($i<$len){
        	if(array_key_exists($A[$i], $bak_arr)){
        		return $A[$i];
        	}
        	$bak_arr[$A[$i]] = null;
        	$i++;
        }
    }
}