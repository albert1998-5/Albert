<?php
session_start();
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";
/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
 

// 未成功，待修改
// DELETE語法已測試正確。應是UID或PID未擷取到

require_once($root_local . "/Connections/connSQL.php");
if(isset($_GET['C_ID'])){
    $C_ID=$_GET['C_ID'];
    $deleteGoto= $root_cust."/results/cart/cart/cart.php";
    $query=sprintf("DELETE FROM `cart` WHERE C_ID='%d'", $C_ID);
    $result=mysqli_query($link,$query);
    header(sprintf("Location:%s",$deleteGoto));
}

?>