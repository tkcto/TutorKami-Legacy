<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$get_id = htmlentities(trim($_GET['id']));
$get_email = $_GET['email'];

$User = "SELECT * FROM tk_user WHERE u_id = $get_id";
$resultUser = $conn->query($User);
if ($resultUser->num_rows > 0) {
	echo "<font color='red'> USER </font><br>";
    while($rowUser = $resultUser->fetch_assoc()) {
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_id : </font>".$rowUser["u_id"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_username : </font>".$rowUser["u_username"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_password : </font>".$rowUser["u_password"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_role : </font>".$rowUser["u_role"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_email : </font>".$rowUser["u_email"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_displayname : </font>".$rowUser["u_displayname"]."<br>";
		echo "<font color='blue'>u_displayid : </font>".$rowUser["u_displayid"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_gender : </font>".$rowUser["u_gender"]."<br>";
		echo "<font color='blue'>u_profile_pic : </font>".$rowUser["u_profile_pic"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>u_oauth_provider : </font>".$rowUser["u_oauth_provider"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>u_app_token : </font>".$rowUser["u_app_token"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>u_social_id : </font>".$rowUser["u_social_id"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_status : </font>".$rowUser["u_status"]."<br>";
		echo "<font color='blue'>u_paying_client : </font>".$rowUser["u_paying_client"]."<br>";
		echo "<font color='blue'>u_admin_approve : </font>".$rowUser["u_admin_approve"]."<br>";
		echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>u_create_date : </font>".$rowUser["u_create_date"]."<br>";
		echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>u_modified_date : </font>".$rowUser["u_modified_date"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>u_country_id : </font>".$rowUser["u_country_id"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ip_address : </font>".$rowUser["ip_address"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>last_page : </font>".$rowUser["last_page"]."<br>";
		
		
	}
}


$sql = "SELECT * FROM tk_user_details WHERE ud_u_id = $get_id ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<font color='red'> DETAILS </font><br>";
    while($row = $result->fetch_assoc()) {
		echo "<font color='blue'>ud_id : </font>".$row["ud_id"]."<br>";
		echo "<font color='blue'>ud_u_id : </font>".$row["ud_u_id"]."<br>";
		echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>ud_first_name : </font>".$row["ud_first_name"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_last_name : </font>".$row["ud_last_name"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_dob : </font>".$row["ud_dob"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_address : </font>".$row["ud_address"]."<br>";
		echo "<i class='fa fa-question' style='color:orange'></i> <font color='blue'>ud_address2 : </font>".$row["ud_address2"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_city : </font>".$row["ud_city"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_state : </font>".$row["ud_state"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_country : </font>".$row["ud_country"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>ud_postal_code : </font>".$row["ud_postal_code"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_phone_number : </font>".$row["ud_phone_number"]."<br>";
		echo "<i class='fa fa-question' style='color:orange'></i> <font color='blue'>ud_company_name : </font>".$row["ud_company_name"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_race : </font>".$row["ud_race"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_marital_status : </font>".$row["ud_marital_status"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_nationality : </font>".$row["ud_nationality"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_admin_comment : </font>".$row["ud_admin_comment"]."<br>";
		echo "<font color='blue'>ud_client_status : </font>".$row["ud_client_status"]."<br>";
		echo "<font color='blue'>ud_client_status_2 : </font>".$row["ud_client_status_2"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_tutor_status : </font>".$row["ud_tutor_status"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_current_occupation : </font>".$row["ud_current_occupation"]."<br>";
		echo "<i class='fa fa-question' style='color:orange'></i> <font color='blue'>ud_current_occupation_other : </font>".$row["ud_current_occupation_other"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_current_company : </font>".$row["ud_current_company"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_tutor_experience : </font>".$row["ud_tutor_experience"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_about_yourself : </font>".$row["ud_about_yourself"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>ud_rate_per_hour : </font>".$row["ud_rate_per_hour"]."<br>";
		echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ud_qualification : </font>".$row["ud_qualification"]."<br>";
		echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>ud_proof_of_accepting_terms : </font>".$row["ud_proof_of_accepting_terms"]."<br>";
		echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>student_disability : </font>".$row["student_disability"]."<br>";
		
		$sqltestimonial = "SELECT * FROM tk_user_testimonial WHERE ut_u_id = $get_id";
		$resulttestimonial = $conn->query($sqltestimonial);
		if ($resulttestimonial->num_rows > 0) {
			echo "<font color='red'> TESTIMONIAL </font><br>";
			while($rowtestimonial = $resulttestimonial->fetch_assoc()) {
				echo "<font color='blue'>ut_id : </font>".$rowtestimonial["ut_id"]."<br>";
				echo "<font color='blue'>ut_u_id  : </font>".$rowtestimonial["ut_u_id"]."<br>";
				echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ut_user_testimonial1 : </font>".$rowtestimonial["ut_user_testimonial1"]."<br>";
				echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>ut_user_testimonial2 : </font>".$rowtestimonial["ut_user_testimonial2"]."<br>";
				echo "<font color='blue'>ut_user_testimonial3 : </font>".$rowtestimonial["ut_user_testimonial3"]."<br>";
				echo "<font color='blue'>ut_user_testimonial4 : </font>".$rowtestimonial["ut_user_testimonial4"]."<br>";
				echo "<font color='blue'>ut_user_testimonial5 : </font>".$rowtestimonial["ut_user_testimonial5"]."<br>";
				echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>ut_create_date : </font>".$rowtestimonial["ut_create_date"]."<br>";
			}
		}


				//area cover
				$sqlareacover = "SELECT * FROM tk_tutor_area_cover WHERE tac_u_id = $get_id";
				$resultareacover = $conn->query($sqlareacover);
				if ($resultareacover->num_rows > 0) {
					echo "<font color='red'> <i class='fa fa-remove' style='color:red'></i> AREA COVER </font><br>";
					while($rowareacover = $resultareacover->fetch_assoc()) {
						
						$state = "SELECT * FROM tk_states WHERE st_id = $rowareacover[tac_st_id]";
						$resultstate = $conn->query($state);
						if ($resultstate->num_rows > 0) {
							$rowstate = $resultstate->fetch_assoc();
								$datastate = $rowstate["st_name"];
						}else{
							$datastate =  $rowareacover["tac_st_id"];
						}
						$city = "SELECT * FROM tk_cities WHERE city_id = $rowareacover[tac_city_id]";
						$resultcity = $conn->query($city);
						if ($resultcity->num_rows > 0) {
							$rowcity = $resultcity->fetch_assoc();
								$datacity = $rowcity["city_name"];
						}else{
							$datacity =  $rowareacover["tac_city_id"];
						}
						
						echo "<font color='green'><b>tac_id : </b></font>".$rowareacover["tac_id"]."<br>";
						echo "<font color='blue'>tac_u_id  : </font>".$rowareacover["tac_u_id"]."<br>";
						echo "<font color='blue'>tac_st_id : </font>".$datastate."<br>";
						echo "<font color='blue'>tac_city_id : </font>".$datacity."<br>";
						echo "<font color='blue'>tac_other  : </font>".$rowareacover["tac_other"]."<br>";
						
					}
				}
						//tutorsubject
						$sqltutorsubject = "SELECT * FROM tk_tutor_subject WHERE trs_u_id = $get_id";
						$resulttutorsubject = $conn->query($sqltutorsubject);
						if ($resulttutorsubject->num_rows > 0) {
							echo "<font color='red'> <i class='fa fa-remove' style='color:red'></i> TUTOR SUBJECT </font><br>";
							while($rowtutorsubject = $resulttutorsubject->fetch_assoc()) {
								
							$course = "SELECT * FROM tk_tution_course WHERE tc_id = $rowtutorsubject[trs_tc_id]";
							$resultcourse = $conn->query($course);
							if ($resultcourse->num_rows > 0) {
								$rowcourse = $resultcourse->fetch_assoc();
									$datacourse = $rowcourse["tc_title"];
							}else{
								$datacourse =  $rowtutorsubject["trs_tc_id"];
							}
							
							$subject = "SELECT * FROM tk_tution_subject WHERE ts_id = $rowtutorsubject[trs_ts_id]";
							$resultsubject = $conn->query($subject);
							if ($resultsubject->num_rows > 0) {
								$rowsubject = $resultsubject->fetch_assoc();
									$datasubject = $rowsubject["ts_title"];
							}else{
								$datasubject =  $rowtutorsubject["trs_ts_id"];
							}
								
								echo "<font color='green'><b>trs_id : </b></font>".$rowtutorsubject["trs_id"]."<br>";
								echo "<font color='blue'>trs_u_id  : </font>".$rowtutorsubject["trs_u_id"]."<br>";
								echo "<font color='blue'>trs_tc_id : </font>".$datacourse."<br>";
								echo "<font color='blue'>trs_ts_id : </font>".$datasubject."<br>";
								echo "<font color='blue'>trs_other  : </font>".$rowtutorsubject["trs_other"]."<br>";
							}
						}











		
	}
}


						//tk_job
						$sqlttk_job = "SELECT * FROM tk_job WHERE j_hired_tutor_email='$get_email'";
						$resulttk_job = $conn->query($sqlttk_job);
						if ($resulttk_job->num_rows > 0) {
							echo "<font color='red'> JOB </font><br>";
							while($rowtk_job = $resulttk_job->fetch_assoc()) {
								echo "<font color='green'><b>j_id : </b></font>".$rowtk_job["j_id"]."<br>";
								echo "<font color='blue'>j_jl_id : </font>".$rowtk_job["j_jl_id"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_rate : </font>".$rowtk_job["j_rate"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'> j_area  : </font>".$rowtk_job["j_area"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'> j_state_id : </font>".$rowtk_job["j_state_id"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_email : </font>".$rowtk_job["j_email"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_telephone : </font>".$rowtk_job["j_telephone"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_preferred_date_time : </font>".$rowtk_job["j_preferred_date_time"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_commission : </font>".$rowtk_job["j_commission"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_duration : </font>".$rowtk_job["j_duration"]."<br>";
								echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>j_deadline : </font>".$rowtk_job["j_deadline"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_hired_tutor_email : </font>".$rowtk_job["j_hired_tutor_email"]."<br>";
								echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>j_start_date : </font>".$rowtk_job["j_start_date"]."<br>";
								echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>j_end_date : </font>".$rowtk_job["j_end_date"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_payment_status : </font>".$rowtk_job["j_payment_status"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_status : </font>".$rowtk_job["j_status"]."<br>";
								echo "<i class='fa fa-minus-circle' style='color:black'></i> <font color='blue'>j_creator_email : </font>".$rowtk_job["j_creator_email"]."<br>";
								echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>j_create_date : </font>".$rowtk_job["j_create_date"]."<br>";
								echo "<i class='fa fa-remove' style='color:red'></i> <font color='blue'>j_modified_date : </font>".$rowtk_job["j_modified_date"]."<br>";
								echo "<i class='fa fa-check' style='color:green'></i> <font color='blue'>j_country_id : </font>".$rowtk_job["j_country_id"]."<br>";
							}
						}
?>