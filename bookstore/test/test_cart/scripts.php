<?php

function query_factory(){

}

function book_factory($data){
    book($data);
    
}



function book($book)
{
    // $book 為 dict(array) 存放 書籍資料

    // !取得數據
    // 編號
    $ID = $book["P_ID"];
    // 名稱
    $name = $book["P_name"];
    // 作者
    $author = $book["P_author"];
    // 價格
    $price = $book["P_price"];

    // 字串生成
    // 圖片路徑
    $images = "./images/product/" . $ID . "_1.jpg";
    // 商品路徑
    $products = "#";




    // !打印環節
    // 商品路徑
    //ex : <a class='book' href='#' title='化物語'>
    // echo ("<a class='book' href='" . $products . "' title='" . $name . "'>");
    echo ("<div class='book' href='" . $products . "' title='" . $name . "'>");

    // 商品圖片
    // <img src="./images/101823_1.jpg" alt="化物語">
    echo ("<img src='" . $images . "' title='" . $name . "'>");

    // 商品資訊
    // <div>化物語</div>
    // <div>作者：西尾維新</div>
    // <div>55元</div>

    echo ("<div class = 'name'>" . $name . "</div>");
    echo ("<div class = 'author'>作者：" . $author . "</div>");
    echo ("<div class = 'price'>" . $price . "元</div>");


    
    // !額外功能 
    // 快速購物
    // <label for="$ID" > 購買本數：
    // <input type='text' name="$ID" id="$ID" size='4'>

    // 本</label>
    if (isset($_REQUEST[$ID])) {
        $value = $_REQUEST[$ID];
    } else {
        $value = "";
    }

    // echo ("<label for='".$ID."' > 購買本數：<input type='text' name='" . $ID . "' id='" . $ID . "' size='4' > 本 </label>");
    echo ("<label for='" . $ID . "' > 購買本數：<input type='number' name='" . $ID . "' id='" . $ID . "' size='4' value = '" . $value . "' min='1' max='100'> 本 </label>");


    echo ("<input type='submit' value='購買'>");




    // !結尾
    // echo("</a>");
    echo ("</div>");
    return $book;
}



// 顯示小計  購物車
function book_cookies($cookies){

    


}
