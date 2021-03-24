<?php
$mysqli = new mysqli("localhost", "bookstore", "123456", "bookstore");



$stmt = $mysqli->prepare("SELECT * FROM `products` ");
$stmt->execute();

/* get resultset for metadata */
$result = $stmt->result_metadata();

/* retrieve field information from metadata result set */
$field = $result->fetch_field();
print_r($field->name);
// printf("Fieldname: %s \n", $field->name);

/* close resultset */
$result->close();

/* close connection */
$mysqli->close();
?>