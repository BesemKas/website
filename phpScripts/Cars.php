<?php

$membershipID = $_SESSION['MembershipID'];

$mysqli = require __DIR__ ."/database.php";

$sql_getCars = "SELECT * FROM car
          WHERE MembershipID = {$_SESSION["MembershipID"]}";

    $resultCars = $mysqli->query($sql_getCars);
    $cars = [];
    while ($row = $resultCars->fetch_assoc()) {
        $cars[] = $row;
    }

    if ($membershipType !== '1') {
        foreach ($cars as $car) {
            echo "<article class='car'>";
            echo "<h3><strong>{$car['Make']} {$car['Model']}</strong></h3>";
            echo "<img src='#' alt='' />";
            echo "<p>Colour: {$car['Colour']}</p>";
            echo "<p>Registration: {$car['RegNum']}</p>";
            echo "<p>VIN: {$car['VINNumber']}</p>";
            echo "<form action='phpScripts/removeCar.php' method='post'>";
            echo "<input type='hidden' name='carID' value='{$car['CarID']}'>";
            echo "<button type='submit'>Remove</button>";
            echo "</form>";
            echo "</article>";
        }
    }
    

    

