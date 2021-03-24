<?php
session_start();
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";
/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
?>

<?php
//引入檔案
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");

// 變數
$O_ID = $_SESSION['O_ID'];

// 將訂單內容建入資料庫
if(isset($_SESSION['O_ID'])){

    for ($i = 0; $i < count($_SESSION['O_P_ID']); $i++) {
        // 若無優惠活動，設為空值
        if(!isset($_SESSION['S_name'][$i][0])){
            $S_name = "";
        }else{
            $S_name = $_SESSION['S_name'][$i][0];
        }
        // 加入資料庫
        $insertSQL = sprintf("INSERT INTO order_output_data (O_ID, P_ID, O_qty, S_name) VALUES ('%d', '%d', '%d', '%s')", $_SESSION['O_ID'],  $_SESSION['O_P_ID'][$i], $_SESSION['O_qty'][$i], $S_name);
        $result = mysqli_query($link, $insertSQL);
    }

    // 刪除購物車資料
    $query=sprintf("DELETE FROM `cart` WHERE UID='%d'", $_SESSION['UID']);
    $result=mysqli_query($link,$query);
}
unset($_SESSION['O_ID']);
unset($_SESSION['O_P_ID']);
unset($_SESSION['O_qty']);
unset($_SESSION['S_name']);


// 查詢訂購時間
$query = sprintf("SELECT order_date FROM order_output_list WHERE O_ID='%d'",$O_ID);
$result = mysqli_query($link, $query);
$data = mysqli_fetch_array($result);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/cart/thanks/thanks.css">

    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- 標籤LOGO -->
    <link rel="shortcut icon" href="<?php $root_cust; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php $root_cust; ?>/images/book-2.png">

    <!-- wow.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <!-- header -->
    <?php require_once($root_local . "/parts/header.php"); ?>

     <!-- content -->
     <div class="flex wow animate__animated animate__fadeInDown">
        <img src="images/check.png" alt="">
        <div class="title" >Thank You！</div>
    </div>

    <div class="torder wow animate__animated animate__zoomIn">
       <table>
           <tr>
               <td>訂單號碼：</td>
               <td><?php echo date("Ymd")."-".$O_ID; ?></td>
           </tr>
           <tr>
               <td>訂購時間：</td>
               <td><?php echo $data['order_date']; ?></td>
           </tr>
           <tr>
               <td>訂單狀態：</td>
               <td>訂單處理中</td>
           </tr>
       </table>
    </div>

    <div class="msg">
        已收到您的訂單，若須檢視訂單狀況或付款狀態，請至會員中心查詢！<br>
        <div class="button" onclick="location.href='<?php $root_local; ?>/bookstore/index.php'">繼續逛逛</div>
    </div>


</body>
</html>