<?php
class Solution {
    function sortedSquares($arr){
        $res = [];
        $count = count($arr);
        $posIndex = 0;
        $negIndex = 0;
        while($posIndex<$count && $arr[$posIndex]<0){
            $posIndex++;
        }
        $negIndex = $posIndex--;
        for($i=0;0<=$posIndex&&$negIndex<$count;$i++){
            $negPow = $arr[$negIndex]*$arr[$negIndex];
            $posPow  = $arr[$posIndex]*$arr[$posIndex];
            if($negPow<$posPow){
                $res[] = $negPow;
                $negIndex++;
            }else{
                $res[] = $posPow;
                $posIndex--;
            }
        }
        while($negIndex<$count){
            $res[] = $arr[$negIndex]*$arr[$negIndex];
            $negIndex++;
        }
        while($posIndex>=0){
            $res[] = $arr[$posIndex]*$arr[$posIndex];
            $posIndex--;
        }
        return $res;
    }
}