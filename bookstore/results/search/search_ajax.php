<?php
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");

?>


<?php
// 搜尋
require_once($root_local . "/script/UL6_database_search.php");

// 主類別表
$query = sprintf("SELECT * FROM `type_list` ORDER BY sort");
$result = mysqli_query($link, $query);
$type_list[] = array("P_type_id" => 0, "P_type_name" => "熱門新書");
while ($data = mysqli_fetch_array($result)) {
    $type_list[] = $data;
}
$title = "";
foreach ($type_list as $data) {
    if ($P_type_id == $data["P_type_id"]) {
        $title = $data["P_type_name"];
    }
}

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="<?php echo $root_cust ; ?>/main_flex.css">
    <!-- 楷書體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- LOGO -->
    <link rel="shortcut icon" href="<?php echo $root_cust ; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php echo $root_cust ; ?>/images/book-2.png">
</head>

<body>
    <!-- 頁首 -->
    <div id="header">
        <div id="logo">
            <img src="<?php echo $root_cust ; ?>/images/book.png" alt="">
            <a href="<?php echo $root_cust ; ?>" target="_top" title="回首頁">南波灣書局</a>
        </div>
        <div class="right">
            <div id="user_list">
                <a href="#" title="user_login">會員名稱，您好</a>
                <a href="#" title="user_logout">登出</a>
                <a href="#" title="cart">購物車</a>
                <a href="#" title="QA">常見問題　</a>
            </div>
            <div class="search_box">
                <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="GET">
                    <input type="text" class="inputkeyword input_border0 ui-autocomplete-input" id="keyword" name="keyword" value="" maxlength="50" placeholder="可搜尋書名" autocomplete="off" required>
                    <input name="button" type="submit" class="type1" id="button" value="搜尋" />
                </form>
            </div>
        </div>

    </div>

    <div id="content">
        <div id="menu">

            <!-- <a href='./results/search/search.php?ALL=1'>全部一覽</a> -->
            <?php
            foreach ($type_list as $data) {
                // 打印菜單
                echo ("<a href='./search.php?P_type_id=" . $data["P_type_id"] . "'>" . $data["P_type_name"] . "</a>");
            }


            ?>
        </div>


        <div id="main">

            <!--  -->
            <div class="book_list">
                <div>
                    <?php
                    echo $title;
                    ?>
                </div>

                <?php if ($stmt->num_rows == 0) { ?>
                    <p>抱歉！沒有相關產品。</p>
                <?php } ?>
                <?php

                // foreach ($book_list as $data) {
                    
                //     // book($data);
                // }


                ?>
            </div>






        </div>
</body>

</html>