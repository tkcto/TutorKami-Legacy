<?php
/* 09 Issues Sept 2020 - No 18 b.iv */
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

// START Class reminder to Tutor - send pukul 8pm - 1 hari sebelum deadline
$allowSend = " SELECT wa_job_id, wa_user FROM tk_send_wa ";
$resultallowSend = $conn->query($allowSend);
if ($resultallowSend->num_rows > 0) {
	while($rowallowSend = $resultallowSend->fetch_assoc()){
	    
	    
//https://docs.google.com/document/d/1cSUndgBFyNYu1KDMIImlV8b5weD_UQwOxYAKz4sNcGs/edit - isu 13
//Start
    $Job = " SELECT jt_j_id, j_id, j_status, j_payment_status, j_deadline, j_hired_tutor_email, u_id, jt_comments FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'open' AND j_payment_status = 'pending' AND j_deadline = '".$currentDate."' ";
    $resultJob = $conn->query($Job);
    if ($resultJob->num_rows > 0) {
        $rowJob = $resultJob->fetch_assoc();
        if( $rowJob['j_hired_tutor_email'] == '' ){

            $nextStep = '';
            $phoneParent = '';
            $msjToParent = '';
            $Parent = " SELECT u_id, ud_u_id, ud_client_status_2, signature_img, signature_img2, signature_img3, u_lang, ud_phone_number, salutation, ud_first_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$rowJob['u_id']."' ";
            $resultParent = $conn->query($Parent);
            if ($resultParent->num_rows > 0) {
                $rowParent = $resultParent->fetch_assoc();
                if( $rowParent['ud_client_status_2'] == 'Tuition Centre' ){
                    if( $rowParent['signature_img3'] == '' ){
                        $nextStep = 'Tuition Centre did not sign term - ';
                    }else{
                        $nextStep = 'Ok';
                    }
                }else{
                    if( $rowParent['signature_img'] == '' && $rowParent['signature_img2'] == '' ){
                        $nextStep = 'Parents did not sign term - ';
                    }else{
                        $nextStep = 'Ok';
                    }
                }
                if( $rowParent['u_lang'] == 'BM' ){
                    $msjToParent = "Salam/Hi ".ucwords($rowParent['salutation'])." ".ucwords($rowParent['ud_first_name']).".newLineSila klik pautan di bawah untuk inform kami jika anda telah memilih tutor, atau jika anda ingin kami mendapatkan profil tutor lain. newLine<link> ";
                }else{
                    $msjToParent = "Salam/Hi ".ucwords($rowParent['salutation'])." ".ucwords($rowParent['ud_first_name']).".newLinePlease click the link below to inform us if you have chosen the tutor, or if you’d like us to get other tutor’s profiles for you. newLine<link> ";
                }
                $phoneParent = $rowParent['ud_phone_number'];
            }
            if( $nextStep != '' ){
                if( $nextStep == 'Ok' ){
                    $Subscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$phoneParent."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                    $resultSubscribe = $conn->query($Subscribe);
                    if ($resultSubscribe->num_rows > 0) {
                        //echo 'Tutor : Unsubscribed - ';
                    }else{
                        $updateDeadLine = "UPDATE tk_job SET j_deadline = '".$tomorrow."' WHERE j_id = '".$rowallowSend['wa_job_id']."' ";
                        $conn->query($updateDeadLine);

                        $historyAC = $conn -> real_escape_string($row['jt_comments']);
                        $remarks = date("d/m/y")." - sent auto msg to Client to ask siapa tutor yg dia pilih. Deadline changed to ".$tomorrow." - System\r\n".$historyAC;
                        $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks."' WHERE jt_j_id = '".$rowallowSend['wa_job_id']."' ";
                        $conn->query($sqlAC);
                        
                        $xdata = array( "to" => "6".$phoneParent,
                            "message" => $msjToParent );
                        $make_call = '';
                        $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                        $response = json_decode($make_call, true);
                        $data     = $response['message'];
                        /*
                        if( $data == 'Sent Successfully' ){
                            echo $data.' - T';
                        }else{
                            echo 'Error : Something Wrong !. Please check wsapme. - ';
                        }*/
                    }
                }
            }

        }
    }
//End

	    $tutorID = '';
        $getTutorID = " SELECT j_id, u_id_tutor FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' ";	
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
            /*
            $args = new stdClass();
            $xdata = new stdClass();
            $args->contactId = $TutorPhoneNo."@c.us";
            $xdata->args = $args;
                                                    	
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
            $response = json_decode($make_call, true);
            $dataPhone     = $response['response']['id'];
                                                    	        
            if( $dataPhone != '' ){

        		$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
        		$resultJob = $conn->query($Job);
        		if ($resultJob->num_rows > 0) {
        			$rowJob = $resultJob->fetch_assoc();
        			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
        				$Client = " SELECT ud_u_id, salutation, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
        				$resultClient = $conn->query($Client);
        				if ($resultClient->num_rows > 0) {
        					$rowClient = $resultClient->fetch_assoc();		
        					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];	
        					$clientPhoneNo = "6".$rowClient['ud_phone_number'];				
        				}else{
        					$clientName = '';
        					$clientPhoneNo = '';
        				}
        				
        				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
        						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
        						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
        				$resultTutor = $conn->query($Tutor);
        				if ($resultTutor->num_rows > 0) {
        					$rowTutor = $resultTutor->fetch_assoc();		
        					$TutorDisplayName = $rowTutor['u_displayname'];		
        					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];	
        					$TutorID = $rowTutor['u_id'];	
        				}else{
        					$TutorDisplayName = '';
        					$TutorPhoneNo = '';
        					$TutorID = '';
        				}
        				
        				if( !activeAPI( $website ) ) {
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Class Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}else{
            				$args = new stdClass();
            				$xdata = new stdClass();
            				$args->to = $TutorPhoneNo."@c.us";
            				$args->content = "Salam/Hi ".ucwords($TutorDisplayName).", sudah kah anda terima confirmation untuk kelas esok dari ".ucwords($clientName).", ".$clientPhoneNo." ? Jika tidak terima, ini bermakna kelas esok tidak jadi dan anda TIDAK PERLU teruskan untuk buat kelas. Mohon inform Coordinator kami segera yang klien tidak confirm kelas esok untuk bermula.\r\n\r\nJika kelas bermula esok, di akhir sesi, anda boleh terus masukkan rekod kelas di link www.tutorkami.com/my-classes\r\n\r\nTerima kasih ".ucwords($TutorDisplayName).".";
            				$xdata->args = $args;
            				
            				$make_call2 = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
            				if($make_call2){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}        				    
        				}
				
        			}
        		}

            }
            */

        		$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
        		$resultJob = $conn->query($Job);
        		if ($resultJob->num_rows > 0) {
        			$rowJob = $resultJob->fetch_assoc();
        			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
        				$Client = " SELECT ud_u_id, salutation, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
        				$resultClient = $conn->query($Client);
        				if ($resultClient->num_rows > 0) {
        					$rowClient = $resultClient->fetch_assoc();		
        					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];	
        					$clientPhoneNo = "6".$rowClient['ud_phone_number'];				
        				}else{
        					$clientName = '';
        					$clientPhoneNo = '';
        				}
        				
        				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
        						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
        						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
        				$resultTutor = $conn->query($Tutor);
        				if ($resultTutor->num_rows > 0) {
        					$rowTutor = $resultTutor->fetch_assoc();		
        					$TutorDisplayName = $rowTutor['u_displayname'];		
        					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];	
        					$TutorID = $rowTutor['u_id'];	
        				}else{
        					$TutorDisplayName = '';
        					$TutorPhoneNo = '';
        					$TutorID = '';
        				}


        				$xdata = array( "to" => $TutorPhoneNo,
        				        "message" => "Salam/Hi ".ucwords($TutorDisplayName).", sudah kah anda terima confirmation untuk kelas esok dari ".ucwords($clientName).", ".$clientPhoneNo." ? Jika tidak terima, ini bermakna kelas esok tidak jadi dan anda TIDAK PERLU teruskan untuk buat kelas. Mohon inform Coordinator kami segera yang klien tidak confirm kelas esok untuk bermula. newLine Jika kelas bermula esok, di akhir sesi, anda boleh terus masukkan rekod kelas di link www.tutorkami.com/my-classes newLine Terima kasih ".ucwords($TutorDisplayName)."." );
        				$make_call2 = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
        				if($make_call2){
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}else{
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$tutorID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}        				    
        				
				
        			}
        		}
        		
        		
	    
	    
