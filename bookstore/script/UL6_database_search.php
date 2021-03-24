<?php
/* !導入$link */
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");

/* 搜尋開始 */

/* !參數設定 */

/* 回傳值 */
$book_list = array();
/* 搜尋表 */
$stmt;

/* 讀取方式
while ($stmt->fetch()) {
    book($book);
}
*/



/* 頁數表系列 */
$page_list = array(); /* 打印用頁數陣列 */
$prev_page = "上一頁";
$next_page = "下一頁";
$separator = " | ";
$max_links = 10;  //分頁設定數量
/* 分頁捕捉 */
$page_num = 0; //起啟頁=0
if (isset($_GET['pageNum_page_num'])) {
    $page_num = $_GET['pageNum_page_num'];
}
// if (isset($_GET['page_num'])) {
//     $page_num = $_GET['page_num'];
// }
$start_row = $page_num * $max_links; //開始行數
$start_limit = 0;
$max_limit = 1000;


/* 查詢表設定 */
/* 類別名稱 */
$P_type_id = 0;
/* 關鍵字設定 */
$keyword = "%%";
if (isset($_REQUEST["P_type_id"])) {
    $P_type_id = $_REQUEST["P_type_id"];
}

if (isset($_REQUEST["keyword"])) {
    $keyword = "%" . $_REQUEST["keyword"] . "%";
}



/* SQL指令 */
$query = ("SELECT  `P_ID`,`P_name`,`P_author`,`P_price`,`P_type_id`,`P_NO`,`P_content`,`P_data`,`P_ISBN`  FROM `products` 
WHERE 
(products.`P_type_id` = ? OR (? = 0)) AND 
(
(products.`P_ID` LIKE ? ) OR 
(products.`P_name` LIKE ? ) OR 
(products.`P_author` LIKE ? ) OR 
(products.`P_type_id` LIKE ? ) OR 
(products.`P_content` LIKE ? ) OR 
0
)
ORDER BY `P_data` DESC 
LIMIT ? , ? ;
");

$stmt = $link->prepare($query);

/* 設定參數類別 */
$stmt->bind_param("iiissssii", $P_type_id, $P_type_id, $keyword, $keyword, $keyword, $keyword, $keyword, $start_limit, $max_limit);

/* 全紀錄 */
$stmt->execute();
/* 必須先 固定 store result */
$stmt->store_result();
/* 總資料行數 */
$rows_all = $stmt->num_rows;
// printf("Number of rows: %d.<br>", $stmt->num_rows);
/* 總頁數 */
$total_Pages = ceil($rows_all / $max_links) - 1;

// 呼叫應用
# variable declaration
/* (當前頁數,總頁數,前一頁樣式,下一頁樣式,間格樣式,每頁總顯示,樣式,顯示樣式編號,GET表單名稱) */
$page_list = buildNavigation($page_num, $total_Pages, $prev_page, $next_page, $separator, $max_links, true, 1, "page_num");
/* 獲取目標資料 */
$start_limit = $start_row;
$max_limit = $max_links;

$stmt->execute();

$stmt->store_result();
/* 必須 全部接收 */
$stmt->bind_result($book["P_ID"], $book["P_name"], $book["P_author"], $book["P_price"], $book["P_type_id"], $book["P_NO"], $book["P_content"], $book["P_book"], $book["P_ISBN"]);
