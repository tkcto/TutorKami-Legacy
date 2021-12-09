<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");

$datetime = date('Y-m-d H:i:s');
$timestamp = strtotime($datetime);
$verification_date = date('H:i d/m/y').' - System';

$allowSend = " SELECT cr_id, cr_parent_verification, cr_create_date FROM tk_classes_record WHERE cr_parent_verification IS NULL OR cr_parent_verification = '' ";
$resultallowSend = $conn->query($allowSend);
if ($resultallowSend->num_rows > 0) {
	while($rowallowSend = $resultallowSend->fetch_assoc()){
	    
	    if( strtotime($rowallowSend['cr_create_date'] . "+2 days") <= $timestamp ){
	        //echo $rowallowSend['cr_id'].' = '.$rowallowSend['cr_create_date'].' ^ '.strtotime($rowallowSend['cr_create_date']).' ^ '.strtotime($rowallowSend['cr_create_date'] . "+2 days").'<br/>';
	        
            $sql = " UPDATE tk_classes_record SET cr_parent_verification='done', time_verification='".$verification_date."' WHERE cr_id ='".$rowallowSend['cr_id']."' ";
            $conn->query($sql);
	    }

	sleep(5);	
	}
}
$conn -> close();
?>
