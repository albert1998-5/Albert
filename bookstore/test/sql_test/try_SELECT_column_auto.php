<?php
require_once("../Connections/connSQL.php");

$query = "SELECT * FROM products WHERE `P_name` LIKE ?";
// $query ="SELECT * FROM products";

if ($stmt = $link->prepare($query)) {

    $keyword = "%%";
    $stmt->bind_param("s", $keyword);



    $stmt->execute();
    // 必須 全部接收
    // $stmt->bind_result($P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);

    // while ($stmt->fetch()) {
    //     printf("%s (%s,%s,%s,%s,%s,%s,%s,%s)\n<br>", $P_ID, $P_name, $P_author, $P_price, $P_type_id, $P_NO, $P_content, $P_data, $P_ISBN);
    // }


    //Snip use normal methods to get to this point
    // $stmt->execute();
    $metaResults = $stmt->result_metadata();
    $fields = $metaResults->fetch_fields();
    $statementParams = '';
    //build the bind_results statement dynamically so I can get the results in an array
    foreach ($fields as $field) {
        if (empty($statementParams)) {
            $statementParams .= "\$column['" . $field->name . "']";
        } else {
            $statementParams .= ", \$column['" . $field->name . "']";
        }
    }

    echo ($statementParams);
    echo ("<br>");

    $statment = "\$stmt->bind_result($statementParams);";
    eval($statment);
    while ($stmt->fetch()) {
        //Now the data is contained in the assoc array $column. Useful if you need to do a foreach, or
        //if your lazy and didn't want to write out each param to bind.
        print_r($column);
        echo ("<br>");
    }

    printf("Number of rows: %d.\n", $stmt->num_rows);
    // Continue on as usual.
    $stmt->close();
}
$link->close();
