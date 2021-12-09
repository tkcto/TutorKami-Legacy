<?php
/* Database connection start */
//require_once('includes/head.php');
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";
/*
$dbConnection = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}
*/
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'u_id', 
	1 => 'u_id',
	2 => 'u_id',
	3 => 'u_id',
	4 => 'u_id',
	5 => 'u_id',
	6 => 'u_id',
	7 => 'u_id',
	8 => 'u_id',
	9 => 'u_id',
	10 => 'u_id',
	11 => 'u_id',
	12 => 'u_id',
	13 => 'u_id',
	14 => 'u_id',
	15 => 'u_id',
	16 => 'u_id',
	17 => 'u_id',
	18 => 'u_id',
	19 => 'u_id',
	20 => 'u_id',
	21 => 'u_id'
);

// getting total number records without any search

$sql = "SELECT * FROM tk_user WHERE u_role != '0' AND u_role != '1' AND u_role != '2'";
//$sql = "SELECT * FROM tk_user";
$query=mysqli_query($conn, $sql) or die("ajax-load-record-migration.php: get tk_user");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM tk_user WHERE u_role != '0' AND u_role != '1' AND u_role != '2' AND 1=1";
//$sql = "SELECT * FROM tk_user WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( u_id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR u_email LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR u_role LIKE '".$requestData['search']['value']."%' )";
}

$query=mysqli_query($conn, $sql) or die("ajax-load-record-migration.php: get tk_user");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("ajax-load-record-migration.php: get tk_user");


$no = 1;
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	//$num_rows = mysqli_num_rows($query);

	$nestedData=array(); 

	$nestedData[] = '<a target="_blank" href="record-migration2.php?id='.$row["u_id"].'&email='.$row["u_email"].'" class="btn_edit tip-right">DETAILS</a>';
	//$nestedData[] = '';
	$nestedData[] = $row["u_id"];
	$nestedData[] = $row["u_email"];
	$nestedData[] = $row["u_role"];
	$nestedData[] = $row["u_username"];
	$nestedData[] = $row["u_password"];
	$nestedData[] = $row["u_displayname"];
	$nestedData[] = $row["u_displayid"];
	$nestedData[] = $row["u_gender"];
	$nestedData[] = $row["u_profile_pic"];
	$nestedData[] = $row["u_oauth_provider"];
	$nestedData[] = $row["u_app_token"];
	$nestedData[] = $row["u_social_id"];
	$nestedData[] = $row["u_status"];
	$nestedData[] = $row["u_paying_client"];
	$nestedData[] = $row["u_admin_approve"];
	$nestedData[] = $row["u_create_date"];
	$nestedData[] = $row["u_modified_date"];
	$nestedData[] = $row["u_country_id"];
	$nestedData[] = $row["ip_address"];
	$nestedData[] = $row["last_page"];
	

	$data[] = $nestedData;
$no++;
}


$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>

