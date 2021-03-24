<?php
// 路徑設置
if (!isset($root_cust)) {
    $root_cust = "/bookstore";
    $root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
}

require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");


/* 開啟 SESSION */
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
    // $_SESSION["usertype"] = 0;
}



/* 權限管制 */
/* 顧客端為0 控制權限大於1 */
if (isset($_SESSION["usertype"]) && ($_SESSION["usertype"] != 0)) {
    // 跳轉至控制台
    header(sprintf("Location: %s", $root_cust . "/results/control/productbe/product.php"));
}


/* 購物車 */

//執行登出動作
if (isset($_GET["logout"]) && ($_GET["logout"] == true)) {

    unset($_SESSION["UID"]);
    unset($_SESSION["login"]);
    unset($_SESSION["usertype"]);
    // unset($_SESSION["username"]);
    // unset($_SESSION["usertype"]);

    // unset($_SESSION["loginMember"]);
    // unset($_SESSION["memberLevel"]);
    header(sprintf("Location: %s", $root_cust));
}





?>
<div id="header">
    <div id="logo">
        <img src="<?php echo $root_cust; ?>/images/book.png" alt="">
        <a href="<?php echo $root_cust; ?>" target="_top" title="回首頁">南波灣書局</a>
    </div>

    <div class="right">
        <div id="user_list">
            <!-- <a href="#" title="user_login">會員名稱，您好</a>
            <a href="#" title="user_logout">登出</a>
            <a href="#" title="cart">購物車</a>
            <a href="#" title="QA">常見問題　</a> -->

            <?php
            if ($_SESSION['login'] == true) {
                // if (isset($_SESSION['UID']) && ($_SESSION['UID'] != 0)) {
                /* 會員中心 */
                echo "<a href='" . $root_cust . "/results/user/user.php" . "' title='user_control'>" . $_SESSION['usid'] . "，您好</a>";
                /* 登出 */
                echo "<a href='" . $root_cust . "?logout=true" . "' title='user_logout'>登出</a>";
            } else {

                // 未完
                /* 登入 */
                echo "<a href='" . $root_cust . "/results/login/login.php" . "' title='user_login'>登入</a>";
                /* 註冊 */
                echo "<a href='" . $root_cust . "/results/login/signup.php" . "' title='user_register'>註冊</a>";
            }

            /* 購物車 */
            echo "<a href='" . $root_cust . "/results/cart/cart/cart.php" . "' title='cart'>購物車</a>";
            /* QA */
            echo "<a href='" . $root_cust . "/results/QA/customerser.html" . "' title='QA'>常見問題　</a>";



            ?>
        </div>
        <div class="search_box">
            <form action="<?php echo $root_cust . "/results/search/search.php" ?>" method="GET">
                <input type="text" class="inputkeyword input_border0 ui-autocomplete-input" id="keyword" name="keyword" value="" maxlength="50" placeholder="可搜尋書名" autocomplete="off" required>
                <input name="button" type="submit" class="type1" id="button" value="搜尋" />
            </form>
        </div>
    </div>
</div>

<?php

?>