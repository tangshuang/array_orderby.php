<?php

/**
 * 对二维数组进行按字段排序
 * @param array $array 要排序的二维数组
 * @param bool $orderby 根据该字段（二维数组单个元素中的键名）排序
 * @param string $order 排序方式，asc:升序；desc:降序（默认）
 * @param string $children 子元素字段（键名），当元素含有该字段时，进行递归排序
 * @return array
 */
function array_orderby(&$array,$orderby = false,$order = 'desc',$children = false) {
  if($orderby == false)
    return $array;
  $key_value = $new_array = array();
  foreach($array as $k => $v) {
    $key_value[$k] = $v[$orderby];
  }
  if($order == 'asc') {
    asort($key_value);
  }
  else {
    arsort($key_value);
  }
  reset($key_value);
  foreach($key_value as $k => $v) {
    $new_array[$k] = $array[$k];
    // 如果有children
    if($children && isset($new_array[$k][$children])) {
      $new_array[$k][$children] = array_sort($new_array[$k][$children]);
    }
  }
  $new_array = array_values($new_array); // 使键名为0,1,2,3...
  $array = $new_array;
  return $new_array;
}
