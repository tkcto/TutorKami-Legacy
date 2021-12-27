<?php
/*
************************************************
** Page Name     : APIUser.php 
** Page Author   : Subhadeep Chowdhury
** Created On    : 06/06/2017
************************************************
*/
require_once('../admin/classes/db.class.php');
class APICms extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
		$this->handler = new RestHandler();
	}
	
	public function GetContent($cms_id = NULL,$lang = NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_page_manage_translation";
		if ($cms_id != '') {
			$sql .= " WHERE pmt_pm_id = {$cms_id} AND pmt_lang_code = '{$lang}'";
		}

	   return $this->db->query($sql);
	}

	public function GetSlider(){
		$sql = "SELECT * FROM ".DB_PREFIX."_slider WHERE sl_status = 'A'";
		return $this->db->query($sql);
	}

	public function GetTutor(){
		$sql = "SELECT U.*, UD.* FROM ".DB_PREFIX."_user AS U ";
        $sql .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        /*$sql .= "WHERE U.u_role = 3 AND U.u_status = 'A' ORDER BY U.u_create_date DESC LIMIT 0,3";*/
        /*$sql .= "WHERE U.u_role = 3 AND U.u_status = 'A' ORDER BY RAND() LIMIT 0,3";*/
		$sql .= "WHERE U.u_role = 3 AND U.u_status = 'A' ORDER BY u_id DESC LIMIT 0,3";
		
		return $this->db->query($sql);
	}

	public function GetTutor2(){
		$sql = "SELECT U.*, UD.* FROM ".DB_PREFIX."_user AS U ";
        $sql .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";
        /*$sql .= "WHERE U.u_role = 3 AND U.u_status = 'A' ORDER BY U.u_create_date DESC LIMIT 0,3";*/
        /*$sql .= "WHERE U.u_role = 3 AND U.u_status = 'A' ORDER BY RAND() LIMIT 0,3";*/
		$sql .= "WHERE (U.u_id='1580709' OR U.u_id='1088046' OR U.u_id='467701' OR U.u_id='1558683') AND U.u_role = 3 AND U.u_status = 'A' ORDER BY u_id DESC LIMIT 0,4";
		
		return $this->db->query($sql);
	}
	
    public function GetLanguage(){
		$sql = "SELECT * FROM ".DB_PREFIX."_languages";
		return $this->db->query($sql);
	}

	public function GetDefaultLanguage(){
		$sql = "SELECT * FROM ".DB_PREFIX."_languages WHERE lang_status = 'default' ";
		$dlang = $this->db->query($sql)->fetch_assoc();
		return $dlang['lang_code'];
	}

	public function SelectedLanguage($lang=NULL){
		$sql = "SELECT * FROM ".DB_PREFIX."_languages WHERE lang_code = '{$lang}'";
		return $this->db->query($sql);
	}

	public function GetSettings($set_name){
		$sql = "SELECT * FROM ".DB_PREFIX."_site_settings WHERE ss_settings_name = '{$set_name}'";
		return $this->db->query($sql);		  
	}

    function GetLanguageSEOContent($current_page, $lang_code){
    	$sql = "SELECT * FROM ".DB_PREFIX."_seo_manage AS SM LEFT JOIN ".DB_PREFIX."_seo_manage_translation AS SMT ON SMT.smt_sm_id = SM.sm_id WHERE SM.sm_page_url = '{$current_page}' AND SMT.smt_lang_code = '{$lang_code}'";
    	
    	return $this->db->query($sql);
    }

    function GetLanguageRESContent($lang_code){
      $sql = "SELECT RM.rm_target_res, RMT.rmt_resourcevalue, RMT.rmt_lang_code FROM ".DB_PREFIX."_res_manage AS RM LEFT JOIN ".DB_PREFIX."_res_manage_translation AS RMT ON RMT.rmt_rm_id = RM.rm_id WHERE RMT.rmt_lang_code = '{$lang_code}'";
      return $this->db->query($sql);
    }
	
}
?>