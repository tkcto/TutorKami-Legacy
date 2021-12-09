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

        $u_id = $_GET['u_id'];//dah dapat u_id
        // var_dump($u_id);die;

        $qry = "SELECT U.*, UD.* FROM ".DB_PREFIX."_user AS U ";

        $qry .= "INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id ";

        $qry .= "WHERE 1";


        if ($user_status != '') {

            $qry = "SELECT * FROM tk_user AS U 
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE 1
                AND U.u_displayid = '".$u_id."'
                AND U.u_status = '".$user_status."'";

        } else {

            $qry = "SELECT * FROM tk_user AS U 
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE 1
                AND U.u_displayid = '".$u_id."'
                AND U.u_status <> 'D'";

        }

        if ($search_email != '') {

            $qry = "SELECT * FROM tk_user AS U 
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE 1
                AND U.u_email = '".$search_email."'
                AND U.u_role = '".$user_role."'";

        }
            

         if ($user_role != '') {

            $qry = "SELECT * FROM tk_user AS U 
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE 1
                AND U.u_displayid = '".$u_id."'
                AND U.u_role = '".$user_role."'";

        }

        return $this->db->query($qry);

    }

// luqman
    public function GetUserJobAddLink($user_role = NULL, $search_email = NULL){

            $qry = "SELECT * FROM tk_user AS U 
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE 1
                AND U.u_email = '".$search_email."'
                AND U.u_role = '".$user_role."'";
            
       
        return $this->db->query($qry);
    }
// luqman
// luqman
    public function GetJobIdLink($job_id = NULL){
        $qry = "SELECT * FROM ".DB_PREFIX."_classes AS CL
                INNER JOIN ".DB_PREFIX."_job AS J ON J.j_id = CL.cl_display_id
                WHERE J.j_id = '".$job_id."'";

        return $this->db->query($qry);  
        
    }
// luqman

// luqman
    public function GetDisplayIdJobLink($u_id = NULL){
        $qry = "SELECT * FROM ".DB_PREFIX."_user AS U
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE U.u_displayid = '".$u_id."'";

            

        return $this->db->query($qry);
    }

    public function GetUserIdJobLink($u_id = NULL){
        $qry = "SELECT * FROM ".DB_PREFIX."_user AS U
                INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
                WHERE U.u_displayid = '".$u_id."'";

            //             $fh = fopen('textfilebaru.txt', 'w');
            // fwrite($fh, $qry);

        return $this->db->query($qry);
    }

// luqman

// luqman
    public function isTutor($data){

        $search_tutor           = isset($data['is_tutor'])                  ? $data['is_tutor'] : '';
        $search_email           = isset($data['u_email'])                   ?  $this->RealEscape($data['u_email']) : ''; //email
        $userimage              = isset($data['data_pic'])                 ?  $this->RealEscape($data['data_pic']) : ''; //email
        $search_first_name      = isset($data['ud_first_name'])             ?  $this->RealEscape($data['ud_first_name']) : ''; //firstname
        $search_last_name       = isset($data['ud_last_name'])              ?  $this->RealEscape($data['ud_last_name']) : ''; //lastname
        $search_display_name    = isset($data['u_displayname'])             ?  $this->RealEscape($data['u_displayname']) : ''; //displayname
        $search_phone_number    = isset($data['ud_phone_number'])           ?  $this->RealEscape($data['ud_phone_number']) : '';//phonenumber
         // if ($search_tutor == 'Yes') {
            // For Tutor   

            //problem
            // $areas              = isset($data['cover_area_state'])          ? $data['cover_area_state'] : '';
            // $course             = isset($data['level_drop'])              ? $data['level_drop'] : '';           
            // $subject            = isset($data['subject'])                   ? $data['subject'] : '';
            // $location           = isset($data['location'])                  ? $data['location'] : '';  
            // problem

            $areas              = isset($data['state_drop'])                ? $data['state_drop'] : '';                   //ada nombor HOLD
            $course             = isset($data['level_drop'])                ? $data['level_drop'] : '';               //ada nombor HOLD
            $u_admin_approve    = isset($data['u_admin_approve'])           ? $data['u_admin_approve'] : '';        //tutoractivated
            $subject            = isset($data['subject'])                   ? $data['subject'] : '';                //textbox others kt subject
            $location           = isset($data['location'])                  ? $data['location'] : '';
            $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               //gender
            $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';                //race
            $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        //tutorstatus
            $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       //tution center
            $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  //ocupation
            $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';   //ada nombor subject
            $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';   //ada nombor city
            
            $validated    = isset($data['validated'])           ? $data['validated'] : ''; 
            $experience    = isset($data['experience'])           ? $data['experience'] : ''; 
            
            $search_ud_state    = isset($data['search_ud_state'])   ? $data['search_ud_state'] : ''; 
            $search_ud_city     = isset($data['search_ud_city'])    ? $data['search_ud_city'] : ''; 
            
            $ud_workplace_state = isset($data['ud_workplace_state']) ? $data['ud_workplace_state'] : ''; 
            $ud_workplace_city  = isset($data['ud_workplace_city'])  ? $data['ud_workplace_city'] : '';  
            
            $searchConductOnline = isset($data['searchConductOnline']) ? $data['searchConductOnline'] : ''; 
            $searchConductClass  = isset($data['searchConductClass'])  ? $data['searchConductClass'] : ''; 

            $level_taught  = isset($data['level_taught'])  ? $data['level_taught'] : ''; 

            $parent_city  = isset($data['parent_city'])   ? $data['parent_city'] : '';
        // } elseif ($search_tutor == 'No') {
            // For Non-Tutor
            // $search_role         = isset($data['u_role'])          ? $data['u_role'] : '';                       //ada nombor KOMEN
            $client_status  = isset($data['ud_client_status'])  ? $data['ud_client_status'] : '';                   //ada
			$user_status  = isset($data['user_status'])  ? $data['user_status'] : '';
        // $ud_state       = isset($data['ud_state'])          ? $data['ud_state'] : '';                           //ada nombor KOMEN
            $messagecheckbox  = isset($data['messagecheckbox'])   ? $data['messagecheckbox'] : '';                    //XDAPAT VALUE LAGI
        // }
        // echo json_encode(["message"=>$messagecheckbox]);//adaaa
            // var_dump($course);die;
/* Getting post data */
 // $rowid = $_POST['rowid'];
//  $rowperpage = $_POST['rowperpage'];//ada value 10
//  /* Count total number of rows */
//  $querycount = "SELECT count(*) as allcount FROM tk_user U
//              INNER JOIN tk_user_details UD
//              ON U.u_id = UD.ud_u_id";
// $resultcount = $this->db->query($querycount);
// $fetchresult = mysqli_fetch_array($resultcount);
// $allcount = $fetchresult['allcount'];
/* Count total number of rows */



        /* QUERY 1 **/
//search 'list tutor only' pilih YES
/*
            $sql = "SELECT 

            U.*, 

            UD.*";

          
              $sql.="FROM ".DB_PREFIX."_user AS U 

        INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id ";

*/



if ($validated != '') {
    if ($validated == 'paid') {

/*
FROM ".DB_PREFIX."_user AS U 
INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id ";*/
/*$sql .= " INNER JOIN ".DB_PREFIX."_job   AS Jb ON Jb.j_hired_tutor_email   = U.u_email ";*/
/*
tk_job.j_email, tk_job.j_id, tk_job.j_state_id, tk_job.state, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, tk_job.city, 

tk_user.u_id, tk_user.u_username, tk_user.u_role, tk_user.u_email, tk_user.u_displayname, tk_user.u_displayid, tk_user.u_gender, tk_user.u_profile_pic, tk_user.u_status, tk_user.u_paying_client, tk_user.u_admin_approve, tk_user.u_create_date, tk_user.u_modified_date, tk_user.u_country_id, tk_user.ip_address, tk_user.last_page, tk_user.signature_img, tk_user.url_video,

tk_user_details.ud_u_id, tk_user_details.ud_state, tk_user_details.ud_city*/
/*
    $sql = "SELECT 
        U.*, 
        jb.*, 
        UD.*";

$sql.="
FROM ".DB_PREFIX."_job AS jb LEFT OUTER JOIN ".DB_PREFIX."_user AS U  ON jb.j_email = U.u_email
LEFT JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id  


";
*/

    }
    /*else if ($validated == 'unpaid') {
                        
    }else if ($validated == 'none') {
                        
    }*/
}else{
    $sql = "SELECT 
        U.*, 
        UD.*";
        $sql.="FROM ".DB_PREFIX."_user AS U 
        INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id ";
}




if ($level_taught != '') {
         // areas select state
        if ($areas != '' || $city_check != '') {
                    
                    $sql .= "
                             INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
                             LEFT JOIN  ".DB_PREFIX."_cities CT ON CT.city_id   = UD.ud_city AND TAC.tac_city_id = CT.city_id  
                             LEFT JOIN ".DB_PREFIX."_states AS ST ON TAC.tac_st_id = ST.st_id
                             LEFT JOIN ".DB_PREFIX."_countries AS C ON ST.st_c_id = C.c_id AND CT.city_c_id = C.c_id ";
        
        }
                    $sql .= " 
                    INNER JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id 
                    LEFT JOIN ".DB_PREFIX."_tution_course   AS TC  ON TC.tc_id     = TRS.trs_tc_id";
        
}else{
         // areas select state
        if ($areas != '' || $city_check != '') {
                    
                    $sql .= "
                             INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
                             LEFT JOIN  ".DB_PREFIX."_cities CT ON CT.city_id   = UD.ud_city AND TAC.tac_city_id = CT.city_id  
                             LEFT JOIN ".DB_PREFIX."_states AS ST ON TAC.tac_st_id = ST.st_id
                             LEFT JOIN ".DB_PREFIX."_countries AS C ON ST.st_c_id = C.c_id AND CT.city_c_id = C.c_id ";
        
        }
         
        
                //subject
        //if ($course != '' && $subject_check != '') {
        if ($course != '' || $subject_check != '') {
                
                    $sql .= " 
                    INNER JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id 
                    LEFT JOIN ".DB_PREFIX."_tution_course   AS TC  ON TC.tc_id     = TRS.trs_tc_id
                    LEFT JOIN ".DB_PREFIX."_tution_subject   AS TS  ON TS.ts_id     = TRS.trs_ts_id";
        }    
}



/*
if ($areas != '') {
	$sql .= "
	INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
	LEFT JOIN ".DB_PREFIX."_states AS ST ON TAC.tac_st_id = ST.st_id ";

}
//subject
if ($course != '') {
	$sql .= " 
	INNER JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id 
	LEFT JOIN ".DB_PREFIX."_tution_course   AS TC  ON TC.tc_id     = TRS.trs_tc_id";
}
*/       






        //$sql .= " WHERE U.u_status <> 'D'";
        
        if ($u_admin_approve != '') {

            //$sql .= " AND U.u_status = '".$u_admin_approve."'";
            $sql .= " WHERE U.u_status = '".$u_admin_approve."'";
            

        }else{
            $sql .= " WHERE U.u_status <> 'D'";
        }

/*
if ($validated != '') {
    if ($validated == 'paid') {
    
        $sql .= " AND jb.j_payment_status = 'paid' ";
    }

}
*/


        if ($search_tutor != '') {
        
            if ($search_tutor == 'Yes') {

                $sql .= " AND U.u_role = '3' ";


            } elseif ($search_tutor == 'No') {

                $sql .= " AND U.u_role = '4' ";

            } elseif ($search_tutor == 'Admin') {

                $sql .= " AND U.u_role = '2' ";

            }

        }

            // echo json_encode(["message"=>'hello']);//adaaa
        // if ($areas != '' || $city_check != '' || $course != '' || $subject_check != '') {
        //     $countcity = count($city_check);
        //     $countsubject = count($subject_check);

            
        //     $sql .= "AND (
        //     (TAC.tac_st_id = '".$areas."' AND TAC.tac_city_id IN(".implode(',',$city_check).") )
        //     OR 
        //     (TRS.trs_tc_id = '".$course."' AND TRS.trs_ts_id IN(".implode(',',$subject_check).") )
        //     )
        //             GROUP BY U.u_username
        //             HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."' OR COUNT(distinct TRS.trs_ts_id) = '".$countsubject."'
        //             ";


        

        

        // }

if ($level_taught != '') {
            if ($areas != '') {
                $sql .= "AND TAC.tac_st_id = '".$areas."' ";
            }
            if ($city_check != '') {
                $sql .= "AND TAC.tac_city_id IN(".implode(',',$city_check).") ";
            }
            $sql .= "AND TRS.trs_tc_id = '".$level_taught."' ";
            $sql .= "GROUP BY U.u_username ";  
}else{
    // SEARCH XLEH COMBINE NI
            /*if ($areas != '' || $city_check != '') {
    
                $sql .= "AND TAC.tac_st_id = '".$areas."' AND TAC.tac_city_id IN(".implode(',',$city_check).")
                ";
            }*/
            if ($areas != '') {
                $sql .= "AND TAC.tac_st_id = '".$areas."' ";
            }
            if ($city_check != '') {
                $sql .= "AND TAC.tac_city_id IN(".implode(',',$city_check).") ";
            }
    
            /*if ($course != '' || $subject_check != '') {
    
                // echo json_encode(["message"=>$countcity]);//adaaa
                
                $sql .= "AND TRS.trs_tc_id = '".$course."' AND TRS.trs_ts_id IN(".implode(',',$subject_check).")
                
                ";
    
            }*/
            if ($course != '') {
                $sql .= "AND TRS.trs_tc_id = '".$course."' ";
            }
            if ($subject_check != '') {
                $sql .= "AND TRS.trs_ts_id IN(".implode(',',$subject_check).") ";
            }    

/* fadhli*/
                if ($areas != '' || $city_check != '' || $course != '' || $subject_check != '') {
                    $countcity = count($city_check);
                    $countsubject = count($subject_check);
                    $sql .= "GROUP BY U.u_username ";        
                }
/*
        if ($areas != NULL && $city_check != NULL && $course == NULL && $subject_check == NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."'";
        }elseif ($course != NULL && $subject_check != NULL && $areas == NULL && $city_check == NULL) {
            $sql .= "HAVING COUNT(distinct TRS.trs_ts_id) = '".$countsubject."'";
        }elseif ($areas != NULL && $city_check != NULL && $course != NULL && $subject_check != NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."' AND COUNT(distinct TRS.trs_ts_id) = '".$countsubject."' ";
        }
        */
        if ($city_check != NULL &&  $subject_check == NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."'";
        }elseif ( $subject_check != NULL &&  $city_check == NULL) {
            $sql .= "HAVING COUNT(distinct TRS.trs_ts_id) = '".$countsubject."'";
        }elseif ($city_check != NULL && $subject_check != NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."' AND COUNT(distinct TRS.trs_ts_id) = '".$countsubject."' ";
        }
/* fadhli*/
}
/*if ($areas != '' || $course != '' ) {
	$sql .= "GROUP BY U.u_username ";        
}*/
        

// SEARCH TAKLEH COMBINE NI

     // SEARCH EMAIL

        if ($search_email != '') {

            //$sql .= " AND U.u_email = '".$search_email."'";
			$sql .= " AND U.u_email = '".$search_email."' OR UD.ud_last_name = '".$search_email."' ";
        
        }
        
        if ($userimage != '') {
			if($userimage == 'All'){
				//$sql .= " AND U.u_profile_pic != '' OR U.u_profile_pic = '' ";
			}else if ($userimage == 'Yes') {
                $sql .= " AND U.u_profile_pic != '' ";
            } elseif ($userimage == 'No') {
                $sql .= " AND U.u_profile_pic = '' ";

            }

        }
		
       // SEARCH FIRST NAME

        if ($search_first_name != '') {

            $sql .= " AND UD.ud_first_name LIKE '%".$search_first_name."%'";
            
        }

                 // SEARCH LAST NAME

        if ($search_last_name != '') {

            $sql .= " AND UD.ud_last_name LIKE '%".$search_last_name."%'";

        }



        // SEARCH DISPLAY

        if ($search_display_name != '') {

            $sql .= " AND U.u_displayname LIKE '%".$search_display_name."%'";

        }

      // SEARCH PHONE NUMBER

        if ($search_phone_number != '') {

            $sql .= " AND UD.ud_phone_number = '".$search_phone_number."'";

        }

    // GENDER

        if ($gender != '') {

            $sql .= " AND U.u_gender = '".$gender."'";

        }
        
    
        if ($search_ud_state != '') {
            $sql .= " AND UD.ud_state = '".$search_ud_state."'";
        }
        if ($search_ud_city != '') {
            $sql .= " AND UD.ud_city = '".$search_ud_city."'";
        }
        

            


        // RACE

        if ($ud_race != '') {

            $sql .= " AND UD.ud_race = '".$ud_race."'";

        }
      
               // OCCUPATION

        if ($current_occupation != '') {
            if ($current_occupation == 'unselected') {
                $sql .= " AND ud_current_occupation = '' ";
            } else {
                $sql .= " AND ud_current_occupation = '".$current_occupation."'";
            }
        }


        // TUTOR STATUS

        if ($ud_tutor_status != '') {

            $sql .= "  AND UD.ud_tutor_status = '".$ud_tutor_status."'";

        }

        // CLIENT STATUS

        if ($client_status != '') {

            //$sql .= "  AND UD.ud_client_status = '".$client_status."'";
			$sql .= "  AND UD.ud_client_status_2 = '".$client_status."'";

        }

        if ($parent_city != '') {

			$sql .= "  AND UD.ud_city = '".$parent_city."'";

        }
               // WILL TEACH AT TUITION CENTER

        if ($tution_center != '') {

            if ($tution_center == '1') {

                $sql .= " AND UD.ud_client_status = 'Tuition Centre'";

            } elseif ($tution_center == '0') {

                $sql .= " AND UD.ud_client_status != 'Tuition Centre'";

            }

        }

        if ($experience != '') {

            if ($experience == '2') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '2' ";
            }elseif ($experience == '3') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '3' ";
            }elseif ($experience == '4') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '4' ";
            }elseif ($experience == '5') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '5' ";
            }elseif ($experience == '6') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '6' ";
            }elseif ($experience == '7') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '7' ";
            }elseif ($experience == '8') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '8' ";
            }elseif ($experience == '9') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '9' ";
            }elseif ($experience == '10') {
                $sql .= " AND ud_tutor_experience_month ='year' AND CAST(ud_tutor_experience AS SIGNED) >= '10' ";
            }

        }
        
        
        
        

        if ($user_status != '') {
            if ($user_status == 'active') {
                $sql .= " AND U.u_status = 'A'";
            } else {
                $sql .= " AND U.u_status = 'B'";
            }
        }


        // if ($areas != '' || $city_check != '') {
            
        //     $sql .= "AND TAC.tac_st_id = '".$areas."' AND TAC.tac_city_id = '".$city_check."'";
        // }

        

        //     // //subject
        //     if ($course != '' || $subject_check != '') {
        //         $sql .= "AND TRS.trs_tc_id = '".$course."' AND TRS.trs_ts_id = '".$subject_check."'";
        //     }

        // TUTOR STATUS - fadhli komen

        /*if ($u_admin_approve != '') {

            $sql .= " AND U.u_status = '".$u_admin_approve."'";

        }*/

        // SEARCH PAYING CLIENT

        if ($messagecheckbox != '') {

            $sql .= " AND U.u_paying_client = '".$messagecheckbox."'";

        }
        
        if ($searchConductOnline != '') {
            if ($searchConductOnline == 'yes') {
                $sql .= " AND conduct_online = 'Yes'";
            } else {
                $sql .= " AND conduct_online = 'No'";
            }
        }
        if ($searchConductClass != '') {
            if ($searchConductClass == 'yes') {
                $sql .= " AND conduct_class = 'Yes'";
            } else {
                $sql .= " AND conduct_class = 'No'";
            }
        }
        
        if ($ud_workplace_state != '') {
            $sql .= " AND UD.ud_workplace_state = '".$ud_workplace_state."'";
        }
        if ($ud_workplace_city != '') {
            $sql .= " AND UD.ud_workplace_city = '".$ud_workplace_city."'";
        }
        
        
        
        // $sql .= "ORDER BY U.u_create_date DESC";
        

        $result =  $this->db->query($sql);

        // if ($result == 0) {
        //  return false;
        // }else{
        //  return true;
        // }

            

    // $result =  $this->db->query($sql);



     $tutor_arr = array();
     //        $tutor_arr[] = array("allcount" => $allcount);
        if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        $u_id = $row['u_id'];
		
        $ori_u_create_date = $row['u_create_date'];
        $ori_u_modified_date = $row['u_modified_date'];
		
        $u_displayid = $row['u_displayid'];
        $u_email = $row['u_email'];
        $ud_first_name = $row['ud_first_name'];
        $u_displayname = $row['u_displayname'];
        /*switch($row['u_status']){
            case P: $ustatus = "<p style='color:red'>".$row['u_status']."</p>"; break;
            case A: $ustatus = "<p style='color:black'>".$row['u_status']."</p>"; break;
            case B: $ustatus = "<p style='color:brown'>".$row['u_status']."</p>"; break;
        }
        $u_status = $ustatus;*/
		/* START fadhli - change color status */
		if( $row['u_status'] == 'P' && ($row['u_admin_approve'] == NULL || $row['u_admin_approve'] == '0' || $row['u_admin_approve'] == '') ){
			$u_status = "<p style='color:DarkRed'>P</p>";
		}
		else if($row['u_status'] == 'P' && $row['u_admin_approve'] == '1'){
			$u_status = "<p style='color:DarkBlue'>W</p>";
		}
		else if($row['u_status'] == 'P' && $row['u_admin_approve'] == '10'){
			$u_status = "<p style='color:LightSkyBlue'>E</p>";
		}
		else if( $row['u_status'] == 'A' && ($row['u_admin_approve'] == NULL || $row['u_admin_approve'] == '2') ){
			$u_status = "<p style='color:DarkGreen'>A</p>";
		}
		else if( $row['u_status'] == 'B' ){
			$u_status = "<p style='color:OrangeRed'>B</p>";
		}
		else{
			$u_status = "ERROR";
		}
		/* END fadhli */
		
        if($row['ud_dob'] == NULL){
            $ud_dob = 0;
        }else{
        $ud_dob = system::CalculateAge($row['ud_dob']);
        }

        /*$ud_city = $row['ud_city'];*/
        
        if (is_numeric($row['ud_city'])) {
            //$ud_city = 'numeric';
			$citysqltest = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '{$row['ud_city']}'";
			$cityqrytest = $this->db->query($citysqltest);
            if($cityqrytest->num_rows > 0){
                $rowtest = mysqli_fetch_array($cityqrytest);
                $ud_city = $rowtest['city_name'];
            }else{
                $ud_city ='';
            }
        }else{
            $ud_city = $row['ud_city'];
        }

        $ud_phone_number = $row['ud_phone_number'];
        // $u_role = $row['u_role'];
        switch($row['u_role']) {
          case 2: $urole = "Admin"; break;
          case 3: $urole = "Tutor"; break;
          case 4: $urole = "Client"; break;
        }
          $u_role = $urole; 
		  
        //$u_create_date = date("d/m/Y", strtotime($row['u_create_date']));
        //$u_modified_date = date("d/m/Y", strtotime($row['u_modified_date']));
        if($row["u_create_date"] == NULL || $row["u_create_date"] =='0000-00-00 00:00:00' || $row["u_create_date"] ==''){
			$u_create_date = '';
        }else{
			$u_create_date = date("d/m/Y", strtotime($row['u_create_date']));
        }
        if($row["u_modified_date"] == NULL || $row["u_modified_date"] =='0000-00-00 00:00:00' || $row["u_modified_date"] ==''){
			$u_modified_date = '';
        }else{
			$u_modified_date = date("d/m/Y", strtotime($row['u_modified_date']));
        }
        
        $ud_rate_per_hour = $row['ud_rate_per_hour'];
		/*if ($search_tutor == 'Yes') {
			$sqlJob =" SELECT aj_u_id, aj_rate, aj_level, aj_j_id FROM ".DB_PREFIX."_applied_job WHERE (aj_rate IS NOT NULL AND aj_rate!='') AND aj_u_id='".$row['u_id']."' ORDER BY aj_level ASC ";
			$resultJob =  $this->db->query($sqlJob);
			if ($resultJob->num_rows > 0) {
				$JobID = $JobID2 = $JobID3 = $JobID4 = $JobID5 = $JobID6 = $JobID7 = $JobID8 = $JobID9 = "";
				$loopRecord = $loopRecord2 = $loopRecord3 = $loopRecord4 = $loopRecord5 = $loopRecord6 = $loopRecord7 = $loopRecord8 = $loopRecord9 = "";
				while($rowJob = mysqli_fetch_array($resultJob)){
					//$JobID .= $rowJob['aj_u_id']." ";
					if($rowJob['aj_level'] == '1'){
						$title = 'Pre-School';
						$loopRecord .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID = $title.' = '.$loopRecord."\n";
					}
					if($rowJob['aj_level'] == '2'){
						$title2 = 'Tahap 1 (Tahun 1-3)';
						$loopRecord2 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID2 = $title2.' = '.$loopRecord2."\n";
					}
					if($rowJob['aj_level'] == '3'){
						$title3 = 'Tahap 2 (UPSR)';
						$loopRecord3 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID3 = $title3.' = '.$loopRecord3."\n";
					}
					if($rowJob['aj_level'] == '4'){
						$title4 = 'Form 1-3 (PT3)';
						$loopRecord4 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID4 = $title4.' = '.$loopRecord4."\n";
					}
					if($rowJob['aj_level'] == '5'){
						$title5 = 'Form 4-5 (SPM)';
						$loopRecord5 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID5 = $title5.' = '.$loopRecord5."\n";
					}
					if($rowJob['aj_level'] == '6'){
						$title6 = 'Primary (International Syllabus)';
						$loopRecord6 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID6 = $title6.' = '.$loopRecord6."\n";
					}
					if($rowJob['aj_level'] == '7'){
						$title7 = 'Lower Secondary (International Syllabus)';
						$loopRecord7 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID7 = $title7.' = '.$loopRecord7."\n";
					}
					if($rowJob['aj_level'] == '8'){
						$title8 = 'Year 10-11 (IGCSE)';
						$loopRecord8 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID8 = $title8.' = '.$loopRecord8."\n";
					}
					if($rowJob['aj_level'] == '9'){
						$title9 = 'Others / Lain-lain';
						$loopRecord9 .=  $rowJob['aj_j_id']." ".$rowJob['aj_rate'].", ";
						$JobID9 = $title9.' = '.$loopRecord9."\n";
					}
					
				}
				$thisJobID = $JobID.$JobID2.$JobID3.$JobID4.$JobID5.$JobID6.$JobID7.$JobID8.$JobID9;
			}else{
				$thisJobID = "";
			}
			if($thisJobID != '' || $thisJobID != NULL){
				$ud_rate_per_hour = $row['ud_rate_per_hour'].'testtest'.$thisJobID;
			}else{
				$ud_rate_per_hour = $row['ud_rate_per_hour'];
			}
		}else{
			$ud_rate_per_hour = $row['ud_rate_per_hour'];
		}*/


      $tutor_arr[] = array("u_id" => $u_id,"ori_u_create_date" => $ori_u_create_date,"ori_u_modified_date" => $ori_u_modified_date,"u_displayid" => $u_displayid,"u_email" => $u_email,"ud_first_name" => $ud_first_name,"u_displayname" => $u_displayname,"u_status" => $u_status,"ud_dob" => $ud_dob,"ud_city" => $ud_city,"ud_phone_number" => $ud_phone_number,"u_role" => $u_role,"u_create_date" => $u_create_date,"u_modified_date" => $u_modified_date,"ud_rate_per_hour" => $ud_rate_per_hour);  
    }
    echo json_encode($tutor_arr);
    // echo json_encode(["message"=>$ud_dob]);
}else{
    echo json_encode(["message"=>'Tiada Maklumat!']);
}
}
// luqman

