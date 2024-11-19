<?php

include_once __DIR__ . "/database.php";

class CProducts
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProducts($limit = 10)
    {
        $sql = "SELECT * FROM Products 
                WHERE IS_HIDDEN = FALSE 
                ORDER BY DATE_CREATE DESC 
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hideProduct($productID)
    {
        $sql = "UPDATE Products 
                SET IS_HIDDEN = TRUE 
                WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$productID]);
    }

    public function updateProductQuantity($productId, $quantity)
    {
        $sql = "UPDATE Products 
                SET PRODUCT_QUANTITY =  ?
                WHERE ID = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$quantity, $productId]);
    }
}