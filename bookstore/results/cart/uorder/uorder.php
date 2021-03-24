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


// 抓UID
if (isset($_SESSION['UID'])) {
    $UID = $_SESSION['UID'];
    $query = sprintf("SELECT * FROM products, cart, users WHERE products.P_ID=cart.P_ID AND cart.UID=users.UID AND cart.UID='%d'", $UID);
    $result = mysqli_query($link, $query) or die("Error: " . mysqli_error($link));
    $dataCount = mysqli_num_rows($result);
}

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

$qty_count = 0;
$discount_total = 0;
$total = 0;


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- css -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/cart/uorder/uorder.css">

    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- 標籤LOGO -->
    <link rel="shortcut icon" href="<?php $root_cust; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php $root_cust; ?>/images/book-2.png">

    <!-- jquery -->
    <script src="<?php $$root_local; ?>/js/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
    </script>

    <!-- 運送方式btn -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("#osend1").click(function() {
                $("#tr1").show();
                $("#tr2").hide();
            });
            $("#osend2").click(function() {
                $("#tr1").hide();
                $("#tr2").show();
            });
            $("#osend3").click(function() {
                $("#tr1").show();
                $("#tr2").hide();
            });
        });
    </script>

    <!-- btn css -->
    <style>
        button {
            /* flex: 1 1 30%; */
            /* width: 8rem; */
            display: block;
            height: 2.5rem;
            font-size: 14px;
            font-weight: bold;
            color: #a30909;
            letter-spacing: 1px;
            border: 1px solid #a30909;
            background-color: #fff;
            margin: 0.5rem 0.8rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #a30909;
            color: #fff;
        }
    </style>

</head>






