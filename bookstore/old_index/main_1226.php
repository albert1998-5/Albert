<?php require_once("./Connections/connSQL.php") ?>
<?php require_once("./script/script.php") ?>

<?php


// $query = sprintf("SELECT * FROM `products`  ORDER BY `P_data` LIMIT 0,10");

// 主類別表
$query = sprintf("SELECT * FROM `type_list` ORDER BY sort");
$type_list = mysqli_query($link, $query);


$book_list[] = search_factory($link, $ALL = 1, $LIMIT = 1);







?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="./main_flex.css">
    <!-- 楷書體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- LOGO -->
    <link rel="shortcut icon" href="./images/book-2.png">
    <link rel="bookmark" href="./images/book-2.png">
</head>

<body>
    <!-- 頁首 -->
    <div id="header">
        <div id="logo">
            <img src="./images/book.png" alt="">
            <a href="./main.php" target="_top" title="回首頁">南波灣書局</a>
        </div>
        <div id="user_list">
            <a href="#" title="user_login">會員名稱，您好</a>
            <a href="#" title="user_logout">登出</a>
            <a href="#" title="cart">購物車</a>
            <a href="#" title="QA">常見問題　</a>
        </div>

    </div>

    <div id="content">
        <div id="menu">

            <a href='./results/search/search.php?ALL=1'>全部一覽</a>
            <?php
            while ($data = mysqli_fetch_array($type_list)) {
                // 打印菜單
                echo ("<a href='./results/search/search.php?P_type_id=" . $data["P_type_id"] . "'>" . $data["P_type_name"] . "</a>");
                
            }


            ?>
        </div>

        <div id="main">

            <div class="book_list">
                <div>
                    熱門新書
                </div>
                <?php
                while ($data = mysqli_fetch_array($book_list[0])) {
                    book($data);
                }


                ?>
            </div>


            <?php


            ?>



        </div>
</body>

</html>