<?PHP
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$dbCon = new mysqli($servername, $username, $password, $dbname);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
}
*/
//require_once 'twilio-php-main//src/Twilio/autoload.php';
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;

date_default_timezone_set("Asia/Kuala_Lumpur");

if( (isset($_POST['phone']) && $_POST['phone'] != '') ) {
    
    //echo $_POST['phone'];
    
/*

//require_once '/path/to/vendor/autoload.php';



$sid    = "ACa4064889163d4b608f86141e3958d242";
$token  = "2b386e86b67e4b47418e765f69f8d3b0";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("whatsapp:+60172327809", // to
                           [
                               //"from" => "whatsapp:+15005550006",
                               "from" => "whatsapp:+60178847085",
                               "body" => "Hi Joe! Thanks for placing an order with us. We’ll let you know once your order has been processed and delivered. Your order number is O12235234"
                           ]
                  );

//print($message->sid);
echo $message->sid;
    
*/





$sid    = "ACa4064889163d4b608f86141e3958d242";
$token  = "2b386e86b67e4b47418e765f69f8d3b0";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("whatsapp:+60172327809", // to
                           [
                               "from" => "whatsapp:+13343848216",
                               "body" => "Hi Joe! Thanks for placing an order with us. We’ll let you know once your order has been processed and delivered. Your order number is O12235234"
                           ]
                  );

print($message->sid);



    

}else{
    echo 'Error !';
}
?>




