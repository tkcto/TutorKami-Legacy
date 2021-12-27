<?php
/*
************************************************
** Page Name     : APIUser.php 
** Page Author   : Subhadeep Chowdhury
** Created On    : 06/06/2017
************************************************
*/
require_once('../admin/classes/db.class.php');
require_once('../admin/classes/whatsapp-api-call.php');
require_once('../admin/generate-token.php');

include_once('../api/phpmailer/class.phpmailer.php');
 require_once('../api/phpmailer/class.smtp.php');
class APIUser extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
		$this->handler = new RestHandler();
	}
	
	public function ParentSignUp($data) {
		
        $username 			= isset($data['u_username']) 		? $this->RealEscape($data['u_username']) : '';
        $email    			= isset($data['u_email']) 			? $this->RealEscape($data['u_email']) : '';
        $gender   			= isset($data['u_gender']) 			? $this->RealEscape($data['u_gender']) : '';
        $password 			= isset($data['u_password']) 		? $this->RealEscape($data['u_password']) : '';
        $con_password 		= isset($data['con_password']) 		? $this->RealEscape($data['con_password']) : '';
        $displayname 		= isset($data['u_displayname']) 	? $this->RealEscape($data['u_displayname']) : '';
        $profile_pic 		= isset($data['u_profile_pic']) 	? $this->RealEscape($data['u_profile_pic']) : '';
        $firstname 			= isset($data['ud_first_name']) 	? $this->RealEscape($data['ud_first_name']) : '';
        $lastname 			= isset($data['ud_last_name']) 		? $this->RealEscape($data['ud_last_name']) : '';
        $phonenum 			= isset($data['ud_phone_number']) 	? $this->RealEscape($data['ud_phone_number']) : '';
        $address  			= isset($data['ud_address']) 		? $this->RealEscape($data['ud_address']) : ''; 
        $ud_dob   			= isset($data['ud_dob']) 			? $this->RealEscape($data['ud_dob']) : '';
		$role				= 4; // Tutor
		$displayid 			= $this->handler->getRandStr(7);

        // Validation
        if ($username == '') {
        	$res = array('flag' => 'error', 'message' => 'Username is required.');
        } elseif($password == '') {
        	$res = array('flag' => 'error', 'message' => 'Password is required.');
        } elseif($password != $con_password) {
        	$res = array('flag' => 'error', 'message' => 'Confirm Password mismatch.');
        } elseif($firstname == '') {
        	$res = array('flag' => 'error', 'message' => 'First name is required.');
        } elseif($lastname == '') {
        	$res = array('flag' => 'error', 'message' => 'Last name is required.');
        } elseif($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
        } elseif($displayname == '') {
        	$res = array('flag' => 'error', 'message' => 'Display name is required.');
        } elseif($phonenum == '') {
        	$res = array('flag' => 'error', 'message' => 'Phone number is required.');
        } elseif($gender == '') {
        	$res = array('flag' => 'error', 'message' => 'Gender is required.');
        } elseif($address == '') {
        	$res = array('flag' => 'error', 'message' => 'Location is required.');
        } else {
        	// Check for Duplicate
	        $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 
	        u_status <> 'D' AND (
	            u_email = '{$email}' || 
	            u_username = '{$email}' || 
	            u_email = '{$username}' || 
	            u_username = '{$username}'
	        )";

	        $qry = $this->db->query($sql);

	        if ($qry->num_rows == 0) {
	            $sqli = "INSERT INTO ".DB_PREFIX."_user SET 
	                u_email = '".$email."',
	                u_username = '".$username."',
	                u_displayname = '".$displayname."',
	                u_displayid = '".$displayid."',
	                u_gender = '".$gender."',
	                u_profile_pic = '".$profile_pic."',
	                u_status = 'P',
	                u_password = '".md5($password)."',
	                u_create_date = '".date('Y-m-d H:i:s')."',
	                u_modified_date = '0000-00-00 00:00:00',
	                u_role  = '{$role}'";

	            $exe = $this->db->query($sqli);
	            if($exe) {
	            	$insert_iud = $this->db->insert_id;

		            $sq = "INSERT INTO ".DB_PREFIX."_user_details SET
		                ud_u_id         = '{$insert_iud}',
		                ud_first_name   = '{$firstname}',
		                ud_last_name    = '{$lastname}',
		                ud_dob    		= '{$ud_dob}',
		                ud_phone_number = '{$phonenum}',
		                ud_address      = '{$address}'";
		            
		            $exe = $this->db->query($sq);

		            if($exe) {
		            	$er = 0;
		            	
		            	if ($er == 0) {
		            		$res = array('flag' => 'success', 'message' => 'Thank you for registering with us. Our team will get back to you shortly after verifying your account.', 'data' => $insert_iud);
		            	} else {
				        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
				        }
			        	
			        } else {
			        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
			        }
	            } else {
		        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
		        }
	        } else {
	        	$res = array('flag' => 'error', 'message' => 'Username / Email already exists in our record.');
	        }
        }

		return $res;
	}
	
	public function RFORM($data) {
	    $thisLang      = isset($data['lang'])               ? $this->RealEscape($data['lang']) : '';
	    
	    $token      = isset($data['token'])                 ? $this->RealEscape($data['token']) : '';
	    $Studentname   = isset($data['Studentname']) 		? $this->RealEscape($data['Studentname']) : '';
	    
	    $gender        = isset($data['gender'])             ? $this->RealEscape($data['gender']) : '';
	    /*$genderOther   = isset($data['genderOther'])        ? $this->RealEscape($data['genderOther']) : '';*/
	    
	    $Homeaddress   = isset($data['Homeaddress']) 		? $this->RealEscape($data['Homeaddress']) : '';
	    $school        = isset($data['school'])             ? $this->RealEscape($data['school']) : '';
	    
	    $Relation      = isset($data['Relation'])           ? $this->RealEscape($data['Relation']) : '';
	    $otherRelation = isset($data['otherRelation'])      ? $this->RealEscape($data['otherRelation']) : '';
	    
	    $occupation    = isset($data['occupation'])         ? $this->RealEscape($data['occupation']) : '';
	    $date          = isset($data['date'])               ? $this->RealEscape($data['date']) : '';
	    
	    $know          = isset($data['hiddentoolsname1'])               ? $this->RealEscape($data['hiddentoolsname1']) : '';
	    $otherNo       = isset($data['otherNo'])            ? $this->RealEscape($data['otherNo']) : '';
	    
	    
	    $Parentname      = isset($data['Parentname'])               ? $this->RealEscape($data['Parentname']) : '';
	    
	    
	    $old_DOB = explode('/', $date); 
	    $new_DOB = $old_DOB[2].'-'.$old_DOB[1].'-'.$old_DOB[0];
	    
	    
	    $bodyV      = isset($data['table-bodyV'])               ? $this->RealEscape($data['table-bodyV']) : '';
	    $thisName = '';
	    $thisGender = '';
	    if( $bodyV != '' ){
            for ($x = 1; $x <= $bodyV; $x++) {
                
                if( $data['Studentname'.$x] != ''){
                      $thisName .= ', '.$data['Studentname'.$x];
                      if( $data['gender'.$x] != ''){
                           $thisGender .= ', '.$data['gender'.$x];    
                      }else{
                          $thisGender .= ', 0'; 
                      }
                                     
                }

            }
	    }
	    $StudentnameN = $Studentname.$thisName;
	    $genderN      = $gender.$thisGender;
	    
	    

        if($token == '') {
        	$res = array('flag' => 'error', 'message' => 'Error!! Something Wrong Happened..');
        } else {
        
/*
            if($gender == 'Other' ){
                $gender2 = $gender.': '.$genderOther;
            }else{
                $gender2 = $gender;
            }
*/
            if($Relation == 'Other' ){
                $Relation2 = $Relation.': '.$otherRelation;
            }else{
                $Relation2 = $Relation;
            }
            
            if (strpos($know, 'Other') !== false) {
                $know2 = $know.': '.$otherNo;
            }else{
                $know2 = $know;
            }

$sqlDouble = " SELECT * FROM ".DB_PREFIX."_rform WHERE displayid = '".$token."' AND name = '".$StudentnameN."' AND gender = '".$genderN."' AND address = '".$Homeaddress."' AND school = '".$school."' AND relationship = '".$Relation2."' AND
occupation = '".$occupation."' AND
dob = '".$date."' AND
know = '".$know2."' AND
parentname = '".$Parentname."' AND
lang = '".$thisLang."' ";
$qryDouble = $this->db->query($sqlDouble);
if ($qryDouble->num_rows > 0) {
    $res = array('flag' => 'success', 'message' => 'Successfully Submitted. Thank You.');
}else{
            $sq = " INSERT INTO ".DB_PREFIX."_rform SET
            displayid    = '".$token."',
            name         = '".$StudentnameN."',
            gender       = '".$genderN."',
            address      = '".$Homeaddress."',
            school       = '".$school."',
            relationship = '".$Relation2."',
            occupation   = '".$occupation."',
            dob          = '".$date."',
            know         = '".$know2."',
            parentname   = '".$Parentname."',
            lang         = '".$thisLang."' ";
            $exe = $this->db->query($sq);


            if($exe) {
    	        $sql = " SELECT * FROM ".DB_PREFIX."_user WHERE u_displayid = '".$token."' ";
    	        $qry = $this->db->query($sql);
    	        if ($qry->num_rows > 0) {
    	            $row = mysqli_fetch_array($qry);
    	                $RForm = " SELECT * FROM ".DB_PREFIX."_rform WHERE displayid = '".$token."' ";
    	                $qryRForm = $this->db->query($RForm);
    	                if ($qryRForm->num_rows > 1) {

        	                $sqlC = " SELECT * FROM ".DB_PREFIX."_user_details WHERE ud_u_id = '".$row['u_id']."' ";
        	                $qryC = $this->db->query($sqlC);
        	                if ($qryC->num_rows > 0) {
        	                    $rowC = mysqli_fetch_array($qryC);
        	                    $thisAddr = $rowC['ud_address'].'\r\n'.$Homeaddress.' ('.$Parentname.')';
        	                    
        	                    $sql = "UPDATE ".DB_PREFIX."_user_details SET ud_address = '".$thisAddr."', ud_dob = '".$new_DOB."' WHERE ud_u_id = '".$row['u_id']."'";            
        	                    $this->db->query($sql);  
        	                }

    	                }else{
        	                $sql = "UPDATE ".DB_PREFIX."_user_details SET ud_address = '".$Homeaddress."', ud_dob = '".$new_DOB."' WHERE ud_u_id = '".$row['u_id']."'";            
        	                $this->db->query($sql);    	                    
    	                }
    	        }
                $res = array('flag' => 'success', 'message' => 'Successfully Submitted. Thank You.');
            }else{
                $res = array('flag' => 'error', 'message' => 'Error.');
            }    
}
            

		}
	    return $res;
	}
	
	public function SignUp($data) {//register luqman
		
        // $username 			= isset($data['u_username']) 		? $this->RealEscape($data['u_username']) : '';//luqman tukar sebab nk email
        $username    			= isset($data['u_email']) 			? $this->RealEscape($data['u_email']) : '';
        $email    			= isset($data['u_email']) 			? $this->RealEscape($data['u_email']) : '';
        $gender   			= isset($data['u_gender']) 			? $this->RealEscape($data['u_gender']) : '';
        $password 			= isset($data['u_password']) 		? $this->RealEscape($data['u_password']) : '';
        $con_password 		= isset($data['con_password']) 		? $this->RealEscape($data['con_password']) : '';
        $displayname 		= isset($data['u_displayname']) 	? $this->RealEscape($data['u_displayname']) : '';
        $profile_pic 		= isset($data['u_profile_pic']) 	? $this->RealEscape($data['u_profile_pic']) : '';
        $firstname 			= isset($data['ud_first_name']) 	? $this->RealEscape($data['ud_first_name']) : '';
        $lastname 			= isset($data['ud_last_name']) 		? $this->RealEscape($data['ud_last_name']) : '';
        $phonenum 			= isset($data['ud_phone_number']) 	? $this->RealEscape($data['ud_phone_number']) : '';
        $postalco 			= isset($data['ud_postal_code']) 	? $this->RealEscape($data['ud_postal_code']) : '';
        $address  			= isset($data['ud_address']) 		? $this->RealEscape($data['ud_address']) : ''; 
        $address2 			= isset($data['ud_address2']) 		? $this->RealEscape($data['ud_address2']) : '';
        $udcountry 			= isset($data['ud_country']) 		? $this->RealEscape($data['ud_country']) : '150';        
        $udstate  			= isset($data['search_ud_state']) 			? $this->RealEscape($data['search_ud_state']) : '';
        $udcity   			= isset($data['search_ud_city']) 			? $this->RealEscape($data['search_ud_city']) : '';
        $ud_dob   			= isset($data['ud_dob']) 			? $this->RealEscape($data['ud_dob']) : '';
        $company_name 		= isset($data['ud_company_name']) 	? $this->RealEscape($data['ud_company_name']) : '';
        $race 				= 'Not selected';
        $nationality 		= isset($data['ud_nationality']) 	? $this->RealEscape($data['ud_nationality']) : 'Not Selected';
        $admin_comment 		= isset($data['ud_admin_comment']) 	? $this->RealEscape($data['ud_admin_comment']) : '';
        $tutor_status 		= isset($data['ud_tutor_status']) 	? $this->RealEscape($data['ud_tutor_status']) : '';
        
        $tutor_experience 	= isset($data['ud_tutor_experience']) 	? $this->RealEscape($data['ud_tutor_experience']) : '';
        $experienceMonth 	= isset($data['experienceMonth']) 	? $this->RealEscape($data['experienceMonth']) : '';
        
        $about_yourself 	= isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
        $rate_per_hour 		= isset($data['ud_rate_per_hour']) ? $this->RealEscape($data['ud_rate_per_hour']) : '';
        $qualification 		= isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
		$role				= 3; // Tutor
		$tution_center 		= (isset($data['tution_center']) && $data['tution_center'] == 1)? 'Tuition Centre':'Not Selected';
		$displayid 			= $this->handler->getRandStr(7);
		$student_disability = isset($data['student_disability']) ? $this->RealEscape($data['student_disability']) : '';
		$dataIpAddress      = isset($data['ip_address']) ? $this->RealEscape($data['ip_address']) : '';
        $conduct_class 		= isset($data['conduct_class']) 	? $this->RealEscape($data['conduct_class']) : '';
        $conduct_online 		= isset($data['conduct_online']) 	? $this->RealEscape($data['conduct_online']) : '';
        
        
        /*$conduct_online_text 		= isset($data['conduct_online_text']) 	? $this->RealEscape($data['conduct_online_text']) : '';*/
		$conduct_online_text	= isset($data['hiddentoolsname1']) ? $this->RealEscape($data['hiddentoolsname1']) : '';
		$conduct_online_other	= isset($data['conduct_online_other']) ? $this->RealEscape($data['conduct_online_other']) : '';
		
        $student_disability_text 		= isset($data['student_disability_text']) 	? $this->RealEscape($data['student_disability_text']) : '';

        // Validation
        // if ($username == '') {
        // 	$res = array('flag' => 'error', 'message' => 'Username is required.');
        // } luqman comment
         if($password == '') {
        	$res = array('flag' => 'error', 'message' => 'Password is required.');
        } elseif($password != $con_password) {
        	$res = array('flag' => 'error', 'message' => 'Confirm Password mismatch.');
        } elseif($firstname == '') {
        	$res = array('flag' => 'error', 'message' => 'First name is required.');
        } elseif($lastname == '') {
        	$res = array('flag' => 'error', 'message' => 'Last name is required.');
        } elseif($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
        } elseif($displayname == '') {
        	$res = array('flag' => 'error', 'message' => 'Display name is required.');
        } elseif($phonenum == '') {
        	$res = array('flag' => 'error', 'message' => 'Phone number is required.');
        } elseif($gender == '') {
        	$res = array('flag' => 'error', 'message' => 'Gender is required.');
        } elseif($udcity == '') {//luqman
        	$res = array('flag' => 'error', 'message' => 'Location is required.');
        } elseif(!isset($data['cover_area_state']) || count($data['cover_area_state']) == 0) {
        	$res = array('flag' => 'error', 'message' => 'Area you can cover is required.');
        } 
		elseif($tutor_experience == '') {
        	$res = array('flag' => 'error', 'message' => 'Experience is required.');
        }elseif($about_yourself == '') {
        	$res = array('flag' => 'error', 'message' => 'About yourself is required.');
        }elseif($conduct_class == '') {
        	$res = array('flag' => 'error', 'message' => 'Conduct class is required.');
        }elseif($conduct_online == '') {
        	$res = array('flag' => 'error', 'message' => 'Conduct Online is required.');
        }
		
		
		
		else {
		    

                if ($udcity != '') {
					$sqlGetState = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '".$udcity."' ";
					$resultGetState = $this->db->query($sqlGetState);
					if($resultGetState->num_rows > 0){
						$rowGetState = mysqli_fetch_array($resultGetState);
						$thisGetState = $rowGetState['city_st_id'];
					}else{
						$thisGetState = '';
					}
                }



		    
	        $sql = "SELECT * FROM ".DB_PREFIX."_user 
	        LEFT JOIN ".DB_PREFIX."_user_details ON ud_u_id = u_id
	        WHERE 
	        u_status <> 'D' AND u_role = '3' AND (
	            u_email = '{$email}' || 
	            u_username = '{$email}' ||
	            ud_phone_number	 = '{$phonenum}'
	        )";

	        $qry = $this->db->query($sql);

		    
	        /*$sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 
	        u_status <> 'D' AND (
	            u_email = '{$email}' || 
	            u_username = '{$email}'
	        )";

	        $qry = $this->db->query($sql);
	        $c = $qry->num_rows;*/

	        if ($qry->num_rows == 0) {
	            $sqli = "INSERT INTO ".DB_PREFIX."_user SET 
	                u_email = '".$email."',
	                u_username = '".$email."',
	                u_displayname = '".$displayname."',
	                resit_pv_name = '".$displayname."',
	                u_displayid = '".$displayid."',
	                u_gender = '".$gender."',
	                u_profile_pic = '".$profile_pic."',
	                u_status = 'P',
	                u_password = '".md5($password)."',
	                u_create_date = '".date('Y-m-d H:i:s')."',
	                u_modified_date = '0000-00-00 00:00:00',
	                u_role  = '{$role}',
	                u_country_id = '150',
	                ip_address = '".$dataIpAddress."'";

	            $exe = $this->db->query($sqli);
	            
	            if($exe) {
	            	$insert_iud = $this->db->insert_id;

		            $sq = "INSERT INTO ".DB_PREFIX."_user_details SET
		                ud_u_id         = '{$insert_iud}',
		                ud_first_name   = '{$firstname}',
		                ud_last_name    = '{$lastname}',
		                ud_dob    		= '{$ud_dob}',
		                ud_phone_number = '{$phonenum}',
		                ud_address      = '{$address}',
		                ud_address2     = '{$address2}',
		                ud_country      = '{$udcountry}',
		                ud_state        = '{$thisGetState}',
		                ud_city         = '{$udcity}',
		                ud_postal_code  = '{$postalco}',
		                ud_company_name = '{$company_name}',
		                ud_race 		= '{$race}',
		                ud_nationality  = '{$nationality}',
		                ud_admin_comment = '{$admin_comment}',
		                ud_client_status = '{$tution_center}',
		                ud_client_status_2 = 'Not Selected',
		                ud_tutor_experience = '{$tutor_experience}',
		                ud_tutor_experience_month = '{$experienceMonth}',
		                ud_about_yourself = '{$about_yourself}',
		                ud_rate_per_hour = '{$rate_per_hour}',
		                ud_qualification = '{$qualification}',
		                ud_tutor_status = '{$tutor_status}',
		                conduct_class = '{$conduct_class}',
		                conduct_online = '{$conduct_online}',
		                
		                conduct_online_text = '{$conduct_online_text}',
		                conduct_online_other = '{$conduct_online_other}',
		                student_disability_text = '{$student_disability_text}',
		                
		                student_disability = '{$student_disability}'";
		            $exe = $this->db->query($sq);

					if($exe) {
		            	$er = 0;
		            	if (isset($data['cover_area_state']) && count($data['cover_area_state']) > 0) {
		            		foreach ($data['cover_area_state'] as $cid) {
		            			if (isset($data['cover_area_city_'.$cid]) && count($data['cover_area_city_'.$cid]) > 0) {
				                    foreach ($data['cover_area_city_'.$cid] as $key => $pid) {
				                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_area_cover SET
				                         tac_u_id    = '{$insert_iud}',
				                         tac_st_id   = '{$cid}',
				                         tac_city_id = '{$pid}'";

				                        if ($this->db->query($allotSql)){} else {
				                            $er++;
				                        }
				                    }
				                }

				            	if (isset($data['other_area_'.$cid]) && $data['other_area_'.$cid] == '1') {
				            		$this->db->query("INSERT INTO ".DB_PREFIX."_tutor_area_cover SET 
				            			tac_u_id = '{$insert_iud}', 
				            			tac_st_id   = '{$cid}', 
				            			tac_other = '".$data['cover_area_other_'.$cid]."'");
				            	}
			                }
		            	}

		            	if (isset($data['tutor_course']) && count($data['tutor_course']) > 0) {
		            		foreach ($data['tutor_course'] as $cid) {
		            			if (isset($data['tutor_subject_'.$cid]) && count($data['tutor_subject_'.$cid]) > 0) {
				                    foreach ($data['tutor_subject_'.$cid] as $key => $pid) {
				                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_subject SET
				                         trs_u_id  = '{$insert_iud}',
				                         trs_tc_id = '{$cid}',
				                         trs_ts_id = '{$pid}'";

				                        if ($this->db->query($allotSql)){} else {
				                            $er++;
				                        }
				                    }
				                }

				            	if (isset($data['subject_'.$cid]) && $data['subject_'.$cid] == '1') {
				            		$this->db->query("INSERT INTO ".DB_PREFIX."_tutor_subject SET 
				            			trs_u_id = '{$insert_iud}', 
				            			trs_tc_id = '{$cid}', 
				            			trs_other = '".$data['other_subject_'.$cid]."'");
				            	}
			                }
		            	}
						
						/* HERE - RATING FUNCTION */	
						if ( $experienceMonth == 'year' ) {
							if( $tutor_experience >= '3' ){
								$rateComment = date('d/m/Y').' -System Register (tick 2)';
								$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '{$insert_iud}', ri_experience = 'true', ri_comments = '{$rateComment}' ";
								if ($this->db->query($allotSql)){} else {
									$er++;
								}
							}
						}
						/* HERE - RATING FUNCTION */
						
		            	if ($er == 0) {
		            		// Fire Notification email to Admin
		            		if (preg_match( "/[\r\n]/", $firstname ) || preg_match( "/[\r\n]/", $lastname) || preg_match( "/[\r\n]/", $email))
		            		{ 
 						   		$res = array('flag' => 'error', 'message' => 'Error sending email.');
							}else{
								$to      = 'tutor.hambal@gmail.com';
					
		            			$emailSubject = 'TutorKami - New tutor registration';	
			            		$emailBody 	  = "A new tutor has registered. Below are the tutor's details:
			            		<br>
			            		Full name: {$firstname} {$lastname}
			            		<br>
			            		Email: {$email}
								<br>
			            		Go <a href='".APP_ROOT."admin/manage_user.php'>here</a> to approve";
			            		// Go <a href='".APP_ROOT."admin/manage_user.php?action=edit&u_id={$insert_iud}'>here</a> to approve";

			            		$headers = 'From: Tutorkami' . "\r\n" .
			    				'Reply-To: webmaster@example.com' . "\r\n" .
			    				'X-Mailer: PHP/' . phpversion();
								// Set content-type header for sending HTML email
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			            		mail($to, $emailSubject, $emailBody, $headers);
			            		// $send = $this->handler->mailGunEmail('Admin', $adminEmail, $emailSubject, $emailBody);
			            	
							}
		            		$res = array('flag' => 'success', 'message' => 'Thank you for registering with us. Our team will get back to you shortly after verifying your account.', 'data' => $insert_iud);
		            	} else {
				        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
				        }
			        	
			        } else {
			        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
			        }
	            } else {
		        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
		        }
	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);
				if($row['u_status'] == 'B'){
					$res = array('flag' => 'error', 'message' => 'Your account has been banned. Please contact our General Manager at 019-220 8594 for further action');	
				}else{
				    $link = '<a href="https://www.tutorkami.com/forgot_password">link</a>';
				    $res = array('flag' => 'error', 'message' => 'You already have an account with us. Please login using your email '.$row['u_email'].' , if you have forgotten the password, please reset it at this '.$link.'');
				}
	        }
        }

		return $res;
	} //luqman

	public function VerifyOTP($otpform){
        $sqli = "SELECT * from ".DB_PREFIX."_user WHERE u_id = '".$otpform['u_id']."' AND u_otp = '".$otpform['u_otp']."'";

        $response = $this->db->query($sqli);
        if ($response->num_rows == 0){
        	$res = array('flag' => 'error', 'message' => 'Wrong OTP.');
        }else{
            $sql = "UPDATE ".DB_PREFIX."_user SET u_status = 'A' WHERE u_id = '".$otpform['u_id']."'";            
            $this->db->query($sql);
            $res = array('flag' => 'success', 'message' => 'You have successfully verified your email. Your account is activated to login.');
        }

        return $res;
    }

    //second email utk tutor
	public function ActivateTutor($email){
        $sqli = "SELECT * from ".DB_PREFIX."_user WHERE u_email = '".$email."'";

        $response = $this->db->query($sqli);
        if ($response->num_rows == 0){
        	$res = array('flag' => 'error', 'message' => 'Wrong Email.');
        }else{
        	$row = $response->fetch_array(MYSQLI_ASSOC);
        	$displayname = $row['u_displayname'];
        	$email = $row['u_email'];
        	// Update Status
            $sql = "UPDATE ".DB_PREFIX."_user SET u_status = 'A', u_admin_approve = '2' WHERE u_id = '".$row['u_id']."'";            
            $result = $this->db->query($sql);
            
            if($result){
            // Fire Welcome Email
            $to = $email;
    		$welcome_subject = 'Welcome to TutorKami';
    		$welcome_content = 'Hi '.$displayname.' <br><br> You can now <a href="'.APP_ROOT.'login.php">log in</a> to our website to use the services offered. Amongst are:
			<br>
			1. Tuition Jobs Viewing & Searching -  View latest jobs or search jobs according to Levels & States
			<br>
			<a href="'.APP_ROOT.'search_job.php">Job Listings</a>
			<br>
			<br>
			2. Update your profile. Additional fields that you can update are:
			<br>
			a. Occupation
			<br>
			b. Upload testimonials
			<br>
			c. Name of school/institution/company you currently are working in 
			<br>
			<br>
			3. Add us as friend on FB, and like our FB Fan Page or Instagram page to get latest info on news and tuition jobs 
			<br>
			<a href="https://www.facebook.com/HambalTutorKami">Add TutorKami.com on Facebook</a>
			<br>
			<a href="https://www.facebook.com/TutorKami.comHomeTuition">Like TutorKami.com Page on Facebook</a>
			<br>
			<a href="https://www.instagram.com/tutorkami/">Instagram/TutorKami</a>
			<br>
			<br>
			Need help with any of our services? Just email us at <a href="mailto:contact@tutorkami.com">contact@tutorkami.com</a>.
			<br>
			We are proud to have you as our member at TutorKami, enjoy your stay!
			<br>
			Note: Your email address was given to us by one of our registered members. If you did not signup to be a member, please send an email to <a href="mailto:contact@tutorkami.com">contact@tutorkami.com</a>
			<br><br> Thank you. <br> Admin, <br> <a href="tutorkami.com" target="_blank">www.tutorkami.com</a>
			<br><br>
			<img src="' . APP_ROOT . 'admin/upload/logo.png" style="max-width: 250px" />';

    				/*$headers = 'From: Tutorkami' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    // Set content-type header for sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";*/

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: Tutorkami <hello@tutorkami.com>' . "\r\n" .
                    'Reply-To: hello@tutorkami.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                    
					mail($to, $welcome_subject, $welcome_content, $headers, '-fhello@tutorkami.com');
    		// $this->handler->mailGunEmail($displayname, $email, $welcome_subject, $welcome_content);
         }
    		
            $res = array('flag' => 'success', 'message' => 'You have successfully verified your email. Your account is activated to login.');
        }

        return $res;
    }

	public function ParentSignIn($data) {
		$email 		= isset($data['u_email'])		? $data['u_email'] : '';
		$password 	= isset($data['u_password'])	? $data['u_password'] : '';

		if($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
			//$_SESSION['exp_time']= date('H:i:s');
        } 
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $res = array('flag' => 'error', 'message' => 'Invalid email format.');
        }
        elseif($password == '') {
        	$res = array('flag' => 'error', 'message' => 'Password is required.');
        } else {

	        $sql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id 
	        WHERE 
		        u_status <> 'D' AND u_role = '4' AND (
		            U.u_email = '{$email}' || 
		            U.u_username = '{$email}' || 
		            UD.ud_last_name = '{$email}'
		        )";

		    $qry = $this->db->query($sql);
	        if ($qry->num_rows == 0) {

    	        $sqlPwID = "SELECT * FROM ".DB_PREFIX."_user AS U 
    	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id 
    	        WHERE u_status <> 'D' AND u_role = '4' AND u_password = '".md5($password)."'   ";
    		    $qryPwID = $this->db->query($sqlPwID);
    		    if ($qryPwID->num_rows == 0) {
    		        $res = array('flag' => 'error', 'message' => 'Wrong username or/and password');
    		    }else{
    		        $rowPwID = $qryPwID->fetch_array(MYSQLI_ASSOC);
    		        if ($rowPwID['ud_last_name'] == '') {
    		            
        	            if ($rowPwID['u_status'] != 'A' && $rowPwID['u_status'] != 'B') {
        	            	$res = array('flag' => 'error', 'message' => 'Your Account is not activated yet.');
        	            } else if($rowPwID['u_status'] == 'B'){
        					$res = array('flag' => 'error', 'message' => 'Your Account Has Been Banned !');	
        				}else {
        				    
        				    $sqlUpdateUser = " UPDATE ".DB_PREFIX."_user_details SET ud_last_name = '".$email."' WHERE ud_u_id = '".$rowPwID['u_id']."' " ;
        				    $this->db->query($sqlUpdateUser);
        				    
                    		$getJob = " SELECT * FROM ".DB_PREFIX."_job WHERE u_id = '".$rowPwID['u_id']."' ";
                    		$resultgetJob = $this->db->query($getJob);
                    		if ($resultgetJob->num_rows > 0) {
                                while ( $rowgetJob = $resultgetJob->fetch_assoc() ) {
                				    $sqlUpdateJob = " UPDATE tk_job SET actual_email = '".$email."' WHERE j_id = '".$rowgetJob['j_id']."' " ;
                				    $this->db->query($sqlUpdateJob);
                                }
                            }
        				    
        	                $data = array(
        	                    'user_id'       => $rowPwID['u_id'],
        	                    'user_name'     => $rowPwID['u_username'],
        	                    'first_name'    => $rowPwID['ud_first_name'],
        	                    'last_name'     => $rowPwID['ud_last_name'],
        	                    'display_name'  => $rowPwID['u_displayname'],
        	                    'user_email'    => $rowPwID['u_email'],
        	                    'user_role'     => $rowPwID['u_role'],
        	                    'user_gender'   => $rowPwID['u_gender'],
        	                    'user_pic'      => $rowPwID['u_profile_pic']
        	                );
        
        	                $res = array('flag' => 'success', 'message' => 'Login Successful.', 'data' => $data);
        	            }
/*
    		            $thisToken=GetShortUrl('Activation Link', $email, $rowPwID['u_id']);
                		//$thisToken = 'token='.$rowPwID['u_id'].'&AqsOvw='.md5($password).'&gMnj='.md5($email);
                        $to = $email;
                		$welcome_subject = 'Please activate your account - TutorKami';
                		$welcome_content = 'Salam/Hi '.$rowPwID['salutation'].' '.$rowPwID['ud_first_name'].'
                		<br><br>
                		Please click below to activate your account.
                		<br><br>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td bgcolor="#0d1d85" style="padding: 12px 18px 12px 18px; border-radius:3px" align="center">
                                    <a href="https://www.tutorkami.com/client_login.php?tokentk='.$thisToken.'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; display: inline-block;">Activate Your Account</a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
            			<br><br> 
            			Thank you.
            			<br><br> <a href="tutorkami.com" target="_blank"><img src="' . APP_ROOT . 'admin/upload/logo3.png" style="max-width: 300px" /></a>
            			';
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: Tutorkami <hello@tutorkami.com>' . "\r\n" .
                        'Reply-To: hello@tutorkami.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
        
    					mail($to, $welcome_subject, $welcome_content, $headers, '-fhello@tutorkami.com');
    		            $res = array('flag' => 'error', 'message' => 'Salam/Hi '.$rowPwID['salutation'].' '.$rowPwID['ud_first_name'].', <br/>For first time login, please check your email and click the activation link (if you did not see our email, please check your spam folder)');
*/
    		            
    		        }else{
    		            $res = array('flag' => 'error', 'message' => 'Wrong username or/and password');
    		        }
    		    }


	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);
	            
	            if ($row['u_password'] != md5($password)) {
	            	//$res = array('flag' => 'error', 'message' => 'Wrong password.');
					$res = array('flag' => 'error', 'message' => 'Wrong username or/and password');
	            } elseif ($row['u_status'] != 'A' && $row['u_status'] != 'B') {
	            	$res = array('flag' => 'error', 'message' => 'Your Account is not activated yet.');
	            } 
				/*START fadhli | filter banned user  */
	            else if($row['u_status'] == 'B'){
					$res = array('flag' => 'error', 'message' => 'Your Account Has Been Banned !');	
				}
				/*END fadhli */
				else {
					
					/*START fadhli | update bila waktu login.. guna column sedia ada( u_modified_date ) */
					$updateLastActivity = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$row['u_id']."'";
					$execute = $this->db->query($updateLastActivity);
					/*END fadhli */
					
	                $data = array(
	                    'user_id'       => $row['u_id'],
	                    'user_name'     => $row['u_username'],
	                    'first_name'    => $row['ud_first_name'],
	                    'last_name'     => $row['ud_last_name'],
	                    'display_name'  => $row['u_displayname'],
	                    'user_email'    => $row['u_email'],
	                    'user_role'     => $row['u_role'],
	                    'user_gender'   => $row['u_gender'],
	                    'user_pic'      => $row['u_profile_pic']
	                );

	                $res = array('flag' => 'success', 'message' => 'Login Successful.', 'data' => $data);
	            }
	        }
		}

        return $res;
	}

	public function SignIn($data) {
		$email 		= isset($data['u_email'])		? $data['u_email'] : '';
		$password 	= isset($data['u_password'])	? $data['u_password'] : '';

		if($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
        } elseif($password == '') {
        	$res = array('flag' => 'error', 'message' => 'Password is required.');
        } else {

	        $sql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id 
	        WHERE 
		        u_status <> 'D' AND u_role = '3' AND (
		            u_email = '{$email}' || 
		            u_username = '{$email}'
		        )";

		    $qry = $this->db->query($sql);
	        if ($qry->num_rows == 0) {
	        	$res = array('flag' => 'error', 'message' => 'The email does not exist in our record');
	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);
	            
	            if ($row['u_password'] != md5($password)) {
	            	$res = array('flag' => 'error', 'message' => 'Wrong password.');
	            } elseif ( $row['u_status'] == 'P' && ($row['u_admin_approve'] == NULL || $row['u_admin_approve'] == '0' || $row['u_admin_approve'] == '') ) {
	            	$res = array('flag' => 'error', 'message' => 'TutorKami Will Review To Activated Your Account');
	            } elseif ( ($row['u_status'] == 'P' || $row['u_status'] == 'A') && $row['u_admin_approve'] == '1' ) {
	            	$res = array('flag' => 'error', 'message' => 'Please Check Your Email To Activate');
	            }
				/*START fadhli | filter banned user  */
	            else if($row['u_status'] == 'B'){
					$res = array('flag' => 'error', 'message' => 'Your Account Has Been Banned !');	
				}
				/*END fadhli */
				else {
					
					/*START fadhli | update bila waktu login.. guna column sedia ada( u_modified_date ) */
					$updateLastActivity = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$row['u_id']."'";
					$execute = $this->db->query($updateLastActivity);
					/*END fadhli */
					
	                $data = array(
	                    'user_id'       => $row['u_id'],
	                    'user_name'     => $row['u_username'],
	                    'first_name'    => $row['ud_first_name'],
	                    'last_name'     => $row['ud_last_name'],
	                    'display_name'  => $row['u_displayname'],
	                    'user_email'    => $row['u_email'],
	                    'user_role'     => $row['u_role'],
	                    'user_gender'   => $row['u_gender'],
	                    'user_displayid'   => $row['u_displayid'],
	                    'user_pic'      => $row['u_profile_pic']
	                );
	                
	                $res = array('flag' => 'success', 'message' => 'Login Successful.', 'data' => $data);
	            }
	        }
		}

        return $res;
	}

	/**
     * This method will handle Facebook login
     * @param array $data
     * @throws Exception
     * @return boolean true or false based on success or failure
     */

    public function fbLogin($profile_arr){
        $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND u_oauth_provider = 'facebook' AND u_social_id = ".$profile_arr['id'];
        
        $qry = $this->db->query($sql);
        if ($qry->num_rows == 0) {
            $sqli = "INSERT INTO ".DB_PREFIX."_user SET 
                u_email             = '".$profile_arr['u_email']."',
                u_profile_pic       = '".$profile_arr['pic']."',
                u_social_id         = '".$profile_arr['id']."',
                u_app_token         = '".$profile_arr['fb_app_token']."',
                u_oauth_provider    = 'facebook',
                u_status            = 'A',
                u_create_date       = '".date('Y-m-d H:i:s')."'";

            if($this->db->query($sqli)) {
	            $insert_iud = $this->db->insert_id;
	            
	            $sql = "INSERT INTO ".DB_PREFIX."_user_details SET
	                ud_u_id         = '{$insert_iud}',
	                ud_first_name   = '".$profile_arr['first_name']."',
	                ud_last_name    = '".$profile_arr['last_name']."'";

	            if($this->db->query($sql)) {
		            /* Get the user from DB */
		            $sql_fb = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND u_id = ".$insert_iud;
		            $qry_fb = $this->db->query($sql_fb);
		            $row    = $qry_fb->fetch_array(MYSQLI_ASSOC);
		            $data = array(
			            'user_id'       => $row['u_id'],
			            'user_name'     => $row['u_username'],
			            'user_email'    => $row['u_email'],
			            'user_role'     => $row['u_role'],
			            'user_gender'   => $row['u_gender'],
			            'user_pic'      => $row['u_profile_pic']
			        );

			        $res = array('flag' => 'success', 'message' => 'Login Successful.', 'data' => $data);
		        } else {
		        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
		        }

	        } else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
        } else {
            $row = $qry->fetch_array(MYSQLI_ASSOC);

            $query = "UPDATE ".DB_PREFIX."_user SET 
                ud_first_name = '".$profile_arr['first_name']."', 
                ud_last_name = '".$profile_arr['last_name']."' 
            WHERE ud_u_id = '".$row['u_id']."'";

            if($this->db->query($query)) {
            	$data = array(
		            'user_id'       => $row['u_id'],
		            'user_name'     => $row['u_username'],
		            'user_email'    => $row['u_email'],
		            'user_role'     => $row['u_role'],
		            'user_gender'   => $row['u_gender'],
		            'user_pic'      => $row['u_profile_pic']
		        );

            	$res = array('flag' => 'success', 'message' => 'Login Successful.', 'data' => $data);
            } else {
            	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
            }
        }

        return $res;
    }

