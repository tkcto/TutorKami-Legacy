<?php
/*
$servername = "localhost";
$username = "tutorka1_live";
$password = "tutorka1_live";
$dbname = "tutorka1_tutorkami_db";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "tutorka1_live");
*/

require_once('admin/classes/config.php.inc');
$conn = mysqli_connect(HOSTNAME, DB_USER, DB_PASS, DBNAME) or die("Connection failed: " . mysqli_connect_error());
$connect = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME, DB_USER, DB_PASS);

session_start();

$column = array('j_id', 'j_create_date', 'j_start_date', 'jlt_title', 'jt_subject', 'j_area', 'st_name', 'j_status', 'j_payment_status', 'aj_j_id', 'j_deadline');

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

 $no1 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail">'.$row['j_id'].'</a>';

 if( $row["j_create_date"] =='' ){
	 $no2 = $row["j_create_date"];
 }else if( $row["j_create_date"]=='0000-00-00 00:00:00' ){
	 $no2 = '';
 }else if( (date("Y", strtotime($row['j_create_date'])))=='1970' ){
	 $no2 = '';
 }else{
	$no2 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.date("d/m/Y", strtotime($row['j_create_date'])).'</a>'; //date("d/m/Y", strtotime($row['j_create_date']));
 }
 
 $sqlLvl = "SELECT * FROM tk_job_level_translation WHERE jlt_jl_id = $row[j_jl_id]";
 $queryLvl=mysqli_query($conn, $sqlLvl) or die("get tk_job_level_translation");
 if( $rowLvl=mysqli_fetch_array($queryLvl) ) {
	$no3 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$rowLvl["jlt_title"].'</a>';
 }else{
	$no3 = 'Error';
 }

 $sqlSubject = "SELECT * FROM tk_job_translation WHERE jt_j_id = $row[j_id]";
 $querySubject=mysqli_query($conn, $sqlSubject) or die("get tk_job_translation");
 if( $rowSubject=mysqli_fetch_array($querySubject) ) {
	$no4 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$rowSubject["jt_subject"].'</a>';
 }else{
	$no4 = 'Error';
 }
 
if( isset($_POST['state']) && $_POST['state'] == '1384' ){
    $no5 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">Online Tuition</a>';
}else{
     $sqlState = "SELECT * FROM tk_states WHERE st_id = $row[j_state_id]";
     $queryState = $connect->prepare($sqlState);
     $queryState->execute();
     $resultState = $queryState->fetchAll();
     foreach($resultState as $rowState){
    	if(strpos(strtolower($row['jt_subject']), 'online') !== false){
            $no5 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">Online Tuition</a>';
        } else{
            $no5 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$row["j_area"].', '.$rowState["st_name"].'</a>';
        }
         
         
     } 
}
 
 
 
 if( $row["j_status"] == 'open' ){
    $no8 = '<font color="#28a745" ><b>Open</b></font> ';
 }else if( $row["j_status"] == 'closed' ){
    $no8 = '<font color="#dc3545" ><b>Closed</b></font> <a type="button" data-tippy-content="Job with status ‘Closed’ means it is <br/>no longer available for you to apply" > <i style="color:#17a2b8;" class="glyphicon glyphicon-question-sign"></i> </a>';
 }else{
    $no8 = '<font color="#ffc107" ><b>"'.$row["j_status"].'"</b></font>';
 }
 
 
 

 if (isset($_SESSION['auth'])) {
	 $no6 = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail" style="text-decoration: none;color: black; ">'.$row["j_rate"].'</a>';
 }else{
	 $no6 = '<a  target="_blank" href="tutor-login?redirect=search_job&jid='.$row['j_id'].'&status='.$row['j_status'].'" class="org-txt"><strong><em>Login to view payment rate</em></strong></a>';
 }

 $no7 = '<a type="button" class="view-button btn btn-sm" target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'">View Detail</a>';





$sub_array[] = '
    <div class="container">
      <div class="panel panel-default">
        <div class="panel-body">
        <center>
              <div class="col-sm-12">
                  '.$no2.'<br/><br/>'.$no3.'<br/><br/>'.$no4.'<br/><br/>'.$no5.'<br/><br/>'.$no8.'<br/><br/>'.$no6.'<br/><br/>'.$no7.'
              </div>
        </center>     
        </div>
      </div>
    </div>';
 
 
 

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

