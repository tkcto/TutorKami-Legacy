<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
date_default_timezone_set("Asia/Kuala_Lumpur");

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}




if(isset($_POST['dataUnsubscribe'])){
    $dataUnsubscribe = $_POST['dataUnsubscribe'];
    //echo $dataUnsubscribe['phone'];

    $update = " UPDATE tk_whatsapp_noti SET wa_note = 'No' WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$dataUnsubscribe['phone']."' ";
    if ( ($conn->query($update) === TRUE) ) {
        echo "Success..";
    } else {
        echo "Error: " . $update . "<br>" . $conn->error;
    }
    exit();
}

if(isset($_POST['dataSubscribe'])){
    $dataSubscribe = $_POST['dataSubscribe'];
    //echo $dataSubscribe['phone'];

    $update = " UPDATE tk_whatsapp_noti SET wa_note = 'Yes' WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$dataSubscribe['phone']."' ";
    if ( ($conn->query($update) === TRUE) ) {
        echo "Success..";
    } else {
        echo "Error: " . $update . "<br>" . $conn->error;
    }
    exit();
}


if(isset($_POST['deletePayment'])){
    $deletePayment = $_POST['deletePayment'];

    $delete = " DELETE FROM tk_payment_history WHERE ph_id = '".$deletePayment['id']."' ";
    if ( ($conn->query($delete) === TRUE) ) {
        echo "Success";
    } else {
        echo "Error: " . $delete . "<br>" . $conn->error;
    }
    exit();
}


if(isset($_POST['updatePayment'])){
    session_start();
    
    $updatePayment = $_POST['updatePayment'];
    
    $old_date = explode('/', $updatePayment['date']); 
    $new_data = $old_date[2].'-'.$old_date[1].'-'.$old_date[0];
    
    $amount = number_format($updatePayment['amount'],2);
    $rf = number_format($updatePayment['rf'],2);
    
    $update = " UPDATE tk_payment_history SET ph_date = '".$new_data."', ph_amount = '".$amount."', ph_rf = '".$rf."', hour = '".$updatePayment['hour']."', tutor = '".$updatePayment['tutor']."', description = '".$updatePayment['des']."', description_rf = '".$updatePayment['des_rf']."' WHERE ph_id = '".$updatePayment['Id']."' ";
    if ( ($conn->query($update) === TRUE) ) {
        $log = 'Edited on '.date('d/m/y').' by '.$updatePayment['Sess'];
        $INSERT = " INSERT INTO tk_payment_log (id_payment, log) VALUES ('".$updatePayment['Id']."', '".$log."') ";
        $conn->query($INSERT);
        if( $updatePayment['role'] == 'client' ){
            $_SESSION["tabReceipt"] = 'client';
        }else{
            $_SESSION["tabReceipt"] = 'tutortutor';
        }
        
        echo "Success";
    } else {
        echo "Error: " . $update . "<br>" . $conn->error;
    }
    exit();
}




















$conn->close();
?>