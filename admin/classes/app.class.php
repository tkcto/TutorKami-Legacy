<?php
/*
************************************************
** Page Name     : app.class.php 
** Page Author   : Durga Charan Garai
** Created On    : 24/05/2017
************************************************
*/
require_once('db.class.php');
class app extends db {
	
	var $db;
	
	function __construct() {
		$this->db = $this->con_db();
	}
 
	/*Functions for Language management*/
	function SaveLanguage($data,$files){
	   
		
		if($data['lang_id']=='') {
			if ($files['lang_flag']['size'] > 0) {
			      $flagname = $files['lang_flag']['name'];
			      $flagtemp = $files['lang_flag']['tmp_name'];
			      $flagext  = explode(".", $flagname);
			      $flagext  = end($flagext);
			      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp','gif');

			      if(in_array($flagext, $allowedext)){
			        move_uploaded_file($flagtemp, "upload/".$flagname);
			        $flag_path = "upload/".$flagname;


			        if($this->db->query("INSERT INTO ".DB_PREFIX."_languages(lang_code,lang_name,lang_flag,lang_status,lang_create_date,lang_country_id) VALUES('".$data['lang_code']."','".$data['lang_name']."','".$flag_path."','".$data['lang_status']."','".date('Y-m-d H:i:s')."','".$_SESSION[DB_PREFIX]['u_country_id']."')")) {

						Session::SetFlushMsg("success", 'Language Added Successfully.');
					} 
					else {
						Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
					}
			      }
			      else{

				  Session::SetFlushMsg("Error",'Not an allowed file type.');
				}
			      
			    }
			else{
			    	Session::SetFlushMsg("Error",'No Flag Choosen, Please Choose a Flag!');

			    }
			
			}else {
		 	if($files['lang_flag']['size'] > 0){

		    $resImage = $this->db->query("SELECT * FROM ".DB_PREFIX."_languages WHERE lang_id ='".$data['lang_id']."'");
			$arrImage = $resImage->fetch_assoc();

			if($arrImage['lang_flag']!='') unlink($arrImage['lang_flag']);

	        $flagname = $files['lang_flag']['name'];
			$flagtemp = $files['lang_flag']['tmp_name'];
			$flagext  = explode(".", $flagname);
			$flagext  = end($flagext);
			$allowedext      = array('jpg', 'jpeg', 'png', 'bmp','gif');

		    if(in_array($flagext, $allowedext)){
		       move_uploaded_file($flagtemp, "upload/".$flagname);
		       $flag_path = "upload/".$flagname;

		       $q = "UPDATE ".DB_PREFIX."_languages SET lang_code = '".$data['lang_code']."',lang_name='".$data['lang_name']."' ,lang_flag ='".$flag_path."', lang_status='".$data['lang_status']."', lang_modified_date='".date('Y-m-d H:i:s')."'  WHERE lang_id = '".$data['lang_id']."'";
				if($this->db->query($q)) {
					Session::SetFlushMsg("success", 'Language Updated Successfully.');
				} else {
					Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
				}
		    }
		    else{
		    	Session::SetFlushMsg("Error",'Not an allowed file type.');
		    }
	      }
	      else{
	      	 $q = "UPDATE ".DB_PREFIX."_languages SET lang_code = '".$data['lang_code']."',lang_name='".$data['lang_name']."', lang_status='".$data['lang_status']."', lang_modified_date='".date('Y-m-d H:i:s')."'  WHERE lang_id = '".$data['lang_id']."'";
				if($this->db->query($q)) {
					Session::SetFlushMsg("success", 'Language Updated Successfully.');
				} else {
					Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
				}
	      }
	  }
	}

  	function FetchLanguage(){
  		$sql = "SELECT * FROM ".DB_PREFIX."_languages";
   	   	/*if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   		$sql .= " WHERE lang_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."' OR lang_status = 'default'";
   	   	}*/
   	   	return $this->db->query($sql);
  	}

  	function GetLanguage($lanid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_languages WHERE lang_id = '".$lanid."'")->fetch_assoc();
  	}

  	function DefaultLanguage(){
		$sql = "SELECT * FROM ".DB_PREFIX."_languages WHERE lang_status = 'default' ";
		$dlang = $this->db->query($sql)->fetch_assoc();
		return $dlang['lang_code'];
	}

  	function DeleteLanguage($lid){
  		$resImage = $this->db->query("SELECT * FROM ".DB_PREFIX."_languages WHERE lang_id ='".$lid."'");
		$arrImage = $resImage->fetch_assoc();
		if($arrImage['lang_flag']!='') unlink($arrImage['lang_flag']);
  		if($this->db->query("DELETE FROM ".DB_PREFIX."_languages WHERE lang_id = '".$lid."'")){
  	 		Session::SetFlushMsg("success", 'Language Deleted Successfully.');
  		} else {
	    	Session::SetFlushMsg("error", 'Deletion Sql failed.');
		}
  	}

 	/*Functions For Country Management*/

