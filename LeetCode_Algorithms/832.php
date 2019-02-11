<?php
class Solution {
    function flipAndInvertImage($A) {
        $res = [];
        for($i=0,$len=count($A);$i<$len;$i++){
            $item_arr = &$A[$i];
            for($j=0,$item_arr_len = count($item_arr);$j<$item_arr_len/2;$j++){
                $item = $item_arr[$j] ^ 1;
                $item_arr[$j] = $item_arr[$item_arr_len - $j - 1] ^ 1;
                $item_arr[$item_arr_len - $j - 1] = $item;
            }
        }
        return $A;
    }
}