<?php
 //validate fields on server side if client side validation fails

 if (empty($_POST["Firstname"])) {
     die("Name is Required");
 }

 if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
     // if not valid email, die
     die("Valid email address is required");
 }

 if (strlen($_POST["password"]) < 8) {
     // check that pw is min 8 char long
     die("password must be atleast 8 characters long");
 }

 if (!preg_match("/[a-z]/i", $_POST["password"])) {
     //pregmatch checks if string contains pattern (a-z). i = case sensitive search
     die("password must contain at least one lowercase letter");
 }

 if (!preg_match("/[A-Z]/i", $_POST["password"])) {
     die("password must contain at least one uppercase letter");
 }

 if (!preg_match("/[0-9]/i", $_POST["password"])) {
     die("password must contain at least one number");
 }

 if (!preg_match("/[^a-zA-Z0-9]/i", $_POST["password"])) {
     //  check that at least one char is not a letter or number (must be special char)
     die("password must contain at least one special character");
 }

 if ($_POST["password"] !== $_POST["passwordCon"]) {
     die("passwords must match");
 }

 $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); // create a var to store the password as a hash value

 $mysqli = require __DIR__ . "/database.php"; //require the database connection file to get connection credentials

 //check if the email already exists in db
 $email = $_POST["email"];

 $sql_checkemail = "SELECT * FROM account WHERE email = ?";

 $checkEmail = $mysqli->prepare($sql_checkemail);

 $checkEmail->bind_param("s", $email);

 $checkEmail->execute();

 $result = $checkEmail->get_result();

 if ($result->num_rows !== 0) {
     die("this email is already taken.");
 } else {
     $sql_insert = "INSERT INTO account(email, firstname,lastname,phone,passwordhash)
        VALUES (?,?,?,?,?)";

     $stmt = $mysqli->stmt_init();

     if (!$stmt->prepare($sql_insert)) {
         die("SQL error: " . $mysqli->error);
     }

     $stmt->bind_param(
         "sssss",
         $_POST["email"],
         $_POST["Firstname"],
         $_POST["Lastname"],
         $_POST["phoneNum"],
         $password_hash
     );

     $stmt->execute();
     session_start();
     // $_SESSION['login'] = ' ';
     // header("Location: memberland.php");

     $email = $_POST["email"];
     $password = $_POST["password"];

     $sql_getEmail = "SELECT * FROM account WHERE Email = ?";

     $checkEmail = $mysqli->prepare($sql_getEmail);
     $checkEmail->bind_param("s", $email);
     $checkEmail->execute();

     $result = $checkEmail->get_result(); //get the rows
     $account = $result->fetch_assoc();
     session_regenerate_id(true);
     $_SESSION["AccountID"] = $account["AccountID"];
     header("Location: ../selectplan.php");
     exit();
 }

