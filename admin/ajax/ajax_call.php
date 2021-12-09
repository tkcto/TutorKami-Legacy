<?php 
require_once('../classes/location.class.php');
require_once('../classes/app.class.php');
require_once('../classes/user.class.php');
require_once('../classes/job.class.php');

$instApp = new app;
$instLocation = new location;
$instUser = new user;
$instJob = new job;

if (isset($_POST['action'])) {

	$ac = $_POST['action'];

	if ($ac == 'get_state') {
		$c_id = $_POST['country_id'];

		$stresponse = $instLocation->CountryWiseState($c_id);

		echo '<option value="0">Select State</option>';
		if ($stresponse->num_rows > 0) {
			while( $cu_row = $stresponse->fetch_assoc() ){
		?>
			<option value="<?php echo $cu_row['st_id'];?>"><?php echo $cu_row['st_name'];?></option>
		<?php 
			}
		}
	}

	if ($ac == 'get_city') {
		$s_id = $_POST['state_id'];
		
		$ciresponse = $instLocation->StateWiseCity($s_id);

		echo '<option value="">Select City</option>';
		if ($ciresponse->num_rows > 0) {
	      while( $cu_row = $ciresponse->fetch_assoc() ){
        	    ?>
        	    <option value="<?php echo $cu_row['city_id'];?>"><?php echo $cu_row['city_name'];?></option>
        	    <?php 
	      }
        	    ?><option value="1384">Online Tuition</option><?php 
	    }
	}
	if ($ac == 'get_city2') {
		$s_id = $_POST['state_id'];
		
		$ciresponse = $instLocation->StateWiseCity($s_id);

		if ($ciresponse->num_rows > 0) {              
	      while( $cu_row = $ciresponse->fetch_assoc() ){                
	    ?>
	    <option value="<?php echo $cu_row['city_id'];?>"><?php echo $cu_row['city_name'];?></option>
	    <?php 
	    	}
	    }
	}
	if ($ac == 'get_cities') {
		$state_id = $_POST['state_id'];
		if ($state_id != '') {
			$i = 0;
			$getStateWiseCity = $instLocation->StateWiseCity($state_id);
			if ($getStateWiseCity->num_rows > 0) {
				while ( $city = $getStateWiseCity->fetch_object() ) {
					echo '<div class="col-md-6">
	                    <input name="cover_area_city_'. $state_id.'['. $i .']" class="city_check" id="city_check_'.$city->city_id.'" value="'.$city->city_id.'" type="checkbox" data-cname="cover_area_city_" data-pname="ca_state_">
	                    <label for="city_check_'.$city->city_id.'">'.$city->city_name.'</label>
	                </div>';

	                $i++;
				}
			}
		}			
	}
	if ($ac == 'getAllCity') {
		$state_id = $_POST['state_id'];
		if ($state_id != '') {
			$i = 0;
			$getStateWiseCity = $instLocation->StateWiseCity($state_id);
			if ($getStateWiseCity->num_rows > 0) {
                /*echo'<select class="js-example-basic-single" name="cover_area_city_'. $state_id.'['. $i .']" id="city_check_'.$city->city_id.'" style="width:48%" ><option value="">Select City</option>';
                    while ( $city = $getStateWiseCity->fetch_object() ) {
                    echo'<option value="'.$city->city_id.'">'.$city->city_name.'</option>';
                    }
                echo'</select>';*/
                echo 'test';
			}
		}			
	}

	if ($ac == 'get_subjects') {
		$level_id = $_POST['level_id'];
		if ($level_id != '') {
			$i = 0;
			$getSubject = $instApp->CourseWiseSubject($level_id);
			if ($getSubject->num_rows > 0) {
				while ($subject = $getSubject->fetch_object()) {
					echo '<div class="col-md-6">
	                    <input name="tutor_subject_'. $level_id.'['. $i .']" class="subject_check" id="subject_check'.$subject->ts_id.'" value="'.$subject->ts_id.'" type="checkbox" data-cname="tutor_subject_" data-pname="ca_state_">
	                    <label for="subject_check'.$subject->ts_id.'">'.$subject->ts_title.'</label>
	                </div>';

	                $i++;
				}
			}
		}			
	}
	
	if ($ac == 'search_user') {
	   // var_dump($_POST);
		$resTutor = $instUser->SearchUser($_POST);
		
        $arrTutor = array();
		if ($resTutor->num_rows > 0) {
            while ( $row = $resTutor->fetch_assoc() ) {
            	$data = array(
            		'u_id' => $row['u_id'],
            		'u_displayid' => $row['u_displayid'],
            	    'u_profile_pic' => $row['u_profile_pic'],
            		'u_email' => $row['u_email'],
            		'ud_first_name' => $row['ud_first_name'],
            		'ud_last_name' => $row['ud_last_name'],
            		'u_role' => $row['u_role'],
            		'u_displayname' => $row['u_displayname'],
            		'u_status' => $row['u_status'],
            		'ud_dob' => $row['ud_dob'],
            		'ud_address' => $row['ud_address'],
            		'ud_phone_number' => $row['ud_phone_number'],
            		'u_create_date' => $row['u_create_date'],
            		'u_modified_date' => $row['u_modified_date'],
            		'age' => system::CalculateAge($row['ud_dob']),
            		'status' => ($row['u_status'] != 'A') ? '<i class="fa fa-times text-red"></i>' : '<i class="fa fa-check text-green"></i>'
            	);
            	array_push($arrTutor, $data);
            }
        }

        echo json_encode($arrTutor);
	}

	if ($ac == 'update_seo_data') {
		$page_id = $_POST['row_id'];
		$page_translate_id = $_POST['lang_id'];
		$value = $_POST['value'];

		switch ($_POST['column']) {
			case '1':
				$column_name = 'smt_meta_title';
				break;
			
			case '2':
				$column_name = 'smt_meta_description';
				break;
			
			case '3':
				$column_name = 'smt_meta_keyword';
				break;
			
			default:
				$column_name = 'smt_meta_title';
				break;
		}

		$data = array(
			'sm_id' => $page_id,
			'smt_id' => $page_translate_id,
			'column' => $column_name,
			'value' => $value
			);

		$res = $instApp->UpdateSEOContent($data);

		echo $value;
	}

	if ($ac == 'update_res_data') {
		$page_id = $_POST['row_id'];
		$page_translate_id = $_POST['lang_id'];
		$value = $_POST['value'];

		switch ($_POST['column']) {
			case '1':
				$column_name = 'rm_target_res';
				break;
			
			case '2':
				$column_name = 'rmt_resourcevalue';
				break;
		}

		$data = array(
			'rm_id' => $page_id,
			'rmt_id' => $page_translate_id,
			'column' => $column_name,
			'value' => $value
			);

		$res = $instApp->UpdateRESContent($data);

		echo ($res) ? $value : '{error}';
	}

	if ($ac == 'get_job_details') {
		$job_id = $_POST['job_id'];
		$arrJb  = $instJob->GetJob($job_id);
		$resJbt = $instJob->GetJobTranslationByJob($job_id);
		$arrJbt = $resJbt->fetch_array(MYSQLI_ASSOC);
		$userRow = array();
		$parentArr = array();
		
		if(is_array($arrJb)){
			if ($arrJb['j_hired_tutor_email'] != '') {
				
				$userRes = $instUser->GetAllUser(3, '', '', '', $arrJb['j_hired_tutor_email']);
				if($userRes->num_rows > 0) 
					$userRow = $userRes->fetch_array(MYSQLI_ASSOC);
			  }

			if ($arrJb['j_email'] != '') {
				
				$userResEm = $instUser->GetAllUser('', '', '', '', $arrJb['j_email']);
				if($userResEm->num_rows > 0) {
	            $userRowEm = $userResEm->fetch_array(MYSQLI_ASSOC);
	            $parentArr = array('parent_id' => $userRowEm['u_id']);
	           }
			}

			echo json_encode(array_merge($arrJb, $arrJbt, $userRow, $parentArr));
		} else {
			echo json_encode(array(0));
		}
	}
// Luqman
if(isset($_POST['data'])){

	$data = $_POST['data'];

	$job_id = isset($data['job_id'])		?	$data['job_id'] : '';
	
	echo json_encode(["response"=>$hello]);//adaaa
	$getClientName = $instApp->getClientName($data);


}
// Luqman
}
