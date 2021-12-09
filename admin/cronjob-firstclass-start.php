<?php
/* 09 Issues Sept 2020 - No 18 b.ii */
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$website = "https://wa.tutorkami.my/api-docs/";
date_default_timezone_set("Asia/Kuala_Lumpur");

$currentDate = date('Y-m-d');
//$currentDate = date('2019-02-13');
$dateRec = str_replace('-', '/', $currentDate);
$tomorrow = date('Y-m-d',strtotime($dateRec . "+1 days"));

// START Class reminder to Parent - send pukul 2pm - 1 hari sebelum deadline
$allowSend = " SELECT wa_job_id, wa_user FROM tk_send_wa ";
$resultallowSend = $conn->query($allowSend);
if ($resultallowSend->num_rows > 0) {
	while($rowallowSend = $resultallowSend->fetch_assoc()){
	    
    $getPhone = " SELECT u_id, ud_u_id, ud_phone_number FROM tk_user INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_id = '".$rowallowSend['wa_user']."' ";	
    $resultPhone = $conn->query($getPhone);
    if ($resultPhone->num_rows > 0) {
        $rowPhone = $resultPhone->fetch_assoc();			
        $ThisPhoneNo = $rowPhone['ud_phone_number'];		
    }else{
        $ThisPhoneNo = '-';
    }
	    
	    
	    
    $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_note = 'Yes' AND wa_user = '".$ThisPhoneNo."' ";
    $resultLogWa = $conn->query($queryLogWa);
    if ($resultLogWa->num_rows > 0) {
    
	    
		//echo $rowallowSend['wa_job_id'];
		$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
		$resultJob = $conn->query($Job);
		if ($resultJob->num_rows > 0) {
			$rowJob = $resultJob->fetch_assoc();
			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
				//echo $rowJob['j_id'];
				$Client = " SELECT ud_u_id, salutation, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
				$resultClient = $conn->query($Client);
				if ($resultClient->num_rows > 0) {
					$rowClient = $resultClient->fetch_assoc();		
					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];		
					$clientID = $rowClient['ud_u_id'];	
					$salutation = $rowClient['salutation'];
				}else{
					$clientName = '';
					$clientID = '';
					$salutation = '';
				}
				
				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
				$resultTutor = $conn->query($Tutor);
				if ($resultTutor->num_rows > 0) {
					$rowTutor = $resultTutor->fetch_assoc();		
					$TutorDisplayName = $rowTutor['u_displayname'];		
					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];		
				}else{
					$TutorDisplayName = '';
					$TutorPhoneNo = '';
				}
                /*
                if( !activeAPI( $website ) ) {
                    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = 'Class Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
                    $exeWaNoti = $conn->query($sqlWaNoti);
                }else{
    				$args = new stdClass();
    				$xdata = new stdClass();
    				$args->to = "6".$rowJob['j_telephone']."@c.us";
    				$args->content = "Salam/Hi ".ucwords($clientName).", mohon confirm kan kelas esok dengan ".ucwords($TutorDisplayName)." dengan menekan link ini https://wa.me/".$TutorPhoneNo."?text=sayaconfirmesokkelasjadi dan tekan Send untuk hantarnya kepada tutor. \r\n\r\nJika ".ucwords($salutation)." tidak confirm kelas esok dengan tutor hari ini, maka kelas esok TIDAK AKAN dijalankan oleh tutor. Terima kasih atas kerjasama ".ucwords($salutation).".\r\n\r\n\r\n (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)";
    				$xdata->args = $args;
    				
    				$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
    				if($make_call){
    					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
    					$exeWaNoti = $conn->query($sqlWaNoti);
    				}else{
    					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
    					$exeWaNoti = $conn->query($sqlWaNoti);
    				}                    
                }
                */
                $xdata = array( "to" => "6".$rowJob['j_telephone'],
                        "message" => "Salam/Hi ".ucwords($clientName).", mohon confirm kan kelas esok dengan ".ucwords($TutorDisplayName)." dengan menekan link ini https://wa.me/".$TutorPhoneNo."?text=sayaconfirmesokkelasjadi dan tekan Send untuk hantarnya kepada tutor. newLine Jika ".ucwords($salutation)." tidak confirm kelas esok dengan tutor hari ini, maka kelas esok TIDAK AKAN dijalankan oleh tutor. Terima kasih atas kerjasama ".ucwords($salutation).". newLine (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)" );
                $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                if($make_call){
                    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
                    $exeWaNoti = $conn->query($sqlWaNoti);
                }else{
                    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
                    $exeWaNoti = $conn->query($sqlWaNoti);
                } 
			}
		}
	sleep(5);
    }
	}
}
// END Class reminder to Parent - send pukul 2pm


$currentDate2 = date('Y-m-d');
$dateRec2 = str_replace('-', '/', $currentDate2);
$tomorrow2 = date('Y-m-d',strtotime($dateRec2 . "+2 days"));

