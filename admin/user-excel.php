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

date_default_timezone_set("Asia/Kuala_Lumpur");

function CalculateAge($dob) {
    $dateOfBirth = date("Y-m-d", strtotime($dob));
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');

    return $age;
}


$output = '';

/*
SELECT * FROM `objects` 
WHERE (CAST(date_field AS DATETIME) 
BETWEEN CAST('2010-09-29 10:15:55' AS DATETIME) AND CAST('2010-01-30 14:15:55' AS DATETIME))
*/

/*
    WHERE (CAST(u_create_date AS DATETIME) 
    BETWEEN CAST('$startdate' AS DATETIME) AND CAST('$enddate' AS DATETIME))
    */
if( isset($_GET['dateCreatedStart']) && $_GET['dateCreatedStart'] != '' && isset($_GET['dateCreatedtEnd']) && $_GET['dateCreatedtEnd'] != '' ){
    
    //$startdate = $_GET['dateCreatedStart'];
    //$enddate = $_GET['dateCreatedtEnd'];
    
    //$startdate = date('Y-m-d', strtotime($_GET['dateCreatedStart']));
    //$enddate = date('Y-m-d', strtotime($_GET['dateCreatedtEnd']));
    
$dateCreatedStart = explode('/', $_GET['dateCreatedStart']); 
$startdate = $dateCreatedStart[2].'-'.$dateCreatedStart[1].'-'.$dateCreatedStart[0];

$dateCreatedtEnd = explode('/', $_GET['dateCreatedtEnd']); 
$enddate = $dateCreatedtEnd[2].'-'.$dateCreatedtEnd[1].'-'.$dateCreatedtEnd[0];
    
    

    
    $queryUser = " SELECT * FROM tk_user 
    INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
WHERE u_role=4 AND CAST(u_create_date AS DATE) BETWEEN CAST('".$startdate."' AS DATE) AND CAST('".$enddate."' AS DATE)
    ";    
}else{
    $queryUser = " SELECT * FROM tk_user 
    INNER JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id
    WHERE u_role=4 
    ";    
}





if( isset($_GET['u_email']) && $_GET['u_email'] != ''){
 $queryUser .= '
 AND u_email = "'.$_GET['u_email'].'"
 ';
}

if( isset($_GET['ud_first_name']) && $_GET['ud_first_name'] != ''){
 $queryUser .= '
 AND ud_first_name = "'.$_GET['ud_first_name'].'"
 ';
}

if( isset($_GET['ud_last_name']) && $_GET['ud_last_name'] != ''){
 $queryUser .= '
 AND ud_last_name = "'.$_GET['ud_last_name'].'"
 ';
}

if( isset($_GET['ud_phone_number']) && $_GET['ud_phone_number'] != ''){
 $queryUser .= '
 AND ud_phone_number = "'.$_GET['ud_phone_number'].'"
 ';
}

if( isset($_GET['u_gender']) && $_GET['u_gender'] != ''){
 $queryUser .= '
 AND u_gender = "'.$_GET['u_gender'].'"
 ';
}

if( isset($_GET['ud_client_status']) && $_GET['ud_client_status'] != ''){
 $queryUser .= '
 AND ud_client_status_2 = "'.$_GET['ud_client_status'].'"
 ';
}

if( isset($_GET['user_status']) && $_GET['user_status'] != ''){
	if($_GET['user_status'] =="active"){
		$queryUser .= " AND u_status = 'A' ";
	}else{
        $queryUser .= " AND u_status = 'B' ";
	}
 
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
	$queryJob .= 'ORDER BY j_create_date DESC, j_id DESC ';
}*/

$queryUser .= 'ORDER BY u_create_date DESC ';

$resultQueryUser = $conn->query($queryUser); 
if($resultQueryUser->num_rows > 0){ 
    $output .= '
        <table class="table" bordered="1">  
            <tr>  
                <th>Display ID</th>
                <th>First Name</th>
                <th>Payment Status</th>
                <th>Active</th>
                <th>Age</th>
                <th>City</th>
                <th>Phone Number</th>
                <th>Type</th>
                <th>Created On</th>
                <th>Last Activity</th>
            </tr>
    ';
while($rowQueryUser = $resultQueryUser->fetch_assoc()){

/*

 $sqlState = "SELECT * FROM tk_states WHERE st_id = '".$rowQueryUser['state']."' ";
 $resultState = $conn->query($sqlState); 
 if($resultState->num_rows > 0){ 
	$rowState = $resultState->fetch_assoc();
	$thisState = $rowState["st_name"];
 }
 
 $sqlCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowQueryUser['city']."' ";
 $resultCity = $conn->query($sqlCity); 
 if($resultCity->num_rows > 0){ 
	$rowCity = $resultCity->fetch_assoc();
	$thisCity = $rowCity["city_name"];
 }

 $sqlLvl = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = '".$rowQueryUser['j_jl_id']."' ";
 $resultLvl = $conn->query($sqlLvl); 
 if($resultLvl->num_rows > 0){ 
	$rowLvl = $resultLvl->fetch_assoc();
	$thisLvl  = $rowLvl["jlt_title"];
 }
*/
 $thisID = $rowQueryUser['u_id'];
 
 if($rowQueryUser['ud_dob'] == NULL){
    $age = 0;
 }else{
    $age = CalculateAge($rowQueryUser['ud_dob']);
 }

 
 $sqlCity = "SELECT * FROM tk_cities WHERE city_id = '".$rowQueryUser['ud_city']."' ";
 $resultCity = $conn->query($sqlCity); 
 if($resultCity->num_rows > 0){ 
	$rowCity = $resultCity->fetch_assoc();
	$thisCity = $rowCity["city_name"];
 }

 if($rowQueryUser['u_role'] = 4){
    $type = 'Client';
 }else{
    $type = $rowQueryUser['u_role'];
 }

    if($rowQueryUser["u_create_date"] == NULL || $rowQueryUser["u_create_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_create_date"] ==''){
        $createDate = '';
    }else{
        $createDate = date("d/m/Y", strtotime($rowQueryUser['u_create_date']));
    }
        
    if($rowQueryUser["u_modified_date"] == NULL || $rowQueryUser["u_modified_date"] =='0000-00-00 00:00:00' || $rowQueryUser["u_modified_date"] ==''){
        $modifiedDate = '';
    }else{
        $modifiedDate = date("d/m/Y", strtotime($rowQueryUser['u_modified_date']));
    }


    $output .= '
        <tr>  
            <td>'.$rowQueryUser['u_displayid'].'</td>
            <td>'.$rowQueryUser['ud_first_name'].'</td>
            <td>'.$rowQueryUser['u_paying_client'].'</td>
            <td>'.$rowQueryUser['u_status'].'</td>
            <td>'.$age.'</td>
            <td>'.$thisCity.'</td>
            <td>'.$rowQueryUser['ud_phone_number'].'</td>
            <td>'.$type.'</td>
            <td>'.$createDate.'</td>
            <td>'.$modifiedDate.'</td>
        </tr>
    ';
}
  
  
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=User List.xls');
  echo $output;
}

?>