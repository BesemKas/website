<?php

session_start();

$mysql = require __DIR__ ."/database.php";



$sql_SetMembership  ="INSERT INTO membership(AccountID, MembershipTypeID) 
                        VALUES (?,?)";

$stmt = $mysqli->stmt_init();

     if (!$stmt->prepare($sql_SetMembership)) {
         die("SQL error: " . $mysqli->error);
     }

     $stmt->bind_param(
         "si",
         $_SESSION["AccountID"],
         $_POST['btn']
     );
     $stmt->execute();

header('Location: ../Account.php');


