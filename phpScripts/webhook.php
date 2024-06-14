<?php
session_start();
header("Location: https://washmore.trueideonline.co.za/index.php");
// Retrieve the POST data from the webhook
$webhook_data = file_get_contents('php://input');
$webhook_payload = json_decode($webhook_data, true);

// Extract relevant information from the payload
$transaction_id = $webhook_payload['id'];
$successful = $webhook_payload['successful'];
$amount = $webhook_payload['amount'];
$gateway_reference = $webhook_payload['gateway_reference'];
$created = $webhook_payload['created'];
$service = $webhook_payload['service'];

// Handle the payment status based on 'successful' value
if ($successful === 1) {
    header("Location: https://washmore.trueideonline.co.za/index.php");
    // ...
} else {
    // Payment failed
    // Handle accordingly (e.g., log the failure, notify the user)
    // ...
}

// Respond with a success status to the webhook (important for the gateway)
http_response_code(200);
?>
