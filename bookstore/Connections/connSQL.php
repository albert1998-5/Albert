<?php
$servername = "id16398012_bookstore";
// $servername = "192.168.20.4";
$username = "id16398012_albert199805";
$password = "Lin0983919132511~";
$database = "id16398012_bookstore";

/* 參數位置 */
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $database = "database";

/* Create connection */
$link = new mysqli($servername, $username, $password, $database);
// $link = mysqli_connect($servername, $username, $password, $database);




/* Check connection */
// if ($link->connect_error) {
//   die("Connection failed: " . $link->connect_error);
// }


// if ($link != FALSE) {
//   mysqli_query($link, "SET NAMES utf8");
//   // echo "OK";
// }

/* 連線失敗 */
if (mysqli_connect_errno()) {
  echo "連線失敗：" . mysqli_connect_error();
  $link = null;
  exit();
} else {
  /* 設定編碼 */
  mysqli_query($link, "SET NAMES utf8");
}
