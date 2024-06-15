<?php
session_start();

$membershipTypeID  =$_COOKIE['membershipTypeID'];

if ( isset($_GET['success']) && $_GET['success'] === 'true') {
    
    $merchant_ref = $_GET['merchant_reference'];
    $gateway_ref = $_GET['gateway_reference'];
    $transactionID = $_GET['transaction_id'];
    $paymentKey = $_GET['payment_key'];
    $status = $_GET['status'];

    if($status === 'success'){

        $mysqli = require __DIR__ . "/database.php";
        
        $sql_getAccount = "SELECT * FROM account
                            WHERE TempToken = ?";
        
        $stmt = $mysqli->prepare($sql_getAccount);
        $stmt->bind_param("s",$paymentKey);
        $stmt->execute();

        $result= $stmt->get_result();
        $account=$result->fetch_assoc();


        
        $sql_setMembership = "INSERT INTO membership(AccountID,MembershipTypeID)
                                VALUES (?,?)";
        
        $stmt = $mysqli->prepare($sql_setMembership);
        $stmt->bind_param("ii",$account['AccountID'],$_COOKIE['membershipTypeID']);
        $stmt->execute();


        $sql_createPayment = "INSERT INTO payment(PaymentID,AccountID,PaymentKey,MerchantReference,Status)
                                VALUES (?,?,?,?,?)";
        
        $stmt = $mysqli->prepare($sql_createPayment);
        $stmt->bind_param("sisss",$transactionID,$account['AccountID'],$paymentKey,$merchant_ref,$status);
        $stmt->execute();

    }else{
        echo "payment failed.";
    }
   
    // Respond with an acknowledgment
    http_response_code(200); // HTTP OK status
    echo "Callback received successfully.<br>";
} else {
    // Invalid request method 
    http_response_code(400); // Bad Request
    echo "Invalid request.";
}
