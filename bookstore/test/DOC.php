<?php
$servername = "localhost";
// $servername = "192.168.20.4";
$username = "bookstore";
$password = "123456";
$database = "bookstore";

/* 參數位置 */
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $database = "database";

/* Create connection */
$link = new mysqli($servername, $username, $password, $database);
// $link = mysqli_connect($servername, $username, $password, $database);



/* 連線失敗 */
if (mysqli_connect_errno()) {
    echo "連線失敗：" . mysqli_connect_error();
    $link = null;
    exit();
} else {
    /* 設定編碼 */
    mysqli_query($link, "SET NAMES utf8");
}

?>
<?php
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";
/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
/* id=header #header */
require_once($root_local . "/parts/header_control.php");
?>
<!-- main_start -->

<?php
$UID = 888;
$P_ID = 2886;
$qty = 66;

/*新增訂單列表*/
$query = "INSERT INTO `order_input_list` 
(`UID_request`) 
VALUES (?)";
$stmt =  $link->prepare($query);
$stmt->bind_param("i", $UID);
$stmt->execute();
/* 獲取訂單列表編號 */
$O_ID = $stmt->insert_id;
$stmt->close();

$query = "INSERT INTO `order_input_data` (`O_ID` ,`P_ID`, `qty`) VALUES (?,?,?);";
$stmt =  $link->prepare($query);
$stmt->bind_param("iii", $O_ID, $P_ID, $qty);
$stmt->execute();
$stmt->close();




?>

<!-- main_end -->