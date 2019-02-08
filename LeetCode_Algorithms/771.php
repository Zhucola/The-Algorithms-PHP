<?php
class Solution {
    function toLowerCase($str) {
        $res = "";
        for($i=0;$i<strlen($str);$i++){
            $item = ord($str[$i]);
            if(65<=$item&&90>=$item){
                $res.=chr($item+32);
            }else{
                $res.=$str[$i];
            }
        }
        return $res;
    }
}