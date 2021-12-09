

<?php
$servername = "localhost";
$username = "live_tutorkami";
$password = "Tutor@kami";
$dbname = "tutorkami_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// AND (ud_id='10' OR ud_id='11')
// AND (ud_id='12' OR ud_id='14' OR ud_id='25' OR ud_id='99')
//AND ud_admin_comment NOT LIKE '%Auto City :%'


$num = 1;
$autoCity = " 
SELECT * FROM tk_user_details LEFT JOIN tk_user 
ON tk_user_details.ud_u_id = tk_user.u_id 
WHERE u_role='4' AND ud_city='0'

";
$resultAutoCity = $conn->query($autoCity);
if ($resultAutoCity->num_rows > 0) {
    while($rowAutoCity = $resultAutoCity->fetch_assoc()){
		 //echo '<font color=green>No:</font>'.$num.' <font color=green>ud_id:</font> '.$rowAutoCity['ud_id'].' <font color=green>u_role:</font> '.$rowAutoCity['u_role'].' <font color=green>ud_city:</font> '.$rowAutoCity['ud_city'].'<br/>';
		 echo ' <font color=green>u_role:</font> '.$rowAutoCity['u_role'].' <font color=green>ud_id:</font> '.$rowAutoCity['ud_id'].' <font color=green>ud_city:</font> <font color=red>'.$rowAutoCity['ud_city'].'</font> <font color=green>displayid:</font> '.$rowAutoCity['u_displayid']. '</font> <font color=blue>'.$rowAutoCity['ud_admin_comment'].'</font>'.'<br/>';
		 //$num++;
		 
		 $combineAcCity = $rowAutoCity['ud_admin_comment'].'\n Auto City : Select City Name';
		// echo $combineAcCity.'<br/>';

		 $sqlCity = " SELECT * FROM tk_cities WHERE city_name='$rowAutoCity[ud_city]' ";
		 $resultCity = $conn->query($sqlCity);
		 if ($resultCity->num_rows > 0) {
			 $rowCity = $resultCity->fetch_assoc();
			 //echo ' <font color=green>u_role:</font> '.$rowAutoCity['u_role'].' <font color=green>ud_id:</font> '.$rowAutoCity['ud_id'].' <font color=green>ud_city:</font> <font color=red>'.$rowAutoCity['ud_city'].'</font> <font color=green>displayid:</font> '.$rowAutoCity['u_displayid'].'<br/>';
			 //$sqlUpdate = " UPDATE tk_user_details SET ud_city = '$rowCity[city_id]' WHERE ud_id = '".$rowAutoCity["ud_id"]."' ";
			 //$conn->query($sqlUpdate);
		 }else{
			 //$sqlUpdate = " UPDATE tk_user_details SET ud_admin_comment = '$combineAcCity' WHERE ud_id = '".$rowAutoCity["ud_id"]."' ";
			 //$conn->query($sqlUpdate);
		 }

		 
		 
		 
		 
		 
	}
}

		

?>