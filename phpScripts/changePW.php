<?php
session_start();
$accountID = $_SESSION['AccountID'];
$account = $_SESSION['account'];

$currentPW = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$newPasswordCon = $_POST['newPasswordCon'];

$mysqli = require __DIR__ ."/database.php";




$valid = validate_cred($account, $currentPW);

if(!$valid){
    die("incorrect password");
}

if($newPassword === $currentPW){
    die("new password cant be the same as old password");

}
if (strlen($newPassword) < 8) {
    // check that pw is min 8 char long
    die("password must be atleast 8 characters long");
}

if (!preg_match("/[a-z]/i", $newPassword)) {
    //pregmatch checks if string contains pattern (a-z). i = case sensitive search
    die("password must contain at least one lowercase letter");
}

if (!preg_match("/[A-Z]/i", $newPassword)) {
    die("password must contain at least one uppercase letter");
}

if (!preg_match("/[0-9]/i", $newPassword)) {
    die("password must contain at least one number");
}

if (!preg_match("/[^a-zA-Z0-9]/i", $newPassword)) {
    //  check that at least one char is not a letter or number (must be special char)
    die("password must contain at least one special character");
}
if ($newPassword !== $newPasswordCon) {
    die("passwords must match");
}

$password_hash = password_hash($newPassword, PASSWORD_DEFAULT); // create a var to store the password as a hash value

$sqlUpdatePW = "UPDATE account
                SET PasswordHash = ?
                WHERE AccountID = ?";

$updatePassword = $mysqli->prepare($sqlUpdatePW);
$updatePassword-> bind_param('si',$password_hash,$accountID);

if ($updatePassword->execute()) {
    // Password updated successfully!
    echo '<script>alert("Password updated successfully!");</script>';
} else {
    die("Error updating password: " . $updatePassword->error);
}


function validate_cred($account,$password)
{
    
    

    $PWmatch = password_verify($password, $account["PasswordHash"]);

    return $PWmatch;
}

