<?php
  session_start();
  
  if(isset($_SESSION["AccountID"])){
    $_SESSION["Page"] = "Contact";
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Contact</title>
    <link rel="icon" href="./Media/logo.jpg">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div id="nav"></div>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 m-auto mt-5 mb-5" id="form__container">
          <div class="heading text-center">
            <h1>Contact Us</h1>
          </div>
        
          <form id="contactForm">
            <input type="text" id="name" name="name" placeholder="Enter your name">
            <input type="email" id="email" name="email" placeholder="Enter your email address">
            <textarea id="message" name="message" placeholder="Write your Message here!"></textarea>
            <button type="submit" id="submitbtn" name="submitbtn">Submit</button>
        </form>

          </form>
        </div>
      </div>
    </div>


    


    <!--footer-->
    <div id="footer"></div>

    <script src="js/getNavFooter.js"></script>
    <script src="js/contact.js"></script>
    
</body>
</html>
