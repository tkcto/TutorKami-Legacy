<?php
/*
************************************************
** Page Name     : location.class.php
** Page Author   : Subhadeep Chowdhury
** Created On    : 01/06/2017
************************************************
*/
require_once('db.class.php');
class location extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}

	function GetAllCountry($country_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_countries";
		if ($country_id != '') {
			$sql .= " WHERE c_id = {$country_id}";
		}

		return $this->db->query($sql);
	}

	function CountryWiseState($country_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_states WHERE st_c_id = {$country_id}";
		return $this->db->query($sql);
		// $fh = fopen('textfilebaru.txt', 'w');
  //               fwrite($fh, $sql);
	}

	function StateWiseCity($state_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_st_id = {$state_id} ORDER BY city_name ASC";
		return $this->db->query($sql);
	}

	function GetCity($city_id = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = {$city_id}";
		return $this->db->query($sql);
	}

	function UserWiseState($user_id, $state_id) {

		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_area_cover";
		if ($user_id != '' && $state_id != '') {
			$sql .= " WHERE tac_u_id = {$user_id} AND tac_st_id = {$state_id}";
		}

		return $this->db->query($sql);
	}

	function UserWiseOtherState($user_id, $state_id) {
		
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_area_cover WHERE tac_other != ''";
		if ($user_id != '' && $state_id != '') {
			$sql .= " AND tac_u_id = {$user_id} AND tac_st_id = {$state_id}";
		}
		$res = '';
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
			$row = $qry->fetch_array(MYSQLI_ASSOC);
			$res = $row['tac_other'];
		}
		return $res;
	}
	
	public function UserWiseCity($user_id) {
		
		$sql = "SELECT tac_u_id,tac_city_id FROM ".DB_PREFIX."_tutor_area_cover WHERE tac_u_id = '".$user_id."'";
		    // $fh = fopen('textfilebaru.txt', 'w');
      //       fwrite($fh, $sql);
		$result = $this->db->query($sql);
		$city_arr = array();

		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_array($result))
			{
				$tac_city_id = $row['tac_city_id'];

				array_push($city_arr,$tac_city_id);
			}
			return $city_arr;
			// var_dump($city_arr);die;
		}
			 // $city_arr =  array_push($city_arr,$row['tac_city_id']);
	}
	
}
