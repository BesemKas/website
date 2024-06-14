<?php
session_start();
$mysqli = require __DIR__ . "/database.php";




if($_SERVER['REQUEST_METHOD'] === "POST"){

$name = $_POST['productName'];
$price = $_POST['productPrice'];
$desc = $_POST['productDescription'];
$stock = $_POST['stockQty'];


$sql__AddProduct = "INSERT INTO product(ProductName,ProductPrice,ProductDescription,StockQuantity)
                VALUES (?,?,?,?)";

$add = $mysqli->prepare($sql__AddProduct);
$add->bind_param("sdsi",$name,$price,$desc,$stock);
$add->execute();
header("Location: ../shop.php");
exit();
}