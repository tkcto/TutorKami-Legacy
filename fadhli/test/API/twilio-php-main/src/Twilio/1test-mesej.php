<?php
// https://www.twilio.com/docs/libraries/php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md

//require __DIR__ . '/autoload.php';
//require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
//require_once '/path/to/vendor/autoload.php';

//require_once '/path/to/vendor/autoload.php';

//fadhli/test/API/twilio-php-main/src/Twilio
require_once 'autoload.php';


 
use Twilio\Rest\Client; 
 
$sid    = "ACa4064889163d4b608f86141e3958d242"; 
$token  = "2b386e86b67e4b47418e765f69f8d3b0"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("whatsapp:+60178847085", // to 
                           array( 
                               "from" => "whatsapp:+14155238886",       
                               "body" => "Your Yummy Cupcakes Company order of 1 dozen frosted cupcakes has shipped and should be delivered on July 10, 2019. Details: http://www.yummycupcakes.com/" 
                           ) 
                  ); 
 
print($message->sid);

?>