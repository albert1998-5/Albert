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

if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
}

$username = "";
$password = "";
// $a="帳號ID或email";
// $b= "密碼 Password" ;
$a = "請輸入帳號Email";
$b = "請輸入密碼Password";


/*確認是否登入*/
if ($_SESSION['login'] && $_SESSION["dept_ID"]) {
    jump_url("/results/control/index.php");
}


/* 搜尋語句 */

if (!isset($_POST['username'])) {
    $username  = "";
    $password = "";
} else {
    $username  = $_POST['username'];
    $password = $_POST['password'];
    /* 
SELECT 
`employee_list`.`UID` ,
`employee_data`.`emp_name` ,
`employee_data`.`dept_ID`
 FROM `employee_data` 
LEFT JOIN `employee_list` ON  `employee_list`.`UID` = `employee_data`.`UID`
LEFT JOIN `dept_list` ON `dept_list`.`dept_ID` = `employee_data`.`dept_ID`
WHERE `employee_list`.`username` = 	'aaa1@gmail.com' && `employee_list`.`passwd` = "123456"
*/


    $prepare_str = " 
SELECT 
`employee_list`.`UID` ,
`employee_data`.`emp_name` ,
`employee_data`.`dept_ID` , 
`dept_list`.`dept_name`

FROM `employee_data` 
LEFT JOIN `employee_list` ON `employee_list`.`UID` = `employee_data`.`UID`
LEFT JOIN `dept_list` ON `dept_list`.`dept_ID` = `employee_data`.`dept_ID`
WHERE `employee_list`.`username` = 	? && `employee_list`.`passwd` = ?
";

    $stmt = $link->prepare($prepare_str);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($UID, $emp_name, $dept_ID,$dept_name);



    /*登入成功*/
    if ($stmt->fetch()) {
        $_SESSION["login"] = true;
        $_SESSION["UID"] = $UID;
        $_SESSION["username"] = $username;
        $_SESSION["passwd"] = $password;

        $_SESSION["dept_ID"] = $dept_ID;
        $_SESSION["dept_ID"] = $dept_name;
        $_SESSION["emp_name"] = $emp_name;

        jump_url("/results/control", "歡迎登入，" .  $emp_name);
    } else {
        echo ("<script>
                    alert('帳號或密碼錯誤');
               </script>
    ");
        // jump_url("/results/control/login/login.php", "帳號或密碼錯誤");
    }
    $stmt->close();
    $link->close();
}




?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- ALL_link -->
    <?php require_once($root_local . "\parts\all_link_control.php"); ?>
    <link rel="stylesheet" href="login.css">
    <style>
        .body {
            background-image: url(<?php echo ($root_cust . "/images/bookstore_abg.jpg"); ?>);
        }
    </style>
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


    <body>
        <div class="body"></div>
        <div class="grad"></div>
        <div class="header">
            <div class="logo">
                <img src="<?php echo $root_cust; ?>/images/book.png" alt="">
                南波灣書局 | 後臺登入
            </div>
            <br>
            <form action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="POST">
                <div class="login">
                    <input type="text" id="username" placeholder="username" name="username" value="<?php echo ($username); ?>"><br>
                    <input type="password" placeholder="password" name="password" id="password" value="<?php echo ($password); ?>"><br>
                    <input type="submit" value="Login" style="width:260px;margin-top:10px;cursor:pointer;">
                </div>
            </form>
        </div>
    </body>
    <!-- 頁尾 -->




</body>

</html>