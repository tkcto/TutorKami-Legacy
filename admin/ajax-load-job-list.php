<?php
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

//$column = array('j_id', 'j_create_date', 'j_start_date', 'jlt_title', 'jt_subject', 'j_area', 'st_name', 'j_status', 'j_payment_status', 'aj_j_id', 'j_deadline');
$column = array('j_id', 'j_create_date', 'j_start_date', 'jlt_title', 'jt_subject', 'j_area', 'st_name', 'j_status', 'j_payment_status', 'aj_j_id', 'j_deadline');

$query = "
SELECT * FROM tk_job 
";

if( isset($_POST['j_email']) || isset($_POST['j_rate']) || isset($_POST['j_hired_tutor_email']) || isset($_POST['j_telephone']) || isset($_POST['j_date']) || isset($_POST['j_jl_id']) || isset($_POST['j_state_id']) || isset($_POST['newCity']) || isset($_POST['j_status']) || isset($_POST['j_payment_status']) || isset($_POST['j_deadline']) || isset($_POST['j_start_date']) || isset($_POST['j_end_date']) || isset($_POST['sort_by']) || isset($_POST['j_creator_email']) || isset($_POST['deadlineYear']) ){
 $query .= ' WHERE j_id IS NOT NULL ';
}

if( isset($_POST['j_email']) && $_POST['j_email'] != ''){
 $query .= '
 AND j_email = "'.$_POST['j_email'].'"
 ';
}
if( isset($_POST['j_rate']) && $_POST['j_rate'] != ''){
 $query .= '
 AND j_rate LIKE "'.$_POST['j_rate'].'%"
 ';
}
if( isset($_POST['j_hired_tutor_email']) && $_POST['j_hired_tutor_email'] != ''){
 $query .= '
 AND j_hired_tutor_email = "'.$_POST['j_hired_tutor_email'].'"
 ';
}
if( isset($_POST['j_telephone']) && $_POST['j_telephone'] != ''){
 $query .= '
 AND (j_telephone = "'.$_POST['j_telephone'].'" OR j_telephone_alt = "'.$_POST['j_telephone'].'" )
 ';
}
if( isset($_POST['j_date']) && $_POST['j_date'] != ''){
 $query .= '
 AND j_create_date = "'.$_POST['j_date'].'"
 ';
}
if( isset($_POST['deadlineYear']) && $_POST['deadlineYear'] != ''){
 $query .= '
 AND j_create_date LIKE "'.$_POST['deadlineYear'].'%"
 ';
}
if( isset($_POST['j_jl_id']) && $_POST['j_jl_id'] != ''){
 $query .= '
 AND j_jl_id = "'.$_POST['j_jl_id'].'"
 ';
}
if( isset($_POST['j_state_id']) && $_POST['j_state_id'] != ''){
 /*$query .= '
 AND j_state_id = "'.$_POST['j_state_id'].'"
 ';*/
	if($_POST['j_state_id'] =="Unselected"){
		$query .= ' AND state = "0" OR city = "0" ';
	}else{
        $query .= ' AND state = "'.$_POST['j_state_id'].'" ';
	}
}
if( isset($_POST['newCity']) && $_POST['newCity'] != ''){
 $query .= '
 AND city = "'.$_POST['newCity'].'"
 ';
}
if( isset($_POST['j_status']) && $_POST['j_status'] != ''){
 $query .= '
 AND j_status = "'.$_POST['j_status'].'"
 ';
}
if( isset($_POST['j_payment_status']) && $_POST['j_payment_status'] != ''){
	if($_POST['j_payment_status'] =="paid"){
		$query .= '
		AND j_payment_status = "'.$_POST['j_payment_status'].'"
		';
	}else{
		$query.=" AND j_payment_status = 'pending' ";
	}
}
if( isset($_POST['j_deadline']) && $_POST['j_deadline'] != ''){
 $query .= '
 AND j_deadline = "'.$_POST['j_deadline'].'"
 ';
}
if( isset($_POST['j_start_date']) && $_POST['j_start_date'] != ''){
 $query .= '
 AND j_start_date = "'.$_POST['j_start_date'].'"
 ';
}
if( isset($_POST['j_end_date']) && $_POST['j_end_date'] != ''){
 $query .= '
 AND j_end_date = "'.$_POST['j_end_date'].'"
 ';
}
if( isset($_POST['j_creator_email']) && $_POST['j_creator_email'] != ''){
 $query .= '
 AND j_creator_email = "'.$_POST['j_creator_email'].'"
 ';
}

