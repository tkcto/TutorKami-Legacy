<?php

/* 09 Issues Sept 2020 - No 18 b.ii */
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");


$website = "https://wa.tutorkami.my/api-docs/";
if( !activeAPI( $website ) ) {
    //echo $website ." is down!";
    
    $server = " SELECT * FROM tk_server ";
    $resulServer = $conn->query($server);
    if ($resulServer->num_rows > 0) {
        $rowServer = $resulServer->fetch_assoc();
        
        if( $rowServer['status'] == 'OK'){
            
            $sql = "UPDATE tk_server SET status='Down', time='".date('d/m/Y H:i:s')."' WHERE id ='1' ";
            $conn->query($sql);
            
            $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
            $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
            $emailBody 	  = "Status : Server is down! <br>Time : ".date('d/m/Y H:i:s');
        
            $headers = 'From: Tutorkami' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            mail($to, $emailSubject, $emailBody, $headers);  
        }
        
    }else{
        $sqlWaNoti = "INSERT INTO tk_server SET status = 'Down', time='".date('d/m/Y H:i:s')."' ";
        $exeWaNoti = $conn->query($sqlWaNoti);
        
        $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
        $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
        $emailBody 	  = "Status : Server is down! <br>Time : ".date('d/m/Y H:i:s');
    
        $headers = 'From: Tutorkami' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        mail($to, $emailSubject, $emailBody, $headers); 
    }
    
} else {
    
    $args = new stdClass();
    $xdata = new stdClass();
    $args->to = "60172327809@c.us";
    $args->content = "Hello World";
    $xdata->args = $args;
    $make_call = callAPI('POST', 'https://wa.tutorkami.my/isConnected', $xdata );
    if( $make_call == '{"success":true,"response":false}' ){
        //echo 'Error';
        
        $server = " SELECT * FROM tk_server ";
        $resulServer = $conn->query($server);
        if ($resulServer->num_rows > 0) {
            $rowServer = $resulServer->fetch_assoc();
            
            if( $rowServer['status'] == 'OK'){
                
                $sql = "UPDATE tk_server SET status='Down', time='".date('d/m/Y H:i:s')."' WHERE id ='1' ";
                $conn->query($sql);
                
                $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
                $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
                $emailBody 	  = "Status : API not working! <br>Time : ".date('d/m/Y H:i:s');
            
                $headers = 'From: Tutorkami' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
                mail($to, $emailSubject, $emailBody, $headers);   
            }
            
        }else{
            $sqlWaNoti = "INSERT INTO tk_server SET status = 'Down', time='".date('d/m/Y H:i:s')."' ";
            $exeWaNoti = $conn->query($sqlWaNoti);
            
            //echo $website ." functions correctly.";
            $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
            $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
            $emailBody 	  = "Status : API not working! <br>Time : ".date('d/m/Y H:i:s');
        
            $headers = 'From: Tutorkami' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            mail($to, $emailSubject, $emailBody, $headers);    
        }
        
    }else{
        $server = " SELECT * FROM tk_server ";
        $resulServer = $conn->query($server);
        if ($resulServer->num_rows > 0) {
            $rowServer = $resulServer->fetch_assoc();
            
            if( $rowServer['status'] == 'Down'){
                
                $sql = "UPDATE tk_server SET status='OK', time='".date('d/m/Y H:i:s')."' WHERE id ='1' ";
                $conn->query($sql);
                
                $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
                $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
                $emailBody 	  = "Status : Server is working! <br>Time : ".date('d/m/Y H:i:s');
            
                $headers = 'From: Tutorkami' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
                mail($to, $emailSubject, $emailBody, $headers);   
            }
            
        }else{
            $sqlWaNoti = "INSERT INTO tk_server SET status = 'OK', time='".date('d/m/Y H:i:s')."' ";
            $exeWaNoti = $conn->query($sqlWaNoti);
            
            //echo $website ." functions correctly.";
            $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com, tkfinance.malaysia@gmail.com, TKcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com";
            $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
            $emailBody 	  = "Status : Server is working! <br>Time : ".date('d/m/Y H:i:s');
        
            $headers = 'From: Tutorkami' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            mail($to, $emailSubject, $emailBody, $headers);    
        }
    }

}


/* isu june 21 (8)    */

