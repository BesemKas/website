<?php
// Resume the current session
session_start();

// Retrieve the membership type ID from a cookie
$membershipTypeID = $_COOKIE['membershipTypeID'];

// Check if the payment was successful and the required GET parameters are set
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    
    // Retrieve payment details from GET parameters
    $merchant_ref = $_GET['merchant_reference'];
    $gateway_ref = $_GET['gateway_reference'];
    $transactionID = $_GET['transaction_id'];
    $paymentKey = $_GET['payment_key'];
    $status = $_GET['status'];

    // If the payment status is 'success', proceed with updating the database
    if ($status === 'success') {

        // Include the database connection script
        $mysqli = require __DIR__ . "/database.php";
        
        // SQL query to get account details using the temporary token
        $sql_getAccount = "SELECT * FROM account WHERE TempToken = ?";
        $stmt = $mysqli->prepare($sql_getAccount);
        $stmt->bind_param("s", $paymentKey);
        $stmt->execute();
        $result = $stmt->get_result();
        $account = $result->fetch_assoc();

        // SQL query to insert a new membership record for the account
        $sql_setMembership = "INSERT INTO membership(AccountID, MembershipTypeID) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql_setMembership);
        $stmt->bind_param("ii", $account['AccountID'], $_COOKIE['membershipTypeID']);
        $stmt->execute();

        // SQL query to create a new payment record with the transaction details
        $sql_createPayment = "INSERT INTO payment(PaymentID, AccountID, PaymentKey, MerchantReference, Status) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql_createPayment);
        $stmt->bind_param("sisss", $transactionID, $account['AccountID'], $paymentKey, $merchant_ref, $status);
        $stmt->execute();

    } else {
        // If payment failed, display an error message
        echo "payment failed.";
    }
   
    // Send an HTTP OK response code and acknowledgment message
    http_response_code(200);
    echo "Callback received successfully.<br>";
} else {
    // If the request is invalid, send an HTTP Bad Request response code and error message
    http_response_code(400);
    echo "Invalid request.";
}
