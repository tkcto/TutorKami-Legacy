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
if( !empty($_POST['displayid']) && !empty($_POST['dataURL']) ){

	$displayid = $_POST['displayid'];               
	$base64data = $_POST['dataURL'];     
	//echo $displayid." - ".$base64data;

	$sql = "SELECT * FROM tk_user WHERE u_displayid = '$displayid'";
	$result = $connect->query($sql);
 
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$id = $row['u_id'];
		$text =  date("d-m-Y")."_".date("H-i")."_".$id;
		$sql = "UPDATE tk_user SET signature_img = '$text' WHERE u_id = {$id}";
		
		define('UPLOAD_DIR', 'images/signature/');
		$img = $base64data;
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $text . '.png';
		$success = file_put_contents($file, $data);



		if($connect->query($sql) === TRUE) {
			echo "Succcessfully Updated";
		} else {
			echo "Erorr while updating record : ". $connect->error;
		}
	} 
	$connect->close();
}
?>