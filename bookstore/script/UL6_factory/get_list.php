<?php
/* 路徑設置 */
if (!isset($GLOBALS['root_cust'])) {
    $GLOBALS['root_cust'] = "/bookstore";
    $GLOBALS['root_local'] = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root_cust'];
}

/* SQL連線 */
if (!isset($link)) {
    require_once($GLOBALS['root_local'] . "/Connections/connSQL.php");
}



function special_offer($link)
{
    /* 獲取 今天有的特價活動  */
    $S_list = array();
    $query = "SELECT * FROM `special_offer` WHERE `start_time` <= now() AND `end_time` >= now();";
    $result = mysqli_query($link, $query);
    while ($data = mysqli_fetch_array($result)) {
        $S_list[] = $data;
    }

    $result->close();
    return $S_list;
}


/* $type_list[] = 書本清單 */
function type_list($link)
{
    $type_list[] = array("P_type_id" => 0, "P_type_name" => "熱門新書");
    $query = sprintf("SELECT * FROM `type_list` ORDER BY sort");
    $result = mysqli_query($link, $query);
    while ($data = mysqli_fetch_array($result)) {
        $type_list[] = $data;
    }
    $result->close();
    return $type_list;
}

function test_list($link)
{
    $type_list[] = array("P_type_id" => 0, "P_type_name" => "熱門新書");
    $query = sprintf("SELECT * FROM `type_list` ORDER BY sort");
    $result = mysqli_query($link, $query);
    while ($data = mysqli_fetch_array($result)) {
        $type_list[] = $data;
    }
    // mysqli_stmt_store_result($stmt);
    mysqli_close($link);
    return ($type_list) ? $type_list : 0;
}
// 主類別表
