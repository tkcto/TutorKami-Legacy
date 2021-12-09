<?php
session_start();
/* Database connection start */
$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* Database connection end */

$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

$column = array('cr_id', 'cr_cl_id', 'cr_date', 'cr_start_time', 'cr_end_time');

$query = "
SELECT * FROM tk_classes_record 
";
/*
if( isset($_POST['state']) && $_POST['state'] != ''){
	if($_POST['state'] == 'All'){
		$query .= 'AND j_state_id IS NOT NULL ';
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
if( isset($_POST['status']) && $_POST['status'] != ''){
	$query .= ' AND j_status = "'.$_POST['status'].'" ';
}else{
	$query .= ' AND j_status = "open" ';
}
if( isset($_POST['job_id']) && $_POST['job_id'] != ''){
	$query .= ' AND j_id = "'.$_POST['job_id'].'" ';
}
if( isset($_POST['thissort']) && $_POST['thissort'] != ''){
	$query .= ' ORDER BY j_id DESC ';
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
 
 //$sub_array[] = '<a target="_blank" href="job_details.php?jid='.$row['j_id'].'&status='.$row['j_status'].'" data-toggle="tooltip" data-placement="top" title="Please click to view job detail">'.$row['j_id'].'</a>';
 $sub_array[] = '<span id="'.$row['cr_id'].'" name="cr_id" class="editable">'.$row['cr_id'].'</span>';
 $sub_array[] = '<span id="'.$row['cr_id'].'" name="cr_cl_id" class="editable">'.$row['cr_cl_id'].'</span>';
 $sub_array[] = '<span id="'.$row['cr_id'].'" name="cr_date" class="editable">'.$row['cr_date'].'</span>';
 $sub_array[] = '<span id="'.$row['cr_id'].'" name="cr_start_time" class="editable">'.$row['cr_start_time'].'</span>';
 $sub_array[] = '<span id="'.$row['cr_id'].'" name="cr_end_time" class="editable">'.$row['cr_end_time'].'</span>';
 
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "
SELECT * FROM tk_classes_record
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
