<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>南波灣書局 | 管理後臺</title>
<!-- ALL_link -->

<?php
if (!isset($GLOBALS['root_cust'])) {
    $GLOBALS['root_cust'] = "/bookstore";
    $GLOBALS['root_local'] = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['root_cust'];
}
require_once($GLOBALS['root_local'] . "/parts/all_link.php");
?>


<!-- Bootstrap CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<!-- Custom fonts for this template-->
<link href="<?php echo $root_cust; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


<!-- Custom styles for this page -->
<link href="<?php echo $root_cust; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<link rel="stylesheet" href="<?php echo $root_cust; ?>/results/control/control.css">