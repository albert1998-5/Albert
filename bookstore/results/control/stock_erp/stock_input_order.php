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
/*輸入表單*/
$check = false;
if (($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['P_ID']) && isset($_POST['qty'])) {
    if ($_POST['P_ID'] != 0 && $_POST['qty'] != 0) {
        $check = true;
    }
}


if ($check) {
    $UID = $_SESSION['UID'];
    $P_ID = $_POST['P_ID'];
    $qty = $_POST['qty'];

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

    
}


?>


<?php
/*擷取資料*/
if (isset($_GET['P_ID'])) {
    $P_ID = $_GET['P_ID'];
} else {
    jump_url("/results/control/stock_erp/stock_list.php");
}

if (isset($_GET['qty'])) {
    $qty = $_GET['qty'];
} else {
    $qty = 10;
}

$query = sprintf("SELECT * FROM products WHERE P_ID = %d", $P_ID);
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);


?>


<center>
    <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
        <div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary">訂單請求</h4>
        </div>
        <a href="stock_list.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
        <form class="card-body" action="#" method="post" name="form1" id="form1">


            <div class="form-group row text-left">
                <div class="col-sm-3 offset-3 text-primary ">
                    <h5>
                        商品代碼<br>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <h5>
                        : <input type="text" name="P_ID" id="P_ID" readonly value="<?php echo $row['P_ID']; ?> "><br>

                    </h5>
                </div>
            </div>
            <div class="form-group row text-left">
                <div class="col-sm-3 offset-3 text-primary">
                    <h5>
                        商品名稱<br>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <h5>
                        : <?php echo $row['P_name']; ?> <br>
                    </h5>
                </div>
            </div>
            <div class="form-group row text-left">
                <div class="col-sm-3 offset-3 text-primary">
                    <h5>
                        價格<br>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <h5>
                        : <input type="text" name="P_price" id="P_price" readonly value="<?php echo $row['P_price']; ?> "><br>
                    </h5>
                </div>
            </div>
            <label class="form-group row text-left" for="qty">

                <div class="col-sm-3 offset-3 text-primary">
                    <h5>
                        數量<br>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <h5>
                        : <input type="text" name="qty" id="qty" value="<?php echo $qty; ?>"><br>
                    </h5>
                </div>

            </label>

            <div class="form-group row text-left">
                <div class="col-sm-3 offset-3 text-primary">
                    <h5>
                        總價<br>
                    </h5>
                </div>
                <div class="col-sm-6">
                    <h5>
                        <!-- : <input type="text" name="total" id="total" value=""><br> -->
                        <div id="total">: <?php echo $qty * $row['P_price']; ?></div><br>
                    </h5>
                </div>
            </div>
            <!-- <input class="btn btn-primary bg-gradient-primary btn-block col-sm-3 " type="submit" value="GO"> -->

            <button id="btn_sub" type="button" class="btn btn-primary bg-gradient-primary btn-block col-sm-3 ">送出 <i class="fas fa-flip-horizontal fa-fw fa-share"></i></button>

        </form>
    </div>
</center>



<!-- main_end -->
<!-- footer_start -->
<?php
require_once($root_local . "/parts/footer_control.php");
?>

<script>
    $(function() {
        $("#qty").bind("input ppropertychange", function() {
            console.log($(this).val());
            // $("#total").val() = $(this).val();
            $("#total").html(": " + ($("#qty").val() * $("#P_price").val()));
        });

        $("#btn_sub").click(function() {
            // console.log("heeeeelololooooooo");
            let error_code = 0;

            if ($("#P_ID").val() == 0) {
                error_code = 1;
            }

            if ($("#qty").val() == 0) {
                error_code = 2;
            }

            if (!error_code) {
                if (confirm("即將送出訂單")) {
                    $("#form1").submit();
                } else {

                }
            } else {
                alert("錯誤:" + error_code);
            }



        });

    });
</script>