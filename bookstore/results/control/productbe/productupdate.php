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
// include("$root_cust./connSQL1227.php");
if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
    $query = "UPDATE products SET P_name=?,P_author=?,P_price=?,P_type_id=?,P_NO=?,P_content=?,P_data=?,P_ISBN=? WHERE P_ID=?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("ssssssssi", $_POST["P_name"], $_POST["P_author"], $_POST["P_price"], $_POST["P_type_id"], $_POST["P_NO"], $_POST["P_content"], $_POST["P_data"], $_POST["P_ISBN"], $_POST["P_ID"]);
    $stmt->execute();
   

    $target_dir = $root_local . "/images/product/";                         //指定儲存檔案的目錄
    // $target_dir = "$root_cust/images/product/";                         //指定儲存檔案的目錄

    // $filepath = $root_local . "/images/product/" . $ID . "_1.jpg";
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    //刪除語法
    $file= $target_dir.$_POST["P_ID"] . "_1.jpg";
    unlink($file);

    //$ID = mysqli_stmt_insert_id($stmt); //新增的圖檔的ID新增定義
    $target_file = $target_dir . $_POST["P_ID"] . "_1.jpg";                          //上傳檔案的名稱改成ID
    $uploadOk = 1;                                                       //上傳成功
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));      //strtolower：轉變為小寫    pathinfo：路徑信息   

    // Check if image file is a actual image or fake image(檢查圖像文件是真實圖像還是偽圖像)
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


    // Check if file already exists(檢查文件是否已經存在)
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size(檢查檔案大小)單位(KB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats(允許文件格式)
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error(檢查$ uploadOk是否被錯誤設置為0)
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file(如果一切正常，請嘗試上傳文件)
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { //move_uploaded_file（檔案,目的）函數將上載的文件移動到新的目的地。
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

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
    <title>南波灣書局-修改畫面</title>

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
            <h1 align="center">產品-修改頁面</h1>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" name="formFix" id="formFix" enctype="multipart/form-data">
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
                        <td><?php echo "<img class= 'book_img' src='" . $images . "' title='" . $name . "' width='200px' height='200px'>" ?><img id="preview_progressbarTW_img" title="圖片" width="200px" height="200px" style="margin-top: 5px;margin-left:5px" src="white.jpg" /><br>
                            <input type="file" id="progressbarTWInput" name="fileToUpload" accept="image/gif, image/jpeg, image/jpg, image/png" />
                        </td>
                    </tr>
                    <tr>
                        <th>商品名稱</th>
                        <td><input type="text" name="P_name" id="P_name" value="<?php echo $P_name; ?>"></td>
                    </tr>
                    <tr>
                        <th>作者</th>
                        <td><input type="text" name="P_author" id="P_author" value="<?php echo $P_author; ?>"></td>
                    </tr>
                    <tr>
                        <th>商品價格</th>
                        <td><input type="text" name="P_price" id="P_price" value="<?php echo $P_price; ?>"></td>
                    </tr>
                    <tr>
                        <th>商品標籤</th>
                        <td><input type="text" name="P_type_id" id="P_type_id" value="<?php echo $P_type_id; ?>"></td>
                    </tr>
                    <tr>
                        <th>系列作編號</th>
                        <td><input type="text" name="P_NO" id="P_NO" value="<?php echo $P_NO; ?>"></td>
                    </tr>
                    <tr>
                        <th>商品資訊</th>
                        <td><input type="text" name="P_content" id="P_content" value="<?php echo $P_content; ?>"></td>
                    </tr>
                    <tr>
                        <th>出版日期</th>
                        <td><input type="date" name="P_data" id="P_data" value="<?php echo $P_data; ?>"></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><input type="text" name="P_ISBN" id="P_ISBN" maxlength="13" value="<?php echo $P_ISBN; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="hidden" name="P_ID" value="<?php echo $P_ID; ?>">
                            <input type="hidden" name="action" value="update">
                            <input type="submit" name="button" value="更新產品資料">
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
<?php
$stmt->close();
$link->close();



?>