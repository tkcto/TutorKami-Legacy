<?php
session_start();
require_once('../classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}


if (isset($_POST['jt_comments2'])) {
    
//echo $_POST['jt_comments'];
		
		$_SESSION["jt_comments"] = $_POST['jt_comments2'];

	
    
    
}

?>
