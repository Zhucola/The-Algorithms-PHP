<?php
class Solution {
	const MORSE = [97=>".-","-...","-.-.","-..",".","..-.","--.","....","..",".---","-.-",".-..","--","-.","---",".--.","--.-",".-.","...","-","..-","...-",".--","-..-","-.--","--.."];
    function uniqueMorseRepresentations($words) {
    	$bak_arr = [];
    	foreach ($words as $item) {
    		$bak_str = "";
    		$len = strlen($item);
    		for($i=0;$i<$len;$i++){
    			$bak_str .= self::MORSE[ord($item[$i])];
    		}
    		$bak_arr[$bak_str] = null;
    	}
    	return count($bak_arr);
    }
}