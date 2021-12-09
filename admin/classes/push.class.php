<?php
require_once('db.class.php');
class system extends db {
	var $db;
	function __construct() {
		$this->db = $this->con_db();
	}

	public function listUsers(){
       return $this->db->query("SELECT * FROM 1notif_user");
	}
	
	public function listNotification(){
       return $this->db->query("SELECT * FROM 1notif");
	}
	
	public function saveNotification($title, $msg, $time, $loop, $loop_every, $user){
		$result = $this->db->query(" INSERT INTO 1notif (title, notif_msg, notif_time, notif_repeat, notif_loop, username) VALUES('$title', '$msg', '$time', '$loop', '$loop_every', '$user') ");
		return $result;
	}

	public function loginUsers($username, $password){
        $qry = $this->db->query(" SELECT id as userid, username, password FROM 1notif_user WHERE username='$username' AND password='$password' ");
		$data= array();
		while ($row = $qry->fetch_array(MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}

	public function listNotificationUser($user){
        $qry = $this->db->query(" SELECT * FROM 1notif WHERE username='$user' AND notif_loop > 0 AND notif_time <= CURRENT_TIMESTAMP() ");
		$data= array();
		while ($row = $qry->fetch_array(MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}

	public function updateNotification($id, $nextTime) {		
		$result = $this->db->query(" UPDATE 1notif SET notif_time = '$nextTime', publish_date=CURRENT_TIMESTAMP(), notif_loop = notif_loop-1 WHERE id='$id') ");
		return $result;
		
	}



}
?>