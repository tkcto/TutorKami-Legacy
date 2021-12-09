<?php
//https://codepen.io/g13nn/pen/VLZEgE

require_once('classes/config.php.inc');

require_once('classes/template-email.class.php');
$instNews = new template;


// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

require_once '../api/phpmailer/class.phpmailer.php'; 
$mail = new PHPMailer(true);  

if(isset($_POST['dataReceipt'])){
	$dataReceipt = $_POST['dataReceipt'];
	
    $sql = " SELECT * FROM tk_payment_history WHERE ph_id = '".$dataReceipt['nilai']."' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $UpdateKomen = " UPDATE tk_payment_history set ph_remarks = '".$dataReceipt['komen']."' WHERE ph_id = '".$dataReceipt['nilai']."'  ";
        $conn->query($UpdateKomen);
        
        //$paymentID =  $row["ph_id"];
        //include('temp-pdf2.php');
        
        $previousInvoice = '';
        $qUser       = '';
        $u_displayid = '';
        $qUserD = '';
        $emailTo = '';
    	$queryJob = " SELECT * FROM tk_job WHERE j_id = '".$row['ph_job_id']."'  ";
    	$resultQueryJob = $conn->query($queryJob); 
    	if($resultQueryJob->num_rows > 0){
    		$rowQueryJob = $resultQueryJob->fetch_assoc();
    		$qJobId = $rowQueryJob['j_email'];
    		$qJobPhone = $rowQueryJob['j_telephone'];
    	
    		$queryUser = " SELECT * FROM tk_user INNER JOIN tk_user_details ON u_id = ud_u_id WHERE u_email = '".$qJobId."'  ";
    		$resultQueryUser = $conn->query($queryUser); 
    		if($resultQueryUser->num_rows > 0){ 
    			$rowQueryUser = $resultQueryUser->fetch_assoc();
    			$qUser       = $rowQueryUser['u_id'];
    			$u_displayid = $rowQueryUser['u_displayid'];
    			$qUserD      = ucwords($rowQueryUser['salutation'].' '.$rowQueryUser['ud_first_name']);
    			$emailTo     = $rowQueryUser["ud_last_name"];
    
    		}
    	}
        
        $pad_length = 2;
        $pad_char = 0;
        if( $row['ph_receipt'] == 'trial' || $row['ph_receipt'] == 'trial paid' ){
            $thisCycle = 'T';
            $thisCycle2 = 'T';
            
            $PreviousDate = " SELECT ph_date, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '".$row['ph_user_type']."' AND ph_user_id = '".$row['ph_user_id']."' AND ph_job_id = '".$row['ph_job_id']."' AND ph_receipt = 'trial'  ";
            $resultPreviousDate = $conn->query($PreviousDate);
            if ($resultPreviousDate->num_rows > 0) {
                $rowPreviousDate = $resultPreviousDate->fetch_assoc();
                    $previousInvoice = date("d/m/Y", strtotime($rowPreviousDate['ph_date']));
            }
        }else if( $row['ph_receipt'] == 'temp' ){
            $thisCycle = '01';
            $thisCycle2 = '1';
            
            $PreviousDate = " SELECT ph_date, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '".$row['ph_user_type']."' AND ph_user_id = '".$row['ph_user_id']."' AND ph_job_id = '".$row['ph_job_id']."' AND ph_receipt = 'temp'  ";
            $resultPreviousDate = $conn->query($PreviousDate);
            if ($resultPreviousDate->num_rows > 0) {
                $rowPreviousDate = $resultPreviousDate->fetch_assoc();
                    $previousInvoice = date("d/m/Y", strtotime($rowPreviousDate['ph_date']));
            }
        }else{
            $thisCycle = str_pad($row['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
            $thisCycle2 = str_pad($row['ph_receipt'], $pad_length, $pad_char, STR_PAD_LEFT);
            
            $PreviousDate = " SELECT ph_date, ph_user_type, ph_user_id, ph_job_id, ph_receipt FROM tk_payment_history WHERE ph_user_type = '".$row['ph_user_type']."' AND ph_user_id = '".$row['ph_user_id']."' AND ph_job_id = '".$row['ph_job_id']."' AND ph_receipt = 'temp'  ";
            $resultPreviousDate = $conn->query($PreviousDate);
            if ($resultPreviousDate->num_rows > 0) {
                $rowPreviousDate = $resultPreviousDate->fetch_assoc();
                    $previousInvoice = date("d/m/Y", strtotime($rowPreviousDate['ph_date']));
            }
        }
        
        
        $cycle    = $row['ph_job_id'].$thisCycle;
        $invoiceNo = 'i'.$row["ph_job_id"].$thisCycle;
    
        $date = date("d/m/Y", strtotime($row['ph_date']));
        
        $tutor = $row['tutor'];
        $hours = $row['hour'];
        
        if( $row['description'] != '' ){
            $desc = $row['description'];
        }else{
            $desc = 'hours of classes';
        }

        if( $row['ph_rf'] != '' ){
            if( $row['ph_rf'] == '0.00' || $row['ph_rf'] == '0' ){
                $checkbox   = '';
                $rf = '';
            }else{
    		    if( $row['description_rf'] != '' ){
    		        $checkbox   = $row['description_rf'];
    		    }else{
    		        $checkbox   = 'Registration fees';
    		    }
    		    $rf = number_format(($row['ph_rf']), 2);
            }
        }else{
            $checkbox   = '';
            $rf = '';
        }
        
    	$total = number_format(($row['ph_amount'] + $rf), 2);
    	
    	$thisamount     = $row['ph_amount'];
    	$thisamount2  = str_replace(",", "", $thisamount);
    	$thisamount3 = $thisamount2;
    	$amount = number_format(($thisamount3), 2);
        
        
        
        
$html = '

<!DOCTYPE html>
<html>
<head>
<style>
table, td, th {
  border: 0px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th {
  text-align: left;
}
</style>
</head>
<body>

<br/><br/>
<table cellspacing="20">
  <tr>
    <td> <font style="font-size:40pt; color:#272264; font-family:Bebas Neue; line-height:18px;"><b>INVOICE</b></font> </td>
    <td align="right"><img src="https://www.tutorkami.com/images/logo.png" alt="Snow" ></td>
  </tr>
</table>

<br/>
<hr style="border: 5px solid #DDDDDD;">
<br/><br/>
<table cellspacing="20">
  <tr>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;FROM</b></font>         </td>
  <td style="padding-left: 20px;">  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;INVOICED TO</b></font>       </td>
  <td>  <font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;INVOICE NO</b></font>  </td>
  <td align="right">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>i'.$job.''.$cycle.'</b></font>     </td>
  </tr>

  <tr>
  <td>  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>TK Edu Sdn Bhd</b></font>  </td>
  <td style="padding-left: 20px;">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$qUserD.'</b></font>       </td>
  <td>  <br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;INVOICE DATE</b></font>    </td>
  <td align="right">  <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$date.'</b></font>      </td>
  </tr>
  
  <tr>
  <td>  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>(1161349-W)</b></font>     </td>
  <td style="padding-left: 20px;">  <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>('.$qJobPhone.')</b></font>    </td>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>Contact No :</b></font>  </td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
  <tr>
  <td>    <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>019-3613956</b></font> </td>
  <td></td>
  <td></td>
  <td></td>
</tr>
</table>

<br/>
';

if( $row['ph_receipt'] == 'trial' ){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
            <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
          <tr>
          <tr>
            <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.' '.$hours.' '.$desc.' (Trial session)</b></font> </td>
            <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount.'</b></font> </td>
          </tr>
        </table>
    ';
}else if( $row['ph_receipt'] == 'trial paid' ){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
            <td><img style="margin-left:100px;" src="img/paid.PNG" alt="paid" ></td>
            <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
          </tr>
        </table>
        
        <table cellspacing="20" style="margin-top:-30px;">
          <tr>
            <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.' '.$hours.' '.$desc.' (Trial session)</b></font> </td>
            <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount.'</b></font> </td>
          </tr>
        </table>
    ';
}else if( $row['ph_receipt'] == 'temp' ){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
            <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
          <tr>
        
          <tr>
            <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.' '.$hours.' '.$desc.' (Cycle #'.$thisCycle2.')</b></font> </td>
            <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount.'</b></font> </td>
          </tr>
        </table>
    ';
}else{
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <br/><br/><font style="border-left: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>&nbsp;DESCRIPTION</b></font>  </td>
            <td><img style="margin-left:100px;" src="img/paid.PNG" alt="paid" ></td>
            <td align="right"> <br/><br/><font style="border-right: 3px solid #272264; height: 32px; font-size:15pt; color:#272264; font-family:Bebas Neue;     line-height:18px;"><b>AMOUNT&nbsp;</b></font>  </td>
          </tr>
        </table>
        
        <table cellspacing="20" style="margin-top:-30px;">
          <tr>
            <td> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$tutor.' '.$hours.' '.$desc.' (Cycle #'.$thisCycle2.')</b></font> </td>
            <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$amount.'</b></font> </td>
          </tr>
        </table>
    ';
}



if($checkbox != ''){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$checkbox.'</b></font> </td>
            <td align="right"> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$rf.'</b></font> </td>
          </tr>
        </table>
    ';
}
if($row['ph_remarks'] != ''){
    $html .= '
        <table cellspacing="20">
          <tr>
            <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>'.$row['ph_remarks'].'</b></font> </td>
            <td align="right"> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b></b></font> </td>
          </tr>
        </table>
    ';
}

  
$html .= '
<table cellspacing="20">
  <tr>
  </tr>
  <tr>
    <td> <font style="border-left: 0px solid #272264; height: 32px; font-size:10pt; color:#595959; font-family:Century Gothic; line-height:18px;"><b>&nbsp;</b></font> </td>
    <td align="right"> <br/><font style="border-left: 0px solid #272264; height: 32px; font-size:15pt; color:#f1592a; font-family:Bebas Neue; line-height:18px;"><b>TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RM '.$total.'</b></font> </td>
  </tr>
</table>

<br/><br/>
<hr style="border: 5px solid #DDDDDD;">
<br/><br/>




</body>
</html>
';

	$filename = "i".$job."".$cycle." ".$qUserD.".pdf";
	try {
		require_once("../pdf/mpdf-library/vendor/autoload.php");




		$mpdf = new \Mpdf\Mpdf([
			//'mode' => 'c',
			'margin_top' => 35,
			'margin_bottom' => 17,
			'margin_header' => 10,
			'default_font_size' => 8,
			'default_font' => 'Times New Roman',
			

    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L'
			
	]);

	$mpdf->showImageErrors = true;
	$mpdf->mirrorMargins = 1;
	$mpdf->SetTitle('Generate Invoice | tutorkami.com');
	$mpdf->WriteHTML($html);
	$mpdf->Output('temp-pdf/'.$filename, 'F');

	} catch(\Mpdf\MpdfException $e) {
		echo $e->getMessage();
	}
        
        
        
        
        
        
        
        



        $file = "temp-pdf/" . $filename;
        //$mailto  = $emailTo;
        $mailto = "tkfinance.malaysia@gmail.com, $emailTo";
        
        if( $row['ph_receipt'] == 'trial' || $row['ph_receipt'] == 'trial paid' ){
            $subject = 'Trial Session Receipt (Payment Confirmation) - TutorKami';
        }else{
            $subject = 'Receipt (Payment Confirmation) - TutorKami';
        }
        
        
        $message = "
                Salam/Hi ".$qUserD.",<br><br>
                
                Attached is the payment receipt for Invoice ".$invoiceNo." sent on ".$previousInvoice.".<br><br>
                
                Note: This email will serve as an official receipt for this payment.<br>
                Thank you and have a nice day.<br><br>

                Best Regards,<br>
                Finance Manager<br>

                <a href='https://www.tutorkami.com/'>www.tutorkami.com</a>

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
        */
        
        	if( $dataReceipt['jenis'] == 'Yes' ){
                /*if (mail($mailto, $subject, $body, $headers)) {
                    unlink($file);
                    echo "Mail been sent successfully!";
                } else {
                    unlink($file);
                    echo "Mail cannot be sent!";
                }*/
                
                if(!$mail->Send()) {
                    unlink($file);
                    echo "Mail cannot be sent!";
                } else {
                    unlink($file);
                    echo "Mail been sent successfully!";
                }
        	}else if( $dataReceipt['jenis'] == 'IP' ){
        	    unlink($file);
        	    echo 'Success!';
        	}else{
        	    //No  - delete tk_payment_history
                $sql = "DELETE FROM tk_payment_history WHERE ph_id = '".$dataReceipt['nilai']."' ";
                if ($conn->query($sql) === TRUE) {
                  echo 'Success!';
                } else {
                  echo "Error deleting record: " . $conn->error;
                }
        	    unlink($file);
        	}
        	
        	
/*
        $GetJob = " SELECT j_id, u_id, j_telephone FROM tk_job WHERE j_id = '".$row['ph_job_id']."' ";
        $resultGetJob = $conn->query($GetJob);
        if ($resultGetJob->num_rows > 0) {
            $rowGetJob = $resultGetJob->fetch_assoc();
            $JobUserID = $rowGetJob['u_id'];
            $JobPhone  = $rowGetJob['j_telephone'];
            
            
            $ClientFirstName = '';
            $ClientEmail = '';
			$queryUserD = " SELECT ud_u_id, ud_first_name, ud_last_name FROM tk_user_details WHERE ud_u_id = '".$JobUserID."' ";
			$resultQueryUserD = $conn->query($queryUserD); 
			if($resultQueryUserD->num_rows > 0){ 
				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
				$ClientFirstName = $rowQueryUserD['ud_first_name'];
				$ClientEmail     = $rowQueryUserD['ud_last_name'];
			}
            
            $total = number_format(($row['ph_amount'] + $row['ph_rf']), 2); 

            $aDate = explode('-',$row['ph_date']);
            $my_new_date = $aDate[2].'/'.$aDate[1].'/'.$aDate[0];
            
            if( $row['ph_receipt'] == '1' ){
                $ph_receipt = '01';
            }else{
                $ph_receipt = $row['ph_receipt'];
            }

            $emailDummy = "tkfinance.malaysia@gmail.com";
            if( $ClientEmail != ''){
                $Sub     = array(
                    $ClientEmail
                    ,$emailDummy
                );                                            
            }else{
                $Sub     = array(
                    $emailDummy
                ); 
            }
// START EMAIL
            $subject = 'Receipt ';
            $footer = 'bi';
                
                    $message  = '
                        Dear '.$ClientFirstName.'<br/><br/>
                
                		Attached is your receipt.<br/><br/>
                
                		Thank you.<br/>
                		Best Regards,<br/>
                		Finance Manager<br/>
                		<a href="https://www.tutorkami.com" target="_blank">www.tutorkami.com</a>
                		<br/><br/><br/>
                
                
                		<!DOCTYPE html>
                		<html>
                		<head>
                		<style>
                		table {
                		  border-collapse: collapse;
                		  border: 0px solid black;
                		} 
                
                		th,td {
                		  border: 0px solid black;
                		}
                
                		table.d {
                		  table-layout: fixed;
                		  width: 100%;  
                		}
                
                		.right {
                			float: right;
                		}
                		.left {
                			float: left;
                		}
                
                		.font {
                		   font-family: "Times New Roman", Times, serif;
                		   color: #272264;
                		   font-weight: bold;
                		}
                		.total {
                		   font-family: "Times New Roman", Times, serif;
                		   color: #f1592a;
                		   font-weight: bold;
                		}
                		.desc {
                		   font-family: "century Gothic", century Gothic;
                		   color: #595959;
                		   font-weight: bold;
                		}
                
                		.vl {
                		  border-left: 3px solid #272264;
                		}
                
                		@media (min-width: 1281px) {
                			.phoneContent {display:none;}
                			.deskContent {display:block;}
                		}
                
                
                		@media (min-width: 1025px) and (max-width: 1280px) {
                			.phoneContent {display:none;}
                			.deskContent {display:block;}
                		}
                
                
                		@media (min-width: 768px) and (max-width: 1024px) {
                			.phoneContent {display:none;}
                			.deskContent {display:block;}
                		}
                
                
                		@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
                		}
                
                
                		@media (min-width: 481px) and (max-width: 767px) {
                			.phoneContent {display:block;}
                			.deskContent {display:none;}
                		}
                
                
                		@media (min-width: 320px) and (max-width: 480px) {
                			.phoneContent {display:block;}
                			.deskContent {display:none;}
                		}
                		</style>
                		</head>
                		
                		<body style="max-width:600px">
                		    <div class="deskContent"> </div>
                		        <div class="phoneContent"></div>
                		        <center></center>
                		        
                        		<table class="d">
                        		  <tr>
                        			<td>  <font size="5" style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;RECEIPT</font></td>
                        			<td align="right"> &emsp;&emsp;&nbsp;&nbsp;<img src="https://www.tutorkami.com/images/logo.png" height="40" alt="Facebook" align="right" > </td>
                        		  </tr>
                        		</table>
                
                		        <hr style="border: 2px solid #DDDDDD;">
                
                        		<table class="d">
                        		  <tr>
                        			<td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;FROM</font></td>
                        			<td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">RECEIPT NO &nbsp;</font></td>
                        		  </tr>
                        		  
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">TK EDU Sdn Bhd</font></td>
                        			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">R'.$row['ph_job_id'].''.$ph_receipt.'</font></td>   
                        		  </tr>
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">(1161349-W)</font></td>
                        			<td>&nbsp;</td>
                        		  </tr>
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">Contact no :</font></td>
                        			<td>&nbsp;</td>
                        		  </tr>
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">019-3613956</font></td>
                        			<td>&nbsp;</td>
                        		  </tr>
                        
                        		  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                        		  
                        		  <tr>
                        			<td><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;BILL TO</font></td>
                        			<td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">RECEIPT DATE&nbsp;</font></td>
                        		  </tr>
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$ClientFirstName.'</font></td>   
                        			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$my_new_date.'</font></td>
                        		  </tr>  
                        		  <tr>
                        			<td> <font style="font-family: century Gothic;color: #595959;font-weight: bold;">('.$JobPhone.')</font></td>
                        			<td>&nbsp;</td>
                        		  </tr>
                        		  
                        		  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                        		 
                        		  <tr>
                        			<td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;DESCRIPTION</font></td>
                        			<td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">AMOUNT &nbsp;</font></td>
                        		  </tr>
                        		  <tr>
                        			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$row['tutor'].' '.$row['hour'].' hours of classes</font></td>
                        			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.number_format(($row['ph_amount']), 2).'</font></td>
                        		  </tr>  
                        		';  
                        
                            		if($row['ph_rf'] > 0){
                            		$message  .= '  
                            		  <tr>
                            			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">Registration fees</font></td>
                            			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.number_format(($row['ph_rf']), 2).'</font></td>
                            		  </tr>  
                            		';  
                            		}
                            		
                    $message  .= '  
                        <tr>
                            <td><font style="font-family: Times, serif;color: #f1592a;font-weight: bold;">TOTAL</font></td>
                            <td align="right"><font style="font-family: Times, serif;color: #f1592a;font-weight: bold;">RM '.$total.'</font></td>
                        </tr>
                        		  
                        		</table>
                        		<br/>
                
                		        <table class="d"></table>
                
                		        <hr style="border: 2px solid #DDDDDD;">
                
                		</body>
                		</html>';
// END EMAIL
            
            
        	if( $dataReceipt['jenis'] == 'Yes' ){
                        $m       = $instNews->sendEmailTemplate('', $Sub, $subject, $message, $footer);
                        if ($m) {
                            echo 'Mail been sent successfully!';
                        } else {
                            echo 'Mail cannot be sent!';
                        }        	    
        	}else if( $dataReceipt['jenis'] == 'IP' ){
        	    echo 'Success!';
        	}else{
        	    //No  - delete tk_payment_history
                $sql = "DELETE FROM tk_payment_history WHERE ph_id = '".$dataReceipt['nilai']."' ";
                if ($conn->query($sql) === TRUE) {
                  echo 'Success!';
                } else {
                  echo "Error deleting record: " . $conn->error;
                }
        	}
            
            
            
            
            
        }else{
           echo 'Error!';
        }
*/
        
        
    }else{
        echo 'Error!';
    }
	
}




















?>