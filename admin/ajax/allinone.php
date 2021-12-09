<?php
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once '../../api/phpmailer/class.phpmailer.php'; 
$mail = new PHPMailer(true);  

if (isset($_POST['action'])) {
    


	if ($_POST['action'] == 'tempInvoice') {
	    $jobID      = $conn->real_escape_string($_POST['jobID']);
	    $parentRate = number_format((float)$conn->real_escape_string($_POST['parentRate']), 2, '.', '');
	    $cycle      = $conn->real_escape_string($_POST['cycle']);
	    $rf         = $conn->real_escape_string($_POST['rf']);
	    $type         = $conn->real_escape_string($_POST['type']);
	    
	    if( $type == 'Invoice' ){
                    $GetInvoice = " SELECT ph_job_id, ph_user_type, ph_receipt FROM tk_payment_history WHERE ph_job_id = '".$jobID."' AND ph_user_type = '4' AND (ph_receipt = 'temp' OR ph_receipt = '1') ";
                    $resultInvoice = $conn->query($GetInvoice);
                    if ($resultInvoice->num_rows > 0) {
                        echo 'true';
                    }else{
                        $Job = " SELECT j_id, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$jobID."' ";
                        $resultJob = $conn->query($Job);
                        if ($resultJob->num_rows > 0) {
                            $row = $resultJob->fetch_assoc();
            
                                $queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_email ='".$row['j_hired_tutor_email']."' ";
                                $resultQueryUser = $conn->query($queryUser); 
                                if($resultQueryUser->num_rows > 0){ 
                                    $rowQueryUser = $resultQueryUser->fetch_assoc();
                                    $displayname = htmlspecialchars($rowQueryUser['u_displayname'], ENT_QUOTES);
                                }else{
                                    $displayname = '';
                                }
                                
                                $my_new_date = date('Y-m-d');
                                if( $rf != '' ){
                                    $rf = number_format((float)$rf, 2, '.', '');
                                }else{
                                    $rf = '0.00';
                                }
                                
                                $totalAmount = number_format((float)($parentRate * $cycle), 2, '.', '');
                                
                        	    $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) VALUES  
                        	    ('4', '".$row["u_id"]."', '".$my_new_date."', '".$jobID."', 'temp', '".$totalAmount."', '".$rf."', '".$cycle."', '".$displayname."') ";
                        	    if ($conn->query($insertPayment) === TRUE) {
                        	        $lastID = $conn->insert_id;
                        	        //echo $conn->insert_id.' '.$my_new_date.' '.$jobID;
                        	        //START send email
                        	        $thisCycle2 = '';
                        	        $total = '';
                                    $welcome = '';
                                    $emailTo = '';
                                    $queryPayment = " SELECT ph_id, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_id = '".$lastID."' ";
                                    $resultPayment = $conn->query($queryPayment); 
                                    if($resultPayment->num_rows > 0){
                                        $rowPayment = $resultPayment->fetch_assoc();
                                        $paymentID =  $rowPayment["ph_id"];
                                        include('../temp-pdf.php');
                                        
                                        $UserDetails = " SELECT * FROM tk_user_details WHERE ud_u_id = '".$rowPayment["ph_user_id"]."' ";
                                        $reUserDetails = $conn->query($UserDetails); 
                                        if($reUserDetails->num_rows > 0){
                                            $rowUserDetails = $reUserDetails->fetch_assoc();
                                            $welcome = ucwords($rowUserDetails["salutation"].' '.$rowUserDetails["ud_first_name"]);
                                            $emailTo = $rowUserDetails["ud_last_name"];
                                        }                            
                                    }
                                    
                                    $file = "../temp-pdf/" . $filename;
                                    
                                    $mailto  = $emailTo;
                                    $subject = 'Invoice (Request for Payment) - TutorKami ';
                                    $message = "
                                                Salam/Hi ".$welcome.",<br><br>
                                                
                                                Thank you for using our service.<br>
                                                Attached is the invoice for cycle number #".$thisCycle2." for Class ID ".$jobID.".<br>
                                                Amount is RM ".$total.".<br><br>
                                
                                                Please make the payment to our Maybank account 569954063020 (TK Edu Sdn Bhd)
                                                or you can also pay via DuitNow. Just login to your bank or e-wallet mobile app, scan the
                                                QR code below, enter the amount and pay<br><br>
                                                
                                                <img src='https://www.tutorkami.com/images/qrcode.PNG' style='max-width: 250px' /><br><br>
                                                
                                
                                                You can also view the invoice online at your TutorKami profile here
                                                <a href='https://www.tutorkami.com/client_login'>https://www.tutorkami.com/client_login</a><br><br>
                                
                                                Thank you,<br>Admin TutorKami
                                
                                            ";
                                            
                                            $mail->IsSMTP();                            // telling the class to use SMTP
                                            $mail->Host       = "220.158.200.81";       // SMTP server
                                            $mail->SMTPAuth   = true;                   // enable SMTP authentication
                                            $mail->Host       = "220.158.200.81";       // sets the SMTP server
                                            $mail->Port       = 26;                     // set the SMTP port for the GMAIL server
                                            $mail->Username   = "fadhli@tutorkami.com"; // SMTP account username
                                            $mail->Password   = "fadhli";               // SMTP account password
                                            
                                            $mail->SetFrom('finance@tutorkami.com', 'TutorKami');
                                            $mail->AddReplyTo("finance@tutorkami.com","TutorKami");
                                            $mail->Subject    = $subject;
                                            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                                            $mail->MsgHTML($message);
                                            $mail->AddAddress($mailto);
                                            $mail->AddAttachment($file);   // attachment if any
                                            
                                            if(!$mail->Send()) {
                                              unlink($file);
                                            } else {
                                              unlink($file);
                                            }
                        	        //END send email
                        	        
                                    $myArr = array($lastID, $my_new_date, $jobID);
                                    $myJSON = json_encode($myArr);
                                    echo $myJSON;
                        	    } else {
                        	        echo "Error";
                        	    }
                        }else{
                            echo 'Error';
                        }
                    }	        
	    }else{
					$GetInvoice = " SELECT ph_job_id, ph_user_type, ph_receipt FROM tk_payment_history WHERE ph_job_id = '".$jobID."' AND ph_user_type = '4' AND ph_receipt = 'trial' ";
                    $resultInvoice = $conn->query($GetInvoice);
                    if ($resultInvoice->num_rows > 0) {
                        echo 'true';
                    }else{
                        $Job = " SELECT j_id, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$jobID."' ";
                        $resultJob = $conn->query($Job);
                        if ($resultJob->num_rows > 0) {
                            $row = $resultJob->fetch_assoc();
            
                                $queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_email ='".$row['j_hired_tutor_email']."' ";
                                $resultQueryUser = $conn->query($queryUser); 
                                if($resultQueryUser->num_rows > 0){ 
                                    $rowQueryUser = $resultQueryUser->fetch_assoc();
                                    $displayname = htmlspecialchars($rowQueryUser['u_displayname'], ENT_QUOTES);
                                }else{
                                    $displayname = '';
                                }
                                
                                $my_new_date = date('Y-m-d');
                                if( $rf != '' ){
                                    $rf = number_format((float)$rf, 2, '.', '');
                                }else{
                                    $rf = '0.00';
                                }
                                
                                $totalAmount = number_format((float)($parentRate * $cycle), 2, '.', '');
                                
                        	    $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) VALUES  
                        	    ('4', '".$row["u_id"]."', '".$my_new_date."', '".$jobID."', 'trial', '".$totalAmount."', '".$rf."', '".$cycle."', '".$displayname."') ";
                        	    if ($conn->query($insertPayment) === TRUE) {
                        	        $lastID = $conn->insert_id;

                        	        $thisCycle2 = '';
                        	        $total = '';
                                    $welcome = '';
                                    $emailTo = '';
                                    $queryPayment = " SELECT ph_id, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_id = '".$lastID."' ";
                                    $resultPayment = $conn->query($queryPayment); 
                                    if($resultPayment->num_rows > 0){
                                        $rowPayment = $resultPayment->fetch_assoc();
                                        $paymentID =  $rowPayment["ph_id"];
                                        include('../temp-pdf-trial.php');
                                        
                                        $UserDetails = " SELECT * FROM tk_user_details WHERE ud_u_id = '".$rowPayment["ph_user_id"]."' ";
                                        $reUserDetails = $conn->query($UserDetails); 
                                        if($reUserDetails->num_rows > 0){
                                            $rowUserDetails = $reUserDetails->fetch_assoc();
                                            $welcome = ucwords($rowUserDetails["salutation"].' '.$rowUserDetails["ud_first_name"]);
                                            $emailTo = $rowUserDetails["ud_last_name"];
                                        }                            
                                    }
                                    
                                    $file = "../temp-pdf/" . $filename;
                                    
                                    $mailto  = $emailTo;
                                    $subject = 'Trial session (Request for Payment) - TutorKami ';
                                    $message = "
                                                Salam/Hi ".$welcome.",<br><br>
                                                
                                                Thank you for using our service.<br>
                                                Attached is the trial session invoice for number #".$cycle." for Class ID ".$jobID.".<br>
                                                Amount is RM ".$total.".<br><br>
                                
                                                Please make the payment to our Maybank account 569954063020 (TK Edu Sdn Bhd)
                                                or you can also pay via DuitNow. Just login to your bank or e-wallet mobile app, scan the
                                                QR code below, enter the amount and pay<br><br>
                                                
                                                <img src='https://www.tutorkami.com/images/qrcode.PNG' style='max-width: 250px' /><br><br>
                                                
                                
                                                You can also view the invoice online at your TutorKami profile here
                                                <a href='https://www.tutorkami.com/client_login'>https://www.tutorkami.com/client_login</a><br><br>
                                
                                                Thank you,<br>Admin TutorKami
                                
                                            ";
                                            
                                            $mail->IsSMTP();                            // telling the class to use SMTP
                                            $mail->Host       = "220.158.200.81";       // SMTP server
                                            $mail->SMTPAuth   = true;                   // enable SMTP authentication
                                            $mail->Host       = "220.158.200.81";       // sets the SMTP server
                                            $mail->Port       = 26;                     // set the SMTP port for the GMAIL server
                                            $mail->Username   = "fadhli@tutorkami.com"; // SMTP account username
                                            $mail->Password   = "fadhli";               // SMTP account password
                                            
                                            $mail->SetFrom('finance@tutorkami.com', 'TutorKami');
                                            $mail->AddReplyTo("finance@tutorkami.com","TutorKami");
                                            $mail->Subject    = $subject;
                                            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                                            $mail->MsgHTML($message);
                                            $mail->AddAddress($mailto);
                                            $mail->AddAttachment($file);   // attachment if any
                                            
                                            if(!$mail->Send()) {
                                              unlink($file);
                                            } else {
                                              unlink($file);
                                            }
                        	        //END send email
                        	        
                                    $myArr = array($lastID, $my_new_date, $jobID);
                                    $myJSON = json_encode($myArr);
                                    echo $myJSON;
                        	    } else {
                        	        echo "Error";
                        	    }
                        }else{
                            echo 'Error';
                        }
                    }
	    }

	}
    


	if ($_POST['action'] == 'showInvoicePopup') {
	    //echo $_POST['JobID'];
	    
        $query = " SELECT * FROM tk_job WHERE j_id = '".$_POST['JobID']."' ";
        $result = $conn->query($query); 
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            //echo $row["parent_rate"].' '.$row["cycle"].' '.$row["rf"];
            
            $myArr = array($row["parent_rate"], $row["cycle"], $row["rf"]);
            $myJSON = json_encode($myArr);
            echo $myJSON;

        }else{
            echo 'Error';
        }
	    
	    
	}
    


	if ($_POST['action'] == 'rform') {
	    //echo $_POST['id'];
	    $delete= " DELETE FROM tk_rform WHERE id = '".$_POST['id']."'  ";
	    if ($conn->query($delete) === TRUE) {
	        echo "Success";
	    } else {
	        echo "Error";
	    }
	}
    


	if ($_POST['action'] == 'saveDueDate') {
        //echo $_POST['JobID'].' '.$_POST['cl_id'].' '.$_POST['clientID'].' '.$_POST['dateDueDate'].' '.$_POST['cr_id'];

        $dateInput = explode('/',$_POST['dateDueDate']);
        $new_date = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
        
            $update = "UPDATE tk_job SET j_end_date = '".$new_date."' WHERE j_id = '".$_POST["JobID"]."' ";
            $conn->query($update);
            
        $my_new_date = date('Y-m-d');
        $totalAmount = number_format((float)($_POST["Amount"] * $_POST["Hours"]), 2, '.', '');
            
        if( $_POST["RF"] != '' ){
            $rf = number_format((float)$_POST["RF"], 2, '.', '');
        }else{
            $rf = '0.00';
        }
        
        $Job = " SELECT j_id, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$_POST["JobID"]."' ";
        $resultJob = $conn->query($Job);
        if ($resultJob->num_rows > 0) {
            $row = $resultJob->fetch_assoc();
                
            $queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_email ='".$row['j_hired_tutor_email']."' ";
            $resultQueryUser = $conn->query($queryUser); 
            if($resultQueryUser->num_rows > 0){ 
                $rowQueryUser = $resultQueryUser->fetch_assoc();
                $displayname = htmlspecialchars($rowQueryUser['u_displayname'], ENT_QUOTES);
            }else{
                $displayname = '';
            }   
                
        }else{
            $displayname = '';
        }
        
        $Kelas = " SELECT cr_id, row_no FROM tk_classes_record WHERE cr_id = '".$_POST["cr_id"]."' ";
        $rKelas = $conn->query($Kelas);
        if ($rKelas->num_rows > 0) {
            $rowKelas = $rKelas->fetch_assoc();
            //$thisCycleNo = 'beginning '.($rowKelas['row_no']+1);
            $thisCycleNo = 'beginning '.($rowKelas['row_no']);
        }else{
             $thisCycleNo = '';
        }
        
        

	    $insertPayment = " INSERT INTO tk_payment_history (ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) VALUES  
	    ('4', '".$_POST["clientID"]."', '".$my_new_date."', '".$_POST["JobID"]."', '".$thisCycleNo."', '".$totalAmount."', '".$rf."', '".$_POST["Hours"]."', '".$displayname."') ";
	    if ($conn->query($insertPayment) === TRUE) {
	        $lastID = $conn->insert_id;

	        $thisCycle2 = '';
	        $total = '';
            /*$queryPayment = " SELECT ph_id, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '4' AND ph_user_id = '".$_POST["clientID"]."' AND ph_job_id = '".$_POST["JobID"]."' AND ph_receipt = 'temp' ORDER BY ph_id DESC ";
            $resultPayment = $conn->query($queryPayment); 
            if($resultPayment->num_rows > 0){
                $rowPayment = $resultPayment->fetch_assoc();
                $paymentID =  $rowPayment["ph_id"];
                include('../temp-pdf.php');
    
            }else{
                echo "Error";
                exit();
            }*/
            $queryPayment = " SELECT ph_id, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_id = '".$lastID."' ";
            $resultPayment = $conn->query($queryPayment); 
            if($resultPayment->num_rows > 0){
                $rowPayment = $resultPayment->fetch_assoc();
                $paymentID =  $rowPayment["ph_id"];
                include('../temp-pdf.php');
    
            }else{
                echo "Error";
                exit();
            }

            $welcome = '';
            $emailTo = '';
            $UserDetails = " SELECT * FROM tk_user_details WHERE ud_u_id = '".$_POST["clientID"]."' ";
            $reUserDetails = $conn->query($UserDetails); 
            if($reUserDetails->num_rows > 0){
                $rowUserDetails = $reUserDetails->fetch_assoc();
                $welcome = ucwords($rowUserDetails["salutation"].' '.$rowUserDetails["ud_first_name"]);
                $emailTo = $rowUserDetails["ud_last_name"];
    
            }


            //$filename = $filename;
            //$path = '../../testpdf.pdf';
            $file = "../temp-pdf/" . $filename;

            $mailto = "tkfinance.malaysia@gmail.com, $emailTo";
            $subject = 'Invoice Payment - TutorKami';
            $message = "
                        Salam/Hi ".$welcome.",<br><br>
                        
                        Thank you for using our service.<br>
                        Attached is the invoice for cycle number #".$thisCycle2." for Class ID ".$_POST["JobID"].".<br>
                        Amount is RM ".$total.".<br><br>
        
                        Please make the payment to our Maybank account 569954063020 (TK Edu Sdn Bhd)
                        or you can also pay via DuitNow. Just login to your bank or e-wallet mobile app, scan the
                        QR code below, enter the amount and pay<br><br>
                        
                        <img src='https://www.tutorkami.com/images/qrcode.PNG' style='max-width: 250px' /><br><br>
                        
        
                        You can also view the invoice online at your TutorKami profile here
                        <a href='https://www.tutorkami.com/client_login'>https://www.tutorkami.com/client_login</a><br><br>
        
                        Thank you,<br>Admin TutorKami
        
                    ";
                    
            $mail->IsSMTP();                            // telling the class to use SMTP
            $mail->Host       = "220.158.200.81";       // SMTP server
            $mail->SMTPAuth   = true;                   // enable SMTP authentication
            $mail->Host       = "220.158.200.81";       // sets the SMTP server
            $mail->Port       = 26;                     // set the SMTP port for the GMAIL server
            $mail->Username   = "fadhli@tutorkami.com"; // SMTP account username
            $mail->Password   = "fadhli";               // SMTP account password
                                
            $mail->SetFrom('finance@tutorkami.com', 'TutorKami');
            $mail->AddReplyTo("finance@tutorkami.com","TutorKami");
            $mail->Subject    = $subject;
            $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
            $mail->MsgHTML($message);
            
            $address1 = $emailTo;
            $address2 = "tkfinance.malaysia@gmail.com";
            
            $mail->AddAddress($address1);
            $mail->AddAddress($address2);

            $mail->AddAttachment($file);   // attachment if any
            $mail->AddAttachment($file);   // attachment if any
                                
            if(!$mail->Send()) {
                unlink($file);
                echo "mail send ... ERROR!";
            } else {
                unlink($file);
                        $update = "UPDATE tk_classes_record SET invoice = 'on' WHERE cr_id = '".$_POST["cr_id"]."' ";
        	            $conn->query($update);
                echo "Success";
            }
            
            /*
            $content = file_get_contents($file);
            $content = chunk_split(base64_encode($content));

            // a random hash will be necessary to send mixed content
            $separator = md5(time());
        
            // carriage return type (RFC)
            $eol = "\r\n";

            // main header (multipart mandatory)
            $headers = "From: TutorKami <contact@tutorkami.com>" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
            $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
            $headers .= "This is a MIME encoded message." . $eol;
        
            // message
            $body = "--" . $separator . $eol;
            //$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
            $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
            $body .= "Content-Transfer-Encoding: 8bit" . $eol;
            $body .= $message . $eol;
        
            // attachment
            $body .= "--" . $separator . $eol;
            $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
            $body .= "Content-Transfer-Encoding: base64" . $eol;
            $body .= "Content-Disposition: attachment" . $eol;
            $body .= $content . $eol;
            $body .= "--" . $separator . "--";

            //SEND Mail
            if (mail($mailto, $subject, $body, $headers)) {
                unlink($file);
                        $update = "UPDATE tk_classes_record SET invoice = 'on' WHERE cr_id = '".$_POST["cr_id"]."' ";
        	            $conn->query($update);
                echo "Success";
            } else {
                echo "mail send ... ERROR!";
            }*/

	        //echo "Success";
	    } else {
	        echo "Error";
	    }
	}
    


	if ($_POST['action'] == 'tempCreateClasses') {
        //echo $_POST['type'];
            $Job = " SELECT cl_display_id FROM tk_classes WHERE cl_display_id = '".$_POST['Job']."' ";
            $resultJob = $conn->query($Job);
            if ($resultJob->num_rows > 0) {
                echo "ada";
            }else{
                /*if( $_SESSION['JHired'] != '' ){
                }*/
                $_SESSION["tempCreateClasses"] = $_POST['type'];
            }
	}
    


	if ($_POST['action'] == 'tempUnsetClasses') {
        unset($_SESSION['tempCreateClasses']);
        unset($_SESSION['JHired']);
	}
    


	if ($_POST['action'] == 'CreateClasses') {
            $Job = " SELECT cl_display_id FROM tk_classes WHERE cl_display_id = '".$_POST['Job']."' ";
            $resultJob = $conn->query($Job);
            if ($resultJob->num_rows > 0) {
                $row = $resultJob->fetch_assoc();
                echo "ada";
            }else{
				$createClass = "INSERT INTO tk_classes 
				(cl_display_id, cl_student_id, cl_tutor_id, cl_student, cl_subject, cl_rate, cl_charge_parent, cl_hours_balance, cl_cycle, cl_status, cl_country_id, cl_create_date) 
				VALUES 
				('".$_POST['Job']."', '".$_POST['PrID']."', '".$_POST['TuID']."', '".$_POST['Student']."', '".$_POST['Subj']."', '".$_POST['Rate']."', '".$_POST['PrRate']."', '".$_POST['Cycle']."', '".$_POST['Cycle']."', 'ongoing', '150', '".date('Y-m-d H:i:s')."') ";
				if ( ($conn->query($createClass) === TRUE) ) {
				    unset($_SESSION['tempCreateClasses']);
				    unset($_SESSION['JHired']);
				    echo "Success";
				}else{
				    unset($_SESSION['tempCreateClasses']);
				    unset($_SESSION['JHired']);
				    echo "Error";
				}             
            }
	}
    


	if ($_POST['action'] == 'ExportExcel') {
	    //include("../../plugins/PHPExcel-1.8/test.php");
	    echo $_POST['id'];
	}
    


	if ($_POST['action'] == 'proceedDeadline') {
	    $pJobID      = $conn->real_escape_string($_POST['pJobID']);
	    $pDeadline   = $conn->real_escape_string($_POST['pDeadline']);
	    $pCheck      = $conn->real_escape_string($_POST['pCheck']);
	    $pRemark     = $conn->real_escape_string($_POST['pRemark']);
	    
	    //echo "Output = ".$pJobID." | ".$pDeadline." | ".$pCheck." | ".$pRemark;

		$formatDeadline = explode('/', $pDeadline);
		$new_date = $formatDeadline[2].'-'.$formatDeadline[1].'-'.$formatDeadline[0];
		
            $Job = " SELECT * FROM tk_job INNER JOIN tk_job_translation ON jt_j_id = j_id WHERE j_id = '".$pJobID."' ";
            $resultJob = $conn->query($Job);
            if ($resultJob->num_rows > 0) {
                $row = $resultJob->fetch_assoc();
                
                $ClientDID = '';
                $ClientLang = '';
                $Client = " SELECT u_id, u_displayid, u_lang FROM tk_user WHERE u_id = '".$row['u_id']."' ";
                $resultClient = $conn->query($Client);
                if ($resultClient->num_rows > 0) {
                    $rowClient = $resultClient->fetch_assoc();
                        $ClientDID = $rowClient['u_displayid'];
                        if( $rowClient['u_lang'] == '' ){
                            $ClientLang = 'BM';
                        }else{
                            $ClientLang = $rowClient['u_lang'];
                        }
                }
                
                $re_JT = $conn -> real_escape_string($row['jt_comments']);
                $remarks = date("d/m/y")." - ".$pRemark." - System\r\n".$re_JT;
                $remarks2 = date("d/m/y")." - This job has stopped. ".$pRemark." - System\r\n".$re_JT;
                
                if( $pDeadline != '' ){
                    if( $pCheck == 'true' ){
                	    $delete= " DELETE FROM tk_send_wa2 WHERE wa_job_id = '".$row['j_id']."' AND wa_user = '".$row['u_id_tutor']."'   ";
                	    $conn->query($delete);

                	    $insert = " INSERT INTO tk_send_wa2 (wa_job_id, wa_user, wa_date) VALUES  ('".$row["j_id"]."', '".$row["u_id_tutor"]."', '".date("Y-m-d H:i:s")."') ";
                	    $conn->query($insert);
                    }else{
                	    $delete= " DELETE FROM tk_send_wa2 WHERE wa_job_id = '".$row['j_id']."' AND wa_user = '".$row['u_id_tutor']."'   ";
                	    $conn->query($delete);
                    }
                    
                    $update = "UPDATE tk_job SET j_deadline = '".$new_date."' WHERE j_id = '".$row['j_id']."' ";
                    $conn->query($update);
                    
                    $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks."' WHERE jt_j_id = '".$row['j_id']."' ";
                    $conn->query($sqlAC);
                    echo $ClientDID.' - '.$ClientLang;
                }else{
                    $delete= " DELETE FROM tk_send_wa2 WHERE wa_job_id = '".$row['j_id']."' AND wa_user = '".$row['u_id_tutor']."'   ";
                    $conn->query($delete);
                    
                    $update = "UPDATE tk_job SET j_deadline = NULL WHERE j_id = '".$row['j_id']."' ";
                    $conn->query($update);
                    
                    $sqlAC = "UPDATE tk_job_translation SET jt_comments = '".$remarks2."' WHERE jt_j_id = '".$row['j_id']."' ";
                    $conn->query($sqlAC);
                    echo $ClientDID.' - '.$ClientLang;
                }
                

            }else{
                echo "Error";
            }
	    
	    
	    
	}
    


	if ($_POST['action'] == 'financePopUp') {
	    //echo $_POST['DoNotShow'];
	    $insert = " INSERT INTO tk_new_jobs_popup (pop_date) VALUES  ('".date("d/m/Y")."') ";
	    $conn->query($insert);
	}
    


	if ($_POST['action'] == 'RestoreDB') {
	    $filePath   = '../excel/'.$_POST['file'];

        $fp = fopen($filePath, 'r');
        $fetchData = fread($fp, filesize($filePath));
        $sqlInfo = explode(";\n", $fetchData); // explode dump sql as a array data
        
        foreach ($sqlInfo AS $sqlData) {
            $conn->query($sqlData);
        }
        echo $conn->commit();
/*
        function restoreDatabaseTables($filePath){

            // Temporary variable, used to store current query
            $templine = '';
            
            // Read in entire file
            $lines = file($filePath);
            
            $error = '';
            
            // Loop through each line
            foreach ($lines as $line){
                // Skip it if it's a comment
                if(substr($line, 0, 2) == '--' || $line == ''){
                    continue;
                }
                
                // Add this line to the current segment
                $templine .= $line;
                
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';'){
                    // Perform the query
                    if(!$conn->query($templine)){
                        $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $conn->error . '<br /><br />';
                    }
                    
                    // Reset temp variable to empty
                    $templine = '';
                }
            }
            return !empty($error)?$error:true;
        }
        echo restoreDatabaseTables($filePath);
*/
        
	}
    


	if ($_POST['action'] == 'proceedNotiTerms') {
	    $ShortlistedID = $_POST['ShortlistedID'];
	    
            $Shortlist = " SELECT id, user_job_id, user_id FROM tk_shortlisted WHERE id = '".$_POST['ShortlistedID']."' ";
            $resulShortlist = $conn->query($Shortlist);
            if ($resulShortlist->num_rows > 0) {
                $rowShortlist = $resulShortlist->fetch_assoc();
                
                require_once('../classes/whatsapp-api-call.php');
                
                $curDate = date("d/m/Y");
                $curTime = date("H:i");
                $postDate = '';
                $postTime = '';
                $setup = '';
                $nextStep = '';
                $Job = " SELECT j_id, j_post_time, j_post_date, u_id FROM tk_job WHERE j_id = '".$rowShortlist['user_job_id']."' ";
                $resultJob = $conn->query($Job);
                if ($resultJob->num_rows > 0) {
                    $rowJob = $resultJob->fetch_assoc();
                            
                    $postDate = $rowJob['j_post_date'];
                    $postTime = date("H:i", strtotime($rowJob['j_post_time']));
                        
                    $timestamp = strtotime($postTime) + 60*60;
                    $postTimePlus1Hour = date('H:i', $timestamp);

                    if( $rowJob['j_post_date'] != '' ){
                        $setup = 'date';
                    }else if( $rowJob['j_post_date'] == '' && $rowJob['j_post_time'] != '' ){
                        $setup = 'time';
                    }else{
                        $setup = 'normal';
                    }

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
                            // Parent / whatever
                            if( $rowParent['signature_img'] == '' && $rowParent['signature_img2'] == '' ){
                                $nextStep = 'Parents did not sign term - ';
                            }else{
                                $nextStep = 'Ok';
                            }
                        }
                        
                        
                        if( $nextStep != '' ){
                            if( $nextStep == 'Ok' ){
                                

                                $Tutor = " SELECT u_id, ud_u_id, signature_img, signature_img2, u_lang, ud_phone_number, u_displayname, resit_pv_name FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_id = '".$rowShortlist['user_id']."' ";
                                $resulTutor = $conn->query($Tutor);
                                if ($resulTutor->num_rows > 0) {
                                    $rowTutor = $resulTutor->fetch_assoc();
                                    
                                    if( $rowTutor['resit_pv_name'] != '' ){
                                        $hiTutor = $rowTutor['resit_pv_name'];
                                    }else{
                                        $hiTutor = $rowTutor['u_displayname'];
                                    }
                                    
                                    if( $rowTutor['u_lang'] == 'BM' ){
                                        $msjToTutor = "Salam/Hi ".ucwords($hiTutor).", kami ingin menghantar profil & nombor telefon anda kepada pelanggan untuk pertimbangan mereka. newLineWalau bagaimanapun, anda mesti bersetuju dengan syarat kami terlebih dahulu. newLineSila log masuk di https://www.tutorkami.com/tutor-login untuk membaca dan menandatangani syarat. Terima kasih.";
                                    }else{
                                        $msjToTutor = "Salam/Hi ".ucwords($hiTutor).", we would like to send your profile & phone number to the client for their consideration. newLineHowever, you need to agree with our terms first. newLinePlease login at https://www.tutorkami.com/tutor-login  to read and sign the terms. Thank you.";
                                    }
// betulkan ni saje isu 12, yang lain dah settle
                                    if( $rowParent['u_lang'] == 'BM' ){
                                        $msjToParent = "Salam/Hi ".ucwords($rowParent['salutation'])." ".ucwords($rowParent['ud_first_name']).",newLineWe have a tutor who is interested to teach the student. This is the link to ".ucwords($hiTutor)."'s profile. newLineYou can What's app message ".ucwords($hiTutor)." by clicking this link newLine We will follow up soon to find out which tutor you choose. But if you decide that you'd like to choose ".ucwords($hiTutor)." to conduct the first class with the student, please click the button below, and we will stop searching for other tutor(s). Thank you.";
                                    }else{
                                        $msjToParent = "Salam/Hi ".ucwords($rowParent['salutation'])." ".ucwords($rowParent['ud_first_name']).",newLineWe have a tutor who is interested to teach the student. This is the link to ".ucwords($hiTutor)."'s profile. newLineYou can What's app message ".ucwords($hiTutor)." by clicking this link newLine We will follow up soon to find out which tutor you choose. But if you decide that you'd like to choose ".ucwords($hiTutor)." to conduct the first class with the student, please click the button below, and we will stop searching for other tutor(s). Thank you.";
                                    }

                                    if( $rowTutor['signature_img'] == '' && $rowTutor['signature_img2'] == '' ){
                                        $Subscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$rowTutor['ud_phone_number']."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                                        $resultSubscribe = $conn->query($Subscribe);
                                        if ($resultSubscribe->num_rows > 0) {
                                            echo 'Tutor : Unsubscribed - ';
                                        }else{
                                            $xdata = array( "to" => "6".$rowTutor['ud_phone_number'],
                                                "message" => $msjToTutor );
                                            $make_call = '';
                                            $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                            $response = json_decode($make_call, true);
                                            $data     = $response['message'];
                                            if( $data == 'Sent Successfully' ){
                                                echo $data.' - T';
                                            }else{
                                                echo 'Error : Something Wrong !. Please check wsapme. - ';
                                            }                                            
                                        }
                                    }else{
                                        if( $setup == 'date' ){
                                            if($curDate == $postDate){
                                                if( $curTime >= $postTime && $curTime <= $postTimePlus1Hour){
                                                    //echo 'Sent Successfully - '.$curTime.' '.$postTime.' 1 '.$postTimePlus1Hour;
                                                    $Subscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$rowParent['ud_phone_number']."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                                                    $resultSubscribe = $conn->query($Subscribe);
                                                    if ($resultSubscribe->num_rows > 0) {
                                                        echo 'Parent : Unsubscribed - ';
                                                    }else{
                                                        $xdata = array( "to" => "6".$rowParent['ud_phone_number'],
                                                            "message" => $msjToParent );
                                                        $make_call = '';
                                                        $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                        $response = json_decode($make_call, true);
                                                        $data     = $response['message'];
                                                        if( $data == 'Sent Successfully' ){
                                                            echo $data.' - A';
                                                        }else{
                                                            echo 'Error : Something Wrong !. Please check wsapme. - ';
                                                        }                                                        
                                                    }
                                                }else{
                                                    echo 'Sent Successfully - P';
                                                }
                                            }else{
                                                echo 'Sent Successfully - P';
                                            }
                                        }else if( $setup == 'time' ){
                                            if( $curTime >= $postTime && $curTime <= $postTimePlus1Hour){
                                                $Subscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$rowParent['ud_phone_number']."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                                                $resultSubscribe = $conn->query($Subscribe);
                                                if ($resultSubscribe->num_rows > 0) {
                                                    echo 'Parent : Unsubscribed - ';
                                                }else{
                                                    $xdata = array( "to" => "6".$rowParent['ud_phone_number'],
                                                        "message" => $msjToParent );
                                                    $make_call = '';
                                                    $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                    $response = json_decode($make_call, true);
                                                    $data     = $response['message'];
                                                    if( $data == 'Sent Successfully' ){
                                                        echo $data.' - A';
                                                    }else{
                                                        echo 'Error : Something Wrong !. Please check wsapme. - ';
                                                    }                                                        
                                                }
                                            }else{
                                                echo 'Sent Successfully - P';
                                            }
                                        }else{
                                            $Subscribe = " SELECT wa_user, wa_remark, wa_note FROM tk_whatsapp_noti WHERE wa_user = '".$rowParent['ud_phone_number']."' AND wa_remark = 'Welcome' AND wa_note = 'No' ";
                                            $resultSubscribe = $conn->query($Subscribe);
                                            if ($resultSubscribe->num_rows > 0) {
                                                echo 'Parent : Unsubscribed - ';
                                            }else{
                                                $xdata = array( "to" => "6".$rowParent['ud_phone_number'],
                                                    "message" => $msjToParent );
                                                $make_call = '';
                                                $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                                $response = json_decode($make_call, true);
                                                $data     = $response['message'];
                                                if( $data == 'Sent Successfully' ){
                                                    echo $data.' - A';
                                                }else{
                                                    echo 'Error : Something Wrong !. Please check wsapme. - ';
                                                }                                                        
                                            }
                                        }
                                    }
                
                                }else{
                                    echo 'Error : undefined #453 - ';
                                }

                                
                            }else{
                                echo $nextStep;
                            }
                        }else{
                            echo 'Error : undefined #454 - ';
                        }
                    }else{
                        echo 'Error : undefined #455 - ';
                    }
                    
                }else{
                    echo 'Error : undefined #456 - ';
                }
                
            }else{
                echo 'Error : undefined #457 - ';
            }

	}
	if ($_POST['action'] == 'updateProceedNotiTerms') {
	    $ShortlistedID = $_POST['ShortlistedID'];
            $Shortlist = " SELECT id, user_id FROM tk_shortlisted WHERE id = '".$_POST['ShortlistedID']."' ";
            $resulShortlist = $conn->query($Shortlist);
            if ($resulShortlist->num_rows > 0) {
                $rowShortlist = $resulShortlist->fetch_assoc();
                    //$update = "UPDATE tk_shortlisted SET s_status = '".$_POST['stringA']."' WHERE id = '".$rowShortlist['id']."' ";
                    //$conn->query($update);
            echo 'Successfully ';       
            }
	}
	
	
	
	
	
	
	
	
	
}
$conn->close();
?>