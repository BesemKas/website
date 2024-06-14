<?php
session_start();

$amount = $_POST['amount'];
$accountID = $_SESSION['AccountID'];
$membershipTypeID = $_POST['membershipTypeID'];

setcookie("membershipTypeID",$membershipTypeID, time() + (86400*30), "/");


$success_url="https://washmore.trueideonline.co.za/phpScripts/NotifyCallback.php";
$error_url="https://washmore.trueideonline.co.za/selectplan.php";
$cancel_url="https://washmore.trueideonline.co.za/selectplan.php";
$notify_url="https://washmore.trueideonline.co.za/phpScripts/NotifyCallback.php";

$command = "curl -X POST -u WashMoreUATAPI:C9BR6swOnXZfalA5VL1e0iGe0W https://services.callpay.com/api/v1/payment-key -d \"amount={$amount}&merchant_reference=testref123&success_url={$success_url}\"";
$response = exec($command);

// Parse the response and proceed with your logic
$result = json_decode($response, true);

// Extract individual components
$paymentKey = $result['key'];
$paymentUrl = $result['url'];
$origin = $result['origin'];

$mysqli = require __DIR__ ."/database.php";

$sql_TempToken ="UPDATE account SET TempToken = ? WHERE AccountID = $accountID";

$stmt=$mysqli->prepare($sql_TempToken);

$stmt->bind_param("s",$paymentKey);
$stmt->execute();

header("Location: $paymentUrl");
exit;
