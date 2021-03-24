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

// 先判斷登入狀態
if ((!isset($_SESSION["login"])) || ($_SESSION["login"] == false)) {
    jump_url("/results/login/login.php?cart=1", "請先登入或註冊會員!");
}

// 建立更新購物車 (須置頂)
if (isset($_POST['C_ID'])) {
    $countNum = count($_POST['qty']);
    for ($i = 0; $i < $countNum; $i++) {
        $qty = $_POST['qty'][$i];
        $C_ID = $_POST['C_ID'][$i];
        $updateSQL = sprintf("UPDATE cart SET qty='%d' WHERE C_ID='%d'", $qty, $C_ID);
        $result = mysqli_query($link, $updateSQL);
    }
}


// 接收session中的產品清單，並加進購物車
if ((isset($_SESSION["cart_PID"])) && ($_SESSION["login"] == "true")) {
    $countNum = count($_SESSION['cart_PID']);
    for ($i = 0; $i < $countNum; $i++) {
        $P_ID = $_SESSION['cart_PID'][$i];
        $qty = $_SESSION['cart_qty'][$i];

        // 先確認數量累加
        $all_qty = 0;
        $selectSQL = sprintf("SELECT * FROM `cart` WHERE UID='%d' AND P_ID='%d'", $_SESSION['UID'], $P_ID);
        $result1 = mysqli_query($link, $selectSQL);
        $cart_rows = mysqli_num_rows($result1);
        echo $cart_rows;
        if ($cart_rows > 0) {
            $row_data = mysqli_fetch_assoc($result1);
            $all_qty = $row_data['qty'] + $qty;
            $insertSQL = sprintf("UPDATE `cart` SET `qty`='%d' WHERE `C_ID`='%d'", $all_qty, $row_data['C_ID']);
            $result = mysqli_query($link, $insertSQL);
            echo $insertSQL;
        } elseif ($cart_rows == 0) {
            //若無產品，即新增一筆資料 
            $updateSQL = sprintf("INSERT INTO cart (UID, P_ID, qty) VALUES ('%d','%d','%d')", $_SESSION['UID'], $P_ID, $qty);
            $result = mysqli_query($link, $updateSQL);
        }
    }
    unset($_SESSION['cart_PID']);
    unset($_SESSION['cart_qty']);
}


// 查詢UID
$query = sprintf("SELECT * FROM products,cart WHERE products.P_ID = cart.P_ID and cart.UID = %d", $_SESSION['UID']);
$result = mysqli_query($link, $query) or die("Error: " . mysqli_error($link));
$dataCount = mysqli_num_rows($result);


// 設定折扣
$S_list = special_offer($link);
$order_list = array();
$order_data = array();
while ($data = mysqli_fetch_array($result)) {
    $order_list[] = $data;
}
// 設定折扣 > 條件比對
for ($i = 0; $i < count($order_list); $i++) {
    // foreach ($order_list as $order_list[$i]) {
    $order_list[$i]['S_name'] = array();
    $order_list[$i]['S_discount'] = 1;
    foreach ($S_list as $S_data) {
        $sale_col = $S_data['sale_col'];
        if ($order_list[$i][$sale_col] == $S_data['sale_value']) {
            /* 綁定特價名稱 */
            $order_list[$i]['S_name'][] = $S_data['S_name'];
            /* 修改為特價價格 */
            if ($order_list[$i]['S_discount'] >= $S_data['S_discount']) {
                $order_list[$i]['S_discount'] = $S_data['S_discount'];
            }
        }
        $order_list[$i]['P_price'] = intval($order_list[$i]['P_price']);
    }
}


$num = 0;
$total = 0;
?>



<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/cart/cart/cart.css">
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">

    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- 標籤LOGO -->
    <link rel="shortcut icon" href="<?php $root_cust; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php $root_cust; ?>/images/book-2.png">

    <!-- 建立javascript詢問功能函數 -->
    <Script type="text/javascript">
        function btn_del() {
            let msg = "確定要刪除此項商品嗎？";
            if (confirm(msg) == true) {
                return true;
            } else {
                return false;
            }
        }
    </Script>
</head>

