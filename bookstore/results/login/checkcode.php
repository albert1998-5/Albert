<?php
if (!isset($_SESSION)) {
    session_start();
}  //判斷session是否已啟動

if ((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))) {  //判斷此兩個變數是否為空

    if ($_SESSION['check_word'] == $_POST['checkword']) {

        $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值

        include("Connections/connSQL.php"); //連結資料庫
        $name = $_POST['name']; //post獲得使用者名稱錶單值
        $passowrd = $_POST['password']; //post獲得使用者密碼單值
        if ($name && $passowrd) { //如果使用者名稱和密碼都不為空
            $sql = "select * from users where username = '$name' and passwd='$passowrd'"; //檢測資料庫是否有對應的username和password的sql
            $result = mysqli_query($link,$sql); //執行sql
            $rows = mysqli_num_rows($result); //返回一個數值
            if ($row>0) { //0 false 1 true
                header("refresh:0;url=welcome.html"); //如果成功跳轉至welcome.html頁面
                exit;
            } else {
                echo "使用者名稱或密碼錯誤";
                // echo "
                // <script>
                // setTimeout(function(){window.location.href='login.html';},1000);
                // </script>
                // ";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
            }
        } else {
            //如果使用者名稱或密碼有空
            echo "表單填寫不完整";
            // echo "
            // <script>
            // setTimeout(function(){window.location.href='login.html';},1000);
            // </script>";
            //如果錯誤使用js 1秒後跳轉到登入頁面重試;
        }
        mysqli_close($link); //關閉資料庫

        // echo '<p> </p><p> </p><a href="./login.php">OK輸入正確，將於一秒後跳轉(按此也可返回)</a>';
        // //   echo '<p> </p><p> </p><a href="./chptcha_index.php">OK輸入正確，將於一秒後跳轉(按此也可返回)</a>';
        // echo '<meta http-equiv="refresh" content="5; url=./login.php">';



        exit();
    } else {
        echo '<p> </p><p> </p><a href="./login.html">Error輸入錯誤，將於一秒後跳轉(按此也可返回)</a>';
        echo '<meta http-equiv="refresh" content="1; url=./login.html">';
    }
}
