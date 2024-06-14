<?php
session_start();
$mysqli = require __DIR__ . "/database.php";




if($_SERVER['REQUEST_METHOD'] === "POST"){
    include "getUser.php";

$model = $_POST['model'];
$make = $_POST['make'];
$colour = $_POST['colour'];
$regNum = $_POST['regNum'];
$VINNum = $_POST['VINNum'];


$sql__AddCar = "INSERT INTO car(MembershipID,Make,Model,Colour,RegNum,VINNumber)
                VALUES ({$membership['MembershipID']},?,?,?,?,?)";

$add = $mysqli->prepare($sql__AddCar);
$add->bind_param("sssss",$model,$make,$colour,$regNum,$VINNum);
$add->execute();
header("Location: ../Account.php");
exit();
}