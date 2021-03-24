<?php
    $p_username = $_POST["username"];
    $p_password = $_POST["password"];
    $p_email = $_POST["email"];



    $servername = "localhost";
    $username = "admin";
    $password = "123456";
    $dbname = "member";

    //建立連線
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    //確認連線是否成功
    if(!$conn){
        die("連線錯誤".mysqli_connect_error());
    }

    $sql = "INSERT INTO userdata(Username, Password, Email) VALUES('$p_username', '$p_password', '$p_email')";

    if(mysqli_query($conn, $sql)){
        echo "success";
    }else{
        echo "failed!".mysqli_error($conn);
    }

    mysqli_close($conn);
?>