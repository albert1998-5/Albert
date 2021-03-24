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
session_start();  // 啟用交談期

if ((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))) {
    if ($_SESSION['check_word'] == $_POST['checkword']) {
        if (isset($_POST['email'])) {
            //新增會員資料
            $usid = $_POST['uname'];
            $username = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'];
            $gender = $_POST['gender'];
            $addr = $_POST['addr'];
            $insertSQL = sprintf("INSERT INTO users (usid,username,passwd,birthday,gender,addr) VALUES ('%s','%s','%s','%s','%s','%s')", $usid, $username, $password, $birthday, $gender, $addr);
            $result = mysqli_query($link, $insertSQL);
        }
        $_SESSION["login_session"] = "true";
        $sql1 = "SELECT * FROM users WHERE username='" . $username . "'";
        $result1 = mysqli_query($link, $sql1);
        
        // $uid = $result1;
        $data = mysqli_fetch_array($result1);

        $_SESSION["login"] =true;
        $_SESSION["UID"] = $data["UID"];
        $_SESSION["usid"] = $data["usid"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["passwd"] = $data["passwd"];
        $_SESSION["birthday"] = $data["birthday"];
        $_SESSION["gender"] = $data["gender"];
        $_SESSION["addr"] = $data["addr"];
        
        header(sprintf("Location: %s", $root_cust));
    } else {
        header("Location:signup.php");
    }
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- ALL_link -->
    <?php require_once($root_local . "\parts\all_link.php"); ?>
    <link rel="stylesheet" href="signup.css">

    <script src="../../js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.validate.js" type="text/javascript"></script>
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
                    uname: {
                        required: true,
                        maxlength: 50,
                        minlength: 3,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: 'checkemail.php',
                    },
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
                    uname: {
                        required: '使用者名稱不得為空白',
                        maxlength: '帳號最大長度為50位(3-50位英文字母、數字的組合)',
                        minlength: '密碼最小長度為3位(3-50位英文字母、數字的組合)',
                    },
                    email: {
                        required: '信箱不得為空白',
                        email: '信箱格式有誤',
                        remote: '信箱已註冊',
                    },
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

                    birthday: {
                        required: '驗證碼不得為空白',
                    }

                },
                // 指明錯誤放置的位置
                errorPlacement: function(error, element) {
                    error.appendTo(element.parent());
                }


            });

        })
    </script>
    <style>
        .error-tips {
            color: red;
            margin-left: 2px;
        }

        .valid-tips:before {
            content: '驗證通過';
            color: green;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!-- 頁首 -->

    <?php
    /* id=header #header */
    require_once($root_local . "/parts/header.php");
    ?>

    <!-- 主體 -->
    <div id="content">
        <div id="main">
            <!--  -->
            <form name="form1" id="form1" method="post" action="./signup.php">

                <div class="signup_box">
                    <h1 class="title_02" title="加入會員-設定帳號">加入會員</h1>
                    <table>
                        <tr>
                            <th><label for='uname'>會員名稱</label></th>
                            <td>
                                <input type="text" value="" id="uname" name="uname" class="input01" maxlength="50">
                                <p class="remind">請以半形輸入，3-50個字組合。</p>
                                <p class="warn"></p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for='email'>電子郵件</label></th>
                            <td>
                                <input type="text" value="" id="email" name="email" class="input01" maxlength="50">
                                <p class="remind">請以半形輸入，e-mail不能重複註冊。</p>
                                <p class="warn"></p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for='password'>密碼</label></th>
                            <td>
                                <input type="password" value="" id="password" name="password" class="input01" maxlength="12" tabindex="4">
                                <p class="remind">8-12字元，至少2個英文與2個數字。</p>
                                <p class="warn"></p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for='checkpassword'>密碼確認</label></th>
                            <td>
                                <input type="password" value="" id="checkpassword" name="checkpassword" class="input01" maxlength="12">
                                <p class="warn"></p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for='birthday'>生日</label></th>
                            <td>
                                <input type="date" value="" id="birthday" name="birthday" class="input01 bypass" maxlength="20">
                            </td>
                        </tr>
                        <tr>
                            <th><label for='gender'>性別</label></th>
                            <td>
                                <div>
                                    <input type="radio" name="gender" value="F">女
                                    <input type="radio" name="gender" value="M">男
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><label for='addr'>居住地址</label></th>
                            <td>
                                <input type="text" value="" id="addr" name="addr" class="input01 bypass" maxlength="30">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <img id="imgcode" src="captcha.php" onclick="refresh_code()" alt="點選更換" title="點選更換" />
                            </th>
                            <td>
                                <input type="text" name="checkword" id="checkword" class="input01 bypass" required="required" placeholder="請輸入驗證碼（不分大小寫）" maxlength="10" size="6" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="註冊" class="signup_input" /></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>

    </div>
    </form>
    </div>

    <!-- 頁尾 -->


    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>