<?php
// Start or resume a session
session_start();

// Retrieve amount, account ID, and membership type ID from POST data and session
$amount = $_POST['amount'];
$accountID = $_SESSION['AccountID'];
$membershipTypeID = $_POST['membershipTypeID'];

// Set a cookie for membershipTypeID that expires in 30 days
setcookie("membershipTypeID", $membershipTypeID, time() + (86400 * 30), "/");

// Define URLs for success, error, cancel, and notify actions
$success_url = "https://washmore.trueideonline.co.za/phpScripts/NotifyCallback.php";
$error_url = "https://washmore.trueideonline.co.za/selectplan.php";
$cancel_url = "https://washmore.trueideonline.co.za/selectplan.php";
$notify_url = "https://washmore.trueideonline.co.za/phpScripts/NotifyCallback.php";

// Execute cURL to request a payment key
$command = "curl -X POST -u WashMoreUATAPI:C9BR6swOnXZfalA5VL1e0iGe0W https://services.callpay.com/api/v1/payment-key -d \"amount={$amount}&merchant_reference=testref123&success_url={$success_url}\"";
$response = exec($command);

// Decode the JSON response to array
$result = json_decode($response, true);

// Extract
$paymentKey = $result['key'];
$paymentUrl = $result['url'];
$origin = $result['origin'];

// database connection script
$mysqli = require __DIR__ . "/database.php";

// SQL query to update the TempToken for the account in the database
$sql_TempToken = "UPDATE account SET TempToken = ? WHERE AccountID = $accountID";

// Prepare the SQL statement for execution
$stmt = $mysqli->prepare($sql_TempToken);

// Bind the payment key to the SQL statement
$stmt->bind_param("s", $paymentKey);

// Execute the prepared statement
$stmt->execute();

// Redirect to the payment URL provided by the payment gateway
header("Location: $paymentUrl");

// Terminate script
exit;