if( isset($_POST['sort_by']) && $_POST['sort_by'] =="12"){
 $query .= '
 AND (j_deadline IS NULL OR j_deadline = "0000-00-00")
 ';
}
if( isset($_POST['sort_by']) && $_POST['sort_by'] != ''){
	if($_POST['sort_by'] =="0"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	if($_POST['sort_by'] =="1"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	
	if($_POST['sort_by'] =="2"){
		$query .= 'ORDER BY (CASE WHEN j_create_date IS NULL OR j_create_date = "1970-01-01 00:00:00" OR j_create_date = "0000-00-00 00:00:00" OR j_create_date LIKE "1970%" THEN 1 ELSE 0 END), j_create_date ';
	}
	
	if($_POST['sort_by'] =="10"){
		//$query .= 'ORDER BY YEAR(j_deadline) DESC, (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
		$query .= 'ORDER BY (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
	if($_POST['sort_by'] =="11"){
		$query .= 'ORDER BY YEAR(j_deadline) DESC, MONTH(j_deadline) DESC, DAY(j_deadline) DESC, (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
	if($_POST['sort_by'] =="12"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC  ';
	}
}else{
	$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
}



/*
if(isset($_POST['order'])){
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}else{
 $query .= 'ORDER BY j_id DESC ';
}*/

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
 
 //$sub_array[] = $row['j_id'];
 $sub_array[] = '
		<a href="job-edit.php?j='.$row['j_id'].'">'.$row['j_id'].'</a>
 ';
 //$sub_array[] = date("d/m/Y", strtotime($row['j_create_date']));
 if( $row["j_create_date"] =='' ){
	 $sub_array[] = $row["j_create_date"];
 }else if( $row["j_create_date"]=='0000-00-00 00:00:00' ){
	 $sub_array[] = '';
 }else if( (date("Y", strtotime($row['j_create_date'])))=='1970' ){
	 $sub_array[] = '';
 }else{
	//$sub_array[] = date("d/m/Y", strtotime($row['j_create_date']));
	
    $day = date('d', strtotime($row['j_create_date']));
    $month = date('m', strtotime($row['j_create_date']));
    $year = date('Y', strtotime($row['j_create_date']));
    $year = substr( $year, -2);
	
	$sub_array[] = $day.'/'.$month.'/'.$year;
 }
 
 //$sub_array[] = $row['j_start_date'];
  
 $sqlLvl = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = $row[j_jl_id]";
 $queryLvl=mysqli_query($conn, $sqlLvl) or die("get tk_job_level_translation");
 if( $rowLvl=mysqli_fetch_array($queryLvl) ) {
	$sub_array[] = $rowLvl["jlt_title"];
 }else{
	$sub_array[] = 'Error';
 }

 $sqlSubject = "SELECT * FROM tk_job_translation WHERE jt_j_id = $row[j_id]";
 $querySubject=mysqli_query($conn, $sqlSubject) or die("get tk_job_translation");
 if( $rowSubject=mysqli_fetch_array($querySubject) ) {
	$sub_array[] = $rowSubject["jt_subject"];
 }else{
	$sub_array[] = 'Error';
 }
 
 $sub_array[] = $row["j_area"];
 
 $sqlState = "SELECT * FROM tk_states WHERE st_id = $row[state]";
 $queryState = $connect->prepare($sqlState);
 $queryState->execute();
 $resultState = $queryState->fetchAll();
 foreach($resultState as $rowState){
	$thisState = $rowState["st_name"];
	
 }
 $sqlCity = "SELECT * FROM tk_cities WHERE city_id = $row[city]";
 $queryCity = $connect->prepare($sqlCity);
 $queryCity->execute();
 $resultCity = $queryCity->fetchAll();
 foreach($resultCity as $rowCity){
	$thisCity = $rowCity["city_name"];
 }
 $sub_array[] = '<font><span class="tooltip-left cursor" data-tooltip="'.$thisState.'" >'.$thisCity.'</span></font>';
 
 //$sub_array[] = $row["j_status"];
 if($row["j_status"] == 'open'){
	$sub_array[] = '<font style="color:#338049;"><b>Open</b></font>';
 }else{
	$sub_array[] = '<font style="color:#803351;"><b>'.ucfirst($row["j_status"]).'</b></font>';
 }
 
 
 if($row["j_payment_status"] == 'pending'){
	//$sub_array[] = 'Unpaid';
	$sub_array[] = '<font style="color:#803351;"><b>Unpaid</b></font>';
 }else{
	//$sub_array[] = $row["j_payment_status"];
	$sub_array[] = '<font style="color:#338049;"><b>'.ucfirst($row["j_payment_status"]).'</b></font>';
 }

 $sqlApplied = "SELECT * FROM tk_applied_job WHERE aj_j_id = $row[j_id]";
 $queryApplied=mysqli_query($conn, $sqlApplied) or die("get tk_applied_job");
 if( $rowApplied=mysqli_num_rows($queryApplied) ) {
	$sub_array[] = '<input disabled type="checkbox" checked>';
 }else{
	$sub_array[] = '<input disabled type="checkbox" >';
 }

 //$sub_array[] = $row["j_deadline"];
 if( $row["j_deadline"] =='' ){
	 $sub_array[] = $row["j_deadline"];
 }else if( $row["j_deadline"]=='0000-00-00' ){
	 $sub_array[] = '';
 }else{
	$sub_array[] = date("d/m/Y", strtotime($row['j_deadline']));
 }
 
 /*$sub_array[] = '
	<span class="btn-group">
		<a href="job-add.php?j='.$row['j_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
		<a href="job-list.php?jd='.$row['j_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
	</span>
 ';*/
 $sub_array[] = '
	<span class="btn-group">
		<a href="job-edit.php?j='.$row['j_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
	</span>
 ';
 
 $data[] = $sub_array;
}




function count_all_data($connect)
{
 $query = "SELECT * FROM tk_job";
 
 
 
 
 
 
 
 
 
 
if( isset($_POST['j_email']) || isset($_POST['j_rate']) || isset($_POST['j_hired_tutor_email']) || isset($_POST['j_telephone']) || isset($_POST['j_date']) || isset($_POST['j_jl_id']) || isset($_POST['j_state_id']) || isset($_POST['newCity']) || isset($_POST['j_status']) || isset($_POST['j_payment_status']) || isset($_POST['j_deadline']) || isset($_POST['j_start_date']) || isset($_POST['j_end_date']) || isset($_POST['sort_by']) || isset($_POST['j_creator_email']) ){
 $query .= ' WHERE j_id IS NOT NULL ';
}

if( isset($_POST['j_email']) && $_POST['j_email'] != ''){
 $query .= '
 AND j_email = "'.$_POST['j_email'].'"
 ';
}
if( isset($_POST['j_rate']) && $_POST['j_rate'] != ''){
 $query .= '
 AND j_rate LIKE "'.$_POST['j_rate'].'%"
 ';
}
if( isset($_POST['j_hired_tutor_email']) && $_POST['j_hired_tutor_email'] != ''){
 $query .= '
 AND j_hired_tutor_email = "'.$_POST['j_hired_tutor_email'].'"
 ';
}
if( isset($_POST['j_telephone']) && $_POST['j_telephone'] != ''){
 $query .= '
 AND j_telephone = "'.$_POST['j_telephone'].'"
 ';
}
if( isset($_POST['j_date']) && $_POST['j_date'] != ''){
 $query .= '
 AND j_create_date = "'.$_POST['j_date'].'"
 ';
}
if( isset($_POST['deadlineYear']) && $_POST['deadlineYear'] != ''){
 $query .= '
 AND j_create_date LIKE "'.$_POST['deadlineYear'].'%"
 ';
}
if( isset($_POST['j_jl_id']) && $_POST['j_jl_id'] != ''){
 $query .= '
 AND j_jl_id = "'.$_POST['j_jl_id'].'"
 ';
}
if( isset($_POST['j_state_id']) && $_POST['j_state_id'] != ''){
	if($_POST['j_state_id'] =="Unselected"){
		$query .= ' AND state = "0" OR city = "0" ';
	}else{
        $query .= ' AND state = "'.$_POST['j_state_id'].'" ';
	}
}
if( isset($_POST['newCity']) && $_POST['newCity'] != ''){
 $query .= '
 AND city = "'.$_POST['newCity'].'"
 ';
}
if( isset($_POST['j_status']) && $_POST['j_status'] != ''){
 $query .= '
 AND j_status = "'.$_POST['j_status'].'"
 ';
}
if( isset($_POST['j_payment_status']) && $_POST['j_payment_status'] != ''){
	if($_POST['j_payment_status'] =="paid"){
		$query .= '
		AND j_payment_status = "'.$_POST['j_payment_status'].'"
		';
	}else{
		$query.=" AND j_payment_status = 'pending' ";
	}
}
if( isset($_POST['j_deadline']) && $_POST['j_deadline'] != ''){
 $query .= '
 AND j_deadline = "'.$_POST['j_deadline'].'"
 ';
}
if( isset($_POST['j_start_date']) && $_POST['j_start_date'] != ''){
 $query .= '
 AND j_start_date = "'.$_POST['j_start_date'].'"
 ';
}
if( isset($_POST['j_end_date']) && $_POST['j_end_date'] != ''){
 $query .= '
 AND j_end_date = "'.$_POST['j_end_date'].'"
 ';
}
if( isset($_POST['j_creator_email']) && $_POST['j_creator_email'] != ''){
 $query .= '
 AND j_creator_email = "'.$_POST['j_creator_email'].'"
 ';
}
if( isset($_POST['sort_by']) && $_POST['sort_by'] =="12"){
 $query .= '
 AND (j_deadline IS NULL OR j_deadline = "0000-00-00")
 ';
}
if( isset($_POST['sort_by']) && $_POST['sort_by'] != ''){
	if($_POST['sort_by'] =="0"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	if($_POST['sort_by'] =="1"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	
	if($_POST['sort_by'] =="2"){
		$query .= 'ORDER BY (CASE WHEN j_create_date IS NULL OR j_create_date = "1970-01-01 00:00:00" OR j_create_date = "0000-00-00 00:00:00" OR j_create_date LIKE "1970%" THEN 1 ELSE 0 END), j_create_date ';
	}
	
	if($_POST['sort_by'] =="10"){
		$query .= 'ORDER BY (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
	if($_POST['sort_by'] =="11"){
		$query .= 'ORDER BY YEAR(j_deadline) DESC, MONTH(j_deadline) DESC, DAY(j_deadline) DESC, (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
	if($_POST['sort_by'] =="12"){
		$query .= 'ORDER BY j_create_date DESC, j_id DESC  ';
	}
}else{
	$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
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
