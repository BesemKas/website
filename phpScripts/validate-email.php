<?php

// Include the database connection script from the 'database.php' file
$mysqli = require __DIR__. "/database.php";

// Retrieve the email address from the query parameters
$email = $_GET['email'];

// SQL query to find an account with a matching email address
$sql = "SELECT * FROM account WHERE email = ?";

// Prepare SQL
$checkEmail = $mysqli->prepare($sql);

// Bind
$checkEmail->bind_param('s', $email);

// Execute the prepared statement
$checkEmail->execute();

// Fetch the result of the executed query
$result = $checkEmail->get_result();

// Determine if the email address not found in database
$available = ($result->num_rows === 0);

// Set response header to content type JSON
header("Content-Type: application/json");

// Send a JSON response indicating whether the email address is available
echo json_encode(['available'=> $available]);
