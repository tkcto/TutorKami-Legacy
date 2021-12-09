<?php
require_once 'admin/classes/dbCon.php'; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once 'api/phpmailer/class.phpmailer.php'; 
$mail = new PHPMailer(true);  

if (isset($_POST['action'])) {
    

	if ($_POST['action'] == 'listoftutor') {
	    $_POST['last_word'] = '6134';
	    
	    if( $_POST['last_word'] == '' ){
	        echo 'Error : code 3257'; 
	    }else{
	        if( $_POST['checkedValue'] == 'Undecided' || $_POST['checkedValue'] == 'None' ){
	            
        	    $Job = " SELECT jt_j_id, j_id, j_status, j_payment_status, j_deadline, j_hired_tutor_email, u_id, jt_comments FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$_POST['last_word']."' AND j_status = 'open' AND j_payment_status = 'pending' ";
        	    $resultJob = $conn->query($Job);
        	    if ($resultJob->num_rows > 0) {
        	        $rowJob = $resultJob->fetch_assoc();
        	        
    	            if( $_POST['val'] == 'Yes' ){
    	                
                        $dateRec = str_replace('-', '/', $rowJob['j_deadline']);
                        $fiveDay = date('Y-m-d',strtotime($dateRec . "+5 days"));
            	        //$updateDeadLine = "UPDATE tk_job SET j_deadline = '".$fiveDay."' WHERE j_id = '".$rowJob['j_id']."' ";
            	        //$conn->query($updateDeadLine);
            	        
            	        $historyAC = $conn -> real_escape_string($rowJob['jt_comments']);
            	        if( $_POST['checkedValue'] == 'Undecided' ){
            	            $remarks = date("d/m/y")." - Client has not decided which tutor yet. Client wants more tutors’ profiles. Deadline changed to ".$fiveDay." - System\r\n".$historyAC;
            	        }else{
            	            $remarks = date("d/m/y")." - Client thinks none of the tutor is suitable. Client wants more tutors’ profiles.Deadline changed to ".$fiveDay." - System\r\n".$historyAC;
            	        }
            	        //$sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            	        //$conn->query($sqlAC);
            	        
            	        echo 'Success - Okay, our team will check if there are more available tutors. Thank you';

    	            }else if( $_POST['val'] == 'No' ){
    	                
                        $dateRec = str_replace('-', '/', $rowJob['j_deadline']);
                        $tomorrow = date('Y-m-d',strtotime($dateRec . "+1 days"));
            	        //$updateDeadLine = "UPDATE tk_job SET j_deadline = '".$tomorrow."', j_status = 'closed' WHERE j_id = '".$rowJob['j_id']."' ";
            	        //$conn->query($updateDeadLine);
            	        
            	        $historyAC = $conn -> real_escape_string($rowJob['jt_comments']);
            	        $remarks = date("d/m/y")." - Client does not want any more tutor profiles sent to him/her. TKC please follow up client. Deadline changed to ".$tomorrow." - System\r\n".$historyAC;
            	        //$sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
            	        //$conn->query($sqlAC);
            	        
    	                echo 'Success - Okay, our Coordinator will follow up with you soon. Thank you.';
    	                
    	            }else{
    	                echo 'Error - Error : code 8853';
    	            }        	        

        	    }else{
        	        echo 'Error - Error : code 8854';
        	    }
        	    
	        }else{
	            echo 'Success';
/*
        	    $Job = " SELECT jt_j_id, j_id, j_status, j_payment_status, j_deadline, j_hired_tutor_email, u_id, jt_comments FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$_POST['last_word']."' AND j_status = 'open' AND j_payment_status = 'pending' ";
        	    $resultJob = $conn->query($Job);
        	    if ($resultJob->num_rows > 0) {
        	        $rowJob = $resultJob->fetch_assoc();
        	        
                    $dateRec = str_replace('-', '/', $rowJob['j_deadline']);
                    $lusa = date('Y-m-d',strtotime($dateRec . "+2 days"));
                    
                    $Tutor = " SELECT u_id, ud_u_id, u_email, signature_img, signature_img2, u_lang, ud_phone_number, u_displayname, resit_pv_name, u_displayid FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_displayid = '".$_POST['checkedValue']."' ";
                    $resulTutor = $conn->query($Tutor);
                    if ($resulTutor->num_rows > 0) {
                        $rowTutor = $resulTutor->fetch_assoc();	
                        
                        $phonetutor = $rowTutor['ud_phone_number'];
                        $TutorEmail = $rowTutor['u_email'];	
                        $TutorDisplayName = $rowTutor['u_displayname'];	
                                    
                        if( $rowTutor['resit_pv_name'] != '' ){
                            $hiTutor = $rowTutor['resit_pv_name'];
                        }else{
                            $hiTutor = $rowTutor['u_displayname'];
                        }
                                    
                        if( $rowTutor['u_lang'] == 'BM' ){
                            $msjToTutor = "BM";
                        }else{
                            $msjToTutor = "En";
                        }

                        if( $rowTutor['signature_img'] == '' && $rowTutor['signature_img2'] == '' ){
                            $TutorTerms = 'No';
                        }else{
                            $TutorTerms = 'Yes';
                        }
                    }else{
                        $phonetutor = '';
                        $TutorEmail = '';
                        $TutorDisplayName = '';
                        $hiTutor = '';
                        $msjToTutor = '';
                        $TutorTerms = '';
                    }
                    
                    $Parent = " SELECT u_id, ud_u_id, ud_client_status_2, signature_img, signature_img2, signature_img3, u_lang, ud_phone_number, salutation, ud_first_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$rowJob['u_id']."' ";
                    $resultParent = $conn->query($Parent);
                    if ($resultParent->num_rows > 0) {
                        $rowParent = $resultParent->fetch_assoc();
                        
                        $phoneParent = $rowParent['ud_phone_number'];
                        $salutation = ucwords($rowParent["salutation"].' '.$rowParent["ud_first_name"]);

                        if( $rowParent['u_lang'] == 'BM' ){
                            $msjToParent = "BM";
                        }else{
                            $msjToParent = "En";
                        }                        
                        if( $rowParent['ud_client_status_2'] == 'Tuition Centre' ){
                            if( $rowParent['signature_img3'] == '' ){
                                $ParentTerms = 'No';
                            }else{
                                $ParentTerms = 'Yes';
                            }
                        }else{
                            if( $rowParent['signature_img'] == '' && $rowParent['signature_img2'] == '' ){
                                $ParentTerms = 'No';
                            }else{
                                $ParentTerms = 'Yes';
                            }
                        }
                    }else{
                        $phoneParent = '';
                        $salutation = '';
                        $msjToParent = '';
                        $ParentTerms = '';
                    }
                    
        	        $updateDeadLine = "UPDATE tk_job SET j_deadline = '".$lusa."', j_status = 'closed', j_start_date = NULL, j_hired_tutor_email = '".$TutorEmail."' WHERE j_id = '".$rowJob['j_id']."' ";
        	        $conn->query($updateDeadLine);

        	        $historyAC = $conn -> real_escape_string($rowJob['jt_comments']);
        	        $remarks = date("d/m/y")." - Client has chosen tutor. Field Hired Tutor has been updated. Waiting confirmation from tutor of the date of 1st class. Deadline has been changed to ".$lusa." - System\r\n".$historyAC;
        	        $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks."' WHERE jt_j_id = '".$rowJob['j_id']."' ";
        	        $conn->query($sqlAC);

                    $allowSend = " SELECT wa_job_id FROM tk_send_wa WHERE wa_job_id = '".$rowJob['j_id']."' ";
                    $resultallowSend = $conn->query($allowSend);
                    if ($resultallowSend->num_rows > 0) {
                    }else{
                        $onSlider = "INSERT INTO tk_send_wa SET wa_job_id = '".$rowJob['j_id']."', wa_user = '".$rowJob['u_id']."', wa_date = '".date('Y-m-d H:i:s')."' ";
                        $conn->query($onSlider);
                    }
                    
                    $TutorSubscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$phonetutor."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                    $resultTutorSubscribe = $conn->query($TutorSubscribe);
                    if ($resultTutorSubscribe->num_rows > 0) {
                        // tak hantar msj
                    }else{
                        if( $msjToTutor == 'BM' ){
                            $msjToTutor = "Salam/Hi ".ucwords($hiTutor).". Tahniah, ".$salutation." , klien untuk Job ".$rowJob['j_id']." telah memilih anda sebagai tutor yang mereka mahukan untuk kelas pertama. Sila hubungi klien di ".$phoneParent." untuk mendapatkan alamat penuh mereka dan untuk mengesahkan tarikh & masa kelas. Terima kasih ";
                        }else{
                            $msjToTutor = "Salam/Hi ".ucwords($hiTutor).". Congratulations, ".$salutation." , the client for Job ".$rowJob['j_id']." has chosen you as the tutor they would like to do the first class with. Please contact the client at ".$phoneParent." to get their full address and to confirm the date & time of the first class. Thank you ";
                            
                        }
                        $xdata = array( "to" => "6".$phonetutor,
                                        "message" => $msjToTutor );
                        $make_call = '';
                        $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                        $response = json_decode($make_call, true);
                        $data     = $response['message'];
                        if( $data == 'Sent Successfully' ){
                            //echo $data.' - T';
                        }else{
                            //echo 'Error : Something Wrong !. Please check wsapme. - ';
                        }                                            
                    }
                    
                    $ParentSubscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$phoneParent."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                    $resultParentSubscribe = $conn->query($ParentSubscribe);
                    if ($resultParentSubscribe->num_rows > 0) {
                        // tak hantar msj
                    }else{
                        if( $msjToParent == 'BM' ){
                            $msjToParent = "Okay, kami akan memberitahu tutor sekarang. Sila hubungi ".ucwords($hiTutor)." di ".$phonetutor." untuk memberikan alamat penuh anda dan jadual tarikh kelas. Terima kasih. ";
                        }else{
                            $msjToParent = "Okay, we will notify the tutor now. Please contact ".ucwords($hiTutor)." at ".$phonetutor." to provide your full address and to schedule the date of the first class. Thank you. ";
                            
                        }
                        $xdata = array( "to" => "6".$phoneParent,
                                        "message" => $msjToParent );
                        $make_call = '';
                        $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                        $response = json_decode($make_call, true);
                        $data     = $response['message'];
                        if( $data == 'Sent Successfully' ){
                            //echo $data.' - T';
                        }else{
                            //echo 'Error : Something Wrong !. Please check wsapme. - ';
                        }                                            
                    }
                    
                    echo 'Success';
        	    }else{
        	        echo 'Error : code 3258';
        	    }
*/
	        }
	    }
	    
	}




}
$conn->close();
?>