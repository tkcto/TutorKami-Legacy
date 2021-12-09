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
if( !empty($_POST['hide']) && !empty($_POST['hide']) ){
    $_SESSION["hideterms"] = $_POST['hide'];
    echo $_SESSION["hideterms"]; 
	$connect->close();
}
?>