// luqman
    public function SearchTutorFE($data){

            $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               //gender
            $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';                //race
            $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        //tutorstatus
            $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  //ocupation
            $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       //tution center

            $areas              = isset($data['state_drop'])                ? $data['state_drop'] : '';                   //ada nombor HOLD
            $course             = isset($data['level_drop'])                ? $data['level_drop'] : '';               //ada nombor HOLD
            $subject            = isset($data['subject'])                   ? $data['subject'] : '';                //textbox others kt subject
            $location           = isset($data['location'])                  ? $data['location'] : '';
            $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';   //ada nombor subject
            $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';   //ada nombor city
            
            $conductOnline             = isset($data['conductOnline'])                  ? $data['conductOnline'] : '';   
            
         //echo json_encode(["message"=>$areas]);//adaaa

        $sql = "SELECT 

            U.*,

            AVG(".DB_PREFIX."_review_rating.rr_rating) as average_rating, 

            UD.*";

          
              $sql.="FROM ".DB_PREFIX."_user AS U 

        INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id 
        LEFT JOIN ".DB_PREFIX."_review_rating ON rr_tutor_id = U.u_id";

          
 // areas select state
        if ($areas != '' || $city_check != '') {
            
            $sql .= "
                     INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
                     LEFT JOIN  ".DB_PREFIX."_cities CT ON CT.city_id   = UD.ud_city AND TAC.tac_city_id = CT.city_id  
                     LEFT JOIN ".DB_PREFIX."_states AS ST ON TAC.tac_st_id = ST.st_id
                     LEFT JOIN ".DB_PREFIX."_countries AS C ON ST.st_c_id = C.c_id AND CT.city_c_id = C.c_id
                         ";
        }

        // //subject
            if ($course != '' && $subject_check != '') {
        
            $sql .= " 
            INNER JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id 
            LEFT JOIN ".DB_PREFIX."_tution_course   AS TC  ON TC.tc_id     = TRS.trs_tc_id
            LEFT JOIN ".DB_PREFIX."_tution_subject   AS TS  ON TS.ts_id     = TRS.trs_ts_id";
            }
       


        //$sql .= " WHERE U.u_status <> 'D' AND U.u_role = '3'";
		/* START fadhli - active sahaja */
		$sql .= " WHERE U.u_status = 'A' AND U.u_role = '3'";
		/* END fadhli */



        

// SEARCH XLEH COMBINE NI
        if ($areas != '' || $city_check != '') {

            
            
            $sql .= "AND TAC.tac_st_id = '".$areas."' AND TAC.tac_city_id IN(".implode(',',$city_check).")
            
            ";
        }

        if ($course != '' || $subject_check != '') {

            
            // echo json_encode(["message"=>$countcity]);//adaaa
            
            $sql .= "AND TRS.trs_tc_id = '".$course."' AND TRS.trs_ts_id IN(".implode(',',$subject_check).")
            
            ";

                }

                if ($areas != '' || $city_check != '' || $course != '' || $subject_check != '') {
                    $countcity = count($city_check);
                    $countsubject = count($subject_check);
                    $sql .= "GROUP BY U.u_username ";        
                }

        if ($areas != NULL && $city_check != NULL && $course == NULL && $subject_check == NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."'";
        }elseif ($course != NULL && $subject_check != NULL && $areas == NULL && $city_check == NULL) {
            $sql .= "HAVING COUNT(distinct TRS.trs_ts_id) = '".$countsubject."'";
        }elseif ($areas != NULL && $city_check != NULL && $course != NULL && $subject_check != NULL) {
            $sql .= "HAVING COUNT(distinct TAC.tac_city_id) = '".$countcity."' AND COUNT(distinct TRS.trs_ts_id) = '".$countsubject."' ";
        }
        


    // GENDER

        if ($gender != '') {

            $sql .= " AND U.u_gender = '".$gender."'";

        }
        
        if ($conductOnline != '') {

            $sql .= " AND UD.conduct_online = '".$conductOnline."'";

        }
        

        // RACE

        if ($ud_race != '') {

            $sql .= " AND UD.ud_race = '".$ud_race."'";

        }

      
               // OCCUPATION

        if ($current_occupation != '') {

            //$sql .= " AND UD.ud_current_occupation = '".$current_occupation."'";
			$sql .= " AND UD.ud_current_occupation = '".$current_occupation."' OR (UD.ud_current_occupation LIKE '".$current_occupation."%' OR UD.ud_current_occupation = 'Lacturer' OR UD.ud_current_occupation = 'Lecture' OR UD.ud_current_occupation = 'Lecturer')";

        }



        // TUTOR STATUS

        if ($ud_tutor_status != '') {

            $sql .= "  AND UD.ud_tutor_status = '".$ud_tutor_status."'";

        }

               // WILL TEACH AT TUITION CENTER

        if ($tution_center != '') {

            if ($tution_center == '1') {

                $sql .= " AND UD.ud_client_status = 'Tuition Centre'";

            } elseif ($tution_center == '0') {

                $sql .= " AND UD.ud_client_status != 'Tuition Centre'";

            }

        }

        $result =  $this->db->query($sql);

          $tutor_arr = array();
        if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        $split_rating = explode('.', $row['average_rating']);
               $rr_rating = '';
               for($i = 0; $i < $split_rating[0]; $i++) {
                $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
               }
               if(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] == '5') {
                $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star-half"></span></span>';
               }elseif(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] > '5') {
                $rr_rating .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
               }

        $u_id = $row['u_id'];
        $u_displayid = $row['u_displayid'];
        $u_displayname = $row['u_displayname'];
        $u_status = $row['u_status'];
        $ud_dob = system::CalculateAge($row['ud_dob']);
        $rr_rating = $rr_rating;
        //$ud_city = $row['ud_city'];
        
