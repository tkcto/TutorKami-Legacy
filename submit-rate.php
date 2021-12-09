<?php
require_once('admin/classes/config.php.inc');
require_once('admin/classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
date_default_timezone_set("Asia/Kuala_Lumpur");



if(empty($_POST["ajobid"])){
    echo'Empty JobID';
    exit();
}else if(empty($_POST["thisuser"])){
    echo'Empty User';
    exit();
}else if(empty($_POST["alvl"])){
    echo'Empty Level';
    exit();
}else{
    $ajobid     = $conn->real_escape_string($_POST["ajobid"]);
    $thisuser   = $conn->real_escape_string($_POST["thisuser"]);
    $alvl       = $conn->real_escape_string($_POST["alvl"]);
    $rate_input = $conn->real_escape_string($_POST["rate_input"]);
    
    $chk = " SELECT * FROM tk_applied_job WHERE aj_j_id = '".$ajobid."' AND aj_u_id = '".$thisuser."' ";
    $resultChk = $conn->query($chk);
    if ($resultChk->num_rows > 0) {
        echo 'You have already applied for this job';
        exit();
    }else{
        $sql = "INSERT INTO tk_applied_job SET
        aj_j_id   = '$ajobid',
        aj_u_id   = '$thisuser',
        aj_status = 'P',
        aj_date   = '".date('Y-m-d H:i:s')."',
        aj_level  = '$alvl',
        aj_rate   = '$rate_input'";

        if( $conn->query($sql) === TRUE ) {
            
/***** Auto Send WhatsApp ****/

$website = "https://wa.tutorkami.my/api-docs/";

$queryCheckSend = " SELECT * FROM tk_send_wa WHERE wa_job_id = '".$ajobid."' "; 
$resultCheckSend = $conn->query($queryCheckSend); 
if($resultCheckSend->num_rows > 0){
    $rowCheckSend = $resultCheckSend->fetch_assoc();
    
    /*$queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status = 'POST' AND wa_note = 'Yes' AND wa_user = '".$rowCheckSend['wa_user']."' ";
    $resultLogWa = $conn->query($queryLogWa);
    if ($resultLogWa->num_rows > 0) {*/

			//$sqlGeJob = "SELECT j_id, j_deadline, j_telephone, j_creator_email, j_status, u_id, j_rating, j_email FROM tk_job WHERE j_id = '".$ajobid."' ";
			$sqlGeJob = "SELECT j_id, jt_j_id, jt_subject, j_deadline, j_telephone, j_creator_email, j_status, u_id, j_rating, j_email FROM tk_job INNER JOIN k_job_translation ON jt_j_id = j_id WHERE j_id = '".$ajobid."' ";
			$resultGeJob = $conn->query($sqlGeJob);
			if($resultGeJob->num_rows > 0){
				$rowGeJob = mysqli_fetch_array($resultGeJob);
				if( $rowGeJob['j_status'] == 'open' ){
    				if( $rowGeJob['j_deadline'] != '' && $rowGeJob['j_deadline'] != '0000-00-00' ){
    
    					$totalNumber = strlen($rowGeJob['j_telephone']); // count total number
    					$jobCoordinator = $rowGeJob['j_creator_email'];
    					if( $jobCoordinator == 'coordinator@tutorkami.com' ){
    						$noPhone = 'http://www.wasap.my/60122309743';
    					}else if( $jobCoordinator == 'coordinator2@tutorkami.com' ){
    						$noPhone = 'http://www.wasap.my/60196412395';
    					}else if( $jobCoordinator == 'coordinator3@tutorkami.com' ){
    						$noPhone = 'http://www.wasap.my/60198771868';
    					}else{
    						$noPhone = 'http://www.wasap.my/60198771868';
    					}

    					$sqlGetClient = "SELECT u_status, u_id, signature_img, signature_img2, salutation, ud_first_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_status = 'A' AND u_id = '".$rowGeJob['u_id']."' ";
    					$resultGeClient = $conn->query($sqlGetClient);
    					if($resultGeClient->num_rows > 0){
    					    $rowGetClient  = mysqli_fetch_array($resultGeClient);
    					    if( $rowGetClient['signature_img'] != '' || $rowGetClient['signature_img2'] != '' ){
/* Noti to tutor */
            							$sqlGeTutor = "SELECT u_id, u_email, ud_u_id, u_displayname, u_displayid, ud_first_name, ud_phone_number FROM tk_user 
            							INNER JOIN tk_user_details ON ud_u_id = u_id 
            							WHERE u_id = '".$thisuser."' ";
            							$resultGeTutor = $conn->query($sqlGeTutor);
            							if($resultGeTutor->num_rows > 0){
            								$rowGeTutor = mysqli_fetch_array($resultGeTutor);
            								$TutorPhoneNo = "6".$rowGeTutor['ud_phone_number'];
            								$TutorDisName = ucwords($rowGeTutor['u_displayname']);
            								$TutorDisID = $rowGeTutor['u_displayid']; 
            								

                                            /* Combined Average Rating */
                                            $allAdmin = array();
                                            $queryAdmin = " SELECT u_id, u_role FROM tk_user WHERE u_role = '2' "; 
                                            $resultAdmin = $conn->query($queryAdmin); 
                                            if($resultAdmin->num_rows > 0){
                                                while($rowAdmin = $resultAdmin->fetch_assoc()){ 
                                                    $allAdmin[] = $rowAdmin['u_id'];
                                                }     
                                            }
    
                                			$numRowRatingTTeam = 0;
                                            $queryRatingTTeam = " SELECT * FROM tk_review_rating_internal WHERE ri_tutor='".$thisuser."' "; 
                                            $resultRatingTTeam = $conn->query($queryRatingTTeam); 
                                            if($resultRatingTTeam->num_rows > 0){
                                				$rowRatingTTeam = $resultRatingTTeam->fetch_assoc();
                                				
                                				if( $rowRatingTTeam['ri_jobs'] =='true' || $rowRatingTTeam['ri_jobs'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_experience'] =='true' || $rowRatingTTeam['ri_experience'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_signed'] =='true' || $rowRatingTTeam['ri_signed'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_location'] =='true' || $rowRatingTTeam['ri_location'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_session'] =='true' || $rowRatingTTeam['ri_session'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_postponed'] =='true' || $rowRatingTTeam['ri_postponed'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_replied'] =='true' || $rowRatingTTeam['ri_replied'] =='true2' ){ $numRowRatingTTeam++; }
                                				if( $rowRatingTTeam['ri_cycles'] =='true' || $rowRatingTTeam['ri_cycles'] =='true2' ){ $numRowRatingTTeam++; }
                                                	for($iTeam = 0; $iTeam < $numRowRatingTTeam; $iTeam++) {
                                						if ($iTeam == 5) { break; }
                                                	}
                                                	$resultTeam = $iTeam;
                                			}else{
                                                 $resultTeam = '0';
                                            }

                                            $purataRatingPParent = 0;
                                            $numRowRatingPParent = 0;
                                            $purataPParent = '';
                                            $queryRatingPParent = " SELECT * FROM tk_review_rating WHERE rr_tutor_id='".$thisuser."' AND rr_status = 'approved' AND rr_parent_id NOT IN ( '" . implode( "', '" , $allAdmin ) . "' ) "; 
                                            $resultRatingPParent = $conn->query($queryRatingPParent); 
                                            if($resultRatingPParent->num_rows > 0){
                                                while($rowRatingPParent = $resultRatingPParent->fetch_assoc()){
                                                       $purataRatingPParent+=  $rowRatingPParent['rr_rating'];
                                                       $numRowRatingPParent++;
                                                } 
                                                $purataPParent = ($purataRatingPParent / $numRowRatingPParent);
                                            }else{
                                                 $purataPParent = '0';
                                            }
                                            
                                            $purataPParentR = round($purataPParent, 2);
                                            if( $resultTeam != '0' && $purataPParentR != '0' ){
                                                $thisCombined = (($resultTeam + $purataPParentR) / 2);
                                            }else{
                                                if( $resultTeam != '0' ){
                                                    $thisCombined = $resultTeam;
                                                }else{
                                                    $thisCombined = $purataPParentR;
                                                }
                                            }
                                            /* Combined Average Rating */
                                            if( $thisCombined >= $rowGeJob['j_rating'] ){

    
                        					        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$rowGeTutor['ud_phone_number']."' ";
                        					        $resultLogWa = $conn->query($queryLogWa);
                        					        if ($resultLogWa->num_rows > 0) {
                        					            $rowLogWa  = mysqli_fetch_array($resultLogWa);
                        					            if( $rowLogWa['wa_note'] == 'Yes' ){
                        					                
                                                            $xdata = array( "to" => "6".$rowGeTutor['ud_phone_number'],
                                                                    "message" => "Salam/Hi ".ucwords($rowGeTutor['u_displayname']).". Your profile and phone number had been sent to ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." for Job ".$rowGeJob['j_id'].", https://www.tutorkami.com/job_details?jid=".$rowGeJob['j_id']."&status=".$rowGeJob['j_status'].". If Client chooses you, they will contact you soon. If after 5 days the Client does not contact you, that means the Client has chosen another tutor. Thank you. newLine This is an auto message from TutorKami.com. Please do not reply to this no number" );
                                                            $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                            $response = json_decode($make_call, true);
                                                            
                                					        if($response['message'] == 'Sent Successfully'){
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$response['message']."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					        }else{
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					        }
                        					                
                        					            }
                        					        }
                                                /*
                                                if( !activeAPI( $website ) ) {
                            						$sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
                            						$exeWaNoti = $conn->query($sqlWaNoti);
                                                }else{
            					            
                                                    $args = new stdClass();
                                                    $xdata = new stdClass();
            					        
                        					        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$rowGeTutor['ud_phone_number']."' ";
                        					        $resultLogWa = $conn->query($queryLogWa);
                        					        if ($resultLogWa->num_rows > 0) {
                        					            $rowLogWa  = mysqli_fetch_array($resultLogWa);
                        					            if( $rowLogWa['wa_note'] == 'Yes' ){
                        					                
                                					        $args->to = "6".$rowGeTutor['ud_phone_number']."@c.us";
                                					        $args->content = "Salam/Hi ".ucwords($rowGeTutor['u_displayname']).". Your profile and phone number had been sent to ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." for Job ".$rowGeJob['j_id'].", https://www.tutorkami.com/job_details?jid=".$rowGeJob['j_id']."&status=".$rowGeJob['j_status'].". If Client chooses you, they will contact you soon. If after 5 days the Client does not contact you, that means the Client has chosen another tutor. Thank you.\r\n\r\nThis is an auto message from TutorKami.com. Please do not reply to this no number";
                                					        $xdata->args = $args;
                                					        $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                                					        if($make_call){
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					        }else{
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					        }
                        					                
                        					            }
                        					        }else{
                                                    	$args->contactId = "6".$rowGeTutor['ud_phone_number']."@c.us";
                                                    	$xdata->args = $args;
                                                    	
                                                    	$make_call = callAPI('POST', 'https://wa.tutorkami.my/getChatById', $xdata );
                                                    	$response = json_decode($make_call, true);
                                                    	$dataPhone     = $response['response']['id'];
                                                    	        
                                                    	if( $dataPhone != '' ){

                                					        $args->to = "6".$rowGeTutor['ud_phone_number']."@c.us";
                                					        $args->content = "Salam/Hi ".ucwords($rowGeTutor['u_displayname']).". Your profile and phone number had been sent to ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." for Job ".$rowGeJob['j_id'].", https://www.tutorkami.com/job_details?jid=".$rowGeJob['j_id']."&status=".$rowGeJob['j_status'].". If Client chooses you, they will contact you soon. If after 5 days the Client does not contact you, that means the Client has chosen another tutor. Thank you.\r\n\r\nThis is an auto message from TutorKami.com. Please do not reply to this no number";
                                					        $xdata->args = $args;
                                					        $make_call2 = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                                					        if($make_call2){
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET  wa_user = '".$rowGeTutor['ud_phone_number']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					            
                                					            $sqlWaNoti2 = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call2."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti2 = $conn->query($sqlWaNoti2);
                                					        }else{
                                					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                                					            $exeWaNoti = $conn->query($sqlWaNoti);
                                					        }
                                                    		
                                                    	}else{
                            					            $sqlWaNoti3 = "INSERT INTO tk_whatsapp_noti_dummy SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeTutor['u_id']." - ".$rowGeTutor['u_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."', wa_manual = '".$rowGeTutor['ud_phone_number']."' ";
                            					            $exeWaNoti3 = $conn->query($sqlWaNoti3);
                                                    	} 
                                                    	
                                                    	
                                                    	
                        					        }
                                                    
                                                }
                                                */
                                                
/* Noti to Parent */
            					if( preg_match("/^[0-9]+$/",$rowGeJob['j_telephone']) ){
            					    
            					        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$rowGeJob['j_telephone']."' ";
            					        $resultLogWa = $conn->query($queryLogWa);
            					        if ($resultLogWa->num_rows > 0) {
            					            $rowLogWa  = mysqli_fetch_array($resultLogWa);
            					            if( $rowLogWa['wa_note'] == 'Yes' ){
            					                
                    					        $xdata = array( "to" => "6".$rowGeJob['j_telephone'],
                    					                "message" => "Salam/Hi ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." we have a tutor who is interested to teach the student. This is the link to profile ".$TutorDisName." https://www.tutorkami.com/tutor_profile?did=".$TutorDisID." newLine You can message ".$TutorDisName." by clicking this link https://wa.me/".$TutorPhoneNo." " );
                    					        $make_call3 = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                            
                    					        $response = json_decode($make_call3, true);
                    					        if($response['message'] = 'Sent Successfully'){
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call3."', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					        }else{
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					        }
                    					        
            					            }
            					        }
            					    /*
            					    if( !activeAPI( $website ) ) {
            					        $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
            					        $exeWaNoti = $conn->query($sqlWaNoti);
            					    }else{
            					            
            					        $args = new stdClass();
            					        $xdata = new stdClass();
            					        
            					        $queryLogWa = " SELECT wa_user, wa_remark, wa_status, wa_note FROM tk_whatsapp_noti WHERE wa_remark = 'Welcome' AND wa_status='POST' AND wa_user = '".$rowGeJob['j_telephone']."' ";
            					        $resultLogWa = $conn->query($queryLogWa);
            					        if ($resultLogWa->num_rows > 0) {
            					            $rowLogWa  = mysqli_fetch_array($resultLogWa);
            					            if( $rowLogWa['wa_note'] == 'Yes' ){
            					                
                    					        $args->to = "6".$rowGeJob['j_telephone']."@c.us";
                    					        //$args->content = "Salam/Hi ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name']).". Regarding your tutor request for ".ucwords($rowGeJob['jt_subject']).", we have a tutor who is interested to teach. This is the link to profile ".$TutorDisName." https://www.tutorkami.com/tutor_profile?did=".$TutorDisID."\r\nYou can message ".$TutorDisName." by clicking this link https://wa.me/".$TutorPhoneNo." ";
                    					        $args->content = "Salam/Hi ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." we have a tutor who is interested to teach the student. This is the link to profile ".$TutorDisName." https://www.tutorkami.com/tutor_profile?did=".$TutorDisID."\r\nYou can message ".$TutorDisName." by clicking this link https://wa.me/".$TutorPhoneNo." ";
                    					        $xdata->args = $args;
                    					        $make_call3 = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                    					        if($make_call3){
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call3."', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					        }else{
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					        }
                    					        
            					            }
            					        }else{
                    					        $args->to = "6".$rowGeJob['j_telephone']."@c.us";
                    					        $args->content = "Salam/Hi ".ucwords($rowGetClient['salutation'].' '.$rowGetClient['ud_first_name'])." we have a tutor who is interested to teach the student. This is the link to profile ".$TutorDisName." https://www.tutorkami.com/tutor_profile?did=".$TutorDisID."\r\nYou can message ".$TutorDisName." by clicking this link https://wa.me/".$TutorPhoneNo." ";
                    					        $xdata->args = $args;
                    					        $make_call4 = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                    					        if($make_call4){
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET  wa_user = '".$rowGeJob['j_telephone']."', wa_remark = 'Welcome', wa_status = 'POST', wa_note = 'Yes', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					            
                    					            $sqlWaNoti2 = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = '".$make_call4."', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti2 = $conn->query($sqlWaNoti2);
                    					        }else{
                    					            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$ajobid."', wa_user = '".$rowGeJob['u_id']." - ".$rowGeJob['j_email']."', wa_remark = 'Apply Job', wa_status = 'POST', wa_note = 'Not Sent', wa_date = '".date('Y-m-d H:i:s')."' ";
                    					            $exeWaNoti = $conn->query($sqlWaNoti);
                    					        }
            					        }
            					    }
            					    */
            					}
/* Noti to Parent */                                                
                                                
                                                
                                            }
            							}
/* Noti to tutor */
    					        
    					        


            					
            					
    					        
    					    }
    					}
    					
    					
    				}
				}
			}
	
	
	    echo 'done'; 
/*
    }else{
        echo 'done';
    }
*/
}else{
    echo 'done'; 
}


/***** Auto Send WhatsApp ****/

        //echo 'done'; 
        } else {
            echo 'ERROR';
	        	
        }
    }
}
?>