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


    public function SearchTutorFE($data){

        $gender             = isset($data['u_gender'])                  ? $data['u_gender'] : '';               
        $ud_race            = isset($data['ud_race'])                   ? $data['ud_race'] : '';               
        $ud_tutor_status    = isset($data['ud_tutor_status'])           ? $data['ud_tutor_status'] : '';        
        $current_occupation = isset($data['ud_current_occupation'])     ? $data['ud_current_occupation'] : '';  
        $tution_center      = isset($data['tution_center'])             ? $data['tution_center']    : '';       

        $areas              = isset($data['state_drop'])                ? $data['state_drop'] : '';                   
        $course             = isset($data['level_drop'])                ? $data['level_drop'] : '';              
        $subject            = isset($data['subject'])                   ? $data['subject'] : '';                
        $location           = isset($data['location'])                  ? $data['location'] : '';
        $subject_check      = isset($data['subject_check'])             ? $data['subject_check'] : '';   
        $city_check         = isset($data['city_check'])                ? $data['city_check'] : '';   
        
        $conductOnline      = isset($data['conductOnline'])             ? $data['conductOnline'] : '';   
        

        $sql = "SELECT U.*, AVG(".DB_PREFIX."_review_rating.rr_rating) as average_rating, UD.*";

        $sql.="FROM ".DB_PREFIX."_user AS U 
            INNER JOIN ".DB_PREFIX."_user_details    AS UD  ON UD.ud_u_id   = U.u_id 
            LEFT JOIN ".DB_PREFIX."_review_rating ON rr_tutor_id = U.u_id";

        if ($areas != '' || $city_check != '') {
            $sql .= "
                INNER JOIN ".DB_PREFIX."_tutor_area_cover AS TAC ON TAC.tac_u_id = U.u_id 
                LEFT JOIN  ".DB_PREFIX."_cities CT ON CT.city_id   = UD.ud_city AND TAC.tac_city_id = CT.city_id  
                LEFT JOIN ".DB_PREFIX."_states AS ST ON TAC.tac_st_id = ST.st_id
                LEFT JOIN ".DB_PREFIX."_countries AS C ON ST.st_c_id = C.c_id AND CT.city_c_id = C.c_id
            ";
        }

        if ($course != '' && $subject_check != '') {
            $sql .= " 
            INNER JOIN ".DB_PREFIX."_tutor_subject AS TRS ON TRS.trs_u_id = U.u_id 
            LEFT JOIN ".DB_PREFIX."_tution_course   AS TC  ON TC.tc_id     = TRS.trs_tc_id
            LEFT JOIN ".DB_PREFIX."_tution_subject   AS TS  ON TS.ts_id     = TRS.trs_ts_id";
        }
   
        $sql .= " WHERE U.u_status = 'A' AND U.u_role = '3'";


        if ($areas != '' || $city_check != '') {
            $sql .= "AND TAC.tac_st_id = '".$areas."' AND TAC.tac_city_id IN(".implode(',',$city_check).") ";
        }

        if ($course != '' || $subject_check != '') {
            $sql .= "AND TRS.trs_tc_id = '".$course."' AND TRS.trs_ts_id IN(".implode(',',$subject_check).") ";
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
    

        if ($gender != '') {
            $sql .= " AND U.u_gender = '".$gender."'";
        }
        
        if ($conductOnline != '') {
            $sql .= " AND UD.conduct_online = '".$conductOnline."'";
        }
    
        if ($ud_race != '') {
            $sql .= " AND UD.ud_race = '".$ud_race."'";
        }

        if ($current_occupation != '') {
            $sql .= " AND UD.ud_current_occupation = '".$current_occupation."' OR (UD.ud_current_occupation LIKE '".$current_occupation."%' OR UD.ud_current_occupation = 'Lacturer' OR UD.ud_current_occupation = 'Lecture' OR UD.ud_current_occupation = 'Lecturer')";
        }

        if ($ud_tutor_status != '') {
            $sql .= "  AND UD.ud_tutor_status = '".$ud_tutor_status."'";
        }

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
            while($row = mysqli_fetch_array($result)){

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

        }else{
            echo json_encode(["message"=>'Tiada Maklumat!']);
        }
    }
	
	
    
    




}
?>