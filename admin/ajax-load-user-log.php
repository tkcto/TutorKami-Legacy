<?php
/* Database connection start */
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* Database connection end */

$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

$column = array('user', 'date', 'time', 'action');

$query = "
SELECT * FROM tk_user_log
";

if( isset($_POST['user']) || isset($_POST['date']) || isset($_POST['time']) || isset($_POST['action']) ){
 $query .= ' WHERE id IS NOT NULL ';
}

if( isset($_POST['user']) && $_POST['user'] != ''){
 $query .= '
 AND user = "'.$_POST['user'].'"
 ';
}
if( isset($_POST['date']) && $_POST['date'] != ''){
 $query .= '
 AND date = "'.$_POST['date'].'"
 ';
}
if( isset($_POST['time']) && $_POST['time'] != ''){
 $query .= '
 AND time = "'.$_POST['time'].'"
 ';
}
if( isset($_POST['action']) && $_POST['action'] != ''){
 $query .= '
 AND action = "'.$_POST['action'].'"
 ';
}
/*
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
if( isset($_POST['j_jl_id']) && $_POST['j_jl_id'] != ''){
 $query .= '
 AND j_jl_id = "'.$_POST['j_jl_id'].'"
 ';
}
if( isset($_POST['j_state_id']) && $_POST['j_state_id'] != ''){
 $query .= '
 AND j_state_id = "'.$_POST['j_state_id'].'"
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
}else{
	$query .= 'ORDER BY j_create_date DESC, j_id DESC ';
}
*/


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
 
    $user = " SELECT * FROM tk_user WHERE u_id='".$row["user"]."' ";
    $resultUser = $conn->query($user);
    if ($resultUser->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        $sub_array[] = $rowUser["u_email"]; 
    }
    
    //$sub_array[] =  date("d/m/Y", strtotime($row["date"])).'<br/>'.$row["time"];
    $sub_array[] =  date("d/m/Y", strtotime($row["date"]));
 
    $sub_array[] = $row["time"];
    
    $sub_array[] = $row["action"];
 
 /*
 $sub_array[] = '
		<a href="job-edit.php?j='.$row['j_id'].'">'.$row['j_id'].'</a>
 ';
 
 if( $row["j_create_date"] =='' ){
	 $sub_array[] = $row["j_create_date"];
 }else if( $row["j_create_date"]=='0000-00-00 00:00:00' ){
	 $sub_array[] = '';
 }else if( (date("Y", strtotime($row['j_create_date'])))=='1970' ){
	 $sub_array[] = '';
 }else{
	$sub_array[] = date("d/m/Y", strtotime($row['j_create_date']));
 }
 
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
 
 $sqlState = "SELECT * FROM tk_states WHERE st_id = $row[j_state_id]";
 $queryState = $connect->prepare($sqlState);
 $queryState->execute();
 $resultState = $queryState->fetchAll();
 foreach($resultState as $rowState){
	$sub_array[] = $rowState["st_name"];
 }
	
 $sub_array[] = $row["j_status"];

 if($row["j_payment_status"] == 'pending'){
	$sub_array[] = 'Unpaid';
 }else{
	$sub_array[] = $row["j_payment_status"];
 }

 $sqlApplied = "SELECT * FROM tk_applied_job WHERE aj_j_id = $row[j_id]";
 $queryApplied=mysqli_query($conn, $sqlApplied) or die("get tk_applied_job");
 if( $rowApplied=mysqli_num_rows($queryApplied) ) {
	$sub_array[] = '<input disabled type="checkbox" checked>';
 }else{
	$sub_array[] = '<input disabled type="checkbox" >';
 }

 if( $row["j_deadline"] =='' ){
	 $sub_array[] = $row["j_deadline"];
 }else if( $row["j_deadline"]=='0000-00-00' ){
	 $sub_array[] = '';
 }else{
	$sub_array[] = date("d/m/Y", strtotime($row['j_deadline']));
 }

 $sub_array[] = '
	<span class="btn-group">
		<a href="job-edit.php?j='.$row['j_id'].'" class="gray-text"><button class="btn-white btn edt-btn btn-xs" name="edit">Edit</button></a>
	</span>
 ';
 */
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = " SELECT * FROM tk_user_log ";
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