<body>
    <!-- header -->
    <?php require_once($root_local . "/parts/header.php"); ?>

    <!-- main content -->
    <div id="main">
        <h3>我的購物車</h3>
        <hr width="95%" align="left">

        <div id="shopping_car">
            <!-- 購物車空值判斷 -->
            <?php if ($dataCount != 0) { ?>
                <div class="car_title">
                    <div class="chead">書名</div>
                    <div class="cqty">數量</div>
                    <div class="cprice">單價</div>
                    <div class="cdiscount">活動折扣</div>
                    <div class="ccount">小計</div>
                    <div class="cdel">刪除</div>
                </div>

                <form action="<?php echo $root_cust; ?>/results/cart/cart/cart.php" method="post" name="form1">
                    <?php
                    // while ($data = mysqli_fetch_array($result)) { 
                    for ($i = 0; $i < $dataCount; $i++) {
                    ?>
                        <div class="order_list">
                            <!-- 書本縮圖 -->
                            <div class="cimg">
                                <img src="<?php echo $root_cust; ?>/images/product/<?php echo $order_list[$i]['P_ID']; ?>_1.jpg" alt="">
                            </div>
                            <!-- 書名 -->
                            <div class="flex_box cname">
                                <div class="cname">
                                    <?php echo $order_list[$i]['P_name'];
                                    $num++; ?>
                                </div>
                                <!-- 作者 -->
                                <div class="cauthor">
                                    <?php echo $order_list[$i]['P_author']; ?>
                                </div>

                                <!-- 活動 -->
                                <div class="csale">
                                    <?php if ($order_list[$i]['S_name'] != "" && $order_list[$i]['S_discount'] != 1) {
                                        echo "<div class='s_list'><img src='images/tag.png' width='20rem' align='center'> 此商品符合：" . $order_list[$i]['S_name'][0] . "　" . ($order_list[$i]['S_discount'] * 10) . "折</div>";
                                    } ?>
                                </div>
                            </div>

                            <!-- 1/24  note:如何引用活動折扣function? -->
                            <!-- 數量 -->
                            <div class="cqty">
                                <input type="text" name="qty[]" id="qty[]" size="1" maxlength="2" value="<?php echo $order_list[$i]['qty']; ?>">　件
                            </div>

                            <!-- 單價 -->
                            <div class="cprice"><?php echo $order_list[$i]['P_price']; ?></div>

                            <!-- 折扣 -->
                            <div class="cdiscount" style="color: #a30909; text-decoration:underline;"><?php echo round(($order_list[$i]['P_price'] - ($order_list[$i]['P_price'] * $order_list[$i]['S_discount'])) * $order_list[$i]['qty']); ?></div>

                            <!-- 小計 -->
                            <div class="ccount"><?php echo round($order_list[$i]['P_price'] * $order_list[$i]['S_discount'] * $order_list[$i]['qty']); ?></div>

                            <!-- 總額 -->
                            <?php $total += intval($order_list[$i]['P_price'] * $order_list[$i]['S_discount'] * $order_list[$i]['qty']); ?>

                            <!-- 刪除 -->
                            <div class="cdel" style="font-size: 1.5rem">
                                <a href="<?php echo $root_cust; ?>/results/cart/cart/cart_del.php?C_ID=<?php echo $order_list[$i]['C_ID']; ?>" onclick="javascript:return btn_del()"><img src="<?php echo $root_cust; ?>/results/cart/cart/images/delete.png" alt="刪除" style="width:1.7vw"></a>
                                <input type="hidden" id="C_ID[]" name="C_ID[]" value="<?php echo $order_list[$i]['C_ID']; ?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div id="total">
                        <div class="cost">
                            <hr>
                            <p>共 <?php echo $num; ?> 件商品</p>
                            <p>小計：<?php echo $total; ?> 元</p>
                            <?php
                            if ($total < 1000) {
                                $fee = 60;
                                $message = "未達免運門檻";
                            } else {
                                $fee = 0;
                                $message = "已達免運門檻";
                            }
                            ?>
                            <p>運費：<?php echo $fee . "元<p><font size='1rem'>(" . $message . ")</font>"; ?></p>
                            <p>總金額：<?php $subtotal = $total + $fee;
                                    echo $subtotal;  ?> 元</p>
                        </div>
                        <div class="flex_box" style="flex-direction:colum">
                            <input type="button" value="結帳去 GO!" class="btn_pay" onclick="location.href='<?php echo $root_cust; ?>/results/cart/uorder/uorder.php'">
                            <input type="submit" id="button[]" name="button[]" value="更新購物車" class="btn_pay" onclick="alert('購物車即將更新!')">
                            <input type="button" value="繼續購物" onclick="location.href='<?php echo $root_cust; ?>/index.php'" class="btn_pay">
                        </div>
                    </div>
                </form>
            <?php
            } else {
                echo "<h3 style='height:2rem; font-size:1.1rem; line-height:2rem;'>您的購物車中尚無商品!</h3>";
            }
            ?>
        </div>
    </div>
    <?php if ($dataCount == 0) { ?>
        <div style="width:100%; height:50vh; background-color:rgb(241, 242, 246); text-align:center;">
            <button onclick="location.href='<?php $root_local; ?>/bookstore/index.php'" class="btn_buy">前往選購 GO!</button>
        </div>
        <!-- echo "<div align='center'><button onclick='location.href:C:/xampp\htdocs\bookstore\index.php'></button></div>"; -->
        <!-- echo "<div style=''></div>"; -->
    <?php } ?>
    <!-- 頁尾 -->

    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>