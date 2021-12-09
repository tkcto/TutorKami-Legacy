<?php
require_once('admin/classes/config.php.inc');
$conn = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$connect = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME, DB_USER, DB_PASS);

function CalculateAge($dob) {
	$dateOfBirth = date("Y-m-d", strtotime($dob));
	$today = date("Y-m-d");
	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$age = $diff->format('%y');

	return $age;
}

$query = "
SELECT DISTINCT u_id, u_displayid, u_modified_date, u_displayname, u_gender, ud_dob, ud_city, ud_current_occupation, ud_current_occupation_other
FROM tk_user  
INNER JOIN tk_user_details ON ud_u_id = u_id  
INNER JOIN tk_tutor_area_cover ON tac_u_id = u_id
INNER JOIN tk_tutor_subject ON trs_u_id = u_id
";
$query .= "WHERE u_status = 'A' AND u_role = '3'";

##### START FILTER STATE & AREA ##### 
if( isset($_POST['state']) && $_POST['state'] != ''){
	if($_POST['state'] =="All"){
		$query.=" AND tac_st_id IS NOT NULL ";
	}else{
		$query .= '
		AND tac_st_id = "'.$_POST['state'].'"
		';
	}
}else{
	$query.=" AND tac_st_id IS NOT NULL ";
}

if( isset($_POST['area']) && $_POST['area'] != ''){
	$query .= " AND tac_city_id IN(".implode(',',$_POST['area']).")";
}else{
	$query.=" AND tac_city_id IS NOT NULL ";
}
##### END FILTER STATE & AREA ##### 

##### START FILTER LEVEL & SUBJECT ##### 
if( isset($_POST['level']) && $_POST['level'] != ''){
	if($_POST['level'] =="All"){
		$query.=" AND trs_tc_id IS NOT NULL ";
	}else{
		$query .= '
		AND trs_tc_id = "'.$_POST['level'].'"
		';
	}
}else{
	$query.=" AND trs_tc_id IS NOT NULL ";
}

if( isset($_POST['subjek']) && $_POST['subjek'] != ''){
	$query .= " AND trs_ts_id IN(".implode(',',$_POST['subjek']).")";
}else{
	$query.=" AND trs_ts_id IS NOT NULL ";
}
##### END FILTER LEVEL & SUBJECT #####

##### START FILTER GENDER ##### 
if( isset($_POST['gender2']) && $_POST['gender2'] != ''){
	if($_POST['gender2'] =="All"){
		//$query.=" AND u_gender IS NOT NULL ";
	}else{
		$query .= '
		AND u_gender = "'.$_POST['gender2'].'"
		';
	}
}else{
	//$query.=" AND u_gender IS NOT NULL ";
}
##### END FILTER GENDER #####

##### START FILTER GENDER ##### 
if( isset($_POST['race']) && $_POST['race'] != ''){
	if($_POST['race'] =="All"){
		//$query.=" AND u_gender IS NOT NULL ";
	}else{
		$query .= '
		AND ud_race = "'.$_POST['race'].'"
		';
	}
}else{
	//$query.=" AND u_gender IS NOT NULL ";
}
##### END FILTER GENDER #####

##### START FILTER OCCUPATION ##### 
if( isset($_POST['occupation']) && $_POST['occupation'] != ''){
	if($_POST['occupation'] =="All"){
		//$query.=" AND u_gender IS NOT NULL ";
	}else if($_POST['occupation'] =="Lacturer"){
		$query .= " AND ud_current_occupation = '".$_POST['occupation']."' OR (ud_current_occupation LIKE '".$_POST['occupation']."%' OR ud_current_occupation = 'Lacturer' OR ud_current_occupation = 'Lecture' OR ud_current_occupation = 'Lecturer')";
	}else{
		$query .= " AND ud_current_occupation = '".$_POST['occupation']."'";
	}
}else{
	//$query.=" AND u_gender IS NOT NULL ";
}
##### END FILTER OCCUPATION #####
$query .= ' ORDER BY u_modified_date DESC ';



$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();

