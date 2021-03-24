<?php
/* 路徑設置 */
// if (!isset($GLOBALS['root_cust'])) {
//     $GLOBALS['root_cust'] = "/bookstore";
//     $GLOBALS['root_local'] = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root_cust'];
// }
if (!isset($GLOBALS['root_cust'])) {
    $GLOBALS['root_cust'] = "/bookstore";
    $GLOBALS['root_local'] = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root_cust'];
}
/* SQL連線 */
if (!isset($link)) {
    require_once($GLOBALS['root_local'] . "/Connections/connSQL.php");
}

/* add小夥伴*/
if (TRUE) {
    require_once($GLOBALS['root_local'] . "/script/UL6_factory/book_factory.php");
    require_once($GLOBALS['root_local'] . "/script/UL6_factory/get_list.php");
}
if (FALSE) {
    require_once($GLOBALS['root_local'] . "/script/UL6_factory/check_level.php");
    require_once($GLOBALS['root_local'] . "/script/UL6_factory/sales.php");
    require_once($GLOBALS['root_local'] . "/script/UL6_factory/UL6_sql.php");
}

/* 跳回首頁 */
function jump_url(
    $url = "",/* 跳轉網址 */
    $str = 0 /* 彈出視窗的文字 */
) {
    if ($str) { 
        echo ("<script> alert('$str');</script>");
    }
    echo ("<script> parent.location.href = '" . $GLOBALS['root_cust'] . $url . "';</script>");
    // echo ("<script> window.location = '" . $GLOBALS['root_cust'] . $url . "';</script>");
}





# !index_list
// 搜尋工廠
function search_factory(
    $link,
    $LIMIT = 0,
    $P_type_id = -1,
    $keyword = ""
) {
    // $link, SQL連線
    // $LIMIT = 0, TRUE or FALSE 開啟限制輸出或不開啟
    // $P_type_id = 0,設為0為 全部搜尋 ,其他對照 類別ID 
    // $keyword = "" , 字串搜尋

    // 查詢建立
    $query = " SELECT * FROM `products` WHERE ";
    $keyword = "%" . $keyword . "%";


    //! WHERE 系列
    // 類別搜尋
    if ($P_type_id > 0) {
        $query .= sprintf(" `P_type_id` = '%d' AND ", $P_type_id);
    }

    // 字串搜尋
    if ($keyword != "%%") {
        $query .= "(";
        $query .= sprintf(" `P_ID` LIKE '%s' OR ", $keyword);
        $query .= sprintf(" `P_name` LIKE '%s' OR ", $keyword);
        $query .= sprintf(" `P_author` LIKE '%s' OR ", $keyword);
        $query .= sprintf(" `P_content` LIKE '%s' OR ", $keyword);
        $query .= "0) AND ";
    }

    // ALL

    $query .= sprintf(" 1 OR (%d = 0) ", $P_type_id);





    // 排序
    $query .= " ORDER BY `P_data` DESC ";

    // 限制
    if ($LIMIT) {
        $query .= " LIMIT 0,10 ";
    }



    $book_list = mysqli_query($link, $query);



    // !TEST 顯示
    // echo $query . "<br>";
    return $book_list;
}


// 顯示小計  購物車
function book_cookies($cookies)
{
}



/* 確認今天日期 */
function comparison_date($finaldate)
{

    $todate = date('Y-m-d');

    if (strtotime($todate) > strtotime($finaldate))

        $message =  '今天已過' . $finaldate . '喔!';

    else

        $message =  '還沒到' . $finaldate . '號喔!';

    return $message;
}