$SendWa = " SELECT * FROM tk_whatsapp_noti_dummy ";
$resSendWa = $conn->query($SendWa);
if ($resSendWa->num_rows > 0) {
    while($roSendWa = $resSendWa->fetch_assoc()){
                $tmp = explode('-', $roSendWa['wa_user']);
                $tutorID = trim($tmp[0]);
                
                $TutorPhoneNo = '';
                $TutorDisName = '';
                $TutorDisID = ''; 
                
                $sqlGeTutor = "SELECT u_id, u_email, ud_u_id, u_displayname, u_displayid, ud_first_name, ud_phone_number FROM tk_user 
                INNER JOIN tk_user_details ON ud_u_id = u_id 
                WHERE u_id = '".$tutorID."' ";
                $resultGeTutor = $conn->query($sqlGeTutor);
                if($resultGeTutor->num_rows > 0){
                    $rowGeTutor = mysqli_fetch_array($resultGeTutor);
                    $TutorPhoneNo = "6".$rowGeTutor['ud_phone_number'];
                    $TutorDisName = ucwords($rowGeTutor['u_displayname']);
                    $TutorDisID = $rowGeTutor['u_displayid']; 
                }
                
                $jobStatus = '';
                $ClientID = '';
                $sqlGetJob = "SELECT j_id, j_status, u_id FROM tk_job WHERE j_id = '".$roSendWa['wa_job_id']."' ";
                $resultGeJobt = $conn->query($sqlGetJob);
                if($resultGeJobt->num_rows > 0){
                    $rowGetJob  = mysqli_fetch_array($resultGeJobt);
                    $jobStatus = $rowGetJob['j_status'];
                    $ClientID = $rowGetJob['u_id'];
                }
            
                $thisClient = '';
                $sqlGetClient = "SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$ClientID."' ";
                $resultGeClient = $conn->query($sqlGetClient);
                if($resultGeClient->num_rows > 0){
                    $rowGetClient  = mysqli_fetch_array($resultGeClient);
                    $thisClient = ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name']);
                }
            
            
            
                            $args = new stdClass();
                            $xdata = new stdClass();
                        					        
                            $args->to = "6".$roSendWa['wa_manual']."@c.us";
                            $args->content = "Salam/Hi ".$TutorDisName.". Your profile and phone number had been sent to ".$thisClient." for Job ".$roSendWa['wa_job_id'].", https://www.tutorkami.com/job_details?jid=".$roSendWa['wa_job_id']."&status=".$jobStatus.". If Client chooses you, they will contact you soon. If after 5 days the Client does not contact you, that means the Client has chosen another tutor. Thank you.\r\n\r\nThis is an auto message from TutorKami.com. Please do not reply to this no number";
                            $xdata->args = $args;
                            $make_call2 = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                            if($make_call2){
                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET  wa_user = '".$roSendWa['wa_manual']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                $exeWaNoti = $conn->query($sqlWaNoti);
                                					            
                                $sqlWaNoti2 = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$roSendWa['wa_job_id']."', wa_user = '".$roSendWa['wa_user']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call2."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                $exeWaNoti2 = $conn->query($sqlWaNoti2);
                                
                                $delete = "DELETE FROM tk_whatsapp_noti_dummy WHERE wa_id = '".$roSendWa['wa_id']."' ";
                                $conn->query($delete);
                                
                            }else{
                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$roSendWa['wa_job_id']."', wa_user = '".$roSendWa['wa_user']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                                $exeWaNoti = $conn->query($sqlWaNoti);
                                
                                $delete = "DELETE FROM tk_whatsapp_noti_dummy WHERE wa_id = '".$roSendWa['wa_id']."' ";
                                $conn->query($delete);
                            }        
    }
}

















$conn -> close();

/*
$website = "https://wa.tutorkami.my/api-docs/";
if( !activeAPI( $website ) ) {
    //echo $website ." is down!";
    
    $server = " SELECT * FROM tk_server ";
    $resulServer = $conn->query($server);
    if ($resulServer->num_rows > 0) {
        $rowServer = $resulServer->fetch_assoc();
        
        if( $rowServer['status'] == 'OK'){
            
            $sql = "UPDATE tk_server SET status='Down', time='".date('d/m/Y H:i:s')."' WHERE id ='1' ";
            $conn->query($sql);
            
            $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com";
            $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
            $emailBody 	  = "Status : Server is down! <br>Time : ".date('d/m/Y H:i:s');
        
            $headers = 'From: Tutorkami' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            mail($to, $emailSubject, $emailBody, $headers);  
        }
        
    }else{
        $sqlWaNoti = "INSERT INTO tk_server SET status = 'Down', time='".date('d/m/Y H:i:s')."' ";
        $exeWaNoti = $conn->query($sqlWaNoti);
        
        $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com";
        $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
        $emailBody 	  = "Status : Server is down! <br>Time : ".date('d/m/Y H:i:s');
    
        $headers = 'From: Tutorkami' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        mail($to, $emailSubject, $emailBody, $headers); 
    }
    
} else {
    
    $server = " SELECT * FROM tk_server ";
    $resulServer = $conn->query($server);
    if ($resulServer->num_rows > 0) {
        $rowServer = $resulServer->fetch_assoc();
        
        if( $rowServer['status'] == 'Down'){
            
            $sql = "UPDATE tk_server SET status='OK', time='".date('d/m/Y H:i:s')."' WHERE id ='1' ";
            $conn->query($sql);
            
            $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com";
            $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
            $emailBody 	  = "Status : Server is working! <br>Time : ".date('d/m/Y H:i:s');
        
            $headers = 'From: Tutorkami' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
            mail($to, $emailSubject, $emailBody, $headers);   
        }
        
    }else{
        $sqlWaNoti = "INSERT INTO tk_server SET status = 'OK', time='".date('d/m/Y H:i:s')."' ";
        $exeWaNoti = $conn->query($sqlWaNoti);
        
        //echo $website ." functions correctly.";
        $to      = "tkcto.malaysia@gmail.com, tutorkami.malaysia@gmail.com";
        $emailSubject = 'WhatsApp Server Uptime Monitoring ';	
        $emailBody 	  = "Status : Server is working! <br>Time : ".date('d/m/Y H:i:s');
    
        $headers = 'From: Tutorkami' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        mail($to, $emailSubject, $emailBody, $headers);    
    }
    

}
*/


?>