// luqman
    public function GetUser($user_role = NULL, $user_id = NULL, $user_status = NULL, $search_tutor = NULL, $search_email = NULL, $search_first_name = NULL, $search_last_name = NULL, $search_phone_number = NULL) {
		$qry = "SELECT U.*, UD.*, C.city_name FROM ".DB_PREFIX."_user AS U ";
        $qry .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        $qry .= "LEFT JOIN ".DB_PREFIX."_cities AS C ON C.city_id = UD.ud_city ";
        $qry .= "WHERE 1";
        // if ($user_status != '') {
        //     $qry .= " AND U.u_status = '{$user_status}'";
        // } else {
        //     $qry .= " AND U.u_status <> 'D'";
        // }

        // if ($user_role != '') {
        //     $qry .= " AND U.u_role = '{$user_role}'";
        // }
        if ($user_id != '') {
            $qry .= " AND U.u_id = {$user_id}";
        }

        // if ($search_tutor != '') {
        // 	if ($search_tutor == 'Yes') {
        // 		$qry .= " AND UD.ud_client_status = 'Tuition Centre'";
        // 	} elseif ($search_tutor == 'No') {
        // 		$qry .= " AND UD.ud_client_status != 'Tuition Centre'";
        //     }
        // }
        // if ($search_email != '') {
        //     $qry .= " AND( U.u_username LIKE '%{$search_email}%' || U.u_email LIKE '%{$search_email}%' )";
        // }
        // if ($search_first_name != '') {
        //     $qry .= " AND UD.ud_first_name LIKE '%{$search_first_name}%'";
        // }
        // if ($search_last_name != '') {
        //     $qry .= " AND UD.ud_last_name LIKE '%{$search_last_name}%'";
        // }
        // if ($search_phone_number != '') {
        //     $qry .= " AND UD.ud_phone_number LIKE '%{$search_phone_number}%'";
        // }
        // $fh = fopen('textfilebaru.txt', 'w');
        //         fwrite($fh, $qry);

		return $this->db->query($qry);
	}
	// luqman

    public function GetTutorByDisplayID($displayid) {
		$qry = "SELECT U.*, UD.*, C.city_name FROM ".DB_PREFIX."_user AS U ";
        $qry .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        $qry .= "LEFT JOIN ".DB_PREFIX."_cities AS C ON C.city_id = UD.ud_city ";
        $qry .= "WHERE 1";
        $qry .= " AND U.u_status <> 'D'";
        $qry .= " AND U.u_role = '3'";
        $qry .= " AND U.u_displayid = '{$displayid}'";

		return $this->db->query($qry);
	}
	
	public function UpdateAccount($data) {
		
        $user_id 			= isset($data['u_id']) 				? $this->RealEscape($data['u_id']) : '';        
        $email    			= isset($data['u_email']) 			? $this->RealEscape($data['u_email']) : '';
        $gender   			= isset($data['u_gender']) 			? $this->RealEscape($data['u_gender']) : '';        
        $displayname 		= isset($data['u_displayname']) 	? $this->RealEscape($data['u_displayname']) : '';
        $profile_pic 		= isset($data['u_profile_pic']) 	? $this->RealEscape($data['u_profile_pic']) : '';
        $firstname 			= isset($data['ud_first_name']) 	? $this->RealEscape($data['ud_first_name']) : '';
        $lastname 			= isset($data['ud_last_name']) 		? $this->RealEscape($data['ud_last_name']) : '';
        $phonenum 			= isset($data['ud_phone_number']) 	? $this->RealEscape($data['ud_phone_number']) : '';
        $postalco 			= isset($data['ud_postal_code']) 	? $this->RealEscape($data['ud_postal_code']) : '';
        $address  			= isset($data['ud_address']) 		? $this->RealEscape($data['ud_address']) : ''; 
        $address2 			= isset($data['ud_address2']) 		? $this->RealEscape($data['ud_address2']) : '';
        $udcountry 			= isset($data['ud_country']) 		? $this->RealEscape($data['ud_country']) : '';        
        $udstate  			= isset($data['search_ud_state']) 			? $this->RealEscape($data['search_ud_state']) : '';
        $udcity   			= isset($data['search_ud_city']) 			? $this->RealEscape($data['search_ud_city']) : '';
        $ud_dob   			= isset($data['ud_dob']) 			? $this->RealEscape($data['ud_dob']) : '';
        $company_name 		= isset($data['ud_company_name']) 	? $this->RealEscape($data['ud_company_name']) : '';
        $race 				= isset($data['ud_race']) 			? $this->RealEscape($data['ud_race']) : '';
        $current_occupation = isset($data['ud_current_occupation']) ? $this->RealEscape($data['ud_current_occupation']) : '';
        $current_occupation_other = isset($data['ud_current_occupation_other']) ? $this->RealEscape($data['ud_current_occupation_other']) : '';
        $current_company 	= isset($data['ud_current_company']) ? $this->RealEscape($data['ud_current_company']) : '';
        $nationality 		= isset($data['ud_nationality']) 	? $this->RealEscape($data['ud_nationality']) : '';
        $admin_comment 		= isset($data['ud_admin_comment']) 	? $this->RealEscape($data['ud_admin_comment']) : '';
        $tutor_status 		= isset($data['ud_tutor_status']) 	? $this->RealEscape($data['ud_tutor_status']) : '';
        
        $tutor_experience 	= isset($data['ud_tutor_experience']) 	? $this->RealEscape($data['ud_tutor_experience']) : '';
        $experienceMonth 	= isset($data['experienceMonth']) 	? $this->RealEscape($data['experienceMonth']) : '';
        
        $about_yourself 	= isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
        $rate_per_hour = isset($data['ud_rate_per_hour']) ? $this->RealEscape($data['ud_rate_per_hour']) : '';
        $qualification 		= isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
        $marital_status 	= isset($data['ud_marital_status']) ? $this->RealEscape($data['ud_marital_status']) : '';
		$role				= 3; // Tutor
		$tution_center 		= (isset($data['tution_center']) && $data['tution_center'] == 1)? 'Tuition Centre':'Not Selected';

        $user_testimonial 	= isset($data['u_testimonial']) ? $this->RealEscape($data['u_testimonial']) : '';
        $student_disability = isset($data['student_disability']) ? $this->RealEscape($data['student_disability']) : '';
        $conduct_class 		= isset($data['conduct_class']) 	? $this->RealEscape($data['conduct_class']) : '';
        $conduct_online 		= isset($data['conduct_online']) 	? $this->RealEscape($data['conduct_online']) : '';
        
        $locationWorkplaceState = isset($data['locationWorkplaceState']) 			? $this->RealEscape($data['locationWorkplaceState']) : '';
        $locationWorkplaceCity  = isset($data['locationWorkplaceCity']) 			? $this->RealEscape($data['locationWorkplaceCity']) : '';

        /*$conduct_online_text  = isset($data['conduct_online_text']) 			? $this->RealEscape($data['conduct_online_text']) : '';*/
		
		$conduct_online_text	= isset($data['hiddentoolsname1']) ? $this->RealEscape($data['hiddentoolsname1']) : '';
		$conduct_online_other	= isset($data['conduct_online_other']) ? $this->RealEscape($data['conduct_online_other']) : '';
		
	                
		
        
        
        $student_disability_text  = isset($data['student_disability_text']) 			? $this->RealEscape($data['student_disability_text']) : '';
        
        
        $checkbox1  = isset($data['checkbox-1']) ? $this->RealEscape($data['checkbox-1']) : '';
        $checkbox2  = isset($data['checkbox-2']) ? $this->RealEscape($data['checkbox-2']) : '';
        $checkbox3  = isset($data['checkbox-3']) ? $this->RealEscape($data['checkbox-3']) : '';
        $checkbox4  = isset($data['checkbox-4']) ? $this->RealEscape($data['checkbox-4']) : '';
        
        
        
        // Validation
        if ($user_id == '') {
        	$res = array('flag' => 'error', 'message' => 'User id is required.');
        }
        
        else {

            /* START fadhli - delete/remove/unlike image/picture in dir */
                if ($profile_pic != '') {
					$sqlPicture = "SELECT * FROM ".DB_PREFIX."_user WHERE u_id = {$user_id}";
					$resultPicture = $this->db->query($sqlPicture);
					if($resultPicture->num_rows > 0){
						$rowPicture = mysqli_fetch_array($resultPicture);
						$thisPic = $rowPicture['u_profile_pic'];
						$dirPicture = "000".$thisPic."_0.jpg";
						unlink('../images/profile/'.$dirPicture);
					}
                }
                /* END - fadhli */
				

					/* HERE - RATING FUNCTION (IF USER CHANGE experience )*/

					$sqlGetExp = "SELECT ud_u_id, ud_tutor_experience, ud_tutor_experience_month FROM ".DB_PREFIX."_user_details WHERE ud_u_id = {$user_id} ";
					$resultGetExp = $this->db->query($sqlGetExp);
					if($resultGetExp->num_rows > 0){
						$rowGetExp = mysqli_fetch_array($resultGetExp);
						if( ($rowGetExp['ud_tutor_experience_month'] != $experienceMonth) || ($rowGetExp['ud_tutor_experience'] != $tutor_experience) ){
							
							$rateComment = date('d/m/Y').' -System Tutor Update Profile (tick 2)';
							$rateComment2 = date('d/m/Y').' -System Tutor Update Profile (untick 2)';
							if ( $experienceMonth == 'year' ) {
								if( $tutor_experience >= '3' ){
									$sqlInternalRating = "SELECT ri_tutor, ri_experience, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = {$user_id} ";
									$resultInternalRating = $this->db->query($sqlInternalRating);
									if($resultInternalRating->num_rows > 0){
										$rowInternalRating = mysqli_fetch_array($resultInternalRating);
										$newComment = $rateComment.'\n'.$rowInternalRating['ri_comments'];
										    
										if( $rowInternalRating['ri_experience'] != 'true' ){
    										$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_experience = 'true', ri_comments = '".$newComment."' WHERE ri_tutor = '{$user_id}' ";
    										if ($this->db->query($allotSql)){} else {}										    
										}

									}else{
										$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '{$user_id}', ri_experience = 'true', ri_comments = '{$rateComment}' ";
										if ($this->db->query($allotSql)){} else {}						
									}
								}else{
									$sqlInternalRating = "SELECT ri_tutor, ri_experience, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = {$user_id} ";
									$resultInternalRating = $this->db->query($sqlInternalRating);
									if($resultInternalRating->num_rows > 0){
										$rowInternalRating = mysqli_fetch_array($resultInternalRating);
										$newComment = $rateComment2.'\n'.$rowInternalRating['ri_comments'];
										
										if( $rowInternalRating['ri_experience'] != 'false' ){
    										$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_experience = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '{$user_id}' ";
    										if ($this->db->query($allotSql)){} else {}										    
										}

									}else{
										$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '{$user_id}', ri_experience = 'false', ri_comments = '{$rateComment2}' ";
										if ($this->db->query($allotSql)){} else {}						
									}
								}
							}else{
									$sqlInternalRating = "SELECT ri_tutor, ri_experience, ri_comments FROM ".DB_PREFIX."_review_rating_internal WHERE ri_tutor = {$user_id} ";
									$resultInternalRating = $this->db->query($sqlInternalRating);
									if($resultInternalRating->num_rows > 0){
										$rowInternalRating = mysqli_fetch_array($resultInternalRating);
										$newComment = $rateComment2.'\n'.$rowInternalRating['ri_comments'];
										
										if( $rowInternalRating['ri_experience'] != 'false' ){
    										$allotSql = " UPDATE ".DB_PREFIX."_review_rating_internal SET ri_experience = 'false', ri_comments = '".$newComment."' WHERE ri_tutor = '{$user_id}' ";
    										if ($this->db->query($allotSql)){} else {}										    
										}

									}else{
										$allotSql = " INSERT INTO ".DB_PREFIX."_review_rating_internal SET ri_tutor = '{$user_id}', ri_experience = 'false', ri_comments = '{$rateComment2}' ";
										if ($this->db->query($allotSql)){} else {}						
									}
							}
							
						}
					}

					/* HERE - RATING FUNCTION */  

            $sqli = "UPDATE ".DB_PREFIX."_user SET 
                u_displayname = '".$displayname."',
				u_gender = '".$gender."'";

            if ($profile_pic != '') {
            	$sqli .= ", u_profile_pic = '".$profile_pic."'";
            }
            
            $sqli .= " WHERE u_id = {$user_id}";

            $exe = $this->db->query($sqli);
            if($exe) {

	            $sq = "UPDATE ".DB_PREFIX."_user_details SET
	                ud_dob    		= '{$ud_dob}',
	                ud_address      = '{$address}',
	                ud_address2     = '{$address2}',
	                ud_country      = '{$udcountry}',
	                ud_state        = '{$udstate}',
	                ud_city         = '{$udcity}',
	                ud_postal_code  = '{$postalco}',
	                ud_phone_number = '{$phonenum}',
	                ud_company_name = '{$company_name}',
	                ud_race 		= '{$race}',
	                ud_nationality  = '{$nationality}',
	              
	                ud_client_status = '{$tution_center}',
	                ud_tutor_experience = '{$tutor_experience}',
	                ud_tutor_experience_month = '{$experienceMonth}',
	                ud_about_yourself = '{$about_yourself}',
	                ud_rate_per_hour = '{$rate_per_hour}',
	                ud_marital_status = '{$marital_status}',
	                ud_qualification = '{$qualification}',
	                ud_tutor_status = '{$tutor_status}',
	                conduct_class = '{$conduct_class}',
	                conduct_online = '{$conduct_online}',
	                ud_current_occupation = '{$current_occupation}',
	                ud_current_occupation_other = '{$current_occupation_other}',
	                ud_current_company = '{$current_company}',
	                student_disability = '{$student_disability}',
	                
	                
	                conduct_online_text  = '{$conduct_online_text}',
	                conduct_online_other = '{$conduct_online_other}',
	                
	                student_disability_text  = '{$student_disability_text}',
	                
	                
	                ud_workplace_state  = '{$locationWorkplaceState}',
	                ud_workplace_city   = '{$locationWorkplaceCity}'
	                
	            WHERE ud_u_id = {$user_id}";
	            
	            $exe = $this->db->query($sq);

	            if($exe) {
	            	$er = 0;

	            	if (isset($data['cover_area_state']) && count($data['cover_area_state']) > 0) {
	            		# DELETE PREVIOUS DATA #
	            		$this->db->query("DELETE FROM ".DB_PREFIX."_tutor_area_cover WHERE tac_u_id = '{$user_id}'");
	            		foreach ($data['cover_area_state'] as $cid) {
	            			if (isset($data['cover_area_city_'.$cid]) && count($data['cover_area_city_'.$cid]) > 0) {
			                    foreach ($data['cover_area_city_'.$cid] as $key => $pid) {
			                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_area_cover SET
			                         tac_u_id    = '{$user_id}',
			                         tac_st_id   = '{$cid}',
			                         tac_city_id = '{$pid}'";

			                        if ($this->db->query($allotSql)){} else {
			                            $er++;
			                        }
			                    }
			                }

			            	if (isset($data['other_area_'.$cid]) && $data['other_area_'.$cid] == '1') {
			            		$this->db->query("INSERT INTO ".DB_PREFIX."_tutor_area_cover SET 
			            			tac_u_id = '{$user_id}', 
			            			tac_st_id   = '{$cid}', 
			            			tac_other = '".$data['cover_area_other_'.$cid]."'");
			            	}
		                }
	            	}

	            	if (isset($data['tutor_course']) && count($data['tutor_course']) > 0) {
	            		# DELETE PREVIOUS DATA #
	            		$this->db->query("DELETE FROM ".DB_PREFIX."_tutor_subject WHERE trs_u_id = '{$user_id}'");
	            		foreach ($data['tutor_course'] as $cid) {
	            			if (isset($data['tutor_subject_'.$cid]) && count($data['tutor_subject_'.$cid]) > 0) {
			                    foreach ($data['tutor_subject_'.$cid] as $key => $pid) {
			                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_subject SET
			                         trs_u_id  = '{$user_id}',
			                         trs_tc_id = '{$cid}',
			                         trs_ts_id = '{$pid}'";

			                        if ($this->db->query($allotSql)){} else {
			                            $er++;
			                        }
			                    }
			                }

			            	if (isset($data['subject_'.$cid]) && $data['subject_'.$cid] == '1') {
			            		$this->db->query("INSERT INTO ".DB_PREFIX."_tutor_subject SET 
			            			trs_u_id = '{$user_id}', 
			            			trs_tc_id = '{$cid}', 
			            			trs_other = '".$data['other_subject_'.$cid]."'");
			            	}
		                }
	            	}
	            	

	            	
	            	if( $checkbox1 == 'on' || $checkbox2 == 'on' || $checkbox3 == 'on' || $checkbox4 == 'on' ){
            	            	if( $checkbox1 == 'on'){
                                            $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti1 = $this->db->query($sqlTesti1);
            									if($resultTesti1->num_rows > 0){
            										$rowTesti1 = mysqli_fetch_array($resultTesti1);
            										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
            										unlink('../'.$thisTesti1);
            									}
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
											
            	            	}
            	            	if( $checkbox2 == 'on'){
                                            $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti2 = $this->db->query($sqlTesti2);
            									if($resultTesti2->num_rows > 0){
            										$rowTesti2 = mysqli_fetch_array($resultTesti2);
            										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
            										unlink('../'.$thisTesti2);
            									}
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            	            	}
            	            	if( $checkbox3 == 'on'){
                                            $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti3 = $this->db->query($sqlTesti3);
            									if($resultTesti3->num_rows > 0){
            										$rowTesti3 = mysqli_fetch_array($resultTesti3);
            										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
            										unlink('../'.$thisTesti3);
            									}
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            	            	}
            	            	if( $checkbox4 == 'on'){
                                            $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti4 = $this->db->query($sqlTesti4);
            									if($resultTesti4->num_rows > 0){
            										$rowTesti4 = mysqli_fetch_array($resultTesti4);
            										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
            										unlink('../'.$thisTesti4);
            									}
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            	            	}	            	    
	            	}else{
	            	    
            		            if ($user_testimonial != '') {
            		            	# DELETE PREVIOUS TESTIMONIAL DATA #
            		            	//$this->db->query("DELETE FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '{$user_id}'");
            		            	if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$user_id."'")->num_rows > 0){
            
            		            		if($user_testimonial['user_testimonial1'] != '') {
            								
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti1 = $this->db->query($sqlTesti1);
            									if($resultTesti1->num_rows > 0){
            										$rowTesti1 = mysqli_fetch_array($resultTesti1);
            										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
            										unlink('../'.$thisTesti1);
            									}
                                            /* END - fadhli */
            								
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            							}
            							if($user_testimonial['user_testimonial2'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti2 = $this->db->query($sqlTesti2);
            									if($resultTesti2->num_rows > 0){
            										$rowTesti2 = mysqli_fetch_array($resultTesti2);
            										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
            										unlink('../'.$thisTesti2);
            									}
                                            /* END - fadhli */
            								
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            							}
            							if($user_testimonial['user_testimonial3'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti3 = $this->db->query($sqlTesti3);
            									if($resultTesti3->num_rows > 0){
            										$rowTesti3 = mysqli_fetch_array($resultTesti3);
            										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
            										unlink('../'.$thisTesti3);
            									}
                                            /* END - fadhli */
            						
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            							}
            							if($user_testimonial['user_testimonial4'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $user_id";
                                            $resultTesti4 = $this->db->query($sqlTesti4);
            									if($resultTesti4->num_rows > 0){
            										$rowTesti4 = mysqli_fetch_array($resultTesti4);
            										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
            										unlink('../'.$thisTesti4);
            									}
                                            /* END - fadhli */
            							
            								//$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $user_id");
            								if ($this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $user_id")){} else {
												$er++;
            								}
            							}
            
            		            	}
            		            	else{
            		            		if($this->db->query("INSERT INTO ".DB_PREFIX."_user_testimonial(ut_u_id,ut_user_testimonial1,ut_user_testimonial2,ut_user_testimonial3,ut_user_testimonial4,ut_create_date) VALUES('".$user_id."','".$user_testimonial['user_testimonial1']."','".$user_testimonial['user_testimonial2']."','".$user_testimonial['user_testimonial3']."','".$user_testimonial['user_testimonial4']."','".date('Y-m-d H:i:s')."')")){}
            		            			else{
            		            				$er++;
            		            			}
            
            		            	}
            			            /*foreach ($user_testimonial as $key => $testimonial) {
            			            	$testimonialSql = "INSERT INTO ".DB_PREFIX."_user_testimonial SET
            							ut_u_id    	   = user_testimonial4,
            							ut_file_path   = '{$testimonial}',
            							ut_create_date = '".date('Y-m-d H:i:s')."'";
            
            							if ($this->db->query($testimonialSql)){} else {
            								$er++;
            							}
            			            }*/
            		            }	            	    
	            	    
	            	}
	            	
	            	
	            	
	            	


	            	if ($er == 0) {
	            		$res = array('flag' => 'success', 'message' => 'Your profile has been updated', 'data' => $user_id);
	            	} else {
			        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
			        }
		        	
		        } else {
		        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
		        }
            } else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
	        
        }

		return $res;
	}

	public function GetUserTestimonial($user_id = NULL, $limit = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_user_testimonial";
		if ($user_id != '') {
			$sql .= " WHERE ut_u_id = {$user_id}";
		}

		$sql .= " ORDER BY ut_id DESC";

		if ($limit != '') {
			$sql .= " LIMIT 0, {$limit}";
		}

		return $this->db->query($sql);
	}

	public function UpdatePassword($data) {

        $user_id 	  = $data['user_id'];
        $old_password = $data['old_password'];
        $new_password = $data['new_password'];
        $con_password = $data['confirm_password'];

        $chk = "SELECT * FROM ".DB_PREFIX."_user WHERE 
        u_id = '".$user_id."' AND 
        u_password = '".md5($old_password)."'";

        $qry = $this->db->query($chk);
        if ($qry->num_rows == 0) {
        	$res = array('flag' => 'error', 'message' => 'Old password mismatch.');
        } elseif($new_password != $con_password){
        	$res = array('flag' => 'error', 'message' => 'Password mismatch.');
        } else {

            $sqly = "UPDATE ".DB_PREFIX."_user SET 
				u_password = '".md5($new_password)."' 
                WHERE u_id = '".$user_id."'";

            if($this->db->query($sqly)){
            	$res = array('flag' => 'success', 'message' => 'You have successfully changed your password');
            } else {
            	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
            }            
        }

        return $res;
    }
// luqman
/*
    public function ForgetPassword($data){
    	$email = isset($data['u_email']) ? $data['u_email'] : '';

    	if($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
        } else {

	        $sql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id 
	        WHERE u_email = '{$email}' AND u_status <> 'D'";

	        $qry = $this->db->query($sql);
	        
	        if ($qry->num_rows == 0) {
	            $res = array('flag' => 'error', 'message' => 'Email does not exists in our record.');
	        } else {

	        if($qry){//kalau email ada
	        	$bansql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        	INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id 
	        	WHERE u_email = '{$email}' AND u_status = 'B' AND U.u_role = 3";

	        	$banqry = $this->db->query($bansql);//tutor kena ban

	        	$banparsql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        	INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id 
	        	WHERE u_email = '{$email}' AND u_status = 'B' AND U.u_role = 4";

	        	$banparqry = $this->db->query($banparsql);//parent kena ban

	        	$normparsql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        	INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id 
	        	WHERE u_email = '{$email}' AND u_status = 'A' AND U.u_role = 4";

	        	$normparqry = $this->db->query($normparsql);//normal parent


	        	// $fh = fopen('textfilebaru.txt', 'w');
          //       fwrite($fh, $normparsql);

	        	if ($banqry->num_rows === 0 && $normparqry->num_rows === 0 && $banparqry->num_rows === 0) {//tutor

	        		$row = $qry->fetch_array(MYSQLI_ASSOC);

	            $new_password = $this->handler->getRandNum(6);

	            $sqly = "UPDATE ".DB_PREFIX."_user SET 
					u_password = '".md5($new_password)."' 
	                WHERE u_id = '".$row['u_id']."'";

	            $emailBody = "Your new password to login into system is: ". $new_password;
	            $email = $this->handler->sendEmail($row['ud_first_name'], $row['u_email'], 'Forgot Password', $emailBody);

	            $result = $this->db->query($sqly);

	            $res = array('flag' => 'success', 'message' => 'Email Sent Successfully.');	        	
	        	
	    }elseif($banparqry->num_rows > 0 || $normparqry->num_rows > 0) {//parent $banparqry->num_rows > 0 || $banparqry->num_rows === 0 klu nk parent dua dapat mesej je xda send email

	        		$res = array('flag' => 'error', 'message' => 'Please contact our Finance Manager at 019-3613956 to get your new password. Thank you.');

	    }else{//tutor
	    	$res = array('flag' => 'error', 'message' => 'Your account have been deactivated. Please send an email to contact@tutorkami.com for further enquiry. Thank you.');
	    	
	    }


	}//kalau email ada
	        }
	    }

        return $res;
    }
*/
    public function ForgetPassword($data){
    	$email = isset($data['u_email']) ? $data['u_email'] : '';

    	if($email == '') {
        	$res = array('flag' => 'error', 'message' => 'Email is required.');
        } else {

	        $sql = "SELECT * FROM ".DB_PREFIX."_user AS U 
	        INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id 
	        WHERE 
		        u_status <> 'D' AND (
		            U.u_email = '{$email}' || 
		            U.u_username = '{$email}' || 
		            UD.ud_last_name = '{$email}'
		        )";

	        $qry = $this->db->query($sql);
	        
	        if ($qry->num_rows == 0) {
	            $res = array('flag' => 'error', 'message' => 'Invalid Email. Please send an email to contact@tutorkami.com for further enquiry. Thank you.');
	        } else {

				if($qry){//kalau email ada
					
					$row = $qry->fetch_array(MYSQLI_ASSOC);
					
					$new_password = $this->handler->getRandNum(6);
				
					if( $row['u_status'] = 'A' ){
					    if( $row['u_role'] == '4' ){ //parent
					        $to = $row['ud_last_name'];
					        
                    		$welcome_content = 'Salam/Hi '.$row['salutation'].' '.$row['ud_first_name'].',<br><br>Your temporary password is: <br>'. $new_password.'<br><br>Please login using your email and this temporary password. After login, please change your password. <br><br>Thank you.<br>Admin TutorKami.com
                			<br><br> <a href="tutorkami.com" target="_blank"><img src="' . APP_ROOT . 'admin/upload/logo3.png" style="max-width: 300px" /></a>';
                			
					    }else if( $row['u_role'] == '3' ){ //tutor
					        $to = $row['u_email'];
					        
                    		$welcome_content = 'Salam/Hi '.$row['u_displayname'].',<br><br>Your temporary password is: <br>'. $new_password.'<br><br>Please login using your email and this temporary password. After login, please change your password. <br><br>Thank you.<br>Admin TutorKami.com
                			<br><br> <a href="tutorkami.com" target="_blank"><img src="' . APP_ROOT . 'admin/upload/logo3.png" style="max-width: 300px" /></a>';
            			
					    }else{
					        $res = array('flag' => 'error', 'message' => 'Please send an email to contact@tutorkami.com for further enquiry. Thank you.');
					    }
					    
						$sqly = "UPDATE ".DB_PREFIX."_user SET u_password = '".md5($new_password)."' WHERE u_id = '".$row['u_id']."'";
						$result = $this->db->query($sqly);

						$welcome_subject = 'Reset Password - TutorKami';

                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: Tutorkami <contact@tutorkami.com>' . "\r\n" .
                        'Reply-To: contact@tutorkami.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
						
						mail($to, $welcome_subject, $welcome_content, $headers, '-fcontact@tutorkami.com');
						
						$res = array('flag' => 'success', 'message' => 'Email Sent Successfully.');	 
						
					}else if( $row['u_status'] = 'B' ){
						$res = array('flag' => 'error', 'message' => 'Your account have been deactivated. Please send an email to contact@tutorkami.com for further enquiry. Thank you.');
					}else{
						$res = array('flag' => 'error', 'message' => 'Please send an email to contact@tutorkami.com for further enquiry. Thank you.');
					}
				
				}
	        }
	    }

        return $res;
    }
    
// luqman
	public function ListCountry($country_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_countries";
		if ($country_id != '') {
			$sql .= " WHERE c_id = {$country_id}";
		}

		return $this->db->query($sql);
	}

	public function ListState($state_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_states";
		if ($state_id != '') {
			$sql .= " WHERE st_id = {$state_id}";
		}
		return $this->db->query($sql);
	}
	
	public function CountryWiseState($country_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_states WHERE st_c_id = {$country_id}";
		return $this->db->query($sql);
	}
	
	public function ListCity($city_id = NULL, $city_name = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_status = 1";
		if ($city_id != '') {
			$sql .= " AND city_id = {$city_id}";
		}
		if ($city_name != '') {
			$sql .= " AND city_name LIKE '%{$city_name}%'";
		}
    $sql .= " ORDER BY city_name ASC";
		return $this->db->query($sql);
	}

	public function StateWiseCity($state_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_st_id = {$state_id}";
		$sql .= " ORDER BY city_name ASC";
		return $this->db->query($sql);
	}

	public function SearchLocation($data) {
		
		$arrJob = array();
		$search_keyword = isset($data['term']) ? $this->RealEscape($data['term']) : '';

		$sql = "SELECT
		    city_id,
		    city_name,
		    st_id,
		    st_name
		FROM
		    ".DB_PREFIX."_cities AS CT
		INNER JOIN ".DB_PREFIX."_states AS ST
		ON
		    ST.st_id = CT.city_st_id
		INNER JOIN ".DB_PREFIX."_countries AS CN
		ON
		    CN.c_id = ST.st_c_id
		WHERE
		    CN.c_id = 150";

		if ($search_keyword != '') {
			$sql .= " AND (ST.st_name LIKE '%{$search_keyword}%' OR CT.city_name LIKE '%{$search_keyword}%')";
		}

		$sql .= " ORDER BY ST.st_id ASC";

		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
            while ( $row = $qry->fetch_assoc() ) {
            	$search_arr = array("id" => $row['st_id'].'||'.$row['city_id'], "label" => $row['city_name'].', '.$row['st_name'], "value" => $row['city_name']);
            	array_push($arrJob, $search_arr);
            }
        }

        $sql1 = "SELECT
		    city_id,
		    city_name,
		    st_id,
		    st_name,
		    tac_other
		FROM
		    ".DB_PREFIX."_cities AS CT
		INNER JOIN ".DB_PREFIX."_states AS ST
		ON
		    ST.st_id = CT.city_st_id
		INNER JOIN ".DB_PREFIX."_countries AS CN
		ON
		    CN.c_id = ST.st_c_id
		INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC
		ON
		    TAC.tac_st_id = ST.st_id
		WHERE
		    CN.c_id = 150";

		if ($search_keyword != '') {
			$sql1 .= " AND (TAC.tac_other LIKE '%{$search_keyword}%')";
		}

		$sql1 .= " GROUP BY ST.st_id";

		$qry1 = $this->db->query($sql1);
		if ($qry1->num_rows > 0) {
            while ( $row1 = $qry1->fetch_assoc() ) {
            	$search_arr1 = array("id" => $row1['st_id'].'||'.$row1['city_id'], "label" => $row1['tac_other'].', '.$row1['st_name'], "value" => $row1['tac_other']);
            	array_push($arrJob, $search_arr1);
            }
        }

		return $arrJob;
	}

	public function SearchSubject($data) {
		
		$arrSub = array();
		$search_keyword = isset($data['term']) ? $this->RealEscape($data['term']) : '';

		$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject";
		$sql .= " INNER JOIN ".DB_PREFIX."_tution_course ON tc_id = ts_tc_id";
		
		if ($search_keyword != '') {
			$sql .= " WHERE (ts_title LIKE '%{$search_keyword}%' OR ts_description LIKE '%{$search_keyword}%')";
		}
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
            while ( $row = $qry->fetch_assoc() ) {
            	$search_arr = array("id" => $row['tc_id'].'||'.$row['ts_id'], "label" => $row['tc_title'].' - '.$row['ts_title'].' ['.$row['ts_description'].']', "value" => $row['ts_title']);
            	array_push($arrSub, $search_arr);
            }
        }

        // 
		$sql1 = "SELECT * FROM ".DB_PREFIX."_tutor_subject";
        $sql1 .= " INNER JOIN ".DB_PREFIX."_tution_course ON tc_id = trs_tc_id";

        if($search_keyword != ''){
        	$sql1 .= " WHERE (trs_other LIKE '%{$search_keyword}%')";
        }
		$qry1 = $this->db->query($sql1);

        if($qry1->num_rows > 0){
        	while ( $row1 = $qry1->fetch_assoc() ) {
            	$search_arr1 = array("id" => $row1['tc_id'].'||'.$row1['trs_ts_id'], "label" => $row1['tc_title'].' - '.$row1['trs_other'], "value" => $row1['trs_other']);
            	array_push($arrSub, $search_arr1);
            }
        }

		return $arrSub;
	}

	public function ListCourse($course_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tution_course";
		if ($course_id != '') {
			$sql .= " WHERE tc_id = {$course_id}";
		}

		return $this->db->query($sql);
	}

	public function ListSubject($subject_id = NULL, $subject_title = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject WHERE ts_status = 'A'";
		if ($subject_id != '') {
			$sql .= " AND ts_id = {$subject_id}";
		}
		if ($subject_title != '') {
			$sql .= " AND (ts_title LIKE '%{$subject_title}%' OR ts_description LIKE '%{$subject_title}%')";
		}

		return $this->db->query($sql);
	}

// luqman
	public function CourseWiseSubject($course_id = NULL) {

		$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject";
		if ($course_id != '') {
			$sql .= " WHERE ts_tc_id = {$course_id} ";
					    // $fh = fopen("textfilebaru.txt", "w") or die("Unable to open file!");
         //    fwrite($fh, $sql);//ada value
		}

		return $this->db->query($sql);

	}

 // public function CourseWiseSubject($course_id = NULL) {
	// $user_id = 666;
	// 	$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject";
	// 	if ($user_id != '') {
	// 		$sql .= " WHERE trs_u_id = {$user_id}";
	// 	    // $fh = fopen("textfilebaru.txt", "w") or die("Unable to open file!");
 //      //       fwrite($fh, $sql);
	// 	}else{
	// 		echo "takda userid";
	// 	}


	// 	return $this->db->query($sql);
	// }
// luqman
	
	public function UserWiseState($user_id, $state_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_area_cover";
		if ($user_id != '' && $state_id != '') {
			$sql .= " WHERE tac_u_id = {$user_id} AND tac_st_id = {$state_id}";
		}

		return $this->db->query($sql);
	}
		
	public function UserWiseCity($user_id, $city_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_area_cover";
		if ($user_id != '' && $city_id != '') {
			$sql .= " WHERE tac_u_id = {$user_id} AND tac_city_id = {$city_id}";
		}

		return $this->db->query($sql);
	}
		
	public function UserWiseCourse($user_id, $course_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject";
		if ($user_id != '' && $course_id != '') {
			$sql .= " WHERE trs_u_id = {$user_id} AND trs_tc_id = {$course_id}";
		}

		return $this->db->query($sql);
	}
	
	public function UserWiseSubject($user_id, $subject_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject";
		if ($user_id != '' && $subject_id != '') {
			$sql .= " WHERE trs_u_id = {$user_id} AND trs_ts_id = {$subject_id}";
		}

		return $this->db->query($sql);
	}

    public function SearchTutor($data) {
		$subject = isset($data['subject']) ? $this->RealEscape($data['subject']) : '';
		$location = isset($data['location']) ? $this->RealEscape($data['location']) : '';
		$gender = isset($data['u_gender']) ? $this->RealEscape($data['u_gender']) : '';
		$ud_race = isset($data['ud_race']) ? $this->RealEscape($data['ud_race']) : '';
		$ud_current_occupation = isset($data['ud_current_occupation']) ? $this->RealEscape($data['ud_current_occupation']) : '';
		$ud_tutor_status = isset($data['ud_tutor_status']) ? $this->RealEscape($data['ud_tutor_status']) : '';
		$tution_center = isset($data['tution_center']) ? $this->RealEscape($data['tution_center']) 	: '';

		$qry = "SELECT U.u_id, U.u_email, U.u_displayname, U.u_displayid, U.u_gender, U.u_profile_pic, CT.city_name, UD.ud_current_occupation, UD.ud_tutor_status,
			AVG(RR.rr_rating) as average_rating FROM ".DB_PREFIX."_user AS U 
			INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id 
			LEFT JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id  
			LEFT JOIN ".DB_PREFIX."_tution_subject AS TS ON TS.ts_id = TRS.trs_ts_id  
			LEFT JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id";

		if($subject != ''|| $location != '')	
		  $qry .=	" LEFT JOIN ".DB_PREFIX."_cities AS CT ON CT.city_id = TAC.tac_city_id";
        else{

		  $qry .=	" LEFT JOIN ".DB_PREFIX."_cities AS CT ON CT.city_id = UD.ud_city";   	
        }
        $qry .=  " LEFT JOIN ".DB_PREFIX."_review_rating AS RR ON RR.rr_tutor_id = U.u_id";
		$qry .= " WHERE U.u_role = '3' AND U.u_status = 'A'";

        // COVER AREA
        $area_count = 0;
        if (isset($data['cover_area_state']) && count($data['cover_area_state']) > 0) {
    		foreach ($data['cover_area_state'] as $cid) {
    			$qry .= " AND TAC.tac_st_id = '{$cid}'";

    			if (isset($data['cover_area_city_'.$cid]) && count($data['cover_area_city_'.$cid]) > 0) {
    				$area_count = count($data['cover_area_city_'.$cid]);
    				$area_ids = implode(',', $data['cover_area_city_'.$cid]);

    				$qry .= " AND TAC.tac_city_id IN({$area_ids})";                    
                }
            }
    	}

    	// OTHER LOCATION
        if ($location != '') {
            // $qry .= " AND UD.ud_city LIKE '%{$location}%'";
            $qry .= " AND (CT.city_name LIKE '%{$location}%' OR TAC.tac_other LIKE '%{$location}%')";
        }

        // SUBJECT
        $subject_count = 0;
        if (isset($data['tutor_course']) && count($data['tutor_course']) > 0) {
    		foreach ($data['tutor_course'] as $cid) {
    			$qry .= " AND TRS.trs_tc_id = '{$cid}'";
    			if (isset($data['tutor_subject_'.$cid]) && count($data['tutor_subject_'.$cid]) > 0) {
    				$subject_count = count($data['tutor_subject_'.$cid]);
    				$subject_ids = implode(',', $data['tutor_subject_'.$cid]);

    				$qry .= " AND TRS.trs_ts_id IN({$subject_ids})";                    
                }
            }
    	}

    	// OTHER SUBJECT
    	if ($subject != '') {
    		$qry .= " AND (TS.ts_title LIKE '%{$subject}%' OR TS.ts_description LIKE '%{$subject}%' OR TRS.trs_other LIKE '%{$subject}%')";
    	}

    	// GENDER
        if ($gender != '') {
            $qry .= " AND U.u_gender = '".stripslashes($gender)."'";
        }

        // RACE
        if ($ud_race != '') {
        	if ($ud_race == 'Others') {
        		$qry .= " AND UD.ud_race != 'Malay' AND UD.ud_race != 'Chinese' AND UD.ud_race != 'Indian'";
        	} else{
            	$qry .= " AND UD.ud_race = '".stripslashes($ud_race)."'";
        	}
        }

        // OCCUPATION
        if ($ud_current_occupation != '') {
        	if ($ud_current_occupation == 'Other') {
        		$qry .= " AND UD.ud_current_occupation != 'Full-time tutor' AND 
        		UD.ud_current_occupation != 'Kindergarten teacher' AND 
        		UD.ud_current_occupation != 'Primary school teacher' AND 
        		UD.ud_current_occupation != 'Secondary school teacher' AND 
        		UD.ud_current_occupation != 'Tuition center teacher' AND 
        		UD.ud_current_occupation != 'Lacturer' AND 
        		UD.ud_current_occupation != 'Ex-teacher' AND 
        		UD.ud_current_occupation != 'Retired teacher'";
        	} else {
            	$qry .= " AND UD.ud_current_occupation = '".stripslashes($ud_current_occupation)."'";
        	}
        }

        // TUTOR STATUS
        if ($ud_tutor_status != '') {
            $qry .= " AND UD.ud_tutor_status IN (".stripslashes($ud_tutor_status).")";
        }

        // WILL TEACH AT TUITION CENTER
        if ($tution_center != '') {
        	if ($tution_center == '1') {
        		$qry .= " AND UD.ud_client_status = 'Tuition Centre'";
        	} elseif ($tution_center == '0') {
        		$qry .= " AND UD.ud_client_status != 'Tuition Centre'";
            }
        }
        
        $qry .= " GROUP BY U.u_id";
        if ($area_count > 0 || $subject_count > 0) {
        	$qry .= " HAVING";
        	$qry .= ($area_count > 0) ? " COUNT(DISTINCT TAC.tac_city_id) = $area_count" : "";
        	$qry .= ($area_count > 0 && $subject_count > 0) ? " AND" : "";
        	$qry .= ($subject_count > 0) ? " COUNT(DISTINCT TRS.trs_ts_id) = $subject_count" : "";

        }
        $qry .= " ORDER BY U.u_id DESC";

		return $this->db->query($qry);
	}

// luqman
	public function TutorRequest($data) {
		$tr_name 				= isset($data['tr_name']) 				? $this->RealEscape($data['tr_name']) 				: '';
		$tr_name2 				= isset($data['tr_name2']) 				? $this->RealEscape($data['tr_name2']) 				: '';
		$tr_location 			= isset($data['tr_location']) 			? $this->RealEscape($data['tr_location']) 			: '';
		$tr_phone_number 		= isset($data['tr_phone_number']) 		? $this->RealEscape($data['tr_phone_number']) 		: '';
		$tr_subject 			= isset($data['tr_subject']) 			? $this->RealEscape($data['tr_subject']) 			: '';
		$tr_additional_comment 	= isset($data['tr_additional_comment']) ? $this->RealEscape($data['tr_additional_comment']) : '';
		$tr_status 				= 'Active';
		//$tr_create_date 		= date('Y-m-d');
		$tr_create_date 		= date('Y-m-d H:i:s');
if($tr_name2 == ''){

		if ($tr_name == '') {
        	$res = array('flag' => 'error', 'message' => 'Name is required.');
        } elseif ($tr_location == '') {
        	$res = array('flag' => 'error', 'message' => 'Location is required.');
        } elseif ($tr_phone_number == '') {
        	$res = array('flag' => 'error', 'message' => 'Phone number is required.');
        } elseif ($tr_subject == '') {
        	$res = array('flag' => 'error', 'message' => 'Subject is required.');
        } else{
			$sql = "INSERT INTO ".DB_PREFIX."_tutor_request SET 
			    tr_name 				= '".$tr_name."',
			    tr_location 			= '".$tr_location."',
			    tr_phone_number 		= '".$tr_phone_number."',
			    tr_subject 				= '".$tr_subject."',
			    tr_additional_comment 	= '".$tr_additional_comment."',
			    tr_status 				= '".$tr_status."',
			    tr_create_date  		= '".$tr_create_date."'";

			$exe = $this->db->query($sql);

			if ($exe) {
				$insert_id = $this->db->insert_id;
        		$res = array('flag' => 'success', 'message' => 'Thank you for the request. Our team will get back to you shortly.', 'data' => $insert_id);

        		if($res){
        			if (preg_match( "/[\r\n]/", $tr_name ) || preg_match( "/[\r\n]/", $tr_location) || preg_match( "/[\r\n]/", $tr_phone_number) || preg_match( "/[\r\n]/", $tr_subject) || preg_match( "/[\r\n]/", $tr_additional_comment)) { 
 						   $res = array('flag' => 'error', 'message' => 'Error sending email.');
					}else{
						//$to      = 'contact@tutorkami.com';
						$to      = 'tutor.hambal@gmail.com, tkcoordinator.malaysia@gmail.com, tkcoordinator2.malaysia@gmail.com, tkcoordinator3.malaysia@gmail.com';
						$subject = 'Request A Tutor Form';
						$htmlContent = '
    <html>
    <body>
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">
            <tr>
                <th>Name:</th><td>'.$tr_name.'</td>
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>Lokasi:</th><td>'.$tr_location.'</td>
            </tr>
            <tr>
                <th>Phone Number:</th><td>'.$tr_phone_number.'</td>
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>Subjek:</th><td>'.$tr_subject.'</td>
            </tr>
            <tr>
                <th>Komen Tambahan:</th><td>'.$tr_additional_comment.'</td>
            </tr>
        </table>
                <h2>This email is for Administrator!</h2>
				<h4>Please click this <a target="_blank" href="https://www.tutorkami.com/admin/tutor-request-list">link</a> to access page</h4>
    </body>
    </html>';

$headers = 'From: Tutorkami' . "\r\n" .
				    				'Reply-To: webmaster@example.com' . "\r\n" .
				    				'X-Mailer: PHP/' . phpversion();
// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						
				    	

								mail($to, $subject, $htmlContent, $headers);
				    				// $send = $this->handler->mailGunEmail($to, $subject, $emailBody, $headers);
					}
        		}
        			
        	} else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
        }

        return $res;
}
	}
	// luqman
	

	public function TutorRequest2($data) {
		$tr_name 				= isset($data['tr_name']) 				? $this->RealEscape($data['tr_name']) 				: '';
		$tr_phone_number 		= isset($data['tr_phone_number']) 		? $this->RealEscape($data['tr_phone_number']) 		: '';

		$tr_additional_comment 	= 'From FB tutor page';
		$tr_status 				= 'Active';
		$tr_create_date 		= date('Y-m-d H:i:s');
		
            		if ($tr_name == '') {
                    	$res = array('flag' => 'error', 'message' => 'Name is required.');
                    }  elseif ($tr_phone_number == '') {
                    	$res = array('flag' => 'error', 'message' => 'Phone number is required.');
                    }  else{
            			$sql = "INSERT INTO ".DB_PREFIX."_tutor_request SET 
            			    tr_name 				= '".$tr_name."',
            			    tr_location 			= '',
            			    tr_phone_number 		= '".$tr_phone_number."',
            			    tr_subject 				= '',
            			    tr_additional_comment 	= '".$tr_additional_comment."',
            			    tr_status 				= '".$tr_status."',
            			    tr_create_date  		= '".$tr_create_date."'";
            
            			$exe = $this->db->query($sql);
            
            			if ($exe) {
            				$insert_id = $this->db->insert_id;
                    		$res = array('flag' => 'success', 'message' => 'Thank you for the request. Our team will get back to you shortly.', 'data' => $insert_id);
            
                    		if($res){
                    		}
                    			
                    	} else {
            	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
            	        }
                    }
                    return $res;
            
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function TutorWiseClasses($user_id, $class_id = NULL, $display_id = NULL) {
		$sql = "SELECT C.*, UD.*, U.u_username, U.u_displayname, U.u_gender, TS.ts_title FROM ".DB_PREFIX."_classes AS C";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user AS U ON U.u_id = C.cl_student_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_tution_subject AS TS ON TS.ts_id = C.cl_subject_id";
		if ($user_id != '') {
			$sql .= " WHERE cl_tutor_id = {$user_id}";
		}
		if ($class_id != '') {
			$sql .= " AND cl_id = {$class_id}";
		}
		if ($display_id != '') {
			$sql .= " AND cl_display_id = {$display_id}";
		}

		return $this->db->query($sql);
	}
	
	public function StudentWiseClasses($user_id, $class_id = NULL) {
		$sql = "SELECT C.*, UD.*, JOB.*, U.u_username, U.u_displayname, U.u_displayid, U.resit_pv_name, TS.ts_title FROM ".DB_PREFIX."_classes AS C";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user AS U ON U.u_id = C.cl_tutor_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_tution_subject AS TS ON TS.ts_id = C.cl_subject_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_job AS JOB ON JOB.j_id = C.cl_display_id"; // add new
		if ($user_id != '') {
			$sql .= " WHERE   cl_student_id = {$user_id}";
		}
		if ($class_id != '') {
			$sql .= " AND cl_id = {$class_id}";
		}

		return $this->db->query($sql);
	}
	
	public function UserWisePaymentHistory($user_id) {
		$sql = "SELECT PH.*, U.u_username, U.u_displayname FROM ".DB_PREFIX."_payment_history AS PH";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user AS U ON U.u_id = PH.ph_user_id";
		if ($user_id != '') {
			$sql .= " WHERE PH.ph_user_type = '4' AND PH.ph_user_id = {$user_id}";
		}

		return $this->db->query($sql);
	}
	
	public function ClassWiseRecord($class_id = NULL, $student_id = NULL, $tutor_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_classes_record AS CR";
		$sql .= " INNER JOIN ".DB_PREFIX."_classes AS C ON C.cl_id = CR.cr_cl_id";
		$sql .= " WHERE CR.cr_cl_id != ''";

		if ($class_id != '') {
			$sql .= " AND CR.cr_cl_id = {$class_id}";
		}
		if ($student_id != '') {
			$sql .= " AND C.cl_student_id = {$student_id}";
		}
		if ($tutor_id != '') {
			$sql .= " AND C.cl_tutor_id = {$tutor_id}";
		}
		
		$sql .= " AND CR.current_cycle NOT LIKE '%temp%' ";
		
		//$sql .= " ORDER BY cr_id DESC";
		$sql .= " ORDER BY cr_date DESC, cr_start_time DESC ";

		return $this->db->query($sql);
	}




public function AddRecord($data) {
	
	$cr_cl_id			= isset($data['class_id']) 			? $this->RealEscape($data['class_id']) 			: '';
	$oldDateFormat      = isset($data['record_date']) 		? $this->RealEscape($data['record_date']) 		: '';
	$newFormat = explode('/', $oldDateFormat);
	$cr_date = $newFormat[2].'-'.$newFormat[1].'-'.$newFormat[0];
		
	$cr_start_time 	 	= isset($data['record_start_time']) ? $this->RealEscape($data['record_start_time']) : '';
	$cr_end_time		= isset($data['record_end_time']) 	? $this->RealEscape($data['record_end_time']) 	: '';
	$cr_duration		= isset($data['total_duration']) 	? $this->RealEscape($data['total_duration']) 	: '';
		
	$cr_tutor_report	= isset($data['record_remark']) 	? $this->RealEscape($data['record_remark']) 	: '';
	$cr_create_date 	= date('Y-m-d H:i:s');

	function is_positive_integer($str) {
		return (is_numeric($str) && $str > 0 && $str == round($str));
	}
	
	//echo convertToHoursMins(250, '%02d hours %02d minutes'); // should output 4 hours 17 minutes
	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
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
	

	$balanceClasses = "SELECT cl_display_id, cl_hours_balance, cl_cycle FROM tk_classes WHERE cl_id ='$cr_cl_id'";
	$resultBalanceClasses = $this->db->query($balanceClasses);
	$rowBalanceClasses = $resultBalanceClasses->fetch_array(MYSQLI_ASSOC);

	//$qry = "SELECT * FROM tk_classes_record WHERE cr_cl_id ='$cr_cl_id' ORDER BY cr_id DESC ";
	$qry = "SELECT * FROM tk_classes_record WHERE cr_cl_id ='$cr_cl_id' ORDER BY cr_date DESC, cr_start_time DESC ";
	$result = $this->db->query($qry);
	if($result->num_rows > 0){
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		if($row["cr_status"] == 'new Cycle'){
			
			$noCycle = $row["cr_classes"];
			$num1 = $rowBalanceClasses["cl_hours_balance"];
			$num2 = number_format($num1, 2);
			$first = strtok($num2, '.');
			$second = substr($num1, strrpos($num1, '.') + 1);
			$totalmin = (($first * 60) + $second);
		
			$mystring = $cr_duration;
			$mystring = str_replace(" hours & ",".",$mystring);
			$mystring = str_replace(" minutes","",$mystring);
			$num3 = number_format($mystring, 2);
			$otherfirst = strtok($num3, '.');
			$othersecond = substr($num3, strrpos($num3, '.') + 1);
			$othertotalmin = (($otherfirst * 60) + $othersecond);
		
			$thisminutes =  $totalmin - $othertotalmin;
			if( $thisminutes < 0 ){
				$total_cycle = $rowBalanceClasses["cl_hours_balance"];
				$negativepositive =  abs($thisminutes);
				$balance = convertToHoursMins($negativepositive, '%02d.%02d');
				$balance = "-".$balance;
				$status = "new";
				$classes = $noCycle;
			}else{
				$total_cycle = $rowBalanceClasses["cl_hours_balance"];
				$balance = convertToHoursMins($thisminutes, '%02d.%02d');
				if($balance == '' OR $balance == '0'){
					$balance = "0.00";
					$status = "new";
					$classes = $noCycle;
				}else{
					$balance = $balance;
					$status = "new";
					$classes = $noCycle;
				}
			}
		
		}else{
            /* THIS */
			$noCycle = $row["cr_classes"];
			$num1 = $rowBalanceClasses["cl_hours_balance"];
			if (filter_var($num1, FILTER_VALIDATE_FLOAT) && $num1 > 0) {
				$num2 = number_format($num1, 2);
				$first = strtok($num2, '.');
				$second = substr($num1, strrpos($num1, '.') + 1);
				$totalmin = (($first * 60) + $second);
		
				$mystring = $cr_duration;
				$mystring = str_replace(" hours & ",".",$mystring);
				$mystring = str_replace(" minutes","",$mystring);
				$num3 = number_format($mystring, 2);
				$otherfirst = strtok($num3, '.');
				$othersecond = substr($num3, strrpos($num3, '.') + 1);
				$othertotalmin = (($otherfirst * 60) + $othersecond);
		
				$thisminutes =  $totalmin - $othertotalmin;
				
				$getDigit = floatval($thisminutes);
				if (filter_var($getDigit, FILTER_VALIDATE_FLOAT) && $getDigit > 0) {
					
					if( $thisminutes < 0 ){
						$negativepositive =  abs($thisminutes);
						$balance = convertToHoursMins($negativepositive, '%02d.%02d');
						$balance = "-".$balance;
						$status = "new";
						$classes = $noCycle;
					}else{
						$balance = convertToHoursMins($thisminutes, '%02d.%02d');
						if($balance == '' OR $balance == '0'){
							$balance = "0.00";
							$status = "new";
							$classes = $noCycle;
						}else{
							$balance = $balance;
							$status = "new";
							$classes = $noCycle;
						}
					}
				}else{
				    $balanceClasses2 = "SELECT cl_hours_balance from tk_classes where cl_id ='$cr_cl_id'";
				    $resultBalanceClasses2 = $this->db->query($balanceClasses2);
				    $rowBalanceClasses2 = $resultBalanceClasses2->fetch_array(MYSQLI_ASSOC);
				        if( $rowBalanceClasses2["cl_hours_balance"] == '0.00' OR $rowBalanceClasses2["cl_hours_balance"] < 0 ){
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
				            $balance = "-".$balance;
				            $status = "Required Parent To Pay";
				            $classes = $noCycle;
				        }else{
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
							if($balance == '' OR $balance == '0'){
								$balance = "0.00";
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}else{
								$balance = "-".$balance;
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}
				        }
				}
			}else{
				$thisnum2 = str_replace("-"," ",$num1);
				$num2 = number_format($thisnum2, 2);
				$first = strtok($num2, '.');
				$second = substr($thisnum2, strrpos($thisnum2, '.') + 1);
				$totalmin = (($first * 60) + $second);
		
				$mystring = $cr_duration;
				$mystring = str_replace(" hours & ",".",$mystring);
				$mystring = str_replace(" minutes","",$mystring);
				$num3 = number_format($mystring, 2);
				$otherfirst = strtok($num3, '.');
				$othersecond = substr($num3, strrpos($num3, '.') + 1);
				$othertotalmin = (($otherfirst * 60) + $othersecond);
		
				$thisminutes =  $totalmin + $othertotalmin;
				
				$getDigit = floatval($thisminutes);
				if (filter_var($getDigit, FILTER_VALIDATE_FLOAT) && $getDigit > 0) {
				    
				    $balanceClasses2 = "SELECT cl_hours_balance from tk_classes where cl_id ='$cr_cl_id'";
				    $resultBalanceClasses2 = $this->db->query($balanceClasses2);
				    $rowBalanceClasses2 = $resultBalanceClasses2->fetch_array(MYSQLI_ASSOC);

				        if( $rowBalanceClasses2["cl_hours_balance"] == '0.00' OR $rowBalanceClasses2["cl_hours_balance"] < 0 ){
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
				            $balance = "-".$balance;
				            $status = "Required Parent To Pay";
				            $classes = $noCycle;
				        }else{
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
				            //$balance = "-".$balance;
							if($balance == '' OR $balance == '0'){
								$balance = "0.00";
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}else{
								$balance = "-".$balance;
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}
				        }
				}else{
				    $balanceClasses2 = "SELECT cl_hours_balance from tk_classes where cl_id ='$cr_cl_id'";
				    $resultBalanceClasses2 = $this->db->query($balanceClasses2);
				    $rowBalanceClasses2 = $resultBalanceClasses2->fetch_array(MYSQLI_ASSOC);
						if( $rowBalanceClasses2["cl_hours_balance"] == '0.00' OR $rowBalanceClasses2["cl_hours_balance"] < 0 ){
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
				            $balance = "-".$balance;
				            $status = "Required Parent To Pay";
				            $classes = $noCycle;
				        }else{
				            $negativepositive =  abs($thisminutes);
				            $balance = convertToHoursMins($negativepositive, '%02d.%02d');
				            //$balance = "-".$balance;
							if($balance == '' OR $balance == '0'){
								$balance = "0.00";
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}else{
								$balance = "-".$balance;
								$status = "FM to pay tutor";
								$classes = $noCycle;
							}
				        }
				}
			}
			$total_cycle = $rowBalanceClasses["cl_hours_balance"];
		/* THIS */
		}
		
    /* new record */
	}else{
		$total_cycle	= isset($data['total_cycle']) 	? $this->RealEscape($data['total_cycle']) 	: '';
		
		$num1 = $total_cycle; 
		$num2 = number_format($num1, 2);
		$first = strtok($num2, '.');
		$second = substr($num1, strrpos($num1, '.') + 1);
		$totalmin = (($first * 60) + $second);
		
		$mystring = $cr_duration;
		$mystring = str_replace(" hours & ",".",$mystring);
		$mystring = str_replace(" minutes","",$mystring);
		$num3 = number_format($mystring, 2);
		$otherfirst = strtok($num3, '.');
		$othersecond = substr($num3, strrpos($num3, '.') + 1);
		$othertotalmin = (($otherfirst * 60) + $othersecond);
		
		$thisminutes =  $totalmin - $othertotalmin;

		if( $thisminutes < 0 ){
			$negativepositive =  abs($thisminutes);
			$balance = convertToHoursMins($negativepositive, '%02d.%02d');
			$balance = "-".$balance;
			$status = "new";
			$classes = "1";
		}else{
			$balance = convertToHoursMins($thisminutes, '%02d.%02d');
			//if($balance == '' OR $balance == '0'){
			if($balance == '' || $balance == '0'){
				$balance = "0.00";
				$status = "new";
				$classes = "1";
			}else{
				$balance = $balance;
				$status = "new";
				$classes = "1";
			}
		}	
	}

    /* START - SAVE ALL RECORD */
	if ($cr_date == '') {
		$res = array('flag' => 'error', 'message' => 'Date is required.');
	} elseif ($cr_start_time == '') {
		$res = array('flag' => 'error', 'message' => 'Start time is required.');
	} elseif ($cr_end_time == '') {
		$res = array('flag' => 'error', 'message' => 'End time is required.');
	} else{

        // 11 Issues Nov 2020 = generate resit = if($resultCekTemp->num_rows > 0){
		$qCekTemp = " SELECT * FROM tk_classes_record WHERE cr_cl_id = '".$cr_cl_id."' AND current_cycle LIKE '%temp%' ";
		$resultCekTemp = $this->db->query($qCekTemp);
		if($resultCekTemp->num_rows > 0){
		    $rowCekTemp = $resultCekTemp->fetch_array(MYSQLI_ASSOC);

		    $DigitNewCycle = (int) filter_var(preg_replace('/\D/', '', $rowCekTemp['current_cycle']), FILTER_SANITIZE_NUMBER_INT);
		    
		    $latestBalance =  $balance;
					
		    $convertNegative = abs($latestBalance);
		    $balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
		    $balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
						
		    $cycleHourTwoDecimalPlaces = number_format((float)$DigitNewCycle, 2, '.', '');  // Outputs -> 105.00
		    $cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
						
		    $totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
		    $newBalance2 = (minutesToHours($totalBalanceInMin));
					

            $totalBalance = $newBalance2;
		    
		    $latestCycle = $classes + 1;

        		$updateData = "UPDATE ".DB_PREFIX."_classes_record SET 
            		cr_cl_id 		= '".$cr_cl_id."',
            		cr_date 		= '".$cr_date."',
            		cr_start_time 	= '".$cr_start_time."',
            		cr_end_time 	= '".$cr_end_time."',
            		cr_duration 	= '".$cr_duration."',
            		cr_tutor_report = '".$cr_tutor_report."',
            		cr_create_date  = '".$cr_create_date."',
            		cr_cycle 		= '".$DigitNewCycle."',
            		
            		cr_balance 		= '".$totalBalance."',
            		
            		cr_status 		= 'new Cycle',                            
            		cr_classes 		= '".$latestCycle."',
        		    current_cycle   = 'this'
        		    
        		    WHERE cr_id = '".$rowCekTemp["cr_id"]."'";            
        		$this->db->query($updateData);


					$sqlUpdateBalWhile = "SELECT cr_id, cr_cl_id, cr_status FROM ".DB_PREFIX."_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$cr_cl_id."' ";
					$resultsqlUpdateBalWhile = $this->db->query($sqlUpdateBalWhile);
					if($resultsqlUpdateBalWhile->num_rows > 0){
						while($rowUpdateBalWhile = mysqli_fetch_array($resultsqlUpdateBalWhile)){
							$sqlUpdateBalS = " UPDATE ".DB_PREFIX."_classes_record SET cr_status='yes', cr_classes = '".$latestCycle."' WHERE cr_id='".$rowUpdateBalWhile['cr_id']."' ";
							$this->db->query($sqlUpdateBalS);
						}
					}
					$sqlUpdateBalWhile2 = "SELECT cr_id, cr_cl_id, cr_status, cr_date FROM ".DB_PREFIX."_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$cr_cl_id."' ORDER BY cr_date DESC ";
					$resultsqlUpdateBalWhile2 = $this->db->query($sqlUpdateBalWhile2);
					if($resultsqlUpdateBalWhile2->num_rows > 0){
						$rowUpdateBalWhile2 = mysqli_fetch_array($resultsqlUpdateBalWhile2);
							$sqlUpdateBalS2 = " UPDATE ".DB_PREFIX."_classes_record SET cr_classes = '".$latestCycle."' WHERE cr_id='".$rowUpdateBalWhile2['cr_id']."' ";
							$this->db->query($sqlUpdateBalS2);
						
					}
					$sqlUpdateBal = " UPDATE ".DB_PREFIX."_classes SET cl_hours_balance='".$totalBalance."',cl_cycle='".$DigitNewCycle."'  WHERE cl_id = '".$cr_cl_id."' ";
					if($this->db->query($sqlUpdateBal)){

                    	$qClass = " SELECT cl_id, cl_display_id FROM tk_classes WHERE cl_id = '".$cr_cl_id."' ";
                    	$resultClass = $this->db->query($qClass);
                    	if($resultClass->num_rows > 0){
                    		$rowClass = $resultClass->fetch_array(MYSQLI_ASSOC);
                    
                        	$qJob = " SELECT j_id, j_hired_tutor_email FROM tk_job WHERE j_id = '".$rowClass['cl_display_id']."' ";
                        	$resultJob = $this->db->query($qJob);
                        	if($resultJob->num_rows > 0){
                        		$rowJob = $resultJob->fetch_array(MYSQLI_ASSOC);
                        		
                        		$queryUser = " SELECT u_id, u_email, u_displayname FROM tk_user WHERE u_email='".$rowJob['j_hired_tutor_email']."'  ";
                        		$resultQueryUser = $this->db->query($queryUser); 
                        		if($resultQueryUser->num_rows > 0){ 
                        			$rowQueryUser = $resultQueryUser->fetch_assoc();
                        			$qUser = $rowQueryUser['u_id'];
                        			$u_displayidT = $rowQueryUser['u_displayname'];
            
                        			$queryUserD = " SELECT ud_u_id, ud_first_name, ud_phone_number FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
                        			$resultQueryUserD = $this->db->query($queryUserD); 
                        			if($resultQueryUserD->num_rows > 0){ 
                        				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
                        				$qUserD = $rowQueryUserD['ud_first_name'];
                        				$qUserDT = $rowQueryUserD['ud_phone_number'];
                      					    /*
                    						$args = new stdClass();
                    						$xdata = new stdClass();
                    						$args->to = "6".$qUserDT."@c.us";
                    						$args->content = "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you\r\n- message from Finance Manager TutorKami -\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";
                    						$xdata->args = $args;
                    						
                    						$make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );
                    						*/
                    						$xdata = array( "to" => "6".$rowQueryUserD['ud_phone_number'],
                    						        "message" => "Salam/Hi ".$u_displayidT.", you can proceed to do the next session for job ".$job.". Thank you newLine - message from Finance Manager TutorKami - newLine (This is an auto message from TutorKami.com. Please do not reply to this number) " );
                    						$make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );

                        			}
                        		}
                        	}
                    	}
					    
					    $res = array('flag' => 'success', 'message' => 'Record saved successfully.');
					} else {
        			    $res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
					}

		}else{
		    
            $row_no = 1;
            $queryLastR = " SELECT * FROM ".DB_PREFIX."_classes_record WHERE cr_cl_id = '".$cr_cl_id."' ORDER BY cr_date DESC, cr_start_time DESC ";
            $resultLastR = $this->db->query($queryLastR);
            if($resultLastR->num_rows > 0){
                $rowLastR = $resultLastR->fetch_array(MYSQLI_ASSOC);
                if( $rowLastR['row_no'] != '' ){
                    if( $status == 'Required Parent To Pay' ){
                        $row_no = $rowLastR['row_no'] + 1;
                    }else{
                        $row_no = $rowLastR['row_no'];
                    }
                    
                }else{
                    $row_no = 1;
                }
            }

        		$sql = "INSERT INTO ".DB_PREFIX."_classes_record SET 
        		cr_cl_id 		= '".$cr_cl_id."',
        		cr_date 		= '".$cr_date."',
        		cr_start_time 	= '".$cr_start_time."',
        		cr_end_time 	= '".$cr_end_time."',
        		cr_duration 	= '".$cr_duration."',
        		cr_tutor_report = '".$cr_tutor_report."',
        		cr_create_date  = '".$cr_create_date."',
        		cr_cycle 		= '".$total_cycle."',
        		cr_balance 		= '".$balance."',
        		cr_status 		= '".$status."',
        		row_no 		= '".$row_no."',
        		cr_classes 		= '".$classes."'";
        		$exe = $this->db->query($sql);
        		$insert_id = $this->db->insert_id;
        		
        		$updateBalance = "UPDATE ".DB_PREFIX."_classes SET cl_hours_balance = '$balance', cl_cycle = '".$rowBalanceClasses["cl_cycle"]."' WHERE cl_id = '".$cr_cl_id."'";            
        		$this->db->query($updateBalance);
        			
        		if ($exe) {
        		    
                		// START 05 Issues may 2021 - isu no 10
                		if( $status == 'Required Parent To Pay' ){
        
                		    // Total payment
                		    $qSales = " SELECT * FROM tk_sales_sub WHERE no2 = '".$rowBalanceClasses["cl_display_id"]."' AND no3 != 'R.F' AND no4 NOT IN ('%0%','%0.00%')  AND no11 NOT LIKE '%rtc%' ORDER BY no1 DESC, id DESC ";
                		    $resultSales = $this->db->query($qSales);
                		    $rowPayment = $resultSales->num_rows;
                		        $rowSales = $resultSales->fetch_array(MYSQLI_ASSOC);
        
                		    // Total new cycle
                		    $TotalNewCycle = " SELECT cr_cl_id, cr_status, cr_id FROM tk_classes_record WHERE cr_cl_id = '".$cr_cl_id."' AND cr_status = 'new Cycle' AND cr_id != '".$insert_id."'   ";
                		    $resultTotalNewCycle = $this->db->query($TotalNewCycle);
                		    $rowTotalNewCycle = $resultTotalNewCycle->num_rows;
     		    
                		    if( ($rowPayment -1) > $rowTotalNewCycle ){
                    		    $SpecialCase = " SELECT * FROM tk_classes_record WHERE cr_id ='".$insert_id."' ";
                    		    $reSpecialCase = $this->db->query($SpecialCase);
                    		    if($reSpecialCase->num_rows > 0){
                    		        $roSpecialCase = $reSpecialCase->fetch_array(MYSQLI_ASSOC);
                    		        
                    		        if( $roSpecialCase['cr_status'] == 'Required Parent To Pay' ){
                    		            
                    		            $newCycle = $roSpecialCase['cr_classes'] + 1;
                    		            //$rowNo = $roSpecialCase['row_no'] + 1;
                    		            $rowNo = $roSpecialCase['row_no'];

                    		            $qryUpdate = " UPDATE tk_classes_record SET cr_cycle = '".$rowSales['no10']."', cr_balance = '".($rowSales['no10'] + ($roSpecialCase['cr_balance']))."', cr_status = 'new Cycle', cr_classes = '".$newCycle."', row_no = '".$rowNo."'  WHERE cr_id = '".$insert_id."' ";            
                    		            $this->db->query($qryUpdate);

                            		    $sql2 = " SELECT * FROM tk_classes_record WHERE cr_status = 'new' AND cr_cl_id ='".$roSpecialCase['cr_cl_id']."' ";
                            		    $result2 = $this->db->query($sql2);
                            		    if($result2->num_rows > 0){
                            		        while($rowResult2 = $result2->fetch_array(MYSQLI_ASSOC)){
                            		            $sqlsql2 = " UPDATE tk_classes_record SET cr_status='yes', cr_classes = '".$newCycle."' WHERE cr_id='".$rowResult2['cr_id']."' ";            
                            		            $this->db->query($sqlsql2);
                            		        }
                            		    }

                            		    $sql3 = " SELECT * FROM tk_classes_record WHERE cr_status = 'Tutor Paid' AND cr_cl_id ='".$roSpecialCase['cr_cl_id']."' ORDER BY cr_date DESC ";
                            		    $result3 = $this->db->query($sql3);
                            		    if($result3->num_rows > 0){
                            		        $rowResult3 = $result3->fetch_array(MYSQLI_ASSOC);
                            		            $sqlsql3 = " UPDATE tk_classes_record SET cr_classes = '".$newCycle."' WHERE cr_id='".$rowResult3['cr_id']."' ";            
                            		            $this->db->query($sqlsql3);
                            		        
                            		    }
                            		    
                            		    $latestBalanceT =  $roSpecialCase['cr_balance'];
                            		    $newBalanceT = $rowSales['no10'] + $latestBalanceT;
			

                                        if ( $latestBalanceT < 0 ) {
                                        	$convertNegativeT = abs($latestBalanceT);
                                        
                                        	$balTwoDecimalPlacesT = number_format((float)$convertNegativeT, 2, '.', '');  // Outputs -> 105.00
                                        	$balanceInMinutesT = (hoursToMinutes($balTwoDecimalPlacesT));
                                        	
                                        	$cycleHourTwoDecimalPlacesT = number_format((float)$rowSales['no10'], 2, '.', '');  // Outputs -> 105.00
                                        	$cycleHourInMinutesT = (hoursToMinutes($cycleHourTwoDecimalPlacesT));
                                        	
                                        	$totalBalanceInMinT = $cycleHourInMinutesT - $balanceInMinutesT;
                                        	$newBalance2T = (minutesToHours($totalBalanceInMinT));
                                        }else{
                                            $findDots = strpos($newBalanceT, '.');
                                            if(is_int($findDots)){
                                             $getValueAfterDots = substr($newBalanceT, strrpos($newBalanceT, '.') + 1);
                                             $stringToDigit = (int)$getValueAfterDots;
                                             if ( strlen((string)$stringToDigit) == '1' ){
                                                 if ( $getValueAfterDots >= 6 ){
                                                     $thisvalue = ($getValueAfterDots - 6);
                                                     
                                                     $first = strtok($newBalanceT, '.');
                                            
                                                     $newBalance2T = ((int)$first + 1).'.'.$thisvalue.'0';
                                                     
                                                 }else{
                                                     $newBalance2T = $newBalanceT;
                                                 }
                                             }else{
                                                 if ( $getValueAfterDots >= 60 ){
                                                     $thisvalue = ($getValueAfterDots - 60);
                                                     
                                                     $first = strtok($newBalanceT, '.');
                                            
                                                     $newBalance2T = ((int)$first + 1).'.'.$thisvalue;
                                                     
                                                 }else{
                                                     $newBalance2T = $newBalanceT;
                                                 }
                                             }
                                            }else{
                                                $newBalance2T = $newBalanceT;
                                            }
                                        }

                    		            $qry = " UPDATE tk_classes SET cl_hours_balance='".$newBalance2T."',cl_cycle='".$rowSales['no10']."'  WHERE cl_id = '".$cr_cl_id."' ";            
                    		            $this->db->query($qry);
                    		        }
                    		    }

                		    }
                		}
                		//END 05 Issues may 2021
        			
        			
                    	$qClass = " SELECT cl_id, cl_display_id, cl_wa FROM tk_classes WHERE cl_id = '".$cr_cl_id."' ";
                    	$resultClass = $this->db->query($qClass);
                    	if($resultClass->num_rows > 0){
                    		$rowClass = $resultClass->fetch_array(MYSQLI_ASSOC);
                    
                        	$qJob = " SELECT * FROM tk_job WHERE j_id = '".$rowClass['cl_display_id']."' ";
                        	$resultJob = $this->db->query($qJob);
                        	if($resultJob->num_rows > 0){
                        		$rowJob = $resultJob->fetch_array(MYSQLI_ASSOC);
                        		
                        		
                        		$queryUser = " SELECT u_id, u_email FROM tk_user WHERE u_email='".$rowJob['j_email']."'  ";
                        		$resultQueryUser = $this->db->query($queryUser); 
                        		if($resultQueryUser->num_rows > 0){ 
                        			$rowQueryUser = $resultQueryUser->fetch_assoc();
                        			$qUser = $rowQueryUser['u_id'];
            
                        			$queryUserD = " SELECT ud_u_id, salutation, ud_first_name FROM tk_user_details WHERE ud_u_id='".$qUser."'  ";
                        			$resultQueryUserD = $this->db->query($queryUserD); 
                        			if($resultQueryUserD->num_rows > 0){ 
                        				$rowQueryUserD = $resultQueryUserD->fetch_assoc();
                        				$qUserD = $rowQueryUserD['salutation'].' '.$rowQueryUserD['ud_first_name'];
                        			}
                        		}
                        		$queryUserT = " SELECT u_email, u_displayname, resit_pv_name FROM tk_user WHERE u_email='".$rowJob['j_hired_tutor_email']."'  ";
                        		$resultQueryUserT = $this->db->query($queryUserT); 
                        		if($resultQueryUserT->num_rows > 0){ 
                        			$rowQueryUserT = $resultQueryUserT->fetch_assoc();
                        			$u_displayidT = $rowQueryUserT['u_displayname'];
                        			$pvName = $rowQueryUserT['resit_pv_name'];
                        		}

                        		if( $rowClass['cl_wa'] == 'Yes' ){

                                        $xdata = array( "to" => "6".$rowJob['j_telephone'],
                                                "message" => "Salam/Hi ".$qUserD.", ".$pvName." has submitted a record for a class session completed on ".date("d/m/Y", strtotime($cr_date))." newLine Please verify by clicking this link https://www.tutorkami.com/vclass?c_id=".$cr_cl_id." (you can also read the class summary if the tutor did provide it). Thank you.\r\n\r\nNote: If you do not verify the record within 48 hours, our system will auto verify it on behalf of you, and we will assume the tutor’s record is correct.\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) " );
                                        $make_call = wsapme('POST', 'https://api.wsapme.com/v1/sendMessage', $xdata );
                                        if($make_call){
                                            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$insert_id."', wa_user = '', wa_remark = 'Record Function', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            $exeWaNoti = $this->db->query($sqlWaNoti);
                                        }else{
                                            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$insert_id."', wa_user = '', wa_remark = 'Record Function', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            $exeWaNoti = $this->db->query($sqlWaNoti);
                                        } 
                        		    /*
                        		    $website = "https://wa.tutorkami.my/api-docs/";
                        		    if( !activeAPI( $website ) ) {
                                        $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$insert_id."', wa_user = '', wa_remark = 'Record Function', wa_status = 'Fail Send', wa_note = 'Server Down', wa_date = '".date('Y-m-d H:i:s')."' ";
                                        $exeWaNoti = $this->db->query($sqlWaNoti);
                        		    }else{
                                		$args = new stdClass();
                                		$xdata = new stdClass();
                                		$args->to = "6".$rowJob['j_telephone']."@c.us";
                                		$args->content = "Salam/Hi ".$qUserD.", ".$pvName." has submitted a record for a class session completed on ".date("d/m/Y", strtotime($cr_date))."\r\n\r\nPlease verify by clicking this link https://www.tutorkami.com/vclass?c_id=".$cr_cl_id." (you can also read the class summary if the tutor did provide it). Thank you.\r\n\r\nNote: If you do not verify the record within 48 hours, our system will auto verify it on behalf of you, and we will assume the tutor’s record is correct.\r\n\r\n(This is an auto message from TutorKami.com. Please do not reply to this number) ";	
                                		$xdata->args = $args;
                                        
                                        $make_call = callAPI('POST', 'https://wa.tutorkami.my/sendText', $xdata );   	
                                        if($make_call){
                                            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$insert_id."', wa_user = '', wa_remark = 'Record Function', wa_status = 'POST', wa_note = '".$make_call."', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            $exeWaNoti = $this->db->query($sqlWaNoti);
                                        }else{
                                            $sqlWaNoti = "INSERT INTO tk_whatsapp_noti SET wa_job_id = '".$insert_id."', wa_user = '', wa_remark = 'Record Function', wa_status = 'Error', wa_note = 'Error', wa_date = '".date('Y-m-d H:i:s')."' ";
                                            $exeWaNoti = $this->db->query($sqlWaNoti);
                                        }                        		        
                        		    }
                        		    */
                        		}

                        	}
                    	}
                    	
        			$res = array('flag' => 'success', 'message' => 'Record saved successfully.', 'data' => $insert_id);
        		} else {
        			$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
        		}		    
		}
	    
		
	}
	return $res;
/* END - SAVE ALL RECORD */
}












	public function VerifyRecord($data) {
		$cr_cl_id				= isset($data['class_id']) 			? $this->RealEscape($data['class_id']) 			: '';
		$cr_id 		 			= isset($data['class_record_id'])	? $this->RealEscape($data['class_record_id'])	: '';
		$cr_parent_verification = '';
		$cr_parent_remark 		= '';
		$verification_date 	    = date('H:i d/m/y').' - Client';

		foreach ($data as $field => $value) {
			if ( preg_match('/^parent_verification_([0-9]+)$/', $field, $matches) ) {
				$cr_parent_verification = $value;
			}
			if ( preg_match('/^parent_remark_([0-9]+)$/', $field, $matches) ) {
				$cr_parent_remark = $value;
			}
		}

		if ($cr_parent_verification == '') {
        	$res = array('flag' => 'error', 'message' => 'Parent verification is required.');
        } else{
			$sql = "UPDATE ".DB_PREFIX."_classes_record SET 
			    cr_parent_verification 	= '".$cr_parent_verification."',
			    cr_parent_remark 		= '".$this->RealEscape($cr_parent_remark)."',
			    time_verification       = '".$verification_date."'
			    WHERE cr_id = {$cr_id}";

			$exe = $this->db->query($sql);

			if ($exe) {
				$insert_id = $this->db->insert_id;
        		$res = array('flag' => 'success', 'message' => 'Feedback saved successfully.', 'data' => $insert_id);
        	} else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
        }

        return $res;
	}

	public function ReviewTutor($data) {
		$rr_tutor_id 		= isset($data['tutor_id']) 				? $this->RealEscape($data['tutor_id']) 				: '';
		$rr_parent_id 		= isset($data['parent_id']) 			? $this->RealEscape($data['parent_id']) 			: '';
		$rr_job     		= isset($data['job_id']) 			    ? $this->RealEscape($data['job_id']) 			    : '';
		$rr_rating 			= isset($data[1]['rating']) 			? $this->RealEscape($data[1]['rating']) 			: '';
		$rr_review 			= isset($data[2]['review']) 			? $this->RealEscape($data[2]['review']) 			: '';
		$rr_about_tutor 	= isset($data[3]['share_about_tutor'])  ? $this->RealEscape($data[3]['share_about_tutor'])  : '';
		$rr_tutor_improve 	= isset($data[3]['tutor_improve']) 		? $this->RealEscape($data[3]['tutor_improve']) 		: '';
		$rr_create_date 	= date('Y-m-d h:i:s');

		if ($rr_tutor_id == '') {
        	$res = array('flag' => 'error', 'message' => 'Tutor id is required.');
        } elseif ($rr_parent_id == '') {
        	$res = array('flag' => 'error', 'message' => 'Parent id is required.');
        } elseif ($rr_job == '') {
        	$res = array('flag' => 'error', 'message' => 'Job id is required.');
        } elseif ($rr_rating == '') {
        	$res = array('flag' => 'error', 'message' => 'Rating is required.');
        } elseif ($rr_review == '') {
        	$res = array('flag' => 'error', 'message' => 'Review is required.');
        // } elseif ($rr_about_tutor == '') {
        	// $res = array('flag' => 'error', 'message' => 'Please write something on what you want to share with us about this tutor.');
        // } elseif ($rr_tutor_improve == '') {
        	// $res = array('flag' => 'error', 'message' => 'Please write something on how can your tutor improve.');
        } else{
			$sql = "INSERT INTO ".DB_PREFIX."_review_rating SET 
			    rr_tutor_id 		= '".$rr_tutor_id."',
			    rr_parent_id 		= '".$rr_parent_id."',
			    rr_rating 			= '".$rr_rating."',
			    rr_review 			= '".$rr_review."',
			    rr_about_tutor 		= '".$rr_about_tutor."',
			    rr_tutor_improve 	= '".$rr_tutor_improve."',
			    rr_create_date  	= '".$rr_create_date."',
			    rr_job          	= '".$rr_job."'
			    
			    ";

			$exe = $this->db->query($sql);

			if ($exe) {
				$insert_id = $this->db->insert_id;
        		$res = array('flag' => 'success', 'message' => 'Record saved successfully.', 'data' => $insert_id);
        	} else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
        }

        return $res;
	}
	
	public function TutorListReview($user_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_review_rating AS RR";
		$sql .= " INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = RR.rr_parent_id";
		$sql .= " INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		if ($user_id != '') {
			$sql .= " WHERE RR.rr_tutor_id = {$user_id}";
		}

		return $this->db->query($sql);
	}
	
	public function ParentListReview($user_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_review_rating AS RR";
		$sql .= " INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = RR.rr_tutor_id";
		$sql .= " INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		if ($user_id != '') {
			$sql .= " WHERE RR.rr_parent_id = {$user_id}";
		}

		return $this->db->query($sql);
	}
	
	
