<?php
/*
************************************************
** Page Name     : job.class.php 
** Page Author   : Durga Charan Garai
** Created On    : 01/06/2017
************************************************
*/
require_once('db.class.php');
require_once('whatsapp-api-call.php');

class job extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}

/*Functions for  Job Level Management*/

    function SaveJobLevel($data){
  	 if($data['jl_id']=='') {
			
				
			if($this->db->query("INSERT INTO ".DB_PREFIX."_job_level(jl_status,jl_create_date,jl_country_id) VALUES('".$data['jl_status']."','".date('Y-m-d H:i:s')."','".$_SESSION[DB_PREFIX]['u_country_id']."')")) {

				$insert_id = $this->db->insert_id;

				foreach($data['jl-tl'] as $key=>$value){

                     $this->db->query("INSERT INTO ".DB_PREFIX."_job_level_translation(jlt_jl_id,jlt_lang_code,jlt_title,jlt_description) VALUES('".$insert_id."','".$key."','".$value."','".$data['jl-ds'][$key]."')");
				
				}
				Session::SetFlushMsg("success", 'Job Level Added Successfully.');
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.');
			}
		} else {
			
				$q = "UPDATE ".DB_PREFIX."_job_level SET jl_modified_date='".date('Y-m-d H:i:s')."',jl_status='".$data['jl_status']."' WHERE jl_id = '".$data['jl_id']."'";

				foreach($data['jl-tl'] as $key=>$value){
                  $this->db->query("UPDATE ".DB_PREFIX."_job_level_translation SET jlt_title = '".$value."',jlt_description='".$data['jl-ds'][$key]."' WHERE jlt_jl_id = '".$data['jl_id']."' AND jlt_lang_code='".$key."'");
                     
				
				} 
			    if($this->db->query($q)) {
				  Session::SetFlushMsg("success", 'Job Level Updated Successfully.');
			    } else {
				  Session::SetFlushMsg("error", 'Update Sql failed.');
			    }

			}
		
   }
   function FetchJobLevel(){
   	   $sql = "SELECT * FROM ".DB_PREFIX."_job_level";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE jl_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }
   	   return $this->db->query($sql);
   }
   function GetDefaultLanguageJobLevel($jlid){
   	  return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_level_translation WHERE jlt_jl_id = '".$jlid."'")->fetch_assoc();
   }
   function DeleteJobLevel($jlid){
   	  if($this->db->query("DELETE FROM ".DB_PREFIX."_job_level WHERE jl_id = '".$jlid."'")){

   	  	$this->db->query("DELETE FROM ".DB_PREFIX."_job_level_translation WHERE jlt_jl_id = '".$jlid."'");
  	 	Session::SetFlushMsg("success", 'Job Level Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.');
	 }
    }
    function GetJobLevel($jlid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_level WHERE jl_id = '".$jlid."'")->fetch_assoc();
    }
    function GetJobLevelTranslationByJobLevel($jlid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_level_translation WHERE jlt_jl_id = '".$jlid."'");
    }
    function FetchJobLevelByLanguage($lcode){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_level_translation WHERE jlt_lang_code='".$lcode."'");
    }

    /*Functions for  Job Management*/

    function SaveJob($data){
    	//$deadline = $data['j_deadline'] != '' ? $data['j_deadline'] : '0000-00-00';
    	/* START fadhli */
		$oldDateDeadline = $data['j_deadline'];
		$formatDeadline = explode('-', $oldDateDeadline);
		$deadline = $formatDeadline[2].'-'.$formatDeadline[1].'-'.$formatDeadline[0];
    	/* END fadhli */
    	
    	
    	//$start_date = $data['j_start_date'] != '' ? $data['j_start_date'] : '0000-00-00';
    	//$end_date = $data['j_end_date'] != '' ? $data['j_end_date'] : '0000-00-00';
    	
        if( $data['j_start_date'] != '' ){
        	if( $data['j_start_date'] == '00-00-0000' || $data['j_start_date'] == '00/00/0000' ){
        		$start_date = '';
        	}else{
        		$arrStartDate = explode('/', $data['j_start_date']);
        		$start_date = $arrStartDate[2].'-'.$arrStartDate[1].'-'.$arrStartDate[0];
        	}
        }else{
        	$start_date = '';
        }
    	
        if( $data['j_end_date'] != '' ){
        	if( $data['j_end_date'] == '00-00-0000' || $data['j_end_date'] == '00/00/0000' ){
        		$end_date = '';
        	}else{
        		$arrEndDate = explode('/', $data['j_end_date']);
        		$end_date = $arrEndDate[2].'-'.$arrEndDate[1].'-'.$arrEndDate[0];
        	}
        }else{
        	$end_date = '';
        }
    	
    	/* START fadhli */
		$oldDateFormat = $data['j_create_date'];
		$arrFormat = explode('/', $oldDateFormat);
		$createDate = $arrFormat[2].'-'.$arrFormat[1].'-'.$arrFormat[0].' '.date('H:i:s');
		$modifyDate = date('y-m-d H:i:s');
    	/* END fadhli */
    	

    	if( $data['j_rate'] != ''){
    	    /*$int = (int) filter_var($data['j_rate'], FILTER_SANITIZE_NUMBER_INT);
			if( $int != ''){
				$waRate = 'RM '.$int.'/jam';
			}else{
				$waRate = $data['j_rate'];
			}*/
			$waRate = $data['j_rate'];
    	}else{
    	    $waRate = '';
    	}

    	
    	if($data['j_id']=='') {
    	    
			$sqlCity = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '".$data['newCity']."' ";
			$resultCity = $this->db->query($sqlCity);
			if($resultCity->num_rows > 0){
			    $rowCity = mysqli_fetch_array($resultCity);
			    $thisCity = $rowCity['city_name'];
			}else{
			    $thisCity = '';
			}
    	    
			$sqlUser = "SELECT * FROM ".DB_PREFIX."_user WHERE u_email = '".$data['j_email']."' ";
			$resultUser = $this->db->query($sqlUser);
			if($resultUser->num_rows > 0){
			    $rowUser = mysqli_fetch_array($resultUser);
			    $thisUser = $rowUser['u_id'];
			    //$this->db->query("UPDATE ".DB_PREFIX."_user_details SET ud_last_name='".$data['actual_email']."' WHERE ud_u_id = '".$thisUser."' ");
			    if( $data['j_payment_status'] == 'paid' ){
			        $this->db->query("UPDATE ".DB_PREFIX."_user SET u_paying_client='P' WHERE u_id = '".$thisUser."' ");
			    }
			}else{
			    $thisUser = '';
			}
			
			$sqlGetJob = "SELECT * FROM ".DB_PREFIX."_job_level_translation WHERE jlt_lang_code = 'en' AND jlt_jl_id = '".$data['j_jl_id']."' ";
			$resultGetJob = $this->db->query($sqlGetJob);
			if($resultGetJob->num_rows > 0){
			    $rowGetJob = mysqli_fetch_array($resultGetJob);
			    $thisJobName = $rowGetJob['jlt_title'];

			}else{
			    $thisJobName = '';
			}

			if( $data['cycle'] == '' ){
			    $cycle = '6';
			}else{
			    $cycle = $data['cycle'];
			}
			
			if( $data['parent_rate'] == '' ){
			    if( $data['j_rate'] == '' ){
			        $parentRate = '';
			    }else{
					$int = (int) filter_var($data['j_rate'], FILTER_SANITIZE_NUMBER_INT);
					if( $int != ''){
						$parentRate = ($int + 15);
					}else{
						$parentRate = '0';
					}
			    }
			}else{
				$parentRate = $data['parent_rate'];
			}
			
			/* HERE */
			if( $data['j_hired_tutor_email'] != '' ){
			    
			    $rateComment = date('d/m/Y').' -System Updated Job (tick 1)';
				$sqlCekJobUser = "SELECT u_id, u_email FROM ".DB_PREFIX."_user WHERE u_email = '".$data['j_hired_tutor_email']."' ";
				$resultCekJobUser = $this->db->query($sqlCekJobUser);
				if($resultCekJobUser->num_rows > 0){
					$rowCekJobUser = mysqli_fetch_array($resultCekJobUser);
    		    
    			    $sqlCekJobTwo = "SELECT j_hired_tutor_email FROM ".DB_PREFIX."_job WHERE j_hired_tutor_email = '".$data['j_hired_tutor_email']."' ";
    			    $resultCekJobTwo = $this->db->query($sqlCekJobTwo);		
    			    if( $resultCekJobTwo->num_rows >= '4' ){
    			        $sqlInternalRating = "SELECT ri_tutor, ri_jobs, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
    			        $resultInternalRating = $this->db->query($sqlInternalRating);
    			        if($resultInternalRating->num_rows > 0){
    			            $rowInternalRating = mysqli_fetch_array($resultInternalRating);
    			            $newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
    			            
    			            if( $rowInternalRating['ri_jobs'] != 'true' ){
        			            $allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        			            if ($this->db->query($allotSql)){} else {}    			                
    			            }

    			        }else{
    			            $allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_jobs = 'true', ri_comments = '".$rateComment."' ";
    			            if ($this->db->query($allotSql)){} else {}						
    			        }
    			    }
				}
			    
			}
			
			$sq = "INSERT INTO ".DB_PREFIX."_job(j_jl_id,j_rate,j_area,j_state_id,state,city,j_email,j_telephone,j_preferred_date_time,j_commission,j_duration,j_deadline,j_hired_tutor_email,j_start_date,j_end_date,j_payment_status,j_creator_email,j_status,j_create_date,j_country_id,actual_email,parent_rate,student_name,cycle,u_id,j_check_rate,j_check_timeday,rf) VALUES('".$data['j_jl_id']."','".$data['j_rate']."','".$data['j_area']."','".$data['j_state_id']."','".$data['j_state_id']."','".$data['newCity']."','".$data['j_email']."','".$data['j_telephone']."','".$data['j_preferred_date_time']."','".$data['j_commission']."','".$data['j_duration']."','".$deadline."','".$data['j_hired_tutor_email']."','".$start_date."','".$end_date."','".$data['j_payment_status']."','".$data['j_creator_email']."','".$data['j_status']."','".$createDate."','".$_SESSION[DB_PREFIX]['u_country_id']."','".$data['actual_email']."','".$parentRate."','".$data['student_name']."','".$cycle."','".$thisUser."','".$data['j_check_rate']."','".$data['j_check_timeday']."','".$data['rf']."')";


			if($this->db->query($sq)) {

				$insert_id = $this->db->insert_id;

				foreach($data['jt_subject'] as $key=>$value){

                     $this->db->query("INSERT INTO ".DB_PREFIX."_job_translation(jt_j_id,jt_lang_code,jt_subject,jt_lessons,jt_remarks,jt_comments) VALUES('".$insert_id."','".$key."','".$value."','".$data['jt_lessons'][$key]."','".$data['jt_remarks'][$key]."','".$data['jt_comments'][$key]."')");
				
				}
				
/***** Auto Send WhatsApp ****/
$website = "https://wa.tutorkami.my/api-docs/";
if( !activeAPI( $website ) ) {
} else {
	//functions correctly
    if ( hasWord('ONLINE', $value) ) {
            //echo 'ada';
        $loopPhone = array('60122309743-1543553367@g.us','60196412395-1614695624@g.us','60172327809-1600591965@g.us');
        foreach ($loopPhone as $fn) {
            //echo $fn.'<br>';
            $args = new stdClass();
            $xdata = new stdClass();
            $args->to = $fn;
            //$args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
            $args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." & ".ucwords($thisJobName)."\r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
            $xdata->args = $args;
            
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );  
        }
            
    } else {
        //echo 'tak';
        /* Selangor & KL */
        if( $data['j_state_id'] == '1046' || $data['j_state_id'] == '1658' || $data['j_state_id'] == '1661' ){
            /*$args = new stdClass();
            $xdata = new stdClass();
            $args->to = "60122309743-1543553367@g.us";
            $args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
            $xdata->args = $args;
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata ); */
            
            $loopPhone = array('60122309743-1543553367@g.us','60196412395-1614695624@g.us');
            foreach ($loopPhone as $fn) {
                $args = new stdClass();
                $xdata = new stdClass();
                $args->to = $fn;
                $args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                $xdata->args = $args;
                $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
            }
        }
        
        /* N.Sembian */
        if( $data['j_state_id'] == '1040' ){
            /*
            $args = new stdClass();
            $xdata = new stdClass();
            $args->to = "60172327809-1600591965@g.us";
            $args->content = "*Job ".$insert_id." :* \r\n".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". \r\n".$waRate."\r\nPlease click link to apply\r\nhttps://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']."\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
            $xdata->args = $args;
            
            $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );   
            */
                        $mesej2 = "*Job ".$insert_id." :* newLine".ucwords($value)." in ".ucwords($data['j_area']).", ".ucwords($thisCity).". newLine".$waRate." newLine Please click link to apply newLine https://www.tutorkami.com/job_details?jid=".$insert_id."&status=".$data['j_status']." newLine newLine (This is an auto message from TutorKami.com. Please do not reply to this number) ";
                        $mesej = str_replace('newLine','\n',$mesej2);
                        
                        
                        $curl = curl_init();
                        
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => 'https://api.wsapme.com/v1/sendMessage',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          
                          CURLOPT_POSTFIELDS =>'{
                                "device" : "237",
                                "to": "60172327809-1600591965@g.us",
                                "message": "'.$mesej.'"
                        }',
                        
                          CURLOPT_HTTPHEADER => array(
                            'x-wsapme-token: 238ce7ee762d4e14f48e4d53e546b316',
                            'Content-Type: application/json'
                          ),
                        ));
                        
                        $response = curl_exec($curl);
                        
                        curl_close($curl);
                        $response2 = json_decode($response, true);
                        $data     = $response2['message'];
            
            
        }        
            
    }	
}
/***** Auto Send WhatsApp ****/

				Session::SetFlushMsg("success", 'Job  Added Successfully.');
				return $insert_id;
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.'.$this->db->error);
				return false;
			}
		} else {
//sini

        			$sqlUser = "SELECT * FROM ".DB_PREFIX."_user WHERE u_email = '".$data['j_email']."' ";
        			$resultUser = $this->db->query($sqlUser);
        			if($resultUser->num_rows > 0){
        			    $rowUser = mysqli_fetch_array($resultUser);
        			    $thisUser = $rowUser['u_id'];
        			    if($data['actual_email'] != ''){
        			        $this->db->query("UPDATE ".DB_PREFIX."_user_details SET ud_last_name='".$data['actual_email']."' WHERE ud_u_id = '".$thisUser."' ");
        			    }
        			    if( $data['j_payment_status'] == 'paid' ){
        			        $this->db->query("UPDATE ".DB_PREFIX."_user SET u_paying_client='P' WHERE u_id = '".$thisUser."' ");
        			    }
        			}
        			
        
        			/* HERE - RATING FUNCTION */
        
        			if( $data['j_hired_tutor_email'] != '' ){
        				
        				$sqlCekJobUser = "SELECT u_id, u_email FROM ".DB_PREFIX."_user WHERE u_email = '".$data['j_hired_tutor_email']."' ";
        				$resultCekJobUser = $this->db->query($sqlCekJobUser);
        				if($resultCekJobUser->num_rows > 0){
        					$rowCekJobUser = mysqli_fetch_array($resultCekJobUser);
        						
        					$rateComment = date('d/m/Y').' -System Updated Job (tick 1)';
        					$rateComment2 = date('d/m/Y').' -System Updated Job (untick 1)';
        					$sqlCekJob = "SELECT j_id, j_hired_tutor_email FROM ".DB_PREFIX."_job WHERE j_id = '".$data['j_id']."' ";
        					$resultCekJob = $this->db->query($sqlCekJob);
        					if($resultCekJob->num_rows > 0){
        						$rowCekJob = mysqli_fetch_array($resultCekJob);
        						
        						
        						if( $rowCekJob['j_hired_tutor_email'] == '' ){
        							$sqlCekJobTwo = "SELECT j_hired_tutor_email FROM ".DB_PREFIX."_job WHERE j_hired_tutor_email = '".$data['j_hired_tutor_email']."' ";
        							$resultCekJobTwo = $this->db->query($sqlCekJobTwo);		
        							if( $resultCekJobTwo->num_rows >= '4' ){
        									$sqlInternalRating = "SELECT ri_tutor, ri_jobs, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        									$resultInternalRating = $this->db->query($sqlInternalRating);
        									if($resultInternalRating->num_rows > 0){
        										$rowInternalRating = mysqli_fetch_array($resultInternalRating);
        										$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
        										
        										if( $rowInternalRating['ri_jobs'] != 'true' ){
            										$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
            										if ($this->db->query($allotSql)){} else {}										    
        										}
        										
        									}else{
        										$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_jobs = 'true', ri_comments = '".$rateComment."' ";
        										if ($this->db->query($allotSql)){} else {}						
        									}
        							}else{
        									/*$sqlInternalRating = "SELECT ri_tutor, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        									$resultInternalRating = $this->db->query($sqlInternalRating);
        									if($resultInternalRating->num_rows > 0){
        										$rowInternalRating = mysqli_fetch_array($resultInternalRating);
        										$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
        										$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        										if ($this->db->query($allotSql)){} else {}
        									}else{
        										$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_jobs = 'false', ri_comments = '".$rateComment."' ";
        										if ($this->db->query($allotSql)){} else {}						
        									}*/
        							}
        						}else{
        						    
        							if( $rowCekJob['j_hired_tutor_email'] != $data['j_hired_tutor_email'] ){
        								// ---------------- //
        								$sqlCekJobTwo = "SELECT j_hired_tutor_email FROM ".DB_PREFIX."_job WHERE j_hired_tutor_email = '".$data['j_hired_tutor_email']."' ";
        								$resultCekJobTwo = $this->db->query($sqlCekJobTwo);				
        								if( $resultCekJobTwo->num_rows >= '4' ){
        										$sqlInternalRating = "SELECT ri_tutor, ri_jobs, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        										$resultInternalRating = $this->db->query($sqlInternalRating);
        										if($resultInternalRating->num_rows > 0){
        											$rowInternalRating = mysqli_fetch_array($resultInternalRating);
        											$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
        											
        											if( $rowInternalRating['ri_jobs'] != 'true' ){
            											$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
            											if ($this->db->query($allotSql)){} else {}												    
        											}
        
        										}else{
        											$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_jobs = 'true', ri_comments = '".$rateComment."' ";
        											if ($this->db->query($allotSql)){} else {}						
        										}
        								}else{
        										/*$sqlInternalRating = "SELECT ri_tutor, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        										$resultInternalRating = $this->db->query($sqlInternalRating);
        										if($resultInternalRating->num_rows > 0){
        											$rowInternalRating = mysqli_fetch_array($resultInternalRating);
        											$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
        											$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
        											if ($this->db->query($allotSql)){} else {}
        										}else{
        											$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_jobs = 'false', ri_comments = '".$rateComment."' ";
        											if ($this->db->query($allotSql)){} else {}						
        										}*/
        								}
        								// ---------------- //
        
        								$sqlCekJobUser2 = "SELECT u_id, u_email FROM ".DB_PREFIX."_user WHERE u_email = '".$rowCekJob['j_hired_tutor_email']."' ";
        								$resultCekJobUser2 = $this->db->query($sqlCekJobUser2);
        								if($resultCekJobUser2->num_rows > 0){
        									$rowCekJobUser2 = mysqli_fetch_array($resultCekJobUser2);
        									
        										$sqlCekJobTwo2 = "SELECT j_id, j_hired_tutor_email FROM ".DB_PREFIX."_job WHERE j_hired_tutor_email = '".$rowCekJob['j_hired_tutor_email']."' AND j_id != '".$data['j_id']."' ";
        										$resultCekJobTwo2 = $this->db->query($sqlCekJobTwo2);
        										if( $resultCekJobTwo2->num_rows >= '5' ){
        												$sqlInternalRating2 = "SELECT ri_tutor, ri_jobs, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser2['u_id']."' ";
        												$resultInternalRating2 = $this->db->query($sqlInternalRating2);
        												if($resultInternalRating2->num_rows > 0){
        													$rowInternalRating2 = mysqli_fetch_array($resultInternalRating2);
        													$newComment2 = $rateComment.'\n'.$rowInternalRating2['ri_comments'];
        													
        													if( $rowInternalRating2['ri_jobs'] != 'true' ){
            													$allotSql2 = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'true', ri_comments = '".$newComment2."' WHERE ri_tutor = '".$rowCekJobUser2['u_id']."' ";
            													if ($this->db->query($allotSql2)){} else {}													    
        													}
        
        												}else{
        													$allotSql2 = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser2['u_id']."', ri_jobs = 'true', ri_comments = '".$rateComment."' ";
        													if ($this->db->query($allotSql2)){} else {}						
        												}
        										}else{
        												$sqlInternalRating2 = "SELECT ri_tutor, ri_jobs, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser2['u_id']."' ";
        												$resultInternalRating2 = $this->db->query($sqlInternalRating2);
        												if($resultInternalRating2->num_rows > 0){
        													$rowInternalRating2 = mysqli_fetch_array($resultInternalRating2);
        													$newComment2 = $rateComment2.'\n'.$rowInternalRating2['ri_comments'];
        													
        													if( $rowInternalRating2['ri_jobs'] != 'false' ){
            													$allotSql2 = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_jobs = 'false', ri_comments = '".$newComment2."' WHERE ri_tutor = '".$rowCekJobUser2['u_id']."' ";
            													if ($this->db->query($allotSql2)){} else {}													    
        													}
        
        												}else{
        													$allotSql2 = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser2['u_id']."', ri_jobs = 'false', ri_comments = '".$rateComment2."' ";
        													if ($this->db->query($allotSql2)){} else {}						
        												}
        										}								
        								}
        								
        							}
        						}
        					}
        					
        					$ratePayComment = date('d/m/Y').' -System Updated Payment (tick 5)';	
        					$ratePayComment2 = date('d/m/Y').' -System Updated Payment (untick 5)';	
        					if( $data['j_status'] == 'closed' && $data['j_payment_status'] == 'paid' ){
        
            					/*$sqlCekJobP = "SELECT j_id, j_hired_tutor_email, j_payment_status FROM ".DB_PREFIX."_job WHERE j_id = '".$data['j_id']."' ";
            					$resultCekJobP = $this->db->query($sqlCekJobP);
            					if($resultCekJobP->num_rows > 0){
            						$rowCekJobP = mysqli_fetch_array($resultCekJobP);
        							if( $rowCekJobP['j_payment_status'] != $data['j_payment_status'] ){ */
                    						$sqlInternalRating2 = "SELECT ri_tutor, ri_session, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
                    						$resultInternalRating2 = $this->db->query($sqlInternalRating2);
                    						if($resultInternalRating2->num_rows > 0){
                    							$rowInternalRating2 = mysqli_fetch_array($resultInternalRating2);
                    							$newPayComment2 = $ratePayComment.'\n'.$rowInternalRating2['ri_comments'];
                    							
                    							if( $rowInternalRating2['ri_session'] != 'true' ){
                        							$allotSql2 = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_session = 'true', ri_comments = '".$newPayComment2."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
                        							if ($this->db->query($allotSql2)){} else {}            							    
                    							}
                    							
                    						}else{
                    							$allotSql2 = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_session = 'true', ri_comments = '".$ratePayComment."' ";
                    							if ($this->db->query($allotSql2)){} else {}						
                    						}
        							/*}
        						}*/
        
        					}else{
        						
            					/*$sqlCekJobP = "SELECT j_id, j_hired_tutor_email, j_payment_status FROM ".DB_PREFIX."_job WHERE j_id = '".$data['j_id']."' ";
            					$resultCekJobP = $this->db->query($sqlCekJobP);
            					if($resultCekJobP->num_rows > 0){
            						$rowCekJobP = mysqli_fetch_array($resultCekJobP);
        							if( $rowCekJobP['j_payment_status'] != $data['j_payment_status'] ){
                    						$sqlInternalRating2 = "SELECT ri_tutor, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
                    						$resultInternalRating2 = $this->db->query($sqlInternalRating2);
                    						if($resultInternalRating2->num_rows > 0){
                    							$rowInternalRating2 = mysqli_fetch_array($resultInternalRating2);
                    							$newPayComment2 = $ratePayComment.'\n'.$rowInternalRating2['ri_comments'];
                    							$allotSql2 = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_session = 'false', ri_comments = '".$newPayComment2."' WHERE ri_tutor = '".$rowCekJobUser['u_id']."' ";
                    							if ($this->db->query($allotSql2)){} else {}
                    						}else{
                    							$allotSql2 = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '".$rowCekJobUser['u_id']."', ri_session = 'false', ri_comments = '".$ratePayComment."' ";
                    							if ($this->db->query($allotSql2)){} else {}						
                    						}
        							}
        						}*/
        						
        					}
        					
        				$this->db->query(" UPDATE ".DB_PREFIX."_job SET u_id_tutor = '".$rowCekJobUser['u_id']."' WHERE j_id = '".$data['j_id']."' ");	
        				}
        				
        			}
        
        			/* HERE - RATING FUNCTION */

                    $sqlJHired = "SELECT j_id, j_hired_tutor_email, cycle, j_post_time, j_post_date FROM ".DB_PREFIX."_job WHERE j_id = '".$data['j_id']."' ";
                    $resultJHired = $this->db->query($sqlJHired);
                    if( $resultJHired->num_rows > 0 ){
                        $rowJHired = mysqli_fetch_array($resultJHired);
                        
                            if( $rowJHired['j_hired_tutor_email'] == '' || $rowJHired['j_hired_tutor_email'] == NULL ){
                                if( $data['j_hired_tutor_email'] != '' ){
                                    $_SESSION['JHired'] = 'RUN';
                                }
                            
                            }
                            
                            //check perubahan cycle
                            
                            if( $rowJHired['cycle'] != $data['cycle'] ){
                                
                                function hoursToMinutes($hours) { 
                                    $minutes = 0; 
                                    if (strpos($hours, '.') !== false) { 
                                        // Split hours and minutes. 
                                        list($hours, $minutes) = explode('.', $hours); 
                                    } 
                                    return $hours * 60 + $minutes; 
                                } 
                                
                            	function convertToHoursMins($time, $format = '%02d.%02d') {
                            		if ($time < 1) {
                            			return;
                            		}
                            		$hours = floor($time / 60);
                            		$minutes = ($time % 60);
                            		return sprintf($format, $hours, $minutes);
                            	}
                                
                                $OnGoingKelas = " SELECT cl_id, cr_cl_id, cl_display_id, current_cycle, cr_date, cr_start_time, cr_status, row_no FROM ".DB_PREFIX."_classes_record
                                                  INNER JOIN ".DB_PREFIX."_classes ON cl_id = cr_cl_id
                                                  WHERE cl_display_id = '".$data['j_id']."' AND current_cycle NOT LIKE '%temp%' ORDER BY cr_date DESC, cr_start_time DESC ";
                                $reOnGoingKelas = $this->db->query($OnGoingKelas);
                                if( $reOnGoingKelas->num_rows > 0 ){
                                    $roOnGoingKelas = mysqli_fetch_array($reOnGoingKelas);
                                    
                                    if( $roOnGoingKelas['cr_status'] != 'Required Parent To Pay' ){
                                        if( $data['j_id'] == '6996' ){
                                            
                                            $FirstRecord = 1;
                                            $currBal = '';
                                            $oldBal = '';
                                            $status = '';
                                            
                                            $CurrOnGoingKelas = " SELECT * FROM ".DB_PREFIX."_classes_record WHERE cr_cl_id = '".$roOnGoingKelas['cr_cl_id']."' AND row_no = '".$roOnGoingKelas['row_no']."' ORDER BY cr_date ASC, cr_start_time ASC ";
                                            $reCurrOnGoingKelas = $this->db->query($CurrOnGoingKelas);
                                            if( $reCurrOnGoingKelas->num_rows > 0 ){
                                                while($roCurrOnGoingKelas = mysqli_fetch_array($reCurrOnGoingKelas)){
                                                    
                                                    if( $FirstRecord == 1){
                                                        $currHour = (hoursToMinutes($data['cycle']));
                                        				$mystring = str_replace(" hours & ",".",$roCurrOnGoingKelas['cr_duration']);
                                        				$mystring = str_replace(" minutes","",$mystring);
                                        				$currMinutes = (hoursToMinutes($mystring));
                                        				
                                        				$totalMinutes = $currHour - $currMinutes;
                                                        if ($totalMinutes <= 0){
                                                            if( $totalMinutes == 0){
                                                                $currBal = '0.00';
                                                                $status = 'FM to pay tutor';     
                                                            }else{
                                                                $currBal = str_replace("-","",$totalMinutes);
                                                                $currBal = '-'.convertToHoursMins($currBal);
                                                                $status = 'FM to pay tutor';                                                            
                                                            }
    
                                                        }else{
                                                            $currBal = convertToHoursMins($currHour - $currMinutes);
                                                            $status = 'new';
                                                            if( $roCurrOnGoingKelas['cr_status'] == 'new Cycle' ){
                                                                $status = 'new Cycle';
                                                            }
                                                        }
                                                        $showHour = $data['cycle'];
                                                    }else{
                                                        $currHour = (hoursToMinutes($oldBal));
                                        				$mystring = str_replace(" hours & ",".",$roCurrOnGoingKelas['cr_duration']);
                                        				$mystring = str_replace(" minutes","",$mystring);
                                        				$currMinutes = (hoursToMinutes($mystring));
                                        				
                                        				$totalMinutes = $currHour - $currMinutes;
                                                        if ($totalMinutes <= 0){
                                                            if( $totalMinutes == 0){
                                                                $currBal = '0.00';
                                                                $status = 'FM to pay tutor';  
                                                            }else{
                                                                $currBal = str_replace("-","",$totalMinutes);
                                                                $currBal = '-'.convertToHoursMins($currBal);
                                                                $status = 'FM to pay tutor';                                                            
                                                            }
                                                        }else{
                                                            $currBal = convertToHoursMins($currHour - $currMinutes);
                                                            $status = 'new';
                                                        }
                                                        if($oldBal != '' && $oldBal < 0){
                                                            $status = 'Required Parent To Pay';
                                                        }
                                                        $showHour = $oldBal;
                                                    }
                                                    
                                                    //$Output = $showHour.' | '.$currBal.' | '.$status;
                                                    //$UpdateCurrOnGoingKelas = " UPDATE ".DB_PREFIX."_classes_record SET cr_parent_verification ='".$Output."' WHERE cr_id = '".$roCurrOnGoingKelas['cr_id']."' "; 
                                                    
                                                    $UpdateCurrOnGoingKelas = " UPDATE ".DB_PREFIX."_classes_record SET cr_cycle ='".$showHour."', cr_balance ='".$currBal."', cr_status ='".$status."' WHERE cr_id = '".$roCurrOnGoingKelas['cr_id']."' "; 
                                                    $this->db->query($UpdateCurrOnGoingKelas);
                                                    
                                                    $UpdateCurrOnGoingKelas2 = " UPDATE ".DB_PREFIX."_classes SET cl_hours_balance ='".$currBal."', cl_cycle ='".$data['cycle']."' WHERE cl_id = '".$roCurrOnGoingKelas['cr_cl_id']."' "; 
                                                    $this->db->query($UpdateCurrOnGoingKelas2);
                                                    
                                                $FirstRecord++;
                                                $oldBal = $currBal;
                                                }
                                            }                                        
                                        }                                      
                                    }

                                    
                                }
                                
                            } 
                            
                        $postTime = $rowJHired['j_post_time'];
                        $postDate = $rowJHired['j_post_date'];

                    }
                    

                    if( $data['sendWA'] != '' ){
                        if( $data['setupTime'] != '' ){
                            $postTime = $data['setupTimeInput'];
                            $postDate = '';
                        }
                        else if( $data['setupDate'] != '' ){
                            $postTime = $data['setupTimeInput'];
                            $postDate = $data['setupDateInput'];
                        }else{
                            $postTime = '';
                            $postDate = '';
                        }
                        
                    }

        			$q = "UPDATE ".DB_PREFIX."_job SET j_jl_id='".$data['j_jl_id']."',j_rate='".$data['j_rate']."',j_area='".$data['j_area']."',j_state_id='".$data['j_state_id']."',state='".$data['j_state_id']."',city='".$data['newCity']."',j_email='".$data['j_email']."',j_telephone='".$data['j_telephone']."',j_telephone_alt='".$data['j_telephone_alt']."',j_preferred_date_time='".$data['j_preferred_date_time']."',j_commission='".$data['j_commission']."',j_duration='".$data['j_duration']."',j_deadline='".$deadline."',j_hired_tutor_email='".$data['j_hired_tutor_email']."',j_start_date='".$start_date."',j_end_date='".$end_date."',j_payment_status='".$data['j_payment_status']."',j_creator_email='".$data['j_creator_email']."', j_create_date='".$createDate."', j_modified_date='".$modifyDate."',j_status='".$data['j_status']."', actual_email='".$data['actual_email']."', parent_rate='".$data['parent_rate']."', student_name='".$data['student_name']."', cycle='".$data['cycle']."', j_check_rate='".$data['j_check_rate']."', j_check_timeday='".$data['j_check_timeday']."', j_rating='".$data['changeRating']."', parent_billed='".$data['billed']."', rf='".$data['rf']."', j_post_time='".$postTime."', j_post_date='".$postDate."' WHERE j_id = '".$data['j_id']."'"; 
        					
        					
        			foreach($data['jt_subject'] as $key=>$value){
                      $this->db->query("UPDATE ".DB_PREFIX."_job_translation SET jt_subject = '".$value."',jt_lessons='".$data['jt_lessons'][$key]."',jt_remarks='".$data['jt_remarks'][$key]."',jt_comments='".$data['jt_comments'][$key]."' WHERE jt_j_id = '".$data['j_id']."' AND jt_lang_code='".$key."'");
        			}
        
        			if( $data['j_deadline'] == '' ){
        				//$this->db->query("DELETE FROM ".DB_PREFIX."_send_wa WHERE wa_job_id = '".$data['j_id']."' ");
        			}
        			
        		    if($this->db->query($q)) {
        			  //Session::SetFlushMsg("success", 'Job Updated Successfully.');
        			  //return $data['j_id'];
					  
					  
if( $data['j_status'] == 'closed' && $data['j_payment_status'] == 'paid' && $data['j_deadline'] != '' && $data['j_deadline'] != '0000-00-00' && $data['actual_email'] == '' ){
	Session::SetFlushMsg("error", 'Parent Email  Required');
	return $data['j_id'];
}else{
	Session::SetFlushMsg("success", 'Job Updated Successfully.');
	return $data['j_id'];	
}
					  
					  
        		    } else {
        			  Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
        			  return false;
        		    }
                
            
            
            

		}
    }

    function GetJob($jid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_job WHERE j_id = '".$jid."'")->fetch_assoc();
    }

    function GetJobTranslationByJob($jid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_translation WHERE jt_j_id = '".$jid."'");
    }

    function GetDefaultLanguageJob($jid){
   	  return $this->db->query("SELECT * FROM ".DB_PREFIX."_job_translation WHERE jt_j_id = '".$jid."'")->fetch_assoc();
    }
    function FetchJob(){
   	   $sql = "SELECT * FROM ".DB_PREFIX."_job";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE j_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }
   	   return $this->db->query($sql);
   	   
    }
    function FetchJobEmail(){
   	   $sql = "SELECT DISTINCT j_creator_email as email FROM ".DB_PREFIX."_job WHERE j_creator_email <> ''";
   	   
   	   return $this->db->query($sql);
   	   
    }
    function DeleteJob($jid){
   	  if($this->db->query("DELETE FROM ".DB_PREFIX."_job WHERE j_id = '".$jid."'")){

   	  	$this->db->query("DELETE FROM ".DB_PREFIX."_job_translation WHERE jt_j_id = '".$jid."'");
  	 	Session::SetFlushMsg("success", 'Job Deleted Successfully.');
  	  }
  	  else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.');
	  }
    }
    function SearchJob($data){
    	 $query = "SELECT * FROM ".DB_PREFIX."_job ";
	 if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $query .= " WHERE j_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   } else {
   	   	$query .= "where 1=1";
   	   }
      if(!empty($data['j_email'])){
		  $cmail = $data['j_email'];
		  $query .= " and j_email = '$cmail'" ;
	  }
	  if (!empty($data['j_rate'])){ 
	  	  $rate = $data['j_rate'];
	      $query .= " and j_rate = '$rate'";
	  }
	  if (!empty($data['j_hired_tutor_email'])){ 
	      $tmail = $data['j_hired_tutor_email'];
	      $query .= " and j_hired_tutor_email = '$tmail'" ;
	  }
	  if (!empty($data['j_telephone'])){ 
	      $phone = $data['j_telephone'];
	      $query .= " and j_telephone = '$phone'";
	  }
	  if (!empty($data['j_date'])){ 
	      $date = $data['j_date'];
	      $query .= " and j_create_date = '$date'";
	  }
	  if (!empty($data['j_jl_id'])){ 
	      $lvl = $data['j_jl_id'];
	      $query .= " and j_jl_id = '$lvl'";
	  }
	  if (!empty($data['j_state_id'])){ 
	      $state = $data['j_state_id'];
	      $query .= " and j_state_id = '$state'";
	  }
	  if (!empty($data['j_status'])){ 
	      $status = $data['j_status'];
	      $query .= " and j_status = '$status'";
	  }
	  if (!empty($data['j_payment_status'])){ 
	      $pstatus = $data['j_payment_status'];
	      $query .= " and j_payment_status = '$pstatus'";
	  }
	  if (!empty($data['j_deadline'])){ 
	      $dline = $data['j_deadline'];
	      $query .= " and j_deadline = '$dline'";
	  }
	  if (!empty($data['j_start_date'])){ 
	      $sdate = $data['j_start_date'];
	      $query .= " and j_start_date = '$sdate'";
	  }
	  if (!empty($data['j_end_date'])){ 
	      $edate = $data['j_end_date'];
	      $query .= " and j_end_date = '$edate'";
	  }
	  if (!empty($data['j_creator_email'])){ 
	      $creator_email = $data['j_creator_email'];
	      $query .= " and j_creator_email = '$creator_email'";
	  }
      return $this->db->query($query);
      //return $query;
    }

    /* SUBHADEEP */
    public function AppliedJobs($aj_id = NULL) {
    	$sql = "SELECT * FROM ".DB_PREFIX."_applied_job AS AJ 
    	INNER JOIN ".DB_PREFIX."_job AS J ON J.j_id = AJ.aj_j_id 
    	INNER JOIN ".DB_PREFIX."_job_translation AS JL ON JL.jt_j_id = J.j_id 
		INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = AJ.aj_u_id 
    	WHERE JL.jt_lang_code = 'en'";

    	if($_SESSION[DB_PREFIX]['r_id']!=1){
			//$sql .= " AND J.j_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	    }
    	if($aj_id != ''){
			$sql .= " AND AJ.aj_id = '".$aj_id."'";
   	    }

   	    return $this->db->query($sql);
    }

    public function JobWiseAppliedJobs($j_id = NULL) {
    	$sql = "SELECT * FROM ".DB_PREFIX."_applied_job AS AJ 
    	INNER JOIN ".DB_PREFIX."_job AS J ON J.j_id = AJ.aj_j_id 
    	INNER JOIN ".DB_PREFIX."_job_translation AS JL ON JL.jt_j_id = J.j_id 
		INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = AJ.aj_u_id 
    	WHERE JL.jt_lang_code = 'en'";

    	if($_SESSION[DB_PREFIX]['r_id']!=1){
			//$sql .= " AND J.j_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	    }
    	if($j_id != ''){
			$sql .= " AND AJ.aj_j_id = '".$j_id."'";
   	    }

   	    return $this->db->query($sql);
    }

    public function SaveAppliedJob($data) {
    	$sql = "UPDATE ".DB_PREFIX."_applied_job SET aj_status = '".$data['aj_status']."' WHERE aj_id = '".$data['aj_id']."'";
        return $this->db->query($sql);
    }
}	

 