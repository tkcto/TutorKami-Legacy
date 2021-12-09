<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}
if(isset($_POST['dataSave'])){
	$dataSave = $_POST['dataSave'];
	if( !empty($dataSave["level"]) && !empty($dataSave["state"]) && !empty($dataSave["city"]) && !empty($dataSave["rate"]) ){

		//$fields = implode(",", $dataSave["city"]);
		
		$implodeCity = implode(",", $dataSave["city"]);
		$explodeCity = explode(',', $implodeCity);

		foreach ($explodeCity as $value) {
		    if(is_numeric($value)){
		        $value_new[]=$value;

		    }
		}
		$fields = implode(",", $value_new);
		

		$sql = "INSERT INTO tk_location_rate2 (level, state, city, rate, note) VALUES 
		('".$dataSave['level']."', '".$dataSave['state']."', '".$fields."', '".$dataSave['rate']."', '".$dataSave['note']."')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}else{
		echo "Please Insert Level, State, City And Rate";
	}
}
if(isset($_POST['dataUpdate'])){
	$dataUpdate = $_POST['dataUpdate'];
	if( !empty($dataUpdate["number"]) && !empty($dataUpdate["city"]) && !empty($dataUpdate["rate"]) ){

		$fields = implode(",", $dataUpdate["city"]);

		$sql = "UPDATE tk_location_rate2 SET city='".$fields."', rate='".$dataUpdate['rate']."', note='".$dataUpdate['note']."' WHERE id='".$dataUpdate['number']."'";

		if ($conn->query($sql) === TRUE) {
			echo "Update Is Successful";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	
	}else{
		echo "Please Insert City And Rate";
	}
}

if(isset($_POST['dataDuplicate'])){
	$dataDuplicate = $_POST['dataDuplicate'];
	if( !empty($dataDuplicate["number"]) && !empty($dataDuplicate["level"]) && !empty($dataDuplicate["state"]) && !empty($dataDuplicate["city"]) && !empty($dataDuplicate["rate"]) ){

		$ids = join(',', array_map('intval', $dataDuplicate["city"])); 
		
		$queryLevel = $conn->query("SELECT * FROM tk_location_rate2 WHERE level='".$dataDuplicate['level']."' AND state='".$dataDuplicate['state']."' AND city IN($ids) ");
		$rowLevel = $queryLevel->num_rows;
		if($rowLevel > 0){
			echo "Data Already Exists In Our Record";
			exit();
		}else{
			$fieldsDuplicate = implode(",", $dataDuplicate["city"]);

			$sql = "INSERT INTO tk_location_rate2 (level, state, city, rate, note) VALUES 
			('".$dataDuplicate['level']."', '".$dataDuplicate['state']."', '".$fieldsDuplicate."', '".$dataDuplicate['rate']."', '".$dataDuplicate['note']."')";

			if ($conn->query($sql) === TRUE) {
				echo "Duplicate Successful Save";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}else{
		echo "Please Insert Level, State, City And Rate";
	}
}

if(isset($_POST['dataDelete'])){
	$dataDelete = $_POST['dataDelete'];
	
	$sql = "DELETE FROM tk_location_rate2 WHERE id='".$dataDelete['id']."'";
	
	if ($conn->query($sql) === TRUE) {
		echo "Data Has Been Deleted";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}
$conn->close();
?>