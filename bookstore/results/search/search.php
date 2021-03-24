<?php
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
?>


<?php
// 搜尋
require_once($root_local . "/script/UL6_database_search.php");
/* 主類別表 */
require_once($root_local . "/script/UL6_database_type_list.php");
/* 獲取搜尋標題 */
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

    <!-- ALL_link -->
    <?php require_once($root_local . "/parts/all_link.php"); ?>
</head>

<body>
    <!-- 頁首 -->
    <?php
    /* id=header #header */
    require_once($root_local . "/parts/header.php");
    ?>

    <div id="content">
        <div id="menu">

            <!-- <a href='./results/search/search.php?ALL=1'>全部一覽</a> -->
            <?php
            foreach ($type_list as $data) {
                // 打印菜單
                echo ("<a href='" . $root_cust . "/results/search/search.php?P_type_id=" . $data["P_type_id"] . "'>" . $data["P_type_name"] . "</a>");
            }
            ?>
        </div>


        <div id="main">

            <?php
            // 多重搜尋
            require_once($root_local . "/parts/search_box.php");
            ?>
            <!--  -->
            <div class="book_list">
                <div>
                    <div class="title">
                        <?php
                        echo $title;
                        ?>
                    </div>

                    <div class="page_list">
                        <?php
                        echo ($page_list[0] . $page_list[1] . $page_list[2]);
                        ?>
                    </div>
                </div>



                <?php if ($stmt->num_rows == 0) { ?>
                    <p>抱歉！沒有相關產品。</p>
                <?php } ?>
                <?php

                // foreach ($book_list as $data) {

                //     // book($data);
                // }
                while ($stmt->fetch()) {
                    book($book);
                }


                ?>
            </div>
        </div>

        <!-- include footer -->
        <?php require_once($root_local . "/parts/footer.php"); ?>
</body>

</html>