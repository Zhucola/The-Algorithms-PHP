<?php
class Solution {
    function numUniqueEmails($emails) {
    	$tmp = [];
        $count = count($emails);
        if($count <= 1){
        	return $count;
        }
        foreach ($emails as $item) {
        	$explode_item = explode("@",$item);
        	if(false !== ($first=strpos($explode_item[0],"+"))){
        		$explode_item[0] = substr($explode_item[0],0,$first);
        		$explode_item[0] = str_replace(".", "", $explode_item[0]);
        	} 
        	$tmp[$explode_item[1]][$explode_item[0]] = null;
        }
      	$res = 0;
        foreach ($tmp as $value) {
			if(is_array($value)){
				$res += count($value);
			}else{
				$res++;
			}
		}
		return $res;
    }
}
