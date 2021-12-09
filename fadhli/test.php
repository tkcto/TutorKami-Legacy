<?php
/*
    if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
        //Send request and receive latitude and longitude
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
        $json = @file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        if($status=="OK"){
            $location = $data->results[0]->formatted_address;
        }else{
            $location =  'No location found.';
        }
        echo $location; 
    } 
    */
?>

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
/*
	$sqltest = "SELECT * FROM tk_location_rate2 WHERE level ='4' AND state ='1046' ";
	$resulttest = $conn->query($sqltest);
	if ($resulttest->num_rows > 0) {
	    
		while($rowtest = $resulttest->fetch_assoc()){
			$thisArray = $rowtest['city'];

if (in_array("46", (explode(',',$thisArray))))
  {
      echo  $rowtest['id'];
  echo "Match found";
  echo "<br/>";
  }

			
			
			
			
		}
		
	}
*/
/*
$sqltest = " SELECT * FROM tk_user LEFT JOIN tk_user_details ON tk_user.u_id = tk_user_details.ud_u_id WHERE u_role='3' AND ud_admin_comment='' ";
$resulttest = $conn->query($sqltest);
if ($resulttest->num_rows > 0) {
    while($rowtest = $resulttest->fetch_assoc()){
        echo $rowtest['u_id'].' - '.$rowtest['ud_admin_comment'].'<br/>';
		
		//$job = " SELECT * FROM tk_job WHERE j_email='$rowtest[u_email]' ";
		//$resultJob = $conn->query($job);
		//if ($resultJob->num_rows > 0) {
			//while($rowtest = $resulttest->fetch_assoc()){
				//echo $rowtest['u_id'].' - '.$rowtest['ud_admin_comment'].'<br/>';
			//}
		//}
		
    }
    
    
}*/
/*
$sqlCity = " SELECT * FROM tk_cities  ";
$resultCity = $conn->query($sqlCity);
if ($resultCity->num_rows > 0) {
    while($rowCity = $resultCity->fetch_assoc()){
		echo $rowCity['city_name'].'<br/>';
	}
}
*/
// AND (ud_id='10' OR ud_id='11')
// AND (ud_id='12' OR ud_id='14' OR ud_id='25' OR ud_id='99')
//AND ud_admin_comment NOT LIKE '%Auto City :%'


$num = 1;
/*$autoCity = " 
SELECT * FROM tk_user_details LEFT JOIN tk_user 
ON tk_user_details.ud_u_id = tk_user.u_id 
WHERE u_role='4' AND ud_last_name !='' AND
ud_last_name REGEXP '^[a-zA-Z0-9][+a-zA-Z0-9._-]*@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]*\\.[a-zA-Z]{2,4}$'

";*/
$autoCity = " 
SELECT * FROM tk_user LEFT JOIN tk_user_details 
ON tk_user.u_id = tk_user_details.ud_u_id  
WHERE u_role='4' AND ud_last_name !=''
AND ud_last_name REGEXP '^[a-zA-Z0-9][+a-zA-Z0-9._-]*@[a-zA-Z0-9][a-zA-Z0-9._-]*[a-zA-Z0-9]*\\.[a-zA-Z]{2,4}$'
";
$resultAutoCity = $conn->query($autoCity);
if ($resultAutoCity->num_rows > 0) {
    while($rowAutoCity = $resultAutoCity->fetch_assoc()){
		 //echo '<font color=green>No:</font>'.$num.' <font color=green>ud_id:</font> '.$rowAutoCity['ud_id'].' <font color=green>u_role:</font> '.$rowAutoCity['u_role'].' <font color=green>ud_city:</font> '.$rowAutoCity['ud_city'].'<br/>';
		 //echo ' <font color=green>u_role:</font> '.$rowAutoCity['u_role'].' <font color=green>ud_id:</font> '.$rowAutoCity['ud_id'].' <font color=green>ud_city:</font> <font color=red>'.$rowAutoCity['ud_city'].'</font> <font color=green>displayid:</font> '.$rowAutoCity['u_displayid']. '</font> <font color=blue>'.$rowAutoCity['ud_admin_comment'].'</font>'.'<br/>';
		 echo '<font color=green>No:</font>'.$num.' <font color=green>u_id:</font> '.$rowAutoCity['u_id'].' <font color=green>ud_u_id:</font> '.$rowAutoCity['ud_u_id'].' <font color=green>u_username:</font> <font color=red>'.$rowAutoCity['u_username'].'</font> <font color=green>ud_last_name:</font> '.$rowAutoCity['ud_last_name'].'<br/>';
		 $num++;

		 $sqlCity = " SELECT * FROM tk_job WHERE j_email='$rowAutoCity[u_username]' ";
		 $resultCity = $conn->query($sqlCity);
		 if ($resultCity->num_rows > 0) {
			 while($rowCity = $resultCity->fetch_assoc()){
			     echo $rowCity['j_id'].'<br/>';
			 }
		 }

		 
		 
		 //$combineAcCity = $rowAutoCity['ud_admin_comment'].'\n Auto City :'.$rowAutoCity['ud_city'];
		// echo $combineAcCity.'<br/>';
/*
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
*/
		 
		 
		 
		 
		 
	}
}

		

?>