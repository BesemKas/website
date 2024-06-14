<?php
session_start();

$mysqli = require __DIR__ . "/database.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $carID = $_POST['carID'];

$sql__RemoveCar="DELETE FROM car
    WHERE CarID = {$carID}";

$remove = $mysqli->prepare($sql__RemoveCar);
$remove->execute();
header("Location: ../Account.php");
exit();
}