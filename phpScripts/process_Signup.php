<?php
// Server-side validation for registration fields

// Check if the Firstname field is empty
if (empty($_POST["Firstname"])) {
    die("Name is Required");
}

// Validate the email address format
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email address is required");
}

// Ensure the password is at least 8 characters long
if (strlen($_POST["password"]) < 8) {
    die("password must be at least 8 characters long");
}

// Check for at least one lowercase letter in the password
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("password must contain at least one lowercase letter");
}

// Check for at least one uppercase letter in the password
if (!preg_match("/[A-Z]/i", $_POST["password"])) {
    die("password must contain at least one uppercase letter");
}

// Check for at least one number in the password
if (!preg_match("/[0-9]/i", $_POST["password"])) {
    die("password must contain at least one number");
}

// Check for at least one special character in the password
if (!preg_match("/[^a-zA-Z0-9]/i", $_POST["password"])) {
    die("password must contain at least one special character");
}

// Ensure the password and confirmation password match
if ($_POST["password"] !== $_POST["passwordCon"]) {
    die("passwords must match");
}

// Hash the password using a secure algorithm
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Include the database connection script
$mysqli = require __DIR__ . "/database.php";

// Check if the email already exists in the database
$email = $_POST["email"];
$sql_checkemail = "SELECT * FROM account WHERE email = ?";
$checkEmail = $mysqli->prepare($sql_checkemail);
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$result = $checkEmail->get_result();

// If an account with this email already exists, stop registration
if ($result->num_rows !== 0) {
    die("this email is already taken.");
} else {
    // Insert new account details into the database
    $sql_insert = "INSERT INTO account(email, firstname, lastname, phone, passwordhash)
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

    // Start a new session and set session variables after successful registration
    session_start();
    $email = $_POST["email"];
    $sql_getEmail = "SELECT * FROM account WHERE Email = ?";
    $checkEmail = $mysqli->prepare($sql_getEmail);
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();
    $account = $result->fetch_assoc();
    
    // Regenerate session ID for security and set AccountID in session
    session_regenerate_id(true);
    $_SESSION["AccountID"] = $account["AccountID"];

    // Redirect to plan selection page after successful registration
    header("Location: ../selectplan.php");
    
    // Terminate script execution after redirection
    exit();
}