foreach($result as $row)
{
 $sub_array = array();
 
 //$sub_array[] = $row['u_modified_date'];
 $sub_array[] = ucwords(strtolower($row['u_displayname']));
 $sub_array[] = ucwords(strtolower($row['u_gender']));
 $sub_array[] = CalculateAge($row['ud_dob']);
 $sub_array[] = ucwords(strtolower($row['ud_city']));
 
	if (strtolower($row['ud_current_occupation']) == 'full-time tutor') {
		$sub_array[] =  'Full Time Tutor';
	}else if (strtolower($row['ud_current_occupation']) == 'kindergarten teacher'){
		$sub_array[] =  'Kindergarten Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'primary school teacher'){
		$sub_array[] =  'Primary School Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'secondary school teacher'){
		$sub_array[] =  'Secondary School Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'tuition center teacher'){
		$sub_array[] =  'Tuition Center Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'lacturer' || strtolower($row['ud_current_occupation']) == 'lecture'|| strtolower($row['ud_current_occupation']) == 'lecturer'){
		$sub_array[] =  'Lecture';
	}else if (strtolower($row['ud_current_occupation']) == 'ex-teacher'){
		$sub_array[] =  'Ex-Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'retired teacher'){
		$sub_array[] =  'Retired Teacher';
	}else if (strtolower($row['ud_current_occupation']) == 'other'){
		$sub_array[] = ucwords(strtolower($row['ud_current_occupation_other'])); 
	}else{
		$sub_array[] = ucwords(strtolower($row['ud_current_occupation']));
	} /* $sub_array[] = $row['ud_current_occupation'];*/
 /*
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
 $sub_array[] = $rr_rating;
 */$sub_array[] = '';
 
 $sub_array[] = '
	<a href="tutor_profile.php?did='.$row['u_displayid'].'" class="btn btm-xs view-button" target="_blank">View Profile</a>
 ';

 $data[] = $sub_array;
}

function count_all_data($connect)
{

$query = "
SELECT DISTINCT u_id, u_displayid, u_modified_date, u_displayname, u_gender, ud_dob, ud_city, ud_current_occupation, ud_current_occupation_other
FROM tk_user  
INNER JOIN tk_user_details ON ud_u_id = u_id  
INNER JOIN tk_tutor_area_cover ON tac_u_id = u_id
INNER JOIN tk_tutor_subject ON trs_u_id = u_id
";
$query .= "WHERE u_status = 'A' AND u_role = '3'";

##### START FILTER STATE & AREA ##### 
if( isset($_POST['state']) && $_POST['state'] != ''){
	if($_POST['state'] =="All"){
		$query.=" AND tac_st_id IS NOT NULL ";
	}else{
		$query .= '
		AND tac_st_id = "'.$_POST['state'].'"
		';
	}
}else{
	$query.=" AND tac_st_id IS NOT NULL ";
}

if( isset($_POST['area']) && $_POST['area'] != ''){
	$query .= " AND tac_city_id IN(".implode(',',$_POST['area']).")";
}else{
	$query.=" AND tac_city_id IS NOT NULL ";
}
##### END FILTER STATE & AREA ##### 

##### START FILTER LEVEL & SUBJECT ##### 
if( isset($_POST['level']) && $_POST['level'] != ''){
	if($_POST['level'] =="All"){
		$query.=" AND trs_tc_id IS NOT NULL ";
	}else{
		$query .= '
		AND trs_tc_id = "'.$_POST['level'].'"
		';
	}
}else{
	$query.=" AND trs_tc_id IS NOT NULL ";
}

if( isset($_POST['subjek']) && $_POST['subjek'] != ''){
	$query .= " AND trs_ts_id IN(".implode(',',$_POST['subjek']).")";
}else{
	$query.=" AND trs_ts_id IS NOT NULL ";
}
##### END FILTER LEVEL & SUBJECT #####

##### START FILTER GENDER ##### 
if( isset($_POST['gender2']) && $_POST['gender2'] != ''){
	if($_POST['gender2'] =="All"){
		//$query.=" AND u_gender IS NOT NULL ";
	}else{
		$query .= '
		AND u_gender = "'.$_POST['gender2'].'"
		';
	}
}else{
	//$query.=" AND u_gender IS NOT NULL ";
}
##### END FILTER GENDER #####

##### START FILTER OCCUPATION ##### 
if( isset($_POST['occupation']) && $_POST['occupation'] != ''){
	if($_POST['occupation'] =="All"){
		//$query.=" AND u_gender IS NOT NULL ";
	}else if($_POST['occupation'] =="Lacturer"){
		$query .= " AND ud_current_occupation = '".$_POST['occupation']."' OR (ud_current_occupation LIKE '".$_POST['occupation']."%' OR ud_current_occupation = 'Lacturer' OR ud_current_occupation = 'Lecture' OR ud_current_occupation = 'Lecturer')";
	}else{
		$query .= " AND ud_current_occupation = '".$_POST['occupation']."'";
	}
}else{
	//$query.=" AND u_gender IS NOT NULL ";
}
##### END FILTER OCCUPATION #####
$query .= ' ORDER BY u_modified_date DESC ';









 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($connect),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);
?>

