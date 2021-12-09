<?php

require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

if($_POST["id"]){
 
    
	$query = $conn->query(" SELECT * FROM tk_page_manage_translation WHERE pmt_id='".$_POST["id"]."' ");
	$res = $query->num_rows;
	if($res > 0){
		if($row = $query->fetch_assoc()){ 
			//echo $row['pmt_lastupdated'].' '.date('H:i',strtotime($row['pmt_time']));
			
			if( $row['pmt_lastupdated'] !='' && $row['pmt_time'] !='' ){
			    echo $row['pmt_lastupdated'].' '.date('H:i',strtotime($row['pmt_time']));
			}else{
			    echo '';
			}
			
		}
	}else{
		echo 'Error';
	}
    
    
    
}
?>
