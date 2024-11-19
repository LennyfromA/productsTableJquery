<?php

$host = 'localhost';
$dbname = 'vedeta_bd';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $exception) {
    echo "Error: " . $exception->getMessage();
    die();
}

function init_db($conn)
{
    $conn->exec("CREATE TABLE IF NOT EXISTS Products (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        PRODUCT_ID INT NOT NULL,
        PRODUCT_NAME VARCHAR(255) NOT NULL,
        PRODUCT_PRICE DECIMAL(10, 2) NOT NULL,
        PRODUCT_ARTICLE VARCHAR(50) NOT NULL,
        PRODUCT_QUANTITY INT NOT NULL,
        DATE_CREATE TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        IS_HIDDEN TINYINT(1) DEFAULT 0
    );");
}

// Инициализация базы данных
init_db($conn);


