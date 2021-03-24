<?php
require_once("../Connections/connSQL.php");

$query = "SELECT * FROM products WHERE `P_name` LIKE ?";
// $query ="SELECT * FROM products";

$stmt = $link->prepare($query);

$keyword = "%%";
$stmt->bind_param("s", $keyword);



$stmt->execute();
// 必須 全部接收
$stmt->bind_result($P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);

while ($stmt->fetch()) {
    printf("%s (%s,%s,%s,%s,%s,%s,%s,%s)\n<br>", $P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);
}
