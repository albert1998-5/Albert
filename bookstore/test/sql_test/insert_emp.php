<?php
/*路徑*/

/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";

/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;

require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");


$servername = "localhost";
// $servername = "192.168.20.4";
$username = "bookstore";
$password = "123456";
$database = "bookstore_test";

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


$query = "SELECT `UID` FROM `employee_data` ORDER BY `UID` ASC ";
$results =  mysqli_query($link, $query);
// UPDATE `employee_list` SET `username` = '科學' , `passwd` = 123455 WHERE `employee_list`.`UID` = 1
$prepare_str = "UPDATE `employee_list` SET `username` = ? WHERE `employee_list`.`UID` = ? ;";
// $prepare_str = "SELECT `UID`,`emp_name` FROM `employee_data` WHERE `UID` = ? ";
$stmt = $link->prepare($prepare_str);
$UID = "";
$stmt->bind_param("si", $username, $UID);

// mysqli_stmt_bind_result();
// mysqli_stmt_bind_param();


while ($data = mysqli_fetch_array($results)) {
    $UID = $data["UID"];

    $username = "aaa" . $UID . "@gmail.com";
    $stmt->execute();

    // $stmt->bind_result($UID, $emp_name);

    // while ($stmt->fetch()) {
    //     echo ($UID . "  " . $emp_name . "<br>");
    // }
}
