<?php
class Solution {
    function hammingDistance($x, $y) {
    	$num = 0;
        $temp = decbin($x^$y);
        for($i=0,$len=strlen($temp);$i<$len;$i++){
        	if(1 == $temp[$i]){
        		$num++;
        	}
        }
        return $num;
    }
}