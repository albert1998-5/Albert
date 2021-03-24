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
    <link rel="stylesheet" href="../user.css">

    <!-- javascript腳本 -->
    <script type="text/javascript">
        $(function() {
            jQuery.validator.addMethod("warnpassword", function(value, element, param) {
                var warnpassword = /^(?=.*[a-zA-Z])(?=.*[a-zA-Z])(?=.*\d)(?=.*\d)[a-zA-Z\d]{8,}$/;
                return this.optional(element) || (warnpassword.test(value));
            }, "至少2個英文與2個數字且不含空白、雙引號、單引號、星號");

            //自訂規則 
            $('#form1').validate({
                ignore: ".bypass",
                rules: {
                    password: {
                        required: true,
                        maxlength: 12,
                        minlength: 8,
                        warnpassword: true,
                    },
                    checkpassword: {
                        required: true,
                        equalTo: '#password',
                    },

                },
                messages: {
                    password: {
                        required: '密碼不得為空白',
                        maxlength: '密碼最大長度為12位(8-12位英文字母、數字的組合)',
                        minlength: '密碼最小長度為8位(8-12位英文字母、數字的組合)',
                        warnpassword: '至少2個英文與2個數字，不含空白、雙引號、單引號、星號',
                    },
                    checkpassword: {
                        required: '確認密碼不得為空白',
                        equalTo: '兩次輸入的密碼不一致',
                    },
                },
                // 指明錯誤放置的位置
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent());
                }
            });
        })
    </script>
    
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
                            <a href="changePw.php" class="list-group-item list-group-item-action">密碼修改</a>
                            <a href="infoUp.php" class="list-group-item list-group-item-action">資料更新</a>
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
                        <p><a href="../user.php" class="text-info">會員中心</a> >會員資料管理</p>
                        <p><h5>密碼修改：</h5></p>
                        <form name="form1" id="form1" method="post" action="changePw.php" class="mx-3">
                            <p><input class="form-control" type="password" placeholder="請輸入您的原始密碼：" required ></p>
                            <p><input class="form-control" type="password" placeholder="請輸入您更新的密碼：" required >
                            <small id="emailHelp" class="form-text text-muted">請輸入8-12個字符，由英文及阿拉伯數字組成，請勿使用特殊符號。</small></p>
                            <p><input class="form-control" type="password" placeholder="請再次輸入您更新的密碼：" required ></p><br>
                            <p>
                            <button type="submit" class="btn btn-outline-info">確認修改</button>
                            &emsp;&emsp;
                            <button type="reset" class="btn btn-outline-info">重新輸入</button>
                            </p>
                        </form>
                        
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