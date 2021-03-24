<?php
// 路徑設置
if (!isset($root_cust)) {
    $root_cust = "/bookstore";
    $root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
}


/* SQL 連線 */
require_once($root_local . "/Connections/connSQL.php");
/* 腳本位置 */
require_once($root_local . "/script/script.php");
/* 分頁計算 */
require_once($root_local . "/script/shirt_lib.php");



/* 開啟 SESSION */
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['login']) or !isset($_SESSION["dept_ID"])) {
    $_SESSION['login'] = false;
    $_SESSION["dept_ID"] = 0;
}



/* 權限管制 */
/* 顧客端為0 控制權限大於1 */
if (!$_SESSION["dept_ID"]) {
    /* 未登入 跳轉至 控制台登入頁面 */

    jump_url("/results/control/login/login.php", "未登入管理者帳號，請先登入");
}


//執行登出動作
if (isset($_GET["logout"]) && ($_GET["logout"] == true)) {

    unset($_SESSION["login"]);
    unset($_SESSION["UID"]);
    unset($_SESSION["username"]);
    unset($_SESSION["passwd"]);
    unset($_SESSION["dept_ID"]);
    unset($_SESSION["emp_name"]);
    jump_url("/results/control/login/login.php", "登出成功");
}



?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <?php require_once($root_local . "/parts/all_link_control.php"); ?>
</head>

<body id="page-top">
    <div id="header">
        <div id="logo">
            <img src="<?php echo $root_cust; ?>/images/book.png" alt="">
            <a href="<?php echo $root_cust; ?>" target="_top" title="回首頁">南波灣書局 | 控制後臺</a>
        </div>

        <div class="right">
            <div id="user_list">
                <?php

                // if (isset($_SESSION['UID']) && ($_SESSION['UID'] != 0)) {
                /* 會員中心 */
                echo "<a href='" . $root_cust . "/results/user/user.php" . "' title='user_control'>" . $_SESSION['emp_name'] . "，您好</a>";
                /* 登出 */
                echo "<a href='" . $root_cust . "/results/control?logout=true" . "' title='user_logout'>登出</a>";
                ?>


            </div>

        </div>
    </div>
    <!-- header_end -->




    <?php
    require_once($root_local . "/parts/menu_control.php");
    ?>