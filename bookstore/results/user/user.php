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

<!doctype html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>南波灣書局_會員中心</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">
    <link rel="stylesheet" href="user.css">
</head>

<body>
    <!-- 頁首 -->

    <?php
    /* id=header #header */
    require_once($root_local . "/parts/header.php");
    ?>

    <!-- 主體 -->
    <section class="my-5">
        <div class="container">
            <div class="row">
                <!-- 左邊欄位 -->
                <div class="col-md-4">
                    <div class="mx-2">
                        <h5 class="font-weight-bold">會員資料管理</h5>
                        <div class="list-group">
                            <a href="data/changePw.php" class="list-group-item list-group-item-action">密碼修改</a>
                            <a href="data/infoUp.php" class="list-group-item list-group-item-action">資料更新</a>
                        </div>

                        <h5 class="font-weight-bold mt-3">訂單管理</h5>
                        <div class="list-group">
                            <a href="order/record.php" class="list-group-item list-group-item-action">訂單紀錄</a>
                            <a href="order/cancel.php" class="list-group-item list-group-item-action">取消訂單</a>
                        </div>

                    </div>
                </div>
                <!-- 右邊欄位 -->
                <div class="col-md-8">
                    <div class="mx-3">
                        <p>首頁>會員中心</p>
                        <p>歡迎！<span class="text-info"><?php echo $_SESSION['usid']; ?></span> 來到會員中心！</p>
                        <p>請選擇您需要的服務。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap尾巴 -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>