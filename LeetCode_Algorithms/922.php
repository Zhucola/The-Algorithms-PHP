<?php
class Solution {
    function sortArrayByParityII($A) {
    	$res = [];
    	$o_key = 0;
    	$j_key = 1;
 		for($i=0,$len=count($A);$i<$len;$i++){
 			if($A[$i]%2 == 0){
 				$res[$o_key] = $A[$i];
 				$o_key += 2;
 			}else{
 				$res[$j_key] = $A[$i];
 				$j_key += 2;
 			}
 		}
 		ksort($res);       
 		return $res;
    }
}