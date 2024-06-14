<?php
session_start();

$_SESSION["Page"] = "Plan";



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/selectplan.css" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <title>Choose your plan</title>
  </head>
  <body>
    <div id="nav"></div>

    <div class="options__wrapper">
      <div class="details">
        <h1>Choose the right package for you!</h1>
      </div>

      <div class="options__container">
        <div class="option" name="Free" id="Free">
          <div class="title">
            <h2>Free</h2>
          </div>
          <div class="price">
            <span name="value" id="value">R0.00</span>
          </div>
          <div class="benefits">
            <div>No Benefits</div>
          </div>
          <form action="phpScripts/setfreemembership.php" method="post">
            <div class="button">
              <button type="submit" name="btn" id="btn" value="1">
                Choose
              </button>
            </div>
          </form>
        </div>

        <!-- Option1 -->
        <div class="option" name="basic" id="basic">
          <div class="title">
            <h2>Silver</h2>
          </div>
          <div class="price">
            <span name="value" id="value">R499.99</span>
            <span name="frequency">per month</span>
          </div>
          <div class="benefits">
            <div>Add a single Car to your account</div>
            <div>Unlimited washes for your car</div>
          </div>
          <form action="phpScripts/paymentKey.php" method="post">
            <div class="button">
              <input type="hidden" name="amount" id="amount" value="10">
              <input type="hidden" name="membershipTypeID" id="membershipTypeID" value="2">
              <button type="submit" name="btn" id="btn" value="2">
                Choose
              </button>
            </div>
          </form>
        </div>

        <!-- Option2 -->
        <div class="option" name="extra" id="extra">
          <div class="title">
            <h2>Gold</h2>
          </div>
          <div class="price">
            <span name="value" id="value">R599.99</span>
            <span name="frequency">per month</span>
          </div>
          <div class="benefits">
            <div>Add up to 2 cars to your account</div>
            <div>Unlimited washes for your car</div>
          </div>
          <form action="phpScripts/setMembership.php" method="post">
            <div class="button">
            <input type="hidden" name="amount" id="amount" value="10">
            <input type="hidden" name="membershipTypeID" id="membershipTypeID" value="3">
              <button type="submit" name="btn" id="btn" value="3">
                Choose
              </button>
            </div>
          </form>
        </div>

        <!-- Option3 -->
        <div class="option" name="family" id="family">
          <div class="title">
            <h2>Platinum</h2>
          </div>
          <div class="price">
            <span name="value" id="value">R799.99</span>
            <span name="frequency">per month</span>
          </div>
          <div class="benefits">
            <div>Add up to 4 cars to your account</div>
            <div>Unlimited washes for your car</div>
          </div>
          <form action="phpScripts/setMembership.php" method="post">
            <div class="button">
            <input type="hidden" name="amount" id="amount" value="10">
            <input type="hidden" name="membershipTypeID" id="membershipTypeID" value="4">
              <button type="submit" name="btn" id="btn" value="4">
                Choose
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--footer-->
    <div id="footer"></div>
    <script src="js/getNavFooter.js"></script>
  </body>
</html>
