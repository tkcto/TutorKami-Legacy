<?php 
require_once('includes/head.php');

if (isset($_POST['action'])) {
	if ($_POST['action'] == 'get_cities') {
		$state_id = $_POST['state_id'];
		$ct_id = isset($_POST['city_id']) ? $_POST['city_id'] : '';
		$selected = '';
		if ($state_id != '') {
			$i = 0;
			$getStateWiseCity = system::FireCurl(LIST_CITY_URL.'?state_id='.$state_id);
		//	print_r($getStateWiseCity);
		//	die();
			if ($getStateWiseCity->flag == 'success' && count($getStateWiseCity->data) > 0) {
				foreach ($getStateWiseCity->data as $key => $city) {
					$selected = ($ct_id != '' && $ct_id == $city->city_id) ? 'checked="checked"' : '';

					echo '<div class="col-md-6">
	                    <input name="cover_area_city_'. $state_id.'['. $i .']" class="city_check" id="city_check_'.$city->city_id.'" value="'.$city->city_id.'" type="checkbox" '.$selected.' data-cname="cover_area_city_" data-pname="ca_state_">
	                  <label for="city_check_'.$city->city_id.'">'.$city->city_name.'</label> 
	                </div>';

	                $i++;
				}
			}
		}			
	}
	
	if ($_POST['action'] == 'get_subjects') {
		$level_id = $_POST['level_id'];
		$sub_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
		if ($level_id != '') {
			$i = 0;
			$getSubject = system::FireCurl(LIST_SUBJECT_URL.'?course_id='.$level_id);
			if ($getSubject->flag == 'success' && count($getSubject->data) > 0) {
				foreach ($getSubject->data as $key => $subject) {
					$selected = ($sub_id != '' && $sub_id == $subject->ts_id) ? 'checked="checked"' : '';

					echo '<div class="col-md-6">
	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$subject->ts_id.'" value="'.$subject->ts_id.'" type="checkbox" '.$selected.' data-cname="tutor_subject_" data-pname="ca_state_">
	                    <label for="subject_check'.$subject->ts_id.'">'.$subject->ts_title.'</label>
	                </div>';

	                $i++;
				}
			}
		}			
	}
	
	if ($_POST['action'] == 'update_class_guide') {
		$status = $_POST['status'];

		if ($status != '') {
			$udateStatus = system::FireCurl(UPDATE_CLASS_GUIDE_URL.'?user_id='.$_SESSION['auth']['user_id'].'&status='.$status);
		}			
	}

	if ($_POST['action'] == 'search_tutor') {
		$response = array();
		$data = $_POST;
  
		$output = system::FireCurl(SEACRH_TUTOR_URL, "POST", "JSON", $data);
		// var_dump($output);
		$search = $output->data;
		$total_result = count($search);

		if($total_result > 0) {
            foreach ($search as $key => $row) {
               $split_rating = explode('.', $row->average_rating);
               $rate = '';
               for($i = 0; $i < $split_rating[0]; $i++) {
               	$rate .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
               }
               if(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] == '5') {
               	$rate .= '<span class="rating-input"><span data-value="0" class="fa fa-star-half"></span></span>';
               }elseif(isset($split_rating[1]) && $split_rating[1] != '' && $split_rating[1] > '5') {
               	$rate .= '<span class="rating-input"><span data-value="0" class="fa fa-star"></span></span>';
               }

               $response[] = array(
               	'u_id' 				=> $row->ud_u_id,
               	'name' 				=> $row->u_displayname,
               	'gender' 			=> ($row->u_gender == 'M') ? 'Male' : 'Female',
               	'dob' 				=> system::CalculateAge($row->ud_dob).' '.YEARS_OLD,
               	'rating' 			=> $rate,
               	'city_name' 		=> $row->ud_address,
               	'ud_qualification'  => $row->ud_qualification);
           }
       }

       echo json_encode($response);
	}
}
