<?php
class Solution {
    function findComplement($num) {
        $temp = "";
        $num_dec = decbin($num);
        for($i=0,$len=strlen($num_dec);$i<$len;$i++){
            $temp.=$num_dec[$i]^1;
        }
        return bindec($temp);
    }
}