<?php  
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/
require_once('classes/config.php.inc');
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

$output = '';



$queryJob = " SELECT * FROM tk_job ";

if( isset($_GET['j_email']) || isset($_GET['j_rate']) || isset($_GET['j_hired_tutor_email']) || isset($_GET['j_telephone']) || isset($_GET['j_date']) || isset($_GET['j_jl_id']) || isset($_GET['j_state_id']) || isset($_GET['newCity']) || isset($_GET['j_status']) || isset($_GET['j_payment_status']) || isset($_GET['j_deadline']) || isset($_GET['j_start_date']) || isset($_GET['j_end_date']) || isset($_GET['sort_by']) || isset($_GET['j_creator_email']) ){
 $queryJob .= ' WHERE j_id IS NOT NULL ';
}

if( isset($_GET['j_email']) && $_GET['j_email'] != ''){
 $queryJob .= '
 AND j_email = "'.$_GET['j_email'].'"
 ';
}
if( isset($_GET['j_rate']) && $_GET['j_rate'] != ''){
 $queryJob .= '
 AND j_rate LIKE "'.$_GET['j_rate'].'%"
 ';
}
if( isset($_GET['j_hired_tutor_email']) && $_GET['j_hired_tutor_email'] != ''){
 $queryJob .= '
 AND j_hired_tutor_email = "'.$_GET['j_hired_tutor_email'].'"
 ';
}
if( isset($_GET['j_telephone']) && $_GET['j_telephone'] != ''){
 $queryJob .= '
 AND j_telephone = "'.$_GET['j_telephone'].'"
 ';
}
if( isset($_GET['j_date']) && $_GET['j_date'] != ''){
 $queryJob .= '
 AND j_create_date = "'.$_GET['j_date'].'"
 ';
}
if( isset($_GET['j_jl_id']) && $_GET['j_jl_id'] != ''){
 $queryJob .= '
 AND j_jl_id = "'.$_GET['j_jl_id'].'"
 ';
}
if( isset($_GET['j_state_id']) && $_GET['j_state_id'] != ''){

	if($_GET['j_state_id'] =="Unselected"){
		$queryJob .= ' AND state = "0" OR city = "0" ';
	}else{
        $queryJob .= ' AND state = "'.$_GET['j_state_id'].'" ';
	}
}
if( isset($_GET['newCity']) && $_GET['newCity'] != ''){
 $queryJob .= '
 AND city = "'.$_GET['newCity'].'"
 ';
}
if( isset($_GET['j_status']) && $_GET['j_status'] != ''){
 $queryJob .= '
 AND j_status = "'.$_GET['j_status'].'"
 ';
}
if( isset($_GET['j_payment_status']) && $_GET['j_payment_status'] != ''){
	if($_GET['j_payment_status'] =="paid"){
		$queryJob .= '
		AND j_payment_status = "'.$_GET['j_payment_status'].'"
		';
	}else{
		$queryJob.=" AND j_payment_status = 'pending' ";
	}
}
if( isset($_GET['j_deadline']) && $_GET['j_deadline'] != ''){
 $queryJob .= '
 AND j_deadline = "'.$_GET['j_deadline'].'"
 ';
}
if( isset($_GET['j_start_date']) && $_GET['j_start_date'] != ''){
 $queryJob .= '
 AND j_start_date = "'.$_GET['j_start_date'].'"
 ';
}
if( isset($_GET['j_end_date']) && $_GET['j_end_date'] != ''){
 $queryJob .= '
 AND j_end_date = "'.$_GET['j_end_date'].'"
 ';
}
if( isset($_GET['j_creator_email']) && $_GET['j_creator_email'] != ''){
 $queryJob .= '
 AND j_creator_email = "'.$_GET['j_creator_email'].'"
 ';
}
/*
if( isset($_GET['sort_by']) && $_GET['sort_by'] != ''){
	if($_GET['sort_by'] =="0"){
		$queryJob .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	if($_GET['sort_by'] =="1"){
		$queryJob .= 'ORDER BY j_create_date DESC, j_id DESC ';
	}
	
	if($_GET['sort_by'] =="2"){
		$queryJob .= 'ORDER BY (CASE WHEN j_create_date IS NULL OR j_create_date = "1970-01-01 00:00:00" OR j_create_date = "0000-00-00 00:00:00" OR j_create_date LIKE "1970%" THEN 1 ELSE 0 END), j_create_date ';
	}
	
	if($_GET['sort_by'] =="10"){
		$queryJob .= 'ORDER BY (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
	if($_GET['sort_by'] =="11"){
		$queryJob .= 'ORDER BY YEAR(j_deadline) DESC, MONTH(j_deadline) DESC, DAY(j_deadline) DESC, (CASE WHEN j_deadline IS NULL OR j_deadline = "0000-00-00" THEN 1 ELSE 0 END), j_deadline ';
	}
}else{
	//$queryJob .= 'ORDER BY j_create_date DESC, j_id DESC ';
	$queryJob .= 'GROUP BY city ORDER BY state ';
}
*/
$queryJob .= 'GROUP BY city ORDER BY state ';


$resultQueryJob = $conn->query($queryJob); 
if($resultQueryJob->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>State</th>
                <th>Cities</th>
            </tr>
    ';
while($rowQueryJob = $resultQueryJob->fetch_assoc()){



 $sqlState = "SELECT * FROM tk_states WHERE st_id = '".$rowQueryJob['state']."' ";
 $resultState = $conn->query($sqlState); 
 if($resultState->num_rows > 0){ 
	$rowState = $resultState->fetch_assoc();
	$thisState = $rowState["st_name"];
 }
 
 $sqlCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowQueryJob['city']."' ";
 $resultCity = $conn->query($sqlCity); 
 if($resultCity->num_rows > 0){ 
	$rowCity = $resultCity->fetch_assoc();
	$thisCity = $rowCity["city_name"];
 }

 $sqlLvl = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = '".$rowQueryJob['j_jl_id']."' ";
 $resultLvl = $conn->query($sqlLvl); 
 if($resultLvl->num_rows > 0){ 
	$rowLvl = $resultLvl->fetch_assoc();
	$thisLvl  = $rowLvl["jlt_title"];
 }

 $thisID = $rowQueryJob['j_id'];

    $output .= '
        <tr>  
            <td>'.$thisState.'</td>
            <td>'.$thisCity.'</td>
        </tr>
    ';
}
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Job List State-City.xls');
  echo $output;
}

?>