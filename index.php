<?php
include_once('database.php');
include_once('products.php');

$productsClass = new CProducts($conn);
$products = $productsClass->getProducts(10);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="table-container">
    <h1 class="text-center">Products</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">PRODUCT_ID</th>
            <th scope="col">PRODUCT_NAME</th>
            <th scope="col">PRODUCT_PRICE</th>
            <th scope="col">PRODUCT_ARTICLE</th>
            <th scope="col">PRODUCT_QUANTITY</th>
            <th scope="col">DATE_CREATE</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr data-id="<?php echo $product['ID']; ?>">
                <td><?php echo $product['ID']; ?></td>
                <td><?php echo $product['PRODUCT_ID']; ?></td>
                <td><?php echo $product['PRODUCT_NAME']; ?></td>
                <td><?php echo $product['PRODUCT_PRICE']; ?></td>
                <td><?php echo $product['PRODUCT_ARTICLE']; ?></td>
                <td>
                    <div class="quantity-controls">
                        <button class="badge rounded-pill text-bg-success quantity-btn" data-action="plus">+</button>
                        <span class="quantity"><?php echo $product['PRODUCT_QUANTITY']; ?></span>
                        <button class="badge rounded-pill text-bg-danger quantity-btn" data-action="minus">-</button>
                    </div>
                </td>
                <td><?php echo $product['DATE_CREATE']; ?></td>
                <td>
                    <button class="hide-btn">Скрыть</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $(".hide-btn").click(function () {
            var row = $(this).closest("tr");
            var productId = row.data("id");

            $.ajax({
                url: "hide_product.php",
                method: 'POST',
                data: {id: productId},
                success: function (response) {
                    row.hide();
                }
            });
        });

        $(".quantity-btn").click(function () {
            var row = $(this).closest("tr");
            var productId = row.data("id");
            var quantityElement = row.find(".quantity");
            var currentQuantity = parseInt(quantityElement.text());
            var action = $(this).data("action");

            if (action === "plus") {
                currentQuantity += 1;
            } else if (action === "minus" && currentQuantity > 0) {
                currentQuantity -= 1;
            }

            quantityElement.text(currentQuantity);

            $.ajax({
                url: 'update_quantity.php',
                method: 'POST',
                data: {id: productId, quantity: currentQuantity},
                success: function (response) {
                    console.log("Quantity updated");
                }
            });
        });
    });
</script>
</body>
</html>