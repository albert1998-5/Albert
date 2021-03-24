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
$name = "";
$password = "";
// $a="帳號ID或email";
// $b= "密碼 Password" ;
$a = "請輸入帳號Email";
$b = "請輸入密碼Password";

if (isset($_SESSION['UID']) && $_SESSION['UID'] != 0) {
    header(sprintf("Location: %s", $root_cust));
}

// $_SESSION["login_session"]存在且== "false"
if ((isset($_SESSION["login_session"])) && ($_SESSION["login_session"] == "false")) {
    $a = "使用者Email或密碼錯誤!";
    $b = "使用者Email或密碼錯誤!";
} else {
    $a = "請輸入帳號Email";
    $b = "請輸入密碼Password";
}

// 檢核驗證碼
if ((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))) {

    if ($_SESSION['check_word'] == $_POST['checkword']) {
        $_SESSION['check_word'] = '';
        header('content-Type: text/html; charset=utf-8');
        // 取得表單欄位值
        if (isset($_POST["name"]))
            $name = $_POST["name"];
        if (isset($_POST["password"]))
            $password = $_POST["password"];

        // 檢查是否輸入使用者名稱和密碼
        if ($name != "" && $password != "") {
            // 建立MySQL的資料庫連接 
            $link = mysqli_connect(
                "localhost",
                "bookstore",
                "123456",
                "bookstore"
            )
                or die("無法開啟MySQL資料庫連接!<br/>");

            //送出UTF8編碼的MySQL指令
            mysqli_query($link, 'SET NAMES utf8');

            // 建立SQL指令字串
            $sql = "SELECT * FROM users WHERE passwd='";
            $sql .= $password . "' AND username='" . $name . "'";
            // echo $name;
            // echo $password;
            // 執行SQL查詢
            $result = mysqli_query($link, $sql);
            $total_records = mysqli_num_rows($result);

            // 是否有查詢到使用者記錄
            if ($total_records > 0) {
                // 成功登入, 指定Session變數
                $_SESSION["login_session"] = "true";
                $sql1 = "SELECT * FROM users WHERE username='" . $name . "'";
                $result1 = mysqli_query($link, $sql1);

                // $uid = $result1;
                $data = mysqli_fetch_array($result1);


                $_SESSION["login"] = true;
                $_SESSION["UID"] = $data["UID"];
                $_SESSION["usid"] = $data["usid"];
                $_SESSION["username"] = $data["username"];
                $_SESSION["passwd"] = $data["passwd"];
                $_SESSION["birthday"] = $data["birthday"];
                $_SESSION["gender"] = $data["gender"];
                $_SESSION["addr"] = $data["addr"];


                header(sprintf("Location: %s", $root_cust));
            } else {
                // 登入失敗
                // echo "<center><font color='red'>";
                $_SESSION["login_session"] = "false";
                header("Location:login.php");
                // echo '<meta http-equiv="refresh" content="1; url=./login.php">';                    
                // echo "</font>";

            }
            mysqli_close($link);  // 關閉資料庫連接 

            exit();
        } else {
            $_SESSION["login_session"] = "1";
            // 如果$name和 $password 為空值
            // echo '<p> </p><p> </p><a href="./index.html">Error輸入錯誤，將於一秒後跳轉(按此也可返回)</a>';
            // echo '<meta http-equiv="refresh" content="1; url=./index.html">';
        }
    } else {
        // 驗證碼錯誤
        $_SESSION["login_session"] = "2";
        header("Location:login.php");
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
    <link rel="stylesheet" href="login.css">
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script>
        function refresh_code() {
            document.getElementById("imgcode").src = "captcha.php";
        }
    </script>

</head>

<body>
    <!-- 頁首 -->


    <!-- 主體 -->
    <div id="bg">
        <div id="content">
            <div id="menu">

            </div>
            <div id="main">

                <!--  -->
                <form name="form1" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <div class="login_box">
                        <h2 class="form-signin-heading">Welcome Back!</h2>
                        <table>
                            <tr>
                                <td>
                                    <input type="text" name="name" id="name" value="" class="input01" required="required" placeholder="<?php echo $a ?>" maxlength="50" size="15" autocorrect="off" autocapitalize="none">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" id="password" class="input01" required="required" placeholder="<?php echo $b ?>" maxlength="12" size="15">

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="checkword" id="checkword" class="input01" required="required" placeholder="請輸入驗證碼" maxlength="10" size="6" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img id="imgcode" src="captcha.php" onclick="refresh_code()" alt="點選更換" title="點選更換" />
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="submit" value="登入" class="login_input" /></td>
                            </tr>
                        </table>
                        <div>
                            <ul class="ask_box">
                                <li><a href="passmail.php">忘記帳號密碼</a></li>
                                <li>| &nbsp; 還不是會員?<a href="signup.php">加入會員</a></li>
                            </ul>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <body>
        <div class="body"></div>
        <div class="grad"></div>
        <div class="header">
            <div class="logo"><img src="./images/icon/logo_Lbg.png" alt="南波灣書局"> </div>
        </div>
        <br>
        <div class="login">
            <input type="text" placeholder="username" name="user"><br>
            <input type="password" placeholder="password" name="password"><br>
            <input type="submit" value="Login" style="width:260px;margin-top:10px;cursor:pointer;">
        </div>
    </body>
    <!-- 頁尾 -->


    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>