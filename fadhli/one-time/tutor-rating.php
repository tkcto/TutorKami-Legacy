<?php

require_once('../../admin/classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");



/*
$allotSql = " DELETE FROM tk_review_rating_internal ";
if ($conn->query($allotSql)){} else {}	


function getBetween($string, $start = "", $end = ""){
    if (strpos($string, $start)) { // required if $start not exist in $string
        $startCharCount = strpos($string, $start) + strlen($start);
        $firstSubStr = substr($string, $startCharCount, strlen($string));
        $endCharCount = strpos($firstSubStr, $end);
        if ($endCharCount == 0) {
            $endCharCount = strlen($firstSubStr);
        }
        return substr($firstSubStr, 0, $endCharCount);
    } else {
        return '';
    }
}

$queryTerms = " SELECT pmt_id, pmt_lastupdated, pmt_time FROM tk_page_manage_translation WHERE pmt_id='76' "; 
$resultTerms = $conn->query($queryTerms); 
if($resultTerms->num_rows > 0){
	$rowTerms = $resultTerms->fetch_assoc();
	$a = explode('/',$rowTerms['pmt_lastupdated']);
	$dateFormat2 = (int)($a[2].$a[1].$a[0]);
	$timeSaveTerms = $rowTerms['pmt_time'];
}

$User = " SELECT u_id, u_role, u_email, ud_tutor_experience_month, ud_tutor_experience, signature_img FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_role ='3' ORDER BY u_id ASC ";
$resultUser = $conn->query($User);
if ($resultUser->num_rows > 0) {
    while($rowUser = $resultUser->fetch_assoc()){
        
        //echo $rowUser["u_id"];   
        //echo '<br/>';
        
        // ########## START RUN JOB >= 5 ##########
        $Job = " SELECT j_hired_tutor_email FROM tk_job WHERE j_hired_tutor_email = '".$rowUser["u_email"]."' ";
        $resultJob = $conn->query($Job);
        if ($resultJob->num_rows >= '5') {
            //$rowJob = $resultJob->fetch_assoc();
            $Tutor_Job = 'true';
            $countJob = '1';
        }else{
            $Tutor_Job = 'false';
            $countJob = '';
        }
        // ########## END RUN JOB >= 5 ##########
        
        // ########## START RUN EXP ##########
        if ( $rowUser["ud_tutor_experience_month"] == 'year' ) {
            if( $rowUser["ud_tutor_experience"] >= '3' ){
                $Tutor_Exp = 'true';
                $countExp = ',2';
            }else{
                $Tutor_Exp = 'false';
                $countExp = '';
            }
        }else{
            $Tutor_Exp = 'false';
            $countExp = '';
        }
        // ########## END RUN EXP ##########  
        
        // ########## START RUN SIGNED ########## 
		if( $rowUser['signature_img'] != '' ){
			$getSig = $rowUser['signature_img'];
			$getSig = strtok($getSig, '_');
			$getSig = str_replace('-', '/', $getSig);
					
			$b = explode('/',$getSig);
			$dateFormat = (int)($b[2].$b[1].$b[0]);
						
			$getTime = getBetween($rowUser['signature_img'],"_","_");
			if(strlen($getTime) == '7'){
				$getTime = str_replace("-",":",substr($getTime, 0, -2)).':00';
			}else{
				$getTime = str_replace("-",":",$getTime).':00';
			}	
				if($dateFormat2 > $dateFormat){
					// yellow HERE
					$Tutor_Sign = 'false';
					$countSign = '';
				}else if($dateFormat2 < $dateFormat){
					//green
					$Tutor_Sign = 'true';
					$countSign = ',3';
				}else if($dateFormat2 = $dateFormat){
					if($timeSaveTerms >= $getTime){
						// yellow HERE
						$Tutor_Sign = 'false';
						$countSign = '';
					}else{
						//green
						$Tutor_Sign = 'true';
						$countSign = ',3';
					}
				}else{
					$Tutor_Sign = 'false';
					$countSign = '';
				}
		}else{
			$Tutor_Sign = 'false';
			$countSign = '';
		}
        // ########## END RUN SIGNED ##########  

        // ########## START RUN 1st session & make payment ##########
        $JobP = " SELECT j_hired_tutor_email, j_payment_status FROM tk_job WHERE j_hired_tutor_email = '".$rowUser["u_email"]."' AND j_payment_status = 'paid' ";
        $resultJobP = $conn->query($JobP);
        if ($resultJobP->num_rows > 0) {
            $Tutor_P = 'true';
			$countP = ',5';
        }else{
            $Tutor_P = 'false';
			$countP = '';
        }
        // ########## END RUN 1st session & make payment ##########
        if( $countJob != '' || $countExp != '' || $countSign != '' || $countP != '' ){
           // $plusComment = '('.$countJob.$countExp.$countSign.$countP.')';
            $plusComment = $countJob.$countExp.$countSign.$countP;
        }else{
            $plusComment = '-';
        }

        $plusComment = ltrim($plusComment, ',');
        
        
        $rateComments = date('d/m/Y').' -System Auto ('.$plusComment.')';
        
        //$allotSql = " INSERT INTO tk_review_rating_internal SET ri_tutor = '".$rowUser["u_id"]."', ri_jobs = '".$Tutor_Job."', ri_experience = '".$Tutor_Exp."', ri_signed = '".$Tutor_Sign."', ri_session = '".$Tutor_P."',ri_comments = '".$rateComments."'       ";
        //if ($conn->query($allotSql)){} else {}	
    }
}*/
?>