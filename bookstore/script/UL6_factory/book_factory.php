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




/* START */


function book_factory($link, $command, $LIMIT = TRUE)
{
    // 常用SQL指令
    $query = "";
    $title = $command;
    // 接收指令
    switch ($command) {
        case ("熱門新書"):
            $title = $command;
            $query = "SELECT * FROM `products` ";
            break;
    }

    // 部分顯示
    $query .= " ORDER BY `P_data` DESC ";
    if ($LIMIT) {
        $query .= "LIMIT 0,10 ";
    }
    $result = mysqli_query($link, $query);



    // 打印環節

    echo ("<div class='book_list'>");
    echo ("<div>" . $title . "</div>");
    while ($data = mysqli_fetch_array($result)) {
        book($data);
    };
    echo ("</div>");

    return $result;
}

function extra_list($add, $ID)
/* 額外功能列表 */
{
    switch ($add) {
        case ("快速購物"):
            return quick_shopping($ID);
    }
}

function book($book)
{
    /*$book 為 dict(array) 存放 書籍資料*/

    /* !取得數據*/
    /* 編號*/
    $ID = $book["P_ID"];
    /*名稱*/
    $name = $book["P_name"];
    /*作者*/
    $author = $book["P_author"];
    /*價格*/
    $price = $book["P_price"];
    /* 根目錄位置 */
    // $GLOBALS['root_cust']="";
    // $GLOBALS['root_cust'] = "/bookstore";

    /*字串生成*/
    /*圖片路徑*/
    $images = $GLOBALS['root_cust'] . "/images/product/" . $ID . "_1.jpg";
    // $images = "./images/product/" . $ID . "_1.jpg";
    /*商品路徑*/
    // $products = "http://localhost/bookstore/results/product/product.php?P_ID=" . $ID;
    // $products = "http://localhost/bookstore/results/product/product.html?P_ID=" . $ID;
    $products = $GLOBALS['root_cust'] . "/results/product/product.php?P_ID=" . $ID;





    // !打印環節
    // 商品路徑
    //ex : <a class='book' href='#' title='化物語'>
    echo ("<a class='book' href='" . $products . "' title='" . $name . "'>");
    // echo ("<div class='book' href='" . $products . "' title='" . $name . "'>");

    // 商品圖片
    // <img src="./images/101823_1.jpg" alt="化物語">
    echo ("<img class= 'book_img' src='" . $images . "' title='" . $name . "'>");

    // 商品資訊
    // <div>化物語</div>
    // <div>作者：西尾維新</div>
    // <div>55元</div>

    echo ("<div class = 'book_name'>" . $name . "</div>");
    echo ("<div class = 'book_author'>作者：" . $author . "</div>");
    echo ("<div class = 'book_price'>" . $price . "元</div>");



    // !額外功能 
    // 快速購物
    // <label for="$ID" > 購買本數：
    // <input type='text' name="$ID" id="$ID" size='4'>



    // !結尾
    echo ("</a>");
    // echo ("</div>");
    return $book;
}


function quick_shopping($ID)
{
    // 本</label>
    if (isset($_REQUEST[$ID])) {
        $value = $_REQUEST[$ID];
    } else {
        $value = "";
    }

    // echo ("<label for='".$ID."' > 購買本數：<input type='text' name='" . $ID . "' id='" . $ID . "' size='4' > 本 </label>");
    echo ("<label for='" . $ID . "' > 購買本數：<input type='number' name='" . $ID . "' id='" . $ID . "' size='4' value = '" . $value . "' min='1' max='100'> 本 </label>");


    echo ("<input type='submit' value='購買'>");
}
