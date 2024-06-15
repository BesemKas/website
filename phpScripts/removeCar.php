<?php
session_start();

// database connection script
$mysqli = require __DIR__ . "/database.php";

// Check request method -> POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Retrieve the car ID from the POST data
    $carID = $_POST['carID'];

    // SQL query to delete a car from the database based on the CarID
    $sql__RemoveCar="DELETE FROM car WHERE CarID = {$carID}";

    // Prepare the SQL statement for execution
    $remove = $mysqli->prepare($sql__RemoveCar);

    // Execute the prepared statement
    $remove->execute();

    // Redirect to the 'Account.php' page after deletion
    header("Location: ../Account.php");

    // Terminate the script to prevent further execution after redirection
    exit();
}
