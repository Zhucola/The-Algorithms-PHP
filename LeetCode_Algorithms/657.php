<?php
class Solution {
    function judgeCircle($moves) {
        $left_and_right = 0;
        $up_and_down = 0;
        for($i=0,$len=strlen($moves);$i<$len;$i++){
        	switch ($moves[$i]) {
        		case 'U':
        			$up_and_down++;
        			break;
        		case 'D':
        			$up_and_down--;
        			break;
        		case 'R':
        			$left_and_right++;
        			break;
        		case 'L':
        			$left_and_right--;
        			break;
        	}
        }
        if($left_and_right == 0 && $up_and_down == 0){
        	return true;
        }else{
        	return false;
        }
    }
}