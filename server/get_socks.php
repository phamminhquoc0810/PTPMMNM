<?php

include('config.php');

$stmt = $conn->prepare("SELECT *FROM products WHERE product_category='socks' LIMIT 4");

$stmt->execute();

$socks_product = $stmt->get_result();

?>