<?php
/* $type_list[] = 書本清單 */

/* 導入$link */
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
require_once($root_local . "/Connections/connSQL.php");

// 主類別表
$query = sprintf("SELECT * FROM `type_list` ORDER BY sort");
$result = mysqli_query($link, $query);
// $type_list[] = array("P_type_id","P_type_name");
while ($data = mysqli_fetch_array($result)) {
    $type_list[] = $data;
}