  	function SaveCountry($data){
       
		
		if($data['c_id']=='') {
			if($this->db->query("INSERT INTO ".DB_PREFIX."_countries(c_iso,c_name,c_nicename,c_iso3,c_numcode,c_phonecode,c_status) VALUES('".$data['c_iso']."','".$data['c_name']."','".$data['c_nicename']."','".$data['c_iso3']."','".$data['c_numcode']."','".$data['c_phonecode']."','".$data['c_status']."')")) {
				Session::SetFlushMsg("success", 'Country Added Successfully.');
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.');
			}
		} else {
			$q = "UPDATE ".DB_PREFIX."_countries SET c_iso = '".$data['c_iso']."',c_name='".$data['c_name']."' ,c_nicename='".$data['c_nicename']."' ,c_iso3='".$data['c_iso3']."' ,c_numcode='".$data['c_numcode']."' ,c_phonecode='".$data['c_phonecode']."' ,c_status='".$data['c_status']."'  WHERE c_id = '".$data['c_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Country Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.');
			}
		}
		
  	}

  	function FetchCountry(){
	  	$sql = "SELECT * FROM ".DB_PREFIX."_countries";
	  	if($_SESSION[DB_PREFIX]['r_id']!=1){
		 	$sql .= " WHERE c_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
		}

	 	return $this->db->query($sql); 	 
  	}

  	function GetCountry($cid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_countries WHERE c_id = '".$cid."'")->fetch_assoc();
  	}

  	function DeleteCountry($cid){
  		if($this->db->query("DELETE FROM ".DB_PREFIX."_countries WHERE c_id = '".$cid."'")){
  	 		Session::SetFlushMsg("success", 'Country Deleted Successfully.');
  		}
  		else {
	    	Session::SetFlushMsg("error", 'Deletion Sql failed.');
		}
  	}

  	/*Functions for State Management*/
  	function FetchStatesByCountry($cid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_states WHERE st_c_id = '" . $cid . "'");
  	}

  	function SaveState($data){
       
		
		if($data['st_id']=='') {
			if($this->db->query("INSERT INTO ".DB_PREFIX."_states(st_name,st_name_bm,st_c_id,st_status) VALUES('".$data['st_name']."','".$data['st_name_bm']."','".$data['st_c_id']."','".$data['st_status']."')")) {
				Session::SetFlushMsg("success", 'State Added Successfully.');
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.');
			}
		} else {
			$q = "UPDATE ".DB_PREFIX."_states SET st_name='".$data['st_name']."' ,st_name_bm='".$data['st_name_bm']."' ,st_c_id='".$data['st_c_id']."' ,st_status='".$data['st_status']."'  WHERE st_id = '".$data['st_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Country Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.');
			}
		}
		
  	}

  	function FetchState(){

  		$sql = "SELECT * FROM ".DB_PREFIX."_states";
  		if($_SESSION[DB_PREFIX]['r_id']!=1){
	 		$sql .= " WHERE st_c_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
		}

 		return $this->db->query($sql);
  	}

  	function DeleteState($sid){
  		if($this->db->query("DELETE FROM ".DB_PREFIX."_states WHERE st_id = '".$sid."'")){
  	 		Session::SetFlushMsg("success", 'State Deleted Successfully.');
  	 	}
  	 	else {
	    	Session::SetFlushMsg("error", 'Deletion Sql failed.');
	 	}
  	}

  	function GetState($sid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_states WHERE st_id = '".$sid."'")->fetch_assoc();
  	}


  	/*Function for City Management*/

  	function FetchCitiesByState($sid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_cities WHERE city_st_id = '" . $sid . "'");
  	}

  	function SaveCity($data){
       
		
		if($data['ct_id']=='') {
			
			
			$qry2 = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_name LIKE '".$data['city_name']."' AND city_st_id =  '".$data['city_st_id']."' ";
			$result2 = $this->db->query($qry2);
			if($result2->num_rows > 0){
				//$row = mysqli_fetch_array($result2);
				Session::SetFlushMsg("error", 'Existing City..');
				return false;
			}else{
				if($this->db->query("INSERT INTO ".DB_PREFIX."_cities(city_name,city_c_id,city_st_id,city_status) VALUES('".$data['city_name']."','".$data['city_c_id']."','".$data['city_st_id']."','".$data['city_status']."')")) {
					Session::SetFlushMsg("success", 'City Added Successfully.');
					
					return true;
				} else {
					Session::SetFlushMsg("error", 'Insert Sql failed.'.$this->db->error);
					return false;
				}
			}
			


		} else {
				$q = "UPDATE ".DB_PREFIX."_cities SET city_name='".$data['city_name']."' ,city_c_id='".$data['city_c_id']."',city_st_id='".$data['city_st_id']."' ,city_status='".$data['city_status']."'  WHERE city_id = '".$data['ct_id']."'";
				if($this->db->query($q)) {
					Session::SetFlushMsg("success", 'City Updated Successfully.');
					return true;
				} else {
					Session::SetFlushMsg("error", 'Update Sql failed.');
					return false;
				}
		}
		
  	} 
  
  	function FetchCity(){

	  	/*$c = $this->FetchCountry();
	  	while($arrCnt = $c->fetch_assoc()) {
	  		$s = $this->db->query("SELECT * FROM ".DB_PREFIX."_states WHERE st_c_id = '".$arrCnt['c_id']."'");
	  		while($arrST = $s->fetch_assoc()) {
	  			echo $this->db->query("UPDATE ".DB_PREFIX."_cities SET city_c_id='".$arrCnt['c_id']."' WHERE city_st_id = '".$arrST['st_id']."'");
	  		}
	  	}*/

	  	$sql = "SELECT * FROM ".DB_PREFIX."_cities";
		if($_SESSION[DB_PREFIX]['r_id']!=1){
		 	$sql .= " WHERE city_c_id = '".$_SESSION[DB_PREFIX]['u_country_id']."' ORDER BY city_name ASC";
		}
	 	return $this->db->query($sql);
  	}

  	function DeleteCity($ctid){
  		if($this->db->query("DELETE FROM ".DB_PREFIX."_cities WHERE city_id = '".$ctid."'")){
  	 		Session::SetFlushMsg("success", 'City Deleted Successfully.');
  	 	}
  		else {
	    	Session::SetFlushMsg("error", 'Deletion Sql failed.');
	 	}
  	}

  	function GetCity($ctid){
  		return $this->db->query("SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '".$ctid."'")->fetch_assoc();
  	}

  	/* Functions for Slider Management*/

  	function SaveSlider($data,$files){
  		if($data['sl_id']=='') {
		    if ($files['sl_image']['size'] > 0) {
		      $flagname = $files['sl_image']['name'];
		      $flagtemp = $files['sl_image']['tmp_name'];
		      $flagext  = explode(".", $flagname);
		      $flagext  = end($flagext);
		      $allowedext      = array('jpg', 'jpeg', 'png', 'bmp','gif');

		      if(in_array($flagext, $allowedext)){
		        move_uploaded_file($flagtemp, "../images/".$flagname);
		        $image_path = "images/".$flagname;
		      }
		      
		    }
			else{
			    	$image_path = "";
			}
				
		if(in_array($flagext, $allowedext) || ($files['sl_image']['size']==0)){		
			if($this->db->query("INSERT INTO ".DB_PREFIX."_slider(sl_image,sl_status,sl_create_date,sl_country_id) VALUES('".$image_path."','".$data['sl_status']."','".date('Y-m-d H:i:s')."','".$_SESSION[DB_PREFIX]['u_country_id']."')")) {

				$insert_id = $this->db->insert_id;

				foreach($data['sl-tl'] as $key=>$value){

                     $this->db->query("INSERT INTO ".DB_PREFIX."_slider_translation(slt_sl_id,slt_lang_code,slt_title,slt_description) VALUES('".$insert_id."','".$key."','".$value."','".$data['sl-ds'][$key]."')");
				
				}
				Session::SetFlushMsg("success", 'Slider Added Successfully.');
				
			} else {
				Session::SetFlushMsg("error", 'Insert Sql failed.');
			}
		}
		else{
			  Session::SetFlushMsg("Error",'Not an allowed file type.');
			}
	} else {
			   if($files['sl_image']['size'] > 0){
				$resImage = $this->db->query("SELECT * FROM ".DB_PREFIX."_slider WHERE sl_id ='".$data['sl_id']."'");
				$arrImage = $resImage->fetch_assoc();
				if($arrImage['sl_image']!='') unlink($arrImage['sl_image']);

				
				$flagname = $files['sl_image']['name'];
				$flagtemp = $files['sl_image']['tmp_name'];
				$flagext  = explode(".", $flagname);
				$flagext  = end($flagext);
				$allowedext  = array('jpg', 'jpeg', 'png', 'bmp','gif');

		        if(in_array($flagext, $allowedext)){
		          move_uploaded_file($flagtemp, "../images/".$flagname);
		          $image_path = "images/".$flagname;

				  $q = "UPDATE ".DB_PREFIX."_slider SET sl_image = '".$image_path."',sl_modified_date='".date('Y-m-d H:i:s')."',sl_status='".$data['sl_status']."' WHERE sl_id = '".$data['sl_id']."'";
                }
                else{
		    	  Session::SetFlushMsg("Error",'Not an allowed file type.');
		         }
		        }
                else{
                	$q = "UPDATE ".DB_PREFIX."_slider SET sl_modified_date='".date('Y-m-d H:i:s')."',sl_status='".$data['sl_status']."' WHERE sl_id = '".$data['sl_id']."'";
                }

				foreach($data['sl-tl'] as $key=>$value){
                  $this->db->query("UPDATE ".DB_PREFIX."_slider_translation SET slt_title = '".$value."',slt_description='".$data['sl-ds'][$key]."' WHERE slt_sl_id = '".$data['sl_id']."' AND slt_lang_code='".$key."'");
                 } 
			    if($this->db->query($q)) {
				  Session::SetFlushMsg("success", 'Slider Updated Successfully.');
			    } else {
				  Session::SetFlushMsg("error", 'Update Sql failed.');
			    }

			}
		
   }

   function FetchSlider(){
   	   $sql = "SELECT * FROM ".DB_PREFIX."_slider";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE sl_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }
   	   return $this->db->query($sql);
   	   
   }
   function GetDefaultLanguageSlider($slid){
   	  return $this->db->query("SELECT * FROM ".DB_PREFIX."_slider_translation WHERE slt_sl_id = '".$slid."'")->fetch_assoc();
   }
   function DeleteSlider($slid){
   	  $resImage = $this->db->query("SELECT * FROM ".DB_PREFIX."_slider WHERE sl_id ='".$slid."'");
	  $arrImage = $resImage->fetch_assoc();
	  if($arrImage['sl_image']!='') unlink($arrImage['sl_image']);
   	  if($this->db->query("DELETE FROM ".DB_PREFIX."_slider WHERE sl_id = '".$slid."'")){

   	  	$this->db->query("DELETE FROM ".DB_PREFIX."_slider_translation WHERE slt_sl_id = '".$slid."'");
  	 	Session::SetFlushMsg("success", 'Slider Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.');
	 }
    }
    function GetSlider($slid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_slider WHERE sl_id = '".$slid."'")->fetch_assoc();
    }
    function GetSliderTranslationBySlider($slid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_slider_translation WHERE slt_sl_id = '".$slid."'");
    }

    /**
    *
    *Functions for Course management
    *
    **/
    function SaveCourse($data){
    	if($data['tc_id']=='') {
			$c_id = ($_SESSION[DB_PREFIX]['r_id'] == 1) ? $data['tc_c_id'] : $_SESSION[DB_PREFIX]['u_country_id'];
						
			$countRow = "SELECT * FROM ".DB_PREFIX."_tution_course";
			$resultCount = $this->db->query($countRow);
			$totalCount = $resultCount->num_rows + 1;
			
			if($this->db->query("INSERT INTO ".DB_PREFIX."_tution_course(tc_title,tc_description,tc_status,tc_country_id,sort_by) VALUES('".$data['tc_title']."','".$data['tc_description']."','".$data['tc_status']."','".$c_id."','".$totalCount."')")) {
				Session::SetFlushMsg("success", 'Level Added Successfully.');

				
			} 
			else {
			    Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
			}
		} else {
			$c_id = ($_SESSION[DB_PREFIX]['r_id'] == 1) ? $data['tc_c_id'] : $_SESSION[DB_PREFIX]['u_country_id'];
			$q = "UPDATE ".DB_PREFIX."_tution_course SET tc_title = '".$data['tc_title']."',tc_description='".$data['tc_description']."' ,tc_status='".$data['tc_status']."',tc_country_id = '".$c_id."'  WHERE tc_id = '".$data['tc_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Level Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function GetCourse($tcid = NULL){
    	$sql = "SELECT * FROM ".DB_PREFIX."_tution_course";
    	if ($tcid != '') {
    		$sql .= " WHERE tc_id = '".$tcid."'";
    	}
		$sql .= "ORDER BY tc_title ASC";
    	return $this->db->query($sql)->fetch_assoc();
    }
    function ListCourse($tcid = NULL){
    	$sql = "SELECT * FROM ".DB_PREFIX."_tution_course";
    	if ($tcid != '') {
    		$sql .= " WHERE tc_id = '".$tcid."'";
    	}
		$sql .= "ORDER BY tc_title ASC";
    	return $this->db->query($sql);
    }
    function ListCourseNew(){
    	$sql = "SELECT * FROM ".DB_PREFIX."_tution_course ORDER BY sort_by ASC";
    	return $this->db->query($sql);
    }
    function FetchCourse(){
       $sql = "SELECT * FROM ".DB_PREFIX."_tution_course AS TC 
       LEFT JOIN ".DB_PREFIX."_countries AS C ON C.c_id = TC.tc_country_id";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE TC.tc_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }
	   $sql .= "ORDER BY sort_by ASC";
   	   return $this->db->query($sql);
    	
    }
    function DeleteCourse($tcid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_tution_course WHERE tc_id = '".$tcid."'")){
  	 	Session::SetFlushMsg("success", 'Course Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	 }
    }
	
	public function UserWiseCourse($user_id, $course_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject";
		if ($user_id != '' && $course_id != '') {
			$sql .= " WHERE trs_u_id = {$user_id} AND trs_tc_id = {$course_id}";
		}

		return $this->db->query($sql);
	}
	
	public function UserWiseOtherCourse($user_id, $course_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."_tutor_subject WHERE trs_other != ''";
		if ($user_id != '' && $course_id != '') {
			$sql .= " AND trs_u_id = {$user_id} AND trs_tc_id = {$course_id}";
		}
		$res = '';
		$qry = $this->db->query($sql);
		if ($qry->num_rows > 0) {
			$row = $qry->fetch_array(MYSQLI_ASSOC);
			$res = $row['trs_other'];
		}
		return $res;
	}
	
	public function UserWiseSubject($user_id) {
		$sql = "SELECT trs_u_id,trs_ts_id FROM ".DB_PREFIX."_tutor_subject WHERE trs_u_id = '".$user_id."'";

		$result = $this->db->query($sql);
		$subject_arr = array();

		if ($result->num_rows > 0) {
			while($row = mysqli_fetch_array($result))
			{
				$trs_ts_id = $row['trs_ts_id'];

				array_push($subject_arr,$trs_ts_id);
			}
			return $subject_arr;
			// var_dump($subject_arr);die;
		}
	}

	
    /**
    *
    *Functions for Subject Management
    *
    **/
    function SaveSubject($data){
    	if($data['ts_id']=='') {
			$c_id = ($_SESSION[DB_PREFIX]['r_id'] == 1) ? $data['ts_c_id'] : $_SESSION[DB_PREFIX]['u_country_id'];
			if($this->db->query("INSERT INTO ".DB_PREFIX."_tution_subject(ts_tc_id,ts_title,ts_description,ts_status,ts_country_id) VALUES('".$data['ts_tc_id']."','".$data['ts_title']."','".$data['ts_description']."','".$data['ts_status']."','".$c_id."')")) {
				Session::SetFlushMsg("success", 'Subject Added Successfully.');
               } 
			else {
				Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
			   }
		} else {
			$c_id = ($_SESSION[DB_PREFIX]['r_id'] == 1) ? $data['ts_c_id'] : $_SESSION[DB_PREFIX]['u_country_id'];
			$q = "UPDATE ".DB_PREFIX."_tution_subject SET ts_tc_id='".$data['ts_tc_id']."',ts_title = '".$data['ts_title']."',ts_description='".$data['ts_description']."' ,ts_status='".$data['ts_status']."', ts_country_id = '".$c_id."' WHERE ts_id = '".$data['ts_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Course Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function GetSubject($tsid = NULL){
    	
    	$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject";
    	if ($tsid != '') {
    		$sql .= " WHERE ts_id = '".$tsid."'";
    	}
    	return $this->db->query($sql)->fetch_assoc();
    }
    function CourseWiseSubject($tcid = NULL){
    	$sql = "SELECT * FROM ".DB_PREFIX."_tution_subject";
    	
    	if ($tcid != '') {
    		$sql .= " WHERE ts_tc_id = '".$tcid."'";
    	}
    	return $this->db->query($sql);
    }
    function FetchSubject(){
       $sql = "SELECT * FROM ".DB_PREFIX."_tution_subject AS TS 
       LEFT JOIN ".DB_PREFIX."_countries AS C ON C.c_id = TS.ts_country_id";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE TS.ts_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }
   	   $sql .= "ORDER BY ts_tc_id, ts_title ASC";
   	   // $fh = fopen('textfilebaru.txt', 'w');
       //      fwrite($fh, $sql);

   	   return $this->db->query($sql);
    	
    }
    function DeleteSubject($tsid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_tution_subject WHERE ts_id = '".$tsid."'")){
  	 	Session::SetFlushMsg("success", 'Subject Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	 }
    }


    function edit_settings($data){
    	if($_FILES['COMPANY_LOGO']["tmp_name"] != ''){
				$resImage = $this->db->query("SELECT * FROM ".DB_PREFIX."_site_settings WHERE ss_settings_name ='COMPANY_LOGO'");
				$arrImage = $resImage->fetch_assoc();
				unlink('upload/'.$arrImage['ss_settings_value']);

				$name = $_FILES['COMPANY_LOGO']['name'];
				$file_tmp = $_FILES['COMPANY_LOGO']['tmp_name'];
				$image_path = 'upload/'.$name;
				move_uploaded_file($file_tmp,"$image_path");
	    
			

			$this->db->query("UPDATE ".DB_PREFIX."_site_settings SET ss_settings_value='".$name."'  WHERE ss_settings_name = 'COMPANY_LOGO' ");
		}

	  	foreach ($data as $k=>$v) {
			if ($k != 'CONTACT_EMAIL') {
				$this->db->query("UPDATE ".DB_PREFIX."_site_settings SET ss_settings_value='".$data[$k]."'  WHERE ss_settings_name = '".$k."' ");
			}
		}

		$this->db->query("UPDATE ".DB_PREFIX."_user SET u_email='".$data['CONTACT_EMAIL']."' WHERE u_id = '1' ");
		
		Session::SetFlushMsg("success", 'Site Settings Updated Successfully.');
			
	}

	function GetSettings(){
		$res =  $this->db->query("SELECT * FROM ".DB_PREFIX."_site_settings");

        $details_array = array();
		

		while($arr = $res->fetch_assoc()) {
			
			$details_array[$arr['ss_settings_name']] = $arr['ss_settings_value'];
		}
		
		return $details_array;
 	}

	function SaveContent($data){
	 	$flag = 0;
    	if($data['pm_id']=='') {
			Session::SetFlushMsg("error", 'Page ID is missing for update.');
			return false;
			
            if($this->db->query("INSERT INTO ".DB_PREFIX."_page_manage(pm_status,pm_country_id) VALUES('".$data['pm_status']."','".$_SESSION[DB_PREFIX]['u_country_id']."')")) {

				$insert_id = $this->db->insert_id;

				foreach($data['pmt_pagename'] as $key=>$value){

                    if($this->db->query("INSERT INTO ".DB_PREFIX."_page_manage_translation(pmt_pm_id,pmt_lang_code,pmt_pagename,pmt_subtitle,pmt_pagedetail) VALUES('".$insert_id."','".$key."','".$value."','".$data['pmt_subtitle'][$key]."','".$data['pmt_pagedetail'][$key]."')")){
                    	$flag = 1;
                    }
                }
				if($flag==1){
					Session::SetFlushMsg("success", 'Content Added Successfully.');					
				}else {
					Session::SetFlushMsg("error", 'Insert Sql failed.'.$this->db->error);
				}
			} /*else {
				Session::SetFlushMsg("error", 'Insert Sql failed.'.$this->db->error;);
			}*/
		} else {
			

			$q = "UPDATE ".DB_PREFIX."_page_manage SET pm_status='".$data['pm_status']."' WHERE pm_id = '".$data['pm_id']."'";

				foreach($data['pmt_pagename'] as $key=>$value){
                  $this->db->query("UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagename = '".$value."',pmt_subtitle='".$data['pmt_subtitle'][$key]."',pmt_pagedetail='".$data['pmt_pagedetail'][$key]."' WHERE pmt_pm_id = '".$data['pm_id']."' AND pmt_lang_code='".$key."'");
                     
				
				} 
			    if($this->db->query($q)) {
				  Session::SetFlushMsg("success", 'Content Updated Successfully.');
			    } else {
				  Session::SetFlushMsg("error", 'Update Sql failed.');
			    }
		}
    }

    function GetContent($pmid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_page_manage WHERE pm_id = '".$pmid."'")->fetch_assoc();
    }

    function GetContentTranslationByContent($cid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_page_manage_translation WHERE pmt_pm_id = '".$cid."'");
    }

    function FetchContent(){
       $sql = "SELECT * FROM ".DB_PREFIX."_page_manage";
   	   /*if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE pm_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }*/
   	   return $this->db->query($sql);
    	
    }

    function GetDefaultLanguageContent($cid){
   	  return $this->db->query("SELECT * FROM ".DB_PREFIX."_page_manage_translation WHERE pmt_pm_id = '".$cid."'")->fetch_assoc();
    }

    function DeleteContent($pmid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_page_manage WHERE pm_id = '".$pmid."'")){
			$this->db->query("DELETE FROM ".DB_PREFIX."_page_manage_translation WHERE pmt_pm_id = '".$pmid."'");	
			Session::SetFlushMsg("success", 'Content Deleted Successfully.');
  		} else {
  			Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error());
  		}
    }

    /* SEO */

    function FetchSEOContent(){
       $sql = "SELECT * FROM ".DB_PREFIX."_seo_manage";
   	   /*if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE sm_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }*/
   	   return $this->db->query($sql);
    	
    }

    function GetLanguageSEOContent($sm_id, $lang_code){
    	$sql = "SELECT * FROM ".DB_PREFIX."_seo_manage_translation WHERE smt_sm_id = '".$sm_id."' AND smt_lang_code = '".$lang_code."'";
    	$res = $this->db->query($sql);
    	if ($res->num_rows == 0) {    		
    		$this->db->query("INSERT INTO ".DB_PREFIX."_seo_manage_translation SET smt_lang_code = '".$lang_code."', smt_sm_id = '".$sm_id."'");

    		$res = $this->db->query($sql);
    	}
   	  	return $res->fetch_assoc();
    }

    function UpdateSEOContent($data){
	 	$flag = 0;
    	if($data['sm_id']=='') {
			Session::SetFlushMsg("error", 'Page ID is missing for update.');
			return false;			
		} else {
			$sql = "UPDATE ".DB_PREFIX."_seo_manage_translation SET 
				".$data['column']." = '".$this->db->real_escape_string($data['value'])."' 
			WHERE 
				smt_sm_id = '".$data['sm_id']."' AND smt_id = '".$data['smt_id']."'";

			return $this->db->query($sql);
		}
    }

    /* Localization */

    function FetchRESContent(){
       	$sql = "SELECT * FROM ".DB_PREFIX."_res_manage";
       	/*if($_SESSION[DB_PREFIX]['r_id']!=1){
        	$sql .= " WHERE rm_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
       	}*/
       	return $this->db->query($sql);
      
    }

    function GetLanguageRESContent($rm_id, $lang_code){
      	$sql = "SELECT * FROM ".DB_PREFIX."_res_manage_translation WHERE rmt_rm_id = '".$rm_id."' AND rmt_lang_code = '".$lang_code."'";

      	$res = $this->db->query($sql);
      	if ($res->num_rows == 0) {
      		$insertsql = "INSERT INTO ".DB_PREFIX."_res_manage_translation SET rmt_lang_code = '".$lang_code."', rmt_rm_id = '".$rm_id."'";
	        $this->db->query($insertsql);

	        $res = $this->db->query($sql);
      	}
        return $res->fetch_assoc();
    }

    function UpdateRESContent($data){
	    $flag = 0;
	      if($data['rm_id']=='') {
	      Session::SetFlushMsg("error", 'Page ID is missing for update.');
	      return false;     
	    } else {
	    	if ($data['column'] == 'rm_target_res') {
	    		$sql = "UPDATE ".DB_PREFIX."_res_manage SET 
			        rm_target_res = '".$this->db->real_escape_string($data['value'])."' 
			      WHERE 
			        rm_id = '".$data['rm_id']."'";
	    	} else {
	    		$sql = "UPDATE ".DB_PREFIX."_res_manage_translation SET 
		        ".$data['column']." = '".$this->db->real_escape_string($data['value'])."' 
		      WHERE 
		        rmt_rm_id = '".$data['rm_id']."' AND rmt_id = '".$data['rmt_id']."'";
	    	}

	      	return $this->db->query($sql);
	    }
    }

    /*
    *
    *Functions for Payment History Management
    *
    */

    function SavePayment($data){
    	if($data['ph_id']=='') {
			
			if($this->db->query("INSERT INTO ".DB_PREFIX."_payment_history(ph_user_type,ph_user_id,ph_date,ph_job_id,ph_amount,ph_receipt) VALUES('".$data['ph_user_type']."','".$data['ph_user_id']."','".$data['ph_date']."','".$data['ph_job_id']."','".$data['ph_amount']."','".$data['ph_receipt']."')")) {
				Session::SetFlushMsg("success", 'Payment Added Successfully.');
               } 
			else {
				Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
			   }
		} else {
			$q = "UPDATE ".DB_PREFIX."_payment_history SET ph_user_type='".$data['ph_user_type']."',ph_user_id = '".$data['ph_user_id']."',ph_date='".$data['ph_date']."' ,ph_job_id='".$data['ph_job_id']."',ph_amount='".$data['ph_amount']."',ph_receipt='".$data['ph_receipt']."'  WHERE ph_id = '".$data['ph_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Payment Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function FetchPayment(){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_payment_history");
    }
    function GetPayment($phid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_payment_history WHERE ph_id = '".$phid."'")->fetch_assoc();
    }
    
    function DeletePayment($phid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_payment_history WHERE ph_id = '".$phid."'")){
  	 		Session::SetFlushMsg("success", 'Payment Deleted Successfully.');
  		} else {
  			Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
  		}
    }
    /*
    *
    *Functions for Classes Management
    *
    */
    // luqman







	function is_positive_integer($str) {
		return (is_numeric($str) && $str > 0 && $str == round($str));
	}
	


	function SaveClasses($data){
		if($data['cl_id']=='') {
    		$qry = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_tutor_id']."'";
    		$result =  $this->db->query($qry);
    		if($result->num_rows > 0){
    			while($row = mysqli_fetch_array($result)){
					$cl_tutor_id =  $row['u_id'];
				}

				$qry2 = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_student_id']."'";
				$result2 = $this->db->query($qry2);
				if($result2->num_rows > 0){
					while($row = mysqli_fetch_array($result2)){
						$cl_student_id = $row['u_id'];
					}
					
    				$qryClasses = "SELECT cl_display_id FROM tk_classes WHERE cl_display_id =  '".$data['cl_display_id']."'";
    				$resultClasses = $this->db->query($qryClasses);
    				if($resultClasses->num_rows > 0){
    				    Session::SetFlushMsg("info", 'Existing Class.');
    				}else{
    					if($this->db->query("INSERT INTO ".DB_PREFIX."_classes(cl_display_id,cl_student,cl_student_id,cl_tutor_id,cl_subject,cl_rate,cl_charge_parent,cl_hours_balance,cl_cycle,cl_status,cl_country_id,cl_create_date) VALUES('".$data['cl_display_id']."','".$data['cl_student']."','".$cl_student_id."','".$cl_tutor_id."','".$data['cl_subject']."','".$data['cl_rate']."','".$data['cl_charge_parent']."','".$data['cl_cycle']."','".$data['cl_cycle']."','".$data['cl_status']."','".$_SESSION[DB_PREFIX]['u_country_id']."','".date('Y-m-d H:i:s')."')")) {
    						Session::SetFlushMsg("success", 'Class Added Successfully.');
    					} else {
    						Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
    					}    				    
    				}
				}
    		}
		} else {
            //Session::SetFlushMsg("success", 'test '.$data['cl_id']);
            //Session::SetFlushMsg("success", 'test '.$row['cr_id']);
            
    		//star fadhli - dapatkan latest tk_classes_record

    
    		//$qryClasses = "SELECT cr_balance, cr_status FROM tk_classes_record WHERE cr_cl_id = '".$data['cl_id']."' ORDER BY cr_id DESC";
    		$qryClasses = " SELECT cr_id, cr_balance, cr_status FROM tk_classes_record WHERE cr_cl_id = '".$data['cl_id']."' ORDER BY cr_date DESC, cr_start_time DESC ";
    		$resultClasses =  $this->db->query($qryClasses);
    		if ($resultClasses->num_rows > 0) {
    			$row = mysqli_fetch_array($resultClasses);
    			
    			Session::SetFlushMsg("success", 'Under Maintenance ..');
/*
    			$latestBalance =  $row['cr_balance'];
    			$newBalance = $data['cl_cycle'] + $latestBalance;
    			
                    // Transform hours like "1.45" into the total number of minutes, "105". 
                    function hoursToMinutes($hours) { 
                        $minutes = 0; 
                        if (strpos($hours, '.') !== false) 
                        { 
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
    
    
                    if ( $latestBalance < 0 ) {
                       //echo "negative";
                    	$convertNegative = abs($latestBalance);
                    
                    	$balTwoDecimalPlaces = number_format((float)$convertNegative, 2, '.', '');  // Outputs -> 105.00
                    	$balanceInMinutes = (hoursToMinutes($balTwoDecimalPlaces));
                    	
                    	$cycleHourTwoDecimalPlaces = number_format((float)$data['cl_cycle'], 2, '.', '');  // Outputs -> 105.00
                    	$cycleHourInMinutes = (hoursToMinutes($cycleHourTwoDecimalPlaces));
                    	
                    	$totalBalanceInMin = $cycleHourInMinutes - $balanceInMinutes;
                    	$newBalance2 = (minutesToHours($totalBalanceInMin));
                       
                       
                    }else{
                       //echo "positif";
                        $findDots = strpos($newBalance, '.');
                        if(is_int($findDots)){
                         //echo 'dot is found';
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
                         //echo 'dot not found';
                         $newBalance2 = $newBalance;
                        }
                    }
    
    			
    			
    			
    			
    			
    			
    			
    			
        			if((!is_positive_integer($row['cr_balance'])) && ($row['cr_status'] == "required parent to pay")) {
        				Session::SetFlushMsg("error", 'Required Parent To Pay.');
        			}else if(($row['cr_balance'] >= 0) && ($row['cr_status'] == "new")){
                		$qry = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_tutor_id']."'";
                		$result =  $this->db->query($qry);
                		if($result->num_rows > 0){
                			$row = mysqli_fetch_array($result);
                			$cl_tutor_id =  $row['u_id'];
            			}
            			$qry2 = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_student_id']."'";
            			$result2 = $this->db->query($qry2);
            			if($result2->num_rows > 0){
            				$row = mysqli_fetch_array($result2);
            				$cl_student_id = $row['u_id'];
            			}
            					$q = "UPDATE ".DB_PREFIX."_classes SET cl_display_id='".$data['cl_display_id']."',
            					cl_student_id = '".$cl_student_id."',
            					cl_tutor_id='".$cl_tutor_id."',
            					
            					cl_student = '".$data['cl_student']."',
            					cl_subject='".$data['cl_subject']."',
            					cl_rate='".$data['cl_rate']."',
            					cl_charge_parent='".$data['cl_charge_parent']."',
            					cl_status='".$data['cl_status']."',
            					cl_country_id='".$_SESSION[DB_PREFIX]['u_country_id']."' 
            					
            					WHERE cl_id = '".$data['cl_id']."'";
            					
            					if($this->db->query($q)) {
            						Session::SetFlushMsg("success", 'Class Updated Successfully.');
            					} else {
            						Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
            					}
        			}else{
        				//$qry = "UPDATE tk_classes SET cl_hours_balance='".$newBalance2."',cl_cycle='".$data['cl_cycle']."'  WHERE cl_id = '".$data['cl_id']."'";
        				$qry = "UPDATE tk_classes SET cl_hours_balance='".$newBalance2."' WHERE cl_id = '".$data['cl_id']."'";
        				$result = $this->db->query($qry);
        	
        				Session::SetFlushMsg("success", 'Now Is New Cycle');
        			}
    			
    			
*/
    			
    		}else{
    		    Session::SetFlushMsg("success", 'Under Maintenance ...');
/*
        		$qry = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_tutor_id']."'";
        		$result =  $this->db->query($qry);
        		if($result->num_rows > 0){
        			$row = mysqli_fetch_array($result);
    					$cl_tutor_id =  $row['u_id'];
    				
    
    				$qry2 = "SELECT u_id FROM tk_user WHERE u_email =  '".$data['cl_student_id']."'";
    				$result2 = $this->db->query($qry2);
    				if($result2->num_rows > 0){
    					$row = mysqli_fetch_array($result2);
    						$cl_student_id = $row['u_id'];
    					
    					
     					//cl_cycle= '".$data['cl_cycle']."',
    					$q = "UPDATE ".DB_PREFIX."_classes SET cl_display_id='".$data['cl_display_id']."',
    					cl_student_id = '".$cl_student_id."',
    					cl_tutor_id='".$cl_tutor_id."',
    					
    					cl_student = '".$data['cl_student']."',
    					cl_subject='".$data['cl_subject']."',
    					cl_rate='".$data['cl_rate']."',
    					cl_charge_parent='".$data['cl_charge_parent']."',
    					cl_hours_balance='".$data['cl_cycle']."',
    
    					cl_status='".$data['cl_status']."',
    					cl_country_id='".$_SESSION[DB_PREFIX]['u_country_id']."'
    					WHERE cl_id = '".$data['cl_id']."'";
    					if($this->db->query($q)) {
    						Session::SetFlushMsg("success", 'Class Updated Successfully.');
    					} else {
    						Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
    					}
    				}
        		}
*/
    			
    		}
    		//end fadhli

		
	

		}
    }
	
	
	
	
	




























    function getClientName($data){

    	$job_id = isset($data['job_id'])		?	$this->RealEscape($data['job_id']) : '';;

    	// echo json_encode(["message"=>$job_id]);//adaaa

    	if($job_id != ''){

    		$sql = "SELECT * FROM ".DB_PREFIX."_job WHERE j_id = '".$job_id."'";

    		$result = $this->db->query($sql);

    		$emailclasses = array();
    		if($result->num_rows > 0){
    			while ($row = mysqli_fetch_array($result)) {
    				$j_email = $row['j_email'];
    				$j_hired_tutor_email = $row['j_hired_tutor_email'];

    				$emailclasses = array("j_email" => $j_email, "j_hired_tutor_email" => $j_hired_tutor_email);
    			}
    			echo json_encode($emailclasses);
    		}
    	}
    	
    }
    // luqman
    function FetchClasses(){
    	
       $sql = "SELECT * FROM ".DB_PREFIX."_classes ";
   	   if($_SESSION[DB_PREFIX]['r_id']!=1){
   	   	 $sql .= " WHERE cl_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";
   	   }

   	   $sql .= "ORDER BY cl_create_date DESC";
   	   
   	   return $this->db->query($sql);
    }
    function GetClasses($clid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_classes WHERE cl_id = '".$clid."'")->fetch_assoc();
    }
    function DeleteClasses($clid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_classes WHERE cl_id = '".$clid."'")){
  	 	Session::SetFlushMsg("success", 'Class Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	 }
    }
    public function ClassWiseRecord($class_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_classes_record AS CR";
		$sql .= " INNER JOIN ".DB_PREFIX."_classes AS C ON C.cl_id = CR.cr_cl_id";
		if ($class_id != '') {
			$sql .= " WHERE CR.cr_cl_id = {$class_id}";
		}

		$sql .= " ORDER BY CR.cr_date DESC";
// $fh = fopen('textfilebaru.txt', 'w');
//             fwrite($fh, $sql);
		return $this->db->query($sql);
	}


    public function fd_classes($class_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_classes WHERE cl_id = {$class_id} ORDER BY cl_id DESC";
		return $this->db->query($sql);
	}

    public function fd_classes_record($class_id = NULL) {
		$sql = "SELECT * FROM ".DB_PREFIX."_classes_record WHERE cr_cl_id = {$class_id} ORDER BY cr_id DESC";
		return $this->db->query($sql);
	}
    /*
    *
    *Functions for Tutor Request Management
    *
    */
    function FetchTutorRequest(){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_tutor_request ORDER BY tr_id DESC");
    }
    function DeleteTutorRequest($trid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_tutor_request WHERE tr_id = '".$trid."'")){
  	 	Session::SetFlushMsg("success", 'Tutor Request Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	  }
     }
     function UpdateTutorRequest($data){
    	//luqman 28/4 - update tr_managed_by
			$q = "UPDATE ".DB_PREFIX."_tutor_request SET tr_status='".$data['tr_status']."', tr_managed_by='".$data['tr_managed_by']."' WHERE tr_id = '".$data['tr_id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Tutor Updated Successfully.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
	  }
     function GetTutorRequest($trid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_tutor_request WHERE tr_id = '".$trid."'")->fetch_assoc();
    }
    /*
    *
    *Functions for Ratings and Reviews Management
    *
    */
    function FetchTutorReview(){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_review_rating WHERE rr_status='disapproved' ORDER BY rr_create_date DESC ");
    }
	
    function FetchTutorReviewPending(){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_review_rating WHERE rr_status='not approved' ORDER BY rr_create_date DESC ");
    }
	
    function FetchTutorReviewApproved(){
        
        $allAdmin = array();
        $queryAdmin = " SELECT * FROM ".DB_PREFIX."_user WHERE u_role = '2' "; 
        $resultAdmin = $this->db->query($queryAdmin);
        if($resultAdmin->num_rows > 0){ 
            while($rowAdmin = $resultAdmin->fetch_assoc()){ 
                $allAdmin[] = $rowAdmin['u_id'];
            }     
        }
        return $this->db->query("SELECT * FROM ".DB_PREFIX."_review_rating WHERE rr_status='approved' AND rr_parent_id NOT IN ( '" . implode( "', '" , $allAdmin ) . "' ) ORDER BY rr_create_date DESC ");
        
        
    	//return $this->db->query("SELECT * FROM ".DB_PREFIX."_review_rating WHERE rr_status='approved' ORDER BY rr_create_date DESC ");
    }

    function DeleteTutorReview($rrid){
    	if($this->db->query("DELETE FROM ".DB_PREFIX."_review_rating WHERE rr_id = '".$rrid."'")){
  	 	Session::SetFlushMsg("success", 'Review Deleted Successfully.');
  	 }
  	 else {
	    Session::SetFlushMsg("error", 'Deletion Sql failed.'.$this->db->error);
	  }
    }
    
    function UpdateTutorReview($data){
    	
		$q = "UPDATE ".DB_PREFIX."_review_rating SET rr_review='".$data['rr_review']."',rr_rating='".$data['inputRating']."',rr_about_tutor='".$data['rr_about_tutor']."',rr_tutor_improve='".$data['rr_tutor_improve']."',  rr_status='".$data['rr_status']."' WHERE rr_id = '".$data['rr_id']."'";
		if($this->db->query($q)) {
			Session::SetFlushMsg("success", 'Review Updated Successfully.');
		} else {
			Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
		}
	}
    
    function GetTutorReview($rrid){
    	return $this->db->query("SELECT * FROM ".DB_PREFIX."_review_rating WHERE rr_id = '".$rrid."'")->fetch_assoc();
    }

    /*public function FetchActiveUser(){
		return	$this->db->query("SELECT COUNT(*) FROM ".DB_PREFIX."_site_user  WHERE su_lasttimeseen > DATE_SUB(NOW(), INTERVAL 5 MINUTE)");
	}*/
	/*public function TrackUser($id){
      $this->db->query("UPDATE ".DB_PREFIX."_site_user SET  su_lasttimeseen = NOW() WHERE su_id = '".$id."'");
	}*/
    /*
    *
    *Fucntions for Registered user count
    *
    */
    function RegisteredUser($interval){
    	return $this->db->query("SELECT COUNT(*) FROM   ".DB_PREFIX."_user WHERE u_create_date > NOW() - INTERVAL {$interval} DAY")->fetch_array();
    }
	
    function SaveUserNotification($data){
    	if($data['id']=='') {
			
			if($this->db->query("INSERT INTO ".DB_PREFIX."_user_notification(title,text) VALUES('".$data['title']."','".$data['myeditor']."')")) {
				Session::SetFlushMsg("success", 'Notification Successfully Saved.');

				
			} 
			else {
			    Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
			}
		} else {
			$q = "UPDATE ".DB_PREFIX."_user_notification SET title = '".$data['title']."',text='".$data['myeditor']."' WHERE id = '".$data['id']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Notification Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveUserNews($data){
    	if($data['idNews']=='') {
			
			if($this->db->query("INSERT INTO ".DB_PREFIX."_user_news(title,text) VALUES('".$data['titleNews']."','".$data['myeditor2']."')")) {
				Session::SetFlushMsg("success", 'Notification Successfully Saved.');

				
			} 
			else {
			    Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
			}
		} else {
			$q = "UPDATE ".DB_PREFIX."_user_news SET title = '".$data['titleNews']."',text='".$data['myeditor2']."' WHERE id = '".$data['idNews']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Notification Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function SaveTermsConditionBI($data){
    	if($data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveTermsConditionBM($data){
    	if($data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }

    function SaveTutorsTermsConditionBI($data){
    	if($data['idBI']=='' || $data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			
			//$sqlInsert = "INSERT INTO ".DB_PREFIX."_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM) VALUES ('".$data['idBI']."', '".$data['myeditor']."', '".date('d/m/Y')."', '".$data['myeditor2']."')";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveTutorsTermsConditionBM($data){
    	if($data['idBM']=='' || $data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			
			//$sqlInsert = "INSERT INTO ".DB_PREFIX."_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM) VALUES ('".$data['idBI']."', '".$data['myeditor']."', '".date('d/m/Y')."', '".$data['myeditor2']."')";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }


    function SaveTutorsTermsConditionBI2($data){
    	if($data['idBI2']=='' || $data['idBM2']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor3']."' WHERE pmt_id = '".$data['idBI2']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor4']."' WHERE pmt_id = '".$data['idBM2']."'";
			
			//$sqlInsert = "INSERT INTO ".DB_PREFIX."_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM) VALUES ('".$data['idBI2']."', '".$data['myeditor3']."', '".date('d/m/Y')."', '".$data['myeditor4']."')";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveTutorsTermsConditionBM2($data){
    	if($data['idBM2']=='' || $data['idBI2']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor4']."' WHERE pmt_id = '".$data['idBM2']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor3']."' WHERE pmt_id = '".$data['idBI2']."'";
			
			//$sqlInsert = "INSERT INTO ".DB_PREFIX."_history_terms (ht_pmt_id, ht_pmt_pagedetail, ht_date, ht_pmt_pagedetai_BM) VALUES ('".$data['idBI2']."', '".$data['myeditor3']."', '".date('d/m/Y')."', '".$data['myeditor4']."')";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    function SaveClientTermsConditionBI($data){
    	if($data['idBI']=='' || $data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }

    function SaveClientTermsConditionBM($data){
    	if($data['idBM']=='' || $data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }

    function SaveGroupTuitionBI($data){
    	if($data['idBI2']=='' || $data['idBM2']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor3']."' WHERE pmt_id = '".$data['idBI2']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor4']."' WHERE pmt_id = '".$data['idBM2']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function SaveGroupTuitionBM($data){
    	if($data['idBM2']=='' || $data['idBI2']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor4']."' WHERE pmt_id = '".$data['idBM2']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor3']."' WHERE pmt_id = '".$data['idBI2']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    
    
    function SaveTuitionCenterBI($data){
    	if($data['idBI']=='' || $data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    function SaveTuitionCenterBM($data){
    	if($data['idBM']=='' || $data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			$q2 = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			
			if( $this->db->query($q) && $this->db->query($q2) ) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
    
    
    
    
    
    
    
    /*function SaveClientTermsConditionBI($data){
    	if($data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveClientTermsConditionBM($data){
    	if($data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms & Condition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }
	

    function SaveGroupTuitionBI($data){
    	if($data['idBI']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor']."' WHERE pmt_id = '".$data['idBI']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms for Group Tuition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }	
    function SaveGroupTuitionBM($data){
    	if($data['idBM']=='') {
			Session::SetFlushMsg("error", 'Insert Sql failed : '.$this->db->error);
		} else {
			$q = "UPDATE ".DB_PREFIX."_page_manage_translation SET pmt_pagedetail = '".$data['myeditor2']."' WHERE pmt_id = '".$data['idBM']."'";
			if($this->db->query($q)) {
				Session::SetFlushMsg("success", 'Terms for Group Tuition Successfully Saved.');
			} else {
				Session::SetFlushMsg("error", 'Update Sql failed.'.$this->db->error);
			}
		}
    }*/
}	
