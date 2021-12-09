<?php
/*
************************************************
** Page Name     : user.class.php 
** Page Author   : Tathagata Basu
** Created On    : 12/11/2014
************************************************
*/
require_once('db.class.php');
require_once('system.class.php');

class user extends db {
	
	var $db, $system;
	
	function __construct() {
		$this->db = $this->con_db();
		$this->system = new system();
		if(!isset($_SESSION)){
		    session_start();
		}
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////
	
	function GetAllRole($role_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_role";
		if ($role_id != '') {
			$sql .= " WHERE r_id = {$role_id}";
		}
		
		return $this->db->query($sql);
	}
	
	function GetParentTutorRole(){
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_role WHERE r_id = 3 OR r_id = 4");
	}
	
	function SaveRole($data) {
		if($data['r_id']=='') {
			$sql = "INSERT INTO ".DB_PREFIX."_role SET 
	            r_status = 'A',
	            r_update_by = '".$_SESSION[DB_PREFIX]['u_id']."',
	            r_name = '{$data['r_name']}',
	            r_system_name = '".$data['r_system_name']."',
	            r_update_on = '".date('Y-m-d H:i:s')."',
	            r_country_id = '1'";
	        
	        if($this->db->query($sql)) {
	        	$res = $this->db->insert_id;
	        	Session::SetFlushMsg("success", 'Role Added Successfully.');
	        } else {
	        	$res = false;
	        	Session::SetFlushMsg("error", 'Database error.');
	        }
			
		} else {
			$sql = "UPDATE ".DB_PREFIX."_role SET 
	            r_update_by = '".$_SESSION[DB_PREFIX]['u_id']."',
	            r_name = '{$data['r_name']}',
	            r_system_name = '".$data['r_system_name']."' ,
	            r_update_on = '".date('Y-m-d H:i:s')."' 
	            WHERE r_id = {$data['r_id']}";
	        
	        
	        
	        if($this->db->query($sql)) {
	        	$res = $data['r_id'];
	        	Session::SetFlushMsg("success", 'Role Updated Successfully.');
	        } else {
	        	$res = false;
	        	Session::SetFlushMsg("error", 'Database error.');
	        }
			
		}

		return $res;
	}
	
	function FetchRole($status) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_role WHERE r_status LIKE '".$status."'");
	}
	
