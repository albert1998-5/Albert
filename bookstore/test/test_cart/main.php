<?php
require_once($root_local."/Connections/connSQL.php")
?>

<?PHP
$query = "Select * FROM products ORDER BY SID";
$result = mysqli_query($link, $query);
?>


<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <?php
    while ($data = mysqli_fetch_array($result)) {
        echo ('<li>' . $data['cname'] . '</li>');
    }


    ?>

</body>

</html>