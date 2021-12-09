<?php
//https://codepen.io/g13nn/pen/VLZEgE

require_once('classes/config.php.inc');

require_once('classes/template-email.class.php');
$instNews = new template;

require_once('classes/whatsapp-api-call.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

// Transform hours like "1.45" into the total number of minutes, "105". 
function hoursToMinutes($hours) { 
    $minutes = 0; 
    if (strpos($hours, '.') !== false) { 
        // Split hours and minutes. 
        list($hours, $minutes) = explode('.', $hours); 
    } 
    return $hours * 60 + $minutes; 
} 

// Transform minutes like "105" into hours like "1.45". 
function minutesToHours($minutes) { 
    $hours = (int)($minutes / 60); 
    $minutes -= $hours * 60; 
    return sprintf("%d.%02.0f", $hours, $minutes); 
}

if($_POST["actualEmail"]){

    $date       = $_POST['date'];
    //$newdate =  date("Y-m-d", strtotime($date) );
    
	$dateInput = explode('/',$_POST['date']);
	$newdate = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    
    $job        = $_POST['jobID'];//'6996';
    //$tutor      = $_POST['tutor'];
    $tutor      = htmlspecialchars($_POST['tutor'], ENT_QUOTES);
	$amount     = number_format($_POST['amount'], 2); //float with 2 decimal places: .00
	$hours      = $_POST['hours']; 
 
    $emailDummy = 'tkfinance.malaysia@gmail.com';
    $cycle_no      = $_POST['cycle_no'];
    $cl_cycle      = $_POST['cl_cycle'];
    
    
	$qeJob2 = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resQueryJob2 = $conn->query($qeJob2); 
	if($resQueryJob2->num_rows > 0){
	    $rQJob2 = $resQueryJob2->fetch_assoc();
	    if( $rQJob2['cycle'] == '' || $rQJob2['cycle'] == NULL ){
	        echo "Empty Cycle";
	        exit();
	    }
	}
    

	if($_POST['checkbox'] == 'true'){
		$checkbox   = 'Registration fees';
		if($_POST['rfAmount'] != ''){
			$rf = number_format($_POST['rfAmount'], 2);
		}else{
			$rf = number_format('50', 2);   
		}
		
	}else{
		$checkbox   = '';
		$rf = number_format('0', 2); 
	}
		
	$thisamount  = str_replace(",", "", $amount);
	$amountnrf = $thisamount + $rf;
	$total = number_format(($amountnrf), 2);
	
    $ActualEmail = $_POST['actualEmail'];

	$queryJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resultQueryJob = $conn->query($queryJob); 
	if($resultQueryJob->num_rows > 0){
		
		$rowQueryJob = $resultQueryJob->fetch_assoc();
		$qJobId = $rowQueryJob['j_email'];
		$qJobPhone = $rowQueryJob['j_telephone'];
		$qTutorEmail = $rowQueryJob['j_hired_tutor_email'];
	
		$queryUser = " SELECT * FROM tk_user WHERE u_email='".$qJobId."'  ";
		$resultQueryUser = $conn->query($queryUser); 
		if($resultQueryUser->num_rows > 0){ 
			$rowQueryUser = $resultQueryUser->fetch_assoc();
			$qUser = $rowQueryUser['u_id'];
			$u_displayid = $rowQueryUser['u_displayid'];
    	
			$queryUserD = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
			$resultQueryUserD = $conn->query($queryUserD); 
			if($resultQueryUserD->num_rows > 0){ 
				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
				$qUserD = $rowQueryUserD['ud_first_name'];
			}
		}
		
		$queryUserT = " SELECT * FROM tk_user WHERE u_email='".$qTutorEmail."'  ";
		$resultQueryUserT = $conn->query($queryUserT); 
		if($resultQueryUserT->num_rows > 0){ 
			$rowQueryUserT = $resultQueryUserT->fetch_assoc();
			$qUserT = $rowQueryUserT['u_id'];
			$u_displayidT = $rowQueryUserT['u_displayname'];
    	
			$queryUserDT = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUserT."'  ";
			$resultQueryUserDT = $conn->query($queryUserDT); 
			if($resultQueryUserDT->num_rows > 0){ 
				$rowQueryUserDT = $resultQueryUserDT->fetch_assoc();
				$qUserDT = $rowQueryUserDT['ud_phone_number'];
			}
		}
		
	}
	
		

	$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".$_POST["jobID"]."'  ";
	$resultClasses = $conn->query($queryClasses); 
	if($resultClasses->num_rows > 0){
		$rQClasses = $resultClasses->fetch_assoc();

		$qeJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
		$resQueryJob = $conn->query($qeJob); 
		if($resQueryJob->num_rows > 0){
			$rQJob = $resQueryJob->fetch_assoc();

			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
			$rParent = $conn->query($qParent); 
			if($rParent->num_rows > 0){ 
				$rowParent = $rParent->fetch_assoc();
				$thisParent = $rowParent['u_id'];
			}
		}

		$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' AND ph_job_id ='".$job."' ORDER BY ph_id DESC  ";
		$resCycle = $conn->query($qCycle); 
		if($resCycle->num_rows > 0){
			$rQCycle = $resCycle->fetch_assoc();
			$cycle = (((int)$rQCycle['ph_receipt']) + 1);
		}else{
			$cycle = '1';
		}
		
		$createPayment = "INSERT INTO tk_payment_history 
		(ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) 
		VALUES 
		('4', '".$thisParent."', '".$newdate."', '".$job."', '".$cycle."', '".$amount."', '".$rf."', '".$hours."', '".$tutor."') ";
		if ($conn->query($createPayment) === TRUE) {
			$last_id = $conn->insert_id;
		} 
		$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".$job."' ";
		$conn->query($UpdateParentBilled);
		
		$queryClassesRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Required Parent To Pay' ";
		$resultClassesRecord = $conn->query($queryClassesRecord); 
		if($resultClassesRecord->num_rows > 0){
			$rowClassesRecord = $resultClassesRecord->fetch_assoc();
			
					$latestBalance =  $rowClassesRecord['cr_balance'];
					$newBalance = $cl_cycle + $latestBalance;

					if ( $latestBalance < 0 ) {
						$convertNegative = abs($latestBalance);
					
						$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
						$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
						
						$cycleHourTwoDecimalPlaces = number_format((float)$cl_cycle, 2, '.', '');  // Outputs -> 105.00
						$cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
						
						$totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
						$newBalance2 = (minutesToHours($totalBalanceInMin));
					}else{
						$findDots = strpos($newBalance, '.');
						if(is_int($findDots)){
						 $getValueAfterDots = substr($newBalance, strrpos($newBalance, '.') + 1);
						 $stringToDigit = (int)$getValueAfterDots;
						 if ( strlen((string)$stringToDigit) == '1' ){
							 if ( $getValueAfterDots >= 6 ){
								 $thisvalue = ($getValueAfterDots - 6);
								 
								 $first = strtok($newBalance, '.');
						
								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue.'0';
								 
							 }else{
								 $newBalance2 = $newBalance;
							 }
						 }else{
							 if ( $getValueAfterDots >= 60 ){
								 $thisvalue = ($getValueAfterDots - 60);
								 
								 $first = strtok($newBalance, '.');
						
								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue;
								 
							 }else{
								 $newBalance2 = $newBalance;
							 }
						 }
						}else{
							$newBalance2 = $newBalance;
						}
					}

					//$sqlUpdateBalCycle = " UPDATE tk_job SET cycle = '".$cl_cycle."' WHERE j_id='".$job."' ";
					//$conn->query($sqlUpdateBalCycle);

					$newCycle = $rowClassesRecord['cr_classes'] + 1;
					$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_cycle = '".$cl_cycle."', cr_balance = '".($cl_cycle + ($rowClassesRecord['cr_balance']))."',  cr_status = 'new Cycle', cr_classes = '".$newCycle."' WHERE cr_id = '".$rowClassesRecord['cr_id']."' ";
					$conn->query($sqlUpdateBalS);
					
					$sqlUpdateBalWhile = " SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$rQClasses["cl_id"]."' ";
					$resultsqlUpdateBalWhile = $conn->query($sqlUpdateBalWhile); 
					if($resultsqlUpdateBalWhile->num_rows > 0){
						while($rowUpdateBalWhile= $resultsqlUpdateBalWhile->fetch_assoc()){
							$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile['cr_id']."' ";
							$conn->query($sqlUpdateBalS);
						}
					}
					$sqlUpdateBalWhile2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC  ";
					$resultsqlUpdateBalWhile2 = $conn->query($sqlUpdateBalWhile2); 
					if($resultsqlUpdateBalWhile2->num_rows > 0){
						$rowUpdateBalWhile2= $resultsqlUpdateBalWhile2->fetch_assoc();
							$sqlUpdateBalS2 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile2['cr_id']."' ";
							$conn->query($sqlUpdateBalS2);
					}
					
					
					
					$sqlUpdateBal = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".$cl_cycle."'  WHERE cl_id = '".$rQClasses["cl_id"]."' ";
					if($conn->query($sqlUpdateBal)){
					    /*
						$args = new stdClass();
						$xdata = new stdClass();
						$args->to = "6".$qUserDT."@c.us";
						$args->content = "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you\r\n- message from Finance Manager TutorKami -\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
						$xdata->args = $args;
						
						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
						*/
						$xdata = array( "to" => "6".$qUserDT,
						        "message" => "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you newLine - message from Finance Manager TutorKami - newLine (This is an auto message from TutorKami.com. Please do not reply to this number) " );
						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
					}
		}
		$queryClassesRecordTP = " SELECT cr_id, cr_cl_id, cr_status, cr_date  FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Tutor Paid' ORDER BY cr_date DESC ";
		$resultClassesRecordTP = $conn->query($queryClassesRecordTP); 
		if($resultClassesRecordTP->num_rows > 0){
			$rowClassesRecordTP = $resultClassesRecordTP->fetch_assoc();
			
			$queryCekLast = " SELECT cr_id, cr_cl_id, cr_date FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC ";
			$resultCekLast = $conn->query($queryCekLast); 
			if($resultCekLast->num_rows > 0){
				$rowCekLast = $resultCekLast->fetch_assoc();
				$dataLastRekod = $rowCekLast["cr_id"];
			}else{
				$dataLastRekod = '';
			}
			if( $rowClassesRecordTP["cr_id"] == $dataLastRekod ){
				$thisTemp = 'temp - '.$cl_cycle;
				$createClass = "INSERT INTO tk_classes_record (cr_cl_id, current_cycle) VALUES ('".$rQClasses["cl_id"]."', '".$thisTemp."') ";
				$conn->query($createClass);		
			}
		}
	}else{
		$qeJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
		$resQueryJob = $conn->query($qeJob); 
		if($resQueryJob->num_rows > 0){
			$rQJob = $resQueryJob->fetch_assoc();
			
			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
			$rParent = $conn->query($qParent); 
			if($rParent->num_rows > 0){ 
				$rowParent = $rParent->fetch_assoc();
				$thisParent = $rowParent['u_id'];
				
				//$sqlUpdate = "UPDATE tk_user SET u_password = '".md5($thisParent)."' WHERE u_id='".$thisParent."'";
				//$conn->query($sqlUpdate);
			}
			$qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
			$rTutor = $conn->query($qTutor); 
			if($rTutor->num_rows > 0){ 
				$rowTutor = $rTutor->fetch_assoc();
				$thisutor = $rowTutor['u_id'];
			}
			$qSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id='".$job."'  ";
			$rSubject = $conn->query($qSubject); 
			if($rSubject->num_rows > 0){ 
				$rowSubject = $rSubject->fetch_assoc();
				$thisSubject = $rowSubject['jt_subject'];
			}
			
            $sqlCekKelas = " SELECT * FROM tk_classes WHERE cl_display_id='".$job."' ";
			$resCekKelas = $conn->query($sqlCekKelas); 
			if($resCekKelas->num_rows > 0){
			}else{
				$createClass = "INSERT INTO tk_classes 
				(cl_display_id, cl_student_id, cl_tutor_id, cl_student, cl_subject, cl_rate, cl_charge_parent, cl_hours_balance, cl_cycle, cl_status, cl_country_id, cl_create_date) 
				VALUES 
				('".$job."', '".$thisParent."', '".$thisutor."', '".$rQJob['student_name']."', '".$thisSubject."', '".$rQJob['j_rate']."', '".$rQJob['parent_rate']."', '".$rQJob['cycle']."', '".$rQJob['cycle']."', 'ongoing', '150', '".date('Y-m-d H:i:s')."') ";
				$conn->query($createClass);				
			}

			$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' AND ph_job_id ='".$job."' ORDER BY ph_id DESC  ";
			$resCycle = $conn->query($qCycle); 
			if($resCycle->num_rows > 0){
				$rQCycle = $resCycle->fetch_assoc();
				$cycle = (((int)$rQCycle['ph_receipt']) + 1);
			}else{
				if($cycle_no != ''){
					$cycle = $cycle_no;
				}else{
					$cycle = '1';
				}
			}
		
			$createPayment = "INSERT INTO tk_payment_history 
			(ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) 
			VALUES 
			('4', '".$thisParent."', '".$newdate."', '".$job."', '".$cycle."', '".$amount."', '".$rf."', '".$hours."', '".$tutor."') ";
			if ($conn->query($createPayment) === TRUE) {
				$last_id = $conn->insert_id;
			}
			$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".$job."' ";
			$conn->query($UpdateParentBilled);
		}
	}

    $pad_length = 2;
    $pad_char = 0;

    $thisCycle = str_pad($cycle, $pad_length, $pad_char, STR_PAD_LEFT);

    $Sub     = array(
        //$_POST['actualEmail']
        $ActualEmail
        ,$emailDummy
    );

    $subject = 'Receipt ';
    $footer = 'bi';


			$message  = '
		Dear '.$qUserD.'<br/><br/>

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







		/* 
		  ##Device = Desktops
		  ##Screen = 1281px to higher resolution desktops
		*/
		@media (min-width: 1281px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Laptops, Desktops
		  ##Screen = B/w 1025px to 1280px
		*/
		@media (min-width: 1025px) and (max-width: 1280px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Tablets, Ipads (portrait)
		  ##Screen = B/w 768px to 1024px
		*/
		@media (min-width: 768px) and (max-width: 1024px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Tablets, Ipads (landscape)
		  ##Screen = B/w 768px to 1024px
		*/
		@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
		}

		/* 
		  ##Device = Low Resolution Tablets, Mobiles (Landscape)
		  ##Screen = B/w 481px to 767px
		*/
		@media (min-width: 481px) and (max-width: 767px) {
			.phoneContent {display:block;}
			.deskContent {display:none;}
		}

		/* 
		  ##Device = Most of the Smartphones Mobiles (Portrait)
		  ##Screen = B/w 320px to 479px
		*/
		@media (min-width: 320px) and (max-width: 480px) {
			.phoneContent {display:block;}
			.deskContent {display:none;}
		}






		</style>
		</head>
		<body style="max-width:600px">

		<div class="deskContent"> </div>
		<div class="phoneContent">
		</div>

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
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">R'.$job.''.$thisCycle.'</font></td>   
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
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$qUserD.'</font></td>   
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$date.'</font></td>
		  </tr>  
		  <tr>
			<td> <font style="font-family: century Gothic;color: #595959;font-weight: bold;">('.$qJobPhone.')</font></td>
			<td>&nbsp;</td>
		  </tr>
		  
		  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		 
		  <tr>
			<td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;DESCRIPTION</font></td>
			<td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">AMOUNT &nbsp;</font></td>
		  </tr>
		  <tr>
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$tutor.' '.$hours.' hours of classes</font></td>
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$amount.'</font></td>
		  </tr>  
		';  

		if($checkbox != ''){
		$message  .= '  
		  <tr>
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$checkbox.'</font></td>
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$rf.'</font></td>
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

		<table class="d">
		</table>

		<hr style="border: 2px solid #DDDDDD;">

		</body>
		</html>
				';
        
        $m       = $instNews->sendEmailTemplate('', $Sub, $subject, $message, $footer);
        
        if ($m) {
            echo 'Mail been sent successfully!';
        } else {
            echo 'Mail cannot be sent!';
        } 
}else{
    
    $date       = $_POST['date'];
    
	$dateInput = explode('/',$_POST['date']);
	$newdate = $dateInput[2].'-'.$dateInput[1].'-'.$dateInput[0];
    
    $job        = $_POST['jobID'];
    //$tutor      = $_POST['tutor'];
    $tutor      = htmlspecialchars($_POST['tutor'], ENT_QUOTES);
    
	$amount     = number_format($_POST['amount'], 2); 
	$hours      = $_POST['hours']; 
 
    $emailDummy = 'tkfinance.malaysia@gmail.com';
    $cycle_no      = $_POST['cycle_no'];
    $cl_cycle      = $_POST['cl_cycle'];
    
    
	$qeJob2 = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resQueryJob2 = $conn->query($qeJob2); 
	if($resQueryJob2->num_rows > 0){
	    $rQJob2 = $resQueryJob2->fetch_assoc();
	    if( $rQJob2['cycle'] == '' || $rQJob2['cycle'] == NULL ){
	        echo "Empty Cycle";
	        exit();
	    }
	}
    
	if($_POST['checkbox'] == 'true'){
		$checkbox   = 'Registration fees';
		if($_POST['rfAmount'] != ''){
			$rf = number_format($_POST['rfAmount'], 2);
		}else{
			$rf = number_format('50', 2);   
		}
	}else{
		$checkbox   = '';
		$rf = number_format('0', 2); 
	}
	
	
	$thisamount  = str_replace(",", "", $amount);
	$amountnrf = $thisamount + $rf;
	$total = number_format(($amountnrf), 2);
	
    	$JobaActualEmail = " SELECT * FROM tk_job WHERE j_id='".$job."' AND actual_email !=''  ";
    	$resultJobaActualEmail = $conn->query($JobaActualEmail); 
    	if($resultJobaActualEmail->num_rows > 0){
    	    $rowJobaActualEmail = $resultJobaActualEmail->fetch_assoc();
            $ActualEmail = $rowJobaActualEmail['actual_email'];
    	}else{
    	    echo "Empty Actual Email On Job Detail";
    	    exit();
    	}
        



	$queryJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
	$resultQueryJob = $conn->query($queryJob); 
	if($resultQueryJob->num_rows > 0){
		
		$rowQueryJob = $resultQueryJob->fetch_assoc();
		$qJobId = $rowQueryJob['j_email'];
		$qJobPhone = $rowQueryJob['j_telephone'];
		$qTutorEmail = $rowQueryJob['j_hired_tutor_email'];
	
		$queryUser = " SELECT * FROM tk_user WHERE u_email='".$qJobId."'  ";
		$resultQueryUser = $conn->query($queryUser); 
		if($resultQueryUser->num_rows > 0){ 
			$rowQueryUser = $resultQueryUser->fetch_assoc();
			$qUser = $rowQueryUser['u_id'];
			$u_displayid = $rowQueryUser['u_displayid'];
    	
			$queryUserD = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
			$resultQueryUserD = $conn->query($queryUserD); 
			if($resultQueryUserD->num_rows > 0){ 
				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
				$qUserD = $rowQueryUserD['ud_first_name'];
			}
		}
		
		$queryUserT = " SELECT * FROM tk_user WHERE u_email='".$qTutorEmail."'  ";
		$resultQueryUserT = $conn->query($queryUserT); 
		if($resultQueryUserT->num_rows > 0){ 
			$rowQueryUserT = $resultQueryUserT->fetch_assoc();
			$qUserT = $rowQueryUserT['u_id'];
			$u_displayidT = $rowQueryUserT['u_displayname'];
    	
			$queryUserDT = " SELECT * FROM tk_user_details WHERE ud_u_id='".$qUserT."'  ";
			$resultQueryUserDT = $conn->query($queryUserDT); 
			if($resultQueryUserDT->num_rows > 0){ 
				$rowQueryUserDT = $resultQueryUserDT->fetch_assoc();
				$qUserDT = $rowQueryUserDT['ud_phone_number'];
			}
		}
	}
	
	
	$queryClasses = " SELECT * FROM tk_classes WHERE cl_display_id='".$_POST["jobID"]."'  ";
	$resultClasses = $conn->query($queryClasses); 
	if($resultClasses->num_rows > 0){
		$rQClasses = $resultClasses->fetch_assoc();

		$qeJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
		$resQueryJob = $conn->query($qeJob); 
		if($resQueryJob->num_rows > 0){
			$rQJob = $resQueryJob->fetch_assoc();

			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
			$rParent = $conn->query($qParent); 
			if($rParent->num_rows > 0){ 
				$rowParent = $rParent->fetch_assoc();
				$thisParent = $rowParent['u_id'];
			}
		}


		$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' AND ph_job_id ='".$job."' ORDER BY ph_id DESC  ";
		$resCycle = $conn->query($qCycle); 
		if($resCycle->num_rows > 0){
			$rQCycle = $resCycle->fetch_assoc();
			$cycle = (((int)$rQCycle['ph_receipt']) + 1);
		}else{
			$cycle = '1';
		}
		
		$createPayment = "INSERT INTO tk_payment_history 
		(ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) 
		VALUES 
		('4', '".$thisParent."', '".$newdate."', '".$job."', '".$cycle."', '".$amount."', '".$rf."', '".$hours."', '".$tutor."') ";
		if ($conn->query($createPayment) === TRUE) {
			$last_id = $conn->insert_id;
		} 
		$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".$job."' ";
		$conn->query($UpdateParentBilled);
		
		$queryClassesRecord = " SELECT * FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Required Parent To Pay' ";
		$resultClassesRecord = $conn->query($queryClassesRecord); 
		if($resultClassesRecord->num_rows > 0){
			$rowClassesRecord = $resultClassesRecord->fetch_assoc();
			
					$latestBalance =  $rowClassesRecord['cr_balance'];
					$newBalance = $cl_cycle + $latestBalance;

					if ( $latestBalance < 0 ) {
						$convertNegative = abs($latestBalance);
					
						$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
						$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
						
						$cycleHourTwoDecimalPlaces = number_format((float)$cl_cycle, 2, '.', '');  // Outputs -> 105.00
						$cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
						
						$totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
						$newBalance2 = (minutesToHours($totalBalanceInMin));
					}else{
						$findDots = strpos($newBalance, '.');
						if(is_int($findDots)){
						 $getValueAfterDots = substr($newBalance, strrpos($newBalance, '.') + 1);
						 $stringToDigit = (int)$getValueAfterDots;
						 if ( strlen((string)$stringToDigit) == '1' ){
							 if ( $getValueAfterDots >= 6 ){
								 $thisvalue = ($getValueAfterDots - 6);
								 
								 $first = strtok($newBalance, '.');
						
								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue.'0';
								 
							 }else{
								 $newBalance2 = $newBalance;
							 }
						 }else{
							 if ( $getValueAfterDots >= 60 ){
								 $thisvalue = ($getValueAfterDots - 60);
								 
								 $first = strtok($newBalance, '.');
						
								 $newBalance2 = ((int)$first + 1).'.'.$thisvalue;
								 
							 }else{
								 $newBalance2 = $newBalance;
							 }
						 }
						}else{
							$newBalance2 = $newBalance;
						}
					}
					
					//$sqlUpdateBalCycle = " UPDATE tk_job SET cycle = '".$cl_cycle."' WHERE j_id='".$job."' ";
					//$conn->query($sqlUpdateBalCycle);

					$newCycle = $rowClassesRecord['cr_classes'] + 1;
					$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_cycle = '".$cl_cycle."', cr_balance = '".($cl_cycle + ($rowClassesRecord['cr_balance']))."',  cr_status = 'new Cycle', cr_classes = '".$newCycle."' WHERE cr_id = '".$rowClassesRecord['cr_id']."' ";
					$conn->query($sqlUpdateBalS);
					
					$sqlUpdateBalWhile = " SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$rQClasses["cl_id"]."' ";
					$resultsqlUpdateBalWhile = $conn->query($sqlUpdateBalWhile); 
					if($resultsqlUpdateBalWhile->num_rows > 0){
						while($rowUpdateBalWhile= $resultsqlUpdateBalWhile->fetch_assoc()){
							$sqlUpdateBalS = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile['cr_id']."' ";
							$conn->query($sqlUpdateBalS);
						}
					}
					$sqlUpdateBalWhile2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC ";
					$resultsqlUpdateBalWhile2 = $conn->query($sqlUpdateBalWhile2); 
					if($resultsqlUpdateBalWhile2->num_rows > 0){
						$rowUpdateBalWhile2= $resultsqlUpdateBalWhile2->fetch_assoc();
							$sqlUpdateBalS2 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowUpdateBalWhile2['cr_id']."' ";
							$conn->query($sqlUpdateBalS2);
					}

					
					
					$sqlUpdateBal = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".$cl_cycle."'  WHERE cl_id = '".$rQClasses["cl_id"]."' ";
					if($conn->query($sqlUpdateBal)){
					    /*
						$args = new stdClass();
						$xdata = new stdClass();
						$args->to = "6".$qUserDT."@c.us";
						$args->content = "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you\r\n- message from Finance Manager TutorKami -\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
						$xdata->args = $args;
						
						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );   
						*/
						$xdata = array( "to" => "6".$qUserDT,
						        "message" => "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you newLine - message from Finance Manager TutorKami - newLine (This is an auto message from TutorKami.com. Please do not reply to this number) " );
						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
					}
		}
		$queryClassesRecordTP = " SELECT cr_id, cr_cl_id, cr_status, cr_date  FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' AND cr_status = 'Tutor Paid' ORDER BY cr_date DESC ";
		$resultClassesRecordTP = $conn->query($queryClassesRecordTP); 
		if($resultClassesRecordTP->num_rows > 0){
			$rowClassesRecordTP = $resultClassesRecordTP->fetch_assoc();
			
			$queryCekLast = " SELECT cr_id, cr_cl_id, cr_date FROM tk_classes_record WHERE cr_cl_id='".$rQClasses["cl_id"]."' ORDER BY cr_date DESC ";
			$resultCekLast = $conn->query($queryCekLast); 
			if($resultCekLast->num_rows > 0){
				$rowCekLast = $resultCekLast->fetch_assoc();
				$dataLastRekod = $rowCekLast["cr_id"];
			}else{
				$dataLastRekod = '';
			}
			if( $rowClassesRecordTP["cr_id"] == $dataLastRekod ){
				$thisTemp = 'temp - '.$cl_cycle;
				$createClass = "INSERT INTO tk_classes_record (cr_cl_id, current_cycle) VALUES ('".$rQClasses["cl_id"]."', '".$thisTemp."') ";
				$conn->query($createClass);		
			}
		}
	}else{
		
		$qeJob = " SELECT * FROM tk_job WHERE j_id='".$job."'  ";
		$resQueryJob = $conn->query($qeJob); 
		if($resQueryJob->num_rows > 0){
			$rQJob = $resQueryJob->fetch_assoc();
			
			$qParent = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_email']."'  ";
			$rParent = $conn->query($qParent); 
			if($rParent->num_rows > 0){ 
				$rowParent = $rParent->fetch_assoc();
				$thisParent = $rowParent['u_id'];
				
				//$sqlUpdate = "UPDATE tk_user SET u_password = '".md5($thisParent)."' WHERE u_id='".$thisParent."'";
				//$conn->query($sqlUpdate);
			}
			$qTutor = " SELECT * FROM tk_user WHERE u_email='".$rQJob['j_hired_tutor_email']."'  ";
			$rTutor = $conn->query($qTutor); 
			if($rTutor->num_rows > 0){ 
				$rowTutor = $rTutor->fetch_assoc();
				$thisutor = $rowTutor['u_id'];
			}
			$qSubject = " SELECT * FROM tk_job_translation WHERE jt_j_id='".$job."'  ";
			$rSubject = $conn->query($qSubject); 
			if($rSubject->num_rows > 0){ 
				$rowSubject = $rSubject->fetch_assoc();
				$thisSubject = $rowSubject['jt_subject'];
			}

			$sqlCekKelas = " SELECT * FROM tk_classes WHERE cl_display_id='".$job."' ";
			$resCekKelas = $conn->query($sqlCekKelas); 
			if($resCekKelas->num_rows > 0){
			}else{
				$createClass = "INSERT INTO tk_classes 
				(cl_display_id, cl_student_id, cl_tutor_id, cl_student, cl_subject, cl_rate, cl_charge_parent, cl_hours_balance, cl_cycle, cl_status, cl_country_id, cl_create_date) 
				VALUES 
				('".$job."', '".$thisParent."', '".$thisutor."', '".$rQJob['student_name']."', '".$thisSubject."', '".$rQJob['j_rate']."', '".$rQJob['parent_rate']."', '".$rQJob['cycle']."', '".$rQJob['cycle']."', 'ongoing', '150', '".date('Y-m-d H:i:s')."') ";
				$conn->query($createClass);				
			}

			$qCycle = " SELECT * FROM tk_payment_history WHERE ph_user_id='".$thisParent."' AND ph_job_id ='".$job."' ORDER BY ph_id DESC  ";
			$resCycle = $conn->query($qCycle); 
			if($resCycle->num_rows > 0){
				$rQCycle = $resCycle->fetch_assoc();
				$cycle = (((int)$rQCycle['ph_receipt']) + 1);
			}else{
				if($cycle_no != ''){
					$cycle = $cycle_no;
				}else{
					$cycle = '1';
				}
			}
		
			$createPayment = "INSERT INTO tk_payment_history 
			(ph_user_type, ph_user_id, ph_date, ph_job_id, ph_receipt, ph_amount, ph_rf, hour, tutor) 
			VALUES 
			('4', '".$thisParent."', '".$newdate."', '".$job."', '".$cycle."', '".$amount."', '".$rf."', '".$hours."', '".$tutor."') ";
			if ($conn->query($createPayment) === TRUE) {
				$last_id = $conn->insert_id;
			}
			$UpdateParentBilled = " UPDATE tk_job SET parent_billed = '' WHERE j_id='".$job."' ";
			$conn->query($UpdateParentBilled);
		}
	}

    $pad_length = 2;
    $pad_char = 0;

    $thisCycle = str_pad($cycle, $pad_length, $pad_char, STR_PAD_LEFT);
   
    $Sub     = array(
        //$_POST['actualEmail']
        $ActualEmail
        ,$emailDummy
    );

    $subject = 'Receipt ';
    $footer = 'bi';


			$message  = '
		Dear '.$qUserD.'<br/><br/>

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







		/* 
		  ##Device = Desktops
		  ##Screen = 1281px to higher resolution desktops
		*/
		@media (min-width: 1281px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Laptops, Desktops
		  ##Screen = B/w 1025px to 1280px
		*/
		@media (min-width: 1025px) and (max-width: 1280px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Tablets, Ipads (portrait)
		  ##Screen = B/w 768px to 1024px
		*/
		@media (min-width: 768px) and (max-width: 1024px) {
			.phoneContent {display:none;}
			.deskContent {display:block;}
		}

		/* 
		  ##Device = Tablets, Ipads (landscape)
		  ##Screen = B/w 768px to 1024px
		*/
		@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
		}

		/* 
		  ##Device = Low Resolution Tablets, Mobiles (Landscape)
		  ##Screen = B/w 481px to 767px
		*/
		@media (min-width: 481px) and (max-width: 767px) {
			.phoneContent {display:block;}
			.deskContent {display:none;}
		}

		/* 
		  ##Device = Most of the Smartphones Mobiles (Portrait)
		  ##Screen = B/w 320px to 479px
		*/
		@media (min-width: 320px) and (max-width: 480px) {
			.phoneContent {display:block;}
			.deskContent {display:none;}
		}






		</style>
		</head>
		<body style="max-width:600px">

		<div class="deskContent"> </div>
		<div class="phoneContent">
		</div>

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
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">R'.$job.''.$thisCycle.'</font></td>   
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
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$qUserD.'</font></td>   
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$date.'</font></td>
		  </tr>  
		  <tr>
			<td> <font style="font-family: century Gothic;color: #595959;font-weight: bold;">('.$qJobPhone.')</font></td>
			<td>&nbsp;</td>
		  </tr>
		  
		  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		 
		  <tr>
			<td> <font style="font-family: Times, serif;color: #272264;font-weight: bold;border-left: 3px solid #272264;">&nbsp;DESCRIPTION</font></td>
			<td align="right"><font style="font-family: Times, serif;color: #272264;font-weight: bold;border-right: 3px solid #272264;">AMOUNT &nbsp;</font></td>
		  </tr>
		  <tr>
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$tutor.' '.$hours.' hours of classes</font></td>
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$amount.'</font></td>
		  </tr>  
		';  

		if($checkbox != ''){
		$message  .= '  
		  <tr>
			<td><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$checkbox.'</font></td>
			<td align="right"><font style="font-family: century Gothic;color: #595959;font-weight: bold;">'.$rf.'</font></td>
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

		<table class="d">
		</table>

		<hr style="border: 2px solid #DDDDDD;">

		</body>
		</html>
				';
        
        $m       = $instNews->sendEmailTemplate('', $Sub, $subject, $message, $footer);
        
        
        if ($m) {
            echo 'Mail been sent successfully!';
        } else {
            echo 'Mail cannot be sent!';
        }
   
    
}
?>
