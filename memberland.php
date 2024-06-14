<?php
 session_start();

 if(isset($_SESSION["loginErr"]))
 {
  $errorMessage = $_SESSION["loginErr"];
  $enteredEmail = $_SESSION["enteredEmail"] ?? ''; // = $_SESSION["enteredEmail"] if set , ='' if not set.
  
  

 }
 else{
  $errorMessage = "";
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Portal</title>
    <link rel="stylesheet" href="css/memberland.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/memberland.js" defer></script>
    
</head>

<body>
  <div id="nav"></div>

    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-5 m-auto" id="formCol">
          <input type="checkbox" name="checkbox" id="checkbox" aria-hidden="true" <?php echo isset($_SESSION["loginErr"]) ? 'checked="checked"' : ''; ?>>

          <!-- signup form -->
          <form action="phpScripts/process_Signup.php" class="signup" id="signup" method="post" novalidate>

            <label for="checkbox">Signup Now</label>
            <p class="text-center text-muted lead">It's Quick and Free!</p>
            
            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="Firstname" id="Firstname" placeholder="Name">
                <input type="text" class="form-control" name="Lastname" id="Lastname" placeholder="Surname">
              </div>
              <div class="errordisp"></div>
            </div>

            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input type="text" class="form-control"  name="email" id="email" placeholder="Email Address">
              </div>
              <div class="errordisp"></div>
            </div>

            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="phoneNum" id="phoneNum" placeholder="Phone Number">
              </div>
              <div class="errordisp"></div>
            </div>

            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
              <div class="errordisp"></div>
            </div>
            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="passwordCon" id="passwordCon" placeholder="Confirm Password">
              </div>
              <div class="errordisp"></div>
            </div>
            <div class="d-grid">
              <button type="submit">Signup Now</button>
              <p class="text-center text-muted" >By clicking Signup now, you agree to out <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></p>
            </div>

          </form>
          <!-- signup form end -->

          <!-- login Form -->
          <form action="phpScripts/login.php" method="post" class="login" id="login">
            
            <label for="checkbox">Login</label>
            <?php if($errorMessage):?>
                <p><?php echo $errorMessage; ?></p>
                <?php endif;?>

            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Email Address" name="emailLogin" id="emailLogin" value="<?php echo isset($_SESSION["enteredEmail"]) ? htmlspecialchars($_SESSION["enteredEmail"]) :''; ?>">
              </div>
            </div>

            <div class="input__control">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="passwordLogin" id="passwordLogin" placeholder="Password">
              </div>
            </div>
            
           
            <div class="d-grid">
              <button type="submit">Login</button>
            </div>
            <?php
                unset($_SESSION["loginErr"]);
                unset($_SESSION["enteredEmail"]);
                ?>

          </form>
          <!-- login Form end -->

        </div>
      </div>

    </div>

    <div id="footer"></div>
    <script src="js/getNavFooter.js"></script>
    
    
    
</body>
</html>