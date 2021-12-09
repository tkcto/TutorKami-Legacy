<?php
require_once('admin/classes/config.php.inc');
require_once('admin/classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
date_default_timezone_set("Asia/Kuala_Lumpur");



if(empty($_POST["thisuser"])){
    echo'Empty User';
    exit();
}else{

    $thisuser   = $conn->real_escape_string($_POST["thisuser"]);
    
    $chkUser = " SELECT ud_u_id, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$thisuser."' ";
    $resultChkUser = $conn->query($chkUser);
    if ($resultChkUser->num_rows > 0) {
        $rochkUser = $resultChkUser->fetch_assoc();
        
        $Subscriber = " SELECT wa_manual FROM tk_whatsapp_noti_dummy WHERE wa_manual = '".$rochkUser['ud_phone_number']."' ";
        $resSubscriber = $conn->query($Subscriber);
        if ($resSubscriber->num_rows > 0) {
            $roSubscriber = $resSubscriber->fetch_assoc();
            echo 'yes';
            exit();   
        }else{
            echo 'no';
            exit();   
        }
        
    }else{
        echo 'Error';
        exit();        
    }
    
}
?>