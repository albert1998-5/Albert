<?php
require_once("../Connections/connSQL.php");


?>
<!-- 面向對象 -->

<?php
/* check connection */
$query = "INSERT INTO `products` (`P_ID`, `P_name`, `P_author`, `P_price`, `P_type_id`, `P_NO`, `P_content`, `P_data`, `P_ISBN`) 
VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
// VALUES(1111, 'TEST', 'UL6', 111, '5', '', '', '0000-00-00', '')";

$stmt = $link->prepare($query);
$stmt->bind_param("issiissss", $P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);
// $stmt = mysqli_prepare($link,$query);


$P_ID = 1112;
$P_name = "TEST";
$P_author = "UL6";
$P_price = "111a";
$P_type_id = 5;
$P_NO = "";
$P_content = "";
$P_data = '0000-00-00';
$P_ISBN = "";

$stmt->execute();
