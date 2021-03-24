<?php
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["cellphone"])) {
    if ($_POST["username"] != "" && $_POST["password"] != "" && $_POST["email"] != "" && $_POST["cellphone"] != "") {
        //前端資料欄位
        $p_username = $_POST["username"];
        $p_password = $_POST["password"];
        $p_email = $_POST["email"];
        $p_cellphone = $_POST["cellphone"];


        $servename = "localhost";
        $username = "root";
        $password = "123456";
        $dbname = "member";

        //連接資料庫
        $conn = mysqli_connect($servename, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO userdata(username,password,email,cellphone) VALUES ('$p_username','$p_password','$p_email','$p_cellphone')";

        if (mysqli_query($conn, $sql)) {
            echo "successful";
        } else {
            echo "failed" . mysqli_error($conn);
        }
        mysqli_close($conn);
    } else {
        echo "不允許空白";
    }
} else {
    echo "不允許未定義的欄位";
}
?>