/*
	public function TutorListReviewApprove($user_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_review_rating AS RR";
		$sql .= " INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = RR.rr_parent_id";
		$sql .= " INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " WHERE rr_status ='approved' ";
		if ($user_id != '') {
			$sql .= " AND RR.rr_tutor_id = {$user_id}";
		}

		return $this->db->query($sql);
	}
*/
	public function TutorListReviewApprove($user_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_review_rating AS RR";
		$sql .= " INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = RR.rr_tutor_id";
		$sql .= " INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " WHERE rr_status ='approved' ";
		if ($user_id != '') {
			$sql .= " AND RR.rr_tutor_id = {$user_id} AND rr_name IS NULL ";
		}
		
		$sql .= " ORDER BY rr_create_date DESC ";

		return $this->db->query($sql);
	}


	public function ParentListReviewApprove($user_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_review_rating AS RR";
		$sql .= " INNER JOIN ".DB_PREFIX."_user AS U ON U.u_id = RR.rr_tutor_id";
		$sql .= " INNER JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " WHERE rr_status ='approved' ";
		if ($user_id != '') {
			$sql .= " AND RR.rr_parent_id = {$user_id}";
		}

		return $this->db->query($sql);
	}
	
	
	
	
	

	public function UserWiseOtherState($user_id, $state_id) {
		$res = '';
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_area_cover WHERE tac_other != ''";
		if ($user_id != '' && $state_id != '') {
			$sql .= " AND tac_u_id = {$user_id} AND tac_st_id = {$state_id}";
		}
		
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
			$row = $qry->fetch_array(MYSQLI_ASSOC);
			$res = $row['tac_other'];
		}
		return $res;
	}
	
	public function UserWiseOtherCourse($user_id, $course_id) {
		$res = '';
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject WHERE trs_other != ''";
		if ($user_id != '' && $course_id != '') {
			$sql .= " AND trs_u_id = {$user_id} AND trs_tc_id = {$course_id}";
		}
		
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
			$row = $qry->fetch_array(MYSQLI_ASSOC);
			$res = $row['trs_other'];
		}
		return $res;
	}
	
	public function GetClassGuide($user_id) {
		$res = '';
		$sql = "SELECT * FROM ".DB_PREFIX."_class_guide_popup WHERE cgp_u_id = '{$user_id}'";				
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
			$row = $qry->fetch_array(MYSQLI_ASSOC);
			$res = $row['cgp_status'];
		}
		return $res;
	}

	public function UpdateClassGuide($user_id, $status) {
		# DELETE PREVIOUS DATA #
	    $this->db->query("DELETE FROM ".DB_PREFIX."_class_guide_popup WHERE cgp_u_id = '{$user_id}'");
	    # INSERT NEW STATUS #
	    $sql = "INSERT INTO ".DB_PREFIX."_class_guide_popup SET 
		    cgp_u_id 	= '".$user_id."',
		    cgp_status 	= '".$status."'";

		$exe = $this->db->query($sql);

		return $exe;
	}
}
?>