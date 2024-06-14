<?php
session_start();



$_SESSION["Page"] = "Shop";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link rel="icon" href="./Media/logo.jpg" />
    <link rel="stylesheet" href="css/shop.css" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
  </head>
  <body>
    <div id="nav"></div>

    <div class="container-fluid" id="product__grid">
      <?php include "phpScripts/getProducts.php"?>

      <?php if (isset($_SESSION['AccountID'])){
          include "phpScripts/getUser.php";
          if($account["AccountType"] === "Admin"){
            echo "<button id='Addbtn' name='Addbtn' onclick='openProdForm()'>Add Product</button>";
          }
        }
      ?>
         
        

    </div>
    <div class="addProduct__container" id="addProduct__container">
                        <h2>Add New Product</h2>
                        <form action="phpScripts/addProduct.php" id="addProductForm" method="post">
                            
                            <input type="text" name="productName" id="productName" placeholder="Enter the Product Name.">
                            <input type="text" name="productPrice" id="productPrice" placeholder="Enter the Procuct Price.">
                            <input type="text" name="productDescription" id="productDescription" placeholder="Enter a Product Description.">
                            <input type="text" name="stockQty" id="stockQty" placeholder="Enter the Stock Quantity.">
                            
                            

                            <button type="submit" class="btn Add">Add</button>
                            <button type="button" class="btn cancel" onclick="closeProdForm()">Cancel</button>
                        </form>
                    </div>

    <div id="footer"></div>

    <script src="js/getNavFooter.js"></script>
    <script src="js/popupform.js"></script>
  </body>
</html>