/*
    $getPhone = " SELECT u_id, ud_u_id, ud_phone_number FROM tk_user INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_id = '".$rowallowSend['wa_user']."' ";	
    $resultPhone = $conn->query($getPhone);
    if ($resultPhone->num_rows > 0) {
        $rowPhone = $resultPhone->fetch_assoc();			
        $ThisPhoneNo = $rowPhone['ud_phone_number'];		
    }else{
        $ThisPhoneNo = '-';
    }
	     	    
        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_user = '".$ThisPhoneNo."' ";
        $resultLogWa = $conn->query($queryLogWa);
        if ($resultLogWa->num_rows > 0) {
            $rowLogWa = $resultLogWa->fetch_assoc();
            if( $rowLogWa['wa_note'] == 'Yes' ){
        		//echo $rowallowSend['wa_job_id'];
        		$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
        		$resultJob = $conn->query($Job);
        		if ($resultJob->num_rows > 0) {
        			$rowJob = $resultJob->fetch_assoc();
        			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
        				//echo $rowJob['j_id'];
        				$Client = " SELECT ud_u_id, salutation, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
        				$resultClient = $conn->query($Client);
        				if ($resultClient->num_rows > 0) {
        					$rowClient = $resultClient->fetch_assoc();		
        					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];	
        					$clientPhoneNo = "6".$rowClient['ud_phone_number'];				
        				}else{
        					$clientName = '';
        					$clientPhoneNo = '';
        				}
        				
        				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
        						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
        						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
        				$resultTutor = $conn->query($Tutor);
        				if ($resultTutor->num_rows > 0) {
        					$rowTutor = $resultTutor->fetch_assoc();		
        					$TutorDisplayName = $rowTutor['u_displayname'];		
        					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];	
        					$TutorID = $rowTutor['u_id'];	
        				}else{
        					$TutorDisplayName = '';
        					$TutorPhoneNo = '';
        					$TutorID = '';
        				}
        				
        				if( !activeAPI( $website ) ) {
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}else{
            				$args = new stdClass();
            				$xdata = new stdClass();
            				$args->to = $TutorPhoneNo."@c.us";
            				$args->content = "Salam/Hi ".ucwords($TutorDisplayName).", sudah kah anda terima confirmation kelas esok dari ".ucwords($clientName).", ".$clientPhoneNo." ? Jika tidak terima, ini bermakna kelas esok tidak jadi dan anda TIDAK PERLU teruskan untuk buat kelas. Mohon inform Coordinator kami segera yang klien tidak confirm kelas esok untuk bermula.\r\n\r\nJika kelas bermula esok, di akhir sesi, anda boleh terus masukkan rekod kelas di link www.tutorkami.com/my-classes\r\n\r\nTerima kasih ".ucwords($TutorDisplayName).".";
            				$xdata->args = $args;
            				
            				$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
            				if($make_call){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}        				    
        				}
				
        			}
        		}
            }else if( $rowLogWa['wa_note'] == 'No' ){
                
        		$Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
        		$resultJob = $conn->query($Job);
        		if ($resultJob->num_rows > 0) {
        			$rowJob = $resultJob->fetch_assoc();
        			if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
        				//echo $rowJob['j_id'];
        				$Client = " SELECT ud_u_id, salutation, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
        				$resultClient = $conn->query($Client);
        				if ($resultClient->num_rows > 0) {
        					$rowClient = $resultClient->fetch_assoc();		
        					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];	
        					$clientPhoneNo = "6".$rowClient['ud_phone_number'];				
        				}else{
        					$clientName = '';
        					$clientPhoneNo = '';
        				}
        				
        				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
        						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
        						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
        				$resultTutor = $conn->query($Tutor);
        				if ($resultTutor->num_rows > 0) {
        					$rowTutor = $resultTutor->fetch_assoc();		
        					$TutorDisplayName = $rowTutor['u_displayname'];		
        					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];	
        					$TutorID = $rowTutor['u_id'];	
        				}else{
        					$TutorDisplayName = '';
        					$TutorPhoneNo = '';
        					$TutorID = '';
        				}
        				
        				if( !activeAPI( $website ) ) {
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}else{
            				$args = new stdClass();
            				$xdata = new stdClass();
            				$args->to = $TutorPhoneNo."@c.us";
            				$args->content = "Salam/Hi ".ucwords($TutorDisplayName).", sudah kah anda terima confirmation kelas esok dari ".ucwords($clientName).", ".$clientPhoneNo." ? Jika tidak terima, ini bermakna kelas esok tidak jadi dan anda TIDAK PERLU teruskan untuk buat kelas. Mohon inform Coordinator kami segera yang klien tidak confirm kelas esok untuk bermula.\r\n\r\nJika kelas bermula esok, di akhir sesi, anda boleh terus masukkan rekod kelas di link www.tutorkami.com/my-classes\r\n\r\nTerima kasih ".ucwords($TutorDisplayName).".";			
            				$xdata->args = $args;
            				
            				$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
            				if($make_call){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}        				    
        				}
				
        			}
        		}
                
                
            }
        }else{
            $Job = " SELECT j_id, j_status, j_payment_status, j_deadline, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_deadline = '".$tomorrow."' ";	
            $resultJob = $conn->query($Job);
            if ($resultJob->num_rows > 0) {
                $rowJob = $resultJob->fetch_assoc();
                if( $rowJob['j_deadline'] != '' && $rowJob['j_deadline'] != '0000-00-00' ){
                    
        				$Client = " SELECT ud_u_id, salutation, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
        				$resultClient = $conn->query($Client);
        				if ($resultClient->num_rows > 0) {
        					$rowClient = $resultClient->fetch_assoc();		
        					$clientName = $rowClient['salutation'].' '.$rowClient['ud_first_name'];
        					$clientPhoneNo = "6".$rowClient['ud_phone_number'];				
        				}else{
        					$clientName = '';
        					$clientPhoneNo = '';
        				}
        				
        				$Tutor = " SELECT u_id, ud_u_id, u_email, u_displayname, ud_phone_number FROM tk_user 
        						   INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id    
        						   WHERE u_email = '".$rowJob['j_hired_tutor_email']."' ";	
        				$resultTutor = $conn->query($Tutor);
        				if ($resultTutor->num_rows > 0) {
        					$rowTutor = $resultTutor->fetch_assoc();		
        					$TutorDisplayName = $rowTutor['u_displayname'];		
        					$TutorPhoneNo = "6".$rowTutor['ud_phone_number'];	
        					$TutorPhoneNo2 = $rowTutor['ud_phone_number'];
        					$TutorID = $rowTutor['u_id'];	
        				}else{
        					$TutorDisplayName = '';
        					$TutorPhoneNo = '';
        					$TutorPhoneNo2 = '';
        					$TutorID = '';
        				}
        				
        				if( !activeAPI( $website ) ) {
        				    $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
        				    $exeWaNoti = $conn->query($sqlWaNoti);
        				}else{
            				$args = new stdClass();
            				$xdata = new stdClass();
            				$args->to = $TutorPhoneNo."@c.us";
            				$args->content = "Salam/Hi ".ucwords($TutorDisplayName).", sudah kah anda terima confirmation kelas esok dari ".ucwords($clientName).", ".$clientPhoneNo." ? Jika tidak terima, ini bermakna kelas esok tidak jadi dan anda TIDAK PERLU teruskan untuk buat kelas. Mohon inform Coordinator kami segera yang klien tidak confirm kelas esok untuk bermula.\r\n\r\nJika kelas bermula esok, di akhir sesi, anda boleh terus masukkan rekod kelas di link www.tutorkami.com/my-classes\r\n\r\nTerima kasih ".ucwords($TutorDisplayName).".";			
            				$xdata->args = $args;
            				
            				$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
            				if($make_call){
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_user = '".$TutorPhoneNo2."', wa_remark = 'Welcome',  wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				    
            					$sqlWaNoti2 = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti2 = $conn->query($sqlWaNoti2);
            				}else{
            					$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$rowallowSend['wa_job_id']."', wa_user = 'TutorID : ".$TutorID."', wa_remark = 'Class Reminder', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
            					$exeWaNoti = $conn->query($sqlWaNoti);
            				}        				    
        				}
                }
            }
        }
*/
	//sleep(5);
	}
}
// END Class reminder to Tutor - send pukul 8pm - 1 hari sebelum deadline
$conn -> close();
?>
