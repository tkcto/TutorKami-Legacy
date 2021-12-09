<?php
require_once('classes/config.php.inc');
require_once('classes/whatsapp-api-call.php');

$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


date_default_timezone_set("Asia/Kuala_Lumpur");

$currentDate = date('Y-m-d');
//$currentDate = date('2019-02-13');
$dateRec = str_replace('-', '/', $currentDate);
$tomorrow = date('Y-m-d',strtotime($dateRec . "+1 days"));

$allowSend = " SELECT wa_job_id FROM tk_send_wa ";
$resultallowSend = $conn->query($allowSend);
if ($resultallowSend->num_rows > 0) {
	while($rowallowSend = $resultallowSend->fetch_assoc()){
		//echo $rowallowSend['wa_job_id'];
		$Job = " SELECT j_id, j_status, j_payment_status, j_start_date, j_telephone, j_hired_tutor_email, u_id FROM tk_job WHERE j_id = '".$rowallowSend['wa_job_id']."' AND j_status = 'closed' AND j_payment_status = 'pending' AND j_start_date = '".$tomorrow."' ";	
		$resultJob = $conn->query($Job);
		if ($resultJob->num_rows > 0) {
			$rowJob = $resultJob->fetch_assoc();
			//echo $rowJob['j_id'];
			$Client = " SELECT ud_u_id, ud_first_name FROM tk_user_details WHERE ud_u_id = '".$rowJob['u_id']."'    ";	
			$resultClient = $conn->query($Client);
			if ($resultClient->num_rows > 0) {
				$rowClient = $resultClient->fetch_assoc();		
				$clientName = $rowClient['ud_first_name'];				
			}else{
				$clientName = '';
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
			//echo "Salam ".ucwords($clientName).", mohon confirm kan kelas esok dengan ".ucwords($TutorDisplayName)." dengan menekan link ini https://wa.me/60178847085?text=sayaconfirmesokkelasjadi dan tekan Send untuk hantarnya kepada tutor. Jika ".ucwords($clientName)." tidak confirm kelas esok dengan tutor hari ini, maka kelas esok tidak akan dijalankan oleh tutor. Terima kasih atas kerjasama ".ucwords($clientName)."
			//\r\n\r\n (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)";
			$args = new stdClass();
			$xdata = new stdClass();
			$args->to = "6".$rowJob['j_telephone']."@c.us";
			$args->content = "Salam ".ucwords($clientName).", mohon confirm kan kelas esok dengan ".ucwords($TutorDisplayName)." dengan menekan link ini https://wa.me/".$TutorPhoneNo."?text=sayaconfirmesokkelasjadi dan tekan Send untuk hantarnya kepada tutor. Jika ".ucwords($clientName)." tidak confirm kelas esok dengan tutor hari ini, maka kelas esok tidak akan dijalankan oleh tutor. Terima kasih atas kerjasama ".ucwords($clientName)."\r\n\r\n\r\n\r\n (Ini adalah mesej automatik dari TutorKami.com. Sila tidak reply pada no phone ini)";
			$xdata->args = $args;
			
			//$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); 
		}		
	}
}









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
