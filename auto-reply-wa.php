<?php

require_once('admin/classes/config.php.inc');
require_once('admin/classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");

    //$sqlWaNoti = " INSERT INTO users_google2 SET oauth_provider = 'testing..' ";
    //$exeWaNoti = $conn->query($sqlWaNoti);
    
/*
$args = new stdClass();
$xdata = new stdClass();
$args->to = "60172327809@c.us";
$args->content = "Auto Send....";
$xdata->args = $args;

$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
*/
								

$conn -> close();
?>
