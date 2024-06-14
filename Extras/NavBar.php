<?php
  session_start();
  
  if(isset($_SESSION["AccountID"])){
    if($_SESSION["Page"] == "Account"){
      $buttonFunction = "Logout";
      $buttonAction = "phpScripts/logout.php";
    }
    else{
      $buttonFunction = "Account";
      $buttonAction = "Account.php";
    }

  }
  else{
    $buttonFunction ="Members";
    $buttonAction = "memberland.php";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <link rel="stylesheet" href="./css/nav-footer.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    
</head>
<body>
  <nav class="navbar">
    <div class="navbar__container">
      <a href="#" id="navbar__logo"><img src="./Media/logo.png" alt="washmore logo" id="navlogo"> Washmore</a>
      
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>

      <ul class="navbar__menu">
        <li class="navbar__item">
          <a href="index.php" class="navbar__links">Home</a>
        </li>
        <li class="navbar__item">
          <a href="Shop.php" class="navbar__links">Shop</a>
        </li>
        <li class="navbar__item">
          <a href="Services.html" class="navbar__links">Services</a>
        </li>
        <li class="navbar__item">
          <a href="contact.php" class="navbar__links">Contact</a>
        </li>
        <li class="navbar__btn">
          <a href="<?= $buttonAction?>" class="button"><?= $buttonFunction?></a>
        </li>
      </ul>
    </div>
  </nav>

  <?php
    header("Content-Type: text/html")
  ?>
  
</body>
</html>