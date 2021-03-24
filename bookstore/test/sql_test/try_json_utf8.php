<?php

/**************************************************************
 *
 * 使用特定function對陣列中所有元素做處理
 * @param string &$array  要處理的字串
 * @param string $function 要執行的函式
 * @return boolean $apply_to_keys_also  是否也應用到key上
 * @access public
 *
 *************************************************************/

function arrayRecursive(&$array = array(), $function, $apply_to_keys_also = false)
{

    static $recursive_counter = "";
    
    $recursive_counter = count($array);
    

    if ($recursive_counter > 100) {
        die('possible deep recursion attack');
    }
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }
        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
    $recursive_counter--;
}
/**************************************************************
 *
 * 將陣列轉換為JSON字串（相容中文）
 * @param array $array  要轉換的陣列
 * @return string  轉換得到的json字串
 * @access public
 *
 *************************************************************/
function JSON($array)
{
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}

$array = array(
    'Name' => '希亞',
    'Age' => 18
);


echo JSON($array);
