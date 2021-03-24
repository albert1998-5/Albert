<!-- 取得資料庫 -->
<?php require_once("../Connections/database.php") ?>
<!-- 載入腳本 -->
<?php require_once("./scripts.php") ?>


<?php
// 接收參數
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $cookie = array(array());
    for ($i = 0, $y = 0; $i < $booklist_count; $i++) {
        // 如果該參數已設置 && 數量不為空值
        if (isset($_REQUEST[$booklist[$i]["P_ID"]]) && $_REQUEST[$booklist[$i]["P_ID"]] != "") {
        // if (isset($_REQUEST[$booklist[$i]["P_ID"]])) {
            $cookie[$y]["P_ID"] = $booklist[$i]["P_ID"];
            $cookie[$y]["num"] = $_REQUEST[$booklist[$i]["P_ID"]];
            $y++;
        }
    }
    if (isset($cookie)) {
        $cookie_count = count($cookie);

        // 顯示 $cookie
        // echo ("cookie_count =" $cookie_count . "<br>");
        // print_r($cookie);
    }
}
?>


<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="main.css">
</head>

<body>


    <?php
    // array顯示測試

    // print_r($booklist);
    // echo ("<br>");
    // print_r($booklist[0]);
    // echo ("<br>");
    // $book = $booklist[1];
    // print_r($book);
    // echo ("<br>");
    // print_r($book["P_name"]);
    // echo ("<br>");

    // echo ("cookie = ");
    // print_r($cookie);
    // echo ("<br>");
    ?>

    <div id="header">

        <div id="user_list">
            <a href="#" title="user_login">會員名稱，您好</a>
            <a href="#" title="user_logout">登出</a>
            <a href="#" title="QA">常見問題</a>
        </div>
        <a href="./index.html" target="_top" title="回首頁"><img src="./images/booklogo2.png" alt="">南波灣書局</a>
    </div>


    <div id="menu">
        <form action="../results/cart/cart.php" method="post">
            <table>
                <tr>
                    <th colspan='2'>購物清單</th>
                </tr>

                <?php
                // 顯示小計

                if (isset($cookie) && $cookie_count != 0) {
                    $total = 0;
                    for ($y = 0; $y < $cookie_count; $y++) {
                        for ($i = 0; $i < $booklist_count; $i++) {
                            // 比對 購物車內物品 並且數量不為空值
                            if ($cookie[$y]["P_ID"] == $booklist[$i]["P_ID"] && $cookie[$y]["num"] != "") {
                                // book_cookies($booklist[$i]);
                                // 書名
                                $P_name = $booklist[$i]["P_name"];
                                // 本數
                                $num = $cookie[$y]["num"];
                                // 小計
                                $price = $booklist[$i]["P_price"] * $cookie[$y]["num"];
                                // 累加
                                $total += $price;

                                // 打印
                                echo ("<tr><td>");
                                echo ($P_name . "：");

                                echo ("</td><td>");

                                echo ($num . "本");

                                echo ("</td></tr>");

                                echo ("<tr><th colspan='2'>" . $price . "元<th></th>");
                                echo ("<tr><th colspan='2'><hr><th></th>");

                                echo ("<input type='hidden' name='" . $cookie[$y]["P_ID"] . "' id='" . $cookie[$y]["P_ID"] . "' size='4' value = '" . $cookie[$y]["num"] . "'>");

                                break;
                            }
                        }
                    }
                    echo ("<tr><th colspan='2'>共：" . $total . "元</th></tr>");
                    echo ("<th colspan='2'><input type='submit' value='結帳'></th> ");
                } else {
                    echo ("<tr><td>");
                    echo ("未購物");

                    echo ("</td><td></td></tr>");
                }

                ?>

            </table>
        </form>
    </div>


    <div id="main">
        <?php
        // 表單測試
        echo ("<div class='book_list'>");
        echo ("<div>熱門新書</div>");

        // 避免$ _SERVER [“ PHP_SELF”]被利用，htmlspecialchars（）函數
        echo ("<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>");
        for ($i = 0; $i < $booklist_count; $i++) {
            $book = $booklist[$i];
            book($book);
        }
        echo ("</div>");
        echo ("</form>");
        ?>

    </div>





</body>



</html>