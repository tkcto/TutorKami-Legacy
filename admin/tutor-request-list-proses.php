<?php
/* Database connection start */

$servername = "localhost";
$username = "tutorka1_live";
$password = "_+11pj,oow.L";
$dbname = "tutorka1_tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


$connect = new PDO("mysql:host=localhost;dbname=tutorka1_tutorkami_db", "tutorka1_live", "_+11pj,oow.L");

if($_POST['insert']){
	$dataId = $_POST['insert'][0];
	$dataStatus = $_POST['insert'][6];
	$dataManagedBy  = $_POST['insert'][8];
	//echo $dataId." - ".$dataStatus." - ".$dataManagedBy." - ";
	
	$queryUpdate = "UPDATE tk_tutor_request SET tr_status = '$dataStatus', tr_managed_by = '$dataManagedBy' WHERE tr_id = '$dataId' ";
	$statementUpdate = $connect->prepare($queryUpdate);
	$statementUpdate->execute();
	
}else{
	
$column = array('tr_id');

$query = "
SELECT * FROM tk_tutor_request 
";
/*
if( isset($_POST['tr_id'])  ){
 $query .= ' WHERE tr_id IS NOT NULL ';
}

if( isset($_POST['tr_id']) && $_POST['tr_id'] != ''){
 $query .= '
 AND tr_id = "'.$_POST['tr_id'].'"
 ';
}
if( isset($_POST['sort_by']) && $_POST['sort_by'] != ''){
		$query .= 'ORDER BY tr_id DESC ';
}else{
	$query .= 'ORDER BY tr_id DESC ';
}

*/

if(isset($_POST["search"]["value"])){
 $query .= 'WHERE tr_name LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_location LIKE "%'.$_POST["search"]["value"].'%" ';

 $query .= 'OR tr_phone_number LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_subject LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_additional_comment LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_status LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_create_date LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR tr_managed_by LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"])){
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}else{
 $query .= 'ORDER BY tr_id DESC ';
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
 
 $sub_array[] = $row['tr_id'];
 $sub_array[] = $row['tr_name'];
 $sub_array[] = $row['tr_location'];
 $sub_array[] = $row['tr_phone_number'];
 $sub_array[] = $row['tr_subject'];
 $sub_array[] = $row['tr_additional_comment'];
 $sub_array[] = $row['tr_status'];
 //$sub_array[] = date("d/m/Y", strtotime($row['tr_create_date']));
 $sub_array[] = date("d/m/Y H:i:s", strtotime($row['tr_create_date']));
 $sub_array[] = $row['tr_managed_by'];
 
 
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM tk_tutor_request";
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


}
?>

