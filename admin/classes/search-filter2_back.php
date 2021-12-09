<?php
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

    

    public function isTutor($data){

        $search_tutor           = isset($data['is_tutor'])                  ? $data['is_tutor'] : '';
        $search_email           = isset($data['u_email'])                   ?  $this->RealEscape($data['u_email']) : ''; //email
        $userimage              = isset($data['data_pic'])                 ?  $this->RealEscape($data['data_pic']) : ''; //email
        $search_first_name      = isset($data['ud_first_name'])             ?  $this->RealEscape($data['ud_first_name']) : ''; //firstname
        $search_last_name       = isset($data['ud_last_name'])              ?  $this->RealEscape($data['ud_last_name']) : ''; //lastname
        $search_display_name    = isset($data['u_displayname'])             ?  $this->RealEscape($data['u_displayname']) : ''; //displayname
        $search_phone_number    = isset($data['ud_phone_number'])           ?  $this->RealEscape($data['ud_phone_number']) : '';//phonenumber


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
            
            
            $validated    = isset($data['validatedaa'])           ? $data['validatedaa'] : ''; 
            $experience    = isset($data['experience'])           ? $data['experience'] : ''; 

            $client_status  = isset($data['ud_client_status'])  ? $data['ud_client_status'] : '';                   //ada
			$user_status  = isset($data['user_status'])  ? $data['user_status'] : '';

            $messagecheckbox  = isset($data['messagecheckbox'])   ? $data['messagecheckbox'] : '';                    //XDAPAT VALUE LAGI
            
            $searchConductOnline = isset($data['searchConductOnline']) ? $data['searchConductOnline'] : ''; 
            $searchConductClass  = isset($data['searchConductClass'])  ? $data['searchConductClass'] : ''; 
            

            
            $search_ud_state    = isset($data['search_ud_state'])   ? $data['search_ud_state'] : ''; 
            $search_ud_city     = isset($data['search_ud_city'])    ? $data['search_ud_city'] : ''; 
            $ud_workplace_state  = isset($data['ud_workplace_state'])  ? $data['ud_workplace_state'] : '';
            $ud_workplace_city  = isset($data['ud_workplace_city'])  ? $data['ud_workplace_city'] : '';   
            $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';   //ada nombor city
            $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';   //ada nombor subject
            $level_taught  = isset($data['level_taught'])  ? $data['level_taught'] : ''; 



if ($validated != '') {
    if ($validated == 'paid') {
/*
        $sql ="
        
SELECT tk_job.j_hired_tutor_email, tk_job.j_id, 

tk_user.u_id, tk_user.u_email, tk_user.u_role, tk_user.u_create_date, tk_user.u_modified_date, tk_user.u_displayid, tk_user.u_displayname, tk_user.u_admin_approve, tk_user.u_status,

tk_user_details.ud_u_id, tk_user_details.ud_first_name, tk_user_details.ud_dob, tk_user_details.ud_city, tk_user_details.ud_phone_number, tk_user_details.ud_rate_per_hour

FROM tk_user LEFT OUTER JOIN tk_job ON tk_job.j_hired_tutor_email = tk_user.u_email

LEFT JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id  
        
        ";*/
        $sql ="
        SELECT  *
        FROM    tk_user
        INNER JOIN tk_user_details ON tk_user_details.ud_u_id   = tk_user.u_id 

        
        
        ";
    }
    if($validated == 'unpaid'){

        
        $sql ="
        SELECT  *
        FROM    tk_user
        INNER JOIN tk_user_details ON tk_user_details.ud_u_id   = tk_user.u_id ";
        
//GROUP BY tk_job.j_hired_tutor_email        
//WHERE  j_hired_tutor_email NOT IN (SELECT j_hired_tutor_email FROM tk_job)         
        
        
        
    }
    if($validated == 'none'){

        $sql ="
        SELECT  *
        FROM    tk_user
        INNER JOIN tk_user_details ON tk_user_details.ud_u_id   = tk_user.u_id ";
    }

}else{
        $sql ="SELECT * FROM tk_user 
        INNER JOIN tk_user_details ON tk_user_details.ud_u_id   = tk_user.u_id ";
}







/*
if ($level_taught != '') {
     // areas select state
    if ($areas != '' || $city_check != '') {
                
                $sql .= "
                         INNER JOIN tk_tutor_area_cover  ON tk_tutor_area_cover.tac_u_id = tk_user.u_id 
                         LEFT JOIN  tk_cities ON tk_cities.city_id   = tk_user_details.ud_city AND tk_tutor_area_cover.tac_city_id = tk_cities.city_id  
                         LEFT JOIN tk_states  ON tk_tutor_area_cover.tac_st_id = tk_states.st_id
                         LEFT JOIN tk_countries ON tk_states.st_c_id = tk_countries.c_id AND tk_cities.city_c_id = tk_countries.c_id ";
    
    }

            
                $sql .= " 
                INNER JOIN tk_tutor_subject ON tk_tutor_subject.trs_u_id = tk_user.u_id 
                LEFT JOIN tk_tution_course ON tk_tution_course.tc_id     = tk_tutor_subject.trs_tc_id";

}else{
     // areas select state
    if ($areas != '' || $city_check != '') {
                
                $sql .= "
                         INNER JOIN tk_tutor_area_cover  ON tk_tutor_area_cover.tac_u_id = tk_user.u_id 
                         LEFT JOIN  tk_cities ON tk_cities.city_id   = tk_user_details.ud_city AND tk_tutor_area_cover.tac_city_id = tk_cities.city_id  
                         LEFT JOIN tk_states  ON tk_tutor_area_cover.tac_st_id = tk_states.st_id
                         LEFT JOIN tk_countries ON tk_states.st_c_id = tk_countries.c_id AND tk_cities.city_c_id = tk_countries.c_id ";
    
    }
    if ($course != '' || $subject_check != '') {
            
                $sql .= " 
                INNER JOIN tk_tutor_subject ON tk_tutor_subject.trs_u_id = tk_user.u_id 
                LEFT JOIN tk_tution_course ON tk_tution_course.tc_id     = tk_tutor_subject.trs_tc_id
                LEFT JOIN tk_tution_subject ON tk_tution_subject.ts_id     = tk_tutor_subject.trs_ts_id";
    }    
}
*/


if ( $level_taught != '' || $subject_check != '' ) {
    $sql .= " INNER JOIN tk_tutor_subject ON trs_u_id = u_id  ";
}

if ( $level_taught != '' || $subject_check != '' ) {
    if ($level_taught != '') {
        $sql .= "AND trs_tc_id = '".$level_taught."' ";
    }
    if ($subject_check != '') {
        $sql .= "AND trs_ts_id IN(".implode(',',$subject_check).") ";
    }
}
      
if ( $city_check != '' ) {
	$sql .= " INNER JOIN tk_tutor_area_cover ON tac_u_id = u_id ";
        
        
}
if ( $city_check != '' ) {
	$sql .= "AND tac_city_id IN(".implode(',',$city_check).") ";
}




if ($validated != '') {
    if ($validated == 'paid') {
        //$sql .= " WHERE u_role = '3' AND j_payment_status = 'paid' ";
        $sql .= " WHERE u_role = '3' AND u_email IN (SELECT j_hired_tutor_email FROM tk_job WHERE j_payment_status = 'paid') ";
    }
    if ($validated == 'unpaid') {
        $sql .= " WHERE u_role = '3' AND u_email IN ( (SELECT j_hired_tutor_email FROM tk_job WHERE j_payment_status = 'pending' AND j_hired_tutor_email  NOT IN  (SELECT j_hired_tutor_email FROM tk_job WHERE j_payment_status = 'paid'))  )";
    }
    if ($validated == 'none') {
        $sql .= "  WHERE u_role = '3' AND u_email NOT IN (SELECT j_hired_tutor_email FROM tk_job) ";
    }

}else{
    $sql .= "  WHERE u_role = '3' ";
}

        if ($search_ud_state != '') {
            $sql .= " AND ud_state = '".$search_ud_state."'";
        }
        if ($search_ud_city != '') {
            $sql .= " AND ud_city = '".$search_ud_city."'";
        }
 
            



        
        if ($u_admin_approve != '') {

            $sql .= " AND u_status = '".$u_admin_approve."'";
            

        }else{
            $sql .= " AND u_status <> 'D'";
        }



/*
if ($level_taught != '') {
        if ($areas != '') {
            $sql .= "AND tac_st_id = '".$areas."' ";
        }
        if ($city_check != '') {
            $sql .= "AND tac_city_id IN(".implode(',',$city_check).") ";
        }
        
        $sql .= "AND trs_tc_id = '".$level_taught."' ";
        $sql .= "GROUP BY u_username ";        
    
}else{
        if ($areas != '') {
            $sql .= "AND tac_st_id = '".$areas."' ";
        }
        if ($city_check != '') {
            $sql .= "AND tac_city_id IN(".implode(',',$city_check).") ";
        }
        
        if ($course != '') {
            $sql .= "AND trs_tc_id = '".$course."' ";
        }
        if ($subject_check != '') {
            $sql .= "AND trs_ts_id IN(".implode(',',$subject_check).") ";
        }  
                if ($areas != '' || $city_check != '' || $course != '' || $subject_check != '') {
                    $countcity = count($city_check);
                    $countsubject = count($subject_check);
                    $sql .= "GROUP BY u_username ";        
                }

        if ($areas != NULL && $city_check != NULL && $course == NULL && $subject_check == NULL) {
            $sql .= "HAVING COUNT(distinct tac_city_id) = '".$countcity."'";
        }elseif ($course != NULL && $subject_check != NULL && $areas == NULL && $city_check == NULL) {
            $sql .= "HAVING COUNT(distinct trs_ts_id) = '".$countsubject."'";
        }elseif ($areas != NULL && $city_check != NULL && $course != NULL && $subject_check != NULL) {
            $sql .= "HAVING COUNT(distinct tac_city_id) = '".$countcity."' AND COUNT(distinct trs_ts_id) = '".$countsubject."' ";
        } 
}
*/




        

// SEARCH TAKLEH COMBINE NI

     // SEARCH EMAIL

        if ($search_email != '') {

            //$sql .= " AND U.u_email = '".$search_email."'";
			$sql .= " AND u_email = '".$search_email."' OR ud_last_name = '".$search_email."' ";
        
        }
        
        if ($userimage != '') {
			if($userimage == 'All'){
				//$sql .= " AND U.u_profile_pic != '' OR U.u_profile_pic = '' ";
			}else if ($userimage == 'Yes') {
                $sql .= " AND u_profile_pic != '' ";
            } elseif ($userimage == 'No') {
                $sql .= " AND u_profile_pic = '' ";

            }

        }
		
       // SEARCH FIRST NAME

        if ($search_first_name != '') {

            $sql .= " AND ud_first_name LIKE '%".$search_first_name."%'";
            
        }

                 // SEARCH LAST NAME

        if ($search_last_name != '') {

            $sql .= " AND ud_last_name LIKE '%".$search_last_name."%'";

        }



        // SEARCH DISPLAY

        if ($search_display_name != '') {

            $sql .= " AND u_displayname LIKE '%".$search_display_name."%'";

        }

      // SEARCH PHONE NUMBER

        if ($search_phone_number != '') {

            $sql .= " AND ud_phone_number = '".$search_phone_number."'";

        }

    // GENDER

        if ($gender != '') {

            $sql .= " AND u_gender = '".$gender."'";

        }
        


        // RACE

        if ($ud_race != '') {

            $sql .= " AND ud_race = '".$ud_race."'";

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

            $sql .= "  AND ud_tutor_status = '".$ud_tutor_status."'";

        }

        // CLIENT STATUS

        if ($client_status != '') {

			$sql .= "  AND ud_client_status_2 = '".$client_status."'";

        }

               // WILL TEACH AT TUITION CENTER

        if ($tution_center != '') {

            if ($tution_center == '1') {

                $sql .= " AND ud_client_status = 'Tuition Centre'";

            } elseif ($tution_center == '0') {

                $sql .= " AND ud_client_status != 'Tuition Centre'";

            }

        }

        if ($user_status != '') {
            if ($user_status == 'active') {
                $sql .= " AND u_status = 'A'";
            } else {
                $sql .= " AND u_status = 'B'";
            }
        }


        if ($messagecheckbox != '') {
            $sql .= " AND u_paying_client = '".$messagecheckbox."'";
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
            $sql .= " AND ud_workplace_state = '".$ud_workplace_state."'";
        }
        if ($ud_workplace_city != '') {
            $sql .= " AND ud_workplace_city = '".$ud_workplace_city."'";
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

if ( $level_taught != '' || $subject_check != '' || $city_check != '' ) {
    $sql .= "GROUP BY u_username ";  
}


        $result =  $this->db->query($sql);




     $tutor_arr = array();
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

		
        if($row['ud_dob'] == NULL){
            $ud_dob = 0;
        }else{
        $ud_dob = system::CalculateAge($row['ud_dob']);
        }

        
        if (is_numeric($row['ud_city'])) {

			$citysqltest = "SELECT * FROM tk_cities WHERE city_id = '{$row['ud_city']}'";
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

        switch($row['u_role']) {
          case 2: $urole = "Admin"; break;
          case 3: $urole = "Tutor"; break;
          case 4: $urole = "Client"; break;
        }
          $u_role = $urole; 
		  
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
        

        $sqlJob =" SELECT * FROM tk_applied_job WHERE aj_u_id='".$row['u_id']."' AND (aj_rate IS NOT NULL AND aj_rate!='') ORDER BY aj_level ASC ";
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

        


      $tutor_arr[] = array("u_id" => $u_id,"ori_u_create_date" => $ori_u_create_date,"ori_u_modified_date" => $ori_u_modified_date,"u_displayid" => $u_displayid,"u_email" => $u_email,"ud_first_name" => $ud_first_name,"u_displayname" => $u_displayname,"u_status" => $u_status,"ud_dob" => $ud_dob,"ud_city" => $ud_city,"ud_phone_number" => $ud_phone_number,"u_role" => $u_role,"u_create_date" => $u_create_date,"u_modified_date" => $u_modified_date,"ud_rate_per_hour" => $ud_rate_per_hour);  

 
   }
    echo json_encode($tutor_arr);

}else{
    echo json_encode(["message"=>'Tiada Maklumat!']);
}
}

	
}

?>