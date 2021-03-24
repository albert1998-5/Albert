<?php
$host = "localhost";
$username = "bookstore";
$passwd = "123456";
$dataname = "test";
$link = new mysqli($host, $username, $passwd, $dataname);


if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
} else {
    die("NO post!");
}

if ($link->connect_errno) {
    die("連線錯誤:" . $link->connect_errno);
}



$query_str = "SELECT * FROM userdata";
$query = $link->query($query_str);


while ($row = $query->fetch_assoc()) {
    echo ($row["ID"] .
        "  " .
        $row["username"] .
        "  " .
        $row["password"] .
        "  " .
        $row["email"] .
        "  " .
        $row["created_data"] . "<br>");
}

$query_str = "INSERT INTO userdata(`username`,`password` , `email`) value (?,?,?)";
$stmt =  $link->prepare($query_str);
$stmt->bind_param("sss", $username, $password, $email);

if ($stmt->execute()) {
    echo ("新增成功");
}

$stmt->close();

$link->close();