	function GetAllUser($user_role = NULL, $user_id = NULL, $user_status = NULL, $search_tutor = NULL, $search_email = NULL, $search_first_name = NULL, $search_last_name = NULL, $search_phone_number = NULL) {
		$qry = "SELECT U.*, UD.* FROM ".DB_PREFIX."_user AS U ";
        $qry .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        $qry .= "WHERE 1";

        if($_SESSION[DB_PREFIX]['r_id'] != 1){
		 	$qry .= " AND U.u_role > '".$_SESSION[DB_PREFIX]['r_id']."'";
		}
        if ($user_status != '') {
            $qry .= " AND U.u_status = '{$user_status}'";
        } else {
            $qry .= " AND U.u_status <> 'D'";
        }

        if ($user_role != '') {
            $qry .= " AND U.u_role = '{$user_role}'";
        }
        //change to cater displayID
       // if ($user_id != '' && $user_id > 0) {
        if ($user_id != '') {
            if (!is_numeric($user_id)) {  
                $qry .= " AND U.u_displayid = '{$user_id}'";
            } else {
                $qry .= " AND U.u_id = {$user_id}";
            }
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

        $qry .= " ORDER BY u_id DESC LIMIT 100";
       //echo($qry);
       // die();
		return $this->db->query($qry);
	}

	public function SearchUser($data) {
	    $search_id           = isset($data['u_id'])            ? $data['u_id'] : '';
		$search_tutor        = isset($data['is_tutor'])        ? $data['is_tutor'] : '';
		$search_email        = isset($data['u_email'])         ? $data['u_email'] : '';		
		$search_first_name   = isset($data['ud_first_name'])   ? $data['ud_first_name'] : '';
		$search_last_name    = isset($data['ud_last_name'])    ? $data['ud_last_name'] : '';
		$search_phone_number = isset($data['ud_phone_number']) ? $data['ud_phone_number'] : '';

		// if ($search_tutor == 'Yes') {
			// For Tutor   
			$displayname 		= isset($data['u_displayname']) 			? $data['u_displayname'] : '';			
			$areas       		= isset($data['cover_area_state']) 			? $data['cover_area_state'] : '';
			$course      		= isset($data['tutor_course']) 				? $data['tutor_course'] : '';			
			$u_admin_approve 	= isset($data['u_admin_approve']) 			? $data['u_admin_approve'] : '';
			$subject 			= isset($data['subject']) 					? $data['subject'] : '';
			$location 			= isset($data['location']) 					? $data['location'] : '';
		    $gender 			= isset($data['u_gender']) 					? $data['u_gender'] : '';
			$ud_race 			= isset($data['ud_race']) 					? $data['ud_race'] : '';
			$ud_tutor_status 	= isset($data['ud_tutor_status']) 			? $data['ud_tutor_status'] : '';
			$tution_center 		= isset($data['tution_center']) 			? $data['tution_center'] 	: '';
			$current_occupation = isset($data['ud_current_occupation']) 	? $data['ud_current_occupation'] : '';
		//	$profile        	= isset($data['u_profile_pic']) 			? $data['u_profile_pic'] : '';
		// } elseif ($search_tutor == 'No') {
			// For Non-Tutor
			$gender       	= isset($data['u_gender']) 			? $data['u_gender'] : '';
			$client_status 	= isset($data['ud_client_status']) 	? $data['ud_client_status'] : '';
			$state        	= isset($data['ud_state']) 			? $data['ud_state'] : '';
	//		$cities        	= isset($data['ud_city']) 			? $data['ud_city'] : '';
			$paying_client 	= isset($data['u_paying_client']) 	? $data['u_paying_client'] : '';
		// }

		$qry = "SELECT 
			U.*, 
			UD.*";
		  if ($search_tutor == 'Yes') {
        	$qry.=",CT.city_name ";  // R.r_name ";
        	$qry.="FROM ".DB_PREFIX."_user AS U
		           INNER JOIN ".DB_PREFIX."_user_details AS UD 	ON UD.ud_u_id 	= U.u_id ";
        	
		  } else {
		      $qry.="FROM ".DB_PREFIX."_user AS U 
		INNER JOIN ".DB_PREFIX."_user_details 	 AS UD 	ON UD.ud_u_id 	= U.u_id ";
		  }
        //separate tutor and parent
        if ($search_tutor == 'Yes') {
            $qry .="LEFT JOIN ".DB_PREFIX."_tutor_subject 	 AS TRS ON TRS.trs_u_id = U.u_id  
		LEFT JOIN ".DB_PREFIX."_tution_subject 	 AS TS 	ON TS.ts_id 	= TRS.trs_ts_id  
		LEFT JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
		LEFT JOIN ".DB_PREFIX."_cities 			 AS CT 	ON CT.city_id 	= UD.ud_city";
		//LEFT JOIN ".DB_PREFIX."_role 			 AS R 	ON R.r_id 		= U.u_role";
	} 
		$qry .= " WHERE U.u_status <> 'D'";

       // if($_SESSION[DB_PREFIX]['r_id'] != 1){
		// 	$qry .= " AND U.u_role > '".$_SESSION[DB_PREFIX]['r_id']."'";
	//	}
		// SEARCH TUTOR (fucking hell)
		if ($search_tutor != '') {
        	if ($search_tutor == 'Yes') {
        		$qry .= " AND U.u_role = '3'";
        		//check for admin disabled
        		//} elseif ($search_tutor == 'No' && $role != '') {
        	} elseif ($search_tutor == 'No') {
        		//$qry .= " AND U.u_role = '".$role."'";
        	    $qry .= " AND U.u_role = '4'";
            }
        }
        //search by id or did
        if ($search_id != '' && $search_id > 0) {
       //     if (!is_numeric($search_id)) {
         //       $qry .= " AND U.u_displayid = {$search_id}";
         //   } else {
                $qry .= " AND U.u_id = {$search_id}";
            //}
        }
        // SEARCH EMAIL
        if ($search_email != '') {
            $qry .= " AND U.u_email LIKE '%{$search_email}%'";
        }

        // SEARCH FIRST NAME
        if ($search_first_name != '') {
            $qry .= " AND UD.ud_first_name LIKE '%{$search_first_name}%'";
        }

        // SEARCH LAST NAME
        if ($search_last_name != '') {
            $qry .= " AND UD.ud_last_name LIKE '%{$search_last_name}%'";
        }

        // SEARCH DISPLAY
        if ($displayname != '') {
            $qry .= " AND U.u_displayname LIKE '%{$displayname}%'";
        }

        // SEARCH PHONE NUMBER
        if ($search_phone_number != '') {
            $qry .= " AND UD.ud_phone_number LIKE '%{$search_phone_number}%'";
        }

        // COVER AREA
        foreach ($data['cover_area_state'] as $key => $value) {
            if (empty($value)) {
                unset($data['cover_area_state'][$key]);
            }
        }
       // if (empty($data['cover_area_state'])) { echo "empty"; };
        
        $area_count = 0;
        if (isset($data['cover_area_state']) && !empty($data['cover_area_state'])) {
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
        foreach ($data['tutor_course'] as $key => $value) {
            if (empty($value)) {
                unset($data['tutor_course'][$key]);
            }
        }
        $subject_count = 0;
        if (isset($data['tutor_course']) && !empty($data['tutor_course'])) {
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
            $qry .= " AND UD.ud_race = '".stripslashes($ud_race)."'";
        }

        // OCCUPATION
        if ($current_occupation != '') {
            $qry .= " AND UD.ud_current_occupation = '".stripslashes($current_occupation)."'";
        }

        // TUTOR STATUS
        if ($ud_tutor_status != '') {
            $qry .= " AND UD.ud_tutor_status = '".stripslashes($ud_tutor_status)."'";
        }

        // WILL TEACH AT TUITION CENTER
        if ($tution_center != '') {
        	if ($tution_center == '1') {
        		$qry .= " AND UD.ud_client_status = 'Tuition Centre'";
        	} elseif ($tution_center == '0') {
        		$qry .= " AND UD.ud_client_status != 'Tuition Centre'";
            }
        }

        // TUTOR STATUS
        if ($u_admin_approve != '') {
            $qry .= " AND U.u_status = '".stripslashes($u_admin_approve)."'";
        }

        // SEARCH STATE
        if ($state != '') {
            $qry .= " AND UD.ud_state = '".stripslashes($state)."'";
        }

        // SEARCH PAYING CLIENT
        if ($paying_client != '') {
            $qry .= " AND U.u_paying_client = '".stripslashes($paying_client)."'";
        }

        $qry .= " GROUP BY U.u_id";
        if ($area_count > 0 || $subject_count > 0) {
        	$qry .= " HAVING";
        	$qry .= ($area_count > 0) ? " COUNT(DISTINCT TAC.tac_city_id) = $area_count" : "";
        	$qry .= ($area_count > 0 && $subject_count > 0) ? " AND" : "";
        	$qry .= ($subject_count > 0) ? " COUNT(DISTINCT TRS.trs_ts_id) = $subject_count" : "";

        }
		$qry .= " ORDER BY U.u_id DESC LIMIT 100";
	//	echo ($qry);
	//	die();
        return $this->db->query($qry);
	}

	public function ExportUser($data) {
		$search_ids = isset($data['id']) ? implode(',', $data['id']) : '';
		
		$qry = "SELECT 
			U.u_id, 
			U.u_email, 
			U.u_displayid, 
			U.u_displayname, 
			U.u_create_date, 
			U.u_modified_date, 
			UD.*, 
			CT.city_name, 
			R.r_name 
		FROM 
			".DB_PREFIX."_user AS U 
		INNER JOIN ".DB_PREFIX."_user_details 	 AS UD 	ON UD.ud_u_id 	= U.u_id 
		LEFT JOIN ".DB_PREFIX."_tutor_subject 	 AS TRS ON TRS.trs_u_id = U.u_id  
		LEFT JOIN ".DB_PREFIX."_tution_subject 	 AS TS 	ON TS.ts_id 	= TRS.trs_ts_id  
		LEFT JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
		LEFT JOIN ".DB_PREFIX."_cities 			 AS CT 	ON CT.city_id 	= UD.ud_city
		LEFT JOIN ".DB_PREFIX."_role 			 AS R 	ON R.r_id 		= U.u_role";

		$qry .= " WHERE U.u_status <> 'D'";

		// SEARCH PAYING CLIENT
        if ($search_ids != '') {
            $qry .= " AND U.u_id IN (".rtrim($search_ids, ',').")";
        }

        $qry .= " GROUP BY U.u_id";
		$qry .= " ORDER BY U.u_create_date DESC";
        
        return $this->db->query($qry);
	}
	
	function FetchUser($status) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_email, u.u_role, r.r_name, u.u_status, r.r_status FROM ".DB_PREFIX."_user AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id WHERE u.u_status LIKE '".$status."' AND r.r_status LIKE '".$status."' ORDER BY u.u_role ASC");
	}
	
	function FetchUserByRole($r_id, $status) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_displayname, u.u_email, u.u_role, r.r_name, u.u_status, r.r_status FROM ".DB_PREFIX."_user AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id WHERE u.u_status LIKE '".$status."' AND r.r_status LIKE '".$status."' AND u.u_role LIKE '".$r_id."' ORDER BY u.u_role ASC, u.u_id ASC");
	 }
	
