<?php


$mysqli = require __DIR__ ."/database.php";

$sql_getProducts = "SELECT * FROM product";


$result=$mysqli->query($sql_getProducts);

$products=[];



while($row = $result->fetch_assoc()){
    $products[] = $row;

}

foreach ($products as $product) {
    echo "<article class='product'>";
    echo "<div>";
    echo "<h3><strong>{$product['ProductName']}</strong></h3>";
    echo "<img src='Media/placeholder.jpg' alt='' />";
    echo "<p>R {$product['ProductPrice']}</p>";
    echo "</div>";
    echo "<p>{$product['ProductDescription']}</p>";
    echo "<div>";
    echo "<p>{$product['StockQuantity']} in Stock</p>";
    echo "<form action='phpScripts/.php' method='post'>";
    echo "<input type='hidden' name='productID' value='{$product['ProductID']}'>";
    echo "<button type='submit'>Add to Cart</button>";
    echo "</form>";
    echo "</div>";
    echo "</article>";
}