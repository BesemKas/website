<?php

$mysqli = require __DIR__ . "/database.php";

$_SESSION["AccountID"];

$sql_getAccount = "SELECT * FROM account
            WHERE AccountID = {$_SESSION["AccountID"]}";

$resultAccount = $mysqli->query($sql_getAccount); // get the record
$account = $resultAccount->fetch_assoc(); // make an account object
$_SESSION["account"] = $account;

$sql_getMembership = "SELECT * FROM
      membership WHERE AccountID = {$account["AccountID"]}";

$resultMembership = $mysqli->query($sql_getMembership);

if ($resultMembership->num_rows > 0) {
    $membership = $resultMembership->fetch_assoc();

  //get the type of membership
    $sql_getMemebershipType = "SELECT * FROM membershiptype
    WHERE MembershipTypeID = {$membership["MembershipTypeID"]}";

    $resultMembershipType = $mysqli->query($sql_getMemebershipType);
    $membershipType = $resultMembershipType->fetch_assoc();

    $_SESSION["MembershipID"] = $membership["MembershipID"];
} else {
    header("Location: selectplan.php");
}


