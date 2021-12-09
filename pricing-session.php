<?php
//Include the database configuration file
require_once('includes/head.php');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if( !empty($_POST["selectStateModal1"]) && !empty($_POST["selectStateModal2"]) ){
    //$_SESSION['selectStateModal2']= $_POST["selectStateModal2"];
    
    // string-before ,	
    $arrCity = explode(",", $_POST['selectStateModal2'], 2);
    $first = trim($arrCity[0]);

	$sqlCity = "SELECT * FROM tk_cities WHERE city_name = '".$first."'  ";
	$resultCity = $conn->query($sqlCity);
	if ($resultCity->num_rows > 0) {
		$rowCity = $resultCity->fetch_assoc();
		$thisCity = $rowCity['city_id'];
		$thisCityName = $rowCity['city_name'];
	}else{
	    $thisCity = '';
	    $thisCityName = '';
	}

    // string-after ,	
    $arrState = explode(',', $_POST['selectStateModal2']);
    $second = trim($arrState[1]);

	$sqlState = "SELECT * FROM tk_states WHERE st_name LIKE '".$second."'  ";
	$resultState = $conn->query($sqlState);
	if ($resultState->num_rows > 0) {
		$rowState = $resultState->fetch_assoc();
		$thisState = $rowState['st_id'];
	    $thisStateName = $rowState['st_name'];
	}else{
	    $thisState = '';
	    $thisStateName = '';
	}
    
	$sqltest = "SELECT * FROM tk_location_rate2 WHERE level = ".$_POST['selectStateModal1']." AND state = ".$thisState." ";
	$resulttest = $conn->query($sqltest);
	if ($resulttest->num_rows > 0) {
		while($rowtest = $resulttest->fetch_assoc()){
			$thisArray = $rowtest['city'];
			if (in_array($thisCity, (explode(',',$thisArray)))){
				$arrThis = $rowtest['id'];
				$arrThisRate = $rowtest['rate'];
			break;
			}
		}
	}
	
    if( $arrThisRate != '' && $thisCityName != '' && $thisStateName != '' ){
        $location = $thisCityName.', '.$thisStateName;
        $return_arr = array("rate" => $arrThisRate,"location" => $location);  
        echo json_encode($return_arr);        
    }else{
        $return_arr = array("rate" => 'Error');  
        echo json_encode($return_arr);   
    }
    


}

?>