// START End reminder to Tutor - send pukul 2pm - 2 hari sebelum deadline
$SendTutor = " SELECT wa_job_id, wa_user FROM tk_send_wa ";
$resultSendTutor = $conn->query($SendTutor);
if ($resultSendTutor->num_rows > 0) {
	while($rowSendTutor = $resultSendTutor->fetch_assoc()){
	    
	    $tutorID = '';
        $getTutorID = " SELECT j_id, u_id_tutor FROM tk_job WHERE j_id = '".$rowSendTutor['wa_job_id']."' ";	
        $resultTutorID = $conn->query($getTutorID);
        if ($resultTutorID->num_rows > 0) {
            $rowTutorID = $resultTutorID->fetch_assoc();	
            $tutorID = $rowTutorID['u_id_tutor'];
        }
	    
        $getPhone = " SELECT u_id, u_displayname, ud_u_id, ud_phone_number FROM tk_user INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_id = '".$tutorID."' ";	
        $resultPhone = $conn->query($getPhone);
        if ($resultPhone->num_rows > 0) {
            $rowPhone = $resultPhone->fetch_assoc();	
            $TutorDisplayName = $rowPhone['u_displayname'];
            $TutorPhoneNo = "6".$rowPhone['ud_phone_number'];
            $ThisPhoneNo = $rowPhone['ud_phone_number'];
        }else{
            $TutorDisplayName = '';
            $TutorPhoneNo = '-';
            $ThisPhoneNo = '-';
        }
        
      
        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_note = 'Yes' AND wa_user = '".$ThisPhoneNo."' ";
        $resultLogWa = $conn->query($queryLogWa);
        if ($resultLogWa->num_rows > 0) {    
            
    		//$Job = " SELECT j_id, jt_j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowSendTutor['wa_job_id']."' AND j_deadline = '".$tomorrow2."' ";
    		$Job = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowSendTutor['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'paid' AND j_deadline = '".$tomorrow2."' ";
    		$resultJob = $conn->query($Job);
    		if ($resultJob->num_rows > 0) {
    			$rowJob = $resultJob->fetch_assoc();
/* */   			
    			$LinkKelas = " SELECT * FROM tk_classes_record INNER JOIN tk_classes ON cl_id = cr_cl_id WHERE cl_display_id = '".$rowJob['j_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
    			$resLinkKelas = $conn->query($LinkKelas);
    			if ($resLinkKelas->num_rows > 0) {
    			    $roLinkKelas = $resLinkKelas->fetch_assoc();
    			    if( $roLinkKelas['cr_status'] =='Tutor Paid'  ){
    			        /*
        				if( !activeAPI( $website ) ) {
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowSendTutor['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Cycle Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				    
        				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
        				    $plusAC = date('d/m/y').' - Done auto WA tutor regarding the start date of new cycle. Log Fail - System';
        				    $output = $plusAC."\r\n".$acHistory;
        				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
        				    $conn->query($sqlUpdate);   
        				    
        				}else{
            				$args = new stdClass();
            				$xdata = new stdClass();
            				$args->to = $TutorPhoneNo."@c.us";
            				$args->content = "Salam/Hi ".ucwords($TutorDisplayName).",\r\nPlease update the Online Record system once you have started the next class for Job ".$rowJob['j_id'].", so we can bill the Client immediately and you will get your next payment on time. Thank you.\r\n\r\n\r\n(This is an automatic message from TutorKami.com. Please do not reply to this number) ";
            				$xdata->args = $args;
            				
            				$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
            				if($make_call){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowSendTutor['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Cycle Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            					
            					$acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Done auto WA tutor regarding the start date of new cycle. Log successful - System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate); 
            					
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowSendTutor['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Cycle Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            					
            					$acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Done auto WA tutor regarding the start date of new cycle. Log error - System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate); 
            				}
        				}
        				*/
            				$xdata = array( "to" => "6".$ThisPhoneNo,
            				        "message" => "Salam/Hi ".ucwords($TutorDisplayName).", newLine Please update the Online Record system once you have started the next class for Job ".$rowJob['j_id'].", so we can bill the Client immediately and you will get your next payment on time. Thank you. newLine (This is an automatic message from TutorKami.com. Please do not reply to this number) " );
            				$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
            				if($make_call){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowSendTutor['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Cycle Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            					
            					$acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Done auto WA tutor regarding the start date of new cycle. Log successful - System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate); 
            					
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowSendTutor['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Cycle Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            					
            					$acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Done auto WA tutor regarding the start date of new cycle. Log error - System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate); 
            				}

    			    }
    			}
/* */			


    		}
        }
	}
}
// START End reminder to Tutor - send pukul 2pm - 2 hari sebelum deadline
$conn -> close();








/***** Auto Send WhatsApp ****/
/*
    $args = new stdClass();
    $xdata = new stdClass();
    $args->to = "60172327809@c.us";
    //$args->content = "Latest job : ".strtolower($value)." in ".strtolower($data['j_area']).". Please click link to apply https://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']." ";
    $args->content = "Dari cronJob";
    $xdata->args = $args;
    
    $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );    
*/
/***** Auto Send WhatsApp ****/


?>
