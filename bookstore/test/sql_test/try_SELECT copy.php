<?php
require_once("../Connections/connSQL.php");

$query = "SELECT * FROM products WHERE `P_name` LIKE ?";
// $query ="SELECT * FROM products";

$stmt = $link->prepare($query);

$keyword = "%%";
$stmt->bind_param("s", $keyword);



$stmt->execute();
// 必須 全部接收
$stmt->bind_result($columns[0], $columns[1], $columns[2], $columns[3], $columns[4], $columns[5], $columns[6], $columns[7], $columns[8]);

while ($stmt->fetch()) {
    $i = 0;
    while ($data = $columns[$i]) {
        echo ($data.",");
        $i++;
    }
    echo "<br>";
}
