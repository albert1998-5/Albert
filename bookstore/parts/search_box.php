<?php
if (!isset($root_cust)) {
    $root_cust = "/bookstore";
    $root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
}

/* 主類別表 */
require_once($root_local . "/script/UL6_database_type_list.php");

$PHP_SELF = htmlspecialchars($_SERVER["PHP_SELF"]);

if (!isset($_GET['keyword'])) {
    $keyword = "";
} else {
    $keyword = htmlspecialchars($_GET['keyword']);
}


?>

<div class="book_list">
    <div class="title">
        多重搜尋
    </div>
    <div>
        <form action="<?php echo $PHP_SELF; ?>" method="GET">
            <input type="text" class="inputkeyword input_border0 ui-autocomplete-input" id="keyword" name="keyword" maxlength="50" placeholder="可搜尋書名" autocomplete="off" value="<?php echo $keyword; ?>">
            <select name="P_type_id" id="P_type_id">
                <!-- <option value='0'>全部</option> -->
                <?php
                foreach ($type_list as $data) {
                    echo ("<option value='" . $data["P_type_id"]);
                    if ($data["P_type_id"] == $_GET["P_type_id"]) {
                        echo "' selected  >";
                    } else {
                        echo "'>";
                    }
                    echo ($data["P_type_name"] . "</option>");
                }
                ?>
            </select>
            <input name="button" type="submit" class="type1" id="button" value="搜尋" />


        </form>
    </div>
</div>