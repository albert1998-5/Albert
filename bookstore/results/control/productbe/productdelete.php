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
// include("$root_cust/connSQL1227.php");
if (isset($_POST["action"]) && ($_POST["action"] == "delete")) {
    $query = "DELETE FROM products WHERE P_ID=?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $_POST["P_ID"]);
    $stmt->execute();
    $stmt->close();
    $link->close();
    //重新導向回到主畫面
    header("Location:$root_cust./results/control/productbe/product.php");
}
$sql_select = "SELECT P_ID,P_name,P_author,P_price,P_type_id,P_NO,P_content,P_data,P_ISBN FROM products WHERE P_ID=?";
$stmt = $link->prepare($sql_select);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->bind_result($P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);
$stmt->fetch();



?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局-刪除畫面</title>

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
    <style>
        th {
            background-color: rgb(125, 155, 236);
        }
    </style>
    <script language="javascript">
        function del() {
            var msg = "您真的確定要刪除嗎？\n\n請確認！";
            if (confirm(msg) == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
    <!-- 頁首 -->
    <?php
    /* id=header #header */
    require_once($root_local . "/parts/header_control.php");
    ?>

    <!-- 主體 -->
    <div id="content">
        <div id="menu">
            <p><a href="<?php echo $root_cust; ?>/results/control/productbe/product.php">回上一頁</a></p>
        </div>





        <div id="main">
            <h1 align="center">產品-刪除頁面</h1>
            <form action="" method="POST" name="formDel" id="formDel">
                <table border="1px" cellspacing="0" style="width: 50%;margin-top:30px;" align="center">
                    <tr>
                        <th>欄位</th>
                        <th>資料</th>
                    </tr>
                    <tr>
                        <th>商品圖檔</th>
                        <?php
                        $ID = $_GET["id"];
                        $name = $_GET["name"];
                        $images = $GLOBALS['root_cust'] . "/images/product/" . $ID . "_1.jpg"; ?>
                        <td><?php echo "<img class= 'book_img' src='" . $images . "' title='" . $name . "' style='width:100px;height:100px;margin-top:5px;'>" ?></td>
                    </tr>
                    <tr>
                        <th>商品名稱</th>
                        <td><?php echo $P_name; ?></td>
                    </tr>
                    <tr>
                        <th>作者</th>
                        <td><?php echo $P_author; ?></td>
                    </tr>
                    <tr>
                        <th>商品價格</th>
                        <td><?php echo $P_price; ?></td>
                    </tr>
                    <tr>
                        <th>商品標籤</th>
                        <td><?php echo $P_type_id; ?></td>
                    </tr>
                    <tr>
                        <th>系列作編號</th>
                        <td><?php echo $P_NO; ?></td>
                    </tr>
                    <tr>
                        <th>商品資訊</th>
                        <td><?php echo $P_content; ?></td>
                    </tr>
                    <tr>
                        <th>出版日期</th>
                        <td><?php echo $P_data; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><?php echo $P_ISBN; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="P_ID" value="<?php echo $P_ID; ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="submit" name="button" value="確定刪除這筆資料嗎?" onclick="return del()">
                            <input type="reset" name="button2" value="取消刪除" onclick="window.history.back();">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- 頁尾 -->


    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>
    <!-- JavaScript part -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        $("#progressbarTWInput").change(function() {

            readURL(this);

        });



        function readURL(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {

                    $("#preview_progressbarTW_img").attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);

            }

        }
    </script>
</body>

</html>
<?php
$stmt->close();
$link->close();



?>