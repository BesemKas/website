<?php
// Start or resume a session
session_start();

// Include the database connection script
$mysqli = require __DIR__ . "/database.php";

// Retrieve email and password from POST data
$email = $_POST["emailLogin"];
$password = $_POST["passwordLogin"];

// SQL query to select account details based on the provided email
$sql_getEmail = "SELECT * FROM account WHERE Email = ?";

// Prepare and execute the SQL statement
$checkEmail = $mysqli->prepare($sql_getEmail);
$checkEmail->bind_param("s", $email);
$checkEmail->execute();

// Retrieve the result set from the query
$result = $checkEmail->get_result();

// Check if any account matches the provided email
if ($result->num_rows > 0) {
    // Fetch the account details as an associative array
    $account = $result->fetch_assoc();
    
    // Validate the provided password against the stored password hash
    $validLogin = validate_cred($account, $password);

    // If credentials are valid, regenerate session ID and redirect to account page
    if ($validLogin) {
        session_regenerate_id(true);
        $_SESSION["AccountID"] = $account["AccountID"];
        header("Location: ../Account.php");
        exit();
    } else {
        // If credentials are invalid, set error message and redirect to login page
        $_SESSION["loginErr"] = "Email or password is incorrect.";
        $_SESSION["enteredEmail"] = $_POST["emailLogin"];
        header("Location: ../memberland.php");
        exit();
    }
} else {
    // If no account matches, set error message and redirect to login page
    $_SESSION["loginErr"] = "Email or password is incorrect.";
    $_SESSION["enteredEmail"] = $_POST["emailLogin"];
    header("Location: ../memberland.php");
    exit();
}

// Function to validate credentials
function validate_cred($account, $password) {
    // Verify the provided password against the stored password hash
    $PWmatch = password_verify($password, $account["PasswordHash"]);
    
    // Return true if passwords match, false otherwise
    return $PWmatch;
}
