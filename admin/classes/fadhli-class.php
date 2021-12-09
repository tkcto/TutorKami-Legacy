<?php



/*************************************************

# Page Name     : fadhli-class.php 
# Page Author   : fadhli
# Created On    : 18/12/2018

*************************************************/



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

    

    public function SearchTutorPage($data){

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
            

        //$sql = "SELECT U.*, AVG(".DB_PREFIX."_review_rating.rr_rating) as average_rating, UD.*";

        $sql ="SELECT * FROM ".DB_PREFIX."_user INNER JOIN ".DB_PREFIX."_user_details ON ud_u_id = u_id LEFT JOIN ".DB_PREFIX."_review_rating ON rr_tutor_id = u_id";

          
		//areas select state 
        if ($areas != '' || $city_check != '') {
            $sql .= "INNER JOIN ".DB_PREFIX."_tutor_area_cover ON tac_u_id = u_id LEFT JOIN ".DB_PREFIX."_cities ON city_id = ud_city AND tac_city_id = city_id LEFT JOIN ".DB_PREFIX."_states ON tac_st_id = st_id LEFT JOIN ".DB_PREFIX."_countries ON st_c_id = c_id AND city_c_id = c_id";
        }

        //subject
        if ($course != '' && $subject_check != '') {
        
            $sql .= "INNER JOIN ".DB_PREFIX."_tutor_subject ON trs_u_id = u_id LEFT JOIN ".DB_PREFIX."_tution_course ON tc_id = trs_tc_id LEFT JOIN ".DB_PREFIX."_tution_subject ON ts_id = trs_ts_id";
        }
       
        $sql .= " WHERE U.u_status <> 'D' AND U.u_role = '3'";

        // SEARCH XLEH COMBINE NI
        if ($areas != '' || $city_check != '') {
            $sql .= "AND tac_st_id = '".$areas."' AND tac_city_id IN(".implode(',',$city_check).")";
        }

        if ($course != '' || $subject_check != '') {
            $sql .= "AND trs_tc_id = '".$course."' AND trs_ts_id IN(".implode(',',$subject_check).")";
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
            $sql .= " AND ud_current_occupation = '".$current_occupation."'";
        }

        // TUTOR STATUS
        if ($ud_tutor_status != '') {
            $sql .= "  AND ud_tutor_status = '".$ud_tutor_status."'";
        }

        // WILL TEACH AT TUITION CENTER
        if ($tution_center != '') {
            if ($tution_center == '1') {
                $sql .= " AND ud_client_status = 'Tuition Centre'";
            } elseif ($tution_center == '0') {
                $sql .= " AND ud_client_status != 'Tuition Centre'";
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
				$ud_city = $row['ud_city'];
				$u_gender = $row['u_gender'];
				$ud_qualification = $row['ud_qualification'];
           
				$tutor_arr[] = array("u_id" => $u_id,"u_displayid" => $u_displayid, "u_gender" => $u_gender, "u_displayname" => $u_displayname,"u_status" => $u_status,"ud_dob" => $ud_dob, "rr_rating" => $rr_rating, "ud_city" => $ud_city,"ud_qualification" => $ud_qualification);  
			}
			echo json_encode($tutor_arr);
        }else{
			echo json_encode(["message"=>'Tiada Maklumat!']);
        }
    }
	
	
}

?>