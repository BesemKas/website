<?php

$mysqli = require __DIR__. "/database.php";


$email = $_GET['email'];

$sql = "SELECT * FROM account WHERE email = ?";

$checkEmail = $mysqli->prepare($sql);
$checkEmail->bind_param('s', $email);
$checkEmail->execute();

$result = $checkEmail->get_result();

$available = ($result->num_rows === 0);

header("Content-Type: application/json");

echo json_encode(['available'=> $available]);