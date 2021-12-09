<?php
require_once('admin/classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");


if(isset($_POST['dataRemove'])){
	$dataRemove = $_POST['dataRemove'];
	if( !empty($dataRemove["button_id"]) ){
        
        $sql = " DELETE FROM tk_timetable WHERE tt_id='".$dataRemove['button_id']."' ";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }            
     
	}
}


//$conn->close();
?>