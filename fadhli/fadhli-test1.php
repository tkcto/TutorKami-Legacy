<?php
/* Database connection start */
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name

	1 => 'u_id',
	2 => 'u_username',
	3 => 'u_password',
	4 => 'u_role',
	5 => 'u_email',
	6 => 'u_displayname',
	7 => 'u_displayid',
	8 => 'u_gender',
	9 => 'u_profile_pic',
	10 => 'u_oauth_provider',
	11 => 'u_app_token',
	12 => 'u_social_id',
	13 => 'u_status',
	14 => 'u_paying_client',
	15 => 'u_admin_approve',
	16 => 'u_create_date',
	17 => 'u_modified_date',
	18 => 'u_country_id',
	19 => 'ip_address',
	20 => 'last_page'
);

// getting total number records without any search
$sql = "SELECT u_id, u_username, u_password, u_role, u_email, u_displayname, u_displayid, u_gender, u_profile_pic, u_oauth_provider, u_app_token, u_social_id, u_status, u_paying_client, u_admin_approve, u_create_date, u_modified_date, u_country_id, ip_address, last_page ";
$sql.=" FROM tk_user";
$query=mysqli_query($conn, $sql) or die("fadhli-test1.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT u_id, u_username, u_password, u_role, u_email, u_displayname, u_displayid, u_gender, u_profile_pic, u_oauth_provider, u_app_token, u_social_id, u_status, u_paying_client, u_admin_approve, u_create_date, u_modified_date, u_country_id, ip_address, last_page ";
$sql.=" FROM tk_user WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( u_id LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR u_username LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR u_password LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_role LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_email LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_displayname LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_displayid LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_gender LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_profile_pic LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_oauth_provider LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_app_token LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_social_id LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_status LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_paying_client LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_admin_approve LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_create_date LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_modified_date LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR u_country_id LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR ip_address LIKE '".$requestData['search']['value']."%' )";
	$sql.=" OR last_page LIKE '".$requestData['search']['value']."%' )"; 
}
$query=mysqli_query($conn, $sql) or die("fadhli-test1.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("fadhli-test1.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["u_id"];
	$nestedData[] = $row["u_username"];
	$nestedData[] = $row["u_password"];
	$nestedData[] = $row["u_role"];
	$nestedData[] = $row["u_email"];
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
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