$sqlRecordCity = " SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = ".$row['ud_city']." ";
$resultRecordCity = $this->db->query($sqlRecordCity);
if($resultRecordCity->num_rows > 0){
	$rowRecordCity  = mysqli_fetch_array($resultRecordCity);
	$ud_city = $rowRecordCity['city_name'];   
}else{
    $ud_city = $row['ud_city'];
}
        $u_gender = $row['u_gender'];
        $ud_qualification = $row['ud_qualification'];
        $ud_current_occupation = $row['ud_current_occupation'];
        $ud_current_occupation_other = $row['ud_current_occupation_other'];
        $u_modified_date = $row['u_modified_date'];
		
 
      $tutor_arr[] = array("u_id" => $u_id,"u_displayid" => $u_displayid, "u_gender" => $u_gender, "u_displayname" => $u_displayname,"u_status" => $u_status,"ud_dob" => $ud_dob, "rr_rating" => $rr_rating, "ud_city" => $ud_city,"ud_qualification" => $ud_qualification,"ud_current_occupation" => $ud_current_occupation,"ud_current_occupation_other" => $ud_current_occupation_other,"u_modified_date" => $u_modified_date);  
    }
    echo json_encode($tutor_arr);
    // echo json_encode(["message"=>$course]);
}else{
    echo json_encode(["message"=>'Tiada Maklumat!']);
}
    }
// luqman

    

    // luqman
    public function LoadProfileUser($data){
        $userid             = isset($data['userid'])                  ? $data['userid'] : '';
        $displayid             = isset($data['displayid'])                  ? $data['displayid'] : '';  
        // echo json_encode(["response"=>$userid]);

        if($userid != ''){
            $sql = "SELECT TRS.trs_u_id, GROUP_CONCAT(TS.ts_title SEPARATOR ', ') ts_title, TC.tc_title FROM tk_tutor_subject TRS
                    INNER JOIN tk_tution_subject TS ON TS.ts_id = TRS.trs_ts_id
                    INNER JOIN tk_tution_course TC ON TRS.trs_tc_id = TC.tc_id

                    WHERE TRS.trs_u_id = '".$userid."'
                    GROUP BY TRS.trs_u_id, TC.tc_title
					ORDER BY TRS.trs_tc_id asc";
        }elseif($displayid !=''){
            $sql = "SELECT TRS.trs_u_id, GROUP_CONCAT(TS.ts_title SEPARATOR ', ') ts_title, TC.tc_title FROM tk_tutor_subject TRS
                    INNER JOIN tk_tution_subject TS ON TS.ts_id = TRS.trs_ts_id
                    INNER JOIN tk_tution_course TC ON TRS.trs_tc_id = TC.tc_id
                    INNER JOIN tk_user U ON TRS.trs_u_id = U.u_id

                    WHERE U.u_displayid = '".$displayid."'
                    GROUP BY TRS.trs_u_id, TC.tc_title
					ORDER BY TRS.trs_tc_id asc";
        }

        $result =  $this->db->query($sql);
        
        $tutor_pro = array();
        if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        $tc_title = $row['tc_title'];
        $ts_title = $row['ts_title'];
        
           
      $tutor_pro[] = array("tc_title" => $tc_title,"ts_title" => $ts_title);  
    }
    echo json_encode($tutor_pro);
    // echo json_encode(["message"=>$course]);
}else{
    echo json_encode(["message"=>'Tiada Maklumat!']);
}
    }
    // luqman

    // luqman
    public function LoadIdUser($data){
        $userid             = isset($data['userid'])                  ? $data['userid'] : '';  
        $displayid             = isset($data['displayid'])                  ? $data['displayid'] : '';  
        // echo json_encode(["response"=>$userid]);

        if($userid != ''){
            $sql = "SELECT u_displayid,u_displayname,u_profile_pic FROM tk_user
                    WHERE u_displayid = '".$userid."' ";
        }
        elseif($displayid != ''){
            $sql = "SELECT u_displayid,u_displayname,u_profile_pic FROM tk_user
                    WHERE u_displayid = '".$displayid."' ";   
        }
        

        $result =  $this->db->query($sql);
        
        $tutor_id = array();
        if ($result->num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
        $u_displayname = $row['u_displayname'];
        $u_displayid = $row['u_displayid'];
        $u_profile_pic = $row['u_profile_pic'];
        
        
           
      $tutor_id[] = array("u_displayid" => $u_displayid, "u_displayname" => $u_displayname, "u_profile_pic" => $u_profile_pic);  
    }
    echo json_encode($tutor_id);
    // echo json_encode(["message"=>$course]);
}else{
    echo json_encode(["message"=>'Tiada Maklumat!']);
}
    }
    // luqman

	public function LoadArea($data){
		$userid		= isset($data['userid']) ? $data['userid'] : '';
        $displayid	= isset($data['displayid']) ? $data['displayid'] : '';  

        if($userid != ''){
            $sql = "SELECT tac_u_id, GROUP_CONCAT(city_name SEPARATOR ', ') city_name, st_name, city_id FROM tk_tutor_area_cover
                    INNER JOIN tk_cities ON city_id = tac_city_id
                    INNER JOIN tk_states ON st_id = tac_st_id

                    WHERE tac_u_id = '".$userid."'
                    GROUP BY tac_u_id, st_name
					ORDER BY st_name asc, city_name asc";
        }elseif($displayid !=''){
            $sql = "SELECT tac_u_id, GROUP_CONCAT(city_name SEPARATOR ', ') city_name, st_name, city_id FROM tk_tutor_area_cover
                    INNER JOIN tk_cities ON city_id = tac_city_id
                    INNER JOIN tk_states ON st_id = tac_st_id
                    INNER JOIN tk_user ON u_id = tac_u_id

                    WHERE u_displayid = '".$displayid."'
                    GROUP BY tac_u_id, st_name
					ORDER BY st_name asc, city_name asc";
        }

        $result =  $this->db->query($sql);
        
        $tutorArea = array();
        if ($result->num_rows > 0) {
			while($row = mysqli_fetch_array($result)){
				$st_name = $row['st_name'];
				$city_name = $row['city_name'];
         
				$tutorArea[] = array("st_name" => $st_name,"city_name" => $city_name);  
			}
			echo json_encode($tutorArea);
        }else{
			echo json_encode(["message"=>'Tiada Maklumat!']);
        }
	}


    // luqman
    public function calcBalanceNew($data){
        $cl_id              = isset($data['cl_id'])                     ?   $this->RealEscape($data['cl_id']) : '';

		$qry = "SELECT cl_hours_balance from tk_classes where cl_id ='$cl_id'";
		$result = $this->db->query($qry);
		if($result->num_rows > 0){
			$row = mysqli_fetch_array($result);
			echo json_encode($row["cl_hours_balance"]);
		}else{
			echo json_encode("No");
		}
/*
		$qry = "SELECT * from tk_classes_record where cr_cl_id ='$cl_id' ORDER BY cr_id DESC";
		$result = $this->db->query($qry);
		if($result->num_rows > 0){
			$row = mysqli_fetch_array($result);
			echo json_encode($row["cr_balance"]);
		}else{
			//echo json_encode("No");
			
			$qry = "SELECT cl_hours_balance from tk_classes where cl_id ='$cl_id'";
			$result = $this->db->query($qry);
			if($result->num_rows > 0){
		    	$row = mysqli_fetch_array($result);
		    	echo json_encode($row["cl_hours_balance"]);
			}else{
		    	echo json_encode("No");
	    	}
		}*/
    }

    // luqman





    public function calcBalanceNewFE($data){
         $cl_id              = isset($data['cl_id'])                     ?   $this->RealEscape($data['cl_id']) : '';
		
		
		$qry = "SELECT * from tk_classes where cl_id ='$cl_id'";
		$result = $this->db->query($qry);
		if($result->num_rows > 0){
            $row = mysqli_fetch_array($result);
            if($row["cl_hours_balance"] == "- " || $row["cl_hours_balance"] == "-"){
			    echo json_encode('00');
            }else{
			    echo json_encode($row["cl_hours_balance"]);
            }
		}else{
			echo json_encode("No");
		}
   /*
        // echo json_encode(["response"=>$cl_id]);//adaaa
        if($cl_id != ''){

            $qry = "SELECT * from tk_classes_record CR
                    where exists (
                      select 1
                      from tk_classes_record
                      where CR.cr_cl_id = '".$cl_id."' 
                      having count(distinct cr_duration) > 1)";
                    }

        $result = $this->db->query($qry);

        $balance = array();
        
        if($result->num_rows > 0){
            while ($row = mysqli_fetch_array($result)) 
            {
                $cl_cycle = $row["cl_cycle"];//ini untuk kalau xda class lagi
                $duration[] = $row["cr_duration"];
                $cycle = $row["cl_cycle"];
                $kitaran = 0;

                    for($i=0; $i<sizeof($duration);$i++)
                    {
                        $cycle -= $duration[$i];
                        
                        if($cycle <= 0)
                        {
                            $kitaran++;
                            $bal = 0 - $cycle;
                            $cycle = 8;
                            $cycle -= $bal;
                        }
                    }
                    $balance[] = array("duration" => $duration);            
            }
        echo json_encode($cycle);
        }else{
            echo json_encode('No');
        }*/
    }








    // luqman
    public function getRateSubjectClassFunc($dataRS){
        $job_id             = isset($dataRS['job_id'])                  ?   $this->RealEscape($dataRS['job_id']) : '';


        if($job_id != ''){

            $qry = "SELECT * FROM ".DB_PREFIX."_job J
                    INNER JOIN ".DB_PREFIX."_job_translation JT ON J.j_id = JT.jt_j_id
                    WHERE JT.jt_lang_code ='en' AND J.j_id = '".$job_id."'";

            

        $result = $this->db->query($qry);

        $retRateSubj = array();

            if($result->num_rows > 0){
                while($row = mysqli_fetch_array($result))
                {
                    $rate = $row['j_rate'];
                    $subject = $row['jt_subject'];
                    $pRate = $row['parent_rate'];
                    $sName = $row['student_name'];
                    $cycle = $row['cycle'];

                    $retRateSubj = array("j_rate" => $rate, "jt_subject" => $subject, "parent_rate" => $pRate, "student_name" => $sName, "cycle" => $cycle);
                }
                echo json_encode($retRateSubj);
            }else{
                echo 'No row found';
            }
        }else{
            echo 'No job id!';
        }
    }
    // luqman

    // luqman
    public function getAllUserInfoFunc($dataUJ){
        $u_id               = isset($dataUJ['u_id'])                    ?   $dataUJ['u_id'] : '';

        if($u_id != ''){
            $qry = "SELECT * FROM ".DB_PREFIX."_user AS U
            INNER JOIN ".DB_PREFIX."_user_details AS UD ON U.u_id = UD.ud_u_id
            INNER JOIN ".DB_PREFIX."_states AS ST ON UD.ud_state = ST.st_id
            WHERE U.u_id = '".$u_id."'";

            //         $fh = fopen('textfilebaru.txt', 'w');
            // fwrite($fh, $qry);

            $result = $this->db->query($qry);

            $Userinfoarr = array();

            if($result->num_rows > 0){
                while($row = mysqli_fetch_array($result))
                {
                    
$sqlRecordCity = " SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = ".$row['ud_city']." ";
$resultRecordCity = $this->db->query($sqlRecordCity);
if($resultRecordCity->num_rows > 0){
	$rowRecordCity  = mysqli_fetch_array($resultRecordCity);
	$outputRecordCity = $rowRecordCity['city_name'];   
}else{
    $outputRecordCity = '';
}
                    
                    
                    //$area = $row['ud_address'].', '.$row['ud_city'];
                    //$area = $row['ud_address'].', '.$outputRecordCity;
                    $area = $row['ud_address'];
                    $state = $row['ud_state'];
                    $email = $row['u_email'];
                    $phoneno = $row['ud_phone_number'];
                    $admincomment = $row['ud_admin_comment'];
                    $ud_last_name = $row['ud_last_name'];
                    $ud_city = $row['ud_city'];
                    

                    $Userinfoarr = array("area" => $area, "state" => $state, "email" => $email, "phoneno" => $phoneno, "admincomment" => $admincomment, "ud_last_name" => $ud_last_name, "city" => $ud_city);
                }
                echo json_encode($Userinfoarr);
            }else{
                echo json_encode("No row found");
            }
        }else{
            echo json_encode("No User ID!");
        }

    }
