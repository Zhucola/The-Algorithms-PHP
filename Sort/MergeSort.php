<?php
/*
                                            mSort($arr,0,4)
                                                 |
                            ---------------------------------------------
                        mSort($arr,0,2)                           mSort($arr,3,4)
                             |                                          |
                   -------------------------------------------------------------------------
                mSort($arr,0,1)     mSort($arr,2,2)         mSort($arr,3,3)  mSort($arr,4,4)
                      |
            --------------------------
        mSort($arr,0,0) mSort($arr,1,1)      
        将任意长度为N的数组排序所需时间和NlogN成正比，缺点是需要的空间和N成正比
        将一个数组排序，可以先递归的将他们分成两半分别排序，然后将结果归并起来
        将一个大数组排序，需要进行很多次归并，每次归并都需要创建一个新数组                      
*/
class MergeSort
{
    public function __construct(array $arr)
    {
        $this->mSort($arr, 0, count($arr) - 1);
    }
    public function mSort(&$arr, $left, $right)
    {
        if ($left < $right) {
            $center = (int)floor(($left + $right) / 2);
            $this->mSort($arr, $left, $center);
            $this->mSort($arr, $center + 1, $right);
            $this->mergeArray($arr, $left, $center, $right);
        }
    }
    public function mergeArray(&$arr, $left, $center, $right) //0 0 1
    {
        //设置两个起始位置标记
        $a_i  = $left;
        $b_i  = $center + 1;
        $temp = [];
        while ($a_i <= $center && $b_i <= $right) {
            //当数组A和数组B都没有越界时
            if ($arr[ $a_i ] < $arr[ $b_i ]) {
                $temp[] = $arr[ $a_i++ ];
            } else {
                $temp[] = $arr[ $b_i++ ];
            }
        }
        //判断 数组A内的元素是否都用完了，没有的话将其全部插入到C数组内：
        while ($a_i <= $center) {
            $temp[] = $arr[ $a_i++ ];
        }
        //判断 数组B内的元素是否都用完了，没有的话将其全部插入到C数组内：
        while ($b_i <= $right) {
            $temp[] = $arr[ $b_i++ ];
        }
        //将$arrC内排序好的部分，写入到$arr内：
        for ($i = 0, $len = count($temp); $i < $len; $i++) {
            $arr[ $left + $i ] = $temp[ $i ];
        }
    }
}
new mergeSort([3,1,2,4,5]);