<?php
session_start();
$_SESSION["AccountID"];
$_SESSION["Page"] = "Account";

if (isset($_SESSION["AccountID"])) {
    $mysqli = require __DIR__ . "/phpScripts/database.php";

    include "phpScripts/getUser.php";
    
} else {
    header("Location: index.php");
    exit();
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Account</title>
    <link rel="icon" href="./Media/logo.jpg">
    <link rel="stylesheet" href="css/Account.css">
    <link rel="stylesheet" href="css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="js/getNavFooter.js" defer></script>
    

</head>

<body>
    <div id="nav"></div>

    <div class="container-fluid pt-5" id="main__container">
        <h1>Welcome <?= $account["FirstName"] ?></h1>
        <div class="container my-6 mt-5" id="account__container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i></button>
                    <button class="nav-link" id="nav-membership-tab" data-bs-toggle="tab" data-bs-target="#nav-membership" type="button" role="tab" aria-controls="nav-membership" aria-selected="false"><i class="fas fa-user-friends    "></i></button>
                    <button class="nav-link" id="nav-cars-tab" data-bs-toggle="tab" data-bs-target="#nav-cars" type="button" role="tab" aria-controls="nav-cars" aria-selected="false"><i class="fa fa-car" aria-hidden="true"></i></button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- first tab -->
                <div class="tab-pane fade show active p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <h2>Your Profile Details</h2>
                    </div>
                    <div class="row">
                        <table id="profile__details">
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Name:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $account['FirstName'] .' '. $account['LastName']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Phone Number:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $account['Phone']?></span>
                                </td>
                                <td><button>update</button></td>
                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Email Address:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $account['Email']?></span>
                                </td>
                                <td><button>update</button></td>

                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Reset Password:</span>
                                </td>
                                <td>
                                </td>
                                
                                <td><button>update</button></td>

                            </tr>
                        </table>
                    </div>

                </div>
                <!-- second tab -->
                <div class="tab-pane fade p-3" id="nav-membership" role="tabpanel" aria-labelledby="nav-membership-tab">
                <div class="row">
                        <h2>Your Membership Details</h2>
                    </div>
                    <div class="row">
                        <table id="profile__details">
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Membership ID:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $membership['MembershipID']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Membership Type:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $membershipType['MembershipName']?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Monthly Payment:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue">R<?= $membershipType['Price']?></span>
                                </td>
                                <td></td>

                            </tr>
                            <tr>
                                <td class="PName">
                                    <span class="propertyName">Car Allocation:</span>
                                </td>
                                <td class="PValue">
                                    <span class="propertyValue"><?= $membershipType['CarAmount']?></span>
                                </td>
                                <td></td>

                            </tr>
                            <tr id="cancelbtn">
                                <td colspan="2"></td>
                                <td><button>Cancel Membership</button></td>
                                
                            </tr>
                        </table>
                    </div>
                    
                </div>
                <!-- third tab -->
                <div class="tab-pane fade p-3" id="nav-cars" role="tabpanel" aria-labelledby="nav-cars-tab">
                    <h2>Your Car Details</h2>
                    <div class="details">
                        <div class="container-fluid" id="car__grid">
                        <?php if ($membershipType["MembershipTypeID"] !== "1") {
                            
                            include "phpScripts/Cars.php";
                            if(count($cars) < $membershipType['CarAmount']){
                                echo "<button id='Addbtn' name='Addbtn' onclick='openForm()'>Add Car</button>";
                                
                            }
                            
                            } else {
                                echo "<label>This membership does not qualify for Adding Cars</label>";
                            } 
                        ?>
                        </div>
                        
                    </div>
                    <div class="addCar__container" id="addCar__container">
                        <h2>Add Your Car!</h2>
                        <form action="phpScripts/addCar.php" id="addCarForm" method="post">
                            
                            <input type="text" name="make" id="make" placeholder="Enter the Make of your car.">
                            <input type="text" name="model" id="model" placeholder="Enter the Model Name of your car.">
                            <input type="text" name="colour" id="colour" placeholder="Enter the Colour of your car.">
                            <input type="text" name="regNum" id="regNum" placeholder="Enter the Registration Number of your car.">
                            <input type="text" name="VINNum" id="VINNum" placeholder="Enter the VIN Number of your car.">
                            

                            <button type="submit" class="btn Add">Add</button>
                            <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <div id="footer"></div>
    <script src="js/popupform.js"></script>
    <script src="js/Account.js"></script>
    
</body>

</html>