// luqman

    public function SearchUser($data) {

    //     $search_id           = isset($data['u_id'])            ? $data['u_id'] : '';

    //     $search_tutor        = isset($data['is_tutor'])        ? $data['is_tutor'] : '';

    //     $search_email        = isset($data['u_email'])         ? $data['u_email'] : '';     

    //     $search_first_name   = isset($data['ud_first_name'])   ? $data['ud_first_name'] : '';

    //     $search_last_name    = isset($data['ud_last_name'])    ? $data['ud_last_name'] : '';

    //     $search_phone_number = isset($data['ud_phone_number']) ? $data['ud_phone_number'] : '';



    //     // if ($search_tutor == 'Yes') {

    //         // For Tutor   

    //         $displayname        = isset($data['u_displayname'])             ? $data['u_displayname'] : '';          

    //         $areas              = isset($data['cover_area_state'])          ? $data['cover_area_state'] : '';

    //         $course             = isset($data['tutor_course'])              ? $data['tutor_course'] : '';           

    //         $u_admin_approve    = isset($data['u_admin_approve'])           ? $data['u_admin_approve'] : '';

    //         $subject            = isset($data['subject'])                   ? $data['subject'] : '';

    //         $location           = isset($data['location'])                  ? $data['location'] : '';

    //         $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';

    //         $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';

    //         $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';

    //         $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';

    //         $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';

    //     //  $profile            = isset($data['u_profile_pic'])             ? $data['u_profile_pic'] : '';

    //     // } elseif ($search_tutor == 'No') {

    //         // For Non-Tutor

    //         $gender         = isset($data['u_gender'])          ? $data['u_gender'] : '';

    //         $client_status  = isset($data['ud_client_status'])  ? $data['ud_client_status'] : '';

    //         $state          = isset($data['ud_state'])          ? $data['ud_state'] : '';

    // //      $cities         = isset($data['ud_city'])           ? $data['ud_city'] : '';

    //         $paying_client  = isset($data['u_paying_client'])   ? $data['u_paying_client'] : '';

      //  }



    //     $qry = "SELECT 

    //         U.*, 

    //         UD.*";

    //       if ($search_tutor == 'Yes') {

    //         $qry.=",CT.city_name ";  // R.r_name ";

    //         $qry.="FROM ".DB_PREFIX."_user AS U

    //                INNER JOIN ".DB_PREFIX."_user_details AS UD  ON UD.ud_u_id   = U.u_id ";

            

    //       } else {

    //           $qry.="FROM ".DB_PREFIX."_user AS U 

    //     INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id ";

    //       }

    //     //separate tutor and parent

    //     if ($search_tutor == 'Yes') {

    //         $qry .="LEFT JOIN ".DB_PREFIX."_tutor_subject    AS TRS ON TRS.trs_u_id = U.u_id  

    //     LEFT JOIN ".DB_PREFIX."_tution_subject   AS TS  ON TS.ts_id     = TRS.trs_ts_id  

    //     LEFT JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 

    //     LEFT JOIN ".DB_PREFIX."_cities           AS CT  ON CT.city_id   = UD.ud_city";

    //     //LEFT JOIN ".DB_PREFIX."_role           AS R   ON R.r_id       = U.u_role";

    // } 

    //     $qry .= " WHERE U.u_status <> 'D'";



    //    // if($_SESSION[DB_PREFIX]['r_id'] != 1){

    //     //  $qry .= " AND U.u_role > '".$_SESSION[DB_PREFIX]['r_id']."'";

    // //  }

    //     // SEARCH TUTOR (fucking hell)

    //     if ($search_tutor != '') {

    //         if ($search_tutor == 'Yes') {

    //             $qry .= " AND U.u_role = '3'";

    //             //check for admin disabled

    //             //} elseif ($search_tutor == 'No' && $role != '') {

    //         } elseif ($search_tutor == 'No') {

    //             //$qry .= " AND U.u_role = '".$role."'";

    //             $qry .= " AND U.u_role = '4'";

    //         }

    //     }

    //     //search by id or did

    //     if ($search_id != '' && $search_id > 0) {

    //    //     if (!is_numeric($search_id)) {

    //      //       $qry .= " AND U.u_displayid = {$search_id}";

    //      //   } else {

    //             $qry .= " AND U.u_id = {$search_id}";

    //         //}

    //     }

    //     // SEARCH EMAIL

    //     if ($search_email != '') {

    //         $qry .= " AND U.u_email LIKE '%{$search_email}%'";

    //     }



    //     // SEARCH FIRST NAME

    //     if ($search_first_name != '') {

    //         $qry .= " AND UD.ud_first_name LIKE '%{$search_first_name}%'";

    //     }



    //     // SEARCH LAST NAME

    //     if ($search_last_name != '') {

    //         $qry .= " AND UD.ud_last_name LIKE '%{$search_last_name}%'";

    //     }



    //     // SEARCH DISPLAY

    //     if ($displayname != '') {

    //         $qry .= " AND U.u_displayname LIKE '%{$displayname}%'";

    //     }



    //     // SEARCH PHONE NUMBER

    //     if ($search_phone_number != '') {

    //         $qry .= " AND UD.ud_phone_number LIKE '%{$search_phone_number}%'";

    //     }



       //  // COVER AREA

       //  foreach ($data['cover_area_state'] as $key => $value) {

       //      if (empty($value)) {

       //          unset($data['cover_area_state'][$key]);

       //      }

       //  }

       // // if (empty($data['cover_area_state'])) { echo "empty"; };

        

       //  $area_count = 0;

       //  if (isset($data['cover_area_state']) && !empty($data['cover_area_state'])) {

       //      foreach ($data['cover_area_state'] as $cid) {

       //          $qry .= " AND TAC.tac_st_id = '{$cid}'";



       //          if (isset($data['cover_area_city_'.$cid]) && count($data['cover_area_city_'.$cid]) > 0) {

       //              $area_count = count($data['cover_area_city_'.$cid]);

       //              $area_ids = implode(',', $data['cover_area_city_'.$cid]);



       //              $qry .= " AND TAC.tac_city_id IN({$area_ids})";                    

       //          }

       //      }

       //  }



    //     // OTHER LOCATION

    //     if ($location != '') {

    //         // $qry .= " AND UD.ud_city LIKE '%{$location}%'";

    //         $qry .= " AND (CT.city_name LIKE '%{$location}%' OR TAC.tac_other LIKE '%{$location}%')";

    //     }



    //     // SUBJECT

    //     foreach ($data['tutor_course'] as $key => $value) {

    //         if (empty($value)) {

    //             unset($data['tutor_course'][$key]);

    //         }

    //     }

    //     $subject_count = 0;

    //     if (isset($data['tutor_course']) && !empty($data['tutor_course'])) {

    //         foreach ($data['tutor_course'] as $cid) {

    //             $qry .= " AND TRS.trs_tc_id = '{$cid}'";

    //             if (isset($data['tutor_subject_'.$cid]) && count($data['tutor_subject_'.$cid]) > 0) {

    //                 $subject_count = count($data['tutor_subject_'.$cid]);

    //                 $subject_ids = implode(',', $data['tutor_subject_'.$cid]);



    //                 $qry .= " AND TRS.trs_ts_id IN({$subject_ids})";                    

    //             }

    //         }

    //     }



    //     // OTHER SUBJECT

    //     if ($subject != '') {

    //         $qry .= " AND (TS.ts_title LIKE '%{$subject}%' OR TS.ts_description LIKE '%{$subject}%' OR TRS.trs_other LIKE '%{$subject}%')";

    //     }



    //     // GENDER

    //     if ($gender != '') {

    //         $qry .= " AND U.u_gender = '".stripslashes($gender)."'";

    //     }



    //     // RACE

    //     if ($ud_race != '') {

    //         $qry .= " AND UD.ud_race = '".stripslashes($ud_race)."'";

    //     }



    //     // OCCUPATION

    //     if ($current_occupation != '') {

    //         $qry .= " AND UD.ud_current_occupation = '".stripslashes($current_occupation)."'";

    //     }



    //     // TUTOR STATUS

    //     if ($ud_tutor_status != '') {

    //         $qry .= " AND UD.ud_tutor_status = '".stripslashes($ud_tutor_status)."'";

    //     }



    //     // WILL TEACH AT TUITION CENTER

    //     if ($tution_center != '') {

    //         if ($tution_center == '1') {

    //             $qry .= " AND UD.ud_client_status = 'Tuition Centre'";

    //         } elseif ($tution_center == '0') {

    //             $qry .= " AND UD.ud_client_status != 'Tuition Centre'";

    //         }

    //     }



    //     // TUTOR STATUS

    //     if ($u_admin_approve != '') {

    //         $qry .= " AND U.u_status = '".stripslashes($u_admin_approve)."'";

    //     }



    //     // SEARCH STATE

    //     if ($state != '') {

    //         $qry .= " AND UD.ud_state = '".stripslashes($state)."'";

    //     }



    //     // SEARCH PAYING CLIENT

    //     if ($paying_client != '') {

    //         $qry .= " AND U.u_paying_client = '".stripslashes($paying_client)."'";

    //     }



    //     $qry .= " GROUP BY U.u_id";

    //     if ($area_count > 0 || $subject_count > 0) {

    //         $qry .= " HAVING";

    //         $qry .= ($area_count > 0) ? " COUNT(DISTINCT TAC.tac_city_id) = $area_count" : "";

    //         $qry .= ($area_count > 0 && $subject_count > 0) ? " AND" : "";

    //         $qry .= ($subject_count > 0) ? " COUNT(DISTINCT TRS.trs_ts_id) = $subject_count" : "";



    //     }

    //     $qry .= " ORDER BY U.u_id DESC LIMIT 100";

    // //  echo ($qry);

    // //  die();

    //     return $this->db->query($qry);

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

        INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id 

        LEFT JOIN ".DB_PREFIX."_tutor_subject    AS TRS ON TRS.trs_u_id = U.u_id  

        LEFT JOIN ".DB_PREFIX."_tution_subject   AS TS  ON TS.ts_id     = TRS.trs_ts_id  

        LEFT JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 

        LEFT JOIN ".DB_PREFIX."_cities           AS CT  ON CT.city_id   = UD.ud_city

        LEFT JOIN ".DB_PREFIX."_role             AS R   ON R.r_id       = U.u_role";



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

   public function fetchTutorEmailNew($class_user_id){

    
        $qry = "SELECT * FROM ".DB_PREFIX."_user U INNER JOIN ".DB_PREFIX."_classes CL ON U.u_id = CL.cl_tutor_id WHERE U.u_role = '3' AND U.u_status = 'A' AND  CL.cl_tutor_id = '".$class_user_id."'
GROUP BY '".$class_user_id."'";



    return $this->db->query($qry);
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
		
		$logdisplayid        = isset($data['logdisplayid']) ? $this->RealEscape($data['logdisplayid']) : '';

        // $username           = $data['u_username'];

        $email              = $data['u_email'];

        $emailalias         = $data['emailalias'];

        $gender             = $data['u_gender'];

        $password           = $data['u_password'];

        $u_role             = $data['u_role'];
           

        $displayname        = isset($data['u_displayname']) ? $this->RealEscape($data['u_displayname']) : '';

        $profile_pic        = isset($data['u_profile_pic']) ? $this->RealEscape($data['u_profile_pic']) : '';

        $proof_profile_pic  = isset($data['ud_proof_of_accepting_terms']) ? $this->RealEscape($data['ud_proof_of_accepting_terms']) : '';

        $u_status           = isset($data['u_status']) ? $this->RealEscape($data['u_status']) : 'P';

        //$u_paying_client    = isset($data['u_paying_client']) ? $this->RealEscape($data['u_paying_client']) : 'P';
		if(isset($data['u_paying_client'])){
			$u_paying_client    = isset($data['u_paying_client']) ? $this->RealEscape($data['u_paying_client']) : 'P';
		}else{
			$u_paying_client = '';
		}
		
		/*$ipAddress = $_SERVER['REMOTE_ADDR'];
		$resultIpAddress = json_decode(file_get_contents("http://ipinfo.io/{$ipAddress}/json"));
        $dataIpAddress = $resultIpAddress->ip." - C : ".$resultIpAddress->country." - R : ".$resultIpAddress->region." - CT : ".$resultIpAddress->city;*/
        
   if (getenv('HTTP_X_FORWARDED_FOR')) {
       $pipaddress = getenv('HTTP_X_FORWARDED_FOR');
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "Proxy IP : ".$pipaddress. "(via $ipaddress)" ; 
   }else { 
       $ipaddress = getenv('REMOTE_ADDR'); 
       $dataIpAddress = "$ipaddress"; 
   }
        
        


        $firstname          = $this->RealEscape($data['ud_first_name']);

        $lastname           = $this->RealEscape($data['ud_last_name']);

        $phonenum           = $this->RealEscape($data['ud_phone_number']);

        $postalco           = isset($data['ud_postal_code']) ? $this->RealEscape($data['ud_postal_code']) : '';

        $address            = isset($data['ud_address']) ? $this->RealEscape($data['ud_address']) : '';

        $address2           = isset($data['ud_address2']) ? $this->RealEscape($data['ud_address2']) : '';

        $udcountry          = isset($data['ud_country']) ? $this->RealEscape($data['ud_country']) : '150';

        $udstate            = isset($data['ud_state']) ? $this->RealEscape($data['ud_state']) : '';

        $udcity             = isset($data['ud_city']) ? $this->RealEscape($data['ud_city']) : '';
		/*if( isset($data['ud_city'])  && $data['ud_city'] != '' ){
			$udcity             = isset($data['ud_city']) ? $this->RealEscape($data['ud_city']) : '';
		}else{
			$udcity             = isset($data['ud_city2']) ? $this->RealEscape($data['ud_city2']) : '';
		}*/

        $ud_dob             = $data['ud_dob'];

        $ud_company_name    = isset($data['ud_company_name']) ? $this->RealEscape($data['ud_company_name']) : '';

        $ud_tutor_status    = isset($data['ud_tutor_status']) ? $this->RealEscape($data['ud_tutor_status']) : '';

        $ud_tutor_experience    = isset($data['ud_tutor_experience']) ? $this->RealEscape($data['ud_tutor_experience']) : '';

        $ud_about_yourself  = isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';

        $ud_marital_status  = isset($data['ud_marital_status']) ? $this->RealEscape($data['ud_marital_status']) : '';

        $ud_qualification   = isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';

        $ud_race            = $this->RealEscape($data['ud_race']);

        $ud_nationality     = $this->RealEscape($data['ud_nationality']);

        $ud_admin_comment   = $this->RealEscape($data['ud_admin_comment']);

        $rate_per_hour      = $this->RealEscape($data['ud_rate_per_hour']);
		//$rateThis      = trim(explode('\n*** SYSTEM ***', $this->RealEscape($data['ud_rate_per_hour']))[1]);
		//$rate_per_hour      = trim(explode("\n*** SYSTEM ***", $this->RealEscape($data['ud_rate_per_hour']))[1]);
		//$rate_per_hour      = preg_replace("/\n/", '', $rateThis, 1); 
		//$rate_per_hour      = str_replace("\n", '', $rateThis); 


        $ud_client_status   = $data['ud_client_status'];

        $ud_client_status_2 = $this->RealEscape($data['ud_client_status_2']);

        $displayid          = $this->system->GenRandLowerCase(7);

        $ud_current_occupation = isset($data['ud_current_occupation']) ? $this->RealEscape($data['ud_current_occupation']) : '';

        $ud_current_occupation_other = isset($data['ud_current_occupation_other']) ? $this->RealEscape($data['ud_current_occupation_other']) : '';

        $ud_current_company = isset($data['ud_current_company']) ? $this->RealEscape($data['ud_current_company']) : '';

        $user_testimonial   = isset($data['u_testimonial']) ? $this->RealEscape($data['u_testimonial']) : '';

        $cover_area_state = isset($data['cover_area_state']) ? $this->RealEscape($data['cover_area_state']) : '';//luqman tambah

        $student_disability = isset($data['student_disability']) ? $this->RealEscape($data['student_disability']) : '';//luqman tambah

        $combineparentemail = $email . $emailalias;//untuk auto set @tutorkami.com luqman tukar dekat insert je
        
        $experienceMonth   = $data['experienceMonth'];
		
        $ud_workplace_state	= isset($data['ud_workplace_state']) ? $this->RealEscape($data['ud_workplace_state']) : '';
        $ud_workplace_city	= isset($data['ud_workplace_city']) ? $this->RealEscape($data['ud_workplace_city']) : '';
		
		
        $conduct_online	= isset($data['conduct_online']) ? $this->RealEscape($data['conduct_online']) : '';
        $conduct_class	= isset($data['conduct_class'])  ? $this->RealEscape($data['conduct_class']) : '';
		

		$conduct_online_text	= isset($data['conduct_online_text']) ? $this->RealEscape($data['conduct_online_text']) : '';
		$student_disability_text	= isset($data['student_disability_text']) ? $this->RealEscape($data['student_disability_text']) : '';
		
		
        $checkbox1  = isset($data['checkbox-1']) ? $this->RealEscape($data['checkbox-1']) : '';
        $checkbox2  = isset($data['checkbox-2']) ? $this->RealEscape($data['checkbox-2']) : '';
        $checkbox3  = isset($data['checkbox-3']) ? $this->RealEscape($data['checkbox-3']) : '';
        $checkbox4  = isset($data['checkbox-4']) ? $this->RealEscape($data['checkbox-4']) : '';
		
		
		if( isset($data['url_video']) ){
			if( $data['url_video'] != NULL || $data['url_video'] != '' ){
				$url_video = $data['url_video'];
			}else{
				$url_video = NULL;
			}			
		}else{
			$url_video = NULL;
		}

// var_dump($udcity);die;

        if ($ud_dob != '') {

            $ex_dob = explode('/', $ud_dob);

            $ud_dob = $ex_dob[2].'-'.$ex_dob[1].'-'.$ex_dob[0];

        } else{

            // $ud_dob = '';
            $ud_dob = NULL;

        }

        // untuk dapatkan city parent dekat side admin
		/*
        if($ud_client_status_2 != '' && $ud_client_status_2 == 'Parent'){
            $citysql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '{$udcity}'";
            
            $cityqry = $this->db->query($citysql);
        
            if($cityqry->num_rows > 0){
                while($row = mysqli_fetch_array($cityqry))
                {
                    $udcity = $row['city_name'];
                }
            }else{
                $udcity = $data['ud_city2'];
            }
        }*/
        /*
		if($udcity > 0){
			$citysql = "SELECT * FROM ".DB_PREFIX."_cities WHERE city_id = '{$udcity}'";
			$cityqry = $this->db->query($citysql);
            if($cityqry->num_rows > 0){
                $row = mysqli_fetch_array($cityqry);
                $udcity = $row['city_id'];
                
            }
		}else{
			$udcity = $data['ud_city2'];
		}*/
		
		



        if(!isset($data['u_id']) || $data['u_id']=='') {
/*
if($u_role == 4){
$sqlChk = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND (u_email = '{$lastname}' || u_username = '{$lastname}' || u_email = '{$lastname}' )";
$qrySqlChk = $this->db->query($sqlChk);
if ($qrySqlChk->num_rows == 0) {
}else{
	Session::SetFlushMsg("error", 'Email has been used previously11.');
	$res = false;
}

$sqlChk2 = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND (u_email = '{$email}' || u_username = '{$email}' || u_email = '{$combineparentemail}' )";
$qrySqlChk2 = $this->db->query($sqlChk2);
if ($qrySqlChk2->num_rows == 0) {
}else{
	Session::SetFlushMsg("error", 'Key has been used previously11.');
	$res = false;
}

$sqlChk3 = "SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE UD.ud_phone_number = '{$phonenum}'";
$qrySqlChk3 = $this->db->query($sqlChk3);
if ($qrySqlChk3->num_rows == 0) {
}else{
	Session::SetFlushMsg("error", 'Phone number has been used previously11.');
	$res = false;
}
}
*/
/*
            $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 

            u_status <> 'D' AND (

                u_email = '{$email}' || u_username = '{$email}'

            )";
*/
            // query luqman hide sbb email ngn username kene detect email sahaja.xda username guna time
            // select * from tk_user where u_status <> 'D' AND (u_email = 'ali@gmail.com' || u_username = 'ali@gmail.com' || u_email = 'ali@gmail.com' || u_username = 'ali@gmail.com')

/* START fadhli - filter email combine and without combine*/
			$sql = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND (u_email = '{$email}' || u_username = '{$email}' || u_email = '{$combineparentemail}' )";
/* End fadhli */

            $qry = $this->db->query($sql);



            if ($qry->num_rows == 0) {//email



                $phnqry = $this->db->query("SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_status <> 'D' AND UD.ud_phone_number = '{$phonenum}'");
            

                if ($phnqry->num_rows == 0) {//phnqry

/* START - fadhli - ADD USER LOG*/
$run = $this->db->query(" INSERT INTO ".DB_PREFIX."_user_log SET user = '".$_SESSION[DB_PREFIX]['u_id']."', date = '".date('Y-m-d')."', time = '".date('H:i:s')."', action = 'ADD USER : ".$combineparentemail."' ");
/* END - fadhli - ADD USER LOG*/

// luqman u_username = '".$username."',
                    $sqli = "INSERT INTO ".DB_PREFIX."_user SET 

                        u_email = '".$combineparentemail."',

                        u_username = '".$combineparentemail."',

                        u_displayid = '".$displayid."',

                        u_displayname = '".$displayname."',

                        u_gender = '".$gender."',

                        u_status = '".$u_status."',

                        u_paying_client = '".$u_paying_client."',

                        u_password = '".md5($password)."',

                        u_profile_pic = '".$profile_pic."',
						
						u_admin_approve = '2',

                        u_create_date = '".date('Y-m-d H:i:s')."',
						
						u_modified_date = '0000-00-00 00:00:00',

                        u_role  = '{$u_role}',

                        ip_address = '".$dataIpAddress."',
						
                        url_video = '".$url_video."',

                        u_country_id = '".$udcountry."'";



                    $exe = $this->db->query($sqli);
					
					if($exe){//exe2

                        $insert_iud = $user_id = $this->db->insert_id;



                        $sq = "INSERT INTO ".DB_PREFIX."_user_details SET

                            ud_u_id         = '{$insert_iud}',

                            ud_first_name   = '{$firstname}',

                            ud_last_name    = '{$lastname}',

                            ud_dob          = '{$ud_dob}',

                            ud_phone_number = '{$phonenum}',

                            ud_address      = '{$address}',

                            ud_address2     = '{$address2}',

                            ud_country      = '{$udcountry}',

                            ud_state        = '{$udstate}',

                            ud_city         = '{$udcity}',

                            ud_postal_code  = '{$postalco}',

                            ud_company_name = '{$ud_company_name}',

                            ud_race         = '{$ud_race}',

                            ud_nationality  = '{$ud_nationality}',

                            ud_admin_comment = '{$ud_admin_comment}',

                            ud_client_status = '{$ud_client_status}',

                            ud_client_status_2 = '{$ud_client_status_2}',

                            ud_tutor_status = '{$ud_tutor_status}',

                            ud_current_occupation = '{$ud_current_occupation}',

                            ud_current_occupation_other = '{$ud_current_occupation_other}',

                            ud_current_company = '{$ud_current_company}',
							
							student_disability = '{$student_disability}',

                            ud_proof_of_accepting_terms = '{$proof_profile_pic}'";

            

                        $exe = $this->db->query($sq);
						
                        // $res = false;
                        //     Session::SetFlushMsg("success", 'Customer Added Successfully.');

                        if($exe) {//exe1

                            $res = $insert_iud;//ni last inserted id luqman



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

// luqman  
                            if($res != ''){//check last insert id then search display id
                                $disidsql = "SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_id = '{$res}'";

                                $disidqry = $this->db->query($disidsql);
                                
                            if($disidqry->num_rows > 0){
                                while($row = mysqli_fetch_array($disidqry))
                                {
                                    $u_displayid = $row['u_displayid'];
                                }

                            unset($_SESSION['tempLast']);
                            unset($_SESSION['tempPass']);
                            unset($_SESSION['tempEmail']);
                            unset($_SESSION['tempAlias']);
                            unset($_SESSION['tempFirst']);
                            unset($_SESSION['tempGender']);
                            unset($_SESSION['tempDOB']);
                            unset($_SESSION['tempPhone']);
                            unset($_SESSION['tempRace']);
                            unset($_SESSION['tempNat']);
                            unset($_SESSION['tempAddress']);
                            unset($_SESSION['tempState']);
                            unset($_SESSION['tempCity']);
                            unset($_SESSION['tempStatus2']);
                            unset($_SESSION['tempStatus']);
                            unset($_SESSION['tempPay']);
                            unset($_SESSION['tempComm']);
                            
                                    Session::SetFlushMsg("success", 'Customer Added Successfully.');//kene letak timeout javascript kalau tak mesej xkua
                            echo "<script>setTimeout(\"location.href = 'https://www.tutorkami.com/admin/manage_user.php?action=edit&u_id=$u_displayid';\",1500);</script>";
                            }
                           
                        }//check last insert id then search display id
                        
                            unset($_SESSION['tempLast']);
                            unset($_SESSION['tempPass']);
                            unset($_SESSION['tempEmail']);
                            unset($_SESSION['tempAlias']);
                            unset($_SESSION['tempFirst']);
                            unset($_SESSION['tempGender']);
                            unset($_SESSION['tempDOB']);
                            unset($_SESSION['tempPhone']);
                            unset($_SESSION['tempRace']);
                            unset($_SESSION['tempNat']);
                            unset($_SESSION['tempAddress']);
                            unset($_SESSION['tempState']);
                            unset($_SESSION['tempCity']);
                            unset($_SESSION['tempStatus2']);
                            unset($_SESSION['tempStatus']);
                            unset($_SESSION['tempPay']);
                            unset($_SESSION['tempComm']);
                           
                            Session::SetFlushMsg("success", 'Customer Added Successfully.');
                        } else {//exe1

                            $res = false;

                            Session::SetFlushMsg("error", 'Database error: '.$this->db->error);

                            $this->db->query("DELETE FROM ".DB_PREFIX."_user WHERE u_id = '".$insert_iud."'");

                        }



                    } else {//exe2

                        $res = false;

                        Session::SetFlushMsg("error", 'Database error: '.$this->db->error);

                    }

                } else {//phnqry
                
                    $_SESSION['tempLast'] = $data['ud_last_name'];
                    $_SESSION['tempPass'] = $data['u_password'];
                    $_SESSION['tempEmail'] = $data['u_email'];  
                        $_SESSION['tempAlias'] = $data['emailalias'];
                    $_SESSION['tempFirst'] = $data['ud_first_name'];
                    $_SESSION['tempGender'] = $data['u_gender'];
                    $_SESSION['tempDOB'] = $data['ud_dob'];
                    $_SESSION['tempPhone'] = $data['ud_phone_number'];
                    $_SESSION['tempRace'] = $data['ud_race'];
                    $_SESSION['tempNat'] = $data['ud_nationality'];
                    $_SESSION['tempAddress'] = $data['ud_address'];
                    $_SESSION['tempState'] = $data['ud_state']; 
                        $_SESSION['tempCity'] = $data['ud_city'];
                    $_SESSION['tempStatus2'] = $data['ud_client_status_2'];
                    $_SESSION['tempStatus'] = $data['u_status'];
                    $_SESSION['tempPay'] = $data['u_paying_client'];
                    $_SESSION['tempComm'] = $data['ud_admin_comment'];

                    Session::SetFlushMsg("error", 'Phone number has been used previously.');

                    $res = false;

                } 

                

                

            } else {//email
                
                    $_SESSION['tempLast'] = $data['ud_last_name'];
                    $_SESSION['tempPass'] = $data['u_password'];
                    $_SESSION['tempEmail'] = $data['u_email'];  
                        $_SESSION['tempAlias'] = $data['emailalias'];
                    $_SESSION['tempFirst'] = $data['ud_first_name'];
                    $_SESSION['tempGender'] = $data['u_gender'];
                    $_SESSION['tempDOB'] = $data['ud_dob'];
                    $_SESSION['tempPhone'] = $data['ud_phone_number'];
                    $_SESSION['tempRace'] = $data['ud_race'];
                    $_SESSION['tempNat'] = $data['ud_nationality'];
                    $_SESSION['tempAddress'] = $data['ud_address'];
                    $_SESSION['tempState'] = $data['ud_state']; 
                        $_SESSION['tempCity'] = $data['ud_city'];
                    $_SESSION['tempStatus2'] = $data['ud_client_status_2'];
                    $_SESSION['tempStatus'] = $data['u_status'];
                    $_SESSION['tempPay'] = $data['u_paying_client'];
                    $_SESSION['tempComm'] = $data['ud_admin_comment'];

                Session::SetFlushMsg("error", 'Key already exists in our record.');

                $res = false;

            }



        } else {//start update

            $id = $user_id = $data['u_id'];


/*
            $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE 

                u_status <> 'D' AND u_id <> {$id} AND (

                    u_email = '{$email}' || 

                    u_username = '{$email}'

                )";
*/
/* START fadhli - filter email combine and without combine*/
            $sql = "SELECT * FROM ".DB_PREFIX."_user WHERE u_status <> 'D' AND u_id <> {$id} AND (u_email = '{$email}' || u_username = '{$email}' || u_email = '{$combineparentemail}' )";
/* End fadhli */

            $qry = $this->db->query($sql);



            if ($qry->num_rows == 0) {//qry

                /* START fadhli - delete/remove/unlike image/picture in dir */
                if ($profile_pic != '') {
					$sqlPicture = "SELECT * FROM ".DB_PREFIX."_user WHERE u_id = {$id}";
					$resultPicture = $this->db->query($sqlPicture);
					if($resultPicture->num_rows > 0){
						$rowPicture = mysqli_fetch_array($resultPicture);
						$thisPic = $rowPicture['u_profile_pic'];
						$dirPicture = "000".$thisPic."_0.jpg";
						unlink('../images/profile/'.$dirPicture);
					}
                }
                /* END - fadhli */

/* START - fadhli - ADD USER LOG*/
/*
u_password $password           = $data['u_password'];
ud_city2    ud_city $udcity             = isset($data['ud_city']) ? $this->RealEscape($data['ud_city']) : '';
u_paying_client

u_email $email              = $data['u_email'];
ud_first_name $firstname          = $this->RealEscape($data['ud_first_name']);
u_gender $gender             = $data['u_gender'];
ud_dob $ud_dob             = $data['ud_dob'];
ud_phone_number $phonenum           = $this->RealEscape($data['ud_phone_number']);
ud_race $ud_race            = $this->RealEscape($data['ud_race']);
ud_nationality $ud_nationality     = $this->RealEscape($data['ud_nationality']);
ud_address $address            = $data['ud_address']; 
ud_state $udstate            = isset($data['ud_state']) ? $this->RealEscape($data['ud_state']) : '';
ud_country $udcountry          = isset($data['ud_country']) ? $this->RealEscape($data['ud_country']) : '150';
ud_client_status_2 $ud_client_status_2 = $this->RealEscape($data['ud_client_status_2']);
u_status $u_status           = isset($data['u_status']) ? $this->RealEscape($data['u_status']) : 'P';
ud_admin_comment $ud_admin_comment   = $this->RealEscape($data['ud_admin_comment']);


ud_last_name $lastname           = $this->RealEscape($data['ud_last_name']);
u_displayname $displayname        = isset($data['u_displayname']) ? $this->RealEscape($data['u_displayname']) : '';
ud_current_company  $ud_current_company = isset($data['ud_current_company']) ? $this->RealEscape($data['ud_current_company']) : '';
ud_address2  $address2           = isset($data['ud_address2']) ? $this->RealEscape($data['ud_address2']) : '';
ud_marital_status $ud_marital_status  = isset($data['ud_marital_status']) ? $this->RealEscape($data['ud_marital_status']) : '';
ud_tutor_status $ud_tutor_status    = isset($data['ud_tutor_status']) ? $this->RealEscape($data['ud_tutor_status']) : '';
ud_current_occupation $ud_current_occupation = isset($data['ud_current_occupation']) ? $this->RealEscape($data['ud_current_occupation']) : '';
ud_rate_per_hour $rate_per_hour      = $this->RealEscape($data['ud_rate_per_hour']);
student_disability $student_disability = isset($data['student_disability']) ? $this->RealEscape($data['student_disability']) : '';
ud_qualification $ud_qualification   = isset($data['ud_qualification']) ? $this->RealEscape($data['ud_qualification']) : '';
ud_tutor_experience $ud_tutor_experience    = isset($data['ud_tutor_experience']) ? $this->RealEscape($data['ud_tutor_experience']) : '';
ud_about_yourself $ud_about_yourself  = isset($data['ud_about_yourself']) ? $this->RealEscape($data['ud_about_yourself']) : '';
ud_client_status $ud_client_status   = $this->RealEscape($data['ud_client_status']);
*/


$sqlUserRecord = " SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_id = '{$id}' ";
$resultUserRecord = $this->db->query($sqlUserRecord);
if($resultUserRecord->num_rows > 0){
	$rowUserRecord = mysqli_fetch_array($resultUserRecord);
	if( isset($data['u_email']) ){
		if( $rowUserRecord['u_email'] == $data['u_email'] ){
			$no1 = '';
		}else{
			$no1 = 'Email : '.$rowUserRecord['u_email'].'<br>';
		}
	}
	if( isset($data['ud_first_name']) ){
		if( $rowUserRecord['ud_first_name'] == $data['ud_first_name'] ){
			$no2 = '';
		}else{
			$no2 = 'First Name : '.$rowUserRecord['ud_first_name'].'<br>';
		}
	}
	if( isset($data['ud_last_name']) ){
		if( $rowUserRecord['ud_last_name'] == $data['ud_last_name'] ){
			$no3 = '';
		}else{
			$no3 = 'Last Name : '.$rowUserRecord['ud_last_name'].'<br>';
		}
	}
	if( isset($data['u_gender']) ){
		if( $rowUserRecord['u_gender'] == $data['u_gender'] ){
			$no5 = '';
		}else{
			$no5 = 'Gender : '.$rowUserRecord['u_gender'].'<br>';
		}
	}
	if( isset($data['u_displayname']) ){
		if( $rowUserRecord['u_displayname'] == $data['u_displayname'] ){
			$no4 = '';
		}else{
			$no4 = 'Display Name : '.$rowUserRecord['u_displayname'].'<br>';
		}
	}
	if( isset($data['ud_current_company']) ){
		if( $rowUserRecord['ud_current_company'] == $data['ud_current_company'] ){
			$no19 = '';
		}else{
			$no19 = 'Company : '.$rowUserRecord['ud_current_company'].'<br>';
		}
	}
	if( isset($data['ud_address2']) ){
		if( $rowUserRecord['ud_address2'] == $data['ud_address2'] ){
			$no12 = '';
		}else{
			$no12 = 'Address : '.$rowUserRecord['ud_address2'].'<br>';
		}
	}
	if( isset($data['ud_marital_status']) ){
		if( $rowUserRecord['ud_marital_status'] == $data['ud_marital_status'] ){
			$no6 = '';
		}else{
			$no6 = 'Marital : '.$rowUserRecord['ud_marital_status'].'<br>';
		}
	}
	if( isset($data['ud_tutor_status']) ){
		if( $rowUserRecord['ud_tutor_status'] == $data['ud_tutor_status'] ){
			$no15 = '';
		}else{
			$no15 = 'Status As Tutor: : '.$rowUserRecord['ud_tutor_status'].'<br>';
		}
	}
	if( isset($data['ud_current_occupation']) ){
		if( $rowUserRecord['ud_current_occupation'] == $data['ud_current_occupation'] ){
			$no20 = '';
		}else{
			$no20 = 'Occupation : '.$rowUserRecord['ud_current_occupation'].'<br>';
		}
	}
	if( isset($data['ud_rate_per_hour']) ){
		if( $rowUserRecord['ud_rate_per_hour'] == $data['ud_rate_per_hour'] ){
			$no21 = '';
		}else{
			$no21 = 'Tutor Rate : '.$rowUserRecord['ud_rate_per_hour'].'<br>';
		}
	}
	if( isset($data['student_disability']) ){
		if( $rowUserRecord['student_disability'] == $data['student_disability'] ){
			$no22 = '';
		}else{
			$no22 = 'Disability Student : '.$rowUserRecord['student_disability'].'<br>';
		}
	}
	if( isset($data['ud_qualification']) ){
		if( $rowUserRecord['ud_qualification'] == $data['ud_qualification'] ){
			$no23 = '';
		}else{
			$no23 = 'Qualification : '.$rowUserRecord['ud_qualification'].'<br>';
		}
	}
	if( isset($data['ud_tutor_experience']) ){
		if( $rowUserRecord['ud_tutor_experience'] == $data['ud_tutor_experience'] ){
			$no24 = '';
		}else{
			$no24 = 'Experience : '.$rowUserRecord['ud_tutor_experience'].'<br>';
		}
	}
	if( isset($data['ud_about_yourself']) ){
		if( $rowUserRecord['ud_about_yourself'] == $data['ud_about_yourself'] ){
			$no25 = '';
		}else{
			$no25 = 'About Yourself : '.$rowUserRecord['ud_about_yourself'].'<br>';
		}
	}
	if( isset($data['ud_client_status']) ){
		if( $rowUserRecord['ud_client_status'] == $data['ud_client_status'] ){
			$no17 = '';
		}else{
		    if($rowUserRecord['ud_client_status'] == '0'){
			    $no17 = 'Consider tuition center : No <br>';
		    }else{
			    $no17 = 'Consider tuition center : Yes <br>';
		    }
		}
	}
	
	if( isset($data['ud_dob']) ){
	    
	    if($data['ud_dob'] == '' || $data['ud_dob'] == NULL){
	        
		    if( $rowUserRecord['ud_dob'] == '' || $rowUserRecord['ud_dob'] == NULL ){
			    $no7 = '';
		    }else{
			    $no7 = 'DOB : '.$rowUserRecord['ud_dob'].'<br>';
		    }
	    }else{
		    $ex_dob2 = explode('/', $data['ud_dob']);
		    $ud_dob2 = $ex_dob2[2].'-'.$ex_dob2[1].'-'.$ex_dob2[0];	
			
		    if( $rowUserRecord['ud_dob'] == $ud_dob2 ){
			    $no7 = '';
		    }else{
			    $no7 = 'DOB : '.$rowUserRecord['ud_dob'].'<br>';
		    }
	    }
		
	}
	if( isset($data['ud_phone_number']) ){
		if( $rowUserRecord['ud_phone_number'] == $data['ud_phone_number'] ){
			$no8 = '';
		}else{
			$no8 = 'Phone : '.$rowUserRecord['ud_phone_number'].'<br>';
		}
	}
	if( isset($data['ud_race']) ){
		if( $rowUserRecord['ud_race'] == $data['ud_race'] ){
			$no9 = '';
		}else{
			$no9 = 'Race : '.$rowUserRecord['ud_race'].'<br>';
		}
	}
	if( isset($data['ud_nationality']) ){
		if( $rowUserRecord['ud_nationality'] == $data['ud_nationality'] ){
			$no10 = '';
		}else{
			$no10 = 'Nationality : '.$rowUserRecord['ud_nationality'].'<br>';
		}
	}
	if( isset($data['ud_address']) ){
		if( $rowUserRecord['ud_address'] == $data['ud_address'] ){
			$no11 = '';
		}else{
			$no11 = 'Address : '.$rowUserRecord['ud_address'].'<br>';
		}
	}
	
	if( isset($data['ud_city']) ){
	    /*
		if( $rowUserRecord['ud_city'] == $data['ud_city'] ){
			$no28 = '';
		}else{
			$queryCityLog = " SELECT * FROM ".DB_PREFIX."_cities WHERE city_id ='".$rowUserRecord['ud_city']."' ";
			$resultCityLog = $this->db->query($queryCityLog);
			if($resultCityLog->num_rows > 0){
				$rowCityLog = mysqli_fetch_array($resultCityLog);
				$no28 = 'City : '.$rowCityLog['city_name'].'<br>';
			}
		}     $no28 = $data['ud_city'];*/
		if( $data['ud_city'] == 'Select City Name' ){
		    
		    if( $rowUserRecord['ud_city'] == $data['ud_city'] ){
		    	$no28 = '';
	    	}else{
		    	$queryCityLog = " SELECT * FROM ".DB_PREFIX."_cities WHERE city_id ='".$rowUserRecord['ud_city']."' ";
		    	$resultCityLog = $this->db->query($queryCityLog);
		    	if($resultCityLog->num_rows > 0){
			    	$rowCityLog = mysqli_fetch_array($resultCityLog);
			    	$no28 = 'City : '.$rowCityLog['city_name'].'<br>';
		    	}else{
	    		    $no28 = 'City : Select City Name <br>';
	    		}
	    	}
		    
		}else{
	    	if( $rowUserRecord['ud_city'] == $data['ud_city'] ){
		    	$no28 = '';
	    	}else{
		    	$queryCityLog = " SELECT * FROM ".DB_PREFIX."_cities WHERE city_id ='".$rowUserRecord['ud_city']."' ";
		    	$resultCityLog = $this->db->query($queryCityLog);
	    		if($resultCityLog->num_rows > 0){
		    		$rowCityLog = mysqli_fetch_array($resultCityLog);
	    			$no28 = 'City : '.$rowCityLog['city_name'].'<br>';
	    		}else{
	    		    $no28 = 'City : Select City Name <br>';
	    		}
	    	}
		}
	}
	
	if( isset($data['ud_state']) ){
		if( $rowUserRecord['ud_state'] == $data['ud_state'] ){
			$no13 = '';
		}else{
			$queryStateLog = " SELECT * FROM ".DB_PREFIX."_states WHERE st_id ='".$rowUserRecord['ud_state']."' ";
			$resultStateLog = $this->db->query($queryStateLog);
			if($resultStateLog->num_rows > 0){
				$rowStateLog = mysqli_fetch_array($resultStateLog);
				$no13 = 'State : '.$rowStateLog['st_name'].'<br>';
			}
		}
	}
	/*
	if( isset($data['ud_country']) ){
		if( $rowUserRecord['ud_country'] == isset($data['ud_country']) ){
			$no14 = '';
		}else{
			$no14 = 'Country : '.$rowUserRecord['ud_country'].'<br>';
		}
	}*/
	if( isset($data['ud_client_status_2']) ){
		if( $rowUserRecord['ud_client_status_2'] == $data['ud_client_status_2'] ){
			$no18 = '';
		}else{
			$no18 = 'Client Status : '.$rowUserRecord['ud_client_status_2'].'<br>';
		}
	}
	if( isset($data['u_status']) ){
		if( $rowUserRecord['u_status'] == $data['u_status'] ){
			$no16 = '';
		}else{
			if($rowUserRecord['u_status'] == 'A'){
				$no16 = 'User Status : Active <br>';
			}else{
				$no16 = 'User Status : Banned <br>';
			}
		}
	}
	if( isset($data['u_paying_client']) ){
		if( $rowUserRecord['u_paying_client'] == $data['u_paying_client'] ){
			$no27 = '';
		}else{
			$no27 = 'Paying Client : Unpay <br>';
		}
	}else{
		if( $rowUserRecord['u_paying_client'] == $data['u_paying_client'] ){
			$no27 = '';
		}else{
			$no27 = 'Paying Client : Pay <br>';
		}
	}
	if( isset($data['ud_admin_comment']) ){
		if( $rowUserRecord['ud_admin_comment'] == $data['ud_admin_comment'] ){
			$no26 = '';
		}else{
			$no26 = 'Admin Comment : '.$rowUserRecord['ud_admin_comment'].'<br>';
		}
	}

	
	$actionLog = $no1.''.$no2.''.$no3.''.$no5.''.$no4.''.$no19.''.$no12.''.$no6.''.$no15.''.$no20.''.$no21.''.$no22.''.$no23.''.$no24.''.$no25.''.$no7.''.$no8.''.$no9.''.$no10.''.$no11.''.$no28.''.$no13.''.$no18.''.$no16.''.$no14.''.$no17.''.$no26.''.$no27;
	$run = $this->db->query(" INSERT INTO ".DB_PREFIX."_user_log SET user = '".$_SESSION[DB_PREFIX]['u_id']."', date = '".date('Y-m-d')."', time = '".date('H:i:s')."', action = 'UPDATE USER : ".$logdisplayid."<br>".$actionLog."' ");
}
/* END - fadhli - ADD USER LOG*/

// luqman tukar username terima email
                $sqly = "UPDATE ".DB_PREFIX."_user SET 

                    u_email = '".$email."',

                    u_username = '".$email."',

                    u_displayname = '".$displayname."',

                    u_gender = '".$gender."',

                    u_status = '".$u_status."', 

                    u_paying_client = '".$u_paying_client."',
					
                    url_video = '".$url_video."',

                    u_role = '{$u_role}'";



                if ($password != '') {

                    $sqly .= ", u_password = '".md5($password)."'";

                }

                if ($profile_pic != '') {
                    $sqly .= ", u_profile_pic = '".$profile_pic."'";

                }

                $sqly .= " WHERE u_id = {$id}";

                $exe = $this->db->query($sqly);
/* update job email*/				
if($u_role == 4){
	$sqlUpdateJob = " UPDATE ".DB_PREFIX."_job SET j_email = '".$email."' ";
	$sqlUpdateJob .= " WHERE u_id = {$id}";
	$exeUpdateJob = $this->db->query($sqlUpdateJob);
}
/* update job email*/

                if($exe->num_rows == 0){//exeupdate

                    $phnbndsql = "SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_status = 'B' AND UD.ud_phone_number = '{$phonenum}'";

                    $phnbndqry = $this->db->query($phnbndsql);//check nombor kena ban

                    $phnprofilesql = "SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_status <> 'D' AND U.u_email = '{$email}' AND UD.ud_phone_number = '{$phonenum}'";

                     $phnprofileqry = $this->db->query($phnprofilesql); //profile sendiri

            

                     $phnsql = "SELECT * FROM ".DB_PREFIX."_user AS U INNER JOIN ".DB_PREFIX."_user_details UD ON U.u_id = UD.ud_u_id WHERE U.u_status <> 'D' AND U.u_email <> '{$email}' AND UD.ud_phone_number = '{$phonenum}'";

                      $phnqry = $this->db->query($phnsql); //check duplicate nombor
                     // var_dump($email);die;
                 if($phnbndqry->num_rows === 0 && $phnprofileqry->num_rows > 0) {
                    //klu xban && updateprofile je

                /* START fadhli - delete/remove/unlike image/picture in dir */
                if ($proof_profile_pic != '') {
					$sqlProof = "SELECT * FROM ".DB_PREFIX."_user_details WHERE ud_u_id = {$id}";
					$resultProof = $this->db->query($sqlProof);
					if($resultProof->num_rows > 0){
						$rowProof = mysqli_fetch_array($resultProof);
						$thisProof = $rowProof['ud_proof_of_accepting_terms'];
						unlink('../'.$thisProof);
					}
                }
                /* END - fadhli */
                    //ud_rate_per_hour = '{$rate_per_hour}',
                    $sqlm = "UPDATE ".DB_PREFIX."_user_details SET 

                        ud_country      = '{$udcountry}',

                        ud_state        = '{$udstate}',

                        ud_city         = '{$udcity}',               

                        ud_first_name   = '{$firstname}',

                        ud_last_name    = '{$lastname}',

                        ud_dob          = '{$ud_dob}',

                        ud_phone_number = '{$phonenum}',

                        ud_address      = '{$address}',

                        ud_address2     = '{$address2}',

                        ud_postal_code  = '{$postalco}',

                        ud_company_name = '{$ud_company_name}',

                        ud_race         = '{$ud_race}',

                        ud_nationality  = '{$ud_nationality}',

                        ud_admin_comment = '{$ud_admin_comment}',

                        ud_marital_status = '{$ud_marital_status}',

                        ud_qualification = '{$ud_qualification}',

                        ud_client_status = '{$ud_client_status}',

                        ud_client_status_2 = '{$ud_client_status_2}',
                        
                        ud_rate_per_hour = '{$rate_per_hour}',

                        ud_tutor_experience = '{$ud_tutor_experience}',

                        ud_tutor_experience_month = '{$experienceMonth}',

                        ud_about_yourself = '{$ud_about_yourself}',

                        ud_tutor_status = '{$ud_tutor_status}',

                        ud_current_occupation = '{$ud_current_occupation}',

                        ud_current_occupation_other = '{$ud_current_occupation_other}',
						
						student_disability = '{$student_disability}',
						
                        ud_workplace_state        = '{$ud_workplace_state}',

                        ud_workplace_city         = '{$ud_workplace_city}',  
						
						conduct_class = '{$conduct_class}',
						conduct_online = '{$conduct_online}',
						
						conduct_online_text = '{$conduct_online_text}',
						student_disability_text = '{$student_disability_text}',

                        ud_current_company = '{$ud_current_company}'";


                    if ($proof_profile_pic != '') {

                        $sqlm .= ", ud_proof_of_accepting_terms = '{$proof_profile_pic}'";

                    }

                    $sqlm .= " WHERE ud_u_id = {$id}";

                    $exe = $this->db->query($sqlm);
					
/* missing ac */
//$this->db->query("UPDATE ".DB_PREFIX."_user_details SET ud_admin_comment = '".$ud_admin_comment."' WHERE ud_u_id = $id");
/* missing ac */
if (filter_var($lastname, FILTER_VALIDATE_EMAIL)) {
	$this->db->query(" UPDATE ".DB_PREFIX."_job SET actual_email = '".$lastname."' WHERE j_email = '".$email."' ");
}

                    if($exe) {//exe

                        $res = $id;




	
	            	if( $checkbox1 == 'on' || $checkbox2 == 'on' || $checkbox3 == 'on' || $checkbox4 == 'on' ){
            	            	if( $checkbox1 == 'on'){
                                            $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti1 = $this->db->query($sqlTesti1);
            									if($resultTesti1->num_rows > 0){
            										$rowTesti1 = mysqli_fetch_array($resultTesti1);
            										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
            										unlink('../'.$thisTesti1);
            									}
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '' WHERE ut_u_id = $id");
            	            	}
            	            	if( $checkbox2 == 'on'){
                                            $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti2 = $this->db->query($sqlTesti2);
            									if($resultTesti2->num_rows > 0){
            										$rowTesti2 = mysqli_fetch_array($resultTesti2);
            										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
            										unlink('../'.$thisTesti2);
            									}
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '' WHERE ut_u_id = $id");
            	            	}
            	            	if( $checkbox3 == 'on'){
                                            $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti3 = $this->db->query($sqlTesti3);
            									if($resultTesti3->num_rows > 0){
            										$rowTesti3 = mysqli_fetch_array($resultTesti3);
            										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
            										unlink('../'.$thisTesti3);
            									}
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '' WHERE ut_u_id = $id");
            	            	}
            	            	if( $checkbox4 == 'on'){
                                            $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti4 = $this->db->query($sqlTesti4);
            									if($resultTesti4->num_rows > 0){
            										$rowTesti4 = mysqli_fetch_array($resultTesti4);
            										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
            										unlink('../'.$thisTesti4);
            									}
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '' WHERE ut_u_id = $id");
            	            	}	            	    
	            	}else{
	            	    
            		            if ($user_testimonial != '') {
            		            	# DELETE PREVIOUS TESTIMONIAL DATA #
            		            	if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$id."'")->num_rows > 0){
            
            		            		if($user_testimonial['user_testimonial1'] != '') {
            								
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti1 = $this->db->query($sqlTesti1);
            									if($resultTesti1->num_rows > 0){
            										$rowTesti1 = mysqli_fetch_array($resultTesti1);
            										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
            										unlink('../'.$thisTesti1);
            									}
                                            /* END - fadhli */
            								
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $id");
            							}
            							if($user_testimonial['user_testimonial2'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti2 = $this->db->query($sqlTesti2);
            									if($resultTesti2->num_rows > 0){
            										$rowTesti2 = mysqli_fetch_array($resultTesti2);
            										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
            										unlink('../'.$thisTesti2);
            									}
                                            /* END - fadhli */
            								
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $id");
            							}
            							if($user_testimonial['user_testimonial3'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti3 = $this->db->query($sqlTesti3);
            									if($resultTesti3->num_rows > 0){
            										$rowTesti3 = mysqli_fetch_array($resultTesti3);
            										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
            										unlink('../'.$thisTesti3);
            									}
                                            /* END - fadhli */
            						
            								$this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $id");
            							}
            							if($user_testimonial['user_testimonial4'] != '') {
            
                                            /* START fadhli - delete/remove/unlike image/picture in dir */
                                            $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                            $resultTesti4 = $this->db->query($sqlTesti4);
            									if($resultTesti4->num_rows > 0){
            										$rowTesti4 = mysqli_fetch_array($resultTesti4);
            										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
            										unlink('../'.$thisTesti4);
            									}
                                            /* END - fadhli */
            							
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
	            	    
	            	}
/*
                        if ($user_testimonial != '') {//testimonial

                            # DELETE PREVIOUS TESTIMONIAL DATA #


                            if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$id."'")->num_rows > 0){



                            if($user_testimonial['user_testimonial1'] != '') {
								
                                $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti1 = $this->db->query($sqlTesti1);
									if($resultTesti1->num_rows > 0){
										$rowTesti1 = mysqli_fetch_array($resultTesti1);
										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
										unlink('../'.$thisTesti1);
									}

                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial2'] != '') {
								
                                $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti2 = $this->db->query($sqlTesti2);
									if($resultTesti2->num_rows > 0){
										$rowTesti2 = mysqli_fetch_array($resultTesti2);
										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
										unlink('../'.$thisTesti2);
									}

                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial3'] != '') {

                                $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti3 = $this->db->query($sqlTesti3);
									if($resultTesti3->num_rows > 0){
										$rowTesti3 = mysqli_fetch_array($resultTesti3);
										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
										unlink('../'.$thisTesti3);
									}

                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial4'] != '') {

                                $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti4 = $this->db->query($sqlTesti4);
									if($resultTesti4->num_rows > 0){
										$rowTesti4 = mysqli_fetch_array($resultTesti4);
										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
										unlink('../'.$thisTesti4);
									}

                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $id");

                            }



                        }

                        else{

                            if($this->db->query("INSERT INTO ".DB_PREFIX."_user_testimonial(ut_u_id,ut_user_testimonial1,ut_user_testimonial2,ut_user_testimonial3,ut_user_testimonial4,ut_create_date) VALUES('".$id."','".$user_testimonial['user_testimonial1']."','".$user_testimonial['user_testimonial2']."','".$user_testimonial['user_testimonial3']."','".$user_testimonial['user_testimonial4']."','".date('Y-m-d H:i:s')."')")){}

                                else{

                                    $er++;

                                }



                          }

                        }//testimonial
*/


                        Session::SetFlushMsg("success", 'Customer Updated Successfully.');


                    } else {    //exe                    

                        $res = false;

                        Session::SetFlushMsg("error", 'Database error: '. $this->db->error);

                    }

                        // $res = false;
                        // Session::SetFlushMsg("success", 'Customer Updated Successfully1.');
                         // Session::SetFlushMsg("success", 'Customer Updated Successfully but Phone number already exists and cannot be updated.');

              // var_dump('takban && duplicate phone number');die;//sini kena update kecuali phone number success update dan phone exists previously

//klu xban && ada phone number
                } elseif ($phnbndqry->num_rows === 0 && $phnqry->num_rows === 0) {
                    //klu xban dan takda duplicate
                 
                /* START fadhli - delete/remove/unlike image/picture in dir */
                if ($proof_profile_pic != '') {
					$sqlProof = "SELECT * FROM ".DB_PREFIX."_user_details WHERE ud_u_id = {$id}";
					$resultProof = $this->db->query($sqlProof);
					if($resultProof->num_rows > 0){
						$rowProof = mysqli_fetch_array($resultProof);
						$thisProof = $rowProof['ud_proof_of_accepting_terms'];
						unlink('../'.$thisProof);
					}
                }
                /* END - fadhli */
                    //ud_rate_per_hour = '{$rate_per_hour}',
                    $sqlm = "UPDATE ".DB_PREFIX."_user_details SET 

                        ud_country      = '{$udcountry}',

                        ud_state        = '{$udstate}',

                        ud_city         = '{$udcity}',               

                        ud_first_name   = '{$firstname}',

                        ud_last_name    = '{$lastname}',

                        ud_dob          = '{$ud_dob}',

                        ud_phone_number = '{$phonenum}',

                        ud_address      = '{$address}',

                        ud_address2     = '{$address2}',

                        ud_postal_code  = '{$postalco}',

                        ud_company_name = '{$ud_company_name}',

                        ud_race         = '{$ud_race}',

                        ud_nationality  = '{$ud_nationality}',

                        ud_admin_comment = '{$ud_admin_comment}',

                        ud_marital_status = '{$ud_marital_status}',

                        ud_qualification = '{$ud_qualification}',

                        ud_client_status = '{$ud_client_status}',

                        ud_client_status_2 = '{$ud_client_status_2}',
                        
                        ud_rate_per_hour = '{$rate_per_hour}',

                        ud_tutor_experience = '{$ud_tutor_experience}',
                        
                        ud_tutor_experience_month = '{$experienceMonth}',

                        ud_about_yourself = '{$ud_about_yourself}',

                        ud_tutor_status = '{$ud_tutor_status}',

                        ud_current_occupation = '{$ud_current_occupation}',

                        ud_current_occupation_other = '{$ud_current_occupation_other}',
						
						student_disability = '{$student_disability}',
						
                        ud_workplace_state        = '{$ud_workplace_state}',

                        ud_workplace_city         = '{$ud_workplace_city}', 
						
                        conduct_class = '{$conduct_class}',
                        conduct_online = '{$conduct_online}',
						
						conduct_online_text = '{$conduct_online_text}',
						student_disability_text = '{$student_disability_text}',

                        ud_current_company = '{$ud_current_company}'";


                    if ($proof_profile_pic != '') {

                        $sqlm .= ", ud_proof_of_accepting_terms = '{$proof_profile_pic}'";

                    }

                    $sqlm .= " WHERE ud_u_id = {$id}";

                    $exe = $this->db->query($sqlm);
					
/* missing ac */
//$this->db->query("UPDATE ".DB_PREFIX."_user_details SET ud_admin_comment = '".$ud_admin_comment."' WHERE ud_u_id = $id");
/* missing ac */
if (filter_var($lastname, FILTER_VALIDATE_EMAIL)) {
	$this->db->query(" UPDATE ".DB_PREFIX."_job SET actual_email = '".$lastname."' WHERE j_email = '".$email."' ");
}

                    if($exe) {//exe

                        $res = $id;



                        if ($user_testimonial != '') {//testimonial

                            # DELETE PREVIOUS TESTIMONIAL DATA #

                            /*$this->db->query("DELETE FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '{$id}'");

                            foreach ($user_testimonial as $key => $testimonial) {

                                $testimonialSql = "INSERT INTO ".DB_PREFIX."_user_testimonial SET

                                ut_u_id        = '{$id}',

                                ut_file_path   = '{$testimonial}',

                                ut_create_date = '".date('Y-m-d H:i:s')."'";



                                if ($this->db->query($testimonialSql)){} else {

                                    $er++;

                                }

                            }*/

                            if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$id."'")->num_rows > 0){



                            if($user_testimonial['user_testimonial1'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti1 = $this->db->query($sqlTesti1);
									if($resultTesti1->num_rows > 0){
										$rowTesti1 = mysqli_fetch_array($resultTesti1);
										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
										unlink('../'.$thisTesti1);
									}
                                /* END - fadhli */

                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial2'] != '') {
								
                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti2 = $this->db->query($sqlTesti2);
									if($resultTesti2->num_rows > 0){
										$rowTesti2 = mysqli_fetch_array($resultTesti2);
										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
										unlink('../'.$thisTesti2);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial3'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti3 = $this->db->query($sqlTesti3);
									if($resultTesti3->num_rows > 0){
										$rowTesti3 = mysqli_fetch_array($resultTesti3);
										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
										unlink('../'.$thisTesti3);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial4'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti4 = $this->db->query($sqlTesti4);
									if($resultTesti4->num_rows > 0){
										$rowTesti4 = mysqli_fetch_array($resultTesti4);
										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
										unlink('../'.$thisTesti4);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $id");

                            }



                        }

                        else{

                            if($this->db->query("INSERT INTO ".DB_PREFIX."_user_testimonial(ut_u_id,ut_user_testimonial1,ut_user_testimonial2,ut_user_testimonial3,ut_user_testimonial4,ut_create_date) VALUES('".$id."','".$user_testimonial['user_testimonial1']."','".$user_testimonial['user_testimonial2']."','".$user_testimonial['user_testimonial3']."','".$user_testimonial['user_testimonial4']."','".date('Y-m-d H:i:s')."')")){}

                                else{

                                    $er++;

                                }



                          }

                        }//testimonial



                        Session::SetFlushMsg("success", 'Customer Updated Successfully.');


                    } else {    //exe                    

                        $res = false;

                        Session::SetFlushMsg("error", 'Database error: '. $this->db->error);

                    }
                        // $res = false;
                        //  Session::SetFlushMsg("success", 'Customer Updated Successfully2.');

                    // var_dump('takban dan tak duplicate phone number');die;
                //sini kena update semua

                    
                    } elseif ($phnbndqry->num_rows === 0 && $phnqry->num_rows > 0) {

                /* START fadhli - delete/remove/unlike image/picture in dir */
                if ($proof_profile_pic != '') {
					$sqlProof = "SELECT * FROM ".DB_PREFIX."_user_details WHERE ud_u_id = {$id}";
					$resultProof = $this->db->query($sqlProof);
					if($resultProof->num_rows > 0){
						$rowProof = mysqli_fetch_array($resultProof);
						$thisProof = $rowProof['ud_proof_of_accepting_terms'];
						unlink('../'.$thisProof);
					}
                }
                /* END - fadhli */
                        //ud_rate_per_hour = '{$rate_per_hour}',
                        $sqlm = "UPDATE ".DB_PREFIX."_user_details SET 

                        ud_country      = '{$udcountry}',

                        ud_state        = '{$udstate}',

                        ud_city         = '{$udcity}',               

                        ud_first_name   = '{$firstname}',

                        ud_last_name    = '{$lastname}',

                        ud_dob          = '{$ud_dob}',

                        ud_address      = '{$address}',

                        ud_address2     = '{$address2}',

                        ud_postal_code  = '{$postalco}',

                        ud_company_name = '{$ud_company_name}',

                        ud_race         = '{$ud_race}',

                        ud_nationality  = '{$ud_nationality}',

                        ud_admin_comment = '{$ud_admin_comment}',

                        ud_marital_status = '{$ud_marital_status}',

                        ud_qualification = '{$ud_qualification}',

                        ud_client_status = '{$ud_client_status}',

                        ud_client_status_2 = '{$ud_client_status_2}',
                        
                        ud_rate_per_hour = '{$rate_per_hour}',

                        ud_tutor_experience = '{$ud_tutor_experience}',
                        
                        ud_tutor_experience_month = '{$experienceMonth}',

                        ud_about_yourself = '{$ud_about_yourself}',

                        ud_tutor_status = '{$ud_tutor_status}',

                        ud_current_occupation = '{$ud_current_occupation}',

                        ud_current_occupation_other = '{$ud_current_occupation_other}',
						
						student_disability = '{$student_disability}',
						
                        ud_workplace_state        = '{$ud_workplace_state}',

                        ud_workplace_city         = '{$ud_workplace_city}', 
						
                        conduct_class = '{$conduct_class}',
                        conduct_online = '{$conduct_online}',
	
						conduct_online_text = '{$conduct_online_text}',
						student_disability_text = '{$student_disability_text}',

                        ud_current_company = '{$ud_current_company}'";
                  
                

                    if ($proof_profile_pic != '') {

                        $sqlm .= ", ud_proof_of_accepting_terms = '{$proof_profile_pic}'";

                    }

                    $sqlm .= " WHERE ud_u_id = {$id}";

                    $exe = $this->db->query($sqlm);
					
/* missing ac */
//$this->db->query("UPDATE ".DB_PREFIX."_user_details SET ud_admin_comment = '".$ud_admin_comment."' WHERE ud_u_id = $id");
/* missing ac */
if (filter_var($lastname, FILTER_VALIDATE_EMAIL)) {
	$this->db->query(" UPDATE ".DB_PREFIX."_job SET actual_email = '".$lastname."' WHERE j_email = '".$email."' ");
}
                    if($exe) {//exe

                        $res = $id;



                        if ($user_testimonial != '') {//testimonial

                            # DELETE PREVIOUS TESTIMONIAL DATA #

                            /*$this->db->query("DELETE FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '{$id}'");

                            foreach ($user_testimonial as $key => $testimonial) {

                                $testimonialSql = "INSERT INTO ".DB_PREFIX."_user_testimonial SET

                                ut_u_id        = '{$id}',

                                ut_file_path   = '{$testimonial}',

                                ut_create_date = '".date('Y-m-d H:i:s')."'";



                                if ($this->db->query($testimonialSql)){} else {

                                    $er++;

                                }

                            }*/

                            if($this->db->query("SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = '".$id."'")->num_rows > 0){



                            if($user_testimonial['user_testimonial1'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti1 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti1 = $this->db->query($sqlTesti1);
									if($resultTesti1->num_rows > 0){
										$rowTesti1 = mysqli_fetch_array($resultTesti1);
										$thisTesti1 = $rowTesti1['ut_user_testimonial1'];
										unlink('../'.$thisTesti1);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial1 = '".$user_testimonial['user_testimonial1']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial2'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti2 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti2 = $this->db->query($sqlTesti2);
									if($resultTesti2->num_rows > 0){
										$rowTesti2 = mysqli_fetch_array($resultTesti2);
										$thisTesti2 = $rowTesti2['ut_user_testimonial2'];
										unlink('../'.$thisTesti2);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial2 = '".$user_testimonial['user_testimonial2']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial3'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti3 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti3 = $this->db->query($sqlTesti3);
									if($resultTesti3->num_rows > 0){
										$rowTesti3 = mysqli_fetch_array($resultTesti3);
										$thisTesti3 = $rowTesti3['ut_user_testimonial3'];
										unlink('../'.$thisTesti3);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial3 = '".$user_testimonial['user_testimonial3']."' WHERE ut_u_id = $id");

                            }

                            if($user_testimonial['user_testimonial4'] != '') {

                                /* START fadhli - delete/remove/unlike image/picture in dir */
                                $sqlTesti4 = "SELECT * FROM ".DB_PREFIX."_user_testimonial WHERE ut_u_id = $id";
                                $resultTesti4 = $this->db->query($sqlTesti4);
									if($resultTesti4->num_rows > 0){
										$rowTesti4 = mysqli_fetch_array($resultTesti4);
										$thisTesti4 = $rowTesti4['ut_user_testimonial4'];
										unlink('../'.$thisTesti4);
									}
                                /* END - fadhli */
								
                                $this->db->query("UPDATE ".DB_PREFIX."_user_testimonial SET ut_user_testimonial4 = '".$user_testimonial['user_testimonial4']."' WHERE ut_u_id = $id");

                            }



                        }

                        else{

                            if($this->db->query("INSERT INTO ".DB_PREFIX."_user_testimonial(ut_u_id,ut_user_testimonial1,ut_user_testimonial2,ut_user_testimonial3,ut_user_testimonial4,ut_create_date) VALUES('".$id."','".$user_testimonial['user_testimonial1']."','".$user_testimonial['user_testimonial2']."','".$user_testimonial['user_testimonial3']."','".$user_testimonial['user_testimonial4']."','".date('Y-m-d H:i:s')."')")){}

                                else{

                                    $er++;

                                }



                          }

                        }//testimonial



                         Session::SetFlushMsg("error", 'Customer Updated Successfully but Phone number already exists and cannot be updated.');


                    } else {    //exe                    

                        $res = false;

                        Session::SetFlushMsg("error", 'Database error: '. $this->db->error);

                    }

                        // $res = false;
                        //  Session::SetFlushMsg("error", 'Customer Updated Successfully but Phone number already exists and cannot be updated.');
                    // Session::SetFlushMsg("error", 'Phone number has been used previously.');

                    } else {// phnbndqry kalau phone number kena banned

                    $res = false;
                    Session::SetFlushMsg("error", 'Phone number has been banned.');

                } 

                }else { //exeupdate

                    $res = false;

                    Session::SetFlushMsg("error", 'Database error: '. $this->db->error);

                }

            

            } else {//qry
            
                    $_SESSION['tempLast'] = $data['ud_last_name'];
                    $_SESSION['tempPass'] = $data['u_password'];
                    $_SESSION['tempEmail'] = $data['u_email'];  
                        $_SESSION['tempAlias'] = $data['emailalias'];
                    $_SESSION['tempFirst'] = $data['ud_first_name'];
                    $_SESSION['tempGender'] = $data['u_gender'];
                    $_SESSION['tempDOB'] = $data['ud_dob'];
                    $_SESSION['tempPhone'] = $data['ud_phone_number'];
                    $_SESSION['tempRace'] = $data['ud_race'];
                    $_SESSION['tempNat'] = $data['ud_nationality'];
                    $_SESSION['tempAddress'] = $data['ud_address'];
                    $_SESSION['tempState'] = $data['ud_state']; 
                        $_SESSION['tempCity'] = $data['ud_city'];
                    $_SESSION['tempStatus2'] = $data['ud_client_status_2'];
                    $_SESSION['tempStatus'] = $data['u_status'];
                    $_SESSION['tempPay'] = $data['u_paying_client'];
                    $_SESSION['tempComm'] = $data['ud_admin_comment'];
                
                Session::SetFlushMsg("error", 'Username / Email already exists in our record.');

                $res = false;

            }

        }



        if (isset($data['cover_area_state']) && count($data['cover_area_state']) > 0) {
            
            # DELETE PREVIOUS DATA #
            $this->db->query("DELETE FROM ".DB_PREFIX."_tutor_area_cover WHERE tac_u_id = '{$user_id}'");
          
            foreach ($data['cover_area_state'] as $cid) {
                    // print_r($cid.",");
                if ($data['cover_area_city_'.$cid]) {
                    // print_r($data['cover_area_city_'.$cid]);

                    if(count($data['cover_area_city_'.$cid] > 0)){
                    
                      
                        foreach ($data['cover_area_city_'.$cid] as $key => $pid) {
                        
                            
                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_area_cover SET

                          tac_u_id    = '{$user_id}',

                         tac_st_id   = '{$cid}',

                         tac_city_id = '{$pid}'";
                         // pid 11 alam impian
                         // cid 1046 selangor
                         //user_id 7453 luqman

                        if ($this->db->query($allotSql)){} else {

                            $er++;

                        }

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
            // die;
         
        }



        if (isset($data['tutor_course']) && count($data['tutor_course']) > 0) {


            $this->db->query("DELETE FROM ".DB_PREFIX."_tutor_subject WHERE trs_u_id = '{$user_id}'");

            foreach ($data['tutor_course'] as $cid) {


                if (isset($data['tutor_subject_'.$cid]) && count($data['tutor_subject_'.$cid]) > 0) {
                    
                    foreach ($data['tutor_subject_'.$cid] as $key => $pid) {
                    
                       
                        $allotSql = "INSERT INTO ".DB_PREFIX."_tutor_subject SET

                         trs_u_id  = '{$user_id}',

                         trs_tc_id = '{$cid}',

                         trs_ts_id = '{$pid}'";

                         //cid 57 course
                         //pid 1045 subject



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
          // die;
        }



        return $res;

    }

    
// luqman
    function ApproveUser($u_id) {



        $userData = $this->GetAllUser('', $u_id);

        $userRow = $userData->fetch_array(MYSQLI_ASSOC);



        //$sql = "UPDATE ".DB_PREFIX."_user SET u_admin_approve = '1' WHERE u_id = '{$u_id}'"; 
        $sqlApprove = "UPDATE ".DB_PREFIX."_user SET u_admin_approve='1' WHERE u_id = '".$u_id."'"; 		
        $result =  $this->db->query($sqlApprove);

        if ($result) {

                                $to      = $userRow['u_email'];
                    
                                $emailSubject = 'TutorKami - Approval Email';
                                $message = '<html><head>

                                <title>'.$emailSubject.'</title>

                                </head>

                                <body>';

                                $message .= '<img src="' . APP_ROOT . 'admin/upload/logo.png" style="max-width: 250px" /><br>';

                                $message .= '<h1><center>Hello ' . $userRow['u_displayname'] . ',</center></h1>';

                                $message .= '<p><center>This is an email from TutorKami.com. You have recently registered yourself as a tutor.</center></p>';

                                $message .= '<p><center>To activate your account please double click the link below:</center></p>';

                                $message .= '<p><center><a href="' . APP_ROOT . 'activation.php?email='.$userRow['u_email'].'">' . APP_ROOT . 'activation.php?email='.$userRow['u_email'].'</a></center></p>';

                                $message .= '<p><center> Please add us as your friend on Facebook at this <a href="https://www.facebook.com/HambalTutorKami">link</a>, like our <a href="https://www.facebook.com/TutorKami.comHomeTuition/">FB page</a> or follow our IG <a href="https://www.instagram.com/tutorkami/">instagram.com/tutorkami</a> as we will update latest news and home tuition jobs over there.  </center></p>';

                                $message .= '<p><center>Thank you.<br>Admin,<br>www.tutorkami.com</center></p>';
								
                                $message .= "</body></html>";

                                /*$headers = 'From: Tutorkami <hello@tutorkami.com>' . "\r\n" .
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
								

                                //mail($to, $emailSubject, $message, $headers);
								/* START fadhli - check email send/not */
								$sendEmail = mail($to, $emailSubject, $message, $headers, '-fhello@tutorkami.com');
								if(!$sendEmail) {   
									$manualSend = "UPDATE ".DB_PREFIX."_user SET u_admin_approve='10' WHERE u_id = '".$u_id."'"; 		
									$resultManualSend =  $this->db->query($manualSend);
								}
								/* END fadhli - check email send/not */
                                // $send = $this->handler->mailGunEmail('Admin', $adminEmail, $emailSubject, $emailBody);
            
                            
        }
            // header('Location: manage_user?action=edit&u_id=' . $userRow['u_displayid']);
            header('Location: manage_user?action=edit&u_id=' . $userRow['u_displayid']);
            Session::SetFlushMsg("success", 'Tutor has been approved.');
            exit();

        

    }
// luqman
/* START fadhli - Manual Activated*/
function ManualActivated($u_id) {
	$userData = $this->GetAllUser('', $u_id);
	$userRow = $userData->fetch_array(MYSQLI_ASSOC);
 
	$sqlApprove = "UPDATE ".DB_PREFIX."_user SET u_status = 'A', u_admin_approve='2' WHERE u_id = '".$u_id."'"; 		
	$result =  $this->db->query($sqlApprove);

	header('Location: manage_user?action=edit&u_id=' . $userRow['u_displayid']);
	Session::SetFlushMsg("success", 'Tutor has been Activated.');
	exit();
}
function manualActive($u_id) {
	$userData = $this->GetAllUser('', $u_id);
	$userRow = $userData->fetch_array(MYSQLI_ASSOC);
 
	$sqlApprove = "UPDATE ".DB_PREFIX."_user SET u_status = 'A', u_admin_approve='2' WHERE u_id = '".$u_id."'"; 		
	$result =  $this->db->query($sqlApprove);

	header('Location: manage_user?action=edit&u_id=' . $userRow['u_displayid']);
	Session::SetFlushMsg("success", 'Tutor has been Activated.');
	exit();
}
/* END fadhli */
    

    function DeleteUser($u_id) {

        if ($u_id == 1) {

            Session::SetFlushMsg("error", 'You don\'t have permission to delete this user.');

            return false;

        } else {
            
/* START - fadhli - DELETE USER LOG 25/10/2019*/
$sqlUserRecord = " SELECT * FROM ".DB_PREFIX."_user WHERE u_id = '{$u_id}' ";
$resultUserRecord = $this->db->query($sqlUserRecord);
if($resultUserRecord->num_rows > 0){
	$rowUserRecord = mysqli_fetch_array($resultUserRecord);
	
	$displayId = 'Display ID : '.$rowUserRecord['u_displayid'];
	$email = 'Email : '.$rowUserRecord['u_email'];
	$action = '<br>'.$displayId.'<br>'.$email;
	
$run = $this->db->query(" INSERT INTO ".DB_PREFIX."_user_log SET user = '".$_SESSION[DB_PREFIX]['u_id']."', date = '".date('Y-m-d')."', time = '".date('H:i:s')."', action = 'DELETE USER : ".$action."' ");
}
/* END - fadhli - DELETE USER LOG*/

            $res = $this->db->query("DELETE FROM ".DB_PREFIX."_user_details WHERE ud_u_id = '".$u_id."'");

            if ($res) {

                Session::SetFlushMsg("success", 'User deleted successfully.');

                return $this->db->query("DELETE FROM ".DB_PREFIX."_user WHERE u_id = '".$u_id."'");

            }           

        }

    }

    public function deletePricing($data) {
        if (isset($data['lr_id']) && $data['lr_id'] > 0) {
            $res = $this->db->query("DELETE FROM ".DB_PREFIX."_location_rate WHERE lr_id = '".$data['lr_id']."'");

            //$sql = "DELETE FROM ".DB_PREFIX."_location_rate WHERE lr_id = '".$data['lr_id']."'";
            Session::SetFlushMsg("success", 'Pricing deleted successfully.');
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

        0 =>    Failure

        1 =>    Success

        2 =>    Old Password Mismatch

        3 =>    Confirm Password Mismatch

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

        $sql .= "ORDER BY LR.lr_create_date DESC";
        // luqman comment sbb superuser je tnjuk data baru, admin xda page admin/locationrate
        // if($_SESSION[DB_PREFIX]['r_id']!=1){

        //     $sql .= " AND lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."'";

        // }
        //luqman



        return $this->db->query($sql);

    }



    public function SaveLocationRate($data) {



        if (isset($data['lr_id']) && $data['lr_id'] > 0) {

// luqman

            $sql = "UPDATE ".DB_PREFIX."_location_rate SET 

                lr_jl_id = '".$data['lr_jl_id']."', 

                lr_c_id = '".$data['lr_c_id']."', 

                lr_st_id = '".$data['lr_st_id']."', 

                lr_city_id = '".$data['lr_city_id']."', 

                lr_rate = '".$data['lr_rate']."',

                lr_parent_rate = '".$data['lr_parent_rate']."', 

                lr_status = 'A', 

                lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."',

                lr_create_date = '".date('Y-m-d H:i:s')."' 

            WHERE lr_id = '".$data['lr_id']."'";

            Session::SetFlushMsg("success", 'Pricing Updated Successfully.');

        } else {



            $sql = "INSERT INTO ".DB_PREFIX."_location_rate SET 

                lr_jl_id = '".$data['lr_jl_id']."', 

                lr_c_id = '".$data['lr_c_id']."', 

                lr_st_id = '".$data['lr_st_id']."', 

                lr_city_id = '".$data['lr_city_id']."', 

                lr_rate = '".$data['lr_rate']."',

                lr_parent_rate = '".$data['lr_parent_rate']."', 

                lr_status = 'A', 

                lr_country_id = '".$_SESSION[DB_PREFIX]['u_country_id']."',

                lr_create_date = '".date('Y-m-d H:i:s')."'";

                Session::SetFlushMsg("success", 'Pricing Added Successfully.');

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

    
    public function fd_getAllTutor() {
		$sql = "SELECT * FROM ".DB_PREFIX."_user LEFT JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id 

		WHERE u_role='3' AND u_status='A' ORDER BY u_displayname DESC";
		return $this->db->query($sql);
	}
	//		LEFT JOIN tk_tutor_subject ON tk_user.u_id = tk_tutor_subject.trs_u_id 


    function allUserInfo($u_id) {
        return $this->db->query("SELECT * FROM ".DB_PREFIX."_user LEFT JOIN ".DB_PREFIX."_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_id = '".$u_id."'")->fetch_assoc();
    }
	
	
	
}

?>