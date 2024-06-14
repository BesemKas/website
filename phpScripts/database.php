<?php
//localhost

// $host = "localhost";
// $dbname = "washmoredatabase";
// $username = "root";
// $password = "";


//truIdonline
$host = "172.16.30.206";
$dbname = "tru645_washmoredatabase";
$username = "tru645_DBM";
$password = "UDmgpjN2WF5LhXG7SLdzkCKbcrxELGw";


$mysqli = new mysqli($host,$username,$password,$dbname);

if($mysqli->connect_errno) // if connection error then conn_errno will != 0 connect_errno is the error number
{
    die("connection error:" . $mysqli->connect_error); // connect_error  is the description of error
}

return $mysqli;
