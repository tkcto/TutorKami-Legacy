<?php
require_once('admin/classes/config.php.inc');
session_start();
$conn = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$connect = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME, DB_USER, DB_PASS);

$column = array('j_id', 'j_create_date', 'j_start_date', 'jlt_title', 'jt_subject', 'j_area', 'st_name', 'j_status', 'j_payment_status', 'aj_j_id', 'j_deadline');
/*
	        $sql = "SELECT * FROM ".DB_PREFIX."_job AS J 
	        INNER JOIN ".DB_PREFIX."_job_translation AS JT ON JT.jt_j_id = J.j_id 
	        LEFT JOIN ".DB_PREFIX."_states AS ST ON ST.st_id = J.j_state_id 
	        LEFT JOIN ".DB_PREFIX."_job_level AS JL ON JL.jl_id = J.j_jl_id 
	        LEFT JOIN ".DB_PREFIX."_job_level_translation AS JLT ON JLT.jlt_jl_id = JL.jl_id
	        WHERE J.j_status = '{$status}' AND JL.jl_status = 'A' AND JLT.jlt_lang_code = '{$lang}' AND JT.jt_lang_code = '{$lang}'";
*/

$query = "
SELECT * FROM tk_job 
INNER JOIN tk_job_translation ON jt_j_id = j_id 
LEFT JOIN tk_tution_course ON tc_id = j_jl_id
LEFT JOIN tk_states ON st_id = j_state_id 
WHERE jt_lang_code = 'en'
";

if( isset($_POST['state']) && $_POST['state'] != ''){
	if($_POST['state'] == 'All'){
		$query .= 'AND j_state_id IS NOT NULL ';
	}else if($_POST['state'] == '1384'){
		$query .= ' AND jt_subject LIKE "%(Online)%" ';
    }else{
		$query .= '
		AND j_state_id = "'.$_POST['state'].'"
		';
	}
}
if( isset($_POST['course']) && $_POST['course'] != ''){
	if($_POST['course'] == 'All'){
		$query .= 'AND j_jl_id IS NOT NULL';
	}else{
		$query .= '
		AND j_jl_id = "'.$_POST['course'].'"
		';
	}
}
/*if( isset($_POST['status']) && $_POST['status'] != ''){
	$query .= ' AND j_status = "'.$_POST['status'].'" ';
}else{
	$query .= ' AND j_status = "open" ';
}*/
if( isset($_POST['status']) && $_POST['status'] != ''){
	if($_POST['status'] == 'All'){
		//$query .= 'AND j_status IS NOT NULL ';
		$query .= ' AND j_status != "'.$_POST['status'].'" ';
	}else{
		$query .= ' AND j_status = "'.$_POST['status'].'" ';
	}
}
if( isset($_POST['job_id']) && $_POST['job_id'] != ''){
	$query .= ' AND j_id = "'.$_POST['job_id'].'" ';
}
if( isset($_POST['thissort']) && $_POST['thissort'] != ''){
	$query .= ' ORDER BY j_create_date DESC ';
}
			
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
 
 //$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail">'.$row['j_id'].'</a>';

 if( $row["j_create_date"] =='' ){
	 $sub_array[] = $row["j_create_date"];
 }else if( $row["j_create_date"]=='0000-00-00 00:00:00' ){
	 $sub_array[] = '';
 }else if( (date("Y", strtotime($row['j_create_date'])))=='1970' ){
	 $sub_array[] = '';
 }else{
	$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.date("d/m/Y", strtotime($row['j_create_date'])).'</a>'; //date("d/m/Y", strtotime($row['j_create_date']));
 }
 
 $sqlLvl = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = $row[j_jl_id]";
 $queryLvl=mysqli_query($conn, $sqlLvl) or die("get tk_job_level_translation");
 if( $rowLvl=mysqli_fetch_array($queryLvl) ) {
	//$sub_array[] = $rowLvl["jlt_title"];
	$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$rowLvl["jlt_title"].'</a>';
 }else{
	$sub_array[] = 'Error';
 }

 $sqlSubject = "SELECT * FROM tk_job_translation WHERE jt_j_id = $row[j_id]";
 $querySubject=mysqli_query($conn, $sqlSubject) or die("get tk_job_translation");
 if( $rowSubject=mysqli_fetch_array($querySubject) ) {
	//$sub_array[] = $rowSubject["jt_subject"];
	$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$rowSubject["jt_subject"].'</a>';
 }else{
	$sub_array[] = 'Error';
 }
 

if( isset($_POST['state']) && $_POST['state'] == '1384' ){
    $sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">Online Tuition</a>';
}else{
     $sqlState = "SELECT * FROM tk_states WHERE st_id = $row[j_state_id]";
     $queryState = $connect->prepare($sqlState);
     $queryState->execute();
     $resultState = $queryState->fetchAll();
     foreach($resultState as $rowState){
    	//$sub_array[] = $row["j_area"].', '.$rowState["st_name"];
    	
    	//$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$row["j_area"].', '.$rowState["st_name"].'</a>';
     
        if(strpos(strtolower($row['jt_subject']), 'online') !== false){
            $sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">Online Tuition</a>';
        } else{
            $sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$row["j_area"].', '.$rowState["st_name"].'</a>';
        }
         
     }    
}
 
 

 if (isset($_SESSION['auth'])) {
	 //$sub_array[] = $row["j_rate"];
	 $sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$row["j_rate"].'</a>';
 }else{
	 //$sub_array[] = '<a href="login.php?redirect=search_job.php" class="org-txt"><strong><em>Login to view</em></strong></a>';
	 $sub_array[] = '<a target="_blank" href="tutor-login?redirect=search_job&jid='.$row['j_id'].'&status='.$row['j_status'].'" class="org-txt"><strong><em>Login to view</em></strong></a>';
 }
 
 
 if( $row["j_status"] == 'open' ){
    $sub_array[] = '<font color="#28a745" ><b>Open</b></font>';
 }else if( $row["j_status"] == 'closed' ){
    $sub_array[] = '<font color="#dc3545" ><b>Closed</b></font>';
 }else{
    $sub_array[] = '<font color="#ffc107" ><b>"'.$row["j_status"].'"</b></font>';
 }
 

 $sub_array[] = '<a type="button" class="view-button btn btn-sm" target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'">View Detail</a>';

 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "
SELECT * FROM tk_job 
INNER JOIN tk_job_translation ON jt_j_id = j_id 
LEFT JOIN tk_tution_course ON tc_id = j_jl_id
LEFT JOIN tk_states ON st_id = j_state_id 
WHERE jt_lang_code = 'en'
 ";

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
