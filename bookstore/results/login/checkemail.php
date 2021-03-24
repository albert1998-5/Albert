<?php
$root_cust = "/bookstore";
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
require_once($root_local . "/Connections/connSQL.php");

if(isset($_GET['email'])){
    $email=$_GET['email'];
    $query="SELECT UID FROM `users` WHERE `username`='".$email."'";
    $result=mysqli_query($link,$query);
    $row=mysqli_num_rows($result);
    if($row==0){
        echo 'true';
        return;
    }
}
echo 'false';
return;
?>