<?php
/* json_處理UTF8系列 */
function json_encode_utf8($data_array)
{
  // 先利用urlencode讓陣列中沒有中文
  foreach ($data_array as $key => $value) {
    $new_data_array[urlencode($key)] = urlencode($value);
  }
  // 利用json_encode將資料轉成JSON格式
  $data_json_url = json_encode($new_data_array);
  // 利用urldecode將資料轉回中文
  $data_json = urldecode($data_json_url);

  return $data_json;
}