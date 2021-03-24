<?php
class cart_factory
{
    public $link;
    function __construct($link)
    {
    }
}



?>

<?php
/* 路徑設置 */
if (!isset($GLOBALS['root_cust'])) {
    $GLOBALS['root_cust'] = "/bookstore";
    $GLOBALS['root_local'] = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root_cust'];
}

/* SQL連線 */
if (!isset($link)) {
    require_once($GLOBALS['root_local'] . "/Connections/connSQL.php");
}



