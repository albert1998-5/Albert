<?php
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";
/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
/* id=header #header */
require_once($root_local . "/parts/header_control.php");


/* 主類別表 */
require_once($root_local . "/script/UL6_database_type_list.php");

$PHP_SELF = htmlspecialchars($_SERVER["PHP_SELF"]);

if (!isset($_GET['keyword'])) {
    $keyword = "";
} else {
    $keyword = htmlspecialchars($_GET['keyword']);
}
?>
<?php
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/parts/all_link.php");

?>
<link rel="stylesheet" href="<?php echo $root_cust; ?>/results/control/productbe/promain_flex.css">
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
// $query = "SELECT * FROM products ORDER BY P_ID ASC";
$query = "SELECT * FROM `products` INNER JOIN `type_list` ON `products` .`P_type_id` = `type_list`.`P_type_id`";
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
<!-- main_start -->
<div id="main">

    <?php
    // 多重搜尋
    require_once($root_local . "/parts/search_box.php");
    ?>
    <div class="book_list">
        <div style="text-align: left;">
            <a href="<?php echo $root_cust; ?>/results/control/productbe/productadd.php">新增產品+</a>
        </div>
        <div>
            目前資料筆數：<?php echo $total_records; ?>
            <?php if ($num_pages > 1) { //若不是第一頁則顯示 
            ?>
                <a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=1">第一頁</a>
                <a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $num_pages - 1; ?>">上一頁</a>
            <?php } ?>
            <?php if ($num_pages < $total_pages) { //若不是最後一頁則顯示 
            ?>
                <a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $num_pages + 1; ?>">下一頁</a>
                <a href="<?php echo $root_cust; ?>/results/control/productbe/product.php?page=<?php echo $total_pages; ?>">最後頁</a>
            <?php } ?>
            頁數：<?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $num_pages) {
                        echo $i . " ";
                    } else {
                        echo "<a href=\"product.php?page={$i}\">{$i}</a>";
                    }
                }
                ?>
        </div>
    </div>
    <!--  -->
    <table border="1px" cellspacing="0" class="book_list1" style="text-align:center" ;>
        <!-- <table border="1px"> -->
        <tr>
            <th>商品編號</th>
            <th>圖檔</th>
            <th>商品名稱</th>
            <th>作者</th>
            <th>商品價格</th>
            <th>商品標籤</th>
            <th>系列作編號</th>
            <th>商品資訊</th>
            <th>出版日期</th>
            <th>ISBN(13碼)</th>
            <th>功能</th>
        </tr>
        <?php
        while ($row_result = $result->fetch_assoc()) {
            $ID = $row_result["P_ID"];
            $name = $row_result["P_name"];

            $images = $GLOBALS['root_cust'] . "/images/product/" . $ID . "_1.jpg";


            echo "<tr class = 'book'>";
            echo "<td>" . $row_result["P_ID"] . "</td>";
            echo ("<td><img class= 'book_img' src='" . $images . "' title='" . $name . "'style='width:100px;margin-top:5px;'></td>");
            echo "<td>" . $row_result["P_name"] . "</td>";
            echo "<td>" . $row_result["P_author"] . "</td>";
            echo "<td>" . $row_result["P_price"] . "</td>";
            echo "<td>" . $row_result["P_type_id"] . "." . $row_result["P_type_name"] . "</td>";
            echo "<td>" . $row_result["P_NO"] . "</td>";
            echo "<td>" . $row_result["P_content"] . "</td>";
            echo "<td>" . $row_result["P_data"] . "</td>";
            echo "<td>" . $row_result["P_ISBN"] . "</td>";

            // echo "<td>" . $row_result["P_ISBN"] . "</td>";
            echo "<td><a href='$root_cust./results/control/productbe/productupdate.php?id=" . $row_result["P_ID"] . "&name=" . $row_result["P_name"] . "'>修改</a>";
            echo "<a href='$root_cust./results/control/productbe/productdelete.php?id=" . $row_result["P_ID"] . "&name=" . $row_result["P_name"] . "'>刪除</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<!-- main_end -->
<!-- footer_start -->
<?php
require_once($root_local . "/parts/footer_control.php");
?>