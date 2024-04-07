<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

// Function to generate a random 6-digit OTP
function generateOTP() {
    return sprintf('%06d', mt_rand(0, 999999));
}

// Define recipient's number
$recipientNumber = "254708411412"; // Replace with the recipient's phone number

// Generate OTP
$otp = generateOTP();


 // Store OTP in session for verification later
 session_start();
 $_SESSION['otp'] = $otp;

 // Redirect to OTP entry page
 //header("Location: otp.php");
// exit;
 
// Check if recipient number is defined
if (!empty($recipientNumber)) {
    $base_url = "mmk166.api.infobip.com";
    $api_key = "be05887b3796c4731c62d54458cd1e0f-1d76893d-f993-4308-a5db-fb9aecad5bf8";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);

    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $recipientNumber);

    // Message containing OTP
    $message = "Your OTP for two-factor authentication: $otp";

    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "daveh"
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    $response = $api->sendSmsMessage($request);

    echo "OTP sent successfully.";
} else {
    echo "Error: Recipient number not provided.";
}
