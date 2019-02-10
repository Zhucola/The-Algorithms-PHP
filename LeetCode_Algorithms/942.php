<?php
class Solution {
    function diStringMatch($S) {
    	$res = [];
    	$i = $i_bak = 0;
        $len = $len_bak = strlen($S);
        while($i<$len){
        	if("I" == $S[$i]){
        		$res[] = $i_bak++;
        	}else{
        		$res[] = $len_bak--;
        	}
        	$i++;
        }
        $res[] = $i_bak;
        return $res;
    }
}