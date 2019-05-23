<?php
class HeapSort
{
    /**
     * @var int
     */
    protected $count;
    /**
     * @var array
     */
    protected $data;
    /**
     * HeapSort constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->count = count($data);
        $this->data  = $data;
    }
    /**
     * Action
     *
     * @return array
     */
    public function run()
    {
        $this->createHeap();
        while ($this->count > 0) {
            /* 这是一个大顶堆 , 所以堆顶的节点必须是最大的
               根据此特点 , 每次都将堆顶数据移到最后一位
               然后对剩余数据节点再次建造堆就可以 */
            $this->swap($this->data[0], $this->data[--$this->count]);
            $this->buildHeap($this->data, 0, $this->count);
        }
        return $this->data;
    }
    /**
     * 创建一个堆
     */
    public function createHeap()
    {
        $i = (int)(floor($this->count / 2) + 1);
        var_dump($i);die;
        while ($i--) {
            $this->buildHeap($this->data, $i, $this->count);
        }
    }
    /**
     * 从 数组 的第 $i 个节点开始至 数组长度为0 结束 , 递归的将其 ( 包括其子节点 ) 转化为一个小顶堆
     *
     * @param $data
     * @param $i
     * @param $count
     */
    public function buildHeap(array &$data, $i, $count)
    {
        if (false === $i < $count) {
            return;
        }
        // 获取左 / 右节点
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;
        $max   = $i;
        // 如果左子节点大于当前节点 , 那么记录左节点键名
        if ($left < $count && $data[$i] < $data[$left]) {
            $max = $left;
        }
        // 如果右节点大于刚刚记录的 $max , 那么再次交换
        if ($right < $count && $data[$max] < $data[$right]) {
            $max = $right;
        }
        if ($max !== $i && $max < $count) {
            $this->swap($data[$i], $data[$max]);
            $this->buildHeap($data, $max, $count);
        }
    }
    /**
     * 交换空间
     *
     * @param $left
     * @param $right
     */
    public function swap(&$left, &$right)
    {
        list($left, $right) = array ($right, $left);
    }
}
$array  = array (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14);
$result = (new HeapSort($array))->run();
var_dump($result);