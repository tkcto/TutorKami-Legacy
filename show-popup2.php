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
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
if( !empty($_POST['displayid']) && !empty($_POST['displayid']) ){

	$displayid = $_POST['displayid'];               

	$sql = "SELECT * FROM tk_user INNER JOIN tk_user_details ON ud_u_id = u_id WHERE u_displayid = '$displayid'";
	$result = $connect->query($sql);
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if( $row['signature_img'] == '' || $row['signature_img'] == NULL){
		    echo 'no';
		}else{
		    echo 'yes';
		}
	}else{
	    echo "Erorr..";
	}
	$connect->close();
}
?>