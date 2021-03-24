<?php 
$id=1;

$query = sprintf("SELECT * FROM `products`, `type_list` WHERE products.P_type_id= type_list.P_type_id AND products.P_ID = $id");


// $query = sprintf("SELECT * FROM `products`, `type_list` WHERE products.P_type_id= type_list.P_type_id AND products.P_ID = %d",$id);

echo $query;

?>