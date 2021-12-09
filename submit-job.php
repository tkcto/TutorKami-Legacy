<?php
/* Database connection start */
$localhost = "localhost"; 
$username = "tutorka1_live"; 
$password = "_+11pj,oow.L"; 
$dbname = "tutorka1_tutorkami_db"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
// check connection 
if($connect->connect_error) {
    die("connection failed : " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}
/* Database connection end */
date_default_timezone_set("Asia/Kuala_Lumpur");



if(empty($_POST["ajobid"])){
    echo'Empty JobID';
    exit();
}else if(empty($_POST["thisuser"])){
    echo'Empty User';
    exit();
}else if(empty($_POST["alvl"])){
    echo'Empty Level';
    exit();
}else if(empty($_POST["rate_input"])){
    echo'Empty Rate';
    exit();
}else{
    $ajobid     = $connect->real_escape_string($_POST["ajobid"]);
    $thisuser   = $connect->real_escape_string($_POST["thisuser"]);
    $alvl       = $connect->real_escape_string($_POST["alvl"]);
    $rate_input = $connect->real_escape_string($_POST["rate_input"]);
    
    
    
    $chk = " SELECT * FROM tk_timetable WHERE tt_tutor = '".$thisuser."' ";
    $resultChk = $connect->query($chk);
    if ($resultChk->num_rows > 0) {
		// Check for Duplicate
        $chk = " SELECT * FROM tk_applied_job WHERE aj_j_id = '".$ajobid."' AND aj_u_id = '".$thisuser."' ";
        $resultChk = $connect->query($chk);
        if ($resultChk->num_rows > 0) {
            echo 'You have already applied for this job';
            exit();
        }else{
			$sql = "INSERT INTO tk_applied_job SET
	                aj_j_id   = '$ajobid',
	                aj_u_id   = '$thisuser',
	                aj_status = 'P',
	                aj_date   = '".date('Y-m-d H:i:s')."',
	                aj_level  = '$alvl',
	                aj_rate   = '$rate_input'";

	        if( $connect->query($sql) === TRUE ) {
	        	echo 'done';     	
	        } else {
	        	echo 'ERROR';
	        	
	        }            
        }        
    }else{
        echo 'Please insert Time Table';
    }


}
?>