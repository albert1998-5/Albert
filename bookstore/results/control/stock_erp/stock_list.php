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

<div class="card shadow mb-4 book_list">
  <div class="card-header py-3">
    <h4 class="m-2 font-weight-bold text-primary">進銷存管理</h4>
    <!-- <button id="button_not" class="btn btn-sm btn-outline-danger bg-gradient-primary">
      <i class="fas fa-fw fa-list-alt"></i>存量不足顯示
    </button> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="book">
            <th>商品編號</th>
            <th>商品名稱</th>
            <th>作者</th>
            <!-- <th>商品價格</th> -->
            <!-- <th>出版日期</th> -->

            <th>在貨庫存</th>
            <th>預計出貨</th>
            <th>預計進貨</th>
            <th>預計庫存</th>

            <th>安全存量</th>
            <th>存量差額</th>

            <th>進出貨紀錄</th>


          </tr>



        </thead>
        <tbody>

          <?php

          // $query = 'SELECT * FROM `products` 
          // LEFT JOIN `stock` ON  `products`.`P_ID` = `stock`.`P_ID` 
          // ORDER BY `P_data` DESC';
          /* 商品表 */
          $query = 'SELECT `products`.* , `stock`.`in_stock`,`stock`.`safety_stock`,`order_output`.`order_output_qty` , `order_input`.`order_input_qty` FROM `products` 
                    LEFT JOIN `stock` ON  `products`.`P_ID` = `stock`.`P_ID` 
                    /* 預計出貨 */
                    LEFT JOIN
                    (SELECT `order_output_data`.`P_ID`,  SUM(`qty`) AS `order_output_qty`
                    FROM  `order_output_data`                            
                    LEFT JOIN `order_output_list` ON `order_output_data`.`O_ID` = `order_output_list`.`O_ID`
                    WHERE `order_output_list`.`order_status` < 3
                    GROUP BY `P_ID`)  AS `order_output`
                    ON `products`.`P_ID` = `order_output`.`P_ID` 
                    /* 預計出貨 */
                    LEFT JOIN
                    (
                    SELECT `order_input_data`.`P_ID`, SUM(`qty`) AS `order_input_qty`
                    FROM  `order_input_data`           
                    LEFT JOIN `order_input_list` ON `order_input_data`.`O_ID` = `order_input_list`.`O_ID`
                    WHERE `order_input_list`.`order_status` < 5
                    GROUP BY `P_ID`
                    ) AS `order_input`
                    ON `products`.`P_ID` = `order_input`.`P_ID` 
                    ORDER BY `products`.`P_ID`';

          $result = mysqli_query($link, $query) or die(mysqli_error($link));

          while ($row = mysqli_fetch_assoc($result)) {
            /* "實際庫存" - "預計出貨" + "即將進貨" > "安全庫存" */
            $check =  ($row['in_stock'] - $row['order_output_qty'] + $row['order_input_qty']) >= $row['safety_stock'];
            $fact = ($row['in_stock'] - $row['order_output_qty'] + $row['order_input_qty']);
            $need = $row['safety_stock'] -  $fact;


            // if ($check) {
            //   echo ("<td>" . $row['P_ID'] . " " . $check . '</td>');
            // } else {
            //   echo ("<td  class = 'text_red'>" . $row['P_ID'] . '</td>');
            // }

            echo "<tr>";

            echo ("<td>" . $row['P_ID'] . '</td>');


            if ($check) {
              echo ("<td>" . $row['P_name'] . '</td>');
            } else {
              echo ("<td class = 'text_red'>" . $row['P_name'] . '<br>
                
                <a type="button" 
                class="btn btn-sm btn-outline-danger bg-gradient-primary" 
                href="stock_input_order.php?qty=' . $need . '&P_ID=' . $row['P_ID'] . '">
                <i class="fas fa-fw fa-list-alt"></i>存量不足，快速訂貨</a></td>');
            }


            // echo '<td>' . $row['P_name'] . '</td>';
            echo '<td>' . $row['P_author'] . '</td>';

            /* 實際庫存 + 預計進貨 - 預計出貨 = $need*/
            // echo '<td class="text-right">' .
            //   $row['in_stock'] .
            //   '<div class = "text-success">(+' . $row['order_input_qty'] . ")</div>" .
            //   '<div class = "text-danger">(-' . $row['order_output_qty'] . ")</div>" .
            //   '<div class = "text-primary">(=' . $fact . ")</div>" .
            //   '</td>';


            /* 實際庫存 */
            echo '<td>' . $row['in_stock'] . '</td>';
            /* 預計出貨 */
            echo '<td>' . '<div class = "text-success">' . $row['order_output_qty'] . "</div>" . '</td>';
            /* 預計進貨 */
            echo '<td>' . '<div class = "text-info">' . $row['order_input_qty'] . "</div>" . '</td>';

            /* 預計庫存 */
            echo '<td>' . '<div class = "text-primary">' . $fact . "</div>" . '</td>';

            /* 安全存量 */
            echo '<td>' . $row['safety_stock'] . '</td>';
            /* 存量差額 */
            // echo '<td>' . '<div class = "text-danger">' . $need . "</div>" . '</td>';
            if ($check) {
              echo ("<td></td>");
            } else {
              echo '<td>' . '<div class = "text-danger">' . $need . "</div>" . '</td>';
            }



            /* 功能區塊 */
            echo '<td align="right"> <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-primary bg-gradient-primary" 
                  href="stock_log.php?action=edit & P_ID=' . $row['P_ID'] . '">
                  <i class="fas fa-fw fa-list-alt"></i> 歷史紀錄</a>';
            echo '</tr> ';
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

<script>
  $(function() {
    let Search = $("input.form-control.form-control-sm");
    console.log(Search);


    $("#button_not").bind("click", function() {
      // alert("存量不足");

      Search.val("存量不足");
    });
  });
</script>