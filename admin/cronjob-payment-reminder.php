<?php
/* 09 Issues Sept 2020 - No 19 */
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
/*$currentDate = date('2020-09-08');
echo $currentDate.'<br/>';*/

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
		
		//$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_end_date, j_telephone, j_hired_tutor_email, parent_rate, cycle, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'paid' ";	
       
        $Job = " SELECT * FROM tk_job
        INNER JOIN tk_job_translation ON jt_j_id = j_id
        INNER JOIN tk_classes ON j_id = cl_display_id
        INNER JOIN tk_classes_record ON cl_id = cr_cl_id
        WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'paid'
        ORDER BY cr_date DESC, cr_start_time DESC ";
		$resultJob = $conn->query($Job);
		if ($resultJob->num_rows > 0) {
			$rowJob = $resultJob->fetch_assoc();
			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
			    
				$dateEndDate = str_replace('-', '/', $rowJob['j_deadline']);
				$firstRemnder = date('Y-m-d',strtotime($dateEndDate . "-5 days"));
				$secondRemnder = date('Y-m-d',strtotime($dateEndDate . "-3 days"));
				
				$amaun = $rowJob['parent_rate'] * $rowJob['cycle'];
				
				/*echo $rowJob['j_id'].' - '.$firstRemnder.'<br/>';
				echo $rowJob['j_id'].' - '.$secondRemnder.'<br/>';*/
				
				$Client = " SELECT u_id, ud_u_id, u_email, u_gender, ud_phone_number, salutation, ud_first_name FROM tk_user 
						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
						   WHERE u_email = '".$rowJob['j_email']."' ";	
				$resultClient = $conn->query($Client);
				if ($resultClient->num_rows > 0) {
					$rowClient = $resultClient->fetch_assoc();		
					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];	
					$clientsalutation = $rowClient['salutation'];	
					$clientID = $rowClient['u_id'];			
					
					if( $rowClient['u_gender'] == 'M' || $rowClient['u_gender'] == 'm' ){
						$clientGender = 'Tuan';
					}else if( $rowClient['u_gender'] == 'F' || $rowClient['u_gender'] == 'f' ){
						$clientGender = 'Puan';
					}else{
						$clientGender = '';
					}
					
				}else{
					$clientName = '';
					$clientID = '';
					$clientGender = '';
				}			    
			    
				$Tutor = " SELECT u_id, resit_pv_name, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
				$resultTutor = $conn->query($Tutor);
				if ($resultTutor->num_rows > 0) {
					$rowTutor = $resultTutor->fetch_assoc();
					if( $rowTutor['resit_pv_name'] != '' ){
					    $TutorDisplayName = $rowTutor['resit_pv_name'];	
					}else{
					    $TutorDisplayName = $rowTutor['u_displayname'];	
					}
					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];		
				}else{
					$TutorDisplayName = '';
					$TutorPhoneNo = '';
				}			 
				

				$cycle = ($rowJob['row_no']+1);
				
				$pad_length = 2;
				$pad_char = 0;
				$thisCycle = str_pad($rowJob['row_no'], $pad_length, $pad_char, STR_PAD_LEFT);
			    
			    
			    if( $rowJob['cr_status'] == 'Required Parent To Pay' ){
        				if( $currentDate == $firstRemnder ){
        				    /*
        				    if( !activeAPI( $website ) ) {
                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '1st Payment Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
                                $exeWaNoti = $conn->query($sqlWaNoti);
                                
            				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Payment reminder has been fail sent to the Client- System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate);
                                
        				    }else{
            					$args = new stdClass();
            					$xdata = new stdClass();
            					$args->to = "6".$rowJob['j_telephone']."@c.us";
            					$args->content = "Salam/Hi ".ucwords($clientName).", mohon ".ucwords($clientsalutation)." buat bayaran berjumlah RM ".$amaun." ke akaun Maybank 569954063020 (TK Edu Sdn Bhd) untuk cycle #".$cycle.", Invoice i".$rowJob['j_id'].$thisCycle." bagi kelas ".ucwords($TutorDisplayName)." ya. Terima kasih ".ucwords($clientsalutation)."\r\n\r\n(Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)";		
            					$xdata->args = $args;
            					
            					$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 		
            					if($make_call){
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '1st Payment Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);

                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been auto sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
                				    
            					}else{
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '1st Payment Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been error sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            				    
            					}				        
        				    }
        				    */

            					$xdata = array( "to" => "6".$rowJob['j_telephone'],
            					        "message" => "Salam/Hi ".ucwords($clientName).", mohon ".ucwords($clientsalutation)." buat bayaran berjumlah RM ".$amaun." ke akaun Maybank 569954063020 (TK Edu Sdn Bhd) untuk cycle #".$cycle.", Invoice i".$rowJob['j_id'].$thisCycle." bagi kelas ".ucwords($TutorDisplayName)." ya. Terima kasih ".ucwords($clientsalutation)." newLine (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)" );
            					$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
            					if($make_call){
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '1st Payment Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);

                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been auto sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
                				    
            					}else{
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '1st Payment Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been error sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            				    
            					}
        				}
        				if( $currentDate == $secondRemnder ){
        				    /*
        				    if( !activeAPI( $website ) ) {
                                $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '2nd Payment Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
                                $exeWaNoti = $conn->query($sqlWaNoti);
                                
            				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
            				    $plusAC = date('d/m/y').' - Payment reminder has been fail sent to the Client- System';
            				    $output = $plusAC."\r\n".$acHistory;
            				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            				    $conn->query($sqlUpdate);
                                
        				    }else{
            					$args = new stdClass();
            					$xdata = new stdClass();
            					$args->to = "6".$rowJob['j_telephone']."@c.us";
            					$args->content = "Salam/Hi ".ucwords($clientName).", mohon ".ucwords($clientsalutation)." buat bayaran berjumlah RM ".$amaun." ke akaun Maybank 569954063020 (TK Edu Sdn Bhd) untuk cycle #".$cycle.", Invoice i".$rowJob['j_id'].$thisCycle." bagi kelas ".ucwords($TutorDisplayName)." ya. Terima kasih ".ucwords($clientsalutation)."\r\n\r\n(Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)";		
            					$xdata->args = $args;
            					
            					$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 				
            					if($make_call){
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '2nd Payment Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been auto sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            						
            					}else{
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '2nd Payment Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been error sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            					}				        
        				    }
        				    */
            					$xdata = array( "to" => "6".$rowJob['j_telephone'],
            					        "message" => "Salam/Hi ".ucwords($clientName).", mohon ".ucwords($clientsalutation)." buat bayaran berjumlah RM ".$amaun." ke akaun Maybank 569954063020 (TK Edu Sdn Bhd) untuk cycle #".$cycle.", Invoice i".$rowJob['j_id'].$thisCycle." bagi kelas ".ucwords($TutorDisplayName)." ya. Terima kasih ".ucwords($clientsalutation)." newLine (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)" );
            					$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
            					if($make_call){
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '2nd Payment Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been auto sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            						
            					}else{
            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'ClientID : ".$clientID."', wa_remark = '2nd Payment Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            						$exeWaNoti = $conn->query($sqlWaNoti);
            						
                				    $acHistory = $conn -> real_escape_string($rowJob['jt_comments']);
                				    $plusAC = date('d/m/y').' - Payment reminder has been error sent to the Client- System';
                				    $output = $plusAC."\r\n".$acHistory;
                				    $sqlUpdate = " UPDATE tk_job_translation SET jt_comments = '".$output."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
                				    $conn->query($sqlUpdate);
            					}
        				}			        
			    }

				
			}
			


	
		}
		
	//sleep(5);	
	}	
	}
}
$conn -> close();

?>