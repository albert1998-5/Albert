<?php
/*路徑*/

/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";

/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;

?>


<?php
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");
?>


<?php
/* 
主類別表 
獲取 type_list
*/
$type_list = type_list($link);

// 獲取各書本類別清單
foreach ($type_list as $data) {
    $book_list[] = search_factory($link, 1, $data["P_type_id"]);
}
// $book_list[] = search_factory($link, 1, 0);

/* 獲取特價列表 */
$S_list = special_offer($link);

// print_r($S_list);



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
            <?php
            foreach ($type_list as $data) {
                // 打印菜單
                echo ("<a href='" . $root_cust . "/results/search/search.php?P_type_id=" . $data["P_type_id"] . "'>" . $data["P_type_name"] . "</a>");
            }
            ?>
        </div>

        <div id="main">
            <?php
            for ($i = 0; $i < count($type_list); $i++) {
                if ($book_list[$i]->num_rows != 0) {
                    echo "<div class='book_list'>";
                    // 類別名稱
                    echo "<div>" . $type_list[$i]["P_type_name"] . "</div>";
                    while ($data = mysqli_fetch_array($book_list[$i])) {
                        /* 特價 */
                        foreach ($S_list as $S_data) {
                            $sale_col = $S_data['sale_col'];
                            if ($data[$sale_col] == $S_data['sale_value']) {
                                /* 綁定特價名稱 */
                                $data['S_name'][] = $S_data['S_name'];
                                // echo $data['S_name'][0];
                                /* 修改為特價價格 */
                                $data['P_price'] *= $S_data['S_discount'];
                            }
                            $data['P_price'] = intval($data['P_price']);
                        }

                        book($data);
                    }

                    echo "</div>";
                }
            }




            // foreach ($book_list as $data) {
            //     if ($data->num_rows != 0) {
            //         echo "<div class='book_list'>";
            //         echo "<div>熱門新書 </div>";
            //         while ($book = mysqli_fetch_array($data)) {
            //             book($book);
            //         }
            //         echo "</div>";
            //     }
            // }

            ?>



        </div>
        <!-- include footer -->
        <?php require_once($root_local . "/parts/footer.php"); ?>
</body>

</html>