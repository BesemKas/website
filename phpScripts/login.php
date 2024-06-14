<?php
session_start();


$mysqli = require __DIR__ . "/database.php";

$email = $_POST["emailLogin"];
$password = $_POST["passwordLogin"];

$sql_getEmail = "SELECT * FROM account WHERE Email = ?";

$checkEmail = $mysqli->prepare($sql_getEmail);
$checkEmail->bind_param("s", $email);
$checkEmail->execute();

$result = $checkEmail->get_result(); //get the rows

if ($result->num_rows> 0) {
    $account = $result->fetch_assoc(); //get result row as an array (account object)
    $validLogin = validate_cred($account,$password);

    if ($validLogin) {
        session_regenerate_id(true);
        $_SESSION["AccountID"] = $account["AccountID"];
        header("Location: ../Account.php");
        exit();
    } else {
        
        $_SESSION["loginErr"] = "Email or password is incorrect.";
        $_SESSION["enteredEmail"] = $_POST["emailLogin"];
        header("Location: ../memberland.php");
        exit();
    }
}
else
{
    
    $_SESSION["loginErr"] = "Email or password is incorrect.";
    $_SESSION["enteredEmail"] = $_POST["emailLogin"];
    header("Location: ../memberland.php");
    exit();
}

function validate_cred($account,$password)
{
    
    

    $PWmatch = password_verify($password, $account["PasswordHash"]);

    return $PWmatch;
}
