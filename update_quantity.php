<?php
include_once('database.php');
include_once('products.php');

$productsClass = new CProducts($conn);

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];
    $productsClass->updateProductQuantity($productId, $quantity);
}
?>