	function GetUserDetail($u_id) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_user WHERE u_id = '".$u_id."'")->fetch_assoc();
	}
	
	function GetUserProfile($u_id) {
		return $this->db->query("SELECT u.u_id, u.u_username, u.u_email, u.u_role, r.r_name FROM ".DB_PREFIX."_user AS u LEFT JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id WHERE u.u_id = '".$u_id."'")->fetch_assoc();
	}
	
	function GetUserDisplayName($u_id) {
		$arrUSer = $this->GetUserDetail($u_id);
		return $arrUSer['u_fname'].' '.$arrUSer['u_lname'];
	}
	
	function SaveUser($data) {
		$flag = 0;
		$mail = 0;
       
        $username 			= $data['u_username'];
        $email    			= $data['u_email'];
        $gender   			= $data['u_gender'];
        $password 			= $data['u_password'];
        $u_role 			= $data['u_role'];
        $displayname 		= isset($data['u_displayname']) ? $this->RealEscape($data['u_displayname']) : '';
        $profile_pic 		= isset($data['u_profile_pic']) ? $this->RealEscape($data['u_profile_pic']) : '';
        $proof_profile_pic 	= isset($data['ud_proof_of_accepting_terms']) ? $this->RealEscape($data['ud_proof_of_accepting_terms']) : '';
        $u_status 			= isset($data['u_status']) ? $this->RealEscape($data['u_status']) : 'P';
        $u_paying_client 	= isset($data['u_paying_client']) ? $this->RealEscape($data['u_paying_client']) : 'P';
        $firstname 			= $this->RealEscape($data['ud_first_name']);
        $lastname 			= $this->RealEscape($data['ud_last_name']);
        $phonenum 			= $this->RealEscape($data['ud_phone_number']);
        $postalco 			= isset($data['ud_postal_code']) ? $this->RealEscape($data['ud_postal_code']) : '';
        $address  			= $data['ud_address']; 
        $address2 			= isset($data['ud_address2']) ? $this->RealEscape($data['ud_address2']) : '';
        $udcountry 			= isset($data['ud_country']) ? $this->RealEscape($data['ud_country']) : '150';
        $udstate  			= isset($data['ud_state']) ? $this->RealEscape($data['ud_state']) : '';
        $udcity   			= isset($data['ud_city']) ? $this->RealEscape($data['ud_city']) : '';
        $ud_dob   			= $data['ud_dob'];
        $ud_company_name 	= isset($data['ud_company_name']) ? $this->RealEscape($data['ud_company_name']) : '';
        $ud_tutor_status 	= isset($data['ud_tutor_status']) ? $this->RealEscape($data['ud_tutor_status']) : '';
        $ud_tutor_experience 	= isset($data['ud_tutor_experience']) ? $this->RealEscape($data['ud_tutor_experience']) : '';
        $ud_about_yourself 	= isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
        $ud_marital_status 	= isset($data['ud_marital_status']) ? $this->RealEscape($data['ud_marital_status']) : '';
        $ud_qualification 	= isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
        $ud_race 			= $this->RealEscape($data['ud_race']);
        $ud_nationality 	= $this->RealEscape($data['ud_nationality']);
        $ud_admin_comment 	= $this->RealEscape($data['ud_admin_comment']);
        $rate_per_hour      = $this->RealEscape($data['ud_rate_per_hour']);
        $ud_client_status 	= $this->RealEscape($data['ud_client_status']);
        $ud_client_status_2 = $this->RealEscape($data['ud_client_status_2']);
        $displayid 			= $this->system->GenRandLowerCase(7);
        $ud_current_occupation = isset($data['ud_current_occupation']) ? $this->RealEscape($data['ud_current_occupation']) : '';
        $ud_current_occupation_other = isset($data['ud_current_occupation_other']) ? $this->RealEscape($data['ud_current_occupation_other']) : '';
        $ud_current_company = isset($data['ud_current_company']) ? $this->RealEscape($data['ud_current_company']) : '';
        $user_testimonial 	= isset($data['u_testimonial']) ? $this->RealEscape($data['u_testimonial']) : '';

        if ($ud_dob != '') {
	        $ex_dob = explode('/', $ud_dob);
	        $ud_dob = $ex_dob[2].'-'.$ex_dob[1].'-'.$ex_dob[0];
        } else {
        	$ud_dob = '';
        }

		if(!isset($data['u_id']) || $data['u_id']=='') {

	        $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 
	        u_status <> 'D' AND (
	            u_email = '{$email}' || 
	            u_username = '{$email}' || 
	            u_email = '{$username}' || 
	            u_username = '{$username}'
	        )";

	        $qry = $this->db->query($sql);

	        if ($qry->num_rows == 0) {

	        	$phnqry = $this->db->query("SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_status <> 'D' AND UD.ud_phone_number = '{$phonenum}'");
	        	if ($phnqry->num_rows == 0) {

		            $sqli = "INSERT INTO ".DB_PREFIX."_user SET 
		                u_email = '".$email."',
		                u_username = '".$username."',
		                u_displayid = '".$displayid."',
		                u_displayname = '".$displayname."',
		                u_gender = '".$gender."',
		                u_status = '".$u_status."',
		                u_paying_client = '".$u_paying_client."',
		                u_password = '".md5($password)."',
		                u_profile_pic = '".$profile_pic."',
		                u_create_date = '".date('Y-m-d H:i:s')."',
		                u_role  = '{$u_role}',
		                u_country_id = '".$udcountry."'";

		            $exe = $this->db->query($sqli);
		            if($exe){
		            	$insert_iud = $user_id = $this->db->insert_id;

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
			                ud_company_name = '{$ud_company_name}',
			                ud_race 		= '{$ud_race}',
			                ud_nationality  = '{$ud_nationality}',
			                ud_admin_comment = '{$ud_admin_comment}',
			                ud_client_status = '{$ud_client_status}',
			                ud_client_status_2 = '{$ud_client_status_2}',
			                ud_tutor_status = '{$ud_tutor_status}',
			                ud_current_occupation = '{$ud_current_occupation}',
			                ud_current_occupation_other = '{$ud_current_occupation_other}',
			                ud_current_company = '{$ud_current_company}',
			                ud_proof_of_accepting_terms = '{$proof_profile_pic}'";

			            $exe = $this->db->query($sq);
			            if($exe) {
				        	$res = $insert_iud;

				        	$sql_news = "INSERT INTO ".DB_PREFIX."_newsletter SET 
					        	news_group = '".$ud_client_status."', 
					        	news_level = 'NA', 
					        	news_id_numer = '".$displayid."', 
					        	news_name = '".$firstname." ".$lastname."', 
					        	news_email = '".$email."', 
					        	news_status = 'A', 
					        	news_create_date = '".date('Y-m-d H:i:s')."', 
					        	news_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
					        
					        $this->db->query($sql_news);

				        	Session::SetFlushMsg("success", 'Customer Added Successfully.');
				        } else {
				        	$res = false;
				        	Session::SetFlushMsg("error", 'Database error: '.$this->db->error);
				        	$this->db->query("DELETE FROM ".DB_PREFIX."_user WHERE u_id = '".$insert_iud."'");
				        }

		            } else {
			        	$res = false;
			        	Session::SetFlushMsg("error", 'Database error: '.$this->db->error);
			        }
			    } else {
		            Session::SetFlushMsg("error", 'Phone number has been used previously.');
		            $res = false;
		        } 
	            
	            
	        } else {
	            Session::SetFlushMsg("error", 'Username / Email already exists in our record.');
	            $res = false;
	        }

		} else {
			$id = $user_id = $data['u_id'];

			$sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 
		        u_status <> 'D' AND u_id <> {$id} AND (
		            u_email = '{$email}' || 
		            u_username = '{$email}'
		        )";

	        $qry = $this->db->query($sql);

	        if ($qry->num_rows == 0) {
	            $sqly = "UPDATE ".DB_PREFIX."_user SET 
	                u_email = '".$email."',
	                u_username = '".$username."',
	                u_displayname = '".$displayname."',
	                u_gender = '".$gender."',
	                u_status = '".$u_status."', 
	                u_paying_client = '".$u_paying_client."',
	                u_role  = '{$u_role}',
	                u_modified_date = '".date('Y-m-d H:i:s')."'";

	            if ($password != '') {
	                $sqly .= ", u_password = '".md5($password)."'";
	            }
	            if ($profile_pic != '') {
	            	$sqly .= ", u_profile_pic = '".$profile_pic."'";
	            }
	            $sqly .= " WHERE u_id = {$id}";
				$exe = $this->db->query($sqly);
	            if($exe){

		            $sqlm = "UPDATE ".DB_PREFIX."_user_details SET 
		                ud_country      = '{$udcountry}',
		                ud_state        = '{$udstate}',
		                ud_city         = '{$udcity}',               
		                ud_first_name   = '{$firstname}',
		                ud_last_name    = '{$lastname}',
		                ud_dob    		= '{$ud_dob}',
		                ud_phone_number = '{$phonenum}',
		                ud_address      = '{$address}',
		                ud_address2     = '{$address2}',
		                ud_postal_code  = '{$postalco}',
		                ud_company_name = '{$ud_company_name}',
		                ud_race 		= '{$ud_race}',
		                ud_nationality  = '{$ud_nationality}',
		                ud_admin_comment = '{$ud_admin_comment}',
		                ud_rate_per_hour = '{$rate_per_hour}',
		                ud_marital_status = '{$ud_marital_status}',
		                ud_qualification = '{$ud_qualification}',
		                ud_client_status = '{$ud_client_status}',
			            ud_client_status_2 = '{$ud_client_status_2}',
		                ud_tutor_experience = '{$ud_tutor_experience}',
		                ud_about_yourself = '{$ud_about_yourself}',
		                ud_tutor_status = '{$ud_tutor_status}',
		                ud_current_occupation = '{$ud_current_occupation}',
		                ud_current_occupation_other = '{$ud_current_occupation_other}',
		                ud_current_company = '{$ud_current_company}'";

		            
		            if ($proof_profile_pic != '') {
		            	$sqlm .= ", ud_proof_of_accepting_terms = '{$proof_profile_pic}'";
		            }
		            $sqlm .= " WHERE ud_u_id = {$id}";

		            $exe = $this->db->query($sqlm);
		            if($exe) {
			        	$res = $id;

			            if ($user_testimonial != '') {
			            	# DELETE PREVIOUS TESTIMONIAL DATA #
			            	/*$this->db->query("DELETE FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '{$id}'");
				            foreach ($user_testimonial as $key => $testimonial) {
				            	$testimonialSql = "INSERT INTO ".DB_PREFIX."_user_testimonial SET
								ut_u_id    	   = '{$id}',
								ut_file_path   = '{$testimonial}',
								ut_create_date = '".date('Y-m-d H:i:s')."'";

								if ($this->db->query($testimonialSql)){} else {
									$er++;
								}
				            }*/
				            if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$id."'")->num_rows > 0){

		            		if($user_testimonial['user_testimonial1'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $id");
							}
							if($user_testimonial['user_testimonial2'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $id");
							}
							if($user_testimonial['user_testimonial3'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $id");
							}
							if($user_testimonial['user_testimonial4'] != '') {
								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $id");
							}

		            	}
		            	else{
		            		if($this->db->query("INSERT INTO ".DB_PREFIX."_user_testimonial(ut_u_id,ut_user_testimonial1,ut_user_testimonial2,ut_user_testimonial3,ut_user_testimonial4,ut_create_date) VALUES('".$id."','".$user_testimonial['user_testimonial1']."','".$user_testimonial['user_testimonial2']."','".$user_testimonial['user_testimonial3']."','".$user_testimonial['user_testimonial4']."','".date('Y-m-d H:i:s')."')")){}
		            			else{
		            				$er++;
		            			}

		            	  }
			            }

			        	Session::SetFlushMsg("success", 'Customer Updated Successfully.');
			        } else {			        	
			        	$res = false;
			        	Session::SetFlushMsg("error", 'Database error: '. $this->db->error);
			        }

	            }else {
		        	$res = false;
		        	Session::SetFlushMsg("error", 'Database error: '. $this->db->error);
		        }
	        } else {
	            Session::SetFlushMsg("error", 'Username / Email already exists in our record.');
	            $res = false;
	        }
		}

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

		return $res;
	}
	
	function ApproveUser($u_id) {

		$userData = $this->GetAllUser('', $u_id);
        $userRow = $userData->fetch_array(MYSQLI_ASSOC);

        $sql = "UPDATE ".DB_PREFIX."_user SET 
                u_admin_approve  = '1',
                u_modified_date = '".date('Y-m-d H:i:s')."' 
                WHERE u_id = {$u_id}";

        if ($this->db->query($sql)) {
			$emailSubject = 'TutorKami - Approval Email';
			$message = '<html><head>
			<title>'.$emailSubject.'</title>
			</head>
			<body>';
			$message .= '<img src="' . APP_ROOT . 'admin/upload/logo.png" style="max-width: 250px" /><br>';
			$message .= '<h1>Hello ' . $userRow['u_displayname'] . ',</h1>';
			$message .= '<p>This is an email from TutorKami.com. You have recently registered yourself as a tutor.</p>';
			$message .= '<p>To activate your account please double click the link below:</p>';
			$message .= '<p><a href="' . APP_ROOT . 'activation.php?email='.$userRow['u_email'].'">' . APP_ROOT . 'activation.php?email='.$userRow['u_email'].'</a></p>';
			$message .= '<p>Please add us as your friend on Facebook at this link <a href="https://www.facebook.com/TutorKami.comHomeTuition">TutorKami.com on Facebook</a> as we will update all home tuition jobs over there, and not at our Fan Page anymore.</p>';
			$message .= '<p>Thank you.<br>Admin,<br>www.tutorkami.com</p>';
			$message .= "</body></html>";

			$this->system->mailGunEmail($userRow['u_displayname'], $userRow['u_email'], $emailSubject, $message);
        }
		
	}
	
	function DeleteUser($u_id) {
		if ($u_id == 1) {
			Session::SetFlushMsg("error", 'You don\'t have permission to delete this user.');
	        return false;
		} else {
			$res = $this->db->query("DELETE FROM ".DB_PREFIX."_user_details WHERE ud_u_id = '".$u_id."'");
			if ($res) {
				Session::SetFlushMsg("success", 'User deleted successfully.');
				return $this->db->query("DELETE FROM ".DB_PREFIX."_user WHERE u_id = '".$u_id."'");
			}			
		}
	}
	
	function SaveProfile($data) {
		$data = $this->RealEscape($data);
		if($this->db->query("UPDATE ".DB_PREFIX."_user SET u_fname = '".$data['u_fname']."', u_lname = '".$data['u_lname']."', u_email = '".$data['u_email']."', u_update_by = '".$_SESSION[DB_PREFIX]['u_id']."', u_update_on = '".date('Y-m-d H:i:s')."', u_update_from = '".$_SERVER['REMOTE_ADDR']."' WHERE u_id = '".$data['u_id']."'")) {
			return 1;
		} else {
			return 0;
		}
	}

	public function TutorsJob($u_email) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_job WHERE j_hired_tutor_email = '".$u_email."'");
	}

	public function ClientsJob($u_email) {
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_job WHERE j_email = '".$u_email."'");
	}

	function GetUserByEmail($umail){
		return $this->db->query("SELECT * FROM ".DB_PREFIX."_user WHERE u_email = '".$umail."'");
	}
	
	/*
	Change Password
	=============================
	Param : u_id, oldPassword, newPassword, newPassword2
	Return :
		0 =>	Failure
		1 =>	Success
		2 =>	Old Password Mismatch
		3 =>	Confirm Password Mismatch
	*/
	function SavePassword($data) {
		$data = $this->RealEscape($data);
		$arrUser = $this->GetUserDetail($data['u_id']);
		if(md5($data['oldPassword'])==$arrUser['u_password']) {
			if($data['newPassword']==$data['newPassword2']) {
				if($this->db->query("UPDATE ".DB_PREFIX."_user SET u_password = '".md5($data['newPassword'])."' WHERE u_id= '".$data['u_id']."'")) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 3;
			}
		} else {
			return 2;
		}
	}
	
	function ResetUserPassword($u_id) {
		$passwd = $this->GenRand(10);
		if($this->db->query("UPDATE ".DB_PREFIX."_user SET u_password = '".md5($passwd)."' WHERE u_id = '".$u_id."'")) {
			$arrMailTo = array();
			$resAdmin = $this->db->query("SELECT * FROM ".DB_PREFIX."_user WHERE u_role = '1'");
			while($arrAdmin = $resAdmin->fetch_assoc()) {
				array_push($arrMailTo, $arrAdmin['u_email']);
			}
			$userData = $this->GetUserDetail($u_id);
			array_push($arrMailTo, $userData['u_email']);
			$mailTo = implode(',',$arrMailTo);
			$mailFrom = 'The SmartCat <india.smartcat@gmail.com>';
			$name = $userData['u_fname'].' '.$userData['u_lname'];
			$username = $userData['u_username'];
			$password = $passwd;
			$html = 
<<<EOD
Hello $name,
<br>
Your account password reset was complete. Your new login details as follows.<br>
<table border="0">
  <tr>
	<td>Username</td>
	<td>:</td>
	<td>$username</td>
  </tr>
  <tr>
	<td>Password</td>
	<td>:</td>
	<td>$password</td>
  </tr>
</table>
<br>
<br>
Admin
EOD;
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$mailFrom . "\r\n";
			@mail($mailTo, 'Reset Password', $html, $headers);
			return 1;
		} else {
			return 0;
		}
	}
	function ResetAdminPassword($data){
	    if($data['pass']!=$data['cpass']){
	    	return 2;
	    }
	    else{
        if($this->db->query("UPDATE ".DB_PREFIX."_user SET u_password = '".md5($data['pass'])."' WHERE u_id = '".$data['u_id']."'")){
            return 1;
        }
        else{
            return 0;
        }
       }
	}
	
	function UnlockUser($u_id) {
		return $this->db->query("UPDATE ".DB_PREFIX."_user SET u_failed_attempt = 0, u_locked = '0' WHERE u_id = '".$u_id."'");
	}
	
	function GenRand($strsize) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$size = strlen( $chars );
		$str = '';
		for( $j = 0; $j < $strsize; $j++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}

	public function GetLocationRate($lr_id = NULL) {
		$sql = "SELECT LR.*, JLT.jlt_title, JLT.jlt_title, CT.city_name, ST.st_name, C.c_name FROM ".DB_PREFIX."_location_rate AS LR 
		LEFT JOIN ".DB_PREFIX."_job_level_translation AS JLT ON JLT.jlt_jl_id = LR.lr_jl_id 
		LEFT JOIN ".DB_PREFIX."_cities AS CT ON CT.city_id = LR.lr_city_id 
		LEFT JOIN ".DB_PREFIX."_states AS ST ON ST.st_id = LR.lr_st_id 
		LEFT JOIN ".DB_PREFIX."_countries AS C ON C.c_id = LR.lr_c_id WHERE LR.lr_status = 'A' AND JLT.jlt_lang_code = 'en'";

		if($lr_id != ''){
			$sql .= " AND lr_id = '".$lr_id."'";
		}

		if($_SESSION[DB_PREFIX]['r_id']!=1){
			$sql .= " AND lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
		}
		
		return $this->db->query($sql);
	}

	public function SaveLocationRate($data) {

		if (isset($data['lr_id']) && $data['lr_id'] > 0) {

			$sql = "UPDATE ".DB_PREFIX."_location_rate SET 
				lr_jl_id = '".$data['lr_jl_id']."', 
				lr_c_id = '".$data['lr_c_id']."', 
				lr_st_id = '".$data['lr_st_id']."', 
				lr_city_id = '".$data['lr_city_id']."', 
				lr_rate = '".$data['lr_rate']."', 
				lr_status = 'A', 
				lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."',
				lr_create_date = '".date('Y-m-d H:i:s')."' 
			WHERE lr_id = '".$data['lr_id']."'";

		} else {

			$sql = "INSERT INTO ".DB_PREFIX."_location_rate SET 
				lr_jl_id = '".$data['lr_jl_id']."', 
				lr_c_id = '".$data['lr_c_id']."', 
				lr_st_id = '".$data['lr_st_id']."', 
				lr_city_id = '".$data['lr_city_id']."', 
				lr_rate = '".$data['lr_rate']."', 
				lr_status = 'A', 
				lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."',
				lr_create_date = '".date('Y-m-d H:i:s')."'";

		}

		$qry = $this->db->query($sql);

		return $qry;
	}

	public function GetUserTestimonial($user_id = NULL) {
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
	
}
?>