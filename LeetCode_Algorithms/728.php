<?php
class Solution {
    function selfDividingNumbers($left, $right) {
		$res = [];
		for($i=$left;$i<=$right;$i++){
			for($z=0,$len=strlen((string)$i);$z<$len;$z++){
				if(((string)$i)[$z] == 0){
					break;
				}
				if($i%((string)$i)[$z] != 0){
					break;
				}
			}
			if($len == $z){
				$res[] = $i;
			}
		}        
		return $res;
    }
}