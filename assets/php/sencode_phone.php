<?php 
require __DIR__ . '/../../vendor/autoload.php'; 

use Twilio\Rest\Client;

function sendCodePhone($phoneNumber, $code) {
    $accountSid = 'AC030454551432eb4f7827af9ec589ef9d';
    $authToken = 'c2a0d3fec53aff937303a1c7b8a470df';
    $twilioNumber = '+15855662679';
    
    // create a new Twilio client
    $client = new Client($accountSid, $authToken);
    
    // use the Twilio client to send an SMS message containing the code
    $message = $client->messages->create(
        $phoneNumber,
        array(
            'from' => $twilioNumber,
            'body' => "$code کۆدی سەلماندنەکەت بریتیە لە "
        )
    );
    
    // if the message was sent successfully, return true
    return $message->sid !== null;
}

