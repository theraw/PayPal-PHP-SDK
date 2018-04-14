<?php
// # AuthorizationCapture
// This sample code demonstrates how you can capture 
// a previously authorized payment.
// API used: /v1/payments/payment
// https://developer.paypal.com/webapps/developer/docs/api/#capture-an-authorization
require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;


// Replace $authorizationId with any static Id you might already have. 
$authorizationId = "xxxxxxxxxxxxxxxxxx";

// ### Capture Payment
// You can capture and process a previously created authorization
// by invoking the $authorization->capture method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
try {

    // Retrieve the authorization
    $authorization = Authorization::get($authorizationId, $apiContext);

    $amt = new Amount();
    $amt->setCurrency("EUR")
        ->setTotal(12.00);

    ### Capture
    $capture = new Capture();
    $capture->setAmount($amt);

    // Perform a capture
    $getCapture = $authorization->capture($capture, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Capture Payment", "Authorization", null, $capture, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 ResultPrinter::printResult("Capture Payment", "Authorization", $getCapture->getId(), $capture, $getCapture);

return $getCapture;