<body>

    <!-- header -->
    <?php require_once($root_local . "/parts/header.php"); ?>

    <!-- content -->
    <h3>我的購物車</h3>
    <hr width="95%" align="left">

    <div class="flex">
        <div class="order_content">

            <div class="title">
                <div style="width: 50%;">書名</div>
                <div style="width: 25%;">數量</div>
                <div style="width: 25%;">單價</div>
            </div>




            <div class="content">
                <?php
                for ($i = 0; $i < count($order_list); $i++) {

                    // 優惠價
                    $order_list[$i]['sprice'] = intval($order_list[$i]['P_price'] * $order_list[$i]['S_discount']);

                    // 總折扣=(原價*數量)-(原價*折扣*數量)
                    $discount_total += ($order_list[$i]['P_price'] - $order_list[$i]['sprice']) * $order_list[$i]['qty'];

                    // 總數量
                    $qty_count += $order_list[$i]['qty'];

                    // 總金額=(原價*數量)-總折扣
                    $total += $order_list[$i]['sprice'] * $order_list[$i]['qty'];

                ?>
                    <table>
                        <tr>
                            <td style="width: 50%; padding-left:1rem;">
                                <!-- 書名 -->
                                <?php echo $order_list[$i]['P_name']; ?>
                                <?php
                                // 判斷有無符合活動->顯示活動名稱
                                if ($order_list[$i]['S_name'] != "" && $order_list[$i]['S_discount'] != 1) {
                                    echo "<div class='s_list'><img src='images/tag.png' width='20rem' align='center'> 此商品符合：" . $order_list[$i]['S_name'][0] . "　" . ($order_list[$i]['S_discount'] * 10) . "折</div>";
                                }
                                ?>

                            </td style="width: 25%;">
                            <td style="text-align: center;">
                                <!-- 數量 -->
                                <?php echo $order_list[$i]['qty']; ?>
                            </td>
                            <td style="text-align: center;width: 25%;">
                                <!-- 單價 -->
                                <?php
                                echo $order_list[$i]['sprice'] . " 元";
                                // 判斷有無符合活動->顯示原價
                                if ($order_list[$i]['S_name'] != "" && $order_list[$i]['S_discount'] != 1) {
                                    echo "<p style='text-decoration:line-through; font-size:0.6rem; color:#999;'>原價：" . $order_list[$i]['P_price'] . " 元</p>";
                                }

                                ?>
                            </td>
                        </tr>
                    </table>
                <?php  } ?>
            </div>




            <div class="total">
                <table>
                    <tr style="height: 30px;">
                        <td>商品件數共：</td>
                        <td><?php echo $qty_count; ?> 件</td>
                    </tr>
                    <tr>
                        <td>
                            運費：
                        </td>
                        <td>
                            <?php
                            if ($total + $discount_total < 1000) {
                                $fee = 60;
                                $message = "未達免運門檻";
                            } else {
                                $fee = 0;
                                $message = "已達免運門檻";
                            }
                            echo $fee . " 元";  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>總折扣：</td>
                        <td style="color:red;"><?php echo $discount_total; ?> 元</td>
                    </tr>
                    <tr style="font-weight:600;">
                        <td>結帳總金額：</td>
                        <td><?php echo $total + $fee; ?> 元</td>
                    </tr>
                </table>
            </div>
        </div>



        <div class="pay_list">
            <form action="uorder_keyin.php" method="post">
                <div style="height:2rem; 
                            text-align: center; 
                            color:#666; 
                            font-size:1.1rem; 
                            border-bottom: 1px solid #999999; 
                            padding-bottom:0.7rem;">收件人資訊
                </div>
                <table>
                    <tr>
                        <td>會員帳號：　</td>
                        <td class="b1"><input type="text" name="uname" value="<?php echo $order_list[0]['username']; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>收件人姓名：　</td>
                        <td class="b2"><input type="text" name="O_name" required="required"></td>
                    </tr>

                    <tr>
                        <td>連絡電話：　</td>
                        <td class="b3"><input type="text" name="O_tel" id="otel" required="required"></td>
                    </tr>
                    <tr>
                        <td>運送方式：　</td>
                        <td class="b4">
                            <input type="radio" name="send_method" id="osend1" value="1" checked>宅配到家
                            <input type="radio" name="send_method" id="osend2" value="2">超商取貨
                        </td>
                    </tr>
                    <tr id="tr1">
                        <td>收件地址：　</td>
                        <td class="b5"><input type="text" name="O_addr" placeholder="請輸入收件地址"></td>
                    </tr>
                    <tr id="tr2" style="display: none;">
                        <td>超商地址：　</td>
                        <td class="b6">
                            <select name="O_conv">
                                <option selected>--請選擇超商--</option>
                                <option value="7-11">7-Eleven</option>
                                <option value="全家">全家便利商店</option>
                            </select>
                            <input type="text" name="O_addr_conv" size="10" placeholder="請輸入門市名稱">
                        </td>
                    </tr>
                    <tr>
                        <td>支付方式：　</td>
                        <td class="b7">
                            <input type="radio" name="pay_method" id="opay" value="1" checked>貨到付款
                            <input type="radio" name="pay_method" id="opay" value="2">匯款
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">訂單備註：　</td>
                        <td class="b8"><textarea name="O_other" id="other" cols="30" rows="5" placeholder="選擇宅配者可備註希望配送時段"></textarea></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">注意事項：　</td>
                        <td>
                            1. 收件人姓名請填寫真實姓名，否則可能無法順利取貨。<br>
                            2. 選擇匯款者，請於三日內匯款至「○○銀行 xx分行，帳號：012-3456-7890-123，戶名：南波灣圖書股份有限公司」，匯款後請與客服聯繫，以便核對確認。
                        </td>
                    </tr>
                    <!-- 隱藏欄位 -->
                    <?php for ($i = 0; $i < count($order_list); $i++) {
                        // 書名
                        $_SESSION['O_P_ID'][$i] = $order_list[$i]['P_ID'];
                        // 數量
                        $_SESSION['O_qty'][$i] = $order_list[$i]['qty'];
                        // 單價
                        $_SESSION['O_price'][$i] = $order_list[$i]['sprice'] *  $order_list[$i]['qty'];
                        // 優惠活動
                        $_SESSION['S_name'][$i] = $order_list[$i]['S_name'];
                    } ?>
                    <!-- 總價格 -->
                    <input type="hidden" name="total_amount" value="<?php echo $total + $fee; ?>">
                    <!-- END -->
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <div class="button">
                                <button type="button" onclick="location.href='<?php echo $root_cust; ?>/results/cart/cart/cart.php'">回購物車</button>
                                <button type="reset" id="osend3">重填</button>
                                <button type="submit" style="background-color: #a30909; color:#fff;">確認送出</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <!-- 頁尾 -->
    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>