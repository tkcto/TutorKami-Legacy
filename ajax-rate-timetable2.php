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
session_start();



if(empty($_POST["namePHP"])){
    echo'Empty Description';
    exit();
}else if(empty($_POST["dayPHP"])){
    echo'Empty Day';
    exit();
}else if(empty($_POST["tutorPHP"])){
    echo'Error : Tutor';
    exit();
}else{
	$tutor     = $_POST["tutorPHP"];


		$sqlDelete = " DELETE FROM tk_timetable WHERE tt_tutor='".$tutor."' ";
		$connect->query($sqlDelete);	  

	$day = $_POST['dayPHP'];
	$name = $_POST['namePHP'];
	
	$totalday = sizeof($day);
	
	for($i=0;$i<$totalday;$i++) {
	
		$Insertday = $day[$i];
		$Insertname = $name[$i];
	

		$sqlTT = " INSERT INTO tk_timetable (tt_tutor, tt_day, tt_time, tt_date) VALUES ( '".$tutor."', '".$Insertday."', '".$Insertname."', '".date('Y-m-d H:i:s')."' ) ";
		$connect->query($sqlTT);
	
	}
    $_SESSION['flash_msg']['msg_type'] = 'success';
    $_SESSION['flash_msg']['msg_text'] = 'Your account has been updated';
	echo 'Updated';


}
?>