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
 use PHPMailer\PHPMailer\PHPMailer;
require_once($root_local . "/Connections/connSQL.php");
require_once($root_local . "/script/script.php");
require_once($root_local . "/script/shirt_lib.php");
include("../../PHPMailer/_lib/class.phpmailer.php"); 
?>

<?php
session_start();
//函式：自動產生指定長度的密碼
function MakePass($length)
{
  $possible1 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $possible2 = "0123456789";
  $str1 = "";
  $str2 = "";
  while (strlen($str1) < $length) {
    $str1 .= substr($possible1, rand(0, strlen($possible1)), 1);
  }
  while (strlen($str2) < $length) {
    $str2 .= substr($possible2, rand(0, strlen($possible2)), 1);
  }
  return ($str1 . $str2);
}

//檢查是否為會員
if (isset($_POST["name"])) {
  $name = $_POST["name"];
  //找尋該會員資料
  $query = "SELECT * FROM users WHERE username='" . $name . "'";
  $result = mysqli_query($link, $query);
  $total_records = mysqli_num_rows($result);

  if ($total_records == 0) {
    header("Location: passmail.php?errMsg=1&username={$name}");
  } else {
    //取出帳號密碼的值
    $row_RecFindUser = $result->fetch_assoc();
    $usermail = $row_RecFindUser["username"];
    $userpw = $row_RecFindUser["passwd"];
    //產生新密碼並更新
    $newpasswd = MakePass(4);

    $query_update = "UPDATE users SET passwd='" . $newpasswd . "' WHERE username='" . $usermail . "'";
    $result = mysqli_query($link, $query_update);
    //補寄密碼信
    $mail= new PHPMailer();
    $mail-> IsSMTP();
    $mail-> SMTPAuth=true;
    $mail-> SMTPSecure="ssl";
    $mail-> Host="smtp.gmail.com";
    $mail-> Port=465;
    $mail-> CharSet="utf8";
    $mail-> Username="ulofsix.database@gmail.com";
    $mail-> Password="gbasdfgh!#!$1314";
    $mail-> From="ulofsix.database@gmail.com";
    $mail-> FromName="藍波灣人員";
    $mail-> Subject="補寄密碼信";
    $mail-> Body="您好，<br />您的帳號為：" . $usermail . " <br/>您的新密碼為：" . $newpasswd . " <br/>";
    $mail-> IsHTML(true);
    $mail-> AddAddress($usermail,"藍波灣會員");

    if (!$mail->Send()){
      echo "Mailer Error:".$mail->ErrorInfo;
    }
    else{
      echo "Message sent!";
      header("Location: passmail.php?mailStats=1");
    }
    
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
  <link rel="stylesheet" href="./passmail.css">
  <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
  <script>
    function refresh_code() {
      document.getElementById("imgcode").src = "captcha.php";
    }
  </script>

</head>

<body>
  <!-- 頁首 -->
  <?php
  /* id=header #header */
  require_once($root_local . "/parts/header.php");
  ?>

  <!-- 主體 -->
  <div id="bg">
    <div id="content">
      <div id="menu">

      </div>
      <div id="main">

        <!--  -->

        <?php if (isset($_GET["mailStats"]) && ($_GET["mailStats"] == "1")) { ?>
          <script>
            alert('密碼信補寄成功！');
            header(sprintf("Location: %s", $root_cust));
            // window.location.href = 'index.php';
          </script>
        <?php } ?>
        <form name="form1" method="post" action="">
          <div class="regbox">
            <h2 class="heading">找回密碼</h2>
            <?php if (isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")) { ?>
              <p class="errDiv">沒有這個帳號: <strong><?php echo $_GET["username"]; ?></strong>！</p>
            <?php } ?>
            <table>
              <tr>
                <td>
                  <p>請輸入您申請的帳號，系統將自動產生一個八位數的密碼寄到您註冊的信箱。</p>
                </td>
              </tr>
              <tr>
                <td>
                  <p><strong>帳號</strong>：
                    <input name="name" type="text" class="logintextbox" id="mail">
                  </p>
                </td>
              </tr>
              <tr>
                <td align="center">
                  <input type="submit" name="button" class="input01" id="button" value="寄密碼信">
                  <input type="button" name="button2" class="input01" id="button2" value="回上一頁" onClick="window.history.back();">
                </td>
              </tr>
            </table>
          </div>
        </form>
        </td>
        </tr>
        </table>
      </div>
    </div>
  </div>

  <!-- 頁尾 -->


  <div id="footer">
    Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
  </div>

</body>

</html>