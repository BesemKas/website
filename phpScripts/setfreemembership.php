<?php
session_start();

// database connection script
$mysqli = require __DIR__ . "/database.php";

// SQL query to insert a new membership record
$sql_SetMembership  = "INSERT INTO membership(AccountID, MembershipTypeID) VALUES (?,?)";

// Initialize a statement object
$stmt = $mysqli->stmt_init();

// Prepare the SQL statement for execution and check for errors
if (!$stmt->prepare($sql_SetMembership)) {
    die("SQL error: " . $mysqli->error);
}

// Bind parameters to the SQL
$stmt->bind_param(
    "si", 
    $_SESSION["AccountID"],
    $_POST['btn']
);

// Execute
$stmt->execute();

// Redirect
header('Location: ../Account.php');



