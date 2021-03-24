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
// require_once($root_local . "/results/control/productbe/promain_flex-3.css");
// require_once($root_local . "/results/control/productbe/product.php");
// require_once($root_local . "/results/control/productbe/productadd.php");
// require_once($root_local . "/results/control/productbe/productdelete.php");
// require_once($root_local . "/results/control/productbe/productupdate.php");

?>
<?php
// include("Connections/connSQL1227.php");


//預設每頁筆數
$pageRow_records = 10;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
//本頁開始記錄筆數=(頁數-1)*每頁紀錄筆數
$starRow_records = ($num_pages - 1) * $pageRow_records;
//未加限制筆數的SQL敘述句
$query = "SELECT * FROM products ORDER BY P_ID ASC";
//加上限制筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$query_limit = "$query LIMIT {$starRow_records},{$pageRow_records}";
//
$result = mysqli_query($link, $query_limit);

$all_result = mysqli_query($link, $query);
//計算總筆數
$total_records = $all_result->num_rows;
//計算總頁數=(總筆數/每頁筆數)後無條件進位
$total_pages = ceil($total_records / $pageRow_records);

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/control/productbe/promain_flex-3.css">
    <!-- 楷書體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- LOGO -->
    <link rel="shortcut icon" href="<?php echo $root_cust; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php echo $root_cust; ?>/images/book-2.png">
</head>

<body>
    <!-- 頁首 -->
    <?php
    /* id=header #header */
    require_once($root_local."/parts/header.php");
    ?>

    <!-- 主體 -->
    <div id="content">
        <div id="menu">
            <p><a href="<?php echo $root_cust; ?>/results/control/productbe/productadd.php">新增產品</a></p>
            <p>目前資料筆數：<?php echo $total_records; ?></p>
            <table border="0" align="left">
                <tr>
                    <?php if ($num_pages > 1) { //若不是第一頁則顯示 
                    ?>
                        <td><a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=1">第一頁</a></td>
                </tr>
                <tr>
                    <td><a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $num_pages - 1; ?>">上一頁</a></td>
                <?php } ?>
                </tr>
                <?php if ($num_pages < $total_pages) { //若不是最後一頁則顯示 
                ?>
                    <tr>
                        <td><a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $num_pages + 1; ?>">下一頁</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $total_pages; ?>">最後頁</a></td>
                    <?php } ?>
                    </tr>
                    <tr>
                    <td>
                        頁數：<br>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $num_pages) {
                                echo $i . " ";
                            } else {
                                echo "<a href=\"product.php?page={$i}\">{$i}</a>";
                            }
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>





        <div id="main">
            <!--  -->
            <table border="1px" style="width: 100%;margin-top:30px;">
                <tr>
                    <th>商品編號</th>
                    <th>商品名稱</th>
                    <th>作者</th>
                    <th>商品價格</th>
                    <th>商品標籤</th>
                    <th>系列作編號</th>
                    <th>商品資訊</th>
                    <th>出版日期</th>
                    <th>ISBN</th>
                    <th>功能</th>
                </tr>
                <?php
                while ($row_result = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_result["P_ID"] . "</td>";
                    echo "<td>" . $row_result["P_name"] . "</td>";
                    echo "<td>" . $row_result["P_author"] . "</td>";
                    echo "<td>" . $row_result["P_price"] . "</td>";
                    echo "<td>" . $row_result["P_type_id"] . "</td>";
                    echo "<td>" . $row_result["P_NO"] . "</td>";
                    echo "<td>" . $row_result["P_content"] . "</td>";
                    echo "<td>" . $row_result["P_data"] . "</td>";
                    echo "<td>" . $row_result["P_ISBN"] . "</td>";
                    echo "<td><a href='$root_cust./results/control/productbe/productupdate.php?id=" . $row_result["P_ID"] . "'>修改</a>";
                    echo "<a href='$root_cust./results/control/productbe/productdelete.php?id=" . $row_result["P_ID"] . "'>刪除</a></td>";
                    echo "</tr>";
                }
                ?>




            </table>


        </div>
    </div>
    <!-- 頁尾 -->


    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>