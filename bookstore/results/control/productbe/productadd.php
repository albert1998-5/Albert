<?php
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";

/* 預設為空 */
// $root_cust = "";

/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;

/* 主類別表 */
require_once($root_local . "/script/UL6_database_type_list1.php");

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
require_once($root_local . "/script/shirt_lib.php");

?>

<?php
if (isset($_POST["action"]) && ($_POST["action"] == "add")) {
    // include("$root_cust/connSQL1227.php");

    $query = "INSERT INTO products (P_name,P_author,P_price,P_type_id,P_NO,P_content,P_data,P_ISBN) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $link->prepare($query);

    $stmt->bind_param("ssssssss", $_POST["P_name"], $_POST["P_author"], $_POST["P_price"], $_POST["P_type_id"], $_POST["P_NO"], $_POST["P_content"], $_POST["P_data"], $_POST["P_ISBN"]);
    $stmt->execute();

    // $id =  $stmt->$insert_id;
    $ID = mysqli_stmt_insert_id($stmt);//新增的圖檔的ID新增定義
    // echo $ID;
    require_once($root_local . "/results/control/productbe/upload.php");

    $stmt->close();
    $link->close();
    //重新導向回到主畫面
    header("Location:$root_cust./results/control/productbe/product.php");
}

?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局-新增畫面</title>

    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/control/productbe/promain_flex-3.css">
    <!-- <link rel="stylesheet" href="<?php echo $root_cust; ?>/results/control/productbe/promain_flex.css"> -->
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
        .a1 {
            border-color: lightskyblue;
            margin-left: 2px;
        }
        th{
            background-color: rgb(125, 155, 236);
        }
    </style>
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
            <h1 align="center">產品-新增頁面</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" name="formadd" id="formadd" enctype="multipart/form-data">
                <table border="1px" cellspacing="0" style="width: 50%;margin-top:30px;" align="center">
                    <tr>
                        <th>欄位</th>
                        <th>資料</th>
                    </tr>
                    <tr>
                        <th>商品圖檔</th>
                        <td>
                            <img id="preview_progressbarTW_img" title="圖片" width="100px" height="100px" style="margin-top: 5px;margin-left:5px" src="white.jpg" /><br>
                            <input type="file" id="progressbarTWInput" name="fileToUpload" accept="image/gif, image/jpeg, image/jpg, image/png" />
                        </td>
                    </tr>
                    <tr>
                        <th>商品名稱</th>
                        <td><input type="text" name="P_name" id="P_name"></td>
                    </tr>
                    <tr>
                        <th>作者</th>
                        <td><input type="text" name="P_author" id="P_author"></td>
                    </tr>
                    <tr>
                        <th>商品價格</th>
                        <td><input type="text" name="P_price" id="P_price"></td>
                    </tr>
                    <tr>
                        <th>商品標籤</th>
                        <td>
                            <select name="P_type_id" id="P_type_id">
                                <!-- <option value='0'>全部</option> -->
                                <?php
                                foreach ($type_list as $data) {
                                    // echo ("<option value='" . $data["P_type_id"]);
                                    // if ($data["P_type_id"] == $_GET["P_type_id"]) {
                                    // echo "' selected  >";
                                    // } else {
                                    // echo "'>";
                                    // }
                                    echo "<option>" . $data["P_type_id"] . "." . $data["P_type_name"] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>系列作編號</th>
                        <td><input type="text" name="P_NO" id="P_NO"></td>
                    </tr>
                    <tr>
                        <th>商品資訊</th>
                        <td><input type="text" name="P_content" id="P_content"></td>
                    </tr>
                    <tr>
                        <th>出版日期</th>
                        <td><input type="date" name="P_data" id="P_data"></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><input type="text" name="P_ISBN" id="P_ISBN" maxlength="13"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="action" value="add">
                            <input type="submit" name="button" value="新增產品資料">
                            <input type="reset" name="button2" value="重新填寫">
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