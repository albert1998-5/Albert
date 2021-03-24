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

if (isset($_GET['P_ID'])) {
    $P_ID = $_GET['P_ID'];
} else {
    $P_ID = 0;
}
$query = sprintf(
    "SELECT * 
     FROM `order_input_data`
     LEFT JOIN 
     `order_input_list` 
     ON 
     `order_input_data`.`O_ID`  = `order_input_list`.`O_ID`

     LEFT JOIN 
     `products` 
     ON 
     `order_input_data`.`P_ID` = `products`.`P_ID`

     WHERE `products`.`P_ID` = %d

     ORDER BY `order_input_list`.`order_date` DESC",
    $P_ID
);
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$row = mysqli_fetch_assoc($result);
?>

<div class="card shadow mb-4 book_list">
    <div class="card-header py-3">
        <h4 class="m-2 font-weight-bold text-primary">
            商品銷售紀錄&nbsp;<a href="stock_input_order.php?P_ID=<?php echo $P_ID; ?>" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="book">
                        <th>訂單編號</th>
                        <th>流水編號</th>
                        <th>進出貨</th>

                        <th>數量</th>
                        <th>日期</th>



                    </tr>



                </thead>
                <tbody>


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

                    echo "
                        <h5 class='m-2 font-weight-bold text-primary'>
                        商品名稱：" . $row['P_name'] . "<br>" .
                        "商品編號：" . $row['P_ID'] .
                        "</h5>";
                    do {

                        echo "<tr class='text-info'>";

                        /* 訂單編號 */
                        echo '<td>' .  $row['O_ID'] . '</td>';
                        /* 流水編號 */
                        echo '<td>' . $row['O_data_ID'] . '</td>';
                        /* 進出貨 */
                        echo '<td>進貨</td>';
                        /* 數量 */
                        echo '<td>' . $row['qty'] . '</td>';
                        /* 日期 */
                        echo '<td>' . $row['order_date'] . '</td>';

                        echo "</tr>";
                    } while ($row = mysqli_fetch_assoc($result));



                    $query = sprintf(
                        "SELECT * 
                       FROM `order_output_data`
                       LEFT JOIN 
                       `order_output_list` 
                       ON 
                       `order_output_data`.`O_ID`  = `order_output_list`.`O_ID`

                       LEFT JOIN 
                       `products` 
                       ON 
                       `order_output_data`.`P_ID` = `products`.`P_ID`

                       WHERE `products`.`P_ID` = %d

                       ORDER BY `order_output_list`.`order_date` DESC",
                        $P_ID
                    );
                    $result = mysqli_query($link, $query) or die(mysqli_error($link));

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr class='text-success'>";

                        /* 訂單編號 */
                        echo '<td>' .  $row['O_ID'] . '</td>';
                        /* 流水編號 */
                        echo '<td>' . $row['O_data_ID'] . '</td>';
                        /* 進出貨 */
                        echo '<td>出貨</td>';
                        /* 數量 */
                        echo '<td>' . $row['qty'] . '</td>';
                        /* 日期 */
                        echo '<td>' . $row['order_date'] . '</td>';

                        echo "</tr>";
                    }

                    ?>







                </tbody>
            </table>
        </div>
    </div>
</div>







<!-- main_end -->
<!-- footer_start -->
<?php
require_once($root_local . "/parts/footer_control.php");
?>