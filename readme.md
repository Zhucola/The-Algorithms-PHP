**很多内容都是借鉴了一些别的大佬的文章，我只是做了很多文章的总结和验证**

## 目录
* [快速排序算法优化](#快速排序算法优化)

# 快速排序算法优化
最基本的快排如下:
```
function quickSort(Array $arr){
	$len = count($arr);
	if($len <= 1){
		return $arr;
	}
	$flag = $arr[0];
	$left = $right = [];
	for($i=1;$i<$len;$i++){
		$temp = $arr[$i];
		if($arr[$i] > $flag){
			$right[] = $temp;
		}else{
			$left[] = $temp;
		}
	}
	$left = quickSort($left);
	$right = quickSort($right);
	return array_merge($left,(array)$flag,$right);
}
```
