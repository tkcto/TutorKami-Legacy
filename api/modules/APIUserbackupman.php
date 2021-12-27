<?php
/*
************************************************
** Page Name     : APIUser.php 
** Page Author   : Subhadeep Chowdhury
** Created On    : 06/06/2017
************************************************
*/
require_once('../admin/classes/db.class.php');
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
	
	public function SignUp($data) {
		
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
        $postalco 			= isset($data['ud_postal_code']) 	? $this->RealEscape($data['ud_postal_code']) : '';
        $address  			= isset($data['ud_address']) 		? $this->RealEscape($data['ud_address']) : ''; 
        $address2 			= isset($data['ud_address2']) 		? $this->RealEscape($data['ud_address2']) : '';
        $udcountry 			= isset($data['ud_country']) 		? $this->RealEscape($data['ud_country']) : '150';        
        $udstate  			= isset($data['ud_state']) 			? $this->RealEscape($data['ud_state']) : '';
        $udcity   			= isset($data['ud_city']) 			? $this->RealEscape($data['ud_city']) : '';
        $ud_dob   			= isset($data['ud_dob']) 			? $this->RealEscape($data['ud_dob']) : '';
        $company_name 		= isset($data['ud_company_name']) 	? $this->RealEscape($data['ud_company_name']) : '';
        $race 				= 'Not selected';
        $nationality 		= isset($data['ud_nationality']) 	? $this->RealEscape($data['ud_nationality']) : 'Not Selected';
        $admin_comment 		= isset($data['ud_admin_comment']) 	? $this->RealEscape($data['ud_admin_comment']) : '';
        $tutor_status 		= isset($data['ud_tutor_status']) 	? $this->RealEscape($data['ud_tutor_status']) : '';
        $tutor_experience 	= isset($data['ud_tutor_experience']) 	? $this->RealEscape($data['ud_tutor_experience']) : '';
        $about_yourself 	= isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
        $rate_per_hour 		= isset($data['ud_rate_per_hour']) ? $this->RealEscape($data['ud_rate_per_hour']) : '';
        $qualification 		= isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
		$role				= 3; // Tutor
		$tution_center 		= (isset($data['tution_center']) && $data['tution_center'] == 1)? 'Tuition Centre':'Not Selected';
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
        } elseif(!isset($data['cover_area_state']) || count($data['cover_area_state']) == 0) {
        	$res = array('flag' => 'error', 'message' => 'Area you can cover is required.');
        } else {
        	// Check for Duplicate
	        $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 
	        u_status <> 'D' AND (
	            u_email = '{$email}' || 
	            u_username = '{$email}'
	        )";

	        $qry = $this->db->query($sql);
	        $c = $qry->num_rows;

	        if ($c == 0) {
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
	                u_role  = '{$role}',
	                u_country_id = '150'";

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
		                ud_state        = '{$udstate}',
		                ud_city         = '{$udcity}',
		                ud_postal_code  = '{$postalco}',
		                ud_company_name = '{$company_name}',
		                ud_race 		= '{$race}',
		                ud_nationality  = '{$nationality}',
		                ud_admin_comment = '{$admin_comment}',
		                ud_client_status = '{$tution_center}',
		                ud_client_status_2 = 'Not Selected',
		                ud_tutor_experience = '{$tutor_experience}',
		                ud_about_yourself = '{$about_yourself}',
		                ud_rate_per_hour = '{$rate_per_hour}',
		                ud_qualification = '{$qualification}',
		                ud_tutor_status = '{$tutor_status}'";
		            
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

		            	if ($er == 0) {
		            		// Fire Notification email to Admin
		            		$get_admin_info = $this->GetUser('', 1);
		            		if ($get_admin_info->num_rows > 0) {
								$admin_info = $get_admin_info->fetch_array(MYSQLI_ASSOC);

			            		$adminEmail = $admin_info['u_email'];			            		
			            		if($adminEmail != '') {
			            			$emailSubject = 'TutorKami - New tutor registration';	
				            		$emailBody 	  = "A new tutor has registered. Below are the tutor's details:
				            		<br>
				            		Full name: {$firstname} {$lastname}
				            		<br>
				            		Email: {$email}
									<br>
				            		Go <a href='".APP_ROOT."admin/manage_user.php?action=edit&u_id={$insert_iud}'>here</a> to approve";

				            		$send = $this->handler->mailGunEmail('Admin', $adminEmail, $emailSubject, $emailBody);
			            		}
				            		
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
	        	$res = array('flag' => 'error', 'message' => 'Email '.$email.' already exists in our record.');
	        }
        }

		return $res;
	}

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
            $this->db->query($sql);
            // Fire Welcome Email
    		$welcome_subject = 'Welcome to TutorKami';
    		$welcome_content = 'You can now <a href="'.APP_ROOT.'login.php">log in</a> to our website to use the services offered. Amongst are:
			<br>
			1. Tuition Jobs Viewing & Searching -  View latest jobs or search jobs according to Levels & States
			<br>
			<a href="'.APP_ROOT.'search_job.php">Job Listings</a>
			<br>
			<br>
			2. Update your profile. Additional fields that you can update are:
			<br>
			a. Race
			<br>
			b. Marital Status
			<br>
			c. Occupation
			<br>
			<br>
			3. Add us as friend on FB to get news of latest jobs, or like our FB Fan Page to get latest news!
			<br>
			<a href="https://www.facebook.com/tutorkami.hometuition">Add TutorKami.com on Facebook</a>
			<br>
			<a href="https://www.facebook.com/TutorKami.comHomeTuition">Like TutorKami.com Page on Facebook</a>
			<br>
			<br>
			Need help with any of our services? Just email us at <a href="mailto:contact@tutorkami.com">contact@tutorkami.com</a>.
			<br>
			We are proud to have you as our member at TutorKami, enjoy your stay!
			<br>
			Note: Your email address was given to us by one of our registered members. If you did not signup to be a member, please send an email to <a href="mailto:contact@tutorkami.com">contact@tutorkami.com</a>.';

    		$this->handler->mailGunEmail($displayname, $email, $welcome_subject, $welcome_content);
    		
            $res = array('flag' => 'success', 'message' => 'You have successfully verified your email. Your account is activated to login.');
        }

        return $res;
    }

	public function ParentSignIn($data) {
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
		        u_status <> 'D' AND u_role = '4' AND (
		            u_email = '{$email}' || 
		            u_username = '{$email}'
		        )";

		    $qry = $this->db->query($sql);
	        if ($qry->num_rows == 0) {
	        	$res = array('flag' => 'error', 'message' => 'Email doesnot exists in our record.');
	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);
	            
	            if ($row['u_password'] != md5($password)) {
	            	$res = array('flag' => 'error', 'message' => 'Wrong password.');
	            } elseif ($row['u_status'] != 'A') {
	            	$res = array('flag' => 'error', 'message' => 'Your Account is not activated yet.');
	            } else {
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
	        	$res = array('flag' => 'error', 'message' => 'Email doesnot exists in our record.');
	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);
	            
	            if ($row['u_password'] != md5($password)) {
	            	$res = array('flag' => 'error', 'message' => 'Wrong password.');
	            } elseif ($row['u_status'] != 'A') {
	            	$res = array('flag' => 'error', 'message' => 'Your Account is not activated yet.');
	            } elseif ($row['u_admin_approve'] == 0) {
	            	$res = array('flag' => 'error', 'message' => 'Your Account is not approved yet.');
	            } else {
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

    public function GetUser($user_role = NULL, $user_id = NULL, $user_status = NULL, $search_tutor = NULL, $search_email = NULL, $search_first_name = NULL, $search_last_name = NULL, $search_phone_number = NULL) {
		$qry = "SELECT U.*, UD.*, C.city_name FROM ".DB_PREFIX."_user AS U ";
        $qry .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        $qry .= "LEFT JOIN ".DB_PREFIX."_cities AS C ON C.city_id = UD.ud_city ";
        $qry .= "WHERE 1";
        if ($user_status != '') {
            $qry .= " AND U.u_status = '{$user_status}'";
        } else {
            $qry .= " AND U.u_status <> 'D'";
        }

        if ($user_role != '') {
            $qry .= " AND U.u_role = '{$user_role}'";
        }
        if ($user_id != '' && $user_id > 0) {
            $qry .= " AND U.u_id = {$user_id}";
        }

        if ($search_tutor != '') {
        	if ($search_tutor == 'Yes') {
        		$qry .= " AND UD.ud_client_status = 'Tuition Centre'";
        	} elseif ($search_tutor == 'No') {
        		$qry .= " AND UD.ud_client_status != 'Tuition Centre'";
            }
        }
        if ($search_email != '') {
            $qry .= " AND( U.u_username LIKE '%{$search_email}%' || U.u_email LIKE '%{$search_email}%' )";
        }
        if ($search_first_name != '') {
            $qry .= " AND UD.ud_first_name LIKE '%{$search_first_name}%'";
        }
        if ($search_last_name != '') {
            $qry .= " AND UD.ud_last_name LIKE '%{$search_last_name}%'";
        }
        if ($search_phone_number != '') {
            $qry .= " AND UD.ud_phone_number LIKE '%{$search_phone_number}%'";
        }

		return $this->db->query($qry);
	}

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
        $udstate  			= isset($data['ud_state']) 			? $this->RealEscape($data['ud_state']) : '';
        $udcity   			= isset($data['ud_city']) 			? $this->RealEscape($data['ud_city']) : '';
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
        $about_yourself 	= isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
        $rate_per_hour = isset($data['ud_rate_per_hour']) ? $this->RealEscape($data['ud_rate_per_hour']) : '';
        $qualification 		= isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
        $marital_status 	= isset($data['ud_marital_status']) ? $this->RealEscape($data['ud_marital_status']) : '';
		$role				= 3; // Tutor
		$tution_center 		= (isset($data['tution_center']) && $data['tution_center'] == 1)? 'Tuition Centre':'Not Selected';

        $user_testimonial 	= isset($data['u_testimonial']) ? $this->RealEscape($data['u_testimonial']) : '';

        // Validation
        if ($user_id == '') {
        	$res = array('flag' => 'error', 'message' => 'User id is required.');
        } else {
	        
            $sqli = "UPDATE ".DB_PREFIX."_user SET 
                u_displayname = '".$displayname."',
                u_gender = '".$gender."',
                u_modified_date = '".date('Y-m-d H:i:s')."'";

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
	                ud_admin_comment = '{$admin_comment}',
	                ud_client_status = '{$tution_center}',
	                ud_tutor_experience = '{$tutor_experience}',
	                ud_about_yourself = '{$about_yourself}',
	                ud_rate_per_hour = '{$rate_per_hour}',
	                ud_marital_status = '{$marital_status}',
	                ud_qualification = '{$qualification}',
	                ud_tutor_status = '{$tutor_status}',
	                ud_current_occupation = '{$current_occupation}',
	                ud_current_occupation_other = '{$current_occupation_other}',
	                ud_current_company = '{$current_company}' 
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
	            	
		            if ($user_testimonial != '') {
		            	# DELETE PREVIOUS TESTIMONIAL DATA #
		            	//$this->db->query("DELETE FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '{$user_id}'");
		            	if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$user_id."'")->num_rows > 0){

		            		if($user_testimonial['user_testimonial1'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $user_id");
							}
							if($user_testimonial['user_testimonial2'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $user_id");
							}
							if($user_testimonial['user_testimonial3'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $user_id");
							}
							if($user_testimonial['user_testimonial4'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $user_id");
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

	            	if ($er == 0) {
	            		$res = array('flag' => 'success', 'message' => 'Congratulation, your account has been successfully updated.', 'data' => $user_id);
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
                u_password = '".md5($new_password)."',
                u_modified_date = '".date('Y-m-d H:i:s')."' 
                WHERE u_id = '".$user_id."'";

            if($this->db->query($sqly)){
            	$res = array('flag' => 'success', 'message' => 'Password Updated Successfully.');
            } else {
            	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
            }            
        }

        return $res;
    }

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
	            $res = array('flag' => 'error', 'message' => 'Email doesnot exists in our record.');
	        } else {
	            $row = $qry->fetch_array(MYSQLI_ASSOC);

	            $new_password = $this->handler->getRandNum(6);

	            $sqly = "UPDATE ".DB_PREFIX."_user SET 
	                u_password = '".md5($new_password)."',
	                u_modified_date = '".date('Y-m-d H:i:s')."' 
	                WHERE u_id = '".$row['u_id']."'";

	            $emailBody = "Your new password to login into system is: ". $new_password;
	            $email = $this->handler->sendEmail($row['ud_first_name'], $row['u_email'], 'Forgot Password', $emailBody);

	            $result = $this->db->query($sqly);
	            $res = array('flag' => 'success', 'message' => 'Email Sent Successfully.');
	        }
	    }

        return $res;
    }

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

	public function CourseWiseSubject($course_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject";
		if ($course_id != '') {
			$sql .= " WHERE ts_tc_id = {$course_id}";
		}

		return $this->db->query($sql);
	}
	
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

		$qry = "SELECT U.u_id, U.u_email, U.u_displayname, U.u_displayid, U.u_gender, U.u_profile_pic, CT.city_name, UD.*, AVG(RR.rr_rating) as average_rating FROM ".DB_PREFIX."_user AS U 
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

	public function TutorRequest($data) {
		$tr_name 				= isset($data['tr_name']) 				? $this->RealEscape($data['tr_name']) 				: '';
		$tr_location 			= isset($data['tr_location']) 			? $this->RealEscape($data['tr_location']) 			: '';
		$tr_phone_number 		= isset($data['tr_phone_number']) 		? $this->RealEscape($data['tr_phone_number']) 		: '';
		$tr_subject 			= isset($data['tr_subject']) 			? $this->RealEscape($data['tr_subject']) 			: '';
		$tr_additional_comment 	= isset($data['tr_additional_comment']) ? $this->RealEscape($data['tr_additional_comment']) : '';
		$tr_status 				= 'Active';
		$tr_create_date 		= date('Y-m-d');

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
        	} else {
	        	$res = array('flag' => 'error', 'message' => 'Database error: '.$this->db->error);
	        }
        }

        return $res;
	}
	
	public function TutorWiseClasses($user_id, $class_id = NULL, $display_id = NULL) {
		$sql = "SELECT C.*, UD.*, U.u_username, U.u_displayname, TS.ts_title FROM ".DB_PREFIX."_classes AS C";
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
		$sql = "SELECT C.*, UD.*, U.u_username, U.u_displayname, TS.ts_title FROM ".DB_PREFIX."_classes AS C";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user AS U ON U.u_id = C.cl_tutor_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_user_details AS UD ON UD.ud_u_id = U.u_id";
		$sql .= " LEFT JOIN ".DB_PREFIX."_tution_subject AS TS ON TS.ts_id = C.cl_subject_id";
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
			$sql .= " WHERE PH.ph_user_id = {$user_id}";
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

		return $this->db->query($sql);
	}

	public function AddRecord($data) {
		$cr_cl_id			= isset($data['class_id']) 			? $this->RealEscape($data['class_id']) 			: '';
		$cr_date	 		= isset($data['record_date']) 		? $this->RealEscape($data['record_date']) 		: '';
		$cr_start_time 	 	= isset($data['record_start_time']) ? $this->RealEscape($data['record_start_time']) : '';
		$cr_end_time		= isset($data['record_end_time']) 	? $this->RealEscape($data['record_end_time']) 	: '';
		$cr_duration		= isset($data['total_duration']) 	? $this->RealEscape($data['total_duration']) 	: '';
		$cr_tutor_report	= isset($data['record_remark']) 	? $this->RealEscape($data['record_remark']) 	: '';
		$cr_create_date 	= date('Y-m-d');

		if ($cr_date == '') {
        	$res = array('flag' => 'error', 'message' => 'Date is required.');
        } elseif ($cr_start_time == '') {
        	$res = array('flag' => 'error', 'message' => 'Start time is required.');
        } elseif ($cr_end_time == '') {
        	$res = array('flag' => 'error', 'message' => 'End time is required.');
        } else{
			$sql = "INSERT INTO ".DB_PREFIX."_classes_record SET 
			    cr_cl_id 		= '".$cr_cl_id."',
			    cr_date 		= '".$cr_date."',
			    cr_start_time 	= '".$cr_start_time."',
			    cr_end_time 	= '".$cr_end_time."',
			    cr_duration 	= '".$cr_duration."',
			    cr_tutor_report = '".$cr_tutor_report."',
			    cr_create_date  = '".$cr_create_date."'";

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

	public function VerifyRecord($data) {
		$cr_cl_id				= isset($data['class_id']) 			? $this->RealEscape($data['class_id']) 			: '';
		$cr_id 		 			= isset($data['class_record_id'])	? $this->RealEscape($data['class_record_id'])	: '';
		$cr_parent_verification = '';
		$cr_parent_remark 		= '';

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
			    cr_parent_remark 		= '".$this->RealEscape($cr_parent_remark)."' 
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
		$rr_rating 			= isset($data[1]['rating']) 			? $this->RealEscape($data[1]['rating']) 			: '';
		$rr_review 			= isset($data[2]['review']) 			? $this->RealEscape($data[2]['review']) 			: '';
		$rr_about_tutor 	= isset($data[3]['share_about_tutor'])  ? $this->RealEscape($data[3]['share_about_tutor'])  : '';
		$rr_tutor_improve 	= isset($data[3]['tutor_improve']) 		? $this->RealEscape($data[3]['tutor_improve']) 		: '';
		$rr_create_date 	= date('Y-m-d');

		if ($rr_tutor_id == '') {
        	$res = array('flag' => 'error', 'message' => 'Tutor id is required.');
        } elseif ($rr_parent_id == '') {
        	$res = array('flag' => 'error', 'message' => 'Parent id is required.');
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
			    rr_create_date  	= '".$rr_create_date."'";

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