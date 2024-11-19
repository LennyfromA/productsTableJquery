<?php
include_once('database.php');
include_once('products.php');

$productsClass = new CProducts($conn);

if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    $productsClass->hideProduct($productId);
}
?>