<?php
// 路徑設置
if (!isset($root_cust)) {
    $root_cust = "/bookstore";
    $root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
}
?>


<!-- <link rel="stylesheet" href="main.css"> -->
<link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">
<!-- 楷書體 -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;500;700&display=swap" rel="stylesheet">
<!-- 正黑體 -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">

<!-- LOGO -->
<link rel="shortcut icon" href="<?php echo $root_cust; ?>/images/book-2.png">
<link rel="bookmark" href="<?php echo $root_cust; ?>/images/book-2.png">


