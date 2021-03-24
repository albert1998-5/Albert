<?php
session_start();
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;

// 


// 接收訂單資料，並將訂單建入資料庫
require_once($root_local . "/Connections/connSQL.php");
if(isset($_POST['O_name'])){
    $O_name = $_POST['O_name'];
    $O_tel = $_POST['O_tel'];
    $total_amount = $_POST['total_amount'];
    $send_method = $_POST['send_method'];
    if($send_method==1){
        $O_addr = $_POST['O_addr'];
    }else{
        $O_addr = $_POST['O_conv']."/".$_POST['O_addr_conv'];
    }
    
    $pay_method = $_POST['pay_method'];
    $O_other = $_POST['O_other'];
    $insertGoTo = $root_cust."/results/cart/thanks/thanks.php";
    $insertSQL = sprintf("INSERT INTO order_output_list (UID, O_name, O_tel, O_addr, total_amount, send_method, pay_method, O_other) 
                    VALUES ('%d', '%s', '%s', '%s', '%d','%s','%s', '%s')", $_SESSION['UID'], $O_name, $O_tel, $O_addr, $total_amount, $send_method, $pay_method, $O_other);
    $result = mysqli_query($link, $insertSQL);  
    // 查詢最新一筆流水號 
    $_SESSION['O_ID'] = mysqli_insert_id($link);
    // 跳轉頁面
    header(sprintf("Refresh:2;url=%s",$insertGoTo));



    // print_r($_SESSION['O_P_name']);
    // print_r($_SESSION['O_qty']);
    // print_r($_SESSION['O_price']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="./images/loading.gif" alt="" style="margin: auto auto;">
</body>
</html>


